<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Webmenu extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, HasFactory;

    public $table = 'webmenus';

    protected $appends = [
        'top_image',
        'slider',
        'footer',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bezeichnung',
        'reihenfolge',
        'template_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function menuArtikels()
    {
        return $this->hasMany(Artikel::class, 'menu_id', 'id');
    }

    public function webmenuSubmenus()
    {
        return $this->hasMany(Submenu::class, 'webmenu_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    public function getTopImageAttribute()
    {
        $file = $this->getMedia('top_image')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getSliderAttribute()
    {
        $files = $this->getMedia('slider');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function getFooterAttribute()
    {
        $file = $this->getMedia('footer')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}

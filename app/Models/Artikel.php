<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Artikel extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, HasFactory;

    public $table = 'artikels';

    protected $appends = [
        'images',
        'download',
    ];

    protected $dates = [
        'sichtbar',
        'end',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const POSITION_RADIO = [
        'zentral' => 'zentral',
        'links'   => 'linke Spalte',
        'rechts'  => 'rechte Spalte',
    ];

    protected $fillable = [
        'bezeichnung',
        'menu_id',
        'sichtbar',
        'end',
        'intro',
        'fulltext',
        'position',
        'reihenfolge',
        'created_at',
        'template_id',
        'submenu_id',
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

    public function menu()
    {
        return $this->belongsTo(Webmenu::class, 'menu_id');
    }

    public function getSichtbarAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setSichtbarAttribute($value)
    {
        $this->attributes['sichtbar'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEndAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEndAttribute($value)
    {
        $this->attributes['end'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getImagesAttribute()
    {
        $files = $this->getMedia('images');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview   = $item->getUrl('preview');
        });

        return $files;
    }

    public function getDownloadAttribute()
    {
        return $this->getMedia('download');
    }

    public function template()
    {
        return $this->belongsTo(Template::class, 'template_id');
    }

    public function submenu()
    {
        return $this->belongsTo(Submenu::class, 'submenu_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}

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

class Aktion extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, HasFactory;

    public $table = 'aktions';

    protected $dates = [
        'start',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bezeichnung',
        'text_id',
        'beschreibung',
        'start',
        'ort_id',
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

    public function text()
    {
        return $this->belongsTo(Texte::class, 'text_id');
    }

    public function getStartAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setStartAttribute($value)
    {
        $this->attributes['start'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function targets()
    {
        return $this->belongsToMany(Organe::class);
    }

    public function ort()
    {
        return $this->belongsTo(Ort::class, 'ort_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}

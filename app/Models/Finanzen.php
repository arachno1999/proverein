<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finanzen extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'finanzens';

    protected $dates = [
        'datum',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'datum',
        'bezeichnung',
        'betrag',
        'created_at',
        'kategorie_id',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getDatumAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDatumAttribute($value)
    {
        $this->attributes['datum'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function kategorie()
    {
        return $this->belongsTo(Finanzkategorien::class, 'kategorie_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}

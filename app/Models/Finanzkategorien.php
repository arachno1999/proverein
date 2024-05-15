<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finanzkategorien extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'finanzkategoriens';

    public const TYPE_RADIO = [
        '1'  => 'Einnahme',
        '-1' => 'Ausgabe',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bezeichnung',
        'type',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function kategorieFinanzens()
    {
        return $this->hasMany(Finanzen::class, 'kategorie_id', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}

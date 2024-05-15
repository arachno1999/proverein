<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organe extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'organes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bezeichnung',
        'created_at',
        'reihenfolge',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function targetAktions()
    {
        return $this->belongsToMany(Aktion::class);
    }

    public function organMitglieds()
    {
        return $this->belongsToMany(Mitglied::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}

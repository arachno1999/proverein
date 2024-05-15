<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Counter extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'counters';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'bezeichnung',
        'key',
        'counter',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}

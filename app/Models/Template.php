<?php

namespace App\Models;

use App\Traits\MultiTenantModelTrait;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use SoftDeletes, MultiTenantModelTrait, HasFactory;

    public $table = 'templates';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'content',
        'created_at',
        'code_mobile',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function templateWebmenus()
    {
        return $this->hasMany(Webmenu::class, 'template_id', 'id');
    }

    public function templateArtikels()
    {
        return $this->hasMany(Artikel::class, 'template_id', 'id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SousDirection extends Model
{
    protected $fillable = [
        'direction_id',
        'name',
    ];

    // Relations
    public function direction()
    {
        return $this->belongsTo(Direction::class);
    }

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function scopeByDirection($query, $directionId)
    {
        return $query->where('direction_id', $directionId);
    }

    public function getNombreAgents()
    {
        return $this->agents()->count();
    }

    public function getNomFullName()
    {
        return $this->direction->name . ' - ' . $this->name;
    }
}

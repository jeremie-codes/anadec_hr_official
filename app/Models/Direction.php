<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public static function getDefaulDirections()
    {
        return [
            [
                'name' => 'DRH',
            ],
            [
                'name' => 'DSBD',
            ],
            [
                'name' => 'DIFO',
            ],
            [
                'name' => 'DINFO',
            ],
            [
                'name' => 'DPE',
            ],
            [
                'name' => 'DII',
            ],
            [
                'name' => 'DFI',
            ],
            [
                'name' => 'DISNP',
            ],
            [
                'name' => 'CCRP',
            ],
            [
                'name' => 'CLL Juridique',
            ],
        ];
    }

    // Relations
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function sousDirections()
    {
        return $this->hasMany(SousDirection::class);
    }

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }
}

<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'name', 'phone', 'city', 'province',
    ];

    public function tournaments()
    {
        return $this->belongsToMany(Tournament::class);
    }

    public function tournamentResult()
    {
        return $this->hasMany(Result::class);
    }
}

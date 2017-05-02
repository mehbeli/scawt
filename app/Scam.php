<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scam extends Model
{

    protected $fillable = [
        'title',
        'location',
    ];

    public static $rules = [
        'title' => 'required|max:255',
        'location' => 'required',
    ];

    public static $rules_url = [
        'title' => 'required|max:255',
        'url' => 'required:location',
    ];

    public function totalPoint()
    {
        return $this->hasOne(\App\Point::class);
    }

    public function details()
    {
        return $this->hasOne(\App\ScamDetail::class);
    }

    public function victims()
    {
        return $this->hasMany(\App\Victim::class)->where('victim', true);
    }

    public function score()
    {
        return $this->hasOne(\App\Point::class);
    }
}

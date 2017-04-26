<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Victim extends Model
{
    public function scam()
    {
        return $this->belongsTo(App\Scam::class);
    }
}

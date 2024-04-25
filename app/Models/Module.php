<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public function filiere(){
        return $this->belongsTo(Filiere::class);
    }
    public function presentiel()
    {
        return $this->hasOne(Presentiel::class);
    }

    public function synch()
    {
        return $this->hasOne(Synch::class);
    }

}

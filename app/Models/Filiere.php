<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function secteur(){
        return $this->belongsTo(Secteur::class);
    }
    public function efps(){
        return $this->belongsToMany(EFP::class)->withTimestamps();
    }
    public function modules(){
        return $this->hasMany(Module::class);
    }

}

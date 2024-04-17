<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Efp extends Model
{
    use HasFactory;
    // protected $table = 'efps';
    protected $guarded = ["id"];

    public function filieres(){
        return $this->belongsToMany(Filiere::class)->withTimestamps();
    }
}

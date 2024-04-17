<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousGroupe extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public function groupe(){
        return $this->belongsTo(Groupe::class);
    }

}

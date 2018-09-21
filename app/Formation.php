<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $fillable = ['id','libelle'];



    public function sessions(){
        return $this->hasMany('App\Session');
    }
}

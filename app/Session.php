<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['libelle','description','date','heure','lieu','formatteur','nbr_participants','formation_id'];



    public function formation(){
        return $this->belongsTo('App\Formation');
    }

    public function participants(){
        return $this->belongsToMany('App\User');
    }

}

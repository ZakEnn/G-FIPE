<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['libelle','date','lieu','formatteur','nbr_participants','formation_id'];



    public function formation(){
        return $this->belongsTo('App\Formation');
    }

}

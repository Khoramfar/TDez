<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;
    protected $fillable = ['theater_id','class_id','cost'];

    public function Theater()
	{
		return $this->belongsTo('App\Models\Theater');
	}
    public function Classe()
	{
		return $this->belongsTo('App\Models\Classe');
	}


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $fillable = ['name','salon_id'];

    public function Salon()
	{
		return $this->belongsTo('App\Models\Salon');
	}
    public function Seats()
	{
		return $this->hasMany('App\Models\Seat', 'class_id');
	}
    public function Prices()
	{
		return $this->hasMany('App\Models\Price', 'class_id');
	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    use HasFactory;
    protected $fillable = ['name','address'];

    public function Shows()
	{
		return $this->hasMany('App\Models\Show');
	}
    public function Classes()
	{
		return $this->hasMany('App\Models\Classe');
	}
    public function Seats()
	{
		return $this->hasMany('App\Models\Seat');
	}

}

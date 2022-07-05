<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    protected $fillable = ['salon_id','class_id','name'];
    public function Classe()
	{
		return $this->belongsTo('App\Models\Classe');
	}
    public function Salon()
	{
		return $this->belongsTo('App\Models\Salon');
	}
    public function Tickets()
	{
		return $this->hasMany('App\Models\Ticket');
	}
}

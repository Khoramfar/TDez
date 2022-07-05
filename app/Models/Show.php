<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    use HasFactory;
    protected $fillable = ['theater_id','salon_id','admin_id','show_date','public', 'is_cancelled'];
    public function Theater()
	{
		return $this->belongsTo('App\Models\Theater');
	}
    public function Salon()
	{
		return $this->belongsTo('App\Models\Salon');
	}
    public function Admin()
	{
		return $this->belongsTo('App\Models\User');
	}
    public function Tickets()
	{
		return $this->hasMany('App\Models\Ticket');
	}
}

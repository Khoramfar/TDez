<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id','show_id','payment_status','description','booking_date'];
    public function Customer()
	{
		return $this->belongsTo('App\Models\User');
	}
    public function Tickets()
	{
		return $this->hasMany('App\Models\Ticket');
	}
    public function Show()
    {
        return $this->belongsTo('App\Models\Show');
    }

}

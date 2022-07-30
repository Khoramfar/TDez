<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    protected $fillable = ['salon_id','class_id','name','count','row'];
    public function Classe()
	{
		return $this->belongsTo('App\Models\Classe','class_id');
	}


}

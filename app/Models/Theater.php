<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    use HasFactory;
    protected $fillable = ['title','description','cover_file_name','original_cover_file_name'];
	public function Shows()
	{
		return $this->hasMany('App\Models\Show');
	}
    public function Prices()
	{
		return $this->hasMany('App\Models\Price');
	}
}

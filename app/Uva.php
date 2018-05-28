<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uva extends Model
{
    //
    protected $table = "uvas";

    protected $fillable=[
    	'title',
    	'subtitle',
    	'image',
    	'olfato',
    	'gusto',
    	'vista',
    	'maridaje',
    ];

   	protected $hidden=[
   		'created_at',
   		'updated_at'
   	];

}

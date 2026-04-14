<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = 'sv_logs';
    protected $fillable = [
        'user_id'	 	,
	 	'item_id'	 ,
	 	'action'	 ,
	 	'dattime' ,
	 	'dat' ,
	 	'module'	 ,
	 	'tbl' ,
	 	'no'	 ,
    ];
    public $timestamps = false;

}

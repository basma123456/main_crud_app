<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected  $table = 'gallery';
    public $primarykey = 'id';
    public $incrementing = false;

    public $timestamps = false;
    protected $fillable=['post_id','post_type','name','name_ar','pic','embed'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsLang extends Model
{
    use HasFactory;
    protected  $table = 'posts_lang';
    public $primarykey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable=['lang','post_id','name','short','keyss','descc','details','txt1','txt2','txt3','area1','area2','area3' , 'area4'];
}

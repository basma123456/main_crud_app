<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected  $table = 'categories';
    public $primarykey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable=['module','main_cat','name','name_ar','title_url','short','short_ar','pic'];

    public function posts()
    {
        return $this->hasMany(Post::class , 'cat');
    }
}

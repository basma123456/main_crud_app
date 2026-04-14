<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsMoreFields extends Model
{
    use HasFactory;
    protected $table = 'posts_more_fields';

    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id', 'post_id', 'field_name', 'field_value', 'field_value_ar'];


    public function post()
    {
        return $this->belongsTo(Post::class , 'post_id');
    }
}

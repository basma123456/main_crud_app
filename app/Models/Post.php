<?php

namespace App\Models;

use App\Http\Traits\ImageTrait;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\PostsLang;
 use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use ImageTrait;
    protected $table = 'posts';
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['name', 'cat', 'cat2', 'name_ar', 'pic', 'add_date', 'views', 'downloads', 'comments',
        'url', 'title_url', 'real_url', 'code', 'country', 'region',
        'rate', 'rate_no', 'rate_value', 'start_date', 'end_date', 'file_type' , 'num_of_likes' , 'is_volunteer' , 'logo' , 'module_id'];


    public function postLangs()
    {
        return $this->hasMany(PostsLang::class , 'post_id');
    }

    public function postLangsCurrent()
    {
        return $this->hasOne(PostsLang::class , 'post_id')->where('lang' , app()->getLocale());
    }

//    public function postLangAr()
//    {
//        return $this->hasOne(PostsLang::class , 'post_id')->where('lang' , 'ar');
//    }
//    public function postLangEn()
//    {
//        return $this->hasOne(PostsLang::class , 'post_id')->where('lang' , 'en');
//    }



//    public function galleries()
//    {
//        return $this->hasMany(Gallery::class , 'post_id');
//    }
    public function category()
    {
        return $this->belongsTo(Category::class , 'cat');
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class , 'post_id');
    }


    public function scopeActive($query)
    {
        return  $query->where('active' , 'yes');
    }

    public function image()
    {
        $path = public_path($this->pic);
         if ($this->pic && file_exists($path)) {
            return asset($this->pic);
        } else {
            return asset( "/images/img/not_found.png");
        }
    }



    public function moduleRelation()
    {
        return $this->belongsTo(Module::class , 'module_id');
    }


    public function moreFields()
    {
        return $this->hasMany(PostsMoreFields::class , 'post_id');
    }



    protected static function booted()
    {
        static::deleting(function ($post) {
            $post->postLangs()->delete();


            foreach ($post->gallery as $image) {
              $this->deleteImage($image , 'pic');
            }
            $post->gallery()->delete();
        });
    }
}

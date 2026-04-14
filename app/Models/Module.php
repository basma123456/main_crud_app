<?php

namespace App\Models;

 use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;
    protected $table = 'modules';
    public $primarykey = 'id';
    public $incrementing = false;
    public $timestamps = false;

    //protected $fillable=['id','name','name_ar','title'];

    public function posts()
    {
        return $this->hasMany(Post::class , 'module_id');
    }

    public function moreFields()
    {
        return $this->hasMany(ModuleMoreFields::class , 'mid');
    }


}

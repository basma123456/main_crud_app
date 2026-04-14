<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleMoreFields extends Model
{
    use HasFactory;
    protected $table = 'module_more_fields';

    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id', 'mid', 'fieldName', 'fType', 'fValues'];


    public function module()
    {
        return $this->belongsTo(Module::class , 'mid');
    }

}

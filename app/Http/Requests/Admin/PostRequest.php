<?php

namespace App\Http\Requests\Admin;

use App\Models\Module;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PostRequest extends FormRequest
{
    protected $module = null;

    public function __construct(Request $request)
    {
        $this->module = Module::where('title', $request->module)->firstOrFail();

    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $arr = [];

//        if ($this->module->name_Req == 'yes') {
//            $arr =  array_merge($arr , [
//                'parname' => 'required',
//                'parname_rtl' => 'required',
//            ]);
//         }
//        if ($this->module->details_Req == 'yes') {
//            $arr =    array_merge($arr , [
//                'details' => 'required',
//            ]);
//        }
//        if ($this->module->cat_Req == 'yes') {
//            $arr =    array_merge($arr , [
//                'cat' => 'required',
//            ]);
//        }
//
//        if ($this->module->pic_Req == 'yes') {
//            $arr =   array_merge($arr , [
//                'file' => 'max:2048|mimes:pdf,png,jpeg,jpg',
//            ]);
//        }

        return $arr;
    }
}

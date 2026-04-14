<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $name;
    use ImageTrait;

    public function __construct()
    {
        $this->name = app()->getLocale() == 'ar' ? 'name_ar' : 'name';
    }

    public function add($module)
    {
        $cats = Category::where('module', $module)->get();
        $name = $this->name;
        return view('admin/categories/create', compact('module', 'cats', 'name'));
    }

    public function store($module, Request $request)
    {
        Category::create(['module' => $module,
            'main_cat' => $request->main_cat ?? 0,
            'name' => $request->name,
            'name_ar' => $request->name_ar,
            'title_url' => $request->name,
            'pic' => $this->storeImage($request, '/uploads/category', $request->pic, 'pic')]);

        return redirect()->back();
    }

    public function edit($module, Category $category)
    {
        $cats = Category::where('module', $module)->get();
        $name = $this->name;
        return view('admin/categories/edit', compact('module', 'category', 'cats', 'name'));
    }

    public function update($module, Category $category, Request $request)
    {
        $arr = ['module' => $module, 'main_cat' => $request->main_cat ?? 0, 'name' => $request->name, 'name_ar' => $request->name_ar, 'title_url' => $request->name,];
        if ($request->hasFile('pic')) {
            $arr = array_merge($arr, ['pic' => $this->updateImage($request, '/uploads/category', $request->pic, 'pic', $category)]);
        }
        $category->update($arr);
        return redirect()->back()->with('success', __('lang.item_updated_successfully'));
    }

}

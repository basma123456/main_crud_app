<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Models\Gallery;
use App\Models\Post;
use Illuminate\Http\Request;
use function Pest\json;


class GalleryController extends Controller
{
    use ImageTrait;
    protected $name;

    public function __construct()
    {
        $this->name = app()->getLocale() == 'en' ? 'name' : 'name_' . app()->getLocale();
    }

    public function index($moduleTitle, Post $post)
    {
        $post->load('gallery');
        $name = $this->name;
        return view('admin/gallery/index', compact('post', 'moduleTitle', 'name'));
    }

    public function create($moduleTitle, Post $post)
    {
        $name = $this->name;
        session()->put('module', $post->module);
        session()->put('post_id', $post->id);
        return view('admin/gallery/add', compact('post', 'moduleTitle', 'name'));
    }

    public function storeImages(Request $request)
    {
        $arrOfImages = $this->storeImageMulti($request, '/uploads/gallery/', $request->images, 'images');
        foreach ($arrOfImages as $key => $val) {
            Gallery::create(
                ['post_id' => (int)session('post_id'), 'post_type' => session('module'), 'pic' => $val, 'name' => 0, 'name_ar' => 0, 'embed' => 0]
            );
        }
        return response()->json('true');
    }


    public function delete(Gallery $gallery)
    {
        $this->deleteImage($gallery, 'pic');
        $gallery->delete();
        return redirect()->back();
    }
}

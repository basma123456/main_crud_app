<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Admin\ModuleService;
use App\Http\Services\Admin\PostService;
use App\Models\Module;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    protected $moduleService;
    protected $postsServices;
    public $name;

    public function __construct(ModuleService $moduleService , PostService $postService )
    {
        $this->moduleService = $moduleService;
        $this->postsServices = $postService;
        $this->name = app()->getLocale() == 'ar' ? 'name_' . app()->getLocale() : 'name';
    }



    public function show($title) //show all
    {
        $module = $this->moduleService->findByTitle($title);
        $posts = $this->postsServices->getPostsByModuleTitle($title);
        $name = $this->name;
        return view('admin/modules/list', compact('title', 'posts', 'module' , 'name'));
    }

    public function showByActiveOrDeactive($title , $status)
    {
        $module = $this->moduleService->findByTitle($title);
        $posts = $this->postsServices->getPostsByModuleTitleActiveOrDeactiveParam($title , $status);
        $name = $this->name;
        return view('admin/modules/list', compact('title', 'posts', 'module' , 'name'));
    }



}

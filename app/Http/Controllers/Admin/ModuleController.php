<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ModuleRequest;
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



    public function show($title , ModuleRequest $request) //show all
    {
        $module = $this->moduleService->findByTitle($title);
        $posts = $this->postsServices->getPostsByModuleTitle($title , $request);
        $name = $this->name;
        return view('admin/modules/list', compact('title', 'posts', 'module' , 'name'));
    }

    public function showByActiveOrDeactive($title , $status , ModuleRequest $request)
    {
        $module = $this->moduleService->findByTitle($title);
        $posts = $this->postsServices->getPostsByModuleTitleActiveOrDeactiveParam($title , $status , $request);
        $name = $this->name;
        return view('admin/modules/list', compact('title', 'posts', 'module' , 'name' , 'status'));
    }



}

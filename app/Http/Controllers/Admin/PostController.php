<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Http\Services\Admin\LogsService;
use App\Http\Services\Admin\PostService;
//use App\Models\admin\Logs;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\SettingTrait;
use App\Models\Category;
use App\Models\Module;
use App\Models\ModuleMoreFields;
use App\Models\Post;
use App\Models\PostsLang;
use App\Models\PostsMoreFields;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostController extends Controller
{
    use ImageTrait;
    use SettingTrait;

    protected $name;
    protected $postService;
    protected $logsService;


    public function __construct(PostService $postService, LogsService $logsService)
    {
        $this->postService = $postService;
        $this->name = app()->getLocale() == 'ar' ? 'name_' . app()->getLocale() : 'name';
        $this->logsService = $logsService;
    }


    public function create($module, Request $request)
    {
        $name = $this->name;
        $moduleRow = Module::with('moreFields')->where('title', $module)->firstOrFail();

        $cat = Category::where('module', '=', $moduleRow->title)->get();
        $fields = [];

        if (count($moduleRow->moreFields)) {
            foreach ($moduleRow->moreFields as $row) {
                $serializedData = $row->fValues;
                $unserializedData = unserialize($serializedData);
                $fields[$row->fieldName] = $unserializedData;
            }
        }
        return view('admin/posts/create', compact('moduleRow', 'cat', 'name'));
    }

//    public function edit($module, $id)
//    {
//        $name = $this->name;
//        // show english data
//        $data = Post::with('postLangs', 'postLangsCurrent', 'moduleRelation')
//            ->where('posts.module', $module)
//            ->findOrFail($id);
//
//        // show arabic data
//        $module_id = Module::where('title', $data->module)->value('id');
//        $have_details = Module::where('title', $data->module)->value('have_details');
//        $have_short = Module::where('title', $data->module)->value('have_short');
//        $have_pic = Module::where('title', $module)->value('have_pic');
//
//        $morefields_data = ModuleMoreFields::where('mid', $module_id)->get();
//        $fields = [];
//        if ($morefields_data) {
//            foreach ($morefields_data as $row) {
//                $serializedData = $row->fValues;
//                $unserializedData = unserialize($serializedData);
//                $fields[$row->fieldName] = $unserializedData;
//            }
//        }
//
//        // $module_id = Module::where('title', $data->module)->value('id');
//        $morefields = PostsMoreFields::where('post_id', 45)->value('field_value');
//        // $fields = [];
//        //dd($data7);
//        //var_dump($$data7); dd();
//        /* Serialized Data */
//
//        //show modules name in left
//        $data2 = DB::select('select * from modules');
//
////        return view('admin.header') . view('admin.left', compact('data2', 'role', 'action')) .
////            view('admin.edit_post', compact('data_en', 'data_ar', 'module_id', 'morefields_data', 'morefields', 'fields', 'have_details', 'have_short', 'have_pic', 'action'))
////            . view('admin.footer');
//        return view('admin/posts/edit', compact('data', 'module_id', 'morefields_data', 'morefields', 'fields', 'have_details', 'have_short', 'have_pic', 'name'));
//
//    }


    public function edit($module, $id)
    {
        $name = $this->name;
        $data = Post::with('postLangsCurrent', 'moduleRelation', 'moreFields')->with(['postLangs' => function ($q) {
            $q->take(2);
        }])
            ->where('posts.module', $module)
            ->find($id);

        $morefields_data = ModuleMoreFields::where('mid', $data->module_id)->get();
        $fields = [];
        if ($morefields_data) {
            foreach ($morefields_data as $row) {
                $serializedData = $row->fValues;
                $unserializedData = unserialize($serializedData);
                $fields[$row->fieldName] = $unserializedData;
            }
        }
        $cat = Category::where('module', '=', $data->moduleRelation->title)->get();
        Log::info($data);
        return view('admin/posts/edit', compact('data', 'morefields_data', 'fields', 'name', 'id', 'cat'));

    }


    public function getArrForUpdate(Request $request, $postRow)
    {
        $details = ($postRow->module == 'video' || $postRow->module == 'videos') ? $request->details : $request->details_ar;
        $arrAr = [
            'posts_lang.name' => $request->parname ?? 0,
            'posts.name_ar' => $request->parname ?? 0,
            'lang' => 'ar',
            'posts_lang.details' => $details ?? 0, //videos
            'posts_lang.short' => $request->short_ar ?? 0, //videos
            'posts_lang.keyss' => $request->keyss_ar ?? 0,
            'posts_lang.descc' => $request->descc_ar ?? 0,
            'posts_lang.txt1' => $request->txt_ar0 ?? 0,
            'posts_lang.txt2' => $request->txt_ar1 ?? 0,
            'posts_lang.txt3' => $request->txt_ar2 ?? 0,
            'posts_lang.txt4' => $request->txt_ar3 ?? 0,
            'posts_lang.area1' => $request->area_ar0 ?? 0,
            'posts_lang.area2' => $request->area_ar1 ?? 0,
            'posts_lang.area3' => $request->area_ar2 ?? 0,
            'posts_lang.area4' => $request->area_ar3 ?? 0,
        ];
        $arrEn = [
            'posts.name_en' => $request->pename,
            'posts.news_date' => $request->news_date,
            // 'posts.title_url' => Str::slug($request->pename, '-'),
            'cat' => $request->cat ?? null,
            'posts_lang.name' => $request->pename,
            'posts_lang.details' => $request->details ?? 0,
            'posts_lang.short' => $request->short ?? 0,
            'posts_lang.keyss' => $request->keyss_en ?? 0,
            'posts_lang.descc' => $request->descc_en ?? 0,
            'posts_lang.txt1' => $request->txt0 ?? 0,
            'posts_lang.txt2' => $request->txt1 ?? 0,
            'posts_lang.txt3' => $request->txt2 ?? 0,
            'posts_lang.txt4' => $request->txt3 ?? 0,
            'posts_lang.area1' => $request->area0 ?? 0,
            'posts_lang.area2' => $request->area1 ?? 0,
            'posts_lang.area3' => $request->area2 ?? 0,
            'posts_lang.area4' => $request->area3 ?? 0,
            'file_type' => $request->file_type,
        ];

        $pic = null;
        if ($request->hasFile('pic')) {
            $pic = $this->updateImage($request, '/uploads/posts/images', $request->pic, 'pic', $postRow);
            if ($pic) {
                $arrEn = array_merge(['pic' => $pic], $arrEn);
            }
        }

        return ['ar' => $arrAr, 'en' => $arrEn];
    }


    public function update($module, $id, Request $request)
    {
        $data = $this->postService->queryPostByQueryBuilder($id, 'en');
        $postRow = $data->first();
        $postRow->moreFields()->delete();
        $moduleRow = Module::with('moreFields')->where('title', $module)->first();
        if ($moduleRow->up > 0) {
            $this->updateImageForMoreUploads($request, '/uploads/posts/', [$request->up0, $request->up1, $request->up2], ['up0', 'up1', 'up2'], $data, ['up1', 'up2', 'up3'], $postRow);
        }
        $arrayData = $this->getArrForUpdate($request, $postRow);
        $this->postService->updateByQueryBuilder($arrayData['en'], $arrayData['ar'], $id);
        if ($request->title_url) {
            $data->update(['title_url' => Str::slug($request->title_url, '-'),]);
        }

//        if ($moduleRow->moreFields && count($moduleRow->moreFields)) {
//            foreach ($moduleRow->moreFields as $row0) {
//                if ($row0->fType == 'checkbox' or $row0->fType == 'radio' or $row0->fType == 'dropdown') {
//                    $valofcheckbox = $request->input('morefield' . $row0->id);
//                    $fieldValuesSerialized = serialize($valofcheckbox);
//                    PostsMoreFields::updateOrCreate([
//                        'post_id' => $id,
//                        'field_name' => $row0->fieldName,
//                    ], [
//                        'field_value' => $fieldValuesSerialized,
//                    ]);
//                    //  print_r($valofcheckbox);
//                }
//                if ($row0->fType == 'textbox') {
//                    $valoftxtbox = $request->input('morefield' . $row0->id);
//                    PostsMoreFields::updateOrCreate([
//                        'post_id' => $id,
//                        'field_name' => $row0->fieldName,
//                    ], [
//                        'field_value' => $valoftxtbox,
//                    ]);
//                }
//                if ($row0->fType == 'fileupload') {
//                    $image_name = $request->input('morefield' . $row0->id . '_2');
//                    // $image_names = null;
//
//                    if ($request->hasFile('morefield' . $row0->id)) {
//                        $fileName = $request->file('morefield' . $row0->id);
//
//                        $image_name = time() . '.' . $fileName->getClientOriginalExtension();
//                        $filePath = public_path('uploads/posts/images');
//                        $fileName->move($filePath, $image_name);
//                    }
//                    //dd($request->hasFile('file2'));
//                    PostsMoreFields::updateOrCreate([
//                        'post_id' => $id,
//                        'field_name' => $row0->fieldName,
//                    ], [
//                        'field_value' => $image_name,
//                    ]);
//                }
//            }
//        }

        /****************settings and logs part***************/
        $this->lastUpdateForSettings();
        $this->logsService->saveLog($id, $module, 'Edit post for ' . $module . ' module (' . $id . ')');
        /****************settings and logs part***************/

        if (!$data) {
            return back()->with('error', '$error_occured');
        }
        return back()->with('success', '$success_edit');
    }


    public function getArrForStore(Request $request, $moduleRow, $p_order)
    {
//        dd($request->all());
        $img = null;
        if ($request->hasFile('pic')) {
            $img = $this->storeImage($request, '/uploads/posts/images/', $request->pic, 'pic');
        }
        $arr = [
            'name_en' => $request->parname,
            'name_ar' => $request->parname_rtl,
            'module' => $moduleRow->title,
            'module_id' => $moduleRow->id,
            'pic' => $img,
            'news_date' => $request->news_date,
            'p_order' => $p_order,
            'cat' => $request->cat ?? null,
            'cat2' => 0,
            'add_date' => 0,
            'views' => 0,
            'downloads' => 0,
            'comments' => 0,
            'url' => 0,
            'title_url' => Str::slug($request->pename, '-'),
            'real_url' => 0,
            'code' => 0,
            'country' => 0,
            'region' => 0,
            'rate' => 0,
            'file_type' => $request->file_type,
        ];
        /****************images*********/
        $images_uploades = []; //here
        if ($moduleRow->up > 0) {
            $images_uploades = $this->storeImagesForMoreUploadsForPost($request, '/uploads/posts/', [$request->up0, $request->up1, $request->up2], ['up0', 'up1', 'up2'], ['up1', 'up2', 'up3']);
            $arr = array_merge($arr, $images_uploades);
        }
        /********************end images***********/

        return $arr;
    }


    public function store(PostRequest $request, $module)
    {
        $request->validated();
        $moduleRow = Module::where('title', $module)->firstOrFail();
        $order_q = Post::where('module', $request->module)->max('p_order');
        $p_order = ($order_q !== null) ? $order_q + 1 : 1;
        $arr = $this->getArrForStore($request, $moduleRow, $p_order);
        $lastInsertID = $this->postService->insertNewPostAndGetId($arr);

        /***********************start more fields field*****************/
        $moduleId = Module::where('title', $module)->value('id');
        $data0 = \App\Models\ModuleMoreFields::where('mid', $moduleId)->get();
        foreach ($data0 as $row0) {
            if ($row0->fType == 'checkbox' or $row0->fType == 'radio' or $row0->fType == 'dropdown') {
                $valofcheckbox = $request->input('morefield' . $row0->id);

                // $validator = Validator::make($request->all(), [
                //     'name' => 'required',
                //     'email' => 'required|email',
                //     'phone' => 'required|numeric',
                //     'message' => 'required',
                //     // Add more validation rules for other fields
                // ],
                //     [
                //         'name.required' => __('frontend_lang\validation.required'),
                //         'email.required' => __('frontend_lang\validation.required'),
                //         'email.email' => __('frontend_lang\validation.email'),
                //         'phone.required' => __('frontend_lang\validation.required'),
                //         'phone.numeric' => __('frontend_lang\validation.numeric'),
                //         'message.required' => __('frontend_lang\validation.required'),
                //     ]

                // );

                $field = $data0->where('fieldName', $row0->fieldName)->first();
                $fType = $field ? $field->fType : null;
                $morid = $field ? $field->id : null;
                // $validator = Validator::make($request->all(), [
                //     'morefield' . $row0->id => 'required',

                //     // Add more validation rules for other fields
                // ],
                // [
                //     'morefield' . $row0->id => __('frontend_lang\validation.required'),
                //     'email.required' => __('frontend_lang\validation.required'),
                //     'email.email' => __('frontend_lang\validation.email'),
                //     'phone.required' => __('frontend_lang\validation.required'),
                //     'phone.numeric' => __('frontend_lang\validation.numeric'),
                //     'message.required' => __('frontend_lang\validation.required'),
                // ]

                // );

                $fieldValuesSerialized = serialize($valofcheckbox);
                $data6 = \App\Models\PostsMoreFields::updateOrCreate([
                    'post_id' => $lastInsertID,
                    'field_name' => $row0->fieldName,
                ], [
                    'field_value' => $fieldValuesSerialized,
                ]);
                //  print_r($valofcheckbox);
            }
            if ($row0->fType == 'textbox') {
                $valoftxtbox = $request->input('morefield' . $row0->id);
                $data6 = PostsMoreFields::updateOrCreate([
                    'post_id' => $lastInsertID,
                    'field_name' => $row0->fieldName,
                ], [
                    'field_value' => $valoftxtbox,
                ]);
            }
            if ($row0->fType == 'fileupload') {
                // $image_names = $request->input('morefield'.$row0->id.'_2');
                $image_names = null;

                // foreach ($field['values'] as $file) {
                if ($request->hasFile('morefield' . $row0->id)) {
                    $fileName = $request->file('morefield' . $row0->id);

                    // $fileName = $fileData[0];
                    $image_name = time() . '.' . $fileName->getClientOriginalExtension();
                    $filePath = public_path('uploads/posts/images');
                    $fileName->move($filePath, $image_name);

                    // $image_names[] = $image_name;
                    // }
                }

                //dd($request->hasFile('file2'));
                $data6 = PostsMoreFields::updateOrCreate([
                    'post_id' => $lastInsertID,
                    'field_name' => $row0->fieldName,
                ], [
                    'field_value' => $image_name,
                ]);
            }
        }
        /***********************end more fields field*****************/

        $postLangs = $this->postService->attachPostFields($request, $lastInsertID);


        /****************settings and logs part***************/
        $this->lastUpdateForSettings();
        $this->logsService->saveLog($lastInsertID, $module, 'Add a new post for ' . $module . ' module (' . $lastInsertID . ')');
        /****************settings and logs part***************/

        if ($lastInsertID or $postLangs) {
            return redirect(route('admin.module.show', $request->module))->with('success', __('lang.added_successfully'));
        } else {
            return back()->with('error', __('lang.error_occured'));
        }
    }


    public function changePostOrder($module, $direction, Post $post)
    {
        $msg = $this->postService->changePostOrder($module, $direction, $post);
        return redirect()->back()->with(['msg' => $msg]);
    }

    public function changePostOrderToLastFirst(Post $post)
    {
        $check = $this->postService->changePostOrderToLastFirst($post);
        if ($check) {
            return redirect()->back()->with(['msg' => __('lang.success')]);
        }

    }

    public function changeStatus(Post $post)
    {
        $msg = $this->postService->changeStatus($post);
        return redirect()->back()->with(['msg' => $msg]);
    }


//    public function store(Request $request , $module)
//    {
//        $moduleRow = Module::where('title' , $module)->firstOrFail();
//
//        $order_q =  Post::where('module', $request->module)->max('p_order');
//
//        // Uncomment the following line if you want to check the value of $order_q
//        // dd($order_q);
//
//        if ($order_q !== null) {
//            $p_order = $order_q + 1;
//        } else {
//            $p_order = 1;
//        }
//
//        //     $count_p_order = $p_order->count();
//        //     //$order='';
//        //     if($count_p_order != false){
//        //         foreach($count_p_order as $or_rs){}
//        //         $order = $or_rs->$order+1;
//        //     }
//        //     else{
//        //         $order = 1;
//        //     }
//
//        // $p_order = DB::table('posts')
//        //     ->where('module', $request->module)
//        //     ->orderBy('p_order', 'desc')
//        //     ->get();
//
//        // $count_p_order = $p_order->count();
//
//        // $order = ''; // Initialize $order with a default value
//
//        // if ($count_p_order > 0) {
//        //     // Use $p_order instead of $count_p_order in the foreach loop
//        //     foreach ($p_order as $or_rs) {
//        //         $order = $or_rs->p_order + 1; // Increment $order by 1
//        //     }
//        // } else {
//        //     $order = 1;
//        // }
//        //dd($p_order);
//
//         if ($moduleRow->name_Req  == 'yes') {
//
//            $validated_name = $request->validate([
//                'name' => 'required',
//                'name_ar' => 'required',
//            ]);
//        }
//         if ($moduleRow->details_Req == 'yes') {
//
//            $validated_details = $request->validate([
//                'details' => 'required',
//
//            ]);
//        }
//         if ($moduleRow->cat_Req == 'yes') {
//
//            $validated_cat = $request->validate([
//                'cat' => 'required',
//
//            ]);
//        }
//
//        if ($moduleRow->pic_Req == 'yes') {
//
//            $validated_pic = $request->validate([
//                'pic' => 'max:2048|mimes:pdf,png,jpeg,jpg',
//            ]);
//        }
//
//        $image_name = null;
//        if ($request->hasFile('file')) {
//            $fileName = $request->file('file');
//            //dd($fileName);
//            $image_name = time() . '.' . $fileName->getClientOriginalExtension();
//            //dd($fileName);
//            //  exit(0);
//            $filePath = public_path('uploads/posts/images');
//            $fileName->move($filePath, $image_name);
//        }
//
//
//
//
//        $num_up = DB::table('modules')
//            ->where('title', $request->module)
//            ->value('up');
//        // dd($num_up);
//
//        $file_names = [];
//
//        for ($y = 0; $y < $num_up; $y++) {
//            $up_name = 'up' . $y;
//            if ($request->hasFile($up_name)) {
//                $file = $request->file($up_name);
//                $file_name = time() . '_' . $y . '.' . $file->getClientOriginalExtension();
//                $file_path = public_path('uploads/posts');
//
//                // Ensure the uploads/posts directory exists
//                if (!file_exists($file_path)) {
//                    mkdir($file_path, 0777, true);
//                }
//
//                // Move the file to the uploads/posts directory
//                $file->move($file_path, $file_name);
//
//                // Store the file name in the array
//                $file_names[$y] = $file_name;
//
//                // Debugging: check if the file exists in the target directory
//                if (!file_exists($file_path . '/' . $file_name)) {
//                    dd("Failed to move file: " . $file_path . '/' . $file_name);
//                }
//            }
//        }
//
//        $more_file_name0 = $file_names[0] ?? '';
//        $more_file_name1 = $file_names[1] ?? '';
//        $more_file_name2 = $file_names[2] ?? '';
//
//        // }
//
//        $arr = [
//            'name_en' => $request->pename,
//            'name_ar' => $request->parname,
//            'module' => $request->module,
//            'module_id' => $moduleRow->id,
//            'pic' => $image_name,
//            'up1' => $more_file_name0,
//            'up2' => $more_file_name1,
//            'up3' => $more_file_name2,
//            'news_date' => $request->news_date,
//            'p_order' => $p_order,
//            'cat' => $request->cat ?? null,
//            'cat2' => 0,
//            'add_date' => 0,
//            'views' => 0,
//            'downloads' => 0,
//            'comments' => 0,
//            'url' => 0,
//            'title_url' => Str::slug($request->pename, '-'),
//            'real_url' => 0,
//            'code' => 0,
//            'country' => 0,
//            'region' => 0,
//            'rate' => 0,
//            'file_type' => $request->file_type,
////            'is_volunteer' => $request->is_volunteer ?? 0,
//        ];
//
//        $lastInsertID = DB::table('posts')->insertGetId($arr);
//
//        //dd($lastInsertID);
//
//        // $data = Post::create([
//        //     'name'   => $request->pename,
//        //     'name_ar'   => $request->parname,
//        //     'module' => $request->module,
//        //     'pic'    => $image_name,
//        //     'cat'    => 0,
//        //     'cat2'    => 0,
//        //     'add_date'    => 0,
//        //     'views'    => 0,
//        //     'downloads'    => 0,
//        //     'comments'    => 0,
//        //     'url'    => 0,
//        //     'title_url'    => 0,
//        //     'real_url'    => 0,
//        //     'code'    => 0,
//        //     'country'    => 0,
//        //     'region'    => 0,
//        //     'rate'    => 0,
//        //     // 'start_date'    => 0000-00-00,
//        //     // 'end_date'    => 0000-00-00,
//        // ]);
//
//        // $mylastid = DB::getPdo()->lastInsertId();
//        // $lastInsertID = $data->id;
//
//        //dd($insertedId);
//
//        // EN Data
//        $arrEn = [
//            'post_id' => $lastInsertID,
//            'lang' => 'en',
//            'name' => $request->pename,
//
//            'details' => $request->details ?? 0,
//            'short' => $request->short ?? 0,
//            'keyss' => $request->keyss_en ?? 0,
//            'descc' => $request->descc_en ?? 0,
//            'txt1' => $request->txt0 ?? 0,
//            'txt2' => $request->txt1 ?? 0,
//            'txt3' => $request->txt2 ?? 0,
//            'txt4' => $request->txt3 ?? 0,
//            'area1' => $request->area0 ?? 0,
//            'area2' => $request->area1 ?? 0,
//            'area3' => $request->area2 ?? 0,
//            'area4' => $request->area3 ?? 0,
//
//        ];
//
//
//
//        $data2 = PostsLang::create($arrEn);
//
//        $module = $request->input('module');
//        $moduleId = Module::where('title', $module)->value('id');
//        //  $data0 = ModuleMoreFields::where('mid', $moduleId)->value('fType');
//        $data0 = \App\Models\ModuleMoreFields::where('mid', $moduleId)->get();
//        foreach ($data0 as $row0) {
//            if ($row0->fType == 'checkbox' or $row0->fType == 'radio' or $row0->fType == 'dropdown') {
//                $valofcheckbox = $request->input('morefield' . $row0->id);
//
//                // $validator = Validator::make($request->all(), [
//                //     'name' => 'required',
//                //     'email' => 'required|email',
//                //     'phone' => 'required|numeric',
//                //     'message' => 'required',
//                //     // Add more validation rules for other fields
//                // ],
//                //     [
//                //         'name.required' => __('frontend_lang\validation.required'),
//                //         'email.required' => __('frontend_lang\validation.required'),
//                //         'email.email' => __('frontend_lang\validation.email'),
//                //         'phone.required' => __('frontend_lang\validation.required'),
//                //         'phone.numeric' => __('frontend_lang\validation.numeric'),
//                //         'message.required' => __('frontend_lang\validation.required'),
//                //     ]
//
//                // );
//
//                $field = $data0->where('fieldName', $row0->fieldName)->first();
//                $fType = $field ? $field->fType : null;
//                $morid = $field ? $field->id : null;
//                // $validator = Validator::make($request->all(), [
//                //     'morefield' . $row0->id => 'required',
//
//                //     // Add more validation rules for other fields
//                // ],
//                // [
//                //     'morefield' . $row0->id => __('frontend_lang\validation.required'),
//                //     'email.required' => __('frontend_lang\validation.required'),
//                //     'email.email' => __('frontend_lang\validation.email'),
//                //     'phone.required' => __('frontend_lang\validation.required'),
//                //     'phone.numeric' => __('frontend_lang\validation.numeric'),
//                //     'message.required' => __('frontend_lang\validation.required'),
//                // ]
//
//                // );
//
//                $fieldValuesSerialized = serialize($valofcheckbox);
//                $data6 = \App\Models\PostsMoreFields::updateOrCreate([
//                    'post_id' => $lastInsertID,
//                    'field_name' => $row0->fieldName,
//                ], [
//                    'field_value' => $fieldValuesSerialized,
//                ]);
//                //  print_r($valofcheckbox);
//            }
//            if ($row0->fType == 'textbox') {
//                $valoftxtbox = $request->input('morefield' . $row0->id);
//                $data6 = PostsMoreFields::updateOrCreate([
//                    'post_id' => $lastInsertID,
//                    'field_name' => $row0->fieldName,
//                ], [
//                    'field_value' => $valoftxtbox,
//                ]);
//            }
//            if ($row0->fType == 'fileupload') {
//                // $image_names = $request->input('morefield'.$row0->id.'_2');
//                $image_names = null;
//
//                // foreach ($field['values'] as $file) {
//                if ($request->hasFile('morefield' . $row0->id)) {
//                    $fileName = $request->file('morefield' . $row0->id);
//
//                    // $fileName = $fileData[0];
//                    $image_name = time() . '.' . $fileName->getClientOriginalExtension();
//                    $filePath = public_path('uploads/posts/images');
//                    $fileName->move($filePath, $image_name);
//
//                    // $image_names[] = $image_name;
//                    // }
//                }
//                //dd($request->hasFile('file2'));
//                $data6 = PostsMoreFields::updateOrCreate([
//                    'post_id' => $lastInsertID,
//                    'field_name' => $row0->fieldName,
//                ], [
//                    'field_value' => $image_name,
//                ]);
//            }
//        }
//        // dd($details = $request->details_ar);
//        // AR Data
//        if ($request->module == 'video' || $request->module == 'videos') {
//            $details = $request->details;
//        } else {
//            $details = $request->details_ar;
//        }
//
//        /**************************************/
//        $arrAr = [
//            'post_id' => $lastInsertID,
//            'lang' => 'ar',
//            'name' => $request->parname,
//            'details' => $details ?? 0,
//            'short' => $request->short_ar ?? 0,
//            'keyss' => $request->keyss_ar ?? 0,
//            'descc' => $request->descc_ar ?? 0,
//            'txt1' => $request->txt_ar0 ?? 0,
//            'txt2' => $request->txt_ar1 ?? 0,
//            'txt3' => $request->txt_ar2 ?? 0,
//            'txt4' => $request->txt_ar3 ?? 0,
//            'area1' => $request->area_ar0 ?? 0,
//            'area2' => $request->area_ar1 ?? 0,
//            'area3' => $request->area_ar2 ?? 0,
//            'area4' => $request->area_ar3 ?? 0,
//
//        ];
//
//
//        $data3 = PostsLang::create($arrAr);
//
//        /********************************/
////        $logs = Logs::create([
////            'user_id' => Auth::user()->id,
////            'item_id' => $lastInsertID,
////            'action' => 'Add post for ' . $module . ' module (' . $lastInsertID . ')',
////            'dattime' => date('Y-m-d H:i:s'),
////            'dat' => date('Y-m-d'),
////            'module' => $module,
////        ]);
////        $this->clearCache($module);
////
//        $success_add = Lang::get('backend_lang/custom.success_add');
//        $error_occured = Lang::get('backend_lang/custom.error_occured');
//        $access_denied = Lang::get('backend_lang/custom.access_denied');
//
//        if ($lastInsertID or $data2 or $data3) {
//
//            // return back()->with('success', 'Data Saved successfully!');
//            return redirect('/AdminCp/module/' . $request->module)->with('success', $success_add);
//        } else {
//            return back()->with('error', $error_occured);
//        }
//    }

//    public function update($module, $id, Request $request)
//    {
//        //upload image
//        $request->validate([
//            'file' => 'max:2048|mimes:pdf,png,jpeg,jpg',
//        ]);
//
//
////         dd($request->all() );
//        // English Data
//        $data = DB::table('posts')
//            ->join('posts_lang', 'posts.id', '=', 'posts_lang.post_id')
//            ->where('posts_lang.lang', 'en')
//            ->where('posts.id', $id);
//
//
//        PostsMoreFields::where('post_id', $id)->delete();
//        $num_up = DB::table('modules')
//            ->where('title', $module)
//            ->value('up');
//        // Initialize with old values
//        $more_file_name0 = $request->upp0;
//        $more_file_name1 = $request->upp1;
//        $more_file_name2 = $request->upp2;
//
//        $file_names = [];
//
//        for ($y = 0; $y < $num_up; $y++) {
//            $up_name = 'up' . $y;
//            if (isset($_FILES[$up_name]['name']) && !empty($_FILES[$up_name]['name'])) {
//                // Get the file object
//                $file = $_FILES[$up_name];
//
//                // Generate a unique file name
//                $file_name = time() . '_' . $y . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
//
//                // Set the upload path
//                $file_path = './uploads/posts/';
//
//                // Ensure the uploads/posts directory exists
//                if (!is_dir($file_path)) {
//                    mkdir($file_path, 0777, true);
//                }
//
//                // Move the file to the uploads/posts directory
//                move_uploaded_file($file['tmp_name'], $file_path . $file_name);
//
//                // Store the file name in the array
//                $file_names[$y] = $file_name;
//
//                // Debugging: check if the file exists in the target directory
//                if (!file_exists($file_path . $file_name)) {
//                    die("Failed to move file: " . $file_path . $file_name);
//                }
//            }
//        }
//
//        // Assign new file names to variables
//        $more_file_name0 = $file_names[0] ?? $more_file_name0;
//        $more_file_name1 = $file_names[1] ?? $more_file_name1;
//        $more_file_name2 = $file_names[2] ?? $more_file_name2;
//
//        if ($request->hasFile('file')) {
//            $fileName = time() . '.' . $request->file('file')->getClientOriginalExtension();
//            $filePath = public_path('uploads/posts/images');
//
//            // Delete the old image if necessary
//            // File::delete(public_path('uploads/posts/images/' . $yourModel->image));
//
//            $request->file('file')->move($filePath, $fileName);
//
//            $data->update([
//                'pic' => $fileName,
//            ]);
//        }
//
//        $data->update([
//            'posts.name_en' => $request->pename,
//            'posts.news_date' => $request->news_date,
//            // 'posts.title_url' => Str::slug($request->pename, '-'),
//            'cat' => $request->cat ?? null,
//            'up1' => $more_file_name0,
//            'up2' => $more_file_name1,
//            'up3' => $more_file_name2,
//            'posts_lang.name' => $request->pename,
//            'posts_lang.details' => $request->details ?? 0,
//            'posts_lang.short' => $request->short ?? 0,
//            'posts_lang.keyss' => $request->keyss_en ?? 0,
//            'posts_lang.descc' => $request->descc_en ?? 0,
//            'posts_lang.txt1' => $request->txt0 ?? 0,
//            'posts_lang.txt2' => $request->txt1 ?? 0,
//            'posts_lang.txt3' => $request->txt2 ?? 0,
//            'posts_lang.txt4' => $request->txt3 ?? 0,
//            'posts_lang.area1' => $request->area0 ?? 0,
//            'posts_lang.area2' => $request->area1 ?? 0,
//            'posts_lang.area3' => $request->area2 ?? 0,
//            'posts_lang.area4' => $request->area3 ?? 0,
//
//            'file_type' => $request->file_type,
////            'is_volunteer' => $request->is_volunteer ?? 0,
//
//        ]);
//        $title_url = Post::where('id', $id)->value('title_url');
//        if ($request->title_url) {
//
//            $data->update(['title_url' => Str::slug($request->title_url, '-'),]);
//        } else {
//            //   $data->update(['title_url' => $title_url,]);
//        }
//
//        $moduleId = Module::where('title', $module)->value('id');
//        //  $data0 = ModuleMoreFields::where('mid', $moduleId)->value('fType');
//        $data0 = ModuleMoreFields::where('mid', $moduleId)->get();
//        foreach ($data0 as $row0) {
//            if ($row0->fType == 'checkbox' or $row0->fType == 'radio' or $row0->fType == 'dropdown') {
//                $valofcheckbox = $request->input('morefield' . $row0->id);
//                $fieldValuesSerialized = serialize($valofcheckbox);
//                $data6 = PostsMoreFields::updateOrCreate([
//                    'post_id' => $id,
//                    'field_name' => $row0->fieldName,
//                ], [
//                    'field_value' => $fieldValuesSerialized,
//                ]);
//                //  print_r($valofcheckbox);
//            }
//            if ($row0->fType == 'textbox') {
//                $valoftxtbox = $request->input('morefield' . $row0->id);
//                $data6 = PostsMoreFields::updateOrCreate([
//                    'post_id' => $id,
//                    'field_name' => $row0->fieldName,
//                ], [
//                    'field_value' => $valoftxtbox,
//                ]);
//            }
//            if ($row0->fType == 'fileupload') {
//                $image_name = $request->input('morefield' . $row0->id . '_2');
//                // $image_names = null;
//
//                if ($request->hasFile('morefield' . $row0->id)) {
//                    $fileName = $request->file('morefield' . $row0->id);
//
//                    $image_name = time() . '.' . $fileName->getClientOriginalExtension();
//                    $filePath = public_path('uploads/posts/images');
//                    $fileName->move($filePath, $image_name);
//                }
//                //dd($request->hasFile('file2'));
//                $data6 = PostsMoreFields::updateOrCreate([
//                    'post_id' => $id,
//                    'field_name' => $row0->fieldName,
//                ], [
//                    'field_value' => $image_name,
//                ]);
//            }
//        }
//
//        // Arabic Data
//        $data_ar = DB::table('posts')
//            ->join('posts_lang', 'posts.id', '=', 'posts_lang.post_id')
//            ->where('posts_lang.lang', 'ar')
//            ->where('posts.id', $id);
//        //  ->update([
//        //             'posts.name' => $request->input('name'),
//        //             'posts_lang.name' => $request->input('name_lang'),
//        //             'posts_lang.details' => $request->input('details_lang')
//        //         ]);
//        // dd($module);
//        if ($module == 'video' || $module == 'videos') {
//            $details = $request->details;  // For 'video' or 'videos' modules, or when id is 10
//        } else {
//            $details = $request->details_ar;  // For other modules
//        }
//        $data_ar->update([
//            'posts_lang.name' => $request->parname ?? 0,
//            'posts.name_ar' => $request->parname ?? 0,
//            'lang' => 'ar',
//            // 'posts_lang.details' => $request->details_ar ?? 0,
//            'posts_lang.details' => $details ?? 0, //videos
//            'posts_lang.short' => $request->short_ar ?? 0, //videos
//            'posts_lang.keyss' => $request->keyss_ar ?? 0,
//            'posts_lang.descc' => $request->descc_ar ?? 0,
//            'posts_lang.txt1' => $request->txt_ar0 ?? 0,
//            'posts_lang.txt2' => $request->txt_ar1 ?? 0,
//            'posts_lang.txt3' => $request->txt_ar2 ?? 0,
//            'posts_lang.txt4' => $request->txt_ar3 ?? 0,
//            'posts_lang.area1' => $request->area_ar0 ?? 0,
//            'posts_lang.area2' => $request->area_ar1 ?? 0,
//            'posts_lang.area3' => $request->area_ar2 ?? 0,
//            'posts_lang.area4' => $request->area_ar3 ?? 0,
//
//        ]);
////        $logs = Logs::create([
////            'user_id' => Auth::user()->id,
////            'item_id' => $id,
////            'action' => 'Edit post for ' . $module . ' module (' . $id . ')',
////            'dattime' => date('Y-m-d H:i:s'),
////            'dat' => date('Y-m-d'),
////            'module' => $module,
////        ]);
////
////
////        $setting = Setteing::first();
////        $setting->update(['last_update' => now()]);
////
////        $this->clearCache($module);
//
//        if ($data || $data_ar) {
//
//            return back()->with('success', '$success_edit');
//        } else {
//            return back()->with('error', '$error_occured');
//        }
//
//
//    }


    public function show($module, $id)
    {
        $name = $this->name;
        $data = Post::with('postLangsCurrent', 'moduleRelation', 'moreFields')->with(['postLangs' => function ($q) {
            $q->take(2);
        }])
            ->where('posts.module', $module)
            ->find($id);

        $morefields_data = ModuleMoreFields::where('mid', $data->module_id)->get();
        $fields = [];
        if ($morefields_data) {
            foreach ($morefields_data as $row) {
                $serializedData = $row->fValues;
                $unserializedData = unserialize($serializedData);
                $fields[$row->fieldName] = $unserializedData;
            }
        }
        $cat = Category::where('module', '=', $data->moduleRelation->title)->get();
        Log::info($data);
        return view('admin/posts/show', compact('data', 'morefields_data', 'fields', 'name', 'id', 'cat'));

    }


    public function delete(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }


}

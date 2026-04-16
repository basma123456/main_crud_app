<?php

namespace App\Http\Services\Admin;

use App\Models\Module;
use App\Models\Post;
use App\Models\PostsLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService
{
    /**
     * Get module by ID
     */
    public function getPostsByModuleTitle($title, $request = null)
    {
        $query = Post::whereHas('moduleRelation', function ($q) use ($title) {
            $q->where('title', $title);
        })->with('category', 'postLangsCurrent');

        if ($request->search) {
            $query = $query->where(function ($q) use ($request, $title) {
                $q->where('name_en', 'like', '%' . $request->search . '%')->orWhere('name_ar', 'like', '%' . $request->search . '%')->where('module', $title)
                    ->orWhereHas('category', function ($q3) use ($request) {
                        $q3->where('name', 'like', '%' . $request->search . '%')
                            ->orWhere('name_ar', 'like', '%' . $request->search . '%');
                    });
            });
        }
        $posts = $query->with('moduleRelation')->orderBy('p_order', 'desc')->paginate(config('app.pagination_num'))->appends([
            'search' => $request->search
        ]);

        return $posts;
    }

    public function getPostsByModuleTitleActiveOrDeactiveParam($title, $status, $request)
    {
        $query = Post::whereHas('moduleRelation', function ($q) use ($title) {
            $q->where('title', $title);
        })->with(['category', 'moduleRelation'  , 'postLangsCurrent'])->where('active', $status);
        if ($request->search) {
            $query = $query->where(function ($q) use ($request, $title) {
                $q->where('name_en', 'like', '%' . $request->search . '%')->orWhere('name_ar', 'like', '%' . $request->search . '%')->where('module', $title)
                    ->orWhereHas('category', function ($q3) use ($request) {
                        $q3->where('name', 'like', '%' . $request->search . '%')
                            ->orWhere('name_ar', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $posts = $query->orderBy('p_order', 'desc')->paginate(config('app.pagination_num'))->appends([
            'search' => $request->search
        ]);
        return $posts;
    }

    public function queryPostByQueryBuilder($id, $lang)
    {
        return Post::join('posts_lang', 'posts.id', '=', 'posts_lang.post_id')->with('moreFields')
            ->where('posts_lang.lang', $lang)
            ->where('posts.id', $id);
    }


    public function updateByQueryBuilder($arrEn, $arrAr, $id)
    {
//dd($arrEn , $arrAr);
        DB::table('posts')
            ->join('posts_lang', 'posts.id', '=', 'posts_lang.post_id')
            ->where('posts.id', $id)
            ->where('posts_lang.lang', 'en')
            ->update($arrEn);

        DB::table('posts')
            ->join('posts_lang', 'posts.id', '=', 'posts_lang.post_id')
            ->where('posts.id', $id)
            ->where('posts_lang.lang', 'ar')
            ->update($arrAr);

        return true;
    }


    public function insertNewPostAndGetId($arr)
    {
        return DB::table('posts')->insertGetId($arr);
    }


    public function getArrForStorePostLangs(Request $request, $lastInsertID)
    {

        $arrAr = [
            'post_id' => $lastInsertID,
            'lang' => 'ar',
            'name' => $request->parname_rtl,
            'details' => ($request->module == 'video' || $request->module == 'videos') ? $request->details : $request->details_ar,
            'short' => $request->short_ar ?? 0,
            'keyss' => $request->keyss_ar ?? 0,
            'descc' => $request->descc_ar ?? 0,
            'txt2' => '0',
            'txt3' => 0,
            'area2' => 0,
            'area3' => 0,
        ];

        if (!empty($request->area_ar)) {
            foreach ($request->area_ar as $key => $val) {
                $num = ($key + 1);
                $arrAr['area' . $num] = $val??0;
            }
        }
        if (!empty($request->txt_ar)) {
            foreach ($request->txt_ar as $key => $val) {
                $num = ($key + 1);
                $arrAr['txt' . $num] = $val??0;
            }
        }

        $arrEn = [
            'post_id' => $lastInsertID,
            'lang' => 'en',
            'name' => $request->parname,
            'details' => $request->details ?? 0,
            'short' => $request->short ?? 0,
            'keyss' => $request->keyss_en ?? 0,
            'descc' => $request->descc_en ?? 0,
            'txt2' => '0',
            'txt3' => 0,
            'area2' => 0,
            'area3' => 0,

        ];
        if (!empty($request->area)) {
            foreach ($request->area as $key => $val) {
                $num = ($key + 1);
                $arrEn['area' . $num] = $val;
            }
        }
        if (!empty($request->txt)) {
            foreach ($request->txt as $key => $val) {
                $num = ($key + 1);
                $arrEn['txt' . $num] = $val;
            }
        }

        return ['arrAr' => $arrAr, 'arrEn' => $arrEn];
    }

    public function attachPostFields($request, $lastInsertID)
    {
        return PostsLang::insert([$this->getArrForStorePostLangs($request, $lastInsertID)['arrAr'], $this->getArrForStorePostLangs($request, $lastInsertID)['arrEn']]);
    }


    public function changePostOrder($module, $direction, Post $post)
    {
        $msg = '';
        switch ($direction) {
            case "+" :

                $currentOrder = $post->p_order;
                $estimatedOrder = $currentOrder + 1;
                $msg = __('lang.order_increased_successfully');
                break;
            case "-" :
                 $currentOrder = $post->p_order;
                $estimatedOrder = $post->p_order >= 2 ? $currentOrder - 1 : 1;
                $msg = __('lang.order_decreased_successfully');
                break;
            default :
        }
        /**************************************update the other post that has (estimated order that we will take) to be current order*****************************/
        Post::where(['p_order' => $estimatedOrder, 'module' => $module])->update(['p_order' => $currentOrder]);
        /*************************************************************************************************************************************/

        /**************************************update  our post to have estimated order instead of current order*****************************/
        $post->p_order = $estimatedOrder;
        $post->save();
        /*************************************************************************************************************************************/
        return $msg;
    }


    public function changePostOrderToLastFirst(Post $post)
    {
//        $lastFirstOrder = Post::whereRaw('id = (SELECT MAX(id) FROM posts)')->first();
        $lastFirstOrder = Post::where('module', $post->module)->orderBy('p_order', 'desc')->first();
        if (!$lastFirstOrder || ($lastFirstOrder == $post)) {
            return false;
        }
        $estimatedOrder = $lastFirstOrder->p_order > 0 ? $lastFirstOrder->p_order : 1;
        $currentOrder = $post->p_order;

        /**************************************update the other post that has (estimated order that we will take) to be current order*****************************/
        $lastFirstOrder->p_order = $currentOrder;
        $lastFirstOrder->save();
        /*************************************************************************************************************************************/

        /**************************************update  our post to have estimated order instead of current order*****************************/
        $post->p_order = $estimatedOrder;
        $post->save();
        /*************************************************************************************************************************************/
        return true;
    }


    public function changeStatus($post)
    {
        if ($post->active == 'no') {
            $post->active = 'yes';
            $post->save();
            $msg = __('lang.post_is_activated_successfully');
        } else {
            $post->active = 'no';
            $post->save();
            $msg = __('lang.post_is_deactivated_successfully');
        }
        return $msg;
    }

}

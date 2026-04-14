<?php

namespace App\Http\Services\Admin;

use App\Models\Logs;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class LogsService
{

    public function saveLog($id , $moduleTitle , $action){
        Logs::create([
            'user_id' => Auth::user()->id,
            'item_id' => $id,
            'action' => $action,
            'dattime' => date('Y-m-d H:i:s'),
            'dat' => date('Y-m-d'),
            'module' => $moduleTitle,
        ]);
        return true;

    }

}

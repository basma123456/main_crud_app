<?php

namespace App\Http\Traits;


use App\Models\Setting;
use Illuminate\Support\Facades\Log;

trait SettingTrait
{

    public function lastUpdateForSettings(){
         Setting::first()->update(['last_update' => now()]);
         return true;
    }
}

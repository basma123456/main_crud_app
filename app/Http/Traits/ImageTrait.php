<?php

namespace App\Http\Traits;


use Illuminate\Support\Facades\Log;

trait ImageTrait
{

    function storeImage($request, $path, $requestName, $name, $key = 0)
    {

        if ($request->hasfile($name)) {
            $file = $requestName;
            $newfile = time() . $key . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . $path, $newfile);
            return $path . '/' . $newfile;
        }
    }


    function deleteImage($model, $name)
    {
        if ($model->$name && !(is_dir(public_path() . ($model->$name))) && file_exists(public_path() . ($model->$name))) {
            unlink(public_path() . ($model->$name));
        }
        return true;
    }


    function updateImage($request, $path, $requestName, $name, $model, $key = 0)
    {
        if ($model->$name && !(is_dir(public_path() . ($model->$name))) && file_exists(public_path() . ($model->$name))) {
            unlink(public_path() . ($model->$name));
        }
        if ($request->hasfile($name)) {
            $file = $requestName;
            $newfile = time() . $key . '.' . $file->getClientOriginalExtension();
            $file->move(public_path() . $path, $newfile);
            return $path . '/' . $newfile;
        }
    }


    function deleteMultipleImages($array, $name)
    {
        if ($array && count($array))
            foreach ($array as $photo) {
                if (!(is_dir(public_path() . ($photo))) && file_exists(public_path() . ($photo))) {
                    unlink(public_path() . ($photo));
                }
            }
    }


    function storeImageMulti($request, $path, $requestName, $name)
    {
        $newfileAll = [];
        foreach ($requestName as $key => $val) {

            if (isset($requestName[$key])) {
                if (isset($request->file($name)[$key])) {
                    $file = $request->file($name)[$key];
                    $newfile = time() . $key . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . $path, $newfile);
                    $newfileAll[] = $path . $newfile;
                }
            }
        }
        return $newfileAll;
    }

    public function storeImagesForMoreUploadsForPost($request, $path, $requestNames, $names, $modelNames)
    {
        $newfileAll = [];
        $arr = [];
//        $model = $modelRow->first();

        foreach ($requestNames as $key => $val) {
            if (isset($requestNames[$key])) {
                $new = $names[$key];
                /**************show error *******/
                $file = $request->file($new);
                /**************show error *******/


                if (isset($file) && $request->file($new) != null) {

                    try {
                        $newfile = time() . $key . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path() . $path, $newfile);
                        $newfileAll[$key] = $path . $newfile;


                        if (isset($modelNames[$key]) && $newfileAll[$key]) {
                            $arr[$modelNames[$key]] = $newfileAll[$key];
//
//                            $model->$modelName = $newfileAll[$key];
//                            $modelQuery->update([$modelName => $newfileAll[$key]]);

                        }
                    } catch (\Exception $e) {
                        Log::info($e->getMessage());
                    }

                }
            }
        }
        return $arr;
    }

    function updateImageForMoreUploads($request, $path, $requestNames, $names, $modelQuery, $modelNames, $model)
    {
        $newfileAll = [];
//        $model = $modelRow->first();

        foreach ($requestNames as $key => $val) {
            if (isset($requestNames[$key])) {
                $new = $names[$key];
                /**************show error *******/
                $file = $request->file($new);

//                    if ($file && !$file->isValid()) {
//                        Log::info();
//                        dd($file->getError(), $file->getErrorMessage());
//                    }
//                if (   !isset($file) ||   !$file->isValid()) {
//                    continue; // skip instead of crashing
//                }

                /**************show error *******/


                if (isset($file) && $request->file($new) != null) {

                    try {

                        $file = $request->file($new);
                        $newfile = time() . $key . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path() . $path, $newfile);
                        $newfileAll[$key] = $path . $newfile;


                        if (isset($modelNames[$key]) && $newfileAll[$key]) {
                            $modelName = $modelNames[$key];
                            if ($model->$modelName && !(is_dir(public_path() . ($model->$modelName))) && file_exists(public_path() . ($model->$modelName))) {
                                unlink(public_path() . ($model->$modelName));
                            }

                            $model->$modelName = $newfileAll[$key];
                            $modelQuery->update([$modelName => $newfileAll[$key]]);

                        }


                    } catch (\Exception $e) {
                        Log::info($e->getMessage());
                    }

                }
            }
        }
        return $newfileAll;
    }


}

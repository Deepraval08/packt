<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ImageTrait {

    public function imageUpload(Request $request){
        if($request->hasFile('image')){
            $upload_path = public_path('images');
            $image = $request->file('image');
            $file_name = time() . '.' .  $image->getClientOriginalExtension();
            $image->move($upload_path, $file_name);
            return $file_name;
        }
    }
}
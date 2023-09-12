<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request){

        $image = $request->file('file');

        $imageName = Str::uuid() .".".$image->extension();

        $serverImage = Image::make($image);
        $serverImage->fit(1000, 1000);

        $path = public_path('uploads').'/'.$imageName;
        $serverImage->save($path);
        
        return response()->json(['image' => $imageName]);
    }
}

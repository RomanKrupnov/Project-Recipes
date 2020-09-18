<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class FileUploadController extends Controller
{
    public function index() {
        //
    }

    public function uploadFile(Request $request) {

        $path = Config::get('images.images_path.recipes');
        $file = $request->file('image')->store($path);

        return response()->json([
            'url' => url($file),
        ], 201);
    }
}

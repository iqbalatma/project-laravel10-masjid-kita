<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Util\UrlEncoder;

class ImageController extends Controller
{
    public function __invoke(string $filename)
    {
        $filename = str_ireplace("_", "/", $filename);
        $filePath = Storage::path($filename);
        return response()->file($filePath);
    }
}

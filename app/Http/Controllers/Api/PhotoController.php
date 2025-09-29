<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller {
    public function upload(Request $request, $userId)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $path = $request->file('photo')->store('photos', 'public');

        $photo = Photo::create([
            'user_id' => $userId,
            'path' => $path
        ]);

        return response()->json([
            'url' => url(Storage::url($path)),
            'photo' => $photo
        ]);
    }
}

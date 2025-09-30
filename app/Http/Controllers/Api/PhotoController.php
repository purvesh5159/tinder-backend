<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller {

    /**
     * @OA\Post(
     *     path="/api/users/{id}/photo",
     *     tags={"Photos"},
     *     summary="Upload a profile photo for a user",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1),
     *         description="User ID"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="photo",
     *                     type="string",
     *                     format="binary",
     *                     description="Photo file"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(response=200, description="Photo uploaded successfully"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
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

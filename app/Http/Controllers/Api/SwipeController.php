<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Swipe;
use App\Models\User;
use Illuminate\Http\Request;

class SwipeController extends Controller
{
    // POST /api/people/{id}/like
    /**
     * @OA\Post(
     *     path="/api/people/{id}/like",
     *     tags={"Swipes"},
     *     summary="Like a person",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=2),
     *         description="Target user ID"
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer", example=1, description="Who is liking")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Like registered successfully"),
     *     @OA\Response(response=400, description="Invalid request"),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    public function like($id, Request $request)
    {
        $userId = (int) $request->input('user_id', 1); // default to 1 if not sent

        if ($userId === (int)$id) {
            return response()->json(['message' => 'Cannot swipe yourself'], 400);
        }

        if (!User::find($userId) || !User::find($id)) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $swipe = Swipe::updateOrCreate(
            ['user_id' => $userId, 'target_user_id' => $id],
            ['type' => 'like']
        );

        return response()->json(['ok' => true, 'swipe' => $swipe]);
    }

    // POST /api/people/{id}/dislike
    /**
     * @OA\Post(
     *     path="/api/people/{id}/dislike",
     *     tags={"Swipes"},
     *     summary="Dislike a person",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=2),
     *         description="Target user ID"
     *     ),
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer", example=1, description="Who is disliking")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Dislike registered successfully"),
     *     @OA\Response(response=400, description="Invalid request"),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    public function dislike($id, Request $request)
    {
        $userId = (int) $request->input('user_id', 1);

        if ($userId === (int)$id) {
            return response()->json(['message' => 'Cannot swipe yourself'], 400);
        }

        if (!User::find($userId) || !User::find($id)) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $swipe = Swipe::updateOrCreate(
            ['user_id' => $userId, 'target_user_id' => $id],
            ['type' => 'dislike']
        );

        return response()->json(['ok' => true, 'swipe' => $swipe]);
    }

    // GET /api/people/liked?user_id=1
    /**
     * @OA\Get(
     *     path="/api/people/liked",
     *     tags={"Swipes"},
     *     summary="Get the list of people liked by a user",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="integer", example=1),
     *         description="User who liked others"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of liked people with photos"
     *     ),
     *     @OA\Response(response=404, description="User not found")
     * )
     */
    public function likedList(Request $request)
    {
        $userId = (int) $request->query('user_id', 1);

        if (!User::find($userId)) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $likedIds = Swipe::where('user_id', $userId)
                          ->where('type', 'like')
                          ->pluck('target_user_id');

        $people = User::with('photos')->whereIn('id', $likedIds)->paginate(20);

        return response()->json($people);
    }
}

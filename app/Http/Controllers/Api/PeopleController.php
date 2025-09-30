<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PeopleController extends Controller {
    // list all people
    /**
     * @OA\Get(
     *     path="/api/people",
     *     tags={"People"},
     *     summary="List all people",
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="integer", example=10),
     *         description="Number of people per page"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paginated list of people with photos"
     *     )
     * )
     */
    public function index(Request $request) {
        return User::with('photos')->paginate(10);
    }

    // create new person
    /**
     * @OA\Post(
     *     path="/api/people",
     *     tags={"People"},
     *     summary="Create a new person",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","age"},
     *             @OA\Property(property="name", type="string", example="Alice"),
     *             @OA\Property(property="age", type="integer", example=25),
     *             @OA\Property(property="latitude", type="number", format="float", example=28.61),
     *             @OA\Property(property="longitude", type="number", format="float", example=77.20)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Person created successfully")
     * )
     */
    public function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string',
            'age'  => 'required|integer',
            'latitude'  => 'nullable|numeric',
            'longitude' => 'nullable|numeric'
        ]);
        return User::create($data);
    }
}


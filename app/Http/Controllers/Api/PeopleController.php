<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PeopleController extends Controller {
    // list all people
    public function index(Request $request) {
        return User::with('photos')->paginate(10);
    }

    // create new person
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


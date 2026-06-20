<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PositionResource;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => PositionResource::collection(
                Position::latest()->paginate(10)
            )
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'code' => 'required|max:20|unique:positions',
            'description' => 'nullable'
        ]);

        $position = Position::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Position created successfully',
            'data' => new PositionResource($position)
        ], 201);
    }

    public function show(Position $position)
    {
        return response()->json([
            'success' => true,
            'data' => new PositionResource($position)
        ]);
    }

    public function update(Request $request, Position $position)
    {
        $position->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Position updated successfully',
            'data' => new PositionResource($position)
        ]);
    }

    public function destroy(Position $position)
    {
        $position->delete();

        return response()->json([
            'success' => true,
            'message' => 'Position deleted successfully'
        ]);
    }
}

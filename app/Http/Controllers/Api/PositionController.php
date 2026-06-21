<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PositionResource;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;

class PositionController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $positions = Position::latest()->paginate(10);

        return $this->successResponse(
            'Position list retrieved successfully',
            PositionResource::collection($positions),
            200,
            [
                'current_page' => $positions->currentPage(),
                'last_page' => $positions->lastPage(),
                'per_page' => $positions->perPage(),
                'total' => $positions->total(),
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'code' => 'required|max:20|unique:positions',
            'description' => 'nullable'
        ]);

        $position = Position::create(
            $request->all()
        );

        return $this->successResponse(
            'Position created successfully',
            new PositionResource($position),
            201
        );
    }

    public function show(Position $position)
    {
        return $this->successResponse(
            'Position detail retrieved successfully',
            new PositionResource($position)
        );
    }

    public function update(
        Request $request,
        Position $position
    ) {
        $request->validate([
            'name' => 'required|max:100',
            'code' => 'required|max:20|unique:positions,code,' . $position->id,
            'description' => 'nullable'
        ]);

        $position->update(
            $request->all()
        );

        return $this->successResponse(
            'Position updated successfully',
            new PositionResource($position)
        );
    }

    public function destroy(Position $position)
    {
        $position->delete();

        return $this->successResponse(
            'Position deleted successfully'
        );
    }
}

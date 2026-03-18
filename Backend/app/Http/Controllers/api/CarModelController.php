<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Accessories;
use App\Models\CarModels;
use App\Http\Requests\StoreCarModelsRequest;
use App\Http\Requests\UpdateCarModelsRequest;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $models = CarModels::all();
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'List all vehicles',
            'data' => [
                $models
            ],
            'count' => $models->count()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarModelsRequest $request)
    {
        try {
            $model = CarModels::create($request->validated());
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Car model created successfully',
            'data' => [
                $model
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarModels $model)
    {
        try {
            $model->load(['carSpecs', 'accessories', 'colorOptions', 'interiorOptions', 'wheelOptions']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => "Vehicle data",
            'data' => [
                'model_info' => $model->makeHidden(['carSpecs', 'accessories', 'colorOptions', 'interiorOptions', 'wheelOptions']),
                'specs' => $model->carSpecs,
                'options' => [
                    'accessories'      => $model->accessories,
                    'colors'           => $model->colorOptions,
                    'interior_options' => $model->interiorOptions,
                    'wheels'           => $model->wheelOptions,
                ]
            ],
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarModelsRequest $request, CarModels $model)
    {
        try {
            $model = CarModels::update($request->validated());
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Vehicle updated successfully',
            'data' => [
                $model
            ]
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModels $model)
    {
        try {
            $model->delete();
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Vehicle deleted successfully',
        ], 204);
    }
}

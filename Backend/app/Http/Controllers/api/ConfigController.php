<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Configs;
use App\Http\Requests\StoreConfigsRequest;
use App\Http\Requests\UpdateConfigsRequest;
use Illuminate\Support\Facades\Auth;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $configs = Configs::all();
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'List all Configs',
            'data' => [
                $configs
            ],
            'count' => $configs->count()
        ], 200);
    }

    public function myConfigs()
    {
        try {
            $config = Auth::user()->configs()
                ->with(['carModel', 'colorOption', 'wheelOption', 'interiorOptions', 'accessories'])
                ->get();

            return response()->json([
                'success' => true,
                'message' => 'Your configs retrieved successfully',
                'data' => $config,
                'count' => $config->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConfigsRequest $request)
    {
        try {
            $data = $request->validated();
            unset($data['total_price']);
            $config = Configs::create($data);

            if ($request->has('interior_option_ids')) {
                $config->interiorOptions()->sync($request->interior_option_ids);
            }

            if ($request->has('accessory_ids')) {
                $config->accessories()->sync($request->accessory_ids);
            }

            $config->total_price = $config->calculateTotalPrice();
            $config->save();

            $config->load(['interiorOptions', 'accessories']);
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Config created successfully',
            'data' => $config
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Configs $config)
    {
        return response()->json([
            'success' => true,
            'message' => "Config data",
            'data' => [
                $config
            ],
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateConfigsRequest $request, Configs $config)
    {
        try {
            $data = $request->validated();
            unset($data['total_price']);
            $config->update($data);

            if ($request->has('interior_option_ids')) {
                $config->interiorOptions()->sync($request->interior_option_ids);
            }

            if ($request->has('accessory_ids')) {
                $config->accessories()->sync($request->accessory_ids);
            }

            $config->total_price = $config->calculateTotalPrice();
            $config->save();

            $config->load(['interiorOptions', 'accessories']);
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Config updated successfully',
            'data' => [
                $config
            ]
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Configs $config)
    {
        try {
            $config->delete();
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Config deleted successfully',
        ], 204);
    }
}

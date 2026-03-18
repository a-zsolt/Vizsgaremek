<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $orders = Orders::all();
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'List all orders',
            'data' => [
                $orders
            ],
            'count' => $orders->count()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrdersRequest $request)
    {
        try {
            $order = Orders::create($request->validated());
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Order created successfully',
            'data' => [
                $order
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Orders $order)
    {
        return response()->json([
            'success' => true,
            'message' => "Order data",
            'data' => [
                $order
            ],
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrdersRequest $request, Orders $order)
    {
        try {
            $order = Orders::update($request->validated());
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Order updated successfully',
            'data' => [
                $order
            ]
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $order)
    {
        try{
            $order->delete();
        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully',
        ], 204);
    }
}

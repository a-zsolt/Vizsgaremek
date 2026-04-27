<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Models\Configs;
use App\Http\Requests\StoreOrdersRequest;
use App\Http\Requests\UpdateOrdersRequest;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->tokenCan('manager')) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized. Manager access required.',
            ], 403);
        }

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
     * Display a listing of the authenticated user's orders.
     */
    public function myOrders()
    {
        try {
            $orders = Auth::user()->orders()->with([
                'config',
                'config.carModel',
                'config.colorOption',
                'config.interiorOptions',
                'config.wheelOption',
                'config.accessories',
            ])->get();

            return response()->json([
                'success' => true,
                'message' => 'Your orders retrieved successfully',
                'data' => $orders,
                'count' => $orders->count()
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrdersRequest $request)
    {
        try {
            $data = $request->validated();
            unset($data['total_price']);

            $config = Configs::findOrFail($data['config_id']);
            $total = (int) $config->calculateTotalPrice();

            $order = new Orders($data);
            $order->total_price = $total;
            $order->save();
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
        $order->load([
            'config',
            'config.carModel',
            'config.colorOption',
            'config.interiorOptions',
            'config.wheelOption',
            'config.accessories',
        ]);

        return response()->json([
            'success' => true,
            'message' => "Order data",
            'data' => $order,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrdersRequest $request, Orders $order)
    {
        try {
            $data = $request->validated();
            unset($data['total_price']);

            if (array_key_exists('config_id', $data)) {
                $config = Configs::findOrFail($data['config_id']);
                $order->total_price = (int) $config->calculateTotalPrice();
            }

            $order->fill($data);
            $order->save();
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

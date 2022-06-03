<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return OrderResource::collection($orders);
    }

    public function store()
    {
        $order = Order::create([
            'user_id' => 1,        //TODO: replaece with this auth()->user()->id;
            'status' => 'pending',
        ]);
        return (new OrderResource($order))->response()->setStatusCode(201);
    }

    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return new OrderResource($order);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }

    public function addProduct(Request $request, Order $order)
    {
        $order->products()->syncWithPivotValues($request->product_id, [
            'quantity' => $request->amount
        ], false);
        return new OrderResource($order);
    }

    public function removeProduct(Request $request, Order $order)
    {
        $order->products()->detach($request->product_id);
        return new OrderResource($order);
    }

    public function updateProduct(Request $request, Order $order)
    {
        $order->products()->updateExistingPivot($request->product_id, [
            'quantity' => $request->amount
        ]);
        return new OrderResource($order);
    }
}

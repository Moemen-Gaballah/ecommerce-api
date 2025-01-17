<?php

namespace App\Http\Controllers\Api;

use App\Events\OrderCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Orders\StoreOrderRequest;
use App\Http\Resources\Orders\OrderResource;
use App\Models\Order;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        try {
            DB::beginTransaction();

            $order = Order::create(['user_id' => $request->user()->id]);

            foreach ($request->products as $product) {
                $productModel = Product::find($product['id']);
                if ($productModel->quantity < $product['quantity']) {
                    return $this->errorResponse('Insufficient quantity', 400);
                }
                $productModel->decrement('quantity', $product['quantity']);
                $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
            }

            OrderCreated::dispatch($order);

            DB::commit();

        } catch (\Exception $e) {

            // An error occured; cancel the transaction...
            DB::rollback();

            //Todo create custom Exception and throw the error.
            return $this->errorResponse("Something wrong happened", 500);
        }

        return $this->successResponse($order, "Order Created Successfully",201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::where('user_id', auth()->id())->with('products')->findOrFail($id);

        return $this->successResponse(new OrderResource($order));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

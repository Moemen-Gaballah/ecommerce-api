<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomPaginationMobileResource;
use App\Http\Resources\Products\ListingProductResource;
use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    { // TODO set request Validation for products
        $cacheKey = $this->generateCacheKeyForProduct($request);
        $cacheDuration = now()->addMinutes(30); // Cache for 30 minutes

        $products = Cache::remember($cacheKey, $cacheDuration, function () use ($request) {
            $query = Product::query();

            // TODO refactor it to become more clean and flexible (QueryFilters Class)
            if($search = $request->get('search')) {
                $query->where('name', 'like', '%' . $search . '%');
            }

            if ($request->has('price_min')) {
                $query->where('price', '>=', $request->price_min);
            }

            if ($request->has('price_max')) {
                $query->where('price', '<=', $request->price_max);
            }


            return $query->paginate(10); // TODO client send it and add validation for max
        });

        return $this->successResponse(new CustomPaginationMobileResource($products, ListingProductResource::collection($products)));
    }

    public function generateCacheKeyForProduct($request){ // TODO Remove after add QueryFilters Class
        $page = $request->get('page', 1);
        $filterData = [];

        if ($request->get('search')) {
            $filterData['search'] = $request->get('search');
        }

        if ($request->has('price_min')) {
            $filterData['price_min'] = $request->get('price_min');
        }

        if ($request->has('price_max')) {
            $filterData['price_max'] = $request->get('price_max');
        }

        return 'products_' . md5(json_encode($filterData) . "_page_{$page}");
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

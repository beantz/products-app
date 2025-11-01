<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        return $this->productService = $productService;
    }

    public function index() {
        
        return response()->json($this->productService->getAll());

    }

    public function store(CreateProductRequest $request) {
        
        return response()->json($this->productService->create($request));

    }

    public function show($id) {

        return response()->json($this->productService->find($id));

    }

    public function update(Request $request, $id) {
        
        return response()->json($this->productService->update($request, $id));

    }

    public function destroy($id) {
        
        return response()->json($this->productService->delete($id));

    }
}

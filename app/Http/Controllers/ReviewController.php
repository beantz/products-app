<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index() {
        try {
            $products = Product::has('review')->with('review')->get();

            if($products->count() > 0) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Todos os produtos com reviews',
                    'data' => $products
                ], 200);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Sem reviews cadastrados'
            ], 200);
            
        } catch (\Exception $e) {
            
            return response()->json([
                'message' => 'Falha ao listar produtos com reviews', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request, $id_product) {
        try {
            $product = Product::findOrFail($id_product);

            $product->review()->create($request->only(['product_id', 'rating']));

            return response()->json([
                'status' => 'success',
                'message' => 'Review de produto inserido com sucesso',
                'data' => $product->review
            ], 201);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'message' => "Falha ao procurar produto de id: $id_product", 
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function destroy($id_product) {
        try {
            $product = Product::findOrFail($id_product);

            if(!$product->review()->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Produto não possui reviews inseridas',
                    'data' => $product
                ], 404);
            }

            $product->review()->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Review de produto deletado com sucesso',
            ], 200);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'message' => "Falha ao procurar produto de id: $id_product", 
                'error' => $e->getMessage()
            ], 404);
        }
    }
}
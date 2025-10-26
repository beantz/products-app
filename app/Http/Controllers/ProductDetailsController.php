<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function index() {
        try {
            $products = Product::has('details')->with('details')->get();

            if($products->count() > 0) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Todos os produtos com detalhes cadastrados',
                    'data' => $products
                ], 200);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Sem detalhes cadastrados'
            ], 200);
            
        } catch (\Exception $e) {
            
            return response()->json([
                'message' => 'Falha ao listar produtos com detalhes', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request, $id_product) {
        try {
            $product = Product::findOrFail($id_product);

            if($product->details()->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Já existe um detalhe inserido nesse produto',
                    'data' => $product->details
                ], 422);
            }

            $product->details()->create($request->only(['ingredients', 'date_manuf', 'date_val']));

            return response()->json([
                'status' => 'success',
                'message' => 'Detalhes de produto inserido com sucesso',
                'data' => $product->details
            ], 201);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'message' => "Falha ao procurar produto de id: $id_product", 
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function show($id_product) {
        try {
            $product = Product::findOrFail($id_product);

            if(!$product->details()->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Produto não possui detalhe inserido',
                    'data' => $product
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Detalhes de produto encontrado com sucesso',
                'data' => $product->details
            ], 200);
            
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

            if(!$product->details()->exists()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Produto não possui detalhe inserido',
                    'data' => $product
                ], 404);
            }

            $product->details()->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Detalhes de produto deletado com sucesso',
            ], 200);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'message' => "Falha ao procurar produto de id: $id_product", 
                'error' => $e->getMessage()
            ], 404);
        }
    }
}

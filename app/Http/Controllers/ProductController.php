<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        try {
            $products = Product::all();

            if($products->count() > 0) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Todos os produtos cadastrados',
                    'data' => $products
                ], 200);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Sem produtos cadastrados'
            ], 404);
            
        } catch (\Exception $e) {
            
            return response()->json([
                'message' => 'Falha ao listar produtos', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request) {
        try {
            $product = Product::create($request->all());

            if($product->count() > 0) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Produto cadastrado com sucesso',
                    'data' => $product
                ], 201);
            }
            
        } catch (\Exception $e) {
            
            return response()->json([
                'message' => 'Falha ao cadastrar produtos', 
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id) {
        try {
            $product = Product::findOrFail($id);

            if($product->count() > 0) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Produto encontrado com sucesso',
                    'data' => $product
                ], 200);
            }
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'message' => "Falha ao procurar produto de id: $id", 
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id) {
        try {
            $product = Product::findOrFail($id);

            $product->update($request->all());

            if($product->wasChanged()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Produto atualizado com sucesso',
                    'data' => $product
                ], 200);
            }

            return response()->json([
                'status' => 'info',
                'message' => 'Os dados fornecidos já são os atuais',
                'data' => $product
            ], 200);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'message' => "Falha ao procurar produto de id: $id", 
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function destroy($id) {
        try {
            $product = Product::findOrFail($id);

            $wasDeleted = $product->delete();

            if($wasDeleted) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Produto deletado com sucesso'
                ], 200);
            }

            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao deletar produto',
                'data' => $product
            ], 500);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return response()->json([
                'message' => "Falha ao procurar produto de id: $id", 
                'error' => $e->getMessage()
            ], 404);
        }
    }
}

<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductService {

    public function getAll() {

        try {
            $products = Product::all();

            if($products->count() > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Todos os produtos cadastrados',
                    'data' => $products
                ];
            }

            return [
                'status' => 'error',
                'message' => 'Sem produtos cadastrados'
            ];
            
        } catch (\Exception $e) {
            
            return [
                'status' => 'error', 
                'message' => 'Falha ao listar produtos', 
                'error' => $e->getMessage()
            ];

            
        }

    }

    public function create(Request $request) {

        try {
            $product = Product::create($request->all());

            if($product->count() > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Produto cadastrado com sucesso',
                    'data' => $product->toArray()
                ];
            }
            
        } catch (\Exception $e) {
            
            return [
                'status' => 'error',
                'message' => 'Falha ao cadastrar produto', 
                'error' => $e->getMessage()
            ];
        }

    }

    public function find($id) {

        try {
            $product = Product::findOrFail($id);

            if($product->count() > 0) {
                return [
                    'status' => 'success',
                    'message' => 'Produto encontrado com sucesso',
                    'data' => $product
                ];
            }
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return [
                'status' => 'error',
                'message' => "Falha ao procurar produto de id: $id", 
                'error' => $e->getMessage()
            ];
        }

    }

    public function update($request, $id) {

        try {
            $product = Product::findOrFail($id);

            $product->update($request->all());

            if($product->wasChanged()) {
                return [
                    'status' => 'success',
                    'message' => 'Produto atualizado com sucesso',
                    'data' => $product
                ];
            }

            return [
                'status' => 'info',
                'message' => 'Os dados fornecidos já são os atuais',
                'data' => $product
            ];
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            
            return [
                'message' => "Falha ao procurar produto de id: $id", 
                'error' => $e->getMessage()
            ];
        }

    }

    public function delete($id) {
        
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
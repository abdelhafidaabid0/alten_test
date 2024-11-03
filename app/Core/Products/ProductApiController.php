<?php

namespace App\Core\Products;

use App\Base\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ProductApiController extends BaseController {
    /**
     * Récupérer tous les produits.
     */
    public function index() : AnonymousResourceCollection {
        return ProductResource::collection(ProductService::get_products_list());
    }



    /**
     * Récupérer les détails d'un produit spécifique.
     */
    public function show($id) : JsonResponse|ProductResource {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produit non trouvé'], Response::HTTP_NOT_FOUND);
        }

        return new ProductResource($product);
    }



    /**
     * Créer un nouveau produit.
     */
    public function store(StoreProductRequest $request) : JsonResponse {
        $product = Product::create($request->validated());

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED)
            ->header('message', 'Produit créé avec succès');
    }



    /**
     * Mettre à jour les détails d'un produit spécifique.
     */
    public function update(UpdateProductRequest $request, $id) : JsonResponse {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produit non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validated();

        $product->update($validatedData);

        return (new ProductResource($product))
            ->response()
            ->setStatusCode(Response::HTTP_OK)
            ->header('message', 'Produit mis à jour avec succès');
    }



    /**
     * Supprimer un produit spécifique.
     */
    public function destroy($id) : JsonResponse {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Produit non trouvé'], Response::HTTP_NOT_FOUND);
        }

        $product->delete();

        return response()->json(['message' => 'Produit supprimé avec succès'], Response::HTTP_NO_CONTENT);
    }
}
<?php

namespace App\Core\Products;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProductService {
    // Définition des constantes pour le statut d'inventaire
    const INVENTORY_STATUS_INSTOCK    = 'INSTOCK';
    const INVENTORY_STATUS_LOWSTOCK   = 'LOWSTOCK';
    const INVENTORY_STATUS_OUTOFSTOCK = 'OUTOFSTOCK';
    const INVENTORY_STATUS            = [
        self::INVENTORY_STATUS_INSTOCK,
        self::INVENTORY_STATUS_LOWSTOCK,
        self::INVENTORY_STATUS_OUTOFSTOCK,
    ];

    const INVENTORY_STATUS_LABELS = [
        self::INVENTORY_STATUS_INSTOCK    => "En stock",
        self::INVENTORY_STATUS_LOWSTOCK   => "Stock faible",
        self::INVENTORY_STATUS_OUTOFSTOCK => "Stock indisponible",
    ];

    const PRODUCT_WATCHS    = "watch";
    const PRODUCT_FURNITURE = "furniture";
    const PRODUCT_SHOE      = "shoe";

    const PRODUCT_CATEGORIES = [
        self::PRODUCT_WATCHS,
        self::PRODUCT_FURNITURE,
        self::PRODUCT_SHOE,
    ];

    const PRODUCT_CATEGORIES_LABELS = [
        self::PRODUCT_WATCHS    => "Montres",
        self::PRODUCT_FURNITURE => "Fournitures",
        self::PRODUCT_SHOE      => "Chaussures",
    ];



    public static function get_products_list() : LengthAwarePaginator {
        // Initialise la requête de produit
        $query = Product::query();

        $filtre_statut     = request("statut", session('product_filters.statut'));
        $filtre_category   = request("category", session('product_filters.category'));
        $filtre_min_rating = request("min_rating", session('product_filters.min_rating'));
        $filtre_min_price  = request("min_price", session('product_filters.min_price'));
        $filtre_max_price  = request("max_price", session('product_filters.max_price'));

        // Applique le filtre de statut si fourni
        if ($filtre_statut) {
            $query->where('inventory_status', $filtre_statut);
        }

        // Applique le filtre de catégorie si fourni
        if ($filtre_category) {
            $query->where('category', $filtre_category);
        }

        // Applique le filtre d'évaluation minimale si fourni
        if ($filtre_min_rating) {
            $query->where('rating', '>=', $filtre_min_rating);
        }

        // Applique le filtre de prix minimum et maximum si fourni
        if ($filtre_min_price) {
            $query->where('price', '>=', $filtre_min_price);
        }

        if ($filtre_max_price) {
            $query->where('price', '<=', $filtre_max_price);
        }


        $per_page = session('product_filters.per_page', request("per_page", 10));

        session(['product_filters.statut' => $filtre_statut]);
        session(['product_filters.category' => $filtre_category]);
        session(['product_filters.min_rating' => $filtre_min_rating]);
        session(['product_filters.min_price' => $filtre_min_price]);
        session(['product_filters.max_price' => $filtre_max_price]);
        session(['product_filters.per_page' => $per_page]);

        // Récupère les produits filtrés avec pagination
        $products = $query->paginate($per_page);

        return $products;
    }



    /**
     * Méthode statique pour calculer la somme totale des produits sélectionnés avec des quantités spécifiques
     *
     * @param Collection $products
     * @param array $quantities Array d'ID de produit comme clé et quantité comme valeur
     * @return float
     */
    public static function get_total_prix(Collection $products, array $quantities = []) : float {
        // Calculer la somme totale en utilisant les quantités spécifiques fournies
        $totalSum = $products->reduce(function ($sum, $product) use ($quantities) {
            // Utiliser la quantité fournie dans l'array $quantities pour chaque produit, ou fallback à 1
            $quantity = $quantities[$product->id] ?? 1;

            return $sum + ($product->price * $quantity);
        }, 0);

        return round($totalSum, 2); // Retourner le total arrondi à deux décimales
    }



    public static function get_products_status_pour_select() : array {
        $list = [];

        foreach (self::INVENTORY_STATUS as $status) {
            $list[$status] = self::INVENTORY_STATUS_LABELS[$status];
        }

        return $list;
    }



    public static function get_products_categories_pour_select() : array {
        $list = [];

        foreach (self::PRODUCT_CATEGORIES as $categorie) {
            $list[$categorie] = self::PRODUCT_CATEGORIES_LABELS[$categorie];
        }

        return $list;
    }



    public static function get_products_ratings_pour_select() : array {
        $list = [];

        for ($i = 1; $i < 5; $i++) {
            if ($i === 1) {
                $list[$i] = "$i étoile et plus";
                continue;
            }
            $list[$i] = "$i étoiles et plus";
        }

        return $list;
    }

}
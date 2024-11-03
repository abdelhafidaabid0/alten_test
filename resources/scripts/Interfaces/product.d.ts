import {CartItem} from "./cart";

export type InventoryStatus = 'INSTOCK' | 'LOWSTOCK' | 'OUTOFSTOCK';

export interface Product extends CartItem {
    id: number;                      // ID unique du produit
    code: string;                    // Code du produit (référence unique)
    name: string;                    // Nom du produit
    description: string;             // Description du produit
    image: string;                   // URL de l'image du produit
    category: string;                // Catégorie à laquelle le produit appartient
    price: number;                   // Prix du produit
    quantity: number;                // Quantité disponible en stock
    internal_reference: string;      // Référence interne (utilisée pour l'inventaire)
    shelld_id: number;               // Identifiant de l'étagère (emplacement dans l'entrepôt)
    inventory_status: InventoryStatus; // Statut de l'inventaire
    rating: number;                  // Note moyenne du produit
    created_at: string;              // Date de création du produit (format ISO)
    updated_at: string;              // Date de dernière mise à jour du produit (format ISO)
}

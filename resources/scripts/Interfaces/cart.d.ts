import {Product} from "./product";

export interface CartItem {
    id: number;
    name: string;
    price: number;
    quantity: number;
    image: string;
}

export interface Cart {
    products: Product[];
    nombre?: number;
    total_prix?: number;
}
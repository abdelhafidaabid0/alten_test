import {Product} from "./product";

export interface CartItem {
    id: number;
    name: string;
    price: number;
    quantity: number;
    image: string;
}

export interface Cart {
    products?: Product[];
    quantities?: any;
    total_quantities?: number;
    total_price?: number;
}
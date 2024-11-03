export interface PaginatorLinkInterface {
    url: string | null;
    label: string;
    active: boolean;
}

export interface PaginatorInterface<T = any> {
    data: T[];
    first_page_url: string;
    last_page_url: string;
    prev_page_url: string | null;
    next_page_url: string | null;
    per_page: number;
    path: string;
    total: number;
    last_page: number;
    current_page: number;
    from: number | null;
    to: number | null;
    links: Array<PaginatorLinkInterface>;
    choix_per_page: Array<number>;
    selected_items_count?: number;
}
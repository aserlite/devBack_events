export interface EventModel {
    id: number;
    title: string;
    description: string;
    start_date: string;
    end_date: string;
    location: string;
    capacity: number;
    price: number;
    created_at: string;
    updated_at: string;
}

export interface CategoryModel {
    id: number;
    name: string;
    created_at: string;
    updated_at: string;
    events_count: number;
}

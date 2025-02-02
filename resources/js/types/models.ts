export interface Pizza {
    id: string;
    name: string;
    slug: string;
    description: string;
    brand: Brand;
    style: Style;
    categories: Category[];
    ingredients: string[];
    nutritional_info: {
        calories: number;
        protein: number;
        carbs: number;
        fat: number;
    };
    average_rating: number;
    total_reviews: number;
    tags: string[];
    image_url?: string;
    reviews?: Review[];
}

export interface Brand {
    id: string;
    name: string;
    slug: string;
    description: string;
    website?: string;
}

export interface Style {
    id: string;
    name: string;
    slug: string;
    description: string;
}

export interface Category {
    id: string;
    name: string;
    slug: string;
    description: string;
}

export interface Review {
    id: string;
    pizza_id: string;
    user_id: string;
    rating: number;
    review: string;
    purchase_location: string;
    purchase_date: string;
    created_at: string;
    updated_at: string;
    user: User;
}

export interface User {
    id: string;
    name: string;
    email: string;
}

export interface FAQItem {
    question: string;
    answer: string;
}

export interface Message {
    id: string;
    message: string;
    from_user_id: string;
    to_user_id: string;
    created_at: string;
    read_at: string | null;
    from_user: User;
    to_user: User;
}

export interface BlogPost {
    id: string;
    title: string;
    slug: string;
    content: string;
    description: string;
    featured_image?: string;
    tags: string[];
    published_at: string;
    created_at: string;
    updated_at: string;
    author: User;
} 
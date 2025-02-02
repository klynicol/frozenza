import type { Pizza, User } from './models';

export interface MetaProps {
    title: string;
    description: string;
}

export interface PageProps {
    meta: MetaProps;
    auth: {
        user: User | null;
    };
}

export interface PizzaListProps extends PageProps {
    pizzas: Pizza[];
} 
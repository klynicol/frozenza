import React from 'react';
import PizzaListItem from '@/Components/Common/PizzaListItem';
import MixInCard from '@/Components/Common/MixInCard';

const PROMO_SLOT_INDEX = 4; // right-most cell of first row in a 5-wide grid

/**
 * Builds grid items for a 5-wide layout with one promo card in the right-most cell of the first row.
 * @param {Array} pizzaList - Array of pizza objects
 * @param {Object} promo - { href, title, description?, ctaText? }
 * @returns {Array} Items to render (pizza objects or { type: 'promo', ... })
 */
export function buildGridItems(pizzaList, promo) {
    if (!Array.isArray(pizzaList) || pizzaList.length === 0) {
        return promo ? [{ type: 'promo', key: 'promo', ...promo }] : [];
    }
    const items = [];
    for (let i = 0; i < pizzaList.length; i++) {
        if (promo && i === PROMO_SLOT_INDEX) {
            items.push({ type: 'promo', key: 'promo', ...promo });
        }
        items.push(pizzaList[i]);
    }
    if (promo && pizzaList.length <= PROMO_SLOT_INDEX) {
        items.push({ type: 'promo', key: 'promo', ...promo });
    }
    return items;
}

const DEFAULT_PROMO = {
    href: '/lowest-calorie-frozen-pizza',
    title: 'Lowest Calorie Frozen Pizza',
    description: 'See our top picks ranked by calories per serving, with full nutrition facts.',
    ctaText: 'See top picks',
};

export default function PizzaGridWithPromo({ pizzas, promo = DEFAULT_PROMO, className = '' }) {
    const list = Array.isArray(pizzas) ? pizzas : (pizzas?.data ?? []);
    const items = buildGridItems(list, promo);

    return (
        <div className={`grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6 ${className}`}>
            {items.map((item, index) =>
                item.type === 'promo' ? (
                    <MixInCard key={item.key} href={item.href} title={item.title} description={item.description} ctaText={item.ctaText} />
                ) : (
                    <PizzaListItem key={item.id} pizza={item} />
                )
            )}
        </div>
    );
}

<?php

namespace App\Enums;

/**
 * The types of images that can be attached to a pizza
 * This should be kept in sync with the types in the pizza_images.type column
 */
enum PizzaImageType: string
{
    case MAIN = 'main';
    case BACK = 'back';
    case OTHER = 'other';
    case NUTRITION = 'nutrition';
    case INGREDIENTS = 'ingredients';
    case COOKED = 'cooked';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
} 
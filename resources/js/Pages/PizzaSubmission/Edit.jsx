import React, { useState, useMemo } from 'react';
import { Head, useForm, Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';

const MAX_IMAGE_SIZE_MB = 100;
const MAX_IMAGE_SIZE_BYTES = MAX_IMAGE_SIZE_MB * 1024 * 1024;

const emptyNutrition = {
    serving_per_container: '',
    serving_fraction: '',
    serving_weight: '',
    calories: '',
    caloris_from_fat: '',
    total_fat: '',
    saturated_fat: '',
    trans_fat: '',
    cholesterol: '',
    sodium: '',
    total_carbohydrate: '',
    dietary_fiber: '',
    total_sugars: '',
    added_sugars: '',
    protein: '',
    vitamin_d: '',
    calcium: '',
    iron: '',
    potassium: '',
    monounsaturated_fat: '',
    polyunsaturated_fat: '',
    vitamin_a: '',
    vitamin_c: '',
};

function buildInitialData(pizza) {
    const n = pizza?.nutrition_fact ?? {};
    return {
        name: pizza?.name ?? '',
        description: pizza?.description ?? '',
        brand_id: pizza?.brand_id ?? pizza?.brand?.id ?? '',
        ingredients: pizza?.ingredients ?? '',
        allergens: pizza?.allergens ?? '',
        website: pizza?.website ?? '',
        tags: Array.isArray(pizza?.tags) ? pizza.tags.map((t) => t.id) : [],
        pizza_image: null,
        nutrition: {
            ...emptyNutrition,
            serving_per_container: n.serving_per_container ?? '',
            serving_fraction: n.serving_fraction ?? '',
            serving_weight: n.serving_weight ?? '',
            calories: n.calories ?? '',
            caloris_from_fat: n.caloris_from_fat ?? '',
            total_fat: n.total_fat ?? '',
            saturated_fat: n.saturated_fat ?? '',
            trans_fat: n.trans_fat ?? '',
            cholesterol: n.cholesterol ?? '',
            sodium: n.sodium ?? '',
            total_carbohydrate: n.total_carbohydrate ?? '',
            dietary_fiber: n.dietary_fiber ?? '',
            total_sugars: n.total_sugars ?? '',
            added_sugars: n.added_sugars ?? '',
            protein: n.protein ?? '',
            vitamin_d: n.vitamin_d ?? '',
            calcium: n.calcium ?? '',
            iron: n.iron ?? '',
            potassium: n.potassium ?? '',
            monounsaturated_fat: n.monounsaturated_fat ?? '',
            polyunsaturated_fat: n.polyunsaturated_fat ?? '',
            vitamin_a: n.vitamin_a ?? '',
            vitamin_c: n.vitamin_c ?? '',
        },
    };
}

export default function Edit({ pizza, brands, tags, auth, meta }) {
    const initialData = useMemo(() => buildInitialData(pizza), [pizza]);
    const [imageSizeError, setImageSizeError] = useState(null);
    const { data, setData, post, processing, errors, reset } = useForm(initialData);

    const handleSubmit = (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('name', data.name);
        formData.append('description', data.description);
        formData.append('brand_id', data.brand_id);
        formData.append('ingredients', data.ingredients);
        formData.append('allergens', data.allergens);
        formData.append('website', data.website);
        formData.append('tags', JSON.stringify(data.tags));
        formData.append('nutrition', JSON.stringify(data.nutrition));
        if (data.pizza_image) {
            formData.append('pizza_image', data.pizza_image);
        }

        post(route('pizza-submissions.update', pizza.id), {
            data: formData,
        });
    };

    const setNutrition = (field, value) => {
        setData('nutrition', { ...data.nutrition, [field]: value });
    };

    const handleTagChange = (tagId) => {
        const newTags = data.tags.includes(tagId)
            ? data.tags.filter((id) => id !== tagId)
            : [...data.tags, tagId];
        setData('tags', newTags);
    };

    const pizzaShowUrl = pizza?.brand ? `/pizzas/${pizza.brand.slug}/${pizza.slug}` : '/pizzas';

    return (
        <MainLayout meta={meta} auth={auth}>
            <Head title={`Edit Pizza: ${pizza?.name}`} />

            <div className="py-12">
                <div className="max-w-4xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">
                            <div className="flex items-center justify-between mb-6">
                                <h2 className="text-2xl font-bold text-gray-900">Edit Pizza: {pizza?.name}</h2>
                                <Link
                                    href={pizzaShowUrl}
                                    className="text-indigo-600 hover:text-indigo-800 text-sm font-medium"
                                >
                                    ← Back to pizza
                                </Link>
                            </div>

                            <form onSubmit={handleSubmit} className="space-y-6">
                                {/* Basic Information */}
                                <div className="space-y-4">
                                    <h3 className="text-lg font-semibold text-gray-700">Basic Information</h3>

                                    <div>
                                        <InputLabel htmlFor="name" value="Pizza Name *" />
                                        <TextInput
                                            id="name"
                                            type="text"
                                            className="mt-1 block w-full"
                                            value={data.name}
                                            onChange={(e) => setData('name', e.target.value)}
                                            required
                                        />
                                        <InputError message={errors.name} className="mt-2" />
                                    </div>

                                    <div>
                                        <InputLabel htmlFor="description" value="Description *" />
                                        <textarea
                                            id="description"
                                            className="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            rows="4"
                                            value={data.description}
                                            onChange={(e) => setData('description', e.target.value)}
                                            required
                                        />
                                        <InputError message={errors.description} className="mt-2" />
                                    </div>

                                    <div>
                                        <InputLabel htmlFor="brand_id" value="Brand *" />
                                        <select
                                            id="brand_id"
                                            className="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            value={data.brand_id}
                                            onChange={(e) => setData('brand_id', e.target.value)}
                                            required
                                        >
                                            <option value="">Select a brand</option>
                                            {brands.map((brand) => (
                                                <option key={brand.id} value={brand.id}>
                                                    {brand.name}
                                                </option>
                                            ))}
                                        </select>
                                        <InputError message={errors.brand_id} className="mt-2" />
                                    </div>

                                    <div>
                                        <InputLabel htmlFor="website" value="Website" />
                                        <TextInput
                                            id="website"
                                            type="url"
                                            className="mt-1 block w-full"
                                            value={data.website}
                                            onChange={(e) => setData('website', e.target.value)}
                                        />
                                        <InputError message={errors.website} className="mt-2" />
                                    </div>
                                </div>

                                {/* Ingredients */}
                                <div className="space-y-4">
                                    <h3 className="text-lg font-semibold text-gray-700">Ingredients</h3>
                                    <div>
                                        <InputLabel htmlFor="ingredients" value="Ingredients" />
                                        <textarea
                                            id="ingredients"
                                            className="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            rows="6"
                                            value={data.ingredients}
                                            onChange={(e) => setData('ingredients', e.target.value)}
                                            placeholder="e.g., Mozzarella cheese, Pepperoni, Tomato sauce"
                                        />
                                        <InputError message={errors.ingredients} className="mt-2" />
                                    </div>
                                </div>

                                {/* Allergens */}
                                <div className="space-y-4">
                                    <h3 className="text-lg font-semibold text-gray-700">Allergens</h3>
                                    <div>
                                        <InputLabel htmlFor="allergens" value="Allergen Information" />
                                        <textarea
                                            id="allergens"
                                            className="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            rows="3"
                                            value={data.allergens}
                                            onChange={(e) => setData('allergens', e.target.value)}
                                            placeholder="e.g., Contains: Milk, Wheat, Soy. May contain: Tree nuts"
                                        />
                                        <InputError message={errors.allergens} className="mt-2" />
                                    </div>
                                </div>

                                {/* Nutritional Information */}
                                <div className="space-y-4">
                                    <h3 className="text-lg font-semibold text-gray-700">Nutritional Information</h3>
                                    <p className="text-sm text-gray-500">
                                        Optional. Per serving, as shown on the package (e.g., 4 per container, 1/4
                                        pizza, 141g).
                                    </p>

                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <InputLabel htmlFor="serving_per_container" value="Serving per container" />
                                            <TextInput
                                                id="serving_per_container"
                                                type="number"
                                                min="1"
                                                className="mt-1 block w-full"
                                                value={
                                                    data.nutrition.serving_per_container === ''
                                                        ? ''
                                                        : data.nutrition.serving_per_container
                                                }
                                                onChange={(e) =>
                                                    setNutrition(
                                                        'serving_per_container',
                                                        e.target.value === '' ? '' : parseInt(e.target.value, 10) || ''
                                                    )
                                                }
                                                placeholder="e.g., 4"
                                            />
                                            <InputError message={errors['nutrition.serving_per_container']} className="mt-2" />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="serving_fraction" value="Serving fraction" />
                                            <TextInput
                                                id="serving_fraction"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.serving_fraction}
                                                onChange={(e) => setNutrition('serving_fraction', e.target.value)}
                                                placeholder="e.g., 1/4 or 1/6"
                                            />
                                            <InputError message={errors['nutrition.serving_fraction']} className="mt-2" />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="serving_weight" value="Serving weight (g)" />
                                            <TextInput
                                                id="serving_weight"
                                                type="number"
                                                min="0"
                                                className="mt-1 block w-full"
                                                value={
                                                    data.nutrition.serving_weight === '' ? '' : data.nutrition.serving_weight
                                                }
                                                onChange={(e) =>
                                                    setNutrition(
                                                        'serving_weight',
                                                        e.target.value === '' ? '' : parseInt(e.target.value, 10) ?? ''
                                                    )
                                                }
                                                placeholder="e.g., 141"
                                            />
                                            <InputError message={errors['nutrition.serving_weight']} className="mt-2" />
                                        </div>
                                    </div>

                                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                        <div>
                                            <InputLabel htmlFor="calories" value="Calories" />
                                            <TextInput
                                                id="calories"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.calories}
                                                onChange={(e) => setNutrition('calories', e.target.value)}
                                                placeholder="e.g., 340"
                                            />
                                            <InputError message={errors['nutrition.calories']} className="mt-2" />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="caloris_from_fat" value="Calories from fat (optional)" />
                                            <TextInput
                                                id="caloris_from_fat"
                                                type="number"
                                                min="0"
                                                className="mt-1 block w-full"
                                                value={
                                                    data.nutrition.caloris_from_fat === ''
                                                        ? ''
                                                        : data.nutrition.caloris_from_fat
                                                }
                                                onChange={(e) =>
                                                    setNutrition(
                                                        'caloris_from_fat',
                                                        e.target.value === '' ? '' : parseInt(e.target.value, 10) ?? ''
                                                    )
                                                }
                                                placeholder="e.g., 120"
                                            />
                                            <InputError message={errors['nutrition.caloris_from_fat']} className="mt-2" />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="total_fat" value="Total fat" />
                                            <TextInput
                                                id="total_fat"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.total_fat}
                                                onChange={(e) => setNutrition('total_fat', e.target.value)}
                                                placeholder="e.g., 15g"
                                            />
                                            <InputError message={errors['nutrition.total_fat']} className="mt-2" />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="saturated_fat" value="Saturated fat" />
                                            <TextInput
                                                id="saturated_fat"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.saturated_fat}
                                                onChange={(e) => setNutrition('saturated_fat', e.target.value)}
                                                placeholder="e.g., 9g"
                                            />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="trans_fat" value="Trans fat" />
                                            <TextInput
                                                id="trans_fat"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.trans_fat}
                                                onChange={(e) => setNutrition('trans_fat', e.target.value)}
                                                placeholder="e.g., 0.5g"
                                            />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="cholesterol" value="Cholesterol" />
                                            <TextInput
                                                id="cholesterol"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.cholesterol}
                                                onChange={(e) => setNutrition('cholesterol', e.target.value)}
                                                placeholder="e.g., 70mg"
                                            />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="sodium" value="Sodium" />
                                            <TextInput
                                                id="sodium"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.sodium}
                                                onChange={(e) => setNutrition('sodium', e.target.value)}
                                                placeholder="e.g., 970mg"
                                            />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="total_carbohydrate" value="Total carbohydrate" />
                                            <TextInput
                                                id="total_carbohydrate"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.total_carbohydrate}
                                                onChange={(e) => setNutrition('total_carbohydrate', e.target.value)}
                                                placeholder="e.g., 30g"
                                            />
                                            <InputError message={errors['nutrition.total_carbohydrate']} className="mt-2" />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="dietary_fiber" value="Dietary fiber" />
                                            <TextInput
                                                id="dietary_fiber"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.dietary_fiber}
                                                onChange={(e) => setNutrition('dietary_fiber', e.target.value)}
                                                placeholder="e.g., 0g"
                                            />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="total_sugars" value="Total sugars" />
                                            <TextInput
                                                id="total_sugars"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.total_sugars}
                                                onChange={(e) => setNutrition('total_sugars', e.target.value)}
                                                placeholder="e.g., 4g"
                                            />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="added_sugars" value="Added sugars" />
                                            <TextInput
                                                id="added_sugars"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.added_sugars}
                                                onChange={(e) => setNutrition('added_sugars', e.target.value)}
                                                placeholder="e.g., 1g"
                                            />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="protein" value="Protein" />
                                            <TextInput
                                                id="protein"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.protein}
                                                onChange={(e) => setNutrition('protein', e.target.value)}
                                                placeholder="e.g., 20g"
                                            />
                                            <InputError message={errors['nutrition.protein']} className="mt-2" />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="vitamin_d" value="Vitamin D" />
                                            <TextInput
                                                id="vitamin_d"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.vitamin_d}
                                                onChange={(e) => setNutrition('vitamin_d', e.target.value)}
                                                placeholder="e.g., 0.1mcg"
                                            />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="calcium" value="Calcium" />
                                            <TextInput
                                                id="calcium"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.calcium}
                                                onChange={(e) => setNutrition('calcium', e.target.value)}
                                                placeholder="e.g., 380mg"
                                            />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="iron" value="Iron" />
                                            <TextInput
                                                id="iron"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.iron}
                                                onChange={(e) => setNutrition('iron', e.target.value)}
                                                placeholder="e.g., 0.7mg"
                                            />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="potassium" value="Potassium" />
                                            <TextInput
                                                id="potassium"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.potassium}
                                                onChange={(e) => setNutrition('potassium', e.target.value)}
                                                placeholder="e.g., 210mg"
                                            />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="monounsaturated_fat" value="Monounsaturated fat" />
                                            <TextInput
                                                id="monounsaturated_fat"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.monounsaturated_fat}
                                                onChange={(e) =>
                                                    setNutrition('monounsaturated_fat', e.target.value)
                                                }
                                                placeholder="e.g., 3g"
                                            />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="polyunsaturated_fat" value="Polyunsaturated fat" />
                                            <TextInput
                                                id="polyunsaturated_fat"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.polyunsaturated_fat}
                                                onChange={(e) =>
                                                    setNutrition('polyunsaturated_fat', e.target.value)
                                                }
                                                placeholder="e.g., 1g"
                                            />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="vitamin_a" value="Vitamin A" />
                                            <TextInput
                                                id="vitamin_a"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.vitamin_a}
                                                onChange={(e) => setNutrition('vitamin_a', e.target.value)}
                                                placeholder="e.g., 50mcg"
                                            />
                                        </div>
                                        <div>
                                            <InputLabel htmlFor="vitamin_c" value="Vitamin C" />
                                            <TextInput
                                                id="vitamin_c"
                                                type="text"
                                                className="mt-1 block w-full"
                                                value={data.nutrition.vitamin_c}
                                                onChange={(e) => setNutrition('vitamin_c', e.target.value)}
                                                placeholder="e.g., 0mg"
                                            />
                                        </div>
                                    </div>
                                </div>

                                {/* Tags */}
                                <div className="space-y-4">
                                    <h3 className="text-lg font-semibold text-gray-700">Tags</h3>
                                    <div className="grid grid-cols-2 md:grid-cols-4 gap-3">
                                        {tags.map((tag) => (
                                            <label key={tag.id} className="flex items-center space-x-2">
                                                <input
                                                    type="checkbox"
                                                    checked={data.tags.includes(tag.id)}
                                                    onChange={() => handleTagChange(tag.id)}
                                                    className="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                />
                                                <span className="text-sm text-gray-700">{tag.slug}</span>
                                            </label>
                                        ))}
                                    </div>
                                </div>

                                {/* Pizza Image */}
                                <div className="space-y-4">
                                    <h3 className="text-lg font-semibold text-gray-700">Pizza Image</h3>
                                    <div>
                                        <InputLabel htmlFor="pizza_image" value="Pizza Image (Optional)" />
                                        <input
                                            id="pizza_image"
                                            type="file"
                                            className="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                            accept="image/*"
                                            onChange={(e) => {
                                                const file = e.target.files?.[0];
                                                setData('pizza_image', file || null);
                                                if (file && file.size > MAX_IMAGE_SIZE_BYTES) {
                                                    setImageSizeError(
                                                        `File is too large. Maximum size is ${MAX_IMAGE_SIZE_MB} MB.`
                                                    );
                                                } else {
                                                    setImageSizeError(null);
                                                }
                                            }}
                                        />
                                        <p className="mt-1 text-sm text-gray-500">
                                            Accepted formats: JPEG, PNG, JPG, GIF. Max size: 100MB. Leave empty to keep
                                            current image.
                                        </p>
                                        <InputError message={imageSizeError || errors.pizza_image} className="mt-2" />
                                    </div>
                                </div>

                                {/* Submit Button */}
                                <div className="flex items-center justify-end space-x-4 pt-6">
                                    <Link
                                        href={pizzaShowUrl}
                                        className="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                    >
                                        Cancel
                                    </Link>
                                    <SecondaryButton
                                        type="button"
                                        onClick={() => {
                                            reset();
                                            setImageSizeError(null);
                                        }}
                                        disabled={processing}
                                    >
                                        Reset to saved
                                    </SecondaryButton>
                                    <PrimaryButton disabled={processing || !!imageSizeError}>
                                        {processing ? 'Saving...' : 'Save changes'}
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </MainLayout>
    );
}

import React, { useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';

export default function Create({ brands, categories, tags }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        description: '',
        brand_id: '',
        ingredients: [''],
        allergens: '',
        website: '',
        tags: [],
        categories: [],
        pizza_image: null,
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        
        const formData = new FormData();
        formData.append('name', data.name);
        formData.append('description', data.description);
        formData.append('brand_id', data.brand_id);
        formData.append('ingredients', JSON.stringify(data.ingredients.filter(ingredient => ingredient.trim())));
        formData.append('allergens', data.allergens);
        formData.append('website', data.website);
        formData.append('tags', JSON.stringify(data.tags));
        formData.append('categories', JSON.stringify(data.categories));
        if (data.pizza_image) {
            formData.append('pizza_image', data.pizza_image);
        }

        post(route('pizza-submissions.store'), {
            data: formData,
            onSuccess: () => reset(),
        });
    };

    const addIngredient = () => {
        setData('ingredients', [...data.ingredients, '']);
    };

    const removeIngredient = (index) => {
        const newIngredients = data.ingredients.filter((_, i) => i !== index);
        setData('ingredients', newIngredients);
    };

    const updateIngredient = (index, value) => {
        const newIngredients = [...data.ingredients];
        newIngredients[index] = value;
        setData('ingredients', newIngredients);
    };

    const handleTagChange = (tagId) => {
        const newTags = data.tags.includes(tagId)
            ? data.tags.filter(id => id !== tagId)
            : [...data.tags, tagId];
        setData('tags', newTags);
    };

    const handleCategoryChange = (categoryId) => {
        const newCategories = data.categories.includes(categoryId)
            ? data.categories.filter(id => id !== categoryId)
            : [...data.categories, categoryId];
        setData('categories', newCategories);
    };

    return (
        <MainLayout>
            <Head title="Submit New Pizza" />

            <div className="py-12">
                <div className="max-w-4xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">
                            <h2 className="text-2xl font-bold text-gray-900 mb-6">Submit a New Pizza</h2>
                            
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
                                    <div className="flex items-center justify-between">
                                        <h3 className="text-lg font-semibold text-gray-700">Ingredients</h3>
                                        <SecondaryButton
                                            type="button"
                                            onClick={addIngredient}
                                            className="text-sm"
                                        >
                                            Add Ingredient
                                        </SecondaryButton>
                                    </div>
                                    
                                    {data.ingredients.map((ingredient, index) => (
                                        <div key={index} className="flex items-center space-x-2">
                                            <TextInput
                                                type="text"
                                                className="flex-1"
                                                value={ingredient}
                                                onChange={(e) => updateIngredient(index, e.target.value)}
                                                placeholder="e.g., Mozzarella cheese, Pepperoni, Tomato sauce"
                                            />
                                            {data.ingredients.length > 1 && (
                                                <button
                                                    type="button"
                                                    onClick={() => removeIngredient(index)}
                                                    className="text-red-600 hover:text-red-800"
                                                >
                                                    Remove
                                                </button>
                                            )}
                                        </div>
                                    ))}
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

                                {/* Categories */}
                                <div className="space-y-4">
                                    <h3 className="text-lg font-semibold text-gray-700">Categories</h3>
                                    
                                    <div className="grid grid-cols-2 md:grid-cols-3 gap-3">
                                        {categories.map((category) => (
                                            <label key={category.id} className="flex items-center space-x-2">
                                                <input
                                                    type="checkbox"
                                                    checked={data.categories.includes(category.id)}
                                                    onChange={() => handleCategoryChange(category.id)}
                                                    className="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                                />
                                                <span className="text-sm text-gray-700">{category.name}</span>
                                            </label>
                                        ))}
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
                                                <span className="text-sm text-gray-700">{tag.name}</span>
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
                                            onChange={(e) => setData('pizza_image', e.target.files[0])}
                                        />
                                        <p className="mt-1 text-sm text-gray-500">
                                            Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB.
                                        </p>
                                        <InputError message={errors.pizza_image} className="mt-2" />
                                    </div>
                                </div>

                                {/* Submit Button */}
                                <div className="flex items-center justify-end space-x-4 pt-6">
                                    <SecondaryButton
                                        type="button"
                                        onClick={() => reset()}
                                        disabled={processing}
                                    >
                                        Reset Form
                                    </SecondaryButton>
                                    <PrimaryButton disabled={processing}>
                                        {processing ? 'Submitting...' : 'Submit Pizza'}
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

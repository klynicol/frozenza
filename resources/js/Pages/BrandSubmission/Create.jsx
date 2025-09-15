import React, { useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';

export default function Create({ auth }) {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        description: '',
        website: '',
        store_locator_url: '',
        founded_year: '',
        brand_story: '',
        unique_selling_points: [''],
        social_media_handles: [''],
        logo: null,
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        
        const formData = new FormData();
        formData.append('name', data.name);
        formData.append('description', data.description);
        formData.append('website', data.website);
        formData.append('store_locator_url', data.store_locator_url);
        formData.append('founded_year', data.founded_year);
        formData.append('brand_story', data.brand_story);
        formData.append('unique_selling_points', JSON.stringify(data.unique_selling_points.filter(point => point.trim())));
        formData.append('social_media_handles', JSON.stringify(data.social_media_handles.filter(handle => handle.trim())));
        if (data.logo) {
            formData.append('logo', data.logo);
        }

        post(route('brand-submissions.store'), {
            data: formData,
            onSuccess: () => reset(),
        });
    };

    const addUniqueSellingPoint = () => {
        setData('unique_selling_points', [...data.unique_selling_points, '']);
    };

    const removeUniqueSellingPoint = (index) => {
        const newPoints = data.unique_selling_points.filter((_, i) => i !== index);
        setData('unique_selling_points', newPoints);
    };

    const updateUniqueSellingPoint = (index, value) => {
        const newPoints = [...data.unique_selling_points];
        newPoints[index] = value;
        setData('unique_selling_points', newPoints);
    };

    const addSocialMediaHandle = () => {
        setData('social_media_handles', [...data.social_media_handles, '']);
    };

    const removeSocialMediaHandle = (index) => {
        const newHandles = data.social_media_handles.filter((_, i) => i !== index);
        setData('social_media_handles', newHandles);
    };

    const updateSocialMediaHandle = (index, value) => {
        const newHandles = [...data.social_media_handles];
        newHandles[index] = value;
        setData('social_media_handles', newHandles);
    };

    return (
        <MainLayout auth={auth} showPromotionalBanner={false}>
            <Head title="Submit New Brand" />

            <div className="py-12">
                <div className="max-w-4xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 bg-white border-b border-gray-200">
                            <h2 className="text-2xl font-bold text-gray-900 mb-6">Submit a New Brand</h2>
                            
                            <form onSubmit={handleSubmit} className="space-y-6">
                                {/* Basic Information */}
                                <div className="space-y-4">
                                    <h3 className="text-lg font-semibold text-gray-700">Basic Information</h3>
                                    
                                    <div>
                                        <InputLabel htmlFor="name" value="Brand Name *" />
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

                                    <div>
                                        <InputLabel htmlFor="store_locator_url" value="Store Locator URL" />
                                        <TextInput
                                            id="store_locator_url"
                                            type="url"
                                            className="mt-1 block w-full"
                                            value={data.store_locator_url}
                                            onChange={(e) => setData('store_locator_url', e.target.value)}
                                            placeholder="https://example.com/store-locator"
                                        />
                                        <p className="mt-1 text-sm text-gray-500">
                                            Link to your brand's store locator page (optional)
                                        </p>
                                        <InputError message={errors.store_locator_url} className="mt-2" />
                                    </div>

                                    <div>
                                        <InputLabel htmlFor="founded_year" value="Founded Year" />
                                        <TextInput
                                            id="founded_year"
                                            type="number"
                                            className="mt-1 block w-full"
                                            value={data.founded_year}
                                            onChange={(e) => setData('founded_year', e.target.value)}
                                            min="1800"
                                            max={new Date().getFullYear() + 1}
                                        />
                                        <InputError message={errors.founded_year} className="mt-2" />
                                    </div>
                                </div>

                                {/* Brand Story */}
                                <div className="space-y-4">
                                    <h3 className="text-lg font-semibold text-gray-700">Brand Story</h3>
                                    
                                    <div>
                                        <InputLabel htmlFor="brand_story" value="Brand Story" />
                                        <textarea
                                            id="brand_story"
                                            className="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            rows="6"
                                            value={data.brand_story}
                                            onChange={(e) => setData('brand_story', e.target.value)}
                                            placeholder="Tell us about your brand's history, mission, and what makes it unique..."
                                        />
                                        <InputError message={errors.brand_story} className="mt-2" />
                                    </div>
                                </div>

                                {/* Unique Selling Points */}
                                <div className="space-y-4">
                                    <div className="flex items-center justify-between">
                                        <h3 className="text-lg font-semibold text-gray-700">Unique Selling Points</h3>
                                        <SecondaryButton
                                            type="button"
                                            onClick={addUniqueSellingPoint}
                                            className="text-sm"
                                        >
                                            Add Point
                                        </SecondaryButton>
                                    </div>
                                    
                                    {data.unique_selling_points.map((point, index) => (
                                        <div key={index} className="flex items-center space-x-2">
                                            <TextInput
                                                type="text"
                                                className="flex-1"
                                                value={point}
                                                onChange={(e) => updateUniqueSellingPoint(index, e.target.value)}
                                                placeholder="e.g., Organic ingredients, Family-owned since 1950"
                                            />
                                            {data.unique_selling_points.length > 1 && (
                                                <button
                                                    type="button"
                                                    onClick={() => removeUniqueSellingPoint(index)}
                                                    className="text-red-600 hover:text-red-800"
                                                >
                                                    Remove
                                                </button>
                                            )}
                                        </div>
                                    ))}
                                </div>

                                {/* Social Media Handles */}
                                <div className="space-y-4">
                                    <div className="flex items-center justify-between">
                                        <h3 className="text-lg font-semibold text-gray-700">Social Media Handles</h3>
                                        <SecondaryButton
                                            type="button"
                                            onClick={addSocialMediaHandle}
                                            className="text-sm"
                                        >
                                            Add Handle
                                        </SecondaryButton>
                                    </div>
                                    
                                    {data.social_media_handles.map((handle, index) => (
                                        <div key={index} className="flex items-center space-x-2">
                                            <TextInput
                                                type="text"
                                                className="flex-1"
                                                value={handle}
                                                onChange={(e) => updateSocialMediaHandle(index, e.target.value)}
                                                placeholder="e.g., @brandname, facebook.com/brandname"
                                            />
                                            {data.social_media_handles.length > 1 && (
                                                <button
                                                    type="button"
                                                    onClick={() => removeSocialMediaHandle(index)}
                                                    className="text-red-600 hover:text-red-800"
                                                >
                                                    Remove
                                                </button>
                                            )}
                                        </div>
                                    ))}
                                </div>

                                {/* Logo Upload */}
                                <div className="space-y-4">
                                    <h3 className="text-lg font-semibold text-gray-700">Brand Logo</h3>
                                    
                                    <div>
                                        <InputLabel htmlFor="logo" value="Logo Image (Optional)" />
                                        <input
                                            id="logo"
                                            type="file"
                                            className="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                            accept="image/*"
                                            onChange={(e) => setData('logo', e.target.files[0])}
                                        />
                                        <p className="mt-1 text-sm text-gray-500">
                                            Accepted formats: JPEG, PNG, JPG, GIF. Max size: 2MB.
                                        </p>
                                        <InputError message={errors.logo} className="mt-2" />
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
                                        {processing ? 'Submitting...' : 'Submit Brand'}
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

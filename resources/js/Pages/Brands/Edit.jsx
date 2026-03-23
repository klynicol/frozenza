import React from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import AdminLayout from '@/Layouts/AdminLayout';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';
import { getImageUrl } from '@/utils/image';
import { ArrowLeftIcon } from '@heroicons/react/24/outline';

function ensureArray(value) {
    if (Array.isArray(value) && value.length > 0) return value;
    if (Array.isArray(value)) return [''];
    if (value && typeof value === 'string') return [value];
    return [''];
}

export default function Edit({ brand }) {
    const { data, setData, put, processing, errors } = useForm({
        name: brand.name || '',
        slug: brand.slug || '',
        description: brand.description || '',
        website: brand.website || '',
        store_locator_url: brand.store_locator_url || '',
        founded_year: brand.founded_year ? String(brand.founded_year) : '',
        brand_story: brand.brand_story || '',
        unique_selling_points: ensureArray(brand.unique_selling_points),
        social_media_handles: ensureArray(brand.social_media_handles),
        seo_title: brand.seo_title || '',
        seo_description: brand.seo_description || '',
        seo_about_content: brand.seo_about_content || '',
        seo_keywords: ensureArray(brand.seo_keywords),
        logo: null,
    });

    const handleSubmit = (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('name', data.name);
        formData.append('slug', data.slug);
        formData.append('description', data.description);
        formData.append('website', data.website);
        formData.append('store_locator_url', data.store_locator_url);
        formData.append('founded_year', data.founded_year);
        formData.append('brand_story', data.brand_story);
        formData.append('seo_title', data.seo_title);
        formData.append('seo_description', data.seo_description);
        formData.append('seo_about_content', data.seo_about_content);
        data.unique_selling_points.filter(Boolean).forEach((p) => formData.append('unique_selling_points[]', p));
        data.social_media_handles.filter(Boolean).forEach((h) => formData.append('social_media_handles[]', h));
        data.seo_keywords.filter(Boolean).forEach((k) => formData.append('seo_keywords[]', k));
        if (data.logo) formData.append('logo', data.logo);

        put(route('admin.brands.update', brand.id), {
            data: formData,
        });
    };

    const addUniqueSellingPoint = () => setData('unique_selling_points', [...data.unique_selling_points, '']);
    const removeUniqueSellingPoint = (index) =>
        setData('unique_selling_points', data.unique_selling_points.filter((_, i) => i !== index));
    const updateUniqueSellingPoint = (index, value) => {
        const next = [...data.unique_selling_points];
        next[index] = value;
        setData('unique_selling_points', next);
    };

    const addSocialMediaHandle = () => setData('social_media_handles', [...data.social_media_handles, '']);
    const removeSocialMediaHandle = (index) =>
        setData('social_media_handles', data.social_media_handles.filter((_, i) => i !== index));
    const updateSocialMediaHandle = (index, value) => {
        const next = [...data.social_media_handles];
        next[index] = value;
        setData('social_media_handles', next);
    };

    const addSeoKeyword = () => setData('seo_keywords', [...data.seo_keywords, '']);
    const removeSeoKeyword = (index) => setData('seo_keywords', data.seo_keywords.filter((_, i) => i !== index));
    const updateSeoKeyword = (index, value) => {
        const next = [...data.seo_keywords];
        next[index] = value;
        setData('seo_keywords', next);
    };

    return (
        <AdminLayout>
            <Head title={`Edit Brand: ${brand.name}`} />

            <div className="py-6">
                <div className="mx-auto max-w-4xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="border-b border-gray-200 bg-white p-6">
                            <div className="mb-6 flex items-center gap-4">
                                <Link
                                    href={route('admin.brands.index')}
                                    className="inline-flex items-center text-sm text-gray-500 hover:text-gray-700"
                                >
                                    <ArrowLeftIcon className="mr-1 h-4 w-4" />
                                    Back to Brands
                                </Link>
                                <h1 className="text-2xl font-semibold text-gray-900">Edit Brand: {brand.name}</h1>
                            </div>

                            <form onSubmit={handleSubmit} className="space-y-8">
                                {/* Basic info */}
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
                                        <InputLabel htmlFor="slug" value="URL slug" />
                                        <TextInput
                                            id="slug"
                                            type="text"
                                            className="mt-1 block w-full"
                                            value={data.slug}
                                            onChange={(e) => setData('slug', e.target.value)}
                                            placeholder="Leave blank to generate from name"
                                        />
                                        <InputError message={errors.slug} className="mt-2" />
                                    </div>
                                    <div>
                                        <InputLabel htmlFor="description" value="Description *" />
                                        <textarea
                                            id="description"
                                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            rows={4}
                                            value={data.description}
                                            onChange={(e) => setData('description', e.target.value)}
                                            required
                                        />
                                        <InputError message={errors.description} className="mt-2" />
                                    </div>
                                    <div className="grid grid-cols-1 gap-4 sm:grid-cols-2">
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
                                            <InputLabel htmlFor="store_locator_url" value="Store locator URL" />
                                            <TextInput
                                                id="store_locator_url"
                                                type="url"
                                                className="mt-1 block w-full"
                                                value={data.store_locator_url}
                                                onChange={(e) => setData('store_locator_url', e.target.value)}
                                            />
                                            <InputError message={errors.store_locator_url} className="mt-2" />
                                        </div>
                                    </div>
                                    <div>
                                        <InputLabel htmlFor="founded_year" value="Founded year" />
                                        <TextInput
                                            id="founded_year"
                                            type="number"
                                            className="mt-1 block w-full"
                                            value={data.founded_year}
                                            onChange={(e) => setData('founded_year', e.target.value)}
                                            min={1800}
                                            max={new Date().getFullYear() + 1}
                                        />
                                        <InputError message={errors.founded_year} className="mt-2" />
                                    </div>
                                </div>

                                {/* Brand story */}
                                <div className="space-y-4">
                                    <h3 className="text-lg font-semibold text-gray-700">Brand story</h3>
                                    <div>
                                        <InputLabel htmlFor="brand_story" value="Brand story" />
                                        <textarea
                                            id="brand_story"
                                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            rows={5}
                                            value={data.brand_story}
                                            onChange={(e) => setData('brand_story', e.target.value)}
                                            placeholder="About the brand, history, mission..."
                                        />
                                        <InputError message={errors.brand_story} className="mt-2" />
                                    </div>
                                </div>

                                {/* Unique selling points */}
                                <div className="space-y-4">
                                    <div className="flex items-center justify-between">
                                        <h3 className="text-lg font-semibold text-gray-700">Unique selling points</h3>
                                        <SecondaryButton type="button" onClick={addUniqueSellingPoint} className="text-sm">
                                            Add point
                                        </SecondaryButton>
                                    </div>
                                    {data.unique_selling_points.map((point, index) => (
                                        <div key={index} className="flex items-center gap-2">
                                            <TextInput
                                                type="text"
                                                className="flex-1"
                                                value={point}
                                                onChange={(e) => updateUniqueSellingPoint(index, e.target.value)}
                                                placeholder="e.g. Organic ingredients"
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

                                {/* Social media */}
                                <div className="space-y-4">
                                    <div className="flex items-center justify-between">
                                        <h3 className="text-lg font-semibold text-gray-700">Social media handles</h3>
                                        <SecondaryButton type="button" onClick={addSocialMediaHandle} className="text-sm">
                                            Add handle
                                        </SecondaryButton>
                                    </div>
                                    {data.social_media_handles.map((handle, index) => (
                                        <div key={index} className="flex items-center gap-2">
                                            <TextInput
                                                type="text"
                                                className="flex-1"
                                                value={handle}
                                                onChange={(e) => updateSocialMediaHandle(index, e.target.value)}
                                                placeholder="e.g. @brandname"
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

                                {/* SEO */}
                                <div className="space-y-4">
                                    <h3 className="text-lg font-semibold text-gray-700">SEO</h3>
                                    <div>
                                        <InputLabel htmlFor="seo_title" value="SEO title" />
                                        <TextInput
                                            id="seo_title"
                                            type="text"
                                            className="mt-1 block w-full"
                                            value={data.seo_title}
                                            onChange={(e) => setData('seo_title', e.target.value)}
                                        />
                                        <InputError message={errors.seo_title} className="mt-2" />
                                    </div>
                                    <div>
                                        <InputLabel htmlFor="seo_description" value="SEO description" />
                                        <textarea
                                            id="seo_description"
                                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            rows={2}
                                            value={data.seo_description}
                                            onChange={(e) => setData('seo_description', e.target.value)}
                                        />
                                        <InputError message={errors.seo_description} className="mt-2" />
                                    </div>
                                    <div>
                                        <InputLabel htmlFor="seo_about_content" value="SEO about content" />
                                        <textarea
                                            id="seo_about_content"
                                            className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                            rows={4}
                                            value={data.seo_about_content}
                                            onChange={(e) => setData('seo_about_content', e.target.value)}
                                        />
                                        <InputError message={errors.seo_about_content} className="mt-2" />
                                    </div>
                                    <div className="flex items-center justify-between">
                                        <InputLabel value="SEO keywords" />
                                        <SecondaryButton type="button" onClick={addSeoKeyword} className="text-sm">
                                            Add keyword
                                        </SecondaryButton>
                                    </div>
                                    {data.seo_keywords.map((keyword, index) => (
                                        <div key={index} className="flex items-center gap-2">
                                            <TextInput
                                                type="text"
                                                className="flex-1"
                                                value={keyword}
                                                onChange={(e) => updateSeoKeyword(index, e.target.value)}
                                                placeholder="Keyword"
                                            />
                                            {data.seo_keywords.length > 1 && (
                                                <button
                                                    type="button"
                                                    onClick={() => removeSeoKeyword(index)}
                                                    className="text-red-600 hover:text-red-800"
                                                >
                                                    Remove
                                                </button>
                                            )}
                                        </div>
                                    ))}
                                </div>

                                {/* Logo */}
                                <div className="space-y-4">
                                    <h3 className="text-lg font-semibold text-gray-700">Logo</h3>
                                    {brand?.image && (
                                        <div className="flex items-center gap-4">
                                            <img
                                                src={getImageUrl(brand.image)}
                                                alt={`${brand.name} logo`}
                                                className="h-24 w-24 object-contain"
                                            />
                                            <p className="text-sm text-gray-500">Current logo. Upload a new file to replace.</p>
                                        </div>
                                    )}
                                    <div>
                                        <InputLabel htmlFor="logo" value="Upload new logo (optional)" />
                                        <input
                                            id="logo"
                                            type="file"
                                            accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                                            className="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-full file:border-0 file:bg-indigo-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-indigo-700 hover:file:bg-indigo-100"
                                            onChange={(e) => setData('logo', e.target.files?.[0] ?? null)}
                                        />
                                        <p className="mt-1 text-sm text-gray-500">JPEG, PNG, GIF, WebP. Max 2MB.</p>
                                        <InputError message={errors.logo} className="mt-2" />
                                    </div>
                                </div>

                                <div className="flex justify-end gap-3 border-t border-gray-200 pt-6">
                                    <Link
                                        href={route('admin.brands.index')}
                                        className="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    >
                                        Cancel
                                    </Link>
                                    <PrimaryButton type="submit" disabled={processing}>
                                        {processing ? 'Saving…' : 'Save brand'}
                                    </PrimaryButton>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </AdminLayout>
    );
}

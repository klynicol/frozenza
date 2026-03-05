import React, { useState } from 'react';
import { Head, useForm } from '@inertiajs/react';
import AdminLayout from '@/Layouts/AdminLayout';
import InputLabel from '@/Components/InputLabel';
import TextInput from '@/Components/TextInput';
import InputError from '@/Components/InputError';
import PrimaryButton from '@/Components/PrimaryButton';
import SecondaryButton from '@/Components/SecondaryButton';

export default function BlogCreate() {
    const { data, setData, post, processing, errors } = useForm({
        title: '',
        meta_description: '',
        keywords: '',
        content: '',
        feature_image: '',
        tags: [],
        published_at: '',
        is_published: false,
    });

    const [tagInput, setTagInput] = useState('');

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route('blogs.store'));
    };

    const addTag = () => {
        if (tagInput.trim() && !data.tags.includes(tagInput.trim())) {
            setData('tags', [...data.tags, tagInput.trim()]);
            setTagInput('');
        }
    };

    const removeTag = (tagToRemove) => {
        setData('tags', data.tags.filter(tag => tag !== tagToRemove));
    };

    const handleKeyPress = (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            addTag();
        }
    };

    return (
        <AdminLayout>
            <Head title="Create Blog Post" />
            
            <div className="py-12">
                <div className="max-w-4xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6">
                            <div className="flex justify-between items-center mb-6">
                                <h1 className="text-2xl font-semibold text-gray-900">Create New Blog Post</h1>
                                <SecondaryButton onClick={() => window.history.back()}>
                                    Cancel
                                </SecondaryButton>
                            </div>

                            <form onSubmit={handleSubmit} className="space-y-6">
                                {/* Title */}
                                <div>
                                    <InputLabel htmlFor="title" value="Title" />
                                    <TextInput
                                        id="title"
                                        type="text"
                                        className="mt-1 block w-full"
                                        value={data.title}
                                        onChange={(e) => setData('title', e.target.value)}
                                        required
                                    />
                                    <InputError message={errors.title} className="mt-2" />
                                </div>

                                {/* Meta Description (required for SEO) */}
                                <div>
                                    <InputLabel htmlFor="meta_description" value="Meta Description (required)" />
                                    <textarea
                                        id="meta_description"
                                        className="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        rows="3"
                                        value={data.meta_description}
                                        onChange={(e) => setData('meta_description', e.target.value)}
                                        placeholder="Brief description for SEO (150-160 characters recommended)"
                                        required
                                    />
                                    <InputError message={errors.meta_description} className="mt-2" />
                                    <p className="mt-1 text-sm text-gray-500">
                                        {(data.meta_description ?? '').length}/160 characters
                                    </p>
                                </div>

                                {/* Keywords (SEO) */}
                                <div>
                                    <InputLabel htmlFor="keywords" value="Keywords" />
                                    <textarea
                                        id="keywords"
                                        className="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        rows="2"
                                        value={data.keywords}
                                        onChange={(e) => setData('keywords', e.target.value)}
                                        placeholder="Comma-separated SEO keywords (optional)"
                                    />
                                    <InputError message={errors.keywords} className="mt-2" />
                                </div>

                                {/* Feature Image (URL or path) */}
                                <div>
                                    <InputLabel htmlFor="feature_image" value="Feature Image (URL or path)" />
                                    <TextInput
                                        id="feature_image"
                                        type="text"
                                        className="mt-1 block w-full"
                                        value={data.feature_image}
                                        onChange={(e) => setData('feature_image', e.target.value)}
                                        placeholder="https://example.com/image.jpg or blogs/image.png"
                                    />
                                    <InputError message={errors.feature_image} className="mt-2" />
                                </div>

                                {/* Tags */}
                                <div>
                                    <InputLabel htmlFor="tags" value="Tags" />
                                    <div className="mt-1 flex gap-2">
                                        <TextInput
                                            id="tags"
                                            type="text"
                                            className="flex-1"
                                            value={tagInput}
                                            onChange={(e) => setTagInput(e.target.value)}
                                            onKeyPress={handleKeyPress}
                                            placeholder="Add a tag and press Enter"
                                        />
                                        <button
                                            type="button"
                                            onClick={addTag}
                                            className="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                                        >
                                            Add
                                        </button>
                                    </div>
                                    {data.tags.length > 0 && (
                                        <div className="mt-2 flex flex-wrap gap-2">
                                            {data.tags.map((tag, index) => (
                                                <span
                                                    key={index}
                                                    className="inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800"
                                                >
                                                    {tag}
                                                    <button
                                                        type="button"
                                                        onClick={() => removeTag(tag)}
                                                        className="ml-2 text-blue-600 hover:text-blue-800"
                                                    >
                                                        ×
                                                    </button>
                                                </span>
                                            ))}
                                        </div>
                                    )}
                                    <InputError message={errors.tags} className="mt-2" />
                                </div>

                                {/* Publish Settings */}
                                <div className="flex items-center space-x-4">
                                    <div className="flex items-center">
                                        <input
                                            id="is_published"
                                            type="checkbox"
                                            className="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                            checked={data.is_published}
                                            onChange={(e) => setData('is_published', e.target.checked)}
                                        />
                                        <label htmlFor="is_published" className="ml-2 text-sm text-gray-700">
                                            Publish immediately
                                        </label>
                                    </div>
                                    
                                    {!data.is_published && (
                                        <div className="flex-1">
                                            <InputLabel htmlFor="published_at" value="Schedule Publish Date" />
                                            <TextInput
                                                id="published_at"
                                                type="datetime-local"
                                                className="mt-1 block w-full"
                                                value={data.published_at}
                                                onChange={(e) => setData('published_at', e.target.value)}
                                            />
                                        </div>
                                    )}
                                </div>

                                {/* Content (optional for drafts) */}
                                <div>
                                    <InputLabel htmlFor="content" value="Content" />
                                    <textarea
                                        id="content"
                                        className="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        rows="20"
                                        value={data.content}
                                        onChange={(e) => setData('content', e.target.value)}
                                        placeholder="Write your blog post content here. HTML is supported."
                                    />
                                    <InputError message={errors.content} className="mt-2" />
                                    <p className="mt-1 text-sm text-gray-500">
                                        HTML tags are supported. Optional when saving as draft.
                                    </p>
                                </div>

                                {/* Submit Buttons */}
                                <div className="flex justify-end space-x-3">
                                    <SecondaryButton onClick={() => window.history.back()}>
                                        Cancel
                                    </SecondaryButton>
                                    <PrimaryButton disabled={processing}>
                                        {processing ? 'Creating...' : 'Create Post'}
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

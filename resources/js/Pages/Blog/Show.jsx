import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import { Link } from '@inertiajs/react';

export default function BlogShow({ post, meta, auth }) {
    return (
        <MainLayout meta={meta} auth={auth}>
            <div className="max-w-4xl mx-auto">
                <article className="bg-white rounded-lg shadow-lg overflow-hidden">
                    {post.featured_image && (
                        <img
                            src={post.featured_image}
                            alt={post.title}
                            className="w-full h-64 object-cover"
                        />
                    )}
                    <div className="p-6">
                        <h1 className="text-3xl font-bold mb-4">{post.title}</h1>
                        <div className="flex justify-between items-center text-sm text-gray-500 mb-8">
                            <span>By {post.author.name}</span>
                            <span>{new Date(post.published_at).toLocaleDateString()}</span>
                        </div>
                        <div 
                            className="prose max-w-none"
                            dangerouslySetInnerHTML={{ __html: post.content }}
                        />
                        {post.tags.length > 0 && (
                            <div className="mt-8 pt-4 border-t">
                                <div className="flex gap-2">
                                    {post.tags.map((tag, index) => (
                                        <span
                                            key={index}
                                            className="px-3 py-1 bg-gray-100 rounded-full text-sm"
                                        >
                                            {tag}
                                        </span>
                                    ))}
                                </div>
                            </div>
                        )}
                    </div>
                </article>

                {auth.user?.id === post.author.id && (
                    <div className="mt-4 flex justify-end gap-4">
                        <Link
                            href={`/blog/${post.slug}/edit`}
                            className="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                        >
                            Edit Post
                        </Link>
                    </div>
                )}
            </div>
        </MainLayout>
    );
} 
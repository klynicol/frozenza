import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import { Link } from '@inertiajs/react';
import { route } from '@/utils/route';
import { hasRole } from '@/utils/roles';

export default function BlogIndex({ posts, meta, auth }) {
    return (
        <MainLayout meta={meta} auth={auth}>
            <div className="max-w-7xl mx-auto">
                <div className="flex justify-between items-center mb-8">
                    <h1 className="text-3xl font-bold">Blog Posts</h1>
                    {auth.user && hasRole(auth.user, 'blog-writer,admin') && (
                        <Link
                            href={route('blogs.create')}
                            className="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600"
                        >
                            Write New Post
                        </Link>
                    )}
                </div>

                <div className="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                    {posts.data.map((post) => (
                        <Link
                            key={post.id}
                            href={`/blogs/${post.slug}`}
                            className="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow"
                        >
                            {post.feature_image && (
                                <img
                                    src={post.feature_image}
                                    alt={post.title}
                                    className="w-full h-48 object-cover"
                                />
                            )}
                            <div className="p-6">
                                <h2 className="text-xl font-bold mb-2">{post.title}</h2>
                                <p className="text-gray-600 mb-4">
                                    {post.meta_description.substring(0, 150)}...
                                </p>
                                <div className="flex justify-between items-center text-sm text-gray-500">
                                    <span>By Charles Gilchrist</span>
                                    <span>{new Date(post.published_at).toLocaleDateString()}</span>
                                </div>
                            </div>
                        </Link>
                    ))}
                </div>

                {/* Pagination */}
                <div className="mt-8 flex justify-center gap-2">
                    {posts.links.map((link, i) => (
                        <Link
                            key={i}
                            href={link.url || '#'}
                            className={`px-4 py-2 rounded ${link.active
                                    ? 'bg-blue-500 text-white'
                                    : 'bg-white text-gray-700 hover:bg-gray-50'
                                } ${!link.url ? 'opacity-50 cursor-not-allowed' : ''}`}
                            dangerouslySetInnerHTML={{ __html: link.label }}
                        />
                    ))}
                </div>
            </div>
        </MainLayout>
    );
} 
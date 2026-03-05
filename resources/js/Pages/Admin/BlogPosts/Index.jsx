import React from 'react';
import { Head, Link, router } from '@inertiajs/react';
import AdminLayout from '@/Layouts/AdminLayout';
import { PencilIcon, TrashIcon, PlusIcon, EyeIcon } from '@heroicons/react/24/outline';
import Pagination from '@/Components/Pagination';

export default function Index({ posts }) {
  const handleDelete = (post) => {
    if (confirm(`Are you sure you want to delete "${post.title}"?`)) {
      router.delete(route('blogs.destroy', post.slug));
    }
  };

  const formatDate = (dateStr) => {
    if (!dateStr) return '—';
    const d = new Date(dateStr);
    return d.toLocaleDateString(undefined, { dateStyle: 'medium' });
  };

  return (
    <AdminLayout>
      <Head title="Manage Blog Posts" />

      <div className="py-6">
        <div className="mx-auto sm:px-6 lg:px-8">
          <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div className="p-6 bg-white border-b border-gray-200">
              <div className="flex justify-between items-center mb-6">
                <h1 className="text-2xl font-semibold text-gray-900">Blog Posts</h1>
                <Link
                  href={route('blogs.create')}
                  className="inline-flex items-center px-3 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700"
                >
                  <PlusIcon className="h-4 w-4 mr-1" />
                  New Blog Post
                </Link>
              </div>

              <div className="overflow-x-auto">
                <table className="min-w-full divide-y divide-gray-200">
                  <thead className="bg-gray-50">
                    <tr>
                      <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Title
                      </th>
                      <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Slug
                      </th>
                      <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Author
                      </th>
                      <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Published
                      </th>
                      <th scope="col" className="relative px-6 py-3">
                        <span className="sr-only">Actions</span>
                      </th>
                    </tr>
                  </thead>
                  <tbody className="bg-white divide-y divide-gray-200">
                    {posts.data && posts.data.length > 0 ? (
                      posts.data.map((post) => (
                        <tr key={post.id}>
                          <td className="px-6 py-4 text-sm font-medium text-gray-900">
                            {post.title}
                          </td>
                          <td className="px-6 py-4 text-sm text-gray-500 font-mono">
                            {post.slug}
                          </td>
                          <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {post.author?.name ?? '—'}
                          </td>
                          <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {post.published_at ? (
                              <span className="text-green-700">{formatDate(post.published_at)}</span>
                            ) : (
                              <span className="text-amber-600">Draft</span>
                            )}
                          </td>
                          <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div className="flex justify-end space-x-2">
                              <Link
                                href={route('blogs.show', post.slug)}
                                target="_blank"
                                rel="noopener noreferrer"
                                className="text-gray-500 hover:text-gray-700"
                                title="View on site"
                              >
                                <EyeIcon className="h-5 w-5" />
                              </Link>
                              <Link
                                href={route('blogs.edit', post.slug)}
                                className="text-indigo-600 hover:text-indigo-900"
                                title="Edit"
                              >
                                <PencilIcon className="h-5 w-5" />
                              </Link>
                              <button
                                type="button"
                                onClick={() => handleDelete(post)}
                                className="text-red-600 hover:text-red-900"
                                title="Delete"
                              >
                                <TrashIcon className="h-5 w-5" />
                              </button>
                            </div>
                          </td>
                        </tr>
                      ))
                    ) : (
                      <tr>
                        <td colSpan="5" className="px-6 py-8 text-center text-sm text-gray-500">
                          No blog posts yet.{' '}
                          <Link href={route('blogs.create')} className="text-indigo-600 hover:underline">
                            Create one
                          </Link>
                        </td>
                      </tr>
                    )}
                  </tbody>
                </table>
              </div>

              {posts.data?.length > 0 && (
                <div className="mt-6">
                  <Pagination links={posts.links} />
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </AdminLayout>
  );
}

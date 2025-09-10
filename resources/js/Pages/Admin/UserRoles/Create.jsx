import React, { useState } from 'react';
import { Head, Link, useForm } from '@inertiajs/react';
import AdminLayout from '@/Layouts/AdminLayout';
import { ArrowLeftIcon } from '@heroicons/react/24/outline';

export default function Create() {
  const { data, setData, post, processing, errors } = useForm({
    code: '',
    name: '',
    description: '',
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    post(route('admin.user-roles.store'));
  };

  return (
    <AdminLayout>
      <Head title="Create User Role" />

      <div className="py-6">
        <div className="mx-auto sm:px-6 lg:px-8">
          <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div className="p-6 bg-white border-b border-gray-200">
              <div className="flex items-center mb-6">
                <Link
                  href={route('admin.user-roles.index')}
                  className="inline-flex items-center text-sm text-gray-500 hover:text-gray-700 mr-4"
                >
                  <ArrowLeftIcon className="h-4 w-4 mr-1" />
                  Back to User Roles
                </Link>
                <h1 className="text-2xl font-semibold text-gray-900">Create New User Role</h1>
              </div>

              <form onSubmit={handleSubmit} className="space-y-6">
                <div className="grid grid-cols-1 gap-6">
                  <div>
                    <label htmlFor="code" className="block text-sm font-medium text-gray-700">
                      Code <span className="text-red-500">*</span>
                    </label>
                    <input
                      type="text"
                      name="code"
                      id="code"
                      value={data.code}
                      onChange={(e) => setData('code', e.target.value)}
                      className={`mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ${
                        errors.code ? 'border-red-300' : ''
                      }`}
                      placeholder="e.g., admin, moderator, user"
                      required
                    />
                    {errors.code && (
                      <p className="mt-1 text-sm text-red-600">{errors.code}</p>
                    )}
                    <p className="mt-1 text-sm text-gray-500">
                      A unique identifier for this role. Use lowercase letters, numbers, and hyphens only.
                    </p>
                  </div>

                  <div>
                    <label htmlFor="name" className="block text-sm font-medium text-gray-700">
                      Name <span className="text-red-500">*</span>
                    </label>
                    <input
                      type="text"
                      name="name"
                      id="name"
                      value={data.name}
                      onChange={(e) => setData('name', e.target.value)}
                      className={`mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ${
                        errors.name ? 'border-red-300' : ''
                      }`}
                      placeholder="e.g., Administrator, Moderator, Regular User"
                      required
                    />
                    {errors.name && (
                      <p className="mt-1 text-sm text-red-600">{errors.name}</p>
                    )}
                    <p className="mt-1 text-sm text-gray-500">
                      A human-readable name for this role.
                    </p>
                  </div>

                  <div>
                    <label htmlFor="description" className="block text-sm font-medium text-gray-700">
                      Description
                    </label>
                    <textarea
                      name="description"
                      id="description"
                      rows={3}
                      value={data.description}
                      onChange={(e) => setData('description', e.target.value)}
                      className={`mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md ${
                        errors.description ? 'border-red-300' : ''
                      }`}
                      placeholder="Describe what this role can do..."
                    />
                    {errors.description && (
                      <p className="mt-1 text-sm text-red-600">{errors.description}</p>
                    )}
                    <p className="mt-1 text-sm text-gray-500">
                      Optional description explaining the purpose and permissions of this role.
                    </p>
                  </div>
                </div>

                <div className="flex justify-end space-x-3">
                  <Link
                    href={route('admin.user-roles.index')}
                    className="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                  >
                    Cancel
                  </Link>
                  <button
                    type="submit"
                    disabled={processing}
                    className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 disabled:opacity-50"
                  >
                    {processing ? 'Creating...' : 'Create User Role'}
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </AdminLayout>
  );
}

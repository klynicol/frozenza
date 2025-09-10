import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import AdminLayout from '@/Layouts/AdminLayout';
import { PencilIcon, TrashIcon, PlusIcon, FunnelIcon, EyeIcon } from '@heroicons/react/24/outline';
import Pagination from '@/Components/Pagination';

export default function Index({ roles, filters }) {
  const [filterForm, setFilterForm] = useState({
    search: filters.search || '',
  });
  const [showFilters, setShowFilters] = useState(Object.values(filters).some(Boolean));

  const handleFilterChange = (e) => {
    const { name, value } = e.target;
    setFilterForm((prev) => ({
      ...prev,
      [name]: value,
    }));
  };

  const applyFilters = (e) => {
    e.preventDefault();
    router.get(route('admin.user-roles.index'), filterForm);
  };

  const resetFilters = () => {
    setFilterForm({
      search: '',
    });
    router.get(route('admin.user-roles.index'));
  };

  const handleDelete = (id) => {
    if (confirm('Are you sure you want to delete this user role?')) {
      router.delete(route('admin.user-roles.destroy', id));
    }
  };

  return (
    <AdminLayout>
      <Head title="Manage User Roles" />

      <div className="py-6">
        <div className="mx-auto sm:px-6 lg:px-8">
          <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div className="p-6 bg-white border-b border-gray-200">
              <div className="flex justify-between items-center mb-6">
                <h1 className="text-2xl font-semibold text-gray-900">User Roles</h1>
                <div className="flex space-x-2">
                  <button
                    onClick={() => setShowFilters(!showFilters)}
                    className="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
                  >
                    <FunnelIcon className="h-4 w-4 mr-1" />
                    {showFilters ? 'Hide Filters' : 'Show Filters'}
                  </button>
                  <Link
                    href={route('admin.user-roles.create')}
                    className="inline-flex items-center px-3 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700"
                  >
                    <PlusIcon className="h-4 w-4 mr-1" />
                    New User Role
                  </Link>
                </div>
              </div>

              {showFilters && (
                <div className="mb-6 p-4 bg-gray-50 rounded-md">
                  <form onSubmit={applyFilters}>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                      <div>
                        <label htmlFor="search" className="block text-sm font-medium text-gray-700">
                          Search
                        </label>
                        <input
                          type="text"
                          name="search"
                          id="search"
                          value={filterForm.search}
                          onChange={handleFilterChange}
                          className="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          placeholder="Search by name, code, or description"
                        />
                      </div>
                      <div className="flex items-end space-x-2">
                        <button
                          type="submit"
                          className="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                          Apply Filters
                        </button>
                        <button
                          type="button"
                          onClick={resetFilters}
                          className="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                          Reset
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              )}

              <div className="overflow-x-auto">
                <table className="min-w-full divide-y divide-gray-200">
                  <thead className="bg-gray-50">
                    <tr>
                      <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                      </th>
                      <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Code
                      </th>
                      <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Description
                      </th>
                      <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Users Count
                      </th>
                      <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Created
                      </th>
                      <th scope="col" className="relative px-6 py-3">
                        <span className="sr-only">Actions</span>
                      </th>
                    </tr>
                  </thead>
                  <tbody className="bg-white divide-y divide-gray-200">
                    {roles.data.length > 0 ? (
                      roles.data.map((role) => (
                        <tr key={role.id}>
                          <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {role.name}
                          </td>
                          <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                              {role.code}
                            </span>
                          </td>
                          <td className="px-6 py-4 text-sm text-gray-500">
                            {role.description || <span className="text-gray-400 italic">No description</span>}
                          </td>
                          <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <span className="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                              {role.users_count} user{role.users_count !== 1 ? 's' : ''}
                            </span>
                          </td>
                          <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {new Date(role.created_at).toLocaleDateString()}
                          </td>
                          <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div className="flex justify-end space-x-2">
                              <Link
                                href={route('admin.user-roles.show', role.id)}
                                className="text-indigo-600 hover:text-indigo-900"
                                title="View Details"
                              >
                                <EyeIcon className="h-5 w-5" />
                              </Link>
                              <Link
                                href={route('admin.user-roles.edit', role.id)}
                                className="text-indigo-600 hover:text-indigo-900"
                                title="Edit"
                              >
                                <PencilIcon className="h-5 w-5" />
                              </Link>
                              <button
                                onClick={() => handleDelete(role.id)}
                                className="text-red-600 hover:text-red-900"
                                title="Delete"
                                disabled={role.users_count > 0}
                              >
                                <TrashIcon className={`h-5 w-5 ${role.users_count > 0 ? 'opacity-50 cursor-not-allowed' : ''}`} />
                              </button>
                            </div>
                          </td>
                        </tr>
                      ))
                    ) : (
                      <tr>
                        <td colSpan="6" className="px-6 py-4 text-center text-sm text-gray-500">
                          No user roles found.
                        </td>
                      </tr>
                    )}
                  </tbody>
                </table>
              </div>

              <div className="mt-6">
                <Pagination links={roles.links} />
              </div>
            </div>
          </div>
        </div>
      </div>
    </AdminLayout>
  );
}

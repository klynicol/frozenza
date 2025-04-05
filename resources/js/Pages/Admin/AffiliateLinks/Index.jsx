import React, { useState } from 'react';
import { Head, Link, router } from '@inertiajs/react';
import AdminLayout from '@/Layouts/AdminLayout';
import { PencilIcon, TrashIcon, PlusIcon, FunnelIcon } from '@heroicons/react/24/outline';
import Pagination from '@/Components/Pagination';
import MultiLevelPizzaDropdown from '@/Components/MultiLevelPizzaDropdown';

export default function Index({ links, filters, pizzas }) {
  const [filterForm, setFilterForm] = useState({
    pizza_id: filters.pizza_id || '',
    vendor: filters.vendor || '',
  });
  const [showFilters, setShowFilters] = useState(Object.values(filters).some(Boolean));

  const handleFilterChange = (e) => {
    const { name, value } = e.target;
    setFilterForm((prev) => ({
      ...prev,
      [name]: value,
    }));
  };

  const handlePizzaChange = (pizzaId) => {
    setFilterForm((prev) => ({
      ...prev,
      pizza_id: pizzaId || '',
    }));
  };

  const applyFilters = (e) => {
    e.preventDefault();
    router.get(route('admin.affiliate-links.index'), filterForm);
  };

  const resetFilters = () => {
    setFilterForm({
      pizza_id: '',
      vendor: '',
    });
    router.get(route('admin.affiliate-links.index'));
  };

  const handleDelete = (id) => {
    if (confirm('Are you sure you want to delete this affiliate link?')) {
      router.delete(route('admin.affiliate-links.destroy', id));
    }
  };

  return (
    <AdminLayout>
      <Head title="Manage Affiliate Links" />

      <div className="py-6">
        <div className="mx-auto sm:px-6 lg:px-8">
          <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div className="p-6 bg-white border-b border-gray-200">
              <div className="flex justify-between items-center mb-6">
                <h1 className="text-2xl font-semibold text-gray-900">Affiliate Links</h1>
                <div className="flex space-x-2">
                  <button
                    onClick={() => setShowFilters(!showFilters)}
                    className="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"
                  >
                    <FunnelIcon className="h-4 w-4 mr-1" />
                    {showFilters ? 'Hide Filters' : 'Show Filters'}
                  </button>
                  <Link
                    href={route('admin.affiliate-links.create')}
                    className="inline-flex items-center px-3 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700"
                  >
                    <PlusIcon className="h-4 w-4 mr-1" />
                    New Affiliate Link
                  </Link>
                </div>
              </div>

              {showFilters && (
                <div className="mb-6 p-4 bg-gray-50 rounded-md">
                  <form onSubmit={applyFilters}>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                      <div>
                        <label htmlFor="pizza_id" className="block text-sm font-medium text-gray-700">
                          Pizza
                        </label>
                        <MultiLevelPizzaDropdown
                          pizzas={pizzas}
                          selectedPizzaId={filterForm.pizza_id}
                          onChange={handlePizzaChange}
                          placeholder="All Pizzas"
                          className="mt-1"
                        />
                      </div>
                      <div>
                        <label htmlFor="vendor" className="block text-sm font-medium text-gray-700">
                          Vendor
                        </label>
                        <input
                          type="text"
                          name="vendor"
                          id="vendor"
                          value={filterForm.vendor}
                          onChange={handleFilterChange}
                          className="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                          placeholder="Enter vendor name"
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
                        Pizza
                      </th>
                      <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Vendor
                      </th>
                      <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        URL
                      </th>
                      <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                      </th>
                      <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Order
                      </th>
                      <th scope="col" className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Commission Rate
                      </th>
                      <th scope="col" className="relative px-6 py-3">
                        <span className="sr-only">Actions</span>
                      </th>
                    </tr>
                  </thead>
                  <tbody className="bg-white divide-y divide-gray-200">
                    {links.data.length > 0 ? (
                      links.data.map((link) => (
                        <tr key={link.id}>
                          <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {link.pizza.name}
                            <div className="text-xs text-gray-500">({link.pizza.brand?.name})</div>
                          </td>
                          <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {link.vendor_name}
                            {link.description && <div className="text-xs italic">{link.description}</div>}
                          </td>
                          <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <a 
                              href={link.url} 
                              target="_blank" 
                              rel="noopener noreferrer"
                              className="text-indigo-600 hover:text-indigo-900 truncate max-w-xs block"
                            >
                              {link.url.length > 40 ? `${link.url.substring(0, 40)}...` : link.url}
                            </a>
                          </td>
                          <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <span className={`px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${
                              link.is_active 
                                ? 'bg-green-100 text-green-800' 
                                : 'bg-red-100 text-red-800'
                            }`}>
                              {link.is_active ? 'Active' : 'Inactive'}
                            </span>
                          </td>
                          <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {link.display_order}
                          </td>
                          <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {link.commission_rate ? `${link.commission_rate}%` : 'N/A'}
                          </td>
                          <td className="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div className="flex justify-end space-x-2">
                              <Link
                                href={route('admin.affiliate-links.edit', link.id)}
                                className="text-indigo-600 hover:text-indigo-900"
                              >
                                <PencilIcon className="h-5 w-5" />
                              </Link>
                              <button
                                onClick={() => handleDelete(link.id)}
                                className="text-red-600 hover:text-red-900"
                              >
                                <TrashIcon className="h-5 w-5" />
                              </button>
                            </div>
                          </td>
                        </tr>
                      ))
                    ) : (
                      <tr>
                        <td colSpan="7" className="px-6 py-4 text-center text-sm text-gray-500">
                          No affiliate links found.
                        </td>
                      </tr>
                    )}
                  </tbody>
                </table>
              </div>

              <div className="mt-6">
                <Pagination links={links.links} />
              </div>
            </div>
          </div>
        </div>
      </div>
    </AdminLayout>
  );
} 
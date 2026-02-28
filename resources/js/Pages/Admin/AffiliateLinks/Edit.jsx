import React from 'react';
import { Head, Link, router } from '@inertiajs/react';
import AdminLayout from '@/Layouts/AdminLayout';
import Form from './Form';

export default function Edit({ affiliateLink, pizzas, affiliates = [] }) {
  const vendorName = affiliateLink.vendor_name || affiliateLink.affiliate?.name || 'Affiliate Link';
  return (
    <AdminLayout>
      <Head title={`Edit Affiliate Link - ${vendorName}`} />

      <div className="py-6">
        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div className="flex items-center justify-between mb-6">
            <h1 className="text-2xl font-semibold text-gray-900">
              Edit Affiliate Link - {vendorName}
            </h1>
            <Link
              href={route('admin.affiliate-links.index')}
              className="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 active:bg-gray-300 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition"
            >
              Back to List
            </Link>
          </div>

          <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div className="p-6 bg-white border-b border-gray-200">
              <Form
                affiliateLink={affiliateLink}
                pizzas={pizzas}
                affiliates={affiliates}
                submitLabel="Update"
                onCancel={() => router.get(route('admin.affiliate-links.index'))}
              />
            </div>
          </div>
        </div>
      </div>
    </AdminLayout>
  );
} 
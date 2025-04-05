import React from 'react';
import {
  ShoppingCartIcon,
  InstacartIcon,
  AmazonIcon,
  WalmartIcon
} from '@/Components/Icons';

const icons = {
  Instacart: InstacartIcon,
  Amazon: AmazonIcon,
  Walmart: WalmartIcon
}

export default function AffiliateLinks({ affiliateLinks }) {
  if (!affiliateLinks || affiliateLinks.length === 0) {
    return null;
  }

  const renderIcon = (link) => {
    const className = 'h-4.5 w-4.5 mr-2 text-indigo-600';
    if (icons[link.vendor_name]) {
      const Icon = icons[link.vendor_name];
      return <Icon className={className} />;
    }
    return null;
  }

  return (
    <div className="mt-4 bg-white rounded-lg shadow-sm p-3">
      <div className="flex items-center justify-between border-b border-gray-200 pb-1.5 mb-2">
        <h2 className="text-sm font-semibold flex items-center">
          <ShoppingCartIcon className="h-3.5 w-3.5 mr-1 text-indigo-600" />
          Where to Buy
        </h2>
      </div>

      <div className="grid grid-cols-1 sm:grid-cols-2 gap-1.5">
        {affiliateLinks.map((link) => (
          <div key={link.id} className="flex items-center justify-between border border-gray-100 rounded px-2 py-1.5 hover:bg-gray-50">
            {renderIcon(link)}
            <div className="flex-1">
              <div className="font-medium text-gray-900 text-sm">{link.vendor_name}</div>
              {link.description && (
                <div className="text-xs text-gray-500 -mt-0.5">{link.description}</div>
              )}
            </div>
            <a
              href={link.url}
              target="_blank"
              rel="noopener noreferrer"
              className="ml-1 px-2 py-1.5 text-xs font-medium rounded text-white bg-indigo-600 hover:bg-indigo-700 whitespace-nowrap"
            >
              Shop
            </a>
          </div>
        ))}
      </div>

      <div className="mt-1.5 text-[10px] text-gray-400 italic">
        *As an affiliate, we earn commissions from qualifying purchases.
      </div>
    </div>
  );
} 
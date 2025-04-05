import React from 'react';
import { Link } from '@inertiajs/react';

export default function Pagination({ links }) {
  // If there's only 1 page, don't show pagination
  if (links.length <= 3) {
    return null;
  }

  return (
    <div className="flex items-center justify-center my-4">
      <nav className="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
        {links.map((link, index) => {
          // Skip the "Next" and "Previous" labels in the middle 
          // They're already included at the beginning and end
          if ((index === 1 && link.label === 'Previous') || 
              (index === links.length - 2 && link.label === 'Next')) {
            return null;
          }

          // Determine if this is a previous or next link
          const isPrevious = link.label.includes('Previous');
          const isNext = link.label.includes('Next');

          return (
            <React.Fragment key={index}>
              {link.url === null ? (
                // Disabled link (current page or disabled prev/next)
                <span
                  className={`${
                    link.active
                      ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                      : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'
                  } relative inline-flex items-center px-4 py-2 border text-sm font-medium ${
                    isPrevious ? 'rounded-l-md' : ''
                  } ${isNext ? 'rounded-r-md' : ''}`}
                  dangerouslySetInnerHTML={{ __html: link.label }}
                />
              ) : (
                // Active link
                <Link
                  href={link.url}
                  className={`${
                    link.active
                      ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600'
                      : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'
                  } relative inline-flex items-center px-4 py-2 border text-sm font-medium ${
                    isPrevious ? 'rounded-l-md' : ''
                  } ${isNext ? 'rounded-r-md' : ''}`}
                  dangerouslySetInnerHTML={{ __html: link.label }}
                />
              )}
            </React.Fragment>
          );
        })}
      </nav>
    </div>
  );
} 
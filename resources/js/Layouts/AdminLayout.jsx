import React, { useState } from 'react';
import { Link, usePage } from '@inertiajs/react';
import {
  Bars3Icon,
  XMarkIcon,
  HomeIcon,
  UserGroupIcon,
  LinkIcon,
  DocumentTextIcon,
  ShoppingBagIcon,
  TagIcon,
  ChartBarIcon,
  Cog6ToothIcon,
  ArrowRightOnRectangleIcon,
  ShieldCheckIcon,
  PencilSquareIcon,
} from '@heroicons/react/24/outline';
import ApplicationLogo from '@/Components/ApplicationLogo';
import Dropdown from '@/Components/Dropdown';
import NavLink from '@/Components/NavLink';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink';
import MetaTags from '@/Components/SEO/MetaTags';

export default function AdminLayout({ children, header, title }) {
  const { auth } = usePage().props;
  const [sidebarOpen, setSidebarOpen] = useState(false);

  const navigation = [
    { name: 'Dashboard', href: route('admin.dashboard'), icon: HomeIcon, current: route().current('admin.dashboard') },
    { name: 'Pizzas', href: '#', icon: ShoppingBagIcon, current: false },
    { name: 'Brands', href: '#', icon: TagIcon, current: false },
    { name: 'Reviews', href: '#', icon: DocumentTextIcon, current: false },
    { name: 'Blogs', href: route('admin.blogs.index'), icon: PencilSquareIcon, current: route().current('admin.blogs.*') },
    { name: 'Users', href: '#', icon: UserGroupIcon, current: false },
    { name: 'User Roles', href: route('admin.user-roles.index'), icon: ShieldCheckIcon, current: route().current('admin.user-roles.*') },
    { name: 'Affiliate Links', href: route('admin.affiliate-links.index'), icon: LinkIcon, current: route().current('admin.affiliate-links.*') },
    { name: 'Analytics', href: '#', icon: ChartBarIcon, current: false },
    { name: 'Settings', href: '#', icon: Cog6ToothIcon, current: false },
  ];

  return (
    <div className="min-h-screen bg-gray-100">
      <MetaTags title={title || 'Admin Panel'} />
      
      {/* Mobile sidebar */}
      <div
        className={`fixed inset-0 z-40 lg:hidden ${
          sidebarOpen ? 'block' : 'hidden'
        }`}
        onClick={() => setSidebarOpen(false)}
      >
        <div className="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
        <div className="fixed inset-y-0 left-0 flex max-w-xs w-full bg-white">
          <div className="relative flex-1 flex flex-col max-w-xs w-full bg-white">
            <div className="absolute top-0 right-0 -mr-12 pt-2">
              <button
                type="button"
                className="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                onClick={() => setSidebarOpen(false)}
              >
                <XMarkIcon className="h-6 w-6 text-white" aria-hidden="true" />
              </button>
            </div>
            <div className="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
              <div className="flex-shrink-0 flex items-center px-4">
                <Link href="/">
                  <ApplicationLogo className="h-8 w-auto" />
                </Link>
                <span className="ml-2 text-xl font-semibold text-gray-900">Admin Panel</span>
              </div>
              <nav className="mt-5 px-2 space-y-1">
                {navigation.map((item) => (
                  <Link
                    key={item.name}
                    href={item.href}
                    className={`${
                      item.current
                        ? 'bg-gray-100 text-gray-900'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                    } group flex items-center px-2 py-2 text-base font-medium rounded-md`}
                  >
                    <item.icon
                      className={`${
                        item.current ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500'
                      } mr-4 flex-shrink-0 h-6 w-6`}
                      aria-hidden="true"
                    />
                    {item.name}
                  </Link>
                ))}
              </nav>
            </div>
            <div className="flex-shrink-0 flex border-t border-gray-200 p-4">
              <Dropdown>
                <Dropdown.Trigger>
                  <div className="flex items-center">
                    <div className="flex-shrink-0">
                      <div className="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white">
                        {auth.user.name.charAt(0).toUpperCase()}
                      </div>
                    </div>
                    <div className="ml-3">
                      <p className="text-base font-medium text-gray-700 group-hover:text-gray-900">
                        {auth.user.name}
                      </p>
                      <p className="text-sm font-medium text-gray-500 group-hover:text-gray-700">
                        Admin
                      </p>
                    </div>
                  </div>
                </Dropdown.Trigger>

                <Dropdown.Content>
                  <Dropdown.Link href={route('profile.edit')}>
                    Profile
                  </Dropdown.Link>
                  <Dropdown.Link href={route('logout')} method="post" as="button">
                    Log Out
                  </Dropdown.Link>
                </Dropdown.Content>
              </Dropdown>
            </div>
          </div>
        </div>
      </div>

      {/* Static sidebar for desktop */}
      <div className="hidden lg:flex lg:w-64 lg:flex-col lg:fixed lg:inset-y-0">
        <div className="flex-1 flex flex-col min-h-0 bg-white border-r border-gray-200">
          <div className="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
            <div className="flex items-center flex-shrink-0 px-4">
              <Link href="/">
                <ApplicationLogo className="h-8 w-auto" />
              </Link>
              <span className="ml-2 text-xl font-semibold text-gray-900">Admin Panel</span>
            </div>
            <nav className="mt-5 flex-1 px-2 bg-white space-y-1">
              {navigation.map((item) => (
                <Link
                  key={item.name}
                  href={item.href}
                  className={`${
                    item.current
                      ? 'bg-gray-100 text-gray-900'
                      : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                  } group flex items-center px-2 py-2 text-sm font-medium rounded-md`}
                >
                  <item.icon
                    className={`${
                      item.current ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500'
                    } mr-3 flex-shrink-0 h-5 w-5`}
                    aria-hidden="true"
                  />
                  {item.name}
                </Link>
              ))}
            </nav>
          </div>
          <div className="flex-shrink-0 flex border-t border-gray-200 p-4">
            <div className="flex items-center w-full">
              <div className="flex-shrink-0">
                <div className="h-9 w-9 rounded-full bg-indigo-600 flex items-center justify-center text-white">
                  {auth.user.name.charAt(0).toUpperCase()}
                </div>
              </div>
              <div className="ml-3 flex-1">
                <p className="text-sm font-medium text-gray-700 group-hover:text-gray-900">
                  {auth.user.name}
                </p>
                <div className="flex items-center">
                  <Link 
                    href={route('profile.edit')} 
                    className="text-xs font-medium text-gray-500 hover:text-indigo-600"
                  >
                    View profile
                  </Link>
                  <span className="mx-1 text-gray-500">·</span>
                  <Link 
                    href={route('logout')} 
                    method="post" 
                    as="button"
                    className="text-xs font-medium text-gray-500 hover:text-indigo-600"
                  >
                    Logout
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Main content area */}
      <div className="lg:pl-64 flex flex-col">
        <div className="sticky top-0 z-10 flex-shrink-0 flex h-16 bg-white shadow">
          <button
            type="button"
            className="px-4 border-r border-gray-200 text-gray-500 lg:hidden"
            onClick={() => setSidebarOpen(true)}
          >
            <Bars3Icon className="h-6 w-6" aria-hidden="true" />
          </button>
          <div className="flex-1 px-4 flex justify-between">
            <div className="flex-1 flex items-center">
              {header && (
                <h1 className="text-xl font-semibold text-gray-900">{header}</h1>
              )}
            </div>
            <div className="ml-4 flex items-center md:ml-6">
              <Link
                href={route('home')}
                className="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
              >
                <span className="sr-only">View site</span>
                <ArrowRightOnRectangleIcon className="h-6 w-6" aria-hidden="true" />
              </Link>
            </div>
          </div>
        </div>

        <main className="flex-1">
          <div className="pt-1">
            {children}
          </div>
        </main>
      </div>
    </div>
  );
} 
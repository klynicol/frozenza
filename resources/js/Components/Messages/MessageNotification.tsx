import React from 'react';
import { Transition } from '@headlessui/react';
import { XMarkIcon } from '@heroicons/react/24/outline';

interface MessageNotificationProps {
    message: string;
    sender: string;
    isVisible: boolean;
    onClose: () => void;
}

export default function MessageNotification({ message, sender, isVisible, onClose }: MessageNotificationProps) {
    return (
        <div className="fixed bottom-4 right-4 z-50">
            <Transition
                show={isVisible}
                enter="transform ease-out duration-300 transition"
                enterFrom="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
                enterTo="translate-y-0 opacity-100 sm:translate-x-0"
                leave="transition ease-in duration-100"
                leaveFrom="opacity-100"
                leaveTo="opacity-0"
            >
                <div className="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto">
                    <div className="p-4">
                        <div className="flex items-start">
                            <div className="flex-1">
                                <p className="text-sm font-medium text-gray-900">
                                    New message from {sender}
                                </p>
                                <p className="mt-1 text-sm text-gray-500">
                                    {message.length > 50 ? message.substring(0, 50) + '...' : message}
                                </p>
                            </div>
                            <button
                                onClick={onClose}
                                className="ml-4 text-gray-400 hover:text-gray-500 focus:outline-none"
                            >
                                <XMarkIcon className="h-5 w-5" />
                            </button>
                        </div>
                    </div>
                </div>
            </Transition>
        </div>
    );
} 
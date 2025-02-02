import React from 'react';
import MainLayout from '@/Layouts/MainLayout';
import { Link } from '@inertiajs/react';
import type { User } from '@/types/models';
import type { PageProps } from '@/types/props';

interface Message {
    id: string;
    message: string;
    created_at: string;
    read_at: string | null;
    from_user: User;
    to_user: User;
}

interface MessagesIndexProps extends PageProps {
    conversations: {
        [key: string]: Message[];
    };
}

export default function MessagesIndex({ conversations, meta, auth }: MessagesIndexProps) {
    return (
        <MainLayout meta={meta} auth={auth}>
            <div className="max-w-4xl mx-auto">
                <h1 className="text-2xl font-bold mb-6">Your Messages</h1>
                <div className="bg-white rounded-lg shadow divide-y">
                    {Object.entries(conversations).map(([userId, messages]) => {
                        const otherUser = messages[0].from_user.id === userId 
                            ? messages[0].from_user 
                            : messages[0].to_user;
                        const unreadCount = messages.filter(m => !m.read_at && m.from_user.id === userId).length;

                        return (
                            <Link
                                key={userId}
                                href={`/messages/${userId}`}
                                className="block p-4 hover:bg-gray-50"
                            >
                                <div className="flex justify-between items-start">
                                    <div>
                                        <h3 className="font-medium">{otherUser.name}</h3>
                                        <p className="text-sm text-gray-500 mt-1">
                                            {messages[0].message.length > 100
                                                ? messages[0].message.substring(0, 100) + '...'
                                                : messages[0].message}
                                        </p>
                                    </div>
                                    {unreadCount > 0 && (
                                        <span className="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {unreadCount}
                                        </span>
                                    )}
                                </div>
                            </Link>
                        );
                    })}
                </div>
            </div>
        </MainLayout>
    );
} 
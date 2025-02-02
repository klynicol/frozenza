import React, { useEffect, useState } from 'react';
import MainLayout from '@/Layouts/MainLayout';
import { useForm } from '@inertiajs/react';
import type { User } from '@/types/models';
import type { PageProps } from '@/types/props';

interface Message {
    id: string;
    message: string;
    from_user_id: string;
    created_at: string;
    read_at: string | null;
    from_user: User;
    to_user: User;
}

interface MessagesShowProps extends PageProps {
    otherUser: User;
    messages: Message[];
}

export default function MessagesShow({ otherUser, messages: initialMessages, meta, auth }: MessagesShowProps) {
    const [messages, setMessages] = useState(initialMessages);
    const { data, setData, post, processing, reset } = useForm({
        message: '',
    });

    useEffect(() => {
        const channel = window.Echo.private(`messages.${auth.user?.id}`);
        
        channel.listen('MessageSent', (e: { message: Message }) => {
            if (e.message.from_user_id === otherUser.id) {
                setMessages(prev => [e.message, ...prev]);
            }
        });

        return () => {
            channel.stopListening('MessageSent');
        };
    }, [otherUser.id, auth.user?.id]);

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        post(`/messages/${otherUser.id}`, {
            onSuccess: () => {
                reset('message');
            },
        });
    };

    return (
        <MainLayout meta={meta} auth={auth}>
            <div className="max-w-4xl mx-auto">
                <div className="bg-white rounded-lg shadow">
                    <div className="border-b px-4 py-3">
                        <h2 className="text-lg font-medium">Chat with {otherUser.name}</h2>
                    </div>
                    
                    <div className="h-[500px] overflow-y-auto p-4 flex flex-col-reverse">
                        <div className="space-y-4">
                            {messages.map((message) => (
                                <div
                                    key={message.id}
                                    className={`flex ${message.from_user.id === auth.user?.id ? 'justify-end' : 'justify-start'}`}
                                >
                                    <div
                                        className={`max-w-[70%] rounded-lg px-4 py-2 ${
                                            message.from_user.id === auth.user?.id
                                                ? 'bg-blue-500 text-white'
                                                : 'bg-gray-100'
                                        }`}
                                    >
                                        <p>{message.message}</p>
                                        <p className="text-xs mt-1 opacity-70">
                                            {new Date(message.created_at).toLocaleString()}
                                        </p>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>

                    <div className="border-t p-4">
                        <form onSubmit={handleSubmit}>
                            <div className="flex gap-2">
                                <input
                                    type="text"
                                    value={data.message}
                                    onChange={e => setData('message', e.target.value)}
                                    className="flex-1 rounded-lg border-gray-300"
                                    placeholder="Type your message..."
                                />
                                <button
                                    type="submit"
                                    disabled={processing || !data.message.trim()}
                                    className="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50"
                                >
                                    Send
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </MainLayout>
    );
} 
import React, { useEffect, useState } from 'react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';
import MetaTags from '@/Components/SEO/MetaTags';
import MessageNotification from '@/Components/Messages/MessageNotification';
import type { MetaProps } from '@/types/props';
import type { Message } from '@/types/models';

interface MainLayoutProps {
    children: React.ReactNode;
    meta: MetaProps & {
        canonicalUrl?: string;
        imageUrl?: string;
    };
    auth: {
        user: {
            id: string;
        } | null;
    };
}

export default function MainLayout({ children, meta, auth }: MainLayoutProps) {
    const [notification, setNotification] = useState<{
        message: string;
        sender: string;
        isVisible: boolean;
    }>({
        message: '',
        sender: '',
        isVisible: false,
    });

    useEffect(() => {
        if (auth.user) {
            const channel = window.Echo.private(`messages.${auth.user.id}`);
            
            channel.listen('MessageSent', (e: { message: Message }) => {
                setNotification({
                    message: e.message.message,
                    sender: e.message.from_user.name,
                    isVisible: true,
                });

                setTimeout(() => {
                    setNotification(prev => ({ ...prev, isVisible: false }));
                }, 5000);
            });

            return () => {
                channel.stopListening('MessageSent');
            };
        }
    }, [auth.user]);

    return (
        <>
            <MetaTags {...meta} />
            <div className="min-h-screen bg-gray-100">
                <Navbar />
                <main className="container mx-auto px-4 py-8">
                    {children}
                </main>
                <Footer />
            </div>
            <MessageNotification
                {...notification}
                onClose={() => setNotification(prev => ({ ...prev, isVisible: false }))}
            />
        </>
    );
} 
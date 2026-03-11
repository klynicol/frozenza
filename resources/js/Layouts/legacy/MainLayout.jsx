import React, { useEffect, useState } from 'react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';
import MetaTags from '@/Components/SEO/MetaTags';
import MessageNotification from '@/Components/Messages/MessageNotification';
import PromotionalBanner from '@/Components/PromotionalBanner';

export default function MainLayout({ children, meta = {}, auth, showPromotionalBanner = true }) {
    const [notification, setNotification] = useState({
        message: '',
        sender: '',
        isVisible: false,
    });

    // useEffect(() => {
    //     if (auth.user) {
    //         const channel = window.Echo.private(`messages.${auth.user.id}`);
            
    //         channel.listen('MessageSent', (e) => {
    //             setNotification({
    //                 message: e.message.message,
    //                 sender: e.message.from_user.name,
    //                 isVisible: true,
    //             });

    //             setTimeout(() => {
    //                 setNotification(prev => ({ ...prev, isVisible: false }));
    //             }, 5000);
    //         });

    //         return () => {
    //             channel.stopListening('MessageSent');
    //         };
    //     }
    // }, [auth.user]);

    return (
        <div className="min-h-screen bg-gray-100">
            <MetaTags {...meta} />
            <Navbar auth={auth} />
            {showPromotionalBanner ? <PromotionalBanner auth={auth} /> : null}
            <main className="container mx-auto px-4 py-8">
                {children}
            </main>
            <Footer />
            <MessageNotification
                {...notification}
                onClose={() => setNotification(prev => ({ ...prev, isVisible: false }))}
            />
        </div>
    );
} 
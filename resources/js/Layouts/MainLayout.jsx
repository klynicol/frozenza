import React, { useEffect, useState } from 'react';
import Contexts from '@/lib/context';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';
import MetaTags from '@/Components/SEO/MetaTags';
import MessageNotification from '@/Components/Messages/MessageNotification';
import PromotionalBanner from '@/Components/PromotionalBanner';

const MainLayout = ({
    children,
    meta = {},
    auth,
    showPromotionalBanner = true
}) => {

    const [notification, setNotification] = useState({
        message: '',
        sender: '',
        isVisible: false,
    });

    return (
        <Contexts>
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
        </Contexts>
    );
}

export default MainLayout;

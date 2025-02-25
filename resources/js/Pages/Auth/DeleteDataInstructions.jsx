import React from 'react';
import MainLayout from '@/Layouts/MainLayout';

const DeleteDataInstructions = ({meta, auth}) => {
    return (
        <MainLayout meta={meta} auth={auth}>
            <div>
                <h1>Delete Data Instructions</h1>
                <p>To delete your data, please go to your user profile and click on the 'Delete Data' button.</p>
            </div>
        </MainLayout>
    );
};

export default DeleteDataInstructions;

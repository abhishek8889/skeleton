import { React, useState ,useCallback } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import Todo  from './Partials/Todo';

export default function Index({auth}) {

    const [tagList , setTagList] = useState(['one','two','thre']);
    

    const addTag = useCallback(() => {
        setTagList(() => [...tagList, 'new tag']);
    },[tagList]);

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">App settings</h2>}
        >
        <Head title="App settings" />

        <Todo tagList={tagList} addTag={addTag}></Todo>
        
        </AuthenticatedLayout>
    );
}
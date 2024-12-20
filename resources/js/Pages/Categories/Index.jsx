import { React, useState } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
// import DeleteUserForm from './Partials/DeleteUserForm';
import AddCategory from './Partials/Add';
import { Head } from '@inertiajs/react';
import LinkBox from '../../Components/LinkBox';
import Table from '@/Components/Table/Table';


export default function Index({ auth, categories,mustVerifyEmail, status, type, parent_category }) {

    const [show, setShow] = useState();
    console.log(categories);
    const [tagHeader,setTagHeader] = useState([
        {
            key: 'image',
            type: 'image', // or any type you need
            title: 'Image Name', // or any title you need
        },
        {
            key: 'name',
            type: 'text',
            title: 'Title',
        },
        {
            key: 'parent_category',
            type: 'text',
            title: 'Parent Category',
        }
        
    ]);

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Categories</h2>}
        >
            <Head title="Categories" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    

                    {type === "add" ?
                         <LinkBox to="/categories" >Category List</LinkBox> :  
                            type === "list" ?
                                <LinkBox to="/category/add"> Add Category </LinkBox> 
                                    : null}

                    <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        {type === "add" ?

                            <AddCategory
                                className="max-w-xl"
                                parent_category={parent_category}
                            /> :
                            // <LinkBox >Add Category</LinkBox>
                            type === "list" ?
                                <Table 
                                    posts={categories}
                                    editRoute={(id) => ''} 
                                    deleteRoute={(id) => ''} 
                                    tagHeader={tagHeader}
                                />:
                                type === "update" ?
                                    <div>update</div> : null
                        }
                    </div>

                </div>
            </div>


            
        </AuthenticatedLayout>
    );
}

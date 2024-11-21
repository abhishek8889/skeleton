import { React, useState } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
// import DeleteUserForm from './Partials/DeleteUserForm';
import CreatePost from './Partials/Create';
import { Head } from '@inertiajs/react';
import LinkBox from '../../Components/LinkBox';
import Table from '@/Components/Table/Table';

export default function Index({ auth, mustVerifyEmail, status, type='' ,categories ,posts ,postDetail=[]}) {

    const [show, setShow] = useState();
    const [tagHeader,setTagHeader] = useState([
        'title',
        'slug',
        'short_name',
        'excerpt',
        'status'
    ]);

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Posts</h2>}
        >
            <Head title="Posts" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

                    {type === "create"  || type === "edit" ?
                         <LinkBox to={route('posts')} >Posts</LinkBox> :
                            type === "list" ?
                                <LinkBox to={route('posts.create')}> Add Posts </LinkBox>
                                    : null}



                    <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        {type === "create"  || type === "edit" ?
                            <CreatePost
                                className="max-w-xl"
                                categories={categories}
                                postDetail={postDetail}
                                type={type}
                            /> :
                            type === "list" ?
                                <Table 
                                    posts={posts}
                                    editRoute={(id) => route('posts.update',{id})} 
                                    deleteRoute={(id) => route('posts.remove',{id})} 
                                    tagHeader={tagHeader}
                                />
                                :
                                type === "update" ?
                                    <div>update</div> : null
                        }
                    </div>

                </div>
            </div>
        </AuthenticatedLayout>
    );
}

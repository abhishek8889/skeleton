import { React, useState } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
// import DeleteUserForm from './Partials/DeleteUserForm';
import AddCategory from './Partials/Add';
import { Head } from '@inertiajs/react';


export default function Index({ auth, mustVerifyEmail, status, type, parent_category }) {

    const [show, setShow] = useState();

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Categories</h2>}
        >
            <Head title="Categories" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    {/* <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        Here i will add categories:::
                    </div> */}

                    <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                        {type === "add" ?
                            <AddCategory
                                className="max-w-xl"
                                parent_category={parent_category}
                            /> :
                            type === "list" ?
                                <div>list</div> :
                                type === "update" ?
                                    <div>update</div> : null
                        }
                    </div>

                </div>
            </div>
        </AuthenticatedLayout>
    );
}

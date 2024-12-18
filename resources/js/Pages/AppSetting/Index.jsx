import { React, useState ,useCallback } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import Todo  from './Partials/Todo';
import FormBox from '@/Components/FormBox/FormBox';
export default function Index({auth}) {

    const [tagList , setTagList] = useState(['one','two','thre']);
    const FormParams = {
        url : '',
        method : 'POST',
        submitButton:{
            'title' : 'Submit',
            'className' : ''
        },
        coloumns : [ 
            {
                box:{
                    'className' : 'mb-1',
                    'id' : ''
                },
                label : {
                    'title' : 'Field Name',
                    'className' : 'text-gray-700 text-sm font-bold mb-2',
                    'id' : 'name',
                    'for' : 'name'
                },
                field:{
                    type : 'input',
                    params : {
                        'type' : 'text',
                        'className' : 'shadow appearance-none border rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline',
                        'id' : 'name',
                        'placeholder' : 'Enter field name'
                    },
                },

                // help : {
                //     'id' : 'emailHelp',
                //     'className' : 'text-gray-600 text-xs italic',
                //     'text' : "We'll never share your email with anyone else"
                // }
            },
            {
                box:{
                    'className' : 'mb-1',
                    'id' : ''
                },
                label : {
                    'title' : 'Field Type',
                    'className' : 'text-gray-700 text-sm font-bold mb-2',
                    'id' : 'field_type',
                    'for' : 'field_type'
                },
                field:{
                    type : 'select',
                    params : {
                        'className' : 'shadow appearance-none border rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline mb-2',
                        'id' : 'field_type',
                    },
                    options :[ 
                        {
                            'value' : 'text',
                            'text' : 'Text',
                        },
                        {
                            'value' : 'textarea',
                            'text' : 'Textarea',
                        },
                        {
                            'value' : 'checkbox',
                            'text' : 'Checkbox',
                        }
                    ]
                },
            }
        ]
    };

    // console.log(FormParams.coloumns);

    const addTag = useCallback(() => {
        setTagList(() => [...tagList, 'new tag']);
    },[tagList]);

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">App settings</h2>}
        >
        <Head title="App settings" />

        {/* <Todo tagList={tagList} addTag={addTag}></Todo> */}
        <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                       < FormBox  formParams={FormParams}/>
                    </div>
                </div>
            </div>
        
        </AuthenticatedLayout>
    );
}
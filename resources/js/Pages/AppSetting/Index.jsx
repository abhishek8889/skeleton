import { React, useState ,useCallback, useEffect } from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import FormBox from '@/Components/FormBox/FormBox';
import PrimaryButton from '@/Components/PrimaryButton';
import Table from '@/Components/Table/Table';



export default function Index({auth}) {
    const [showForm , setShowForm] = useState(false);
    const [showFormBtn , setShowFormBtn] = useState('Add new field');
    const [tagHeader ,setTagHeader] = useState([]);
    const [formParams , setFormParams] = useState({
            url : route('settings.create'),
            method : 'POST',
            submitButton:{
                'title' : 'Submit',
                'className' : ''
            },
            coloumns : [ 
                {
                    box:{
                        'className' : 'mb-1 mt-3',
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
                        name : 'name',
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
                        name : 'type',
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
        });

    const changeField = (val) => {
        let fieldTag = '';
        let fieldType = '';
        let fieldLabel = '';
        let fieldBoxClass = '';
        if(val == 'text'){
            fieldTag = 'input';
            fieldType = 'text';


        }else if(val == 'textarea'){
            fieldTag = 'textarea';
        }else if(val == 'checkbox'){
            fieldTag = 'input';
            fieldType = 'checkbox';
            fieldLabel = 'Check this if you agree.';
            fieldBoxClass = 'form-check';
        }

        const newField = {
            box:{
                'className' : 'mb-1',
                'id' : ''
            },
            label : {
                'title' : fieldLabel ? fieldLabel : 'Field Value' ,
                'className' : 'text-gray-700 text-sm font-bold mb-2',
                'id' : 'field_value',
                'for' : 'field_value'
            },
            field:{
                type : fieldTag ? fieldTag : '' ,
                name : 'value',
                params : {
                    'type' : fieldType ? fieldType : '',
                    'className' : fieldBoxClass ? fieldBoxClass : 'shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline',
                    'id' : 'field_value',
                    'placeholder' : 'Enter field value',
                },
            },

            // help : {
            //     'id' : 'emailHelp',
            //     'className' : 'text-gray-600 text-xs italic',
            //     'text' : "We'll never share your email with anyone else"
            // }
        }
    
      
        setFormParams((prev) => {
            const updatedColumns = [...prev.coloumns]; // Copy the existing `coloumns` array
        
            updatedColumns.splice(2, 0, newField); // Insert the new field at index 1 (second position)

            return {
                ...prev, // Keep all previous properties
                coloumns: updatedColumns, // Update the `coloumns` array with the new field inserted
            };
        });
    }

    const handleAddFormBtn = () => {
        setShowForm((prev) => {
            const newState = !prev;
            setShowFormBtn(newState ? "Remove form" : "Add new field");
            return newState;
        });
    }


    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">App settings</h2>}
        >
        <Head title="App settings" />
        <div className="py-12">
            <div className="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div className="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <PrimaryButton  onClick={handleAddFormBtn} className={formParams.submitButton?.className ?? ''}>
                    {showFormBtn ? showFormBtn : 'Add new field'}
                    </PrimaryButton>
                    { showForm && <FormBox  formParams={formParams} changeField={changeField} /> }
                    {/* {tagHeader  && (
                        <Table 
                            posts=''
                            editRoute={(id) => route('posts.edit',{id})} 
                            deleteRoute={(id) => route('posts.remove',{id})} 
                            tagHeader={tagHeader}
                        />
                    )} */}
                </div>
            </div>
        </div> 
        
        
        </AuthenticatedLayout>
    );
}
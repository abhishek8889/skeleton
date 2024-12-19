import { React, useEffect, useState } from 'react';
import PrimaryButton from '@/Components/PrimaryButton';


const FormBox = ({formParams ,changeField}) => {
    const [fieldTypeBox, setFieldTypeBox] = useState('');
    const [formData , setFormData] = useState({});
    const  handleSubmit = (e) => {
        e.preventDefault();

    }

    const handleInputChange = (e) => {
        formData.map(() => {
            if(e.target.name === formData.name){
                setFormData({...formData , [e.target.name] : e.target.value});
            }
        })
    }


    return (
        <div className="row">
            <form onSubmit={handleSubmit} >
                {
                    formParams.coloumns.map((form,index) => {
                        return (
                            <>
                                <div className={form.box.className ? form.box.className : 'form-group mb-3' } >
                                    {form.label &&  <label htmlFor={form.label.for} className={form.label.className}>{form.label.title}</label> }
                                    
                                    {/* Input box */}
                                    {form.field && form.field.type === 'input' && (
                                        <input 
                                            type={form.field.params.type} 
                                            className={form.field.params.className} 
                                            id={form.field.params.id} 
                                            placeholder={form.field.params?.placeholder ?? ''} 
                                            name={form.field.name ? form.field.name : ''}
                                            onChange={handleInputChange}
                                        />
                                    )}

                                    {/* Text area */}
                                    {form.field && form.field.type === 'textarea' && (
                                        <textarea 
                                            type={form.field.params.type} 
                                            className={form.field.params.className} 
                                            id={form.field.params.id} 
                                            placeholder={form.field.params?.placeholder ?? ''} 
                                            name={form.field.name ? form.field.name : ''}
                                            onChange={handleInputChange}
                                        />
                                    )}

                                   

                                    {/* Select box */}
                                    {form.field && form.field.type === 'select' && (
                                        <select 
                                            className={form.field.params.className} 
                                            id={form.field.params.id}
                                            name={form.field.name ? form.field.name : ''} 
                                            onChange={(e) => {
                                                changeField(e.target.value);
                                                handleInputChange(e);
                                            }}
                                        >
                                            {
                                                form.field.options && form.field.options.map((option) => {  
                                                    return <option value={option.value}>{option.text}</option>
                                                })
                                            }
                                        </select>
                                    )}
                                    {form.help && <small id={form.help.id} className={form.help.className}>{form.help.text}</small> }
                                    
                                </div>
                            </>
                        );
                    })
                }
                <PrimaryButton className={formParams.submitButton?.className ?? ''}>

                    {formParams.submitButton?.title ?? ''}

                </PrimaryButton>
            </form>
        </div>
    );
}

export default FormBox;
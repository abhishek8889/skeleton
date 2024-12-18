import { React, useEffect, useState } from 'react';
import PrimaryButton from '@/Components/PrimaryButton';


const FormBox = ({formParams}) => {
    const [fieldTypeBox, setFieldTypeBox] = useState('');
    return (
        <div className="row">
            <form>
                {
                    formParams.coloumns.map((form,index) => {
                        return (
                            <>
                                <div className={form.box.className ? form.box.className : 'form-group mb-3' } >
                                    {form.label &&  <label htmlFor={form.label.for} className={form.label.className}>{form.label.title}</label> }
                                    {form.field && form.field.type === 'input' && (
                                        <input 
                                            type={form.field.params.type} 
                                            className={form.field.params.className} 
                                            id={form.field.params.id} 
                                            placeholder={form.field.params?.placeholder ?? ''} 
                                        />
                                    )}
                                    {form.field && form.field.type === 'select' && (
                                        <select 
                                            className={form.field.params.className} 
                                            id={form.field.params.id}
                                            name={form.field.params.name ? form.field.params.name : ''} 
                                            // onChange={e}
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
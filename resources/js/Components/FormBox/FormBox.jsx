import { React, useEffect, useState ,useRef } from 'react';
import PrimaryButton from '@/Components/PrimaryButton';

import { ToastContainer, toast } from 'react-toastify';

const FormBox = ({formParams ,changeField}) => {
    const [formData  , setFormData] = useState(new FormData());
    const formRef = useRef(null); // Add a ref for the form

    const handleInputChange = (e) => {
        if (formData.has(e.target.name)) {
            formData.set(e.target.name, e.target.value);
        } else {
            formData.append(e.target.name, e.target.value);
        }
    }    
  

    const  handleSubmit = (e) => {
        e.preventDefault();
        axios({
            method: formParams.method?formParams.method:'POST',
            url: formParams.url?formParams.url:'',
            data: formData,
            headers: { 
                "Content-Type": "multipart/form-data" 
            },
        })
        .then(function (response) {
            if(response.data.status == 'success' && response.data.success == true){
                toast.success(`${response.data.message?response.data.message:'Success'}`, {
                    position: "top-right",
                    autoClose: 5000,
                    hideProgressBar: false,
                    closeOnClick: false,
                    pauseOnHover: true,
                    draggable: true,
                    progress: undefined,
                    theme: "light",
                })
                formRef.current.reset();
                setFormData(new FormData());
            }
        })
        .catch(function (response) {
            if(response.status == 400){
                if(response.response.data.type == 'validation'){
                    console.log(response.response.data.errors);
                }
            }
        });
    }


    return (
        <div className="row">
            <form ref={formRef}  onSubmit={handleSubmit} >
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
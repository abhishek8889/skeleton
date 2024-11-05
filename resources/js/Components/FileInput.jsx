import { forwardRef } from 'react';

export default forwardRef(function FileInput({ type = 'file', className = '', ...props }) {

    return (
        <input
            {...props}
            type={type}
            className={
                'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ' +
                className
            }
        />
    );
});

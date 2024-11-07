import { forwardRef, useEffect, useRef } from 'react';

export default forwardRef(function SelectBox({ className = '', isFocused = false, options, ...props }, ref) {
    const input = ref ? ref : useRef();

    // useEffect(() => {
    //     if (isFocused) {
    //         input.current.focus();
    //     }
    // }, []);

    return (
        <select
            {...props}
            className={
                'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm ' +
                className
            }
        >
        <option key="" value="Select Option">Select Option</option>
        {options.length > 0 ? (
            options.map((option) => (
                <option key={option.id} value={option.name}>
                    {option.name}
                </option>
            ))
        ) : (
            <option className="" value="" disabled>
                No data found
            </option>
        )}
        </select>
    );
});



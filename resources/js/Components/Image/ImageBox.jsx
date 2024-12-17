import { React } from 'react';


export default function ImageBox({boxClass,imgClass, ...props}) {
    return (
        <>
            <div className={boxClass}>
                <img  className={imgClass} src={props.src} alt={props.alt} />
            </div>
        </>
    );
}
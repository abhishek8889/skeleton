import { Link } from '@inertiajs/react'

const LinkBox = ({ value, className = '', children,to, ...props}) => {
    return (
        <Link  href={to} className={`block font-medium text-sm text-gray-700 ` + className} >
            {value ? value : children}
        </Link>
    );
}
export default LinkBox;
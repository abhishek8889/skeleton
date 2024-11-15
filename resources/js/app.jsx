import './bootstrap';
import '../css/app.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';
import { createRoot } from 'react-dom/client';
import { createInertiaApp ,usePage } from '@inertiajs/react';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';
const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.jsx`, import.meta.glob('./Pages/**/*.jsx')),
    setup({ el, App, props }) {
        const root = createRoot(el);


        root.render(<App {...props} />);
    },
    progress: {
        color: '#4B5563',
    },

});

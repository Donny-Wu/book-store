import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                //kool_form assets
                'resources/views/kool_form/css/bootstrap.min.css',
                'resources/views/kool_form/css/bootstrap-icons.css',
                'resources/views/kool_form/css/tooplate-kool-form-pack.css',

                'resources/views/kool_form/js/jquery.min.js',
                'resources/views/kool_form/js/bootstrap.bundle.min.js',
                'resources/views/kool_form/js/countdown.js',
                'resources/views/kool_form/js/init.js',
            ],
            refresh: true,
        }),
    ],
});

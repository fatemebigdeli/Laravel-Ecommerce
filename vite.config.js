import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { resolve } from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/admin/admin.scss',
                'resources/css/mds.bs.datetimepicker.style.css',
                'resources/js/admin/files/jquery.czMore-latest.js',
                'resources/js/admin/files/mds.bs.datetimepicker.js',
                'resources/js/admin/admin.js',
                'resources/scss/home/home.scss',
                'resources/js/home/home.js',

            ],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                // تنظیم مسیر خروجی برای CSS
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name.endsWith('.css')) {
                        return 'assets/css/[name][extname]';
                    }
                    if (assetInfo.name.endsWith('.js')) {
                        return 'assets/js/[name][extname]';
                    }
                    if (/\.(woff2?|eot|ttf|otf)$/.test(assetInfo.name)) {
                        return 'assets/fonts/[name][extname]';
                    }
                    return 'assets/[name]-[hash][extname]';
                },
                chunkFileNames: 'assets/js/[name].js',
                entryFileNames: 'assets/js/[name].js',
            }
        }
    }
});


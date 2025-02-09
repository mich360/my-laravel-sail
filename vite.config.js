import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    css: {
        postcss: false,  // PostCSSを無効化
        preprocessorOptions: {
            scss: {
                quietDeps: true, // 依存関係の警告を非表示にする
                additionalData: `@use 'bootstrap/scss/functions' as *; @use 'bootstrap/scss/mixins' as *; @use 'bootstrap/scss/variables' as *;`
            },
        },
    },
});

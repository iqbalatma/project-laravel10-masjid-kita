import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';



let css = [
    "resources/css/app.css",
];

let js = [
    "resources/js/app.js",
    "resourecs/js/pages/masters/subdistricts/index.js"
];
export default defineConfig({
    plugins: [
        laravel({
            input: css.concat(js),
            refresh: true,
        }),
    ],
});

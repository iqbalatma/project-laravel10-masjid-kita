import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

let css = ["resources/css/app.css"];

let js = [
    "resources/js/app.js",
    "resources/js/pages/masters/districts/index.js",
    "resources/js/pages/masters/subdistricts/index.js",
    "resources/js/pages/masters/villages/index.js",
    "resources/js/pages/masters/mosques/index.js",
    "resources/js/pages/masters/transaction-types/index.js",
    "resources/js/pages/user-managements/roles/index.js",
    "resources/js/pages/user-managements/users/index.js",
];
export default defineConfig({
    plugins: [
        laravel({
            input: css.concat(js),
            refresh: true,
        }),
    ],
});

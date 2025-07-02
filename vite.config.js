import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        host: "0.0.0.0", // Allow access from other devices on the network
        port: 5173, // Default Vite port
        strictPort: true, // Ensure the port is not used by another process
        hmr: {
            host: process.env.VITE_HMR_HOST || "localhost", // Use env var or fallback to localhost
        },
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
});

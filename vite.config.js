import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    server: {
        host: "0.0.0.0", // Allow access from other devices on the network
        port: 5173, // Default Vite port
        strictPort: true, // Ensure the port is not used by another process
        hmr: {
            host: "192.168.100.134", // Replace with your PC's IP address
        },
    },
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
    ],
});

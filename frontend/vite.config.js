import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [
    tailwindcss(), // Tailwind v4 plugin untuk Vite
  ],
  server: {
    host: "0.0.0.0", // Penting untuk Docker
    port: 5173,
    strictPort: true,
    watch: {
      usePolling: true, // Penting untuk Docker file watching
    },
    proxy: {
      "/api": {
        target: "http://php-backend:80", // Gunakan service name Docker
        changeOrigin: true,
        rewrite: (path) => path.replace(/^\/api/, ""),
      },
    },
  },
  preview: {
    port: 5173,
    host: "0.0.0.0",
  },
});

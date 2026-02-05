import { defineConfig } from "vite";

export default defineConfig({
  server: {
    port: 5173,
    proxy: {
      "/": {
        target: "http://php:80",
        changeOrigin: true,
      },
    },
  },
});

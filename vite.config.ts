import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  plugins: [tailwindcss()],

  build: {
    outDir: "public/build",
    copyPublicDir: false,
    manifest: true,
    rollupOptions: {
      input: { main: "resources/js/main.ts" },
    },
  },
});

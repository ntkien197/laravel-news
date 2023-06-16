import { defineConfig, loadEnv } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import * as path from 'path'

export default ({ mode }) => {
  process.env = { ...process.env, ...loadEnv(mode, process.cwd()) }

  return defineConfig({
    plugins: [
      laravel({
        input: 'resources/ts/main.ts',
        refresh: true,
      }),
      vue({
        template: {
          transformAssetUrls: {
            base: null,
            includeAbsolute: false,
          },
        },
      }),
    ],
    build: {
      manifest: true,
      outDir: "public/build",
      rollupOptions: {
        input: "resources/ts/main.ts",
      },
    },
    server: {
      // host: process.env.VITE_SERVER_HOST,
      port: process.env.VITE_SERVER_PORT ? parseInt(process.env.VITE_SERVER_PORT.toString()) : 8000,
    },

    resolve: {
      alias: {
        '~': path.resolve(__dirname, 'node_modules'),
        '@': path.join(__dirname, '/resources/ts'),
      },
    },
  })
}

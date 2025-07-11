import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  plugins: [
    laravel({
      input: ['packages/Clean/Theme/resources/assets/css/app.css'],
      refresh: true,
    }),
  ],
})

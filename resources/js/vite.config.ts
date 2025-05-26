import { sveltekit } from '@sveltejs/kit/vite';
import { defineConfig } from 'vite';

export default defineConfig({
	plugins: [sveltekit()],
	css: {
		preprocessorOptions: {
			scss: {
				includePaths: ['node_modules']
			}
		}
	},
	resolve: {
		alias: {
			'~bootstrap': 'bootstrap'
		}
	}
});

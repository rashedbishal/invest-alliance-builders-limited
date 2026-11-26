import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig(({ mode }) => {
    // Same host as APP_URL (e.g. a LAN IP), so other devices load assets from this machine.
    const env = loadEnv(mode, process.cwd(), '');
    let devHost = 'localhost';
    try {
        devHost = new URL(env.APP_URL).hostname || devHost;
    } catch {
        // APP_URL missing or malformed: stay on localhost.
    }

    return {
        plugins: [
            laravel({
                input: [
                    'resources/css/app.css',
                    'resources/js/app.js',
                    // Main site theme (welcome.blade.php)
                    'resources/css/site.css',
                    'resources/js/site.js',
                ],
                refresh: true,
            }),
            tailwindcss(),
        ],
        server: {
            host: '0.0.0.0',
            port: 5173,
            // `origin` and public/hot hardcode this port, so fail loudly
            // instead of silently moving to 5174 when it's taken.
            strictPort: true,
            origin: `http://${devHost}:5173`,
            watch: {
                // None of these affect the frontend; watching them just
                // burns CPU and can trigger spurious reloads.
                ignored: [
                    '**/.agents/**',
                    '**/.claude/**',
                    '**/.cursor/**',
                    '**/.junie/**',
                    '**/vendor/**',
                    '**/storage/**',
                ],
            },
            // The page is served from Laravel (:8000) while modules come from Vite
            // (:5173), so Vite must allow that cross-origin request. Limit it to
            // localhost and private LAN addresses.
            cors: {
                origin: [
                    /^https?:\/\/(localhost|127\.0\.0\.1|192\.168\.\d+\.\d+|10\.\d+\.\d+\.\d+)(:\d+)?$/,
                ],
            },
        },
    };
});

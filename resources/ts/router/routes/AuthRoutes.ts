const AuthRoutes = [
    {
        path: '/login',
        name: 'auth-login',
        component: () => import('@/views/auth/login.vue'),
        meta: {
            layout: 'LayoutAuth'
        }
    },
    {
        path: "/:catchAll(.*)",
        name: 'catchAll',
        component: () => import('@/views/errors/page404.vue')
    },
];

export default AuthRoutes;

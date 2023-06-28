const DashboardRoutes = [
    {
        path: '/',
        alias: '/',
        name: 'dashboard.index',
        component: () => import('@/views/home/index.vue'),
        meta: {
            layout: 'LayoutDefault',
            auth: true
        }
    },
];

export default DashboardRoutes;

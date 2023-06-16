function isAuthenticated(to: any, from: any, next: any) {
    UserAuth.checkAuth()
        .then((response: ResponseData) => {
            store.commit("auth/isLogin", response.data);
            // store.dispatch("login", response.data)

            if (response.data.success)
                next();
            else
                next({ path: '/' })
        })
        .catch((e: Error) => {
            // store.commit('a/progressBar', false)
            return next({ path: '/' })
        });
}

function notAuthenticated(to: any, from: any, next: any) {
    UserAuth.checkAuth()
        .then((response: ResponseData) => {
            // store.dispatch("login", response.data)
            store.commit("auth/isLogin", response.data);
            if (response.data.success)
                next({ path: '/admin' })
            else
                next();
        })
        .catch((e: Error) => {
            // store.commit('a/progressBar', false)
            return next();
        });
}

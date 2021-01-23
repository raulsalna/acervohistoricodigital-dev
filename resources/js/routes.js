import Home from "./components/views/layouts/Home";


import AccessDenied from "./components/views/layouts/AccessDenied";
import Menu from "./components/views/layouts/Menu";
import Admin from "./routes/Admin";
import Archive from "./routes/Archive";
import Box from "./routes/Box";



export const routes = [

    {
        path: '/acervo/ingresar',
        component: AccessDenied,
        beforeEnter: (to, from, next) => {

            if (sessionStorage.getItem('ACERVO_token')) {
                next('/acervo');
            } else {
                next();
            }
        }
    },



    {
        path: '/acervo',
        component: Home,
        children: [
            { path: '/', component: Menu },
            { ...Admin },
            { ...Archive },
            { ...Box },
        ],
        beforeEnter: (to, from, next) => {
            if (sessionStorage.getItem("ACERVO_token")) {
                next();
            } else {
                next("/acervo/ingresar");
            }
        }
    },

    { path: '*', redirect: '/acervo' }


];

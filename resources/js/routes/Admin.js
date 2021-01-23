import {RouterView} from './RouterView.js';
import AdminIndex from '../components/views/admin/Index';

import CatalogsIndex from '../components/views/catalogs/Index';
import BulkIndex from '../components/views/Admin/bulk/Index';
import UsersIndex from '../components/views/Admin/users/Index';
import UsersEdit from '../components/views/Admin/users/Edit';
import UsersCreate from '../components/views/admin/users/Create';
import store from '../store/index';
import {Message} from 'element-ui'

export default {
    path: '/acervo/administracion',
    component: RouterView,
    children: [
        {
            path: '',
            component: AdminIndex,
            name: 'AdminIndex',
        },
        {
            path: 'catalogos',
            component: CatalogsIndex,
            name: 'CatalogsIndex',
        },
        {
            path: 'carga',
            component: BulkIndex,
            name: 'BulkIndex',
        },
        {
            path: 'usuarios',
            component: UsersIndex,
            name: 'UsersIndex',
        },
        {
            path: 'usuarios/nuevoUsuario',
            component: UsersCreate,
            name: 'UsersCreate',
        },
        {
            path: 'usuarios/editar/:id',
            component: UsersEdit,
            name: 'UsersEdit',
            props: true
        },

    ],
}

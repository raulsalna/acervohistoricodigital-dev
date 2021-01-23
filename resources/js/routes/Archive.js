import {RouterView} from './RouterView.js';
import Index from '../components/views/archive/Index';
import Create from '../components/views/archive/Create';
import Show from '../components/views/archive/Show';
import Edit from '../components/views/archive/Edit';

export default {
    path: '/acervo/archivo',
    component: RouterView,
    children: [
        {
            path: '',
            component: Index,
            name: 'Index',
        },
        {
            path: 'nuevoArchivo',
            component: Create,
            name: 'Create',
        },
        {
            path: 'verArchivo/:hash',
            component: Show,
            name: 'Show',
        },
        {
            path: 'editarArchivo/:hash',
            component: Edit,
            name: 'Edit',
        },

    ],
}
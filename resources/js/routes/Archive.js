import {RouterView} from './RouterView.js';
import Index from '../components/views/Archive/Index';
import Create from '../components/views/Archive/Create';
import Show from '../components/views/Archive/Show';
import Edit from '../components/views/Archive/Edit';

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
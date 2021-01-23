import { RouterView } from "./RouterView.js";
import BoxIndex from "../components/views/box/Index";
import CreateBox from "../components/views/box/Create";
import ShowBox from "../components/views/box/Show";
import EditBox from "../components/views/box/Edit";
import ContactForm from "../components/views/box/partials/ContactForm";
import BoxDialog from "../components/views/box/partials/BoxDialog";



export default {
  path: "/acervo/caja",
  component: RouterView,
  children: [
    {
      path: "",
      component: BoxIndex,
      name: "BoxIndex"
    },
    {
      path: "nuevaCaja",
      component: CreateBox,
      name: "CreateBox"
    },
    {
      path: "mostrarCaja/:hash",
      component: ShowBox,
      name: "ShowBox"
    },
    {
      path: "editarCaja/:hash",
      component: EditBox,
      name: "EditBox"
    },
    {
      path: "nuevoComponente",
      component: ContactForm,
      name: "ContactForm"
    },
    {
      path: "nuevoBox",
      component: BoxDialog,
      name: "BoxDialog"
    }
  ]
};

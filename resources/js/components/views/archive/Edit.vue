<template>
    <div>
        <header-section icon="far fa-edit" title="Editar Archivo Histórico">
            <template slot="buttons">
                <el-button size="medium" type="danger" icon="el-icon-arrow-left" @click="$router.push('/acervo/archivo')">Regresar</el-button>
            </template>
        </header-section>
            <div>
                <EditData></EditData>
            </div>
    </div>
</template>

<script>
import HeaderSection from "../layouts/partials/HeaderSection";
import EditData from "../archive/partials/EditData";
export default {
    components: {
    HeaderSection,
    EditData
    
  },
   data() {

    return {

    };
   },
   methods:{

       },
   }

</script>

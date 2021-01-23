<template>
    <div>
        <header-section icon="far fa-folder-open" title="Nuevo Archivo Histórico">
            <template slot="buttons">
                <el-button size="medium" type="danger" icon="el-icon-arrow-left" @click="$router.push('/acervo/archivo')">Regresar</el-button>
            </template>
        </header-section>
            <div>
                <BasicData></BasicData>
            </div>
    </div>
</template>

<script>
import HeaderSection from "../layouts/partials/HeaderSection";
import BasicData from "../archive/partials/BasicData";
export default {
    components: {
    HeaderSection,
    BasicData,
  },
   data() {

    return {

    };
   },
   methods:{

       },
   }

</script>

<template>
    <div>
        <header-section icon="fas fa-eye" title="Ver Archivo Histórico">
            <template slot="buttons">
                <el-button size="medium" type="danger" icon="el-icon-arrow-left" @click="$router.push('/acervo/archivo')">Regresar</el-button>
            </template>
        </header-section>
            <div>
                <ShowData></ShowData>
            </div>
    </div>
</template>

<script>
import HeaderSection from "../layouts/partials/HeaderSection";
import ShowData from "../archive/partials/ShowData";
export default {
    components: {
    HeaderSection,
    ShowData
    
  },
   data() {

    return {

    };
   },
   methods:{

       },
   }

</script>

<template>
    <div>
        <header-section icon="far fa-file-excel" title="Carga Masiva">
            <template slot="buttons">
                <a rel="nofollow" href="/carga/carga_masiva.xlsx">
                    <el-button size="small" icon="fas fa-file-excel"  type="info"> Descargar Formato
                    </el-button>
                </a>
                <el-button align="right" size="small" type="danger" icon="el-icon-arrow-left" @click="$router.push('/acervo/administracion')">
                    Regresar
                </el-button>
            </template>
        </header-section>
        <br>
        <BulkMasive></BulkMasive>
    </div>
</template>


<script>
    import HeaderSection from "../../layouts/partials/HeaderSection";
    import BulkMasive from "../../Admin/bulk/BulkMasive";

    export default {
        components: {
            HeaderSection,
            BulkMasive

        },
        computed: {
            urlMain() {
            return window.URL;
            }
        },
        data(){
            return{
                
            }  
        },
        methods: {
            goTo(link, data) {
                axios.post(this.urlMain+'/api/transaction', data).then(response => {
                    this.$router.push({
                        name: link
                    });
                }).catch(error => {
                    this.$message({
                        type: "warning",
                        message: "No fue posible completar la acción, intente nuevamente."
                    });
                });
            }
        }
    }
</script>
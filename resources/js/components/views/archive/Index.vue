<template>
    <div>
        <header-section icon="fas fa-archive" title="Archivo Histórico">
            <template slot="buttons">
                <el-button size="small" icon="fas fa-plus-circle" @click.native="$router.push('/acervo/archivo/nuevoArchivo')" type="success"> Agregar archivo
                </el-button>
                <el-button align="right" size="small" type="danger" icon="el-icon-arrow-left" @click="$router.push('/acervo')">
                    Regresar
                </el-button>
            </template>
        </header-section>
        <br>
        <TableIndex></TableIndex>
    </div>
</template>


<script>
    import HeaderSection from "../layouts/partials/HeaderSection";
    import TableIndex from "../archive/partials/TableIndex";
    export default {
        components: {
            HeaderSection,
            TableIndex
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
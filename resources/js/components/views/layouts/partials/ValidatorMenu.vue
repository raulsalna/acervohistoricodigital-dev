<template>
    <div>
        <el-row :gutter="10">
            <el-col :span="8">
                    <a class="links"
                       @click="goTo('ActivitiesMenu', {cat_transaction_type_id : 1, action: 'Ingresa al index de recomendaciones'})">
                      Acervo
                    </a>
                <br><br>
                <span>Acervo</span>
                <br>
            </el-col>
            <el-col :span="8">
                    <a class="links"
                       @click="goTo('bilateralEconomicRelationsMenu', {cat_transaction_type_id : 1, action: 'Ingresa al index de recomendaciones'})">
                      Fototeca
                    </a>
                <br><br>
                <span>Fototeca</span>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                registers: 0,
            }
        },
        computed: {
            urlMain() {
            return window.URL;
            }
        },
        created() {
            
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
        },
    }
</script>

<style scoped>
    .links {
        font-size: 25px;
        color: #9D2449;
        cursor: pointer;
        text-decoration: underline;
    }
</style>

<template>
    <div>
        <el-row :gutter="10">
            <el-col :span="8">
                <i class="fas fa-archive"></i>
                <a class="links" @click="goTo('Index', {cat_transaction_type_id : 1, action: 'Ingresa a el Archivo'})">
                    Archivo Histórico
                </a>
                <br><br>
                <span> &nbsp; Archivo Histórico</span>
            </el-col>
            <el-col :span="8">
                <i class="fas fa-box"></i>
                <a class="links" @click="goTo('BoxIndex', {cat_transaction_type_id : 1, action: 'Ingresa a la Caja'})">Caja
                    </a>
                <br><br>
                <span> &nbsp; Caja</span>
                <br><br>
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

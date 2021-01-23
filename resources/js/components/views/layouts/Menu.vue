<template>
    <div>
        <admin-menu v-if="$store.state.user.profile === 1"/>
        <capturist-menu v-if="$store.state.user.profile === 2"/>
        <validator-menu v-if="$store.state.user.profile === 3"/>

    </div>
</template>

<script>
    import AdminMenu from './partials/AdminMenu';
    import CapturistMenu from "./partials/CapturistMenu";
    import ValidatorMenu from "./partials/ValidatorMenu";
    import NotAssignedMenu from './partials/NotAssignedMenu';

    export default {
        components: {
            AdminMenu,
            CapturistMenu,
            ValidatorMenu,
            NotAssignedMenu
        },
        computed: {
            urlMain() {
            return window.URL;
            }
        },
        created() {
            let data = {cat_transaction_type_id : 1, action: 'Entra a inicio'};

            axios.post(this.urlMain+'/api/transaction', data).then(response => {
            }).catch(error => {
                this.$message({
                    type: "warning",
                    message: "No fue posible completar la acción, intente nuevamente."
                });
            });
        },
    }
</script>

<style scoped>

</style>

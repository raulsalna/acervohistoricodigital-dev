<template>
    <div>
        <header-section icon="fa-users" title="Usuarios">
            <template slot="buttons">
                <el-button size="small" icon="fas fa-plus-circle" @click.native="$router.push('/acervo/administracion/usuarios/nuevoUsuario')" type="success"> Agregar usuario
                </el-button>
                <el-button size="small" type="danger" icon="el-icon-arrow-left" @click="$router.push('/acervo/administracion')">
                    Regresar
                </el-button>
            </template>
        </header-section>
        <el-row :gutter="20">
            <el-col :span="6">
                <el-pagination @size-change="handleSizeChange" :current-page.sync="pagination.currentPage" :page-sizes="[10, 20, 50, 100]" :page-size="parseInt(pagination.perPage)" layout="sizes">
                </el-pagination>
            </el-col>
            <el-col :span="6" :offset="12">
                <el-input clearable suffix-icon="fas fa-search" placeholder="Buscar" v-model="search" @change="listAndFilterUsers(search)">
                </el-input>
            </el-col>
        </el-row>
        <br>
        <el-row :gutter="10">
            <el-col :span="24">
                <el-table :data="users.data" size="mini" border :row-class-name="notAssignedUser" style="width: 100%">
                    <el-table-column prop="username" label="Usuario">
                    </el-table-column>
                    <el-table-column prop="full_name" label="Nombre">
                    </el-table-column>
                    <el-table-column prop="profile.name" label="Rol">
                    </el-table-column>
                    <!-- <el-table-column prop="profile.name" label="Representación">
                    </el-table-column> -->
                    <el-table-column label="Acciones" header-align="left" align="center" width="140">
                        <template slot-scope="scope">
                            <el-button-group>
                                <el-tooltip class="item" effect="dark" content="Editar" placement="right-start">
                                    <el-button type="info" size="mini" icon="fas fa-edit" @click="editRegister(scope.row.hash)">
                                    </el-button>
                                </el-tooltip>
                            </el-button-group>
                            <el-button-group>
                                <el-tooltip class="item" effect="dark" content="Eliminar" placement="right-start">
                                    <el-button type="danger" size="mini" icon="fas fa-trash-alt" @click="deleteRegister(scope.row.hash)">
                                    </el-button>
                                </el-tooltip>
                            </el-button-group>
                        </template>
                    </el-table-column>
                </el-table>
                <br>
                <el-pagination :page-size="parseInt(pagination.perPage)" @size-change="handleSizeChange" @current-change="handleCurrentChange" layout="total, ->, prev, pager, next" :current-page.sync="pagination.currentPage" :total="pagination.total">
                </el-pagination>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import HeaderSection from "../../layouts/partials/HeaderSection";

    export default {
        components: {
            HeaderSection
        },

        data() {
            return {
                users: [],
                search: '',
                pagination: {
                    currentPage: 1,
                    total: 0,
                    perPage: 10
                },

                downloadText: 'Descargar Excel',
                downloading: false,
            }
        },
        computed: {
            urlMain() {
            return window.URL;
            }
        },
        created() {
            this.listAndFilterUsers();
        },

        methods: {
            notAssignedUser({
                    row
                }) {

                    if (row.profile === 5) {
                        return 'danger-row';
                    }
                },

                addRegister() {
                    let data = {
                        cat_transaction_type_id: 1,
                        action: 'Agregar Usuario'
                    };

                    axios.post(this.urlMain+'/api/transaction', data).then(response => {
                        this.$router.push({
                            name: 'UsersCreate'
                        });
                    }).catch(error => {
                        this.$message({
                            type: "warning",
                            message: "No fue posible completar la acción, intente nuevamente."
                        });
                    });
                },

                getUsers(currentPage = 1) {
                    this.startLoading();

                    let data = {
                        params: {
                            page: currentPage,
                            perPage: this.pagination.perPage,
                            search: this.search
                        }
                    };

                    axios.get(this.urlMain+'/api/users', data).then(response => {

                        this.users = response.data.users.data;
                        this.pagination.total = response.data.users.total;
                        this.pagination.currentPage = response.data.users.current_page;
                        this.pagination.perPage = response.data.users.per_page;

                        this.stopLoading();

                    }).catch(error => {
                        this.stopLoading();

                        this.$message({
                            type: "warning",
                            message: "No fue posible completar la acción, intente nuevamente."
                        });
                    });
                },
                listAndFilterUsers(currentPage = 1) {
                let data = {
                    params: {
                    page: this.pagination.currentPage ? this.pagination.currentPage : 1,
                    perPage: this.pagination.perPage ? this.pagination.perPage : 10,
                    search: this.search ? this.search : ""
                    }
                };
                this.startLoading();
                axios
                    .get(
                    this.urlMain +`/api/users/listAndFilterUsers/
                    ${this.busqueda ? this.busqueda : null}`,
                    data)
                    .then(response => {
                    this.stopLoading();
                    if (this.drawer && this.drawer === true) {
                        // this.$refs['searchvisitsref'].resetFields()
                        this.drawer = false;
                    }
                    this.users = response.data.users;
                    this.pagination.total = response.data.users.total;
                    this.pagination.currentPage = response.data.users.current_page;
                    this.pagination.perPage = response.data.users.per_page;

                    //   this.visits = response.data.visits.filter(item => item.isActive == true);
                    })
                    .catch(error => {
                    this.stopLoading();
                    this.$message({
                        type: "warning",
                        message:
                        "No fue posible completar la acción listAndFilter, intente nuevamente."
                    });
                    });
                },

                handleCurrentChange(currentPage) {
                    this.pagination.currentPage = currentPage;
                    this.listAndFilterUsers(currentPage)
                },

                handleSizeChange(sizePerPage) {
                    this.pagination.perPage = sizePerPage;
                    this.listAndFilterUsers();
                },

                editRegister(id) {
                    let data = {
                        cat_transaction_type_id: 1,
                        action: 'Editar Usuario'
                    };

                    axios.post(this.urlMain+'/api/transaction', data).then(response => {
                        this.$router.push({
                            name: 'UsersEdit',
                            params: {
                                id: id
                            }
                        });
                    }).catch(error => {
                        this.$message({
                            type: "warning",
                            message: "No fue posible completar la acción, intente nuevamente."
                        });
                    });
                },
                deleteRegister($id) {
                    this.$confirm('Esta acción eliminara el registro del sistema', {
                        confirmButtonText: 'Aceptar',
                        cancelButtonText: 'Cancelar',
                        type: 'warning'
                    }).then(() => {
                        this.startLoading();
                        axios.delete(this.urlMain+`/api/users/${$id}`, {
                            responseType: 'blob'
                        }).then(response => {
                            this.listAndFilterUsers();
                            this.stopLoading();
                            this.$message({
                                type: "success",
                                title: 'Éxito',
                                message: "Eliminación exitosa"
                            });

                        }).catch(error => {
                            this.stopLoading();
                            this.$message({
                                type: "warning",
                                message: "No fue posible completar la acción, intente nuevamente."
                            });
                        });
                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: 'Eliminación cancelada'
                        });
                    });

                },

        },
    }
</script>
export const cats={
    data(){
        return{
            cat_documentary:        [],
            cat_physic:             [],
            cat_transaction:        [],
            cat_producer:           [],
            cat_support:            [],
            cat_idioms:             [],
            cat_box:                [],
            cat_files:              [],
            cat_documentary_gro:    [],

            // cajaForm:{
            //     box:                     null,
            //     fileName:                null,   
            //     place:                   null,
            //     depositRoom:             null,
            //     corridor:                null,
            //     shelf:                   null,
            //     strep:                   null,
            // }
        }
    },

    mounted(){
        this.getCatDocumentTradition();
        this.getCatPhysicalCharacteristics();
        this.getCatTransactionType();
        this.getCatProducer();
        this.getCatSupport();
        this.getCatIdioms();
        this.getCatBox();
        this.getCatFiles();
        this.getCatDocumentaryGroup();
     },
    computed: {
        urlMain() {
        return window.URL;
        }
    },
     methods:{
        // newBox() {
        //     this.showLoading("Guardando registro");
        //     let data = this.cajaForm;
        //     axios.post(this.urlMain + "/api/box", data).then(response => {
        //     this.dialogFormVisible = false;
        //     this.$router.push("/acervo/archivo/nuevoArchivo");
        //     this.getCatBox();
        //     this.archivoForm.box_id = response.data.box;
        //     this.stopLoading();
        // })
        //     .catch(error => {
        //     console.log(error.response.data.errors);
        //     this.errors = error.response.data.errors;
        //     this.stopLoading();
        //     });
        // },
        getCatDocumentTradition() {
        axios
            .get(this.urlMain +"/api/index_cat_documentary_tradition")
            .then(response => {
                this.cat_documentary = response.data;
            })
            .catch(error => {
                this.$message({
                    type: "warning",
                    message: "No fue posible completar la acción, intente nuevamente."
                });
            });
        },
        getCatPhysicalCharacteristics() {
        axios
            .get(this.urlMain +"/api/index_cat_physical_characteristics")
            .then(response => {
                this.cat_physic = response.data;
            })
            .catch(error => {
                this.$message({
                    type: "warning",
                    message: "No fue posible completar la acción, intente nuevamente."
                });
            });
        },
        getCatTransactionType() {
        axios
            .get(this.urlMain +"/api/index_cat_transaction_type")
            .then(response => {
                this.cat_transaction = response.data;
            })
            .catch(error => {
                this.$message({
                    type: "warning",
                    message: "No fue posible completar la acción, intente nuevamente."
                });
            });
        },
        getCatProducer() {
        axios
            .get(this.urlMain +"/api/index_cat_producer")
            .then(response => {
                this.cat_producer = response.data;
            })
            .catch(error => {
                this.$message({
                    type: "warning",
                    message: "No fue posible completar la acción, intente nuevamente."
                });
            });
        },
        getCatSupport() {
        axios
            .get(this.urlMain +"/api/index_cat_support")
            .then(response => {
                this.cat_support = response.data;
            })
            .catch(error => {
                this.$message({
                    type: "warning",
                    message: "No fue posible completar la acción, intente nuevamente."
                });
            });
        },
        getCatIdioms() {
        axios
            .get(this.urlMain +"/api/index_cat_idioms")
            .then(response => {
                this.cat_idioms = response.data;
            })
            .catch(error => {
                this.$message({
                    type: "warning",
                    message: "No fue posible completar la acción, intente nuevamente."
                });
            });
        },

        getCatBox() {
        axios
            .get(this.urlMain +"/api/index_cat_box")
            .then(response => {
                this.cat_box = response.data;
            })
            .catch(error => {
                this.$message({
                    type: "warning",
                    message: "No fue posible completar la acción, intente nuevamente."
                });
            });
        },

        getCatFiles() {
        axios
            .get(this.urlMain +"/api/index_cat_files")
            .then(response => {
                this.cat_files = response.data;
            })
            .catch(error => {
                this.$message({
                    type: "warning",
                    message: "No fue posible completar la acción, intente nuevamente."
                });
            });
        },

        getCatDocumentaryGroup() {
        axios
            .get(this.urlMain +"/api/index_cat_documentary_group")
            .then(response => {
                this.cat_documentary_gro = response.data;
            })
            .catch(error => {
                this.$message({
                    type: "warning",
                    message: "No fue posible completar la acción, intente nuevamente."
                });
            });
        },
    }
}
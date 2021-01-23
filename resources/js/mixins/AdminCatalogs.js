export const cats={
    data(){
        return{
            newArray:                   [],
            errors:                     [],
            general_cat:                [],
            selectedGeneralRow:         [],
            deleteGneralRow:            [],
            dialogCatConfirmation:      false,
            dialogGeneralCat:           false,
            inputErrorCatConfirmation:  false,
            dialogFieldnull:            false,
            GeneralCat:                 false,
            selectedCat:                null,

            newGeneralCatForm: {
                name: null,
            },
            dialogGeneralCatForm: {
                name: null,
            },
            cats_index: [
                {id:3,  name: 'Catálogo de características físicas'},
                {id:4,  name: 'Catálogo de grupo de documentación'},
                {id:5,  name: 'Catálogo de grupo de tradición'},
                {id:6,  name: 'Catálogo de productor'},
                {id:7,  name: 'Catálogo de soporte'},
                {id:8,  name: 'Catálogo de tipo de transacción'},
                {id:9,  name: 'Catálogo de idiomas'},
            ],
        }
    },
    computed: {
        urlMain() {
        return window.URL;
        }
    },
    watch: {
        selectedCat(value){
            this.inputErrorCatConfirmation = false;

            switch(value){
                case 1:
                    this.getCatFiles();
                    this.GeneralCat =  true;
                break;
                case 2:
                    this.getCatBox();
                    this.GeneralCat =  true;
                    break;
                case 3:
                    this.getCatPhysicalCharacteristics();
                    this.GeneralCat =  true;
                break;
                case 4:
                    this.getCatDocumentaryGroup();
                    this.GeneralCat =  true;
                break;
                case 5:
                    this.getCatDocumentTradition();
                    this.GeneralCat =  true;
                break;
                case 6:
                    this.getCatProducer();
                    this.GeneralCat =  true;
                break;
                case 7:
                    this.getCatSupport();
                    this.GeneralCat =  true;
                break;
                case 8:
                    this.getCatTransactionType();
                    this.GeneralCat =  true;
                break;
                case 9:
                    this.getCatIdioms();
                    this.GeneralCat =  true;
                break;
            }
        },
        "newCatActivityStatusForm.status_name": function(value) {
        this.newCatActivityStatusForm.status_name = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
        },
        "newCatTypeVisitForm.type_visit": function(value) {
        this.newCatTypeVisitForm.type_visit = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
        },
        "newCatVisitHighLevel.has_level_visit_name": function(value) {
        this.newCatVisitHighLevel.has_level_visit_name = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
        },
        "newCatSector.name": function(value) {
        this.newCatSector.name = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
        },
        "newCatSubSector.name": function(value) {
        this.newCatSubSector.name = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
        },
        "newContinentForm.name": function(value) {
        this.newContinentForm.name = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
        },
        "newCatRegionForm.name": function(value) {
        this.newCatRegionForm.name = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
        },
        "newCatRepresentationForm.name": function(value) {
        this.newCatRepresentationForm.name = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
        },
        "newCatSubSectorInput.name": function(value) {
        this.newCatSubSectorInput.name = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
        },
        "dialogGeneralCatForm.name": function(value) {
        this.dialogGeneralCatForm.name = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
        },
        "newGeneralCatForm.name": function(value) {
          this.newGeneralCatForm.name = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
          }
    },
    methods:{

        // Cargar los catalogos
        // Cargar los catalogos
        newGeneralCat()
        {
            if(this.selectedCat == 1)
            {this.newFileCat()}
            if(this.selectedCat == 2)
            {this.newBoxCat()}
            if(this.selectedCat == 3)
            {this.newPhysicalCharacteristCat()}
            if(this.selectedCat == 4)
            {this.newDocumentaryGroupCat()}
            if(this.selectedCat == 5)
            {this.newDocumentaryTraditionCat()}
            if(this.selectedCat == 6)
            {this.newProducerCat()}
            if(this.selectedCat == 7)
            {this.newSupportCat()}
            if(this.selectedCat == 8)
            {this.newTransactionTypeCat()}
            if(this.selectedCat == 9)
            {this.newIdiomsCat()}
        },
        UpdateGeneralCat()
        {
          if(this.dialogGeneralCatForm.name.length >0 )
            this.dialogFieldnull = false;
            if(this.dialogGeneralCatForm.name.length <1 ) {
            this.dialogFieldnull = true;
            return false; }
            if(this.selectedCat == 1)
            {this.updateFileRowCat(this.selectedGeneralRow)}
            if(this.selectedCat == 2)
            {this.updateBoxRowCat(this.selectedGeneralRow)}
            if(this.selectedCat == 3)
            {this.updatePhysicalCharacRowCat(this.selectedGeneralRow)}
            if(this.selectedCat == 4)
            {this.updateDocumentaryGroupRowCat(this.selectedGeneralRow)}
            if(this.selectedCat == 5)
            {this.updateDocumentaryTraditionalRowCat(this.selectedGeneralRow)}
            if(this.selectedCat == 6)
            {this.updateProducerRowCat(this.selectedGeneralRow)}
            if(this.selectedCat == 7)
            {this.updateSupportRowCat(this.selectedGeneralRow)}
            if(this.selectedCat == 8)
            {this.updateTransactionRowCat(this.selectedGeneralRow)}
            if(this.selectedCat == 9)
            {this.updateIdiomsRowCat(this.selectedGeneralRow)}
        },
        deleteGeneralCat($id)
        {
            this.deleteGneralRow = $id;
            if(this.selectedCat == 1)
            {this.deleteFileRowCat(this.deleteGneralRow)}
            if(this.selectedCat == 2)
            {this.deleteBoxRowCat(this.deleteGneralRow)}
            if(this.selectedCat == 3)
            {this.deletePhysicalCharacterRowCat(this.deleteGneralRow)}
            if(this.selectedCat == 4)
            {this.deleteDocumentaryGroupRowCat(this.deleteGneralRow)}
            if(this.selectedCat == 5)
            {this.deleteDocTraditionRowCat(this.deleteGneralRow)}
            if(this.selectedCat == 6)
            {this.deleteProducerRowCat(this.deleteGneralRow)}
            if(this.selectedCat == 7)
            {this.deleteSupportRowCat(this.deleteGneralRow)}
            if(this.selectedCat == 8)
            {this.updateTransactionRowCat(this.deleteGneralRow)}
            if(this.selectedCat == 9)
            {this.deleteIdiomsRowCat(this.deleteGneralRow)}
        },
        rowGeneralCat(row){
            console.log(row);
            this.dialogGeneralCat = true;
            this.selectedGeneralRow = row;
            this.dialogGeneralCatForm.name = row.name;
        },
        getCatDocumentTradition() {
        axios
            .get(this.urlMain +"/api/index_cat_documentary_tradition")
            .then(response => {
                this.general_cat = response.data;
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
                this.general_cat = response.data;
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
                this.general_cat = response.data;
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
                this.general_cat = response.data;
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
                this.general_cat = response.data;
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
                this.general_cat = response.data;
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
                this.general_cat = response.data;
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
                this.general_cat = response.data;
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
                this.general_cat = response.data;
            })
            .catch(error => {
                this.$message({
                    type: "warning",
                    message: "No fue posible completar la acción, intente nuevamente."
                });
            });
        },

        newFileCat() {
        let data = this.newGeneralCatForm;
        axios
            .post(this.urlMain+"/api/store_cat_files", data)
            .then(response => {
                this.getCatFiles();
                this.$message({
                        type: "success",
                        title: 'Éxito',
                        message: "Éxito registro guardado con éxito"
                    });
                    this.inputErrorCatConfirmation = false;
                    this.newGeneralCatForm.name = null;
            })
            .catch(error => {
                if(this.newGeneralCatForm.name == null){
                    this.inputErrorCatConfirmation = true;
                }else{
                    this.dialogCatConfirmation = true;
                }
                this.errors = error.response.data.errors;
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        },

        newDocumentaryTraditionCat() {
        let data = this.newGeneralCatForm;
        axios
            .post(this.urlMain+"/api/store_cat_documentary_tradition", data)
            .then(response => {
                this.getCatDocumentTradition();
                this.$message({
                        type: "success",
                        title: 'Éxito',
                        message: "Éxito registro guardado con éxito"
                    });
                    this.inputErrorCatConfirmation = false;
                    this.newGeneralCatForm.name = null;
            })
            .catch(error => {
                if(this.newGeneralCatForm.name == null){
                    this.inputErrorCatConfirmation = true;
                }else{
                    this.dialogCatConfirmation = true;
                }
                this.errors = error.response.data.errors;
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        },

        newPhysicalCharacteristCat() {
        let data = this.newGeneralCatForm;
        axios
            .post(this.urlMain+"/api/store_cat_physical_characteristics", data)
            .then(response => {
                this.getCatPhysicalCharacteristics();
                this.$message({
                        type: "success",
                        title: 'Éxito',
                        message: "Éxito registro guardado con éxito"
                    });
                    this.inputErrorCatConfirmation = false;
                    this.newGeneralCatForm.name = null;
            })
            .catch(error => {
                if(this.newGeneralCatForm.name == null){
                    this.inputErrorCatConfirmation = true;
                }else{
                    this.dialogCatConfirmation = true;
                }
                this.errors = error.response.data.errors;
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        },

        newTransactionTypeCat() {
        let data = this.newGeneralCatForm;
        axios
            .post(this.urlMain+"/api/store_cat_transaction_type", data)
            .then(response => {
                this.getCatTransactionType();
                this.$message({
                        type: "success",
                        title: 'Éxito',
                        message: "Éxito registro guardado con éxito"
                    });
                    this.inputErrorCatConfirmation = false;
                    this.newGeneralCatForm.name = null;
            })
            .catch(error => {
                if(this.newGeneralCatForm.name == null){
                    this.inputErrorCatConfirmation = true;
                }else{
                    this.dialogCatConfirmation = true;
                }
                this.errors = error.response.data.errors;
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        },

        newProducerCat() {
        let data = this.newGeneralCatForm;
        axios
            .post(this.urlMain+"/api/store_cat_producer", data)
            .then(response => {
                this.getCatProducer();
                this.$message({
                        type: "success",
                        title: 'Éxito',
                        message: "Éxito registro guardado con éxito"
                    });
                    this.inputErrorCatConfirmation = false;
                    this.newGeneralCatForm.name = null;
            })
            .catch(error => {
                if(this.newGeneralCatForm.name == null){
                    this.inputErrorCatConfirmation = true;
                }else{
                    this.dialogCatConfirmation = true;
                }
                this.errors = error.response.data.errors;
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        },

        newSupportCat() {
        let data = this.newGeneralCatForm;
        axios
            .post(this.urlMain+"/api/store_cat_support", data)
            .then(response => {
                this.getCatSupport();
                this.$message({
                        type: "success",
                        title: 'Éxito',
                        message: "Éxito registro guardado con éxito"
                    });
                    this.inputErrorCatConfirmation = false;
                    this.newGeneralCatForm.name = null;
            })
            .catch(error => {
                if(this.newGeneralCatForm.name == null){
                    this.inputErrorCatConfirmation = true;
                }else{
                    this.dialogCatConfirmation = true;
                }
                this.errors = error.response.data.errors;
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        },

        newIdiomsCat() {
        let data = this.newGeneralCatForm;
        axios
            .post(this.urlMain+"/api/store_cat_idioms", data)
            .then(response => {
                this.getCatIdioms();
                this.$message({
                        type: "success",
                        title: 'Éxito',
                        message: "Éxito registro guardado con éxito"
                    });
                    this.inputErrorCatConfirmation = false;
                    this.newGeneralCatForm.name = null;
            })
            .catch(error => {
                if(this.newGeneralCatForm.name == null){
                    this.inputErrorCatConfirmation = true;
                }else{
                    this.dialogCatConfirmation = true;
                }
                this.errors = error.response.data.errors;
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        },

        newBoxCat() {
        let data = this.newGeneralCatForm;
        axios
            .post(this.urlMain+"/api/store_cat_box", data)
            .then(response => {
                this.getCatBox();
                this.$message({
                        type: "success",
                        title: 'Éxito',
                        message: "Éxito registro guardado con éxito"
                    });
                    this.inputErrorCatConfirmation = false;
                    this.newGeneralCatForm.name = null;
            })
            .catch(error => {
                if(this.newGeneralCatForm.name == null){
                    this.inputErrorCatConfirmation = true;
                }else{
                    this.dialogCatConfirmation = true;
                }
                this.errors = error.response.data.errors;
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        },

        newDocumentaryGroupCat() {
        let data = this.newGeneralCatForm;
        axios
            .post(this.urlMain+"/api/store_cat_documentary_group", data)
            .then(response => {
                this.getCatDocumentaryGroup();
                this.$message({
                        type: "success",
                        title: 'Éxito',
                        message: "Éxito registro guardado con éxito"
                    });
                    this.inputErrorCatConfirmation = false;
                    this.newGeneralCatForm.name = null;
            })
            .catch(error => {
                if(this.newGeneralCatForm.name == null){
                    this.inputErrorCatConfirmation = true;
                }else{
                    this.dialogCatConfirmation = true;
                }
                this.errors = error.response.data.errors;
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        },
        // Nuevos catalogos
        // Nuevos catalogos

        // Editar catalogos
        // Editar catalogos
        updateFileRowCat(selectedGeneralRow){
            axios.put(this.urlMain+'/api/update_cat_files/'+this.selectedGeneralRow.hash,this.dialogGeneralCatForm).then(response => {
            this.getCatFiles();
            this.dialogGeneralCat = false;
            this.stopLoading();
            this.$message({
                type: "success",
                title: 'Éxito',
                message: "Se actualizo exitosamente"
            });
        }).catch(error => {
            this.stopLoading();
            // this.$message({
            //     type: "warning",
            //     message: "No fue posible completar la acción, intente nuevamente."
            // });
        });
        },

        updateDocumentaryTraditionalRowCat(selectedGeneralRow){
            axios.put(this.urlMain+'/api/update_cat_documentary_tradition/'+this.selectedGeneralRow.hash,this.dialogGeneralCatForm).then(response => {
            this.getCatDocumentaryGroup();
            this.dialogGeneralCat = false;
            this.stopLoading();
            this.$message({
                type: "success",
                title: 'Éxito',
                message: "Se actualizo exitosamente"
            });
        }).catch(error => {
            this.stopLoading();
            // this.$message({
            //     type: "warning",
            //     message: "No fue posible completar la acción, intente nuevamente."
            // });
        });
        },

        updatePhysicalCharacRowCat(selectedGeneralRow){
            axios.put(this.urlMain+'/api/update_cat_physical_characteristics/'+this.selectedGeneralRow.hash,this.dialogGeneralCatForm).then(response => {
            this.getCatPhysicalCharacteristics();
            this.dialogGeneralCat = false;
            this.stopLoading();
            this.$message({
                type: "success",
                title: 'Éxito',
                message: "Se actualizo exitosamente"
            });
        }).catch(error => {
            this.stopLoading();
            // this.$message({
            //     type: "warning",
            //     message: "No fue posible completar la acción, intente nuevamente."
            // });
        });
        },

        updateTransactionRowCat(selectedGeneralRow){
            axios.put(this.urlMain+'/api/update_cat_transaction_type/'+this.selectedGeneralRow.hash,this.dialogGeneralCatForm).then(response => {
            this.getCatTransactionType();
            this.dialogGeneralCat = false;
            this.stopLoading();
            this.$message({
                type: "success",
                title: 'Éxito',
                message: "Se actualizo exitosamente"
            });
        }).catch(error => {
            this.stopLoading();
            // this.$message({
            //     type: "warning",
            //     message: "No fue posible completar la acción, intente nuevamente."
            // });
        });
        },

        updateProducerRowCat(selectedGeneralRow){
            axios.put(this.urlMain+'/api/update_cat_producer/'+this.selectedGeneralRow.hash,this.dialogGeneralCatForm).then(response => {
            this.getCatProducer();
            this.dialogGeneralCat = false;
            this.stopLoading();
            this.$message({
                type: "success",
                title: 'Éxito',
                message: "Se actualizo exitosamente"
            });
        }).catch(error => {
            this.stopLoading();
            // this.$message({
            //     type: "warning",
            //     message: "No fue posible completar la acción, intente nuevamente."
            // });
        });
        },

        updateSupportRowCat(selectedGeneralRow){
            axios.put(this.urlMain+'/api/update_cat_support/'+this.selectedGeneralRow.hash,this.dialogGeneralCatForm).then(response => {
            this.getCatSupport();
            this.dialogGeneralCat = false;
            this.stopLoading();
            this.$message({
                type: "success",
                title: 'Éxito',
                message: "Se actualizo exitosamente"
            });
        }).catch(error => {
            this.stopLoading();
            // this.$message({
            //     type: "warning",
            //     message: "No fue posible completar la acción, intente nuevamente."
            // });
        });
        },

        updateIdiomsRowCat(selectedGeneralRow){
            axios.put(this.urlMain+'/api/update_cat_idioms/'+this.selectedGeneralRow.hash,this.dialogGeneralCatForm).then(response => {
            this.getCatIdioms();
            this.dialogGeneralCat = false;
            this.stopLoading();
            this.$message({
                type: "success",
                title: 'Éxito',
                message: "Se actualizo exitosamente"
            });
        }).catch(error => {
            this.stopLoading();
            // this.$message({
            //     type: "warning",
            //     message: "No fue posible completar la acción, intente nuevamente."
            // });
        });
        },

        updateBoxRowCat(selectedGeneralRow){
            axios.put(this.urlMain+'/api/update_cat_box/'+this.selectedGeneralRow.hash,this.dialogGeneralCatForm).then(response => {
            this.getCatBox();
            this.dialogGeneralCat = false;
            this.stopLoading();
            this.$message({
                type: "success",
                title: 'Éxito',
                message: "Se actualizo exitosamente"
            });
        }).catch(error => {
            this.stopLoading();
            // this.$message({
            //     type: "warning",
            //     message: "No fue posible completar la acción, intente nuevamente."
            // });
        });
        },

        updateDocumentaryGroupRowCat(selectedGeneralRow){
            axios.put(this.urlMain+'/api/update_cat_documentary_group/'+this.selectedGeneralRow.hash,this.dialogGeneralCatForm).then(response => {
            this.getCatDocumentaryGroup();
            this.dialogGeneralCat = false;
            this.stopLoading();
            this.$message({
                type: "success",
                title: 'Éxito',
                message: "Se actualizo exitosamente"
            });
        }).catch(error => {
            this.stopLoading();
            // this.$message({
            //     type: "warning",
            //     message: "No fue posible completar la acción, intente nuevamente."
            // });
        });
        },
        // Editar catalogos
        // Editar catalogos

        // Eliminar catalogos
        // Eliminar catalogos
        deleteFileRowCat($id){
            this.$confirm('Esta acción eliminara el registro del sistema', 'Precaución', {
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            type: 'warning'
        }).then(() => {
            this.startLoading();
            axios.delete(this.urlMain+`/api/delete_cat_file/${$id}`, {responseType: 'blob'}).then(response => {
                this.getCatFiles();
                this.stopLoading();
                this.$message({
                    type: "success",
                    title: 'Éxito',
                    message: "El registro se eliminó correctamente"
                });
            }).catch(error => {
                this.stopLoading();
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        }).catch(() => {
            this.$message({
                type: 'info',
                message: 'Eliminación cancelada'
            });
        });
        },

        deleteDocTraditionRowCat($id){
            this.$confirm('Esta acción eliminara el registro del sistema', 'Precaución', {
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            type: 'warning'
        }).then(() => {
            this.startLoading();
            axios.delete(this.urlMain+`/api/delete_cat_documentary_tradition/${$id}`, {responseType: 'blob'}).then(response => {
                this.getCatDocumentTradition();
                this.stopLoading();
                this.$message({
                    type: "success",
                    title: 'Éxito',
                    message: "El registro se eliminó correctamente"
                });
            }).catch(error => {
                this.stopLoading();
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        }).catch(() => {
            this.$message({
                type: 'info',
                message: 'Eliminación cancelada'
            });
        });
        },

        deletePhysicalCharacterRowCat($id){
            this.$confirm('Esta acción eliminara el registro del sistema', 'Precaución', {
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            type: 'warning'
        }).then(() => {
            this.startLoading();
            axios.delete(this.urlMain+`/api/delete_cat_physical_characteristics/${$id}`, {responseType: 'blob'}).then(response => {
                this.getCatPhysicalCharacteristics();
                this.stopLoading();
                this.$message({
                    type: "success",
                    title: 'Éxito',
                    message: "El registro se eliminó correctamente"
                });
            }).catch(error => {
                this.stopLoading();
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        }).catch(() => {
            this.$message({
                type: 'info',
                message: 'Eliminación cancelada'
            });
        });
        },

        deleteTransactionTypeRowCat($id){
            this.$confirm('Esta acción eliminara el registro del sistema', 'Precaución', {
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            type: 'warning'
        }).then(() => {
            this.startLoading();
            axios.delete(this.urlMain+`/api/delete_cat_transaction_type/${$id}`, {responseType: 'blob'}).then(response => {
                this.getCatTransactionType();
                this.stopLoading();
                this.$message({
                    type: "success",
                    title: 'Éxito',
                    message: "El registro se eliminó correctamente"
                });
            }).catch(error => {
                this.stopLoading();
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        }).catch(() => {
            this.$message({
                type: 'info',
                message: 'Eliminación cancelada'
            });
        });
        },

        deleteProducerRowCat($id){
            this.$confirm('Esta acción eliminara el registro del sistema', 'Precaución', {
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            type: 'warning'
        }).then(() => {
            this.startLoading();
            axios.delete(this.urlMain+`/api/delete_cat_producer/${$id}`, {responseType: 'blob'}).then(response => {
                this.getCatProducer();
                this.stopLoading();
                this.$message({
                    type: "success",
                    title: 'Éxito',
                    message: "El registro se eliminó correctamente"
                });
            }).catch(error => {
                this.stopLoading();
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        }).catch(() => {
            this.$message({
                type: 'info',
                message: 'Eliminación cancelada'
            });
        });
        },

        deleteSupportRowCat($id){
            this.$confirm('Esta acción eliminara el registro del sistema', 'Precaución', {
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            type: 'warning'
        }).then(() => {
            this.startLoading();
            axios.delete(this.urlMain+`/api/delete_cat_support/${$id}`, {responseType: 'blob'}).then(response => {
                this.getCatSupport();
                this.stopLoading();
                this.$message({
                    type: "success",
                    title: 'Éxito',
                    message: "El registro se eliminó correctamente"
                });
            }).catch(error => {
                this.stopLoading();
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        }).catch(() => {
            this.$message({
                type: 'info',
                message: 'Eliminación cancelada'
            });
        });
        },

        deleteIdiomsRowCat($id){
            this.$confirm('Esta acción eliminara el registro del sistema', 'Precaución', {
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            type: 'warning'
        }).then(() => {
            this.startLoading();
            axios.delete(this.urlMain+`/api/delete_cat_idioms/${$id}`, {responseType: 'blob'}).then(response => {
                this.getCatIdioms();
                this.stopLoading();
                this.$message({
                    type: "success",
                    title: 'Éxito',
                    message: "El registro se eliminó correctamente"
                });
            }).catch(error => {
                this.stopLoading();
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        }).catch(() => {
            this.$message({
                type: 'info',
                message: 'Eliminación cancelada'
            });
        });
        },

        deleteBoxRowCat($id){
            this.$confirm('Esta acción eliminara el registro del sistema', 'Precaución', {
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            type: 'warning'
        }).then(() => {
            this.startLoading();
            axios.delete(this.urlMain+`/api/delete_cat_box/${$id}`, {responseType: 'blob'}).then(response => {
                this.getCatBox();
                this.stopLoading();
                this.$message({
                    type: "success",
                    title: 'Éxito',
                    message: "El registro se eliminó correctamente"
                });
            }).catch(error => {
                this.stopLoading();
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        }).catch(() => {
            this.$message({
                type: 'info',
                message: 'Eliminación cancelada'
            });
        });
        },

        deleteDocumentaryGroupRowCat($id){
            this.$confirm('Esta acción eliminara el registro del sistema', 'Precaución', {
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            type: 'warning'
        }).then(() => {
            this.startLoading();
            axios.delete(this.urlMain+`/api/delete_cat_documentary_group/${$id}`, {responseType: 'blob'}).then(response => {
                this.getCatDocumentaryGroup();
                this.stopLoading();
                this.$message({
                    type: "success",
                    title: 'Éxito',
                    message: "El registro se eliminó correctamente"
                });
            }).catch(error => {
                this.stopLoading();
                // this.$message({
                //     type: "warning",
                //     message: "No fue posible completar la acción, intente nuevamente."
                // });
            });
        }).catch(() => {
            this.$message({
                type: 'info',
                message: 'Eliminación cancelada'
            });
        });
        },
        // Eliminar catalogos
        // Eliminar catalogos
    }
}

export const boxdialog={
    data(){
        return{

            cajaForm:{
                box:                     null,
                fileName:                null,   
                place:                   null,
                depositRoom:             null,
                corridor:                null,
                shelf:                   null,
                strep:                   null,
            }
        }
    },

    mounted(){

     },
    computed: {
        urlMain() {
        return window.URL;
        }
    },
     methods:{
        newBox() {
            this.showLoading("Guardando registro");
            let data = this.cajaForm;
            axios.post(this.urlMain + "/api/box", data).then(response => {
            this.dialogFormVisible = false;
            this.$router.push("/acervo/archivo/nuevoArchivo");
            this.getCatBox();
            this.archivoForm.box_id = response.data.box;
            this.stopLoading();
        })
            .catch(error => {
            console.log(error.response.data.errors);
            this.errors = error.response.data.errors;
            this.stopLoading();
            });
        },
        
    }
}
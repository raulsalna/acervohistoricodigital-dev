<template>
  <div>
    <el-upload
      ref="upload"
      class="upload-demo"
      :before-upload="startLoading"
      :on-success="successfile"
      :on-error="showErrorMessage"
      :headers="{ Authorization: apiToken }"
      action="/api/importExcel"
      accept="application/vnd.ms-excel,  application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
      name="document"
      :limit="1"
    >
      <el-button size="small" icon="far fa-file-excel" type="primary">
        Carga Masiva</el-button
      >
    </el-upload>
    <el-alert
      v-show="errores.length > 1"
      title="!Error"
      type="error"
      @close="cleanError"
      >{{ this.errores }}
    </el-alert>
  </div>
</template>

<script>
export default {
  data() {
    return {
      apiToken: "Bearer " + sessionStorage.getItem("ACERVO_token"),
      errors: [],
      errores: "",
    };
  },
  methods: {
      startLoading() {
      this.$store.dispatch(
        "loading/spinner",
        {
          msg: "Cargando Datos...",
          status: true
        },
        {
          root: true
        }
      );
    },

    stopLoading() {
      this.$store.dispatch(
        "loading/spinner",
        {},
        {
          root: true
        }
      );
    },
    apiImport() {
      return `${this.urlMain}/api/importExcel`;
    },
    limpiar_archivo_previo(){
      this.$refs.upload.clearFiles();
    },
    successfile(response, file, fileList) {
      if (response.success == true && !response.message) {
        this.$message.success({
          duration: 10000,
          showClose: true,
          message:`El archivo ${file.name} cargado con exito`
        });
      }
      if (response.success == true && response.message) {
        if (
          response.message ==
          "Validation rule unique requires at least 1 parameters."
        ) {
          response.message =
            "Se encontraron registros con campo: 'CODIGO', existentes en la base de datos o en el archivo excel duplicados, limpiar lista de archivos antes de volver a intentar";
          this.errores = response.message;
        }
      }
      if (response.success == false && response.message) {
        this.$message.warning({
          duration: 10000,
          showClose: true,
          message: `El archivo ${file.name} presenta el siguiente error en  el registro ${response.row} :  ${response.errors}`
        }
        );
      }
      if (response.success == false && response.row) {
        this.$message.warning({
          duration: 10000,
          showClose: true,
          message: `El archivo ${file.name} presenta el siguiente error en  el registro ${response.row} :  ${response.errors}`
        });
      }
      this.$refs.upload.clearFiles();
      this.stopLoading();

    },
    showErrorMessage(err, file, fileList) {
      this.$message.warning(`El archivo ${file.name} presenta errores${err}`);
      this.$refs.upload.clearFiles();
      this.stopLoading();
    },
    cleanError() {
      this.errores = "";
      this.$refs.upload.clearFiles();
    },
  },
  computed: {
    urlMain() {
      return window.URL;
    },
  },
};
</script>

export const messages = {
  methods: {
    registerMessage() {
      return this.$message({
        type: "success",
        title: "Éxito",
        message: "Éxito, Registro guardado con éxito"
      });
    },
    updateMessage() {
      return this.$message({
        type: "success",
        title: "Éxito",
        message: "Éxito, Registro actualizado con éxito"
      });
    },
    deleteMessage() {
      return this.$message({
        type: "success",
        title: "Éxito",
        message: "Éxito, Registro eliminado con éxito"
      });
    },
    existMessage($error_value) {
      if ($error_value ==2) {
        return this.$message({
          type: "warning",
          title: "Aviso",
          message: "Este Título ya esta registrado,se sugiere cambiarlo"
        });
      }
      if ($error_value ==1) {
        return this.$message({
          type: "warning",
          title: "Aviso",
          message: "Esta Caja ya esta registrado,se sugiere cambiarlo"
        });
      }
      return 0;
    }
  }
};

<template>
  <div>
    <header-section icon="fas fa-archive" title="Caja">
      <template slot="buttons">
        <el-button
          icon="el-icon-circle-plus-outline"
          align="right"
          size="small"
          @click.native="dialogVisible = true"
          type="success"
        >Agregar caja</el-button>
        <el-button
          align="right"
          size="small"
          type="danger"
          icon="el-icon-arrow-left"
          @click="$router.push('/acervo')"
        >Regresar</el-button>
      </template>
    </header-section>
    <br />
    <TableIndex :key="componentKey"></TableIndex>
    <!-- //Dialog new Box -->
    <el-dialog :visible.sync="dialogVisible" :destroy-on-close="true" width="90%">
      <div>
        <NewBox
          @dialogCancel="dialogValueCancel"
          @dialogFalsevalue="dialogValueFalse"
          :key="newBoxKey"
        ></NewBox>
      </div>
      <span slot="footer" class="dialog-footer"></span>
    </el-dialog>
    <!-- //Fin Dialog new Box -->
  </div>
</template>


<script>
import HeaderSection from "../layouts/partials/HeaderSection";
import TableIndex from "../box/partials/TableIndex";
// import ContactForm from "../box/partials/ContactForm";
import NewBox from "../box/partials/NewBox";

export default {
  components: {
    HeaderSection,
    TableIndex,
    NewBox
    // ContactForm
  },
  computed: {
    urlMain() {
      return window.URL;
    }
  },
  data() {
    return {
      // search: null,
      dialogVisible: false,
      dialogShowVisible: false,

      componentKey: 0,
      newBoxKey: 0
    };
  },
  methods: {
    resetNewBox() {
      this.newBoxKey += 1;
    },
    dialogValueCancel(dialogCancelValue) {
      this.dialogVisible = dialogCancelValue;
    },
    dialogValueFalse(dialogFalse) {
      this.dialogVisible = dialogFalse;
      this.componentKey += 1;
    },
    goTo(link, data) {
      axios
        .post(this.urlMain + "/api/transaction", data)
        .then(response => {
          this.$router.push({
            name: link
          });
        })
        .catch(error => {
          this.$message({
            type: "warning",
            message: "No fue posible completar la acción, intente nuevamente."
          });
        });
    }
  }
};
</script>

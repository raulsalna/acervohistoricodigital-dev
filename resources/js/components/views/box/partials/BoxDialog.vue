<template>
  <div>
    <el-button type="text" @click="dialogVisible = true">click to open the Dialog</el-button>

    <el-dialog title="Tips" :visible.sync="dialogVisible" width="80%" :before-close="handleClose">
    <el-form ref="cajaForm" :model="cajaForm" label-width="120px" label-position="top">
      <div>
        <NewBox
          :cajaForm="cajaForm"
        ></NewBox>
      </div>
    </el-form>
    <!-- <span>This is a message</span> -->
      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogVisible = false">Cancel</el-button>
        <el-button type="primary" @click="dialogVisible = false">Confirm</el-button>
      </span>
    </el-dialog>
  </div>
</template>
<script>
import ContactForm from "./ContactForm";
import NewBox from "./NewBox";

export default {
  components: {
    ContactForm,
    NewBox
  },

  data() {
    return {
      cajaForm: {
        fileName: "",
        place: "",
        depositRoom: "",
        corridor: "",
        shelf: "",
        strep: "",
        box: ""
      },
      valor: false,
      valor2: null,
      dialogVisible: false
    };
  },
  props: ["dialogFormVisible"],

  methods: {
    handleClose(done) {
      this.$confirm("Are you sure to close this dialog?")
        .then(_ => {
          done();
        })
        .catch(_ => {});
    },
    updatedialogFormVisible() {
      let dialogFormVisibleUpdate = this.dialogFormVisible;
      dialogFormVisibleUpdate = false;
      this.$emit("update-dialogFormVisible", dialogFormVisibleUpdate);
    },
    updatePlace() {
      this.valor = this.dialogFormVisible;
    }
  },
  mounted() {
    //this.updatePlace();
  },
  watch: {
    dialogFormVisible: function(val) {
      this.valor = this.dialogFormVisible;
    }
  }
};
</script>

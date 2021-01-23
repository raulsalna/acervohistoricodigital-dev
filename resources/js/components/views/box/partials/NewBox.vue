<template>
  <div>
    <header-section icon="fas fa-archive" title="Agregar Caja"></header-section>
    <el-form
      id="cajaForm"
      ref="cajaForm"
      :model="cajaForm"
      label-width="120px"
      label-position="top"
    >
      <el-row :gutter="10">
        <el-col :span="24">
          <el-form-item label="Caja*">
            <el-input v-model="cajaForm.box" maxlength="100"></el-input>
            <span v-for="error in errors.box" :key="error.box">
              <p style="color: red">El campo (Caja) es requerido</p>
            </span>
            <span v-if="box_existe">
              <p style="color: red">
                Esta Caja ya esta registrada, se sugiere cambiarlo
              </p>
            </span>
          </el-form-item>
        </el-col>
      </el-row>

      <el-row :gutter="10">
        <el-col :span="8">
          <el-form-item label="Título*">
            <el-input v-model="cajaForm.fileName" maxlength="100"></el-input>
            <span v-for="error in errors.fileName" :key="error.fileName">
              <p style="color: red">El campo (Título) es requerido</p>
            </span>
            <span v-if="titulo_existe">
              <p style="color: red">
                Este Título ya esta registrado, se sugiere cambiarlo
              </p>
            </span>
          </el-form-item>
        </el-col>
        <el-col :span="8">
          <el-form-item label="Lugar*">
            <el-input v-model="cajaForm.place" maxlength="100"></el-input>
            <span v-for="error in errors.place" :key="error.place">
              <p style="color: red">El campo (Lugar) es requerido</p>
            </span>
          </el-form-item>
        </el-col>
        <el-col :span="8">
          <el-form-item label="Sala de depósito*">
            <el-input v-model="cajaForm.depositRoom" maxlength="100"></el-input>
            <span v-for="error in errors.depositRoom" :key="error.depositRoom">
              <p style="color: red">El campo (Sala de depósito) es requerido</p>
            </span>
          </el-form-item>
        </el-col>
      </el-row>
      <el-row :gutter="10">
        <el-col :span="8">
          <el-form-item label="Pasillo*">
            <el-input v-model="cajaForm.corridor" maxlength="100"></el-input>
            <span v-for="error in errors.corridor" :key="error.corridor">
              <p style="color: red">El campo (Pasillo) es requerido</p>
            </span>
          </el-form-item>
        </el-col>
        <el-col :span="8">
          <el-form-item label="Estante*">
            <el-input v-model="cajaForm.shelf" maxlength="100"></el-input>
            <span v-for="error in errors.shelf" :key="error.shelf">
              <p style="color: red">El campo (Estante) es requerido</p>
            </span>
          </el-form-item>
        </el-col>
        <el-col :span="8">
          <el-form-item label="Estrepaño*">
            <el-input v-model="cajaForm.strep" maxlength="100"></el-input>
            <span v-for="error in errors.strep" :key="error.strep">
              <p style="color: red">El campo (Estrepaño) es requerido</p>
            </span>
          </el-form-item>
        </el-col>
      </el-row>
      <el-row :gutter="10">
        <el-col :span="22">
          <el-button
            size="small"
            icon="el-icon-circle-check"
            style="float: right"
            type="success"
            @click="newBox"
          >
            Guardar</el-button
          >
        </el-col>
        <el-col :span="2">
          <el-button
            size="small"
            icon="el-icon-circle-close"
            style="float: right"
            @click.native="cancelCajaForm"
            type="danger"
            >Cancelar</el-button
          >
        </el-col>
      </el-row>
    </el-form>
  </div>
</template>

<script>
import HeaderSection from "../../layouts/partials/HeaderSection";
import Vue from "vue";
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
import store from "../../../../store/index";
import { mask } from "vue-the-mask";
import onlyInt, { onlyFloat } from "vue-input-only-number";
import { messages } from "../../../../mixins/Messages";

export default {
  components: {
    HeaderSection,
  },
  mixins: [messages],
  data() {
    return {
      cajaForm: {
        fileName: "",
        place: "",
        depositRoom: "",
        corridor: "",
        shelf: "",
        strep: "",
        box: "",
      },
      errors: [],
      box_existe:"",
      titulo_existe:""
    };
  },
  // props: ["cajaForm"],
  computed: {
    urlMain() {
      return window.URL;
    },
  },
  watch: {
    "cajaForm.fileName": function (value) {
      this.cajaForm.fileName = value.replace(
        /[#$%&?|+=*!<>"';()/{}[\]\\]/g,
        ""
      );
    },
    "cajaForm.place": function (value) {
      this.cajaForm.place = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
    },
    "cajaForm.depositRoom": function (value) {
      this.cajaForm.depositRoom = value.replace(
        /[#$%&?|+=*!<>"';()/{}[\]\\]/g,
        ""
      );
    },
    "cajaForm.corridor": function (value) {
      this.cajaForm.corridor = value.replace(
        /[#$%&?|+=*!<>"';()/{}[\]\\]/g,
        ""
      );
    },
    "cajaForm.shelf": function (value) {
      this.cajaForm.shelf = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
    },
    "cajaForm.strep": function (value) {
      this.cajaForm.strep = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
    },
    "cajaForm.box": function (value) {
      this.cajaForm.box = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
    },
  },

  methods: {
    cancelCajaForm() {
      this.$refs["cajaForm"].resetFields();
      if (this.errors != null) this.errors = [];
      let dialogCancelValue = false;
      this.$emit("dialogCancel", dialogCancelValue);
    },
    newBox() {
      this.errors = [];
      this.box_existe="";
      this.titulo_existe="";
      let data = this.cajaForm;
      axios
        .post(this.urlMain + "/api/box", data)
        .then((response) => {
          if(response.data.titulo_existe && response.data.titulo_existe==true){this.titulo_existe=true; this.existMessage(2); return 0;}
          if(response.data.box_existe && response.data.box_existe==true){this.box_existe=true; this.existMessage(1); return 0;}
          // console.log("ESta es la respuesta obtenida si ya existe el titulo: "+response.data.titulo_existe);
          let dialogFalse = false;
          this.$emit("dialogFalsevalue", dialogFalse);
          //this.$router.go(this.urlMain + "acervo/caja/");
          this.registerMessage();
          this.$refs["cajaForm"].resetFields();
        })
        .catch((error) => {
          if (error.response.data.errors) {
            this.errors = error.response.data.errors;
          }
          if (error.response.data.errors.box_existe){this.box_existe=error.response.data.errors.box_existe;}
          if (error.response.data.errors.title_existe){this.title_existe_existe=error.response.data.errors.title_existe_existe;}
        });
    },
  },
};
</script>

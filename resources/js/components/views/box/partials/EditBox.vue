<template>
  <div>
    <el-row style="margin-top: 25px;margin-bottom: 10px">
      <el-divider content-position="left">
        <h3>Ubicación Topográfica de la Caja : [{{boxForm.box}}]</h3>
      </el-divider>
    </el-row>
    <el-form :model="boxForm" label-width="120px" label-position="top">
      <el-row :gutter="10">
        <el-col :span="8">
          <el-form-item label="Título">
            <el-input v-model="boxForm.fileName" maxlength="100"></el-input>
            <span v-for="error in errors.fileName" :key="error.fileName">
              <p style="color:red">El campo (Título) es requerido</p>
            </span>
            <span v-if="titulo_existe">
              <p style="color: red">
                Este Título ya esta registrado, se sugiere cambiarlo
              </p>
            </span>
          </el-form-item>
        </el-col>
        <el-col :span="8">
          <el-form-item label="Lugar">
            <el-input v-model="boxForm.place" maxlength="100" ></el-input>
            <span v-for="error in errors.place" :key="error.place">
              <p style="color:red">El campo (Lugar) es requerido</p>
            </span>
          </el-form-item>
        </el-col>
        <el-col :span="8">
          <el-form-item label="Sala de depósito">
            <el-input v-model="boxForm.depositRoom" maxlength="100" ></el-input>
            <span v-for="error in errors.depositRoom" :key="error.depositRoom">
              <p style="color:red">El campo (Sala de depósito) es requerido</p>
            </span>
          </el-form-item>
        </el-col>
      </el-row>
      <el-row :gutter="10">
        <el-col :span="8">
          <el-form-item label="Pasillo">
            <el-input v-model="boxForm.corridor" maxlength="100"></el-input>
            <span v-for="error in errors.corridor" :key="error.corridor">
              <p style="color:red">El campo (Pasillo) es requerido</p>
            </span>
          </el-form-item>
        </el-col>
        <el-col :span="8">
          <el-form-item label="Estante">
            <el-input v-model="boxForm.shelf" maxlength="100"></el-input>
            <span v-for="error in errors.shelf" :key="error.shelf">
              <p style="color:red">El campo (Estante) es requerido</p>
            </span>
          </el-form-item>
        </el-col>
        <el-col :span="8">
          <el-form-item label="Estrepaño">
            <el-input v-model="boxForm.strep" maxlength="100"></el-input>
            <span v-for="error in errors.strep" :key="error.strep">
              <p style="color:red">El campo (Estrepaño) es requerido</p>
            </span>
          </el-form-item>
        </el-col>
      </el-row>
      <!-- <el-row :gutter="10">
        <el-col :span="8">
          <el-form-item label="Caja">
            <el-input v-model="boxForm.box" maxlength="100"></el-input>
            <span v-for="error in errors.box" :key="error.box">
              <p style="color:red">El campo (Caja) es requerido</p>
            </span>
          </el-form-item>
        </el-col>
      </el-row>
      <el-row :gutter="10"> -->
        <el-col :span="22">
          <el-button
            size="small"
            icon="el-icon-circle-check"
            style="float:right;"
            type="success"
            @click="updateBox"
          >Actualizar</el-button>
        </el-col>
        <el-col :span="2">
          <el-button
            size="small"
            icon="el-icon-circle-close"
            style="float:right;"
            @click.native="$router.replace('/acervo/caja')"
            type="danger"
          >Cancelar</el-button>
        </el-col>
    </el-form>
  </div>
</template>

<script>
import Vue from "vue";
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
import store from "../../../../store/index";
import { mask } from "vue-the-mask";
import onlyInt, { onlyFloat } from "vue-input-only-number";
import { messages } from "../../../../mixins/Messages";

export default {
  mixins: [messages],
  data() {
    return {
      errors: [],
      boxs: [],
      boxForm: {
        fileName: "",
        place: "",
        depositRoom: "",
        corridor: "",
        shelf: "",
        strep: "",
        box: "",

      },
      box_existe:"",
      titulo_existe:"",
      originalTitle:""
    };
  },
  computed: {
    urlMain() {
      return window.URL;
    }
  },
  watch: {
    "boxForm.fileName": function(value) {this.boxForm.fileName = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");},
    "boxForm.place": function(value) {this.boxForm.place = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");},
    "boxForm.depositRoom": function(value) {this.boxForm.depositRoom = value.replace(
        /[#$%&?|+=*!<>"';()/{}[\]\\]/g,
        ""
      );},
    "boxForm.corridor": function(value) {this.boxForm.corridor = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");},
    "boxForm.shelf": function(value) {this.boxForm.shelf = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");},
    "boxForm.strep": function(value) {this.boxForm.strep = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");},
    "boxForm.box": function(value) {this.boxForm.box = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");}
  },

  methods: {
    editBox() {
      this.startLoading();
      axios
        .get(this.urlMain + `/api/box/${this.$route.params.hash}` + "/edit")
        .then(response => {
          this.boxForm =response.data.boxs;
          // this.originalTitle=this.boxForm.fileName;
          this.originalTitle=response.data.boxs.fileName;

          this.stopLoading();
        })
        .catch(error => {
          this.stopLoading();
          this.$message({
            type: "warning",
            message:
              "No fue posible completar la acción de Mostrar Box, intente nuevamente."
          });
        });
    },
    updateBox() {
      this.errors = [];
      this.box_existe="";
      this.titulo_existe="";
      const data = this.boxForm;
      axios
        .put(this.urlMain + `/api/box/${this.$route.params.hash}`, data)
        .then(response => {
          if(response.data.titulo_existe && response.data.titulo_existe==true){this.titulo_existe=true; this.existMessage(2); return 0;}
          if(response.data.box_existe && response.data.box_existe==true){this.box_existe=true; this.existMessage(1); return 0;}
          this.$router.push("/acervo/caja/");
          this.updateMessage();
        })
        .catch(error => {
          this.errors = error.response.data.errors;
          if (error.response.data.errors.box_existe){this.box_existe=error.response.data.errors.box_existe;}
          if (error.response.data.errors.title_existe){this.title_existe_existe=error.response.data.errors.title_existe_existe;}

          this.$message({
            type: "warning",
            message:
              "No fue posible completar la acción de Actualizar Box, intente nuevamente."
          });
        });
    }
  },
  created() {
    this.editBox();
  }
};
</script>

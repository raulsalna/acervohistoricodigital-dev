<template>
  <div>
    <el-row style="margin-top: 25px;margin-bottom: 10px">
      <el-divider content-position="left">
        <h3>Ubicación Topográficas</h3>
      </el-divider>
    </el-row>
    <el-form :model="boxForm" label-width="120px" label-position="top" disabled>

    <el-row :gutter="10">
      <el-col :span="8">
        <el-form-item label="Título" >
          <el-input v-model="boxForm.fileName" maxlength="100"></el-input>
          <span v-for="error in errors.fileName" :key="error.fileName">
            <p style="color:red">El campo (Título) es requerido</p>
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
          <el-input v-model="boxForm.depositRoom" maxlength="100"></el-input>
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
    <el-row :gutter="10">
      <el-col :span="8">
        <el-form-item label="Caja">
          <el-input v-model="boxForm.box" maxlength="100"></el-input>
          <span v-for="error in errors.box" :key="error.box">
            <p style="color:red">El campo (Caja) es requerido</p>
          </span>
        </el-form-item>
      </el-col>
    </el-row>
    </el-form>
  </div>
</template>

<script>
import Vue from "vue";
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
import store from "../../../../store/index";
import { mask } from "vue-the-mask";
import onlyInt, { onlyFloat } from "vue-input-only-number";
export default {
  data() {
    return {
      boxForm:
        {
          fileName:"",
          place: "",
          depositRoom: "",
          corridor: "",
          shelf: "",
          strep: "",
          box: ""
        },
      errors: []
    };
  },
  computed: {
    urlMain() {
      return window.URL;
    }
  },
  methods: {
    showBox() {
      this.startLoading();
      axios
        .get(this.urlMain + `/api/box/${this.$route.params.hash}`)
        .then(response => {
          this.boxForm = response.data.boxs;
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
    }
  },
  created() {
    this.showBox();
  }
};
</script>

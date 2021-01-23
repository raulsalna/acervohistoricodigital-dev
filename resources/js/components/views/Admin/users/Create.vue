<template>
  <div>
    <header-section
      icon="fa-user-plus"
      title="Nuevo usuario

        "
    >
      <template slot="buttons">
        <el-button
          size="medium"
          type="danger"
          icon="el-icon-arrow-left"
          @click="$router.push('/acervo/administracion/usuarios')"
          >Regresar</el-button
        >
      </template>
    </header-section>
    <el-form
      ref="userForm"
      :model="userForm"
      label-width="120px"
      label-position="top"
    >
      <el-row :gutter="10">
        <el-col :span="8">
          <el-form-item label="Usuario">
            <el-input v-model="userForm.username" maxlength="100">
              <el-button
                slot="append"
                @click.native="getUsers()"
                icon="el-icon-search"
              ></el-button>
            </el-input>
            <span
              v-for="error in errors.username"
              :key="error.username"
            >
              <p style="color:red">El campo (Usuario) es requerido</p>
            </span>
          </el-form-item>
        </el-col>
        <el-col :span="8">
        </el-col>
      </el-row>
      <el-row :gutter="10">
        <el-col :span="8">
          <el-form-item label="Nombre (s)">
            <el-input
              v-model="userForm.name"
              maxlength="100"
              disabled
            ></el-input>
            <span
              v-for="error in errors.name"
              :key="error.name"
            >
              <p style="color:red">El campo (Nombre) es requerido</p>
            </span>
          </el-form-item>
        </el-col>
        <el-col :span="8">
          <el-form-item label="Primer apellido">
            <el-input
              v-model="userForm.firstName"
              maxlength="100"
              disabled
            ></el-input>
            <span
              v-for="error in errors.firstName"
              :key="error.firstName"
            >
              <p style="color:red">El campo (Primer apellido) es requerido</p>
            </span>

          </el-form-item>
        </el-col>
        <el-col :span="8">
          <el-form-item label="Segundo apellido">
            <el-input
              v-model="userForm.secondName"
              maxlength="100"
              disabled
            ></el-input>
          </el-form-item>
        </el-col>
      </el-row>
      <el-row :gutter="10">
        <el-col :span="12">
          <el-form-item
            label="Rol de usuario"
            :rules="stdRule"
            :required="true"
          >
            <el-select
              v-model="userForm.cat_profile_id"
              filterable
              placeholder="Seleccionar"
              style="width: 100%"
              :disabled="isDisabled"
            >
              <el-option
                v-for="(profile, index) in profiles"
                :key="index"
                :label="profile.name"
                :value="profile.id"

              ></el-option>
            </el-select>
            <span
              v-for="error in errors.cat_profile_id"
              :key="error.cat_profile_id"
            >
              <p style="color:red">El campo (Rol de usuario es requerido)</p>
              <!-- <small style="color:red">{{error}}</small> -->
            </span>
          <header-section v-show="userForm.cat_profile_id==2" title="Privilegios de capturista:"></header-section>
          <el-checkbox-group v-show="userForm.cat_profile_id==2" v-model="userForm.userAttributes"  border="true">
            <el-checkbox label=3>Editar</el-checkbox>
            <el-checkbox label=4>Eliminar</el-checkbox>
            <el-checkbox label=1>Ver</el-checkbox>
          </el-checkbox-group>
          </el-form-item>
        </el-col>
      </el-row>
      <el-row :gutter="10">
        <el-col :span="5" :offset="14">
          <el-button type="primary" style="width: 100%" @click="cleanAll()"
            >Limpiar</el-button
          >
        </el-col>
        <el-col :span="5">
          <el-button
            type="success"
            style="width: 100%"
            @click="submitForm"
            :disabled="isDisabled"
            >Guardar</el-button
          >
        </el-col>
      </el-row>
    </el-form>
                <!-- :disabled="isDisabled" -->

  </div>
</template>

<script>
import HeaderSection from "../../layouts/partials/HeaderSection";

export default {
  components: {
    HeaderSection
  },

  watch: {
    "userForm.username": function(value) {
      this.userForm.username = value.replace(
        /[#$%&?|+=*!<>"';()/{}[\]\\]/g,
        ""
      );
    },
    "userForm.name": function(value) {
      this.userForm.name = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
    },
    "userForm.firstName": function(value) {
      this.userForm.firstName = value.replace(
        /[#$%&?|+=*!<>"';()/{}[\]\\]/g,
        ""
      );
    },
    "userForm.secondName": function(value) {
      this.userForm.secondName = value.replace(
        /[#$%&?|+=*!<>"';()/{}[\]\\]/g,
        ""
      );
    },
  },

  data() {
    return {
      errors: [],
      users: [],
      profiles: [],
      userForm: {
        username: "",
        cat_profile_id: null,
        name: "",
        firstName: "",
        secondName: "",
        userRepresentation: [],
        userAttributes: [],
      },
      isDisabled: true,
      loco: true,
      stdRule: [
        {
          required: true,
          message: "El campo (Descripción) es requerido",
          trigger: ["blur", "change"]
        }
      ],

    };
  },

  mounted() {
    this.getCatProfile();
  },
  computed: {
    urlMain() {
      return window.URL;
    }
  },

  methods: {
    getUsers() {
      this.startLoading();
      this.isDisabled = true;
      const params = {
        username: this.userForm.username
      };
      axios
        .post(this.urlMain + "/api/intgra/getUser", params)
        .then(response => {
          if (response.data.userForm === null) {
            this.cleanAll();
            this.stopLoading();
          } else {
            this.userForm.name = response.data.userForm.name;
            this.userForm.username = response.data.userForm.username;
            this.userForm.firstName = response.data.userForm.firstName;
            this.userForm.secondName = response.data.userForm.secondName;
            this.isDisabled = false;
            this.stopLoading();
          }
        })
        .catch(error => {
          this.stopLoading();
        });
    },

    getCatProfile() {
      axios
        .get(this.urlMain + "/api/profiles")
        .then(response => {
          this.profiles = response.data;
          this.stopLoading();
        })
        .catch(error => {
          this.stopLoading();
        });
    },

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

    cleanAll() {
      this.userForm.username = "";
      this.userForm.cat_profile_id = null;
      this.userForm.name = "";
      this.userForm.firstName = "";
      this.userForm.secondName = "";
      this.isDisabled = true;
      this.userForm.userRepresentation = null;
      this.userForm.userAttributes = [];

    },

    submitForm() {

      let coma = ",";
      console.log(coma);
      let sincoma = "";
      let userAttributes2 = "";
      userAttributes2 = this.userForm.userAttributes.toString().replace(coma, sincoma);
      let userAttributes3 = userAttributes2.toString().replace(coma, sincoma);
      this.userForm.userAttributes= userAttributes3;
      const params = {
        userForm: this.userForm,
      };
      this.startLoading();

      axios
        .post(this.urlMain + "/api/users", params.userForm)
        .then(response => {
          this.stopLoading();
          if (response.data.exist === true) {
            this.$message({
              type: "warning",
              message: "El usuario ya se encuentra registrado en el sistema"
            });
          } else {
            this.$router.replace("/acervo/administracion/usuarios");
            this.stopLoading();
            this.$message({
              type: "success",
              title: "Éxito",
              message: "Se almacenó la información correctamente"
            });
          }
        })
        .catch(error => {
          this.errors = error.response.data.errors;
          this.stopLoading();
        });
    }
  }
};
</script>

<style scoped></style>

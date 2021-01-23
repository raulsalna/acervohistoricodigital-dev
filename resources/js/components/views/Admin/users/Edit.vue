<template>
    <div>
        <header-section icon="fa-user-plus" title="Editar usuario">
            <template slot="buttons">
                <el-button size="medium" type="danger" icon="el-icon-arrow-left" @click="$router.push('/acervo/administracion/usuarios')"> Regresar </el-button>
            </template>
        </header-section>
        <el-form ref="userForm" :model="userForm" label-width="120px" label-position="top">
            <!-- <el-row :gutter="10"> -->
                <el-row :gutter="10">
                    <el-col :span="8">
                        <el-form-item label="Nombre de usuario"
                                    prop="username"
                                    :rules="[
                                        { required: true, message: 'Este campo es requerido', trigger: 'blur'},
                                    ]">
                            <el-input disabled v-model="userForm.username" maxlength="100"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item label="Nombre"
                                  prop="name"
                                  :rules="[
                                    { required: true, message: 'Este campo es requerido', trigger: 'blur'},
                                  ]">
                        <el-input disabled v-model="userForm.name" maxlength="100"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Primer apellido"
                                  prop="firstName"
                                  :rules="[
                                    { required: true, message: 'Este campo es requerido', trigger: 'blur'},
                                  ]">
                        <el-input disabled v-model="userForm.firstName" maxlength="100"></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Segundo apellido">
                        <el-input  disabled v-model="userForm.secondName" maxlength="100"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="12">
                    <el-form-item label="Rol de usuario"
                                  prop="cat_profile_id"
                                  :rules="[
                                    { required: true, message: 'Este campo es requerido', trigger: 'blur'},
                                  ]">
                        <el-select v-model="userForm.cat_profile_id"
                                   filterable placeholder="Seleccionar"
                                   @change="changeProfile(userForm.cat_profile_id)"
                                   style="width: 100%">
                            <el-option
                                v-for="(profile , index) in profiles"
                                :key="index"
                                :label="profile.name"
                                :value="profile.id">
                            </el-option>
                        </el-select>
                        <header-section v-show="userForm.cat_profile_id==2" title="Privilegios de capturista:"></header-section>
                        <el-checkbox-group v-show="userForm.cat_profile_id==2" v-model="userAttributes"  border="true">
                          <el-checkbox label=3>Editar</el-checkbox>
                          <el-checkbox label=4>Eliminar</el-checkbox>
                          <el-checkbox label=1>Ver</el-checkbox>
                        </el-checkbox-group>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="5" :offset="19">
                    <el-button :disabled="updateDisabled == true" type="success" style="width: 100%" @click="submitForm">
                        Actualizar
                    </el-button>
                </el-col>
            </el-row>
        </el-form>
    </div>
</template>
<script>
import HeaderSection from "../../layouts/partials/HeaderSection";

export default {
  components: {
    HeaderSection,
  },

  watch: {
    "userForm.name": function (value) {
      this.userForm.name = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
    },
    "userForm.firstName": function (value) {
      this.userForm.firstName = value.replace(
        /[#$%&?|+=*!<>"';()/{}[\]\\]/g,
        ""
      );
    },
    "userForm.secondName": function (value) {
      this.userForm.secondName = value.replace(
        /[#$%&?|+=*!<>"';()/{}[\]\\]/g,
        ""
      );
    },
  },

  data() {
    return {
      errors: [],
      profiles: [],
      updateDisabled: false,
      userForm: {
        cat_profile_id: null,
        name: "",
        firstName: "",
        secondName: "",
        username: "",
      },
      userAttributes: [],
    };
  },
  computed: {
    urlMain() {
      return window.URL;
    },
  },
  created() {
    this.startLoading();
    axios
      .get(this.urlMain + "/api/users/" + this.$route.params.id + "/edit")
      .then((response) => {
        this.profiles = response.data.profiles;
        this.userForm = response.data.userForm;
        if (this.userForm.cat_transaction_id != null) {
          console.log(this.userForm.cat_transaction_id.toString().length);
          if (this.userForm.cat_transaction_id.toString().length > 0)
            this.userAttributes.push(
              this.userForm.cat_transaction_id.toString().substr(0, 1)
            );
          if (this.userForm.cat_transaction_id.toString().length > 1)
            this.userAttributes.push(
              this.userForm.cat_transaction_id.toString().substr(1, 1)
            );
          if (this.userForm.cat_transaction_id.toString().length > 2)
            this.userAttributes.push(
              this.userForm.cat_transaction_id.toString().substr(2, 1)
            );
        }
        this.stopLoading();
      })
      .catch((error) => {
        this.stopLoading();
        this.errors = error.response.data.errors;
        this.$message({
          type: "warning",
          message: "No fue posible completar la acción, intente nuevamente.",
        });
      });
  },

  methods: {
    cleanAll() {
      this.userForm.username = "";
      this.userForm.cat_profile_id = null;
      this.userForm.cat_consulate_id = null;
      this.userForm.cat_mission_id = null;
      this.userForm.cat_organism_id = null;
      this.userForm.topics = [];
      this.userForm.name = "";
      this.userForm.firstName = "";
      this.userForm.secondName = "";
    },

    changeProfile(profileId) {
      this.startLoading();

      axios
        .get(this.urlMain + `/api/get-topics/${btoa(profileId)}`)
        .then((response) => {
          this.stopLoading();
        })
        .catch((error) => {
          this.stopLoading();

          this.$message({
            type: "warning",
            message: "No fue posible completar la acción, intente nuevamente.",
          });
        });
    },

    submitForm() {
      this.startLoading();
      let coma = ",";
      let sincoma = "";
      let userAttributes2 = "";
      userAttributes2 = this.userAttributes.toString().replace(coma, sincoma);
      let userAttributes3 = userAttributes2.toString().replace(coma, sincoma);

      const params = {
        userForm: this.userForm,
        userAttributes: userAttributes3,
      };
      this.$refs["userForm"].validate((valid) => {
        if (valid) {
          axios
            .put(this.urlMain + `/api/users/${this.$route.params.id}`, params)
            .then((response) => {
              this.stopLoading();

              this.$message({
                type: "success",
                title: "Éxito",
                message: "Se actualizo la información correctamente",
              });

              this.$router.push("/acervo/administracion/usuarios");
            })
            .catch((error) => {
              this.stopLoading();

              this.$message({
                type: "warning",
                message:
                  "No fue posible completar la acción, intente nuevamente.",
              });
            });
        } else {
          this.stopLoading();
        }
      });
    },
  },
};
</script>

<style scoped>
</style>

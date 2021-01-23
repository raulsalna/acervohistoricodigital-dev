<template>
  <div>
    <header-section icon="el-icon-document-add" title="Catálogos">
      <template slot="buttons">
        <el-button
          size="small"
          type="danger"
          icon="el-icon-arrow-left"
          @click="$router.push('/acervo/administracion/')"
        >
          Regresar
        </el-button>
      </template>
    </header-section>

    <el-row :gutter="10">
      <el-col :span="24">
        <el-select
          v-model="selectedCat"
          placeholder="Seleccione un catálogo"
          style="width: 100%"
        >
          <el-option
            v-for="(cat, index) in cats_index"
            :key="index"
            :label="cat.name"
            :value="cat.id"
          >
          </el-option>
        </el-select>
      </el-col>
    </el-row>

    <br />
    <el-row>
      <!-- Catálogo Input y Boton de Catálogo  -->
      <!-- Catálogo Input y Boton de Catálogo  -->
      <el-form
        ref="newGeneralCatForm"
        :model="newGeneralCatForm"
        label-width="120px"
        label-position="top"
        v-if="GeneralCat"
      >
        <el-row :gutter="10">
          <el-col :span="24">
            <br />
            <el-form-item prop="name" label="Catálogo">
              <el-input placeholder="Nuevo" v-model="newGeneralCatForm.name" maxlength="132"
  show-word-limit>
              </el-input>
              <span v-if="inputErrorCatConfirmation">
                <p style="color: red">El campo (Catálogo) es requerido</p>
              </span>
            </el-form-item>
          </el-col>
        </el-row>
        <el-row :gutter="10">
          <el-col :span="24">
            <br />
            <el-button-group style="float: right">
              <el-button
                size="small"
                icon="far fa-save"
                @click.native="newGeneralCat()"
                type="success"
              >
                Guardar</el-button
              >
            </el-button-group>
          </el-col>
        </el-row>
        <br />
        <el-row>
          <!-- Contenido de tabla Catálogo -->
          <!-- Contenido de tabla Catálogo -->
          <el-table :data="general_cat" style="width: 100%">
            <el-table-column width="180" prop="id" label="Código" ></el-table-column>
            <el-table-column prop="name" label="Nombre"> </el-table-column>
            <el-table-column
              fixed="right"
              label="Acciones"
              align="center"
              width="220"
            >
              <template slot-scope="scope">
                <el-button-group>
                  <el-tooltip
                    class="item"
                    effect="dark"
                    content="Editar"
                    placement="right-start"
                  >
                    <el-button
                      type="info"
                      size="mini"
                      icon="fas fa-edit"
                      @click="rowGeneralCat(scope.row)"
                    >
                    </el-button>
                  </el-tooltip>
                </el-button-group>
                <el-button-group>
                  <el-tooltip
                    class="item"
                    effect="dark"
                    content="Eliminar"
                    placement="right-start"
                  >
                    <el-button
                      type="danger"
                      size="mini"
                      icon="fas fa-trash-alt"
                      @click="deleteGeneralCat(scope.row.id)"
                    >
                    </el-button>
                  </el-tooltip>
                </el-button-group>
              </template>
            </el-table-column>
          </el-table>
          <!-- /Contenido de tabla Catálogo -->
          <!-- /Contenido de tabla Catálogo -->
        </el-row>
      </el-form>
    </el-row>
    <br />

    <!-- Dialogo de Catálogo general -->
    <!-- Dialogo de Catálogo general -->
    <el-dialog
      title="Editar Catálogo"
      :visible.sync="dialogGeneralCat"
      width="60%"
    >
      <el-form>
        <el-form-item label="Catálogo">
          <el-input placeholder="Nuevo" v-model="dialogGeneralCatForm.name" maxlength="132"
  show-word-limit>
          </el-input>
              <span v-if="dialogFieldnull">
                <p style="color: red">El campo (Catálogo) es requerido</p>
              </span>
              <span v-if="dialogGeneralCatForm.name!=null && dialogGeneralCatForm.name.length == 132 ">
                <p style="color: black">El campo (Catálogo) ha alcanzado el número máximo de 132 caracteres, puede continuar</p>
              </span>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer">
        <el-button @click="dialogGeneralCat = false; dialogFieldnull = false" size="mini"
          >Cancelar</el-button
        >
        <el-button type="primary" size="mini" @click="UpdateGeneralCat()"
          >Confirmar</el-button
        >
      </span>
    </el-dialog>
    <!-- /Dialogo de Catálogo general -->
    <!-- /Dialogo de Catálogo general -->

    <!-- Dialogo de Confirmacion -->
    <!-- Dialogo de Confirmacion -->
    <el-dialog
      title="Catálogos"
      :visible.sync="dialogCatConfirmation"
      width="40%"
      center
    >
      <el-form label-position="top" width="90%" margin="50px">
        <el-form-item label="Confirmacion">
          <h4>El registro ya se encuentra en el catalogo</h4>
        </el-form-item>
      </el-form>
    </el-dialog>
    <!-- /Dialogo de Confirmacion -->

    <!-- /Dialogo de Fieldnull -->
    <!-- <el-dialog
      title="Error"
      :visible.sync="dialogFieldnull"
      width="30%"
    >
      <span>
        <p style="color: red">El campo (Catálogo) es requerido</p>
      </span>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="dialogFieldnull = false"
          >Cerrar </el-button
        >
      </span>
    </el-dialog> -->
    <!-- /Dialogo de Dialogo Fieldnull -->

    <!-- <entities v-if="selectedCat === 1"/>
    <order v-if="selectedCat === 2"/>
    <order v-if="selectedCat === 3"/>
    <order v-if="selectedCat === 4"/> -->
  </div>
</template>

<script>
import { cats } from "../../../mixins/AdminCatalogs";
import HeaderSection from "../layouts/partials/HeaderSection";

export default {
  mixins: [cats],
  props: ["edit", "watch"],
  components: {
    HeaderSection,
  },
  data() {
    return {};
  },
  mounted() {},
  computed: {},
  methods: {},
};
</script>

<style scoped>
.links {
  font-size: 25px;
  color: #9D2449;
  cursor: pointer;
  text-decoration: underline;
}
</style>

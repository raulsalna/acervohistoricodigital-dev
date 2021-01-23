<template>
    <div>
        <el-form ref="archivoForm" :model="archivoForm" label-width="120px" label-position="top">
            <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item label="Código*">
                        <el-input v-model="archivoForm.code"  maxlength="100" ></el-input>
                        <span v-for="error in errors.code" :key="error.code">
                            <p style="color:red">El campo (Código) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Caja*">
                        <el-select v-model="archivoForm.box_id"  style="width:100%" placeholder="Seleccionar">
                            <el-option v-for="itemBox in cat_box"  :key="itemBox.id" :label="itemBox.fileName" :value="itemBox.id">
                            </el-option>
                        </el-select>
                        <span v-for="error in errors.box_id" :key="error.box_id">
                            <p style="color:red">El campo (Caja) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Expediente*">
                        <el-select v-model="archivoForm.proceedings_id"  style="width:100%" placeholder="Seleccionar">
                            <el-option v-for="item in cat_transaction"  :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                        <span v-for="error in errors.proceedings_id" :key="error.proceedings_id">
                            <p style="color:red">El campo (Expediente) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item label="Título*">
                        <el-input v-model="archivoForm.title"  maxlength="100" ></el-input>
                        <span v-for="error in errors.title" :key="error.title">
                            <p style="color:red">El campo (Título) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Colocación Topográfica*">
                        <el-input v-model="archivoForm.placement"  maxlength="100" ></el-input>
                        <span v-for="error in errors.placement" :key="error.placement">
                            <p style="color:red">El campo (Colocación Topográfica) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Grupo Documental*">
                        <el-select v-model="archivoForm.group_id"  style="width:100%" placeholder="Seleccionar">
                            <el-option v-for="item in cat_documentary_gro"  :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                        <span v-for="error in errors.cat_documentary_gro" :key="error.cat_documentary_gro">
                            <p style="color:red">El campo (Grupo Documental) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item label="Año*">
                        <el-date-picker v-model="archivoForm.year"  type="year" value-format="yyyy" format="yyyy" style="width:100%">
                        </el-date-picker>
                        <span v-for="error in errors.year" :key="error.year">
                            <p style="color:red">El campo (Año) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Fecha de Apertura*">
                        <el-date-picker v-model="archivoForm.openingDate"  format="dd-MM-yyyy" value-format="yyyy-MM-dd" type="date" style="width:100%">
                        </el-date-picker>
                        <span v-for="error in errors.openingDate" :key="error.openingDate">
                            <p style="color:red">El campo (Fecha de Apertura) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Fecha de Cierre*">
                        <el-date-picker v-model="archivoForm.closingDate"  format="dd-MM-yyyy" value-format="yyyy-MM-dd" type="date" style="width:100%">
                        </el-date-picker>
                        <span v-for="error in errors.closingDate" :key="error.closingDate">
                            <p style="color:red">El campo (Fecha de Cierre) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item label="Volumen Inicio*">
                        <el-input v-model="archivoForm.startVolume"  maxlength="100" ></el-input>
                        <span v-for="error in errors.startVolume" :key="error.startVolume">
                            <p style="color:red">El campo (Volumen Inicio) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Volumen Final*">
                        <el-input v-model="archivoForm.endVolume"  maxlength="100" ></el-input>
                        <span v-for="error in errors.endVolume" :key="error.endVolume">
                            <p style="color:red">El campo (Volumen Final) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Soporte*">
                        <el-select v-model="archivoForm.support"  style="width:100%" multiple placeholder="Seleccionar">
                            <el-option v-for="item in cat_support"  :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                        <span v-for="error in errors.support" :key="error.support">
                            <p style="color:red">El campo (Soporte) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item label="Productor*">
                        <el-select v-model="archivoForm.producer"  style="width:100%" multiple placeholder="Seleccionar">
                            <el-option v-for="item in cat_producer"  :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                        <span v-for="error in errors.producer" :key="error.producer">
                            <p style="color:red">El campo (Productor) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Idiomas*">
                        <el-select v-model="archivoForm.languages"  style="width:100%" multiple  placeholder="Seleccionar">
                            <el-option v-for="item in cat_idioms"  :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                        <span v-for="error in errors.languages" :key="error.languages">
                            <p style="color:red">El campo (Idiomas) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Características Físicas*">
                        <el-select v-model="archivoForm.characters_id"  style="width:100%"  placeholder="Seleccionar">
                            <el-option v-for="item in cat_physic"  :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                        <span v-for="error in errors.languages" :key="error.languages">
                            <p style="color:red">El campo (Características Físicas) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="24">
                    <el-form-item label="Tradicion Documental*">
                        <el-select v-model="archivoForm.documentaryTradition_id"  style="width:100%"  placeholder="Seleccionar">
                            <el-option v-for="item in cat_documentary"  :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                        <span v-for="error in errors.documentaryTradition_id" :key="error.documentaryTradition_id">
                            <p style="color:red">El campo (Tradicion Documental) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="24">
                    <el-form-item label="Descripción de expediente*">
                        <el-input v-model="archivoForm.description"  type="textarea" maxlength="100" :rows="6"></el-input>
                        <span v-for="error in errors.description" :key="error.description">
                            <p style="color:red">El campo (Descripción de expediente) es requerido</p>
                        </span>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="24">
                    <el-form-item label="Notas de archivista">
                    <el-input v-model="archivoForm.notesArchivist"  type="textarea" maxlength="100" :rows="6"></el-input>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="24">
                    <el-form-item label="Notas">
                        <el-tag :key="tag" v-for="tag in notesToAppend" closable :disable-transitions="false" @close="handleClose(tag)"> {{tag}} </el-tag>
                            <el-input class="input-new-tag" v-if="inputVisible" v-model="notes" ref="saveTagInput" size="mini" @keyup.enter.native="handleInputConfirm" @blur="handleInputConfirm"   maxlength="200" ></el-input>
                            <el-button v-else class="button-new-tag" size="small" @click="showInput">+ Nota nueva</el-button>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="22">
                    <el-button size="small" @click="updateArchive()"  icon="far fa-save" style="float:right;" type="success" >   Actualizar</el-button>
                </el-col>
                <el-col :span="2">
                    <el-button size="small" icon="fas fa-window-close"  style="float:right;" @click.native="$router.replace('/acervo/archivo')" type="danger">   Cancelar</el-button>
                </el-col>
            </el-row>
        </el-form>
    </div>
</template>

<script>
import {cats} from "../../../../mixins/Catalogs"
import {messages} from "../../../../mixins/Messages"
export default {
    mixins: [cats,messages],
    data() {
        return{
            archivoForm:{
            title:                   null,
            box_id:                  null,
            proceedings_id:          null,
            placement:               null,
            code:                    null,
            group_id:                null,
            year:                    null,
            openingDate:             null,
            closingDate:             null,
            startVolume:             null,
            endVolume:               null,
            support:                 null,
            producer:                null,
            languages:               null,
            characters_id:           null,
            documentaryTradition_id: null,
            description:             null,
            appendNotes:             null,
            notesArchivist:          null,
            },
            inputValue:              '',
            inputVisible:            false,
            notes:                   null,
            notesToAppend:           [],
            errors: []
        }
    },
    mounted(){
       this.edit();
    },
    computed: {
        urlMain() {
        return window.URL;
        }

    },
    watch: {
    "archivoForm.code": function (value) {
      this.archivoForm.code = value.replace(
        /[#$%&?|+=*!<>"';()/{}[\]\\]/g,
        ""
      );
    },
    "archivoForm.title": function (value) {
      this.archivoForm.title = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
    },
    "archivoForm.placement": function (value) {
      this.archivoForm.placement = value.replace(
        /[#$%&?|+=*!<>"';()/{}[\]\\]/g,
        ""
      );
    },
    "archivoForm.startVolume": function (value) {
      this.archivoForm.startVolume = value.replace(
        /[#$%&?|+=*!<>"';()/{}[\]\\]/g,
        ""
      );
    },
    "archivoForm.endVolume": function (value) {
      this.archivoForm.endVolume = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
    },
    "archivoForm.description": function (value) {
      this.archivoForm.description = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
    },
    "archivoForm.notesArchivist": function (value) {
      this.archivoForm.notesArchivist = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
    },
    "notes": function (value) {
      this.notes = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
    },
  },

    methods:{
    edit() {
      this.startLoading();
      axios
        .get(this.urlMain + `/api/archive/${this.$route.params.hash}`)
        .then(response => {
          this.archivoForm = response.data.archive;
          this.archivoForm.producer = response.data.archive.producer.map(function (e) {return e.cat_producer_id});
          this.archivoForm.support = response.data.archive.support.map(function (e) {return e.cat_support_id});

          this.archivoForm.languages = response.data.archive.languages.map(function (e) {return e.geo_cat_idioms_id});
          this.stopLoading();
          if(response.data.archive['appendNotes']){console.log("response.data.archive:"+ response.data.archive['appendNotes']); this.notesToAppend =  response.data.archive['appendNotes'].split(",");}

        }).catch((error) => {
          this.stopLoading();
          this.$message({
            type: "warning",
            message:
              "No fue posible completar la acción de Mostrar Boxis, intente nuevamente."
          });
        });
    },
    updateArchive() {
      this.startLoading();
      let data = this.archivoForm;
      if(this.notesToAppend && this.notesToAppend!=null ){data['appendNotes'] = this.notesToAppend.toString();}else{console.log("ya en la funcion update : 999");this.notesToAppend="";data['appendNotes'] = this.notesToAppend;}

      axios
        .put(this.urlMain + `/api/archive/${this.$route.params.hash}`,data)
        .then(response => {
          this.$router.push("/acervo/archivo/");
          this.stopLoading();
          this.updateMessage();
        })
        .catch(error => {
          console.log(error.response.data.errors);
          this.errors = error.response.data.errors;

         this.stopLoading();
          this.$message({
            type: "warning",
            message:
              "No fue posible completar la acción de Actualizar, intente nuevamente."
          });
        });
    },
    handleInputConfirm() {
            let inputValue = this.notes;
            if (inputValue) {
            this.notesToAppend.push(inputValue);
            }
            this.inputVisible = false;
            this.notes = '';
    },
    showInput() {
                this.inputVisible = true;
                this.$nextTick(_ => {
                this.$refs.saveTagInput.$refs.input.focus();
                });
    },
    handleClose(tag) {
                this.notesToAppend.splice(this.notesToAppend.indexOf(tag), 1);
                console.log( "Largo del array : "+this.notesToAppend.length);
                if(this.notesToAppend.length==0){console.log("ya valio cero");this.notesToAppend=null;}
    },

    }
}
</script>

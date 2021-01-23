<template>
    <div>
        <el-form ref="archivoForm" :model="archivoForm" label-width="120px" label-position="top" disabled>
            <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item label="Código">
                        <el-input v-model="archivoForm.code"  maxlength="100" ></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Caja">
                        <el-select v-model="archivoForm.box_id"  style="width:100%" placeholder="Seleccionar">
                            <el-option v-for="itemBox in cat_box"  :key="itemBox.id" :label="itemBox.fileName" :value="itemBox.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Expediente">
                        <el-select v-model="archivoForm.proceedings_id"  style="width:100%" placeholder="Seleccionar">
                            <el-option v-for="item in cat_transaction"  :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item label="Título">
                        <el-input v-model="archivoForm.title"  maxlength="100" ></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Colocación Topográfica">
                        <el-input v-model="archivoForm.placement"  maxlength="100" ></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Grupo Documental">
                        <el-select v-model="archivoForm.group_id"  style="width:100%" placeholder="Seleccionar">
                            <el-option v-for="item in cat_documentary_gro"  :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item label="Año">
                        <el-date-picker v-model="archivoForm.year"  type="year" value-format="yyyy" format="yyyy" style="width:100%">
                        </el-date-picker>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Fecha de Apertura">
                        <el-date-picker v-model="archivoForm.openingDate"  format="dd-MM-yyyy" value-format="yyyy-MM-dd" type="date" style="width:100%">
                        </el-date-picker>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Fecha de Cierre">
                        <el-date-picker v-model="archivoForm.closingDate"  format="dd-MM-yyyy" value-format="yyyy-MM-dd" type="date" style="width:100%">
                        </el-date-picker>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item label="Volumen Inicio">
                        <el-input v-model="archivoForm.startVolume"  maxlength="100" ></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Volumen Final">
                        <el-input v-model="archivoForm.endVolume"  maxlength="100" ></el-input>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Soporte">
                        <el-select v-model="archivoForm.support"  style="width:100%" multiple placeholder="Seleccionar">
                            <el-option v-for="item in cat_support"  :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="8">
                    <el-form-item label="Productor">
                        <el-select v-model="archivoForm.producer"  style="width:100%" multiple placeholder="Seleccionar">
                            <el-option v-for="item in cat_producer"  :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Idiomas">
                        <el-select v-model="archivoForm.languages"  style="width:100%" multiple placeholder="Seleccionar">
                            <el-option v-for="item in cat_idioms"  :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
                <el-col :span="8">
                    <el-form-item label="Características Físicas">
                        <el-select v-model="archivoForm.characters_id"  style="width:100%"  placeholder="Seleccionar">
                            <el-option v-for="item in cat_physic"  :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="24">
                    <el-form-item label="Tradicion Documental">
                        <el-select v-model="archivoForm.documentaryTradition_id"  style="width:100%"  placeholder="Seleccionar">
                            <el-option v-for="item in cat_documentary"  :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="10">
                <el-col :span="24">
                    <el-form-item label="Descripción de expediente">
                        <el-input v-model="archivoForm.description"  type="textarea" maxlength="100" :rows="6"></el-input>
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
                    <el-form-item  label="Notas">
                        <el-tag :key="tag" v-for="tag  in notesToAppend"  :disable-transitions="false" @close="handleClose(tag)"> {{tag}} </el-tag>
                            <el-input  class="input-new-tag" v-if="inputVisible" v-model="notes" ref="saveTagInput" size="mini" @keyup.enter.native="handleInputConfirm" @blur="handleInputConfirm"   maxlength="200" ></el-input>
                    </el-form-item>
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
        }
    },
    mounted(){
       this.show();
    },
    computed: {
        urlMain() {
        return window.URL;
        }

    },
    watch:{
    //     "archivoForm.languages": function(value) {
    //   this.archivoForm.languages = value.replace();
    // },
    },

    methods:{
    show() {
      this.startLoading();
      axios
        .get(this.urlMain + `/api/archive/${this.$route.params.hash}`)
        .then(response => {

          this.archivoForm = response.data.archive;
          this.archivoForm.producer = response.data.archive.producer.map(function (e) {return e.cat_producer_id});
          this.archivoForm.support = response.data.archive.support.map(function (e) {return e.cat_support_id});
          this.archivoForm.languages = response.data.archive.languages.map(function (e) {return e.geo_cat_idioms_id});
          if(response.data.archive['appendNotes'] && response.data.archive['appendNotes'].length>0)
          {this.notesToAppend =  response.data.archive['appendNotes'].split(",");}
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
    },

    }
}
</script>

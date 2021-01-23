<template>
  <el-drawer
    :before-close="AdvanceSearchClose"
    :destroy-on-close="true"
    title="Filtro de Busqueda avanzada( ingrese uno o varios criterios de busqueda )."
    :visible.sync="drawer"
    :direction="`rtl`"
    size="70%"
    :with-header="true"
  >

    <el-scrollbar ref="scrollbar" style="height: calc(100vh - 45px)">
      <el-form
        id="searchBox"
        ref="searchBox"
        :model="searchBox"
        label-width="120px"
        label-position="top"
        @submit.native.prevent
      >
        <el-card>
          <el-row :gutter="20">
            <el-col :span="12">
              <el-form-item label="Fecha de inicio">
                <el-date-picker
                  format="dd-MM-yyyy"
                  value-format="yyyy-MM-dd"
                  v-model="searchBox.startDate"
                  type="datetimerange"
                  start-placeholder="Fecha inicial"
                  end-placeholder="Fecha final"
                ></el-date-picker>
              </el-form-item>
            </el-col>
            <el-col :span="5">
              <el-form-item label="Nombre de la caja">
                <el-input clearable size="small" v-model="searchBox.fileName"></el-input>
              </el-form-item>
            </el-col>
            <el-col :span="5">
              <el-form-item label="Lugar">
                <el-input clearable size="small" v-model="searchBox.place"></el-input>
              </el-form-item>
            </el-col>
          </el-row>
          <el-row :gutter="20">
            <el-button
              style="float:right;"
              size="small"
              type="primary"
              icon="el-icon-search"
              @click="AdvanceSearchClose"
            >Buscar</el-button>
          </el-row>
        </el-card>
      </el-form>
    </el-scrollbar>
  </el-drawer>
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
  props: ["drawer"],
  directives: { mask },
  components: {
    HeaderSection
  },
  data() {
    return {
      busqueda: null,
      errors: [],
      searchBox: {
        fileName: "",
        place: "",
        depositRoom: "",
        corridor: "",
        shelf: "",
        strep: "",
        box: "",
        startDate: "",
        endDate: ""
      },
      pickerOptionsStart: {
        disabledDate(time) {
          return time.getTime() < Date.now() - 3600 * 1000 * 24;
        }
      },
      pickerOptionsEnd: {
        disabledDate(time) {
          return time.getTime() < Date.now() - 3600 * 1000 * 24;
        },
        disabledDate: this.delimtDays
      },
    };
  },
  methods: {
    AdvanceSearchClose() {
      let drawerAdvanceSearch = this.drawer;
      drawerAdvanceSearch = false;
      let searchBox = this.searchBox;
      this.$emit("drawerClose", drawerAdvanceSearch, searchBox);
      this.searchBox.fileName='';
      this.searchBox.place='';
      this.searchBox.startDate='';

    },
    delimtDays(date) {
      return date < new Date(this.searchBox.startDate);
    }
  },
  watch: {
    search: function(value) {
      this.search = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
    },
    "searchBox.fileName": function(value) {
      this.searchBox.fileName = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
    },
    "searchBox.place": function(value) {
      this.searchBox.place = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g, "");
    }
  }
};
</script>

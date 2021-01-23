<template>
  <div>
    <header-section icon="far fa-folder-open" title="Nueva caja">
      <template slot="buttons">
        <el-button
          size="medium"
          type="danger"
          icon="el-icon-arrow-left"
          @click="$router.push('/acervo/caja')"
        >Regresar</el-button>
      </template>
    </header-section>
    <el-form ref="cajaForm" :model="cajaForm" label-width="120px" label-position="top">
      <div>
        <NewBox
          :cajaForm="cajaForm"
        ></NewBox>
      </div>
    </el-form>
  </div>
</template>

<script>
import HeaderSection from "../layouts/partials/HeaderSection";
import NewBox from "../box/partials/NewBox";
import Vue from "vue";
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
import store from "../../../store/index";
import { mask } from "vue-the-mask";
import onlyInt, { onlyFloat } from "vue-input-only-number";

export default {
  components: {
    HeaderSection,
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
    // place:"",
    // depositRoom:""

    };
  },
  computed: {
    urlMain() {
      return window.URL;
    }
  },
  methods: {
    // update_Place(datos) {
    //   this.place = datos["place"];
    //   this.depositRoom = datos["depositRoom"];
    // }
  }
};
</script>

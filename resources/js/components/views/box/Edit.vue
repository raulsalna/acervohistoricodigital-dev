<template>
  <div>
    <header-section icon="far fa-folder-open" title="Editar caja">
      <template slot="buttons">
        <el-button
          size="medium"
          type="danger"
          icon="el-icon-arrow-left"
          @click="$router.push('/acervo/caja')"
        >Regresar</el-button>
      </template>
    </header-section>
      <div>
        <EditBox></EditBox>
      </div>
  </div>
</template>

<script>
import HeaderSection from "../layouts/partials/HeaderSection";
import EditBox from "../box/partials/EditBox";
import Vue from "vue";
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
import store from "../../../store/index";
import { mask } from "vue-the-mask";
import onlyInt, { onlyFloat } from "vue-input-only-number";
import {messages} from "../../../mixins/Messages"


export default {
  components: {
    HeaderSection,
    EditBox
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
    };
  },
  computed: {
    urlMain() {
      return window.URL;
    }
  }

};
</script>

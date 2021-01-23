<template>
  <div>
    <header-section icon="fas fa-eye" title="Mostrar caja">
      <template slot="buttons">
        <el-button
          size="medium"
          type="danger"
          icon="el-icon-arrow-left"
          @click="$router.push('/acervo/caja')"
        >Regresar</el-button>
      </template>
    </header-section>
        <ShowBox></ShowBox>
  </div>
</template>

<script>
import HeaderSection from "../layouts/partials/HeaderSection";
import ShowBox from "../box/partials/ShowBox";
import Vue from "vue";
import { mapState, mapGetters, mapActions, mapMutations } from "vuex";
import store from "../../../store/index";
import { mask } from "vue-the-mask";
import onlyInt, { onlyFloat } from "vue-input-only-number";

export default {
  components: {
    HeaderSection,
    ShowBox
  },
  computed: {
    urlMain() {
      return window.URL;
    }
  }
};
</script>

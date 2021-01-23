<template>
  <el-container style="height: 500px; border: 1px solid #eee">
    <el-container>
      <el-header style="text-align: right; font-size: 12px">
        <el-row :gutter="20">
          <br/>
          <el-col :span="6" align="left">
            <el-pagination
              @size-change="handleSizeChange"
              :current-page.sync="pagination.currentPage"
              :page-sizes="[10, 20, 50, 100]"
              :page-size="parseInt(pagination.perPage)"
              layout="sizes"
            ></el-pagination>
          </el-col>
          <el-col :span="6" :offset="6">
              <el-button
                size="small"
                @click="advancedSearch"
                type="primary"
                style="float:right;"
                icon="fas fa-filter"
              >  Busqueda avanzada</el-button>
          </el-col>
          <el-col :span="6">
              <el-input
                clearable
                suffix-icon="fas fa-search"
                label="Nombre de la caja"
                size="small"
                placeholder="Buscar por título..."
                v-model="search"
                @change="listAndFilterArchives"
              ></el-input>
          </el-col>
        </el-row>
      </el-header>

      <el-main>
        <el-table :data="archives.data" style="width: 100%">
          <el-table-column prop="code" label="Código" ></el-table-column>
          <el-table-column prop="title" label="Título" ></el-table-column>
          <el-table-column prop="code" label="Expediente" ></el-table-column>
          <el-table-column prop="placement" label="Colocación Topográfica" ></el-table-column>
          <el-table-column prop="year" label="Año" ></el-table-column>
          <el-table-column prop="openingDate" label="Fecha de Apertura" ></el-table-column>
          <el-table-column prop="closingDate" label="Fecha de Cierre" ></el-table-column>
          <el-table-column fixed="right" label="Operaciones" >
              <template slot-scope="scope">
                <el-button-group>
                <el-button v-if="isSee==1"  size="small" icon="far fa-eye" @click.native="$router.push('/acervo/archivo/verArchivo/' + scope.row.hash)" type="success"></el-button>
                <el-button v-if="isEdit==3"  type="primary" icon="far fa-edit"  @click.native="$router.push('/acervo/archivo/editarArchivo/' + scope.row.hash)" size="small"></el-button>
                <el-button  v-if="isRemove==4" type="danger" icon="el-icon-delete"  @click.native="open(scope.row.hash)" size="small"></el-button>
                </el-button-group>
              </template>
          </el-table-column>
        </el-table>
      </el-main>
      <el-footer>
        <el-pagination
          :page-size="parseInt(pagination.perPage)"
          @size-change="handleSizeChange"
          @current-change="handleCurrentChange"
          layout="total, ->, prev, pager, next, jumper"
          :current-page.sync="pagination.currentPage"
          :total="pagination.total"
        ></el-pagination>
      </el-footer>
    </el-container>
    <!-- //Dialog AdvanceSearch -->
    <!-- <el-dialog :visible.sync="drawer" :destroy-on-close="true" width="90%"> -->
      <div>
        <AdvanceSearch :drawer="drawer" @drawerClose="closeAdvanceSearch"></AdvanceSearch>
      </div>
    <!-- <span slot="footer" class="dialog-footer"></span> -->
    <!-- </el-dialog> -->
  </el-container>
</template>

<script>
import {messages} from "../../../../mixins/Messages"
import AdvanceSearch from "./AdvanceSearch";


  export default {
    mixins: [messages],
    components: {
      AdvanceSearch
    },
    methods: {
      handleClick() {
        console.log('click');
      },
      advancedSearch() {
        this.drawer = true;
      },
      closeAdvanceSearch(drawerAdvanceSearch, advSearch){
        this.drawer=drawerAdvanceSearch;
        this.advSearch.fileName=advSearch.fileName;
        this.advSearch.place=advSearch.place;
        this.advSearch.startDate=advSearch.startDate;
        this.listAndFilterArchives();
      },
      getArchives() {
      axios
        .get(this.urlMain + "/api/archives")
        .then(response => {
          this.archives = response.data.archives;
        })
        .catch(error => {
          this.$message({
            type: "warning",
            message: "No fue posible completar la acción, intente nuevamente."
          });
        });
    },
    listAndFilterArchives(currentPage = 1) {
      let data = {
        params: {
          page: this.pagination.currentPage ? this.pagination.currentPage : 1,
          perPage: this.pagination.perPage ? this.pagination.perPage : 10,
          search: this.search ? this.search : "",
          fileName: this.advSearch.fileName ? this.advSearch.fileName : "",
          filePlace: this.advSearch.place ? this.advSearch.place : "",
          startDate: this.advSearch.startDate ? this.advSearch.startDate : ""
        }
      };
      this.startLoading();
      axios
        .get(
          this.urlMain +
            `/api/archive/listAndFilterArchives/${this.busqueda ? this.busqueda : null}`,
          data
        )
        .then(response => {
          this.archives = response.data.archives;
          this.pagination.total = response.data.archives.total;
          this.pagination.currentPage = response.data.archives.current_page;
          this.pagination.perPage = response.data.archives.per_page;
          if(this.$store.state.user.cat_transaction_id != null){
            if(this.$store.state.user.cat_transaction_id.toString().indexOf('1')!= -1 ){this.isSee=1;}
            if(this.$store.state.user.cat_transaction_id.toString().indexOf('4')!= -1 ){this.isRemove=4;}
            if(this.$store.state.user.cat_transaction_id.toString().indexOf('3')!= -1 ){this.isEdit=3;}
            }
            if(this.$store.state.user.profile == 1){this.isSee=1;this.isRemove=4;this.isEdit=3;}

          // if($store.state.user.cat_transaction_id ) {this.isSee=1}
          this.stopLoading();

        })
        .catch(error => {
          this.$message({
            type: "warning",
            message:
              "No fue posible completar la acción, intente nuevamente."
          });
          this.stopLoading();

        });
    },
    handleSizeChange(sizePerPage) {
      this.pagination.perPage = sizePerPage;
      this.listAndFilterArchives((this.pagination.currentPage = 1));
    },
    handleCurrentChange(currentPage) {
      console.log(`current page: ${currentPage}`);
      this.pagination.currentPage = currentPage;
      this.listAndFilterArchives(currentPage);
    },
    eliminar(registro){
      axios
        .delete(this.urlMain + "/api/archive/"+registro)
        .then(response => {
          this.deleteMessage();
          this.listAndFilterArchives();
        })
        .catch(error => {
          this.$message({
            type: "warning",
            message: "No fue posible completar la acción, intente nuevamente."
          });
        });

    },
    open(row) {
      this.$confirm(
        "Esta acción eliminará el registro del sistema",
         "Precaución",
        {
          confirmButtonText: "OK",
          cancelButtonText: "Cancelar",
          type: "warning",
          center: true
        }
      )
        .then(() => {
          this.eliminar(row);
        })
        .catch(() => {
          this.$message({
            type: "info",
            message: "Borrado Cancelado"
          });
        });
    }
    },
    data() {
      return {
          busqueda: null,
          search: null,
          drawer: false,

          pagination: {
          currentPage: 1,
          total: 0,
          perPage: 10
          },
          advSearch: {
            fileName:"",
            place: "",
            depositRoom: "",
            corridor: "",
            shelf: "",
            strep: "",
            box: ""
          },

          archives: [],
          isSee:null,
          isEdit:null,
          isRemove:null

      }
    },
    computed: {
      urlMain() {
        return window.URL;
    }
  },
  mounted() {
    this.listAndFilterArchives();
  },
      watch: {
    "search": function(value) {this.search = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g,"");},
  },
  }
</script>

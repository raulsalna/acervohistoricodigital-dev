<template>
  <el-container style="height: 500px; border: 1px solid #eee">
    <el-container>
      <el-header style="text-align: right; font-size: 12px">
        <br/>
        <el-row :gutter="20">
          <el-col :span="6" align="left">
            <el-pagination
              @size-change="handleSizeChange"
              :current-page.sync="pagination.currentPage"
              :page-sizes="[10, 20, 50, 100]"
              :page-size="parseInt(pagination.perPage)"
              layout="sizes"
            ></el-pagination>
          </el-col>
          <el-col :span="6" >
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
                @change="listAndFilterBox"
              ></el-input>
          </el-col>

        </el-row>
      </el-header>

      <el-main>
        <el-table :data="boxs.data" style="width: 100%">
          <el-table-column width="80" prop="id" label="Codigo" ></el-table-column>
          <el-table-column prop="box" label="Caja" ></el-table-column>
          <el-table-column prop="fileName" label="Título" ></el-table-column>
          <el-table-column prop="place" label="Lugar" ></el-table-column>
          <el-table-column prop="depositRoom" label="Sala de depósito" ></el-table-column>
          <el-table-column prop="corridor" label="Corredor" ></el-table-column>
          <el-table-column prop="shelf" label="Estante" ></el-table-column>
          <el-table-column prop="strep" label="Repisa" ></el-table-column>
          <el-table-column fixed="right" label="Operaciones" >
            <template slot-scope="scope">
              <el-button-group>
                <el-button
                  type="success"
                  icon="el-icon-view"
                  @click.native="$router.push('/acervo/caja/mostrarCaja/' + scope.row.hash)"
                  size="small"
                ></el-button>
                <el-button
                  type="primary"
                  icon="el-icon-edit"
                  @click.native="$router.push('/acervo/caja/editarCaja/' + scope.row.hash)"
                  size="small"
                ></el-button>
                <el-button
                  type="danger"
                  icon="el-icon-delete"
                  @click.native="open(scope.row.hash)"
                  size="small"
                ></el-button>
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
    <!-- //Dialog show Box -->
    <el-dialog :visible.sync="dialogShowVisible" :destroy-on-close="true" width="90%">
      <div>
        <ShowBox></ShowBox>
      </div>
      <span slot="footer" class="dialog-footer"></span>
    </el-dialog>
    <!-- //Fin show new Box -->
      <div>
        <AdvanceSearch :drawer="drawer" @drawerClose="closeAdvanceSearch"></AdvanceSearch>
      </div>
    <!-- //Fin AdvanceSearch -->
  </el-container>
</template>

<script>
import { messages } from "../../../../mixins/Messages";
import ShowBox from "./ShowBox";
import AdvanceSearch from "./AdvanceSearch";

export default {
  mixins: [messages],
  data() {
    return {
      dialogShowVisible: false,
      //Inicio variables para modulo busqueda
      busqueda: null,
      search: null,
      drawer: false,
      drawervuex: false,

      searchbox: {
        fileName:"",
        place: "",
        depositRoom: "",
        corridor: "",
        shelf: "",
        strep: "",
        box: ""
      },
      pagination: {
        currentPage: 1,
        total: 0,
        perPage: 10
      },

      boxs: []
    };
  },
  components: {
    ShowBox,
    AdvanceSearch
  },
  methods: {
    closeAdvanceSearch(drawerAdvanceSearch, searchBox){
      this.drawer=drawerAdvanceSearch;
      this.searchbox.fileName=searchBox.fileName;
      this.searchbox.place=searchBox.place;
      this.searchbox.startDate=searchBox.startDate;
      this.searchbox.depositRoom=searchBox.depositRoom;
      this.searchbox.corridor=searchBox.corridor;
      this.listAndFilterBox();
    },
    handleClick() {
      console.log("click");
    },
    advancedSearch() {
          this.drawer = true;
    },
    getBox() {
      axios
        .get(this.urlMain + "/api/box")
        .then(response => {
          this.boxs = response.data.boxs;
        })
        .catch(error => {
          this.$message({
            type: "warning",
            message: "No fue posible completar la acción, intente nuevamente."
          });
        });
    },
    listAndFilterBox(currentPage = 1) {
      let data = {
        params: {
          page: this.pagination.currentPage ? this.pagination.currentPage : 1,
          perPage: this.pagination.perPage ? this.pagination.perPage : 10,
          search: this.search ? this.search : "",
          nameBox: this.searchbox.fileName ? this.searchbox.fileName : "",
          placeBox: this.searchbox.place ? this.searchbox.place : "",
          startDate: this.searchbox.startDate ? this.searchbox.startDate : "",
          depositRoom: this.searchbox.depositRoom ? this.searchbox.depositRoom :"",
          corridor: this.searchbox.corridor ? this.searchbox.corridor: ""
        }
      };
      this.startLoading();
      axios
        .get(
          this.urlMain +
            `/api/box/listAndFilterBox/${this.busqueda ? this.busqueda : null}`,
          data
        )
        .then(response => {
          this.boxs = response.data.boxs;
          this.pagination.total = response.data.boxs.total;
          this.pagination.currentPage = response.data.boxs.current_page;
          this.pagination.perPage = response.data.boxs.per_page;
          this.stopLoading();
        })
        .catch(error => {
          this.$message({
            type: "warning",
            message:
              "No fue posible completar la acción listAndFilterBox, intente nuevamente."
          });
          this.stopLoading();
        });
    },
    handleSizeChange(sizePerPage) {
      this.pagination.perPage = sizePerPage;
      this.listAndFilterBox((this.pagination.currentPage = 1));
    },
    handleCurrentChange(currentPage) {
      console.log(`current page: ${currentPage}`);
      this.pagination.currentPage = currentPage;
      this.listAndFilterBox(currentPage);
    },
    eliminar(registro) {
      axios
        .delete(this.urlMain + "/api/box/" + registro)
        .then(response => {
          this.deleteMessage();
          this.listAndFilterBox();
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
  computed: {
    urlMain() {
      return window.URL;
    }
  },
        watch: {
    "search": function (value) {this.search = value.replace(/[#$%&?|+=*!<>"';()/{}[\]\\]/g,"");},
  },
  mounted() {
    // this.getBox();
    this.listAndFilterBox();
  }
};
</script>

<template>
    <el-dialog title="" :visible.sync="valor" @close="updatedialogFormVisible" width="50%">
      <el-form ref="cajaForm" :model="cajaForm" label-width="120px" label-position="top">
                <el-row :gutter="10">
                    <el-col :span="24">
                        <el-form-item label="Caja">
                            <el-input  maxlength="100"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row :gutter="10">
                    <el-col :span="8">
                        <el-form-item label="Título">
                            <el-input  maxlength="100"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="8">
                        <el-form-item label="Lugar">
                            <el-input  maxlength="100" ></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="8">
                        <el-form-item label="Sala de depósito">
                            <el-input  maxlength="100"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-row :gutter="10">
                    <el-col :span="8">
                        <el-form-item label="Pasillo">
                            <el-input  maxlength="100"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="8">
                        <el-form-item label="Estante">
                            <el-input  maxlength="100"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="8">
                        <el-form-item label="Estrepaño">
                            <el-input  maxlength="100"></el-input>
                        </el-form-item>
                    </el-col>
                </el-row>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="variables = false">Cancelar</el-button>
            <el-button type="primary"  >Agregar</el-button>
        </span>
    </el-dialog>  
</template>
<script>
export default {
  data() {
    return {
      valor:false,
      valor2:null
    };
  },
  props: ["dialogFormVisible"],

  methods: {
    updatedialogFormVisible() {
      let dialogFormVisibleUpdate=this.dialogFormVisible;
      dialogFormVisibleUpdate=false;
      this.$emit("update-dialogFormVisible", dialogFormVisibleUpdate);

    },
    updatePlace()
    {
       this.valor=this.dialogFormVisible;
    }
  },
  mounted() {

  },
  watch:{
    dialogFormVisible: function(val)
    {
      this.valor=this.dialogFormVisible
    }

  }
};
</script>

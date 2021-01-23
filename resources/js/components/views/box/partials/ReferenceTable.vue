<template>
  <div>
    <el-row :gutter="10">
      <el-col :span="8">
        <el-form-item label="Lugar">
          <el-input v-model="cajaForm.place" maxlength="100" @input="onChangeInputPlace"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="8">
        <el-form-item label="Sala de depósito">
          <el-input v-model="cajaForm.depositRoom" maxlength="100" @input="onChangeInputPlace"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="8">
        <el-form-item label="Pasillo">
          <el-input v-model="cajaForm.corridor" maxlength="100"></el-input>
        </el-form-item>
      </el-col>
    </el-row>
    <el-row :gutter="10">
      <el-col :span="8">
        <el-form-item label="Estante">
          <el-input v-model="cajaForm.shelf" maxlength="100"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="8">
        <el-form-item label="Estrepaño">
          <el-input v-model="cajaForm.strep" maxlength="100"></el-input>
        </el-form-item>
      </el-col>
      <el-col :span="8">
        <el-form-item label="Caja">
          <el-input v-model="cajaForm.box" maxlength="100"></el-input>
        </el-form-item>
      </el-col>
    </el-row>
    <el-row :gutter="10">
      <el-col :span="22">
        <el-button size="small" icon="far fa-save" style="float:right;" type="success">Guardar</el-button>
      </el-col>
      <el-col :span="2">
        <el-button
          size="small"
          icon="fas fa-window-close"
          style="float:right;"
          @click.native="$router.replace('/acervo/archivo')"
          type="danger"
        >Cancelar</el-button>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      boxForm:[
        {place:'',
        depositRoom:'',
        corridor:'',
        shelf:'',
        box:''
        }
      ],

    };
  },
  props: ['cajaForm','place','depositRoom','corridor','shelf','strep','box','avisar'],

  methods: {
    onChangeInputPlace() {
      let datos=[{place:'',
        depositRoom:'',
        corridor:'',
        shelf:'',
        box:''
        }];
      datos.place=this.place;
      datos.depositRoom=this.depositRoom;
      console.log('Datos.place: '+ datos.place+'Datos.depositRoom: '+ datos.depositRoom);
      this.avisar(datos);
    }
  }
};
</script>

<template>
    <div>
        <el-row :gutter="10">
            <el-col :span="12">
                <el-form-item label="Clasificación Actual">
                    <el-input v-model="currentClasification" maxlength="100" ></el-input>
                </el-form-item>
            </el-col>
            <el-col :span="12">
                <el-form-item label="Clasificación Decimal">
                    <el-input v-model="decimalClasification" maxlength="100" ></el-input>
                </el-form-item>
            </el-col>
        </el-row>
        <el-row :gutter="10">
            <el-col :span="22">
                <el-button size="small"   icon="far fa-save" style="float:right;" type="success" >   Guardar</el-button>                        
            </el-col>
            <el-col :span="2">
                <el-button size="small" icon="fas fa-window-close"  style="float:right;" @click.native="$router.replace('/acervo/archivo')" type="danger">   Cancelar</el-button>
            </el-col>
        </el-row>
    </div>
</template>

<script>
export default {
    data() {
        return{
            currentClasification: '',
            decimalClasification: '',
            options: [{
                value: 'Option1',
                label: 'Option1'
                }, {
                value: 'Option2',
                label: 'Option2'
                }, {
                value: 'Option3',
                label: 'Option3'
                }],
        }
    },

    props: ['currentClasification','decimalClasification']
}
</script>
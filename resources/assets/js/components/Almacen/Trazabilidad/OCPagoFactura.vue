<template>
  <main class="main">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          OC - Pago - Factura
        </div>
        <div class="card-body">
          <div class="form-group row">
            <label class="col-md-2 form-control-label">Proyectos</label>
            <div class="col-md-7">
              <v-select :options="proveedores" v-model="proveedor" label="name" v-validate="'excluded:0'" data-vv-as="Proveedor"></v-select>
              <span class="text-danger">{{ errors.first('Proveedor') }}</span>
            </div>
            <div class="col-md-2">
              <button class="btn btn-dark" @click="buscar"><i class="fa fa-search"></i> Buscar</button>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">Proyecto</div>
        <div class="card-body">

          <table class="table table-bordered table-sm">
              <tr>
                  <td class="table-active">Nombre</td>
                  <td colspan="3">{{ proveedor != null ? proveedor.nombre_corto : ''}}</td>
              </tr>
          </table>


          <table class="table table-bordered table-sm">
              <thead>
                  <tr class="table-active">
                      <th style="width:35%">OC</th>
                      <th style="width:35%">Factura</th>
                      <th style="width:30%">Pago</th>
                  </tr>
              </thead>
              <tr v-for="t in ocs"  :key="t.oc.id">
                <td>
                  <span class="font-weight-bold">{{t.oc.folio}}</span><br>
                  Total: {{ t.oc.total }} <br>
                  Moneda {{ t.oc.moneda == 1 ? 'USD' : t.oc.moneda == 2 ? 'MNX' : 0 }} <br>
                  <button class="btn btn-sm btn-danger" @click="descargar(t.oc.id)"><i class="fas fa-file-pdf"></i> Descargar OC</button>

                </td>
                <td>
                  <div v-for="a in t.facturas"  :key="a.id">
                    <span class="font-weight-bold">{{a.uuid}}</span><br>
                    Total: {{ a.total_factura }} <br>
                    <button class="btn btn-sm btn-success" @click="descargarf(a.comprobante)">
                      <i class="fas fa-file-download"></i>&nbsp;Descargar Factura
                    </button>
                  </div>

                </td>
                <td>
                  <div v-for="b in t.pagos"  :key="b.id">
                    <span class="font-weight-bold">{{b.descripcion}}</span><br>
                    Total: {{ b.cargo }} <br>
                    Moneda {{ b.moneda == 1 ? 'USD' : b.moneda == 2 ? 'MNX' : 0 }} <br>
                    <button class="btn btn-sm btn-warning" @click="descargarfactura(b.adjunto)">
                      <i class="fas fa-file-download"></i>&nbsp;Descargar
                    </button>
                  </div>
                </td>
              </tr>
          </table>
          <!-- {{ocs}} -->
        </div>
      </div>
    </div>
  </main>
</template>
<script>
export default {
  data (){
    return {
      proveedor: null,
      empleado: null,
      ocs: [],
      proveedores: [],
      hiden: 0,
      isLoading: false
    }
  },
  methods: {
    listar(){
      this.isLoading = true;
      let me=this;
      axios.get('proyecto').then(response => {
        me.proveedores = [];
        response.data.forEach(data =>{
          me.proveedores.push({
            id : data.proyecto.id,
            name : data.proyecto.nombre_corto,
          });
        });
      })
      .catch(function (error) {
        console.log(error);
      });
    },

    buscar(){
      axios.get('buscarocpf/proyecto/'+this.proveedor.id).then(response => {
        this.ocs = response.data;
      }).catch(error => {
        console.error(error);
      });
    },

    descargar(id) {
      window.open('descargar-compran/' + id, '_blank');
      let me = this;
    },

    descargarfactura(archivo){
      if (typeof(this.pago.adjunto) === 'object') {
        toastr.warning('ATENCION','No se puede descargar un archivo que aun no a sido subido');
      }else {
        let me=this;
        axios({
            url: 'descargarfacturareporte/' + archivo ,
            method: 'GET',
            responseType: 'blob', // importante
        }).then((response) => {
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', archivo); //archivo = nombre del archivo alojado en el ftp
            document.body.appendChild(link);
            link.click();
            //--Llama el metodo para borrar el archivo local una ves descargado--//
            axios.get('eliminareportegastos/' + archivo)
            .then(response => {
            })
            .catch(function (error) {
                    console.log(error);
            });
            //--fin del metodo borrar--//
        });
      }
    },

  },
  mounted() {
    this.listar();
  },
}
</script>

<template>
<div>
    <div class="card">
        <div class="card-body">
            <vue-element-loading :active="isLoading" />
            <!-- Inicio de form -->
            <template>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Compañía de seguro</label>
                        <input type="text" class="form-control" v-model="poliza.proveedor" name="proveedor" data-vv-name="Compañía de seguro" v-validate="'required'">
                        <span class="text-danger">{{errors.first('Compañía de seguro')}}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label>No.poliza de seguro</label>
                        <input type="text" class="form-control" v-model="poliza.numero_poliza" name="numero_poliza" data-vv-name="No.poliza de seguro" v-validate="'required'">
                        <span class="text-danger">{{errors.first('No.poliza de seguro')}}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label>No. de inciso</label>
                        <input type="text" class="form-control" v-model="poliza.numero_inciso" name="numero_inciso" data-vv-name="No. de inciso">
                        <span class="text-danger">{{errors.first('No. de inciso')}}</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Fecha de renovación (Inicio)</label>
                        <input type="date" class="form-control" v-model="poliza.fecha_inicio" name="fecha_inicio" data-vv-name="Fecha de renovación (Inicio)" v-validate="'required'">
                        <span class="text-danger">{{errors.first('Fecha de renovación (Inicio)')}}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Fecha de renovación (Termino)</label>
                        <input type="date" class="form-control" v-model="poliza.fecha_termino" name="fecha_termino" data-vv-name="Fecha de renovación (Termino)" v-validate="'required'">
                        <span class="text-danger">{{errors.first('Fecha de renovación (Termino)')}}</span>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Contacto</label>
                        <input type="text" class="form-control" v-model="poliza.contacto" data-vv-name="Contacto" v-validate="'required'">
                        <span class="text-danger">{{errors.first('Contacto')}}</span>
                    </div>
                </div>
                <div class="form-row">
                    <template v-if="poliza.comprobante != ''">
                        <div class="form-group col-md-2">
                            <label>&nbsp;</label>
                            <button type="button" class="form-control" @click="descargar(poliza.comprobante)">
                                <i class="fas fa-file-download"></i>&nbsp;Descargar
                            </button>
                        </div>
                        <div class="form-group col-md-2">
                            <label>&nbsp;</label>
                            <button type="button" class="form-control" @click="actualiza()">
                                <i class="fas fa-file"></i>&nbsp;Actualizar Archivo
                            </button>
                        </div>
                    </template>
                    <template v-if="poliza.comprobante == ''">
                        <div class="form-group col-md-4">
                            <label>Comprobante</label>
                            <input type="file" class="form-control" name="comprobante" @change="onChange($event)">
                        </div>
                    </template>

                </div>
                <div class="modal-footer">
                    <button type="button" v-if="Tipo_Edo == 2" class="btn btn-outline-dark" @click="cerrarModal()"><i class="fas fa-window-close"></i>&nbsp;Cerrar</button>
                    <button type="button" v-if="Tipo_Edo == 1" class="btn btn-secondary" @click="guardarMto(1)"><i class="fas fa-save"></i>&nbsp;Guardar</button>
                    <button type="button" v-if="Tipo_Edo == 2" class="btn btn-secondary" @click="guardarMto(0)"><i class="fas fa-save"></i>&nbsp;Actualizar</button>
                </div>
            </template>
            <!-- Fin de form de  -->

            <!-- Inicio de tabla de  -->
            <template>
                <v-client-table :data="datapoliza" :options="optionspoliza" :columns="columnspoliza" ref="tablePoliza">
                    <template slot="id" slot-scope="props">
                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <div class="btn-group dropup" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-outline-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-grip-horizontal"></i> Acciones
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <button type="button" @click="actualizar(props.row)" class="dropdown-item">
                                        <i class="fas fa-edit"></i>&nbsp; Actualizar
                                    </button>
                                    <button type="button" @click="Eliminar(props.row.id)" class="dropdown-item">
                                        <i class="fas fa-times"></i>&nbsp; Eliminar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </v-client-table>
            </template>
            <!-- Fin de tabla de  -->
        </div>
    </div>
</div>
</template>

<script>
import Utilerias from '../../Herramientas/utilerias.js';
var config = require('../../Herramientas/config-vuetables-client').call(this);
export default
{
    data()
    {
        return {
            tipo: 0,
            Tipo_Edo: 1,
            operacion_array: '',
            id: '',
            datapoliza: [],
            columnspoliza: [
                'id',
                'proveedor',
                'contacto',
                'numero_poliza',
                'numero_inciso',
                'fecha_inicio',
                'fecha_termino'
            ],
            isLoading: false,
            poliza:
            {
                id: 0,
                proveedor: '',
                numero_poliza: '',
                fecha_inicio: '',
                fecha_termino: '',
                comprobante: '',
                numero_inciso: '',
                contacto: "",
            },
            optionspoliza:
            {
                headings:
                {
                    id: 'Acciones',
                    numero_poliza: '# Poliza'
                },
                perPage: 5,
                perPageValues: [],
                skin: config.skin,
                sortIcon: config.sortIcon,
                filterByColumn: true,
                listColumns:
                {},
                texts: config.texts
            },
        }
    },
    methods:
    {

        /**
         * Obtiene las polizas de la unidad actual
         */
        getData()
        {
            this.isLoading = true;
            axios.get('vehiculos/polizas/unidades/' + this.id).then(res =>
            {
                this.isLoading = false;
                if (res.data.status)
                {
                    this.datapoliza = res.data.polizas;
                }
                else toastr.error(res.data.mensaje);
            });
        },

        getId(id)
        {
            this.id = id;
            this.getData();
        },

        onChange(e)
        {
            this.poliza.comprobante = e.target.files[0];
        },

        guardarMto(nuevo)
        {
            this.$validator.validate().then(result =>
            {
                if (result)
                {
                    this.isLoading = true;
                    let me = this;
                    let formData = new FormData();
                    formData.append('id', this.poliza.id);
                    formData.append('proveedor', this.poliza.proveedor);
                    formData.append('numero_poliza', this.poliza.numero_poliza);
                    formData.append('contacto', this.poliza.contacto);
                    formData.append('numero_inciso', this.poliza.numero_inciso);
                    formData.append('fecha_inicio', this.poliza.fecha_inicio);
                    formData.append('fecha_termino', this.poliza.fecha_termino);
                    formData.append('comprobante', this.poliza.comprobante);
                    formData.append('unidad_id', this.id);
                    formData.append('metodo', nuevo);
                    axios.post('vehiculos/polizas/unidades', formData).then(response =>
                    {
                        me.isLoading = false;
                        if (response.data.status)
                        {
                            me.getData();
                            me.cerrarModal();
                            if (nuevo)
                            {
                                toastr.success('Poliza guardada correctamente');
                            }
                            else
                            {
                                toastr.success('Poliza actualizada correctamente');
                            }
                        }
                        else
                        {
                            toastr.error(res.data.mensaje);
                        }
                    });
                }
            });
        },

        actualizar(data)
        {
            this.Tipo_Edo = 2;
            this.poliza.id = data.id;
            this.poliza.proveedor = data.proveedor;
            this.poliza.numero_poliza = data.numero_poliza;
            this.poliza.fecha_inicio = data.fecha_inicio;
            this.poliza.fecha_termino = data.fecha_termino;
            this.poliza.comprobante = data.comprobante;
            this.poliza.contacto = data.contacto;
            this.poliza.unidad_id = data.unidad_id;
            this.poliza.numero_inciso = data.numero_inciso;
        },

        actualiza()
        {
            this.poliza.comprobante = '';
        },

        cerrarModal()
        {
            Utilerias.resetObject(this.poliza);
            this.Tipo_Edo = 1;
        },

        Eliminar(id)
        {
            axios.post("vehiculos/polizas/eliminar",
            {
                id
            }).then(res =>
            {
                if (res.data.status)
                {
                    toastr.success("Eliminado correctamente");
                    this.getData();
                }
                else
                {
                    toastr.error(res.data.mensaje);
                }
            })
        },

        descargar(archivo)
        {
            console.error(archivo);
            let me = this;
            axios(
            {
                url: 'vehiculos/polizas/unidades/descargar/' + archivo,
                method: 'GET',
                responseType: 'blob', // importante
            }).then((response) =>
            {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download', archivo); //archivo = nombre del archivo alojado en el ftp
                document.body.appendChild(link);
                link.click();
                //--Llama el metodo para borrar el archivo local una ves descargado--//
                axios.get('/polizaeditar/' + archivo)
                    .then(response =>
                    {})
                    .catch(function (error)
                    {
                        console.log(error);
                    });
                //--fin del metodo borrar--//
            });
        },

    },

    mounted()
    {

    }
}
</script>

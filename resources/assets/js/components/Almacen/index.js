const Entrada = r => require.ensure([], () => r(require('./Entradas/EntradaPrincipal.vue')), 'alm')
const EntradaInterna = r => require.ensure([], () => r(require('../Almacen/EntradaInterna.vue')), 'alm')
const SalidasTaller = r => require.ensure([], () => r(require('./SalidasTaller/SalidasTaller.vue')), 'alm')
const SalidasSitio = r => require.ensure([], () => r(require('../Almacen/Salidas/SalidasSitio.vue')), 'alm')
const SalidasResguardo = r => require.ensure([], () => r(require('../Almacen/Salidas/SalidasResguardo.vue')), 'alm')
const TipoEntrada = r => require.ensure([], () => r(require('./Catalogos/Tipo-entrada.vue')), 'alm')
const TipoCalidad = r => require.ensure([], () => r(require('./Catalogos/Tipo-calidad.vue')), 'alm')
const Stock = r => require.ensure([], () => r(require('./Catalogos/Stock.vue')), 'alm')
const Categoria = r => require.ensure([], () => r(require('./Catalogos/Categoria.vue')), 'alm')
const Grupo = r => require.ensure([], () => r(require('./Catalogos/Grupo.vue')), 'alm')
const Almacen = r => require.ensure([], () => r(require('./Catalogos/Almacen.vue')), 'alm')
const Articulo = r => require.ensure([], () => r(require('./Articulo/Articulo.vue')), 'alm')
const TipoResguardo = r => require.ensure([], () => r(require('./Catalogos/Tipo-resguardo.vue')), 'alm')
const Existencia = r => require.ensure([], () => (require('./Reportes/Existencias.vue')), 'alm')
const Inventario = r => require.ensure([], () => (require('./Reportes/Inventarios.vue')), 'alm')
const Materiales  = r => require.ensure([], () => (require('./Reportes/Materiales.vue')), 'alm')
const Dashboard  = r => require.ensure([], () => (require('./Dashboard/Dashboard.vue')), 'alm')
const Retorno = r => require.ensure([], () => (require('./Retornos/Retorno.vue')), 'alm')
const Informe = r => require.ensure([], () => (require('./Reportes/Informe')), 'alm')
const SubirFactura = r => require.ensure([], () =>(require('../Almacen/Subirfactura.vue')), 'alm')
const ImpuestosFacturas = r => require.ensure([], () =>(require('./Catalogos/ImpuestosFacturas.vue')), 'alm')
const ConsultaArtuculos = r => require.ensure([], () =>(require('./Catalogos/ConsultaArtuculos.vue')), 'alm')
const EntradaSalida = r => require.ensure([], () =>(require('../Almacen/EntradaSalida.vue')), 'alm')
const ReporteOCPF = r => require.ensure([], () =>(require('./Trazabilidad/OCPagoFactura.vue')), 'alm')
const ArticulosOC = r => require.ensure([], () =>(require('./Reportes/ArticulosOC.vue')), 'alm')
const ArticulosSalidas = r => require.ensure([], () =>(require('./Reportes/ArticulosSalidas.vue')), 'alm')
const Lote2 = r => require.ensure([], () => r(require('./Catalogos/Lote.vue')), 'alm')
const ArticulosReq = r => require.ensure([], () => r(require('./Reportes/ArticulosReq.vue')), 'alm')
const SalidaBarras = r => require.ensure([], () => r(require('../Almacen/SalidaBarras.vue')), 'alm')

const Estatus = r => require.ensure([], () => r(require('./Reportes/Estatus.vue')), 'alm')

const Codigos = r => require.ensure([], () => r(require('./Entradas/Codigos.vue')), 'alm')
const Trazabilidad = r => require.ensure([], () => r(require('./Reportes/Trazabilidad.vue')), 'alm')
const UnidadesMedida = r => require.ensure([], () => r(require('./UnidadesMedida.vue')), 'alm')

const EquiposCalibracion = r => require.ensure([], () => r(require('./EquiposCalibracion.vue')), 'alm')

const EntradaInventario = r => require.ensure([], () => r(require('./EntradaInventario.vue')), 'alm')
const EntradaPendiete = r => require.ensure([], () => r(require('./EntradaPendiente.vue')), 'alm')

const InventarioGeneral = r => require.ensure([], () => r(require('./Inventario/Inventario.vue')), 'alm')
const ReportesEntradas = r => require.ensure([], () => r(require('./Reportes/Entradas.vue')), 'alm')
const Herramientas = r => require.ensure([], () => r(require('./Herramientas/Principal.vue')), 'alm')
// Reportes contabilidad
const ReporteContabilidad = r => require.ensure([], () => r(require('./Reportes/Inventario/Contabilidad.vue')), 'alm')

// Requisiciones
const Requisiciones = r => require.ensure([], () => r(require('./Requisiciones/Requisiciones.vue')), 'alm')

const rutas = [
    { path: '/entradas', component: Entrada, name: 'entrada', meta: { requiresAuth: true }},
    { path: '/entradasinternas', component: EntradaInterna, name: 'entradainterna', meta: { requiresAuth: true }},
    { path: '/entradasalida/', component: EntradaSalida},
    { path: '/salidastaller', component: SalidasTaller, name: 'salidastaller', meta: { requiresAuth: true }},
    { path: '/salidasitio', component: SalidasSitio, name: 'salidassitio', meta: { requiresAuth: true }},
    { path: '/salidasresguardo', component: SalidasResguardo, name: 'salidasresguardo', meta: { requiresAuth: true }},
    { path: '/alm/catalogos/tipo-entrada/' , component: TipoEntrada },
    { path: '/alm/catalogos/tipo-calidad/' , component: TipoCalidad },
    { path: '/alm/catalogos/stock/' , component: Stock },
    { path: '/alm/catalogos/categoria/' , component: Categoria },
    { path: '/alm/catalogos/grupo/', component: Grupo },
    { path: '/alm/catalogos/almacen/', component: Almacen },
    { path: '/alm/articulo/articulo/', component: Articulo },
    { path: '/alm/catalogos/resguardo', component: TipoResguardo },
    { path: '/reporte/existencias/', component: Existencia },
    { path: '/reporte/inventario/', component: Inventario },
    { path: '/reporte/materiales/', component: Materiales},
    { path: '/reporte/lote/', component: Lote2},
    { path: '/alm/dashboard/', component: Dashboard},
    { path: '/alm/retornos', component: Retorno},
    { path: '/reporte/informe/', component: Informe},
    { path: '/subirfacturasalmacen', component: SubirFactura},
    { path: '/alm/catalogos/impuestosfacturas/', component: ImpuestosFacturas },
    { path: '/consulta/articulos', component: ConsultaArtuculos},
    { path: '/reporte/oc/p/f/', component: ReporteOCPF},
    { path: '/reporte/consulta/oc/articulos', component: ArticulosOC},
    { path: '/reporte/consulta/salidas/articulos', component: ArticulosSalidas},
    { path: '/reporte/consulta/req/articulos', component: ArticulosReq},
    { path: '/salidas/codigo/barras', component: SalidaBarras},
    { path: '/estatus/oc/entradas/salidas', component: Estatus},
    { path: '/entradas/codigo/generar/', component: Codigos},
    { path: '/alm/reportes/trazabilidad/', component: Trazabilidad},
    { path: '/alm/unidadesmedida', component: UnidadesMedida},
    { path: '/alm/equipos/calibracion', component: EquiposCalibracion},
    { path: '/alm/entrada/inventario', component : EntradaInventario},
    { path: '/alm/entrada/pendiente', component : EntradaPendiete},
    // Inventario 2021
    { path: '/alm/inventariogrl', component : InventarioGeneral},
    { path: '/reportes/entradas', component: ReportesEntradas },
    // Inventario Contabilidad
    { path: '/almacen/reportecontabilidad', component: ReporteContabilidad },
    // Requisiciones
    { path: '/almacen/requisiciones', component: Requisiciones },
    {
      path: "/almacen/requisiciones/:id/detalles",
      name: "almacen-requisiciones-detalles",
      props: true,
      component: () => import(/* webpackChunkName: "Requisiciones-Detalles" */"./Requisiciones/Detalles.vue"),
    },
  ]

export default rutas

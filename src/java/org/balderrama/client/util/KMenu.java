package org.balderrama.client.util;

import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.TabPanel;
import com.gwtext.client.widgets.menu.BaseItem;
import com.gwtext.client.widgets.menu.Item;
import com.gwtext.client.widgets.menu.Menu;
import com.gwtext.client.widgets.menu.MenuItem;
import com.gwtext.client.widgets.menu.event.MenuListener;
import java.util.Date;
import org.balderrama.client.MainEntryPoint;
import org.balderrama.client.marca.Marca;
import org.balderrama.client.configuracion.ConfiguracionColor;
import org.balderrama.client.configuracion.Material;
//import org.balderrama.client.cliente.Cliente;
import org.balderrama.client.almacen.Almacen;
import org.balderrama.client.configuracion.Coleccion;
import org.balderrama.client.modelo.Modelo;
import org.balderrama.client.system.CargarDatos;
////import org.balderrama.client.system.CargarArchivo;
import org.balderrama.client.system.SeleccionMarcaProformas;
import org.balderrama.client.system.Rol;
import org.balderrama.client.system.Usuario;
//import org.balderrama.client.muestra.Muestra;
////import org.balderrama.client.muestra.PanelPedidoMuestra;
//import org.balderrama.client.muestra.ListaRecibidos;


import org.balderrama.client.system.ListarCalzados;
//import org.balderrama.client.configuracion.Empresa;
import org.balderrama.client.configuracion.ConfiguracionParametro;
import org.balderrama.client.reportes.ReporteAlmacen;
import org.balderrama.client.sistemadetalle.IngresoAlmacenForm;
import org.balderrama.client.sistemadetalle.PanelPedidoE;
import org.balderrama.client.sistemadetalle.PanelPedidoEE;
import org.balderrama.client.sistemadetalle.PanelPedidoEEU;
import org.balderrama.client.sistemadetalle.PanelRebaja;
//import org.balderrama.client.sistemadetalle.PanelPedidoConfirmado1;
import org.balderrama.client.sistemadetalle.PanelInventario;
import org.balderrama.client.system.Empleado;
import org.balderrama.client.sistemadetalle.IngresoAlmacen;
import org.balderrama.client.sistemadetalle.IngresoTiendaMarca;
import org.balderrama.client.sistemadetalle.IngresoTiendaDetalle;
import org.balderrama.client.sistemadetalle.IngresoTiendaCodigo;
import org.balderrama.client.configuracion.ConfiguracionArticulos;
import org.balderrama.client.emergentes.SeleccionMarca;
import org.balderrama.client.emergentes.SeleccionMarcaTienda;
import org.balderrama.client.emergentes.SeleccionMarcaUnion;
import org.balderrama.client.emergentes.SeleccionMarcaRebaja;
//import org.balderrama.client.emergentes.SeleccionMarcaColeccion;
import org.balderrama.client.emergentes.SeleccionMarcaCodigoTienda;
import org.balderrama.client.emergentes.SeleccionMarcaCodigo;
import org.balderrama.client.emergentes.SeleccionMarcaKardex;
import org.balderrama.client.parametros.Cargos;
import org.balderrama.client.parametros.Ciudades;
//import org.balderrama.client.emergentes.SeleccionMarcaEstilo;
import org.balderrama.client.emergentes.SeleccionMarcaEstiloInventario;
import org.balderrama.client.emergentes.SeleccionMarcaEstiloInventariofecha;
import org.balderrama.client.emergentes.SeleccionMarcaEstiloCodigo;
import org.balderrama.client.emergentes.SeleccionCliente;
//import org.balderrama.client.emergentes.SeleccionTiposGastos;
import org.balderrama.client.Etapas.Control;
import org.balderrama.client.procesos.Periodo;
//import org.balderrama.client.tiposgastos.TiposGastos;
//import org.balderrama.client.tiposgastos.TiposGastosDetalle;
import org.balderrama.client.CobroMayor.CobrosMayor;
import org.balderrama.client.cliente.PanelCobro;
import org.balderrama.client.cliente.PanelCobroCuenta;
import org.balderrama.client.cliente.PanelCreditoRegistro;
import org.balderrama.client.cliente.clientedeudor;
import org.balderrama.client.cliente.DevolucionCobro;
import org.balderrama.client.configuracion.Configuracion;
import org.balderrama.client.configuracion.ConfiguracionColorDetalle;
import org.balderrama.client.emergentes.SeleccionAlmacenGeneral;
import org.balderrama.client.emergentes.SeleccionAlmacenRecapitula;
import org.balderrama.client.emergentes.SeleccionBuscadorModelo;
import org.balderrama.client.emergentes.SeleccionEstadistico;
import org.balderrama.client.emergentes.SeleccionGeneralFecha;
import org.balderrama.client.emergentes.SeleccionInformes;
import org.balderrama.client.emergentes.SeleccionInformesCliente;
import org.balderrama.client.emergentes.SeleccionMarcaEstiloInventarioBuscar;
import org.balderrama.client.emergentes.SeleccionMarcaEstiloInventarioControl;
//import org.balderrama.client.lector.menucarga;
//import org.balderrama.client.incentivo.EmpleadoAsistencia;
import org.balderrama.client.emergentes.SeleccionMarcaEstiloInventarioventa;
//import org.balderrama.client.emergentes.SeleccionMarcaFeria;
import org.balderrama.client.emergentes.SeleccionVendedorGeneral;
import org.balderrama.client.emergentes.SeleccionVentaFecha;
import org.balderrama.client.recapitulacion.recapitula;
import org.balderrama.client.reportes.PanelEstadistico1;
import org.balderrama.client.sistemadetalle.PanelInventarioM;
import org.balderrama.client.system.EditarMarcaEmpleado;
import org.balderrama.client.traspaso.ListaTraspaso;
//import org.balderrama.client.venta.Entrega;
//import org.balderrama.client.traspaso.PanelConfirmarTraspaso;
//import org.balderrama.client.traspaso.PanelCrearCaja;
import org.balderrama.client.traspaso.PanelTraspasoCaja;
import org.balderrama.client.traspaso.PanelTraspasoDetalle;
import org.balderrama.client.traspaso.SeleccionMarcaTraspaso;
import org.balderrama.client.venta.Devolucion;
import org.balderrama.client.venta.ListaAnulacion;
import org.balderrama.client.venta.ListaCambioMercaderia;
import org.balderrama.client.venta.ListaDevolucion;
import org.balderrama.client.venta.ListaVenta;
import org.balderrama.client.venta.PanelPedidoConfirmado1;
import org.balderrama.client.venta.PanelVenta;
import org.balderrama.client.venta.PanelVentaDetalle;
import org.balderrama.client.venta.PanelVentaCaja;
import org.balderrama.client.venta.SeleccionMarcaCliente;
//import org.balderrama.client.traspaso.SeleccionMarcaTraspaso;
//import org.balderrama.client.traspaso.PanelTraspaso;

/**
 *
 * @author HAYDEE
 */
public class KMenu implements MenuListener {

    Button button = null;
    MainEntryPoint panel;
    IngresoAlmacenForm ped;
    SeleccionMarca formM;
    SeleccionMarcaTienda formMT;
    SeleccionMarcaCliente formMTC;
    SeleccionMarcaTraspaso formMTCA;
    SeleccionMarcaUnion formMU;
    SeleccionMarcaRebaja formMUR;
    SeleccionMarcaEstiloInventario formMTEInventario;
    SeleccionAlmacenRecapitula formRec;
    SeleccionEstadistico formRecE;
    SeleccionAlmacenGeneral formRecg;
    SeleccionMarcaEstiloInventarioBuscar formMTEInventarioBuscar;
    SeleccionMarcaEstiloInventarioControl formMTEInventariocontrol;
    SeleccionBuscadorModelo formMTEBuscador;
    SeleccionMarcaEstiloInventariofecha formMTEInventariofecha;
    SeleccionMarcaEstiloInventarioventa formMTEInventarioventa;
    SeleccionGeneralFecha formMTEInventarioFechafin;
    SeleccionInformes formMI;
    SeleccionInformesCliente formMIC;
    SeleccionMarcaEstiloCodigo formMTEC;
 //    SeleccionMarcaFeria formMTEFeria;
    SeleccionVendedorGeneral formVenGral;
//    SeleccionMarcaOficina formMofi;
    CobrosMayor formMCM;
    ////CargarArchivo formCA;
    SeleccionMarcaProformas formProformas;
    SeleccionMarcaCodigo formMCo;
    SeleccionMarcaCodigoTienda formMCoT;
    SeleccionMarcaKardex formMKar;
    SeleccionVentaFecha formMKar1;
    SeleccionCliente formC;
//    SeleccionTiposGastos formG;
    ConfiguracionArticulos conf;
    Cobros cob;
    public Number tipoCambio;

    public KMenu(MainEntryPoint p) {
        this.panel = p;
    }

    public void onModuleLoad(JSONObject conec) {

        button = new Button();
        button.setText("----Menu Sistema");
        button.setIconCls("user-icon");
        Menu menu = new Menu();
        Object[][] categorias = Utils.getArrayOfJSONObject(conec, "resultado", new String[]{"idcategoriafuncion", "nombre"});
        for (int i = 0; i < categorias.length; i++) {
            String cadNom = categorias[i][1].toString();
            String cadID = categorias[i][0].toString();
            cadID = "CatFunc" + cadID;
            cadNom = cadNom;
            Menu subMenu = new Menu();
            subMenu.setId(cadID);
            subMenu.addListener(this);
            Object[][] func = Utils.getArrayOfJSONObject(conec, cadNom, new String[]{"idfuncion", "descripcion"});
//            com.google.gwt.user.client.Window.alert("nombre: "+cadNom+"id: "+cadID);
            for (int ii = 0; ii < func.length; ii++) {
                Item csharpItem = new Item(func[ii][1].toString());
                csharpItem.setId(func[ii][0].toString());
                csharpItem.setIconCls("settings-icon");
                subMenu.addItem(csharpItem);
            }
            MenuItem vsItem = new MenuItem(cadNom, subMenu);
            vsItem.setIconCls("plugins-nav-icon");
            menu.addItem(vsItem);

        }
        button.setMenu(menu);
        button.setMenuAlign("tl-bl?");




    }

    public KMenu getKmenu() {
        return this;
    }

    public Button getButton() {
        return button;
    }

    public void setButton(Button button) {
        this.button = button;
    }

    public void doBeforeHide(Menu menu) {
        //Window.alert("csharpItem8");
    }

    public void doBeforeShow(Menu menu) {
        //Window.alert("csharpItem7");
    }

    public void onClick(Menu menu, String menuItemId, EventObject e) {
        try {
            Panel temp = panel.getTabPanel().getItem("TP" + menuItemId);
            if (temp != null) {
                panel.getTabPanel().activate(temp.getId());
                panel.getTabPanel().scrollToTab(temp, true);
            } else {
                seleccionarOpcion(menu, menuItemId, e, null);
            }
        } catch (Exception ee) {
            seleccionarOpcion(menu, menuItemId, e, null);
        }

    }

    public void onHide(Menu menu) {
        //Window.alert("csharpItem1");
    }

    public void onItemClick(BaseItem item, EventObject e) {
        //Window.alert("csharpItem2");
    }

    public void onMouseOut(Menu menu, BaseItem menuItem, EventObject e) {
        //Window.alert("csharpItem3");
    }

    public void onMouseOver(Menu menu, BaseItem menuItem, EventObject e) {
        //Window.alert("csharpItem4");
    }

    public void onShow(Menu menu) {
        //Window.alert("csharpItem5");
    }

    public void seleccionarOpcion(Menu menu, String menuItemId, EventObject e, Object object) {
        if (object == null) {

            if (menuItemId.equalsIgnoreCase("fun1504")) {
                Marca mar = new Marca(this, panel);
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {

                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(mar);
                    panel.getTabPanel().activate(mar.getId());
                    panel.getTabPanel().scrollToTab(mar, true);
                }
            }


            if (menuItemId.equalsIgnoreCase("fun1002")) {
                formC = new SeleccionCliente(KMenu.this);
                formC.show();
            }
            if (menuItemId.equalsIgnoreCase("fun1005")) {
                Usuario proveedor = new Usuario();
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {
                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(proveedor);
                    panel.getTabPanel().activate(proveedor.getId());
                    panel.getTabPanel().scrollToTab(proveedor, true);
                }
            }
            if (menuItemId.equalsIgnoreCase("fun1007")) {
                Rol proveedor = new Rol();
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {
                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(proveedor);
                    panel.getTabPanel().activate(proveedor.getId());
                    panel.getTabPanel().scrollToTab(proveedor, true);
                }
            }

            if (menuItemId.equalsIgnoreCase("fun1008")) {
                CargarDatos proveedor = new CargarDatos();
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {
                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(proveedor);
                    panel.getTabPanel().activate(proveedor.getId());
                    panel.getTabPanel().scrollToTab(proveedor, true);
                }
            }
            if (menuItemId.equalsIgnoreCase("fun1507")) {
                ListarCalzados proveedor = new ListarCalzados();
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {
                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(proveedor);
                    panel.getTabPanel().activate(proveedor.getId());
                    panel.getTabPanel().scrollToTab(proveedor, true);
                }
            }


            if (menuItemId.equalsIgnoreCase("fun1012")) {
                Empleado proveedor = new Empleado(this, panel);
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {
                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(proveedor);
                    panel.getTabPanel().activate(proveedor.getId());
                    panel.getTabPanel().scrollToTab(proveedor, true);
                }
            }


            if (menuItemId.equalsIgnoreCase("fun1013")) {
                Cargos proveedor = new Cargos();
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {
                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(proveedor);
                    panel.getTabPanel().activate(proveedor.getId());
                    panel.getTabPanel().scrollToTab(proveedor, true);
                }
            }
            if (menuItemId.equalsIgnoreCase("fun1014")) {
                Ciudades proveedor = new Ciudades();
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {
                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(proveedor);
                    panel.getTabPanel().activate(proveedor.getId());
                    panel.getTabPanel().scrollToTab(proveedor, true);
                }
            }

            if (menuItemId.equalsIgnoreCase("fun1020")) {
                ConfiguracionArticulos Configuracion = new ConfiguracionArticulos();
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {
                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(Configuracion);
                    panel.getTabPanel().activate(Configuracion.getId());
                    panel.getTabPanel().scrollToTab(Configuracion, true);
                }
            }




            if (menuItemId.equalsIgnoreCase("fun1004")) {
                Almacen linea = new Almacen();
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador ", "error");
                } else {
                    Utils.setErrorPrincipal("Se cargo el manejador de Almacen", "mensaje");
                    panel.getTabPanel().add(linea);
                    panel.getTabPanel().activate(linea.getId());
                    panel.getTabPanel().scrollToTab(linea, true);
                }
            }


            if (menuItemId.equalsIgnoreCase("fun2011")) {
                long idpanel = (new Date()).getTime();
                Configuracion res = new Configuracion(idpanel, panel);
                res.onModuleLoad();
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador ", "error");
                } else {
                    Utils.setErrorPrincipal("Se cargo el manejador de estado de resultados", "mensaje");
                    //   setPropiedades(res.getPanel().getId(), res.getPanel(), tabPanel);
                    panel.getTabPanel().setActiveTab("tab-9600_venta-" + idpanel);
                }
            }




            if (menuItemId.equalsIgnoreCase("fun1500")) {
                Coleccion linea = new Coleccion();
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {
                    Utils.setErrorPrincipal("Se cargo el manejador de Coleccion", "mensaje");
                    panel.getTabPanel().add(linea);
                    panel.getTabPanel().activate(linea.getId());
                    panel.getTabPanel().scrollToTab(linea, true);
                }
            }


            if (menuItemId.equalsIgnoreCase("fun1502")) {
                String enlace = "php/Marca.php?funcion=BuscarMarcaLineaColeccion";
//                Utils.setErrorPrincipal("Cargando tienda y marca", "cargar");
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {

//                                        Object[][] tiendaM = Utils.getArrayOfJSONObject(marcaO, "tiendaM", new String[]{"idtienda", "nombre"});
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        Object[][] lineaM = Utils.getArrayOfJSONObject(marcaO, "lineaM", new String[]{"idlinea", "codigo"});
                                        Object[][] coleccionM = Utils.getArrayOfJSONObject(marcaO, "coleccionM", new String[]{"idcoleccion", "codigo"});

                                        Modelo pro = new Modelo(marcaM, lineaM, coleccionM);
                                        if (panel.getTabPanel() == null) {
                                            Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                                        } else {

                                            Utils.setErrorPrincipal("Se cargo el manejador ", "mensaje");
                                            panel.getTabPanel().add(pro);
                                            panel.getTabPanel().activate(pro.getId());
                                        //panel.getTabPanel().scrollToTab(pro, true);
                                        }
                                    //
                                    } else {
                                        Utils.setErrorPrincipal(mensajeR, "error");
                                    }
                                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }

//            if (menuItemId.equalsIgnoreCase("fun4000")) {
//                Muestra mar = new Muestra();
//                if (panel.getTabPanel() == null) {
//                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
//                } else {
//                    Utils.setErrorPrincipal("Se cargo el manejador publicidad web", "mensaje");
//                    panel.getTabPanel().add(mar);
//                    panel.getTabPanel().activate(mar.getId());
//                    panel.getTabPanel().scrollToTab(mar, true);
//                }
//            }

            if (menuItemId.equalsIgnoreCase("fun2007")) {
                ConfiguracionParametro linea = new ConfiguracionParametro();
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {
                    Utils.setErrorPrincipal("Se cargo el manejador de tienda", "mensaje");
                    panel.getTabPanel().add(linea);
                    panel.getTabPanel().activate(linea.getId());
                    panel.getTabPanel().scrollToTab(linea, true);
                }
            }


            //reporte prueba////////////////////
            if (menuItemId.equalsIgnoreCase("fun1101")) {
                String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaAlmaceninventario";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        Object[][] kardexM = Utils.getArrayOfJSONObject(marcaO, "kardexM", new String[]{"idkardex", "mesrango", "fechainicio", "fechafin"});
                                        //  Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{"idalmacen", "nombre"});
                                        String mesrango = Utils.getStringOfJSONObject(marcaO, "mesrango");
                                        String fechaini = Utils.getStringOfJSONObject(marcaO, "fechaini");
                                        String fechafin = Utils.getStringOfJSONObject(marcaO, "fechafin");
                                        formRec = new SeleccionAlmacenRecapitula(mesrango, fechaini, fechafin, kardexM, estiloM, KMenu.this);
                                        formRec.show();

                                    }                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }
            if (menuItemId.equalsIgnoreCase("fun1104")) {
                String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaAlmaceninventario";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        Object[][] kardexM = Utils.getArrayOfJSONObject(marcaO, "kardexM", new String[]{"idkardex", "mesrango", "fechainicio", "fechafin"});
                                        //  Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{"idalmacen", "nombre"});
                                        String mesrango = Utils.getStringOfJSONObject(marcaO, "mesrango");
                                        String fechaini = Utils.getStringOfJSONObject(marcaO, "fechaini");
                                        String fechafin = Utils.getStringOfJSONObject(marcaO, "fechafin");
                                        formRecE = new SeleccionEstadistico(mesrango, fechaini, fechafin, kardexM, estiloM, KMenu.this);
                                        formRecE.show();

                                    }                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }
            if (menuItemId.equalsIgnoreCase("fun1102")) {
                // String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaAlmaceninventario";
                String enlace = "php/IngresoAlmacen.php?funcion=BuscarInventarioVendedor";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        Object[][] kardexM = Utils.getArrayOfJSONObject(marcaO, "kardexM", new String[]{"idkardex", "mesrango", "fechainicio", "fechafin"});

                                        String mesrango = Utils.getStringOfJSONObject(marcaO, "mesrango");
                                        String fechaini = Utils.getStringOfJSONObject(marcaO, "fechaini");
                                        String fechafin = Utils.getStringOfJSONObject(marcaO, "fechafin");
//                                        formRec = new SeleccionAlmacenRecapitula(mesrango,fechaini,fechafin,kardexM,estiloM ,KMenu.this);
//                                        formRec.show();
                                        Object[][] vendedorM = Utils.getArrayOfJSONObject(marcaO, "empleadoM", new String[]{"idempleado", "nombre"});
                                        formVenGral = new SeleccionVendedorGeneral(mesrango, fechaini, fechafin, kardexM, vendedorM, KMenu.this);
                                        formVenGral.show();

                                    }                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }

            if (menuItemId.equalsIgnoreCase("fun1103")) {
                String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaAlmaceninventario";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        Object[][] kardexM = Utils.getArrayOfJSONObject(marcaO, "kardexM", new String[]{"idkardex", "mesrango", "fechainicio", "fechafin"});
                                        //  Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{"idalmacen", "nombre"});
                                        String mesrango = Utils.getStringOfJSONObject(marcaO, "mesrango");
                                        String fechaini = Utils.getStringOfJSONObject(marcaO, "fechaini");
                                        String fechafin = Utils.getStringOfJSONObject(marcaO, "fechafin");
                                        formRecg = new SeleccionAlmacenGeneral(mesrango, fechaini, fechafin, kardexM, estiloM, KMenu.this);
                                        formRecg.show();

                                    }                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }
            //reporte fin prueba////

            if (menuItemId.equalsIgnoreCase("fun3010")) {

                String enlace = "php/Marca.php?funcion=BuscarMarca";
//                Utils.setErrorPrincipal("Cargando tienda y marca", "cargar");
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {

//                                        Object[][] tiendaM = Utils.getArrayOfJSONObject(marcaO, "tiendaM", new String[]{"idtienda", "nombre"});
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
//                                Object[][] caracM1016 = Utils.getArrayOfJSONObject(jsonObject, "caracteristicaM", new String[]{"idcaracteristica", "nombre"});

                                        //IngresoAlmacenForm aux  = new IngresoAlmacenForm(KMenu.this, panel);
                                        //IngresoAlmacenForm(KMenu.this, panel);

                                        formMCo = new SeleccionMarcaCodigo(marcaM, KMenu.this);
                                        formMCo.show();


                                    }

                                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }

            if (menuItemId.equalsIgnoreCase("fun1030")) {
                String enlace = "php/Cliente.php?funcion=BuscarClienteActivo";
//                Utils.setErrorPrincipal("Cargando tienda y marca", "cargar");
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {
                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
//                                        Object[][] tiendaM = Utils.getArrayOfJSONObject(marcaO, "tiendaM", new String[]{"idtienda", "nombre"});
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
                                        formMKar = new SeleccionMarcaKardex(marcaM, KMenu.this);
                                        formMKar.show();
                                    }
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }

            if (menuItemId.equalsIgnoreCase("fun30041")) {

                String enlace = "php/Cliente.php?funcion=BuscarCliente";
//                Utils.setErrorPrincipal("Cargando tienda y marca", "cargar");
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {

//                                        Object[][] tiendaM = Utils.getArrayOfJSONObject(marcaO, "tiendaM", new String[]{"idtienda", "nombre"});
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});

                                        formMKar1 = new SeleccionVentaFecha(marcaM, KMenu.this);
                                        formMKar1.show();


                                    }

                                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }
            if (menuItemId.equalsIgnoreCase("fun1031")) {
                clientedeudor linea = new clientedeudor(KMenu.this);
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {
                    Utils.setErrorPrincipal("Se cargo el manejador de Empresa", "mensaje");
                    panel.getTabPanel().add(linea);
                    panel.getTabPanel().activate(linea.getId());
                    panel.getTabPanel().scrollToTab(linea, true);
                }
            }

            //reporte fin prueba////

            //registroextra
            if (menuItemId.equalsIgnoreCase("fun5013")) {

                String enlace = "php/Marca.php?funcion=BuscarMarca";
//                Utils.setErrorPrincipal("Cargando tienda y marca", "cargar");
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {

//                                        Object[][] tiendaM = Utils.getArrayOfJSONObject(marcaO, "tiendaM", new String[]{"idtienda", "nombre"});
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        formMT = new SeleccionMarcaTienda(marcaM, KMenu.this);
                                        formMT.show();


                                    }

                                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }
            //union
            if (menuItemId.equalsIgnoreCase("fun5014")) {

                String enlace = "php/Marca.php?funcion=BuscarMarca";
//                Utils.setErrorPrincipal("Cargando tienda y marca", "cargar");
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {

//                                        Object[][] tiendaM = Utils.getArrayOfJSONObject(marcaO, "tiendaM", new String[]{"idtienda", "nombre"});
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});

                                        formMU = new SeleccionMarcaUnion(marcaM, KMenu.this);
                                        formMU.show();


                                    }

                                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }
            //modificarextra

            if (menuItemId.equalsIgnoreCase("fun5021")) {
//reimpresion codigo
                String enlace = "php/Marca.php?funcion=BuscarMarca";
                //String enlace = "php/Marca.php?funcion=BuscarMarca";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {

//                                        Object[][] tiendaM = Utils.getArrayOfJSONObject(marcaO, "tiendaM", new String[]{"idtienda", "nombre"});
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        //Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "estiloM", new String[]{"idestilo", "nombre"});
                                        //  Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "estiloM", new String[]{"idestilo", "idmarca","nombre"});
                                        formMTEC = new SeleccionMarcaEstiloCodigo(marcaM, KMenu.this);
                                        formMTEC.show();


                                    }

                                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }
            //administra inventario
            if (menuItemId.equalsIgnoreCase("fun2303")) {
                String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaAlmaceninventario";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        Object[][] kardexM = Utils.getArrayOfJSONObject(marcaO, "kardexM", new String[]{"idkardex", "mesrango", "fechainicio", "fechafin"});
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{"idalmacen", "nombre"});
                                        String mesrango = Utils.getStringOfJSONObject(marcaO, "mesrango");
                                        String fechaini = Utils.getStringOfJSONObject(marcaO, "fechaini");
                                        String fechafin = Utils.getStringOfJSONObject(marcaO, "fechafin");
                                        formMTEInventario = new SeleccionMarcaEstiloInventario(mesrango, fechaini, fechafin, kardexM, marcaM, estiloM, KMenu.this);
                                        formMTEInventario.show();
                                    }                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }
            if (menuItemId.equalsIgnoreCase("fun2301")) {
                String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaEstiloinventariocierre";

                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        //      Object[][] kardexM = Utils.getArrayOfJSONObject(marcaO, "kardexM", new String[]{"idkardex", "mesrango","fechainicio","fechafin"});
                                        Object[][] kardexM = Utils.getArrayOfJSONObject(marcaO, "kardexM", new String[]{"idalmacen", "nombre", "idkardex", "mesrango"});

                                        //  Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        // Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{"idalmacen","nombre"});
                                        String mesrango = Utils.getStringOfJSONObject(marcaO, "mesrango");
                                        String fechaini = Utils.getStringOfJSONObject(marcaO, "fechaini");
                                        String fechafin = Utils.getStringOfJSONObject(marcaO, "fechafin");
                                        //formMTEInventario = new SeleccionMarcaEstiloInventario(mesrango,fechaini,fechafin,kardexM,marcaM,estiloM ,KMenu.this);
                                        //                             formMTEInventario.show();
                                        formMTEInventariocontrol = new SeleccionMarcaEstiloInventarioControl(kardexM, KMenu.this);
                                        formMTEInventariocontrol.show();
                                    }                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }
            if (menuItemId.equalsIgnoreCase("fun2309")) {
                String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaAlmaceninventario";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        Object[][] kardexM = Utils.getArrayOfJSONObject(marcaO, "kardexM", new String[]{"idkardex", "mesrango", "fechainicio", "fechafin"});
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{"idalmacen", "nombre"});
                                        String mesrango = Utils.getStringOfJSONObject(marcaO, "mesrango");
                                        String fechaini = Utils.getStringOfJSONObject(marcaO, "fechaini");
                                        String fechafin = Utils.getStringOfJSONObject(marcaO, "fechafin");
                                        //formMTEInventario = new SeleccionMarcaEstiloInventario(mesrango,fechaini,fechafin,kardexM,marcaM,estiloM ,KMenu.this);
                                        //                             formMTEInventario.show();

                                        formMTEBuscador = new SeleccionBuscadorModelo(kardexM, estiloM, KMenu.this);
                                        formMTEBuscador.show();
                                    }                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }

            if (menuItemId.equalsIgnoreCase("fun2304")) {
                String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaEmpleado";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "nombre"});
                                        formMTEInventariofecha = new SeleccionMarcaEstiloInventariofecha(marcaM, estiloM, KMenu.this);
                                        formMTEInventariofecha.show();
                                    }                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }

            if (menuItemId.equalsIgnoreCase("fun23041")) {
                String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaEmpleado";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "nombre"});
                                        formMTEInventarioventa = new SeleccionMarcaEstiloInventarioventa(marcaM, estiloM, KMenu.this);
                                        formMTEInventarioventa.show();
                                    }                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }

              if (menuItemId.equalsIgnoreCase("fun23042")) {
                String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaEmpleado";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "nombre"});
//                                        formMTEFeria = new SeleccionMarcaFeria(marcaM, estiloM, KMenu.this);
//                                        formMTEFeria.show();
                                           formMTEInventarioventa = new SeleccionMarcaEstiloInventarioventa(marcaM, estiloM, KMenu.this);
                                        formMTEInventarioventa.show();
                                    }                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }
            if (menuItemId.equalsIgnoreCase("fun23091")) {
                String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaEmpleado";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "nombre"});
                                        formMTEInventarioFechafin = new SeleccionGeneralFecha(marcaM, estiloM, KMenu.this);
                                        formMTEInventarioFechafin.show();
                                    }                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }


            if (menuItemId.equalsIgnoreCase("fun30042")) {
                String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaEmpleado";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "nombre"});
                                        formMI = new SeleccionInformes(marcaM, estiloM, KMenu.this);
                                        formMI.show();
                                    }                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }
            if (menuItemId.equalsIgnoreCase("fun30043")) {
                ////String enlace = "php/Cliente.php?funcion=BuscarCliente";
                String enlace = "php/IngresoAlmacen.php?funcion=BuscarMFMarcaVendedorCliente";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        Object[][] almacenM = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{"idalmacen", "nombre"});
                                        Object[][] vendedorM = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "nombre"});
                                        String mescierre = Utils.getStringOfJSONObject(marcaO, "mescierre");
                                        String fechaini = Utils.getStringOfJSONObject(marcaO, "fechaini");
                                        String fechafin = Utils.getStringOfJSONObject(marcaO, "fechafin");
                                        Object[][] clienteM = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
                                        formMIC = new SeleccionInformesCliente(almacenM, mescierre, fechaini, fechafin, marcaM, vendedorM, clienteM, KMenu.this);
                                        formMIC.show();
                                    }
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }

            if (menuItemId.equalsIgnoreCase("fun30044")) {
                final String idmarca = "mar-1";
                String enlace = "php/VentaMayor.php?funcion=Buscardatosparadevcobro&idmarca=" + idmarca;
                Utils.setErrorPrincipal("Cargando parametros ", "cargar");
                final Conector conec = new Conector(enlace, false);
                {
                    try {
                        conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                            private EventObject e;

                            public void onResponseReceived(Request request, Response response) {
                                String data = response.getText();
                                JSONValue jsonValue = JSONParser.parse(data);
                                JSONObject jsonObject;
                                if ((jsonObject = jsonValue.isObject()) != null) {
                                    String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                    String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                    if (errorR.equalsIgnoreCase("true")) {
                                        Utils.setErrorPrincipal(mensajeR, "mensaje");

                                        JSONValue marcaV = jsonObject.get("resultado");
                                        JSONObject marcaO;
                                        if ((marcaO = marcaV.isObject()) != null) {
                                            Object[][] vendedores = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "codigo"});
                                            Object[][] clientes = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
                                            Object[][] marcas = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                            String vendedor = Utils.getStringOfJSONObject(marcaO, "vendedor");
                                            String marca = Utils.getStringOfJSONObject(marcaO, "marca");
                                            String tipocambio = Utils.getStringOfJSONObject(marcaO, "tipocambio");
                                            String almacen = Utils.getStringOfJSONObject(marcaO, "almacen");
                                            String boleta = Utils.getStringOfJSONObject(marcaO, "boleta");
                                            DevolucionCobro pro = new DevolucionCobro(idmarca, marca, boleta, vendedor, vendedores, clientes, marcas, tipocambio, almacen, KMenu.this);
                                            if (panel.getTabPanel() == null) {
                                                Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                                            } else {
                                                Utils.setErrorPrincipal("Se cargo el manejador ", "mensaje");
                                                panel.getTabPanel().add(pro);
                                                panel.getTabPanel().activate(pro.getId());
                                            }
                                            Utils.setErrorPrincipal("Se cargaron los parametros Correctamente", "mensaje");
                                        } else {
                                            //Utils.setErrorPrincipal("Salio ", "mensaje");
                                            //                 MessageBox.alert("No Hay datos en la consulta");
                                        }
                                    }
                                } else {
                                }
                                throw new UnsupportedOperationException("Not supported yet.");
                            }

                            public void onError(Request request, Throwable exception) {
                                throw new UnsupportedOperationException("Not supported yet.");
                            }
                        });
                    } catch (RequestException ea) {
                        ea.getMessage();
                    //             MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
                    }
                }
            }

            ////if (menuItemId.equalsIgnoreCase("fun30045")) {
            if (menuItemId.equalsIgnoreCase("fun8000")) {
                String enlace = "php/Marca.php?funcion=BuscarMarcaProcesar";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {
                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        formProformas = new SeleccionMarcaProformas(marcaM, KMenu.this);
                                        formProformas.show();
                                    }
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }

            if (menuItemId.equalsIgnoreCase("fun2305")) {
                String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaEmpleado";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "nombre"});
                                        formMUR = new SeleccionMarcaRebaja(marcaM, estiloM, KMenu.this);
                                        formMUR.show();
                                    }                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }

            }

//if (menuItemId.equalsIgnoreCase("fun1504")) {
//                Marca mar = new Marca(this, panel);
//                if (panel.getTabPanel() == null) {
//                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
//                } else {
//
//                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
//                    panel.getTabPanel().add(mar);
//                    panel.getTabPanel().activate(mar.getId());
//                    panel.getTabPanel().scrollToTab(mar, true);
//                }
//            }

            if (menuItemId.equalsIgnoreCase("fun2308")) {
                final String idmarca = "mar-1";
                String enlace = "php/VentaMayor.php?funcion=Buscardatosparaventa&idmarca=" + idmarca;
                //  String enlace = "php/Marca.php?funcion=BuscarClienteEstiloColorMaterialModeloLineaPorMarca&idmarca=" + idmarca;
                Utils.setErrorPrincipal("Cargando parametros ", "cargar");
                final Conector conec = new Conector(enlace, false);
                {
                    try {
                        conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                            private EventObject e;

                            public void onResponseReceived(Request request, Response response) {
                                String data = response.getText();
                                JSONValue jsonValue = JSONParser.parse(data);
                                JSONObject jsonObject;
                                if ((jsonObject = jsonValue.isObject()) != null) {
                                    String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                    String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                    if (errorR.equalsIgnoreCase("true")) {
                                        Utils.setErrorPrincipal(mensajeR, "mensaje");

                                        JSONValue marcaV = jsonObject.get("resultado");
                                        JSONObject marcaO;
                                        if ((marcaO = marcaV.isObject()) != null) {
                                            Object[][] vendedores = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "codigo"});
                                            Object[][] clientes = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
                                            String vendedor = Utils.getStringOfJSONObject(marcaO, "vendedor");
                                            String marca = Utils.getStringOfJSONObject(marcaO, "marca");
                                            String tipocambio = Utils.getStringOfJSONObject(marcaO, "tipocambio");
                                            String almacen = Utils.getStringOfJSONObject(marcaO, "almacen");
                                            String boleta = Utils.getStringOfJSONObject(marcaO, "boleta");

                                            recapitula pro = new recapitula(idmarca, vendedor, vendedores, clientes, tipocambio, almacen, KMenu.this);

                                            if (panel.getTabPanel() == null) {
                                                Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                                            } else {

                                                Utils.setErrorPrincipal("Se cargo el manejador ", "mensaje");
                                                panel.getTabPanel().add(pro);
                                                panel.getTabPanel().activate(pro.getId());
                                            //panel.getTabPanel().scrollToTab(pro, true);
                                            }
                                            //
                                            Utils.setErrorPrincipal("Se cargaron los parametros Correctamente", "mensaje");


                                        //    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + opcion, "mensaje");
                                        } else {
                                            //                 MessageBox.alert("No Hay datos en la consulta");
                                        }
                                    }
                                } else {
                                }
                                throw new UnsupportedOperationException("Not supported yet.");
                            }

                            public void onError(Request request, Throwable exception) {
                                throw new UnsupportedOperationException("Not supported yet.");
                            }
                        });

                    } catch (RequestException ea) {
                        ea.getMessage();
                    //             MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
                    }

                }
            }


// if (menuItemId.equalsIgnoreCase("fun1040")) {
//
//                String enlace = "php/Muestra.php?funcion=BuscarMarcaAlmacenColeccion";
////                Utils.setErrorPrincipal("Cargando tienda y marca", "cargar");
//                final Conector conecaPB = new Conector(enlace, false);
//                try {
//                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {
//
//                        public void onResponseReceived(Request request, Response response) {
//                            String data = response.getText();
//                            JSONValue jsonValue = JSONParser.parse(data);
//                            JSONObject jsonObject;
//                            if ((jsonObject = jsonValue.isObject()) != null) {
//
//                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
//                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
//                                if (errorR.equalsIgnoreCase("true")) {
//                                    JSONValue marcaV = jsonObject.get("resultado");
//                                    JSONObject marcaO;
//                                    if ((marcaO = marcaV.isObject()) != null) {
//
//                               //         Object[][] tiendaM = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{"idalmacen", "nombre"});
//                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
////                                Object[][] caracM1016 = Utils.getArrayOfJSONObject(jsonObject, "caracteristicaM", new String[]{"idcaracteristica", "nombre"});
//  String coleccion = Utils.getStringOfJSONObject(marcaO, "coleccion");
//
//                                        //IngresoAlmacenForm aux  = new IngresoAlmacenForm(KMenu.this, panel);
//                                        //IngresoAlmacenForm(KMenu.this, panel);
//s
//                                        formMofic = new SeleccionMarcaColeccion(marcaM, coleccion,KMenu.this);
//                                        formMofic.show();
//
//
//                                    }
//
//                                //
//                                } else {
//                                    Utils.setErrorPrincipal(mensajeR, "error");
//                                }
//                            } else {
//                                Utils.setErrorPrincipal("Error en los datos", "error");
//                            }
//                        }
//
//                        public void onError(Request request, Throwable exception) {
//                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//                        }
//                    });
//                } catch (RequestException ex) {
//                    ex.getMessage();
//                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//                }
//            }


// if (menuItemId.equalsIgnoreCase("fun1041")) {
//
//                String enlace = "php/Muestra.php?funcion=BuscarMarcaAlmacenColeccion";
////                Utils.setErrorPrincipal("Cargando tienda y marca", "cargar");
//                final Conector conecaPB = new Conector(enlace, false);
//                try {
//                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {
//
//                        public void onResponseReceived(Request request, Response response) {
//                            String data = response.getText();
//                            JSONValue jsonValue = JSONParser.parse(data);
//                            JSONObject jsonObject;
//                            if ((jsonObject = jsonValue.isObject()) != null) {
//
//                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
//                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
//                                if (errorR.equalsIgnoreCase("true")) {
//                                    JSONValue marcaV = jsonObject.get("resultado");
//                                    JSONObject marcaO;
//                                    if ((marcaO = marcaV.isObject()) != null) {
//
//                                        Object[][] tiendaM = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{"idalmacen", "nombre"});
//                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
////                                Object[][] caracM1016 = Utils.getArrayOfJSONObject(jsonObject, "caracteristicaM", new String[]{"idcaracteristica", "nombre"});
//  String coleccion = Utils.getStringOfJSONObject(marcaO, "coleccion");
//
//                                        //IngresoAlmacenForm aux  = new IngresoAlmacenForm(KMenu.this, panel);
//                                        //IngresoAlmacenForm(KMenu.this, panel);
//s
//                                        formMofi = new SeleccionMarcaOficina(marcaM, tiendaM,coleccion,KMenu.this);
//                                        formMofi.show();
//
//
//                                    }
//
//                                //
//                                } else {
//                                    Utils.setErrorPrincipal(mensajeR, "error");
//                                }
//                            } else {
//                                Utils.setErrorPrincipal("Error en los datos", "error");
//                            }
//                        }
//
//                        public void onError(Request request, Throwable exception) {
//                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//                        }
//                    });
//                } catch (RequestException ex) {
//                    ex.getMessage();
//                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//                }
//            }
            if (menuItemId.equalsIgnoreCase("fun1044")) {

                String enlace = "php/Marca.php?funcion=BuscarMarca";
//                Utils.setErrorPrincipal("Cargando tienda y marca", "cargar");
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {

//                                        Object[][] tiendaM = Utils.getArrayOfJSONObject(marcaO, "tiendaM", new String[]{"idtienda", "nombre"});
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        formMTCA = new SeleccionMarcaTraspaso(marcaM, KMenu.this);
                                        formMTCA.show();


                                    }

                                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }


            if (menuItemId.equalsIgnoreCase("fun6021")) {
                String enlace = "php/CobroMayor.php?funcion=BuscarClienteMarcaReciboTipoCambio";

//                String enlace = "php/Muestra.php?funcion=BuscarMarcaAlmacenColeccion";
//                Utils.setErrorPrincipal("Cargando tienda y marca", "cargar");
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {

                                        Object[][] clienteM = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "nombre"});
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "idcliente", "nombre"});
                                        // Object[][] reciboM = Utils.getArrayOfJSONObject(marcaO, "reciboM", new String[]{"factura", "idcredito","idmarca","idcliente"});
                                        String tipocambio = Utils.getStringOfJSONObject(marcaO, "tipocambio");

                                        //IngresoAlmacenForm aux  = new IngresoAlmacenForm(KMenu.this, panel);
                                        //IngresoAlmacenForm(KMenu.this, panel);

                                        formMCM = new CobrosMayor(clienteM, marcaM, tipocambio, KMenu.this);
                                        formMCM.show();


                                    }

                                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }
            if (menuItemId.equalsIgnoreCase("fun1043")) {
                ListaTraspaso pedido1 = new ListaTraspaso(KMenu.this);
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {

                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(pedido1);
                    panel.getTabPanel().activate(pedido1.getId());
                    panel.getTabPanel().scrollToTab(pedido1, true);
                }

            }
            if (menuItemId.equalsIgnoreCase("fun6004")) {
                ListaDevolucion pedido1 = new ListaDevolucion(KMenu.this);
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {

                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(pedido1);
                    panel.getTabPanel().activate(pedido1.getId());
                    panel.getTabPanel().scrollToTab(pedido1, true);
                }
            }
            if (menuItemId.equalsIgnoreCase("fun6006")) {
                ListaAnulacion pedido1 = new ListaAnulacion(KMenu.this);
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {

                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(pedido1);
                    panel.getTabPanel().activate(pedido1.getId());
                    panel.getTabPanel().scrollToTab(pedido1, true);
                }
            }
            if (menuItemId.equalsIgnoreCase("fun6000")) {
                ListaVenta pedido1 = new ListaVenta(KMenu.this);
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {

                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(pedido1);
                    panel.getTabPanel().activate(pedido1.getId());
                    panel.getTabPanel().scrollToTab(pedido1, true);
                }

            }
            if (menuItemId.equalsIgnoreCase("fun6003")) {
                final String idmarca = "mar-1";
                String enlace = "php/VentaMayor.php?funcion=Buscardatosparadev&idmarca=" + idmarca;
                //  String enlace = "php/Marca.php?funcion=BuscarClienteEstiloColorMaterialModeloLineaPorMarca&idmarca=" + idmarca;

                Utils.setErrorPrincipal("Cargando parametros ", "cargar");
                final Conector conec = new Conector(enlace, false);
                {
                    try {
                        conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                            private EventObject e;

                            public void onResponseReceived(Request request, Response response) {
                                String data = response.getText();
                                JSONValue jsonValue = JSONParser.parse(data);
                                JSONObject jsonObject;
                                if ((jsonObject = jsonValue.isObject()) != null) {
                                    String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                    String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                    if (errorR.equalsIgnoreCase("true")) {
                                        Utils.setErrorPrincipal(mensajeR, "mensaje");

                                        JSONValue marcaV = jsonObject.get("resultado");
                                        JSONObject marcaO;
                                        if ((marcaO = marcaV.isObject()) != null) {
                                            Object[][] vendedores = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "codigo"});
                                            Object[][] clientes = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
                                            Object[][] marcas = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});

                                            String vendedor = Utils.getStringOfJSONObject(marcaO, "vendedor");
                                            String marca = Utils.getStringOfJSONObject(marcaO, "marca");
                                            String tipocambio = Utils.getStringOfJSONObject(marcaO, "tipocambio");
                                            String almacen = Utils.getStringOfJSONObject(marcaO, "almacen");
                                            String boleta = Utils.getStringOfJSONObject(marcaO, "boleta");

                                            Devolucion pro = new Devolucion(idmarca, marca, boleta, vendedor, vendedores, clientes, marcas, tipocambio, almacen, KMenu.this);

                                            if (panel.getTabPanel() == null) {
                                                Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                                            } else {

                                                Utils.setErrorPrincipal("Se cargo el manejador ", "mensaje");
                                                panel.getTabPanel().add(pro);
                                                panel.getTabPanel().activate(pro.getId());
                                            //panel.getTabPanel().scrollToTab(pro, true);
                                            }
                                            //
                                            Utils.setErrorPrincipal("Se cargaron los parametros Correctamente", "mensaje");


                                        //    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + opcion, "mensaje");
                                        } else {
                                            //                 MessageBox.alert("No Hay datos en la consulta");
                                        }
                                    }
                                } else {
                                }
                                throw new UnsupportedOperationException("Not supported yet.");
                            }

                            public void onError(Request request, Throwable exception) {
                                throw new UnsupportedOperationException("Not supported yet.");
                            }
                        });

                    } catch (RequestException ea) {
                        ea.getMessage();
                    //             MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
                    }

                }
            }

//if (menuItemId.equalsIgnoreCase("fun5030")) {
//                PanelTraspaso p = (PanelTraspaso) object;
//                panel.getTabPanel().add(p);
//                panel.getTabPanel().activate(p.getId());
//                panel.getTabPanel().scrollToTab(p, true);
//
//
//            }
            if (menuItemId.equalsIgnoreCase("fun5017")) {
                IngresoTiendaMarca pedido1 = new IngresoTiendaMarca(KMenu.this);
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {

                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(pedido1);
                    panel.getTabPanel().activate(pedido1.getId());
                    panel.getTabPanel().scrollToTab(pedido1, true);
                }


            }
            //traspasos
            if (menuItemId.equalsIgnoreCase("fun5017")) {
                IngresoTiendaMarca pedido1 = new IngresoTiendaMarca(KMenu.this);
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {

                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(pedido1);
                    panel.getTabPanel().activate(pedido1.getId());
                    panel.getTabPanel().scrollToTab(pedido1, true);
                }


            }
//codigobarra
            if (menuItemId.equalsIgnoreCase("fun5018")) {
                //  String enlTemp = "http://sistema.novamoda-bo.com/NovaModa/web/proformas";
                String enlTemp = "http://sistema.novamoda.com.bo/NovaModa/web/proformas";
                com.google.gwt.user.client.Window.open(enlTemp, "_blank", "enlTemp");
            }

            if (menuItemId.equalsIgnoreCase("fun5019")) {
                String enlace = "php/Marca.php?funcion=BuscarMarca";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {
                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        formMCoT = new SeleccionMarcaCodigoTienda(marcaM, KMenu.this);
                                        formMCoT.show();
                                    }
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }

            if (menuItemId.equalsIgnoreCase("fun3004")) {
                String enlace = "php/ControlPrecioPedido.php?funcion=BuscarMarcaPedido";


//                Utils.setErrorPrincipal("Cargando tienda y marca", "cargar");
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {

                                        Object[][] pedidoM = Utils.getArrayOfJSONObject(marcaO, "pedidoM", new String[]{"idpedido", "numeropedido", "idmarca"});
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
//
                                    //   controlpp = new ControlPrecioPedidoForm(marcaM, pedidoM, KMenu.this);
                                    //  controlpp.show();

                                    }

                                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }

            if (menuItemId.equalsIgnoreCase("fun6002")) {

                String enlace = "php/Marca.php?funcion=BuscarMarca";
//                Utils.setErrorPrincipal("Cargando tienda y marca", "cargar");
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {

//                                        Object[][] tiendaM = Utils.getArrayOfJSONObject(marcaO, "tiendaM", new String[]{"idtienda", "nombre"});
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        formMTC = new SeleccionMarcaCliente(marcaM, KMenu.this);
                                        formMTC.show();


                                    }

                                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }



            if (menuItemId.equalsIgnoreCase("fun1705")) {

                String enlace = "php/Cobros.php?funcion=ConsultaEmpresa";
//                Utils.setErrorPrincipal("Cargando tienda y marca", "cargar");
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {

//                                        Object[][] tiendaM = Utils.getArrayOfJSONObject(marcaO, "tiendaM", new String[]{"idtienda", "nombre"});
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "empresaM", new String[]{"idempresa", "nombre"});
//
                                        String planilla = Utils.getStringOfJSONObject(marcaO, "planilla");

                                    //   Object[][] caracM1016 = Utils.getArrayOfJSONObject(jsonObject, "caracteristicaM", new String[]{"idcaracteristica", "nombre"});

                                    //IngresoAlmacenForm aux  = new IngresoAlmacenForm(KMenu.this, panel);
                                    //IngresoAlmacenForm(KMenu.this, panel);

                                    //        formGGG = new ConsultaPlanilla(marcaM, planilla, KMenu.this);
                                    //        formGGG.show();


                                    }

                                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }


            if (menuItemId.equalsIgnoreCase("fun1804")) {

                String enlace = "php/Cobros.php?funcion=BuscarClienteEmpresa";
//                Utils.setErrorPrincipal("Cargando tienda y marca", "cargar");
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {

//                                         clienteC = Utils.getArrayOfJSONObject(compraObject, "clienteM", new String[]{"idcliente","idempresa", "nombre"});
                                        Object[][] empresaC = Utils.getArrayOfJSONObject(marcaO, "empresaM", new String[]{"idempresa", "nombre"});
                                        Object[][] clienteM = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "idempresa", "nombre"});

                                    }

                                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            }


            if (menuItemId.equalsIgnoreCase("fun10201")) {
                Periodo linea = new Periodo();
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {
                    Utils.setErrorPrincipal("Se cargo el manejador de Empresa", "mensaje");
                    panel.getTabPanel().add(linea);
                    panel.getTabPanel().activate(linea.getId());
                    panel.getTabPanel().scrollToTab(linea, true);
                }
            }

            if (menuItemId.equalsIgnoreCase("fun6005")) {
                ListaCambioMercaderia pedido1 = new ListaCambioMercaderia(KMenu.this);
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {

                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(pedido1);
                    panel.getTabPanel().activate(pedido1.getId());
                    panel.getTabPanel().scrollToTab(pedido1, true);
                }
            }
        } else {

//if (menuItemId.equalsIgnoreCase("fun5020")) {
//                PanelPedidoMuestra p = (PanelPedidoMuestra) object;
//                panel.getTabPanel().add(p);
//                panel.getTabPanel().activate(p.getId());
//                panel.getTabPanel().scrollToTab(p, true);
//s
//
//            }

            if (menuItemId.equalsIgnoreCase("fun5015")) {
                PanelCobro p = (PanelCobro) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);
            }
            if (menuItemId.equalsIgnoreCase("fun11041")) {
                PanelEstadistico1 p = (PanelEstadistico1) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);
            }

            if (menuItemId.equalsIgnoreCase("fun50156")) {
                PanelCobroCuenta p = (PanelCobroCuenta) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);
            }


            if (menuItemId.equalsIgnoreCase("fun5016")) {
                PanelPedidoE p = (PanelPedidoE) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);
            }
            if (menuItemId.equalsIgnoreCase("fun50161")) {
                PanelPedidoEE p = (PanelPedidoEE) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);


            }
            if (menuItemId.equalsIgnoreCase("fun60021")) {
                PanelVenta p = (PanelVenta) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);


            }
            if (menuItemId.equalsIgnoreCase("fun6001")) {
                PanelVentaDetalle p = (PanelVentaDetalle) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);


            }
            if (menuItemId.equalsIgnoreCase("fun6007")) {
                PanelVentaCaja p = (PanelVentaCaja) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);


            }
            if (menuItemId.equalsIgnoreCase("fun60071")) {
                PanelTraspasoCaja p = (PanelTraspasoCaja) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);


            }
            if (menuItemId.equalsIgnoreCase("fun6010")) {
                PanelTraspasoDetalle p = (PanelTraspasoDetalle) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);


            }
            if (menuItemId.equalsIgnoreCase("fun50151")) {
                PanelPedidoEEU p = (PanelPedidoEEU) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);
            }
            if (menuItemId.equalsIgnoreCase("fun50152")) {
                PanelRebaja p = (PanelRebaja) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);
            }
            if (menuItemId.equalsIgnoreCase("fun50153")) {
                PanelCreditoRegistro p = (PanelCreditoRegistro) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);
            }
            if (menuItemId.equalsIgnoreCase("fun5025")) {
                PanelPedidoConfirmado1 p = (PanelPedidoConfirmado1) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);


            }
            if (menuItemId.equalsIgnoreCase("fun5026")) {
                IngresoTiendaDetalle p = (IngresoTiendaDetalle) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);


            }
            if (menuItemId.equalsIgnoreCase("fun5028")) {
                IngresoTiendaCodigo p = (IngresoTiendaCodigo) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);


            }
            if (menuItemId.equalsIgnoreCase("fun5029")) {
                PanelInventario p = (PanelInventario) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);

            }
            if (menuItemId.equalsIgnoreCase("fun16089")) {
                PanelPedidoConfirmado1 p = (PanelPedidoConfirmado1) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);

            }
            if (menuItemId.equalsIgnoreCase("fun50291")) {
                PanelInventarioM p = (PanelInventarioM) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);


            }
//  if (menuItemId.equalsIgnoreCase("fun10431")) {
//                PanelCrearCaja p = (PanelCrearCaja) object;
//                panel.getTabPanel().add(p);
//                panel.getTabPanel().activate(p.getId());
//                panel.getTabPanel().scrollToTab(p, true);
//
//
//            }
//           if (menuItemId.equalsIgnoreCase("fun10432")) {
//                PanelConfirmarTraspaso p = (PanelConfirmarTraspaso) object;
//                panel.getTabPanel().add(p);
//                panel.getTabPanel().activate(p.getId());
//                panel.getTabPanel().scrollToTab(p, true);
//
//
//            }

//            if (menuItemId.equalsIgnoreCase("fun10021")) {
//                Cliente p = (Cliente) object;
//                panel.getTabPanel().add(p);
//                panel.getTabPanel().activate(p.getId());
//                panel.getTabPanel().scrollToTab(p, true);
//
//
//            }
//
//            if (menuItemId.equalsIgnoreCase("fun10411")) {
//                ListaRecibidos p = (ListaRecibidos) object;
//                panel.getTabPanel().add(p);
//                panel.getTabPanel().activate(p.getId());
//                panel.getTabPanel().scrollToTab(p, true);
//
//
//            }
            if (menuItemId.equalsIgnoreCase("fun1505")) {
                ConfiguracionColor p = (ConfiguracionColor) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);


            }
//            if (menuItemId.equalsIgnoreCase("fun1511")) {
//                ConfiguracionColorDetalle pa = (ConfiguracionColorDetalle) object;
//                panel.getTabPanel().add(pa);
//                panel.getTabPanel().activate(pa.getId());
//                panel.getTabPanel().scrollToTab(pa, true);
//            }
            if (menuItemId.equalsIgnoreCase("fun1511")) {
                ConfiguracionColorDetalle proveedor = new ConfiguracionColorDetalle();
                // proveedor.show();
                if (panel.getTabPanel() == null) {
                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
                } else {
                    Utils.setErrorPrincipal("Se cargo el manejador", "mensaje");
                    panel.getTabPanel().add(proveedor);
                    panel.getTabPanel().activate(proveedor.getId());
                    panel.getTabPanel().scrollToTab(proveedor, true);
                }
            }
            if (menuItemId.equalsIgnoreCase("fun1506")) {
                Material p = (Material) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);


            }
            if (menuItemId.equalsIgnoreCase("fun110200")) {
                EditarMarcaEmpleado p = (EditarMarcaEmpleado) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);


            }
//             if (menuItemId.equalsIgnoreCase("fun16041")) {
//                TiposGastos p = (TiposGastos) object;
//                panel.getTabPanel().add(p);
//                panel.getTabPanel().activate(p.getId());
//                panel.getTabPanel().scrollToTab(p, true);
//
//
//            }
//            if (menuItemId.equalsIgnoreCase("fun16041")) {
//                TiposGastos linea = new TiposGastos();
//                if (panel.getTabPanel() == null) {
//                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
//                } else {
//                    Utils.setErrorPrincipal("Se cargo la lista", "mensaje");
//                    panel.getTabPanel().add(linea);
//                    panel.getTabPanel().activate(linea.getId());
//                    panel.getTabPanel().scrollToTab(linea, true);
//                }
//            }
            if (menuItemId.equalsIgnoreCase("fun10191")) {
                Control p = (Control) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);


            }

//            if (menuItemId.equalsIgnoreCase("fun16042")) {
//                TiposGastosDetalle linea = new TiposGastosDetalle();
//                if (panel.getTabPanel() == null) {
//                    Utils.setErrorPrincipal("No existe el manejador de pestanas", "error");
//                } else {
//                    Utils.setErrorPrincipal("Se cargo la lista", "mensaje");
//                    panel.getTabPanel().add(linea);
//                    panel.getTabPanel().activate(linea.getId());
//                    panel.getTabPanel().scrollToTab(linea, true);
//                }
//            }

            if (menuItemId.equalsIgnoreCase("fun1500")) {
                Coleccion p = (Coleccion) object;
                panel.getTabPanel().add(p);
                panel.getTabPanel().activate(p.getId());
                panel.getTabPanel().scrollToTab(p, true);
            }


            if (menuItemId.equalsIgnoreCase("fun5099")) {
                IngresoAlmacen in = (IngresoAlmacen) object;
                panel.getTabPanel().add(in);
                panel.getTabPanel().activate(in.getId());
                panel.getTabPanel().scrollToTab(in, true);
                ped.close();
                ped.setModal(false);


            }


            if (menuItemId.equalsIgnoreCase("fun1001")) {
                Marca in = (Marca) object;
                panel.getTabPanel().add(in);
                panel.getTabPanel().activate(in.getId());
                panel.getTabPanel().scrollToTab(in, true);
//                conf.
//                conf.setModal(false);


            }


        }
    }

    public void setPropiedades(String idTabbed, Panel tab, TabPanel tap_aux) {
        tap_aux.setActiveTab(idTabbed);
        tab.setAutoScroll(true);
        tab.setIconCls("tab-icon");
        tab.setClosable(true);
        tap_aux.add(tab);
    }

    public void seleccionarOpcionRemove(Menu menu, String menuItemId, EventObject e, Object object) {

        if (object == null) {
        } else {
            if (menuItemId.equalsIgnoreCase("fun5025")) {
                PanelPedidoConfirmado1 ordenproduccion = (PanelPedidoConfirmado1) object;
                panel.getTabPanel().remove(ordenproduccion);
            }
            if (menuItemId.equalsIgnoreCase("fun5029")) {
                PanelInventario ordenproduccion = (PanelInventario) object;
                panel.getTabPanel().remove(ordenproduccion);
            }
            if (menuItemId.equalsIgnoreCase("fun16089")) {
                PanelPedidoConfirmado1 ordenproduccion = (PanelPedidoConfirmado1) object;
                panel.getTabPanel().remove(ordenproduccion);
            }
            if (menuItemId.equalsIgnoreCase("fun50291")) {
                PanelInventarioM ordenproduccion = (PanelInventarioM) object;
                panel.getTabPanel().remove(ordenproduccion);
            }
////             if (menuItemId.equalsIgnoreCase("fun10431")) {
////                PanelCrearCaja ordenproduccion = (PanelCrearCaja) object;
////                panel.getTabPanel().remove(ordenproduccion);
////           }
//              if (menuItemId.equalsIgnoreCase("fun10432")) {
//                PanelConfirmarTraspaso ordenproduccion = (PanelConfirmarTraspaso) object;
//                panel.getTabPanel().remove(ordenproduccion);
//           }
            if (menuItemId.equalsIgnoreCase("fun5016")) {
                PanelPedidoE ordenproduccion = (PanelPedidoE) object;
                panel.getTabPanel().remove(ordenproduccion);
            }

            if (menuItemId.equalsIgnoreCase("fun50161")) {
                PanelPedidoEE ordenproduccion = (PanelPedidoEE) object;
                panel.getTabPanel().remove(ordenproduccion);
            }
            if (menuItemId.equalsIgnoreCase("fun60021")) {
                PanelVenta ordenproduccion = (PanelVenta) object;
                panel.getTabPanel().remove(ordenproduccion);
            }
            if (menuItemId.equalsIgnoreCase("fun6001")) {
                PanelVentaDetalle ordenproduccion = (PanelVentaDetalle) object;
                panel.getTabPanel().remove(ordenproduccion);
            }
            if (menuItemId.equalsIgnoreCase("fun6007")) {
                PanelVentaCaja ordenproduccion = (PanelVentaCaja) object;
                panel.getTabPanel().remove(ordenproduccion);
            }
            if (menuItemId.equalsIgnoreCase("fun60071")) {
                PanelTraspasoCaja ordenproduccion = (PanelTraspasoCaja) object;
                panel.getTabPanel().remove(ordenproduccion);

            }
            if (menuItemId.equalsIgnoreCase("fun6003")) {
                Devolucion ordenproduccion = (Devolucion) object;
                panel.getTabPanel().remove(ordenproduccion);
            }
            if (menuItemId.equalsIgnoreCase("fun6010")) {
                PanelTraspasoDetalle ordenproduccion = (PanelTraspasoDetalle) object;
                panel.getTabPanel().remove(ordenproduccion);
            }
            if (menuItemId.equalsIgnoreCase("fun50151")) {
                PanelPedidoEEU ordenproduccion = (PanelPedidoEEU) object;
                panel.getTabPanel().remove(ordenproduccion);
            }
            if (menuItemId.equalsIgnoreCase("fun50152")) {
                PanelRebaja ordenproduccion = (PanelRebaja) object;
                panel.getTabPanel().remove(ordenproduccion);
            }
            if (menuItemId.equalsIgnoreCase("fun50153")) {
                PanelCreditoRegistro ordenproduccion = (PanelCreditoRegistro) object;
                panel.getTabPanel().remove(ordenproduccion);
            }
            if (menuItemId.equalsIgnoreCase("fun50156")) {
                PanelCobroCuenta ordenproduccion = (PanelCobroCuenta) object;
                panel.getTabPanel().remove(ordenproduccion);
            }
            if (menuItemId.equalsIgnoreCase("fun50160")) {
                DevolucionCobro ordenproduccion = (DevolucionCobro) object;
                panel.getTabPanel().remove(ordenproduccion);
            }

        }

    }
}

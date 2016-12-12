/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.emergentes;

import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.Label;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.TabPanel;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;
import org.balderrama.client.MainEntryPoint;
import org.balderrama.client.util.KMenu;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import org.balderrama.client.sistemadetalle.PanelPedidoE;
import org.balderrama.client.sistemadetalle.PanelPedidoEE;

/**
 *
 * @author 
 */
public class SeleccionMarcaTienda extends Window {

    private final int ANCHO = 300;
    private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private ComboBox com_tienda;
    private ComboBox com_marca;
    private Label label = new Label("2");
    private Panel formpanel1;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String almacenC;
    private String tipoC;
    private Object[][] tiendaM;
    private Object[][] marcaM;
    //private String[] clienteM;
    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;
    //para crear un nuevo tab
    public TabPanel tap_panel;
    public KMenu padre;
    public MainEntryPoint panel;
   // private ComboBox com_cliente;
   boolean respuesta = false;

String tipomarca;

    public SeleccionMarcaTienda(Object[][] marca, KMenu kmenu) {
          padre=kmenu;
        marcaM = marca;
        String tituloTabla = "Registrar Ingreso";
        this.setClosable(true);
        this.setId("TPfun5013");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle(tituloTabla);
        setAutoWidth(true);
        setAutoHeight(true);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        onModuleLoad();
    }

    public void onModuleLoad(){
      String nombreBoton1 = "Entrar";
        String nombreBoton2 = "Cancelar";
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
       //                       GuardarEditarCliente(e);
        String idmarcap = com_marca.getValue();
 Buscaropcion(e,idmarcap);

            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionMarcaTienda.this.destroy();
                SeleccionMarcaTienda.this.close();

              }
        });
        com_marca = new ComboBox("Marca", "marca",200);
        formPanel.add(com_marca);
        addButton(but_aceptarP);
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
        addListeners();
    }
   private void addListeners() {
           com_marca.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                //  GuardarEditarCliente(e);
                     String idmarcap = com_marca.getValue();
                      Buscaropcion(e,idmarcap);
                }
            }

        });


    }

    private void initCombos() {

      
        com_marca.setValueField("idmarca");
        com_marca.setDisplayField("nombre");
        com_marca.setMinChars(1);
        com_marca.setFieldLabel("nombre");
        com_marca.setMode(ComboBox.LOCAL);
        com_marca.setEmptyText("Seleccione una marca");
        com_marca.setLoadingText("Buscando");
        com_marca.setTypeAhead(true);
        com_marca.setSelectOnFocus(true);
        com_marca.setHideTrigger(true);  
        
        SimpleStore cotegoriaStore = new SimpleStore(new String[]{"idmarca", "nombre"}, marcaM);
        cotegoriaStore.load();
        com_marca.setStore(cotegoriaStore);



    }
 public void Buscaropcion(final EventObject e,String idmarca) {
               respuesta = false;
        //         private EventObject e;
            String enlace = "php/VentaMayor.php?funcion=buscardatosmarcaventa&marca=" + idmarca;

            final Conector conec = new Conector(enlace, false);
                try {
                    conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
                        private String idempresa;
                        private String planilla;
                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {
                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
                                    JSONValue clienteValue = jsonObject.get("resultado");
                                    JSONObject clienteObject;
                                    if ((clienteObject = clienteValue.isObject()) != null) {

                                        idempresa = Utils.getStringOfJSONObject(clienteObject, "formatomayor");
                                        planilla = Utils.getStringOfJSONObject(clienteObject, "tipob");
                              tipomarca = Utils.getStringOfJSONObject(clienteObject, "idgrupo");
              if(tipomarca=="2"){
                GuardarEditarClienteNike(e);//estilo material color modelo
              }else{
                GuardarEditarCliente(e);//estilo material color modelo
              }

                                        respuesta = true;
                                    } else {
                                    //    resetCamposCliente();

                                        Utils.setErrorPrincipal("No se recuperaron correctamente lo valores", "error");
                                    }

                                } else {
                                  //  resetCamposCliente();

                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                          //  resetCamposCliente();

                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");

                        }
                    });

                } catch (RequestException ex) {
                    ex.getMessage();
             //       resetCamposCliente();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }

              //  return respuesta;


    }
    public void Buscaropcion2(EventObject e) {


        String idmarca = "NINGUNO";
         String idmarcap = com_marca.getValue();
         if(idmarcap == "mar-3") {
                GuardarEditarClienteNike(e);//estilo material color modelo
             }else{
              GuardarEditarCliente(e);//estilo material color modelo
             }
   
    }


    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }



    public void GuardarEditarCliente(EventObject e) {

       
        String idmarca = com_marca.getValue();

      //  String enlace = "php/Marca.php?funcion=BuscarClienteVendedorColorMaterialModeloLineaPorMarca&idmarca=" + idmarca;
        String enlace = "php/Marca.php?funcion=BuscarClienteEstiloColorMaterialModeloLineaPorMarca&idmarca=" + idmarca;

        Utils.setErrorPrincipal("Cargando parametros de Nueva Marca", "cargar");
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
                                    Object[][] clientes = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
                                    Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "colorM", new String[]{"idcolor", "codigo"});
                                    Object[][] materiales = Utils.getArrayOfJSONObject(marcaO, "materialM", new String[]{"idmateria", "codigo"});
                                    Object[][] vendedorM = Utils.getArrayOfJSONObject(marcaO, "empleadoM", new String[]{"idempleado", "codigo"});

                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");
                                    String numeropedido = Utils.getStringOfJSONObject(marcaO, "numeropedido");
                                    String opcion = Utils.getStringOfJSONObject(marcaO, "opcion");
                                    String opcionb = Utils.getStringOfJSONObject(marcaO, "opcionb");
                                    String encargado = Utils.getStringOfJSONObject(marcaO, "encargado");

                                    PanelPedidoE pan_compraDirecta = new PanelPedidoE(idmarca, nombre, numeropedido,encargado, opcion, vendedorM,clientes, colores, materiales, opcionb, SeleccionMarcaTienda.this,padre);
                                    padre.seleccionarOpcion(null, "fun5016", e, pan_compraDirecta);
                                    SeleccionMarcaTienda.this.clear();
                                    SeleccionMarcaTienda.this.close();
//
                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + opcion, "mensaje");
                                } else {
                                    MessageBox.alert("No Hay datos en la consulta");
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
                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
            }

        }

    }
    public void GuardarEditarClienteNike(EventObject e) {


        String idmarca = com_marca.getValue();

      //  String enlace = "php/Marca.php?funcion=BuscarClienteVendedorColorMaterialModeloLineaPorMarca&idmarca=" + idmarca;
        String enlace = "php/Marca.php?funcion=BuscarClienteEstiloColorMaterialModeloLineaPorMarca&idmarca=" + idmarca;

        Utils.setErrorPrincipal("Cargando parametros de Nueva Marca", "cargar");
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
                                    Object[][] clientes = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
                                    Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "colorM", new String[]{"idcolor", "codigo"});
                                    Object[][] materiales = Utils.getArrayOfJSONObject(marcaO, "materialM", new String[]{"idmateria", "codigo"});
                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");
                                    String numeropedido = Utils.getStringOfJSONObject(marcaO, "numeropedido");
                                    String opcion = Utils.getStringOfJSONObject(marcaO, "opcion");
                                    String opcionb = Utils.getStringOfJSONObject(marcaO, "opcionb");
                                    String encargado = Utils.getStringOfJSONObject(marcaO, "encargado");
Object[][] vendedorM = Utils.getArrayOfJSONObject(marcaO, "empleadoM", new String[]{"idempleado", "codigo"});

                                    PanelPedidoEE pan_compraDirecta = new PanelPedidoEE(idmarca, nombre, numeropedido,encargado, opcion, clientes, colores, materiales, opcionb,vendedorM, SeleccionMarcaTienda.this,padre);
                                    padre.seleccionarOpcion(null, "fun50161", e, pan_compraDirecta);
                                    SeleccionMarcaTienda.this.clear();
                                    SeleccionMarcaTienda.this.close();
//
                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + opcion, "mensaje");
                                } else {
                                    MessageBox.alert("No Hay datos en la consulta");
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
                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
            }

        }

    }

//      public void GuardarEditarClienteTalla(EventObject e) {
//
//
//        String idmarca = com_marca.getValue();
//final String opciontalla = com_cliente.getValue();
//
//      //  String enlace = "php/Marca.php?funcion=BuscarClienteVendedorColorMaterialModeloLineaPorMarca&idmarca=" + idmarca;
//        String enlace = "php/Marca.php?funcion=BuscarEstiloMaterialPorMarca&idmarca=" + idmarca;
//
//        Utils.setErrorPrincipal("Cargando parametros de Nueva Marca", "cargar");
//        final Conector conec = new Conector(enlace, false);
//        {
//            try {
//                conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
//
//                    private EventObject e;
//
//                    public void onResponseReceived(Request request, Response response) {
//                        String data = response.getText();
//                        JSONValue jsonValue = JSONParser.parse(data);
//                        JSONObject jsonObject;
//                        if ((jsonObject = jsonValue.isObject()) != null) {
//                            String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
//                            String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
//                            if (errorR.equalsIgnoreCase("true")) {
//                                Utils.setErrorPrincipal(mensajeR, "mensaje");
//
//                                JSONValue marcaV = jsonObject.get("resultado");
//                                JSONObject marcaO;
//                                if ((marcaO = marcaV.isObject()) != null) {
//                                   // Object[][] clientes = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
//                                  //vendedor. es estilos
//                                    Object[][] vendedores = Utils.getArrayOfJSONObject(marcaO, "estiloM", new String[]{"idestilo", "nombre"});
//                                 //   Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "colorM", new String[]{"idcolor", "codigo"});
//                                    Object[][] materiales = Utils.getArrayOfJSONObject(marcaO, "materialM", new String[]{"idmateria", "codigo"});
//                                    //Object[][] modelos = Utils.getArrayOfJSONObject(marcaO, "modeloM", new String[]{"idmodelo","idestilo", "codigo"});
//                              //       Object[][] lineas = Utils.getArrayOfJSONObject(marcaO, "lineaM", new String[]{"idlinea", "codigo"});
//                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
//                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");
//                                    String numeropedido = Utils.getStringOfJSONObject(marcaO, "numeropedido");
//                                    String opcion = Utils.getStringOfJSONObject(marcaO, "opcion");
//                                          String opcionb = Utils.getStringOfJSONObject(marcaO, "opcionb");
//
//
////nike
//PanelPedidoEE pan_compraDirecta = new PanelPedidoEE(idmarca, nombre, numeropedido, opcion, vendedores, materiales,opcionb, opciontalla,SeleccionMarcaTienda.this,padre);
//
//                                    padre.seleccionarOpcion(null, "fun50161", e, pan_compraDirecta);
//                                    SeleccionMarcaTienda.this.clear();
//                                    SeleccionMarcaTienda.this.close();
////
//                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + opcion, "mensaje");
//                                } else {
//                                    MessageBox.alert("No Hay datos en la consulta");
//                                      Utils.setErrorPrincipal(mensajeR, "mensaje");
//                      //  Window.alert(mensajeR);
//                         //  Window.alert(mensajeR);
//                                }
//                            }
//                               else {
//                            //Window.alert(mensajeR);
////                            com.google.gwt.user.client.Window.alert("error 1000");
//                            Utils.setErrorPrincipal(mensajeR, "error");
//                                    //  Window.alert(mensajeR);
//
//                        }
//
//                        }
//                        throw new UnsupportedOperationException("Not supported yet.");
//                    }
//
//                    public void onError(Request request, Throwable exception) {
//                        throw new UnsupportedOperationException("Not supported yet.");
//                    }
//                });
//
//            } catch (RequestException ea) {
//                ea.getMessage();
//                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
//            }
//
//        }
//     }
//
//       public void GuardarEditarClienteTallaColor(EventObject e) {
//
//
//        String idmarca = com_marca.getValue();
//final String opciontalla = com_cliente.getValue();
//
//      //  String enlace = "php/Marca.php?funcion=BuscarClienteVendedorColorMaterialModeloLineaPorMarca&idmarca=" + idmarca;
//        String enlace = "php/Marca.php?funcion=BuscarEstiloColorPorMarca&idmarca=" + idmarca;
//
//        Utils.setErrorPrincipal("Cargando parametros de Nueva Marca", "cargar");
//        final Conector conec = new Conector(enlace, false);
//        {
//            try {
//                conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
//
//                    private EventObject e;
//
//                    public void onResponseReceived(Request request, Response response) {
//                        String data = response.getText();
//                        JSONValue jsonValue = JSONParser.parse(data);
//                        JSONObject jsonObject;
//                        if ((jsonObject = jsonValue.isObject()) != null) {
//                            String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
//                            String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
//                            if (errorR.equalsIgnoreCase("true")) {
//                                Utils.setErrorPrincipal(mensajeR, "mensaje");
//
//                                JSONValue marcaV = jsonObject.get("resultado");
//                                JSONObject marcaO;
//                                if ((marcaO = marcaV.isObject()) != null) {
//                                   // Object[][] clientes = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
//                                  //vendedor. es estilos
//                                    Object[][] vendedores = Utils.getArrayOfJSONObject(marcaO, "estiloM", new String[]{"idestilo", "nombre"});
//                                   // Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "colorM", new String[]{"idcolor", "codigo"});
//                               Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "colorM", new String[]{"idcolor", "codigo"});
//                                         //Object[][] modelos = Utils.getArrayOfJSONObject(marcaO, "modeloM", new String[]{"idmodelo","idestilo", "codigo"});
//                              //       Object[][] lineas = Utils.getArrayOfJSONObject(marcaO, "lineaM", new String[]{"idlinea", "codigo"});
//                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
//                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");
//                                    String numeropedido = Utils.getStringOfJSONObject(marcaO, "numeropedido");
//                                    String opcion = Utils.getStringOfJSONObject(marcaO, "opcion");
//                                          String opcionb = Utils.getStringOfJSONObject(marcaO, "opcionb");
//
//
//
//PanelPedidoEE pan_compraDirecta = new PanelPedidoEE(idmarca, nombre, numeropedido, opcion, vendedores, colores, opcionb, opciontalla,SeleccionMarcaTienda.this,padre);
//
//                                    padre.seleccionarOpcion(null, "fun50161", e, pan_compraDirecta);
//                                    SeleccionMarcaTienda.this.clear();
//                                    SeleccionMarcaTienda.this.close();
////
//                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + opcion, "mensaje");
//                                } else {
//                                    MessageBox.alert("No Hay datos en la consulta");
//                                }
//                            }
//                        } else {
//                        }
//                        throw new UnsupportedOperationException("Not supported yet.");
//                    }
//
//                    public void onError(Request request, Throwable exception) {
//                        throw new UnsupportedOperationException("Not supported yet.");
//                    }
//                });
//
//            } catch (RequestException ea) {
//                ea.getMessage();
//                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
//            }
//
//        }
//     }
//            public void GuardarEditarClienteSimple(EventObject e) {
//
//
//        String idmarca = com_marca.getValue();
//final String opciontalla = com_cliente.getValue();
//
//      //  String enlace = "php/Marca.php?funcion=BuscarClienteVendedorColorMaterialModeloLineaPorMarca&idmarca=" + idmarca;
//        String enlace = "php/Marca.php?funcion=BuscarEstiloPorMarca&idmarca=" + idmarca;
//
//        Utils.setErrorPrincipal("Cargando parametros de Nueva Marca", "cargar");
//        final Conector conec = new Conector(enlace, false);
//        {
//            try {
//                conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
//
//                    private EventObject e;
//
//                    public void onResponseReceived(Request request, Response response) {
//                        String data = response.getText();
//                        JSONValue jsonValue = JSONParser.parse(data);
//                        JSONObject jsonObject;
//                        if ((jsonObject = jsonValue.isObject()) != null) {
//                            String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
//                            String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
//                            if (errorR.equalsIgnoreCase("true")) {
//                                Utils.setErrorPrincipal(mensajeR, "mensaje");
//
//                                JSONValue marcaV = jsonObject.get("resultado");
//                                JSONObject marcaO;
//                                if ((marcaO = marcaV.isObject()) != null) {
//                                   // Object[][] clientes = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
//                                  //vendedor. es estilos
//                                    Object[][] vendedores = Utils.getArrayOfJSONObject(marcaO, "estiloM", new String[]{"idestilo", "nombre"});
//                                   // Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "colorM", new String[]{"idcolor", "codigo"});
//                               //     Object[][] materiales = Utils.getArrayOfJSONObject(marcaO, "materialM", new String[]{"idmateria", "codigo"});
//                                    //Object[][] modelos = Utils.getArrayOfJSONObject(marcaO, "modeloM", new String[]{"idmodelo","idestilo", "codigo"});
//                              //       Object[][] lineas = Utils.getArrayOfJSONObject(marcaO, "lineaM", new String[]{"idlinea", "codigo"});
//                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
//                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");
//                                    String numeropedido = Utils.getStringOfJSONObject(marcaO, "numeropedido");
//                                    String opcion = Utils.getStringOfJSONObject(marcaO, "opcion");
//  String opcionb = Utils.getStringOfJSONObject(marcaO, "opcionb");
//
//
//
//PanelPedidoEE pan_compraDirecta = new PanelPedidoEE(idmarca, nombre, numeropedido, opcion, vendedores, opcionb, opciontalla,SeleccionMarcaTienda.this,padre);
//
//                                    padre.seleccionarOpcion(null, "fun50161", e, pan_compraDirecta);
//                                    SeleccionMarcaTienda.this.clear();
//                                    SeleccionMarcaTienda.this.close();
////
//                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + opcion, "mensaje");
//                                } else {
//                                    MessageBox.alert("No Hay datos en la consulta");
//                                }
//                            }
//                        } else {
//                        }
//                        throw new UnsupportedOperationException("Not supported yet.");
//                    }
//
//                    public void onError(Request request, Throwable exception) {
//                        throw new UnsupportedOperationException("Not supported yet.");
//                    }
//                });
//
//            } catch (RequestException ea) {
//                ea.getMessage();
//                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
//            }
//
//        }

//    }
}
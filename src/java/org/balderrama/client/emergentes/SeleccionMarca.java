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

/**
 *
 * @author buggy
 */
public class SeleccionMarca extends Window {

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
    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;
    //para crear un nuevo tab
    public TabPanel tap_panel;
    public KMenu padre;
    public MainEntryPoint panel;
  private ComboBox com_cliente;
   private String[] clienteM;

    public SeleccionMarca(Object[][] marca, KMenu kmenu) {
    //public IngresoAlmacenForm(KMenu kmenu,MainEntryPoint pan) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");

        // this.padre = padre
        padre=kmenu;
      //  panel=pan;
       this.clienteM = new String[]{"M","W","GS/PS","NINO/NINA"};

        marcaM = marca;
        //kmenu = menu;
        String tituloTabla = "Realizar PEDIDOS";
        this.setClosable(true);
        this.setId("TPfun500511");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle(tituloTabla);
        setAutoWidth(true);
        setAutoHeight(true);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);

        setCloseAction(Window.CLOSE);
        //setPlain(true);
        onModuleLoad();

    }

    public void onModuleLoad(){

        //setId("win-Clientes");

        String nombreBoton1 = "Entrar";
        String nombreBoton2 = "Cancelar";

        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        //formPanel.setLabelWidth(ANCHO - 400);
      
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                             // GuardarEditarCliente(e);
                Buscaropcion(e);

            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionMarca.this.destroy();
                SeleccionMarca.this.close();

              }
        });
//        formpanel1 = new Panel();
//        formpanel1.setWidth(50);
//        formpanel1.setHeight(50);
//        label.setHeight(50);
//        label.setWidth(50);
        //formpanel1.add(label);

   
        com_marca = new ComboBox("Marca", "marca",200);
        com_cliente = new ComboBox("Opcion Talla", "opcion", 200);
        com_cliente.setValue("NINGUNO");
        com_cliente.setReadOnly(true);

        // formPanel.setLabelWidth(ANCHO - 400 - 5);


        //formPanel.add(formpanel1);
        formPanel.add(com_marca);
          formPanel.add(com_cliente);
   
        addButton(but_aceptarP);
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
     
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


        SimpleStore tiposStore = new SimpleStore("opcion", clienteM);
        tiposStore.load();
        com_cliente.setDisplayField("opcion");
        com_cliente.setStore(tiposStore);


    }
 public void Buscaropcion(EventObject e) {


        String idmarca = com_cliente.getValue();
         String idmarcap = com_marca.getValue();
  //                       GuardarEditarCliente(e);
        //if (idmarca == "NINGUNO") {

           GuardarEditarCliente(e);
//              }
//        if (idmarca == "M") {
//             GuardarEditarClienteTalla(e);
//           }
//         if (idmarca == "W") {
//             GuardarEditarClienteTalla(e);
//           }
//         if (idmarca == "GS/PS") {
//             GuardarEditarClienteTalla(e);
//           }
//         if (idmarca == "NINO/NINA") {
//             GuardarEditarClienteTalla(e);
//           }
 }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }



    public void GuardarEditarCliente(EventObject e) {
//
//
//        String idmarca = com_marca.getValue();
//         final String opciontalla = com_cliente.getValue();
//
//         String enlace = "php/Marca.php?funcion=BuscarClienteVendedorColorMaterialModeloLineaPorMarca&idmarca=" + idmarca;
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
//                                    Object[][] clientes = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
//                                    Object[][] vendedores = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "codigo"});
//                                    Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "colorM", new String[]{"idcolor", "codigo"});
//                                    Object[][] materiales = Utils.getArrayOfJSONObject(marcaO, "materialM", new String[]{"idmateria", "codigo"});
//                                    Object[][] modelos = Utils.getArrayOfJSONObject(marcaO, "modeloM", new String[]{"idmodelo", "codigo"});
//                                     Object[][] lineas = Utils.getArrayOfJSONObject(marcaO, "lineaM", new String[]{"idlinea", "codigo"});
//                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
//                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");
//                                    String numeropedido = Utils.getStringOfJSONObject(marcaO, "numeropedido");
//                                    String opcion = Utils.getStringOfJSONObject(marcaO, "opcion");
//
//
//
//                                    PanelPedido pan_compraDirecta = new PanelPedido(idmarca, nombre, numeropedido, opcion, clientes, vendedores, colores, materiales, modelos,lineas,opciontalla, SeleccionMarca.this);
//                                    padre.seleccionarOpcion(null, "fun5002", e, pan_compraDirecta);
//                                    SeleccionMarca.this.clear();
//                                    SeleccionMarca.this.close();
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

    }
   public void GuardarEditarClienteTalla(EventObject e) {
//
//
//        String idmarca = com_marca.getValue();
//        final String opciontalla = com_cliente.getValue();
//
//      //  String enlace = "php/Marca.php?funcion=BuscarClienteVendedorColorMaterialModeloLineaPorMarca&idmarca=" + idmarca;
//    //    String enlace = "php/Marca.php?funcion=BuscarEstiloMaterialPorMarca&idmarca=" + idmarca;
//  String enlace = "php/Marca.php?funcion=BuscarClienteVendedorColorMaterialModeloLineaPorMarca&idmarca=" + idmarca;
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
//                                     Object[][] clientes = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
//                                    Object[][] vendedores = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "codigo"});
//                                    Object[][] materiales = Utils.getArrayOfJSONObject(marcaO, "materialM", new String[]{"idmateria", "codigo"});
//                                    Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "colorM", new String[]{"idcolor", "codigo"});
//                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
//                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");
//                                    String numeropedido = Utils.getStringOfJSONObject(marcaO, "numeropedido");
//                                    String opcion = Utils.getStringOfJSONObject(marcaO, "opcion");
//                                          String opcionb = Utils.getStringOfJSONObject(marcaO, "opcionb");
//
//PanelPedido pan_compraDirecta = new PanelPedido(idmarca, nombre, numeropedido, opcion, materiales,opcionb,clientes,vendedores,colores, opciontalla,SeleccionMarca.this);
//
//                                   padre.seleccionarOpcion(null, "fun5002", e, pan_compraDirecta);
//                                    SeleccionMarca.this.clear();
//                                    SeleccionMarca.this.close();
////
//
//
////
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
     }
   
}
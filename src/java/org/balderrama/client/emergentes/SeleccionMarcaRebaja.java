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
import org.balderrama.client.sistemadetalle.PanelRebaja;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;

/**
 *
 * @author 
 */
public class SeleccionMarcaRebaja extends Window {

    private final int ANCHO = 300;
    private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private ComboBox com_tienda;
    private ComboBox com_marca;
       private ComboBox com_vendedor;
    private Label label = new Label("2");
    private Panel formpanel1;
    private Button but_aceptarP;
     private Button but_aceptarP1;
    private Button but_reporte;
    private Button but_cancelarP;
    private String almacenC;
    private String tipoC;
    private Object[][] tiendaM;
    private Object[][] marcaM;
    private Object[][] vendedorM;
    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;
    //para crear un nuevo tab
    public TabPanel tap_panel;
    public KMenu padre;
    public MainEntryPoint panel;
   // private ComboBox com_cliente;
 

    public SeleccionMarcaRebaja(Object[][] marca,Object[][] vendedor, KMenu kmenu) {
    //public IngresoAlmacenForm(KMenu kmenu,MainEntryPoint pan) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");

        // this.padre = padre
        padre=kmenu;
        marcaM = marca;
        vendedorM = vendedor;
        //kmenu = menu;
        String tituloTabla = "Cargas datos de lector";
        this.setClosable(true);
        this.setId("TPfun2305");
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

        String nombreBoton1 = "Ir a archivo a subir";
        String nombreBoton11 = "Actualizar Base de datos";
        String nombreBoton2 = "Cancelar";
String nombreBoton3 = "Ver Reporte";
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
  but_aceptarP1 = new Button(nombreBoton11, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {

                 String idmarca=com_marca.getValueAsString();
                 String vendedor = com_vendedor.getValueAsString();
         // String enlace = "funcion=verventalistavendedor&idmarca=" + idmarca + "&idvendedor="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;

// String enlTemp = "php/Lecturacodigos.php?funcion=subirarchivo&idmarca=" +idmarca + "&idvendedor="+ vendedor;
//                            com.google.gwt.user.client.Window.open(enlTemp, "_blank", "enlTemp");
//
            }
        });
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
       
                 String idmarca=com_marca.getValueAsString();
                 String vendedor = com_vendedor.getValueAsString();
         // String enlace = "funcion=verventalistavendedor&idmarca=" + idmarca + "&idvendedor="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;

 String enlTemp = "php/Lecturacodigos.php?funcion=subirarchivo&idmarca=" +idmarca + "&idvendedor="+ vendedor;
                            com.google.gwt.user.client.Window.open(enlTemp, "_blank", "enlTemp");
            }
        });
        but_reporte = new Button(nombreBoton3, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
 //String enlTemp = "funcion=reporterebajasHTML&idcambio=" + idventaG;
           String idmarca = com_marca.getValue();
        String enlace = "funcion=reporterebajasHTML&idmarca=" + idmarca ;
               verReporte(enlace);

            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionMarcaRebaja.this.destroy();
                SeleccionMarcaRebaja.this.close();

              }
        });
     com_marca = new ComboBox("Marca", "marca",200);
    com_vendedor = new ComboBox("Vendedor", "vendedor",200);
        //formPanel.add(formpanel1);
        formPanel.add(com_marca);
          formPanel.add(com_vendedor);
        addButton(but_aceptarP);
        addButton(but_aceptarP1);
      //  addButton(but_reporte);
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
     addListeners();
    }
          private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
   private void addListeners() {
           com_marca.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                //  GuardarEditarCliente(e);
com_vendedor.focus();
                }
            }

        });
         com_vendedor.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                //  GuardarEditarCliente(e);
   String idmarca=com_marca.getValueAsString();
                 String vendedor = com_vendedor.getValueAsString();
         // String enlace = "funcion=verventalistavendedor&idmarca=" + idmarca + "&idvendedor="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;

 String enlTemp = "php/Lecturacodigos.php?funcion=subirarchivo&idmarca=" +idmarca + "&idvendedor="+ vendedor;
                            com.google.gwt.user.client.Window.open(enlTemp, "_blank", "enlTemp");
                }
            }

        });


    }

    private void initCombos() {

      
        com_marca.setValueField("idmarca");
        com_marca.setDisplayField("nombre");
        com_marca.setMinChars(1);
        com_marca.setFieldLabel("Marca");
        com_marca.setMode(ComboBox.LOCAL);
        com_marca.setEmptyText("Seleccione una marca");
        com_marca.setLoadingText("Buscando");
        com_marca.setTypeAhead(true);
        com_marca.setSelectOnFocus(true);
        com_marca.setHideTrigger(true);  
        
        SimpleStore cotegoriaStore = new SimpleStore(new String[]{"idmarca", "nombre"}, marcaM);
        cotegoriaStore.load();
        com_marca.setStore(cotegoriaStore);

com_vendedor.setValueField("idempleado");
        com_vendedor.setDisplayField("nombre");
        com_vendedor.setMinChars(1);
        com_vendedor.setFieldLabel("Vendedor");
        com_vendedor.setMode(ComboBox.LOCAL);
        com_vendedor.setEmptyText("Seleccione un vendedor");
        com_vendedor.setLoadingText("Buscando");
        com_vendedor.setTypeAhead(true);
        com_vendedor.setSelectOnFocus(true);
        com_vendedor.setHideTrigger(true);

        SimpleStore cotegoriaStore1 = new SimpleStore(new String[]{"idempleado", "nombre"}, vendedorM);
        cotegoriaStore1.load();
        com_vendedor.setStore(cotegoriaStore1);

    }

    
    public Button getBut_aceptar() {
        return but_aceptarP;
    }
    public Button getBut_aceptar1() {
        return but_aceptarP1;
    }
 public Button getBut_reporte() {
        return but_reporte;
    }
    public Button getBut_cancelar() {
        return but_cancelarP;
    }



    public void GuardarEditarCliente(EventObject e) {

       
       String idmarca = com_marca.getValue();

      //  String enlace = "php/Marca.php?funcion=BuscarClienteVendedorColorMaterialModeloLineaPorMarca&idmarca=" + idmarca;
        String enlace = "php/Marca.php?funcion=BuscarMarcaModelosKardex2&idmarca=" + idmarca;
// String enlace = "php/Marca.php?funcion=BuscarMarcaModelosKardex&idmarca=" + idmarca;

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
                                   Object[][] modelos = Utils.getArrayOfJSONObject(marcaO, "modeloM", new String[]{"idmodelo", "nombre"});
                                  // Object[][] vendedores = Utils.getArrayOfJSONObject(marcaO, "estiloM", new String[]{"idestilo", "nombre"});

                                    //       Object[][] lineas = Utils.getArrayOfJSONObject(marcaO, "lineaM", new String[]{"idlinea", "codigo"});
                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");
                                    String opcion = Utils.getStringOfJSONObject(marcaO, "opcion");
                                  String opcionb = Utils.getStringOfJSONObject(marcaO, "opcionb");


PanelRebaja pan_compraDirecta = new PanelRebaja(idmarca, nombre, opcion, opcionb,modelos,SeleccionMarcaRebaja.this,padre);
                                    padre.seleccionarOpcion(null, "fun50152", e, pan_compraDirecta);
//PanelPedidoEEU pan_compraDirecta = new PanelPedidoEEU(idmarca, nombre, opcion, opcionb,opciontalla,modelos,vendedores,SeleccionMarcaUnion.this,padre);
  //                                  padre.seleccionarOpcion(null, "fun50151", e, pan_compraDirecta);

                                    SeleccionMarcaRebaja.this.clear();
                                    SeleccionMarcaRebaja.this.close();
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

}
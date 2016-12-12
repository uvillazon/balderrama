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
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.Record;
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
import org.balderrama.client.MainEntryPoint;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.layout.VerticalLayout;
//import org.balderrama.client.pedido.Pedido;
import org.balderrama.client.beans.Planilla;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.ReporteMediaCartaChorroWindowp;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.Utils;

/**
 *
 * @author 
 */

 public class SeleccionMarcaEstiloInventarioControl extends Window {

  //  private final int ANCHO = 300;
    //private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private ComboBox com_tienda;
        private ComboBox com_kardex;
      //   private ComboBox com_almacen;
    private Label label = new Label("2");
    private Panel formpanel1;
       private Button but_actualizar;

    private Button but_cancelarP;
    private String almacenC;
    private String tipoC;
    private Object[][] almacenM;
   // private Object[][] marcaM;
    private Object[][] kardexM;
    boolean respuesta = false;
   // Object[][] estiloM;
    public Object[][] estiloM1;
    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;
    //para crear un nuevo tab
    public TabPanel tap_panel;
    public KMenu padre;
    public MainEntryPoint panel;
     private TextField tex_fechaini;
        Planilla clienteSeleccionado;
         String idplanilla;
    // private TextField tex_fechafin;
  public SeleccionMarcaEstiloInventarioControl(Object[][] kardex, KMenu kmenu) {
        padre=kmenu;
        kardexM = kardex;
   //     almacenM =almace;
        String tituloTabla = "Cierre de Mes";
        this.setClosable(true);
        this.setId("TPfun2301");
        setIconCls("tab-icon");
        setAutoScroll(true);
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

        String nombreBoton13 = "Procesar cambio de periodo";
        String nombreBoton2 = "Cancelar";
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        //formPanel.setLabelWidth(ANCHO - 400);
       Panel pan_botones = new Panel();
        pan_botones.setLayout(new VerticalLayout(10));
        pan_botones.setBaseCls("x-plain");


          but_actualizar = new Button(nombreBoton13, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {

 validarregularizacion(e);
            }
        });

        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionMarcaEstiloInventarioControl.this.destroy();
                SeleccionMarcaEstiloInventarioControl.this.close();

              }
        });
        com_kardex = new ComboBox("Mes Periodo", "kardex");
    //    com_almacen = new ComboBox("Almacen", "almacen");

         tex_fechaini = new TextField("Fecha ini", "totalpares");
    //    tex_fechafin = new TextField("Fecha fin", "totalbs");
 //formPanel.add(com_almacen);
        formPanel.add(com_kardex);
  formPanel.add(tex_fechaini);
  //formPanel.add(tex_fechafin);

        addButton(but_actualizar);

        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
     addListeners();
    }

   public void validarregularizacion(EventObject e) {
             final String fecha1 = tex_fechaini.getText();
             final String idkardex = com_kardex.getValue();

            JSONObject usuarioSoU = new JSONObject();
                    usuarioSoU.put("mesrango", new JSONString(fecha1));
                    usuarioSoU.put("idalmacen", new JSONString(idkardex));
                    String datos = "resultado=" + usuarioSoU.toString();
   String enlace = "php/IngresoAlmacen.php?funcion=Cambiogestioninventario&" +datos;
                    Utils.setErrorPrincipal("Procesando", "cargar");
                    final Conector conec = new Conector(enlace, false, "POST");
                    try {
                        conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {
                            public void onResponseReceived(Request request, Response response) {
                                String data = response.getText();
                                JSONValue jsonValue = JSONParser.parse(data);
                                JSONObject jsonObject;
                                if ((jsonObject = jsonValue.isObject()) != null) {
                                    String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                    String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                    if (errorR.equalsIgnoreCase("true")) {
                                        Utils.setErrorPrincipal(mensajeR, "mensaje");

                                        MessageBox.alert("Se proceso correctamente");
    //        destroy();
                                    } else {
                                          Utils.setErrorPrincipal(mensajeR, "mensaje");
                                  MessageBox.alert("Mes ya cerrado");
                                    }
                                }
                            }
                            public void onError(Request request, Throwable exception) {
                                Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                            }
                        });
                    } catch (RequestException ex) {
                        Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                    }
    }


   private void onChangeempresa() {
        if (com_kardex.getValue().equalsIgnoreCase("")) {
                   MessageBox.alert("Seleccione una empresa");

        } else {
          String codigoCliente = com_kardex.getValueAsString().trim();
                    findByCodigoCliente(codigoCliente);
                  tex_fechaini.focus();

        }
 }
     private boolean findByCodigoCliente(final String codigoBuscado) {
                respuesta = false;
                String enlace = "php/IngresoAlmacen.php?funcion=buscarplanillaempresa&empresa=" + codigoBuscado;

            //      String enlace = "php/Planilla.php?funcion=buscarplanillaempresa&empresa=" + codigoBuscado;
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

                                        idempresa = Utils.getStringOfJSONObject(clienteObject, "idalmacen");
                                        planilla = Utils.getStringOfJSONObject(clienteObject, "mesrango");
idplanilla = Utils.getStringOfJSONObject(clienteObject, "idkardex");
                                        clienteSeleccionado = new Planilla(idempresa, planilla);
                                      //  tex_idCliente.setValue(clienteSeleccionado.getNit());
                                        tex_fechaini.setValue(clienteSeleccionado.getPlanilla());
                                     //    tex_saldo.setValue(clienteSeleccionado.getSaldo());
                                        tex_fechaini.focus();
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

                return respuesta;
            }
   private void addListeners() {
        com_kardex.addListener(new ComboBoxListenerAdapter() {

            @Override
            public void onSelect(ComboBox comboBox, Record record, int index) {
                onChangeempresa();
            }
        });


//        com_kardex.addListener(new TextFieldListenerAdapter() {
//            @Override
//            public void onSpecialKey(Field field, EventObject e) {
//                if (e.getKey() == EventObject.ENTER) {
//                   String codigoCliente = field.getValueAsString().trim();
//                   String idproductosproc = com_kardex.getValueAsString().trim();
//                    if (!idproductosproc.isEmpty()) {
//                        cargarProducto(idproductosproc);
//                    }
//                }else{
//                  MessageBox.alert("Despues de seleccionar la marca haga enter, para cargar su lista de estilos correspondiente.");
//                }
//            }
//        });
//

    }
  private void cargarProducto(String id) {

        String idProducto = "";
        String detalle = "";
        String unidad = "";
        String fecha = "";
        if (id != null) {
//              Object[][] kardexM = Utils.getArrayOfJSONObject(marcaO, "kardexM", new String[]{"idalmacen", "idkardex","mesrango"});

                 SimpleStore producto = new SimpleStore(new String[]{"idalmacen", "nombre","idkardex","mesrango"}, kardexM);
                    producto.load();
                    producto.filter("idalmacen", id);
                    Record r = producto.getRecords()[0];
                    idProducto = r.getAsString("idkardex");
                    detalle = r.getAsString("mesrango");
                    unidad = r.getAsString("fechafin");
//                    fecha = r.getAsString("fecha");
                    tex_fechaini.setValue(detalle);
         //           tex_fechafin.setValue(unidad);


            //                        respuesta = true;

        }
    }

    private void initCombos() {
 com_kardex.setValueField("idalmacen");
        com_kardex.setDisplayField("nombre");
        com_kardex.setMinChars(1);
        com_kardex.setFieldLabel("nombre");
        com_kardex.setMode(ComboBox.LOCAL);
        com_kardex.setEmptyText("Seleccione Almacen");
        com_kardex.setLoadingText("Buscando");
        com_kardex.setTypeAhead(true);
        com_kardex.setSelectOnFocus(true);
        com_kardex.setHideTrigger(true);

        SimpleStore cotegoriaStore1 = new SimpleStore(new String[]{"idalmacen", "nombre"}, kardexM);
        cotegoriaStore1.load();
        com_kardex.setStore(cotegoriaStore1);
    }


    public Button getBut_actualizar() {
        return but_actualizar;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

     private void verReportePeque(String enlace) {
        ReporteMediaCartaChorroWindowp print = new ReporteMediaCartaChorroWindowp(enlace);
        print.show();
    }

           private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }

}
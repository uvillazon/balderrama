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
import org.balderrama.client.sistemadetalle.PanelInventario;
import org.balderrama.client.sistemadetalle.PanelInventarioM;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.ReporteMediaCartaChorroWindowp;
import org.balderrama.client.util.ReporteMediaCartaChorroWindowg;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.Utils;

/**
 *
 * @author 
 */
public class SeleccionMarcaEstiloInventario extends Window {

    private final int ANCHO = 300;
    private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private ComboBox com_tienda;
    private ComboBox com_marca;
        private ComboBox com_kardex;
    private Label label = new Label("2");
    private Panel formpanel1;
//    private Button but_aceptarP;
    private Button but_inventarioventas;
    private Button but_inventarioventas1;
  //   private Button but_inventarioventas2;
    private Button but_aceptarPp;
  //  private Button but_editar;
     private Button but_editar1;
    private Button but_cancelarP;
    private String almacenC;
    private String tipoC;
    private Object[][] tiendaM;
    private Object[][] marcaM;
    private Object[][] kardexM;
    boolean respuesta = false;
    Object[][] estiloM;
    public Object[][] estiloM1;
    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;
    //para crear un nuevo tab
    public TabPanel tap_panel;
    public KMenu padre;
       public KMenu kmenu;
    public MainEntryPoint panel;
  //  Pedido ped;
   // private ComboBox com_estilo;
     private TextField tex_fechaini;
     private TextField tex_fechafin;
     String mesperiodo;
     String fechainicio;
     String fechafin;
       subseleccion subselec;
//desde ccabecera

  public SeleccionMarcaEstiloInventario(String mesper,String fechaini,String fechaf,Object[][] kardex,Object[][] marca,Object[][] estilo, KMenu kmenu) {
        padre=kmenu;
      //  panel=pan;
kardexM = kardex;
        marcaM = marca;
        estiloM =estilo;
        fechainicio= fechaini;
        fechafin=fechaf;
        mesperiodo=mesper;
        //kmenu = menu;
        String tituloTabla = "Control Inventario";
        this.setClosable(true);
        this.setId("TPfun2303");
        setIconCls("tab-icon");
        setAutoScroll(true);
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
       String nombreBoton3 = "Ver/Editar Inventario";
        String nombreBoton2 = "Cancelar";
//   String nombreBoton4 = "Capital de Operacion Nacional";
     String nombreBoton41 = "RECAPITULACION";
String nombreBoton5 = "Resumen Capital  X Marca";
String nombreBoton51 = "Formato Impresion Marca";
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        //formPanel.setLabelWidth(ANCHO - 400);
 Panel pan_botones = new Panel();
        pan_botones.setLayout(new VerticalLayout(10));
        pan_botones.setBaseCls("x-plain");


//ver editar inventario
         but_aceptarPp = new Button(nombreBoton3, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                 String idmarca = com_marca.getValue();
   //     String idestilo = com_estilo.getValue();
        String idestilo = "alm-1";
         String idkardex = com_kardex.getValue();

               cargarDatosPanelPedido(idmarca,idestilo,idkardex);
                SeleccionMarcaEstiloInventario.this.destroy();
                       SeleccionMarcaEstiloInventario.this.close();
            }
        
        });
//capital general solo por marcas
  
//recapitulacion general
         but_editar1 = new Button("RECAPITULACION", new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                 String idmarca = com_marca.getValue();
       // String idestilo = com_estilo.getValue();
         String idestilo = "alm-1";
                 String idkardex = com_kardex.getValue();

                          String fechainicio = tex_fechaini.getValueAsString();
                           String fechafin = tex_fechafin.getValueAsString();
      String enlace = "funcion=VerRecapitulacionMarca&idmarca=" + idmarca + "&idestilo="+idestilo+ "&idkardex="+idkardex+ "&fechainicio="+fechainicio+ "&fechafin="+fechafin;
    //    String enlace = "funcion=VerRecapitulacion&idmarca=" + idmarca + "&idestilo="+idestilo+ "&idkardex="+idkardex;

      verReporteGrande(enlace);

            }


        });

    //capital marca RESUMEN
         but_inventarioventas = new Button(nombreBoton5, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                 String idmarca = com_marca.getValue();
       // String idestilo = com_estilo.getValue();
         String idestilo = "alm-1";
         String idkardex = com_kardex.getValue();

     
 String enlace = "funcion=verDetalleCapitalMarca&idmarca=" + idmarca + "&idkardex="+idkardex;
               verReporte(enlace);

                 //   SeleccionMarcaEstiloInventario.this.destroy();
                  //     SeleccionMarcaEstiloInventario.this.close();
        }
        });
        //impresionmarca
         but_inventarioventas1 = new Button(nombreBoton51, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                 final String idmarca = com_marca.getValue();

         final String idkardex = com_kardex.getValue();
        final String fechai = tex_fechaini.getValueAsString();
    final String fechaf = tex_fechafin.getValueAsString();
    String idalmacen="alm-1";
          String enlace = "php/IngresoAlmacen.php?funcion=CargarInventarioActual&idmarca=" + idmarca+"&idalmacen="+idalmacen+ "&idkardex="+idkardex;
   Utils.setErrorPrincipal("Cargando parametros", "cargar");
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
                                                    String marca = Utils.getStringOfJSONObject(marcaO, "marca");
   Object[][] clientes = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
  Object[][] vendedorM = Utils.getArrayOfJSONObject(marcaO, "empleadoM", new String[]{"idempleado", "codigo"});
   String opcion = Utils.getStringOfJSONObject(marcaO, "opcionb");
//   String marca = Utils.getStringOfJSONObject(marcaO, "marca");
   String formatomayor = Utils.getStringOfJSONObject(marcaO, "formatomayor");
   String totalpares = Utils.getStringOfJSONObject(marcaO, "totalpares");
   String totalbs = Utils.getStringOfJSONObject(marcaO, "totalsus");
   String totalcajas = Utils.getStringOfJSONObject(marcaO, "totalcajas");
 String responsable = Utils.getStringOfJSONObject(marcaO, "responsable");
 String almacen = Utils.getStringOfJSONObject(marcaO, "almacen");

String mesrango = Utils.getStringOfJSONObject(marcaO, "mesrango");
subselec = new subseleccion(idmarca,marca,idkardex,fechai,fechaf,clientes,vendedorM);
                                        subselec.show();
  SeleccionMarcaEstiloInventario.this.clear();
                                    SeleccionMarcaEstiloInventario.this.close();

                                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + opcion, "mensaje");
                                                } else {
                                                    MessageBox.alert("No Hay datos en la consulta");
                                                }
                                            }
                                            else{
                                            Utils.setErrorPrincipal(mensajeR, "mensaje");
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

                  //  String enlace = "funcion=ListaInventarioMarca&idmarca=" + idmarca + "&idcliente="+idcliente + "&rango="+rango + "&idvendedor="+idvendedor;
              // verReporte(enlace);
               
                 //   SeleccionMarcaEstiloInventario.this.destroy();
                  //     SeleccionMarcaEstiloInventario.this.close();
        }
        });

      but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionMarcaEstiloInventario.this.destroy();
                SeleccionMarcaEstiloInventario.this.close();

              }
        });
        com_kardex = new ComboBox("Inf Buscar", "kardex");

        com_marca = new ComboBox("Marca", "marcas",200);
      //  com_estilo = new ComboBox("Almacen", "estilos");
         tex_fechaini = new TextField("Fecha ini", "totalpares");
        tex_fechafin = new TextField("Fecha fin", "totalbs");
  //com_estilo.setDisabled(true);
  // formPanel.add(com_marca);
   //     formPanel.add(com_estilo);
  formPanel.add(com_kardex);
  formPanel.add(tex_fechaini);
  formPanel.add(tex_fechafin);

        formPanel.add(com_marca);
//        formPanel.add(com_estilo);
      //  addButton(but_actualizar);
    //     addButton(but_entradas);
        // addButton(but_nuevo);
       
     //    addButton(but_trasrecibidos);
    //     addButton(but_aceptarP);
        //inventario ver
         addButton(but_aceptarPp);
         //impresion
         addButton(but_inventarioventas1);
         //resumen
        addButton(but_inventarioventas);
       //   addButton(but_editar);
           addButton(but_editar1);
        //      addButton(but_inventarioventas2);
       
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
        initvalues();
     addListeners();
    }


 private void initvalues() {
     
     com_kardex.setValue(mesperiodo);
     tex_fechaini.setValue(fechainicio);
     tex_fechafin.setValue(fechafin);
 }
   

   
    
     private void cargarDatosPanelPedido(final String idmarca,final String idalmacen,final String idkardex) {
        //ver editar
   String enlace = "php/IngresoAlmacen.php?funcion=CargarInventarioActual&idmarca=" + idmarca+"&idalmacen="+idalmacen+ "&idkardex="+idkardex;
   Utils.setErrorPrincipal("Cargando parametros", "cargar");
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
                                                    String marca = Utils.getStringOfJSONObject(marcaO, "marca");
   Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
  Object[][] vendedorM = Utils.getArrayOfJSONObject(marcaO, "empleadoM", new String[]{"idempleado", "codigo"});

   String opcion = Utils.getStringOfJSONObject(marcaO, "opcionb");
                                                       String formatomayor = Utils.getStringOfJSONObject(marcaO, "formatomayor");
   String totalpares = Utils.getStringOfJSONObject(marcaO, "totalpares");
   String totalbs = Utils.getStringOfJSONObject(marcaO, "totalsus");
   String totalcajas = Utils.getStringOfJSONObject(marcaO, "totalcajas");
 String responsable = Utils.getStringOfJSONObject(marcaO, "responsable");
 String almacen = Utils.getStringOfJSONObject(marcaO, "almacen");

String mesrango = Utils.getStringOfJSONObject(marcaO, "mesrango");
if(idmarca=="mar-3"){
PanelInventarioM pan_compraDirecta = new PanelInventarioM(idkardex,mesrango,idmarca, marca,opcion,formatomayor, colores,vendedorM,totalcajas,totalpares,totalbs,responsable, almacen,idalmacen,SeleccionMarcaEstiloInventario.this,padre);
  padre.seleccionarOpcion(null, "fun50291", e, pan_compraDirecta);
}else{if(idmarca=="mar-32"){
PanelInventarioM pan_compraDirecta = new PanelInventarioM(idkardex,mesrango,idmarca, marca,opcion,formatomayor, colores,vendedorM,totalcajas,totalpares,totalbs,responsable, almacen,idalmacen,SeleccionMarcaEstiloInventario.this,padre);
  padre.seleccionarOpcion(null, "fun50291", e, pan_compraDirecta);
}else{
     //PanelPedidoConfirmado pan_compraDirecta = new PanelPedidoConfirmado(Pedido.this, idpedido1,idmarca,fecha,observacion,totalcajas,totalpares,nombre,numeropedido);
PanelInventario pan_compraDirecta = new PanelInventario(idkardex,mesrango,idmarca, marca,opcion,formatomayor, colores,vendedorM,totalcajas,totalpares,totalbs,responsable, almacen,idalmacen,SeleccionMarcaEstiloInventario.this,padre);
  padre.seleccionarOpcion(null, "fun5029", e, pan_compraDirecta);
}
}

  SeleccionMarcaEstiloInventario.this.clear();
                                    SeleccionMarcaEstiloInventario.this.close();
 
                                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + opcion, "mensaje");
                                                } else {
                                                    MessageBox.alert("No Hay datos en la consulta");
                                                }
                                            }
                                            else{
                                            Utils.setErrorPrincipal(mensajeR, "mensaje");
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
     
   private void addListeners() {
                com_marca.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                   //String codigoCliente = field.getValueAsString().trim();
      //             com_estilo.focus();
com_marca.focus();
                }else{
                  MessageBox.alert("Despues de seleccionar la marca haga enter, para cargar su lista de estilos correspondiente.");
                }
            }


        });
//           com_marca.addListener(new ComboBoxListenerAdapter() {
//
//            @Override
//      public void onSelect(ComboBox comboBox, Record record, int index) {
//                onChangeCategoria();
//            }
//
//              private void onChangeCategoria() {
//
//                   com_estilo.focus();
//
//    }
//        });
            com_kardex.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                   String codigoCliente = field.getValueAsString().trim();
                   String idproductosproc = com_kardex.getValueAsString().trim();
                    if (!idproductosproc.isEmpty()) {
                        cargarProducto(idproductosproc);
                        com_marca.focus();
                        //com_kardex.setValue("");
                        //com_productoProc.setEmptyText("");

                    }
                }else{
                  MessageBox.alert("Despues de seleccionar la marca haga enter, para cargar su lista de estilos correspondiente.");
                }
            }
        });
//           com_marca.addListener(new ComboBoxListenerAdapter() {
//
//            @Override
//      public void onSelect(ComboBox comboBox, Record record, int index) {
//                onChangeCategoria();
//            }
//
//              private void onChangeCategoria() {
//                    String idproductosproc = com_kardex.getValueAsString().trim();
//                  cargarProducto(idproductosproc);
//                   String idmarca = com_marca.getValue();
//                  String idkardex = com_kardex.getValue();
//                  String idestilo="alm-1";
//             cargarDatosPanelPedido(idmarca,idestilo,idkardex);
//                SeleccionMarcaEstiloInventario.this.destroy();
//                       SeleccionMarcaEstiloInventario.this.close();
//                  // com_estilo.setDisabled(false);
//                  // com_estilo.focus();
//
//
//    }
//        });
    


    }
     
  private void cargarProducto(String id) {

        String idProducto = "";
        String detalle = "";
        String unidad = "";
        String fecha = "";
        if (id != null) {
                 SimpleStore producto = new SimpleStore(new String[]{"idkardex", "mesrango","fechainicio","fechafin"}, kardexM);
                    producto.load();
                    producto.filter("idkardex", id);
                    Record r = producto.getRecords()[0];
                    idProducto = r.getAsString("idkardex");
                    detalle = r.getAsString("fechainicio");
                    unidad = r.getAsString("fechafin");
//                    fecha = r.getAsString("fecha");
                    tex_fechaini.setValue(detalle);
                    tex_fechafin.setValue(unidad);


            //                        respuesta = true;

        }
    }

    private void initCombos() {
 com_kardex.setValueField("idkardex");
        com_kardex.setDisplayField("mesrango");
        com_kardex.setMinChars(1);
        com_kardex.setFieldLabel("mesrango");
        com_kardex.setMode(ComboBox.LOCAL);
        com_kardex.setEmptyText("Seleccione Rango");
        com_kardex.setLoadingText("Buscando");
        com_kardex.setTypeAhead(true);
        com_kardex.setSelectOnFocus(true);
        com_kardex.setHideTrigger(true);

        SimpleStore cotegoriaStore1 = new SimpleStore(new String[]{"idkardex", "mesrango"}, kardexM);
        cotegoriaStore1.load();
        com_kardex.setStore(cotegoriaStore1);

        

         com_marca.setValueField("idmarca");
        com_marca.setDisplayField("nombre");
        com_marca.setMinChars(1);
        com_marca.setFieldLabel("marca");
        com_marca.setMode(ComboBox.LOCAL);
        com_marca.setEmptyText("Seleccione Marca");
        com_marca.setLoadingText("Buscando");
        com_marca.setTypeAhead(true);
        com_marca.setSelectOnFocus(true);
        com_marca.setHideTrigger(true);

        SimpleStore cotegoriaStore = new SimpleStore(new String[]{"idmarca", "nombre"}, marcaM);
        cotegoriaStore.load();
        com_marca.setStore(cotegoriaStore);


//
//         com_estilo.setMinChars(1);
//           com_estilo.setFieldLabel("Almacen");
//            com_estilo.setEmptyText("Seleccione un almacen");
//           com_estilo.setDisplayField("nombre");
//           com_estilo.setValueField("idalmacen");
//           com_estilo.setMode(ComboBox.LOCAL);
//           com_estilo.setTriggerAction(ComboBox.ALL);
//          com_estilo.setLinked(true);
//           com_estilo.setForceSelection(true);
////           com_cliente.setReadOnly();
//           com_estilo.setHideTrigger(true);
//           com_estilo.setSelectOnFocus(true);
//           com_estilo.setTypeAhead(true);
//     SimpleStore proveedorStore1 = new SimpleStore(new String[]{"idalmacen", "nombre"}, estiloM);
//        proveedorStore1.load();
//com_estilo.setStore(proveedorStore1);
//com_estilo.focus();

    }
  
 public Button getBut_aceptarpp() {
        return but_aceptarPp;
    }
// public Button getBut_aceptarp() {
//        return but_aceptarP;
//    }
//  public Button getBut_nuevo() {
//        return but_nuevo;
//    }
//   public Button getBut_actualizar() {
//        return but_actualizar;
//    }
//    public Button getBut_entradas() {
//        return but_entradas;
//    }
//     public Button getBut_trasrecibidos() {
//        return but_trasrecibidos;
//    }
//      public Button getBut_regularizacion() {
//        return but_regularizacion;
//    }
//       public Button getBut_traspdespachados() {
//        return but_traspdespachados;
//    }
//        public Button getBut_devuletos() {
//        return but_devueltos;
//    }
//
//  public Button getBut_editar() {
//        return but_editar;
//    }
   public Button getBut_inventarioventas() {
        return but_inventarioventas;
    }
public Button getBut_inventarioventas1() {
        return but_inventarioventas1;
    }
//public Button getBut_inventarioventas2() {
//        return but_inventarioventas2;
//    }
    public Button getBut_cancelar() {
        return but_cancelarP;
    }

     private void verReportePeque(String enlace) {
        ReporteMediaCartaChorroWindowp print = new ReporteMediaCartaChorroWindowp(enlace);
        print.show();
    }
 private void verReporteGrande(String enlace) {
        ReporteMediaCartaChorroWindowg print = new ReporteMediaCartaChorroWindowg(enlace);
        print.show();
    }
           private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }

}
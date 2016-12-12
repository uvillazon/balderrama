/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

/**
 *
 * @author 
 */
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.google.gwt.user.client.Window;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.core.RegionPosition;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.data.Store;
import com.gwtext.client.util.DateUtil;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.PaddedPanel;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextArea;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.event.EditorGridListenerAdapter;
import com.gwtext.client.widgets.layout.BorderLayout;
import com.gwtext.client.widgets.layout.BorderLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.FormLayout;
import com.gwtext.client.widgets.layout.HorizontalLayout;
import com.gwtext.client.widgets.layout.TableLayout;
import com.gwtext.client.widgets.layout.TableLayoutData;

import java.util.Date;
import org.balderrama.client.emergentes.SeleccionMarcaRebaja;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;

//import org.balderrama.client.util.Validacion;


public class PanelRebaja extends Panel {

    private SeleccionMarcaRebaja SM;
    //private Panel panel;
    private String COMPRA_DIRECTA_TABBED = "9600000_venta-";
    private TextField tex_marca;
    private ComboBox com_modeloCV;
    //private ComboBox com_estilo;

   // private TextField tex_numeropedido;
    //private TextField tex_modeloCP;
    private TextField tex_totalpares;
     private TextField tex_totalpares2;
    private TextField tex_totalbs;

    public TextField tex_totalcaja;
    private DateField dat_fecha;
   // private ListaPedidoCalzados lista;
    private ListaCalzadoRebaja lista1;
  // public ListaCalzadoPedidoTallaUnion2 lista2;
    boolean respuesta = false;
    private TextArea tea_descripcion;
    private Button but_aceptar;
    private Button but_cancelar;
    private Button but_limpiar;
    private Button but_anadir;
    public KMenu kmenu;
    String selecionado = "";
    String marca;
    String idmarca;
    String numeropedido;
    String modelo;
    Object[][] modeloM;
    //Object[][] colorM;
    //Object[][] materialM;
 Object[][] estiloM;
    String opciona;
    String opcion;
     String opcionnueva;
 //  String opciontalla;
  String iddetalleingreso;
   private Store proveedorStore11;

    public PanelRebaja(String idmarca, String nombremarca, String opcion, String opcionbb, Object[][] modelM,SeleccionMarcaRebaja SM,KMenu kmenu) {
         this.SM = SM;
        this.marca = nombremarca;
        this.idmarca = idmarca;
        this.opcion = opcionbb;
        this.opciona = opcion;
        this.modeloM = modelM;
      //   this.estiloM = vendedorM;
     //    this.opciontalla= opciontalla;
         this.kmenu = kmenu;

        onModuleLoad();
         }

    public void onModuleLoad() {
        //panel = new Panel();
        setId("tab-" + COMPRA_DIRECTA_TABBED);
        setTitle("Modelos");
        setLayout(new FitLayout());
        setBaseCls("x-plain");
        this.setClosable(true);
        this.setId("TPfun50152");
        setIconCls("tab-icon");

        Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");
 Panel pan_centrofin = new Panel();
       //pan_centro.setTitle("Lista de Clientes");
        pan_centrofin.setLayout(new FormLayout());
        pan_centrofin.setWidth(1300);
        pan_centrofin.setHeight(600);

        Panel pan_norte = new Panel();
        pan_norte.setLayout(new TableLayout(3));
        pan_norte.setBaseCls("x-plain");
        pan_norte.setHeight(98);
        pan_norte.setPaddings(5);

        Panel pan_sud = new Panel();
        pan_sud.setLayout(new TableLayout(3));
        pan_sud.setBaseCls("x-plain");
        pan_sud.setHeight(120);
        pan_sud.setPaddings(5);

        //if (opcion.equalsIgnoreCase("6")) {
            lista1 = new ListaCalzadoRebaja();
            lista1.onModuleLoad5();
            opcionnueva = "100";
         // }
        


        Panel pan_centro = lista1.getPanel();

        FormPanel for_panel1 = new FormPanel();
        for_panel1.setBaseCls("x-plain");
        for_panel1.setWidth(330);
        for_panel1.setLabelWidth(100);
        tex_marca = new TextField("Marca", "marca", 200);
        tex_marca.setValue(marca);
        tex_marca.setReadOnly(true);
//com_estilo = new ComboBox("Estilos", "idestilo");
//com_estilo.focus();
        // tex_modeloCP = new TextField("Modelo CP", "idmodelo", 200);
        //tex_modeloCP.setValue("idmodelo");

        for_panel1.add(tex_marca);

 // for_panel1.add(com_estilo);
        // for_panel1.add(tex_modeloCP);

        FormPanel for_panel2 = new FormPanel();
        for_panel2.setBaseCls("x-plain");
        for_panel2.setWidth(330);
        for_panel2.setLabelWidth(100);

        but_anadir = new Button("Anadir modelo nuevo");
        Panel pan_botonescliente = new Panel();
        pan_botonescliente.setLayout(new HorizontalLayout(2));
        pan_botonescliente.setBaseCls("x-plain");
 pan_botonescliente.add(but_anadir);


        com_modeloCV = new ComboBox("Buscar Modelos Anadir", "idmodelo",400);

//tex_modeloCP = new TextField("codigo Nuevo", "idmodelonuevo", 400);
// tex_modeloCP.setDisabled(false);
//
    for_panel2.add(com_modeloCV);
 //for_panel2.add(tex_modeloCP);
 for_panel2.add(new PaddedPanel(pan_botonescliente, 5, 5, 5, 5), new TableLayoutData(2));
       
        FormPanel for_panel3 = new FormPanel();
        for_panel3.setBaseCls("x-plain");
        for_panel3.setWidth(300);
        for_panel3.setLabelWidth(100);

        dat_fecha = new DateField("Fecha", "d-m-Y");
        Date date = new Date();
        dat_fecha.setValue(Utils.getStringOfDate(date));

        for_panel3.add(dat_fecha);



        pan_norte.add(new PaddedPanel(for_panel1, 10));
        pan_norte.add(new PaddedPanel(for_panel2, 10));
        pan_norte.add(new PaddedPanel(for_panel3, 10));
//        pan_norte.add(new PaddedPanel(for_panel12, 0, 0, 13, 10));

        FormPanel for_panel4 = new FormPanel();
        for_panel4.setBaseCls("x-plain");
        tex_totalpares = new TextField("Total Pares", "totalpares");
         tex_totalpares2 = new TextField("Total bs anterior", "totalbs");
        tex_totalbs = new TextField("Total Bs Nuevo", "totalbsnuevo");

        tex_totalcaja = new TextField("Diferencia", "diferencia");

      
        for_panel4.add(tex_totalpares);
     for_panel4.add(tex_totalpares2);

        FormPanel for_panel6 = new FormPanel();
        for_panel6.setBaseCls("x-plain");
       

        for_panel6.add(tex_totalbs);
 for_panel6.add(tex_totalcaja);
        Panel pan_botones = new Panel();
        pan_botones.setLayout(new HorizontalLayout(10));
        pan_botones.setBaseCls("x-plain");
        //       pan_botones.setHeight(40);
        but_aceptar = new Button("registrar precio");
        but_cancelar = new Button("Cancelar");
        but_limpiar = new Button("Limpiar");
        //but_verproducto = new Button("Ver Producto");
        pan_botones.add(but_aceptar);
        pan_botones.add(but_cancelar);
        pan_botones.add(but_limpiar);
        //pan_botones.add(but_verproducto);

        pan_sud.add(new PaddedPanel(for_panel4, 0, 0, 13, 10));
        //pan_sud.add(new PaddedPanel(for_panel5, 0, 0, 13, 10));
        pan_sud.add(new PaddedPanel(for_panel6, 3, 0, 13, 10));
        pan_sud.add(new PaddedPanel(pan_botones, 10, 200, 10, 10), new TableLayoutData(3));


          pan_centrofin.add(pan_centro);
       //  pan_centrofin.add(pan_oeste);
        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centrofin, new BorderLayoutData(RegionPosition.CENTER));
        pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        add(pan_borderLayout);

       initCombos();
        //initValues();
        addListeners();

    }
     



    private void initCombos() {



  SimpleStore proveedorStore1 = new SimpleStore(new String[]{"idmodelo", "nombre"}, modeloM);
        proveedorStore1.load();
         com_modeloCV.setMinChars(1);
            com_modeloCV.setStore(proveedorStore1);
           com_modeloCV.setFieldLabel("Modelo ");
            com_modeloCV.setEmptyText("Seleccione un modelo");
           com_modeloCV.setDisplayField("nombre");
           com_modeloCV.setValueField("idmodelo");
           com_modeloCV.setMode(ComboBox.LOCAL);
           com_modeloCV.setTriggerAction(ComboBox.ALL);
          com_modeloCV.setLinked(true);
           com_modeloCV.setForceSelection(true);
//           com_cliente.setReadOnly();
           com_modeloCV.setHideTrigger(true);
           com_modeloCV.setSelectOnFocus(true);
           com_modeloCV.setTypeAhead(true);

        
    }

    private void initValues() {
        //com.google.gwt.user.client.Window.alert("//" + tipocambio);

        tex_totalpares.setValue("0");
         tex_totalpares2.setValue("0");
        tex_totalbs.setValue("0");

    }

    private void addListeners() {

           com_modeloCV.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {

                 if (e.getKey() == EventObject.ENTER) {
                // String vendedor = com_modeloCV.getValueAsString();
                  String idproductos = com_modeloCV.getValueAsString().trim();
   if (idproductos != null)
   {

        findByCodigoProducto(idproductos);

                    } else {
     MessageBox.alert("Por favor seleccione un modelo ");
                }

                }
                  if (e.getKey() == EventObject.END) {
                 //   MessageBox.alert("ErrrrNo hay producto seleccionado para quitar y/o selecciono mas de uno.");
                }
            }
        });

        //**************************************************
        //************* BOTON CANCELAR   *******************
        //**************************************************
       but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
 kmenu.seleccionarOpcionRemove(null, "fun50152", e, PanelRebaja.this);
            }
        });
        //**************************************************
        //************* BOTON ACEPTAR *******************
        //**************************************************
        but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
//                if (Multivendedo.equalsIgnoreCase("SI")) {
//                    procesoValidar();
//                } else {
                createPedido(idmarca);
//                }
            }
        });


        but_limpiar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                limpiarVentanaVenta();
            }
        });
 but_anadir.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {

//         String modelo = tex_modeloCP.getValueAsString();
//
//                if ((!modelo.isEmpty())) {
//                   // crearitems(modelo);
//
//                } else {
//                    MessageBox.alert("Tiene que registrar el modelo nuevo");
//                }
                //createCompra();
            }

        });
     




         tex_totalcaja.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {

                if (e.getKey() == EventObject.ENTER) {
                     String idestilo = tex_totalcaja.getValueAsString().trim();
                    //String idproductos = tex_producto.getValueAsString().trim();

//                         lista2.recargarlista2(idestilo);
                            tex_totalcaja.focus();

                   }
                    // Utils.setErrorPrincipal("Usted debe introducir un id modelo antes.", "error");
                }
            });
      lista1.getGrid().addEditorGridListener(new EditorGridListenerAdapter() {

            @Override
            public void onAfterEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
                calcularSubTotal(grid, record, field, newValue, oldValue, rowIndex, colIndex);
            }
        });




    }


//               public void GuardarItems(final String modelo) {
//              Record registroCompra = lista2.getRecordDef().createRecord(new Object[]{
//                      id, marca, modelo, 0, 0, 0});
//
//                                lista2.getGrid().stopEditing();
//                                lista2.getGrid().getStore().insert(0, registroCompra);
//                                lista2.getGrid().startEditing(0, 0);
//
//            }
      private boolean findByCodigoProducto(final String buscando) {
//                String enlace = "php/KardexTienda.php?funcion=buscarporcodigobarra&codigo=" + buscando+"&vendedor="+vendedor;
  String enlace = "php/IngresoAlmacen.php?funcion=buscarmodeloinsertarprecio&modelo=" + buscando;

                //String enlace = "php/Pedido.php?funcion=BuscarModeloPorId&idmodelo=" + buscando;
             //   Utils.setErrorPrincipal("Cargando parametros del codigo", "cargar");
                final Conector conec = new Conector(enlace, false);
                {

                    try {
                        conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

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
 // if (opcionnueva.equalsIgnoreCase("100")) {
//   String[] nombreCaso5Columns = {"iddetalleingreso","coleccion", "codigo", "color", "precio","cantidadpares", "totalbs","precionuevo", "totalbsnuevo", "diferencia"};

        String idmodelo = Utils.getStringOfJSONObject(marcaO, "iddetalleingreso");
          String coleccion = Utils.getStringOfJSONObject(marcaO, "coleccion");
                                            String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                            String color = Utils.getStringOfJSONObject(marcaO, "color");
                                            Number precio2 = Utils.getBigDecimalOfJSONObject(marcaO, "precio");
                                         String pares = Utils.getStringOfJSONObject(marcaO, "cantidadpares");
                                         String bs = Utils.getStringOfJSONObject(marcaO, "totalbs");
                                        

    Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
                                                        idmodelo, coleccion,codigo, color,precio2, pares, bs, 0,0,0});
                   lista1.getGrid().stopEditing();
                                            lista1.getGrid().getStore().insert(0, registroCompra);
                                            lista1.getGrid().startEditing(0, 0);
                                            Float to = new Float(0);
//                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
//                                                to += lista1.getStore().getRecords()[i].getAsFloat("precio");
//                                            }
                                           Float top = new Float(0);
                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
                                                top += lista1.getStore().getRecords()[i].getAsFloat("cantidadpares");
                                            }
                                           Float top1 = new Float(0);
                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
                                                top1 += lista1.getStore().getRecords()[i].getAsFloat("totalbs");
                                            }
                                            //tex_montoTotal.setValue(to.toString());
                                            tex_totalpares.setValue(top.toString());
                                            // tex_totalbs.setValue(to.toString());
                                             tex_totalpares2.setValue(top1.toString());

                                           // prueba.setText(to.toString());

                     //               }
 
                                           
                                         

                                        } else {

                                            //MessageBox.alert("No Hay datos en la consulta");
                                        }

                                    }

                                    else{
                                       //  Utils.setErrorPrincipal(mensajeR, "mensaje");
                                    com_modeloCV.setValue("");
                                            com_modeloCV.focus();
                                        MessageBox.alert(mensajeR);

                                    }
                                } else {
                                  com_modeloCV.setValue("");
                                            com_modeloCV.focus();
                                }
                                throw new UnsupportedOperationException("Not supported yet.");
                            }

                            public void onError(Request request, Throwable exception) {
                                throw new UnsupportedOperationException("Not supported yet.");
                            }
                        });

                    } catch (RequestException e) {
                        e.getMessage();
                        MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
                    // Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");

                    }
                    return respuesta;
                }

            }

  public void limpiarVentanaVenta() {
        lista1.LimpiarGrid();
      //  lista2.LimpiarGrid();
        tex_totalpares.setValue("0");
         tex_totalpares2.setValue("0");
        tex_totalcaja.setValue("");
        tea_descripcion.setValue("");
    //   com_estilo.setValue("");
        //com_empleado.setValue("No existe el Cliente");
    }
   private void calcularSubTotal(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
        String temp = newValue.toString();
        Float old = new Float(oldValue.toString());


         Float totalpares1 = record.getAsFloat("cantidadpares");
  Float precio2 = record.getAsFloat("precionuevo");
   Float totalbsant = record.getAsFloat("totalbs");
    Float totalbsneo = record.getAsFloat("totalbsnuevo");
  Float ne = old;
        try {
            ne = new Float(temp);
        } catch (Exception e) {
            com.google.gwt.user.client.Window.alert("atapadp  " + e.getMessage());
            ne = old;
        }
 if (colIndex == 7) {
            record.set("precionuevo", 0.0);
        // record.set("preciobs", ne);
        }
        if (colIndex == 8) {
            record.set("totalbsnuevo", 0.0);
        // record.set("preciosus", ne);
        }
        if (colIndex == 9) {
            record.set("diferencia", 0.0);
        // record.set("preciosus", ne);
        }

            record.commit();

        if (record.getAsFloat("precionuevo") != 0.0) {
            record.set("totalbsnuevo", record.getAsFloat("precionuevo") * record.getAsFloat("cantidadpares"));
         record.set("diferencia", record.getAsFloat("totalbsnuevo") - record.getAsFloat("totalbs"));

        }

//
//            record.set("totalbsnuevo", totalpares1 * precio2 );
//       //    record.set("totalbs", record.getAsFloat("totalpares") * record.getAsFloat("precio"));
//    record.set("precionuevo", precio2);
//
//       // record.set("totalbsnuevo", record.getAsFloat("cantidadpares") * record.getAsFloat("precionuevo"));
//
//  record.set("diferencia", totalbsneo - totalbsant);
//
// record.commit();
      
        Float total = new Float(0);
        for (int i = 0; i <
                grid.getStore().getRecords().length; i++) {
            total += grid.getStore().getRecords()[i].getAsFloat("totalbsnuevo");

        }

       // tex_montoTotal.setValue(total.toString());
        tex_totalbs.setValue(total.toString());
        // tex_totalcaja.setValue(total.toString());
       // record.set("cantidad", 0);

        Float totalpares = new Float(0);
        for (int i = 0; i <
                grid.getStore().getRecords().length; i++) {
            totalpares += grid.getStore().getRecords()[i].getAsFloat("diferencia");

        }

tex_totalcaja.setValue(totalpares.toString());

// tex_montoPagar
// tex_montocancelado

    }
    public void createPedido(final String idmarca) {
          String totalpares = tex_totalpares.getValueAsString();
        String totalbsanterior = tex_totalpares2.getValueAsString();
  String totalbsnuevo = tex_totalbs.getValueAsString();
        String diferencia = tex_totalcaja.getValueAsString();


String fecha = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
        
        Record[] records = lista1.getStore().getRecords();
        JSONArray productos = new JSONArray();
        JSONObject productoObject;

                      // tex_montocancelado.setValue("0");
            JSONObject compraObject = new JSONObject();
            compraObject.put("fecha", new JSONString(fecha));
            compraObject.put("idmarca", new JSONString(idmarca));
            compraObject.put("totalpares", new JSONString(totalpares));
            compraObject.put("totalbsanterior", new JSONString(totalbsanterior));
            compraObject.put("totalbsnuevo", new JSONString(totalbsnuevo));
           compraObject.put("diferencia", new JSONString(diferencia));
        //  String[] nombreCaso5Columns = {"iddetalleingreso","coleccion", "codigo", "color", "precio","cantidadpares", "totalbs","precionuevo", "totalbsnuevo", "diferencia"};

            for (int i = 0; i < records.length; i++) {
                productoObject = new JSONObject();
                productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
            productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
            productoObject.put("cantidadpares", new JSONString(records[i].getAsString("cantidadpares")));
  productoObject.put("totalbs", new JSONString(records[i].getAsString("totalbs")));

                productoObject.put("precionuevo", new JSONString(records[i].getAsString("precionuevo")));
            productoObject.put("totalbsnuevo", new JSONString(records[i].getAsString("totalbsnuevo")));
            productoObject.put("diferencia", new JSONString(records[i].getAsString("diferencia")));

                productos.set(i, productoObject);
                productoObject = null;
            }
            JSONObject resultado = new JSONObject();
            resultado.put("venta", compraObject);
            resultado.put("productos", productos);

            String datos = "resultado=" + resultado.toString();

            Utils.setErrorPrincipal("registrando", "cargar");
               String url = "./php/IngresoAlmacen.php?funcion=GuardarNuevoPrecio&" + datos;

         //   String url = "./php/VentaDetalle.php?funcion=txSaveVenta&" + datos;
//            final Conector conec = new Conector(url, false, "GET");
            final Conector conec = new Conector(url, false, "POST");

           //         final Conector conec = new Conector(url, false,"POST");
      try {
            conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {
    private EventObject e;
                public void onResponseReceived(Request request, Response response) {
                    String data = response.getText();
                    JSONValue jsonValue = JSONParser.parse(data);
                    JSONObject jsonObject;
                    if ((jsonObject = jsonValue.isObject()) != null) {
                        String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                        String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                        if (errorR.equalsIgnoreCase("true")) {
                             String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
                             //   String enlTemp = "funcion=reporterebajasHTML&idmarca=" + idventaG;
                    //String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
    //String idmarca = com_marca.getValue();
        String enlace = "funcion=reporterebajasHTML&idmarca=" + idmarca ;
               verReporte(enlace);
 kmenu.seleccionarOpcionRemove(null, "fun50152", e, PanelRebaja.this);

                        } else {
                            //Window.alert(mensajeR);
                            com.google.gwt.user.client.Window.alert("No se puede realizar la venta");
                            Utils.setErrorPrincipal(mensajeR, "error");
                        }
                    } else {
                        com.google.gwt.user.client.Window.alert("error 1001");
                        Utils.setErrorPrincipal("Error en la respuesta del servidor", "error");
                    }
                }

                public void onError(Request request, Throwable exception) {
                    //Window.alert("Ocurrio un error al conectar con el servidor ");
                    com.google.gwt.user.client.Window.alert("error 1002");
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            });
        } catch (RequestException ex) {
                //Window.alert("Ocurrio un error al conectar con el servidor");
//            com.google.gwt.user.client.Window.alert("error 1003");
                Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
            }






}

 


    public void closePanel() {
        this.destroy();
    }

    public void closeTabCompraDirecta() {
        this.remove("tab-" + COMPRA_DIRECTA_TABBED);
       SM.panel.getTabPanel().remove("tab-" + COMPRA_DIRECTA_TABBED);
       this.destroy();
        }


    private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }

}

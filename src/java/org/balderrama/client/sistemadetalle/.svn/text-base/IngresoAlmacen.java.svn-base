/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

/**
 *
 * @author miguel
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
import com.gwtext.client.core.EventObject;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.core.RegionPosition;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.SimpleStore;
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
import com.gwtext.client.widgets.layout.HorizontalLayout;
import com.gwtext.client.widgets.layout.TableLayout;
import com.gwtext.client.widgets.layout.TableLayoutData;
//import org.asia.client.almacen.venta.FormularioSeleccionarCliente;
//import org.asia.client.almacen.venta.MostrarAlmacenesWindow;
//import org.asia.client.bean.ProductoProforma;
//import org.asia.client.bean.Cliente;
import java.util.Date;
import org.balderrama.client.MainEntryPoint;
import org.balderrama.client.system.PrincipalTab;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;

public class IngresoAlmacen extends Panel {

    //private Marca marca1;
    private long idpanel;
    private final int ANCHO = 1000;
    private final int ALTO = 540;
    //private Panel panel;
    private String INGRESO_ALMACEN = "5099";
    private TextField tex_marca;
    private TextField tex_idmarca;
    private DateField dat_fecha;
    private ComboBox com_modeloCV;
    private TextField tex_numeropedido;
    private TextField tex_totalpares;
    private TextField tex_totalcaja;
    private ListaIngresoAlmacen lista1;
    boolean respuesta = false;
    private TextArea tea_descripcion;
    private Button but_aceptar;
    private Button but_cancelar;
    private Button but_limpiar;
    String selecionado = "";
    //private long idpanel;
    String marca;
    String idmarca;
    String numeropedido;
    String modelo;
    String codigo;
    IngresoAlmacenForm ingreso;
    Object[][] clienteM;
    Object[][] vendedorM;
    Object[][] colorM;
    Object[][] materialM;
    Object[][] modeloM;
    String opcion;
    private MainEntryPoint Principal;

    public IngresoAlmacen(String idmarca, String marca, String numerodoc, String opcion, Object[][] modeloM, IngresoAlmacenForm forma) {
        //public IngresoAlmacen(IngresoAlmacenForm forma){
        this.marca = marca;
        this.idmarca = idmarca;
        this.numeropedido = numerodoc;
        this.opcion = opcion;
        this.modeloM = modeloM;
        ingreso = forma;
        onModuleLoad();
    }

    public void onModuleLoad() {
        //panel = new Panel();
        setId("tab-" + "5099");
        setTitle("Panel Ingreso Almacen");
        setLayout(new FitLayout());
        setBaseCls("x-plain");
        this.setClosable(true);
        setIconCls("tab-icon");

        Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");

        Panel pan_norte = new Panel();
        pan_norte.setLayout(new TableLayout(4));
        pan_norte.setBaseCls("x-plain");
        pan_norte.setHeight(40);
        pan_norte.setWidth(300);
        pan_norte.setPaddings(5);

        Panel pan_sud = new Panel();
        pan_sud.setLayout(new TableLayout(3));
        pan_sud.setBaseCls("x-plain");
        pan_sud.setHeight(120);
        pan_sud.setPaddings(5);

        if (opcion.equalsIgnoreCase("1")) {
            lista1 = new ListaIngresoAlmacen();
            lista1.onModuleLoad1();
        }
        if (opcion.equalsIgnoreCase("2")) {
            lista1 = new ListaIngresoAlmacen();
            lista1.onModuleLoad2();
        }


        Panel pan_centro = lista1.getPanel();

        FormPanel for_panel1 = new FormPanel();
        for_panel1.setBaseCls("x-plain");
        for_panel1.setWidth(300);
        for_panel1.setLabelWidth(100);
        tex_idmarca = new TextField("IdMarca", "idmarca");
        tex_idmarca.setValue(idmarca);
        tex_marca = new TextField("Marca", "marca");
        tex_marca.setValue(marca);
        tex_marca.setReadOnly(true);
        dat_fecha = new DateField("Fecha", "d-m-Y");
        Date date = new Date();
        dat_fecha.setValue(Utils.getStringOfDate(date));
        for_panel1.add(tex_marca);
        //for_panel1.add(tex_modeloCP);

        FormPanel for_panel2 = new FormPanel();
        for_panel2.setBaseCls("x-plain");
        for_panel2.setWidth(300);
        for_panel2.setLabelWidth(100);
        tex_numeropedido = new TextField("Numero Pedido", "numeropedido");
        tex_numeropedido.setReadOnly(true);
        tex_numeropedido.setValue(numeropedido);


        //com_modeloCV.setWidth(20);

        for_panel2.add(tex_numeropedido);
        //for_panel2.add(com_modeloCV);

        FormPanel for_panel3 = new FormPanel();
        for_panel3.setBaseCls("x-plain");
        for_panel3.setWidth(300);
        for_panel3.setLabelWidth(100);

        //dat_fecha = new DateField("Fecha", "d-m-Y");
        com_modeloCV = new ComboBox("ModeloCV", "idmodelo");
        for_panel3.add(com_modeloCV);

        FormPanel for_panel41 = new FormPanel();
        for_panel41.setBaseCls("x-plain");
        for_panel41.setWidth(300);
        for_panel41.setLabelWidth(100);
        for_panel41.add(dat_fecha);



        pan_norte.add(new PaddedPanel(for_panel1, 0, 0, 13, 10));
        pan_norte.add(new PaddedPanel(for_panel2, 0, 0, 13, 10));
        pan_norte.add(new PaddedPanel(for_panel3, 0, 0, 13, 10));
        pan_norte.add(new PaddedPanel(for_panel41, 0, 0, 13, 10));

        FormPanel for_panel4 = new FormPanel();
        for_panel4.setBaseCls("x-plain");
        tex_totalpares = new TextField("Total Pares", "totalpares1");
        tex_totalpares.setReadOnly(true);
        tex_totalcaja = new TextField("Total Bs.", "totalcaja");
        tex_totalcaja.setReadOnly(true);
        for_panel4.add(tex_totalpares);
        for_panel4.add(tex_totalcaja);


        FormPanel for_panel6 = new FormPanel();
        for_panel6.setBaseCls("x-plain");
        tea_descripcion = new TextArea("Observacion", "observacion");
        tea_descripcion.setWidth("100%");

        for_panel6.add(tea_descripcion);

        Panel pan_botones = new Panel();
        pan_botones.setLayout(new HorizontalLayout(10));
        pan_botones.setBaseCls("x-plain");
        //       pan_botones.setHeight(40);
        but_aceptar = new Button("Guardar");
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


        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centro, new BorderLayoutData(RegionPosition.CENTER));
        //pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.CENTER));
        pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        add(pan_borderLayout);

        initCombos();
        initValues();
        addListeners();


    }

    private void initCombos() {


        SimpleStore proveedorStore = new SimpleStore(new String[]{"idmodelo", "codigo"}, modeloM);
        proveedorStore.load();


        com_modeloCV.setMinChars(1);
        //com_modeloCV.setFieldLabel("Modelo");
        com_modeloCV.setStore(proveedorStore);
        com_modeloCV.setValueField("idmodelo");
        com_modeloCV.setDisplayField("codigo");
        com_modeloCV.setForceSelection(true);
        com_modeloCV.setMode(ComboBox.LOCAL);
        com_modeloCV.setEmptyText("Buscar Modelo");
        com_modeloCV.setLoadingText("buscando...");
        com_modeloCV.setTypeAhead(true);
        com_modeloCV.setSelectOnFocus(true);
        com_modeloCV.setWidth(130);

        com_modeloCV.setHideTrigger(true);

    }

    private void initValues() {
        //com.google.gwt.user.client.Window.alert("//" + tipocambio);

        tex_totalpares.setValue("0");
        tex_totalcaja.setValue("0");

    }

    private void addListeners() {

        //**************************************************
        //************* BOTON CANCELAR   *******************
        //**************************************************
        but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {

                //closeTabCompraDirecta();
            }
        });

        //**************************************************
        //************* BOTON ACEPTAR *******************
        //**************************************************
        but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {

                createCalzados("mismo");

            }
        });


        but_limpiar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                //limpiarVentanaVenta();
            }
        });

        com_modeloCV.addListener(new TextFieldListenerAdapter() {

            public void onSpecialKey(Field field, EventObject e) {

                if (e.getKey() == EventObject.ENTER) {
                    //String idmarca = field.getValueAsString().trim();
                    String idmodelo = com_modeloCV.getValueAsString().trim();
                    //String codigo = tex_producto.getValueAsString().trim();
                    if (idmodelo.isEmpty()) {

                        com_modeloCV.focus();

                    } else {

//                          
                        addListenerModelo(idmodelo);

                        com_modeloCV.focus();

                    // Utils.setErrorPrincipal("Usted debe introducir un id modelo antes.", "error");
                    }
                }
            //Utils.setErrorPrincipal("Usted debe introducir un id modelo antes.", "error");
            }

            private void addListenerModelo(String buscando) {
                String enlace = "php/IngresoAlmacen.php?funcion=BuscarModeloDetallePorId&idmodelo=" + buscando;
                Utils.setErrorPrincipal("Cargando parametros del modelo", "cargar");
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
                                            String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                            String precio = Utils.getStringOfJSONObject(marcaO, "precio2");
                                            String idmodelo = Utils.getStringOfJSONObject(marcaO, "idmodelodetalle");

                                            //Object[][] lineas = Utils.getArrayOfJSONObject(marcaO, "lineaM", new String[]{"idcliente", "codigo"});
                                            if (opcion.equalsIgnoreCase("1")) {
                                                Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
                                                            codigo, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, precio, 0, 0, idmodelo});
                                                lista1.getGrid().stopEditing();
                                                lista1.getGrid().getStore().insert(0, registroCompra);
                                                lista1.getGrid().startEditing(0, 0);

                                            }
                                            if (opcion.equalsIgnoreCase("2")) {

                                                Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
                                                            codigo, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, precio, 0, 0, idmodelo});
                                                lista1.getGrid().stopEditing();
                                                lista1.getGrid().getStore().insert(0, registroCompra);
                                                lista1.getGrid().startEditing(0, 0);
                                            }


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

                    } catch (RequestException e) {
                        e.getMessage();
                        MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
                    }

                }

            }
        });



        //**************************************************
        //*************CALCULAR TOTAL DE COMPRA ************
        //**************************************************
        lista1.getGrid().addEditorGridListener(new EditorGridListenerAdapter() {

            @Override
            public void onAfterEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
                calcularSubTotal(grid, record, field, newValue, oldValue, rowIndex, colIndex);
            }
        });


    }

    private void calcularSubTotal(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
        String temp = newValue.toString();
        Float old = new Float(oldValue.toString());

        Float ne = old;
        try {
            ne = new Float(temp);
        } catch (Exception e) {
            com.google.gwt.user.client.Window.alert("atapadp  " + e.getMessage());
            ne = old;
        }
        if (opcion.equalsIgnoreCase("1")) {
            record.commit();
            Float precio = record.getAsFloat("precio");
            Float talla14 = record.getAsFloat("14");
            Float talla15 = record.getAsFloat("15");
            Float talla16 = record.getAsFloat("16");
            Float talla17 = record.getAsFloat("17");
            Float talla18 = record.getAsFloat("18");
            Float talla19 = record.getAsFloat("19");
            Float talla20 = record.getAsFloat("20");
            Float talla21 = record.getAsFloat("21");
            Float talla22 = record.getAsFloat("22");
            Float talla23 = record.getAsFloat("23");
            Float talla24 = record.getAsFloat("24");
            Float talla25 = record.getAsFloat("25");
            Float talla26 = record.getAsFloat("26");
            Float talla27 = record.getAsFloat("27");
            Float talla28 = record.getAsFloat("28");
            Float talla29 = record.getAsFloat("29");
            Float talla30 = record.getAsFloat("30");
            Float talla31 = record.getAsFloat("31");
            Float talla32 = record.getAsFloat("32");
            Float talla33 = record.getAsFloat("33");
            Float talla34 = record.getAsFloat("34");
            Float talla35 = record.getAsFloat("35");
            Float talla36 = record.getAsFloat("36");
            Float talla37 = record.getAsFloat("37");
            Float talla38 = record.getAsFloat("38");

            record.set("totalpares", talla14 + talla15 + talla16 + talla17 + talla18 + talla19 + talla20 + talla21 + talla22 + talla23 + talla24 + talla25 + talla26 + talla27 + talla28 + talla29 + talla30 + talla31 + talla32 + talla33 + talla34 + talla35 + talla36 + talla37 + talla38);


            Float totalbs = new Float(0);
            Float totalpa = new Float(0);
            record.set("totalbs", record.getAsFloat("totalpares") * record.getAsFloat("precio"));
            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
                totalbs += grid.getStore().getRecords()[i].getAsFloat("totalbs");
                totalpa += grid.getStore().getRecords()[i].getAsFloat("totalpares");

            }

            tex_totalpares.setValue(totalpa.toString());
            tex_totalcaja.setValue(totalbs.toString());
        }




//        tex_montoPagar.setValue(total.toString());
//        lista1.getStore().reload();
    // lista.getGrid().reconfigure(lista.getStore(), lista.getColumnModel());
    // lista.getGrid().getView().refresh();

    }

    public void closeTabCompraDirecta() {
        Principal.getTabPanel().remove(this.getId(),true);
          this.remove(this.getId(),true);
       
    }

    public void createCalzados(String usuario) {

        String idmarca1 = tex_idmarca.getText();
        String marca1 = tex_marca.getText();
        String numeropedido1 = tex_numeropedido.getValueAsString();
        String modeloCV = com_modeloCV.getValueAsString();
        String totalpares = tex_totalpares.getValueAsString();
        String totalcaja = tex_totalcaja.getValueAsString();
        String descripcion = tea_descripcion.getValueAsString();




        Record[] records = lista1.getStore().getRecords();
        JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();
        compraObject.put("idmarca", new JSONString(idmarca1));
        compraObject.put("marca", new JSONString(marca1));
        compraObject.put("numeropedido", new JSONString(numeropedido1));
        compraObject.put("modeloCV", new JSONString(modeloCV));
        compraObject.put("totalpares", new JSONString(totalpares));
        compraObject.put("totalcaja", new JSONString(totalcaja));
        compraObject.put("descripcion", new JSONString(descripcion));


        for (int i = 0; i < records.length; i++) {

            if (opcion.equalsIgnoreCase("1")) {
                productoObject = new JSONObject();
                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
                productoObject.put("14", new JSONString(records[i].getAsString("14")));
                productoObject.put("15", new JSONString(records[i].getAsString("15")));
                productoObject.put("16", new JSONString(records[i].getAsString("16")));
                productoObject.put("17", new JSONString(records[i].getAsString("17")));
                productoObject.put("18", new JSONString(records[i].getAsString("18")));
                productoObject.put("19", new JSONString(records[i].getAsString("19")));
                productoObject.put("20", new JSONString(records[i].getAsString("20")));
                productoObject.put("21", new JSONString(records[i].getAsString("21")));
                productoObject.put("22", new JSONString(records[i].getAsString("22")));
                productoObject.put("23", new JSONString(records[i].getAsString("23")));
                productoObject.put("24", new JSONString(records[i].getAsString("24")));
                productoObject.put("25", new JSONString(records[i].getAsString("25")));
                productoObject.put("26", new JSONString(records[i].getAsString("26")));
                productoObject.put("27", new JSONString(records[i].getAsString("27")));
                productoObject.put("28", new JSONString(records[i].getAsString("28")));
                productoObject.put("29", new JSONString(records[i].getAsString("29")));
                productoObject.put("30", new JSONString(records[i].getAsString("30")));
                productoObject.put("31", new JSONString(records[i].getAsString("31")));
                productoObject.put("32", new JSONString(records[i].getAsString("32")));
                productoObject.put("33", new JSONString(records[i].getAsString("33")));
                productoObject.put("34", new JSONString(records[i].getAsString("34")));
                productoObject.put("35", new JSONString(records[i].getAsString("35")));
                productoObject.put("36", new JSONString(records[i].getAsString("36")));
                productoObject.put("37", new JSONString(records[i].getAsString("37")));
                productoObject.put("38", new JSONString(records[i].getAsString("38")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("totalbs", new JSONString(records[i].getAsString("totalbs")));
                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productos.set(i, productoObject);
                productoObject = null;

            }
            if (opcion.equalsIgnoreCase("2")) {
                productoObject = new JSONObject();
                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
                productoObject.put("33", new JSONString(records[i].getAsString("33")));
                productoObject.put("34", new JSONString(records[i].getAsString("34")));
                productoObject.put("35", new JSONString(records[i].getAsString("35")));
                productoObject.put("36", new JSONString(records[i].getAsString("36")));
                productoObject.put("37", new JSONString(records[i].getAsString("37")));
                productoObject.put("38", new JSONString(records[i].getAsString("38")));
                productoObject.put("39", new JSONString(records[i].getAsString("39")));
                productoObject.put("40", new JSONString(records[i].getAsString("40")));
                productoObject.put("41", new JSONString(records[i].getAsString("41")));
                productoObject.put("42", new JSONString(records[i].getAsString("42")));
                productoObject.put("43", new JSONString(records[i].getAsString("43")));
                productoObject.put("44", new JSONString(records[i].getAsString("44")));
                productoObject.put("45", new JSONString(records[i].getAsString("45")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("totalbs", new JSONString(records[i].getAsString("totalbs")));
                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productos.set(i, productoObject);
                productoObject = null;
            }


        }

        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);

        String datos = "resultado=" + resultado.toString();

        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "./php/IngresoAlmacen.php?funcion=GuardarNuevoIngreso&" + datos;
        //com.google.gwt.user.client.Window.alert("zzzz" + url);
        final Conector conec = new Conector(url, false, "GET");
        // com.google.gwt.user.client.Window.alert("error 9999 " + conec.toString());
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
                            lista1.LimpiarGrid();
                            closeTabCompraDirecta();
//                            String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
                        //                            String enlTemp = "funcion=reporteventaHTML&idventa=" + idventaG;
                        //                            verReporte(enlTemp);
                        } else {
                            //Window.alert(mensajeR);
//                            com.google.gwt.user.client.Window.alert("error 1000");
                            Utils.setErrorPrincipal(mensajeR, "error");
                        }
                    } else {
//                        com.google.gwt.user.client.Window.alert("error 1001");
                        Utils.setErrorPrincipal("Error en la respuesta del servidor", "error");
                    }
                }

                public void onError(Request request, Throwable exception) {
                    //Window.alert("Ocurrio un error al conectar con el servidor ");
//                    com.google.gwt.user.client.Window.alert("error 1002");
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            });
        } catch (RequestException ex) {
            //Window.alert("Ocurrio un error al conectar con el servidor");
//            com.google.gwt.user.client.Window.alert("error 1003");
            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
        }
    //
    }
}


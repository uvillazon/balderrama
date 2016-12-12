package org.balderrama.client.venta;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.Position;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.data.ArrayReader;
import com.gwtext.client.data.FieldDef;
import com.gwtext.client.data.FloatFieldDef;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.RecordDef;
import com.gwtext.client.data.Store;
import com.gwtext.client.data.StringFieldDef;
import com.gwtext.client.util.DateUtil;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.QuickTipsConfig;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.TabPanel;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.NumberField;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.grid.GridEditor;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import com.gwtext.client.widgets.grid.event.EditorGridListenerAdapter;

import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.ColumnLayout;
import com.gwtext.client.widgets.layout.ColumnLayoutData;
import com.gwtext.client.widgets.layout.FormLayout;
import com.gwtextux.client.data.PagingMemoryProxy;
import java.util.Date;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
//import org.balderrama.client.emergentes.SeleccionVentaFeria;
import org.balderrama.client.util.KMenu;

public class VentaFeria extends Window {
 private FormularioProductoKardex1 for_cliente;
    private final int ANCHO = 600;
    private final int ALTO = 700;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
        private final AnchorLayoutData ANCHO_LAYOUT_DATAFCD = new AnchorLayoutData("95%");
 private final int ANCHOFCD = 950;
    private final int ALTOFCD = 400;
    private final int WINDOW_PADDING = 5;
    private FormPanel for_panel;
    private TextField tex_titulo;
  //  private HtmlEditor html_detalle;
    private Button but_aceptar;
 private Object[][] productoM;
   private TextField tex_idproducto;
    private TextField tex_empleado;
    private TextField tex_codigoBarra;
      private TextField tex_par;
        private TextField tex_sus;
    private DateField dat_fecha;
    private EditorGridPanel grid;
    private Store store;
    private ColumnModel columnModel;
    private BaseColumnConfig[] columns;
    private CheckboxSelectionModel cbSelectionModel;
    boolean respuesta = false;
    private ColumnConfig Columnid;
    private ColumnConfig Columncodigo;
    private ColumnConfig Columnproducto;
    private ColumnConfig Columntalla;
    private ColumnConfig Columncantidad;
    private ColumnConfig Columnpreciobs2;
    private PagingMemoryProxy proxy;
    private RecordDef recordDef;
    private ArrayReader reader;
    private ToolbarButton eliminarEntrega;
   // private Object[][] productoM;
    private Button aceptar;
  //  private Button cancelar;
    private Button listaventas;
    private Button ventadiaria;

    private Float totalcantidad;
    private Float totalBs;
    protected ExtElement ext_element;
    public TabPanel tap_panel;
//    private MostrarAlmacenesWindow formulario_alm;
   // private ListaCompraProducto lista;
    //ToolbarMenuSistema toolbar;
    PagingToolbar pagingToolbar;
    String idtraspaso;
    String idalmacenorigen;
    String idalmacendestino;
    String origen;
    String destino;

    String idempleado;
    String empleado;
    String idproducto;
    String numerodocumento;
    String descripcion;
    String producto;
    String fecha;
    String hora;
    String idalmacen;
    String almacen;
    private Object[][] tiendaM;
    private Object[][] empleadoM;
    private Object clienteC[][];
    private Date fechahoy;
    public Comision formulario2;
  //   public seleccionventafecha formulario21;
  //SeleccionVentaFeria formMTEInventarioventa;


 public VentaFeria() {
        this.productoM = new Object[][]{new Object[]{"kar-0", "", "","", 0, 0}};
        this.setId("win-usuario-venta-nuevo");
        this.setWidth(1000);
        this.setMinWidth(950);
        this.setHeight(550);
        this.setButtonAlign(Position.CENTER);
        this.setCloseAction(Window.CLOSE);
        this.setPlain(true);
        this.setTitle("Venta Simple Unitarios en Bs ");
        this.setCloseAction(Window.CLOSE);
        this.setPlain(true);
        initComponents();
        addListeners();
    }

   public void anadirProductoAVenta(Record[] pr) {
        for (int j = 0; j < pr.length; j++) {
          Record plant = recordDef.createRecord(new Object[]{pr[j].getAsString("idkardexunico"), pr[j].getAsString("codigo"),  pr[j].getAsString("detalle"),  pr[j].getAsString("talla"),1, pr[j].getAsFloat("precio")});
                grid.stopEditing();
                store.insert(0, plant);
                grid.startEditing(0, 0);
                recalcular(true);

          //  }
        }
    }
      private void initComponents() {

        for_panel = new FormPanel();
        for_panel.setLabelWidth(60);
        for_panel.setLabelAlign(Position.LEFT);
        for_panel.setBaseCls("x-plain");

        dat_fecha = new DateField("Fecha", "d-m-Y");
        fechahoy = new Date();
        dat_fecha.setValue(fechahoy);
        dat_fecha.setReadOnly(true);

        Panel topPanel = new Panel();
        topPanel.setLayout(new ColumnLayout());
        topPanel.setBaseCls("x-plain");

        Panel columnOnePanel = new Panel();
        columnOnePanel.setBaseCls("x-plain");
        columnOnePanel.setLayout(new FormLayout());

        Panel columnTwoPanel = new Panel();
        columnTwoPanel.setBaseCls("x-plain");
        columnTwoPanel.setLayout(new FormLayout());

        Panel columnThreePanel = new Panel();
        columnThreePanel.setBaseCls("x-plain");
        columnThreePanel.setLayout(new FormLayout());
     
//        com_empleado = new ComboBox("Vendedor", "empleado");
//
//        com_empleado.focus();
        tex_empleado = new TextField("Vendedor", "empleado");
        tex_codigoBarra = new TextField("CODIGO BARRA", "codigobarra");
        tex_codigoBarra.setDisabled(false);

        columnOnePanel.add(tex_empleado);
       columnOnePanel.add(tex_empleado);
        columnOnePanel.add(tex_codigoBarra, ANCHO_LAYOUT_DATAFCD);


        //tex_descripcion = new TextArea("Obser.", "observacion");
         columnTwoPanel.add(dat_fecha, ANCHO_LAYOUT_DATAFCD);

        //columnTwoPanel.add(tex_descripcion, ANCHO_LAYOUT_DATAFCD);


         tex_par = new TextField("Pares", "pares");
        tex_par.setDisabled(false);
        tex_par.setValue("0");
        tex_sus = new TextField("Total", "sus");
        tex_sus.setDisabled(false);
        tex_sus.setValue("0");
        columnThreePanel.add(tex_par);
        columnThreePanel.add(tex_sus);
        //initCombos();
        topPanel.add(columnOnePanel, new ColumnLayoutData(0.3));
        topPanel.add(columnTwoPanel, new ColumnLayoutData(0.3));
        topPanel.add(columnThreePanel, new ColumnLayoutData(0.3));

        //grilllaempleado
        proxy = new PagingMemoryProxy(productoM);
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idkardextienda"),
                    new StringFieldDef("codigo"),
                    new StringFieldDef("detalle"),
                     new StringFieldDef("talla"),
                    new FloatFieldDef("cantidad"),
                    new FloatFieldDef("precio")
                });
        reader = new ArrayReader(recordDef);

        store = new Store(proxy, reader, true);
        store.load();


        Columnid = new ColumnConfig("Id kardextienda", "idkardextienda", 100, true);

        Columncodigo = new ColumnConfig("Modelo", "codigo", 100, true);

        Columnproducto = new ColumnConfig("Detalle", "detalle", 300, true);
         Columntalla = new ColumnConfig("Talla", "talla", 100, true);
        Columncantidad = new ColumnConfig("Cantidad", "cantidad", 100, true);
       

        Columnpreciobs2 = new ColumnConfig("Precio", "precio", 150, true);
           NumberField numberField = new NumberField();
        numberField.setAllowBlank(false);
        numberField.setAllowNegative(false);
        numberField.setMaxValue(1000);
        Columnpreciobs2.setEditor(new GridEditor(numberField));
        cbSelectionModel = new CheckboxSelectionModel();

        columns = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    Columncodigo,
                    Columnproducto,
                    Columntalla,
                    Columncantidad,
                    Columnpreciobs2,};
        columnModel = new ColumnModel(columns);
        grid = new EditorGridPanel();
        grid.setWidth(900);
        grid.setHeight(330);
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setId("grid-lista-traspaso_producto-555");
        grid.setTitle("Lista de Productos - Venta");
        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No existen datos para mostrarse");
        eliminarEntrega = new ToolbarButton("Quitar");
        eliminarEntrega.setEnableToggle(true);
        QuickTipsConfig tipsConfig8 = new QuickTipsConfig();
        tipsConfig8.setText("Quitar");
        eliminarEntrega.setTooltip(tipsConfig8);

        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarEntrega);
        pagingToolbar.addSeparator();
        grid.setBottomToolbar(pagingToolbar);
       aniadirListenersCompra();


        for_panel.add(topPanel);
        add(for_panel);
        add(grid);
        aceptar = new Button("Confirmar VENTA");
      //  cancelar = new Button("Cancelar");
        listaventas = new Button("Listar Ventas");
        ventadiaria = new Button("Reporte Ventas");
        addButton(aceptar);
       // addButton(cancelar);
         addButton(listaventas);
        //  addButton(ventadiaria);
    }

    private void addListeners() {
        
         this.listaventas.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
              //  guardarTraspaso();
               String enlTemp = "funcion=verventasferia" ;
            verReporte(enlTemp);
            }
        });
         this.ventadiaria.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
              //  guardarTraspaso();
               SeleccionVentaFeriametodo();
            }
        });
       this.aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
              //  guardarTraspaso();
                   final String par = tex_par.getValueAsString().trim();
                  final String sus = tex_sus.getText();
                  String vend = tex_empleado.getValueAsString().trim();
if (!vend.isEmpty()) {

                procesoCredito();  


    } else {
             MessageBox.alert("Asigne Vendedor es obligatorio ");
                }

               

            }
        });
//         this.cancelar.addListener(new ButtonListenerAdapter() {
//
//            @Override
//            public void onClick(Button button, EventObject e) {
//               // guardarTraspaso();
//            LimpiarGrid();
//               clear();
//                destroy();
//                 close();
//
//            }
//        });


    }

private void SeleccionVentaFeriametodo() {
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
//                                formulario21 = new seleccionventafecha(marcaM,estiloM,VentaFeria.this);
//                  formulario21.show();
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
    private void procesoCredito() {
          final String par = tex_par.getValueAsString().trim();
                  final String sus = tex_sus.getText();
     String enlace = "php/VentaFeria.php?funcion=BuscarClientesespecial";
                        Utils.setErrorPrincipal("Cargando parametros ", "cargar");
                        final Conector conec = new Conector(enlace, false);

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
                                            JSONValue resultadoValue = jsonObject.get("resultado");
                                            JSONObject compraObject;
                                            if ((compraObject = resultadoValue.isObject()) != null) {
                              clienteC = Utils.getArrayOfJSONObject(compraObject, "clienteM", new String[]{"idcliente","nombrecliente"});
                  formulario2 = new Comision(clienteC,par,sus,VentaFeria.this);
                  formulario2.show();
                                            } else {
                                                Utils.setErrorPrincipal("No se recuperaron correctamente lo valores de producto", "error");
                                            }

                                        } else {
                                            Utils.setErrorPrincipal(mensajeR, "error");
                                        }
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
public void LimpiarGrid() {
        store.removeAll();

        grid.setStore(store);
        grid.reconfigure(store, columnModel);
}
private void aniadirListenersCompra() {
     tex_empleado.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    tex_codigoBarra.focus();
                }
            }
        });

            tex_codigoBarra.addListener(new TextFieldListenerAdapter() {
            private FormularioProductoKardex1 kardex;
            @Override
            public void onSpecialKey(Field field, EventObject e) {
 if (e.getKey() == EventObject.ENTER) {
        String idproductos = tex_codigoBarra.getValueAsString().trim();
           //findByCodigoProducto(idproductos, vendedor);

 // MessageBox.alert("No hay producto modelo para eliminar y/o selecciono mas de uno.");
   if (idproductos == null || idproductos =="")
     {   showListCliente(idproductos);
              //  MessageBox.alert("No hay"+);
                    } else {
                  findByCodigoProducto(idproductos);
              // MessageBox.alert("No hay producto modelo para eliminar y/o selecciono mas de uno.");
                    }
                }
            }

            public boolean findByCodigoProducto(final String buscando) {
            String vendedor=tex_empleado.getValueAsString().trim();
            String enlace = "php/VentaFeria.php?funcion=buscarcodigobarra&codigo=" + buscando+ "&vendedor="+vendedor;

            Utils.setErrorPrincipal("Cargando parametros del codigo", "cargar");
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
         // String[] nombreComlumns = {"idkardexunico", "idmodelo", "modelo","detalle","talla", "item","cantidad", "preciou","preciocaja"};
                                           String idkardex = Utils.getStringOfJSONObject(marcaO, "idkardexunico");
                                           // String idmodelo = Utils.getStringOfJSONObject(marcaO, "idmodelo");
                                            String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                            String detalle = Utils.getStringOfJSONObject(marcaO, "detalle");
                                            String talla = Utils.getStringOfJSONObject(marcaO, "talla");
                                            //String item = Utils.getStringOfJSONObject(marcaO, "item");
                                            // String cantidad = Utils.getStringOfJSONObject(marcaO, "talla");
                                              String preciou = Utils.getStringOfJSONObject(marcaO, "precio");

  Record registroCompra = recordDef.createRecord(new Object[]{
                                          idkardex, codigo, detalle,talla,'1', preciou});

//                                         for (int j = 0; j < pr.length; j++) {
        //    if (yaExisteElProducto(pr[j].getAsString("idproducto")) == false) {
    //   Record plant = recordDef.createRecord(new Object[]{pr[j].getAsString("idkardexunico"), pr[j].getAsString("codigo"),  pr[j].getAsString("detalle"),  pr[j].getAsString("talla"),1, pr[j].getAsFloat("precio")});
//  Record plant = recordDef.createRecord(new Object[]{pr[j].getAsString("idkardexunico"), pr[j].getAsString("codigo"),  pr[j].getAsString("detalle"),  pr[j].getAsString("talla"),1, pr[j].getAsFloat("precio")});


                grid.stopEditing();
                store.insert(0, registroCompra);
                grid.startEditing(0, 0);
               recalcular(true);

          //  }
  //      }
                                          tex_codigoBarra.setValue("");
                                            tex_codigoBarra.focus();
                                      //    totalTotalV1073 = new Float(tex_montoPagar.getText());
                                    //   montocancelado = new Float(tex_montocancelado.getText());

                                        } else {

                                            //MessageBox.alert("No Hay datos en la consulta");
                                        }

                                    }

                                    else{
                                       //  Utils.setErrorPrincipal(mensajeR, "mensaje");
                                    tex_codigoBarra.setValue("");
                                            tex_codigoBarra.focus();
                                        MessageBox.alert(mensajeR);

                                    }
                                } else {
                                    tex_codigoBarra.setValue("");
                                            tex_codigoBarra.focus();
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

            private void showListCliente(String modelo) {
                for_cliente = new FormularioProductoKardex1(VentaFeria.this,modelo,tex_empleado.getValueAsString());
                for_cliente.show();
            }
        
          });
//
//

        //**************************************************
        //***********REPORTE COMPRA
        //**************************************************

        eliminarEntrega.addListener(new ButtonListenerAdapter() {

            private String selecionado;

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idkardexunico");
                    grid.stopEditing();
                    store.remove(cbSelectionModel.getSelected());
                    grid.startEditing(0, 0);
                    recalcular(true);
                } else {
                    MessageBox.alert("No hay producto modelo para eliminar y/o selecciono mas de uno.");
                }
                eliminarEntrega.setPressed(false);
            }
        });

        grid.addEditorGridListener(new EditorGridListenerAdapter() {

            @Override
            public void onAfterEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
                recalcular(true);
            }
        });
         grid.addGridRowListener(new GridRowListenerAdapter() {

            @Override
            public void onRowDblClick(GridPanel grid, int rowIndex, EventObject e) {
                Record rs = grid.getStore().getRecordAt(rowIndex);
              //  quitarEsteItem(rs);
            }
        });

    }


    public void recuperarAlmacenOrigen(String codigo, String almacen) {

    //    com_almacendestino.focus();

    }

    public void anadirProductoTraspaso(String idproducto, String codigo,String nombre,String talla, String cantidad, String precio1bs) {
//        com.google.gwt.user.client.Window.alert(fecha);


        Record plant;

        plant = recordDef.createRecord(new Object[]{idproducto,codigo, nombre, talla,new Float("0"), new Float("0")});

        grid.stopEditing();
        store.insert(0, plant);
    }

    public void guardarventafin(String nit,String cliente) {

              String vendedorferia = tex_empleado.getText();
            String totalpares = tex_par.getText();
            String totalbs = tex_sus.getText();
            String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
        Record[] records = grid.getStore().getRecords();
     //   Record[] records = lista2.getStore().getRecords();
        JSONArray productos = new JSONArray();
        JSONObject productoObject;
 String idmarca="mar-57";
 String totalcaja="1";
 String vendedor="emp-92";
 String tipocambio="6.96";
        JSONObject compraObject = new JSONObject();
        compraObject.put("idmarca", new JSONString(idmarca));
      //  compraObject.put("boleta", new JSONString(boleta));
        compraObject.put("fecharegistro", new JSONString(fechaent));
        compraObject.put("totalpares", new JSONString(totalpares));
        compraObject.put("totalbs", new JSONString(totalbs));
        compraObject.put("totalcaja", new JSONString(totalcaja));
         compraObject.put("totalsus", new JSONString(totalbs));
        compraObject.put("vendedorferia", new JSONString(vendedorferia));
         compraObject.put("cliente", new JSONString(cliente));
          compraObject.put("nit", new JSONString(nit));
          compraObject.put("vendedor", new JSONString(vendedor));
           compraObject.put("tipocambio", new JSONString(tipocambio));
       //     compraObject.put("boletamanual", new JSONString(boletamanual));
//        compraObject.put("fecha", new JSON(date));

        for (int i = 0; i < records.length; i++) {
if (!records[i].getAsString("idkardextienda").equalsIgnoreCase("kar-0")) {
                productoObject = new JSONObject();
                  productoObject.put("idkardexunico", new JSONString(records[i].getAsString("idkardextienda")));
                  productoObject.put("cantidad", new JSONString(records[i].getAsString("cantidad")));
                  productoObject.put("preciou", new JSONString(records[i].getAsString("precio")));

                productos.set(i, productoObject);
                productoObject = null;
  }
        }

        JSONObject resultado = new JSONObject();
        resultado.put("venta", compraObject);
        resultado.put("productos", productos);
        String datos = "resultado=" + resultado.toString();
       Utils.setErrorPrincipal("registrando datos", "guardar");
        String url = "./php/VentaFeria.php?funcion=guardarventasferia&" + datos;
        final Conector conec = new Conector(url, false, "POST");
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
                            Utils.setErrorPrincipal(mensajeR, "resultado");
                         //  Window.alert(mensajeR);
                        String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
  //                                String enlTemp = "funcion=ventasimpleHTML&idventa=" + idventaG;
//                                verReporte(enlTemp);

                                cargarDatosfacturacion(idventaG);
 LimpiarGrid();
               clear();
                destroy();
                 close();
                        } else {
                            Utils.setErrorPrincipal(mensajeR, "error");
                        }
                    } else {
                        Utils.setErrorPrincipal("Error en la respuesta del servidor", "error");
                    }
                }

                public void onError(Request request, Throwable exception) {
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }



            });
        } catch (RequestException ex) {
            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
        }
//    }else{
//     MessageBox.alert("Por favor revise campo Cliente nunca use el -> / en la insercion del nombre del cliente");
//         }
  }

    public void recuperarAlmacenDestino(String codigo, String almacen) {
        tex_idproducto.focus();

//                            lanzarWindowBuscarProducto();
//                            lanzarWindowBuscarProducto();


    }
    private void cargarDatosfacturacion(final String idventa) {
        String enlace = "php/VentaFeria.php?funcion=BuscarDatosFacturaFeria&idventadetalle=" + idventa;
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
                                    //  String marca = Utils.getStringOfJSONObject(marcaO, "marca");
                                    String totalpares = Utils.getStringOfJSONObject(marcaO, "totalpares");
                                    String monto = Utils.getStringOfJSONObject(marcaO, "totalsus");
                                    String cliente = Utils.getStringOfJSONObject(marcaO, "cliente");
                                    String marca = Utils.getStringOfJSONObject(marcaO, "marca");
                                    String tipocalzado = Utils.getStringOfJSONObject(marcaO, "tipocalzado");
                                    String idalmacen = Utils.getStringOfJSONObject(marcaO, "idalmacen");
                                    String idusuario = Utils.getStringOfJSONObject(marcaO, "idusuario");
                                    String idusuariocaja = Utils.getStringOfJSONObject(marcaO, "idusuariocaja");
                                    String nit = Utils.getStringOfJSONObject(marcaO, "nit");
                               //     String enlTemp = "http://localhost:8080/facturacion/php/inicioventa.php?idventa=" + idventa + "&pares=" + totalpares + "&monto=" + monto + "&cliente=" + cliente + "&marca=" + marca + "&tipocalzado=" + tipocalzado + "&idalmacen=" + idalmacen + "&idusuario=" + idusuario + "&nit=" + nit;
                                 String enlTemp = "http://sistema.novamoda.com.bo/mayor/php/inicioventa.php?idventa=" + idventa + "&pares=" + totalpares + "&monto=" + monto + "&cliente=" + cliente + "&marca=" + marca + "&tipocalzado=" + tipocalzado + "&idalmacen=" + idalmacen + "&idusuario=" + idusuario + "&nit=" + nit + "&idusuariocaja=" + idusuariocaja;
                                    com.google.gwt.user.client.Window.open(enlTemp, "_blank", "enlTemp");
//   PanelPedidoConfirmado1 cliente = new PanelPedidoConfirmado1(idventa, totalpares, totalbs, totalcajas ,marcanombre, boleta, idvendedor,vendedor,idcliente,nomcliente,fecha,fechalimite,hora,tipocambio,clientesM,vendedorM,ListaVenta.this,padre);
//s
//  padre.seleccionarOpcion(null, "fun16089", e, cliente);

                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente", "mensaje");
                                } else {
                                    MessageBox.alert("No Hay datos en la consulta");
                                }
                            } else {
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
 private void recalcular(boolean desc) {
 totalcantidad = new Float(0);
        totalBs = new Float(0);
       // totalTotalV = new Float(0);
        Record[] recs = grid.getStore().getRecords();
        for (int i = 0; i < recs.length; i++) {
             String idCuenta = recs[i].getAsString("idkardexunico");
            Float cant = recs[i].getAsFloat("cantidad");
             totalcantidad += cant;
               Float pre = recs[i].getAsFloat("precio");
                 totalBs += pre;

            tex_par.setValue(totalcantidad.toString());
                 tex_sus.setValue(totalBs.toString());
        }
       
    }


    private void quitarEsteItem(Record quitar) {
        store.remove(quitar);

        store.reload();
        grid.setStore(store);
        grid.reconfigure(store, columnModel);
        grid.getView().refresh();
        recalcular(true);
    }

    private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }

 public RecordDef getRecordDef() {
        return recordDef;
    }


      


}
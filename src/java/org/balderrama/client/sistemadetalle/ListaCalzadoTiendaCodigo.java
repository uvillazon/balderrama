/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Component;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.QuickTipsConfig;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.event.PanelListenerAdapter;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.UrlParam;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.data.*;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.widgets.Toolbar;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.NumberField;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;

/**
 *
 * @author example
 */
public class ListaCalzadoTiendaCodigo {

    private EditorGridPanel grid;
   // private final int ALTO = 355;
  //   private final int ALTO = Utils.getScreenHeight() - 270;
         private final int ALTO = 510;
    private ToolbarButton eliminarProducto;
      private ToolbarButton seleccionarProducto;
      private ToolbarButton registrarProducto;
        private ToolbarButton nuevoProducto;
    PagingToolbar pagingToolbar1124;
    String selecionado1124 = "";
 //    private String[] coleccionM;
  // private ComboBox com_coleccion;
//    private String[] estiloM;
   private ComboBox com_estilo;
    protected String buscarCodigo;
    protected String buscarMarca;
    protected String buscarAnio;
    private String idmarca;
    private String nombrem;
    private TextField tex_codigo;
    private TextField tex_marca;
    private TextField tex_anio;
    private Toolbar too_busquedaCBWW;
    private ToolbarButton too_buscarCBWW;
    protected ExtElement ext_element;
    private CheckboxSelectionModel cbSelectionModel;
    private Store store;
     private ColumnConfig idColumn;
    private BaseColumnConfig[] columns;
    private ColumnModel columnModel;
    protected String buscaCodigo;
    protected String buscarNombre;
    private DataProxy dataProxy;
    private JsonReader reader;
    PagingToolbar pagingToolbar;
    String selecionado = "";
    String total = "";
    private Panel panel;
    private ColumnConfig codigoColumn;
    private ColumnConfig colorColumn;
    private ColumnConfig materialColumn;
    private ColumnConfig lineaColumn;
    private ColumnConfig stylenameColumn;
    private ColumnConfig clienteColumn;
    private ColumnConfig vendedorColumn;
    private ColumnConfig totalparesColumn;
    private ColumnConfig totalcajasColumn;
    private ColumnConfig precioColumn;
    private ColumnConfig preciototalColumn;

    private ColumnConfig talla1Column;
    private ColumnConfig talla1mColumn;
    private ColumnConfig talla2Column;
    private ColumnConfig talla2mColumn;
    private ColumnConfig talla3Column;
     private ColumnConfig talla4Column;
    private ColumnConfig talla3mColumn;
    
    private ColumnConfig totalColumn;
    private ColumnConfig tipoventaColumn;
    private ColorPedido colorpedido;
    private MaterialPedido materialpedido;
      private Object[][] modeloMO;
   //    private Object[][] tallaM;
    private String idpedido;
      private String nombremarca;
     //  private String nombreestilo;
    //    private String idestilo;
     private String opcion;
    //clienteM = nombreCaso3Columns[2];
    String[] nombreCaso7Columns = {"idkardexunico", "idkardexdetalle", "modelo","color","material", "preciounitario", "tallakardex", "cantidad","codigobarra"};

    private RecordDef recordDef;

    private ColumnConfig coleccionColumn;

 public void onModuleLoad(String idmarcam, String nombrem, Object[][] estilo) {
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        // this.coleccionMO = coleccion;
    //      this.tallaM = tall;
        this.modeloMO = estilo;
        this.idmarca = idmarcam;
     
        this.nombremarca = nombrem;
      //  this.idesti = estilom;
//         this.nombreestilo = estilom;
// dataProxy = new ScriptTagProxy("");
dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetalleIngresoTalla&idmarca=" + idmarca);

 recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso7Columns[0]),
                    new StringFieldDef(nombreCaso7Columns[1]),
                    new StringFieldDef(nombreCaso7Columns[2]),
                    new StringFieldDef(nombreCaso7Columns[3]),
                    new StringFieldDef(nombreCaso7Columns[4]),
                    new StringFieldDef(nombreCaso7Columns[5]),
                    new StringFieldDef(nombreCaso7Columns[6]),
                    new StringFieldDef(nombreCaso7Columns[7]),
                    new StringFieldDef(nombreCaso7Columns[8])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);

        idColumn = new ColumnConfig("Id detalleingreso", nombreCaso7Columns[0], 20, true);
        lineaColumn = new ColumnConfig("id modelo", nombreCaso7Columns[1], 80, true);
       // precioColumn = new ColumnConfig("iddetalleingresotalla", nombreCaso7Columns[2], 55, true);
        talla3Column = new ColumnConfig("Modelo", nombreCaso7Columns[2], 100, true, null);
        talla4Column = new ColumnConfig("Color", nombreCaso7Columns[3], 150, true, null);
        talla1Column = new ColumnConfig("Material", nombreCaso7Columns[4], 150, true, null);

        talla1mColumn = new ColumnConfig("Precio", nombreCaso7Columns[5], 75, true, null);
        talla2Column = new ColumnConfig("Talla", nombreCaso7Columns[6], 75, true, null);
        talla2mColumn = new ColumnConfig("Cantidad", nombreCaso7Columns[7], 80, true, null);
         talla3mColumn = new ColumnConfig("Codigobarra", nombreCaso7Columns[8], 150, true, null);
        //colorColumn.setEditor(new GridEditor(metodoFeli()));
       // talla2Column.setEditor(new GridEditor(metodoFeli()));
// talla2mColumn.setEditor(new GridEditor(metodoFeli()));
        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    //lineaColumn,
                    //precioColumn,
                    talla3Column,
                      talla4Column,
                    talla1Column,
                    talla1mColumn,
                    talla2Column,
                    talla2mColumn,
                    talla3mColumn
                };

        columnModel = new ColumnModel(columns);

       grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
     grid.setWidth("100%");
        grid.setHeight(ALTO - 60);
               grid.setTitle("Ingresos en Kardex/ Marca " + nombremarca);
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

      seleccionarProducto = new ToolbarButton("Seleccionar/ para cod barra");
        seleccionarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        seleccionarProducto.setTooltip(tipsConfig3);

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);

 registrarProducto = new ToolbarButton("Lista Codigos Seleccion");
        registrarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig31 = new QuickTipsConfig();
        tipsConfig31.setText("Registrar pares faltante(s)");
        registrarProducto.setTooltip(tipsConfig31);
       
nuevoProducto = new ToolbarButton("Lista Marca Modelo");
        nuevoProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig311 = new QuickTipsConfig();
        tipsConfig311.setText("Registrar pares en talla faltante");
        nuevoProducto.setTooltip(tipsConfig311);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
        pagingToolbar.addSeparator();
         pagingToolbar.addButton(seleccionarProducto);
          pagingToolbar.addSeparator();
         pagingToolbar.addButton(registrarProducto);
        pagingToolbar.addSeparator();
         pagingToolbar.addButton(nuevoProducto);

        //buscador
   too_busquedaCBWW = new Toolbar();

      //  com_coleccion = new ComboBox("Coleccion", "coleccion");
        com_estilo = new ComboBox("Modelo", "modelo");

        too_buscarCBWW = new ToolbarButton("Buscar");
        too_buscarCBWW.setPressed(true);

 //       too_busquedaCBWW.addText("Coleccion:");
 //too_busquedaCBWW.addField(com_coleccion);
  too_busquedaCBWW.addText("Modelo:");
too_busquedaCBWW.addField(com_estilo);


        too_busquedaCBWW.addButton(too_buscarCBWW);
        grid.setTopToolbar(too_busquedaCBWW);


        grid.setBottomToolbar(pagingToolbar);
        aniadirListenersProducto();
        panel.add(grid);
       recuperarAlmacenes();
          aniadirListenersBuscador();
        aniadirListenersBuscadoresText();
        
    }


   

    public NumberField metodoFeli() {


        NumberField num_field1 = new NumberField();
        num_field1.setAllowDecimals(false);
        num_field1.setAllowBlank(false);

        num_field1.setAllowNegative(false);

        return num_field1;
    }

    public EditorGridPanel getGrid() {
        return grid;
    }

    public void setGrid(EditorGridPanel grid) {
        this.grid = grid;
    }

    public Panel getPanel() {
        return panel;
    }

    public void aniadirListenersBuscador() {

                too_buscarCBWW.addListener(new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Utils.setErrorPrincipal("Se realizo la busqueda", "mensaje");
                        buscarSegunParametros();
                    }
                });
            }

         public void aniadirListenersBuscadoresText() {

             
 com_estilo.addListener(new TextFieldListenerAdapter() {

                    @Override
                    public void onSpecialKey(Field field, EventObject e) {
                        if (e.getKey() == EventObject.ENTER) {
                            buscarSegunParametros();
                        //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 2");
                        }
                    }
                });

            }
  public void buscarSegunParametros() {
                store.reload(new UrlParam[]{new UrlParam("start", 0), new UrlParam("limit", 100),
                            new UrlParam("buscarmodelo", com_estilo.getText())}, false);
    //store.reload(new UrlParam[]{new UrlParam("start", 0), new UrlParam("limit", 100),
     //                       new UrlParam("buscarcoleccion", com_coleccion.getText()),new UrlParam("buscarmodelo", com_estilo.getText())}, false);

  }

    private void aniadirListenersProducto() {
        //**************************************************
        //***********ELIMINAR PRODUCTO
        //**************************************************

        eliminarProducto.addListener(new ButtonListenerAdapter() {
            private boolean procederAEliminar;
            int repeat = 0;
//modseleccion
            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("iddetalleingreso");
                    grid.stopEditing();
                    store.remove(cbSelectionModel.getSelected());
                    grid.startEditing(0, 0);
                    

                } else {
                    MessageBox.alert("No hay producto seleccionado para quitar y/o selecciono mas de uno.");
                }

                eliminarProducto.setPressed(false);
            }
        });


          
    nuevoProducto.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
      //  String idmarca = com_marca.getValue();
        String modelo = com_estilo.getValue();
      String enlace = "funcion=imprimirlistacodigospormodelo&idmarca=" + idmarca + "&modelo="+ modelo;
               verReporte(enlace);
nuevoProducto.setPressed(false);
            }
        });
         registrarProducto.addListener(new ButtonListenerAdapter() {

            private boolean procederAEliminar;
            int repeat = 0;
            Record[] records;

            @Override
            public void onClick(Button button, EventObject e) {
                records = cbSelectionModel.getSelections();

                //Record[] cambiados = grid.getStore().getModifiedRecords();

                if (records.length > 0) {

            JSONObject compraObject = new JSONObject();

        compraObject.put("idmarca", new JSONString(idmarca));
       // compraObject.put("idestilo", new JSONString(idestilo));

                                JSONArray productos = new JSONArray();
                                JSONObject productoObject;

                                for (int i = 0; i < records.length; i++) {
                                    productoObject = new JSONObject();
                             productoObject.put("idkardexunico", new JSONString(records[i].getAsString("idkardexunico")));
                             productoObject.put("idkardexdetalle", new JSONString(records[i].getAsString("idkardexdetalle")));

                             productoObject.put("tallakardex", new JSONString(records[i].getAsString("tallakardex")));
                               productoObject.put("cantidad", new JSONString(records[i].getAsString("cantidad")));
    
                                        productos.set(i, productoObject);
                                        productoObject = null;
                            }
        JSONObject resultado = new JSONObject();
        resultado.put("v", compraObject);
        resultado.put("p", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("generando", "cargar");
        String url;
      //  url = "funcion=imprimirmodeloestilotallabarra&" + datos;
        url = "funcion=imprimirlistacodigos&" + datos;

        verReporte(url);
                } else {
                    MessageBox.alert("No hay producto selecionado y/o selecciono mas de uno.");
                }
                registrarProducto.setPressed(false);
            }
        });
  seleccionarProducto.addListener(new ButtonListenerAdapter() {

            private boolean procederAEliminar;
            int repeat = 0;
            Record[] records;

            @Override
            public void onClick(Button button, EventObject e) {
                records = cbSelectionModel.getSelections();

                //Record[] cambiados = grid.getStore().getModifiedRecords();

                if (records.length > 0) {
                        MessageBox.confirm("Para cod Barras", "Realmente desea seleccionar " + records.length + " item(s)? ", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {



            JSONObject compraObject = new JSONObject();

        compraObject.put("idmarca", new JSONString(idmarca));
       // compraObject.put("idestilo", new JSONString(idestilo));

                                JSONArray productos = new JSONArray();
                                JSONObject productoObject;

                                for (int i = 0; i < records.length; i++) {
                                    productoObject = new JSONObject();
                             productoObject.put("idkardexunico", new JSONString(records[i].getAsString("idkardexunico")));
                             productoObject.put("idkardexdetalle", new JSONString(records[i].getAsString("idkardexdetalle")));

                             productoObject.put("tallakardex", new JSONString(records[i].getAsString("tallakardex")));
                               productoObject.put("cantidad", new JSONString(records[i].getAsString("cantidad")));
     //productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
     //  productoObject.put("codigobarra", new JSONString(records[i].getAsString("codigobarra")));

                                        productos.set(i, productoObject);
                                        productoObject = null;
                            }
        JSONObject resultado = new JSONObject();
        resultado.put("v", compraObject);
        resultado.put("p", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("generando", "cargar");
        String url;
        url = "funcion=imprimirmodeloestilotallabarra&" + datos;
       // url = "funcion=imprimirmodeloestilotalla&" + datos;

        verReporte(url);
                            }
                        }
                    });
                } else {
                    MessageBox.alert("No hay producto selecionado y/o selecciono mas de uno.");
                }
                seleccionarProducto.setPressed(false);
            }
        });


        //**************************************************
        //*********** LISTENERS DE LA TABLA
        //**************************************************
        grid.addListener(
                new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store.load(0, 100);
                    }
                });


    }
// String[] nombreCaso7Columns = {"iddetalleingreso", "idmodelo", "iddetalleingresotalla","modelo","detalle", "precio", "talla", "cantidad","codigobarra"};

  public void createPedido() {
        Record[] records = grid.getStore().getModifiedRecords();
   JSONArray productos = new JSONArray();
        JSONObject productoObject;
        JSONObject compraObject = new JSONObject();
        compraObject.put("idmarca", new JSONString(idmarca));
    //    compraObject.put("idestilo", new JSONString(idestilo));
        for (int i = 0; i < records.length; i++) {
                                    productoObject = new JSONObject();
                                    productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                    productoObject.put("iddetalleingresotalla", new JSONString(records[i].getAsString("iddetalleingresotalla")));

                                    productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
                                    productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                                    productoObject.put("cantidad", new JSONString(records[i].getAsString("cantidad")));
                                    productoObject.put("codigobarra", new JSONString(records[i].getAsString("codigobarra")));
                                    productos.set(i, productoObject);
                                    productoObject = null;
                                }
        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "./php/IngresoAlmacen.php?funcion=txNewIngresoCodigoBarra&" + datos;

        final Conector conec = new Conector(url, false, "POST");
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
                             String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
        //                    lista1.LimpiarGrid();
    grid.getStore().reload();
                            Utils.setErrorPrincipal(mensajeR, "mensaje");
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
    //
    }
   public void createTalla() {
        Record[] records = grid.getStore().getModifiedRecords();
   JSONArray productos = new JSONArray();
        JSONObject productoObject;
        JSONObject compraObject = new JSONObject();
        compraObject.put("idmarca", new JSONString(idmarca));
       // compraObject.put("idestilo", new JSONString(idestilo));
        for (int i = 0; i < records.length; i++) {
                                    productoObject = new JSONObject();
                                    productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                    productoObject.put("iddetalleingresotalla", new JSONString(records[i].getAsString("iddetalleingresotalla")));
                                    productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
                                    productoObject.put("talla", new JSONString(records[i].getAsString("talla")));

                                    productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                                    productoObject.put("cantidad", new JSONString(records[i].getAsString("cantidad")));
                                   // productoObject.put("codigobarra", new JSONString(records[i].getAsString("codigobarra")));
                                    productos.set(i, productoObject);
                                    productoObject = null;
                                }
        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "./php/IngresoAlmacen.php?funcion=txNewIngresoCodigoBarraNuevo&" + datos;

        final Conector conec = new Conector(url, false, "POST");
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
                             String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
        //                    lista1.LimpiarGrid();
    grid.getStore().reload();
                            Utils.setErrorPrincipal(mensajeR, "mensaje");
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
    //
    }
    private void quitarEsteItem(Record quitar) {

        store.remove(quitar);
        grid.setStore(store);
        grid.startEditing(0, 0);
    }
  public void initDescuentoEspecial(String opcion) {

//if (opcion.equalsIgnoreCase("1")) {
//             tipoalmacenM = new String[]{"0", "5", "4", "3"};
 //       SimpleStore tiposStore = new SimpleStore("desuentoporcentaje", tipoalmacenM);
  //      tiposStore.load();

   }

    public RecordDef getRecordDef() {
        return recordDef;
    }

    public void LimpiarGrid() {
        store.removeAll();

        grid.setStore(store);
        grid.reconfigure(store, columnModel);

    }

    public Store getStore() {
        return store;
    }

    public Record[] getRecords() {
        Record[] records = cbSelectionModel.getSelections();
        return records;
    }

    public ColumnModel getColumnModel() {
        return columnModel;
    }
   private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
    private void recuperarAlmacenes() {
    
        com_estilo.setDisplayField("codigo");
        com_estilo.setValueField("codigo");
        com_estilo.setForceSelection(true);
        com_estilo.setMinChars(1);
        com_estilo.setMode(ComboBox.LOCAL);
        com_estilo.setFieldLabel("codigo");
        com_estilo.setEmptyText("Seleccione un Modelo");
        com_estilo.setLoadingText("Buscando");
        com_estilo.setTypeAhead(true);
        com_estilo.setSelectOnFocus(true);
        com_estilo.setHideTrigger(true);
    
        SimpleStore proveedorStore1 = new SimpleStore(new String[]{"idmodelo","codigo"}, modeloMO);
        proveedorStore1.load();
        com_estilo.setStore(proveedorStore1);

    }



}
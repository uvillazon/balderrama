/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.venta;

//import org.tiendab.client.almacen.producto.*;
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
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.QuickTipsConfig;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.event.PanelListenerAdapter;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.grid.GridPanel;
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
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.NumberField;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.grid.GridEditor;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import com.gwtext.client.widgets.grid.event.*;
import org.balderrama.client.util.BuscadorToolBar;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
/**
 *
 * @author example
 */
public class ListaParesVentaSimple {

  private EditorGridPanel grid;
    private String ANCHO = "100%";
    private String ALTO = "400px";
    protected ExtElement ext_element;
    private CheckboxSelectionModel cbSelectionModel;
    private Store store;
    private ColumnConfig idColumn;
     private ToolbarButton eliminarProducto;
      private ToolbarButton soloimprimir;
    private BaseColumnConfig[] columns;
    private ColumnModel columnModel;
    private BuscadorToolBar buscadorToolBar;
    protected String buscarCodigo;
    protected String buscarNombre;
    protected String buscarCategoria;
    private ToolbarButton buscar;
    private DataProxy dataProxy;
    private JsonReader reader;
    PagingToolbar pagingToolbar;
    String selecionado = "";
    private Panel panel;
    private ColumnConfig codigoColumn;
    private ColumnConfig proveedorColumn;
    private ColumnConfig nombreColumn;
    private ColumnConfig cantidadColumn;
    private ColumnConfig precioColumn;
    private ColumnConfig precio2Column;
    private ColumnConfig unidadColumn;
    private ColumnConfig estiloColumn;
    private String nombreArchivo;
    private String condicionBusqueda;
    //private ColumnConfig unidadColumn;
    private RecordDef recordDef;
    boolean setTopToobar = true;
   //    private ColumnConfig codigoColumn;
    private ColumnConfig colorColumn;
    private ColumnConfig materialColumn;
    private ColumnConfig lineaColumn;
      private ColumnConfig coleccionColumn;
    private ColumnConfig totalparesColumn;
       private ColumnConfig totalbsColumn;
    private ColumnConfig totalcajasColumn;
    private ColumnConfig talla1Column;
    private ColumnConfig talla1mColumn;
    private ColumnConfig talla2Column;
    private ColumnConfig talla2mColumn;
    private ColumnConfig talla3Column;
    private ColumnConfig talla3mColumn;
    private ColumnConfig talla4Column;
    private ColumnConfig talla4mColumn;
    private ColumnConfig talla5Column;
    private ColumnConfig talla5mColumn;
    private ColumnConfig talla6Column;
    private ColumnConfig talla6mColumn;
    private ColumnConfig talla7Column;
    private ColumnConfig talla7mColumn;
    private ColumnConfig talla8Column;
    private ColumnConfig talla8mColumn;
    private ColumnConfig talla9Column;
    private ColumnConfig talla9mColumn;
    private ColumnConfig talla10Column;
    private ColumnConfig talla10mColumn;
    private ColumnConfig talla11Column;
    private ColumnConfig talla11mColumn;
    private ColumnConfig talla12Column;
    private ColumnConfig talla12mColumn;
    private ColumnConfig talla14Column;
    private ColumnConfig talla15Column;
    private ColumnConfig talla16Column;
    private ColumnConfig talla17Column;
    private ColumnConfig talla18Column;
    private ColumnConfig talla19Column;
    private ColumnConfig talla20Column;
    private ColumnConfig talla21Column;
    private ColumnConfig talla22Column;
    private ColumnConfig talla23Column;
    private ColumnConfig talla24Column;
    private ColumnConfig talla25Column;
    private ColumnConfig talla26Column;
    private ColumnConfig talla27Column;
    private ColumnConfig talla28Column;
    private ColumnConfig talla29Column;
    private ColumnConfig talla30Column;
    private ColumnConfig talla31Column;
    private ColumnConfig talla32Column;
    private ColumnConfig talla33Column;
    private ColumnConfig talla34Column;
    private ColumnConfig talla35Column;
    private ColumnConfig talla36Column;
    private ColumnConfig talla37Column;
    private ColumnConfig talla38Column;
    private FormularioKardexVenta padred1;
String[] nombreCaso4Columns = {"idmodelo", "iditemventa","codigo", "cajas","preciosus",  "totalpares","totalsus"};
String idventa;
    
    public ListaParesVentaSimple(String nombreArchivo,FormularioKardexVenta padre) {
        this.nombreArchivo = nombreArchivo;
        this.padred1 =padre;
    }

    public ListaParesVentaSimple(String nombreArchivo, boolean setTopToobar) {
        this.setTopToobar = setTopToobar;
        this.nombreArchivo = nombreArchivo;
    }

    public ListaParesVentaSimple(String nombreArchivo, String condicionBusqueda) {
        this.nombreArchivo = nombreArchivo;
        this.condicionBusqueda = condicionBusqueda;
    }

    public ListaParesVentaSimple(String nombreArchivo, String ancho, String alto) {
        this.nombreArchivo = nombreArchivo;
        this.ANCHO = ancho;
        this.ALTO = alto;

    }

    public ListaParesVentaSimple(String nombreArchivo) {
        this.nombreArchivo = nombreArchivo;
     //   this.padred1 =padre;
    }

 
    public void onModuleLoad(String idventa) {
        this.idventa =idventa;
        panel = new Panel();
  //String[] nombreCaso4Columns = {"idmodelo", "iditemventa","codigo", "cajas","preciosus",  "totalpares","totalsus"};

        dataProxy = new ScriptTagProxy(nombreArchivo);
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso4Columns[0]),
                    new StringFieldDef(nombreCaso4Columns[1]),
                    new StringFieldDef(nombreCaso4Columns[2]),
                    new FloatFieldDef(nombreCaso4Columns[3]),
                    new FloatFieldDef(nombreCaso4Columns[4]),
                    new FloatFieldDef(nombreCaso4Columns[5]),
                    new FloatFieldDef(nombreCaso4Columns[6])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
         idColumn = new ColumnConfig("Id modelo", nombreCaso4Columns[0], 20, true);
        lineaColumn = new ColumnConfig("item", nombreCaso4Columns[1], 50, true);

        codigoColumn = new ColumnConfig("Modelo", nombreCaso4Columns[2], 120, true);
         colorColumn = new ColumnConfig("Cajas", nombreCaso4Columns[3], 70, true);
          coleccionColumn = new ColumnConfig("Preciosus", nombreCaso4Columns[4], 50, true);


         precioColumn = new ColumnConfig("totalpares", nombreCaso4Columns[5], 60, true);
        totalparesColumn = new ColumnConfig("totalsus", nombreCaso4Columns[6], 60, true, null);
  NumberField numberField = new NumberField();
        numberField.setAllowBlank(false);
        numberField.setAllowNegative(false);
        numberField.setMaxValue(1000);
        totalparesColumn.setEditor(new GridEditor(numberField));
         cbSelectionModel = new CheckboxSelectionModel();

        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    lineaColumn,
                    codigoColumn,
                    colorColumn,
                    coleccionColumn,
                    precioColumn,
                    totalparesColumn
                };

        columnModel = new ColumnModel(columns);

           grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Calzados");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(false);
        grid.setClicksToEdit(1);
           eliminarProducto = new ToolbarButton("Modificar e Imprimir");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Modificando algunos valores");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);

        soloimprimir = new ToolbarButton("Solo Imprimir");
        soloimprimir.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig21.setText("Todo esta ok");
        //tipsConfig.setTitle("Tip Title");
        soloimprimir.setTooltip(tipsConfig21);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No existen productos para mostrar");
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
 pagingToolbar.addSeparator();
     pagingToolbar.addButton(soloimprimir);
 pagingToolbar.addSeparator();

        String items[] = {"Código", "Detalle", "Talla"};
        buscadorToolBar = new BuscadorToolBar(items);
        Toolbar topToolBar = buscadorToolBar.getToolbar();
        if (setTopToobar) {
            grid.setTopToolbar(topToolBar);
        }
        grid.setBottomToolbar(pagingToolbar);
        buscar = buscadorToolBar.getBuscar();
        buscadorToolBar.getItemsText1().focus();
      addListenersBuscador();
        addListenersBuscadoresText();
        aniadirListenersProducto();
        panel.add(grid);

    }

    public GridPanel getGrid() {
        return grid;
    }

     public void setGrid(EditorGridPanel grid) {
        this.grid = grid;
    }

    public Panel getPanel() {
        return panel;
    }
 public NumberField metodoFeli() {


        NumberField num_field1 = new NumberField();
        num_field1.setAllowDecimals(false);
        num_field1.setAllowBlank(false);

        num_field1.setAllowNegative(false);

        return num_field1;
    }
    private void aniadirListenersProducto() {
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
        grid.addGridCellListener(
                new GridCellListenerAdapter() {

                    @Override
                    public void onCellClick(GridPanel grid, int rowIndex, int colIndex, EventObject e) {
                        if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor")) {
                            Record record = grid.getStore().getAt(rowIndex);
                            record.set("indoor", !record.getAsBoolean("indoor"));
                        }

                    }
                });
        soloimprimir.addListener(new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
             // Record[] records =   grid.getStore().getModifiedRecords();

                        String enlTemp = "funcion=verboletaventa&idventa=" + idventa;
                        verReporte(enlTemp);
                     //  grid.clear();
                    //    grid.cl
                  
                soloimprimir.setPressed(false);
            }
        });

         eliminarProducto.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
              Record[] records =   grid.getStore().getModifiedRecords();
//

       // Record[] records = lista1.getStore().getRecords();
        JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();
        compraObject.put("idventa", new JSONString(idventa));


        for (int i = 0; i < records.length; i++) {
            //accesorios

        productoObject = new JSONObject();
             //String[] nombreCaso11Columns = {"idmodelo","codigo", "color","cliente", "totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45","totalpares","totalparescaja",  "totalparesbs"};

                productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
                productoObject.put("iditemventa", new JSONString(records[i].getAsString("iditemventa")));
                productoObject.put("preciosus", new JSONString(records[i].getAsString("preciosus")));
                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productoObject.put("totalsus", new JSONString(records[i].getAsString("totalsus")));
                    productos.set(i, productoObject);
                productoObject = null;
        }

        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
        //  Window.alert(resultado.toString());

        String url = "./php/VentaMayor.php?funcion=ConfirmarVenta&" + datos;
   //com.google.gwt.user.client.Window.alert("zzzz" + url);
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
                            Utils.setErrorPrincipal(mensajeR, "mensaje");

                        String enlTemp = "funcion=verboletaventa&idventa=" + idventa;
                        verReporte(enlTemp);
//   padred1.closeFormulario();
                        } else {
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
                eliminarProducto.setPressed(false);
            }
        });
    }
 private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
    public void buscarSegunParametros() {
        buscarCodigo = buscadorToolBar.getItemsText1().getText();
        buscarNombre = buscadorToolBar.getItemsText2().getText();
        buscarCategoria = buscadorToolBar.getItemsText3().getText();
        if (condicionBusqueda != null && condicionBusqueda.equalsIgnoreCase("proveedor")) {
            store.reload(new UrlParam[]{
                        new UrlParam("start", 0),
                        new UrlParam("limit", 100),
                        new UrlParam("noincluyeproveedor", "true"),
                        new UrlParam("buscarcodigo", buscarCodigo),
                        new UrlParam("buscarnombre", buscarNombre),
                        new UrlParam("buscarcategoria", buscarCategoria)
                    }, false);
        } else {
            store.reload(new UrlParam[]{
                        new UrlParam("start", 0), new UrlParam("limit", 100),
                        new UrlParam("buscarcodigo", buscarCodigo),
                        new UrlParam("buscarnombre", buscarNombre),
                        new UrlParam("buscarcategoria", buscarCategoria)
                    }, false);
        }
    }

    private void addListenersBuscador() {
        buscar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                buscarSegunParametros();
            }
        });
    }

    private void addListenersBuscadoresText() {

        //*********************************************************************
        //***************BUSCADOR DE ID************************************
        //*********************************************************************
        buscadorToolBar.getItemsText1().addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

        //*********************************************************************
        //***************BUSCADOR DE NOMBRE************************************
        //*********************************************************************
        buscadorToolBar.getItemsText2().addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

        //*********************************************************************
        //***************BUSCADOR DE TIPO************************************
        //*********************************************************************
        buscadorToolBar.getItemsText3().addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

    }

    public CheckboxSelectionModel getCbSelectionModel() {
        return cbSelectionModel;
    }

    public RecordDef getRecordDef() {
        return recordDef;
    }
}
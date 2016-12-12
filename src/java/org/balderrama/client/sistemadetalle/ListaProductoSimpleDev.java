/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

//import org.tiendab.client.almacen.producto.*;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Component;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.event.PanelListenerAdapter;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.event.GridCellListenerAdapter;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.UrlParam;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.data.*;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.widgets.QuickTipsConfig;
import com.gwtext.client.widgets.Toolbar;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import org.balderrama.client.util.BuscadorToolBar;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;

/**
 *
 * @author example
 */
public class ListaProductoSimpleDev {

    private GridPanel grid;
    private String ANCHO = "100%";
    private String ALTO = "400px";
    protected ExtElement ext_element;
    private CheckboxSelectionModel cbSelectionModel;
    private Store store;
    private ColumnConfig idColumn;
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
    private ToolbarButton verVenta;
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
      private ToolbarButton verVentabarra;
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
//String[] nombreCaso4Columns = {"idmodelo", "linea","codigo", "color","opciont", "precio", "totalpares","14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "totalcajas", "totalbs"};
String[] nombreCaso4Columns = {"idventa", "fecha","boleta", "vendedor","tcajas", "totalpares", "totalsus","descuento", "estado"};

    public ListaProductoSimpleDev(String nombreArchivo) {
        this.nombreArchivo = nombreArchivo;
    }

    public ListaProductoSimpleDev(String nombreArchivo, boolean setTopToobar) {
        this.setTopToobar = setTopToobar;
        this.nombreArchivo = nombreArchivo;
    }

    public ListaProductoSimpleDev(String nombreArchivo, String condicionBusqueda) {
        this.nombreArchivo = nombreArchivo;
        this.condicionBusqueda = condicionBusqueda;
    }

    public ListaProductoSimpleDev(String nombreArchivo, String ancho, String alto) {
        this.nombreArchivo = nombreArchivo;
        this.ANCHO = ancho;
        this.ALTO = alto;

    }

    public void onModuleLoad() {
        panel = new Panel();
  
        dataProxy = new ScriptTagProxy(nombreArchivo);
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso4Columns[0]),
                    new StringFieldDef(nombreCaso4Columns[1]),
                    new StringFieldDef(nombreCaso4Columns[2]),
                    new StringFieldDef(nombreCaso4Columns[3]),
                    new FloatFieldDef(nombreCaso4Columns[4]),
                    new FloatFieldDef(nombreCaso4Columns[5]),
                    new FloatFieldDef(nombreCaso4Columns[6]),
                    new FloatFieldDef(nombreCaso4Columns[7]),
                    new StringFieldDef(nombreCaso4Columns[8])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
         idColumn = new ColumnConfig("Id modelo", nombreCaso4Columns[0], 20, true);
        lineaColumn = new ColumnConfig("Fecha", nombreCaso4Columns[1], 100, true);
        codigoColumn = new ColumnConfig("Boleta", nombreCaso4Columns[2], 70, true);
         colorColumn = new ColumnConfig("Vendedor", nombreCaso4Columns[3], 70, true);
          coleccionColumn = new ColumnConfig("Cajas", nombreCaso4Columns[4], 70, true);
         precioColumn = new ColumnConfig("Pares", nombreCaso4Columns[5], 80, true);
        totalparesColumn = new ColumnConfig("Sus", nombreCaso4Columns[6], 80, true, null);
        talla14Column = new ColumnConfig("Descuento", nombreCaso4Columns[7], 30, true, null);
        talla15Column = new ColumnConfig("Estado", nombreCaso4Columns[8], 80, true, null);
        
                     cbSelectionModel = new CheckboxSelectionModel();

        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    lineaColumn,
                    codigoColumn,
                    colorColumn,
                    coleccionColumn,
                    precioColumn,
                    totalparesColumn,
                    talla14Column,
                    talla15Column
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setWidth(ANCHO);
        grid.setHeight(ALTO);
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");

        verVenta = new ToolbarButton("ver Venta");
        verVenta.setEnableToggle(true);
        QuickTipsConfig tipsConfig6 = new QuickTipsConfig();
        tipsConfig6.setText("Ver Venta");
        //tipsConfig.setTitle("Tip Title");
        verVenta.setTooltip(tipsConfig6);
verVentabarra = new ToolbarButton("ver Codigos Barra");
        verVentabarra.setEnableToggle(true);
        QuickTipsConfig tipsConfig62 = new QuickTipsConfig();
        tipsConfig62.setText("ver Codigos Barra");
        //tipsConfig.setTitle("Tip Title");
        verVentabarra.setTooltip(tipsConfig62);

       pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No hay datos para mostrar");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(verVenta);
        pagingToolbar.addSeparator();
pagingToolbar.addButton(verVentabarra);
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

    public void setGrid(GridPanel grid) {
        this.grid = grid;
    }

    public Panel getPanel() {
        return panel;
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
                 verVenta.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idventa");
             String enlTemp = "funcion=verboletaventa&idventa=" + selecionado;
            verReporte(enlTemp);

                } else {
                    MessageBox.alert("No hay Venta selecionado para ver detalle y/o selecciono mas de uno.");
                }
                verVenta.setPressed(false);
            }
        });
  verVentabarra.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idventa");
             String enlTemp = "funcion=vercodigobarra&idventa=" + selecionado;
            verReporte(enlTemp);

                } else {
                    MessageBox.alert("No hay Venta selecionado para ver detalle y/o selecciono mas de uno.");
                }
                verVentabarra.setPressed(false);
            }
        });
    }
private void verReporte(String enlace) {
       ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);

  //      ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace,"PDF");
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
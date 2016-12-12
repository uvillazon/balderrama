/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.venta;

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
import com.gwtext.client.widgets.Toolbar;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;
import org.balderrama.client.util.BuscadorToolBar;

/**
 *
 * @author example
 */
public class ListaProductoSimple {

    private GridPanel grid;
    private String ANCHO = "100%";
    private String ALTO = "330px";
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
    String selecionado = "";
    private Panel panel;
    private ColumnConfig codigoColumn;
    private ColumnConfig proveedorColumn;
    private ColumnConfig nombreColumn;
    private ColumnConfig categoriaColumn;
    private ColumnConfig cantidadColumn;
    private ColumnConfig preciobsColumn;
    private ColumnConfig preciosusColumn;
    private String nombreArchivo;
    private String condicionBusqueda;
    //private ColumnConfig unidadColumn;
    private RecordDef recordDef;
    boolean setTopToobar = true;
VentaFeria padre;
    public ListaProductoSimple(String nombreArchivo) {
        this.nombreArchivo = nombreArchivo;
    }

    public ListaProductoSimple(String nombreArchivo, boolean setTopToobar) {
        this.setTopToobar = setTopToobar;
        this.nombreArchivo = nombreArchivo;
    }

    public ListaProductoSimple(String nombreArchivo, String condicionBusqueda) {
        this.nombreArchivo = nombreArchivo;
        this.condicionBusqueda = condicionBusqueda;
    }

    public ListaProductoSimple(String nombreArchivo, String ancho, String alto) {
        this.nombreArchivo = nombreArchivo;
        this.ANCHO = ancho;
        this.ALTO = alto;

    }

    public void onModuleLoad(VentaFeria padre1) {
        this.padre=padre1;
        panel = new Panel();
         panel.setId("panel-lista-productosventa");

        dataProxy = new ScriptTagProxy(nombreArchivo);
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idkardexunico"),
                    new StringFieldDef("codigo"),
                    new StringFieldDef("detalle"),
                    new StringFieldDef("talla"),
                    new StringFieldDef("cantidad"),
                          //new StringFieldDef("unidad"),
                    //new StringFieldDef("precio1bs"),
                    new StringFieldDef("precio"),
                     new StringFieldDef("marca")
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);

        /* columnade idproducto  */
        idColumn = new ColumnConfig("Id producto", "idkardexunico", 100, true);
        /* columnade loggin  */
        codigoColumn = new ColumnConfig("Código", "codigo", 100, true, null, "codigo");
        /* columnade nombre  */
        //proveedorColumn = new ColumnConfig("Proveedor", "proveedor", 100, true, null, "proveedor");

        nombreColumn = new ColumnConfig("Detalle", "detalle", 110, true);
        /* columnade cantidad  */
        cantidadColumn = new ColumnConfig("Cantidad", "cantidad", 80, true);
        /* columnade categoria  */
        categoriaColumn = new ColumnConfig("Talla", "talla", 70, true);
        /* columnade uniadad  */
        //unidadColumn = new ColumnConfig("Unidad", "unidad", 100, true);

        //preciobsColumn = new ColumnConfig("precio", "precio1bs", 60, true);

        preciosusColumn = new ColumnConfig("precio", "precio", 70, true);
        preciobsColumn = new ColumnConfig("Marca", "marca", 100, true);

        cbSelectionModel = new CheckboxSelectionModel();
        CheckboxColumnConfig checkBoxColumn = new CheckboxColumnConfig(cbSelectionModel);
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                  //  proveedorColumn,
                    nombreColumn,
                     categoriaColumn,
                    cantidadColumn,
                  //  unidadColumn,
                   
                    //preciobsColumn,
                    preciosusColumn,
                    preciobsColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth(ANCHO);
        grid.setHeight(ALTO);
        //  grid.setTitle("Lista de productos");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No existen modelos para mostrar");

        String items[] = {"Código", "Marca", "Talla"};
        buscadorToolBar = new BuscadorToolBar(items);
        Toolbar topToolBar = buscadorToolBar.getToolbar();
        if (setTopToobar) {
            grid.setTopToolbar(topToolBar);
        }
        grid.setBottomToolbar(pagingToolbar);
        buscar = buscadorToolBar.getBuscar();
        buscadorToolBar.getItemsText1().focus();

//
        addListenersBuscador();
//
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
                 grid.addGridRowListener(new GridRowListenerAdapter() {

            @Override
            public void onRowDblClick(GridPanel grid, int rowIndex, EventObject e) {
                    Record[] data = new Record[1];
                data[0] = grid.getStore().getRecordAt(rowIndex);
                cargarProductoAVenta(data);
            }
        });
    }
     private void cargarProductoAVenta(Record[] dat) {
             padre.anadirProductoAVenta(dat);
        }

    public void buscarSegunParametros() {
        buscarCodigo = buscadorToolBar.getItemsText1().getText();
        buscarNombre = buscadorToolBar.getItemsText2().getText();
        buscarCategoria = buscadorToolBar.getItemsText3().getText();
       // if (condicionBusqueda != null && condicionBusqueda.equalsIgnoreCase("proveedor")) {
            store.reload(new UrlParam[]{
                        new UrlParam("start", 0),
                        new UrlParam("limit", 100),
                           new UrlParam("porbuscador", "true"),
                        new UrlParam("buscarcodigo", buscarCodigo),
                        new UrlParam("buscarnombre", buscarNombre),
                        new UrlParam("buscarcategoria", buscarCategoria)
                    }, false);

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
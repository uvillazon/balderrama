/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.CobroMayor;

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
import org.balderrama.client.util.BuscadorToolBar;

/**
 *
 * @author example
 */
public class ListaClienteSimple {

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
    protected String buscarNombre;
    protected String buscarApellido;
    protected String buscarEmpresa;
    private ToolbarButton buscar;
    private DataProxy dataProxy;
    private JsonReader reader;
    PagingToolbar pagingToolbar;
    String selecionado = "";
      String idcliente;
      String idmarca;

      private Panel panel;

    private ColumnConfig idClienteColumn;
    private ColumnConfig empresaColumn;
    private ColumnConfig nombreColumn;
    private ColumnConfig apellidoColumn;
    private ColumnConfig nitColumn;
     private ColumnConfig itemColumn;
    private String nombreArchivo;
    private String condicionBusqueda;
   // private ColumnConfig unidadColumn;
    private RecordDef recordDef;
    boolean setTopToobar = true;
    private ColumnConfig totalColumn;

    public ListaClienteSimple(String nombreArchivo) {
        this.nombreArchivo = nombreArchivo;
    }

    public ListaClienteSimple(String nombreArchivo, boolean setTopToobar) {
        this.setTopToobar = setTopToobar;
        this.nombreArchivo = nombreArchivo;
    }

    public ListaClienteSimple(String nombreArchivo, String condicionBusqueda) {
        this.nombreArchivo = nombreArchivo;
        this.condicionBusqueda = condicionBusqueda;
    }

    public ListaClienteSimple(String nombreArchivo, String ancho, String alto) {
        this.nombreArchivo = nombreArchivo;
        this.ANCHO = ancho;
        this.ALTO = alto;

    }

    public void onModuleLoad(String idclienteM,String idmarcaM) {
        panel = new Panel();
        this.idcliente= idclienteM;
         this.idmarca= idmarcaM;
        // panel.setId("panel-lista-productosproveedor");
// dataProxy= new ScriptTagProxy("./php/Empresa.php?funcion=buscarclientesempresaplanilla&idempresa="+idempresa+"&planilla="+planilla);
 
 dataProxy = new ScriptTagProxy("./php/CobroMayor.php?funcion=listarDeudasCliente&idcliente="+idcliente+"&idmarca="+idmarca);
        final RecordDef recordDef = new RecordDef(new FieldDef[]{


//        dataProxy = new ScriptTagProxy(nombreArchivo);
//        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idcredito"),
                    new StringFieldDef("factura"),
                    new StringFieldDef("saldo"),
                    new StringFieldDef("marca"),
                    new StringFieldDef("fechacredito"),
                    new StringFieldDef("fechamoroso"),
                    new StringFieldDef("preciototal")
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);

        /* columnade idproducto  */
         idClienteColumn = new ColumnConfig("Id", "idcredito", 100, false);
        nombreColumn = new ColumnConfig("Boleta", "factura", 100, false);

        /* columna de cantidad  */
        apellidoColumn = new ColumnConfig("Saldo Actual", "saldo", 100, false);
        /* columna de nit */
        itemColumn = new ColumnConfig("Marca", "marca", 100, false);

        empresaColumn = new ColumnConfig("Fecha Credito", "fechacredito", 100, false);
        /* columnade nombre  */

        nitColumn = new ColumnConfig("Fecha Moroso", "fechamoroso", 100, false);

   totalColumn = new ColumnConfig("Totaldeuda", "preciototal", 100, false);

        /* columna de reponsable  */


        cbSelectionModel = new CheckboxSelectionModel();
        CheckboxColumnConfig checkBoxColumn = new CheckboxColumnConfig(cbSelectionModel);
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    //idClienteColumn,
                    nombreColumn,
                    apellidoColumn,
                    itemColumn,
                    empresaColumn,
                    nitColumn,
                    totalColumn
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
        pagingToolbar.setEmptyMsg("No existen productos para mostrar");

        String items[] = {"Marca", "Recibo", "Fecha Credito"};
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
    }

    public void buscarSegunParametros() {
        buscarNombre = buscadorToolBar.getItemsText1().getText();
        buscarApellido = buscadorToolBar.getItemsText2().getText();
        buscarEmpresa = buscadorToolBar.getItemsText3().getText();
        if (condicionBusqueda != null && condicionBusqueda.equalsIgnoreCase("proveedor")) {
            store.reload(new UrlParam[]{
                        new UrlParam("start", 0),
                        new UrlParam("limit", 100),
                        new UrlParam("noincluyeproveedor", "true"),
                        new UrlParam("buscarmarca", buscarNombre),
                        new UrlParam("buscarrecibo", buscarApellido),
                        new UrlParam("buscarfecha", buscarEmpresa)
                    }, false);
        } else {
            store.reload(new UrlParam[]{
                        new UrlParam("start", 0), new UrlParam("limit", 100),
                        new UrlParam("buscarmarca", buscarNombre),
                        new UrlParam("buscarrecibo", buscarApellido),
                        new UrlParam("buscarfecha", buscarEmpresa)
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
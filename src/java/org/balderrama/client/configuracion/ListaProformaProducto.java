/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.configuracion;

import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
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
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.event.GridCellListenerAdapter;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.data.*;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.NumberField;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.grid.GridEditor;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;
import mx4j.util.Utils;
import org.balderrama.client.configuracion.Configuracion;

/**
 *
 * @author example
 */
public class ListaProformaProducto {

    private EditorGridPanel grid;
    private final int ANCHO = 400;
    private final int ALTO = 250;
    private ToolbarButton eliminarProducto;
    protected ExtElement ext_element;
    private CheckboxSelectionModel cbSelectionModel;
    private Store store;
    private ColumnConfig idColumn;
    private BaseColumnConfig[] columns;
    private ColumnModel columnModel;
    protected String buscaCodigo;
    protected String buscarNombre;
    private ToolbarButton buscar;
    private DataProxy dataProxy;
    private JsonReader reader;
    PagingToolbar pagingToolbar;
    String selecionado = "";
    private Panel panel;
    private ColumnConfig codigoColumn;
    private ColumnConfig detalleColumn;
    private ColumnConfig tallaColumn;

    private ColumnConfig cantidadColumn;
    private ColumnConfig precioColumn;
    private ColumnConfig com_empleadoAColumn;
    private ColumnConfig vendedorColumn;
    private ComboBox com_empleadoA;
    private Object empleadoA[][];
    private Object[][] vendedorM;
public Configuracion padre;
//private Object[][] empleadosM;

//    private ColumnConfig precio1Column;
//    private ColumnConfig cantidadColumn;
//    private ColumnConfig totalColumn;
//    private ColumnConfig precioColumn;
    String[] nombreComlumns = {"idkardextienda", "codigo", "detalle","talla", "cantidad", "precio2", "vendedor"};
    //this.empleadoA = codigoemp;
    private RecordDef recordDef;

    public void onModuleLoad() {
        panel = new Panel();
       // this.vendedorM = vendedorM;
        //panel.setId("panel-lista-productosproveedor");

        dataProxy = new ScriptTagProxy("");
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreComlumns[0]),
                    new StringFieldDef(nombreComlumns[1]),
                    new StringFieldDef(nombreComlumns[2]),
                    new StringFieldDef(nombreComlumns[3]),
                    new StringFieldDef(nombreComlumns[4]),
                    new StringFieldDef(nombreComlumns[5]),
                    new FloatFieldDef(nombreComlumns[6])
//                    new FloatFieldDef(nombreComlumns[7]),
//                    new FloatFieldDef(nombreComlumns[8])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);



        idColumn = new ColumnConfig("Id Kardex", nombreComlumns[0], 90, true);
        codigoColumn = new ColumnConfig("Articulo", nombreComlumns[1], 110, true, null);
        detalleColumn = new ColumnConfig("Detalle", nombreComlumns[2], 280, true);
        tallaColumn = new ColumnConfig("Talla", nombreComlumns[3], 50, true);

        cantidadColumn = new ColumnConfig("Cantidad", nombreComlumns[4], 90, true, null);
        precioColumn = new ColumnConfig("Precio", nombreComlumns[5], 90, true, null);


        vendedorColumn = new ColumnConfig("Vendedor", nombreComlumns[6], 110, true);

       
        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    //                    idColumn,
                    codigoColumn,
                    detalleColumn,
                    tallaColumn,
                    cantidadColumn,
                    precioColumn,
                    vendedorColumn
//                    precioColumn,
//                    precio1Column,
//                    cantidadColumn,
//                    totalColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        grid.setTitle("Detalle Venta");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        //grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
       // grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);


        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);

        grid.setBottomToolbar(pagingToolbar);
  grid.addListener(
                new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store.load(0, 100);
                    }
                });

//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();

        aniadirListenersProducto();
        panel.add(grid);
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

    private void aniadirListenersProducto() {
        //**************************************************
        //***********ELIMINAR PRODUCTO
        //**************************************************

        eliminarProducto.addListener(new ButtonListenerAdapter() {

            private boolean procederAEliminar;
            int repeat = 0;

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idkardextienda");
                    grid.stopEditing();
                    store.remove(cbSelectionModel.getSelected());
                    grid.startEditing(0, 0);
                } else {
                    MessageBox.alert("No hay producto selecionado para eliminar y/o selecciono mas de uno.");
                }
                eliminarProducto.setPressed(false);
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
                Record rs = grid.getStore().getRecordAt(rowIndex);
                quitarEsteItem(rs);
            }
        });
    }



    private void quitarEsteItem(Record quitar) {

        store.remove(quitar);
        grid.setStore(store);
        grid.startEditing(0, 0);
         padre.limpiarVentanaVenta();
//         padre.recalcular(true);
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
}
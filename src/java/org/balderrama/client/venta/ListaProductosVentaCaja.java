/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.venta;

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
import com.gwtext.client.data.*;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.NumberField;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;

/**
 *
 * @author example
 */
public class ListaProductosVentaCaja {

    private EditorGridPanel grid;
    private final int ANCHO = 400;
    private final int ALTO =300;
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

             private ColumnConfig preciocajaColumn;
 private ColumnConfig itemColumn;
  private ColumnConfig id2Column;
    private ColumnConfig cantidadColumn;
    private ColumnConfig precioColumn;
    private ColumnConfig com_empleadoAColumn;
    private ColumnConfig vendedorColumn;
    private ComboBox com_empleadoA;
    private Object empleadoA[][];
   // private Object[][] vendedorM;
public PanelVentaDetalle padre;
 private Float totalTotalV1073;
    private Float descPorV1073;
    private Float descCalV1073;
    private Float pagarV1073;
    private Float montocancelado;
    private String idventa;
 String[] nombreComlumns = {"idkardexunico", "idmodelo", "modelo","detalle","cantidad", "preciou"};

    private RecordDef recordDef;
 

    public void onModuleLoad() {
        panel = new Panel();
        
        dataProxy = new ScriptTagProxy("");
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreComlumns[0]),
                    new StringFieldDef(nombreComlumns[1]),
                    new StringFieldDef(nombreComlumns[2]),
                    new StringFieldDef(nombreComlumns[3]),
                    new FloatFieldDef(nombreComlumns[4]),
                    new FloatFieldDef(nombreComlumns[5])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);



        idColumn = new ColumnConfig("Id Kardex", nombreComlumns[0], 90, true);
         id2Column = new ColumnConfig("Idmodelo", nombreComlumns[1], 90, true);
        codigoColumn = new ColumnConfig("Articulo", nombreComlumns[2], 90, true, null);
        detalleColumn = new ColumnConfig("Detalle", nombreComlumns[3], 600, true);
  //      tallaColumn = new ColumnConfig("Talla", nombreComlumns[4], 50, true);
   //    itemColumn = new ColumnConfig("Item", nombreComlumns[5], 80, true);
        cantidadColumn = new ColumnConfig("Cantidad Pares", nombreComlumns[4], 80, true, null);
        precioColumn = new ColumnConfig("Precio Caja", nombreComlumns[5], 90, true, null);
   //  preciocajaColumn = new ColumnConfig("Precio Caja", nombreComlumns[8], 100, true, null);
//vendedorColumn = new ColumnConfig("Mercaderia de :", nombreComlumns[9], 180, true, null);

//         NumberField numberField = new NumberField();
//        numberField.setAllowBlank(false);
//        numberField.setAllowNegative(false);
//        numberField.setMaxValue(1000);
//        precioColumn.setEditor(new GridEditor(numberField));

// precioColumn.setEditor(new GridEditor(metodoFeli()));

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    //                    idColumn,
                    codigoColumn,
                    detalleColumn,
                   // tallaColumn,
                    //itemColumn,
                    cantidadColumn,
                    precioColumn,
                    //preciocajaColumn,
                    //vendedorColumn

                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-productos-ventasvender-caja-");
      
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

        eliminarProducto = new ToolbarButton("Ver Pares por codigo");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Ver detalle del producto");
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
                //editarprecio


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
               Record[] records = grid.getSelectionModel().getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idkardexunico");
                   String enlTemp = "funcion=verproductoHTML&idkardexunico=" + selecionado;

                                                                         verReporte(enlTemp);
                                    

                } else {
                    MessageBox.alert("No hay producto selecionado para ver en otras tiendas y/o selecciono mas de uno.");
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
  


    public CheckboxSelectionModel getSelectionModel() {
        return cbSelectionModel;
    }

  
 public NumberField metodoFeli() {


        NumberField num_field1 = new NumberField();
        num_field1.setAllowDecimals(false);
        num_field1.setAllowBlank(false);

        num_field1.setAllowNegative(false);

        return num_field1;
    }
  private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }

}
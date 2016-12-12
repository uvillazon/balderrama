/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.venta;

import org.balderrama.client.sistemadetalle.*;
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
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.grid.GridEditor;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import com.gwtext.client.widgets.grid.event.*;

/**
 *
 * @author example
 */
public class ListaTallaW {

    private EditorGridPanel grid;
    private final int ALTO = 22;
    private ToolbarButton eliminarProducto;
    protected ExtElement ext_element;
    private CheckboxSelectionModel cbSelectionModel;
      private CheckboxSelectionModel cbSelectionModel1;
    private Store store;
    private ColumnConfig idColumn;
    private BaseColumnConfig[] columns;
    private ColumnModel columnModel;
    protected String buscaCodigo;
    protected String buscarNombre;
    private DataProxy dataProxy;
    private JsonReader reader;
    PagingToolbar pagingToolbar;
     private PanelPedidoE SM;
    String selecionado = "";
      String codigo ;
        String marca ;
        String opcion;
    private Panel panel;
     private Object[][] colorM;
     private Object[][] materialM;
  private Object[][] clienteM;
     private ColumnConfig codigoColumn;
    private ColumnConfig colorColumn;
    private ColumnConfig materialColumn;
    private ColumnConfig lineaColumn;
    private ColumnConfig clienteColumn;
        private ColumnConfig precioColumn;
    private ColumnConfig preciounitarioColumn;
  private ColumnConfig totalparesbsColumn;
   private ColumnConfig totalparescajaColumn;
    private ColorPedido colorpedido;
     private MaterialPedido materialpedido;
          private ClientePedido clientepedido;
     private ColorPedido1 colorpedido1;
     private MaterialPedido1 materialpedido1;
//    private ColumnConfig stylenameColumn;
//    private ColumnConfig clienteColumn;
//    private ColumnConfig vendedorColumn;
     private ColumnConfig coleccionColumn;
    private ColumnConfig totalparesColumn;
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
    private ColumnConfig talla39Column;
    private ColumnConfig talla40Column;
    private ColumnConfig talla41Column;
    private ColumnConfig talla42Column;
    private ColumnConfig talla43Column;
    private ColumnConfig talla44Column;
    private ColumnConfig talla45Column;
    private ColumnConfig precio1Column;
    private ColumnConfig cantidadColumn;
    private ColumnConfig totalColumn;
    private ColumnConfig tipoventaColumn;
      private ColumnConfig talla;
//    private ColorPedido colorpedido;
 //   private MaterialPedido materialpedido;
    //opcion 9
    //OPCION 6
    String[] nombreCaso5Columns = {"idmodelo", "codigo", "material","cliente", "totalcajas","precio","preciounitario","talla","5", "5m", "6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12",  "totalpares","totalparescaja",  "totalparesbs"};
    String[] nombreCaso3Columns = {"idmodelo", "codigo", "material","cliente", "totalcajas","precio","preciounitario","talla","31", "32", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45",  "totalpares","totalparescaja",  "totalparesbs"};

    private RecordDef recordDef;
  
    public void onModuleLoad3() {
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        dataProxy = new ScriptTagProxy("");
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso3Columns[0]),
                    new StringFieldDef(nombreCaso3Columns[1]),
                    new StringFieldDef(nombreCaso3Columns[2]),
                    new StringFieldDef(nombreCaso3Columns[3]),
                    new StringFieldDef(nombreCaso3Columns[4]),
                    new StringFieldDef(nombreCaso3Columns[5]),
                    new StringFieldDef(nombreCaso3Columns[6]),
                    new StringFieldDef(nombreCaso3Columns[7]),
                    new FloatFieldDef(nombreCaso3Columns[8]),
                    new FloatFieldDef(nombreCaso3Columns[9]),
                    new FloatFieldDef(nombreCaso3Columns[10]),
                    new FloatFieldDef(nombreCaso3Columns[11]),
                    new FloatFieldDef(nombreCaso3Columns[12]),
                    new FloatFieldDef(nombreCaso3Columns[13]),
                    new FloatFieldDef(nombreCaso3Columns[14]),
                    new FloatFieldDef(nombreCaso3Columns[15]),
                    new FloatFieldDef(nombreCaso3Columns[16]),
                    new FloatFieldDef(nombreCaso3Columns[17]),
                    new FloatFieldDef(nombreCaso3Columns[18]),
                    new FloatFieldDef(nombreCaso3Columns[19]),
                    new FloatFieldDef(nombreCaso3Columns[20]),
                    new FloatFieldDef(nombreCaso3Columns[21]),
                    new FloatFieldDef(nombreCaso3Columns[22]),
                    new FloatFieldDef(nombreCaso3Columns[23]),
                    new StringFieldDef(nombreCaso3Columns[24]),
                    new StringFieldDef(nombreCaso3Columns[25])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso3Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso3Columns[1], 80, true);
        materialColumn = new ColumnConfig("Stylename", nombreCaso3Columns[2], 100, true);
       // colorColumn = new ColumnConfig("Color", nombreCaso3Columns[3], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso3Columns[3], 100, true);

        totalcajasColumn = new ColumnConfig("Num", nombreCaso3Columns[4], 70, true, null);
        precioColumn = new ColumnConfig("Precio", nombreCaso3Columns[5],80, true);
         preciounitarioColumn = new ColumnConfig("Precio", nombreCaso3Columns[6], 80, true);
         talla = new ColumnConfig("B", nombreCaso3Columns[7], 50, true);

        talla5Column = new ColumnConfig("-", nombreCaso3Columns[8], 35, true, null);
        talla5mColumn = new ColumnConfig("-", nombreCaso3Columns[9], 35, true, null);
        talla6Column = new ColumnConfig("-", nombreCaso3Columns[10], 35, true, null);
        talla6mColumn = new ColumnConfig("-", nombreCaso3Columns[11], 35, true, null);
        talla7Column = new ColumnConfig("-", nombreCaso3Columns[12], 35, true, null);
        talla7mColumn = new ColumnConfig("-", nombreCaso3Columns[13], 35, true, null);
        talla8Column = new ColumnConfig("-", nombreCaso3Columns[14], 35, true, null);
        talla8mColumn = new ColumnConfig("-", nombreCaso3Columns[15], 35, true, null);
        talla9Column = new ColumnConfig("-", nombreCaso3Columns[16], 35, true, null);
        talla9mColumn = new ColumnConfig("-", nombreCaso3Columns[17], 35, true, null);
        talla10Column = new ColumnConfig("-", nombreCaso3Columns[18], 35, true, null);
        talla10mColumn = new ColumnConfig("-", nombreCaso3Columns[19], 35, true, null);
        talla11Column = new ColumnConfig("-", nombreCaso3Columns[20], 35, true, null);
        talla11mColumn = new ColumnConfig("-", nombreCaso3Columns[21], 35, true, null);
        talla12Column = new ColumnConfig("-", nombreCaso3Columns[22], 35, true, null);

        totalparesColumn = new ColumnConfig("Total", nombreCaso3Columns[23], 80, true, null);
        totalparescajaColumn = new ColumnConfig("pares  x", nombreCaso3Columns[24], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total", nombreCaso3Columns[25], 80, true, null);



        cbSelectionModel = new CheckboxSelectionModel();
         cbSelectionModel1 = new CheckboxSelectionModel();

        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    clienteColumn,
                      totalcajasColumn,
                    precioColumn,
                          preciounitarioColumn,
                          talla,
                     talla5Column,
                    talla5mColumn,
                    talla6Column,
                   talla6mColumn,
                    talla7Column,
                    talla7mColumn,
                    talla8Column,
                    talla8mColumn,
                    talla9Column,
                    talla9mColumn,
                    talla10Column,
                    talla10mColumn,
                      talla11Column,
                    talla11mColumn,
                    talla12Column,
                   totalparescajaColumn,
                    totalparesbsColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);

       // grid.setTitle("Lista de Tallas");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(false);

        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

        eliminarProducto = new ToolbarButton("");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
     //   pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
       pagingToolbar.addButton(eliminarProducto);

    //    grid.setBottomToolbar(pagingToolbar);

//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();

     aniadirListenersProductoEspecial();
        panel.add(grid);
    }


    public void onModuleLoad1() {
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        dataProxy = new ScriptTagProxy("");
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso5Columns[0]),
                    new StringFieldDef(nombreCaso5Columns[1]),
                    new StringFieldDef(nombreCaso5Columns[2]),
                    new StringFieldDef(nombreCaso5Columns[3]),
                    new StringFieldDef(nombreCaso5Columns[4]),
                    new StringFieldDef(nombreCaso5Columns[5]),
                    new StringFieldDef(nombreCaso5Columns[6]),
                    new StringFieldDef(nombreCaso5Columns[7]),
                    new FloatFieldDef(nombreCaso5Columns[8]),
                    new FloatFieldDef(nombreCaso5Columns[9]),
                    new FloatFieldDef(nombreCaso5Columns[10]),
                    new FloatFieldDef(nombreCaso5Columns[11]),
                    new FloatFieldDef(nombreCaso5Columns[12]),
                    new FloatFieldDef(nombreCaso5Columns[13]),
                    new FloatFieldDef(nombreCaso5Columns[14]),
                    new FloatFieldDef(nombreCaso5Columns[15]),
                    new FloatFieldDef(nombreCaso5Columns[16]),
                    new FloatFieldDef(nombreCaso5Columns[17]),
                    new FloatFieldDef(nombreCaso5Columns[18]),
                    new FloatFieldDef(nombreCaso5Columns[19]),
                    new FloatFieldDef(nombreCaso5Columns[20]),
                    new FloatFieldDef(nombreCaso5Columns[21]),
                    new FloatFieldDef(nombreCaso5Columns[22]),
                    new FloatFieldDef(nombreCaso5Columns[23]),
                    new StringFieldDef(nombreCaso5Columns[24]),
                    new StringFieldDef(nombreCaso5Columns[25])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso5Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso5Columns[1], 80, true);
        materialColumn = new ColumnConfig("Stylename", nombreCaso5Columns[2], 100, true);
       // colorColumn = new ColumnConfig("Color", nombreCaso5Columns[3], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso5Columns[3], 100, true);
        
        totalcajasColumn = new ColumnConfig("Num", nombreCaso5Columns[4], 70, true, null);
        precioColumn = new ColumnConfig("Precio", nombreCaso5Columns[5],80, true);
         preciounitarioColumn = new ColumnConfig("Precio", nombreCaso5Columns[6], 80, true);
         talla = new ColumnConfig("M/W", nombreCaso5Columns[7], 50, true);

       talla5Column = new ColumnConfig("5", nombreCaso5Columns[8], 35, true, null);
        talla5mColumn = new ColumnConfig("5m", nombreCaso5Columns[9], 35, true, null);
        talla6Column = new ColumnConfig("6", nombreCaso5Columns[10], 35, true, null);

      talla6mColumn = new ColumnConfig("6m", nombreCaso5Columns[11], 35, true, null);
        talla7Column = new ColumnConfig("7", nombreCaso5Columns[12], 35, true, null);
        talla7mColumn = new ColumnConfig("7m", nombreCaso5Columns[13], 35, true, null);
        talla8Column = new ColumnConfig("8", nombreCaso5Columns[14], 35, true, null);
        talla8mColumn = new ColumnConfig("8m", nombreCaso5Columns[15], 35, true, null);
        talla9Column = new ColumnConfig("9", nombreCaso5Columns[16], 35, true, null);
        talla9mColumn = new ColumnConfig("9m", nombreCaso5Columns[17], 35, true, null);
        talla10Column = new ColumnConfig("10", nombreCaso5Columns[18], 35, true, null);
        talla10mColumn = new ColumnConfig("10m", nombreCaso5Columns[19], 35, true, null);
        talla11Column = new ColumnConfig("11", nombreCaso5Columns[20], 35, true, null);
        talla11mColumn = new ColumnConfig("11m", nombreCaso5Columns[21], 35, true, null);
        talla12Column = new ColumnConfig("12", nombreCaso5Columns[22], 35, true, null);

        totalparesColumn = new ColumnConfig("Total", nombreCaso5Columns[23], 80, true, null);
        totalparescajaColumn = new ColumnConfig("pares  x", nombreCaso5Columns[24], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total", nombreCaso5Columns[25], 80, true, null);

      

        cbSelectionModel = new CheckboxSelectionModel();
         cbSelectionModel1 = new CheckboxSelectionModel();

        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    clienteColumn,
                      totalcajasColumn,
                    precioColumn,
                          preciounitarioColumn,
                          talla,
                     talla5Column,
                    talla5mColumn,
                    talla6Column,
                   talla6mColumn,
                    talla7Column,
                    talla7mColumn,
                    talla8Column,
                    talla8mColumn,
                    talla9Column,
                    talla9mColumn,
                    talla10Column,
                    talla10mColumn,
                      talla11Column,
                    talla11mColumn,
                    talla12Column,
                   totalparescajaColumn,
                    totalparesbsColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
       
       // grid.setTitle("Lista de Tallas");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(false);

        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

        eliminarProducto = new ToolbarButton("");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
     //   pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
       pagingToolbar.addButton(eliminarProducto);

    //    grid.setBottomToolbar(pagingToolbar);

//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();

     aniadirListenersProductoEspecial();
        panel.add(grid);
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
private void aniadirListenersProductoEspecial() {
        //**************************************************
        //***********ELIMINAR PRODUCTO
        //**************************************************
//ramarin
         eliminarProducto.addListener(new ButtonListenerAdapter() {

            private boolean procederAEliminar;
            int repeat = 0;

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idproducto");
                    grid.stopEditing();
                    store.remove(cbSelectionModel.getSelected());
                    grid.startEditing(0, 0);
                    SM.limpiarVentanaVenta();
        // SM.recalcular(true);
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

                 if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor")) {
                               int newcol = colIndex +1;
                            if (e.getKey() == EventObject.ENTER) {
                                          Record record1 = grid.getStore().getAt(newcol);
                                     record1.set("indoor",record1);
                                      }
                             }
                      }
                });
    // grid.addGridColumnListener(listener)
     grid.addGridColumnListener(new GridColumnListener() {


            public void onColumnMove(GridPanel grid, int oldIndex, int newIndex) {
             if (grid.getColumnModel().getDataIndex(oldIndex).equals("precio")) {
                            Record record = grid.getStore().getAt(newIndex);
                            record.set("indoor", !record.getAsBoolean("indoor"));
                        }
            }

            public void onColumnResize(GridPanel grid, int colIndex, int newSize) {
                throw new UnsupportedOperationException("Not supported yet.");
            }
         });

    }

 

    public RecordDef getRecordDef() {
        return recordDef;
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
     public void buscarProductos(String idmarca) {
 // dataProxy1018 = new ScriptTagProxy("./php/Empresa.php?funcion=buscarclientesempresaplanilla&idempresa="+idempresa+"&planilla="+planilla);
// SM.limpiarVentanaVenta();
// aniadirListenersProducto();
        dataProxy = new ScriptTagProxy("php/IngresoAlmacen.php?funcion=buscarlistamodelos&idmarca="+idmarca);

       reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);


        store.reload();
        grid.reconfigure(store, columnModel);
        pagingToolbar.setStore(store);
        grid.getView().refresh();

//   grid.addEditorGridListener(new EditorGridListenerAdapter() {
//
//            @Override
//            public void onAfterEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
//                SM.calcularSubTotal(grid, record, field, newValue, oldValue, rowIndex, colIndex);
//            }
//        });
//        grid.getView().refresh();
//            grid.addGridCellListener(
//                new GridCellListenerAdapter() {
//
//                    @Override
//                    public void onCellClick(GridPanel grid, int rowIndex, int colIndex, EventObject e) {
//                        if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor")) {
//                            Record record = grid.getStore().getAt(rowIndex);
//                            record.set("indoor", !record.getAsBoolean("indoor"));
//                        }
//                   if (grid.getColumnModel().getDataIndex(colIndex).equals("color")) {
//                            colorpedido = new ColorPedido(colorM, ListaCalzadoPedido.this, colIndex, rowIndex);
//                            colorpedido.show();
//                        }
//                        if (grid.getColumnModel().getDataIndex(colIndex).equals("material")) {
//                             materialpedido = new MaterialPedido(materialM, ListaCalzadoPedido.this, colIndex, rowIndex);
//                            materialpedido.show();
//
//                        }
//
//                    }
//                });


    }
 public void buscarProductosmodelo(String idmarca,String modelo) {

        dataProxy = new ScriptTagProxy("php/IngresoAlmacen.php?funcion=buscarlistamodelo&idmarca="+idmarca+"&idmodelo="+modelo);

       reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        //store = new Store(dataProxy, reader, true);
        store.reload();
        grid.reconfigure(store, columnModel);
        pagingToolbar.setStore(store);
        grid.getView().refresh();
 }
 public void buscarProductosestilo(String idmarca,String estilo) {
   // dataProxy = new ScriptTagProxy("php/IngresoAlmacen.php?funcion=buscarlistamodelo&idmarca="+idmarca+"&idmodelo="+modelo);
   dataProxy = new ScriptTagProxy("php/IngresoAlmacen.php?funcion=buscarlistaestilo&idmarca="+idmarca+"&idestilo="+estilo);

       reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        //store = new Store(dataProxy, reader, true);
        store.reload();
        grid.reconfigure(store, columnModel);
        pagingToolbar.setStore(store);
        grid.getView().refresh();

 }
}
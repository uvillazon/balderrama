/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.cliente;

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
import com.gwtext.client.core.SortDir;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.data.*;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.widgets.form.NumberField;
import com.gwtext.client.widgets.grid.GroupingView;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import com.gwtext.client.widgets.grid.event.*;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;

/**
 *
 * @author example
 */
public class listamarcadeuda {
   private EditorGridPanel grid;
    private final int ALTO = 420;
    private ToolbarButton eliminarProducto;
    private ToolbarButton guardarProducto;

    private ToolbarButton cambiarestilo;
    // private FormularioConsultas formularioConsultas;
    protected ExtElement ext_element;
    public CheckboxSelectionModel cbSelectionModel;
   // private Store store;
    private GroupingStore store;
    // GroupingStore store = new GroupingStore();
    private ColumnConfig idColumn;
    private BaseColumnConfig[] columns;
    private ColumnModel columnModel;
    protected String buscaCodigo;
    protected String buscarNombre;
    private DataProxy dataProxy;
    private JsonReader reader;
    PagingToolbar pagingToolbar;
    String selecionado = "";
      String selecionado2 = "";
    String estilo = "";
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
    private ColumnConfig talla13Column;
    private ColumnConfig talla13mColumn;
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
     private ColumnConfig estiloColumn;
          private ColumnConfig cajaColumn;
               private ColumnConfig parColumn;
                    private ColumnConfig rebajaColumn;
      private String idpedido;
    //  private String ;
    private String idestilo;
     private String idkardex;
     private String idtienda;
    private String opcion;
    String idcliente;
   // private Object[][] vendedorM;
    private Object[][] colorM;
    //private Object[][] materialM;
    String[] nombreCaso5Columns = {"idventa", "idmarca", "fechaventa","boleta", "cajas","pares","montodeuda","rebaja", "pagado", "porpagar", "fechaultimopago", "fechamaxima","estado","detalle", "marca"};
  // String[] nombreCaso333Columns = {"iddetalleingreso", "codigo", "precio", "01", "19", "02", "20", "03", "30", "04", "40", "05", "50", "06", "60", "07", "70", "08", "80", "09", "90", "10", "100", "11", "110", "12", "120", "13", "totalcajas", "totalpares"};

    private RecordDef recordDef;
    private ColumnConfig coleccionColumn;
  //rivate Object[][] estiloM;


    public void onModuleLoad5(String idmarca, String idkardex,String idtiend) {
        panel = new Panel();
         this.idtienda=idtiend;
         this.idkardex = idkardex;
         this.idcliente = idmarca;
         this.opcion = "12";
        //      dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorramarim&idmarca=" + idpedido +"&idkardex=" + idkardex+ "&idtienda=" + idtienda);
      dataProxy = new ScriptTagProxy("php/CobroMayor.php?funcion=Listardeudasclientepormarca&idcliente=" + idcliente);
    //    String enlace = "php/CobroMayor.php?funcion=BuscarCuentasCliente&idcliente=" + idcliente;

      // dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorramarim&idmarca=" + idpedido +"&idkardex=" + idkardex+ "&idtienda=" + idtienda);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso5Columns[0]),
                    new StringFieldDef(nombreCaso5Columns[1]),
                    new StringFieldDef(nombreCaso5Columns[2]),
                    new StringFieldDef(nombreCaso5Columns[3]),
                    new StringFieldDef(nombreCaso5Columns[4]),
                    new FloatFieldDef(nombreCaso5Columns[5]),
                    new FloatFieldDef(nombreCaso5Columns[6]),
                    new FloatFieldDef(nombreCaso5Columns[7]),
                    new FloatFieldDef(nombreCaso5Columns[8]),
                    new FloatFieldDef(nombreCaso5Columns[9]),
                    new FloatFieldDef(nombreCaso5Columns[10]),
                    new StringFieldDef(nombreCaso5Columns[11]),
                    new StringFieldDef(nombreCaso5Columns[12]),
                    new StringFieldDef(nombreCaso5Columns[13]),
                    new StringFieldDef(nombreCaso5Columns[14])
                });
        //pogo
  
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
     //   GroupingStore store
        store = new GroupingStore(dataProxy, reader, true);
       store.setReader(reader);
        store.setDataProxy(dataProxy);
         store.setSortInfo(new SortState("boleta", SortDir.ASC));
         store.setGroupField("marca");
         store.load();

        idColumn = new ColumnConfig("Id modelo", nombreCaso5Columns[0], 100, true);
        coleccionColumn = new ColumnConfig("Col.", nombreCaso5Columns[1], 70, true);
        codigoColumn = new ColumnConfig("Fecha Venta", nombreCaso5Columns[2], 80, true);
        colorColumn = new ColumnConfig("Boleta", nombreCaso5Columns[3],70, true);
        cajaColumn = new ColumnConfig("Cajas", nombreCaso5Columns[4], 60, true);
        parColumn = new ColumnConfig("Pares", nombreCaso5Columns[5], 60, true);
        precioColumn = new ColumnConfig("Sus", nombreCaso5Columns[6], 80, true);
        rebajaColumn = new ColumnConfig("Rebaja", nombreCaso5Columns[7], 80, true);
        talla33Column = new ColumnConfig("Pagado", nombreCaso5Columns[8], 80, true, null);
        talla34Column = new ColumnConfig("Por Pagar", nombreCaso5Columns[9], 80, true, null);
        talla35Column = new ColumnConfig("Ultimo Pago", nombreCaso5Columns[10], 80, true, null);
        talla36Column = new ColumnConfig("FEcha Limite", nombreCaso5Columns[11], 80, true, null);
        talla37Column = new ColumnConfig("Estado", nombreCaso5Columns[12], 100, true, null);
        talla38Column = new ColumnConfig("detalle", nombreCaso5Columns[13], 100, true, null);
         talla45Column = new ColumnConfig("Marca", nombreCaso5Columns[14],100, true, null);


        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                                       codigoColumn,
                    colorColumn,
                    cajaColumn,
                    parColumn,
                    precioColumn,
                    rebajaColumn,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                    talla45Column
                };


        columnModel = new ColumnModel(columns);

 grid = new EditorGridPanel();
 grid.setStore(store);
        grid.setColumnModel(columnModel);

        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);

         grid.setFrame(true);
         grid.setStripeRows(true);
         grid.setAutoExpandColumn("marca");
         grid.setTitle("Modelos");
//         grid.setHeight(350);
//         grid.setWidth(1500);
        grid.setWidth("100%");
        grid.setHeight(280);

         GroupingView gridView = new GroupingView();
         gridView.setForceFit(true);
         gridView.setGroupTextTpl("{text} ({[values.rs.length]} {[values.rs.length > 1 ?  \"Items\" : \"Item\"]})");

         grid.setView(gridView);
         grid.setFrame(true);

         grid.setCollapsible(true);
         grid.setAnimCollapse(false);
         grid.setTitle("Modelos agrupados por estilo");
         grid.setIconCls("grid-icon");

        eliminarProducto = new ToolbarButton("Ver Detalle venta");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Ver modelos vendidos");
        eliminarProducto.setTooltip(tipsConfig2);

        cambiarestilo = new ToolbarButton("Ver Detalle cobros");
        cambiarestilo.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig21.setText("ver cobros ");
        cambiarestilo.setTooltip(tipsConfig21);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
              pagingToolbar.addSeparator();
        pagingToolbar.addButton(cambiarestilo);
        grid.setBottomToolbar(pagingToolbar);

        grid.setBottomToolbar(pagingToolbar);
        aniadirListenersProducto();
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

     public void InsertRowColor(int rowIndex, int colIndex, String dato) {
        grid.getColumnModel().getDataIndex(rowIndex).equals("color");
        Record rs = grid.getStore().getRecordAt(rowIndex);
        rs.set("color", dato);

    }
 

    private void aniadirListenersProducto() {

        cambiarestilo.addListener(new ButtonListenerAdapter() {


        @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idventa");
                    selecionado2 = records[0].getAsString("idcliente");

    // String enlace = "php/VentaDetalle.php?funcion=eliminarventa&idventadetalle=" + idventa + "&idusuario=" + usuario;

             String enlTemp = "funcion=verpagos&idventa=" + selecionado+ "&idcliente=" + selecionado2;
            verReporte(enlTemp);

                } else {
                    MessageBox.alert("No hay Venta selecionado para ver detalle y/o selecciono mas de uno.");
                }
                cambiarestilo.setPressed(false);
            }
        });
        //**************************************************
        //***********ELIMINAR PRODUCTO
        //**************************************************

        eliminarProducto.addListener(new ButtonListenerAdapter() {

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
                eliminarProducto.setPressed(false);
            }
        });

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

                        if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor") &&
                                e.getTarget(".checkbox", 1) != null) {
                            Record record = grid.getStore().getAt(rowIndex);
                            record.set("indoor", !record.getAsBoolean("indoor"));
                        }
                        if (grid.getColumnModel().getDataIndex(colIndex).equals("color")) {
                            // colorpedido = new ColorPedido(colorM, ListaCalzadoPedidoTalla.this, colIndex, rowIndex);
                            //colorpedido.show();
                        }

                        if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor")) {
                            int newcol = colIndex + 1;
                            if (e.getKey() == EventObject.ENTER) {
                                Record record1 = grid.getStore().getAt(newcol);
                                record1.set("indoor", record1);
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

//    private void aniadirListenersProductoEspecial(final String idmarca, final String idtienda) {
//           cambiarestilo.addListener(new ButtonListenerAdapter() {
//
//            @Override
//            public void onClick(Button button, EventObject e) {
//                Record[] records = cbSelectionModel.getSelections();
//                if (records.length == 1) {
//                    selecionado = records[0].getAsString("iddetalleingreso");
//                    selecionado2 = records[0].getAsString("codigo");
//
// String enlace = "funcion=verIngresosMarcaEstiloModeloHTMLtiendas&idmarca=" + idmarca + "&idtienda="+idtienda + "&modelo="+selecionado2 + "&idtienda="+selecionado;
//             verReporte(enlace);
//
//                        }
//
//                cambiarestilo.setPressed(false);
//            }
//        });
//    }

         private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
    private void quitarEsteItem(Record quitar) {

        store.remove(quitar);
        grid.setStore(store);
        grid.startEditing(0, 0);
    }

    public void initDescuentoEspecial(String opcion) {
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
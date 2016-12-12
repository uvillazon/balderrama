/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONString;
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
import com.gwtext.client.widgets.grid.GridEditor;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import com.gwtext.client.widgets.grid.event.GridCellListenerAdapter;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;

/**
 *
 * @author example
 */
public class ListaCalzadoRebaja {

    private EditorGridPanel grid;
   // private final int ALTO = 355;
     private final int ALTO = 250;
    private ToolbarButton eliminarProducto;
      PagingToolbar pagingToolbar1124;
    String selecionado1124 = "";
     private String[] coleccionM;
   private ComboBox com_coleccion;
    private String[] estiloM;
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
 //   private ColumnConfig totalcajasColumn;
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
    private ColumnConfig precio1Column;
    private ColumnConfig cantidadColumn;
    private ColumnConfig totalColumn;
    private ColumnConfig tipoventaColumn;
    private ColorPedido colorpedido;
    private MaterialPedido materialpedido;
    private Object[][] clienteM;
     private Object[][] coleccionMO;
      private Object[][] estiloMO;
    private String idpedido;
      private String nombremarca;
        private String idestilo;
     private String opcion;
    private Object[][] vendedorM;
    private Object[][] colorM;
    private Object[][] materialM;
     String[] nombreCaso5Columns = {"iddetalleingreso","coleccion", "codigo", "color", "precio","cantidadpares", "totalbs","precionuevo", "totalbsnuevo", "diferencia"};
    
    private RecordDef recordDef;

    private ColumnConfig coleccionColumn;

    public void onModuleLoad5() {
        panel = new Panel();

         dataProxy = new ScriptTagProxy("");
         recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso5Columns[0]),
                    new StringFieldDef(nombreCaso5Columns[1]),
                    new StringFieldDef(nombreCaso5Columns[2]),
                    new StringFieldDef(nombreCaso5Columns[3]),
                    new FloatFieldDef(nombreCaso5Columns[4]),
                    new FloatFieldDef(nombreCaso5Columns[5]),
                    new FloatFieldDef(nombreCaso5Columns[6]),
                    new FloatFieldDef(nombreCaso5Columns[7]),
                    new FloatFieldDef(nombreCaso5Columns[8]),
                    new FloatFieldDef(nombreCaso5Columns[9])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso5Columns[0], 100, true);
        coleccionColumn = new ColumnConfig("Col.", nombreCaso5Columns[1], 80, true);

        codigoColumn = new ColumnConfig("Modelo", nombreCaso5Columns[2], 100, true);
         colorColumn = new ColumnConfig("Color", nombreCaso5Columns[3], 120, true);
        precioColumn = new ColumnConfig("Precio", nombreCaso5Columns[4], 100, true);

        talla33Column = new ColumnConfig("Cantidad", nombreCaso5Columns[5], 100, true, null);
        talla34Column = new ColumnConfig("Total", nombreCaso5Columns[6], 100, true, null);
        talla35Column = new ColumnConfig("Precio Nuevo", nombreCaso5Columns[7], 100, true, null);
        talla36Column = new ColumnConfig("Total nuevo", nombreCaso5Columns[8], 100, true, null);
        talla37Column = new ColumnConfig("Diferencia", nombreCaso5Columns[9], 100, true, null);

 talla35Column.setEditor(new GridEditor(metodoFeli()));
       // talla35Column.setEditor(new GridEditor(metodoFeli()));

//        //num_field4.setMaxValue(1000);
//        colorColumn.setEditor(new GridEditor(metodoFeli()));
//        materialColumn.setEditor(new GridEditor(metodoFeli()));



        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    coleccionColumn,
                    codigoColumn,
                    colorColumn,
                    precioColumn,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column
                };


        columnModel = new ColumnModel(columns);

       grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);

        grid.setTitle("Lista de Modelos");
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
  grid.addGridCellListener(new GridCellListenerAdapter() {
            @Override
             public void onCellClick(GridPanel grid, int rowIndex, int colIndex, EventObject e) {
                 if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor") &&
                         e.getTarget(".checkbox", 1) != null) {
                     Record record = grid.getStore().getAt(rowIndex);
                     record.set("indoor", !record.getAsBoolean("indoor"));
                 }
             }
         });


        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);



        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
        pagingToolbar.addSeparator();

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

                com_coleccion.addListener(new TextFieldListenerAdapter() {

                    @Override
                    public void onSpecialKey(Field field, EventObject e) {
                        if (e.getKey() == EventObject.ENTER) {
                            buscarSegunParametros();
                        //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 2");
                        }
                    }
                });
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
                            new UrlParam("buscarcoleccion", com_coleccion.getText()),new UrlParam("buscarestilo", com_estilo.getText())}, false);
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
   



}
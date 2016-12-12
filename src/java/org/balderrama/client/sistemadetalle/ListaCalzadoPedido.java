/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

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
public class ListaCalzadoPedido {

    private EditorGridPanel grid;
    private final int ALTO = 250;
    private ToolbarButton eliminarProducto;
      private ToolbarButton Producto;
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
     private PanelPedidoE SM;
       private String[] tipoM;
    String selecionado = "";
      String codigo ;
        String marca ;
        String opcion;
    private Panel panel;
     private Object[][] colorM;
     private Object[][] materialM;
  private Object[][] clienteM;
   private Object[][] vendedorM;
     private ColumnConfig codigoColumn;
    private ColumnConfig colorColumn;
     private ColumnConfig talla;
    private ColumnConfig materialColumn;
    private ColumnConfig vendedorColumn;
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
        private ColumnConfig fechaColumn;
           private String idmarca;

        private String cod;
    private String mat;
     private String col;
       private String cli;
         private String vend;
         private String fecha;
         private String caj;
           private String prec;
             private String uni;
               private String t1;
                 private String t2;
                   private String t3;
                     private String t4;
                       private String t5;
                         private String t6;
                           private String t7;
                 private String t8;
                   private String t9;
                     private String t10;


                      private String t14;
                 private String t15;
                  private String t16;
                   private String t17;
                    private String t18;
                     private String t19;
                      private String t20;
                       private String t21;
                        private String t22;
                         private String t23;
                          private String t24;
                           private String t25;
                            private String t26;
                             private String t27;
                              private String t28;
                               private String t29;
                                private String t30;
                                 private String t31;
                                  private String t32;
                                   private String t33;
                                    private String t34;
                                    private String t35;
                                     private String t36;
                                    private String t37;
                                    private String t38;



                       private String tpar;
                         private String cparc;
                         private String parbs;
//    private ColorPedido colorpedido;
 //   private MaterialPedido materialpedido;
    //opcion 9
    String[] nombreCaso5Columns = {"idmodelo", "codigo", "material","color","cliente","vendedor", "fecha","totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42",  "totalpares","totalparescaja",  "totalparesbs"};
    String[] nombreCaso55Columns = {"idmodelo", "codigo", "material","color","cliente","vendedor", "fecha","talla","totalcajas","precio","preciounitario","36", "37", "38", "39", "40", "41", "42", "43", "44", "45",  "totalpares","totalparescaja",  "totalparesbs"};
    String[] nombreCaso8Columns = {"idmodelo", "codigo", "material","cliente","vendedor","fecha", "totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalpares","totalparescaja",  "totalparesbs"};
    String[] nombreCaso88Columns = {"idmodelo", "codigo", "cliente", "vendedor","fecha","totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "totalpares","totalparescaja",  "totalparesbs"};
    String[] nombreCaso10Columns = {"idmodelo", "codigo", "cliente","vendedor","fecha", "totalcajas","precio","preciounitario","14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38",  "totalpares","totalparescaja",  "totalparesbs"};
    String[] nombreCaso11Columns = {"idmodelo","codigo", "color","cliente","vendedor","fecha", "totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45","totalpares","totalparescaja",  "totalparesbs"};
    String[] nombreCaso12Columns = {"idmodelo", "codigo", "color","cliente","vendedor","fecha", "totalcajas","precio","preciounitario","14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38",  "totalpares","totalparescaja",  "totalparesbs"};
    String[] nombreCaso13Columns = {"idmodelo", "codigo", "material","color","cliente","vendedor","fecha", "totalcajas","precio","preciounitario","14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38",  "totalpares","totalparescaja",  "totalparesbs"};
    String[] nombreCaso99Columns = {"idmodelo","codigo", "material","color","cliente","vendedor","fecha","talla","totalcajas","precio","preciounitario", "34","35", "36", "37", "38", "39", "40", "totalpares","totalparescaja",  "totalparesbs"};
    String[] nombreCaso15Columns = {"idmodelo","codigo", "color","cliente","vendedor","fecha", "totalcajas","precio","preciounitario","26", "27", "28", "29", "30", "31", "32","33", "34", "35", "36", "37", "38", "totalpares","totalparescaja",  "totalparesbs"};

    private RecordDef recordDef;
    private Object[][] lineaM;
    private PanelPedidoE padre;
 public void onModuleLoad99( final Object[][] colorM1,Object[][] materialM1,Object[][] cliente,Object[][] vendedor,String[] tipo,String idmar) {

         this.vendedorM = vendedor;
         this.colorM = colorM1;
         this.tipoM = tipo;
              this.materialM = materialM1;
                this.clienteM = cliente;
this.idmarca = idmar;
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        dataProxy = new ScriptTagProxy("");
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso99Columns[0]),
                    new StringFieldDef(nombreCaso99Columns[1]),
                    new StringFieldDef(nombreCaso99Columns[2]),
                    new StringFieldDef(nombreCaso99Columns[3]),
                    new StringFieldDef(nombreCaso99Columns[4]),
                    new StringFieldDef(nombreCaso99Columns[5]),
                    new StringFieldDef(nombreCaso99Columns[6]),
                    new StringFieldDef(nombreCaso99Columns[7]),
                    new FloatFieldDef(nombreCaso99Columns[8]),
                    new FloatFieldDef(nombreCaso99Columns[9]),
                    new FloatFieldDef(nombreCaso99Columns[10]),
                    new FloatFieldDef(nombreCaso99Columns[11]),
                    new FloatFieldDef(nombreCaso99Columns[12]),
                    new FloatFieldDef(nombreCaso99Columns[13]),
                    new FloatFieldDef(nombreCaso99Columns[14]),
                    new FloatFieldDef(nombreCaso99Columns[15]),
                    new FloatFieldDef(nombreCaso99Columns[16]),
                    new FloatFieldDef(nombreCaso99Columns[17]),
                    new FloatFieldDef(nombreCaso99Columns[18]),
                    new FloatFieldDef(nombreCaso99Columns[19]),
                    new FloatFieldDef(nombreCaso99Columns[20])

                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso99Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso99Columns[1], 80, true);
        materialColumn = new ColumnConfig("Material", nombreCaso99Columns[2], 100, true);

        colorColumn = new ColumnConfig("Color", nombreCaso99Columns[3], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso99Columns[4], 100, true);
        SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, clienteM);
        paisStore1.load();
        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);
        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);
        clienteColumn.setEditor(new GridEditor(cbVendedor));

vendedorColumn = new ColumnConfig("Vendedor", nombreCaso99Columns[5], 100, true);
        SimpleStore paisStore12 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        paisStore12.load();
        final ComboBox cbVendedor1 = new ComboBox();
        cbVendedor1.setStore(paisStore12);
        cbVendedor1.setDisplayField("codigo");
        cbVendedor1.setFieldLabel("codigo");
        cbVendedor1.setValueField("codigo");
        cbVendedor1.setMinChars(1);
        vendedorColumn.setEditor(new GridEditor(cbVendedor1));

        fechaColumn = new ColumnConfig("Ingreso", nombreCaso99Columns[6], 80, true);
     //fechaColumn.setEditor(new GridEditor(metodoFeli()));
  talla = new ColumnConfig("Talla", nombreCaso99Columns[7], 50, true);
  SimpleStore tiposStore = new SimpleStore("talla", tipoM);
        tiposStore.load();
         ComboBox com_cliente = new ComboBox();
      //  com_cliente.setStore(paisStore1);
        com_cliente.setDisplayField("talla");
        com_cliente.setStore(tiposStore);
  talla.setEditor(new GridEditor(com_cliente));

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso99Columns[8], 65, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso99Columns[9], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso99Columns[10], 55, true);

        talla34Column = new ColumnConfig("Unidad", nombreCaso99Columns[11], 30, true, null);
        talla35Column = new ColumnConfig("XS", nombreCaso99Columns[12], 30, true, null);
        talla36Column = new ColumnConfig("S", nombreCaso99Columns[13], 30, true, null);
        talla37Column = new ColumnConfig("P", nombreCaso99Columns[14], 30, true, null);
        talla38Column = new ColumnConfig("M", nombreCaso99Columns[15], 30, true, null);
        talla39Column = new ColumnConfig("L", nombreCaso99Columns[16], 30, true, null);
        talla40Column = new ColumnConfig("XL", nombreCaso99Columns[17], 30, true, null);
         totalparesColumn = new ColumnConfig("Tot. Unidades", nombreCaso99Columns[18], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso99Columns[19], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso99Columns[20], 80, true, null);
 TextField tex_detallea1 = new TextField();
       fechaColumn.setEditor(new GridEditor(tex_detallea1));
        TextField tex_detalle = new TextField();
        colorColumn.setEditor(new GridEditor(tex_detalle));
         TextField tex_detalle1 = new TextField();
        materialColumn.setEditor(new GridEditor(tex_detalle1));
       // precioColumn.setEditor(new GridEditor(metodoFeli()));
         NumberField numberField = new NumberField();
        numberField.setAllowBlank(false);
        numberField.setAllowNegative(false);
        numberField.setMaxValue(1000);
        precioColumn.setEditor(new GridEditor(numberField));

        preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
      
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
        talla39Column.setEditor(new GridEditor(metodoFeli()));
        talla40Column.setEditor(new GridEditor(metodoFeli()));
        

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    colorColumn,
                    clienteColumn,
                    vendedorColumn,
                    fechaColumn,
                     talla,
                    totalcajasColumn,
                    precioColumn,
                   // preciounitarioColumn,
                   
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                    talla39Column,
                    talla40Column,
                   totalparescajaColumn,
                    totalparesbsColumn
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

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        eliminarProducto.setTooltip(tipsConfig2);


         Producto = new ToolbarButton("Copiar Modelo");
        Producto.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        Producto.setTooltip(tipsConfig21);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(Producto);
        grid.setBottomToolbar(pagingToolbar);

//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();

     aniadirListenersProductoEspecial();
        panel.add(grid);
    }


     public void onModuleLoad55( final Object[][] colorM1,Object[][] materialM1,Object[][] cliente,Object[][] vendedor,String[] tipo,String idmar) {

         this.vendedorM = vendedor;
         this.colorM = colorM1;
         this.tipoM = tipo;
              this.materialM = materialM1;
                this.clienteM = cliente;

this.idmarca = idmar;
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        dataProxy = new ScriptTagProxy("");
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso55Columns[0]),
                    new StringFieldDef(nombreCaso55Columns[1]),
                    new StringFieldDef(nombreCaso55Columns[2]),
                    new StringFieldDef(nombreCaso55Columns[3]),
                    new StringFieldDef(nombreCaso55Columns[4]),
                    new StringFieldDef(nombreCaso55Columns[5]),
                    new StringFieldDef(nombreCaso55Columns[6]),
                    new StringFieldDef(nombreCaso55Columns[7]),
                    new FloatFieldDef(nombreCaso55Columns[8]),
                    new FloatFieldDef(nombreCaso55Columns[9]),
                    new FloatFieldDef(nombreCaso55Columns[10]),
                    new FloatFieldDef(nombreCaso55Columns[11]),
                    new FloatFieldDef(nombreCaso55Columns[12]),
                    new FloatFieldDef(nombreCaso55Columns[13]),
                    new FloatFieldDef(nombreCaso55Columns[14]),
                    new FloatFieldDef(nombreCaso55Columns[15]),
                    new FloatFieldDef(nombreCaso55Columns[16]),
                    new FloatFieldDef(nombreCaso55Columns[17]),
                    new FloatFieldDef(nombreCaso55Columns[18]),
                    new FloatFieldDef(nombreCaso55Columns[19]),
                    new FloatFieldDef(nombreCaso55Columns[20]),
                    new FloatFieldDef(nombreCaso55Columns[21]),
                    new FloatFieldDef(nombreCaso55Columns[22]),
                    new FloatFieldDef(nombreCaso55Columns[23])

                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso55Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso55Columns[1], 100, true);
        materialColumn = new ColumnConfig("Material", nombreCaso55Columns[2], 100, true);

        colorColumn = new ColumnConfig("Color", nombreCaso55Columns[3], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso55Columns[4], 100, true);
        SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, clienteM);
        paisStore1.load();
        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);
        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);
        clienteColumn.setEditor(new GridEditor(cbVendedor));

vendedorColumn = new ColumnConfig("Vendedor", nombreCaso55Columns[5], 100, true);
        SimpleStore paisStore12 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        paisStore12.load();
        final ComboBox cbVendedor1 = new ComboBox();
        cbVendedor1.setStore(paisStore12);
        cbVendedor1.setDisplayField("codigo");
        cbVendedor1.setFieldLabel("codigo");
        cbVendedor1.setValueField("codigo");
        cbVendedor1.setMinChars(1);
        vendedorColumn.setEditor(new GridEditor(cbVendedor1));

        fechaColumn = new ColumnConfig("Ingreso", nombreCaso55Columns[6], 80, true);
     //fechaColumn.setEditor(new GridEditor(metodoFeli()));
  talla = new ColumnConfig("Talla", nombreCaso55Columns[7], 50, true);
  SimpleStore tiposStore = new SimpleStore("talla", tipoM);
        tiposStore.load();
         ComboBox com_cliente = new ComboBox();
      //  com_cliente.setStore(paisStore1);
        com_cliente.setDisplayField("talla");
        com_cliente.setStore(tiposStore);
  talla.setEditor(new GridEditor(com_cliente));

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso55Columns[8], 65, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso55Columns[9], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso55Columns[10], 55, true);
        talla33Column = new ColumnConfig("36", nombreCaso55Columns[11], 30, true, null);
        talla34Column = new ColumnConfig("37", nombreCaso55Columns[12], 30, true, null);
        talla35Column = new ColumnConfig("38", nombreCaso55Columns[13], 30, true, null);
        talla36Column = new ColumnConfig("39", nombreCaso55Columns[14], 30, true, null);
        talla37Column = new ColumnConfig("40", nombreCaso55Columns[15], 30, true, null);
        talla38Column = new ColumnConfig("41", nombreCaso55Columns[16], 30, true, null);
        talla39Column = new ColumnConfig("42", nombreCaso55Columns[17], 30, true, null);
        talla40Column = new ColumnConfig("43", nombreCaso55Columns[18], 30, true, null);
        talla41Column = new ColumnConfig("44", nombreCaso55Columns[19], 30, true, null);
        talla42Column = new ColumnConfig("45", nombreCaso55Columns[20], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso55Columns[21], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso55Columns[22], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso55Columns[23], 80, true, null);
 TextField tex_detallea1 = new TextField();
       fechaColumn.setEditor(new GridEditor(tex_detallea1));
        TextField tex_detalle = new TextField();
        colorColumn.setEditor(new GridEditor(tex_detalle));
         TextField tex_detalle1 = new TextField();
        materialColumn.setEditor(new GridEditor(tex_detalle1));
        precioColumn.setEditor(new GridEditor(metodoFeli()));
        preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
        talla39Column.setEditor(new GridEditor(metodoFeli()));
        talla40Column.setEditor(new GridEditor(metodoFeli()));
        talla41Column.setEditor(new GridEditor(metodoFeli()));
        talla42Column.setEditor(new GridEditor(metodoFeli()));
       TextField tex_detallea = new TextField();
        totalcajasColumn.setEditor(new GridEditor(tex_detallea));

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    colorColumn,
                    clienteColumn,
                    vendedorColumn,
                    fechaColumn,
                     talla,
                    totalcajasColumn,
                    precioColumn,
                    preciounitarioColumn,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                    talla39Column,
                    talla40Column,
                    talla41Column,
                    talla42Column,
                   totalparescajaColumn,
                    totalparesbsColumn
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

       eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        eliminarProducto.setTooltip(tipsConfig2);


         Producto = new ToolbarButton("Copiar Modelo");
        Producto.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        Producto.setTooltip(tipsConfig21);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(Producto);
        grid.setBottomToolbar(pagingToolbar);

//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();

     aniadirListenersProductoEspecial();
        panel.add(grid);
    }


//ramarimverificado
    public void onModuleLoad5( final Object[][] colorM1,Object[][] materialM1,Object[][] cliente,Object[][] vendedor,String idmar,PanelPedidoE pad) {
            this.colorM = colorM1;
              this.materialM = materialM1;
                this.clienteM = cliente;
                 this.vendedorM = vendedor;
this.idmarca = idmar;
this.padre =pad;
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
                    new FloatFieldDef(nombreCaso5Columns[7]),
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
                    new FloatFieldDef(nombreCaso5Columns[22])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso5Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso5Columns[1], 100, true);
        materialColumn = new ColumnConfig("Material", nombreCaso5Columns[2], 100, true);

        colorColumn = new ColumnConfig("Color", nombreCaso5Columns[3], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso5Columns[4], 100, true);
        SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, clienteM);
        paisStore1.load();
        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);
        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);
        clienteColumn.setEditor(new GridEditor(cbVendedor));

vendedorColumn = new ColumnConfig("Vendedor", nombreCaso5Columns[5], 100, true);
        SimpleStore paisStore12 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        paisStore12.load();
        final ComboBox cbVendedor1 = new ComboBox();
        cbVendedor1.setStore(paisStore12);
        cbVendedor1.setDisplayField("codigo");
        cbVendedor1.setFieldLabel("codigo");
        cbVendedor1.setValueField("codigo");
        cbVendedor1.setMinChars(1);
        vendedorColumn.setEditor(new GridEditor(cbVendedor1));

        fechaColumn = new ColumnConfig("Ingreso", nombreCaso5Columns[6], 80, true);
    // fechaColumn.setEditor(new GridEditor(metodoFeli()));

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso5Columns[7], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso5Columns[8], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso5Columns[9], 100, true);
        talla33Column = new ColumnConfig("33", nombreCaso5Columns[10], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso5Columns[11], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso5Columns[12], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso5Columns[13], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso5Columns[14], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso5Columns[15], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso5Columns[16], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso5Columns[17], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso5Columns[18], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso5Columns[19], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso5Columns[20], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso5Columns[21], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso5Columns[22], 80, true, null);
  TextField tex_detallea1 = new TextField();
       fechaColumn.setEditor(new GridEditor(tex_detallea1));
        TextField tex_detalle = new TextField();
        colorColumn.setEditor(new GridEditor(tex_detalle));
         TextField tex_detalle1 = new TextField();
        materialColumn.setEditor(new GridEditor(tex_detalle1));
        precioColumn.setEditor(new GridEditor(metodoFeli()));
        preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
        talla39Column.setEditor(new GridEditor(metodoFeli()));
        talla40Column.setEditor(new GridEditor(metodoFeli()));
        talla41Column.setEditor(new GridEditor(metodoFeli()));
        talla42Column.setEditor(new GridEditor(metodoFeli()));
       TextField tex_detallea = new TextField();
        totalcajasColumn.setEditor(new GridEditor(tex_detallea));
      
        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    colorColumn,
                    clienteColumn,
                    vendedorColumn,
                    fechaColumn,
                    totalcajasColumn,
                    precioColumn,
                    preciounitarioColumn,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                    talla39Column,
                    talla40Column,
                    talla41Column,
                    talla42Column,
                   totalparescajaColumn,
                    totalparesbsColumn
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

      eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        eliminarProducto.setTooltip(tipsConfig2);


         Producto = new ToolbarButton("Copiar Modelo");
        Producto.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        Producto.setTooltip(tipsConfig21);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(Producto);
        grid.setBottomToolbar(pagingToolbar);

//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();

     aniadirListenersProductoEspecial();
        panel.add(grid);
    }


    public void onModuleLoad8(Object[][] materialM1,Object[][] cliente,Object[][] vendedor,String idmar) {
             this.vendedorM = vendedor;
              this.materialM = materialM1;
                this.clienteM = cliente;
this.idmarca=idmar;
        panel = new Panel();
  
        //panel.setId("panel-lista-productosproveedor");
        dataProxy = new ScriptTagProxy("");
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso8Columns[0]),
                    new StringFieldDef(nombreCaso8Columns[1]),
                    new StringFieldDef(nombreCaso8Columns[2]),
                    new StringFieldDef(nombreCaso8Columns[3]),
                    new StringFieldDef(nombreCaso8Columns[4]),
                    new StringFieldDef(nombreCaso8Columns[5]),
                    new FloatFieldDef(nombreCaso8Columns[6]),
                    new FloatFieldDef(nombreCaso8Columns[7]),
                    new FloatFieldDef(nombreCaso8Columns[8]),
                    new FloatFieldDef(nombreCaso8Columns[9]),
                    new FloatFieldDef(nombreCaso8Columns[10]),
                    new FloatFieldDef(nombreCaso8Columns[11]),
                    new FloatFieldDef(nombreCaso8Columns[12]),
                    new FloatFieldDef(nombreCaso8Columns[13]),
                    new FloatFieldDef(nombreCaso8Columns[14]),
                    new FloatFieldDef(nombreCaso8Columns[15]),
                    new FloatFieldDef(nombreCaso8Columns[16]),
                    new FloatFieldDef(nombreCaso8Columns[17]),
                    new FloatFieldDef(nombreCaso8Columns[18]),
                    new FloatFieldDef(nombreCaso8Columns[19]),
                    new FloatFieldDef(nombreCaso8Columns[20]),
                    new FloatFieldDef(nombreCaso8Columns[21]),
                    new FloatFieldDef(nombreCaso8Columns[22]),
                    new FloatFieldDef(nombreCaso8Columns[23]),
                    new FloatFieldDef(nombreCaso8Columns[24])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso8Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso8Columns[1], 100, true);
        materialColumn = new ColumnConfig("Material", nombreCaso8Columns[2], 100, true);
      clienteColumn = new ColumnConfig("Cliente", nombreCaso8Columns[3], 100, true);
        SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, clienteM);
        paisStore1.load();
        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);
        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);
        clienteColumn.setEditor(new GridEditor(cbVendedor));

vendedorColumn = new ColumnConfig("Vendedor", nombreCaso8Columns[4], 100, true);
        SimpleStore paisStore12 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        paisStore12.load();
        final ComboBox cbVendedor1 = new ComboBox();
        cbVendedor1.setStore(paisStore12);
        cbVendedor1.setDisplayField("codigo");
        cbVendedor1.setFieldLabel("codigo");
        cbVendedor1.setValueField("codigo");
        cbVendedor1.setMinChars(1);
        vendedorColumn.setEditor(new GridEditor(cbVendedor1));

        fechaColumn = new ColumnConfig("Ingreso", nombreCaso8Columns[5], 80, true);
    // fechaColumn.setEditor(new GridEditor(metodoFeli()));

          totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso8Columns[6], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso8Columns[7], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso8Columns[8], 100, true);
        talla33Column = new ColumnConfig("33", nombreCaso8Columns[9], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso8Columns[10], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso8Columns[11], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso8Columns[12], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso8Columns[13], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso8Columns[14], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso8Columns[15], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso8Columns[16], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso8Columns[17], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso8Columns[18], 30, true, null);
        talla43Column = new ColumnConfig("43", nombreCaso8Columns[19], 30, true, null);
        talla44Column = new ColumnConfig("44", nombreCaso8Columns[20], 30, true, null);
        talla45Column = new ColumnConfig("45", nombreCaso8Columns[21], 30, true, null);

        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso8Columns[22], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso8Columns[23], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso8Columns[24], 80, true, null);
     TextField tex_detallea1 = new TextField();
       fechaColumn.setEditor(new GridEditor(tex_detallea1));
        TextField tex_detalle1 = new TextField();
        materialColumn.setEditor(new GridEditor(tex_detalle1));
       precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
        talla39Column.setEditor(new GridEditor(metodoFeli()));
        talla40Column.setEditor(new GridEditor(metodoFeli()));
        talla41Column.setEditor(new GridEditor(metodoFeli()));
        talla42Column.setEditor(new GridEditor(metodoFeli()));
   talla43Column.setEditor(new GridEditor(metodoFeli()));
        talla44Column.setEditor(new GridEditor(metodoFeli()));
        talla45Column.setEditor(new GridEditor(metodoFeli()));

TextField tex_detallea = new TextField();
        totalcajasColumn.setEditor(new GridEditor(tex_detallea));


        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                     materialColumn,
                    clienteColumn,
                     vendedorColumn,
                      fechaColumn,
                    totalcajasColumn,
                    precioColumn,
                    preciounitarioColumn,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                    talla39Column,
                    talla40Column,
                    talla41Column,
                    talla42Column,
                    talla43Column,
                    talla44Column,
                    talla45Column,
                   totalparescajaColumn,
                    totalparesbsColumn
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

       eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        eliminarProducto.setTooltip(tipsConfig2);


         Producto = new ToolbarButton("Copiar Modelo");
        Producto.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        Producto.setTooltip(tipsConfig21);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(Producto);
        grid.setBottomToolbar(pagingToolbar);

//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();

     aniadirListenersProductoEspecial();
        panel.add(grid);
    }

    public void onModuleLoad88(Object[][] cliente,Object[][] vendedor) {
               this.clienteM = cliente;
             this.vendedorM = vendedor;
        panel = new Panel();
       // String[] nombreCaso88Columns = {"idmodelo", "codigo", "cliente", "vendedor","fecha","totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "totalpares","totalparescaja",  "totalparesbs"};

        //panel.setId("panel-lista-productosproveedor");
        dataProxy = new ScriptTagProxy("");
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso88Columns[0]),
                    new StringFieldDef(nombreCaso88Columns[1]),
                    new StringFieldDef(nombreCaso88Columns[2]),
                    new StringFieldDef(nombreCaso88Columns[3]),
                    new StringFieldDef(nombreCaso88Columns[4]),
                    new FloatFieldDef(nombreCaso88Columns[5]),
                    new FloatFieldDef(nombreCaso88Columns[6]),
                    new FloatFieldDef(nombreCaso88Columns[7]),
                    new FloatFieldDef(nombreCaso88Columns[8]),
                    new FloatFieldDef(nombreCaso88Columns[9]),
                    new FloatFieldDef(nombreCaso88Columns[10]),
                    new FloatFieldDef(nombreCaso88Columns[11]),
                    new FloatFieldDef(nombreCaso88Columns[12]),
                    new FloatFieldDef(nombreCaso88Columns[13]),
                    new FloatFieldDef(nombreCaso88Columns[14]),
                    new FloatFieldDef(nombreCaso88Columns[15]),
                    new FloatFieldDef(nombreCaso88Columns[16]),
                    new FloatFieldDef(nombreCaso88Columns[17]),
                    new FloatFieldDef(nombreCaso88Columns[18]),
                    new FloatFieldDef(nombreCaso88Columns[19]),
                    new FloatFieldDef(nombreCaso88Columns[20])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso88Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso88Columns[1], 100, true);
        clienteColumn = new ColumnConfig("Cliente", nombreCaso88Columns[2], 100, true);
         SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, clienteM);
        //SimpleStore paisStore = new SimpleStore(new String[]{"idcliente", "codigo"},nombreCaso3Columns[2]);
        paisStore1.load();

        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);


        clienteColumn.setEditor(new GridEditor(cbVendedor));

vendedorColumn = new ColumnConfig("Vendedor", nombreCaso88Columns[3], 100, true);
        SimpleStore paisStore12 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        paisStore12.load();
        final ComboBox cbVendedor1 = new ComboBox();
        cbVendedor1.setStore(paisStore12);
        cbVendedor1.setDisplayField("codigo");
        cbVendedor1.setFieldLabel("codigo");
        cbVendedor1.setValueField("codigo");
        cbVendedor1.setMinChars(1);
        vendedorColumn.setEditor(new GridEditor(cbVendedor1));

        fechaColumn = new ColumnConfig("Ingreso", nombreCaso88Columns[4], 80, true);
    // fechaColumn.setEditor(new GridEditor(metodoFeli()));

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso88Columns[5], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso88Columns[6], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso88Columns[7], 100, true);
        talla33Column = new ColumnConfig("33", nombreCaso88Columns[8], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso88Columns[9], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso88Columns[10], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso88Columns[11], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso88Columns[12], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso88Columns[13], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso88Columns[14], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso88Columns[15], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso88Columns[16], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso88Columns[17], 30, true, null);

        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso88Columns[18], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso88Columns[19], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso88Columns[20], 80, true, null);
 TextField tex_detallea1 = new TextField();
       fechaColumn.setEditor(new GridEditor(tex_detallea1));
       precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
        talla39Column.setEditor(new GridEditor(metodoFeli()));
        talla40Column.setEditor(new GridEditor(metodoFeli()));
        talla41Column.setEditor(new GridEditor(metodoFeli()));
        talla42Column.setEditor(new GridEditor(metodoFeli()));
TextField tex_detallea = new TextField();
        totalcajasColumn.setEditor(new GridEditor(tex_detallea));


        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    clienteColumn,
                    vendedorColumn,
                    fechaColumn,
                    totalcajasColumn,
                  precioColumn,
                    preciounitarioColumn,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                    talla39Column,
                    talla40Column,
                    talla41Column,
                    talla42Column,
                   totalparescajaColumn,
                    totalparesbsColumn
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

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        eliminarProducto.setTooltip(tipsConfig2);


         Producto = new ToolbarButton("Copiar Modelo");
        Producto.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        Producto.setTooltip(tipsConfig21);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(Producto);
        grid.setBottomToolbar(pagingToolbar);

//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();

     aniadirListenersProductoEspecial();
        panel.add(grid);
    }


    public void onModuleLoad10(Object[][] cliente,Object[][] vendedor) {
               this.clienteM = cliente;
                this.vendedorM = vendedor;
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");

        dataProxy = new ScriptTagProxy("");
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso10Columns[0]),
                    new StringFieldDef(nombreCaso10Columns[1]),
                    new StringFieldDef(nombreCaso10Columns[2]),
                    new StringFieldDef(nombreCaso10Columns[3]),
                    new StringFieldDef(nombreCaso10Columns[4]),
                    new FloatFieldDef(nombreCaso10Columns[5]),
                    new FloatFieldDef(nombreCaso10Columns[6]),
                    new FloatFieldDef(nombreCaso10Columns[7]),
                    new FloatFieldDef(nombreCaso10Columns[8]),
                    new FloatFieldDef(nombreCaso10Columns[9]),
                    new FloatFieldDef(nombreCaso10Columns[10]),
                    new FloatFieldDef(nombreCaso10Columns[11]),
                    new FloatFieldDef(nombreCaso10Columns[12]),
                    new FloatFieldDef(nombreCaso10Columns[13]),
                    new FloatFieldDef(nombreCaso10Columns[14]),
                    new FloatFieldDef(nombreCaso10Columns[15]),
                    new FloatFieldDef(nombreCaso10Columns[16]),
                    new FloatFieldDef(nombreCaso10Columns[17]),
                    new FloatFieldDef(nombreCaso10Columns[18]),
                    new FloatFieldDef(nombreCaso10Columns[19]),
                    new FloatFieldDef(nombreCaso10Columns[20]),
                    new FloatFieldDef(nombreCaso10Columns[21]),
                    new FloatFieldDef(nombreCaso10Columns[22]),
                    new FloatFieldDef(nombreCaso10Columns[23]),
                    new FloatFieldDef(nombreCaso10Columns[24]),
                    new FloatFieldDef(nombreCaso10Columns[25]),
                    new FloatFieldDef(nombreCaso10Columns[26]),
                    new FloatFieldDef(nombreCaso10Columns[27]),
                    new FloatFieldDef(nombreCaso10Columns[28]),
                    new FloatFieldDef(nombreCaso10Columns[29]),
                    new FloatFieldDef(nombreCaso10Columns[30]),
                    new FloatFieldDef(nombreCaso10Columns[31]),
                    new FloatFieldDef(nombreCaso10Columns[32]),
                    new FloatFieldDef(nombreCaso10Columns[33]),
                    new FloatFieldDef(nombreCaso10Columns[34]),
                    new FloatFieldDef(nombreCaso10Columns[35])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
         idColumn = new ColumnConfig("Id modelo", nombreCaso10Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso10Columns[1], 100, true);
        clienteColumn = new ColumnConfig("Cliente", nombreCaso10Columns[2], 100, true);
         SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, clienteM);
        //SimpleStore paisStore = new SimpleStore(new String[]{"idcliente", "codigo"},nombreCaso3Columns[2]);
        paisStore1.load();

        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);


        clienteColumn.setEditor(new GridEditor(cbVendedor));

vendedorColumn = new ColumnConfig("Vendedor", nombreCaso10Columns[3], 100, true);
        SimpleStore paisStore12 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        paisStore12.load();
        final ComboBox cbVendedor1 = new ComboBox();
        cbVendedor1.setStore(paisStore12);
        cbVendedor1.setDisplayField("codigo");
        cbVendedor1.setFieldLabel("codigo");
        cbVendedor1.setValueField("codigo");
        cbVendedor1.setMinChars(1);
        vendedorColumn.setEditor(new GridEditor(cbVendedor1));

        fechaColumn = new ColumnConfig("Ingreso", nombreCaso10Columns[4], 80, true);
    // fechaColumn.setEditor(new GridEditor(metodoFeli()));

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso10Columns[5], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso10Columns[6], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso10Columns[7], 100, true);
        talla14Column = new ColumnConfig("14", nombreCaso10Columns[8], 30, true, null);
        talla15Column = new ColumnConfig("15", nombreCaso10Columns[9], 30, true, null);
        talla16Column = new ColumnConfig("16", nombreCaso10Columns[10], 30, true, null);
        talla17Column = new ColumnConfig("17", nombreCaso10Columns[11], 30, true, null);
        talla18Column = new ColumnConfig("18", nombreCaso10Columns[12], 30, true, null);
        talla19Column = new ColumnConfig("19", nombreCaso10Columns[13], 30, true, null);
        talla20Column = new ColumnConfig("20", nombreCaso10Columns[14], 30, true, null);
        talla21Column = new ColumnConfig("21", nombreCaso10Columns[15], 30, true, null);
        talla22Column = new ColumnConfig("22", nombreCaso10Columns[16], 30, true, null);
        talla23Column = new ColumnConfig("23", nombreCaso10Columns[17], 30, true, null);
        talla24Column = new ColumnConfig("24", nombreCaso10Columns[18], 30, true, null);
        talla25Column = new ColumnConfig("25", nombreCaso10Columns[19], 30, true, null);
        talla26Column = new ColumnConfig("26", nombreCaso10Columns[20], 30, true, null);
        talla27Column = new ColumnConfig("27", nombreCaso10Columns[21], 30, true, null);
        talla28Column = new ColumnConfig("28", nombreCaso10Columns[22], 30, true, null);
        talla29Column = new ColumnConfig("29", nombreCaso10Columns[23], 30, true, null);
        talla30Column = new ColumnConfig("30", nombreCaso10Columns[24], 30, true, null);
        talla31Column = new ColumnConfig("31", nombreCaso10Columns[25], 30, true, null);
        // talla31Column = new ColumnConfig("21", nombreCso1Columns[10], 200, true, null);
        talla32Column = new ColumnConfig("32", nombreCaso10Columns[26], 30, true, null);
        talla33Column = new ColumnConfig("33", nombreCaso10Columns[27], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso10Columns[28], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso10Columns[29], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso10Columns[30], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso10Columns[31], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso10Columns[32], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso10Columns[33], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso10Columns[34], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso10Columns[35], 80, true, null);

 TextField tex_detallea1 = new TextField();
       fechaColumn.setEditor(new GridEditor(tex_detallea1));
       precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
        talla14Column.setEditor(new GridEditor(metodoFeli()));
        talla15Column.setEditor(new GridEditor(metodoFeli()));
        talla16Column.setEditor(new GridEditor(metodoFeli()));
        talla17Column.setEditor(new GridEditor(metodoFeli()));
        talla18Column.setEditor(new GridEditor(metodoFeli()));
        talla19Column.setEditor(new GridEditor(metodoFeli()));
        talla20Column.setEditor(new GridEditor(metodoFeli()));
        talla21Column.setEditor(new GridEditor(metodoFeli()));
        talla22Column.setEditor(new GridEditor(metodoFeli()));
        talla23Column.setEditor(new GridEditor(metodoFeli()));
        talla24Column.setEditor(new GridEditor(metodoFeli()));
        talla25Column.setEditor(new GridEditor(metodoFeli()));
        talla26Column.setEditor(new GridEditor(metodoFeli()));
        talla27Column.setEditor(new GridEditor(metodoFeli()));
        talla28Column.setEditor(new GridEditor(metodoFeli()));
        talla29Column.setEditor(new GridEditor(metodoFeli()));
        talla30Column.setEditor(new GridEditor(metodoFeli()));
        talla31Column.setEditor(new GridEditor(metodoFeli()));
        talla32Column.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
   //    totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
      //  totalparesColumn.setEditor(new GridEditor(metodoFeli()));
TextField tex_detallea = new TextField();
        totalcajasColumn.setEditor(new GridEditor(tex_detallea));


        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                     codigoColumn,
                    clienteColumn,
                    vendedorColumn,
                    fechaColumn,
                     totalcajasColumn,
                    precioColumn,
                  preciounitarioColumn,
                    talla14Column,
                    talla15Column,
                    talla16Column,
                    talla17Column,
                    talla18Column,
                    talla19Column,
                    talla20Column,
                    talla21Column,
                    talla22Column,
                    talla23Column,
                    talla24Column,
                    talla25Column,
                    talla26Column,
                    talla27Column,
                    talla28Column,
                    talla29Column,
                    talla30Column,
                    talla31Column,
                    talla32Column,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                  totalparescajaColumn,
                    totalparesbsColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

       eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        eliminarProducto.setTooltip(tipsConfig2);


         Producto = new ToolbarButton("Copiar Modelo");
        Producto.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        Producto.setTooltip(tipsConfig21);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(Producto);
        grid.setBottomToolbar(pagingToolbar);
 aniadirListenersProductoEspecial();
        panel.add(grid);
    }

public void onModuleLoad12(Object[][] colorM1,Object[][] cliente,Object[][] vendedor,String idmarc) {
               this.clienteM = cliente;
                this.vendedorM = vendedor;
                 this.colorM = colorM1;
        panel = new Panel();
        this.idmarca = idmarc;
        //panel.setId("panel-lista-productosproveedor");

        dataProxy = new ScriptTagProxy("");
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso12Columns[0]),
                    new StringFieldDef(nombreCaso12Columns[1]),
                    new StringFieldDef(nombreCaso12Columns[2]),
                    new StringFieldDef(nombreCaso12Columns[3]),
                    new StringFieldDef(nombreCaso12Columns[4]),
                    new StringFieldDef(nombreCaso12Columns[5]),
                    new FloatFieldDef(nombreCaso12Columns[6]),
                    new FloatFieldDef(nombreCaso12Columns[7]),
                    new FloatFieldDef(nombreCaso12Columns[8]),
                    new FloatFieldDef(nombreCaso12Columns[9]),
                    new FloatFieldDef(nombreCaso12Columns[10]),
                    new FloatFieldDef(nombreCaso12Columns[11]),
                    new FloatFieldDef(nombreCaso12Columns[12]),
                    new FloatFieldDef(nombreCaso12Columns[13]),
                    new FloatFieldDef(nombreCaso12Columns[14]),
                    new FloatFieldDef(nombreCaso12Columns[15]),
                    new FloatFieldDef(nombreCaso12Columns[16]),
                    new FloatFieldDef(nombreCaso12Columns[17]),
                    new FloatFieldDef(nombreCaso12Columns[18]),
                    new FloatFieldDef(nombreCaso12Columns[19]),
                    new FloatFieldDef(nombreCaso12Columns[20]),
                    new FloatFieldDef(nombreCaso12Columns[21]),
                    new FloatFieldDef(nombreCaso12Columns[22]),
                    new FloatFieldDef(nombreCaso12Columns[23]),
                    new FloatFieldDef(nombreCaso12Columns[24]),
                    new FloatFieldDef(nombreCaso12Columns[25]),
                    new FloatFieldDef(nombreCaso12Columns[26]),
                    new FloatFieldDef(nombreCaso12Columns[27]),
                    new FloatFieldDef(nombreCaso12Columns[28]),
                    new FloatFieldDef(nombreCaso12Columns[29]),
                    new FloatFieldDef(nombreCaso12Columns[30]),
                    new FloatFieldDef(nombreCaso12Columns[31]),
                    new FloatFieldDef(nombreCaso12Columns[32]),
                    new FloatFieldDef(nombreCaso12Columns[33]),
                    new FloatFieldDef(nombreCaso12Columns[34]),
                    new FloatFieldDef(nombreCaso12Columns[35]),
                    new FloatFieldDef(nombreCaso12Columns[36])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
         idColumn = new ColumnConfig("Id modelo", nombreCaso12Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso12Columns[1], 100, true);
            colorColumn = new ColumnConfig("Color", nombreCaso12Columns[2], 100, true);
        clienteColumn = new ColumnConfig("Cliente", nombreCaso12Columns[3], 100, true);
         SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, clienteM);
        //SimpleStore paisStore = new SimpleStore(new String[]{"idcliente", "codigo"},nombreCaso3Columns[2]);
        paisStore1.load();

        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);


        clienteColumn.setEditor(new GridEditor(cbVendedor));

vendedorColumn = new ColumnConfig("Vendedor", nombreCaso12Columns[4], 100, true);
        SimpleStore paisStore12 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        paisStore12.load();
        final ComboBox cbVendedor1 = new ComboBox();
        cbVendedor1.setStore(paisStore12);
        cbVendedor1.setDisplayField("codigo");
        cbVendedor1.setFieldLabel("codigo");
        cbVendedor1.setValueField("codigo");
        cbVendedor1.setMinChars(1);
        vendedorColumn.setEditor(new GridEditor(cbVendedor1));

        fechaColumn = new ColumnConfig("Ingreso", nombreCaso12Columns[5], 80, true);
    // fechaColumn.setEditor(new GridEditor(metodoFeli()));

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso12Columns[6], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso12Columns[7], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso12Columns[8], 100, true);
        talla14Column = new ColumnConfig("14", nombreCaso12Columns[9], 30, true, null);
        talla15Column = new ColumnConfig("15", nombreCaso12Columns[10], 30, true, null);
        talla16Column = new ColumnConfig("16", nombreCaso12Columns[11], 30, true, null);
        talla17Column = new ColumnConfig("17", nombreCaso12Columns[12], 30, true, null);
        talla18Column = new ColumnConfig("18", nombreCaso12Columns[13], 30, true, null);
        talla19Column = new ColumnConfig("19", nombreCaso12Columns[14], 30, true, null);
        talla20Column = new ColumnConfig("20", nombreCaso12Columns[15], 30, true, null);
        talla21Column = new ColumnConfig("21", nombreCaso12Columns[16], 30, true, null);
        talla22Column = new ColumnConfig("22", nombreCaso12Columns[17], 30, true, null);
        talla23Column = new ColumnConfig("23", nombreCaso12Columns[18], 30, true, null);
        talla24Column = new ColumnConfig("24", nombreCaso12Columns[19], 30, true, null);
        talla25Column = new ColumnConfig("25", nombreCaso12Columns[20], 30, true, null);
        talla26Column = new ColumnConfig("26", nombreCaso12Columns[21], 30, true, null);
        talla27Column = new ColumnConfig("27", nombreCaso12Columns[22], 30, true, null);
        talla28Column = new ColumnConfig("28", nombreCaso12Columns[23], 30, true, null);
        talla29Column = new ColumnConfig("29", nombreCaso12Columns[24], 30, true, null);
        talla30Column = new ColumnConfig("30", nombreCaso12Columns[25], 30, true, null);
        talla31Column = new ColumnConfig("31", nombreCaso12Columns[26], 30, true, null);
        talla32Column = new ColumnConfig("32", nombreCaso12Columns[27], 30, true, null);
        talla33Column = new ColumnConfig("33", nombreCaso12Columns[28], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso12Columns[29], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso12Columns[30], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso12Columns[31], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso12Columns[32], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso12Columns[33], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso12Columns[34], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso12Columns[35], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso12Columns[36], 80, true, null);
  TextField tex_detallea1 = new TextField();
       fechaColumn.setEditor(new GridEditor(tex_detallea1));
        TextField tex_detalle = new TextField();
        colorColumn.setEditor(new GridEditor(tex_detalle));
         TextField tex_detalle1 = new TextField();
       // materialColumn.setEditor(new GridEditor(tex_detalle1));
        precioColumn.setEditor(new GridEditor(metodoFeli()));
 
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
        talla14Column.setEditor(new GridEditor(metodoFeli()));
        talla15Column.setEditor(new GridEditor(metodoFeli()));
        talla16Column.setEditor(new GridEditor(metodoFeli()));
        talla17Column.setEditor(new GridEditor(metodoFeli()));
        talla18Column.setEditor(new GridEditor(metodoFeli()));
        talla19Column.setEditor(new GridEditor(metodoFeli()));
        talla20Column.setEditor(new GridEditor(metodoFeli()));
        talla21Column.setEditor(new GridEditor(metodoFeli()));
        talla22Column.setEditor(new GridEditor(metodoFeli()));
        talla23Column.setEditor(new GridEditor(metodoFeli()));
        talla24Column.setEditor(new GridEditor(metodoFeli()));
        talla25Column.setEditor(new GridEditor(metodoFeli()));
        talla26Column.setEditor(new GridEditor(metodoFeli()));
        talla27Column.setEditor(new GridEditor(metodoFeli()));
        talla28Column.setEditor(new GridEditor(metodoFeli()));
        talla29Column.setEditor(new GridEditor(metodoFeli()));
        talla30Column.setEditor(new GridEditor(metodoFeli()));
        talla31Column.setEditor(new GridEditor(metodoFeli()));
        talla32Column.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
   //    totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
      //  totalparesColumn.setEditor(new GridEditor(metodoFeli()));
TextField tex_detallea = new TextField();
        totalcajasColumn.setEditor(new GridEditor(tex_detallea));


        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                     codigoColumn,
                      colorColumn,
                    clienteColumn,
                    vendedorColumn,
                    fechaColumn,
                     totalcajasColumn,
                    precioColumn,
                  preciounitarioColumn,
                    talla14Column,
                    talla15Column,
                    talla16Column,
                    talla17Column,
                    talla18Column,
                    talla19Column,
                    talla20Column,
                    talla21Column,
                    talla22Column,
                    talla23Column,
                    talla24Column,
                    talla25Column,
                    talla26Column,
                    talla27Column,
                    talla28Column,
                    talla29Column,
                    talla30Column,
                    talla31Column,
                    talla32Column,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                  totalparescajaColumn,
                    totalparesbsColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

       eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        eliminarProducto.setTooltip(tipsConfig2);


         Producto = new ToolbarButton("Copiar Modelo");
        Producto.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        Producto.setTooltip(tipsConfig21);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(Producto);
        grid.setBottomToolbar(pagingToolbar);
 aniadirListenersProductoEspecial();
        panel.add(grid);
    }


public void onModuleLoad13(Object[][] colorM1,Object[][] materialM1,Object[][] cliente,Object[][] vendedor,String idmarc) {
               this.clienteM = cliente;
                this.vendedorM = vendedor;
                 this.colorM = colorM1;
                 this.materialM =materialM1;
        panel = new Panel();
        this.idmarca = idmarc;
        //panel.setId("panel-lista-productosproveedor");

        dataProxy = new ScriptTagProxy("");
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso13Columns[0]),
                    new StringFieldDef(nombreCaso13Columns[1]),
                    new StringFieldDef(nombreCaso13Columns[2]),
                    new StringFieldDef(nombreCaso13Columns[3]),
                    new StringFieldDef(nombreCaso13Columns[4]),
                    new StringFieldDef(nombreCaso13Columns[5]),
                    new StringFieldDef(nombreCaso13Columns[6]),
                    new FloatFieldDef(nombreCaso13Columns[7]),
                    new FloatFieldDef(nombreCaso13Columns[8]),
                    new FloatFieldDef(nombreCaso13Columns[9]),
                    new FloatFieldDef(nombreCaso13Columns[10]),
                    new FloatFieldDef(nombreCaso13Columns[11]),
                    new FloatFieldDef(nombreCaso13Columns[12]),
                    new FloatFieldDef(nombreCaso13Columns[13]),
                    new FloatFieldDef(nombreCaso13Columns[14]),
                    new FloatFieldDef(nombreCaso13Columns[15]),
                    new FloatFieldDef(nombreCaso13Columns[16]),
                    new FloatFieldDef(nombreCaso13Columns[17]),
                    new FloatFieldDef(nombreCaso13Columns[18]),
                    new FloatFieldDef(nombreCaso13Columns[19]),
                    new FloatFieldDef(nombreCaso13Columns[20]),
                    new FloatFieldDef(nombreCaso13Columns[21]),
                    new FloatFieldDef(nombreCaso13Columns[22]),
                    new FloatFieldDef(nombreCaso13Columns[23]),
                    new FloatFieldDef(nombreCaso13Columns[24]),
                    new FloatFieldDef(nombreCaso13Columns[25]),
                    new FloatFieldDef(nombreCaso13Columns[26]),
                    new FloatFieldDef(nombreCaso13Columns[27]),
                    new FloatFieldDef(nombreCaso13Columns[28]),
                    new FloatFieldDef(nombreCaso13Columns[29]),
                    new FloatFieldDef(nombreCaso13Columns[30]),
                    new FloatFieldDef(nombreCaso13Columns[31]),
                    new FloatFieldDef(nombreCaso13Columns[32]),
                    new FloatFieldDef(nombreCaso13Columns[33]),
                    new FloatFieldDef(nombreCaso13Columns[34]),
                    new FloatFieldDef(nombreCaso13Columns[35]),
                    new FloatFieldDef(nombreCaso13Columns[36]),
                    new FloatFieldDef(nombreCaso13Columns[37])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
         idColumn = new ColumnConfig("Id modelo", nombreCaso13Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso13Columns[1], 100, true);
       materialColumn = new ColumnConfig("Material", nombreCaso13Columns[2], 100, true);

        colorColumn = new ColumnConfig("Color", nombreCaso13Columns[3], 100, true);
        clienteColumn = new ColumnConfig("Cliente", nombreCaso13Columns[4], 100, true);
         SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, clienteM);
        //SimpleStore paisStore = new SimpleStore(new String[]{"idcliente", "codigo"},nombreCaso3Columns[2]);
        paisStore1.load();

        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);


        clienteColumn.setEditor(new GridEditor(cbVendedor));

vendedorColumn = new ColumnConfig("Vendedor", nombreCaso13Columns[5], 100, true);
        SimpleStore paisStore12 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        paisStore12.load();
        final ComboBox cbVendedor1 = new ComboBox();
        cbVendedor1.setStore(paisStore12);
        cbVendedor1.setDisplayField("codigo");
        cbVendedor1.setFieldLabel("codigo");
        cbVendedor1.setValueField("codigo");
        cbVendedor1.setMinChars(1);
        vendedorColumn.setEditor(new GridEditor(cbVendedor1));

        fechaColumn = new ColumnConfig("Ingreso", nombreCaso13Columns[6], 80, true);
    // fechaColumn.setEditor(new GridEditor(metodoFeli()));

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso13Columns[7], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso13Columns[8], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso13Columns[9], 100, true);
        talla14Column = new ColumnConfig("14", nombreCaso13Columns[10], 30, true, null);
        talla15Column = new ColumnConfig("15", nombreCaso13Columns[11], 30, true, null);
        talla16Column = new ColumnConfig("16", nombreCaso13Columns[12], 30, true, null);
        talla17Column = new ColumnConfig("17", nombreCaso13Columns[13], 30, true, null);
        talla18Column = new ColumnConfig("18", nombreCaso13Columns[14], 30, true, null);
        talla19Column = new ColumnConfig("19", nombreCaso13Columns[15], 30, true, null);
        talla20Column = new ColumnConfig("20", nombreCaso13Columns[16], 30, true, null);
        talla21Column = new ColumnConfig("21", nombreCaso13Columns[17], 30, true, null);
        talla22Column = new ColumnConfig("22", nombreCaso13Columns[18], 30, true, null);
        talla23Column = new ColumnConfig("23", nombreCaso13Columns[19], 30, true, null);
        talla24Column = new ColumnConfig("24", nombreCaso13Columns[20], 30, true, null);
        talla25Column = new ColumnConfig("25", nombreCaso13Columns[21], 30, true, null);
        talla26Column = new ColumnConfig("26", nombreCaso13Columns[22], 30, true, null);
        talla27Column = new ColumnConfig("27", nombreCaso13Columns[23], 30, true, null);
        talla28Column = new ColumnConfig("28", nombreCaso13Columns[24], 30, true, null);
        talla29Column = new ColumnConfig("29", nombreCaso13Columns[25], 30, true, null);
        talla30Column = new ColumnConfig("30", nombreCaso13Columns[26], 30, true, null);
        talla31Column = new ColumnConfig("31", nombreCaso13Columns[27], 30, true, null);
        talla32Column = new ColumnConfig("32", nombreCaso13Columns[28], 30, true, null);
        talla33Column = new ColumnConfig("33", nombreCaso13Columns[29], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso13Columns[30], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso13Columns[31], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso13Columns[32], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso13Columns[33], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso13Columns[34], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso13Columns[35], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso13Columns[36], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso13Columns[37], 80, true, null);

 TextField tex_detallea1 = new TextField();
       fechaColumn.setEditor(new GridEditor(tex_detallea1));
        TextField tex_detalle = new TextField();
        colorColumn.setEditor(new GridEditor(tex_detalle));
           TextField tex_detalle1 = new TextField();
        materialColumn.setEditor(new GridEditor(tex_detalle1));
        precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
        talla14Column.setEditor(new GridEditor(metodoFeli()));
        talla15Column.setEditor(new GridEditor(metodoFeli()));
        talla16Column.setEditor(new GridEditor(metodoFeli()));
        talla17Column.setEditor(new GridEditor(metodoFeli()));
        talla18Column.setEditor(new GridEditor(metodoFeli()));
        talla19Column.setEditor(new GridEditor(metodoFeli()));
        talla20Column.setEditor(new GridEditor(metodoFeli()));
        talla21Column.setEditor(new GridEditor(metodoFeli()));
        talla22Column.setEditor(new GridEditor(metodoFeli()));
        talla23Column.setEditor(new GridEditor(metodoFeli()));
        talla24Column.setEditor(new GridEditor(metodoFeli()));
        talla25Column.setEditor(new GridEditor(metodoFeli()));
        talla26Column.setEditor(new GridEditor(metodoFeli()));
        talla27Column.setEditor(new GridEditor(metodoFeli()));
        talla28Column.setEditor(new GridEditor(metodoFeli()));
        talla29Column.setEditor(new GridEditor(metodoFeli()));
        talla30Column.setEditor(new GridEditor(metodoFeli()));
        talla31Column.setEditor(new GridEditor(metodoFeli()));
        talla32Column.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
   //    totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
      //  totalparesColumn.setEditor(new GridEditor(metodoFeli()));
TextField tex_detallea = new TextField();
        totalcajasColumn.setEditor(new GridEditor(tex_detallea));


        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                     codigoColumn,
                     materialColumn,
                      colorColumn,
                    clienteColumn,
                    vendedorColumn,
                    fechaColumn,
                     totalcajasColumn,
                    precioColumn,
                  preciounitarioColumn,
                    talla14Column,
                    talla15Column,
                    talla16Column,
                    talla17Column,
                    talla18Column,
                    talla19Column,
                    talla20Column,
                    talla21Column,
                    talla22Column,
                    talla23Column,
                    talla24Column,
                    talla25Column,
                    talla26Column,
                    talla27Column,
                    talla28Column,
                    talla29Column,
                    talla30Column,
                    talla31Column,
                    talla32Column,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                  totalparescajaColumn,
                    totalparesbsColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        eliminarProducto.setTooltip(tipsConfig2);


         Producto = new ToolbarButton("Copiar Modelo");
        Producto.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        Producto.setTooltip(tipsConfig21);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(Producto);
        grid.setBottomToolbar(pagingToolbar);
 aniadirListenersProductoEspecial();
        panel.add(grid);
    }

public void onModuleLoad11( final Object[][] colorM1,Object[][] cliente,Object[][] vendedor,String idmar) {
            this.colorM = colorM1;

                this.clienteM = cliente;
                 this.vendedorM = vendedor;
this.idmarca = idmar;
        panel = new Panel();
        dataProxy = new ScriptTagProxy("");
        recordDef = new RecordDef(new FieldDef[]{
         //   String[] nombreCaso11Columns = {"idmodelo","codigo", "color","cliente","vendedor","fecha", "totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45","totalpares","totalparescaja",  "totalparesbs"};

                    new StringFieldDef(nombreCaso11Columns[0]),
                    new StringFieldDef(nombreCaso11Columns[1]),
                    new StringFieldDef(nombreCaso11Columns[2]),
                    new StringFieldDef(nombreCaso11Columns[3]),
                    new StringFieldDef(nombreCaso11Columns[4]),
                    new StringFieldDef(nombreCaso11Columns[5]),
                    new FloatFieldDef(nombreCaso11Columns[6]),
                    new FloatFieldDef(nombreCaso11Columns[7]),
                    new FloatFieldDef(nombreCaso11Columns[8]),
                    new FloatFieldDef(nombreCaso11Columns[9]),
                    new FloatFieldDef(nombreCaso11Columns[10]),
                    new FloatFieldDef(nombreCaso11Columns[11]),
                    new FloatFieldDef(nombreCaso11Columns[12]),
                    new FloatFieldDef(nombreCaso11Columns[13]),
                    new FloatFieldDef(nombreCaso11Columns[14]),
                    new FloatFieldDef(nombreCaso11Columns[15]),
                    new FloatFieldDef(nombreCaso11Columns[16]),
                    new FloatFieldDef(nombreCaso11Columns[17]),
                    new FloatFieldDef(nombreCaso11Columns[18]),
                    new FloatFieldDef(nombreCaso11Columns[19]),
                    new FloatFieldDef(nombreCaso11Columns[20]),
                      new FloatFieldDef(nombreCaso11Columns[21]),
                    new FloatFieldDef(nombreCaso11Columns[22]),
                      new FloatFieldDef(nombreCaso11Columns[23]),
                    new FloatFieldDef(nombreCaso11Columns[24])
                //new FloatFieldDef(nombreCaso11Columns[20])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
         idColumn = new ColumnConfig("Id modelo", nombreCaso11Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso11Columns[1], 100, true);
        //materialColumn = new ColumnConfig("Material", nombreCaso11Columns[2], 100, true);
        colorColumn = new ColumnConfig("Color", nombreCaso11Columns[2], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso11Columns[3], 100, true);
         SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, clienteM);
        //SimpleStore paisStore = new SimpleStore(new String[]{"idcliente", "codigo"},nombreCaso3Columns[2]);
        paisStore1.load();

        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);

   
        clienteColumn.setEditor(new GridEditor(cbVendedor));

vendedorColumn = new ColumnConfig("Vendedor", nombreCaso11Columns[4], 100, true);
        SimpleStore paisStore12 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        paisStore12.load();
        final ComboBox cbVendedor1 = new ComboBox();
        cbVendedor1.setStore(paisStore12);
        cbVendedor1.setDisplayField("codigo");
        cbVendedor1.setFieldLabel("codigo");
        cbVendedor1.setValueField("codigo");
        cbVendedor1.setMinChars(1);
        vendedorColumn.setEditor(new GridEditor(cbVendedor1));

        fechaColumn = new ColumnConfig("Ingreso", nombreCaso11Columns[5], 80, true);
    // fechaColumn.setEditor(new GridEditor(metodoFeli()));
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso11Columns[6], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso11Columns[7], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso11Columns[8], 100, true);
        talla33Column = new ColumnConfig("33", nombreCaso11Columns[9], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso11Columns[10], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso11Columns[11], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso11Columns[12], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso11Columns[13], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso11Columns[14], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso11Columns[15], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso11Columns[16], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso11Columns[17], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso11Columns[18], 30, true, null);
        talla43Column = new ColumnConfig("43", nombreCaso11Columns[19], 30, true, null);
        talla44Column = new ColumnConfig("44", nombreCaso11Columns[20], 30, true, null);
        talla45Column = new ColumnConfig("45", nombreCaso11Columns[21], 30, true, null);
         totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso11Columns[22], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso11Columns[23], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso11Columns[24], 80, true, null);
 TextField tex_detallea1 = new TextField();
       fechaColumn.setEditor(new GridEditor(tex_detallea1));
        TextField tex_detalle = new TextField();
        colorColumn.setEditor(new GridEditor(tex_detalle));
        precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
        talla39Column.setEditor(new GridEditor(metodoFeli()));
        talla40Column.setEditor(new GridEditor(metodoFeli()));
        talla41Column.setEditor(new GridEditor(metodoFeli()));
        talla42Column.setEditor(new GridEditor(metodoFeli()));
        talla43Column.setEditor(new GridEditor(metodoFeli()));
        talla44Column.setEditor(new GridEditor(metodoFeli()));
        talla45Column.setEditor(new GridEditor(metodoFeli()));
TextField tex_detallea = new TextField();
        totalcajasColumn.setEditor(new GridEditor(tex_detallea));
      //  totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        //totalparesColumn.setEditor(new GridEditor(metodoFeli()));

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                   codigoColumn,
                 colorColumn,
                    clienteColumn,
                    vendedorColumn,
                    fechaColumn,
                    totalcajasColumn,
                    precioColumn,
                          preciounitarioColumn,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                    talla39Column,
                    talla40Column,
                    talla41Column,
                    talla42Column,
                    talla43Column,
                    talla44Column,
                    talla45Column,
                        totalparescajaColumn,
                    totalparesbsColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

      eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        eliminarProducto.setTooltip(tipsConfig2);


         Producto = new ToolbarButton("Copiar Modelo");
        Producto.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        Producto.setTooltip(tipsConfig21);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(Producto);
        grid.setBottomToolbar(pagingToolbar);
 aniadirListenersProductoEspecial();
        panel.add(grid);
    }
public void onModuleLoad15( final Object[][] colorM1,Object[][] cliente,Object[][] vendedor,String idmar) {
            this.colorM = colorM1;

                this.clienteM = cliente;
                 this.vendedorM = vendedor;
this.idmarca = idmar;
        panel = new Panel();
        dataProxy = new ScriptTagProxy("");
        recordDef = new RecordDef(new FieldDef[]{
         
                  new StringFieldDef(nombreCaso15Columns[0]),
                    new StringFieldDef(nombreCaso15Columns[1]),
                    new StringFieldDef(nombreCaso15Columns[2]),
                    new StringFieldDef(nombreCaso15Columns[3]),
                    new StringFieldDef(nombreCaso15Columns[4]),
                    new StringFieldDef(nombreCaso15Columns[5]),
                    new FloatFieldDef(nombreCaso15Columns[6]),
                    new FloatFieldDef(nombreCaso15Columns[7]),
                    new FloatFieldDef(nombreCaso15Columns[8]),
                    new FloatFieldDef(nombreCaso15Columns[9]),
                    new FloatFieldDef(nombreCaso15Columns[10]),
                    new FloatFieldDef(nombreCaso15Columns[11]),
                    new FloatFieldDef(nombreCaso15Columns[12]),
                    new FloatFieldDef(nombreCaso15Columns[13]),
                    new FloatFieldDef(nombreCaso15Columns[14]),
                    new FloatFieldDef(nombreCaso15Columns[15]),
                    new FloatFieldDef(nombreCaso15Columns[16]),
                    new FloatFieldDef(nombreCaso15Columns[17]),
                    new FloatFieldDef(nombreCaso15Columns[18]),
                    new FloatFieldDef(nombreCaso15Columns[19]),
                    new FloatFieldDef(nombreCaso15Columns[20]),
                    new FloatFieldDef(nombreCaso15Columns[21]),
                    new FloatFieldDef(nombreCaso15Columns[22]),
                    new FloatFieldDef(nombreCaso15Columns[23]),
                    new FloatFieldDef(nombreCaso15Columns[24])

                //new FloatFieldDef(nombreCaso11Columns[20])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
         idColumn = new ColumnConfig("Id modelo", nombreCaso15Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso15Columns[1], 100, true);
         colorColumn = new ColumnConfig("Color", nombreCaso15Columns[2], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso15Columns[3], 100, true);
         SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, clienteM);
        //SimpleStore paisStore = new SimpleStore(new String[]{"idcliente", "codigo"},nombreCaso3Columns[2]);
        paisStore1.load();

        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);


        clienteColumn.setEditor(new GridEditor(cbVendedor));

vendedorColumn = new ColumnConfig("Vendedor", nombreCaso15Columns[4], 100, true);
        SimpleStore paisStore12 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        paisStore12.load();
        final ComboBox cbVendedor1 = new ComboBox();
        cbVendedor1.setStore(paisStore12);
        cbVendedor1.setDisplayField("codigo");
        cbVendedor1.setFieldLabel("codigo");
        cbVendedor1.setValueField("codigo");
        cbVendedor1.setMinChars(1);
        vendedorColumn.setEditor(new GridEditor(cbVendedor1));

        fechaColumn = new ColumnConfig("Ingreso", nombreCaso15Columns[5], 80, true);
    // fechaColumn.setEditor(new GridEditor(metodoFeli()));
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso15Columns[6], 80, true, null);
        precioColumn = new ColumnConfig("Docena", nombreCaso15Columns[7], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit Bs", nombreCaso15Columns[8], 100, true);
        talla26Column = new ColumnConfig("26", nombreCaso15Columns[9], 30, true, null);
        talla27Column = new ColumnConfig("27", nombreCaso15Columns[10], 30, true, null);
        talla28Column = new ColumnConfig("28", nombreCaso15Columns[11], 30, true, null);
        talla29Column = new ColumnConfig("29", nombreCaso15Columns[12], 30, true, null);
        talla30Column = new ColumnConfig("30", nombreCaso15Columns[13], 30, true, null);
        talla31Column = new ColumnConfig("31", nombreCaso15Columns[14], 30, true, null);
        // talla31Column = new ColumnConfig("21", nombreCso1Columns[10], 200, true, null);
        talla32Column = new ColumnConfig("32", nombreCaso15Columns[15], 30, true, null);
        talla33Column = new ColumnConfig("33", nombreCaso15Columns[16], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso15Columns[17], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso15Columns[18], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso15Columns[19], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso15Columns[20], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso15Columns[21], 30, true, null);

         totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso15Columns[22], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso15Columns[23], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total BS", nombreCaso15Columns[24], 80, true, null);
 TextField tex_detallea1 = new TextField();
       fechaColumn.setEditor(new GridEditor(tex_detallea1));
        TextField tex_detalle = new TextField();
        colorColumn.setEditor(new GridEditor(tex_detalle));

        precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
       talla26Column.setEditor(new GridEditor(metodoFeli()));
        talla27Column.setEditor(new GridEditor(metodoFeli()));
        talla28Column.setEditor(new GridEditor(metodoFeli()));
        talla29Column.setEditor(new GridEditor(metodoFeli()));
        talla30Column.setEditor(new GridEditor(metodoFeli()));
        talla31Column.setEditor(new GridEditor(metodoFeli()));
        talla32Column.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
TextField tex_detallea = new TextField();
        totalcajasColumn.setEditor(new GridEditor(tex_detallea));
      //  totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        //totalparesColumn.setEditor(new GridEditor(metodoFeli()));

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                   codigoColumn,
                 colorColumn,
                    clienteColumn,
                    vendedorColumn,
                    fechaColumn,
                    totalcajasColumn,
                    precioColumn,
                          preciounitarioColumn,
                     talla26Column,
                    talla27Column,
                    talla28Column,
                    talla29Column,
                    talla30Column,
                    talla31Column,
                    talla32Column,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                        totalparescajaColumn,
                    totalparesbsColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

      eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        eliminarProducto.setTooltip(tipsConfig2);


         Producto = new ToolbarButton("Copiar Modelo");
        Producto.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        Producto.setTooltip(tipsConfig21);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(Producto);
        grid.setBottomToolbar(pagingToolbar);
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
                    } else {
                    MessageBox.alert("No hay producto selecionado para eliminar y/o selecciono mas de uno.");
                }

                eliminarProducto.setPressed(false);
            }
        });







  Producto.addListener(new ButtonListenerAdapter() {
            private boolean procederAEliminar;
            int repeat = 0;

            @Override
            public void onClick(Button button, EventObject e) {
               // Record[] records = cbSelectionModel.getSelections();
               // if (records.length == 1) {

                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    if(idmarca=="mar-35")
                           {
     String[] nombreCaso13Columns = {"idmodelo", "codigo", "material","color","cliente","vendedor","fecha", "totalcajas","precio","preciounitario","14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38",  "totalpares","totalparescaja",  "totalparesbs"};

                         selecionado = records[0].getAsString("idproducto");
                  cod = records[0].getAsString("codigo");
                mat = records[0].getAsString("material");
                col = records[0].getAsString("color");
                cli = records[0].getAsString("cliente");
                vend = records[0].getAsString("vendedor");
                fecha = records[0].getAsString("fecha");
                  caj = records[0].getAsString("totalcajas");
                    prec = records[0].getAsString("precio");
                      uni = records[0].getAsString("preciounitario");
                       t14 = records[0].getAsString("14");
                        t15 = records[0].getAsString("15");
                          t16 = records[0].getAsString("16");
                            t17 = records[0].getAsString("17");
                              t18 = records[0].getAsString("18");
                                t19 = records[0].getAsString("19");
                                 t20 = records[0].getAsString("20");
                        t21 = records[0].getAsString("21");
                          t22 = records[0].getAsString("22");
                            t23 = records[0].getAsString("23");
                              t24 = records[0].getAsString("24");
                                t25 = records[0].getAsString("25");
                                 t26 = records[0].getAsString("26");
                        t27 = records[0].getAsString("27");
                          t28 = records[0].getAsString("28");
                            t29 = records[0].getAsString("29");
                              t30 = records[0].getAsString("30");
                                t31 = records[0].getAsString("31");
                                  t32 = records[0].getAsString("32");
                      t33 = records[0].getAsString("33");
                        t34 = records[0].getAsString("34");
                          t35 = records[0].getAsString("35");
                            t36 = records[0].getAsString("36");
                              t37 = records[0].getAsString("37");
                                t38 = records[0].getAsString("38");

                                         tpar = records[0].getAsString("totalpares");
                                      cparc = records[0].getAsString("totalparescaja");
                                        parbs = records[0].getAsString("totalparesbs");
 Record plant2 = recordDef.createRecord(new Object[]{
      "",cod,mat,col,cli,vend,fecha,caj,prec,uni,t14,t15,t16,t17,t18,t19,t20,t21,t22,t23,t24,t25,t26,t27,t28,t29,t30,t31,t32,t33,t34,t35,t36,t37,t38, tpar,cparc,parbs,});

                grid.stopEditing();
                store.insert(0, plant2);
                grid.startEditing(0, 0);

                    }else
                        {
                         selecionado = records[0].getAsString("idproducto");
                  cod = records[0].getAsString("codigo");
                mat = records[0].getAsString("material");
                col = records[0].getAsString("color");
                cli = records[0].getAsString("cliente");
                vend = records[0].getAsString("vendedor");
                fecha = records[0].getAsString("fecha");
                  caj = records[0].getAsString("totalcajas");
                    prec = records[0].getAsString("precio");
                      uni = records[0].getAsString("preciounitario");
                      t1 = records[0].getAsString("33");
                        t2 = records[0].getAsString("34");
                          t3 = records[0].getAsString("35");
                            t4 = records[0].getAsString("36");
                              t5 = records[0].getAsString("37");
                                t6 = records[0].getAsString("38");
                                  t7 = records[0].getAsString("39");
                                    t8 = records[0].getAsString("40");
                                      t9 = records[0].getAsString("41");
                                        t10 = records[0].getAsString("42");
                                         tpar = records[0].getAsString("totalpares");
                                      cparc = records[0].getAsString("totalparescaja");
                                        parbs = records[0].getAsString("totalparesbs");
 Record plant2 = recordDef.createRecord(new Object[]{
      "",cod,mat,col,cli,vend,fecha,caj,prec,uni,t1,t2,t3,t4,t5,t6, t7, t8, t9, t10, tpar,cparc,parbs,});

                grid.stopEditing();
                store.insert(0, plant2);
                grid.startEditing(0, 0);

                    }




                    } else {
                    MessageBox.alert("No hay producto selecionado para copiar y/o selecciono mas de uno.");
                }
                Producto.setPressed(false);
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
                        
                   if (grid.getColumnModel().getDataIndex(colIndex).equals("color")) {
                            colorpedido = new ColorPedido(idmarca,colorM, ListaCalzadoPedido.this, colIndex, rowIndex);
                            colorpedido.show();
                        }
                         if (grid.getColumnModel().getDataIndex(colIndex).equals("material")) {
                             materialpedido = new MaterialPedido(idmarca,materialM, ListaCalzadoPedido.this, colIndex, rowIndex);
                            materialpedido.show();

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

   

    public void InsertRowColor(int rowIndex, int colIndex, String dato) {
        grid.getColumnModel().getDataIndex(rowIndex).equals("color");
        Record rs = grid.getStore().getRecordAt(rowIndex);
        rs.set("color", dato);

    }

    public void InsertRowMaterial(int rowIndex, int colIndex, String dato) {
        grid.getColumnModel().getDataIndex(rowIndex).equals("material");
        Record rs = grid.getStore().getRecordAt(rowIndex);
        rs.set("material", dato);

    }

    private void quitarEsteItem(Record quitar) {

        store.remove(quitar);
        grid.setStore(store);
        grid.startEditing(0, 0);
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
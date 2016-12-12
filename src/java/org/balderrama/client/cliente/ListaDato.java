/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.cliente;

import org.balderrama.client.sistemadetalle.*;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.NumberField;
import com.gwtext.client.widgets.grid.GridEditor;
import com.gwtext.client.widgets.grid.event.*;

import org.balderrama.client.util.Utils;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
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
import com.gwtext.client.data.*;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import org.balderrama.client.util.Conector;
/**
 *
 * @author example
 */
public class ListaDato {

    private EditorGridPanel grid;
    private final int ALTO = 250;
    private ToolbarButton eliminarProducto;
    private ToolbarButton Producto;
    protected ExtElement ext_element;
    public CheckboxSelectionModel cbSelectionModel;
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
    private ColumnConfig codigoColumn;
//    private ColumnConfig colorColumn;
//    private ColumnConfig talla;
    private ColumnConfig materialColumn;
//    private ColumnConfig vendedorColumn;
//    private ColumnConfig clienteColumn;
    private ColumnConfig precioColumn;
    private ColumnConfig preciounitarioColumn;
//    private ColumnConfig totalparesbsColumn;
//    private ColumnConfig totalparescajaColumn;
//    private ColorPedido colorpedido;
//    private MaterialPedido materialpedido;
//    private ClientePedido clientepedido;
//    private ColorPedido1 colorpedido1;
//    private MaterialPedido1 materialpedido1;
//    private ColumnConfig coleccionColumn;
    private ColumnConfig totalparesColumn;
    private ColumnConfig totalcajasColumn;
//    private ColumnConfig talla1Column;
//    private ColumnConfig talla1mColumn;
//    private ColumnConfig talla2Column;
//    private ColumnConfig talla2mColumn;
//    private ColumnConfig talla3Column;
//    private ColumnConfig talla3mColumn;
//    private ColumnConfig talla4Column;
//    private ColumnConfig talla4mColumn;
//    private ColumnConfig talla5Column;
//    private ColumnConfig talla5mColumn;
//    private ColumnConfig talla6Column;
//    private ColumnConfig talla6mColumn;
//    private ColumnConfig talla7Column;
//    private ColumnConfig talla7mColumn;
//    private ColumnConfig talla8Column;
//    private ColumnConfig talla8mColumn;
//    private ColumnConfig talla9Column;
//    private ColumnConfig talla9mColumn;
//    private ColumnConfig talla10Column;
//    private ColumnConfig talla10mColumn;
//    private ColumnConfig talla11Column;
//    private ColumnConfig talla11mColumn;
//    private ColumnConfig talla12Column;
//    private ColumnConfig talla12mColumn;
//    private ColumnConfig talla14Column;
//    private ColumnConfig talla15Column;
//    private ColumnConfig talla16Column;
//    private ColumnConfig talla17Column;
//    private ColumnConfig talla18Column;
//    private ColumnConfig talla19Column;
//    private ColumnConfig talla20Column;
//    private ColumnConfig talla21Column;
//    private ColumnConfig talla22Column;
//    private ColumnConfig talla23Column;
//    private ColumnConfig talla24Column;
//    private ColumnConfig talla25Column;
//    private ColumnConfig talla26Column;
//    private ColumnConfig talla27Column;
//    private ColumnConfig talla28Column;
//    private ColumnConfig talla29Column;
//    private ColumnConfig talla30Column;
//    private ColumnConfig talla31Column;
//    private ColumnConfig talla32Column;
    private ColumnConfig talla33Column;
    private ColumnConfig talla34Column;
    private ColumnConfig talla35Column;
    private ColumnConfig talla36Column;
    private ColumnConfig talla37Column;
//    private ColumnConfig talla38Column;
//    private ColumnConfig talla39Column;
//    private ColumnConfig talla40Column;
//    private ColumnConfig talla41Column;
//    private ColumnConfig talla42Column;
//    private ColumnConfig talla43Column;
//    private ColumnConfig talla44Column;
//    private ColumnConfig talla45Column;
//    private ColumnConfig precio1Column;
//    private ColumnConfig cantidadColumn;
//    private ColumnConfig totalColumn;
//    private ColumnConfig tipoventaColumn;
//    private ColumnConfig fechaColumn;
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
   //opcion 9
    String[] nombreCaso5Columns = {"idcreditocli", "marca", "vendedor", "saldoant", "vencaja", "venpar", "vensus", "pagos", "rebajas", "pardev", "susdev", "saldoact"};
   
    private RecordDef recordDef;
    private Object[][] vendedorM;
    private PanelCreditoRegistro padre;
    String idcliente;

//ramarimverificado
    public void onModuleLoad5( PanelCreditoRegistro pad,String idcliente,Object[][] vendedor) {
        this.vendedorM = vendedor;
        this.padre = pad;
        this.idcliente = idcliente;
        panel = new Panel();
        
        dataProxy = new ScriptTagProxy("./php/Cobros.php?funcion=Listarcuentascliente&idcliente=" + idcliente);
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso5Columns[0]),
                    new StringFieldDef(nombreCaso5Columns[1]),
                    new StringFieldDef(nombreCaso5Columns[2]),
                    new FloatFieldDef(nombreCaso5Columns[3]),
                    new FloatFieldDef(nombreCaso5Columns[4]),
                    new FloatFieldDef(nombreCaso5Columns[5]),
                    new FloatFieldDef(nombreCaso5Columns[6]),
                    new FloatFieldDef(nombreCaso5Columns[7]),
                    new FloatFieldDef(nombreCaso5Columns[8]),
                    new FloatFieldDef(nombreCaso5Columns[9]),
                    new FloatFieldDef(nombreCaso5Columns[10]),
                    new FloatFieldDef(nombreCaso5Columns[11]),
                    new FloatFieldDef(nombreCaso5Columns[12])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        //store.setReader(reader);
        //store.setDataProxy(dataProxy);
        //store.load();
        idColumn = new ColumnConfig("Id modelo", nombreCaso5Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Marca", nombreCaso5Columns[1], 120, true);
        materialColumn = new ColumnConfig("vendedor", nombreCaso5Columns[2], 120, true);
        SimpleStore paisStore12 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedor);
        paisStore12.load();
        final ComboBox cbVendedor1 = new ComboBox();
        cbVendedor1.setStore(paisStore12);
        cbVendedor1.setDisplayField("codigo");
        cbVendedor1.setFieldLabel("codigo");
        cbVendedor1.setValueField("codigo");
        cbVendedor1.setMinChars(1);
        materialColumn.setEditor(new GridEditor(cbVendedor1));
        totalparesColumn = new ColumnConfig("Saldo Anterior", nombreCaso5Columns[3], 100, true, null);
        totalcajasColumn = new ColumnConfig("Venta Caja", nombreCaso5Columns[4], 80, true, null);
        precioColumn = new ColumnConfig("Venta Par", nombreCaso5Columns[5], 100, true);
        preciounitarioColumn = new ColumnConfig("Venta Sus", nombreCaso5Columns[6], 100, true);
        talla33Column = new ColumnConfig("Pagos", nombreCaso5Columns[7], 100, true, null);
        talla34Column = new ColumnConfig("Rebajas", nombreCaso5Columns[8], 100, true, null);
        talla35Column = new ColumnConfig("Par Dev", nombreCaso5Columns[9], 100, true, null);
        talla36Column = new ColumnConfig("Sus Dev", nombreCaso5Columns[10], 100, true, null);
        talla37Column = new ColumnConfig("Saldo Act", nombreCaso5Columns[11], 100, true, null);
        totalparesColumn.setEditor(new GridEditor(metodoFeli()));
        precioColumn.setEditor(new GridEditor(metodoFeli()));
        preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
       
      
        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                  new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    totalparesColumn,
                    totalcajasColumn,
                    precioColumn,
                    preciounitarioColumn,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column
                  };
        columnModel = new ColumnModel(columns);
        grid = new EditorGridPanel();
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Saldos");
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

        eliminarProducto = new ToolbarButton("Eliminar Cuenta");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar cuenta(s)");
        eliminarProducto.setTooltip(tipsConfig2);

        Producto = new ToolbarButton("Copiar Cuenta");
        Producto.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar (s)");
        Producto.setTooltip(tipsConfig21);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
        pagingToolbar.addSeparator();
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

                   selecionado = records[0].getAsString("idcreditocli");
                   MessageBox.confirm("Eliminar Cuenta", "Realmente desea eliminar todas los creditos dependiente??", new MessageBox.ConfirmCallback() {
                   public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                String enlace = "php/Cobros.php?funcion=eliminarcredito&idcreditocli=" + selecionado;
                                Utils.setErrorPrincipal("Eliminando el cliente", "cargar");
                                final Conector conec = new Conector(enlace, false);
                                try {
                                    conec.getRequestBuilder().sendRequest("asdf", new RequestCallback() {

                                        public void onResponseReceived(Request request, Response response) {
                                            String data = response.getText();
                                            JSONValue jsonValue = JSONParser.parse(data);
                                            JSONObject jsonObject;
                                            if ((jsonObject = jsonValue.isObject()) != null) {
                                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                                if (errorR.equalsIgnoreCase("true")) {
                                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
                                                    store.reload();
                                                    grid.reconfigure(store, columnModel);
                                                    grid.getView().refresh();
                                                } else {
                                                    //Window.alert(mensajeR);
                                                    Utils.setErrorPrincipal(mensajeR, "error");
                                                }
                                            }
                                        }
                                        public void onError(Request request, Throwable exception) {
                                            //Window.alert("Ocurrio un error al conectar con el servidor ");
                                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                                        }
                                    });
                                } catch (RequestException ex) {
                                    //Window.alert("Ocurrio un error al conectar con el servidor");
                                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                                }
                            }
                        }
                    });
                } else {
                    MessageBox.alert("No hay usuario selecionado para eliminar o selecciono mas de uno.");
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
                    //       colorpedido = new ColorPedido(idmarca,colorM, ListaDato.this, colIndex, rowIndex);
                      //      colorpedido.show();
                        }
                         if (grid.getColumnModel().getDataIndex(colIndex).equals("material")) {
                        //     materialpedido = new MaterialPedido(idmarca,materialM, ListaDato.this, colIndex, rowIndex);
                         //   materialpedido.show();

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
 public void reload() {
        store.reload();
        grid.reconfigure(store, columnModel);
        grid.getView().refresh();
    }

    public ColumnModel getColumnModel() {
        return columnModel;
    }
     public void buscarProductos(String idmarca) {

        dataProxy = new ScriptTagProxy("php/IngresoAlmacen.php?funcion=buscarlistamodelos&idmarca="+idmarca);

       reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);

        
        store.reload();
        grid.reconfigure(store, columnModel);
        pagingToolbar.setStore(store);
        grid.getView().refresh();


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
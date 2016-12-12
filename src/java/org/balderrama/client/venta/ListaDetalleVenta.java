/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.venta;

import com.google.gwt.json.client.JSONArray;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
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
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.data.*;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.widgets.form.NumberField;
import com.gwtext.client.widgets.grid.GridEditor;
import com.gwtext.client.widgets.grid.event.*;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;

/**
 *
 * @author example
 */
public class ListaDetalleVenta {

    private EditorGridPanel grid;
    private final int ALTO = 300;
    private ToolbarButton eliminarProducto;
    private ToolbarButton preciomodifica;
    // private FormularioConsultas formularioConsultas;
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
    String selecionado = "";
    String selecionado2 = "";
    private Panel panel;
    private ColumnConfig codigoColumn;
    private ColumnConfig iditemColumn;
    private ColumnConfig detalleColumn;
    private ColumnConfig tallaColumn;
    private ColumnConfig cantidadColumn;
    private ColumnConfig precioColumn;
    private ColumnConfig com_empleadoAColumn;
    private ColumnConfig vendedorColumn;
    private ColumnConfig precioventaColumn;
    private String idpedido;
    //  private String ;
    private String idestilo;
    private String opcion;
    //  private Object[][] vendedorM;
    //     String[] nombreComlumns = {"idmodelo","idventa", "codigo", "detalle","cajas","preciocaja", "pares", "totalsus"};
    String[] nombreComlumns = {"idmodelo", "idventa", "codigo", "cajas", "total", "pares", "precioventa", "ventapar", "precioventafinal"};

    //String[] nombreCaso1Columns = {"iddetalleingreso", "coleccion", "codigo", "color", "precio", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalcajas", "totalpares"};
    private RecordDef recordDef;
    private ColumnConfig coleccionColumn;
//public void onModuleLoad9(String idventa, Object[][] vendedorMM) {
//        panel = new Panel();
//        this.idpedido = idventa;
//        this.vendedorM = vendedorMM;
//

    public void onModuleLoad9(String idventa) {
        panel = new Panel();
        //   this.vendedorM = vendedorM1;
        //panel.setId("panel-lista-productosproveedor");
        this.idpedido = idventa;
//        dataProxy = new ScriptTagProxy("./php/VentaCredito.php?funcion=ListarDetalleProductosVenta&idventadetalle=" + idpedido );
        dataProxy = new ScriptTagProxy("./php/VentaMayor.php?funcion=ListarDetalleProductosVenta&idventadetalle=" + idpedido);

        //    dataProxy = new ScriptTagProxy("");
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreComlumns[0]),
                    new StringFieldDef(nombreComlumns[1]),
                    new StringFieldDef(nombreComlumns[2]),
                    new StringFieldDef(nombreComlumns[3]),
                    new StringFieldDef(nombreComlumns[4]),
                    new StringFieldDef(nombreComlumns[5]),
                    new StringFieldDef(nombreComlumns[6]),
                    new StringFieldDef(nombreComlumns[7]),
                    new FloatFieldDef(nombreComlumns[8])
//                    new FloatFieldDef(nombreComlumns[8])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);

        //String[] nombreComlumns = {"idmodelo","idventa", "codigo", "cajas","total", "pares", "precioventa","ventapar"};


        idColumn = new ColumnConfig("Id Kardex", nombreComlumns[0], 90, true);
        iditemColumn = new ColumnConfig("Id item", nombreComlumns[1], 90, true);

        codigoColumn = new ColumnConfig("Articulo", nombreComlumns[2], 320, true, null);
        detalleColumn = new ColumnConfig("CAjas", nombreComlumns[3], 60, true);
        tallaColumn = new ColumnConfig("Total", nombreComlumns[4], 60, true);

        cantidadColumn = new ColumnConfig("Pares", nombreComlumns[5], 60, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreComlumns[6], 120, true, null);

        vendedorColumn = new ColumnConfig("Total precio", nombreComlumns[7], 120, true, null);
        precioventaColumn = new ColumnConfig("Precio Venta FINAL", nombreComlumns[8], 170, true, null);

//        cbVendedor.setHideTrigger(false);
        //   vendedorColumn.setEditor(new GridEditor(cbVendedor));
        NumberField numberField = new NumberField();
        numberField.setAllowBlank(false);
        numberField.setAllowNegative(false);
        numberField.setMaxValue(1000);
        precioventaColumn.setEditor(new GridEditor(numberField));
        //precioventaColumn.setEditor(new GridEditor(metodoFeli()));
        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    //                    idColumn,
                    codigoColumn,
                    detalleColumn,
                    tallaColumn,
                    cantidadColumn,
                    precioColumn,
                    vendedorColumn,
                    precioventaColumn,};

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-productosventas-credito");
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

        eliminarProducto = new ToolbarButton("Eliminar modelo de la venta");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Ver detalle del producto");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);

        preciomodifica = new ToolbarButton("Modificar Precio");
        preciomodifica.setEnableToggle(true);
        QuickTipsConfig tipsConfig22 = new QuickTipsConfig();
        tipsConfig22.setText("Ver detalle del producto");
        //tipsConfig.setTitle("Tip Title");
        preciomodifica.setTooltip(tipsConfig22);
        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(preciomodifica);
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
        //**************************************************
        //***********ELIMINAR PRODUCTO
        //**************************************************
        preciomodifica.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = grid.getStore().getModifiedRecords();
                createCambioFalla();
                preciomodifica.setPressed(false);
            }
        });

        eliminarProducto.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idmodelo");
                    selecionado2 = records[0].getAsString("idventa");
                    MessageBox.confirm("Eliminar Item", "Realmente desea eliminar este Item, este modelo regresara a stock?? No olvide reimprimir su boleta", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                //eliminar
                                //        String enlace = "php/IngresoAlmacen.php?funcion=CargarInventarioActual&idmarca=" + idmarca+"&idalmacen="+idalmacen+ "&idkardex="+idkardex;

                                String enlace = "php/VentaMayor.php?funcion=EliminarModeloVenta&idmodelo=" + selecionado + "&idventa=" + selecionado2;
                                Utils.setErrorPrincipal("Eliminando ", "cargar");
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
                                                    reload();
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

                                        public void reload() {
                                            store.reload();
                                            grid.reconfigure(store, columnModel);
                                            grid.getView().refresh();
                                        }
                                    });
                                } catch (RequestException ex) {
                                    //Window.alert("Ocurrio un error al conectar con el servidor");
                                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                                }
                            //end yes
                            }
                        }
                    });
                } else {
                    MessageBox.alert("No hay dato selecionado para editar y/o selecciono mas de uno.");
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

//        grid.addGridCellListener(new GridCellListenerAdapter() {
//            @Override
//            public void onCellClick(GridPanel grid, int rowIndex, int colIndex, EventObject e) {
//                if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor") &&
//                        e.getTarget(".checkbox", 1) != null) {
//                    Record record = grid.getStore().getAt(rowIndex);
//                    record.set("indoor", !record.getAsBoolean("indoor"));
//                }
//            }
//        });
        grid.addGridCellListener(
                new GridCellListenerAdapter() {

                    @Override
                    public void onCellClick(GridPanel grid, int rowIndex, int colIndex, EventObject e) {
                        //MessageBox.alert("precio " + grid.getColumnModel().getDataIndex(colIndex).equals("precio") + " indoor " + grid.getColumnModel().getDataIndex(colIndex).equals("indoor"));
                        if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor") && e.getTarget(".checkbox", 1) != null) {
                            Record record = grid.getStore().getAt(rowIndex);
                            record.set("indoor", !record.getAsBoolean("indoor"));
                        }
                        if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor") && e.getTarget(".checkbox", 1) != null) {
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
                                // MessageBox.alert("precio " + grid.getColumnModel().getDataIndex(colIndex).equals("precio") + " indoor " + grid.getColumnModel().getDataIndex(colIndex).equals("indoor") + " nuevo " + grid.getColumnModel().getDataIndex(newcol).equals("indoor"));
                                Record record1 = grid.getStore().getAt(newcol);
                                record1.set("indoor", record1);
                            }
                        }
                    }
                });
        // grid.addGridColumnListener(listener)
        grid.addGridColumnListener(new GridColumnListener() {

            public void onColumnMove(GridPanel grid, int oldIndex, int newIndex) {
                //MessageBox.alert("Dato " + grid.getColumnModel().getDataIndex(oldIndex).equals("precio"));
                if (grid.getColumnModel().getDataIndex(oldIndex).equals("precio")) {
                    Record record = grid.getStore().getAt(newIndex);
                    record.set("indoor", !record.getAsBoolean("indoor"));
                }
            }

            public void onColumnResize(GridPanel grid, int colIndex, int newSize) {
                throw new UnsupportedOperationException("Not supported yet.");
            }
        });

        grid.addEditorGridListener(new EditorGridListenerAdapter() {

            @Override
            public void onAfterEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
                String nuevo = newValue.toString();
                Float viejo = new Float(oldValue.toString());
                Float nue = new Float(nuevo);
                if (nue < viejo) {
                    com.google.gwt.user.client.Window.alert(" No puede bajar el precio de venta");
                    //record.commit();
                    record.set("precioventafinal", viejo);
                }
            }
        });

    }

    public void createCambioFalla() {
//String montonuevo =tex_fecha.getValueAsString().trim();
        Record[] records = grid.getStore().getModifiedRecords();
        JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();
        compraObject.put("idventa", new JSONString(idpedido));

        for (int i = 0; i < records.length; i++) {
//  String[] nombreComlumns = {"idmodelo","idventa", "codigo", "cajas","total", "pares", "precioventa","ventapar","precioventafinal"};

            productoObject = new JSONObject();
            productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
            productoObject.put("idventa", new JSONString(records[i].getAsString("idventa")));
            productoObject.put("precioventafinal", new JSONString(records[i].getAsString("precioventafinal")));
            productos.set(i, productoObject);
            productoObject = null;

        }
// String[] nombreComlumns = {"idmodelo","idventa", "codigo", "cajas","total", "pares", "precioventa","ventapar","precioventafinal"};

        JSONObject resultado = new JSONObject();
        resultado.put("venta", compraObject);
        resultado.put("productos", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "./php/VentaMayor.php?funcion=EditarVentaPrecio&" + datos;
        final Conector conec = new Conector(url, false, "POST");
        try {
            conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {

                private EventObject e;

                public void onResponseReceived(Request request, Response response) {
                    String data = response.getText();
                    JSONValue jsonValue = JSONParser.parse(data);
                    JSONObject jsonObject;
                    if ((jsonObject = jsonValue.isObject()) != null) {
                        String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                        String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                        if (errorR.equalsIgnoreCase("true")) {
                            Utils.setErrorPrincipal(mensajeR, "resultado");
                            //  Window.alert(mensajeR);
                            String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
                            //  FormularioKardexVenta kardex;
                            String enlTemp = "funcion=verboletaventa&idventa=" + idventaG;
                            verReporte(enlTemp);
                        // if (formularioc == null || formularioc.isHidden()) {
//                              showListProducto(idventaG);
                        //     } else {
                        //}
                        //reload();
                        // close();
                        //        destroy();
                        } else {
                            Utils.setErrorPrincipal(mensajeR, "error");
                        }
                    } else {
                        Utils.setErrorPrincipal("Error en la respuesta del servidor", "error");
                    }
                }

                public void onError(Request request, Throwable exception) {
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            });
        } catch (RequestException ex) {
            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
        }
    }

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
}
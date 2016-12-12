/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

import com.google.gwt.json.client.JSONString;

import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.widgets.TabPanel;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.Position;
import com.gwtext.client.widgets.Component;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.Window;

import com.gwtext.client.widgets.QuickTipsConfig;
import com.gwtext.client.widgets.event.PanelListenerAdapter;
import com.gwtext.client.widgets.form.FieldSet;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.grid.event.EditorGridListenerAdapter;
import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.FormLayout;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.TextAlign;
import com.gwtext.client.data.*;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.NumberField;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.grid.*;
import com.gwtext.client.widgets.grid.event.GridCellListenerAdapter;
import org.balderrama.client.traspaso.ListaTraspaso;

/**
 *
 * @author
 */
class FormularioKardexVentaCliente extends Window {

    private final int ANCHO = 800;
    private final int ALTO = 420;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("98%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanelCliente;
    private TextField tex_fecha;
    private Object[][] productoM;
    boolean respuesta = false;
    private RecordDef recordDef;
    private Float totalcantidad;
    private Float totalBs;
    private Float totalTotalV1073;
    private Float descPorV1073;
    private Float descCalV1073;
    private Float totalTotalVsus;
    private Float devuelto;
    // private Float montocambio;
    // private Float tipocambio;
    private Float devueltosus;
    private Float montocancelado;
    //    private Float montodescuento;
    private Float montocanceladosus;
    private Float diferencia;
    private Float nuevobs;
    private String montobs;
    private Float cambio;
    private Float montocanceladosusenbs;
    private Float nuevomontodeuda;
    private DateField dat_fecha;
    //   private Date fecha;
    private Button but_aceptar;
    //  private Button but_aceptarv;
    //   private Button but_cancelar;
    private String fechad;
    private String caja;
    private String real;
    private String descuento;
    public FieldSet userFS;
    private Float vcfactura;
    private String vsfactura;
    private String vctarjeta;
    private String vcredito;
    private String extras;
    private String cpagado;
    private String devolucion;
    private String gastos;
    private Number total;
//private String total;
    private Float ventaanterior;
    private Float ventanueva;
    private Float reintegro;
    private Float reintegron;
    private String credito;
    private String efecbs;
    private String efecsus;
    private String efecmonedas;
    private String depbs;
    private String depsus;
    private String cajanueva;
    private String cpagadoregistro;
    //   private String turno;
    private String[] estados;
    private Object[][] comunidadM;
    private Object[][] tipoM;
    private Store comunidadStore;
    private Store tipoStore;
    // private SeleccionFecha padre;
    private String fechab;
    private String idmarca;
    private String fecha;
    private String tipocambio;
    private Float tipocambio2;
    private EditorGridPanel grid1015;
    private ColumnConfig id1015;
    private ColumnConfig ida1015;
    private ColumnConfig id21015;
    private ColumnConfig codigo1015;
    private ColumnConfig codigof1015;
    private ColumnConfig nombre1015;
    private ColumnConfig marca1015;
    private ColumnConfig pais1015;
    private ColumnConfig paisa1015;
    private ColumnConfig paisb1015;
    private ColumnConfig pais21015;
    private ColumnConfig cantidad1015;
    private ColumnConfig preciobs1015;
    private ColumnConfig preciosus1015;
    private ColumnConfig pago7;
    private ColumnConfig car1015;
    private ToolbarButton editarProducto1015;
    private ToolbarButton eliminarProducto1015;
    private ToolbarButton nuevoProducto1015;
    private ToolbarButton duplicarProducto1015;
    private ToolbarButton caracProducto1015;
    private ToolbarButton inventarioProducto1015;
    private ToolbarButton kardexProducto1015;
    private ToolbarButton movimientoProducto1015;
    private ToolbarButton verProducto1015;
    protected ExtElement ext_element1015;
    private CheckboxSelectionModel cbSelectionModel1015;
    private Store store1015;
    private BaseColumnConfig[] columns1015;
    private ColumnModel columnModel1015;
    private DataProxy dataProxy1015;
    private JsonReader reader1015;
    PagingToolbar pagingToolbar1015;
//private ComboBox com_vendedor;
    public PanelInventario padre;
    public PanelInventarioM padreM;
    private String[] pagoM;
    private String[] facturaM;
    //   private ComboBox com_pago;
    //   private ComboBox com_factura;
    String idventa;

    public FormularioKardexVentaCliente(PanelInventario panel, String idventa, String montoventa) {

        this.idventa = idventa;
        this.montobs = montoventa;
        //  this.tipocambio = tipodecambio;
        this.padre = panel;
        String nombreBoton1 = "Confirmar e Imprimir";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Confirmar Precios VEnta";
        tituloTabla = "Confirmar Precios de venta por caja";

        setId("win-FormularioCambio");
        setTitle(tituloTabla);
        setWidth(ANCHO);
        setMinWidth(ANCHO);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        setPlain(true);

        but_aceptar = new Button(nombreBoton1);
        //      but_cancelar = new Button(nombreBoton2);
        //   addButton(but_aceptarv);
        addButton(but_aceptar);
        //    addButton(but_cancelar);

        formPanelCliente = new FormPanel();
        formPanelCliente.setBaseCls("x-plain");
        formPanelCliente.setLabelWidth(150);
        formPanelCliente.setUrl("save-form.php");
        formPanelCliente.setWidth(ANCHO);
        formPanelCliente.setHeight(ALTO);
        formPanelCliente.setLabelAlign(Position.LEFT);
        tex_fecha = new TextField("Monto Total Venta", "monto", 150);
        tex_fecha.setReadOnly(true);
        tex_fecha.setValue(montobs);
        formPanelCliente.setAutoWidth(true);


//formPanelCliente.add(tex_turno);
        formPanelCliente.add(tex_fecha);

        listaproductosdetalle(idventa);
        //formPanelCliente.add(userFS);
        add(formPanelCliente);
        initCombo();
        // initValidators();
        anadirListenersTexfield();
        addListeners();

    }

    public FormularioKardexVentaCliente(PanelInventarioM panelM, String idventa, String montoventa) {

        this.idventa = idventa;
        this.montobs = montoventa;
        this.padreM = panelM;
        String nombreBoton1 = "Confirmar e Imprimir";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Confirmar Precios VEnta";
        tituloTabla = "Confirmar Precios de venta por caja";

        setId("win-FormularioCambio");
        setTitle(tituloTabla);
        setWidth(ANCHO);
        setMinWidth(ANCHO);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        setPlain(true);

        but_aceptar = new Button(nombreBoton1);
        //      but_cancelar = new Button(nombreBoton2);
        //   addButton(but_aceptarv);
        addButton(but_aceptar);
        //    addButton(but_cancelar);

        formPanelCliente = new FormPanel();
        formPanelCliente.setBaseCls("x-plain");
        formPanelCliente.setLabelWidth(150);
        formPanelCliente.setUrl("save-form.php");
        formPanelCliente.setWidth(ANCHO);
        formPanelCliente.setHeight(ALTO);
        formPanelCliente.setLabelAlign(Position.LEFT);
        tex_fecha = new TextField("Monto Total Venta", "monto", 150);
        tex_fecha.setReadOnly(true);
        tex_fecha.setValue(montobs);
        formPanelCliente.setAutoWidth(true);


//formPanelCliente.add(tex_turno);
        formPanelCliente.add(tex_fecha);

        listaproductosdetalle(idventa);
        //formPanelCliente.add(userFS);
        add(formPanelCliente);
        initCombo();
        // initValidators();
        anadirListenersTexfield();
        addListeners();

    }

    private void anadirListenersTexfield() {
    }

    private void listaproductosdetalle(String idventa) {
        TabPanel tabPanel = new TabPanel();
        tabPanel.setPlain(true);
        tabPanel.setActiveTab(0);
        tabPanel.setHeight(370);
        tabPanel.setWidth(ANCHO);
        Panel firstPanel = new Panel();
        // firstPanel.setTitle("CALZADO PARA CAMBIAR");
        firstPanel.setLayout(new FormLayout());
        //    dataProxy1015 = new PagingMemoryProxy(productoM);
        dataProxy1015 = new ScriptTagProxy("php/VentaMayor.php?funcion=ListarDetalleProductosVenta&idventadetalle=" + idventa);

        recordDef = new RecordDef(new FieldDef[]{
                    // RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idmodelo"),
                    new StringFieldDef("idventa"),
                    new StringFieldDef("codigo"),
                    new StringFieldDef("cajas"),
                    new StringFieldDef("total"),
                    new StringFieldDef("pares"),
                    new StringFieldDef("preciodocena"),
                    new StringFieldDef("precioventa"),
                    new FloatFieldDef("ventapar")
                });
        reader1015 = new JsonReader(recordDef);
        reader1015.setRoot("resultado");
        reader1015.setTotalProperty("totalCount");

        store1015 = new Store(dataProxy1015, reader1015, true);
        //store1015.setRemoteSort(true);
        //  store1015.

        //chanchadita(store);
        id1015 = new ColumnConfig("Id kardex", "idmodelo", 80, false);
        ida1015 = new ColumnConfig("Id kardex", "idventa", 80, false);
        codigo1015 = new ColumnConfig("Articulo", "codigo", 130, false);
        /* columnade ci  */
        codigof1015 = new ColumnConfig("cajas", "cajas", 70, false);
        /* columnade nombre  */
        nombre1015 = new ColumnConfig("Total", "total", 70, false);
        nombre1015.setAlign(TextAlign.CENTER);
        /* columnade primer apellido  */
        marca1015 = new ColumnConfig("Pares", "pares", 70, false);
        marca1015.setAlign(TextAlign.CENTER);
        paisa1015 = new ColumnConfig("PrecioXCaja", "preciodocena", 95, false);
        paisb1015 = new ColumnConfig("PrecioXpares", "precioventa", 95, false);

        /* columnade rol  */
        pais1015 = new ColumnConfig("Precio Final Venta", "ventapar", 160, false);
        //  pais1015.setAlign(TextAlign.CENTER);
        //        pais1015.setEditor(new GridEditor(metodoFeli()));
//          NumberField numberField = new NumberField();
//        numberField.setAllowBlank(false);
//        numberField.setAllowNegative(false);
//        numberField.setMaxValue(1000);
//        pais1015.setEditor(new GridEditor(numberField));
        pais1015.setAlign(TextAlign.RIGHT);
        pais1015.setRenderer(new Renderer() {

            public String render(Object value, CellMetadata cellMetadata, Record record,
                    int rowIndex, int colNum, Store store) {
                return "$" + value;
            }
        });
        NumberField numberField = new NumberField();
        numberField.setAllowBlank(false);
        numberField.setAllowNegative(false);
        numberField.setMaxValue(1000);
        pais1015.setEditor(new GridEditor(numberField));
// pais1015.setEditor(new GridEditor(metodoFeli()));
        cbSelectionModel1015 = new CheckboxSelectionModel();
        CheckboxColumnConfig checkBoxColumnc = new CheckboxColumnConfig(cbSelectionModel1015);
        columns1015 = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel1015),
                    //column ID is company which is later used in setAutoExpandColumn
                    //id1015,
                    codigo1015,
                    codigof1015,
                    //  nombre1015,
                    marca1015,
                    paisa1015,
                    paisb1015,
                    pais1015
                };

        columnModel1015 = new ColumnModel(columns1015);
        grid1015 = new EditorGridPanel();

        // grid1015 = new EditorGridPanel();
        grid1015.setId("grid-lista-productos-venta-mayor");
        grid1015.setTitle("Calzados vendidos");
        grid1015.setStore(store1015);
        grid1015.setColumnModel(columnModel1015);
        grid1015.setTrackMouseOver(true);
        grid1015.setLoadMask(true);
        grid1015.setSelectionModel(cbSelectionModel1015);
        grid1015.setFrame(true);
        grid1015.setStripeRows(true);
        grid1015.setIconCls("grid-icon");
        grid1015.setClicksToEdit(1);

        pagingToolbar1015 = new PagingToolbar(store1015);
        pagingToolbar1015.setPageSize(100);
        pagingToolbar1015.setDisplayInfo(true);
        pagingToolbar1015.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar1015.setEmptyMsg("No topics to display");
        pagingToolbar1015.addSeparator();
        eliminarProducto1015 = new ToolbarButton("Habilitar campos para editar precios");
        eliminarProducto1015.setEnableToggle(true);
        QuickTipsConfig tipsConfig8 = new QuickTipsConfig();
        tipsConfig8.setText("Reordenar");
        eliminarProducto1015.setTooltip(tipsConfig8);

        pagingToolbar1015.addSeparator();
        pagingToolbar1015.addButton(eliminarProducto1015);
        //  pagingToolbar1015.addButton(kardexProducto1015);
        //pagingToolbar1015.addSeparator();

        grid1015.setBottomToolbar(pagingToolbar1015);

        grid1015.setWidth(ANCHO - 80);
        grid1015.setHeight(350);
        grid1015.addGridCellListener(new GridCellListenerAdapter() {

            @Override
            public void onCellClick(GridPanel grid, int rowIndex, int colIndex, EventObject e) {
                if (grid.getColumnModel().getDataIndex(colIndex).equals("ventapar") &&
                        e.getTarget(".checkbox", 1) != null) {
                    Record record = grid.getStore().getAt(rowIndex);
                    record.set("ventapar", !record.getAsBoolean("ventapar"));
                }
            }
        });
//  grid1015.addListener(
//                new PanelListenerAdapter() {
//
//                    @Override
//                    public void onRender(Component component) {
//                        store1015.load(0, 100);
//                    }
//                });
        aniadirListenersCompra();
        firstPanel.add(grid1015);
        tabPanel.add(firstPanel);


        formPanelCliente.add(tabPanel);


    }

    public NumberField metodoFeli() {


        NumberField num_field1 = new NumberField();
        num_field1.setAllowDecimals(false);
        num_field1.setAllowBlank(false);

        num_field1.setAllowNegative(false);

        return num_field1;
    }

    private void aniadirListenersCompra() {
        eliminarProducto1015.addListener(new ButtonListenerAdapter() {

            @Override
            @SuppressWarnings("static-access")
            public void onClick(Button button, EventObject e) {
                grid1015.stopEditing();
                // MessageBox.alert("ordenando");
                grid1015.startEditing(0, 0);
                store1015.clearSortState(true);
                store1015.reload();
                eliminarProducto1015.setPressed(false);
            }
        });

        grid1015.addListener(
                new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store1015.load(0, 100);
                    //   store1015.setSortInfo(new SortState("precio2", SortDir.DESC));

                    }
                });
        grid1015.addEditorGridListener(new EditorGridListenerAdapter() {

            @Override
            public void onAfterEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
                String nuevo = newValue.toString();
                Float viejo = new Float(oldValue.toString());
                Float nue = new Float(nuevo);

                ////Float preciooriginal = record.getAsFloat("ventapar");
                ////com.google.gwt.user.client.Window.alert(" precio " + preciooriginal + " nuevo " + nue + " viejo " + viejo);
                if (nue < viejo) {
                    com.google.gwt.user.client.Window.alert(" No puede bajar el precio de venta");
                    grid1015.stopEditing();
                    grid1015.startEditing(0, 0);
                    store1015.clearSortState(true);
                    store1015.reload();
                } else {
                    recalculargrid(grid1015, record, field, newValue, oldValue, rowIndex, colIndex, true);
                }
            //    calcularSubTotal(grid, record, field, newValue, oldValue, rowIndex, colIndex);

            //   store1015.setSortInfo(new SortState("precio2", SortDir.DESC));

            }
        });
//         grid1015.addGridRowListener(new GridRowListenerAdapter() {
//
//            @Override
//            public void onRowDblClick(GridPanel grid, int rowIndex, EventObject e) {
//                Record rs = grid1015.getStore().getRecordAt(rowIndex);
//                //quitarEsteItem(rs);
//            }
//        });
    }

    private void initCombo() {
    }

    private void initValues() {
        //tex_turno.setValue(idmarca);

        tex_fecha.setValue(fechad);


    }

    private void addListeners() {


        but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                createCambioFalla(idventa);
            }
        });



//        but_cancelar.addListener(new ButtonListenerAdapter() {
//
//            @Override
//            public void onClick(Button button, EventObject e) {
//            close();
//            destroy();
//            }
//        });


    }

    private void recalculargrid(GridPanel grid1015, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex, boolean desc) {

        //  private void recalculargrid(boolean desc) {
        String temp = newValue.toString();
        Float old = new Float(oldValue.toString());

        Float ne = old;
        try {
            ne = new Float(temp);
        } catch (Exception e) {
            // com.google.gwt.user.client.Window.alert("atapadp  " + e.getMessage());
            ne = old;
        }
        Float precio2 = record.getAsFloat("ventapar");

        record.commit();
        record.set("ventapar", precio2);

        // record.set("total", record.getAsFloat("cantidad") * record.getAsFloat("precio2"));

        Float total = new Float(0);
        Float totalcan = new Float(0);
        for (int i = 0; i <
                grid1015.getStore().getRecords().length; i++) {

            total += grid1015.getStore().getRecords()[i].getAsFloat("ventapar");
        }
        //    tex_montoPagar.setValue(total.toString());
        // tex_montocancelado.setValue(total.toString());


//tex_totalpares.setValue(totalpares.toString());
        tex_fecha.setValue(total.toString());
//        totalcantidad = new Float(0);
//        totalBs = new Float(0);
        Record[] recs = grid1015.getStore().getRecords();



//                                            calcularreintegro(true);
    //findByCodigoCliente2();

    }

    public void createCambioFalla(String idven) {
        String montonuevo = tex_fecha.getValueAsString().trim();
        Record[] records = grid1015.getStore().getRecords();
        JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();
        compraObject.put("idventa", new JSONString(idven));
        compraObject.put("montototal", new JSONString(montonuevo));
//        compraObject.put("fecha", new JSON(date));


        for (int i = 0; i < records.length; i++) {

            productoObject = new JSONObject();
            productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
            productoObject.put("precioventa", new JSONString(records[i].getAsString("precioventa")));
            productoObject.put("ventapar", new JSONString(records[i].getAsString("ventapar")));
            productoObject.put("pares", new JSONString(records[i].getAsString("pares")));
            productos.set(i, productoObject);
            productoObject = null;

        }

        JSONObject resultado = new JSONObject();
        resultado.put("venta", compraObject);
        resultado.put("productos", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "./php/VentaMayor.php?funcion=txSaveVentaConfirmada&" + datos;
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
                            close();
                            destroy();
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
}

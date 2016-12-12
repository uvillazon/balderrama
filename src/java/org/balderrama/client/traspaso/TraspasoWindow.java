/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.traspaso;

/**
 *
 * @author Administrador
 */
//import org.tiendab.client.almacen.compra.*;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.Position;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.TextAlign;
import com.gwtext.client.data.ArrayReader;
import com.gwtext.client.data.FieldDef;
import com.gwtext.client.data.FloatFieldDef;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.RecordDef;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.data.Store;
import com.gwtext.client.data.StringFieldDef;
import com.gwtext.client.util.DateUtil;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.QuickTipsConfig;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.TabPanel;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextArea;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.grid.GridEditor;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import com.gwtext.client.widgets.grid.event.EditorGridListenerAdapter;

import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.ColumnLayout;
import com.gwtext.client.widgets.layout.ColumnLayoutData;
import com.gwtext.client.widgets.layout.FormLayout;
import com.gwtextux.client.data.PagingMemoryProxy;
import java.util.Date;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import org.balderrama.client.sistemadetalle.FormularioProductoKardex;
import org.balderrama.client.util.BuscadorToolBar;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.KMenu;

public class TraspasoWindow extends Window {

    private final int ANCHOFCD = 950;
    private final int ALTOFCD = 400;
    private final AnchorLayoutData ANCHO_LAYOUT_DATAFCD = new AnchorLayoutData("95%");
//    private TextField tex_almacenorigen;
//    private TextField tex_origen;
    private TextField tex_idproducto;
    private ComboBox com_almacendestino;
    private ComboBox com_empleado;
    private TextField tex_codigoBarra;
    private DateField dat_fecha;
    private TextArea tex_descripcion;
    private FormPanel for_panel;
    private EditorGridPanel grid;
    private Store store;
    private ColumnModel columnModel;
    private BaseColumnConfig[] columns;
    private CheckboxSelectionModel cbSelectionModel;
    boolean respuesta = false;
    private ColumnConfig Columnid;
    private ColumnConfig Columncodigo;
    private ColumnConfig Columnproducto;
    private ColumnConfig Columntalla;
    private ColumnConfig Columncantidad;
    private ColumnConfig Columnpreciobs2;
    private PagingMemoryProxy proxy;
    private RecordDef recordDef;
    private ArrayReader reader;
    private ToolbarButton eliminarEntrega;
    private Object[][] productoM;
    private Button aceptar;
    private Button cancelar;
    private Button verproducto;
    private Float totalcantidad;
    private Float totalBs;
    protected ExtElement ext_element;
    public TabPanel tap_panel;
    private MostrarAlmacenesWindow formulario_alm;
   // private ListaCompraProducto lista;
   // ToolbarMenuSistema toolbar;
    PagingToolbar pagingToolbar;
    String idtraspaso;
    String idalmacenorigen;
    String idalmacendestino;
    String origen;
    String destino;

    String idempleado;
    String empleado;
    String idproducto;
    String numerodocumento;
    String descripcion;
    String producto;
    String fecha;
    String hora;
    String idalmacen;
    String almacen;
    private Object[][] tiendaM;
    private Object[][] empleadoM;
private Date fechahoy;
private ListaTraspaso padre;
    /**
     * Si id usuario es null, quiere decir que es para crear un nuevo
     */
    public TraspasoWindow(Object[][] tienda, Object[][] empleado, ListaTraspaso padr) {
        this.productoM = new Object[][]{new Object[]{"kar-0", "", "Total","", 0, 0}};
        this.tiendaM = tienda;
        this.empleadoM = empleado;

        this.padre = padr;
        this.idtraspaso = null;
        setWidth(950);
        setMinWidth(950);
        setHeight(500);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        setPlain(true);
        initComponents();
        initValues();
        addListeners();
        addlistenerscombos();
//        initValidators();
    }
private void addlistenerscombos() {


com_empleado.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    com_almacendestino.setDisabled(false);
                     com_almacendestino.focus();

                //  GuardarEditarCliente(e);
                }
            }
        });

         com_empleado.addListener(new ComboBoxListenerAdapter() {

            @Override
            public void onSelect(ComboBox comboBox, Record record, int index) {
              //  onChangeMarca();
                 com_almacendestino.setDisabled(false);
                com_almacendestino.focus();
              //   tex_codigoBarra.focus();
            }
        });
com_almacendestino.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                     tex_codigoBarra.setDisabled(false);
                     tex_codigoBarra.focus();
                //  GuardarEditarCliente(e);
                }
            }
        });
          com_almacendestino.addListener(new ComboBoxListenerAdapter() {

            @Override
            public void onSelect(ComboBox comboBox, Record record, int index) {

                   // recalcular(true);
                     tex_codigoBarra.focus();
                }
        });

}
    public TraspasoWindow(String idcompra, JSONObject datosEditar) {

        getDatosJsonEditar(datosEditar);
        setWidth(750);
        setMinWidth(750);
        setHeight(500);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        setPlain(true);
        this.idtraspaso = idcompra;
        initComponents();
        addListeners();
        initValues();
        initValidators();

    }

    public TraspasoWindow(String idalmacen, String almacen) {

//        this.productoM = new Object[][]{new Object[]{"kar-1", "TOTAL", "TOTAL", 0, 0}};
//        this.productoM = new Object[][]{{}};
        this.idtraspaso = null;
        setWidth(950);
        setMinWidth(950);
        setHeight(550);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        setPlain(true);
        this.idalmacen = idalmacen;
        this.almacen = almacen;
        this.idalmacenorigen = idalmacen;
        this.origen = almacen;
        initComponents();
        addListeners();
        initValues();
        initValidators();

    }

    private void getDatosJsonEditar(JSONObject data) {

        JSONObject docO;
        JSONValue docV;
        docV = data.get("resultado");
        if ((docO = docV.isObject()) != null) {

            this.fecha = Utils.getStringOfJSONObject(docO, "fecha");

            this.idalmacenorigen = Utils.getStringOfJSONObject(docO, "idalmacenorigen");
            this.origen = Utils.getStringOfJSONObject(docO, "origen");
            this.idalmacendestino = Utils.getStringOfJSONObject(docO, "idalmacendestino");
            this.destino = Utils.getStringOfJSONObject(docO, "destino");
            this.idempleado = Utils.getStringOfJSONObject(docO, "idempleado");
            this.empleado = Utils.getStringOfJSONObject(docO, "empleado");

            this.numerodocumento = Utils.getStringOfJSONObject(docO, "numerodocumento");
            this.productoM = Utils.getArrayOfJSONObject(data, "productos", new String[]{"idkardextienda", "codigo", "detalle", "cantidad", "precio2"});
        } else {
            Utils.setErrorPrincipal("El objecto tiene una falla", "error");
            TraspasoWindow.this.clear();
            TraspasoWindow.this.destroy();
            TraspasoWindow.this.close();
        }
    }

    private void initComponents() {

        for_panel = new FormPanel();
        for_panel.setLabelWidth(60);
        for_panel.setLabelAlign(Position.LEFT);
        for_panel.setBaseCls("x-plain");


       

        dat_fecha = new DateField("Fecha", "d-m-Y");
         fechahoy = new Date();
              dat_fecha.setValue(fechahoy);
 dat_fecha.setReadOnly(true);



        Panel topPanel = new Panel();
        topPanel.setLayout(new ColumnLayout());
        topPanel.setBaseCls("x-plain");

        Panel columnOnePanel = new Panel();
        columnOnePanel.setBaseCls("x-plain");
        columnOnePanel.setLayout(new FormLayout());

        Panel columnTwoPanel = new Panel();
        columnTwoPanel.setBaseCls("x-plain");
        columnTwoPanel.setLayout(new FormLayout());

        Panel columnThreePanel = new Panel();
        columnThreePanel.setBaseCls("x-plain");
        columnThreePanel.setLayout(new FormLayout());
  com_almacendestino = new ComboBox("Tienda Destino", "destino");
         com_almacendestino.setDisabled(true);
        com_empleado = new ComboBox("Empleado", "empleado");
        com_empleado.focus();
        tex_codigoBarra = new TextField("codigo barra.", "codigobarra");
        tex_codigoBarra.setDisabled(true);

  columnTwoPanel.add(com_empleado);

     
        columnTwoPanel.add(com_almacendestino, ANCHO_LAYOUT_DATAFCD);
        
        columnTwoPanel.add(tex_codigoBarra, ANCHO_LAYOUT_DATAFCD);

//        dat_fecha = new DateField("Fecha", "fecha");
//        dat_fecha = new DateField("Fecha", "fecha");
        tex_descripcion = new TextArea("Obser.", "observacion");
       // columnThreePanel.add(com_empleado, ANCHO_LAYOUT_DATAFCD);
         columnThreePanel.add(dat_fecha, ANCHO_LAYOUT_DATAFCD);

        columnThreePanel.add(tex_descripcion, ANCHO_LAYOUT_DATAFCD);
        initCombos();
        topPanel.add(columnOnePanel, new ColumnLayoutData(0.3));
        topPanel.add(columnTwoPanel, new ColumnLayoutData(0.3));
        topPanel.add(columnThreePanel, new ColumnLayoutData(0.3));

        //grillla
        proxy = new PagingMemoryProxy(productoM);
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idkardextienda"),
                    new StringFieldDef("codigo"),
                    new StringFieldDef("detalle"),
                     new StringFieldDef("talla"),
                    new FloatFieldDef("cantidad"),
                    new FloatFieldDef("precio2")
                });
        reader = new ArrayReader(recordDef);

        store = new Store(proxy, reader, true);
        store.load();


        Columnid = new ColumnConfig("Id kardextienda", "idkardextienda", 100, true);

        Columncodigo = new ColumnConfig("Articulo", "codigo", 100, true);

        Columnproducto = new ColumnConfig("Detalle", "detalle", 300, true);
         Columntalla = new ColumnConfig("Talla", "talla", 100, true);
        Columncantidad = new ColumnConfig("Cantidad", "cantidad", 100, true);
         Columncantidad.setEditor(new GridEditor(new TextField()));

        Columnpreciobs2 = new ColumnConfig("Precio", "precio2", 150, true);
        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    Columncodigo,
                    Columnproducto,
                    Columntalla,
                    Columncantidad,
                    Columnpreciobs2,};
        columnModel = new ColumnModel(columns);
        grid = new EditorGridPanel();
        grid.setWidth(900);
        grid.setHeight(330);
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setId("grid-lista-traspaso_producto");
        grid.setTitle("Lista de Productos - Calzados");
        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No existen compras para mostrarse");
        eliminarEntrega = new ToolbarButton("Quitar");
        eliminarEntrega.setEnableToggle(true);
        QuickTipsConfig tipsConfig8 = new QuickTipsConfig();
        tipsConfig8.setText("Quitar");
        eliminarEntrega.setTooltip(tipsConfig8);

        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarEntrega);
        pagingToolbar.addSeparator();
        grid.setBottomToolbar(pagingToolbar);
        aniadirListenersCompra();


        for_panel.add(topPanel);
        add(for_panel);
        add(grid);
        aceptar = new Button("Aceptar");
        cancelar = new Button("Cancelar");
        verproducto = new Button("Ver Producto");
        addButton(aceptar);
        addButton(cancelar);

    }

    private void initCombos() {

//

        final SimpleStore proveedorStore = new SimpleStore(new String[]{"idtienda", "nombre"}, tiendaM);
        proveedorStore.load();
        com_almacendestino.setMinChars(1);
        com_almacendestino.setStore(proveedorStore);
        com_almacendestino.setValueField("idtienda");
        com_almacendestino.setDisplayField("nombre");
        com_almacendestino.setForceSelection(true);
        com_almacendestino.setMode(ComboBox.LOCAL);
        com_almacendestino.setEmptyText("Seleccione una tienda");
        com_almacendestino.setLoadingText("buscando...");
        com_almacendestino.setTypeAhead(true);
        com_almacendestino.setSelectOnFocus(true);
        com_almacendestino.setWidth(200);

        com_almacendestino.setHideTrigger(true);





        final SimpleStore proveedorStore1 = new SimpleStore(new String[]{"idempleado", "codigo"}, empleadoM);
        proveedorStore1.load();

        com_empleado.setMinChars(1);
        //com_empresa.setFieldLabel("Ciudad");
        com_empleado.setStore(proveedorStore);
        com_empleado.setValueField("idempleado");
        com_empleado.setDisplayField("codigo");
        com_empleado.setForceSelection(true);
        com_empleado.setMode(ComboBox.LOCAL);
        com_empleado.setEmptyText("Seleccione el responsable");
        com_empleado.setLoadingText("buscando...");
        com_empleado.setTypeAhead(true);
        com_empleado.setSelectOnFocus(true);
        com_empleado.setWidth(200);

        com_empleado.setHideTrigger(true);

        com_empleado.setStore(proveedorStore1);


    }

    private void initValidators() {
    }

    private void initValues() {
     
//        com_almacendestino.setValue(idalmacendestino);
//        com_almacendestino.setValue(destino);
//        com_empleado.setValue(empleado);
//        tex_descripcion.setValue(descripcion);

    }

    private void recuperarCuenta(String valor) {
    }

    private void addListeners() {
       this.aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                guardarTraspaso();
            }
        });
         this.cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
               // guardarTraspaso();
            LimpiarGrid();
               clear();
                destroy();
                 close();

            }
        });
    }
public void LimpiarGrid() {
        store.removeAll();

        grid.setStore(store);
        grid.reconfigure(store, columnModel);
}
    private void aniadirListenersCompra() {
        //**************************************************
        //***********ELIMINAR COMPRA
        //**************************************************


//        tex_almacenorigen.addListener(new TextFieldListenerAdapter() {
//
//            @Override
//            public void onSpecialKey(Field field, EventObject e) {
//                String dat = tex_almacenorigen.getText();
//                dat = dat.trim();
//                if (e.getKey() == EventObject.ENTER) {
//                    if (dat == "" || dat == null) {
//                        LanzarAlmacenes();
//
//                    } else {
////                        recuperarDocumento(tex_almacenorigen.getText());
//                    }
//                }
//            }
//        });
       com_almacendestino.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                String dat = com_almacendestino.getText();
                dat = dat.trim();
                if (e.getKey() == EventObject.ENTER) {
                    if (dat == "" || dat == null) {
                       // LanzarAlmacenesDestino();
                       MessageBox.alert("Por favor seleccione una tienda destino");

                    } else {
//                        recuperarDocumento(tex_almacenorigen.getText());
                    }
                }
            }
        });

        tex_codigoBarra.addListener(new TextFieldListenerAdapter() {

            private FormularioProductoKardex kardex;

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    // abrir la lsita de productos for_proveedor
                    //MessageBox.alert(field.getValueAsString());
                  //  String codigoProducto = field.getValueAsString().trim();
//                    String idProveedor = tex_almacenorigen.getValueAsString().trim();
                    String idproductos = tex_codigoBarra.getValueAsString().trim();

                    if (idproductos.isEmpty() || findByCodigoProducto(idproductos)) {
                        if (kardex == null || kardex.isHidden()) {
//                                showListProducto();
                            } else {
                            kardex.onFocus();
                        }


                    }
                    Utils.setErrorPrincipal("Usted debe introducir un id almacen antes.", "error");


                }
            }

            private boolean findByCodigoProducto(final String codigoBuscado) {
                respuesta = false;
                String enlace = "php/KardexTienda.php?funcion=traspasobuscarporcodigobarra&codigo=" + codigoBuscado;
                Utils.setErrorPrincipal("Cargando parametros del producto", "cargar");
                final Conector conec = new Conector(enlace, false);

                try {
                    conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

//                        private String idkardexmodelo;
//                        private String codigo;
//                        private String detalle;
//                        private Number precio2;
//                        private Number cantidad1;

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {
                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
                                    JSONValue productoValue = jsonObject.get("resultado");
                                    JSONObject productoObject;
                                    if ((productoObject = productoValue.isObject()) != null) {

                                      String  idkardexmodelo = Utils.getStringOfJSONObject(productoObject, "idkardextienda");
                                       String codigo = Utils.getStringOfJSONObject(productoObject, "codigo");
                                        Number precio2 = Utils.getBigDecimalOfJSONObject(productoObject, "precio2");
                                     String detalle = Utils.getStringOfJSONObject(productoObject, "detalle");
                                     String talla = Utils.getStringOfJSONObject(productoObject, "talla");


                                     // Number cantidad = Utils.getBigDecimalOfJSONObject(productoObject, "cantidad");
                                      // cantidad1 = Utils.getBigDecimalOfJSONObject(productoObject, "cantidad");

                                       Number cantidad = 1.0;
                                        //total = 3.0;
                                  //      Record plant;

                            //            plant = recordDef.createRecord(new Object[]{idkardexmodelo, codigo, detalle, "1", precio2});
 Record plant = recordDef.createRecord(new Object[]{idkardexmodelo, codigo, detalle,talla, cantidad, precio2});

                                        grid.stopEditing();
                                        store.insert(0, plant);

                                        recalcular(true);
                                        tex_codigoBarra.setValue("");
                                        tex_codigoBarra.focus();
                                        respuesta = true;
                                    } else {
                                        Utils.setErrorPrincipal("No se recuperaron correctamente lo valores ", "error");
                                    }

                                } else {
                                    MessageBox.alert(mensajeR);
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");

                        }
                    });

                } catch (RequestException ex) {
                    ex.getMessage();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }

                return respuesta;
            }
        });
//
//

        //**************************************************
        //***********REPORTE COMPRA
        //**************************************************
//        verEntrega.addListener(new ButtonListenerAdapter() {
//
//            private String selecionado;
//
//            @Override
//            public void onClick(Button button, EventObject e) {
//                Record[] records = cbSelectionModel.getSelections();
//                if (records.length == 1) {
//                    selecionado = records[0].getAsString("idproducto");
//                    String enlTemp = "funcion=reporteproductoHTML&idproducto=" + selecionado;
//                    verReporte(enlTemp);
//
//                } else {
//                    MessageBox.alert("No hay entrega selecionado para ver detalle y/o selecciono mas de uno.");
//                }
//                verEntrega.setPressed(false);
//            }
//        });
        eliminarEntrega.addListener(new ButtonListenerAdapter() {

            private String selecionado;

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idkardextienda");
                    grid.stopEditing();
                    store.remove(cbSelectionModel.getSelected());
                    grid.startEditing(0, 0);
                    recalcular(true);
                } else {
                    MessageBox.alert("No hay producto selecionado para eliminar y/o selecciono mas de uno.");
                }
                eliminarEntrega.setPressed(false);
            }
        });

        grid.addEditorGridListener(new EditorGridListenerAdapter() {

            @Override
            public void onAfterEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
                recalcular(true);
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

    private void LanzarAlmacenes() {
        if (formulario_alm != null) {
            formulario_alm.clear();
            formulario_alm.destroy();
            formulario_alm =
                    null;
        }

        formulario_alm = new MostrarAlmacenesWindow(TraspasoWindow.this);
        formulario_alm.show();
    }

    private void LanzarAlmacenesDestino() {
        if (formulario_alm != null) {
            formulario_alm.clear();
            formulario_alm.destroy();
            formulario_alm =
                    null;
        }
        String dato = "destino";
        formulario_alm = new MostrarAlmacenesWindow(TraspasoWindow.this, dato);
        formulario_alm.show();
    }

    public void recuperarAlmacenOrigen(String codigo, String almacen) {

        com_almacendestino.focus();

    }

    public void anadirProductoTraspaso(String idproducto, String codigo,String nombre,String talla, String cantidad, String precio1bs) {
//        com.google.gwt.user.client.Window.alert(fecha);


        Record plant;

        plant = recordDef.createRecord(new Object[]{idproducto,codigo, nombre, talla,new Float("0"), new Float("0")});

        grid.stopEditing();
        store.insert(0, plant);
    }

   private void guardarTraspaso() {

        Record[] produc = grid.getStore().getRecords();
        if (produc.length <= 0) {

            Utils.setErrorPrincipal("Tiene que traspasar por lo menos un producto", "error");
        } else {
            String enlace = "";
            String mensaje = "";
            String datos = "";
            JSONArray itemDocumentos = new JSONArray();
            JSONObject itemDocumento;

            for (int i = 0; i < produc.length; i++) {
                if (!produc[i].getAsString("idkardextienda").equalsIgnoreCase("kar-0")) {
                    itemDocumento = new JSONObject();
                    itemDocumento.put("idkardextienda", new JSONString(produc[i].getAsString("idkardextienda")));
       Float debed = produc[i].getAsFloat("cantidad");
                   itemDocumento.put("cantidad", new JSONString(debed.toString()));
                    Float precio2 = produc[i].getAsFloat("precio2");
                    itemDocumento.put("precio2", new JSONString(precio2.toString()));
                    itemDocumentos.set(i, itemDocumento);
                    itemDocumento = null;
                }
            }
//            String idorigen = tex_almacenorigen.getText();
            String iddestino = com_almacendestino.getText();
            String encargado = com_empleado.getText();

            String numdoc = tex_codigoBarra.getText();

            String fecha1 = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
            String desc = tex_descripcion.getText();
            JSONObject resultado = new JSONObject();

            resultado.put("fecha", new JSONString(fecha1));
//            resultado.put("idalmacenorigen", new JSONString(idorigen));
            resultado.put("idalmacendestino", new JSONString(iddestino));
            resultado.put("idempleado", new JSONString(encargado));

            resultado.put("numerodocumento", new JSONString(numdoc));
            resultado.put("descripcion", new JSONString(desc));
            resultado.put("productos", itemDocumentos);

            if (idtraspaso == null) {
                datos = "resultado=" + resultado.toString();
                enlace = "php/TraspasoDetalle.php?funcion=guardartraspasos&" + datos;

                mensaje = "Guardar la transaccion";


            } else {
                resultado.put("iddocumento", new JSONString(idtraspaso));
                datos = "resultado=" + resultado.toString();
                enlace = "php/dao/TransaccionActualizar.php?function=txUpdateTransaccion&" + datos;
                mensaje = "Guardar la transaccion";

            }

            Utils.setErrorPrincipal(mensaje, "cargar");
            final Conector conecSAVE = new Conector(enlace, false, "GET");

            try {
                conecSAVE.getRequestBuilder().sendRequest(datos, new RequestCallback() {

                    public void onResponseReceived(Request request, Response response) {

                        String data = response.getText();
                        JSONValue jsonValue = JSONParser.parse(data);
                        JSONObject jsonObject;

                        if ((jsonObject = jsonValue.isObject()) != null) {
                            String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                            String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                            if (errorR.equalsIgnoreCase("true")) {

                                String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
                                
                                String enlTemp = "funcion=traspasoHTML&idtraspaso=" + idventaG;
                                verReporte(enlTemp);
                                Utils.setErrorPrincipal(mensajeR, "mensaje");
                                 padre.reload();
                                  LimpiarGrid();
                                clear();
                                destroy();
                                close();



                            } else {
                                Utils.setErrorPrincipal(mensajeR, "error");
                            }

                        } else {
                            Utils.setErrorPrincipal("Error en la respuesta del servidor", "error");
                        }

                    }

                    public void onError(Request request, Throwable exception) {
                        //Window.alert("Ocurrio un error al conectar con el servidor ");
                        Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                    }
                });

            } catch (RequestException ex) {
                Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
            }

        }
    }

    public void recuperarAlmacenDestino(String codigo, String almacen) {

        com_almacendestino.setValue(codigo);
        com_almacendestino.setValue(almacen);

        tex_idproducto.focus();

//                            lanzarWindowBuscarProducto();
//                            lanzarWindowBuscarProducto();


    }

    private void recalcular(boolean desc) {


        totalcantidad = new Float(0);
        totalBs = new Float(0);
        Record[] recs = grid.getStore().getRecords();
//        com.google.gwt.user.client.Window.alert("" + recs.length);
        for (int i = 0; i < recs.length; i++) {
            String idCuenta = recs[i].getAsString("idkardextienda");
//            com.google.gwt.user.client.Window.alert(idCuenta);
            if (idCuenta.equalsIgnoreCase("kar-0")) {
//                com.google.gwt.user.client.Window.alert("1" + recs.length);
                recs[i].set("cantidad", totalcantidad);
                recs[i].set("precio2", totalBs);

//                com.google.gwt.user.client.Window.alert("2" + recs.length);
            } else {
//                com.google.gwt.user.client.Window.alert("3" + recs.length);
                Float cantidad = recs[i].getAsFloat("cantidad");
                Float precio = recs[i].getAsFloat("precio2");

                if (cantidad.isNaN() == true) {
                    cantidad = new Float("0");
                }
                if (precio.isNaN() == true) {
                    precio = new Float("0");
                }





                totalcantidad = totalcantidad + cantidad;
                totalBs = totalBs + precio;


            }

        }
    }

    private void quitarEsteItem(Record quitar) {
        store.remove(quitar);

        store.reload();
        grid.setStore(store);
        grid.reconfigure(store, columnModel);
        grid.getView().refresh();
        recalcular(true);
    }

    private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
}
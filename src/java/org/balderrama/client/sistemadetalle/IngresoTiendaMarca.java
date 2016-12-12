/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

import org.balderrama.client.modelo.*;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.data.FieldDef;
import com.gwtext.client.data.JsonReader;
import com.gwtext.client.data.RecordDef;
import com.gwtext.client.data.ScriptTagProxy;
import com.gwtext.client.data.StringFieldDef;
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
import com.gwtext.client.core.UrlParam;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.Store;
import com.gwtext.client.util.Format;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import org.balderrama.client.util.Conector;
import com.gwtext.client.widgets.form.Checkbox;
import com.gwtext.client.widgets.grid.CellMetadata;
import com.gwtext.client.widgets.grid.Renderer;
import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.form.Field;
import org.balderrama.client.util.BuscadorToolBar;
import org.balderrama.client.util.KMenu;

/**
 *
 * @author 
 */
public class IngresoTiendaMarca extends Panel {

    private GridPanel grid;
    private ColumnConfig idColumn;
    private ColumnConfig codigoColumn;
    private ColumnConfig marcaColumn;
    private ColumnConfig tiendaColumn;
    private ColumnConfig totalparesColumn;
     private ColumnConfig totalcajasColumn;
      private ColumnConfig totalsusColumn;
    private ColumnConfig fechaColumn;
    private ColumnConfig horaColumn;
    private ColumnConfig responsableColumn;
    private final int ANCHO = Utils.getScreenWidth() - 24;
    private final int ALTO = Utils.getScreenHeight() - 275;
    private ToolbarButton anularIngreso;
    private ToolbarButton eliminarModelo;
   private ToolbarButton verdetalle;
//    private Toolbar too_busquedaPBW;
    private ToolbarButton buscar;
//    private TextField tex_modeloPBU;
//    private TextField tex_colorPBU;
//    private TextField tex_materialPBU;
//    private TextField tex_marcaPBU;
    private BuscadorToolBar buscadorToolBar;
    protected String buscarModelo;
    protected String buscarMarca;
    protected String buscarColeccion;
    protected String buscarLinea;
    private EditarModeloForm formulario;
    private ToolbarButton CodigoBarra;
     private ToolbarButton CodigoBarracaja;
    private ToolbarButton codlineaMarca;
    private ToolbarButton codcolorMarca;
    private ToolbarButton codmaterialMarca;
    private ToolbarButton configurarMarca;
    private ToolbarButton cargarimagenMarca;
    // private EditarMarcaForm formulario;
    protected ExtElement ext_element;
    CheckboxSelectionModel cbSelectionModel;
    Store store;
    private String selecionado;
        private String selecionado1;
         private String selecionado2;
    private BaseColumnConfig[] columns;
    ColumnModel columnModel;
 public KMenu padre;

    public IngresoTiendaMarca(KMenu kmenu) {
        padre=kmenu;

        this.setClosable(true);
        this.setId("TPfun5017");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Lista de Ingresos ");
        onModuleLoad();
    }

    public void onModuleLoad() {

        DataProxy dataProxy = new ScriptTagProxy("php/IngresoAlmacen.php?funcion=ListarIngresosAlmacenExtra");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idingreso"),
                    new StringFieldDef("boleta"),
                    new StringFieldDef("marca"),
                    new StringFieldDef("almacen"),
                    new StringFieldDef("fecha"),
                    new StringFieldDef("hora"),
                     new StringFieldDef("totalcajas"),
                    new StringFieldDef("totalpares"),
                     new StringFieldDef("totalbs"),
                    new StringFieldDef("responsable"),
                    new StringFieldDef("idalmacen"),
                             new StringFieldDef("idmarca")

                });
        JsonReader reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");

        store = new Store(dataProxy, reader, true);

        /* columnade idusuario  */
        idColumn = new ColumnConfig("Idingreso", "idingreso", 300, true);
        idColumn.setId("expandible");
        /* columnade nombre  */
        codigoColumn = new ColumnConfig("Boleta", "boleta", 50, true);
        marcaColumn = new ColumnConfig("Marca", "marca", 130, true);
        tiendaColumn = new ColumnConfig("Almacen", "almacen", 90, true);
          fechaColumn = new ColumnConfig("Fecha", "fecha", 100, true);
        horaColumn = new ColumnConfig("Hora", "hora", 100, true);
         totalcajasColumn = new ColumnConfig("Total Cajas", "totalcajas", 100, true);
        totalparesColumn = new ColumnConfig("Total Pares", "totalpares", 100, true);
         totalsusColumn = new ColumnConfig("Total Sus", "totalbs", 110, true);
        responsableColumn = new ColumnConfig("Responsable", "responsable", 120, true);
responsableColumn.setId("expandible");
      

           
        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    marcaColumn,
                    tiendaColumn,
                      fechaColumn,
                     horaColumn,
                  totalcajasColumn,
                  totalparesColumn,
                   totalsusColumn,
                    responsableColumn
                    //        descripcionColumn, //                    proveedorColumn,
                   
                };
        columnModel = new ColumnModel(columns);
        grid = new EditorGridPanel();


        grid.setId("grid-lista-Ingresos-Tienda");

        grid.setWidth(ANCHO);

        grid.setHeight(ALTO);

        grid.setTitle("Lista de Ingresos ");



        grid.setStore(store);

        grid.setColumnModel(columnModel);

        grid.setTrackMouseOver(true);

        grid.setAutoExpandColumn("expandible");

        grid.setLoadMask(true);

        grid.setSelectionModel(cbSelectionModel);

        grid.setFrame(true);

        grid.setStripeRows(true);

        grid.setIconCls("grid-icon");

        grid.addGridRowListener(new GridRowListenerAdapter() {

            @Override
            public void onRowDblClick(GridPanel grid, int rowIndex, EventObject e) {
//                Window.alert("En contruccion: aqui saldra la informacion del rol en detalle");
                Record[] records = cbSelectionModel.getSelections();


                selecionado = records[0].getAsString("idlinea");
                String enlTemp = "funcion=reportelineaHTML&idlinea=" + selecionado;
                verReporte(enlTemp);
//                    Window.alert(enlTemp);
            }
        });

//        grid.a


//        nuevoLinea = new ToolbarButton("Nuevo");
//
//        nuevoLinea.setEnableToggle(true);
//        QuickTipsConfig tipsConfig1 = new QuickTipsConfig();
//
//        tipsConfig1.setText("Crear nueva linea");
//
//        nuevoLinea.setTooltip(tipsConfig1);
        anularIngreso = new ToolbarButton("Anular Ingreso");

        anularIngreso.setEnableToggle(true);
        QuickTipsConfig tipsConfig = new QuickTipsConfig();

        tipsConfig.setText("Anular Ingresos");

        anularIngreso.setTooltip(tipsConfig);

        eliminarModelo = new ToolbarButton("Ver Pares Ingreso");

        eliminarModelo.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();

        tipsConfig2.setText("Detalle ingreso(s)");

        eliminarModelo.setTooltip(tipsConfig2);

        CodigoBarra = new ToolbarButton("Impresion Codigo Barra");
     CodigoBarra.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Generar Codigo de barra de un ingreso");
        CodigoBarra.setTooltip(tipsConfig3);
        CodigoBarracaja = new ToolbarButton("Codigo Barra Caja");
     CodigoBarracaja.setEnableToggle(true);
        QuickTipsConfig tipsConfig33 = new QuickTipsConfig();
        tipsConfig33.setText("Generar Codigo de barra de un ingreso");
        CodigoBarracaja.setTooltip(tipsConfig33);

 verdetalle = new ToolbarButton("Ver/Editar Detalle");
     verdetalle.setEnableToggle(true);
        QuickTipsConfig tipsConfig31 = new QuickTipsConfig();
        tipsConfig31.setText("Ver detalle ingreso");
        verdetalle.setTooltip(tipsConfig31);
        PagingToolbar pagingToolbar = new PagingToolbar(store);

        pagingToolbar.setPageSize(100);

        pagingToolbar.setDisplayInfo(true);

        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");

        pagingToolbar.setEmptyMsg("No topics to display");

//        pagingToolbar.addSeparator();
//
//        pagingToolbar.addButton(nuevoLinea);

        pagingToolbar.addSeparator();

        pagingToolbar.addButton(anularIngreso);

        pagingToolbar.addSeparator();

        pagingToolbar.addButton(eliminarModelo);
 pagingToolbar.addSeparator();

        pagingToolbar.addButton(verdetalle);
        pagingToolbar.addSeparator();

        pagingToolbar.addButton(CodigoBarra);
          pagingToolbar.addSeparator();

        pagingToolbar.addButton(CodigoBarracaja);

        String items[] = {"Proforma", "Fecha", "Almacen", "Marca"};
        buscadorToolBar = new BuscadorToolBar(items);
        grid.setTopToolbar(buscadorToolBar.getToolbar());
        grid.setBottomToolbar(pagingToolbar);
        buscar = buscadorToolBar.getBuscar();
//
        addListenersBuscador();

        addListenersBuscadoresText();
        grid.setBottomToolbar(pagingToolbar);

        add(grid);
        //panel.add(grid);

        aniadirListenersMarcas();

    //RootPanel.get().add(panel);
    }

    public GridPanel getGrid() {
        return grid;
    }

    public void setGrid(GridPanel grid) {
        this.grid = grid;
    }

    private void addListenersBuscadoresText() {

        //*********************************************************************
        //***************BUSCADOR ID************************************
        //*********************************************************************
        buscadorToolBar.getItemsText1().addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

        //*********************************************************************
        //***************BUSCADOR DE NOMBRE************************************
        //*********************************************************************
        buscadorToolBar.getItemsText2().addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

        //*********************************************************************
        //***************BUSCADOR DE TIPO************************************
        //*********************************************************************
        buscadorToolBar.getItemsText3().addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

        buscadorToolBar.getItemsText4().addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

    }

    public void aniadirListenersBuscador() {

        buscar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Utils.setErrorPrincipal("Se realizo la busqueda", "mensaje");
                buscarSegunParametros();
            }
        });
    }

    public void reload() {
        store.reload();
        grid.reconfigure(store, columnModel);
        grid.getView().refresh();
    }

    private void addListenersBuscador() {
        buscar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                buscarSegunParametros();
            }
        });
    }

    public void buscarSegunParametros() {
        buscarModelo = buscadorToolBar.getItemsText1().getText();
        buscarColeccion = buscadorToolBar.getItemsText2().getText();
        buscarLinea = buscadorToolBar.getItemsText3().getText();
        buscarMarca = buscadorToolBar.getItemsText4().getText();
        store.reload(new UrlParam[]{
                    new UrlParam("start", 0), new UrlParam("limit", 100),
                    new UrlParam("buscarcodigo", buscarModelo),
                    new UrlParam("buscarfecha", buscarColeccion),
                    new UrlParam("buscartienda", buscarLinea),
                    new UrlParam("buscarmarca",buscarMarca ),}, false);
    }

    private void cargarDatosEditarMarca(String idmodelo) {
        String enlace = "php/Modelo.php?funcion=BuscarLineaColeccionMarcaPorId&idmodelo=" + idmodelo;
        Utils.setErrorPrincipal("Cargando parametros del modelo", "cargar");
        final Conector conec = new Conector(enlace, false);
        {

            try {
                conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                    public void onResponseReceived(Request request, Response response) {
                        String data = response.getText();
                        JSONValue jsonValue = JSONParser.parse(data);
                        JSONObject jsonObject;

                        if ((jsonObject = jsonValue.isObject()) != null) {
                            String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                            String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                            if (errorR.equalsIgnoreCase("true")) {
                                Utils.setErrorPrincipal(mensajeR, "mensaje");

                                JSONValue marcaV = jsonObject.get("resultado");
                                JSONObject marcaO;

                                if ((marcaO = marcaV.isObject()) != null) {
//                                    Object[][] estilos = Utils.getArrayOfJSONObject(marcaO, "estiloM", new String[]{"idestilo", "nombre"});
                                    Object[][] lineas = Utils.getArrayOfJSONObject(marcaO, "lineaM", new String[]{"idlinea", "codigo"});
                                    Object[][] colecciones = Utils.getArrayOfJSONObject(marcaO, "coleccionM", new String[]{"idcoleccion", "codigo"});
                                    String idmodelo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
                                    String stylename = Utils.getStringOfJSONObject(marcaO, "stylename");
                                    String idcoleccion = Utils.getStringOfJSONObject(marcaO, "idcoleccion");
                                    String idlinea = Utils.getStringOfJSONObject(marcaO, "idlinea");
                                    String marca = Utils.getStringOfJSONObject(marcaO, "marca");
                                    String detalle = Utils.getStringOfJSONObject(marcaO, "detalle");

                                    String imagen = Utils.getStringOfJSONObject(marcaO, "imagen");
//                                    String codigobarra = Utils.getStringOfJSONObject(marcaO, "codigobarra");
//                                    formulario = null;
//                                    formulario = new EditarModeloForm(idmodelo, idmarca, marca, idlinea, idcoleccion, stylename,detalle,imagen, lineas, colecciones, IngresoTienda.this);
//                                    formulario.show();
                                } else {
                                    MessageBox.alert("No Hay datos en la consulta");
                                }

                            }
                        } else {
                        }
                        throw new UnsupportedOperationException("Not supported yet.");
                    }

                    public void onError(Request request, Throwable exception) {
                        throw new UnsupportedOperationException("Not supported yet.");
                    }
                });

            } catch (RequestException e) {
                e.getMessage();
                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
            }

        }
    }

    private void aniadirListenersMarcas() {
        //**************************************************
        //***********ELIMINAR ROL
        //**************************************************

        anularIngreso.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idingreso");
                    MessageBox.confirm("Anular Ingreso", "Realmente desea anular el registroo??", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                //eliminar
                                String enlace = "php/IngresoAlmacen.php?funcion=AnularIngreso&idingreso=" + selecionado;
                                //String enlace = "php/Modelo.php?funcion=EliminarModelo&idmodelo=" + selecionado;

                                Utils.setErrorPrincipal("Anulando el registro", "cargar");
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
                                    });
                                } catch (RequestException ex) {
                                    //Window.alert("Ocurrio un error al conectar con el servidor");
                                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                                }
                            }
                        }
                    });
                } else {
                    MessageBox.alert("No hay ingreso para anular y/o selecciono mas de uno.");
                }
                anularIngreso.setPressed(false);
            }
        });
    eliminarModelo.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();

                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idingreso");
                       //     String enlTemp = "generarcodigobarra.jsp?idingreso=" + selecionado;
                       String enlTemp = "funcion=Listaparesingreso&idingreso=" + selecionado;

                       verReporte(enlTemp);

                        } else {
                            MessageBox.alert("No hay Ingreso para ver detalle.");
                        }

                        eliminarModelo.setPressed(false);
                    }
                });



        CodigoBarra.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();

                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idingreso");
                       //     String enlTemp = "generarcodigobarra.jsp?idingreso=" + selecionado;
                                String enlTemp = "funcion=AdicionCodigoBarraIngresoHTMLNike&idingreso=" + selecionado;

                            verReporte(enlTemp);

                        } else {
                            MessageBox.alert("No hay Ingreso para generar codigo de barra.");
                        }

                        CodigoBarra.setPressed(false);
                    }
                });
 CodigoBarracaja.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();

                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idingreso");
                       //     String enlTemp = "generarcodigobarra.jsp?idingreso=" + selecionado;
              //                  String enlTemp = "funcion=AdicionCodigoBarraIngresoHTMLNike&idingreso=" + selecionado;
  String enlTemp = "funcion=CodigoBarraIngresoAlmacenHTML&idingreso=" + selecionado;

                            verReporte(enlTemp);

                        } else {
                            MessageBox.alert("No hay Ingreso para generar codigo de barra.");
                        }

                        CodigoBarracaja.setPressed(false);
                    }
                });
    verdetalle.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();

                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idingreso");
                            selecionado1 = records[0].getAsString("idalmacen");
                              selecionado2 = records[0].getAsString("idmarca");

                        cargarDatosPanelColeccion(selecionado2,selecionado1,selecionado);

                        } else {
                            MessageBox.alert("No hay Ingreso para generar codigo de barra.");
                        }

                        verdetalle.setPressed(false);
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

      private void cargarDatosPanelColeccion(final String idmarca,final String idalmacen,String ingreso) {
         final String idkardex="kar-0";
   String enlace = "php/IngresoAlmacen.php?funcion=CargarInventarioActual&idmarca=" + idmarca+"&idalmacen="+idalmacen+ "&idkardex="+idkardex;
   Utils.setErrorPrincipal("Cargando parametros", "cargar");
                        final Conector conec = new Conector(enlace, false);
                        {
                            try {
                                conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                                    private EventObject e;

                                    public void onResponseReceived(Request request, Response response) {
                                        String data = response.getText();
                                        JSONValue jsonValue = JSONParser.parse(data);
                                        JSONObject jsonObject;
                                        if ((jsonObject = jsonValue.isObject()) != null) {
                                            String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                            String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                            if (errorR.equalsIgnoreCase("true")) {
                                                Utils.setErrorPrincipal(mensajeR, "mensaje");

                                                JSONValue marcaV = jsonObject.get("resultado");
                                                JSONObject marcaO;
                                                if ((marcaO = marcaV.isObject()) != null) {
                                                    String marca = Utils.getStringOfJSONObject(marcaO, "marca");
   Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
  Object[][] vendedorM = Utils.getArrayOfJSONObject(marcaO, "empleadoM", new String[]{"idempleado", "codigo"});

   String opcion = Utils.getStringOfJSONObject(marcaO, "opcionb");
                                                       String formatomayor = Utils.getStringOfJSONObject(marcaO, "formatomayor");
   String totalpares = Utils.getStringOfJSONObject(marcaO, "totalpares");
   String totalbs = Utils.getStringOfJSONObject(marcaO, "totalsus");
   String totalcajas = Utils.getStringOfJSONObject(marcaO, "totalcajas");
 String responsable = Utils.getStringOfJSONObject(marcaO, "responsable");
 String almacen = Utils.getStringOfJSONObject(marcaO, "almacen");

String mesrango = Utils.getStringOfJSONObject(marcaO, "mesrango");
if(idmarca=="mar-3"){
PanelInventarioM pan_compraDirecta = new PanelInventarioM(idkardex,mesrango,idmarca, marca,opcion,formatomayor, colores,vendedorM,totalcajas,totalpares,totalbs,responsable, almacen,idalmacen,IngresoTiendaMarca.this,padre);
  padre.seleccionarOpcion(null, "fun50291", e, pan_compraDirecta);
}else{
     //PanelPedidoConfirmado pan_compraDirecta = new PanelPedidoConfirmado(Pedido.this, idpedido1,idmarca,fecha,observacion,totalcajas,totalpares,nombre,numeropedido);
PanelInventario pan_compraDirecta = new PanelInventario(idkardex,mesrango,idmarca, marca,opcion,formatomayor, colores,vendedorM,totalcajas,totalpares,totalbs,responsable, almacen,idalmacen,IngresoTiendaMarca.this,padre);
  padre.seleccionarOpcion(null, "fun5029", e, pan_compraDirecta);
}

  //SeleccionMarcaEstiloInventario.this.clear();
    //                                SeleccionMarcaEstiloInventario.this.close();

                                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + opcion, "mensaje");
                                                } else {
                                                    MessageBox.alert("No Hay datos en la consulta");
                                                }
                                            }
                                            else{
                                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                                            }
                                        } else {
                                        }
                                        throw new UnsupportedOperationException("Not supported yet.");
                                    }

                                    public void onError(Request request, Throwable exception) {
                                        throw new UnsupportedOperationException("Not supported yet.");
                                    }
                                });

                            } catch (RequestException ea) {
                                ea.getMessage();
                                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
                            }

                        }
    }

    private void verReporte(String enlace) {
       ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);

  //      ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace,"PDF");
        print.show();
    }
}

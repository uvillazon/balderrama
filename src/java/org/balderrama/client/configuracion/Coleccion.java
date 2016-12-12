/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.configuracion;

import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.google.gwt.user.client.ui.KeyboardListenerAdapter;
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
import com.gwtext.client.widgets.QuickTipsConfig;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.event.PanelListenerAdapter;
import com.gwtext.client.widgets.grid.event.GridCellListenerAdapter;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.Ext;
import com.gwtext.client.widgets.form.Field;
//import org.balderrama.client.pedido.Pedido;
//import org.balderrama.client.sistemadetalle.MarcaDetalle;
import org.balderrama.client.util.Conector;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.widgets.form.Checkbox;
import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
import com.gwtext.client.core.UrlParam;
import com.gwtext.client.widgets.Toolbar;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.data.Store;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.grid.*;
import org.balderrama.client.marca.Marca;

/**
 *
 * @author buggy
 */
public class Coleccion extends Panel {

    private GridPanel grid;
    private ColumnConfig idColumn;
    private ColumnConfig codigoColumn;
    private ColumnConfig anioColumn;
    private ColumnConfig detalleColumn;
//    private ColumnConfig nombreColumn;
    private ColumnConfig marcaColumn;
    private ColumnConfig estadoColumn;
    private ColumnConfig codigobarraColumn;
    private final int ANCHO = Utils.getScreenWidth() - 24;
    private final int ALTO = Utils.getScreenHeight() - 270;
//control de precios
      private LineaNuevaMarcaColeccion formulario1;

    private ControlPreciosForm controlP;
    private ToolbarButton editarColeccion;
    private ToolbarButton eliminarColeccion;
    private ToolbarButton nuevaColeccion;
//    private ToolbarButton reporteColeccion;
    private ToolbarButton verlinea;
    private ToolbarButton detalleColeccion;
//    private ToolbarButton codmaterialMarca;
//    private ToolbarButton configurarMarca;
//    private ToolbarButton cargarimagenMarca;
//  control de precios
    private ToolbarButton controlPrecios;
    private NuevaColeccionForm formulario;
//    private ConfigurarMarcaForm formulario1;
    protected ExtElement ext_element;
    private Button NuevoButton;
    CheckboxSelectionModel cbSelectionModel;
    Store store;
    private String selecionado;
    private BaseColumnConfig[] columns;
    ColumnModel columnModel;
    public CodificarPrecioForm precioForm;
    //variables para buscador
    PagingToolbar pagingToolbar1124;
    String selecionado1124 = "";
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
 private String[] clienteM;
   private ComboBox com_cliente;
  //  private MarcaDetalle padre1;
    public Coleccion() {
        this.setClosable(true);
        this.setId("TPfun1500");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Colecciones");
        onModuleLoad();
    }

    public Coleccion(Marca mar, String idmarca, String nombre) {
        this.setClosable(true);
        this.setId("TPfun1500" + idmarca);
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Colecciones");
        this.idmarca = idmarca;
        this.nombrem = nombre;
        this.clienteM = new String[]{"2006", "2007","2008","2009","2010","2011"};

        onModuleLoad();

    }
 

    public void onModuleLoad() {



        DataProxy dataProxy = new ScriptTagProxy("php/Coleccion.php?funcion=ListarColecciones&buscarmarca=" + idmarca + "&sort=estado&dir=DESC");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idcoleccion"),
                    new StringFieldDef("codigo"),
                    new StringFieldDef("marca"),
                    new StringFieldDef("anio"),
                    new StringFieldDef("codigobarra"),
                    new StringFieldDef("detalle"),
                    new StringFieldDef("estado")
                });
        JsonReader reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");

        store = new Store(dataProxy, reader, true);

        /* columnade idusuario  */
        idColumn = new ColumnConfig("Id Coleccion", "idcoleccion", 200, true);
//        idColumn.setId("expandible");
        /* columnade nombre  */
        codigoColumn = new ColumnConfig("Codigo", "codigo", 200, true);
        codigoColumn.setId("expandible");
        marcaColumn = new ColumnConfig("Marca", "marca", 200, true);
        anioColumn = new ColumnConfig("Anio", "anio", 200, true);
        codigobarraColumn = new ColumnConfig("Codigo Barra", "codigobarra", 200, true);
        detalleColumn = new ColumnConfig("Detalle", "detalle", 200, true);
        estadoColumn = new ColumnConfig("Estado", "estado", 200, true);



//        direccionColumn=new ColumnConfig("Direccion","direccion",(ANCHO/6) - 50 , true);
//        direccionColumn = new ColumnConfig("Imagen", "imagen", (ANCHO / 6) - 50, true, new Renderer() {
//
//            public String render(Object value, CellMetadata cellMetadata,
//                    Record record, int rowIndex, int colNum, Store store) {
//                return Format.format("<img src=\"images/jpg.php?name=../{0}&size=100\">",
//                        new String[]{record.getAsString("imagen")});
//            }
//        }, "imagen");

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    //column ID is company which is later used in setAutoExpandColumn
                    //                    idColumn,
                    codigoColumn,
                    marcaColumn,
                    anioColumn,
                    codigobarraColumn,
                    detalleColumn,
                    estadoColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-Coleccion" + idmarca);
        grid.setWidth(ANCHO);
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Coleccion Marca " + nombrem);
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


                selecionado = records[0].getAsString("idcoleccion");
                String enlTemp = "funcion=reporteClienteHTML&idcliente=" + selecionado;
                verReporte(enlTemp);
//                    Window.alert(enlTemp);
            }
        });

//        grid.a


        nuevaColeccion = new ToolbarButton("Nuevo");
        nuevaColeccion.setEnableToggle(true);
        QuickTipsConfig tipsConfig1 = new QuickTipsConfig();
        tipsConfig1.setText("Crear Coleccion");
        nuevaColeccion.setTooltip(tipsConfig1);

        editarColeccion = new ToolbarButton("Editar");
        editarColeccion.setEnableToggle(true);
        QuickTipsConfig tipsConfig = new QuickTipsConfig();
        tipsConfig.setText("Editar Coleccion");
        editarColeccion.setTooltip(tipsConfig);

        eliminarColeccion = new ToolbarButton("Eliminar");
        eliminarColeccion.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Eliminar Coleccion");
        eliminarColeccion.setTooltip(tipsConfig2);

//        reporteColeccion = new ToolbarButton("Reporte");
//        reporteColeccion.setEnableToggle(true);
//        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
//        tipsConfig3.setText("Reporte Coleccion");
//        reporteColeccion.setTooltip(tipsConfig3);


        verlinea = new ToolbarButton("Lineas");
        verlinea.setEnableToggle(true);
        QuickTipsConfig tipsConfig4 = new QuickTipsConfig();
        tipsConfig4.setText("Mostrar lineas de Coleccion");
        verlinea.setTooltip(tipsConfig4);
//      control de precios
        controlPrecios = new ToolbarButton("Control de Precios");
        controlPrecios.setEnableToggle(true);
        QuickTipsConfig tipsConfig40 = new QuickTipsConfig();
        tipsConfig40.setText("Ver control de Precios");
        controlPrecios.setTooltip(tipsConfig40);


        detalleColeccion = new ToolbarButton("Detalle Coleccion");
        detalleColeccion.setEnableToggle(true);
        QuickTipsConfig tipsConfig50 = new QuickTipsConfig();
        tipsConfig40.setText("Detalle Coleccion");
        detalleColeccion.setTooltip(tipsConfig50);

        PagingToolbar pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(nuevaColeccion);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(editarColeccion);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarColeccion);
        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(reporteColeccion);
//        pagingToolbar.addSeparator();
        pagingToolbar.addButton(verlinea);
        pagingToolbar.addSeparator();
//buscador
        too_busquedaCBWW = new Toolbar();
        tex_marca = new TextField("Marca", "marca");
        com_cliente = new ComboBox("Anio", "anio");
        too_buscarCBWW = new ToolbarButton("Buscar");
        too_buscarCBWW.setPressed(true);
        too_busquedaCBWW.addText("Anio:");
 too_busquedaCBWW.addField(com_cliente);
        too_busquedaCBWW.addButton(too_buscarCBWW);
        grid.setTopToolbar(too_busquedaCBWW);
   grid.setBottomToolbar(pagingToolbar);
     
        add(grid);
          recuperarAlmacenes();
        //panel.add(grid);
        aniadirListenersCliente();
        aniadirListeners();
        aniadirListenersBuscador();
        aniadirListenersBuscadoresText();

    //RootPanel.get().add(panel);
    }

    public GridPanel getGrid() {
        return grid;
    }

    public void setGrid(GridPanel grid) {
        this.grid = grid;
    }

    public void reload() {
        store.reload();
        grid.reconfigure(store, columnModel);
        grid.getView().refresh();
    }
  private void recuperarAlmacenes() {
       // SimpleStore tiposStore = new SimpleStore("anio", clienteM);
       // tiposStore.load();
        com_cliente.setDisplayField("anio");
        com_cliente.setValueField("anio");
        com_cliente.setForceSelection(true);
        com_cliente.setMinChars(1);
        com_cliente.setMode(ComboBox.LOCAL);
        com_cliente.setFieldLabel("anio");
      //  com_cliente.setStore(tiposStore);

        com_cliente.setEmptyText("Seleccione un Anio");
        com_cliente.setLoadingText("Buscando");
        com_cliente.setTypeAhead(true);
        com_cliente.setSelectOnFocus(true);
        com_cliente.setHideTrigger(true);
       // com_anio.setReadOnly(true);
        SimpleStore proveedorStore = new SimpleStore("anio", clienteM);
        proveedorStore.load();
        com_cliente.setStore(proveedorStore);


    }
    private void CargarNuevaColeccion() {
        //String enlace = "php/Coleccion.php?funcion=BuscarAlmacenTipo";
        String enlace = "php/Coleccion.php?funcion=BuscarMarcaAnio";
        Utils.setErrorPrincipal("Cargando parametros de Nueva Coleccion", "cargar");
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
                                JSONValue marcasV = jsonObject.get("resultado");
                                JSONObject marcasO;
                                if ((marcasO = marcasV.isObject()) != null) {
                                    Object[][] marca = Utils.getArrayOfJSONObject(marcasO, "marcaM", new String[]{"idmarca", "nombre"});
                                    Object[][] anio = Utils.getArrayOfJSONObject(marcasO, "anioM", new String[]{"anio", "anio"});
                                    formulario = null;
//                                    (String idcliente, String nombre, String codigo, String tipo, String almacen, String telefono, String fax, String estado, String direccion,  Object[][] almacenes, Coleccion padre)
                                    formulario = new NuevaColeccionForm(null, "", "", idmarca, "", marca, anio, "",Coleccion.this);
                                    formulario.show();
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

    private void cargarDatosEditarColeccion(String idcoleccion) {
        String enlace = "php/Coleccion.php?funcion=BuscarMarcaAnioPorId&idcoleccion=" + idcoleccion;
        Utils.setErrorPrincipal("Cargando parametros de Coleccion", "cargar");
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
                                    //Object[][] almacenes = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{ "anio"});
                                    Object[][] marcas = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                    Object[][] anios = Utils.getArrayOfJSONObject(marcaO, "anioM", new String[]{"anio", "anio"});
//                                    Object[][] tipos = Utils.getArrayOfJSONObject(marcaO, "tipoM", new String[]{"idtipocliente", "nombre"});
                                    String idcoleccion = Utils.getStringOfJSONObject(marcaO, "idcoleccion");
                                    String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
                                    String anio = Utils.getStringOfJSONObject(marcaO, "anio");
                                    String codigobarra = Utils.getStringOfJSONObject(marcaO, "codigobarra");
//                                    String tipo = Utils.getStringOfJSONObject(marcaO, "idtipocliente");
//                                    String almacen = Utils.getStringOfJSONObject(marcaO, "idalmacen");
                                    String detalle = Utils.getStringOfJSONObject(marcaO, "detalle");
                                    String estado = Utils.getStringOfJSONObject(marcaO, "estado");

//                                    String estado = Utils.getStringOfJSONObject(marcaO, "estado");
//                                    String fax = Utils.getStringOfJSONObject(marcaO, "fax");
//                                    String  = Utils.getStringOfJSONObject(marcaO, "estado");
//                                    formulario = null;
                                    formulario = new NuevaColeccionForm(idcoleccion, codigo, detalle, idmarca, anio, marcas, anios, estado,Coleccion.this);
                                    formulario.show();
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

//
    private void aniadirListeners() {
        //**************************************************
        //***********ELIMINAR ROL
        //**************************************************

        KeyboardListenerAdapter listener = new KeyboardListenerAdapter();
        

    }

            private void aniadirListenersCliente() {
                //**************************************************
                //***********ELIMINAR ROL
                //**************************************************

                eliminarColeccion.addListener(new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idcoleccion");
                            MessageBox.confirm("Eliminar Coleccion", "Realmente desea eliminar esta Coleccion??", new MessageBox.ConfirmCallback() {

                                public void execute(String btnID) {
                                    if (btnID.equalsIgnoreCase("yes")) {
                                        //eliminar
                                        String enlace = "php/Coleccion.php?funcion=EliminarColeccion&idcoleccion=" + selecionado;
                                        Utils.setErrorPrincipal("Eliminando la Coleccion", "cargar");
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
                            MessageBox.alert("No hay Coleccion selecionado para la Eliminacion  y/o selecciono mas de uno.");
                        }
                        eliminarColeccion.setPressed(false);
                    }
                });
                //**************************************************
                //***********NUEVA MARCA
                //**
                nuevaColeccion.addListener(new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        CargarNuevaColeccion();
                    }
                });
//        NuevoButton.addListener(new ButtonListenerAdapter() {
//
//            @Override
//            public void onClick(Button button, EventObject e) {
//                CargarNuevaColeccion();
//            }
//        });

                //**************************************************
                //***********EDITAR ROL
                //**************************************************
                editarColeccion.addListener(
                        new ButtonListenerAdapter() {

                            @Override
                            public void onClick(Button button, EventObject e) {
                                Record[] records = cbSelectionModel.getSelections();
                                if (records.length == 1) {
                                    String idcoleccion = records[0].getAsString("idcoleccion");
                                    cargarDatosEditarColeccion(idcoleccion);
                                } else {

                                    Utils.setErrorPrincipal("Por favor seleccione una Coleccion para editar", "error");
                                }

                            }
                        });

                verlinea.addListener(
                        new ButtonListenerAdapter() {

                            @Override
                            public void onClick(Button button, EventObject e) {
                                Record[] records = cbSelectionModel.getSelections();

                                if (records.length == 1) {
                                    selecionado = records[0].getAsString("idcoleccion");
//MessageBox.alert("Menu codificador");
                                   // CargarDatosCodificarPrecio(selecionado);
                                     CargarDatosLineaNueva(selecionado);


                                } else {
                                    MessageBox.alert("Seleccione Una Coleccion");
                                }

                                verlinea.setPressed(false);
                            }
                        });
                controlPrecios.addListener(
                        new ButtonListenerAdapter() {

                            @Override
                            public void onClick(Button button, EventObject e) {
                                ext_element = Ext.get("grid-lista-productos");

                                Record[] records = cbSelectionModel.getSelections();

                                if (records.length == 1) {
                                    selecionado = records[0].getAsString("idcoleccion");
                                    cargarControlPrecios();
//                            if (formularioProducto == null || formularioProducto.isHidden()) {
//                                cargarControlPrecios();
//                            //createFormularioProducto( selecionado);
//                            } else {
//                                cargarControlPrecios.onFocus();
//                            //MessageBox.alert("no es nulo");
//                            }
//
                                } else {
//                            if (formularioProducto == null || formularioProducto.isHidden()) {
                                    MessageBox.alert("Seleccione solamente un producto.");
//                            //createFormularioProducto( selecionado);
//                            } else {
//                                formularioProducto.onFocus();
//                            //MessageBox.alert("no es nulo");
//                            }
                                }
                                controlPrecios.setPressed(false);
                            // cargarControlPrecios();
                            }
                        });



                detalleColeccion.addListener(
                        new ButtonListenerAdapter() {

                            @Override
                            public void onClick(Button button, EventObject e) {
                                Record[] records = cbSelectionModel.getSelections();

                                if (records.length == 1) {
                                    selecionado = records[0].getAsString("idcoleccion");
                                    String enlTemp = "funcion=detalleColeccionHTML&idcoleccion=" + selecionado;
                                    verReporte(enlTemp);

                                } else {
                                    MessageBox.alert("No hay coleccion selecionado para ver el reporte.");
                                }

                                detalleColeccion.setPressed(false);
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

            public String getLinksaveUpdate(String idrol, String nombre, String estado, Object[] seleccionados) {
                String dev = "";
                if (seleccionados.length >= 1) {

                    if (idrol == null) {
                        idrol = "nuevo";
                    }
                    JSONObject todos = new JSONObject();
                    todos.put("idrol", new JSONString(idrol));
                    todos.put("nombre", new JSONString(nombre));
                    todos.put("estado", new JSONString(estado));
                    JSONArray funcS = new JSONArray();
                    for (int i = 0; i < seleccionados.length; i++) {
                        Checkbox che = (Checkbox) seleccionados[i];
                        funcS.set(i, new JSONString(che.getId().substring(1)));
                    }
                    todos.put("funciones", funcS);
                    dev = todos.toString();
                } else {
                    Utils.setErrorPrincipal("Por favor seleccione por lo menos una funacion", "error");
                }
                return dev;
            }


               private void CargarDatosLineaNueva(final String idcoleccion) {
                //   String enlace = "php/Linea.php?funcion=BuscarMarcaColeccionEstilo";
String enlace = "php/Linea.php?funcion=BuscarMarcaColeccionEstilo";

     //   String enlace = "php/Linea.php?funcion=BuscarEstiloMarcaColeccionPorColeccion&idcoleccion=" + idcoleccion;
        Utils.setErrorPrincipal("Cargando parametros de linea", "cargar");
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

                                JSONValue lineaV = jsonObject.get("resultado");
                                JSONObject lineaO;
                                if ((lineaO = lineaV.isObject()) != null) {
                                    Object[][] colecciones = Utils.getArrayOfJSONObject(lineaO, "coleccionM", new String[]{"idcoleccion", "codigo", "idmarca"});
                                    Object[][] estilos = Utils.getArrayOfJSONObject(lineaO, "estiloM", new String[]{"idestilo", "nombre","idmarca"});
                                    Object[][] marcas = Utils.getArrayOfJSONObject(lineaO, "marcaM", new String[]{"idmarca", "nombre"});

                                    formulario1 = null;
                                    formulario1 = new LineaNuevaMarcaColeccion(null, idmarca, idcoleccion, "", marcas, colecciones, estilos, "", "", Coleccion.this);
                                    formulario1.show();
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

            private void CargarDatosCodificarPrecio(final String idcoleccion) {



                String enlace = "php/Coleccion.php?funcion=BuscarModeloPorIdColeccion&idcoleccion=" + idcoleccion;
                Utils.setErrorPrincipal("Cargando datos para Codificar el precio de la Coleccion", "cargar");
                final Conector conec = new Conector(enlace, false);
                try {
                    conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;

                            if ((jsonObject = jsonValue.isObject()) != null) {
                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                Object[][] datsPro = Utils.getArrayOfJSONObject(jsonObject, "resultado", new String[]{"idmodelo", "codigo", "precio1", "precio2"});
                                if (errorR.equalsIgnoreCase("true")) {
                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
                                    precioForm = null;
                                    precioForm = new CodificarPrecioForm(idcoleccion, datsPro, Coleccion.this);
                                    precioForm.show();
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }

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

//    public String getLinksaveUpdate(String idrol, String nombre, String estado, Object[] seleccionados) {
//        String dev = "";
//        if (seleccionados.length >= 1) {
//
//            if (idrol == null) {
//                idrol = "nuevo";
//            }
//            JSONObject todos = new JSONObject();
//            todos.put("idrol", new JSONString(idrol));
//            todos.put("nombre", new JSONString(nombre));
//            todos.put("estado", new JSONString(estado));
//            JSONArray funcS = new JSONArray();
//            for (int i = 0; i < seleccionados.length; i++) {
//                Checkbox che = (Checkbox) seleccionados[i];
//                funcS.set(i, new JSONString(che.getId().substring(1)));
//            }
//            todos.put("funciones", funcS);
//            dev = todos.toString();
//        } else {
//            Utils.setErrorPrincipal("Por favor seleccione por lo menos una funacion", "error");
//        }
//        return dev;
//    }
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

                com_cliente.addListener(new TextFieldListenerAdapter() {

                    @Override
                    public void onSpecialKey(Field field, EventObject e) {
                        if (e.getKey() == EventObject.ENTER) {
                            buscarSegunParametros();
                        //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 2");
                        }
                    }
                });

            //**************************************************
            //*********** BUSCADOR COLOR
            //**************************************************


            }

            public void buscarSegunParametros() {
                store.reload(new UrlParam[]{new UrlParam("start", 0), new UrlParam("limit", 100),
                            new UrlParam("buscaranio", com_cliente.getText())}, false);
            }

            private void verReporte(String enlace) {
                ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
                print.show();
            }

            private void cargarControlPrecios() {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length >= 1) {

                    Record[] recordss = cbSelectionModel.getSelections();
                    JSONArray funcS = new JSONArray();
                    for (int i = 0; i < recordss.length; i++) {
                        funcS.set(i, new JSONString(recordss[i].getAsString("idcoleccion")));
                    }
                    JSONObject joo = new JSONObject();
                    joo.put("resultado", funcS);
                    String enlace = "php/ListaPrecios.php?funcion=ListaPrecios&resultado=" + joo.toString();
                    Utils.setErrorPrincipal("Cargando datos control precios", "cargar");
                    final Conector conec = new Conector(enlace, false);
                    try {
                        conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                            public void onResponseReceived(Request request, Response response) {
                                String data = response.getText();
                                JSONValue jsonValue = JSONParser.parse(data);
                                JSONObject jsonObject;

                                if ((jsonObject = jsonValue.isObject()) != null) {
                                    String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                    String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                    String nuevoR = Utils.getStringOfJSONObject(jsonObject, "nuevo");
                                    Object[][] datsPro = Utils.getArrayOfJSONObject(jsonObject, "resultado", new String[]{"idcalzado", "modelo", "marca", "color", "material", "preciooficina", "preciomayor", "precio3"});
                                    if (errorR.equalsIgnoreCase("true")) {
                                        Utils.setErrorPrincipal(mensajeR, "mensaje");
                                        controlP = null;
                                        controlP = new ControlPreciosForm(datsPro, Coleccion.this, nuevoR);
                                        controlP.show();
                                    } else {
                                        Utils.setErrorPrincipal(mensajeR, "error");
                                    }

                                }
                            }

                            public void onError(Request request, Throwable exception) {
                                Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                            }
                        });
                    } catch (RequestException exp) {
                        Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                    }
                } else {
                    MessageBox.alert("No hay marca(s) selecionado(s) para mostrar");
                }
            }

            void buscarProductosSinKardex() {
                throw new UnsupportedOperationException("Not yet implemented");
            }

            void buscarProductos() {
                throw new UnsupportedOperationException("Not yet implemented");
            }
        }

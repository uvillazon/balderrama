/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.marca;

import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
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
import com.gwtext.client.data.Record;
import com.gwtext.client.data.Store;
import com.gwtext.client.util.Format;
import com.gwtext.client.widgets.TabPanel;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import org.balderrama.client.util.Conector;
import com.gwtext.client.widgets.grid.CellMetadata;
import com.gwtext.client.widgets.grid.Renderer;
import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;
//import org.balderrama.client.linea.EditarLineaForm;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
import org.balderrama.client.modelo.EditarModeloForm;
//import org.balderrama.client.pedido.PanelPedido;
import org.balderrama.client.configuracion.Coleccion;
//import org.balderrama.client.pedido.PanelPedido;
import org.balderrama.client.MainEntryPoint;
import org.balderrama.client.configuracion.ColorNuevoForm;
import org.balderrama.client.configuracion.ConfiguracionArticulos;
import org.balderrama.client.configuracion.ConfiguracionColor;
import org.balderrama.client.configuracion.Material;
import org.balderrama.client.util.ToolbarMenuSistema;
import org.balderrama.client.util.KMenu;
//import org.balderrama.client.configuracion.EditarEstiloForm;

/**
 *
 * @author buggy
 */
public class Marca extends Panel {

    private GridPanel grid;
    private ColumnConfig idColumn;
    private ColumnConfig codigoColumn;
    private ColumnConfig codigobarraColumn;
    private ColumnConfig nombreColumn;
    private ColumnConfig coleccionColumn;
    private ColumnConfig proveedorColumn;
    private ColumnConfig imagenColumn;
     private ColumnConfig ordenColumn;
    private ColumnConfig formatoColumn;
    private ColumnConfig opcionColumn;
    private ColumnConfig rangoColumn;
    private ColumnConfig detalleColumn;

    private final int ANCHO = Utils.getScreenWidth() - 24;
    private final int ALTO = Utils.getScreenHeight() - 270;
    private ToolbarButton editarMarca;
    private ToolbarButton eliminarMarca;
    private ToolbarButton nuevoMarca;
    private ToolbarButton reporteMarca;
    private ToolbarButton configurarMarca;
    private ToolbarButton configurarMaterial;
     private ToolbarButton configurarStylename;
    private ToolbarButton configurarColores;
    private ToolbarButton cargarimagenMarca;
    private ToolbarButton modeloMarca;
    //private ToolbarButton modeloEstilo;

    private ToolbarButton reporteProductos;
    private ToolbarButton pedidoCalzado;
    private ToolbarButton coleccionB;
    private EditarMarcaForm formulario;
    private ConfigurarMarcaForm formulario1;
    protected ExtElement ext_element;
    CheckboxSelectionModel cbSelectionModel;
    Store store;
    private String selecionado;
    private BaseColumnConfig[] columns;
    ColumnModel columnModel;
    public CodificarMaterialForm formularioM;
    public CodificarColorForm formularioC;
//    public EditarLineaForm formulario2;
    public EditarModeloForm formulario3;
    // public EditarEstiloForm formulario4;
//      private EditarEstiloForm formularioEstilo;

    public ColorNuevoForm formularioColor;
    //public PanelPedido pedido;
    public TabPanel tap_panel;
    public KMenu kmenu;
    public MainEntryPoint pan;
    public boolean flag = false;
    ToolbarMenuSistema toolbar;
    ConfiguracionArticulos configuracion;
    private EventObject e;

    public Marca(KMenu kmenu, MainEntryPoint panel) {

        this.kmenu = kmenu;
        this.pan = panel;
        this.setClosable(true);
        this.setId("TPfun1504");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Marcas Empresa");
        onModuleLoad();
    }

    public Marca() {
        this.setClosable(true);
        this.setId("TPfun1504");
        setIconCls("tab-icon");
        setAutoScroll(false);
       setTitle("Marcas Empresa");
        onModuleLoad();
    }

    public Marca(ConfiguracionArticulos forma) {


        configuracion = forma;
        this.setClosable(true);
        this.setId("TPfun1504");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Marcas Empresa");
        onModuleLoad();
    }

    public void onModuleLoad() {

        DataProxy dataProxy = new ScriptTagProxy("php/Marca.php?funcion=ListarMarcasPedido");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idmarca"),
                    new StringFieldDef("codigo"),
                     new StringFieldDef("codigobarra"),
                    new StringFieldDef("nombre"),
                    new StringFieldDef("coleccion"),
                    new StringFieldDef("origen"),
                    new StringFieldDef("numeroorden"),
                    new StringFieldDef("formatomayor"),
                    new StringFieldDef("opcionb"),
                    new StringFieldDef("talla"),
                    new StringFieldDef("pedido")
                });
        JsonReader reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");

        store = new Store(dataProxy, reader, true);

 //idColumn = new ColumnConfig("Id Kardex", nombreComlumns[0], 90, true);
        idColumn = new ColumnConfig("Id Marca", "idmarca", 100, true);

        /* columnade nombre  */
        nombreColumn = new ColumnConfig("Nombre", "nombre",160, true);
        nombreColumn.setId("expandible");
        codigoColumn = new ColumnConfig("Codigo", "codigo", 80, true);
        codigobarraColumn = new ColumnConfig("Codigo Barra", "codigobarra", 80, true);

        coleccionColumn = new ColumnConfig("Coleccion Vigente", "coleccion", 120, true);
        proveedorColumn = new ColumnConfig("Origen", "origen", 100, true);
        ordenColumn = new ColumnConfig("numeroorden", "numeroorden", 80, true);
          formatoColumn = new ColumnConfig("formatomayor", "formatomayor", 120, true);
            opcionColumn = new ColumnConfig("opcionb", "opcionb", 100, true);
            rangoColumn = new ColumnConfig("Rango", "talla", 120, true);
            detalleColumn = new ColumnConfig("Detalle", "pedido", 150, true);
//        imagenColumn = new ColumnConfig("Imagen", "imagen", (ANCHO / 6), true, new Renderer() {
//
//            public String render(Object value, CellMetadata cellMetadata,
//                    Record record, int rowIndex, int colNum, Store store) {
//                return Format.format("<img src=\"images/jpg.php?name={0}&size=100\">",
//                        new String[]{record.getAsString("imagen")});
//            }
//        }, "imagen");

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    //column ID is company which is later used in setAutoExpandColumn

                    codigoColumn,
                     codigobarraColumn,
                    nombreColumn,
                    coleccionColumn,
                    proveedorColumn,
                    ordenColumn,
                    formatoColumn,
                    opcionColumn,
                    rangoColumn,
                    detalleColumn

                    //imagenColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-marcas");
        grid.setWidth(ANCHO);
        grid.setHeight(ALTO);

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


                selecionado = records[0].getAsString("idmarca");
                String enlTemp = "funcion=reportemarcaHTML&idmarca=" + selecionado;
                verReporte(enlTemp);
//              
            }
        });

//        grid.a


        nuevoMarca = new ToolbarButton("Nuevo");
        nuevoMarca.setEnableToggle(true);
        QuickTipsConfig tipsConfig1 = new QuickTipsConfig();
        tipsConfig1.setText("Crear nuevo rol");
        nuevoMarca.setTooltip(tipsConfig1);

        editarMarca = new ToolbarButton("Editar");
        editarMarca.setEnableToggle(true);
        QuickTipsConfig tipsConfig = new QuickTipsConfig();
        tipsConfig.setText("Editar Marca");
        editarMarca.setTooltip(tipsConfig);

        eliminarMarca = new ToolbarButton("Eliminar");
        eliminarMarca.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Eliminar Marca");
        eliminarMarca.setTooltip(tipsConfig2);

        reporteMarca = new ToolbarButton("Reporte");
        reporteMarca.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Reporte Marca");
        reporteMarca.setTooltip(tipsConfig3);


        configurarMarca = new ToolbarButton("Configurar");
        configurarMarca.setEnableToggle(true);
        QuickTipsConfig tipsConfig7 = new QuickTipsConfig();
        tipsConfig7.setText("Confgurar Marca");
        configurarMarca.setTooltip(tipsConfig7);

        //configuraqr colores
        configurarColores = new ToolbarButton("+Color");
        configurarColores.setEnableToggle(true);
        QuickTipsConfig tipsConfig20 = new QuickTipsConfig();
        tipsConfig20.setText("Agragar color a una marca");
        configurarColores.setTooltip(tipsConfig20);
        //configurar material
        configurarMaterial = new ToolbarButton("+Material");
        configurarMaterial.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig21.setText("Agregar material a una marca");
        configurarMaterial.setTooltip(tipsConfig21);

        cargarimagenMarca = new ToolbarButton("Subir Imagen");
        cargarimagenMarca.setEnableToggle(true);
        QuickTipsConfig tipsConfig8 = new QuickTipsConfig();
        tipsConfig8.setText("Subir Imagen Marca");
        cargarimagenMarca.setTooltip(tipsConfig8);

        modeloMarca = new ToolbarButton("+Modelos");
        modeloMarca.setEnableToggle(true);
        QuickTipsConfig tipsConfig9 = new QuickTipsConfig();
        tipsConfig9.setText("Agregar Modelos a Marca");
        modeloMarca.setTooltip(tipsConfig9);
//         modeloEstilo = new ToolbarButton("+Estilos");
//        modeloEstilo.setEnableToggle(true);
//        QuickTipsConfig tipsConfig91 = new QuickTipsConfig();
//        tipsConfig91.setText("Agregar Estilos a Marca");
//        modeloEstilo.setTooltip(tipsConfig91);
configurarStylename = new ToolbarButton("+Stylename");
        configurarStylename.setEnableToggle(true);
        QuickTipsConfig tipsConfig211 = new QuickTipsConfig();
        tipsConfig211.setText("Agregar stylename para una marca");
        configurarStylename.setTooltip(tipsConfig211);


        reporteProductos = new ToolbarButton("Detalle Modelos");
        reporteProductos.setEnableToggle(true);
        QuickTipsConfig tipsConfig10 = new QuickTipsConfig();
        tipsConfig10.setText("Muestra todos los modelos de la MARCA");
        reporteProductos.setTooltip(tipsConfig10);


        pedidoCalzado = new ToolbarButton("Pedido");
        pedidoCalzado.setEnableToggle(true);

        QuickTipsConfig tipsConfig11 = new QuickTipsConfig();
        tipsConfig11.setText("Realizar pedido por Marca");
        pedidoCalzado.setTooltip(tipsConfig11);

        coleccionB = new ToolbarButton("Coleccion");
        coleccionB.setEnableToggle(true);


        PagingToolbar pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);

        pagingToolbar.addButton(nuevoMarca);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(editarMarca);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarMarca);
        pagingToolbar.addSeparator();

        pagingToolbar.addButton(configurarColores);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(configurarMaterial);
        pagingToolbar.addSeparator();
         pagingToolbar.addButton(cargarimagenMarca);
//        pagingToolbar.addSeparator();
// pagingToolbar.addButton(modeloEstilo);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(modeloMarca);
        pagingToolbar.addSeparator();

        pagingToolbar.addButton(coleccionB);
        pagingToolbar.addSeparator();
 pagingToolbar.addButton(configurarStylename);
        pagingToolbar.addSeparator();

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

    public void reload() {
        store.reload();
        grid.reconfigure(store, columnModel);
        grid.getView().refresh();
    }

    private void CargarDatosNuevaMarca() {
        String enlace = "php/Marca.php?funcion=BuscarProveedorCategoriaTalla";
        Utils.setErrorPrincipal("Cargando parametros de Nueva Marca", "cargar");
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
                                    Object[][] proveedores = Utils.getArrayOfJSONObject(marcaO, "proveedorM", new String[]{"idproveedor", "nombre"});
                                    Object[][] almacenes = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{"idalmacen", "nombre"});
                                    formulario = null;
                                    formulario = new EditarMarcaForm(null, "", "", "", "", "", "", "", null, null, null, almacenes, proveedores, Marca.this);
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

    private void cargarDatosNuevoModelo(String idmarca) {
        String enlace = "php/Modelo.php?funcion=BuscarLineaColeccionMarca&idmarca=" + idmarca;
        Utils.setErrorPrincipal("Cargando parametros de Nueva Marca", "cargar");
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
//                                    Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "colorM", new String[]{"idcolor", "codigo"});
//                                    Object[][] materiales = Utils.getArrayOfJSONObject(marcaO, "materialM", new String[]{"idmateria", "codigo"});
                                    Object[][] lineas = Utils.getArrayOfJSONObject(marcaO, "lineaM", new String[]{"idlinea", "codigo"});
                                    Object[][] colecciones = Utils.getArrayOfJSONObject(marcaO, "coleccionM", new String[]{"idcoleccion", "codigo"});
                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
                                    String idcoleccion = Utils.getStringOfJSONObject(marcaO, "idcoleccion");
                                    String nombre = Utils.getStringOfJSONObject(marcaO, "marca");
                                    String idlinea = Utils.getStringOfJSONObject(marcaO, "idlinea");

                                    formulario3 = null;
                                    formulario3 = new EditarModeloForm(null, idlinea,idmarca, idcoleccion, nombre, null, lineas, colecciones, Marca.this);
                                    formulario3.show();
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


    private void cargarDatosEditarMarca(String idmarca) {
        String enlace = "php/Marca.php?funcion=BuscarProveedorCategoriaTallaPorMarca&idmarca=" + idmarca;
        Utils.setErrorPrincipal("Cargando parametros de Nueva Marca", "cargar");
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
                                    Object[][] proveedores = Utils.getArrayOfJSONObject(marcaO, "proveedorM", new String[]{"idproveedor", "nombre"});
                                    Object[][] almacenes = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{"idalmacen", "nombre"});

                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
                                    String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");
                                    String proveedor = Utils.getStringOfJSONObject(marcaO, "idproveedor");
//                                    String categoria = Utils.getStringOfJSONObject(marcaO, "idcategoria");
                                    String codigobarra = Utils.getStringOfJSONObject(marcaO, "codigobarra");
                                    String imagen = Utils.getStringOfJSONObject(marcaO, "imagen");
                                    String idalmacen = Utils.getStringOfJSONObject(marcaO, "idalmacen");
                                    String mostrar = Utils.getStringOfJSONObject(marcaO, "pedido");
                                    String origen = Utils.getStringOfJSONObject(marcaO, "origen");
                                    String talla = Utils.getStringOfJSONObject(marcaO, "talla");

                                    formulario = null;
                                    formulario = new EditarMarcaForm(idmarca, null ,proveedor, codigo, codigobarra, nombre, imagen, idalmacen, mostrar, origen, talla, almacenes, proveedores, Marca.this);
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

    //colores
    private void cargarDatosConfigurarMarca(String idmarca) {
        String enlace = "php/Marca.php?funcion=BuscarColorMaterialPorMarca&idmarca=" + idmarca;
        Utils.setErrorPrincipal("Cargando parametros de Nueva Marca", "cargar");
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
                                    Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "colorM", new String[]{"idcolor", "nombre", "existe"});
                                    Object[][] materiales = Utils.getArrayOfJSONObject(marcaO, "materialM", new String[]{"idmateria", "nombre", "existe"});
                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");

                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");

                                    formulario1 = null;
                                    formulario1 = new ConfigurarMarcaForm(idmarca, nombre, colores, materiales, Marca.this);
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

    private void cargarDatosPanelPedidos(String idmarca) {
        String enlace = "php/Marca.php?funcion=BuscarClienteVendedorColorMaterialModeloPorMarca&idmarca=" + idmarca;
        Utils.setErrorPrincipal("Cargando parametros de Nueva Marca", "cargar");
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
                                    Object[][] clientes = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
                                    Object[][] vendedores = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "codigo"});
                                    Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "colorM", new String[]{"idcolor", "codigo"});
                                    Object[][] materiales = Utils.getArrayOfJSONObject(marcaO, "materialM", new String[]{"idmateria", "codigo"});
                                    Object[][] modelos = Utils.getArrayOfJSONObject(marcaO, "modeloM", new String[]{"idmodelo", "codigo"});
                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");

                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");
                                    String numeropedido = Utils.getStringOfJSONObject(marcaO, "numeropedido");
                                    String opcion = Utils.getStringOfJSONObject(marcaO, "opcion");



                                 //   PanelPedido pan_compraDirecta = new PanelPedido(idmarca, nombre, numeropedido, opcion, clientes, vendedores, colores, materiales, modelos, Marca.this);
                                   // kmenu.seleccionarOpcion(null, "fun5002", e, pan_compraDirecta);
//
                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + opcion, "mensaje");
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

    private void cargarDatosPanelColeccion(String idmarca) {

        String enlace = "php/Marca.php?funcion=BuscarLineaColeccionPorMarca&idmarca=" + idmarca;
        Utils.setErrorPrincipal("Cargando parametros de Coleccion", "cargar");
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
                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");

                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
                                    Coleccion pan_compraDirecta = new Coleccion(Marca.this, idmarca, nombre);
                                    kmenu.seleccionarOpcion(null, "fun1500", e, pan_compraDirecta);
//
                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente", "mensaje");
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

        eliminarMarca.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idmarca");
                    MessageBox.confirm("Eliminar Marca", "Realmente desea eliminar esta Marca??", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                //eliminar
                                String enlace = "php/Marca.php?funcion=EliminarMarca&idmarca=" + selecionado;
                                Utils.setErrorPrincipal("Eliminando la Marca", "cargar");
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
                    MessageBox.alert("No hay venta selecionado para editar y/o selecciono mas de uno.");
                }
                eliminarMarca.setPressed(false);
            }
        });
        //**************************************************
        //***********NUEVA MARCA
        //**
        nuevoMarca.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                CargarDatosNuevaMarca();
            }
        });


        cargarimagenMarca.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {

                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idmarca");
                            String enlTemp = "php/uploadimagen.php?funcion=imagen&idmarca=" + selecionado;
                            com.google.gwt.user.client.Window.open(enlTemp, "_blank", "enlTemp");
//                            verReporte1(enlTemp);

                        } else {
                            MessageBox.alert("No hay Marca selecionado para subir imagen.");
                        }

                        cargarimagenMarca.setPressed(false);
                    }
                });

        //**************************************************
        //***********EDITAR ROL
        //**************************************************
        editarMarca.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idmarca = records[0].getAsString("idmarca");
                            cargarDatosEditarMarca(idmarca);
                        } else {

                            Utils.setErrorPrincipal("Por favor seleccione una M para editar", "error");
                        }

                    }
                });
        reporteMarca.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();

                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idmarca");
                            String enlTemp = "funcion=reportemarcaHTML&idmarca=" + selecionado;
                            verReporte(enlTemp);

                        } else {
                            MessageBox.alert("No hay marca selecionado para ver el reporte.");
                        }

                        reporteMarca.setPressed(false);
                    }
                });
        configurarMarca.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idmarca = records[0].getAsString("idmarca");
                            cargarDatosConfigurarMarca(idmarca);
                        } else {

                            Utils.setErrorPrincipal("Por favor seleccione una Marca para configurar", "error");
                        }

                    }
                });
        //configurar colores
        configurarColores.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
//                            String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
                            String idmarca = records[0].getAsString("idmarca");
                            String nombre = records[0].getAsString("nombre");
                            ConfiguracionColor conficolor = new ConfiguracionColor(Marca.this, idmarca, nombre);
//                            Coleccion pan_compraDirecta = new Coleccion(Marca.this, idmarca, nombre);
                            kmenu.seleccionarOpcion(null, "fun1505", e, conficolor);

//                            cargarDatosConfigurarColores(idmarca);
                        } else {

                            Utils.setErrorPrincipal("Por favor seleccione una Marca para configurar", "error");
                        }

                    }
                });
        //configurar material
        configurarMaterial.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idmarca = records[0].getAsString("idmarca");
                            String nombre = records[0].getAsString("nombre");
                            if(nombre.equalsIgnoreCase("NIKE"))
                            {
                             Utils.setErrorPrincipal("PARA ESTA MARCA REQUIERE STYLENAME . NO MATERIAL", "error");
                            }else
                            {

                                Material conficolor = new Material(Marca.this, idmarca, nombre);
                            kmenu.seleccionarOpcion(null, "fun1506", e, conficolor);
                            }
                        } else {

                            Utils.setErrorPrincipal("Por favor seleccione una Marca para configurar", "error");
                        }

                    }
                });


                 configurarStylename.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idmarca = records[0].getAsString("idmarca");
                            String nombre = records[0].getAsString("nombre");
                            Material conficolor = new Material(Marca.this, idmarca, nombre);
//                            Coleccion pan_compraDirecta = new Coleccion(Marca.this, idmarca, nombre);
                            kmenu.seleccionarOpcion(null, "fun1506", e, conficolor);
                        } else {

                            Utils.setErrorPrincipal("Por favor seleccione una Marca para configurar", "error");
                        }

                    }
                });


        modeloMarca.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idmarca = records[0].getAsString("idmarca");
                            cargarDatosNuevoModelo(idmarca);
                        } else {

                            Utils.setErrorPrincipal("Por favor seleccione una Marca para Crear Modelos", "error");
                        }

                    }
                });



        reporteProductos.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();

                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idmarca");
                            String enlTemp = "funcion=detalleModeloHTML&idmarca=" + selecionado;
                            verReporte(enlTemp);

                        } else {
                            MessageBox.alert("No hay marca selecionado para ver el reporte.");
                        }

                        reporteMarca.setPressed(false);
                    }
                });
        pedidoCalzado.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idmarca = records[0].getAsString("idmarca");
                            cargarDatosPanelPedidos(idmarca);
                        } else {

                            MessageBox.alert("Por favor seleccione una Marca para Realizar un pedido");
                        }

                    }
                });

        coleccionB.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idmarca = records[0].getAsString("idmarca");
                            cargarDatosPanelColeccion(idmarca);
                        } else {

                            MessageBox.alert("Por favor seleccione una Marca para Panel Coleccion");
                        }

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

    public void setPropiedades(String idTabbed, Panel tab, TabPanel tap_aux) {
        tap_aux.setActiveTab(idTabbed);
        tab.setAutoScroll(true);
        tab.setIconCls("tab-icon");
        tab.setClosable(true);
        tap_aux.add(tab);
    }

    private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }

    public boolean getflag() {

        return flag;
    }
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.cliente;

import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.google.gwt.user.client.Window;
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
import com.gwtext.client.widgets.form.Field;
import org.balderrama.client.util.Conector;
import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
import com.gwtext.client.core.UrlParam;
import com.gwtext.client.widgets.Toolbar;
import com.gwtext.client.widgets.form.TextField;
//import org.balderrama.client.configuracion.CodificarPrecioForm;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.Store;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.grid.*;
//import org.balderrama.client.cliente.ClienteDetalle;
import org.balderrama.client.util.KMenu;

/**
 *
 * @author haydee
 */
public class clientedeudor extends Panel {

    private GridPanel grid;
    private ColumnConfig idColumn;
    private ColumnConfig nombreColumn;
    private ColumnConfig telefonoColumn;
    private ColumnConfig ciudadColumn;
    private ColumnConfig codigoColumn;
    private ColumnConfig direccionColumn;
    private ColumnConfig estadoColumn;
    private ColumnConfig planillaColumn;
    private ColumnConfig responsableColumn;
    private EditarNuevoClienteCredito formulario;
    private final int ANCHO = Utils.getScreenWidth() - 24;
    private final int ALTO = Utils.getScreenHeight() - 270;
//control de precios
    private TextField tex_ciPBU;
    private TextField tex_nombrePBU;
    private TextField tex_apellidosPBU;
    private TextField tex_empresaPBU;
    protected String buscarCi;
    protected String buscarNombres;
    protected String buscarApellido;
    protected String buscarEmpresa;
    protected String buscarLogin;
    private ToolbarButton buscar;
    private Toolbar too_busquedaPBW;
    // private ControlPreciosForm controlP;
    private ToolbarButton editarCliente;
    private ToolbarButton eliminarCliente;
    private ToolbarButton nuevoCliente;
    private ToolbarButton creditoCliente;
    private ToolbarButton reporteCliente;
    private ToolbarButton cambiarestado;
//  control de precios
    private ComboBox com_cliente;

    //   public NuevaEmpresaForm formulario;
    //  public PeriodoForm formulariop;
    private Object[][] ciudadM;
//    private ConfigurarMarcaForm formulario1;
    protected ExtElement ext_element;
    CheckboxSelectionModel cbSelectionModel;
    Store store;
    private String selecionado;
    private String selecionadonombre;
    private BaseColumnConfig[] columns;
    ColumnModel columnModel;
//    public CodificarPrecioForm precioForm;
    //variables para buscador
    PagingToolbar pagingToolbar1124;
    String selecionado1124 = "";
    public KMenu padre;

    public clientedeudor(KMenu kmenu) {
        this.setClosable(true);
        this.setId("TPfun1031");
        padre = kmenu;
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Cliente Credito");
        //  ciudadM = ciudad;
        onModuleLoad();
    }

    public void onModuleLoad() {

        DataProxy dataProxy = new ScriptTagProxy("php/Cliente.php?funcion=ListarCliente");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idcliente"),
                    new StringFieldDef("codigo"),
                    new StringFieldDef("nombre"),
                    new StringFieldDef("apellido"),
                    new StringFieldDef("ciudad"),
                    new StringFieldDef("nit"),
                    new StringFieldDef("direccion"),
                    new StringFieldDef("telefono"),
                    new StringFieldDef("estado")
                });
        JsonReader reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");

        store = new Store(dataProxy, reader, true);

        /* columnade idusuario  */
        idColumn = new ColumnConfig("Id Empresa", "idcliente", 10, true);

        idColumn.setWidth(100);
        // idColumn.setId("expandible");
        /* columnade nombre  */
        codigoColumn = new ColumnConfig("Codigo", "codigo", 70, true);
        //codigoColumn.setId("expandible");

        nombreColumn = new ColumnConfig("Nombre", "nombre", 150, true);
        responsableColumn = new ColumnConfig("Apellido", "apellido", 150, true);
        ciudadColumn = new ColumnConfig("Ciudad", "ciudad", 110, true);
        planillaColumn = new ColumnConfig("Nit", "nit", 80, true);


        direccionColumn = new ColumnConfig("Direccion", "direccion", 200, true);
        telefonoColumn = new ColumnConfig("Telefono", "telefono", 90, true);

        // ciudadColumn.setId("expandible");
        estadoColumn = new ColumnConfig("Estado", "estado", 60, true);
        estadoColumn.setId("expandible");

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    //column ID is company which is later used in setAutoExpandColumn
                    //       idColumn,
                    codigoColumn,
                    nombreColumn,
                    responsableColumn,
                    ciudadColumn,
                    planillaColumn,
                    direccionColumn,
                    telefonoColumn,
                    estadoColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-cliente-deuda");
        grid.setWidth(ANCHO);
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Clientes");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setAutoExpandColumn("expandible");
        grid.setLoadMask(true);
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setView(new GridView() {

            @Override
            public String getRowClass(Record record, int index, RowParams rowParams, Store store) {
                String estado = record.getAsString("estado");
                if (estado.equals("INACTIVO") == true) {
                    return "RED";

                } else {
                    if (estado.equals("PENDIENTE") == true) {
                        return "YELLOW";

                    } else {
                        return "none";
                    }
                }

            }
        });
        grid.addGridRowListener(new GridRowListenerAdapter() {

            @Override
            public void onRowDblClick(GridPanel grid, int rowIndex, EventObject e) {
//                Window.alert("En contruccion: aqui saldra la informacion del rol en detalle");
                Record[] records = cbSelectionModel.getSelections();


                selecionado = records[0].getAsString("idempresa");
                String enlTemp = "funcion=reporteEmpresaHTML&idempresa=" + selecionado;
                verReporte(enlTemp);
//                    Window.alert(enlTemp);
            }
        });


//        grid.a
        creditoCliente = new ToolbarButton("CREDITO CLIENTE HISTORIAL");
        creditoCliente.setEnableToggle(true);
        QuickTipsConfig tipsConfig13 = new QuickTipsConfig();
        tipsConfig13.setText("Creditos marca");
        creditoCliente.setTooltip(tipsConfig13);

        nuevoCliente = new ToolbarButton("Nuevo");
        nuevoCliente.setEnableToggle(true);
        QuickTipsConfig tipsConfig1 = new QuickTipsConfig();
        tipsConfig1.setText("Crear Cliente");
        nuevoCliente.setTooltip(tipsConfig1);

        editarCliente = new ToolbarButton("Editar");
        editarCliente.setEnableToggle(true);
        QuickTipsConfig tipsConfig = new QuickTipsConfig();
        tipsConfig.setText("Editar Cliente");
        editarCliente.setTooltip(tipsConfig);

        eliminarCliente = new ToolbarButton("Eliminar");
        eliminarCliente.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Eliminar Cliente");
        eliminarCliente.setTooltip(tipsConfig2);

        reporteCliente = new ToolbarButton("Reporte");
        reporteCliente.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Reporte Cliente");
        reporteCliente.setTooltip(tipsConfig3);


        cambiarestado = new ToolbarButton("Cambiar Estado a Cliente");
        cambiarestado.setEnableToggle(true);
        QuickTipsConfig tipsConfig4 = new QuickTipsConfig();
        tipsConfig4.setText("Cambiar Estado Cliente a Pendiente , Inactivo");
        cambiarestado.setTooltip(tipsConfig3);
//      control de precios


        PagingToolbar pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(500);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(nuevoCliente);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(editarCliente);
        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(eliminarCliente);
//        pagingToolbar.addSeparator();
        pagingToolbar.addButton(reporteCliente);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(cambiarestado);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(creditoCliente);
        pagingToolbar.addSeparator();

        //para el buscador
        too_busquedaPBW = new Toolbar();

        tex_ciPBU = new TextField("Codigo", "codigo");
        // tex_nombrePBU = new TextField("Empresa", "nombre");
        com_cliente = new ComboBox("Empresa", "nombre");

        tex_apellidosPBU = new TextField("Responsable", "responsable");
        tex_empresaPBU = new TextField("Estado", "estado");

        buscar = new ToolbarButton("Buscar");
        buscar.setPressed(true);

//        too_busquedaPBW.addText("EMPRESA:");
//        too_busquedaPBW.addField(com_cliente);
        too_busquedaPBW.addText("CODIGO:");
        too_busquedaPBW.addField(tex_ciPBU);
        too_busquedaPBW.addText("APELLIDO:");
        too_busquedaPBW.addField(tex_apellidosPBU);
        too_busquedaPBW.addText("NOMBRE:");
        too_busquedaPBW.addField(tex_empresaPBU);
        too_busquedaPBW.addButton(buscar);
        grid.setTopToolbar(too_busquedaPBW);
        grid.setBottomToolbar(pagingToolbar);
        aniadirListenersBuscador();
        aniadirListenersBuscadoresText();
        add(grid);
        aniadirListenersCliente();
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

//
    private void aniadirListenersCliente() {
        //**************************************************
        //***********ELIMINAR ROL
        //**************************************************

        eliminarCliente.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idcliente");
                    MessageBox.confirm("Eliminar Cliente", "Realmente desea eliminar este Cliente??", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                //eliminar
                                String enlace = "php/Cliente.php?funcion=EliminarCliente&idcliente=" + selecionado;
                                Utils.setErrorPrincipal("Eliminando el Cliente", "cargar");
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
                    MessageBox.alert("No hay Cliente selecionado para el Cliente y/o selecciono mas de uno.");
                }
                eliminarCliente.setPressed(false);
            }
        });


        //******************CAMBIAR ESTADO****************
        cambiarestado.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idcliente");
                    MessageBox.confirm("Cambiar Estado a INACTIVO", "Realmente desea Cambiar Estado ??", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                //eliminar
                                String enlace = "php/Cliente.php?funcion=CambiarEstado&idcliente=" + selecionado;
                                Utils.setErrorPrincipal("Cambiar de Estado", "cargar");
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
                                                    // Window.alert(mensajeR);
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
                    MessageBox.alert("No hay Cliente selecionado para el Cliente y/o selecciono mas de uno.");
                }
                cambiarestado.setPressed(false);
            }
        });


        //**************************************************
        //***********NUEVA MARCA
        //**
        nuevoCliente.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                CargarNuevoCliente();
            }
        });

        creditoCliente.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    String idcliente = records[0].getAsString("idcliente");
                    cargarDatosCobro(idcliente);
                //cargarDatosEditarCliente(idcliente);

                } else {

                    Utils.setErrorPrincipal("Por favor seleccione un Cliente para editar", "error");
                }

            }
        });
        //**************************************************
        //***********EDITAR ROL
        //**************************************************
        editarCliente.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idcliente = records[0].getAsString("idcliente");
                            cargarDatosEditarCliente(idcliente);
                        } else {

                            Utils.setErrorPrincipal("Por favor seleccione un Cliente para editar", "error");
                        }

                    }
                });
        reporteCliente.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();

                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idcliente");
                            String enlTemp = "funcion=reporteclienteHTML&idcliente=" + selecionado;
                            verReporte(enlTemp);

                        } else {
                            MessageBox.alert("No hay marca selecionado para ver el reporte.");
                        }

                        reporteCliente.setPressed(false);
                    }
                });
        cambiarestado.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idmarca = records[0].getAsString("idcliente");

                        } else {

                            Utils.setErrorPrincipal("seleccione un cliente para cambiar estado", "error");
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
                        store.load(0, 500);
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

    public void aniadirListenersBuscador() {

        buscar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Utils.setErrorPrincipal("Se realizo la busqueda", "mensaje");
                buscarSegunParametros();
            }
        });
    }

    private void cargarDatosCobro(final String idcliente) {
        final String idkardex = "kar-0";

        String enlace = "php/IngresoAlmacen.php?funcion=Cargardatoscliente&idmarca=" + idcliente;
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
                                    String cliente = Utils.getStringOfJSONObject(marcaO, "codigo");
                                    String saldo = Utils.getStringOfJSONObject(marcaO, "saldo");
                                    Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                    Object[][] vendedor = Utils.getArrayOfJSONObject(marcaO, "empleadoM", new String[]{"idempleado", "codigo"});
                                    String fechaini = Utils.getStringOfJSONObject(marcaO, "fechainicio");
                                    String fechafin = Utils.getStringOfJSONObject(marcaO, "fechafin");
                                    PanelCreditoRegistro pan_compraDirecta = new PanelCreditoRegistro(idcliente, saldo, cliente, colores, vendedor, fechaini, fechafin, clientedeudor.this, padre);
                                    padre.seleccionarOpcion(null, "fun50153", e, pan_compraDirecta);
                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente", "mensaje");
                                } else {
                                    MessageBox.alert("No Hay datos en la consulta");
                                }
                            } else {
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

    private void cargarDatosEditarCliente(String idcliente) {
        String enlace = "php/Cliente.php?funcion=BuscarCiudadTipoPorCliente&idcliente=" + idcliente;
        Utils.setErrorPrincipal("Cargando parametros de nuevo cliente", "cargar");
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
                                    Object[][] ciudades = Utils.getArrayOfJSONObject(marcaO, "ciudadM", new String[]{"idciudad", "nombre"});
                                    //Object[][] tipos = Utils.getArrayOfJSONObject(marcaO, "tipoM", new String[]{"idtipocliente", "nombre"});
                                    String idcliente = Utils.getStringOfJSONObject(marcaO, "idcliente");

                                    //  String tipo = Utils.getStringOfJSONObject(marcaO, "idtipocliente");
                                    String ciudad = Utils.getStringOfJSONObject(marcaO, "idciudad");
                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");
                                    String nit = Utils.getStringOfJSONObject(marcaO, "nit");
                                    String apellido = Utils.getStringOfJSONObject(marcaO, "apellido");
                                    String telefono = Utils.getStringOfJSONObject(marcaO, "telefono");

                                    String estado = Utils.getStringOfJSONObject(marcaO, "estado");
                                    // String fax = Utils.getStringOfJSONObject(marcaO, "fax");
                                    String direccion = Utils.getStringOfJSONObject(marcaO, "direccion");
                                    String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                    // String  = Utils.getStringOfJSONObject(marcaO, "estado");
                                    formulario = null;
                                    formulario = new EditarNuevoClienteCredito(idcliente, nit, nombre, apellido, codigo, ciudad, telefono, estado, direccion, ciudades, clientedeudor.this);
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

    private void CargarNuevoCliente() {
        String enlace = "php/Cliente.php?funcion=BuscarCiudadTipo";
        Utils.setErrorPrincipal("Cargando parametros de Nuevo Cliente", "cargar");
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
                                    Object[][] ciudades = Utils.getArrayOfJSONObject(marcaO, "ciudadM", new String[]{"idciudad", "nombre"});
                                    formulario = null;
                                    formulario = new EditarNuevoClienteCredito(ciudades, clientedeudor.this);
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

    private void onChangeempresa() {
        //com_almacen.setDisabled(true);
        buscarSegunParametros();
    //     tex_montoPapeleta.focus();
    }

    public void aniadirListenersBuscadoresText() {
        com_cliente.addListener(new ComboBoxListenerAdapter() {

            @Override
            public void onSelect(ComboBox comboBox, Record record, int index) {
                onChangeempresa();
            }
        });
        //**************************************************
        //*********** BUSCADOR CI
        //**************************************************
        com_cliente.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 2");
                }
            }
        });
        tex_apellidosPBU.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

        //**************************************************
        //*********** BUSCADOR NOMBRE
        //**************************************************
        tex_ciPBU.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 2");
                }
            }
        });

        //**************************************************
        //*********** BUSCADOR APELLIDOS
        //**************************************************
//**************************************************
        //*********** BUSCADOR EMpresa
        //**************************************************
        tex_empresaPBU.addListener(new TextFieldListenerAdapter() {

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
        store.reload(new UrlParam[]{new UrlParam("start", 0), new UrlParam("limit", 500),
                    new UrlParam("buscarcodigo", tex_ciPBU.getText()),
                    new UrlParam("buscarempresa", com_cliente.getText()),
                    new UrlParam("buscarresponsable", tex_apellidosPBU.getText()),
                    new UrlParam("buscarestado", tex_empresaPBU.getText())}, false);
    }

    private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }

    void buscarProductosSinKardex() {
        throw new UnsupportedOperationException("Not yet implemented");
    }

    void buscarProductos() {
        throw new UnsupportedOperationException("Not yet implemented");
    }
}


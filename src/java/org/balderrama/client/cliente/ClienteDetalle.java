/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.cliente;


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
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.event.GridCellListenerAdapter;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Ext;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.UrlParam;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.data.*;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.widgets.Toolbar;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;

/**
 *
 * @author buggy
 *
 */


public class ClienteDetalle extends Panel {
    private GridPanel gridCliente;
    private ColumnConfig loginColumn;
    private ColumnConfig nombreColumn;
    private ColumnConfig primerApColumn;
    private ColumnConfig ciColumn;
   // private ColumnConfig rolColumn;
    private ColumnConfig telefonoColumn;
    private ColumnConfig estadoColumn;
    private final int ANCHO = 900;
    private final int ALTO = 420;
    private ToolbarButton editarCliente;
    private ToolbarButton eliminarCliente;
    private ToolbarButton nuevoCliente;
    private ToolbarButton cambiarEstado;
    private ToolbarButton reporteCliente;
    //protected EditarUsuarioForm formulario;
    protected ExtElement ext_element;
    private CheckboxSelectionModel cbSelectionModel;
    private Store store;
    private ColumnConfig idColumn;
    private BaseColumnConfig[] columns;
    private ColumnModel columnModel;
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
    //private DataProxy dataProxy;
    private JsonReader reader;
    PagingToolbar pagingToolbar;
    String selecionado = "";
    String selecionadoalmacen = "";
    private Panel panel;
    private ColumnConfig celularColumn;
    private ColumnConfig emailColumn;
    private Toolbar too_busquedaPBW;
     private ComboBox com_cliente;
   // protected EditarNuevoClienteDetalle formularioCliente;
     protected EditarClienteForm formularioCliente;
    private ColumnConfig saldoColumn;
private String idempresa;
    private String nombreempresa;

 public ClienteDetalle() {
        this.setClosable(true);
        this.setId("TPfun10022");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Lista Cliente Detalle");
        onModuleLoad();
    }
  public ClienteDetalle(String idempresas) {
        this.setClosable(true);
        this.setId("TPfun10022");
        idempresa=idempresas;
     //   nombreempresa=nombreempresas;
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Lista Cliente Detalle");
        onModuleLoad2();
    }
   public void onModuleLoad2() {

   // DataProxy dataProxy = new ScriptTagProxy("php/clientedetalle.php?funcion=listarcliente");
//        dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoColor&idmarca=" + idpedido + "&idestilo=" + idestilo);

    DataProxy dataProxy = new ScriptTagProxy("php/clientedetalle.php?funcion=listarcliente&buscarempresa="+idempresa);

    final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idclienteempresa"),
                    new StringFieldDef("codigo"),
                    new StringFieldDef("empresa"),
                    new StringFieldDef("nombre"),
                    new StringFieldDef("apellido"),
                    new StringFieldDef("nit"),
                    new StringFieldDef("item"),
                    new StringFieldDef("estado"),
                    new StringFieldDef("saldoactual")

        });

        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);

        /* columnade idusuario  */
        idColumn = new ColumnConfig("Codigo", "idclienteempresa", 70, true);
        /* columnade loggin  */
        emailColumn = new ColumnConfig("Empresa", "empresa", 100, true);

		loginColumn = new ColumnConfig("Nombres", "nombre", 200, true, null, "nombre");
       nombreColumn = new ColumnConfig("Apellidos", "apellido", 100, true);

        /* columnade nombre  */
        ciColumn = new ColumnConfig("CI", "nit", 100, true);

	    /* columnade primer apellido  */
        primerApColumn = new ColumnConfig("Item", "item", 100, true);
        //rolColumn = new ColumnConfig("Telefono", "telefono", 100, true);
        estadoColumn = new ColumnConfig("Estado", "estado", 100, true);
        saldoColumn = new ColumnConfig("Saldo", "saldoactual", 100, true);

        cbSelectionModel = new CheckboxSelectionModel();
        CheckboxColumnConfig checkBoxColumn = new CheckboxColumnConfig(cbSelectionModel);
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    idColumn,
                    emailColumn,
                    nombreColumn,

                    loginColumn,
                    ciColumn,
                    //rolColumn,
                    primerApColumn,
                    estadoColumn,
                    saldoColumn
                };
        columnModel = new ColumnModel(columns);
        gridCliente = new EditorGridPanel();

        gridCliente.setId("gridCliente-lista-Cliente1");

        gridCliente.setWidth("100%");

        gridCliente.setHeight(ALTO);
        //  grid.setTitle("Lista de usuarios");

        gridCliente.setStore(store);

        gridCliente.setColumnModel(columnModel);

        gridCliente.setTrackMouseOver(true);

        gridCliente.setLoadMask(true);

        gridCliente.setSelectionModel(new RowSelectionModel());
        gridCliente.setSelectionModel(cbSelectionModel);
        gridCliente.setFrame(
                true);
        gridCliente.setStripeRows(
                true);
        gridCliente.setIconCls(
                "gridCliente-icon");

        nuevoCliente = new ToolbarButton("Nuevo");
        nuevoCliente.setEnableToggle(true);
        QuickTipsConfig tipsConfig1 = new QuickTipsConfig();
        tipsConfig1.setText("Crear nuevo Cliente");
        nuevoCliente.setTooltip(tipsConfig1);


        eliminarCliente = new ToolbarButton("Eliminar");

        eliminarCliente.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();

        tipsConfig2.setText("Eliminar Cliente(s)");
        //tipsConfig.setTitle("Tip Title");

        eliminarCliente.setTooltip(tipsConfig2);
        editarCliente = new ToolbarButton("Editar");

        editarCliente.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();

        tipsConfig3.setText("Editar Cliente");
        //tipsConfig.setTitle("Tip Title");

        editarCliente.setTooltip(tipsConfig3);

		cambiarEstado = new ToolbarButton("Modificar Estado");
        cambiarEstado.setEnableToggle(true);
        QuickTipsConfig tipsConfig4 = new QuickTipsConfig();
        tipsConfig4.setText("Cambiar el Estado");
        cambiarEstado.setTooltip(tipsConfig4);

		reporteCliente = new ToolbarButton("Reporte");
        reporteCliente.setEnableToggle(true);
        QuickTipsConfig tipsConfig5 = new QuickTipsConfig();
        tipsConfig5.setText("Reporte Cliente");
      reporteCliente.setTooltip(tipsConfig5);



        pagingToolbar = new PagingToolbar(store);

        pagingToolbar.setPageSize(100);

        pagingToolbar.setDisplayInfo(true);

        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");

        pagingToolbar.setEmptyMsg("No topics to display");

        pagingToolbar.addSeparator();

        pagingToolbar.addButton(nuevoCliente);

        pagingToolbar.addSeparator();

        pagingToolbar.addButton(editarCliente);

        pagingToolbar.addSeparator();

        pagingToolbar.addButton(eliminarCliente);

  pagingToolbar.addSeparator();

        pagingToolbar.addButton(cambiarEstado);
pagingToolbar.addSeparator();

        pagingToolbar.addButton(reporteCliente);



        too_busquedaPBW = new Toolbar();
    com_cliente = new ComboBox("Empresa", "nombre");
        tex_ciPBU = new TextField("NIT", "nit");
        tex_nombrePBU = new TextField("Nombre", "nombre");
        tex_apellidosPBU = new TextField("Apellidos", "apellidos");
        tex_empresaPBU = new TextField("Empresa", "empresa");

		buscar = new ToolbarButton("Buscar");
        buscar.setPressed(true);
   too_busquedaPBW.addText("EMPRESA:");
        too_busquedaPBW.addField(com_cliente);
             too_busquedaPBW.addText("Apellidos:");
        too_busquedaPBW.addField(tex_apellidosPBU);
        too_busquedaPBW.addText("Nombre:");
        too_busquedaPBW.addField(tex_nombrePBU);

        too_busquedaPBW.addText("NIT:");
        too_busquedaPBW.addField(tex_ciPBU);
        too_busquedaPBW.addButton(buscar);
        gridCliente.setTopToolbar(too_busquedaPBW);
        gridCliente.setBottomToolbar(pagingToolbar);
//        panel.add(gridCliente);



//
//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();
          recuperarAlmacenes();
        aniadirListenersBuscador();
        aniadirListenersBuscadoresText();
        aniadirListenersUsuario();
         add(gridCliente);
    //RootPanel.get().add(panel);
    }
    public void onModuleLoad() {

    DataProxy dataProxy = new ScriptTagProxy("php/clientedetalle.php?funcion=listarcliente");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idclienteempresa"),
                    new StringFieldDef("codigo"),
                    new StringFieldDef("empresa"),
                    new StringFieldDef("nombre"),
                    new StringFieldDef("apellido"),
                    new StringFieldDef("nit"),
                    new StringFieldDef("item"),
                    new StringFieldDef("estado"),
                    new StringFieldDef("saldoactual")

        });

        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);

        /* columnade idusuario  */
        idColumn = new ColumnConfig("Codigo", "idclienteempresa", 70, true);
        /* columnade loggin  */
        emailColumn = new ColumnConfig("Empresa", "empresa", 100, true);

		loginColumn = new ColumnConfig("Nombres", "nombre", 200, true, null, "nombre");
       nombreColumn = new ColumnConfig("Apellidos", "apellido", 100, true);

        /* columnade nombre  */
        ciColumn = new ColumnConfig("CI", "nit", 100, true);

	    /* columnade primer apellido  */
        primerApColumn = new ColumnConfig("Item", "item", 100, true);
        //rolColumn = new ColumnConfig("Telefono", "telefono", 100, true);
        estadoColumn = new ColumnConfig("Estado", "estado", 100, true);
        saldoColumn = new ColumnConfig("Saldo", "saldoactual", 100, true);

        cbSelectionModel = new CheckboxSelectionModel();
        CheckboxColumnConfig checkBoxColumn = new CheckboxColumnConfig(cbSelectionModel);
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    idColumn,
                    emailColumn,
                    nombreColumn,
                  
                    loginColumn,
                    ciColumn,
                    //rolColumn,
                    primerApColumn,
                    estadoColumn,
                    saldoColumn
                };
        columnModel = new ColumnModel(columns);
        gridCliente = new EditorGridPanel();

        gridCliente.setId("gridCliente-lista-Cliente1");

        gridCliente.setWidth("100%");

        gridCliente.setHeight(ALTO);
        //  grid.setTitle("Lista de usuarios");

        gridCliente.setStore(store);

        gridCliente.setColumnModel(columnModel);

        gridCliente.setTrackMouseOver(true);

        gridCliente.setLoadMask(true);

        gridCliente.setSelectionModel(new RowSelectionModel());
        gridCliente.setSelectionModel(cbSelectionModel);
        gridCliente.setFrame(
                true);
        gridCliente.setStripeRows(
                true);
        gridCliente.setIconCls(
                "gridCliente-icon");

        nuevoCliente = new ToolbarButton("Nuevo");
        nuevoCliente.setEnableToggle(true);
        QuickTipsConfig tipsConfig1 = new QuickTipsConfig();
        tipsConfig1.setText("Crear nuevo Cliente");
        nuevoCliente.setTooltip(tipsConfig1);


        eliminarCliente = new ToolbarButton("Eliminar");

        eliminarCliente.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();

        tipsConfig2.setText("Eliminar Cliente(s)");
        //tipsConfig.setTitle("Tip Title");

        eliminarCliente.setTooltip(tipsConfig2);
        editarCliente = new ToolbarButton("Editar");

        editarCliente.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();

        tipsConfig3.setText("Editar Cliente");
        //tipsConfig.setTitle("Tip Title");

        editarCliente.setTooltip(tipsConfig3);

		cambiarEstado = new ToolbarButton("Modificar Estado");
        cambiarEstado.setEnableToggle(true);
        QuickTipsConfig tipsConfig4 = new QuickTipsConfig();
        tipsConfig4.setText("Cambiar el Estado");
        cambiarEstado.setTooltip(tipsConfig4);

		reporteCliente = new ToolbarButton("Reporte");
        reporteCliente.setEnableToggle(true);
        QuickTipsConfig tipsConfig5 = new QuickTipsConfig();
        tipsConfig5.setText("Reporte Cliente");
      reporteCliente.setTooltip(tipsConfig5);



        pagingToolbar = new PagingToolbar(store);

        pagingToolbar.setPageSize(100);

        pagingToolbar.setDisplayInfo(true);

        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");

        pagingToolbar.setEmptyMsg("No topics to display");

        pagingToolbar.addSeparator();

        pagingToolbar.addButton(nuevoCliente);

        pagingToolbar.addSeparator();

        pagingToolbar.addButton(editarCliente);

        pagingToolbar.addSeparator();

        pagingToolbar.addButton(eliminarCliente);

  pagingToolbar.addSeparator();

        pagingToolbar.addButton(cambiarEstado);
pagingToolbar.addSeparator();

        pagingToolbar.addButton(reporteCliente);



        too_busquedaPBW = new Toolbar();
    com_cliente = new ComboBox("Empresa", "nombre");
        tex_ciPBU = new TextField("NIT", "nit");
        tex_nombrePBU = new TextField("Nombre", "nombre");
        tex_apellidosPBU = new TextField("Apellidos", "apellidos");
        tex_empresaPBU = new TextField("Empresa", "empresa");

		buscar = new ToolbarButton("Buscar");
        buscar.setPressed(true);
   too_busquedaPBW.addText("EMPRESA:");
        too_busquedaPBW.addField(com_cliente);
             too_busquedaPBW.addText("Apellidos:");
        too_busquedaPBW.addField(tex_apellidosPBU);
        too_busquedaPBW.addText("Nombre:");
        too_busquedaPBW.addField(tex_nombrePBU);

        too_busquedaPBW.addText("NIT:");
        too_busquedaPBW.addField(tex_ciPBU);
        too_busquedaPBW.addButton(buscar);
        gridCliente.setTopToolbar(too_busquedaPBW);
        gridCliente.setBottomToolbar(pagingToolbar);
//        panel.add(gridCliente);



//
//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();
          recuperarAlmacenes();
        aniadirListenersBuscador();
        aniadirListenersBuscadoresText();
        aniadirListenersUsuario();
         add(gridCliente);
    //RootPanel.get().add(panel);
    }
   private void recuperarAlmacenes() {


           ScriptTagProxy dataProxyAlmacenes = new ScriptTagProxy("php/Empresa.php?funcion=ListarEmpresa");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                     new StringFieldDef("idempresa"),
                    new StringFieldDef("codigo"),
                     new StringFieldDef("nombre")
                });
        JsonReader readerAlmacen = new JsonReader(recordDef);
        readerAlmacen.setRoot("resultado");
        readerAlmacen.setTotalProperty("totalCount");
        Store storeAlmacen = new Store(dataProxyAlmacenes, readerAlmacen, true);
        storeAlmacen.load();

        com_cliente.setMinChars(1);
        com_cliente.setStore(storeAlmacen);
        com_cliente.setValueField("nombre");
        com_cliente.setDisplayField("nombre");
        com_cliente.setForceSelection(true);
        com_cliente.setMode(ComboBox.LOCAL);
        com_cliente.setEmptyText("Seleccione una empresa");

        com_cliente.setLoadingText("buscando...");
        com_cliente.setTypeAhead(true);
        com_cliente.setSelectOnFocus(true);
        com_cliente.setWidth(200);

        com_cliente.setHideTrigger(true);


    }
    public GridPanel getGrid() {
        return gridCliente;
    }

    public void setGrid(GridPanel gridCliente) {
        this.gridCliente = gridCliente;
    }

  public void reload() {
        store.reload();
        gridCliente.reconfigure(store, columnModel);
        gridCliente.getView().refresh();
    }


//    public Panel getPanel() {
//        return panel;
//    }

    private void aniadirListenersUsuario() {
        //**************************************************
        //***********ELIMINAR USUARIO
        //**************************************************

        eliminarCliente.addListener(new ButtonListenerAdapter() {

            private boolean procederAEliminar;
            int repeat = 0;

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idclienteempresa");
                    //selecionadoalmacen = records[0].getAsString("idalmacen");
                    MessageBox.confirm("Eliminar Cliente", "Realmente desea eliminar este cliente??", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                //eliminar
                                String enlace = "php/ClienteDetalle.php?funcion=eliminarcliente&idclienteempresa=" + selecionado;
                              //  String enlace = "php/cliente.php?funcion=eliminarcliente&idclienteempresa=" + selecionado+"&idalmacen="+selecionadoalmacen;

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
                                                    gridCliente.reconfigure(store, columnModel);
                                                    gridCliente.getView().refresh();
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

                eliminarCliente.setPressed(false);
            }
        });

        //**************************************************
        //***********EDITAR USUARIO
        //**************************************************

         editarCliente.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        //Window.alert(grid.getWidth() + "---------------" + grid.getHeight());
                        ext_element = Ext.get("gridCliente-lista-cliente");
                        //ext_element.mask();
                        Record[] records = cbSelectionModel.getSelections();
                        String selecionado = "";
                        String selecionadoalmacen = "";
                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idclienteempresa");
                           // selecionadoalmacen = records[0].getAsString("idalmacen");
                            if (formularioCliente != null) {
                                formularioCliente.clear();
                                formularioCliente.destroy();
                                formularioCliente = null;
                            }
                            formularioCliente = new EditarClienteForm(selecionado, ClienteDetalle.this);
                            formularioCliente.show();
                        } else {
                            MessageBox.alert("Seleccione solo un Cliente por favor");
//                            Utils.setErrorPrincipal("Seleccione solo un usuario por favor", "error");
                        }

                        editarCliente.setPressed(false);
                    }
                });

 //**************************************************
        //***********EDITAcambiar estado
        //**************************************************
        cambiarEstado.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idmarca = records[0].getAsString("idclienteempresa");

                        } else {

                            Utils.setErrorPrincipal("seleccione un cliente para cambiar estado", "error");
                        }

                    }
                });
//   nuevoCliente.addListener(new ButtonListenerAdapter() {
//
//            @Override
//            public void onClick(Button button, EventObject e) {
//                CargarNuevoCliente();
//            }
//        });

          nuevoCliente.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                if (formularioCliente != null) {
                    formularioCliente.clear();
                    formularioCliente.destroy();
                    formularioCliente = null;
                }
                formularioCliente = new EditarClienteForm(null, ClienteDetalle.this);
                formularioCliente.show();
                nuevoCliente.setPressed(false);
            }
        });
        //**************************************************
        //***********EDITAR USUARIO
        //**************************************************
        reporteCliente.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();

                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idclienteempresa");
                            String enlTemp = "funcion=reporteclienteHTML&idclienteempresa=" + selecionado;
                            verReporte(enlTemp);

                        } else {
                            MessageBox.alert("No hay marca selecionado para ver el reporte.");
                        }

                        reporteCliente.setPressed(false);
                    }
                });



     //**************************************************
        //*********** LISTENERS DE LA TABLA
        //**************************************************
        gridCliente.addListener(
                new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store.load(0, 100);
                    }
                });
        gridCliente.addGridCellListener(
                new GridCellListenerAdapter() {

                    @Override
                    public void onCellClick(GridPanel gridCliente, int rowIndex, int colIndex, EventObject e) {
                        if (gridCliente.getColumnModel().getDataIndex(colIndex).equals("indoor")) {
                            Record record = gridCliente.getStore().getAt(rowIndex);
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
        //**************************************************
        //*********** BUSCADOR CI
        //**************************************************
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
//        tex_empresaPBU.addListener(new TextFieldListenerAdapter() {
//
//            @Override
//            public void onSpecialKey(Field field, EventObject e) {
//                if (e.getKey() == EventObject.ENTER) {
//                    buscarSegunParametros();
//                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 2");
//                }
//            }
//        });
//

        //**************************************************
        //*********** BUSCADOR LOGIN
        //**************************************************
        tex_nombrePBU.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

    }


     private void CargarNuevoCliente() {
               String enlace = "php/ClienteDetalle.php?funcion=BuscarEmpresa";

//         String enlace = "php/Cliente.php?funcion=BuscarAlmacenTipo";
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
                                           Object[][] almacenes = Utils.getArrayOfJSONObject(marcaO, "empresaM", new String[]{"idempresa", "nombre"});

                                    formularioCliente = null;
                               //    formularioCliente = new EditarNuevoClienteDetalle(null,"","","", "", "", "", null,"", almacenes, ClienteDetalle.this);

                                    formularioCliente.show();
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


    private void cargarDatosEditarCliente(String idcliente) {
        String enlace = "php/ClienteDetalle.php?funcion=buscarclienteporid&idclienteempresa=" + idcliente;
     //      String enlace = "php/Cliente.php?funcion=BuscarAlmacenTipoPorCliente&idcliente=" + idcliente;

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
                                    Object[][] almacenes = Utils.getArrayOfJSONObject(marcaO, "empresaM", new String[]{"idempresa", "nombre"});
                                    //Object[][] tipos = Utils.getArrayOfJSONObject(marcaO, "tipoM", new String[]{"idtipocliente", "nombre"});
                                    String idcliente = Utils.getStringOfJSONObject(marcaO, "idclienteempresa");
                                    String nit = Utils.getStringOfJSONObject(marcaO, "nit");
                                    String idempresa = Utils.getStringOfJSONObject(marcaO, "idempresa");
                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");
                                    String apellido = Utils.getStringOfJSONObject(marcaO, "apellido");
                                    String telefono = Utils.getStringOfJSONObject(marcaO, "telefono");
                                    String direccion = Utils.getStringOfJSONObject(marcaO, "direccion");
                                    String estado = Utils.getStringOfJSONObject(marcaO, "estado");
                                    String item = Utils.getStringOfJSONObject(marcaO, "item");

                                    formularioCliente = null;
                              // formularioCliente = new EditarNuevoClienteDetalle(idcliente,idempresa,nombre,apellido, nit, item, telefono, estado,direccion, almacenes, ClienteDetalle.this);

                                    formularioCliente.show();
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
    public void buscarSegunParametros() {
        store.reload(new UrlParam[]{new UrlParam("start", 0), new UrlParam("limit", 100),
                    new UrlParam("buscarnit", tex_ciPBU.getText()),
                    new UrlParam("buscarnombres", tex_nombrePBU.getText()),
                    new UrlParam("buscarapellido", tex_apellidosPBU.getText()),
                     new UrlParam("buscarempresa", com_cliente.getText())},false);
    }
     private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
}
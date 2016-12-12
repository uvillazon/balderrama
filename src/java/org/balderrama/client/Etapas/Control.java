/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.Etapas;


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
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.ColumnLayout;
import com.gwtext.client.widgets.layout.ColumnLayoutData;
import com.gwtext.client.widgets.layout.FormLayout;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;

/**
 *
 * @author buggy
 *
 */


public class Control extends Panel {
//
//     this.setClosable(true);
//        this.setId("TPfun10022");
//        setIconCls("tab-icon");
//        setAutoScroll(false);
//        setTitle("Lista Cliente");
private TextField num_factura;
    private TextField num_proforma;
    private TextField nom_marca;
    private TextField num_cantidad;
    private DateField fecha;


    private GridPanel gridCliente;
    private ColumnConfig loginColumn;
    private ColumnConfig nombreColumn;
    private ColumnConfig primerApColumn;
    private ColumnConfig ciColumn;
   // private ColumnConfig rolColumn;
    private ColumnConfig telefonoColumn;
    private ColumnConfig estadoColumn;
    private final int ANCHO = 900;
    private final int ALTO = 500;
    private ToolbarButton editarCliente;
    private ToolbarButton eliminarCliente;
    private ToolbarButton nuevoCliente;
    private ToolbarButton cambiarEstado;
    private ToolbarButton reporteCliente;
    //protected EditarUsuarioForm formulario;
     private EditarEstadoEtapa formulario;
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
     private DataProxy dataProxy;
    //private DataProxy dataProxy;
    private JsonReader reader;
    PagingToolbar pagingToolbar;
    String selecionado = "";
    String selecionadoalmacen = "";
    private Panel panel;
    private ColumnConfig celularColumn;
    private ColumnConfig emailColumn;
    private Toolbar too_busquedaPBW;
    String factura;
    String num_proformaD;
    String num_facturaD;
    String nom_marcaD;
    String num_cantidadD;

    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("95%");
   // protected EditarNuevoClienteDetalle formularioCliente;
 //    protected EditarClienteForm formularioCliente;


 public Control(String factura1,String num_proforma1,String num_factura1,String nom_marca1,String num_cantidad1) {
        this.setClosable(true);
        this.setId("TPfun1019");
        this.factura=factura1;
        this.num_proformaD=num_proforma1;
        this.num_facturaD=num_factura1;
        this.nom_marcaD=nom_marca1;
        this.num_cantidadD=num_cantidad1;

        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Etapas");
        onModuleLoad();
    }
    public void onModuleLoad() {
       initTextfields();
  Panel topPanel = new Panel();
        topPanel.setLayout(new ColumnLayout());
        topPanel.setBaseCls("x-plain");

        Panel columnOnePanel = new Panel();
        columnOnePanel.setLayout(new FormLayout());
        columnOnePanel.setBaseCls("x-plain");
        columnOnePanel.add(fecha, ANCHO_LAYOUT_DATA);
        columnOnePanel.add(num_proforma, ANCHO_LAYOUT_DATA);
        columnOnePanel.add(num_factura, ANCHO_LAYOUT_DATA);

        Panel columnTwoPanel = new Panel();
        columnTwoPanel.setLayout(new FormLayout());
        columnTwoPanel.setBaseCls("x-plain");
        columnTwoPanel.add(nom_marca, ANCHO_LAYOUT_DATA);
        columnTwoPanel.add(num_cantidad, ANCHO_LAYOUT_DATA);


        topPanel.add(columnOnePanel, new ColumnLayoutData(0.19));
        topPanel.add(columnTwoPanel, new ColumnLayoutData(0.19));
       // topPanel.add(columnTresPanel, new ColumnLayoutData(0.19));
        //topPanel.add(columnCuatroPanel, new ColumnLayoutData(0.18));
        //topPanel.add(columnCincoPanel, new ColumnLayoutData(0.17));
        //topPanel.add(columnseisPanel, new ColumnLayoutData(0.07));

        //     dataProxy1018 = new ScriptTagProxy("./php/Cobros.php?funcion=buscarventasporcliente&idcliente="+idclienteD);


    dataProxy = new ScriptTagProxy("./php/Etapas.php?funcion=buscaretapasporfactura&numerofactura="+factura);
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idetapa"),
                    new StringFieldDef("nombre"),
                    new StringFieldDef("responsable"),
                    new StringFieldDef("estado")
        });

        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);

        /* columnade idusuario  */
        idColumn = new ColumnConfig("Codigo", "idetapa", 80, true);
        /* columnade loggin  */
      //  emailColumn = new ColumnConfig("Empresa", "empresa", 100, true);

		loginColumn = new ColumnConfig("Nombres", "nombre", 200, true, null, "nombre");
       nombreColumn = new ColumnConfig("Responsable", "responsable", 150, true);

         estadoColumn = new ColumnConfig("Estado", "estado", 100, true);
        cbSelectionModel = new CheckboxSelectionModel();
        CheckboxColumnConfig checkBoxColumn = new CheckboxColumnConfig(cbSelectionModel);
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    idColumn,
                  //  emailColumn,
                    loginColumn,
                    nombreColumn,
                   // ciColumn,
                    //rolColumn,
                  //  primerApColumn,
                    estadoColumn
                };
        columnModel = new ColumnModel(columns);
        gridCliente = new EditorGridPanel();

        gridCliente.setId("gridCliente-lista-Cliente");

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

        nuevoCliente = new ToolbarButton("VER");
        nuevoCliente.setEnableToggle(true);
        QuickTipsConfig tipsConfig1 = new QuickTipsConfig();
        tipsConfig1.setText("Ver");
        nuevoCliente.setTooltip(tipsConfig1);


        eliminarCliente = new ToolbarButton("DETALLE");

        eliminarCliente.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();

        tipsConfig2.setText("detalle");
        //tipsConfig.setTitle("Tip Title");

        eliminarCliente.setTooltip(tipsConfig2);
        editarCliente = new ToolbarButton("MODIFICAR");

        editarCliente.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();

        tipsConfig3.setText("modificar");
        //tipsConfig.setTitle("Tip Title");

        editarCliente.setTooltip(tipsConfig3);

		cambiarEstado = new ToolbarButton("Cambio Estado");
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


        gridCliente.setBottomToolbar(pagingToolbar);
        aniadirListenersUsuario();
         initValues();
         add(topPanel);
        add(gridCliente);

    //RootPanel.get().add(panel);
    }
    private void initTextfields() {
       num_proforma  = new TextField("Num. Proforma", "numproforma");
       num_factura  = new TextField("Factura", "factura");
       nom_marca = new TextField("Marca", "marca");
        num_cantidad = new TextField("Cantidad", "cantidad");
        fecha = new DateField("Fecha", "fecha");

    }
   public void initValues() {



        num_proforma.setValue(num_proformaD);
        num_factura.setValue(num_facturaD);
        nom_marca.setValue(nom_marcaD);
        num_cantidad.setValue(num_cantidadD);

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
//          editarCliente.addListener(
//                new ButtonListenerAdapter() {
//
//                    @Override
//                    public void onClick(Button button, EventObject e) {
//                        Record[] records = cbSelectionModel.getSelections();
//                        if (records.length == 1) {
//                            String idcliente = records[0].getAsString("idclienteempresa");
//                            cargarDatosEditarCliente(idcliente);
//                        } else {
//
//                            Utils.setErrorPrincipal("Por favor seleccione un Cliente para editar", "error");
//                        }
//
//                    }
//                });

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
//                            if (formularioCliente != null) {
//                                formularioCliente.clear();
//                                formularioCliente.destroy();
//                                formularioCliente = null;
//                            }
//                            formularioCliente = new EditarClienteForm(selecionado, ClienteDetalle.this);
//                            formularioCliente.show();
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
                            String idetapa = records[0].getAsString("idetapa");
                            cargarDatosEditarAlmacen(idetapa);
                        } else {

                            Utils.setErrorPrincipal("Por favor seleccione una Etapa para editar", "error");
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
//                if (formularioCliente != null) {
//                    formularioCliente.clear();
//                    formularioCliente.destroy();
//                    formularioCliente = null;
//                }
//                formularioCliente = new EditarClienteForm(null, ClienteDetalle.this);
//                formularioCliente.show();
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
        //***********NUEVO USUARIO
        //**************************************************
//        nuevoCliente.addListener(new ButtonListenerAdapter() {
//
//            @Override
//            public void onClick(Button button, EventObject e) {
//                if (formularioCliente != null) {
//                    formularioCliente.clear();
//                    formularioCliente.destroy();
//                    formularioCliente = null;
//                }
//                formularioCliente = new EditarNuevoCliente(null, ClienteDetalle.this);
//                formularioCliente.show();
//                nuevoCliente.setPressed(false);
//            }
//        });



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
private void cargarDatosEditarAlmacen(String idetapa) {
        String enlace = "php/Etapas.php?funcion=BuscarEtapa&idetapa=" + idetapa;
        Utils.setErrorPrincipal("Cargando parametros de etapa", "cargar");
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
                                    String idalmacen = Utils.getStringOfJSONObject(marcaO, "idetapa");
                                    String tipo = Utils.getStringOfJSONObject(marcaO, "estado");
                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");
                                    formulario = null;
                                    formulario = new EditarEstadoEtapa(idalmacen, nombre,tipo, Control.this);
                                    formulario.show();
                                } else
                                {
                                    MessageBox.alert("No Hay datos en la consulta");
                                }
                            }
                            else
                            {
                                      MessageBox.alert("mensaje");

                            Utils.setErrorPrincipal(mensajeR, "mensaje");

                        //  Utils.setErrorPrincipal(mensajeR, "mensaje");
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
        tex_empresaPBU.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 2");
                }
            }
        });


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

                            //        formularioCliente = null;
                               //    formularioCliente = new EditarNuevoClienteDetalle(null,"","","", "", "", "", null,"", almacenes, ClienteDetalle.this);

                           //         formularioCliente.show();
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

                           //         formularioCliente = null;
                              // formularioCliente = new EditarNuevoClienteDetalle(idcliente,idempresa,nombre,apellido, nit, item, telefono, estado,direccion, almacenes, ClienteDetalle.this);

                           //         formularioCliente.show();
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
    public void buscarSegunParametros() {
        store.reload(new UrlParam[]{new UrlParam("start", 0), new UrlParam("limit", 100),
                    new UrlParam("buscarnit", tex_ciPBU.getText()),
                    new UrlParam("buscarnombres", tex_nombrePBU.getText()),
                    new UrlParam("buscarapellido", tex_apellidosPBU.getText()),
					new UrlParam("buscarempresa", tex_empresaPBU.getText())}, false);
    }
     private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
}
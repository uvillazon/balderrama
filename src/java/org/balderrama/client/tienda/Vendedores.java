/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.tienda;

/**
 *
 * @author buggy
 */
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.google.gwt.user.client.Window;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.data.FieldDef;
import com.gwtext.client.data.JsonReader;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.RecordDef;
import com.gwtext.client.data.ScriptTagProxy;
import com.gwtext.client.data.Store;
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
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;
import com.gwtext.client.widgets.form.Checkbox;
import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;
import org.balderrama.client.marca.EditarMarcaForm;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.tienda.EditarVendedorForm;
//import org.selkis.client.util.Utils;

/**
 *
 * @author Administrador
 */
public class Vendedores extends Panel {

    private GridPanel grid;
    private ColumnConfig nombreColumn;
    private ColumnConfig estadoColumn;
    private final int ANCHO = Utils.getScreenWidth() - 24;
    private final int ALTO = Utils.getScreenHeight() - 155;
    private ToolbarButton nuevoVendedor;
    private ToolbarButton editarVendedor;
    private ToolbarButton eliminarVendedor;
    private ToolbarButton reporteVendedor;
    private EditarVendedorForm formulario;

    protected ExtElement ext_element;
    private JsonReader reader;
    private CheckboxSelectionModel cbSelectionModel;
    private Store store;
    private String selecionado;
    private BaseColumnConfig[] columns;
    private ColumnModel columnModel;
    private ColumnConfig idvendedorColumn;
    private ColumnConfig codigoColumn;
    private ColumnConfig nombColumn;
    private ColumnConfig apellidoColumn;
    private ColumnConfig tiendaColumn;
    private ColumnConfig telefonoColumn;
    private ColumnConfig direccionColumn;
    private ColumnConfig fechaColumn;
    private ColumnConfig usuarioColumn;
    private ColumnConfig estadColumn;


    public Vendedores() {
        this.setClosable(true);
        this.setId("TPfun5001");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Vendedores");
        onModuleLoad();
    }

    public void onModuleLoad() {

        DataProxy dataProxy = new ScriptTagProxy("php/Vendedor.php?funcion=ListarVendedor");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idvendedor"),
                    new StringFieldDef("codigo"),
                    new StringFieldDef("nombre"),
                    new StringFieldDef("apellido"),
                    new StringFieldDef("tienda"),
                    new StringFieldDef("telefono"),
                    new StringFieldDef("direccion"),
                    new StringFieldDef("fecha"),
                    new StringFieldDef("usuario"),
                    new StringFieldDef("estado")
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");

        store = new Store(dataProxy, reader, true);

        /* columnade idusuario  */

        /* columnade nombre  */
        idvendedorColumn = new ColumnConfig("Id vendedor", "idvendedor", (ANCHO / 10) - 50, true);
//        idColumn.setId("expandible");
        codigoColumn = new ColumnConfig("Codigo", "codigo", 100, true);
        codigoColumn.setId("expandible");
        nombColumn = new ColumnConfig("Nombre", "nombre", (ANCHO / 8) - 50, true);
        apellidoColumn = new ColumnConfig("apellido", "apellido", (ANCHO / 8) - 50, true);
        tiendaColumn = new ColumnConfig("tienda", "tienda", (ANCHO / 8) - 50, true);
        telefonoColumn = new ColumnConfig("telefono", "telefono", (ANCHO / 8) - 50, true);
        direccionColumn = new ColumnConfig("direccion", "direccion", (ANCHO / 8) - 50, true);
        fechaColumn = new ColumnConfig("fecha", "fecha", (ANCHO / 8) - 50, true);
        usuarioColumn = new ColumnConfig("usuario", "usuario", (ANCHO / 8) - 50, true);
        estadColumn = new ColumnConfig("estado", "estado", (ANCHO / 8) - 50, true);



        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    //column ID is company which is later used in setAutoExpandColumn
                    //                                        idColumn,
                    idvendedorColumn,
                    codigoColumn,
                    nombColumn,
                    apellidoColumn,
                    telefonoColumn,
                    tiendaColumn,
                    telefonoColumn,
                    direccionColumn,
                    fechaColumn,
                    usuarioColumn,
                    estadColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-roles");
        grid.setWidth(ANCHO);
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Proveedores");
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
                Record[] records = cbSelectionModel.getSelections();


                selecionado = records[0].getAsString("idvendedor");
                String enlTemp = "funcion=reporteproveedorHTML&idvendedor=" + selecionado;
                verReporte(enlTemp);
//                    Window.alert(enlTemp);
                }
            }
            )
                ;

//        grid.a


        nuevoVendedor = new ToolbarButton("Nuevo");

            nuevoVendedor.setEnableToggle (true);
            QuickTipsConfig tipsConfig1 = new QuickTipsConfig();

            tipsConfig1.setText ("Crear nuevo Vendedor");

            nuevoVendedor.setTooltip (tipsConfig1);

            editarVendedor  = new ToolbarButton("Editar");
            editarVendedor.setEnableToggle (true);
            QuickTipsConfig tipsConfig = new QuickTipsConfig();
            tipsConfig.setText ("Editar Vendedor");
            editarVendedor.setTooltip (tipsConfig);


            eliminarVendedor  = new ToolbarButton("Eliminar");
            eliminarVendedor.setEnableToggle (true);
            QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
            tipsConfig2.setText ("Eliminar Vendedores(es)");
            eliminarVendedor.setTooltip (tipsConfig2);

            reporteVendedor  = new ToolbarButton("Reporte");
            reporteVendedor.setEnableToggle (true);
            QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
            tipsConfig3.setText ("Vendedor(es)");

            reporteVendedor.setTooltip (tipsConfig2);
            PagingToolbar pagingToolbar = new PagingToolbar(store);

            pagingToolbar.setPageSize (100);

            pagingToolbar.setDisplayInfo (true);

            pagingToolbar.setDisplayMsg ("Mostrando {0} - {1} de {2}");

            pagingToolbar.setEmptyMsg ("No topics to display");

            pagingToolbar.addSeparator ();

            pagingToolbar.addButton (nuevoVendedor);

            pagingToolbar.addSeparator ();

            pagingToolbar.addButton (editarVendedor);

            pagingToolbar.addSeparator ();

            pagingToolbar.addButton (eliminarVendedor);

            pagingToolbar.addSeparator ();

            pagingToolbar.addButton (reporteVendedor);

            pagingToolbar.addSeparator ();

            grid.setBottomToolbar (pagingToolbar);

            add(grid);
            //panel.add(grid);

            aniadirListenersVendedor();

            //RootPanel.get().add(panel);
        }

    public GridPanel getGrid() {
        return grid;
    }

    public void reload() {
        store.reload();
        grid.reconfigure(store, columnModel);
        grid.getView().refresh();
    }

    public void setGrid(GridPanel grid) {
        this.grid = grid;
    }

//    private void aniadirListenersFormulario() {
//
//        formulario.getBut_aceptar().addListener(new ButtonListenerAdapter() {
//
//            int repeat = 0;
//
//            @Override
//            public void onClick(Button button, EventObject e) {
//                String idrol = formulario.getIdRol();
//                String nombre = formulario.getTex_nombre().getText();
//                String estado = formulario.getCom_estado().getText();
//                //com.google.gwt.user.client.Window.alert(idrol + "-->" + nombre + "-->" + estado);
//                String enlace = "";
//                if (idrol != null) {
//                    //com.google.gwt.user.client.Window.alert(formulario.getSeleccionados() + "<-----> es para modificsr");
//                    enlace = getLinksaveUpdate(idrol, nombre, estado, formulario.getSeleccionados());
//                    enlace = "php/dao/RolNuevoUpdate.php?function=txSaveUpdateRol&resultado=" + enlace;
//
//                } else {
//                    enlace = getLinksaveUpdate("nuevo", nombre, estado, formulario.getSeleccionados());
//                    enlace = "php/dao/RolNuevoUpdate.php?function=txSaveUpdateRol&resultado=" + enlace;
//                }
//                Conector cones = new Conector(enlace, false);
//                Utils.setErrorPrincipal("Guardando los cambios en el rol", "cargar");
//                try {
//                    cones.getRequestBuilder().sendRequest(null, new RequestCallback() {
//
//                        public void onResponseReceived(Request request, Response response) {
//                            String dataGU = response.getText();
//                            JSONValue jsonValue = JSONParser.parse(dataGU);
//                            JSONObject jsonObjectGU;
//                            if ((jsonObjectGU = jsonValue.isObject()) != null) {
//                                String errorR = Utils.getStringOfJSONObject(jsonObjectGU, "error");
//                                String mensajeR = Utils.getStringOfJSONObject(jsonObjectGU, "mensaje");
//                                if (errorR.equalsIgnoreCase("True")) {
//                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
//                                    formulario.getWindow().close();
//                                    formulario = null;
//                                    store.reload();
//                                    grid.reconfigure(store, columnModel);
//                                    grid.getView().refresh();
//                                } else {
//                                    Utils.setErrorPrincipal(mensajeR, "error");
//                                }
//                            }
//                        }
//
//                        public void onError(Request request, Throwable exception) {
//                            Utils.setErrorPrincipal("No se pudo conectar con el servidor", "error");
//                        }
//                    });
//                } catch (RequestException ex) {
//                    Utils.setErrorPrincipal("No se pudo conectar con el servidor", "error");
//                }
//            }
//        });
//
//        formulario.getBut_cancelar().addListener(new ButtonListenerAdapter() {
//
//            @Override
//            public void onClick(Button button, EventObject e) {
//                formulario.getWindow().close();
//                formulario.getWindow().destroy();
//                formulario = null;
//
//            }
//        });
//    }
    private void cargarDatosNuevoVendedor() {

        formulario = null;
//        formulario = new EditarVendedorForm(null, "", "", "", "", "", "",Vendedores.this);
        formulario.show();

    }

    private void cargarDatosEditarVendedor(String idvendedor) {

        String enlace = "php/Vendedor.php?funcion=BuscarVendedorPorId&idvendedor=" + idvendedor;
        Utils.setErrorPrincipal("Cargando parametros para VEndedor", "cargar");
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
                        if (errorR.equalsIgnoreCase("true")) {
                            Utils.setErrorPrincipal(mensajeR, "mensaje");

                            JSONValue productoV = jsonObject.get("resultado");
                            JSONObject productoO;
                            if ((productoO = productoV.isObject()) != null) {
                                String idvendedor = Utils.getStringOfJSONObject(productoO, "idvendedor");
                                String codigo = Utils.getStringOfJSONObject(productoO, "codigo");
                                String nombre = Utils.getStringOfJSONObject(productoO, "nombre");
                                String apellido = Utils.getStringOfJSONObject(productoO, "apellido");
                                String telefono = Utils.getStringOfJSONObject(productoO, "telefono");
                                String direccion = Utils.getStringOfJSONObject(productoO, "direccion");
                                String estado = Utils.getStringOfJSONObject(productoO, "estado");

                                formulario = null;
//                                formulario = new EditarVendedorForm(idvendedor, codigo, nombre,apellido,telefono,direccion, estado,Vendedores.this);
                                formulario.show();
                            } else {
                                Utils.setErrorPrincipal("Error en el objeto vendedores", "error");
                            }
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
            ex.getMessage();
            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
        }
    }

    private void aniadirListenersVendedor() {
        //**************************************************
        //***********ELIMINAR ROL
        //**************************************************

        eliminarVendedor.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idvendedor");
                    MessageBox.confirm("Eliminar Vendedor", "Realmente desea eliminar este Vendedor??", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                //eliminar
                                String enlace = "php/Vendedor.php?funcion=EliminarVendedor&idvendedor=" + selecionado;
                                Utils.setErrorPrincipal("Eliminando el Vendedor", "cargar");
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
                eliminarVendedor.setPressed(false);
            }
        });
        nuevoVendedor.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                cargarDatosNuevoVendedor();
            }
        });
        editarVendedor.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    String idvendedor = records[0].getAsString("idvendedor");
                    cargarDatosEditarVendedor(idvendedor);
                } else {
                    Utils.setErrorPrincipal("Por favor seleccione un producto para editar", "error");
                }

            }
        });
        reporteVendedor.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();

                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idvendedor");
                            String enlTemp = "funcion=reportevendedorHTML&idvendedor=" + selecionado;
                            verReporte(enlTemp);

                        } else {
                            MessageBox.alert("No hay proveedor selecionado para ver el reporte.");
                        }

                        reporteVendedor.setPressed(false);
                    }
                });

        //**************************************************
        //***********EDITAR ROL
        //**************************************************


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

    private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
}


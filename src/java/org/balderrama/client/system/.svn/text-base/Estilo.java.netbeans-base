/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.system;

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
//import org.selkis.client.util.Utils;

/**
 *
 * @author Administrador
 */
public class Estilo extends Panel {

    private GridPanel grid;
    private ColumnConfig nombreColumn;
    private ColumnConfig estadoColumn;
    private final int ANCHO = Utils.getScreenWidth() - 24;
    private final int ALTO = Utils.getScreenHeight() - 155;
    private ToolbarButton nuevoEstilo;
    private ToolbarButton editarEstilo;
    private ToolbarButton eliminarEstilo;
    private ToolbarButton reporteEstilo;
    private EditarEstiloForm formulario;

    protected ExtElement ext_element;
    private JsonReader reader;
    private CheckboxSelectionModel cbSelectionModel;
    private Store store;
    private String selecionado;
    private BaseColumnConfig[] columns;
    private ColumnModel columnModel;
    private ColumnConfig idColumn;
    private ColumnConfig codigoColumn;
    private ColumnConfig nombColumn;
    private ColumnConfig telefonoColumn;
    private ColumnConfig descripcionColumn;
    private ColumnConfig paisColumn;
    private ColumnConfig webColumn;
    private ColumnConfig emailColumn;

    public Estilo() {
        this.setClosable(true);
        this.setId("TPfun5000");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Estilos");
        onModuleLoad();
    }

    public void onModuleLoad() {

        DataProxy dataProxy = new ScriptTagProxy("php/Estilo.php?funcion=ListarEstilo");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idestilo"),
                   
                    new StringFieldDef("nombre"),
                    new StringFieldDef("descripcion")
                   
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");

        store = new Store(dataProxy, reader, true);

        /* columnade idusuario  */

        /* columnade nombre  */
        idColumn = new ColumnConfig("Id Estilo", "idestilo", (ANCHO / 7) - 50, true);
        idColumn.setId("expandible");
//        codigoColumn = new ColumnConfig("Codigo", "codigo", 100, true);
//        codigoColumn.setId("expandible");
        nombColumn = new ColumnConfig("Nombre", "nombre", (ANCHO / 8) - 50, true);
        telefonoColumn = new ColumnConfig("telefono", "telefono", (ANCHO / 8) - 50, true);
        descripcionColumn = new ColumnConfig("Descripcion", "descripcion", (ANCHO / 8) - 50, true);
        paisColumn = new ColumnConfig("Pais", "pais", (ANCHO / 8) - 50, true);
        webColumn = new ColumnConfig("Pagina Web", "web", (ANCHO / 8) - 50, true);
        emailColumn = new ColumnConfig("E-mail", "email", (ANCHO / 8) - 50, true);


        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    //column ID is company which is later used in setAutoExpandColumn
                    //                                        idColumn,
                    idColumn,
                    nombColumn,
//                    telefonoColumn,
                    descripcionColumn
//                    paisColumn,
//                    webColumn,
//                    emailColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-Estilos");
        grid.setWidth(ANCHO);
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Estilos");
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


                selecionado = records[0].getAsString("idproveedor");
                String enlTemp = "funcion=reporteproveedorHTML&idproveedor=" + selecionado;
                verReporte(enlTemp);
//                    Window.alert(enlTemp);
                }
            }
            )
                ;

//        grid.a


        nuevoEstilo = new ToolbarButton("Nuevo");

            nuevoEstilo.setEnableToggle (true);
            QuickTipsConfig tipsConfig1 = new QuickTipsConfig();

            tipsConfig1.setText ("Crear nuevo Estilo");

            nuevoEstilo.setTooltip (tipsConfig1);

            editarEstilo  = new ToolbarButton("Editar");
            editarEstilo.setEnableToggle (true);
            QuickTipsConfig tipsConfig = new QuickTipsConfig();
            tipsConfig.setText ("Editar Estilo");
            editarEstilo.setTooltip (tipsConfig);


            eliminarEstilo  = new ToolbarButton("Eliminar");
            eliminarEstilo.setEnableToggle (true);
            QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
            tipsConfig2.setText ("Eliminar Estilos(es)");
            eliminarEstilo.setTooltip (tipsConfig2);

            reporteEstilo  = new ToolbarButton("Reporte");
            reporteEstilo.setEnableToggle (true);
            QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
            tipsConfig3.setText ("Reporte(es)");

            reporteEstilo.setTooltip (tipsConfig2);
            PagingToolbar pagingToolbar = new PagingToolbar(store);

            pagingToolbar.setPageSize (100);

            pagingToolbar.setDisplayInfo (true);

            pagingToolbar.setDisplayMsg ("Mostrando {0} - {1} de {2}");

            pagingToolbar.setEmptyMsg ("No topics to display");

            pagingToolbar.addSeparator ();

            pagingToolbar.addButton (nuevoEstilo);

            pagingToolbar.addSeparator ();

            pagingToolbar.addButton (editarEstilo);

            pagingToolbar.addSeparator ();

            pagingToolbar.addButton (eliminarEstilo);

            pagingToolbar.addSeparator ();

            pagingToolbar.addButton (reporteEstilo);

            pagingToolbar.addSeparator ();

            grid.setBottomToolbar (pagingToolbar);

            add(grid);
            //panel.add(grid);

            aniadirListenersProveedor();

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


    private void cargarDatosNuevoEstilo() {

       String enlace = "php/Estilo.php?funcion=CargarNuevoEstilo";
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
                                    
//                                    Object[][] categorias = Utils.getArrayOfJSONObject(marcaO, "categoriaM", new String[]{"idcategoria", "nombre"});
//                                    Object[][] proveedores = Utils.getArrayOfJSONObject(marcaO, "proveedorM", new String[]{"idproveedor", "nombre"});
                                    Object[][] tallas = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});

//                                   scenes = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{"idalmacen", "nombre"});
                                    formulario = null;
//                                    MessageBox.alert("Envio parametros");
                                    formulario = new EditarEstiloForm(null, "", "", tallas, Estilo.this);
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

    private void cargarDatosEditarEstilo(String idestilo) {

        String enlace = "php/Estilo.php?funcion=CargarDatosEstiloMarca&idestilo=" + idestilo;
        Utils.setErrorPrincipal("Cargando parametros para Proveedor", "cargar");
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
                                String idestilo = Utils.getStringOfJSONObject(productoO, "idestilo");
//                                String codigo = Utils.getStringOfJSONObject(productoO, "codigo");
                                String nombre = Utils.getStringOfJSONObject(productoO, "nombre");
                                String descripcion = Utils.getStringOfJSONObject(productoO, "descripcion");
                                Object[][] tallas = Utils.getArrayOfJSONObject(productoO, "marcaM", new String[]{"idmarca", "nombre","existe"});


                              
                                formulario = null;
//                                formulario = new EditarEstiloForm(idproveedor, codigo, nombre, telefono, pais, ciudad, direccion, email, web, representante, Proveedor.this);
                                formulario = new EditarEstiloForm(idestilo, nombre,descripcion,tallas, Estilo.this);
                                formulario.show();
                            } else {
                                Utils.setErrorPrincipal("Error en el objeto proveedor", "error");
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

    private void aniadirListenersProveedor() {
        //**************************************************
        //***********ELIMINAR ROL
        //**************************************************

        eliminarEstilo.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idproveedor");
                    MessageBox.confirm("Eliminar Proveedor", "Realmente desea eliminar este Proveedor??", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                //eliminar
                                String enlace = "php/Proveedor.php?funcion=EliminarProveedor&idproveedor=" + selecionado;
                                Utils.setErrorPrincipal("Eliminando el Proveedor", "cargar");
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
                eliminarEstilo.setPressed(false);
            }
        });
        nuevoEstilo.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                cargarDatosNuevoEstilo();
            }
        });
        editarEstilo.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    String idestilo = records[0].getAsString("idestilo");
                    cargarDatosEditarEstilo(idestilo);
                } else {
                    Utils.setErrorPrincipal("Por favor seleccione un producto para editar", "error");
                }

            }
        });
        reporteEstilo.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();

                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idproveedor");
                            String enlTemp = "funcion=reporteproveedorHTML&idproveedor=" + selecionado;
                            verReporte(enlTemp);

                        } else {
                            MessageBox.alert("No hay proveedor selecionado para ver el reporte.");
                        }

                        reporteEstilo.setPressed(false);
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


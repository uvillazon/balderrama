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
import com.google.gwt.user.client.ui.TabPanel;
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
import org.balderrama.client.MainEntryPoint;
import org.balderrama.client.marca.EditarMarcaForm;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
//import org.selkis.client.util.Utils;

/**
 *
 * @author Administrador
 */
public class Empleado extends Panel {

    private GridPanel grid;
    private ColumnConfig nombreColumn;
    private ColumnConfig ciudadColumn;
    private final int ANCHO = Utils.getScreenWidth() - 24;
    private final int ALTO = Utils.getScreenHeight() - 270;
    private ToolbarButton nuevoEmpleado;
    private ToolbarButton editarEmpleado;
    private ToolbarButton elminarEmpleado;
    private ToolbarButton reporteEmpleado;
        private ToolbarButton marcasEm;
    private ToolbarButton BajaEmpleado;
    private EditarEmpleadoForm formulario;
     private EditarEmpleadoEstado formularioEstado;
      private EditarMarcaEmpleado formulario1;
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
    private ColumnConfig apellidoColumn;
    private ColumnConfig telefonoColumn;
    private ColumnConfig emailColumn;
    private ColumnConfig webColumn;
    private ColumnConfig tipoEmColumn;
    private ColumnConfig celularColumn;
    private ColumnConfig estadoColumn;
 public TabPanel tap_panel;
    public KMenu kmenu;
    public MainEntryPoint pan;

    public Empleado(KMenu kmenu, MainEntryPoint panel) {
     this.kmenu = kmenu;
        this.pan = panel;
        this.setClosable(true);
        this.setId("TPfun1012");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Empleados");
        onModuleLoad();
    }

    public void onModuleLoad() {

        DataProxy dataProxy = new ScriptTagProxy("php/Empleado.php?funcion=ListarEmpleados");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idempleado"),
                    new StringFieldDef("codigo"),
                    new StringFieldDef("nombres"),
                    new StringFieldDef("apellidos"),
                    new StringFieldDef("tipoempleado"),
                   new StringFieldDef("telefeno"),
                    new StringFieldDef("direccion"),
                    new StringFieldDef("estado"),
                    new StringFieldDef("ciudad")
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");

        store = new Store(dataProxy, reader, true);

        idColumn = new ColumnConfig("Id Empleado", "idempleado", (ANCHO / 7) - 50, true);
// fechaColumn = new ColumnConfig("Fecha", "fecha", 90, false);
        codigoColumn = new ColumnConfig("Codigo", "codigo", 100, true);

        nombColumn = new ColumnConfig("Nombres", "nombres", 120, true);
        apellidoColumn = new ColumnConfig("Apellidos", "apellidos", 120, true);
        tipoEmColumn = new ColumnConfig("Cargo", "tipoempleado", 100, true);
        telefonoColumn = new ColumnConfig("Telefono", "telefeno", 70, true);
        celularColumn = new ColumnConfig("Celular", "celular", 70, true);
        estadoColumn = new ColumnConfig("Estado", "estado", 100, true);
        ciudadColumn = new ColumnConfig("Ciudad", "ciudad", 120, true);
ciudadColumn.setId("expandible");
        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    nombColumn,
                    apellidoColumn,
                    tipoEmColumn,
                    telefonoColumn,
                    celularColumn,
                    estadoColumn,
                    ciudadColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-Empleados");
        grid.setWidth(ANCHO);
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Empleados");
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


                selecionado = records[0].getAsString("idempleado");
                String enlTemp = "funcion=reporteempleadoHTML&idempleado=" + selecionado;
                verReporte(enlTemp);
//                    Window.alert(enlTemp);
            }
        });

//        grid.a


        nuevoEmpleado = new ToolbarButton("Nuevo Empleado");
        nuevoEmpleado.setEnableToggle(true);
        QuickTipsConfig tipsConfig1 = new QuickTipsConfig();
        tipsConfig1.setText("Crear nuevo Empleado");

        nuevoEmpleado.setTooltip(tipsConfig1);

        editarEmpleado = new ToolbarButton("Editar Empleado");
        editarEmpleado.setEnableToggle(true);
        QuickTipsConfig tipsConfig = new QuickTipsConfig();
        tipsConfig.setText("Editar Datos Empleado");
        editarEmpleado.setTooltip(tipsConfig);


        elminarEmpleado = new ToolbarButton("Eliminar");
        elminarEmpleado.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Eliminar Empleado");
        elminarEmpleado.setTooltip(tipsConfig2);

        reporteEmpleado = new ToolbarButton("Reporte");
        reporteEmpleado.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Reporte(es)");

        reporteEmpleado.setTooltip(tipsConfig3);

 marcasEm = new ToolbarButton("Editar/Asignar Marcas");
        marcasEm.setEnableToggle(true);
        QuickTipsConfig tipsConfig31 = new QuickTipsConfig();
        tipsConfig31.setText("Marcas");

        marcasEm.setTooltip(tipsConfig31);


        BajaEmpleado = new ToolbarButton("Baja Empleado");
        BajaEmpleado.setEnableToggle(true);
        QuickTipsConfig tipsConfig4 = new QuickTipsConfig();
        tipsConfig4.setText("dar de baja a Empleado");
        BajaEmpleado.setTooltip(tipsConfig4);

        PagingToolbar pagingToolbar = new PagingToolbar(store);

        pagingToolbar.setPageSize(100);

        pagingToolbar.setDisplayInfo(true);

        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");

        pagingToolbar.setEmptyMsg("No topics to display");

        pagingToolbar.addSeparator();

        pagingToolbar.addButton(nuevoEmpleado);

        pagingToolbar.addSeparator();

        pagingToolbar.addButton(editarEmpleado);

        pagingToolbar.addSeparator();

        pagingToolbar.addButton(elminarEmpleado);

        pagingToolbar.addSeparator();

        pagingToolbar.addButton(reporteEmpleado);

        pagingToolbar.addSeparator();
          pagingToolbar.addButton(marcasEm);

        pagingToolbar.addSeparator();

        pagingToolbar.addButton(BajaEmpleado);

        pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);

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

    private void cargarDatosNuevoEmpleado() {
        String enlace = "php/Empleado.php?funcion=CargarNuevoEmpleado";
        Utils.setErrorPrincipal("Cargando parametros", "cargar");
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
                                    Object[][] Cargos = Utils.getArrayOfJSONObject(marcaO, "cargoM", new String[]{"idtipoempleado", "nombre", "codigo"});
                                 formulario = null;
//                                    MessageBox.alert("Envio parametros");
                                formulario = new EditarEmpleadoForm(null, "", "", "", "", "", "", "", "", "", null,"", Cargos, ciudades,Empleado.this);
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

    private void cargarDatosEditarEmpleado(String idempleado) {
        String enlace = "php/Empleado.php?funcion=CargarDatosEditarEmpleado&idempleado=" + idempleado;
        Utils.setErrorPrincipal("Cargando parametros...", "cargar");
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
                                String idempleado = Utils.getStringOfJSONObject(productoO, "idempleado");
                                String codigo = Utils.getStringOfJSONObject(productoO, "codigo");
                                String nombre = Utils.getStringOfJSONObject(productoO, "nombres");
                                String apellido = Utils.getStringOfJSONObject(productoO, "apellidos");
                                String ciudad = Utils.getStringOfJSONObject(productoO, "idciudad");
                                String telefono = Utils.getStringOfJSONObject(productoO, "telefeno");
                                String celular = Utils.getStringOfJSONObject(productoO, "celular");
                                String direccion = Utils.getStringOfJSONObject(productoO, "direccion");
                                String tipoempleado = Utils.getStringOfJSONObject(productoO, "idtipoempleado");
                                String email = Utils.getStringOfJSONObject(productoO, "email");
                                String estado = Utils.getStringOfJSONObject(productoO, "fechainicio");
                                String nombretienda = Utils.getStringOfJSONObject(productoO, "nombretienda");
                                Object[][] almacenes = Utils.getArrayOfJSONObject(productoO, "ciudadM", new String[]{"idciudad", "nombre"});
                                Object[][] Cargos = Utils.getArrayOfJSONObject(productoO, "cargoM", new String[]{"idtipoempleado", "nombre", "codigo"});

                                formulario = null;
                                formulario = new EditarEmpleadoForm(idempleado, codigo, nombre, apellido, ciudad, telefono, celular, direccion, tipoempleado, email, estado, nombretienda,Cargos, almacenes,Empleado.this);
//                                formulario = new EditarEmpleadoForm(null, "", "", "", "", "", "", "", "", "", null, almacenes, Empleado.this);
                                formulario.show();
                            } else {
                                Utils.setErrorPrincipal("Error en el objeto ", "error");
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
 private void cargarDatosEditarEstado(String idempleado) {
        String enlace = "php/Empleado.php?funcion=CargarDatosEditarEmpleado&idempleado=" + idempleado;
        Utils.setErrorPrincipal("Cargando parametros...", "cargar");
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
                                String idempleado = Utils.getStringOfJSONObject(productoO, "idempleado");
                                String estado = Utils.getStringOfJSONObject(productoO, "estado");

                                formularioEstado = null;
                                formularioEstado = new EditarEmpleadoEstado(idempleado,estado,Empleado.this);
//formularioEstado = new EditarEmpleadoEstado(idempleado, codigo, nombre, apellido, ciudad, telefono, celular, direccion, tipoempleado, email, estado, nombretienda,Cargos, almacenes,Empleado.this);

                                formularioEstado.show();
                            } else {
                                Utils.setErrorPrincipal("Error en el objeto ", "error");
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

        elminarEmpleado.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idempleado");
                    MessageBox.confirm("Eliminar Empleado", "Realmente desea eliminar este Empleado??", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                //eliminar
                               // String enlace = "php/Proveedor.php?funcion=EliminarProveedor&idproveedor=" + selecionado;
                                String enlace = "php/Empleado.php?funcion=EliminarEmpleado&idempleado=" + selecionado;

                                Utils.setErrorPrincipal("Eliminando el Empleado", "cargar");
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
                elminarEmpleado.setPressed(false);
            }
        });
        nuevoEmpleado.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                cargarDatosNuevoEmpleado();
            }
        });
        editarEmpleado.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    String idempleado = records[0].getAsString("idempleado");
                    cargarDatosEditarEmpleado(idempleado);
                } else {
                    Utils.setErrorPrincipal("Por favor seleccione un vendedor para editar", "error");
                }

            }
        });


           BajaEmpleado.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    String idempleado = records[0].getAsString("idempleado");
                   cargarDatosEditarEstado(idempleado);
                } else {
                    Utils.setErrorPrincipal("Por favor seleccione un vendedor para cambiar estado ", "error");
                }

            }
        });
        reporteEmpleado.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();

                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idempleado");
                            String enlTemp = "funcion=reporteempleadoHTML&idempleado=" + selecionado;
                            verReporte(enlTemp);

                        } else {
                            MessageBox.alert("No hay empleado selecionado para ver el reporte.");
                        }

                        reporteEmpleado.setPressed(false);
                    }
                });


            marcasEm.addListener(
             new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idempleado = records[0].getAsString("idempleado");
                              String nombres = records[0].getAsString("nombres");

                            EditarMarcaEmpleado conficolor = new EditarMarcaEmpleado(Empleado.this, idempleado,nombres);
                            kmenu.seleccionarOpcion(null, "fun110200", e, conficolor);
                        } else {

                            Utils.setErrorPrincipal("Por favor seleccione una Marca para configurar", "error");
                        }

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
}


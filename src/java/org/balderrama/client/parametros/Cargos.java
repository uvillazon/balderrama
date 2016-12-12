/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.parametros;

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

/**
 *
 * @author miguel
 */
public class Cargos extends Panel {

    private GridPanel grid;
    private ColumnConfig nombreColumn;
    private ColumnConfig codigoColumn;
    private final int ANCHO = Utils.getScreenWidth() - 24;
    private final int ALTO = Utils.getScreenHeight() - 270;
    private ToolbarButton nuevoCargo;
    private ToolbarButton editarCargo;
    private ToolbarButton eliminarCargo;
     private ToolbarButton forzartraspaso;
    private ToolbarButton forzarventa;
        private ToolbarButton forzarventa1;
    private ToolbarButton actualizarColor;
    private CargoNuevoForm formulario;
    protected ExtElement ext_element;
    private JsonReader reader;
    private CheckboxSelectionModel cbSelectionModel;
    private Store store;
    private String selecionado;
    private BaseColumnConfig[] columns;
    private ColumnModel columnModel;
    private ColumnConfig idColorColumn;
    private ColumnConfig codigoCargoColumn;
    private ColumnConfig nombreCargoColumn;
    private ColumnConfig idColumn;

    public Cargos() {
        this.setClosable(true);
        this.setId("TPfun1013");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Cargos");
        onModuleLoad();
    }

    public void onModuleLoad() {

        DataProxy dataProxy = new ScriptTagProxy("php/Cargo.php?funcion=ListarCargo");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idtipoempleado"),
                    new StringFieldDef("nombre"),
                    new StringFieldDef("codigo"),});
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");

        store = new Store(dataProxy, reader, true);

        /* columnade idusuario  */

        /* columnade nombre  */
        idColumn = new ColumnConfig("tipo empleado", "idtipoempleado", (ANCHO / 7) - 50, true);
//        idColumn.setId("expandible");
        codigoCargoColumn = new ColumnConfig("Codigo", "codigo", 200, true);
        nombreCargoColumn = new ColumnConfig("Nombre", "nombre", (ANCHO / 2), true);
        nombreCargoColumn.setId("expandible");



        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    //column ID is company which is later used in setAutoExpandColumn
                    //                                        idColumn,
                    //                    idColorColumn,
                    codigoCargoColumn,
                    nombreCargoColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-Cargos");
        grid.setWidth(ANCHO);
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Cargos");
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
                Window.alert("En contruccion: aqui saldra la informacion del rol en detalle");
            /*Record[] records = cbSelectionModel.getSelections();


            selecionado = records[0].getAsString("idcolor");
            String enlTemp = "funcion=reporteproveedorHTML&idproveedor=" + selecionado;
            verReporte(enlTemp);*/
            }
        });

//        grid.a


        nuevoCargo = new ToolbarButton("Nuevo");
        nuevoCargo.setEnableToggle(true);
        QuickTipsConfig tipsConfig1 = new QuickTipsConfig();
        tipsConfig1.setText("Crear nuevo Cargo");
        nuevoCargo.setTooltip(tipsConfig1);

        editarCargo = new ToolbarButton("Editar");
        editarCargo.setEnableToggle(true);
        QuickTipsConfig tipsConfig = new QuickTipsConfig();
        tipsConfig.setText("Editar Cargo");
        editarCargo.setTooltip(tipsConfig);

        eliminarCargo = new ToolbarButton("Eliminar");
        eliminarCargo.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Eliminar Cargo");
        eliminarCargo.setTooltip(tipsConfig2);


        forzarventa = new ToolbarButton("FORZAR VENTA");
        forzarventa.setEnableToggle(true);
        QuickTipsConfig tipsConfig22 = new QuickTipsConfig();
        tipsConfig22.setText("FORZAR VENTA");
        forzarventa.setTooltip(tipsConfig22);

         forzarventa1 = new ToolbarButton("FORZAR REGISTRO");
        forzarventa1.setEnableToggle(true);
        QuickTipsConfig tipsConfig221 = new QuickTipsConfig();
        tipsConfig221.setText("FORZAR VENTA");
        forzarventa1.setTooltip(tipsConfig221);


         forzartraspaso = new ToolbarButton("FORZAR TRASPASO");
        forzartraspaso.setEnableToggle(true);
        QuickTipsConfig tipsConfig223 = new QuickTipsConfig();
        tipsConfig223.setText("FORZAR TRASPASO");
        forzartraspaso.setTooltip(tipsConfig223);

        PagingToolbar pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(nuevoCargo);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(editarCargo);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarCargo);
        pagingToolbar.addSeparator();
         pagingToolbar.addButton(forzarventa);
        pagingToolbar.addSeparator();
          pagingToolbar.addButton(forzarventa1);
        pagingToolbar.addSeparator();
         pagingToolbar.addButton(forzartraspaso);
        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(actualizarColor);
//        pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);

        add(grid);
        //panel.add(grid);
        aniadirListenersColor();

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


    private void cargarDatosNuevoCargo() {

        formulario = null;
        formulario = new CargoNuevoForm(null, "", "", Cargos.this);
        formulario.show();

    }
    // private void cargarDatosNuevoforza() {
public void cargarDatosNuevoforza(){

  // public void createCompra(String pagop) {

     //  final String planilla = tex_monto.getValueAsString();
                    JSONObject usuarioSoU = new JSONObject();
                    String estado="libre";
                    usuarioSoU.put("estado", new JSONString(estado));
                    String datos = "resultado=" + usuarioSoU.toString();
                   //  String enlace = "php/Planilla.php?funcion=Registraremisionplanilla&" + datos;
                       String enlace = "./php/VentaMayor.php?funcion=txSaveestado&" + datos;

                   //  Utils.setErrorPrincipal("Habilitando venta", "cargar");
                    final Conector conec = new Conector(enlace, false, "POST");
                    try {
                        conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {
                            public void onResponseReceived(Request request, Response response) {
                                String data = response.getText();
                                JSONValue jsonValue = JSONParser.parse(data);
                                JSONObject jsonObject;
                                if ((jsonObject = jsonValue.isObject()) != null) {
                                    String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                    String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                    if (errorR.equalsIgnoreCase("true")) {
                                       // padre.buscarSegunParametros();
                                    //       validarsaldoplanilla(e,pagop,montopendiente,tipoempresanueva);
 MessageBox.alert("Habilitado correctamente");
           store.reload();
                                    } else {
                                  MessageBox.alert("Existen un error ");
                                  //      Utils.setErrorPrincipal(mensajeR, "mensaje");
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

public void cargarDatosNuevoforzatraspaso(){

  // public void createCompra(String pagop) {
                    JSONObject usuarioSoU = new JSONObject();
                    String estado="libre";
                    usuarioSoU.put("estado", new JSONString(estado));
                    String datos = "resultado=" + usuarioSoU.toString();
                    String enlace = "./php/VentaMayor.php?funcion=txSaveestadotraspaso&" + datos;

                    final Conector conec = new Conector(enlace, false, "POST");
                    try {
                        conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {
                            public void onResponseReceived(Request request, Response response) {
                                String data = response.getText();
                                JSONValue jsonValue = JSONParser.parse(data);
                                JSONObject jsonObject;
                                if ((jsonObject = jsonValue.isObject()) != null) {
                                    String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                    String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                    if (errorR.equalsIgnoreCase("true")) {
                                      MessageBox.alert("Traspaso Habilitado correctamente");
                                      store.reload();
                                    } else {
                                  MessageBox.alert("Existen un error ");
                                  //      Utils.setErrorPrincipal(mensajeR, "mensaje");
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

public void cargarDatosNuevoforza1(){

                  JSONObject usuarioSoU = new JSONObject();
                    String estado="libre";
                    usuarioSoU.put("estado", new JSONString(estado));
                    String datos = "resultado=" + usuarioSoU.toString();
                   //  String enlace = "php/Planilla.php?funcion=Registraremisionplanilla&" + datos;
                       String enlace = "./php/VentaMayor.php?funcion=txSaveestado1&" + datos;

                   //  Utils.setErrorPrincipal("Habilitando venta", "cargar");
                    final Conector conec = new Conector(enlace, false, "POST");
                    try {
                        conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {
                            public void onResponseReceived(Request request, Response response) {
                                String data = response.getText();
                                JSONValue jsonValue = JSONParser.parse(data);
                                JSONObject jsonObject;
                                if ((jsonObject = jsonValue.isObject()) != null) {
                                    String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                    String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                    if (errorR.equalsIgnoreCase("true")) {
                                       // padre.buscarSegunParametros();
                                    //       validarsaldoplanilla(e,pagop,montopendiente,tipoempresanueva);
 MessageBox.alert("Habilitado correctamente");
           store.reload();
                                    } else {
                                  MessageBox.alert("Existen un error ");
                                  //      Utils.setErrorPrincipal(mensajeR, "mensaje");
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

    //**************************************************
    //***********EDITAR ROL
    //**************************************************

    private void cargarDatosEditarColor(String idcargo) {
        String enlace = "php/Cargo.php?funcion=CargarDatosCargoPorId&idcargo=" + idcargo;
        Utils.setErrorPrincipal("Cargando parametros para Color", "cargar");
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
                                String idcolor = Utils.getStringOfJSONObject(productoO, "idtipoempleado");
                                String codigo = Utils.getStringOfJSONObject(productoO, "codigo");
                                String nombre = Utils.getStringOfJSONObject(productoO, "nombre");
                          

                                formulario = null;
                                formulario = new CargoNuevoForm(idcolor,codigo,nombre,Cargos.this);
                                formulario.show();
                            } else {
                                Utils.setErrorPrincipal("Error en el objeto color", "error");
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

    private void aniadirListenersColor() {
        //**************************************************
        //***********ELIMINAR ROL
        //**************************************************

        eliminarCargo.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idtipoempleado");
                    MessageBox.confirm("Eliminar...", "Realmente desea eliminar??", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                //eliminar
                                String enlace = "php/Cargo.php?funcion=EliminarCargo&idcargo=" + selecionado;
                                Utils.setErrorPrincipal("Eliminando...", "cargar");
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
                eliminarCargo.setPressed(false);
            }
        });
        nuevoCargo.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                cargarDatosNuevoCargo();
            }
        });
        editarCargo.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    String idcargo = records[0].getAsString("idtipoempleado");
                    cargarDatosEditarColor(idcargo);
                } else {
                    Utils.setErrorPrincipal("Por favor seleccione un cargo para editar", "error");
                }

            }
        });
       
 forzarventa.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                cargarDatosNuevoforza();
            }
        });

 forzartraspaso.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                cargarDatosNuevoforzatraspaso();
            }
        });

 forzarventa1.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                cargarDatosNuevoforza1();
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
}


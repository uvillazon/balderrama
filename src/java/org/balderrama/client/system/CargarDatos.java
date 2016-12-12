/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.system;

import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.ui.ClickListener;
import com.google.gwt.user.client.ui.FileUpload;
import com.google.gwt.user.client.ui.FormHandler;
import com.google.gwt.user.client.ui.FormPanel;
import com.google.gwt.user.client.ui.FormSubmitCompleteEvent;
import com.google.gwt.user.client.ui.FormSubmitEvent;
import com.google.gwt.user.client.ui.HorizontalPanel;
import com.google.gwt.user.client.ui.Widget;
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
import com.gwtext.client.data.Record;
import com.gwtext.client.data.RecordDef;
import com.gwtext.client.data.ScriptTagProxy;
import com.gwtext.client.data.Store;
import com.gwtext.client.data.StringFieldDef;
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
import com.gwtext.client.core.TextAlign;
import com.gwtext.client.core.UrlParam;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.widgets.layout.FitLayout;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;

/**
 *
 * @author Haydee
 */
public class CargarDatos extends Panel {

    private final int ANCHO = Utils.getScreenWidth() - 24;
    private final int ALTO = Utils.getScreenHeight() - 270;
    private FileUpload cargarCD;
    protected ExtElement ext_elementCD;
    private GridPanel gridCD;
    private ColumnConfig nombreColumnCD;
    private ColumnConfig tamanoColumnCD;
    private ColumnConfig fechaColumnCD;
    private ColumnConfig horaColumnCD;
    private ToolbarButton eliminarArchivosCD;
    private ToolbarButton vistaPreviaArchivosCD;
    private ToolbarButton cargarProductoArchivosCD;
    private ToolbarButton cargarClienteArchivosCD;
    private ToolbarButton cargarProveedoresArchivosCD;
    private ToolbarButton actualizarProductosAchivosCD;
    private ToolbarButton cargarCaracteristicasCD;
    private CheckboxSelectionModel cbSelectionModelCD;
    private Store storeCD;
    private BaseColumnConfig[] columnsCD;
    private ColumnModel columnModelCD;
    private DataProxy dataProxyCD;
    private JsonReader readerCD;
    PagingToolbar pagingToolbarCD;
    String selecionadoCD = "";
    private Panel panel;

    public CargarDatos() {
        this.setClosable(true);
        this.setId("TPfun1008");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Archivos");
        onModuleLoad();
    }

    public void onModuleLoad() {

        panel = new Panel();
        panel.setId("MediaCartaChorroWindow");
        panel.setBorder(false);
        panel.setPaddings(15);
        panel.setLayout(new FitLayout());
        panel.setAutoHeight(true);
        panel.setAutoScroll(true);

        final FormPanel form = new FormPanel();
        form.setEncoding(FormPanel.ENCODING_MULTIPART);
        form.setMethod(FormPanel.METHOD_POST);
        form.setAction("php/CargarDatos.php");
        form.addStyleName("table-center");
        form.addStyleName("demo-panel-padded");
        form.setWidth("275px");

        HorizontalPanel holder = new HorizontalPanel();

        FileUpload upload = new FileUpload();
        upload.setName("file");
        holder.add(upload);
        holder.add(new Button("Cargar", new ClickListener() {

            public void onClick(Widget sender) {
                form.submit();
            }
        }));

        form.add(holder);
        form.addFormHandler(new FormHandler() {

            public void onSubmit(FormSubmitEvent event) {

                Utils.setErrorPrincipal("Cargando el archivo", "cargar");
            }

            public void onSubmitComplete(FormSubmitCompleteEvent event) {
                Utils.setErrorPrincipal(event.getResults(), "mensaje");
                storeCD.reload(new UrlParam[]{new UrlParam("start", 0), new UrlParam("limit", 100)});
            }
        });

        add(form);


        dataProxyCD = new ScriptTagProxy("php/CargarDatosListar.php?function=findAllFiles");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("nombre"),
                    new StringFieldDef("tamano"),
                    new StringFieldDef("fecha"),
                    new StringFieldDef("hora")
                });
        readerCD = new JsonReader(recordDef);
        readerCD.setRoot("resultado");
        readerCD.setTotalProperty("totalCount");

        storeCD = new Store(dataProxyCD, readerCD, true);
        //chanchadita(store);

        /* columnade loggin  */
        nombreColumnCD = new ColumnConfig("Nombre", "nombre", 600);
        /* columnade ci  */
        tamanoColumnCD = new ColumnConfig("Tamano", "tamano", 100);
        tamanoColumnCD.setAlign(TextAlign.RIGHT);
        /* columnade nombre  */
        fechaColumnCD = new ColumnConfig("Fecha", "fecha", 110, true);
        fechaColumnCD.setAlign(TextAlign.RIGHT);
        horaColumnCD = new ColumnConfig("Hora", "hora", 110, true);
        horaColumnCD.setAlign(TextAlign.RIGHT);

        cbSelectionModelCD = new CheckboxSelectionModel();
        columnsCD = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModelCD),
                    nombreColumnCD,
                    tamanoColumnCD,
                    fechaColumnCD,
                    horaColumnCD
                };

        columnModelCD = new ColumnModel(columnsCD);

        gridCD = new EditorGridPanel();
        gridCD.setId("grid-lista-CD");

        gridCD.setTitle("Lista de Archivos");
        gridCD.setStore(storeCD);
        gridCD.setColumnModel(columnModelCD);
        gridCD.setTrackMouseOver(true);
        gridCD.setLoadMask(true);
        gridCD.setSelectionModel(cbSelectionModelCD);
        gridCD.setFrame(true);
        gridCD.setStripeRows(true);
        gridCD.setIconCls("grid-icon");

        eliminarArchivosCD = new ToolbarButton("Eliminar");
        eliminarArchivosCD.setEnableToggle(true);
        eliminarArchivosCD.setTitle("Eliminar archivos");

        vistaPreviaArchivosCD = new ToolbarButton("Vista Previa");
        vistaPreviaArchivosCD.setEnableToggle(true);
        vistaPreviaArchivosCD.setTitle("Vista Previa");

        cargarProductoArchivosCD = new ToolbarButton("Cargar colores");
        cargarProductoArchivosCD.setEnableToggle(true);
        cargarProductoArchivosCD.setTitle("Cargar colores");

        cargarClienteArchivosCD = new ToolbarButton("Cargar material");
        cargarClienteArchivosCD.setEnableToggle(true);
        cargarClienteArchivosCD.setTitle("Cargar material");

        cargarProveedoresArchivosCD = new ToolbarButton("Cargar modelos");
        cargarProveedoresArchivosCD.setEnableToggle(true);
        cargarProveedoresArchivosCD.setTitle("Cargar modelos");

        actualizarProductosAchivosCD = new ToolbarButton("cargar calzados");
        actualizarProductosAchivosCD.setEnableToggle(true);
        actualizarProductosAchivosCD.setTitle("cargar calzados");

        cargarCaracteristicasCD = new ToolbarButton("Actualizar calzados");
        cargarCaracteristicasCD.setEnableToggle(true);
        cargarCaracteristicasCD.setTitle("Cargar y actualizar datos de calzados");

        pagingToolbarCD = new PagingToolbar(storeCD);
        pagingToolbarCD.setPageSize(100);
        pagingToolbarCD.setDisplayInfo(true);
        pagingToolbarCD.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbarCD.setEmptyMsg("No topics to display");
        pagingToolbarCD.addSeparator();
        pagingToolbarCD.addButton(eliminarArchivosCD);
        pagingToolbarCD.addButton(vistaPreviaArchivosCD);
        pagingToolbarCD.addButton(cargarProductoArchivosCD);
        pagingToolbarCD.addButton(actualizarProductosAchivosCD);
        pagingToolbarCD.addButton(cargarClienteArchivosCD);
        pagingToolbarCD.addButton(cargarProveedoresArchivosCD);
        pagingToolbarCD.addButton(cargarCaracteristicasCD);

        gridCD.setBottomToolbar(pagingToolbarCD);
        add(gridCD);
        aniadirListenersUsuario();
        gridCD.setWidth(ANCHO);
        gridCD.setHeight(ALTO);

        add(panel);
    }

    private void aniadirListenersUsuario() {
        //**************************************************
        //***********ELIMINAR USUARIO
        //**************************************************
        eliminarArchivosCD.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(com.gwtext.client.widgets.Button button, EventObject e) {
                Record[] records = cbSelectionModelCD.getSelections();
                if (records.length == 1) {
                    selecionadoCD = records[0].getAsString("nombre");
                    MessageBox.confirm("Eliminar Usuario", "Realmente desea eliminar el archivo??", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                String enlace = "php/dao/CargarDatosEliminar.php?function=txDeleteCargarDatos&file=" + selecionadoCD;
                                Utils.setErrorPrincipal("Eliminando el archivo", "cargar");
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

                                                } else {
                                                    Utils.setErrorPrincipal(mensajeR, "error");
                                                }
                                                storeCD.reload(new UrlParam[]{new UrlParam("start", 0), new UrlParam("limit", 100)}, false);
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
                        }
                    });
                } else {
                    Utils.setErrorPrincipal("No hay usuario selecionado para eliminar o selecciono mas de uno.", "error");
                }
                eliminarArchivosCD.setPressed(false);
            }
        });
        gridCD.addListener(
                new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        storeCD.load(0, 100);
                    }
                });
        gridCD.addGridCellListener(new GridCellListenerAdapter() {

            @Override
            public void onCellClick(GridPanel grid, int rowIndex, int colIndex, EventObject e) {
                if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor")) {
                    Record record = grid.getStore().getAt(rowIndex);
                    record.set("indoor", !record.getAsBoolean("indoor"));
                }

            }
        });
        vistaPreviaArchivosCD.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(com.gwtext.client.widgets.Button button, EventObject e) {
                Record[] records = cbSelectionModelCD.getSelections();
                if (records.length == 1) {
                    String selecionado = records[0].getAsString("nombre");
                    verReporte(selecionado);
                } else {
                    Utils.setErrorPrincipal("Por favor seleccione solo un archivo", "error");
                }
                vistaPreviaArchivosCD.setPressed(false);
            }
        });
        cargarProductoArchivosCD.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(com.gwtext.client.widgets.Button button, EventObject e) {
                Record[] records = cbSelectionModelCD.getSelections();
                if (records.length == 1) {
                    String selecionado = records[0].getAsString("nombre");
                    cargarProductos(selecionado);
                } else {
                    Utils.setErrorPrincipal("Por favor seleccione solo un archivo", "error");
                }
                cargarProductoArchivosCD.setPressed(false);
            }
        });
        cargarClienteArchivosCD.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(com.gwtext.client.widgets.Button button, EventObject e) {
                Record[] records = cbSelectionModelCD.getSelections();
                if (records.length == 1) {
                    String selecionado = records[0].getAsString("nombre");
                    cargarClientes(selecionado);
                } else {
                    Utils.setErrorPrincipal("Por favor seleccione solo un archivo", "error");
                }
                cargarClienteArchivosCD.setPressed(false);
            }
        });
        cargarProveedoresArchivosCD.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(com.gwtext.client.widgets.Button button, EventObject e) {
                Record[] records = cbSelectionModelCD.getSelections();
                if (records.length == 1) {
                    String selecionado = records[0].getAsString("nombre");
                    cargarProveedores(selecionado);
                } else {
                    Utils.setErrorPrincipal("Por favor seleccione solo un archivo", "error");
                }
                cargarProveedoresArchivosCD.setPressed(false);
            }
        });
        actualizarProductosAchivosCD.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(com.gwtext.client.widgets.Button button, EventObject e) {
                Record[] records = cbSelectionModelCD.getSelections();
                if (records.length == 1) {
                    String selecionado = records[0].getAsString("nombre");
                    actualizarProductos(selecionado);
                } else {
                    Utils.setErrorPrincipal("Por favor seleccione solo un archivo", "error");
                }
                actualizarProductosAchivosCD.setPressed(false);
            }
        });
        cargarCaracteristicasCD.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(com.gwtext.client.widgets.Button button, EventObject e) {
                Record[] records = cbSelectionModelCD.getSelections();
                if (records.length == 1) {
                    String selecionado = records[0].getAsString("nombre");
                    actualizarCaracteristicas(selecionado);
                } else {
                    Utils.setErrorPrincipal("Por favor seleccione solo un archivo", "error");
                }
                cargarCaracteristicasCD.setPressed(false);
            }
        });
    }

    private void verReporte(String enlace) {
        String enlaceReporte = "php/dao/CargarDatosListar.php?function=findVistaPrevia&file=" + enlace;
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlaceReporte, true);
        print.show();
    }

    private void cargarProductos(String enlace) {
        String enlaceReporte = "php/CargarColoresCategoriasSubcategorias.php?function=findVistaPrevia&file=" + enlace;
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlaceReporte, true);
        print.show();
    }

    private void actualizarProductos(String enlace) {
        String enlaceReporte = "php/dao/CargarActualizarProductos.php?function=findVistaPrevia&file=" + enlace;
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlaceReporte, true);
        print.show();
    }

    private void actualizarCaracteristicas(String enlace) {
        String enlaceReporte = "php/dao/CargarActualizarCaracteristicas.php?function=findVistaPrevia&file=" + enlace;
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlaceReporte, true);
        print.show();
    }

    private void cargarClientes(String enlace) {
        String enlaceReporte = "php/dao/CargarClientesFromXLS.php?function=findVistaPrevia&file=" + enlace;
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlaceReporte, true);
        print.show();
    }

    private void cargarProveedores(String enlace) {
        String enlaceReporte = "php/dao/CargarProveedoresFromXLS.php?function=findVistaPrevia&file=" + enlace;
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlaceReporte, true);
        print.show();
    }
}

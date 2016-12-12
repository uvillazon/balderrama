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
import com.gwtext.client.util.Format;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.Store;
import com.gwtext.client.util.Format;
import com.gwtext.client.widgets.QuickTips;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import org.balderrama.client.util.Conector;
import com.gwtext.client.widgets.form.Checkbox;
import com.gwtext.client.widgets.grid.CellMetadata;
import com.gwtext.client.widgets.grid.Renderer;
import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;
import org.balderrama.client.marca.Marca;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;

/**
 *
 * @author buggy
 */
public class EditarMarcaEmpleado extends Panel {

    private GridPanel grid;
    private ColumnConfig idColumn;
    private ColumnConfig id2Column;
    private ColumnConfig codigoColumn;
    private ColumnConfig nombreColumn;
    private ColumnConfig descripcionColumn;
    private final int ANCHO = Utils.getScreenWidth() - 24;
    private final int ALTO = Utils.getScreenHeight() - 270;
    private ToolbarButton editarmaterial;
//    private ToolbarButton eliminarmaterial;
    private ToolbarButton nuevomaterial;
    private String idempleado;
    private String nombrem;
    private NuevoMarcaEmpleadoForm formulario;
    private NuevoMarcaEmpleadoEstado formulario2;
    private ToolbarButton reporteMaterial;
    private ToolbarButton codlineaMarca;
    private ToolbarButton codcolorMarca;
    private ToolbarButton codmaterialMarca;
    private ToolbarButton configurarMarca;
    private ToolbarButton cargarimagenMarca;
    // private EditarMarcaForm formulario;
    protected ExtElement ext_element;
    CheckboxSelectionModel cbSelectionModel;
    Store store;
    private String selecionado;
    private BaseColumnConfig[] columns;
    ColumnModel columnModel;

    public EditarMarcaEmpleado() {
        this.setClosable(true);
        this.setId("TPfun110200");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Lista ");
        onModuleLoad();
    }

//formulario = new EditarMarcaEmpleado(idmaterial, codigo, nombre, descripcion,  Empleado.this);
    public EditarMarcaEmpleado( Empleado mar,String idempleado,String nombres) {
        this.setClosable(true);
        this.setId("TPfun110200" + idempleado);
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle(""+ nombres);
        this.idempleado = idempleado;
        onModuleLoad();

    }

  

    public void onModuleLoad() {

        DataProxy dataProxy = new ScriptTagProxy("php/Empleado.php?funcion=ListarEmpleadoMarca&idempleado="+idempleado);
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idempleado"),
                    new StringFieldDef("idmarca"),
                    new StringFieldDef("marca"),
                    new StringFieldDef("estado")
       
                });
        JsonReader reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");

        store = new Store(dataProxy, reader, true);

        /* columnade idusuario  */
        idColumn = new ColumnConfig("Idmarca", "idmarca", 200, true);
        id2Column = new ColumnConfig("Idempleado", "idempleado",200, true);
//        idColumn.setId("expandible");
        /* columnade nombre  */
        codigoColumn = new ColumnConfig("Marca", "marca", 400, true);

        nombreColumn = new ColumnConfig("Estado", "estado", 200, true);
        nombreColumn.setId("expandible");


        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    //column ID is company which is later used in setAutoExpandColumn
                    codigoColumn,
                    nombreColumn,
            //        descripcionColumn //                    cateoriaColumn,
                //                    proveedorColumn,
                };
        columnModel = new ColumnModel(columns);
        grid = new EditorGridPanel();


        grid.setId("grid-lista-Material-2" + idempleado);

        grid.setWidth(ANCHO);

        grid.setHeight(ALTO);

        grid.setTitle("Lista de Marcas " + nombrem);

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
                selecionado = records[0].getAsString("idmaterial");
                String enlTemp = "funcion=reportematerialHTML&idmaterial=" + selecionado;
                verReporte(enlTemp);
//                    Window.alert(enlTemp);
            }
        });

//        grid.a


        nuevomaterial = new ToolbarButton("Nuevo");

        nuevomaterial.setEnableToggle(true);
        QuickTipsConfig tipsConfig1 = new QuickTipsConfig();

        tipsConfig1.setText("Crear nueva marca asignada");

        nuevomaterial.setTooltip(tipsConfig1);
        editarmaterial = new ToolbarButton("Editar estado marca");

        editarmaterial.setEnableToggle(true);
        QuickTipsConfig tipsConfig = new QuickTipsConfig();

        tipsConfig.setText("Editar l");

        editarmaterial.setTooltip(tipsConfig);
//        eliminarmaterial = new ToolbarButton("Eliminar");
//
//        eliminarmaterial.setEnableToggle(true);
//        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
//
//        tipsConfig2.setText("Eliminar Materiales(s)");
//
//        eliminarmaterial.setTooltip(tipsConfig2);
//
        reporteMaterial = new ToolbarButton("Reporte");
        reporteMaterial.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Reporte Material");
        reporteMaterial.setTooltip(tipsConfig);
//

        PagingToolbar pagingToolbar = new PagingToolbar(store);

        pagingToolbar.setPageSize(100);

        pagingToolbar.setDisplayInfo(true);

        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");

        pagingToolbar.setEmptyMsg("No topics to display");

        pagingToolbar.addSeparator();

        pagingToolbar.addButton(nuevomaterial);

        pagingToolbar.addSeparator();

        pagingToolbar.addButton(editarmaterial);

        pagingToolbar.addSeparator();

//        pagingToolbar.addButton(eliminarmaterial);
//        pagingToolbar.addSeparator();


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


//    private void CargarDatosNuevaMarca() {
//
//Object[][] marcas = null;
//        formulario = null;
//        formulario = new NuevoMarcaEmpleadoForm(null, nombrem,idmarca,marcas, EditarMarcaEmpleado.this);
//   //    formulario = new NuevoMarcaEmpleadoForm(null, "", "", "",nombrem,idmarca, marcas,EditarMarcaEmpleado.this);
//        formulario.show();
//
//    }
  private void CargarDatosNuevaMarca() {

        String enlace = "php/Empleado.php?funcion=CargarMarcas";
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

                                   Object[][] marcas = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
        formulario = null;
        formulario = new NuevoMarcaEmpleadoForm(null, nombrem,idempleado, marcas,EditarMarcaEmpleado.this);
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
//editar estado
    private void cargarDatosEditarMarca(String idmarca) {
        //             String cadena = "php/VentaDetalle.php?funcion=validarUsuario&idusuario=" + idCliente + "&password=" + idAlmacen;

        String enlace = "php/Empleado.php?funcion=buscarMarcasEmpleado&idmarca=" + idmarca+ "&idempleado=" + idempleado;
        Utils.setErrorPrincipal("Cargando parametros ", "cargar");
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
                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
                                    String marca = Utils.getStringOfJSONObject(marcaO, "marca");
                                    String estado = Utils.getStringOfJSONObject(marcaO, "estado");
                                    formulario2 = null;
                                    
                                    formulario2 = new NuevoMarcaEmpleadoEstado(idmarca, idempleado, marca,estado, EditarMarcaEmpleado.this);
                                    formulario2.show();
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

        //**************************************************
        //***********NUEVA Linea
        //**
        nuevomaterial.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {

                CargarDatosNuevaMarca();
            }
        });

        //**************************************************
        //***********EDITAR ROL
        //**************************************************
        editarmaterial.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idlinea = records[0].getAsString("idmarca");
                            cargarDatosEditarMarca(idlinea);
                        } else {

                            Utils.setErrorPrincipal("Por favor seleccione un material para editar", "error");
                        }

                    }
                });
        reporteMaterial.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();

                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idmaterial");
                            String enlTemp = "funcion=reportematerialHTML&idmaterial=" + selecionado;
                            verReporte(enlTemp);

                        } else {
                            MessageBox.alert("No hay marca selecionado para ver el reporte.");
                        }

                        reporteMaterial.setPressed(false);
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

    public String getLinksaveUpdate(
            String idrol, String nombre, String estado, Object[] seleccionados) {
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
            for (int i = 0; i <
                    seleccionados.length; i++) {
                Checkbox che = (Checkbox) seleccionados[i];
                funcS.set(i, new JSONString(che.getId().substring(1)));
            }
            todos.put("funciones", funcS);
            dev = todos.toString();
        } else {
            Utils.setErrorPrincipal("Por favor seleccione por lo menos una funcion", "error");
        }

        return dev;
    }

    private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
}

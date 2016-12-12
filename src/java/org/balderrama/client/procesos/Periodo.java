/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.procesos;

import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
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
import com.gwtext.client.core.Ext;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.util.Format;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import org.balderrama.client.util.Conector;
import com.gwtext.client.widgets.form.Checkbox;
import com.gwtext.client.widgets.grid.CellMetadata;
import com.gwtext.client.widgets.grid.Renderer;
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
import com.gwtext.client.widgets.grid.*;

/**
 *
 * @author 
 */
public class Periodo extends Panel {

    private GridPanel grid;
    private ColumnConfig idColumn;
    private ColumnConfig nombreColumn;
    private ColumnConfig telefonoColumn;
    private ColumnConfig ciudadColumn;
    private ColumnConfig codigoColumn;
    private ColumnConfig direccionColumn;
    private ColumnConfig estadoColumn;
    private ColumnConfig responsableColumn;
    private final int ANCHO = Utils.getScreenWidth() - 24;
    private final int ALTO = Utils.getScreenHeight() - 300;
//control de precios
   // private ControlPreciosForm controlP;
    private ToolbarButton editarEmpresa;
    private ToolbarButton eliminarEmpresa;
    private ToolbarButton nuevaEmpresa;
//    private ToolbarButton reporteColeccion;
    private ToolbarButton verCliente;
    private ToolbarButton detalleColeccion;
    private ModificarForm formulario;
    private Object[][] ciudadM;
//    private ConfigurarMarcaForm formulario1;
    protected ExtElement ext_element;
    CheckboxSelectionModel cbSelectionModel;
    Store store;
    private String selecionado;
    private BaseColumnConfig[] columns;
    ColumnModel columnModel;
  //  public CodificarPrecioForm precioForm;
    //variables para buscador
    PagingToolbar pagingToolbar1124;
    String selecionado1124 = "";

    public Periodo() {
        this.setClosable(true);
        this.setId("TPfun10201");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Lista Empresas");
      //  ciudadM = ciudad;
        onModuleLoad();
    }

    public void onModuleLoad() {

        DataProxy dataProxy = new ScriptTagProxy("php/Empresa.php?funcion=ListarEmpresa");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idempresa"),
                    new StringFieldDef("codigo"),
                    new StringFieldDef("nombre"),
                    new StringFieldDef("direccion"),
                    new StringFieldDef("telefono"),
                    new StringFieldDef("responsable"),
                    new StringFieldDef("ciudad"),
                    new StringFieldDef("estado")
                });
        JsonReader reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");

        store = new Store(dataProxy, reader, true);

        /* columnade idusuario  */
       idColumn = new ColumnConfig("Id Empresa", "idempresa", 200, true);

        idColumn.setWidth(100);
        //idColumn.setId("expandible");
        /* columnade nombre  */
        codigoColumn = new ColumnConfig("Codigo", "codigo", 100, true);
       codigoColumn.setId("expandible");

        nombreColumn = new ColumnConfig("Empresa", "nombre", 150, true);
        responsableColumn = new ColumnConfig("Responsable", "responsable", 200, true);
        telefonoColumn = new ColumnConfig("Telefono", "telefono", 200, true);
        direccionColumn = new ColumnConfig("Direccion", "direccion", 200, true);
        ciudadColumn = new ColumnConfig("Ciudad", "ciudad", 150, true);
        estadoColumn = new ColumnConfig("Estado", "estado", 200, true);



//        direccionColumn=new ColumnConfig("Direccion","direccion",(ANCHO/6) - 50 , true);
//        direccionColumn = new ColumnConfig("Imagen", "imagen", (ANCHO / 6) - 50, true, new Renderer() {
//
//            public String render(Object value, CellMetadata cellMetadata,
//                    Record record, int rowIndex, int colNum, Store store) {
//                return Format.format("<img src=\"images/jpg.php?name=../{0}&size=100\">",
//                        new String[]{record.getAsString("imagen")});
//            }
//        }, "imagen");

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    //column ID is company which is later used in setAutoExpandColumn
             //       idColumn,
                    codigoColumn,
                    nombreColumn,
                    responsableColumn,
                    telefonoColumn,
                    direccionColumn,
                    ciudadColumn,
                    estadoColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-Empresa");
        grid.setWidth(ANCHO);
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Empresas");
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


                selecionado = records[0].getAsString("idcliente");
                String enlTemp = "funcion=reporteClienteHTML&idcliente=" + selecionado;
                verReporte(enlTemp);
//                    Window.alert(enlTemp);
            }
        });

//        grid.a


        nuevaEmpresa = new ToolbarButton("Procesar");
        nuevaEmpresa.setEnableToggle(true);
        QuickTipsConfig tipsConfig1 = new QuickTipsConfig();
        tipsConfig1.setText("Procesar Datos");
        nuevaEmpresa.setTooltip(tipsConfig1);

        editarEmpresa = new ToolbarButton("Modificar");
        editarEmpresa.setEnableToggle(true);
        QuickTipsConfig tipsConfig = new QuickTipsConfig();
        tipsConfig.setText("Modificar");
        editarEmpresa.setTooltip(tipsConfig);

        eliminarEmpresa = new ToolbarButton("Salir");
        eliminarEmpresa.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Salir");
        eliminarEmpresa.setTooltip(tipsConfig2);

//        reporteColeccion = new ToolbarButton("Reporte");
//        reporteColeccion.setEnableToggle(true);
//        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
//        tipsConfig3.setText("Reporte Coleccion");
//        reporteColeccion.setTooltip(tipsConfig3);



        PagingToolbar pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(nuevaEmpresa);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(editarEmpresa);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarEmpresa);
        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(reporteColeccion);
//        pagingToolbar.addSeparator();
        

        grid.setBottomToolbar(pagingToolbar);

        add(grid);
        //panel.add(grid);
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

    private void CargarNuevaEmpresa() {
  String enlace = "php/Cobros.php?funcion=BuscarCiudadCobrador";
        Utils.setErrorPrincipal("Cargando parametros de Nuevo Almacen", "cargar");
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
                                   // Object[][] responsables = Utils.getArrayOfJSONObject(marcaO, "responsableM", new String[]{"idusuario", "nombre"});
                                    Object[][] ciudades = Utils.getArrayOfJSONObject(marcaO, "ciudadM", new String[]{"idciudad", "nombre"});
                                    Object[][] empleados = Utils.getArrayOfJSONObject(marcaO, "empleadoM", new String[]{"idempleado", "nombre"});

                                    formulario = null;
                          //          formulario = new EditarNuevoAlmacen(null, "", "", "", "", "", "", "", responsables, ciudades, Almacen.this);
                                formulario = new ModificarForm(null,ciudades,empleados, "", "", "", "", "", "", "","", "", "", "", "", "", "", "", "", "", "", "", "", "", Periodo.this);

                                    formulario.onModuleLoad();
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
//        formulario = null;
//        formulario = new NuevaEmpresaForm(null,ciudadM, "", "", "", "", "", "", "","", "", "", "", "", "", "", "", "", "", "", "", "", "", Empresa.this);
//        formulario.onModuleLoad();
    }

    private void cargarDatosEditarColeccion(String idempresa) {
        String enlace = "php/Empresa.php?funcion=BuscarEmpresaPorId&idempresa=" + idempresa;
        Utils.setErrorPrincipal("Cargando parametros de Coleccion", "cargar");
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
                                    //Object[][] almacenes = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{ "anio"});
                                    Object[][] marcas = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                    Object[][] anios = Utils.getArrayOfJSONObject(marcaO, "anioM", new String[]{"anio", "anio"});
//                                    Object[][] tipos = Utils.getArrayOfJSONObject(marcaO, "tipoM", new String[]{"idtipocliente", "nombre"});
                                    String idcoleccion = Utils.getStringOfJSONObject(marcaO, "idcoleccion");
                                    String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
                                    String anio = Utils.getStringOfJSONObject(marcaO, "anio");
                                    String codigobarra = Utils.getStringOfJSONObject(marcaO, "codigobarra");
//                                    String tipo = Utils.getStringOfJSONObject(marcaO, "idtipocliente");
//                                    String almacen = Utils.getStringOfJSONObject(marcaO, "idalmacen");
                                    String detalle = Utils.getStringOfJSONObject(marcaO, "detalle");
                                    String estado = Utils.getStringOfJSONObject(marcaO, "estado");

//                                    String estado = Utils.getStringOfJSONObject(marcaO, "estado");
//                                    String fax = Utils.getStringOfJSONObject(marcaO, "fax");
//                                    String  = Utils.getStringOfJSONObject(marcaO, "estado");
//                                    formulario = null;
//                                    formulario = new NuevaColeccionForm(idcoleccion, codigo,detalle,idmarca,anio,marcas,anios,Coleccion.this);
//                                    formulario.show();
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

//
    private void aniadirListenersCliente() {
        //**************************************************
        //***********ELIMINAR ROL
        //**************************************************

        eliminarEmpresa.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idcoleccion");
                    MessageBox.confirm("Eliminar Coleccion", "Realmente desea eliminar esta Coleccion??", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                //eliminar
                                String enlace = "php/Coleccion.php?funcion=EliminarColeccion&idcoleccion=" + selecionado;
                                Utils.setErrorPrincipal("Eliminando la Coleccion", "cargar");
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
                    MessageBox.alert("No hay Coleccion selecionado para la Eliminacion  y/o selecciono mas de uno.");
                }
                eliminarEmpresa.setPressed(false);
            }
        });
        //**************************************************
        //***********NUEVA MARCA
        //**
        nuevaEmpresa.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                CargarNuevaEmpresa();
            }
        });

        //**************************************************
        //***********EDITAR ROL
        //**************************************************
        editarEmpresa.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idcoleccion = records[0].getAsString("idempresa");
                            cargarDatosEditarColeccion(idcoleccion);
                        } else {

                            Utils.setErrorPrincipal("Por favor seleccione una Coleccion para editar", "error");
                        }

                    }
                });
//        reporteColeccion.addListener(
//                new ButtonListenerAdapter() {
//
//                    @Override
//                    public void onClick(Button button, EventObject e) {
//                        Record[] records = cbSelectionModel.getSelections();
//
//                        if (records.length == 1) {
//                            selecionado = records[0].getAsString("idcoleccion");
//                            String enlTemp = "funcion=reportecoleccionHTML&idcoleccion=" + selecionado;
//                            verReporte(enlTemp);
//
//                        } else {
//                            MessageBox.alert("No hay marca selecionado para ver el reporte.");
//                        }
//
//                        reporteColeccion.setPressed(false);
//                    }
//                });
        verCliente.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();

                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idcoleccion");
//MessageBox.alert("Menu codificador");
                            //CargarDatosCodificarPrecio(selecionado);


                        } else {
                            MessageBox.alert("Seleccione Una Coleccion");
                        }

                        verCliente.setPressed(false);
                    }
                });



        detalleColeccion.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();

                        if (records.length == 1) {
                            selecionado = records[0].getAsString("idcoleccion");
                            String enlTemp = "funcion=detalleColeccionHTML&idcoleccion=" + selecionado;
                            verReporte(enlTemp);

                        } else {
                            MessageBox.alert("No hay coleccion selecionado para ver el reporte.");
                        }

                        detalleColeccion.setPressed(false);
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

    
    private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }

    private void cargarControlPrecios() {
        Record[] records = cbSelectionModel.getSelections();
        if (records.length >= 1) {

            Record[] recordss = cbSelectionModel.getSelections();
            JSONArray funcS = new JSONArray();
            for (int i = 0; i < recordss.length; i++) {
                funcS.set(i, new JSONString(recordss[i].getAsString("idcoleccion")));
            }
            JSONObject joo = new JSONObject();
            joo.put("resultado", funcS);
            String enlace = "php/ListaPrecios.php?funcion=ListaPrecios&resultado=" + joo.toString();
            Utils.setErrorPrincipal("Cargando datos control precios", "cargar");
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
                            String nuevoR = Utils.getStringOfJSONObject(jsonObject, "nuevo");
                            Object[][] datsPro = Utils.getArrayOfJSONObject(jsonObject, "resultado", new String[]{"idcalzado", "modelo", "marca", "color", "material", "preciooficina", "preciomayor", "precio3"});
                            if (errorR.equalsIgnoreCase("true")) {
                                Utils.setErrorPrincipal(mensajeR, "mensaje");
                            //    controlP = null;
//                                controlP = new ControlPreciosForm(datsPro, Coleccion.this, nuevoR);
                             //   controlP.show();
                            } else {
                                Utils.setErrorPrincipal(mensajeR, "error");
                            }

                        }
                    }

                    public void onError(Request request, Throwable exception) {
                        Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                    }
                });
            } catch (RequestException exp) {
                Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
            }
        } else {
            MessageBox.alert("No hay marca(s) selecionado(s) para mostrar");
        }
    }

    void buscarProductosSinKardex() {
        throw new UnsupportedOperationException("Not yet implemented");
    }

    void buscarProductos() {
        throw new UnsupportedOperationException("Not yet implemented");
    }
}


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
import com.gwtext.client.util.Format;
import org.balderrama.client.util.Conector;
import com.gwtext.client.widgets.form.Checkbox;
import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
//import org.balderrama.client.pedido.PanelPedido;
import com.gwtext.client.data.*;
import com.gwtext.client.core.UrlParam;
import com.gwtext.client.widgets.Toolbar;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.Store;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.grid.*;

/**
 *
 * @author buggy
 */
public class ListarCalzados extends Panel {

    private GridPanel grid;
    private ColumnConfig idcalzadoColumn;
    private ColumnConfig modeloColumn;
    private ColumnConfig lineaColumn;
    private ColumnConfig coleccionColumn;
//    private ColumnConfig nombreColumn;
    private ColumnConfig colorColumn;
    private ColumnConfig marcaColumn;
    private ColumnConfig materialColumn;
    private ColumnConfig stylenameColumn;
    private ColumnConfig imagenColumn;
    private final int ANCHO = Utils.getScreenWidth() - 24;
    private final int ALTO = Utils.getScreenHeight() - 270;
//control de precios
    private NuevoCalzadoForm calzado;
    private ToolbarButton editarColeccion;
    private ToolbarButton eliminarColeccion;
    private ToolbarButton nuevaColeccion;
    private ToolbarButton reporte;
    private ToolbarButton inventario;

//    private ToolbarButton controlPrecios;
//    private NuevaColeccionForm formulario;
//    private ConfigurarMarcaForm formulario1;
    protected ExtElement ext_element;
    CheckboxSelectionModel cbSelectionModel;
    Store store;
    private String selecionado;
    private BaseColumnConfig[] columns;
    ColumnModel columnModel;
    //public CodificarPrecioForm precioForm;
    //variables para buscador
    PagingToolbar pagingToolbar1124;
    String selecionado1124 = "";
    protected String buscarmodelo;
    protected String buscarlinea;
    protected String buscarcoleccion;
    protected String buscarcolor;
    protected String buscarmaterial;
    protected String buscarmarca;
    private TextField tex_modelo;
    private TextField tex_linea;
    private TextField tex_coleccion;
    private TextField tex_color;
    private TextField tex_material;
    private TextField tex_marca;
    private Toolbar too_busquedaCBWW;
    private ToolbarButton too_buscarCBWW;

    public ListarCalzados() {
        this.setClosable(true);
        this.setId("TPfun1507");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Aritulos");
        onModuleLoad();
    }

    public void onModuleLoad() {

        DataProxy dataProxy = new ScriptTagProxy("php/Calzado.php?funcion=ListarCalzado");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idcalzado"),
                    new StringFieldDef("modelo"),
                    new StringFieldDef("linea"),
                    new StringFieldDef("coleccion"),
                    new StringFieldDef("color"),
                    new StringFieldDef("material"),
                    new StringFieldDef("marca"),
                    new StringFieldDef("stylename"),
                    new StringFieldDef("imagen")
                });
        JsonReader reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");

        store = new Store(dataProxy, reader, true);

        /* columnade idusuario  */
        idcalzadoColumn = new ColumnConfig("Id Calzado", "idcalzado", 150, true);

        /* columnade nombre  */
        modeloColumn = new ColumnConfig("Modelo", "modelo", 100, true);
           modeloColumn.setId("expandible");
        lineaColumn = new ColumnConfig("Linea", "linea", 100, true);
        colorColumn = new ColumnConfig("Color", "color", 200, true);
        coleccionColumn = new ColumnConfig("Coleccion", "coleccion", 100, true);
        materialColumn = new ColumnConfig("Material", "material", 200, true);
        marcaColumn = new ColumnConfig("Marca", "marca", 200, true);
        stylenameColumn = new ColumnConfig("StyleName", "stylename",100, true);
        imagenColumn = new ColumnConfig("Imagen", "imagen", 150, true, new Renderer() {

            public String render(Object value, CellMetadata cellMetadata,
                    Record record, int rowIndex, int colNum, Store store) {
                return Format.format("<img src=\"images/jpg.php?name={0}&size=100\">",
                        new String[]{record.getAsString("imagen")});
            }
        }, "imagen");



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
                  
                    modeloColumn,
                    lineaColumn,
                    colorColumn,
                    coleccionColumn,
                    materialColumn,
                    marcaColumn,
                    stylenameColumn,
                    imagenColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-Calzados");
        grid.setWidth(ANCHO);
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Articulos");
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


        nuevaColeccion = new ToolbarButton("Nuevo");
        nuevaColeccion.setEnableToggle(true);
        QuickTipsConfig tipsConfig1 = new QuickTipsConfig();
        tipsConfig1.setText("Nuevo Calzado");
        nuevaColeccion.setTooltip(tipsConfig1);

        editarColeccion = new ToolbarButton("Editar");
        editarColeccion.setEnableToggle(true);
        QuickTipsConfig tipsConfig = new QuickTipsConfig();
        tipsConfig.setText("Editar datos Calzado");
        editarColeccion.setTooltip(tipsConfig);

        eliminarColeccion = new ToolbarButton("Eliminar");
        eliminarColeccion.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Eliminar Calzado");
        eliminarColeccion.setTooltip(tipsConfig2);

        reporte = new ToolbarButton("Reporte");
        reporte.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Reporte Calzado");
        reporte.setTooltip(tipsConfig3);


        inventario = new ToolbarButton("Inventario");
        inventario.setEnableToggle(true);
        QuickTipsConfig tipsConfig4 = new QuickTipsConfig();
        tipsConfig4.setText("Inventario");
        inventario.setTooltip(tipsConfig4);
//      control de precios


        PagingToolbar pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(nuevaColeccion);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(editarColeccion);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarColeccion);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(inventario);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(reporte);
        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(codmaterialMarca);
//        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(codcolorMarca);
//        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(configurarMarca);
//        pagingToolbar.addSeparator();

        //para el buscador
        too_busquedaCBWW = new Toolbar();

        tex_modelo = new TextField("Modelo", "modelo");
        tex_linea = new TextField("Linea", "linea");
        tex_coleccion = new TextField("Coleccion", "coleccion");
        tex_color = new TextField("Color", "color");
        tex_material = new TextField("Material", "material");
        tex_marca = new TextField("Marca", "marca");
        too_buscarCBWW = new ToolbarButton("Buscar");
        too_buscarCBWW.setPressed(true);

        too_busquedaCBWW.addText("Modelo:");
        too_busquedaCBWW.addField(tex_modelo);
        too_busquedaCBWW.addText("Linea:");
        too_busquedaCBWW.addField(tex_linea);
        too_busquedaCBWW.addText("Coleccion:");
        too_busquedaCBWW.addField(tex_coleccion);
        too_busquedaCBWW.addText("Color:");
        too_busquedaCBWW.addField(tex_color);
        too_busquedaCBWW.addText("Material:");
        too_busquedaCBWW.addField(tex_material);
        too_busquedaCBWW.addText("Marca:");
        too_busquedaCBWW.addField(tex_marca);


        too_busquedaCBWW.addButton(too_buscarCBWW);
        grid.setTopToolbar(too_busquedaCBWW);


        grid.setBottomToolbar(pagingToolbar);

        add(grid);
        //panel.add(grid);
        aniadirListenersCliente();
        aniadirListenersBuscador();
        aniadirListenersBuscadoresText();

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

    private void CargarNuevoCalzado() {
        //String enlace = "php/Coleccion.php?funcion=BuscarAlmacenTipo";
//        String enlace = "php/Calzado.php?funcion=BuscarMarcaAnio";
//        Utils.setErrorPrincipal("Cargando parametros de Nueva Coleccion", "cargar");
//        final Conector conec = new Conector(enlace, false);
//        {
//            try {
//                conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
//
//                    public void onResponseReceived(Request request, Response response) {
//                        String data = response.getText();
//                        JSONValue jsonValue = JSONParser.parse(data);
//                        JSONObject jsonObject;
//                        if ((jsonObject = jsonValue.isObject()) != null) {
//                            String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
//                            String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
//                            if (errorR.equalsIgnoreCase("true")) {
//                                Utils.setErrorPrincipal(mensajeR, "mensaje");
//                                JSONValue marcasV = jsonObject.get("resultado");
//                                JSONObject marcasO;
//                                if ((marcasO = marcasV.isObject()) != null) {
//                                    Object[][] marca = Utils.getArrayOfJSONObject(marcasO, "marcaM", new String[]{"idmarca", "nombre"});
//                                    Object[][] anio = Utils.getArrayOfJSONObject(marcasO, "anioM", new String[]{"anio", "anio"});
                                    calzado = null;
//                                    (String idcliente, String nombre, String codigo, String tipo, String almacen, String telefono, String fax, String estado, String direccion,  Object[][] almacenes, Coleccion padre)
                                    //calzado = new NuevoCalzadoForm(null, "", "", "","",marca,anio,Coleccion.this);
                                    calzado = new NuevoCalzadoForm();
                                    calzado.show();
//                                } else {
//                                    MessageBox.alert("No Hay datos en la consulta");
//
//                                }
//                            }
//                        } else {
//                        }
//                        throw new UnsupportedOperationException("Not supported yet.");
//                    }
//
//                    public void onError(Request request, Throwable exception) {
//                        throw new UnsupportedOperationException("Not supported yet.");
//                    }
//                });
//
//            } catch (RequestException e) {
//                e.getMessage();
//                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
//            }
//
//        }
    }

    private void cargarDatosEditarColeccion(String idcalzado) {
//        String enlace = "php/Coleccion.php?funcion=BuscarMarcaAnioPorId&idcoleccion=" + idcoleccion;
//        Utils.setErrorPrincipal("Cargando parametros de Coleccion", "cargar");
//        final Conector conec = new Conector(enlace, false);
//        {
//            try {
//                conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
//
//                    public void onResponseReceived(Request request, Response response) {
//                        String data = response.getText();
//                        JSONValue jsonValue = JSONParser.parse(data);
//                        JSONObject jsonObject;
//                        if ((jsonObject = jsonValue.isObject()) != null) {
//                            String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
//                            String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
//                            if (errorR.equalsIgnoreCase("true")) {
//                                Utils.setErrorPrincipal(mensajeR, "mensaje");
//
//                                JSONValue marcaV = jsonObject.get("resultado");
//                                JSONObject marcaO;
//                                if ((marcaO = marcaV.isObject()) != null) {
//                                    //Object[][] almacenes = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{ "anio"});
//                                    Object[][] marcas = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
//                                    Object[][] anios = Utils.getArrayOfJSONObject(marcaO, "anioM", new String[]{"anio", "anio"});
////                                    Object[][] tipos = Utils.getArrayOfJSONObject(marcaO, "tipoM", new String[]{"idtipocliente", "nombre"});
//                                    String idcoleccion = Utils.getStringOfJSONObject(marcaO, "idcoleccion");
//                                    String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
//                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");
//                                    String anio = Utils.getStringOfJSONObject(marcaO, "anio");
//                                    String codigobarra = Utils.getStringOfJSONObject(marcaO, "codigobarra");
////                                    String tipo = Utils.getStringOfJSONObject(marcaO, "idtipocliente");
////                                    String almacen = Utils.getStringOfJSONObject(marcaO, "idalmacen");
//                                    String detalle = Utils.getStringOfJSONObject(marcaO, "detalle");
//                                    String estado = Utils.getStringOfJSONObject(marcaO, "estado");
//
////                                    String estado = Utils.getStringOfJSONObject(marcaO, "estado");
////                                    String fax = Utils.getStringOfJSONObject(marcaO, "fax");
////                                    String  = Utils.getStringOfJSONObject(marcaO, "estado");
////                                    formulario = null;
//                                    formulario = new NuevaColeccionForm(idcoleccion, codigo,detalle,idmarca,anio,marcas,anios,Coleccion.this);
//                                    formulario.show();
//                                } else {
//                                    MessageBox.alert("No Hay datos en la consulta");
//                                }
//                            }
//                        } else {
//                        }
//                        throw new UnsupportedOperationException("Not supported yet.");
//                    }
//
//                    public void onError(Request request, Throwable exception) {
//                        throw new UnsupportedOperationException("Not supported yet.");
//                    }
//                });
//
//            } catch (RequestException e) {
//                e.getMessage();
//                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
//            }
//
//        }
    }

//
    private void aniadirListenersCliente() {
        //**************************************************
        //***********ELIMINAR ROL
        //**************************************************

        eliminarColeccion.addListener(new ButtonListenerAdapter() {

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
                eliminarColeccion.setPressed(false);
            }
        });
        //**************************************************
        //***********NUEVA MARCA
        //**
        nuevaColeccion.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                CargarNuevoCalzado();
            }
        });

        //**************************************************
        //***********EDITAR ROL
        //**************************************************
        editarColeccion.addListener(
                new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idcoleccion = records[0].getAsString("idcoleccion");
                            cargarDatosEditarColeccion(idcoleccion);
                        } else {

                            Utils.setErrorPrincipal("Por favor seleccione una Coleccion para editar", "error");
                        }

                    }
                });
        reporte.addListener(
                new ButtonListenerAdapter() {
            
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

    private void CargarDatosCodificarPrecio(final String idcoleccion) {

//
//
//        String enlace = "php/Coleccion.php?funcion=BuscarModeloPorIdColeccion&idcoleccion=" + idcoleccion;
//        Utils.setErrorPrincipal("Cargando datos para Codificar el precio de la Coleccion", "cargar");
//        final Conector conec = new Conector(enlace, false);
//        try {
//            conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
//
//                public void onResponseReceived(Request request, Response response) {
//                    String data = response.getText();
//                    JSONValue jsonValue = JSONParser.parse(data);
//                    JSONObject jsonObject;
//
//                    if ((jsonObject = jsonValue.isObject()) != null) {
//                        String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
//                        String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
//                        Object[][] datsPro = Utils.getArrayOfJSONObject(jsonObject, "resultado", new String[]{ "idmodelo", "codigo","precio1","precio2"});
//                        if (errorR.equalsIgnoreCase("true")) {
//                            Utils.setErrorPrincipal(mensajeR, "mensaje");
//                            precioForm = null;
//                            precioForm = new CodificarPrecioForm(idcoleccion, datsPro,  Coleccion.this);
//                            precioForm.show();
//                        } else {
//                            Utils.setErrorPrincipal(mensajeR, "error");
//                        }
//
//                    }
//                }
//
//                public void onError(Request request, Throwable exception) {
//                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//                }
//            });
//        } catch (RequestException ex) {
//            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//        }
    }

//    public String getLinksaveUpdate(String idrol, String nombre, String estado, Object[] seleccionados) {
//        String dev = "";
//        if (seleccionados.length >= 1) {
//
//            if (idrol == null) {
//                idrol = "nuevo";
//            }
//            JSONObject todos = new JSONObject();
//            todos.put("idrol", new JSONString(idrol));
//            todos.put("nombre", new JSONString(nombre));
//            todos.put("estado", new JSONString(estado));
//            JSONArray funcS = new JSONArray();
//            for (int i = 0; i < seleccionados.length; i++) {
//                Checkbox che = (Checkbox) seleccionados[i];
//                funcS.set(i, new JSONString(che.getId().substring(1)));
//            }
//            todos.put("funciones", funcS);
//            dev = todos.toString();
//        } else {
//            Utils.setErrorPrincipal("Por favor seleccione por lo menos una funacion", "error");
//        }
//        return dev;
//    }
    public void aniadirListenersBuscador() {

        too_buscarCBWW.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Utils.setErrorPrincipal("Se realizo la busqueda", "mensaje");
                buscarSegunParametros();
            }
        });
    }

    public void aniadirListenersBuscadoresText() {

        tex_modelo.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 2");
                }
            }
        });

        //**************************************************
        //*********** BUSCADOR MARCA
        //**************************************************
        tex_linea.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 2");
                }
            }
        });

        //**************************************************
        //*********** BUSCADOR COLOR
        //**************************************************
        tex_coleccion.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

        tex_color.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

        tex_material.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });
         tex_marca.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

    }

    public void buscarSegunParametros() {
        store.reload(new UrlParam[]{new UrlParam("start", 0), new UrlParam("limit", 100),
                    new UrlParam("buscarmodelo", tex_modelo.getText()), new UrlParam("buscarlinea", tex_linea.getText()),
                    new UrlParam("buscarcoleccion", tex_coleccion.getText()), new UrlParam("buscarcolor", tex_color.getText()), new UrlParam("buscarmaterial", tex_material.getText()), new UrlParam("buscarmarca", tex_marca.getText())}, false);
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
//                                controlP = null;
//                                controlP = new ControlPreciosForm(datsPro, Coleccion.this, nuevoR);
//                                controlP.show();
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

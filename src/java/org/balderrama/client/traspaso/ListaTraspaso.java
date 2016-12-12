/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.traspaso;
import org.balderrama.client.modelo.*;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
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
import com.gwtext.client.core.UrlParam;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.data.Store;
import com.gwtext.client.util.DateUtil;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import org.balderrama.client.util.Conector;
import com.gwtext.client.widgets.form.ComboBox;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import org.balderrama.client.util.BuscadorToolBar;
import org.balderrama.client.util.KMenu;

/**
 *
 * @author
 */
public class ListaTraspaso extends Panel {

    public GridPanel grid;
   //   protected FormularioTraspaso formularioTraspaso;
    private ConfigurarMaterialForm formulario20;
    public ConfigurarAnularForm formulario201;
     public Cambiarvendedor formulario2;
      private ToolbarButton editarTraspaso;
    private ToolbarButton eliminarTraspaso;
   // private ToolbarButton nuevoTraspaso;
    private ToolbarButton duplicar;
    private ToolbarButton reporteTraspaso;
    private ToolbarButton cambiar;
     private ToolbarButton vender;
   // private ToolbarButton configurarMaterial;
    private ColumnConfig idColumn;
    private ColumnConfig codigoColumn;
    private ColumnConfig marcaColumn;
        private ColumnConfig idmarcaColumn;
    private ColumnConfig tiendaColumn;
    private ColumnConfig totalparesColumn;
     private ColumnConfig totalcajasColumn;
      private ColumnConfig totalsusColumn;
    private ColumnConfig fechaColumn;
     private ColumnConfig almdestColumn;
    private ColumnConfig horaColumn;
    private ColumnConfig responsableColumn;
     private ColumnConfig responsableenvioColumn;

     private ColumnConfig idTraspasoColumn;
    private ColumnConfig almacenOrigenColumn;
    private ColumnConfig cantidadColumn;
    private ColumnConfig estadoColumn;
     private ColumnConfig tipoColumn;
     private ColumnConfig paresColumn;
    private ColumnConfig montoColumn;
    private ColumnConfig almacenDestinoColumn;
    private final int ANCHO = Utils.getScreenWidth() - 24;
    private final int ALTO = Utils.getScreenHeight() - 275;
    private ToolbarButton anularIngreso;
    private ToolbarButton eliminarModelo;
   private ToolbarButton verdetalle;
//    private Toolbar too_busquedaPBW;
    private ToolbarButton buscar;
//    private TextField tex_modeloPBU;
//    private TextField tex_colorPBU;
//    private TextField tex_materialPBU;
//    private TextField tex_marcaPBU;
    private BuscadorToolBar buscadorToolBar;
    protected String buscarModelo;
    protected String buscarMarca;
    protected String buscarColeccion;
    protected String buscarLinea;
    private EditarModeloForm formulario;
    private ToolbarButton CodigoBarra;
    private ToolbarButton codlineaMarca;
    private ToolbarButton codcolorMarca;
    private ToolbarButton codmaterialMarca;
    private ToolbarButton configurarMarca;
    private ToolbarButton cargarimagenMarca;
     private ToolbarButton codigob;
     private ToolbarButton codigobarra;
    // private EditarMarcaForm formulario;
    protected ExtElement ext_element;
    CheckboxSelectionModel cbSelectionModel;
    Store store;
    private String selecionado;
        private String selecionado1;
         private String selecionado2;
    private BaseColumnConfig[] columns;
    ColumnModel columnModel;
 public KMenu padre;
    private Object tindaC[][];
    private Object empleadoC[][];
 protected String buscarCodigo;
    protected String buscarFechaInicial;
    protected String buscarFechaFinal;
    protected String buscarTienda;
      protected String buscarTipo;
 private String[] clienteM;
  private ComboBox com_cliente;
  private MostraVenta formulario_almv;
  private FormularioKardexVenta formulariocl;
String idtraspaso;
String idmarca;
String idvendedor;
String idcliente;
String mifecha;

    public ListaTraspaso(KMenu kmenu) {
        padre=kmenu;
this.clienteM = new String[]{"ENVIADOS", "RECIBIDOS"};
        this.setClosable(true);
        this.setId("TPfun1043");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Lista de Traspasos");
        onModuleLoad();
    }

    public void onModuleLoad() {

      DataProxy dataProxy = new ScriptTagProxy("php/Traspaso.php?funcion=listarTraspaso");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("iddetalletraspaso"),
                       new StringFieldDef("idtraspaso"),
                          new StringFieldDef("idmarca"),
                               new StringFieldDef("codigo"),
                   new StringFieldDef("idalmacendestino"),
                    new StringFieldDef("boleta"),
                    new StringFieldDef("fecha"),
                    new StringFieldDef("hora"),
                    new StringFieldDef("tiendaorigen"),
                    new StringFieldDef("tiendadestino"),
                    new StringFieldDef("marca"),
                    new StringFieldDef("cajas"),
                    new StringFieldDef("pares"),
                    new StringFieldDef("precio"),
                    new StringFieldDef("responsable"),
                              new StringFieldDef("recibidopor"),
                     new StringFieldDef("estado"),
                       new StringFieldDef("tiendasesion"),
                       new StringFieldDef("tipotraspaso")
                });
       JsonReader reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true); //nada


   /* columna de idtraspaso  */
        idTraspasoColumn = new ColumnConfig("Id", "idtraspasomodelo", 100, false);
        /* columnade codigo  */
           codigoColumn = new ColumnConfig("Boleta", "boleta", 40, false);
        fechaColumn = new ColumnConfig("Fecha", "fecha", 90, false);
almdestColumn = new ColumnConfig("Fecha", "idalmacendestino", 90, false);
        /* columna de hora */
        horaColumn = new ColumnConfig("Hora", "hora", 60, false);
     
        /* columnade almacen  */
        almacenOrigenColumn = new ColumnConfig("Almacen Orig.", "tiendaorigen", 130, false);
        /* columnade almacen  */
        almacenDestinoColumn = new ColumnConfig("Almacen Dest.", "tiendadestino", 130, false);
        /* columna de cantidad  */
        marcaColumn = new ColumnConfig("Marca", "marca", 100, false);
           idmarcaColumn = new ColumnConfig("idmarca", "idmarca", 100, false);
 cantidadColumn = new ColumnConfig("Cajas", "cajas", 40, false);
 paresColumn = new ColumnConfig("Pares", "pares", 70, false);
montoColumn = new ColumnConfig("Monto", "precio", 70, false);
        responsableColumn = new ColumnConfig("Quien recibe", "responsable",120, false);
        responsableenvioColumn = new ColumnConfig("Enviado Por", "recibidopor",120, false);

        estadoColumn = new ColumnConfig("Estado", "estado", 120, false);

                  tipoColumn = new ColumnConfig("TIPO TRASPASO", "tipotraspaso", 120, false);



        cbSelectionModel = new CheckboxSelectionModel();
        CheckboxColumnConfig checkBoxColumn = new CheckboxColumnConfig(cbSelectionModel);
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                   codigoColumn,
                    fechaColumn,
                    horaColumn,
                    almacenOrigenColumn,
                    almacenDestinoColumn,
                    marcaColumn,
                    cantidadColumn,
                   paresColumn,
                    montoColumn,

                    responsableColumn,responsableenvioColumn,
                    tipoColumn,estadoColumn,};

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-traspasos");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        //  grid.setTitle("Lista de traspasos");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");

      

        eliminarTraspaso = new ToolbarButton("Anular");
        eliminarTraspaso.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Anular traspaso(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarTraspaso.setTooltip(tipsConfig2);

//configurarMaterial = new ToolbarButton("Confirmar Traspaso");
//        configurarMaterial.setEnableToggle(true);
//        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
//        tipsConfig21.setText("confirmar llegada de traspaso");
//        configurarMaterial.setTooltip(tipsConfig21);


        reporteTraspaso = new ToolbarButton("Ver traspaso");
        reporteTraspaso.setEnableToggle(true);
        QuickTipsConfig tipsConfig6 = new QuickTipsConfig();
        tipsConfig6.setText("Ver reporte");
        //tipsConfig.setTitle("Tip Title");
        reporteTraspaso.setTooltip(tipsConfig6);

         cambiar = new ToolbarButton("Cambiar vendedor");
        cambiar.setEnableToggle(true);
        QuickTipsConfig tipsConfig61 = new QuickTipsConfig();
        tipsConfig61.setText("cambiar");
        //tipsConfig.setTitle("Tip Title");
        cambiar.setTooltip(tipsConfig61);

        vender = new ToolbarButton("Venta traspaso");
        vender.setEnableToggle(true);
        QuickTipsConfig tipsConfig61d = new QuickTipsConfig();
        tipsConfig61d.setText("vender");
        //tipsConfig.setTitle("Tip Title");
        vender.setTooltip(tipsConfig61d);

 codigobarra = new ToolbarButton("VEr codigo Barra ");
        codigobarra.setEnableToggle(true);
        QuickTipsConfig tipsConfig631 = new QuickTipsConfig();
        tipsConfig631.setText("Ver codigobarra");
        //tipsConfig.setTitle("Tip Title");
        codigobarra.setTooltip(tipsConfig631);

 codigob = new ToolbarButton("VEr codigo ");
        codigob.setEnableToggle(true);
        QuickTipsConfig tipsConfig63 = new QuickTipsConfig();
        tipsConfig63.setText("Ver codigobarra");
        //tipsConfig.setTitle("Tip Title");
        codigob.setTooltip(tipsConfig63);

        PagingToolbar pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
      //  pagingToolbar.addButton(configurarMaterial);
       // pagingToolbar.addSeparator();
        pagingToolbar.addButton(reporteTraspaso);
         pagingToolbar.addSeparator();
          pagingToolbar.addButton(cambiar);
           pagingToolbar.addSeparator();
              pagingToolbar.addButton(vender);
           pagingToolbar.addSeparator();
          pagingToolbar.addButton(codigobarra);
            pagingToolbar.addSeparator();
          pagingToolbar.addButton(codigob);
         pagingToolbar.addSeparator();
 pagingToolbar.addButton(eliminarTraspaso);

        String items[] = {"Boleta", "Fecha", "Almacen","Tipo"};
        String tiposBuscadores[] = {"text", "date", "combo","combo"};
        buscadorToolBar = new BuscadorToolBar(items, tiposBuscadores);
        grid.setTopToolbar(buscadorToolBar.getToolbar());
        grid.setBottomToolbar(pagingToolbar);
        buscar = buscadorToolBar.getBuscar();
        add(grid);
        //panel.add(grid);
  recuperarAlmacenes();

//
        addListenersBuscador();
//
        addListenersBuscadoresText();

        aniadirListenersTraspaso();
        //aniadirListenersMarcas();

    //RootPanel.get().add(panel);
    }
  private void aniadirListenersTraspaso() {
        //**************************************************
        //***********ELIMINAR TRASPASO
        //**************************************************

       eliminarTraspaso.addListener(
                new ButtonListenerAdapter() {

                  @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idtraspaso = records[0].getAsString("idtraspaso");

                               String  origen= records[0].getAsString("tiendaorigen");
                                  String  destino= records[0].getAsString("tiendadestino");
                                   String  estado = records[0].getAsString("estado");
        String  tiendasesion= records[0].getAsString("tiendasesion");
  String idmar= records[0].getAsString("idmarca");
  String codig= records[0].getAsString("codigo");
  String codigocero ="0";
 if(estado!="ANULADO"){
        if(tiendasesion==origen){
                    if(codig==codigocero){
                       cargarDatosConfigurarAnular(idtraspaso);
                    }else{
                        MessageBox.alert("Este traspaso ya fue vendido , debe intentar por otro metodo ");
                        }
        }else{
        MessageBox.alert("solo se anula mercaderia del almacen que inicio el envio");
        }

   }else{
        MessageBox.alert("Este traspaso ya fue Anulado");
        }


                        } else {

                          MessageBox.alert("Por favor seleccione un traspaso para confirmar");
                        }

                    }


                });

  vender.addListener(
                new ButtonListenerAdapter() {

                  @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idtraspaso = records[0].getAsString("idtraspaso");

                               String  origen= records[0].getAsString("tiendaorigen");
                                  String  destino= records[0].getAsString("tiendadestino");
                                   String  estado = records[0].getAsString("estado");
        String  tiendasesion= records[0].getAsString("tiendasesion");
  String idmar= records[0].getAsString("idmarca");
  String codig= records[0].getAsString("codigo");
  String codigocero ="0";
        if(tiendasesion==destino){
                    if(codig==codigocero){
                     cargarvender(idtraspaso,idmar);
            }else{
                MessageBox.alert("Este traspaso ya fue vendido , debe intentar por otro metodo de venta");
                }

    }else{
        MessageBox.alert("solo se vende Mercaderia q entro en el almacen Propio");
        }



                        } else {

                          MessageBox.alert("Por favor seleccione un traspaso para confirmar");
                        }

                    }


                });
 cambiar.addListener(
                new ButtonListenerAdapter() {

                  @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                        if (records.length == 1) {
                            String idtraspaso = records[0].getAsString("idtraspaso");
                               String  origen= records[0].getAsString("tiendaorigen");
                                String  destino= records[0].getAsString("tiendadestino");
                                String  estado = records[0].getAsString("estado");
                                  String idmarca = records[0].getAsString("idmarca");
                                 String  responsable = records[0].getAsString("responsable");
        String  tiendasesion= records[0].getAsString("tiendasesion");
          String  almacendestino= records[0].getAsString("idalmacendestino");
        if(estado=="pendiente"){
        if(tiendasesion==origen){
        datosnuevovendedor(idtraspaso,responsable,idmarca,almacendestino);
      
    }else{
        MessageBox.alert("No se puede cambiar vendedor este traspaso le corresponde al almacen que envia");
        }
        }else{
        MessageBox.alert("Este traspaso ya fue confirmado");

        }


                        } else {

                          MessageBox.alert("Por favor seleccione un traspaso para confirmar");
                        }

                    }


                });
 codigobarra.addListener(
                new ButtonListenerAdapter() {

                  @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                       //  Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idtraspaso");
    String enlTemp = "funcion=vercodigobarratraspaso&idtraspaso=" + selecionado;
         

  verReporte(enlTemp);

                } else {
                    MessageBox.alert("No hay traspasos selecionado para ver detalle y/o selecciono mas de uno.");
                }

                    }


                });
 codigob.addListener(
                new ButtonListenerAdapter() {

                  @Override
                    public void onClick(Button button, EventObject e) {
                        Record[] records = cbSelectionModel.getSelections();
                       //  Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idtraspaso");
                   String enlTemp = "funcion=vercodigostraspaso&idtraspaso=" + selecionado;
  //String enlTemp = "funcion=AdicionCodigoBarraIngresoHTML&idingreso=" + idventaG;

  verReporte(enlTemp);

                } else {
                    MessageBox.alert("No hay traspasos selecionado para ver detalle y/o selecciono mas de uno.");
                }

                    }


                });
        //**************************************************
        //***********NUEVO TRASPASO
        //**************************************************
      

        //**************************************************
        //***********REPORTE TRASPASO
        //**************************************************
        reporteTraspaso.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idtraspaso");
                   String enlTemp = "funcion=verboletatraspaso&idtraspaso=" + selecionado;
  //String enlTemp = "funcion=AdicionCodigoBarraIngresoHTML&idingreso=" + idventaG;

  verReporte(enlTemp);

                } else {
                    MessageBox.alert("No hay traspasos selecionado para ver detalle y/o selecciono mas de uno.");
                }
                reporteTraspaso.setPressed(false);
            }
        });
//
// 

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

    public void buscarSegunParametros() {
        buscarCodigo = buscadorToolBar.getItemsText1().getText();
        buscarFechaInicial = DateUtil.format(buscadorToolBar.getItemsDate2().getValue(), "d-m-Y");
        buscarTienda = buscadorToolBar.getItemsCombo3().getText();
          buscarTipo = buscadorToolBar.getItemsCombo4().getText();

       // com.google.gwt.user.client.Window.alert("codigo->  " + buscarCodigo + " fehca -->" + buscarFechaInicial + " tienda-> " + buscarTienda);
        store.reload(new UrlParam[]{
                    new UrlParam("start", 0), new UrlParam("limit", 100),
                    new UrlParam("buscarcodigo", buscarCodigo),
                    new UrlParam("buscarfecha", buscarFechaInicial),
                    new UrlParam("buscartienda", buscarTienda),
                    new UrlParam("buscartipo", buscarTipo)
                }, false);
    }
    private void datosnuevovendedor(final String idtraspaso ,final String responsable,String idmarca,String almacendestino) {
      // String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaEmpleado";
     //  String enlace = "php/VentaMayor.php?funcion=BuscarEmpleado";
        String enlace = "php/VentaMayor.php?funcion=BuscarEmpleadotraspaso&idmarca=" + idmarca+ "&iddestino="+almacendestino;

        Utils.setErrorPrincipal("Cargando parametros del Traspaso", "cargar");
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
                      //               Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
        Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "nombre"});

                                   

                                    formulario2 = null;
                                    formulario2 = new Cambiarvendedor( estiloM,idtraspaso,responsable, ListaTraspaso.this);
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

     public void cargarvender(final String idtraspaso,final String idmarca) {
     String enlace = "php/VentaMayor.php?funcion=BuscarEmpleadoCliente&idmarca=" + idmarca;
     Utils.setErrorPrincipal("Cargando parametros venta", "cargar");
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
       Object[][] vendedorM = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "codigo"});
       Object[][] clienteM = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});


       formulario_almv = null;
       formulario_almv = new MostraVenta(idtraspaso,clienteM,vendedorM,idmarca,"",ListaTraspaso.this);
       formulario_almv.show();
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
              //   GuardarCat.setPressed(false);
    }

private void cargarDatosConfigurarAnular(final String idtraspaso) {
        String enlace = "php/Traspaso.php?funcion=BuscarMaterialPorTraspaso&idtraspaso=" + idtraspaso;
        Utils.setErrorPrincipal("Cargando parametros del Traspaso", "cargar");
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
                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idtraspaso");
                                    String codigo = Utils.getStringOfJSONObject(marcaO, "boleta");
                                    String origen = Utils.getStringOfJSONObject(marcaO, "tiendaorigen");
                                    String destino = Utils.getStringOfJSONObject(marcaO, "tiendadestino");
                                    String fecha = Utils.getStringOfJSONObject(marcaO, "fecha");
                                    String estado = Utils.getStringOfJSONObject(marcaO, "responsable");

                                    formulario201 = null;
                                    formulario201 = new ConfigurarAnularForm(idtraspaso, codigo,origen,destino,fecha,estado, ListaTraspaso.this);
                                    formulario201.show();
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
    private void addListenersBuscador() {
        buscar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                buscarSegunParametros();
            }
        });
    }

    private void addListenersBuscadoresText() {

        //*********************************************************************
        //***************BUSCADOR DE ID************************************
        //*********************************************************************
        buscadorToolBar.getItemsText1().addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

        //*********************************************************************
        //***************BUSCADOR DE NOMBRE************************************
        //*********************************************************************
        buscadorToolBar.getItemsDate2().addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

        //*********************************************************************
        //***************BUSCADOR DE TIPO************************************
        //*********************************************************************
        buscadorToolBar.getItemsCombo3().addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });
           buscadorToolBar.getItemsCombo4().addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

    }
 
 private void recuperarAlmacenes() {
       SimpleStore tiposStore = new SimpleStore("tipos", clienteM);
        tiposStore.load();
        buscadorToolBar.getItemsCombo4().setDisplayField("tipos");
        buscadorToolBar.getItemsCombo4().setStore(tiposStore);

        ScriptTagProxy dataProxyAlmacenes = new ScriptTagProxy("php/Traspaso.php?funcion=ListarTienda");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idtienda"),
                    new StringFieldDef("codigo"),
                    new StringFieldDef("nombre"),
                    new StringFieldDef("estado"),
                    new StringFieldDef("idcliente"),
                    new StringFieldDef("telefono"),
                    new StringFieldDef("direccion")
                });
        JsonReader readerAlmacen = new JsonReader(recordDef);
        readerAlmacen.setRoot("resultado");
        readerAlmacen.setTotalProperty("totalCount");
        Store storeAlmacen = new Store(dataProxyAlmacenes, readerAlmacen, true);
        storeAlmacen.load();

        buscadorToolBar.getItemsCombo3().setDisplayField("nombre");
        buscadorToolBar.getItemsCombo3().setMode(ComboBox.REMOTE);
        buscadorToolBar.getItemsCombo3().setTriggerAction(ComboBox.ALL);
        buscadorToolBar.getItemsCombo3().setForceSelection(true);
        buscadorToolBar.getItemsCombo3().setValueField("idtienda");
        buscadorToolBar.getItemsCombo3().setReadOnly(true);
        buscadorToolBar.getItemsCombo3().setLoadingText("Buscando ...");
        buscadorToolBar.getItemsCombo3().setStore(storeAlmacen);

    }

public void registrarventa(String idtrasp,String idmarc,String idvendedo,String idclient,String fecha){
 this.idtraspaso = idtrasp;
       this.idmarca =idmarc;
        this.idvendedor = idvendedo;
       this.idcliente =idclient;
         this.mifecha = fecha;

                    JSONObject usuarioSoU = new JSONObject();
                    usuarioSoU.put("idtraspaso", new JSONString(idtraspaso));
                    usuarioSoU.put("idmarca", new JSONString(idmarca));
                    usuarioSoU.put("idvendedor", new JSONString(idvendedor));
                        usuarioSoU.put("idcliente", new JSONString(idcliente));
                    usuarioSoU.put("fecha", new JSONString(mifecha));
                    String datos = "resultado=" + usuarioSoU.toString();
                     String enlace = "php/VentaMayor.php?funcion=Registrarventatraspaso&" + datos;
                    //String enlace = "php/Planilla.php?funcion=Registraremisionplanilla&" + datos;

                     Utils.setErrorPrincipal("Registrando Venta", "cargar");
                    final Conector conec = new Conector(enlace, false, "POST");
                    try {
                        conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {
                            public void onResponseReceived(Request request, Response response) {
                                String data = response.getText();
                                JSONValue jsonValue = JSONParser.parse(data);
                                JSONObject jsonObject;
                                if ((jsonObject = jsonValue.isObject()) != null) {
                                    String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                   // String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                    if (errorR.equalsIgnoreCase("true")) {
               
  String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");

Utils.setErrorPrincipal("Ver formato para precios", "error");
                     // if (formularioc == null || formularioc.isHidden()) {
                     //   String montoventa = tex_totalsus.getValueAsString().trim();
                              showListProducto(idventaG);

                        formulario_almv.close();
            formulario_almv.destroy();
         //   kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);

            //abrirpanelreporte();
                         //  Window.alert(mensajeR);
                       // final String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");

                                    } else {
                                  MessageBox.alert("Existen un error en la generacion de planilla");
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

 private void showListProducto(String idventa) {
               String montoventa="0";
                        formulariocl = new FormularioKardexVenta(ListaTraspaso.this,idventa,montoventa);
                            formulariocl.show();
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

   
     
    private void verReporte(String enlace) {
       ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);

  //      ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace,"PDF");
        print.show();
    }
}

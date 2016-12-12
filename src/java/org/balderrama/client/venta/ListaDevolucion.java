/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.venta;
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
import com.gwtext.client.core.TextAlign;
import com.gwtext.client.core.UrlParam;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.Store;
import com.gwtext.client.util.DateUtil;
import com.gwtext.client.widgets.Toolbar;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import java.util.Date;
import org.balderrama.client.util.BuscadorToolBar;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.venta.FormularioEntrega;

/**
 *
 * @author
 */
public class ListaDevolucion extends Panel {

    private GridPanel grid;
       private MostraDevolucionMonto formulario_almv;
   //   protected FormularioTraspaso formularioTraspaso;
//    private ConfigurarMaterialForm formulario20;
 //   public ConfigurarAnularForm formulario201;
    private FormularioEntrega formularioEntrega;
      private ToolbarButton editarTraspaso;
    private ToolbarButton eliminarTraspaso;
    private ToolbarButton nuevoTraspaso;
    private ToolbarButton duplicar;
    private ToolbarButton reporteTraspaso;
    private ToolbarButton configurarMaterial;
     private ColumnConfig idColumn;
    private ColumnConfig codigoColumn;
    private ColumnConfig marcaColumn;
    private ColumnConfig tiendaColumn;
    private ColumnConfig totalparesColumn;
     private ColumnConfig totalcajasColumn;
      private ColumnConfig totalsusColumn;
     private ColumnConfig responsableColumn;
      private ColumnConfig idproformaColumn;
  private Object empresaC[][];
    protected String buscardocumento;
     protected String buscardocumento2;
      protected String buscardocumento3;
    protected String buscarFecha;
    private ColumnConfig fechaColumn;
    private ColumnConfig cantidadColumn;
    private ColumnConfig totalColumn;
    private ColumnConfig clienteColumn;
    private ColumnConfig clienteempresaColumn;
private Object clienteC[][];

    private ColumnConfig horaColumn;
    private ColumnConfig tipoventaColumn;
    private ColumnConfig creditoColumn;
 private ColumnConfig observacionColumn;
     private ColumnConfig idTraspasoColumn;
    private ColumnConfig almacenOrigenColumn;
    private ColumnConfig estadoColumn;
    private ColumnConfig boletaColumn;

        private ColumnConfig tcajasColumn;
        private ColumnConfig tparesColumn;
        private ColumnConfig tsusColumn;
        private ColumnConfig descuentoColumn;
        private ColumnConfig montoColumn;
        private ColumnConfig fechacColumn;

    private final int ANCHO = Utils.getScreenWidth() - 24;
    private final int ALTO = Utils.getScreenHeight() - 275;
    private ToolbarButton anularIngreso;
    private ToolbarButton eliminarModelo;
   private ToolbarButton verdetalle;
//    private Toolbar too_busquedaPBW;
    private ToolbarButton buscar;
   private ToolbarButton verVenta;
  //  private ToolbarButton verDetalleVenta;
  //  private ToolbarButton verVentaDiaria;
   // private ToolbarButton verVentaVendedor;
   // private ToolbarButton anularVenta;
   // private ToolbarButton confirmarventa;
    private ToolbarButton eliminarVenta;
  //  private ToolbarButton editarVenta;

    private BuscadorToolBar buscadorToolBar;
 
    private EditarModeloForm formulario;
    private ToolbarButton CodigoBarra;
    private ToolbarButton codlineaMarca;
    private ToolbarButton codcolorMarca;
    private ToolbarButton codmaterialMarca;
    private ToolbarButton configurarMarca;
    private ToolbarButton cargarimagenMarca;
    private FormularioConsultas formularioConsultas;
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
     // private ToolbarButton buscar;
      private Toolbar too_busquedaPBW;
   private ComboBox com_marca;
 private ToolbarButton verVentacompleta;

       public TextField tex_apellidosPBU;
        public TextField tex_ciPBU;
         private DateField dat_fecha;
          private DateField dat_fecha1;
    public ListaDevolucion(KMenu kmenu) {
        padre=kmenu;

        this.setClosable(true);
        this.setId("TPfun6004");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Lista de Devolucion");
        onModuleLoad();
    }

    public void onModuleLoad() {
     DataProxy dataProxy = new ScriptTagProxy("php/VentaMayor.php?funcion=ListarVentaDevolucion");
//     DataProxy dataProxy = new ScriptTagProxy("php/VentaMayor.php?funcion=ListarVentaMayor");

     final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("iddevolucion"),
                    new StringFieldDef("idventa"),
                    new StringFieldDef("boleta"),
                    new StringFieldDef("fecha"),
                    new StringFieldDef("hora"),
                    new StringFieldDef("vendedor"),
                    new StringFieldDef("marca"),
                    new StringFieldDef("cliente"),
                    new StringFieldDef("totalpares"),
                    new StringFieldDef("totalsus"),
                    new StringFieldDef("estadomayor")
                });

       JsonReader reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true); //nada
 fechaColumn = new ColumnConfig("Fecha", "fecha", 100, false);
           horaColumn = new ColumnConfig("Hora", "hora", 65, false);
            idColumn = new ColumnConfig("Boleta", "idventa", 65, false);
                      boletaColumn = new ColumnConfig("Boleta", "boleta", 65, false);
      //    creditoColumn = new ColumnConfig("almacen", "almacen", 120, false);
        cantidadColumn = new ColumnConfig("vendedor", "vendedor", 120, false);
       cantidadColumn.setAlign(TextAlign.CENTER);
        totalColumn = new ColumnConfig("marca", "marca", 120, false);
         clienteempresaColumn = new ColumnConfig("cliente", "cliente", 160, false);
      //   tipoventaColumn = new ColumnConfig("tipoventa", "tipoventa", 90, false);

       //    tcajasColumn = new ColumnConfig("tcajas", "tcajas", 90, false);
            tparesColumn = new ColumnConfig("totalpares", "totalpares", 100, false);
             tsusColumn = new ColumnConfig("totalsus", "totalsus", 100, false);
    estadoColumn = new ColumnConfig("estado", "estadomayor", 100, false);
        cbSelectionModel = new CheckboxSelectionModel();
        CheckboxColumnConfig checkBoxColumn = new CheckboxColumnConfig(cbSelectionModel);
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                   fechaColumn,
                   horaColumn,
                   boletaColumn,
                   cantidadColumn,
                   totalColumn,
                   clienteempresaColumn,
                   tparesColumn,
                   tsusColumn,
                   estadoColumn,};

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-ventas-mayor-dev");
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

        verVenta = new ToolbarButton("ver devolucion");
        verVenta.setEnableToggle(true);
        QuickTipsConfig tipsConfig6 = new QuickTipsConfig();
        tipsConfig6.setText("Ver ");
        //tipsConfig.setTitle("Tip Title");
        verVenta.setTooltip(tipsConfig6);

      

        eliminarVenta = new ToolbarButton("Ver venta original");
        eliminarVenta.setEnableToggle(true);
        QuickTipsConfig tipsConfig19 = new QuickTipsConfig();
        tipsConfig19.setText("Ver venta");
        //tipsConfig.setTitle("Tip Title");
        eliminarVenta.setTooltip(tipsConfig19);

        verVentacompleta = new ToolbarButton("Confirmar Devolucion");
        verVentacompleta.setEnableToggle(true);
        QuickTipsConfig tipsConfig65 = new QuickTipsConfig();
        tipsConfig6.setText("Confirmar Venta");
        //tipsConfig.setTitle("Tip Title");
        verVentacompleta.setTooltip(tipsConfig65);
   
        PagingToolbar pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No hay datos para mostrar");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(verVenta);
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarVenta);
        pagingToolbar.addSeparator();
          pagingToolbar.addSeparator();
        pagingToolbar.addButton(verVentacompleta);
       //para el buscador
   too_busquedaPBW = new Toolbar();
        tex_ciPBU = new TextField("Boleta", "codigo",100);
        com_marca = new ComboBox("Marca", "nombre");
        tex_apellidosPBU = new TextField("Vendedor", "responsable");
        dat_fecha = new DateField("Fecha FIN", "Y-m-d");
        Date date = new Date();
        dat_fecha.setValue(Utils.getStringOfDate(date));
        dat_fecha1 = new DateField("Fecha INI", "Y-m-d");
        Date date1 = new Date();
        dat_fecha1.setValue(Utils.getStringOfDate(date1));
       // com_tipo = new ComboBox("Confirmados", "confirma");
		buscar = new ToolbarButton("Buscar");
        buscar.setPressed(true);

        too_busquedaPBW.addText("Boleta:");
        too_busquedaPBW.addField(tex_ciPBU);
        too_busquedaPBW.addText("Marca:");
        too_busquedaPBW.addField(com_marca);
        too_busquedaPBW.addText("Vendedor:");
        too_busquedaPBW.addField(tex_apellidosPBU);
        too_busquedaPBW.addText("Fecha Ini:");
        too_busquedaPBW.addField(dat_fecha1);
               too_busquedaPBW.addText("Fecha Fin:");
        too_busquedaPBW.addField(dat_fecha);
//                too_busquedaPBW.addText("filtrar:");
//        too_busquedaPBW.addField(com_tipo);
        too_busquedaPBW.addButton(buscar);
        grid.setTopToolbar(too_busquedaPBW);

        grid.setBottomToolbar(pagingToolbar);

         recuperarAlmacenes();
aniadirListenersBuscador();

        aniadirListenersBuscadoresText();
        add(grid);
//        addListenersBuscador();
//        addListenersBuscadoresText();
        aniadirListenersCompra();
    }
 private void aniadirListenersCompra() {
  verVentacompleta.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("iddevolucion");
                    String estado = records[0].getAsString("estadomayor");
                     String boletas= records[0].getAsString("idventa");
                     String montototal= records[0].getAsString("totalsus");
            if(estado!="PENDIENTE"){
             MessageBox.alert("La devolucion ya fue confirmada ");

        }else{
             formulario_almv = null;
             formulario_almv = new MostraDevolucionMonto(montototal,selecionado,boletas,ListaDevolucion.this);
             formulario_almv.show();
         //    cargarDatosconfirmar(selecionado,boletas);

        }

                } else {
                    MessageBox.alert("No hay Venta selecionado para confirmar y/o selecciono mas de uno.");
                }
                verVentacompleta.setPressed(false);
            }
        });
        verVenta.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("iddevolucion");

             String enlTemp = "funcion=verboletaventadevolucion&idventa=" + selecionado;
            verReporte(enlTemp);

                } else {
                    MessageBox.alert("No hay Venta selecionado para ver detalle y/o selecciono mas de uno.");
                }
                verVenta.setPressed(false);
            }
        });

    
        eliminarVenta.addListener(new ButtonListenerAdapter() {
               @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idventa");
             String enlTemp = "funcion=verboletaventa&idventa=" + selecionado;
            verReporte(enlTemp);

                } else {
                    MessageBox.alert("No hay Venta selecionado para ver detalle y/o selecciono mas de uno.");
                }
                eliminarVenta.setPressed(false);
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

       public void cargarDatosconfirmar(String iddevolucion,final String idventa) {
                    JSONObject usuarioSoU = new JSONObject();
                      usuarioSoU.put("iddevolucion", new JSONString(iddevolucion));
                    usuarioSoU.put("idventa", new JSONString(idventa));
                    String datos = "resultado=" + usuarioSoU.toString();

           String enlace = "php/Cobros.php?funcion=Confirmardevolucionunidad&" + datos;
                    Utils.setErrorPrincipal("Guardando ", "cargar");
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
                                            MessageBox.alert("Se confirmo exitosamente");
                                            reload();
                                      } else {
                                  MessageBox.alert("Existen un error"+ mensajeR);
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

private void procesoValidar(final String idventa) {

                String enlace = "php/Ventadetalle.php?funcion=BuscarUsuario";
                Utils.setErrorPrincipal("Cargando parametros ", "cargar");
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
//                                        String idalmacen = Utils.getStringOfJSONObject(jsonObject, "idalmacen");
//                                        String nombrealmacen = Utils.getStringOfJSONObject(jsonObject, "nombrealmacen");
                                        if (errorR.equalsIgnoreCase("true")) {
                                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                                            JSONValue resultadoValue = jsonObject.get("resultado");
                                            JSONObject compraObject;
                                            if ((compraObject = resultadoValue.isObject()) != null) {


                                                empresaC = Utils.getArrayOfJSONObject(compraObject, "usuarioM", new String[]{"idusuario", "login"});
//                                                if (empresaC != null) {
//                                                    formularioConsultas = new FormularioConsultas(idventa,empresaC,ListaDevolucion.this);
//                                                    formularioConsultas.show();
//
//                                                }
                                            } else {
                                                Utils.setErrorPrincipal("No se recuperaron correctamente lo valores", "error");
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
public void eliminarventa(String idventa,String usuario) {

    String enlace = "php/VentaDetalle.php?funcion=eliminarventa&idventadetalle=" + idventa + "&idusuario=" + usuario;
                                Utils.setErrorPrincipal("Eliminando la venta", "cargar");
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
                                          //          Window.alert(mensajeR);
                                                    store.reload();
                                                    grid.reconfigure(store, columnModel);
                                                    grid.getView().refresh();
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
  public void aniadirListenersBuscador() {

        buscar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Utils.setErrorPrincipal("Se realizo la busqueda", "mensaje");
                buscarSegunParametros();
            }
        });
    }
  private void onChangeempresa() {
        //com_almacen.setDisabled(true);
      buscarSegunParametros();
        //     tex_montoPapeleta.focus();
  }

    public void aniadirListenersBuscadoresText() {
         com_marca.addListener(new ComboBoxListenerAdapter() {

            @Override
            public void onSelect(ComboBox comboBox, Record record, int index) {
                onChangeempresa();
            }
        });
        //**************************************************
        //*********** BUSCADOR CI
        //**************************************************
         com_marca.addListener(new TextFieldListenerAdapter() {

                    @Override
                    public void onSpecialKey(Field field, EventObject e) {
                        if (e.getKey() == EventObject.ENTER) {
                            buscarSegunParametros();
                        //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 2");
                        }
                    }
                });
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
        dat_fecha.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 2");
                }
            }
        });

    }


private void cargarDatosPanelPedido(final String idestilo) {

    String enlace = "php/VentaDetalle.php?funcion=CargarModificarVendedor&venta=" + idestilo;
                        Utils.setErrorPrincipal("Cargando parametros", "cargar");
                        final Conector conec = new Conector(enlace, false);
                        {
                            try {
                                conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                                    private EventObject e;

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

   Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "codigo"});
String idventadetalle = Utils.getStringOfJSONObject(marcaO, "idventadetalle");
  String totalpares = Utils.getStringOfJSONObject(marcaO, "cantidad");
   String totalbs = Utils.getStringOfJSONObject(marcaO, "ingresototalbs");
 String fecha = Utils.getStringOfJSONObject(marcaO, "fecha");
 String credito = Utils.getStringOfJSONObject(marcaO, "credito");
 String descuento = Utils.getStringOfJSONObject(marcaO, "descuento");
 String observacion = Utils.getStringOfJSONObject(marcaO, "observacion");
 String numero = Utils.getStringOfJSONObject(marcaO, "numero");
 String boleta = Utils.getStringOfJSONObject(marcaO, "boleta");
 String nit = Utils.getStringOfJSONObject(marcaO, "nit");
  String tipofactura = Utils.getStringOfJSONObject(marcaO, "tipofactura");
 String apellido = Utils.getStringOfJSONObject(marcaO, "apellidocliente");


//    PanelVentaDetalle pan_compraDirecta = new PanelVentaDetalle(idventadetalle,tipofactura,boleta,nit,apellido, totalpares,totalbs,fecha,credito ,descuento,observacion,numero,colores,ListaVenta.this,padre);
// padre.seleccionarOpcion(null, "fun6001", e, pan_compraDirecta);

         Utils.setErrorPrincipal("Se cargaron los parametros Correctamente", "mensaje");


                                                } else {
                                                    MessageBox.alert("La venta ya arqueda no puede modificarse, consulte al administrador");
                                                }
                                            }
                                            else{
                                                MessageBox.alert("La venta ya arqueda no puede modificarse, consulte al administrador");
                                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                                            }
                                        } else {
                                        }
                                        throw new UnsupportedOperationException("Not supported yet.");
                                    }

                                    public void onError(Request request, Throwable exception) {
                                        throw new UnsupportedOperationException("Not supported yet.");
                                    }
                                });

                            } catch (RequestException ea) {
                                ea.getMessage();
                                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
                            }

                        }



                    }

//    public void buscarSegunParametros() {
//        buscardocumento = buscadorToolBar.getItemsText1().getText();
//        buscarFecha = DateUtil.format(buscadorToolBar.getItemsDate2().getValue(), "Y-m-d");
////        buscarCliente = buscadorToolBar.getItemsText3().getText();
//        store.reload(new UrlParam[]{
//                    new UrlParam("start", 0), new UrlParam("limit", 100),
//                    new UrlParam("buscarcliente", buscardocumento),
//                    new UrlParam("buscarfecha", buscarFecha),
////                    new UrlParam("buscarcliente", buscarCliente)
//                }, false);
//    }
 public void buscarSegunParametros() {

           store.reload(new UrlParam[]{new UrlParam("start", 0), new UrlParam("limit", 500),
                    new UrlParam("buscarboleta", tex_ciPBU.getText()),
                    new UrlParam("buscarmarca", com_marca.getText()),
                    new UrlParam("buscarvendedore", tex_apellidosPBU.getText()),
                    new UrlParam("buscafechaini", DateUtil.format(dat_fecha1.getValue(), "Y-m-d")),
				//	new UrlParam("filtro", com_tipo.getText()),
           new UrlParam("buscafecha", DateUtil.format(dat_fecha.getValue(), "Y-m-d"))}, false);

    }
  private void cargarDatosentrega(String idventa) {
 
       Record[] records = cbSelectionModel.getSelections();
                     String tcajas = records[0].getAsString("tcajas");
                    String tpares = records[0].getAsString("totalpares");
                     String tsus = records[0].getAsString("totalsus");
                    String descuento = records[0].getAsString("descuento");
                     String montoapagar = records[0].getAsString("montoapagar");
                    String fechacancelacion = records[0].getAsString("fechacancelacion");
                      String fechas = records[0].getAsString("fecha");
//                              formularioEntrega = new FormularioEntrega(idventa,tcajas,tpares,tsus,descuento,montoapagar,fechas,fechacancelacion,ListaDevolucion.this);
//                                                    formularioEntrega.show();
   }
private void recuperarAlmacenes() {

           ScriptTagProxy dataProxyAlmacenes = new ScriptTagProxy("php/Marca.php?funcion=ListarMarcas");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                     new StringFieldDef("idmarca"),
                    new StringFieldDef("codigo"),
                     new StringFieldDef("nombre")
                });
        JsonReader readerAlmacen = new JsonReader(recordDef);
        readerAlmacen.setRoot("resultado");
        readerAlmacen.setTotalProperty("totalCount");
        Store storeAlmacen = new Store(dataProxyAlmacenes, readerAlmacen, true);
        storeAlmacen.load();

        com_marca.setMinChars(1);
        com_marca.setStore(storeAlmacen);
        com_marca.setValueField("nombre");
        com_marca.setDisplayField("nombre");
        com_marca.setForceSelection(true);
        com_marca.setMode(ComboBox.LOCAL);
        com_marca.setEmptyText("Seleccione marca");

        com_marca.setLoadingText("buscando...");
        com_marca.setTypeAhead(true);
        com_marca.setSelectOnFocus(true);
        com_marca.setWidth(200);

        com_marca.setHideTrigger(true);


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

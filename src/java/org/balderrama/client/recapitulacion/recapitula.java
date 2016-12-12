/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.recapitulacion;
import com.gwtext.client.core.RegionPosition;
import com.gwtext.client.widgets.PaddedPanel;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.layout.BorderLayout;
import com.gwtext.client.widgets.layout.BorderLayoutData;
import com.gwtext.client.widgets.layout.HorizontalLayout;
import com.gwtext.client.widgets.layout.TableLayout;
import com.gwtext.client.widgets.layout.TableLayoutData;

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
import org.balderrama.client.util.Conector;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.UrlParam;
import com.gwtext.client.data.FieldDef;
import com.gwtext.client.data.JsonReader;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.RecordDef;
import com.gwtext.client.data.ScriptTagProxy;
import com.gwtext.client.data.Store;
import com.gwtext.client.data.StringFieldDef;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.Toolbar;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.TextArea;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.event.EditorGridListenerAdapter;
import com.gwtext.client.widgets.layout.FitLayout;
import java.util.Date;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
//import org.balderrama.client.cliente.ClienteDetalle;
import org.balderrama.client.util.ReporteMediaCartaChorroWindowg;

public class recapitula extends Panel {

    public EditorGridPanel gridCategoria;
    private JsonReader reader;
    private ColumnConfig idColumn;
    private ColumnConfig estadoColumn;
        private ColumnConfig observacionColumn;
    private ColumnConfig nombreColumn;
// public EditarClienteForm formularioCliente;
    private ColumnConfig fechaColumn ;
 private Store proveedorStore11;
       private ColumnConfig cantidadColumn;
       private ColumnConfig totalColumn;
       private ColumnConfig saldoColumn;
       private ColumnConfig tiempoColumn;
              private ColumnConfig facturaColumn;
         private ColumnConfig tipoColumn;
           private ColumnConfig tiendaColumn;
private ColumnConfig empresaColumn;
        private ColumnConfig clienteColumn;
private ColumnConfig boletaColumn;
        private ColumnConfig papeletaColumn;
        private Object[][] vendedorM;
          private Object[][] clienteM;
            protected String buscarCi;
    protected String buscarNombres;
    protected String buscarApellido;
	protected String buscarEmpresa;
    protected String buscarLogin;
     private TextField tex_rango;
    // private TextField tex_modeloCP;
    private TextField tex_totalpares;
    private TextField tex_totalbs;
    private TextField tex_preciototal;
    private DateField dat_fecha;
    //private ListaPedidoCalzados lista;
    private Listamarcarecapitula lista1;
    boolean respuesta = false;
    private TextArea tea_descripcion;
    private Button but_aceptar;

    private Button but_aceptarR;
 //private Button but_imprimir;
    private Button but_cancelar;

    private Button but_limpiar;
    public KMenu kmenu;
    String selecionado = "";
    String marca;
    String idmarca;
    String opcion;
        String totalpares;
    String totalbs;
  String mesrango;
    String opcionnueva;
    String fecha;
    String idkardex;
     String idtienda;
    private ToolbarButton buscar;
      private Toolbar too_busquedaPBW;
//String selecionado = "";
    private final int ANCHO = Utils.getScreenWidth() - 23;
   // private final int ALTO = Utils.getScreenHeight() - 170;
   private final int ALTO = 470;

    private ToolbarButton GuardarCat;
    private ToolbarButton VerEmpresa;
    private ToolbarButton eliminarCat;
    private ToolbarButton nuevoCliente;
    private ToolbarButton verVenta;
    private ToolbarButton subcategoriaCat;
    private ToolbarButton cuentasCat;
    protected ExtElement ext_element;
     private Object[][] empresaM;
   //  private Object[][] clienteM;
        private Object[][] clienteM1;
    public CheckboxSelectionModel cbSelectionModel;
    public Store store;
    private BaseColumnConfig[] columns;
    private ColumnModel columnModel;
    private RecordDef recordDef;
    private int id = 0;
    private TextField tex_marca;
     int columnaseleccionada =0;
      String escolumna ="";
    private PagingToolbar pagingToolbar;
     private String COMPRA_DIRECTA_TABBED = "9777000_venta-";

   // private SubCategoria subcats;
   // private CuentaProducto cuentaProducto;
public KMenu padre;
  // public ComboBox com_cliente;
     public ComboBox com_empresa;
     public String tpares;
     public String tbs;
      public String tien1;
       public String tien2;
           public String tien3;
        public String tpares1;
       public String tbs1;
        public String tpares2;
       public String tbs2;
         public String tpares3;
       public String tbs3;
     String detalle;
     String nombreempresa;
  String nombrecliente;
   private ComboBox com_clientes;

   public recapitula(String idmarca,  String vendedor, Object[][] vendedores, Object[][] clientes, String tipocambio, String almacen,  KMenu padre) {

        //this.SM = SM;
       // this.fmayor = tipomarca;
        this.kmenu = padre;
        this.marca = vendedor;
        this.idmarca = idmarca;

        this.vendedorM = vendedores;
        this.clienteM = clientes;
         this.opcion = tipocambio;

        onModuleLoad();
    }



   public void onModuleLoad() {

          setId("tab-" + COMPRA_DIRECTA_TABBED);
        setTitle("Recapitulacion");
        setLayout(new FitLayout());
        setBaseCls("x-plain");
        this.setClosable(true);
        this.setId("TPfun2308");
        setIconCls("tab-icon");

 //MessageBox.alert(totalbs);
        Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");

        Panel pan_norte = new Panel();
        pan_norte.setLayout(new TableLayout(3));
        pan_norte.setBaseCls("x-plain");
        pan_norte.setHeight(90);
        pan_norte.setPaddings(5);
        Panel pan_sud = new Panel();
        pan_sud.setLayout(new TableLayout(1));
        pan_sud.setBaseCls("x-plain");
        pan_sud.setHeight(50);
        pan_sud.setPaddings(5);
       //  if (opcion.equalsIgnoreCase("6")) {
            lista1 = new Listamarcarecapitula();
            lista1.onModuleLoad5(idmarca, idkardex,idtienda);
            this.opcionnueva = "12";
        //Panel pan_centro = lista1.getPanel();
       // }

        Panel pan_centro = lista1.getPanel();

        FormPanel for_panel1 = new FormPanel();
        for_panel1.setBaseCls("x-plain");
        for_panel1.setWidth(330);
        for_panel1.setLabelWidth(100);
        tex_marca = new TextField("Marca", "marca", 200);
        tex_marca.setValue(marca);
        tex_marca.setReadOnly(true);
        for_panel1.add(tex_marca);
       // for_panel1.add(tex_numeropedido);

        // for_panel1.add(tex_modeloCP);

        FormPanel for_panel2 = new FormPanel();
        for_panel2.setBaseCls("x-plain");
        for_panel2.setWidth(330);
        for_panel2.setLabelWidth(100);
        tex_totalpares = new TextField("Total Pares", "totalpares", 200);
        tex_totalpares.setReadOnly(true);
        tex_totalpares.setValue(totalpares);

    tex_totalbs = new TextField("Total Bs", "totalbs", 200);
        tex_totalbs.setReadOnly(true);
        tex_totalbs.setValue(totalbs);
        but_aceptar = new Button("Formato Impresion Capital");
        but_cancelar = new Button("Cancelar");

     for_panel2.add(tex_totalpares);
       for_panel2.add(tex_totalbs);

        FormPanel for_panel3 = new FormPanel();
        for_panel3.setBaseCls("x-plain");
        for_panel3.setWidth(300);
        for_panel3.setLabelWidth(100);

        dat_fecha = new DateField("Fecha", "d-m-Y");
        Date date = new Date();
        dat_fecha.setValue(Utils.getStringOfDate(date));
        // dat_fecha.setValue(fecha);
         tex_rango = new TextField("Mes Periodo", "rango", 200);
        tex_rango.setReadOnly(true);
        tex_rango.setValue(mesrango);
        for_panel3.add(dat_fecha);
for_panel3.add(tex_rango);


        pan_norte.add(new PaddedPanel(for_panel1, 10));
        pan_norte.add(new PaddedPanel(for_panel2, 10));
        pan_norte.add(new PaddedPanel(for_panel3, 10));
//        pan_norte.add(new PaddedPanel(for_panel12, 0, 0, 13, 10));

        FormPanel for_panel4 = new FormPanel();
        for_panel4.setBaseCls("x-plain");

        tex_preciototal = new TextField("", "totalprecio");
// tex_totalcaja.setValue(totalcajas);
        for_panel4.add(tex_preciototal);


        FormPanel for_panel6 = new FormPanel();
        for_panel6.setBaseCls("x-plain");
        tea_descripcion = new TextArea("Observacion", "observacion");
        tea_descripcion.setWidth("100%");

        for_panel6.add(tea_descripcion);

        Panel pan_botones = new Panel();
        pan_botones.setLayout(new HorizontalLayout(10));
        pan_botones.setBaseCls("x-plain");
        //       pan_botones.setHeight(40);

        but_limpiar = new Button("Limpiar");
        but_aceptarR = new Button("Reporte");
//but_imprimir = new Button("Imprimir Lista");
 //       pan_botones.add(but_imprimir);
        //but_verproducto = new Button("Ver Producto");
        pan_botones.add(but_aceptar);
        pan_botones.add(but_cancelar);
        pan_botones.add(but_aceptarR);

        pan_sud.add(new PaddedPanel(pan_botones, 10, 200, 10, 10), new TableLayoutData(3));


        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centro, new BorderLayoutData(RegionPosition.CENTER));
        pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        add(pan_borderLayout);

        //initCombos();
        //  initValues();
        addListeners();


    }

    private void addListeners() {

   but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
//      kmenu.seleccionarOpcionRemove(null, "fun2308", e, recapitula.this);


 // abrirpanelreporte();
            }
        });

        //**************************************************
        //************* BOTON ACEPTAR *******************
        //**************************************************
         but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
           String idmarca="mar-1";
String idestilo="mar-1";
String idkardex="mar-1";
      String enlace = "funcion=VerRecapitulacion&idmarca=" + idmarca + "&idestilo="+idestilo+ "&idkardex="+idkardex;
               verReporteGrande(enlace);
            }
        });

    but_aceptarR.addListener(new ButtonListenerAdapter() {

            @Override

            public void onClick(Button button, EventObject e) {
           //      String idmarca = com_marca.getValue();
        //String idestilo = com_estilo.getValue();
//
//                    String enlace = "funcion=verIngresosMarcaEstiloHTML&idmarca=" + idmarca + "&idestilo="+idestilo;
//               verReporte(enlace);

            }
        });


        lista1.getGrid().addEditorGridListener(new EditorGridListenerAdapter() {

            @Override
            public void onAfterEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
         //       calcularSubTotal(grid, record, field, newValue, oldValue, rowIndex, colIndex);
            }
        });
    }

private void recuperarAlmacenes() {


           ScriptTagProxy dataProxyAlmacenes = new ScriptTagProxy("php/Empresa.php?funcion=ListarEmpresa");
        final RecordDef recordDef2 = new RecordDef(new FieldDef[]{
                     new StringFieldDef("idempresa"),
                    new StringFieldDef("codigo"),
                     new StringFieldDef("nombre")
                });
        JsonReader readerAlmacen = new JsonReader(recordDef2);
        readerAlmacen.setRoot("resultado");
        readerAlmacen.setTotalProperty("totalCount");
        Store storeAlmacen = new Store(dataProxyAlmacenes, readerAlmacen, true);
        storeAlmacen.load();

        com_clientes.setMinChars(1);
        com_clientes.setStore(storeAlmacen);
        com_clientes.setValueField("idempresa");
        com_clientes.setDisplayField("nombre");

        com_clientes.setForceSelection(true);
        com_clientes.setMode(ComboBox.LOCAL);
        com_clientes.setEmptyText("Seleccione una empresa");

        com_clientes.setLoadingText("buscando...");
        com_clientes.setTypeAhead(true);
        com_clientes.setSelectOnFocus(true);
        com_clientes.setWidth(200);

        com_clientes.setHideTrigger(true);


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
  public void aniadirListenersBuscadoresText() {
         com_clientes.addListener(new ComboBoxListenerAdapter() {

            @Override
            public void onSelect(ComboBox comboBox, Record record, int index) {
                onChangeempresa();
            }
        });
        //**************************************************
        //*********** BUSCADOR CI
        //**************************************************
         com_clientes.addListener(new TextFieldListenerAdapter() {

                    @Override
                    public void onSpecialKey(Field field, EventObject e) {
                        if (e.getKey() == EventObject.ENTER) {
                            buscarSegunParametros();
                        //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 2");
                        }
                    }
                });

    }
   private void onChangeempresa() {
        //com_almacen.setDisabled(true);
      buscarSegunParametros();
        //     tex_montoPapeleta.focus();
  }
 public void buscarSegunParametros() {
        store.reload(new UrlParam[]{new UrlParam("start", 0), new UrlParam("limit", 500),
                    new UrlParam("buscarempresa", com_clientes.getText())}, false);
    }

    private void aniadirListenersRoles() {
        GuardarCat.addListener(new ButtonListenerAdapter() {

            private boolean procederAEliminar;
            int repeat = 0;
            Record[] records;

            @Override
            public void onClick(Button button, EventObject e) {
                records = cbSelectionModel.getSelections();

                   //records = gridCategoria.getStore().getModifiedRecords();

       if (records.length > 0) {
                   MessageBox.confirm("Guardar", "Realmente desea validar : " + records.length + " producto(s)?", new MessageBox.ConfirmCallback() {
                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                JSONArray productos = new JSONArray();
                                JSONObject productoObject;
                              for (int i = 0; i < records.length; i++) {
                                    productoObject = new JSONObject();
                                   productoObject.put("idventadetalle", new JSONString(records[i].getAsString("idventadetalle")));
                                   productoObject.put("total", new JSONString(records[i].getAsString("total")));
                                   productoObject.put("saldo", new JSONString(records[i].getAsString("saldo")));
                                   productoObject.put("cantidad", new JSONString(records[i].getAsString("cantidad")));
                                    productoObject.put("tiempocredito", new JSONString(records[i].getAsString("tiempocredito")));
                                productoObject.put("empresa", new JSONString(records[i].getAsString("nombreempresa")));
                                productoObject.put("cliente", new JSONString(records[i].getAsString("nombrecliente")));
                                productoObject.put("papeleta", new JSONString(records[i].getAsString("papeleta")));
                                productoObject.put("estado", new JSONString(records[i].getAsString("estado")));
                                productos.set(i, productoObject);
                                    productoObject = null;
                                }
                                //eliminar
                                JSONObject resultado = new JSONObject();
                                 resultado.put("productos", productos);

                               String datos = "resultado=" + resultado.toString();
                               Utils.setErrorPrincipal("Validando venta(s)", "cargar");
                                String url = "./php/VentaCredito.php?funcion=GuardaryValidar&" + datos;
        final Conector conec = new Conector(url, false, "POST");
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
                                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
                                                    store.reload();
                                                //    grid.reconfigure(store, columnModel);
                                                //    grid.getView().refresh();
                                                } else {
                                                    //Window.alert(mensajeR);
                                                    com.google.gwt.user.client.Window.alert("error 1000");
                                                    Utils.setErrorPrincipal(mensajeR, "error");
                                                }
                                            } else {
                                                com.google.gwt.user.client.Window.alert("error 1001");
                                                Utils.setErrorPrincipal("Error en la respuesta del servidor", "error");
                                            }
                                        }

                                        public void onError(Request request, Throwable exception) {
                                            //Window.alert("Ocurrio un error al conectar con el servidor ");
                                            com.google.gwt.user.client.Window.alert("error 1002");
                                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                                        }
                                    });
                                } catch (RequestException ex) {
                                    //Window.alert("Ocurrio un error al conectar con el servidor");
                                    com.google.gwt.user.client.Window.alert("error 1003");
                                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                                }
                            }//fin boton
                        }
                    });
                } else {
                    MessageBox.alert("No hay producto selecionado para editar y/o selecciono mas de uno.");
                }
                GuardarCat.setPressed(false);
            }
        });
        //validar


verVenta.addListener(new ButtonListenerAdapter() {

            private boolean procederAEliminar;
            int repeat = 0;

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idventadetalle");
                    String enlTemp = "funcion=reporteventaHTML&idventadetalle=" + selecionado;
                    verReporte(enlTemp);

                } else {
                    MessageBox.alert("No hay venta selecionado para ver detalle y/o selecciono mas de uno.");
                }
                verVenta.setPressed(false);
            }
        });

     VerEmpresa.addListener(new ButtonListenerAdapter() {

            private boolean procederAEliminar;
            int repeat = 0;

            @Override
            public void onClick(Button button, EventObject e) {
         //       ClienteDetalle cliente = new ClienteDetalle();
          //  padre.seleccionarOpcion(null, "fun10022", e, cliente);

                VerEmpresa.setPressed(false);
            }
        });

         nuevoCliente.addListener(new ButtonListenerAdapter() {

            private boolean procederAEliminar;
            int repeat = 0;

            @Override

            public void onClick(Button button, EventObject e) {

//                formularioCliente = new EditarClienteForm(null, recapitula.this);
//                formularioCliente.show();
                nuevoCliente.setPressed(false);
//               formularioCliente = new EditarClienteForm(null, VentasCredito.this);
//                formularioCliente.show();

            }
        });

//modifica



    }

    
    public void reloadGrid() {

        store.rejectChanges();
        store.reload(new UrlParam[]{new UrlParam("start", 0), new UrlParam("limit", 100)}, false);
        store.rejectChanges();
        gridCategoria.getView().refresh();
    }

     private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
private void verReporteGrande(String enlace) {
        ReporteMediaCartaChorroWindowg print = new ReporteMediaCartaChorroWindowg(enlace);
        print.show();
    }

//

}
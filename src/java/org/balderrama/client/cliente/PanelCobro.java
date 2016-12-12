/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.cliente;

import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.Position;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.core.RegionPosition;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.data.JsonReader;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.ArrayReader;

import com.gwtext.client.data.GroupingStore;
import com.gwtext.client.data.RecordDef;
import com.gwtext.client.data.ScriptTagProxy;
import com.gwtext.client.util.DateUtil;
import com.gwtext.client.widgets.Component;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.PaddedPanel;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.event.PanelListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.NumberField;
import com.gwtext.client.widgets.form.TextArea;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.layout.BorderLayout;
import com.gwtext.client.widgets.layout.BorderLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.HorizontalLayout;
import com.gwtext.client.widgets.layout.TableLayout;
import com.gwtext.client.widgets.layout.TableLayoutData;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.grid.event.EditorGridListenerAdapter;
import com.gwtext.client.widgets.grid.event.GridCellListenerAdapter;
import com.gwtext.client.widgets.grid.event.GridColumnListener;
import com.gwtextux.client.data.PagingMemoryProxy;
import java.util.Date;
import org.balderrama.client.MainEntryPoint;
import org.balderrama.client.emergentes.SeleccionMarcaKardex;
import org.balderrama.client.util.Conector;
//import org.balderrama.client.marca.Marca;
import org.balderrama.client.util.KMenu;
//import org.balderrama.client.util.ReporteMediaCartaChorroWindowPeque;
import org.balderrama.client.util.Utils;
//import org.balderrama.client.util.Validacion;
import com.gwtext.client.widgets.grid.GridPanel;
//import org.balderrama.client.util.ReporteTraspasoPendiente;

public class PanelCobro extends Panel {
 private SeleccionMarcaKardex SM;
public MostrarCobros formulario_alm;
//private MostrarCobrosPP formulario_almPP;
   public EditorGridPanel grid1018;
   private final int ANCHO = 400;
    private final int ALTO = 260;
    
    //private Panel panel;
     private String COMPRA_DIRECTA_TABBED = "7000_venta-";
    // private String COMPRA_DIRECTA_TABBED = "7000_cobro-";
    private TextField tex_marca;
    private ComboBox com_modeloCV;
    private TextField tex_numeropedido;
   // private TextField tex_modeloCP;
    private TextField tex_totalpares;
    public TextField tex_totalcaja;
    public TextField tex_totalcaja2;
    public DateField dat_fecha;
    public TextField dat_fechaplanilla;
   // public KMenu padre;
 //   private EditorGridPanel grid;
    //private Store store;
      private GroupingStore store1018;
    private ColumnModel columnModel;
    private BaseColumnConfig[] columns;
    private ColumnConfig Columnid;
    private ColumnConfig Columncodigo;
    private ColumnConfig Columnproducto;
    private ColumnConfig Columntalla;
    private ColumnConfig Columncantidad;
    private ColumnConfig Columnpreciobs2;
    private PagingMemoryProxy proxy;
    private RecordDef recordDef;
    private ArrayReader reader;
    private ToolbarButton eliminarEntrega;
    PagingToolbar pagingToolbar;
    private TextField tex_empresa;
    private TextField tex_codigo;
    private TextField tex_direccion;
    private TextField tex_telefono;
   // private TextField tex_responsable;
    public TextField tex_comision;
    private TextField tex_ciudad;
    //public TextField tex_planilla;
    public TextField tex_montototal;
    private TextField tex_mes1;
    public TextField tex_cobro1;
    private TextField tex_mes2;
    public TextField tex_cobro2;
    private TextField tex_mes3;
    public TextField tex_cobro3;
    private TextField tex_mes4;
    public TextField tex_cobro4;
 //   private FechaCobros formulario;
    private ColumnConfig idplanilla1018;
     private ColumnConfig codigo1018;
     private ColumnConfig credito1018;
     private ColumnConfig codigof1018;
     private ColumnConfig nombre1018;
     private ColumnConfig meses1018;
    private ColumnConfig marca1018;
    private ColumnConfig pais1018;
    private ColumnConfig cantidad1018;
    private ColumnConfig preciobs1018;
    private ColumnConfig preciosus1018;
    private ColumnConfig cobrador1018;
      private ColumnConfig totalcobro1018;
       private ColumnConfig totalcobrado1018;
    private ColumnConfig car1018;
   
    private ToolbarButton kardexProducto1018;
    private ToolbarButton verventas1018;
    protected ExtElement ext_element1018;
    private CheckboxSelectionModel cbSelectionModel1018;
  //  public Store store1018;
   // public Store store1019;
    private BaseColumnConfig[] columns1018;
    private ColumnModel columnModel1018;
    private DataProxy dataProxy1018;
    private JsonReader reader1018;
    PagingToolbar pagingToolbar1018;
// private Button but_limpiar;
    private Button but_nuevo;
    private Button but_llenar;
    public String montocobro;
 public Integer numero;
 public String montocobro2;
    //  private ListaPedidoCalzados lista;
    //private ListaClienteEmpresa lista1;
    boolean respuesta = false;
    private TextArea tea_descripcion;
    private Button but_aceptar;
    private Button but_cancelar;
//    private Button but_verfecha;
    //private Button but_acuenta;
   // private Button but_elimpagopendiente;
   //   private Button but_cobrarpagopendiente;
 //   private Button but_comision;
//    private Comision formulario2;
// private Acuenta formulario3;
    String selecionado = "";
     String selecionado2 = "";
    String marca;
    String idmarca;
    String numeropedido;
    String modelo;
    String idcliente;
    String nombre;
    String codigo;
   String enplanilla;
 //   String telefono;
    String responsable;
    String comision;
    String mes1;
    String mes2;
    String mes3;
String idemp;
String planillaes;
   // String ciudad;
  //  String planilla;
    String montototal;
    
    
    String cobro3;
    String cobrototal;
    String cobroanterior;
        String totalfin;
        Float cobro11;
        Float cobro22;
        Float cobro33;
         Float micobrototal;
        String totalcobro;
        String totalc;
        String totalfinn;
        String tot1;
         String cobrado;
    //Object[][] clienteM;
    Object[][] vendedorM;
   // Object[][] colorM;
   // Object[][] materialM;
    Object[][] modeloM;
   // Object[][] tiendaM;
   // Object[][] creditoM;
    String opcion;
    int columnaseleccionada =0;
      String escolumna ="";
      String escolumna2 ="";
      String columna;
      String fechapagado;
  //  int columnaseleccionada = 0;
  //    String escolumna ="";

      //Float cobrototall;
      private Number cobrototall;
        private String porcobrar;
     private Float totalTotalV1073;
      private Float totalmodif;
        private Float mivalor;
        String mivalorstring;
    private Float descPorV1073;
    private Float descCalV1073;
    private Float pagarV1073;
    //private CheckboxSelectionModel cbSelectionModel;
   // private Object records;
    private Object lista;
    private float $cuota;
public MainEntryPoint panell;
 public String opciondescuento;
  private KMenu kmenu;
  String pagadopendiente;
   Record[] record;
// ArrayReader records;
// Boolean espagopendiente = false;
 String espagopendiente= "NO";
  String esllenado= "NO";
 String montototalpagado;
// String pendientes;
// String montopendiente;
   int colauxiliar;
   Record record2;
     Record record3 = null;
     String opciongrid ="";
     Float opciondif;
     String opciondif1;
     String primerfecha;
     String ultimofecha;
String esprimerpago="NO";
int montoprimer ;
Float montocobrodecimal;
Float saldo;
Float montocobro1;
Float montocobrooriginal;
Float montocobrovariable;
String bandera1;
String bandera2;
//String idplanilla;
String idplanillanuevo;
String acuenta;
String pendiente;
//String fechaplanilla;
   private listamarcadeuda lista1;

    public PanelCobro(String idclient, String codigo, String nombre, String porpagar, String venta, String devolucion, String rebaja, String pagado, String porcobrar, Object[][] vendedores, SeleccionMarcaKardex SM, MainEntryPoint ma, KMenu kmenu) {
         this.kmenu = kmenu;
        this.SM = SM;
        this.panell= ma;
 this.vendedorM = vendedores;

        this.idcliente = idclient;
        this.codigo = codigo;
        this.nombre = nombre;
        this.mes1 = venta;
        this.mes2 = devolucion;
        this.mes3 = rebaja;
       
          this.cobro3 = porpagar;
          this.cobrototal = pagado;
       this.porcobrar = porcobrar;
//this.montopendiente= pagopendiente;
            this.opciondescuento="1";
            pagadopendiente="";
  //          this.pendientes = pendientess;
            opciongrid ="1";
            esprimerpago="SI";
        //this.creditoM = materialM;
        onModuleLoad();
    }


  
    public void onModuleLoad() {

  setId("tab-" + COMPRA_DIRECTA_TABBED);
        setTitle("Cobros por Marca");
        setLayout(new FitLayout());
        setBaseCls("x-plain");
        this.setClosable(true);
        this.setId("TPfun5015");
        setIconCls("tab-icon");

        Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");

        Panel pan_norte = new Panel();
        pan_norte.setLayout(new TableLayout(4));
        pan_norte.setBaseCls("x-plain");
        pan_norte.setHeight(100);
        pan_norte.setPaddings(5);

        Panel pan_sud = new Panel();
        pan_sud.setLayout(new TableLayout(9));
        pan_sud.setBaseCls("x-plain");
        pan_sud.setHeight(120);
     //   pan_sud.setWidth(550);
    //    pan_sud.setPaddings(5);
        pan_sud.setPaddings(5, 20, 5, 0);

     

        FormPanel for_panel1 = new FormPanel();
        for_panel1.setBaseCls("x-plain");
        for_panel1.setWidth(370);
        for_panel1.setLabelWidth(100);
        tex_empresa = new TextField("Cliente", "nombre", 200);
        tex_empresa.setReadOnly(true);

       
        for_panel1.add(tex_empresa);
        
        FormPanel for_panel2 = new FormPanel();
        for_panel2.setBaseCls("x-plain");
        for_panel2.setWidth(370);
        for_panel2.setLabelWidth(100);

        tex_montototal = new TextField("Por Cobrar", "cobro", 200);
// tex_montototal.setCls("grande");
  but_nuevo = new Button("REGISTRAR COBRO");
   but_llenar = new Button("Rebaja");
        Panel pan_botonescliente = new Panel();
        pan_botonescliente.setLayout(new HorizontalLayout(2));
        pan_botonescliente.setBaseCls("x-plain");

        pan_botonescliente.add(but_nuevo);
         pan_botonescliente.add(but_llenar);
    
        for_panel2.add(tex_montototal);
        for_panel2.add(new PaddedPanel(pan_botonescliente, 5, 5, 5, 5), new TableLayoutData(7));

        FormPanel for_panel3 = new FormPanel();
        for_panel3.setBaseCls("x-plain");
        for_panel3.setWidth(370);
        for_panel3.setLabelWidth(100);

        dat_fecha = new DateField("Fecha de cobro", "d-m-Y");
        Date date = new Date();
        dat_fecha.setValue(Utils.getStringOfDate(date));
 // dat_fechaplanilla = new TextField("Fecha Ult Plan", "fechaplanilla", 150);


        for_panel3.add(dat_fecha);
       //for_panel3.add(dat_fechaplanilla);

 lista1 = new listamarcadeuda();
            lista1.onModuleLoad5(idcliente, opciongrid,esprimerpago);

        pan_norte.add(new PaddedPanel(for_panel1, 10));
        pan_norte.add(new PaddedPanel(for_panel2, 10));
        pan_norte.add(new PaddedPanel(for_panel3, 10));
//        pan_norte.add(new PaddedPanel(for_panel12, 0, 0, 13, 10));



      
FormPanel for_panel48 = new FormPanel();
 for_panel48.setLabelAlign(Position.TOP);
        for_panel48.setBaseCls("x-plain");
        tex_totalcaja2 = new TextField("Por Cobrar", "porcobrar",90);
tex_totalcaja2.setReadOnly(true);
 
        for_panel48.add(tex_totalcaja2);
      //  for_panel48.add(tex_comision);
 for_panel48.setWidth(120);
        for_panel48.setLabelWidth(90);
            for_panel48.setMargins(0, 0, 1, 0);



        FormPanel for_panel5 = new FormPanel();
          for_panel5.setLabelAlign(Position.TOP);
        for_panel5.setBaseCls("x-plain");
        tex_mes1 = new TextField("Monto Venta", "mes1",60);
        tex_mes1.setReadOnly(true);
        for_panel5.add(tex_mes1);
        //for_panel5.add(tex_cobro1);
        for_panel5.setWidth(85);
        for_panel5.setLabelWidth(50);
        for_panel5.setMargins(0, 0, 1, 0);

         FormPanel for_panel51 = new FormPanel();
          for_panel51.setLabelAlign(Position.TOP);
        for_panel51.setBaseCls("x-plain");
        tex_cobro1 = new TextField("Pagado", "cobro1",60);
          tex_cobro1.setCls("grande");
        for_panel51.add(tex_cobro1);
 for_panel51.setWidth(85);
        for_panel51.setLabelWidth(50);
for_panel51.setMargins(0, 0, 1, 0);

        FormPanel for_panel6 = new FormPanel();
         for_panel6.setLabelAlign(Position.TOP);
        for_panel6.setBaseCls("x-plain");
        tex_mes2 = new TextField("REbaja", "mes2",60);
        tex_mes2.setReadOnly(true);
        for_panel6.add(tex_mes2);
         for_panel6.setWidth(85);
        for_panel6.setLabelWidth(50);
for_panel6.setMargins(0, 0, 1, 0);
        //for_panel6.add(tex_cobro2);
        FormPanel for_panel61 = new FormPanel();
        for_panel61.setBaseCls("x-plain");
        for_panel61.setLabelAlign(Position.TOP);
        tex_cobro2 = new TextField("Devolucion", "cobro2",60);
        //for_panel61.add(tex_mes2);
        for_panel61.add(tex_cobro2);
 for_panel61.setWidth(85);
        for_panel61.setLabelWidth(50);
        for_panel61.setMargins(0, 0, 1, 0);



        Panel pan_botones = new Panel();
        pan_botones.setLayout(new HorizontalLayout(7));
        pan_botones.setBaseCls("x-plain");
        //       pan_botones.setHeight(40);
        but_aceptar = new Button("Reporte Cliente");
        but_cancelar = new Button("Cancelar");
       // but_limpiar = new Button("Limpiar");
        //but_verproducto = new Button("Ver Producto");
        pan_botones.add(but_aceptar);
        pan_botones.add(but_cancelar);
       
      
    pan_sud.add(new PaddedPanel(for_panel48, 0, 0, 5, 0));
         pan_sud.add(new PaddedPanel(for_panel5, 0, 0, 5, 0));
         pan_sud.add(new PaddedPanel(for_panel51, 0, 0, 5, 0));
         pan_sud.add(new PaddedPanel(for_panel6, 0, 0, 5, 0));
         pan_sud.add(new PaddedPanel(for_panel61, 0, 0, 5, 0));
         
        pan_sud.add(new PaddedPanel(pan_botones, 10, 10, 10, 10), new TableLayoutData(7));


      Panel pan_centro = lista1.getPanel();
     
        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centro, new BorderLayoutData(RegionPosition.CENTER));
        pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        add(pan_borderLayout);
     //   pan_centro.add(grid1018);
        initValues();
        addListeners();
        addListenerTotal();
}
 public EditorGridPanel getGrid() {
        return grid1018;
    }
       private void initValues() {
     tex_empresa.setValue(nombre);
       tex_mes1.setValue(mes1);
      tex_cobro1.setValue(cobrototal);
      tex_mes2.setValue(mes3);
        tex_cobro2.setValue(mes2);
        tex_montototal.setValue(porcobrar);
        tex_totalcaja2.setValue(cobro3);
//        this.nombre = nombre;
//        this. = venta;
//        this. = devolucion;
//        this. = rebaja;
//        this. = porpagar;
//        this. = pagado;
//        this. = porcobrar;
//
     }

public void initDescuentoEspecial(String opciondesc) {
    if (opciondesc.equalsIgnoreCase("1")) {
             opciondescuento ="1";
                    }
        if (opciondesc.equalsIgnoreCase("2")) {
            opciondescuento ="2";
        }
   }

 private void addListenersGrid() {

             kardexProducto1018.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel1018.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idplanillaemitida");
                     selecionado2 = records[0].getAsString("idclienteempresa");

                    String enlTemp = "funcion=reportepagosclienteHTML&idplanillaemitida=" + selecionado+"&idclienteempresa=" + selecionado2;
                    verReporte(enlTemp);

                } else {
                    MessageBox.alert("No hay cliente selecionado para ver cobros y/o selecciono mas de uno.");
                }
                kardexProducto1018.setPressed(false);
            }
        });

           verventas1018.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel1018.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idplanillaemitida");
                     selecionado2 = records[0].getAsString("idclienteempresa");

                    String enlTemp = "funcion=reporteventasclienteHTML&idplanillaemitida=" + selecionado+"&idclienteempresa=" + selecionado2;
                    verReporte(enlTemp);

                } else {
                    MessageBox.alert("No hay cliente selecionado para ver detalle ventas y/o selecciono mas de uno.");
                }
                verventas1018.setPressed(false);
            }
        });
        grid1018.addListener(
                new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store1018.load(0, 100);
                    }
                });

       grid1018.addGridCellListener(
            new GridCellListenerAdapter() {
                    @Override
                    public void onCellClick(final GridPanel grid1018, final int rowIndex, final int colIndex, EventObject e) {
                            final Record record = grid1018.getStore().getAt(rowIndex);
              if (grid1018.getColumnModel().getDataIndex(colIndex).equals("cobro1")) {
                    int newcol = colIndex + 6;
                    montocobro1 = record.getAsFloat("totalcobro");
                    primerfecha = record.getAsString("primerfecha");

                if(montocobro1 !=0.00){
                esprimerpago="NO";
                  if(primerfecha=="0000-00-00" ){
                  //  com.google.gwt.user.client.Window.alert("no y 0fecha" +primerfecha);
                    //aqui entra cuando no hay ningun cobro pero es la segunda vez
                        esprimerpago="SI";
                  }else{
                    //aqui existe cobro con fecha anterior
                    esprimerpago="NO";
                        montocobrovariable = record.getAsFloat("cobro1");
                         montocobrooriginal = montocobrovariable;
                           String fecha = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
                        if(primerfecha==fecha){
                    //    com.google.gwt.user.client.Window.alert("noy mas fecha + hoy" +montocobrooriginal);
                        }else{
                         bandera2 = record.getAsString("idplanillaemitida");
                        //  calcularmonto(bandera2,primerfecha,montocobrovariable);
                           String enlace = "php/Cobros.php?funcion=verificaroriginalcobo&idplanilla=" + bandera2+"&fecha="+primerfecha+"&montocobro="+montocobrovariable;
                    final Conector conecaPB = new Conector(enlace, false);
                    try {
                        conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                            public void onResponseReceived(Request request, Response response) {
                                String data = response.getText();
                                JSONValue jsonValue = JSONParser.parse(data);
                                JSONObject jsonObject;
                                    String bandera;
                                if ((jsonObject = jsonValue.isObject()) != null) {

                                    String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                    String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                    if (errorR.equalsIgnoreCase("true")) {
                                      montocobrooriginal = (Float) Utils.getBigDecimalOfJSONObject(jsonObject, "respuesta");
                                       com.google.gwt.user.client.Window.alert("repetir esto" +montocobrooriginal);

                                      calculoduplicado(grid1018, record,rowIndex, colIndex,montocobrooriginal,montocobrodecimal);
                                      } else {
                                       bandera = Utils.getStringOfJSONObject(jsonObject, "respuesta");
                                       }
                                }
                            }

                            public void onError(Request request, Throwable exception) {
                                Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                            }
 private void calculoduplicado(GridPanel grid1018, Record record, int rowIndex, int colIndex, Float montocobrooriginal, Float montocobrodecimal) {
                   String antiguooriginal = montocobrooriginal.toString();
                   int oldoriginal = Integer.parseInt(antiguooriginal);
              Float old1 = null;
              String un = "0";
              String unnum = "0";
                    int uno = record.getAsInteger(un);
            //  int old = 0;
              int old2 = 0;
            int old = record.getAsInteger(un);
                    int cob1 = record.getAsInteger("cobro1");
                    int cob2 = record.getAsInteger("cobro2");
                    int cob3 = record.getAsInteger("cobro3");
                            int totalcob = record.getAsInteger("totalcobro");
                            int totalcobrado = record.getAsInteger("totalcobrado");
            String v = "0";
                    int valor = record.getAsInteger(v);
                   // Float ne = old;
                    try {
                     //   ne = new Float(temp);
                    } catch (Exception e) {
                        com.google.gwt.user.client.Window.alert("error en el campo" + e.getMessage());
                       // ne = old;
                    }

                     if (colIndex == 13) {
                        //record.set("sellosus", 0.0);
                              record.set("totalcobrado", 0);
              }

                     if (colIndex == 6) {
            record.set("cobro1", oldoriginal+oldoriginal);
           //  record.set("cobro1", oldoriginal+oldoriginal);

            record.set("cobro2", valor);
            record.set("cobro3", valor);
          //  record.set("totalcobrado",oldoriginal-oldoriginal);

                    }
    if (colIndex == 8) {
          //  record.set("cobro1", oldoriginal+oldoriginal);
           //  record.set("cobro1", oldoriginal+oldoriginal);

            record.set("cobro2",  oldoriginal+oldoriginal);
            record.set("cobro3", valor);
          //  record.set("totalcobrado",oldoriginal-oldoriginal);

                    }
    if (colIndex == 10) {
          //  record.set("cobro1", oldoriginal+oldoriginal);
           //  record.set("cobro1", oldoriginal+oldoriginal);

           // record.set("cobro2", valor);
            record.set("cobro3",  oldoriginal+oldoriginal);
          //  record.set("totalcobrado",oldoriginal-oldoriginal);

                    }


                    //record.commit();
         record.set("totalcobro", ((record.getAsInteger("cobro1"))+(record.getAsInteger("cobro2"))+(record.getAsInteger("cobro3"))));
   // record.set("totalcobrado", ((record.getAsInteger("cobro1"))+(record.getAsInteger("cobro2"))+(record.getAsInteger("cobro3"))));
 record.set("totalcobrado",((record.getAsInteger("totalcobro"))- oldoriginal));

                  Float total3 = new Float(0);
                  Float total1 = new Float(0);
                  Float total2 = new Float(0);
            //       for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {

                    for (int i = 0; i < grid1018.getStore().getModifiedRecords().length; i++) {
                         total3 += grid1018.getStore().getModifiedRecords()[i].getAsInteger("cobro1");
                        total1 += grid1018.getStore().getModifiedRecords()[i].getAsInteger("cobro2");
                        total2 += grid1018.getStore().getModifiedRecords()[i].getAsInteger("cobro3");

                    }

                    tex_cobro1.setValue(total3.toString());
                    tex_cobro2.setValue(total1.toString());
                    tex_cobro3.setValue(total2.toString());
                  Float total4 = new Float(0);
                    for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
                        total4 += grid1018.getStore().getRecords()[i].getAsInteger("totalcobrado");
                      }
                    tex_totalcaja.setValue(total4.toString());
                     Float total41 = new Float(0);
                    for (int i = 0; i < grid1018.getStore().getModifiedRecords().length; i++) {
                        total41 += grid1018.getStore().getModifiedRecords()[i].getAsInteger("totalcobro");
                      }

//                   totalcobro =(cobro1.toString())+(cobro2.toString())+(cobro3.toString());
//                   totalc = total41.toString();


              // record.set("totalcobrado", ((record.getAsFloat("cobro1"))+(record.getAsFloat("cobro2"))+(record.getAsFloat("cobro3"))));
             Float total411 = new Float(0);
                   if(espagopendiente == "SI"){

                    for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
                        total411 += grid1018.getStore().getRecords()[i].getAsFloat("totalcobrado");
                      }

                   }else{
                        //Float total411 = new Float(0);
                    for (int i = 0; i < grid1018.getStore().getModifiedRecords().length; i++) {
                        total411 += grid1018.getStore().getModifiedRecords()[i].getAsFloat("totalcobrado");
                      }

                   }


                        totalTotalV1073 = total411;
                    descPorV1073 = totalTotalV1073 - cobrototall.floatValue();
                      tex_montototal.setValue(total411.toString());


                      Float total4112 = new Float(0);
                    for (int i = 0; i < grid1018.getStore().getModifiedRecords().length; i++) {
                        total4112 += grid1018.getStore().getModifiedRecords()[i].getAsFloat("totalcobro");
                      }
            totalmodif= total4112;
            mivalorstring = tex_montototal.getValueAsString();
            mivalor = Float.parseFloat(mivalorstring);

            micobrototal = Float.parseFloat(cobrototal);
            mivalor = mivalor + micobrototal;
            //          tex_totalcaja.setValue(total4112.toString());
             tex_totalcaja.setValue(mivalor.toString());
 //record.beginEdit();
 //record.reject();
            }
                        });
                    } catch (RequestException ex) {
                        ex.getMessage();
                        Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                      }
                        }
                    }
                }
                   if(montocobro1 ==0.00){
                    esprimerpago="SI";
                             if(primerfecha=="0000-00-00"){
                             //aqui entra cuando no hay ningun cobro y es la primera vez
                            //   com.google.gwt.user.client.Window.alert("si y 0 fecha" +primerfecha);
                               }else{
                              // com.google.gwt.user.client.Window.alert("si y mas fecha" +primerfecha);
                                }
                       }

                }
                    //columna3
                             if (grid1018.getColumnModel().getDataIndex(colIndex).equals("cobro3")) {
                    int newcol = colIndex + 6;
                    montocobro1 = record.getAsFloat("totalcobro");
                    primerfecha = record.getAsString("primerfecha");
                if(montocobro1 !=0.00){
                esprimerpago="NO";
                  if(primerfecha=="0000-00-00" ){
                  //  com.google.gwt.user.client.Window.alert("no y 0fecha" +primerfecha);
                    //aqui entra cuando no hay ningun cobro pero es la segunda vez
                        esprimerpago="SI";
                  }else{
                    //aqui existe cobro con fecha anterior
                    esprimerpago="NO";
                        montocobrovariable = record.getAsFloat("cobro1");
                         montocobrooriginal = montocobrovariable;
                           String fecha = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
                        if(primerfecha==fecha){
                    //    com.google.gwt.user.client.Window.alert("noy mas fecha + hoy" +montocobrooriginal);
                        }else{
                         bandera2 = record.getAsString("idplanillaemitida");
                        //  calcularmonto(bandera2,primerfecha,montocobrovariable);
                           String enlace = "php/Cobros.php?funcion=verificaroriginalcobo&idplanilla=" + bandera2+"&fecha="+primerfecha+"&montocobro="+montocobrovariable;
                    final Conector conecaPB = new Conector(enlace, false);
                    try {
                        conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                            public void onResponseReceived(Request request, Response response) {
                                String data = response.getText();
                                JSONValue jsonValue = JSONParser.parse(data);
                                JSONObject jsonObject;
                                    String bandera;
                                if ((jsonObject = jsonValue.isObject()) != null) {

                                    String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                    String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                    if (errorR.equalsIgnoreCase("true")) {
                                      montocobrooriginal = (Float) Utils.getBigDecimalOfJSONObject(jsonObject, "respuesta");
                                       com.google.gwt.user.client.Window.alert("repetir esto" +montocobrooriginal);

                                      calculoduplicado2(grid1018, record,rowIndex, colIndex,montocobrooriginal,montocobrodecimal);
                                      } else {
                                       bandera = Utils.getStringOfJSONObject(jsonObject, "respuesta");
                                       }
                                }
                            }

                            public void onError(Request request, Throwable exception) {
                                Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                            }
 private void calculoduplicado2(GridPanel grid1018, Record record, int rowIndex, int colIndex, Float montocobrooriginal, Float montocobrodecimal) {
                   String antiguooriginal = montocobrooriginal.toString();
                   int oldoriginal = Integer.parseInt(antiguooriginal);
              Float old1 = null;
              String un = "0";
              String unnum = "0";
                    int uno = record.getAsInteger(un);
            //  int old = 0;
              int old2 = 0;
            int old = record.getAsInteger(un);
                    int cob1 = record.getAsInteger("cobro1");
                    int cob2 = record.getAsInteger("cobro2");
                    int cob3 = record.getAsInteger("cobro3");
                            int totalcob = record.getAsInteger("totalcobro");
                            int totalcobrado = record.getAsInteger("totalcobrado");
            String v = "0";
                    int valor = record.getAsInteger(v);
                   // Float ne = old;
                    try {
                     //   ne = new Float(temp);
                    } catch (Exception e) {
                        com.google.gwt.user.client.Window.alert("error en el campo" + e.getMessage());
                       // ne = old;
                    }

                     if (colIndex == 13) {
                        //record.set("sellosus", 0.0);
                              record.set("totalcobrado", 0);
              }

                     if (colIndex == 6) {
            record.set("cobro1", oldoriginal+oldoriginal);
           //  record.set("cobro1", oldoriginal+oldoriginal);

            record.set("cobro2", valor);
            record.set("cobro3", valor);
          //  record.set("totalcobrado",oldoriginal-oldoriginal);

                    }
    if (colIndex == 8) {
          //  record.set("cobro1", oldoriginal+oldoriginal);
           //  record.set("cobro1", oldoriginal+oldoriginal);

            record.set("cobro2",  oldoriginal+oldoriginal);
            record.set("cobro3", valor);
          //  record.set("totalcobrado",oldoriginal-oldoriginal);

                    }
    if (colIndex == 10) {
          //  record.set("cobro1", oldoriginal+oldoriginal);
           //  record.set("cobro1", oldoriginal+oldoriginal);

           // record.set("cobro2", valor);
            record.set("cobro3",  oldoriginal+oldoriginal);
          //  record.set("totalcobrado",oldoriginal-oldoriginal);

                    }


                    //record.commit();
         record.set("totalcobro", ((record.getAsInteger("cobro1"))+(record.getAsInteger("cobro2"))+(record.getAsInteger("cobro3"))));
   // record.set("totalcobrado", ((record.getAsInteger("cobro1"))+(record.getAsInteger("cobro2"))+(record.getAsInteger("cobro3"))));
 record.set("totalcobrado",((record.getAsInteger("totalcobro"))- oldoriginal));

                  Float total = new Float(0);
                  Float total1 = new Float(0);
                  Float total2 = new Float(0);
            //       for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {

                    for (int i = 0; i < grid1018.getStore().getModifiedRecords().length; i++) {
                         total += grid1018.getStore().getModifiedRecords()[i].getAsInteger("cobro1");
                        total1 += grid1018.getStore().getModifiedRecords()[i].getAsInteger("cobro2");
                        total2 += grid1018.getStore().getModifiedRecords()[i].getAsInteger("cobro3");

                    }

                    tex_cobro1.setValue(total.toString());
                    tex_cobro2.setValue(total1.toString());
                    tex_cobro3.setValue(total2.toString());
                  Float total4 = new Float(0);
                    for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
                        total4 += grid1018.getStore().getRecords()[i].getAsInteger("totalcobrado");
                      }
                    tex_totalcaja.setValue(total4.toString());
                     Float total41 = new Float(0);
                    for (int i = 0; i < grid1018.getStore().getModifiedRecords().length; i++) {
                        total41 += grid1018.getStore().getModifiedRecords()[i].getAsInteger("totalcobro");
                      }

                
              // record.set("totalcobrado", ((record.getAsFloat("cobro1"))+(record.getAsFloat("cobro2"))+(record.getAsFloat("cobro3"))));
             Float total411 = new Float(0);
                   if(espagopendiente == "SI"){

                    for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
                        total411 += grid1018.getStore().getRecords()[i].getAsFloat("totalcobrado");
                      }

                   }else{
                        //Float total411 = new Float(0);
                    for (int i = 0; i < grid1018.getStore().getModifiedRecords().length; i++) {
                        total411 += grid1018.getStore().getModifiedRecords()[i].getAsFloat("totalcobrado");
                      }

                   }


                        totalTotalV1073 = total411;
                    descPorV1073 = totalTotalV1073 - cobrototall.floatValue();
                      tex_montototal.setValue(total411.toString());


                      Float total4112 = new Float(0);
                    for (int i = 0; i < grid1018.getStore().getModifiedRecords().length; i++) {
                        total4112 += grid1018.getStore().getModifiedRecords()[i].getAsFloat("totalcobro");
                      }
            totalmodif= total4112;
            mivalorstring = tex_montototal.getValueAsString();
            mivalor = Float.parseFloat(mivalorstring);

            micobrototal = Float.parseFloat(cobrototal);
            mivalor = mivalor + micobrototal;
            //          tex_totalcaja.setValue(total4112.toString());
             tex_totalcaja.setValue(mivalor.toString());
 //record.beginEdit();
 //record.reject();
            }
                        });
                    } catch (RequestException ex) {
                        ex.getMessage();
                        Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                      }
                        }
                    }
                }


                }
                            //fin columna 3
          if (grid1018.getColumnModel().getDataIndex(colIndex).equals("cobro1")) {
                       int antcol = colIndex ;
                        columnaseleccionada = antcol;
                       escolumna="columna1";
                        escolumna2="columna1";

                 }else{
                             if (grid1018.getColumnModel().getDataIndex(colIndex).equals("cobro2")) {
                       int antcol = colIndex ;
                       columnaseleccionada = antcol;
                       escolumna="columna2";
                        escolumna2="columna2";
                 }else{
                             if (grid1018.getColumnModel().getDataIndex(colIndex).equals("cobro3")) {
                       int antcol = colIndex ;
                       columnaseleccionada = antcol;
                       escolumna="columna3";
                        escolumna2="columna3";
                   }
                   }
                   }

                      }

               
        @Override
       public void onCellDblClick(GridPanel grid, int rowIndex, int colIndex, EventObject e) {
                 Record record = grid1018.getStore().getAt(rowIndex);
               
        }


                });

                grid1018.addGridColumnListener(new GridColumnListener() {
                            public void onColumnMove(GridPanel grid1018, int oldIndex, int newIndex) {
                                if (grid1018.getColumnModel().getDataIndex(oldIndex).equals("cobrototal")) {
                                    Record record = grid1018.getStore().getAt(newIndex);
                                    record.set("indoor", !record.getAsBoolean("indoor"));
                                }
                            }
                            public void onColumnResize(GridPanel grid, int colIndex, int newSize) {
                                throw new UnsupportedOperationException("Not supported yet.");
                            }
                        });
    grid1018.addEditorGridListener(new EditorGridListenerAdapter() {
            @Override
       public void onAfterEdit(GridPanel grid1018, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
              montocobrodecimal = record.getAsFloat("cobro1");
              saldo = record.getAsFloat("saldo");
              
               if(saldo==0){
 com.google.gwt.user.client.Window.alert("esta deuda ya se cancelo, no puede incluir mas montos" );
               }else{
   if(esprimerpago=="SI"){
             calculofinal(grid1018, record, field, newValue, oldValue, rowIndex, colIndex);
              }
              if(esprimerpago=="NO"){
                  if(montocobrodecimal==montocobrooriginal){
                      com.google.gwt.user.client.Window.alert("esto es mismo monto" + montocobrodecimal);
                  }else{
                 // com.google.gwt.user.client.Window.alert("anadir monto" + montocobrodecimal);
             //     calcularSubTotal2(grid1018, record, field, newValue, oldValue, rowIndex, colIndex,montocobrooriginal,montocobrodecimal);
             calculofinal(grid1018, record, field, newValue, oldValue, rowIndex, colIndex);
             
                  }
              }
               }
           
  }

 
   public void doBeforeEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
                    Float total = new Float(0);
          Float total411 = new Float(0);
          if(espagopendiente == "SI"){
                      record.set("totalcobrado", record.getAsInteger("cobro1") + record.getAsInteger("cobro2") + record.getAsInteger("cobro3"));
                    for (int i = 0; i < grid.getStore().getRecords().length; i++) {
                        total411 += grid.getStore().getRecords()[i].getAsFloat("totalcobrado");
                      }

                    }else{
               if(esllenado == "SI"){
                      record.set("totalcobrado", record.getAsInteger("cobro1") + record.getAsInteger("cobro2") + record.getAsInteger("cobro3"));
                   
                   for (int i = 0; i < grid.getStore().getRecords().length; i++) {
                        total411 += grid.getStore().getRecords()[i].getAsFloat("totalcobrado");
                      }
               }else{
                      record.set("totalcobrado", record.getAsInteger("cobro1") + record.getAsInteger("cobro2") + record.getAsInteger("cobro3"));
                   
                for (int i = 0; i < grid.getStore().getRecords().length; i++) {
                        total411 += grid.getStore().getModifiedRecords()[i].getAsFloat("totalcobrado");
                      }
               }
                   
                   }
          
         tex_montototal.setValue(total411.toString());
          Float total4112 = new Float(0);
          for (int i = 0; i < grid.getStore().getRecords().length; i++) {
            total4112 += grid.getStore().getModifiedRecords()[i].getAsFloat("totalcobro");
          }
          tex_totalcaja .setValue(total411.toString());
            }
         });
    }


    private void addListenerTotal() {
    tex_montototal.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {

                if (e.getKey() == EventObject.ENTER) {
                    //String idmarca = field.getValueAsString().trim();
                    String idmodelo = tex_montototal.getValueAsString().trim();
                    //String codigo = tex_producto.getValueAsString().trim();
                    if (idmodelo.isEmpty()) {
                        tex_montototal.focus();
                    } else {
                addListenerModelo(idmodelo,grid1018);
                        tex_montototal.focus();
                    }
                }
             }

            private void addListenerModelo(String buscando,GridPanel grid1018) {
       // Float total = new Float(0);

        for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
          //  total += grid1018.getStore().getRecords()[i].getAsFloat("cobro1");
          String montototal1 = tex_montototal.getText();
       grid1018.getStore().getRecords()[i].getAsFloat(montototal1);

       //      record.set("total", 0.0);
        }
            }
        });



    }
    private void addListeners() {

 but_nuevo.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = lista1.cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idventa");
        //emergente
                } else {
                    MessageBox.alert("No hay Venta selecionado para ver detalle y/o selecciono mas de uno.");
                }
                but_nuevo.setPressed(false);
            }
        });

           but_llenar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
               String neo= escolumna;
             if((escolumna.equalsIgnoreCase("0"))||(escolumna.equalsIgnoreCase("")))
             {
                   com.google.gwt.user.client.Window.alert("Seleccione una columna para asignar valores");
             }else{
                 //  opciongrid ="2";
           //  insertarvaloresencolumna(columnaseleccionada,escolumna);
                   esllenado="SI";

          //    insertarvaloresencolumnallenarlleno(columnaseleccionada,escolumna);
             }
            }
        });
      
        //**************************************************
        //************* BOTON CANCELAR   *******************
        //**************************************************
        but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
            kmenu.seleccionarOpcionRemove(null, "fun7000", e, PanelCobro.this);
            abrirpanelreporte();
            }
        });

        //**************************************************
        //************* BOTON ACEPTAR *******************
        //**************************************************
        but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
         
              if((espagopendiente.equalsIgnoreCase("NO"))||(espagopendiente.equalsIgnoreCase("")))
             {
                  creandoconfimacion();
             }else{
           creandoconfimacionpagadopendiente();
             }
            }
        });

              

   




    }

    
    public void buscarProductos(EventObject e,String idempresa,String planilla,String idplanilla,String pendiente){
//
//      // String miplanilla=tex_planilla.getValueAsString().trim();
//        grid1018.clear();
////       dataProxy1018 = new ScriptTagProxy("./php/Empresa.php?funcion=buscarclientesempresaplanilla&idempresa="+idempresa+"&planilla="+planilla+"&idplanilla="+idplanilla);
//
//       dataProxy1018 = new ScriptTagProxy("php/Empresa.php?funcion=buscarclientesempresaplanilla&idempresa="+idempresa+"&planilla="+miplanilla+"&idplanilla="+idplanilla);
//       store1018 = new GroupingStore(dataProxy1018, reader1018, true);
//        store1018.load(0,100);
//
//        grid1018.reconfigure(store1018, columnModel1018);
//        pagingToolbar1018.setStore(store1018);
//        grid1018.getView().refresh();
//        reabrirpanel(e,idempresa,miplanilla,"nopendiente");
////nuevopanelcobro(idempresa,miplanilla,idplanilla);

                            }



private boolean findByCodigoCliente(String idempresa,final String codigo) {
               respuesta = false;

                String enlace = "php/Planilla.php?funcion=buscarplanillaempresacodigo&empresa=" + idempresa+"&planillabuscada="+codigo;

               // Utils.setErrorPrincipal("Cargando parametros ", "cargar");
                final Conector conec = new Conector(enlace, false);

                try {
                    conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        private String idempresa;
                        private String planilla;
                        // private String idplanilla;

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {
                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
                                    JSONValue clienteValue = jsonObject.get("resultado");
                                    JSONObject clienteObject;
                                    if ((clienteObject = clienteValue.isObject()) != null) {

                                        idempresa = Utils.getStringOfJSONObject(clienteObject, "idempresa");
                                        planilla = Utils.getStringOfJSONObject(clienteObject, "planilla");
                                        idplanillanuevo = Utils.getStringOfJSONObject(clienteObject, "no_planillaactual");


//                                       buscarProductos(e,idempresa,planilla,idplanilla,nopend);
                                        respuesta = true;
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
             //       resetCamposCliente();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }

                return respuesta;
            }

  public void GuardarEditarCliente(EventObject e,String pendientes,String pagopendiente,String planillafi) {
this.pendiente = pendientes;
//final String idempresa = com_marca.getValue();
    //  final String planillat = tex_planilla.getValueAsString();
      final String pagpend = pagopendiente;
      String enlace = "php/Cobros.php?funcion=BuscarEmpresaCobradorClienteTienda&idplanilla="+idplanillanuevo;
    Utils.setErrorPrincipal("Cargando parametros de empresa", "cargar");
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
                                    //Object[][] clientes = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo", "nombre", "item"});
                                    Object[][] vendedores = Utils.getArrayOfJSONObject(marcaO, "empleadoM", new String[]{"idempleado", "nombre"});
                                   // Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "tiendaM", new String[]{"idtienda", "nombre"});
                                    String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");
                                    String responsable = Utils.getStringOfJSONObject(marcaO, "responsable");
                                    String comision = Utils.getStringOfJSONObject(marcaO, "comision");
                                    String mes1 = Utils.getStringOfJSONObject(marcaO, "mes1");
                                    String mes2 = Utils.getStringOfJSONObject(marcaO, "mes2");
                                    String mes3 = Utils.getStringOfJSONObject(marcaO, "mes3");

                                     String cobro1 = Utils.getStringOfJSONObject(marcaO, "cobro1");
                                    String cobro2 = Utils.getStringOfJSONObject(marcaO, "cobro2");
                                    String cobro3 = Utils.getStringOfJSONObject(marcaO, "cobro3");
                                    String cobrototal = Utils.getStringOfJSONObject(marcaO, "cobrototal");
  Number cobrototal1 = Utils.getBigDecimalOfJSONObject(marcaO,"cobrototal");
 String porcobrar = Utils.getStringOfJSONObject(marcaO, "porcobrar");

                                    String mesanio1 = Utils.getStringOfJSONObject(marcaO, "mesanio1");
                                    String mesanio2 = Utils.getStringOfJSONObject(marcaO, "mesanio2");
                                    String mesanio3 = Utils.getStringOfJSONObject(marcaO, "mesanio3");
                                    String mesanio4 = Utils.getStringOfJSONObject(marcaO, "mesanio4");
                                    String mesanio5 = Utils.getStringOfJSONObject(marcaO, "mesanio5");
                                    String mesanio6 = Utils.getStringOfJSONObject(marcaO, "mesanio6");
                                     String planilla1 = Utils.getStringOfJSONObject(marcaO, "planilla");
                                       String fechaplanilla = Utils.getStringOfJSONObject(marcaO, "fechaplanilla");
  //PanelCobro pan_compraDirecta = new PanelCobro(idempresa,idplanillanuevo,fechaplanilla, codigo, nombre, responsable, comision, planilla1,mes1,mes2,mes3, vendedores, cobro1,cobro2,cobro3,cobrototal,cobrototal1,porcobrar,mesanio1,mesanio2,mesanio3,mesanio4,mesanio5,mesanio6,pendiente,pagpend,SM,panell,kmenu);

  // PanelCobrosEmpresa pan_compraDirecta = new PanelCobrosEmpresa(idemp, idplanilla,codigo, nombre, responsable, comision, planillaes,mes1,mes2,mes3, vendedores, cobro1,cobro2,cobro3,cobrototal,cobrototal1,porcobrar,mesanio1,mesanio2,mesanio3,mesanio4,mesanio5,mesanio6, esonopendiente,montopendiente,SM,panell,kmenu);

                                  //  PanelCobrosEmpresa pan_compraDirecta = new PanelCobrosEmpresa(idempresa, codigo, nombre, responsable, comision, planilla,mes1,mes2,mes3, vendedores, cobro1,cobro2,cobro3,cobro11,cobro22,cobro33,mesanio1,mesanio2,mesanio3,mesanio4,mesanio5,mesanio6, ConsultaEmpresa.this,panel);
                 //                   kmenu.seleccionarOpcion(null, "fun5015", e, pan_compraDirecta);

//
                 //                Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + idempresa, "mensaje");
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

            } catch (RequestException ea) {
                ea.getMessage();
                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
            }

        }
    }
     

        public void nuevopanelcobrovalores(final String idempresa,final String planilla,String escolumna){
         String enlace = "php/Cobros.php?funcion=BuscarEmpresaCobroSuma&idempresa=" + idempresa+"&planilla="+planilla+"&escolumna="+escolumna;
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
                                 
                                     String cobro1 = Utils.getStringOfJSONObject(marcaO, "cobro1");
                                    String cobro2 = Utils.getStringOfJSONObject(marcaO, "cobro2");
                                    String cobro3 = Utils.getStringOfJSONObject(marcaO, "cobro3");
                                    String cobrototal = Utils.getStringOfJSONObject(marcaO, "cobrototal");
 String porcobrar = Utils.getStringOfJSONObject(marcaO, "porcobrar");
String cobrado = Utils.getStringOfJSONObject(marcaO, "cobrado");

                              
      changevaluesnuevos(idempresa, cobro1,cobro2,cobro3,cobrototal,porcobrar,cobrado);

                                } else {
                                    Utils.setErrorPrincipal("No se recuperaron correctamente lo valores de usuario", "error");
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
 }
        public void changevaluesnuevos(String idempre,String cobro1a,String cobro2a,String cobro3a,String cobrototala,String porcobrara,String cobradoa){
      
          this.cobro3 = cobro3a;
          this.cobrototal = cobrototala;

this.cobrado = cobradoa;

this.porcobrar = porcobrara;
        
        tex_cobro3.setValue(cobro3);
        //tex_montototal.setValue(cobro1);
        tex_totalcaja.setValue(cobrototal);
        tex_totalcaja2.setValue(porcobrar);

}
public void initvaluespago(String idempre,String mesplanilla,String mes1a,String mes2a,String mes3a,String cobro1a,String cobro2a,String cobro3a,String cobrototala,String porcobrara,String mesanio1,String mesanio2,String mesanio3,String mesanio4,String mesanio5,String mesanio6){

         // this.cobro1 = cobro1a;
         // this.cobro2 = cobro2a;
          this.cobro3 = cobro3a;
          this.cobrototal = cobrototala;
//this.cobrototall = cobrototal;
this.porcobrar = porcobrara;

//        tex_cobro1.setValue(cobro1);
//        tex_cobro2.setValue(cobro2);
        tex_cobro3.setValue(cobro3);
        tex_montototal.setValue("0");
        tex_totalcaja.setValue(cobrototal);
        tex_totalcaja2.setValue(porcobrar);

}
     private void abrirpanelreporte(){
      String enlace = "php/Cobros.php?funcion=ConsultaEmpresa";
//                Utils.setErrorPrincipal("Cargando tienda y marca", "cargar");
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "empresaM", new String[]{"idempresa", "nombre"});
                                        String planilla = Utils.getStringOfJSONObject(marcaO, "planilla");
                                        SM = new SeleccionMarcaKardex(marcaM,  kmenu);
                                        SM.show();
                                    }

                                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
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
     private void limpiarVentanaVenta() {
        store1018.reload();
        grid1018.reconfigure(store1018, columnModel1018);
        pagingToolbar1018.setStore(store1018);
        grid1018.getView().refresh();
        grid1018.clear();
            tex_cobro3.setValue(cobro3);
        tex_montototal.setValue("0");
        tex_totalcaja.setValue(cobrototal);
    }
    public void buscarProductos2(String miplanilla){
//        grid1018.clear();
//        dataProxy1018 = new ScriptTagProxy("php/Empresa.php?funcion=buscarclientesempresaplanilla&idempresa="+idcliente);
//        store1019 = new Store(dataProxy1018, reader1018, true);
//        store1019.load(0,100);
//        grid1018.reconfigure(store1019, columnModel1018);
//        pagingToolbar1018.setStore(store1019);
//        grid1018.getView().refresh();
//        tex_montototal.reset();
//        tex_montototal.setValue("0");
//                                           Float to = new Float(0);
//                                            Float to1 = new Float(0);
//                                            Float to2 = new Float(0);
//                                            Float to3 = new Float(0);
//
//                                            for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
//                                                to += grid1018.getStore().getRecords()[i].getAsFloat("mes1");
//                                            }
//                                            for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
//                                                to1 += grid1018.getStore().getRecords()[i].getAsFloat("mes2");
//                                            }
//                                           for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
//                                                to2 += grid1018.getStore().getRecords()[i].getAsFloat("mes3");
//                                            }
//                                           for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
//                                                to3 += grid1018.getStore().getRecords()[i].getAsFloat("total");
//                                            }
//                                                                                     //tex_montoTotal.setValue(to.toString());
//                                            tex_mes1.setValue(to.toString());
//                                            tex_mes2.setValue(to1.toString());
//                                            tex_mes3.setValue(to2.toString());
//                                            tex_totalcaja2.setValue(to3.toString());
//                                            Float to1m = new Float(0);
//                                            Float to2m = new Float(0);
//                                            Float to3m = new Float(0);
//                                                Float to4 = new Float(0);
//                                            for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
//                                                to1m += grid1018.getStore().getRecords()[i].getAsFloat("cobro1");
//                                            }
//                                            for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
//                                                to2m += grid1018.getStore().getRecords()[i].getAsFloat("cobro2");
//                                            }
//                                           for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
//                                                to3m += grid1018.getStore().getRecords()[i].getAsFloat("cobro3");
//                                            }
//                                                 for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
//                                                to4 += grid1018.getStore().getRecords()[i].getAsFloat("totalcobro");
//                                            }
//
//        tex_cobro1.setValue(to1m.toString());
//        tex_cobro2.setValue(to2m.toString());
//        tex_cobro3.setValue(to3m.toString());
//                                  tex_totalcaja.setValue(to4.toString());
//                                         tex_montototal.setValue("0");
    }
     
 public void nuevopanelcobro(final String idempresa,final String planilla){
         String enlace = "php/Cobros.php?funcion=BuscarEmpresaCobradorClienteTienda&idempresa=" + idempresa+"&planilla="+planilla;
    Utils.setErrorPrincipal("Cargando parametros de empresa", "cargar");
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
                                    String mes1 = Utils.getStringOfJSONObject(marcaO, "mes1");
                                    String mes2 = Utils.getStringOfJSONObject(marcaO, "mes2");
                                    String mes3 = Utils.getStringOfJSONObject(marcaO, "mes3");
                                    String cobro1 = Utils.getStringOfJSONObject(marcaO, "cobro1");
                                    String cobro2 = Utils.getStringOfJSONObject(marcaO, "cobro2");
                                    String cobro3 = Utils.getStringOfJSONObject(marcaO, "cobro3");
                                    String cobrototal = Utils.getStringOfJSONObject(marcaO, "cobrototal");
                                      Number cobrototal1 = Utils.getBigDecimalOfJSONObject(marcaO,"cobrototal");
                                     String porcobrar = Utils.getStringOfJSONObject(marcaO, "porcobrar");

                                    String mesanio1 = Utils.getStringOfJSONObject(marcaO, "mesanio1");
                                    String mesanio2 = Utils.getStringOfJSONObject(marcaO, "mesanio2");
                                    String mesanio3 = Utils.getStringOfJSONObject(marcaO, "mesanio3");
                                    String mesanio4 = Utils.getStringOfJSONObject(marcaO, "mesanio4");
                                    String mesanio5 = Utils.getStringOfJSONObject(marcaO, "mesanio5");
                                    String mesanio6 = Utils.getStringOfJSONObject(marcaO, "mesanio6");
      initvaluesnuevos(idempresa, planilla,mes1,mes2,mes3, cobro1,cobro2,cobro3,cobrototal,porcobrar,mesanio1,mesanio2,mesanio3,mesanio4,mesanio5,mesanio6);
                                } else {
                                    Utils.setErrorPrincipal("No se recuperaron correctamente lo valores de usuario", "error");
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
 }
public void initvaluesnuevos(String idempre,String mesplanilla,String mes1a,String mes2a,String mes3a,String cobro1a,String cobro2a,String cobro3a,String cobrototala,String porcobrara,String mesanio1,String mesanio2,String mesanio3,String mesanio4,String mesanio5,String mesanio6){
          this.mes1 = mes1a;
          this.mes2 = mes2a;
          this.mes3 = mes3a;
         
          this.cobro3 = cobro3a;
          this.cobrototal = cobrototala;
          this.porcobrar = porcobrara;
  
      tex_comision.setValue(comision);
       tex_mes1.setValue(mes1);
      tex_mes2.setValue(mes2);
     tex_mes3.setValue(mes3);
       
        tex_cobro3.setValue(cobro3);
        tex_montototal.setValue("0");
        tex_totalcaja.setValue(cobrototal);
        tex_totalcaja2.setValue(porcobrar);

}
//registrocobro
public void createCompraSin(final EventObject ee,String montocomision) {
String fechaa = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
   String cobro111 = tex_cobro1.getValueAsString();
        String cobro221 = tex_cobro2.getValueAsString();
        String cobro331 = tex_cobro3.getValueAsString();
        String totalcaja = tex_totalcaja.getValueAsString();
        String montototal1 = tex_montototal.getValueAsString();
        String recibocomision = formulario_alm.tex_nombreC.getValueAsString();
       // String montocomision = formulario_alm.tex_codigoC.getValueAsString().trim();
       
       // String mesplanilla =tex_planilla.getValueAsString();

         String chequebanco = formulario_alm.com_empleado.getValueAsString();
         String chequecuentabanco = formulario_alm.tex_cpagadoregistro.getValueAsString();
        String dolaresbs = formulario_alm.tex_efecbs.getValueAsString();
        String dolaressus = formulario_alm.tex_efecsus.getValueAsString();
        String dolaresequivbssus = formulario_alm.tex_efecmonedas.getValueAsString();
         String chequemontoefectivo = formulario_alm.tex_depbs.getValueAsString();
        String chequemonto = formulario_alm.tex_depsus.getValueAsString();


        Record[] records;
   if(espagopendiente == "SI"){
    records = grid1018.getStore().getRecords();

   }else{
            if(esllenado == "SI"){
             records = grid1018.getStore().getRecords();

            }else{
             records = grid1018.getStore().getModifiedRecords();

            }
   
   }
        JSONArray productos = new JSONArray();
        JSONObject productoObject;
     JSONObject compraObject = new JSONObject();
         compraObject.put("fecha", new JSONString(fechaa));
         compraObject.put("idempresa", new JSONString(idcliente));

        // compraObject.put("no_planilla", new JSONString(idplanilla));

//            compraObject.put("mesplanilla", new JSONString(mesplanilla));
            compraObject.put("cobrototal1", new JSONString(cobro111));
            compraObject.put("cobrototal2", new JSONString(cobro221));
            compraObject.put("cobrototal3", new JSONString(cobro331));
            compraObject.put("totalcaja", new JSONString(totalcaja));
            compraObject.put("montototal", new JSONString(montototal1));

            compraObject.put("recibocomision", new JSONString(recibocomision));
            compraObject.put("montocomision", new JSONString(montocomision));
// if (formulario_alm.userFS.isCollapsed()==false) {
               compraObject.put("tipopago", new JSONString("pagodolares"));
               compraObject.put("dolaresbs", new JSONString(dolaresbs));
               compraObject.put("dolaressus", new JSONString(dolaressus));
               compraObject.put("dolaresequivbssus", new JSONString(dolaresequivbssus));
//              } else{
//              compraObject.put("tipopago", new JSONString("efectivo"));
//              }
 // if (formulario_alm.userFS1.isCollapsed()==false) {
  //             compraObject.put("tipopago", new JSONString("pagocheque"));
               compraObject.put("chequebanco", new JSONString(chequebanco));
               compraObject.put("chequecuentabanco", new JSONString(chequecuentabanco));
               compraObject.put("chequemontoefectivo", new JSONString(chequemontoefectivo));
               compraObject.put("chequemonto", new JSONString(chequemonto));
            //  }else{
              compraObject.put("tipopago", new JSONString("efectivo"));
               compraObject.put("espendiente", new JSONString(espagopendiente));
                  if (formulario_alm.facturaSi.isChecked()) {
                compraObject.put("tipotarjeta", new JSONString("SI"));
            } else {
                compraObject.put("tipotarjeta", new JSONString("NO"));
            }
             // }
            for (int i = 0; i < records.length; i++) {
                productoObject = new JSONObject();
                 productoObject.put("idclienteempresa", new JSONString(records[i].getAsString("idclienteempresa")));
                 productoObject.put("idplanillaemitida", new JSONString(records[i].getAsString("idplanillaemitida")));
                productoObject.put("cobro1", new JSONString(records[i].getAsString("cobro1")));
                productoObject.put("cobro2", new JSONString(records[i].getAsString("cobro2")));
                productoObject.put("cobro3", new JSONString(records[i].getAsString("cobro3")));
               productoObject.put("totalcobro", new JSONString(records[i].getAsString("totalcobro")));
                  productoObject.put("totalcobrado", new JSONString(records[i].getAsString("totalcobrado")));
                productoObject.put("cobrador", new JSONString(records[i].getAsString("cobrador")));
                
                 productos.set(i, productoObject);
                productoObject = null;
            }
            JSONObject resultado = new JSONObject();
            resultado.put("cobro", compraObject);
            resultado.put("cobrocliente", productos);

            String datos = "resultado=" + resultado.toString();

            Utils.setErrorPrincipal("registrando", "cargar");
            // String url = "./php/VentaDetalle.php?funcion=insertarventa";
             String url = "php/Cobros.php?funcion=registrarcobroplanillacomision&" + datos;

//       d     String url = "./php/VentaDetalle.php?funcion=txSaveVenta&" + datos;
//            final Conector conec = new Conector(url, false, "GET");
            final Conector conec = new Conector(url, false, "POST");

           //         final Conector conec = new Conector(url, false,"POST");
      try {
            conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {
 private EventObject e;
                public void onResponseReceived(Request request, Response response) {
                    String data = response.getText();
                    JSONValue jsonValue = JSONParser.parse(data);
                    JSONObject jsonObject;
                    if ((jsonObject = jsonValue.isObject()) != null) {
                        String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                        String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                        if (errorR.equalsIgnoreCase("true")) {
                             String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
                           //     String enlTemp = "funcion=reporteventaHTML&idventadetalle=" + idventaG;

//0804
//kmenu.seleccionarOpcionRemove(null, "fun7000", ee, PanelCobrosEmpresa.this);
 //String miplanilla = tex_planilla.getValueAsString().trim();
//reabrirpanel(e,idempresa,miplanilla,"nopendiente");
//jorge
           // formulario_alm.close();
            // formulario_alm.destroy();
   kmenu.seleccionarOpcionRemove(null, "fun5015", e, PanelCobro.this);
//   formulario_alm.clear();
//   formulario_alm.destroy();
//   formulario_alm.close();
  abrirpanelreporte();
                            Utils.setErrorPrincipal(mensajeR, "mensaje");

                        } else {
                            //Window.alert(mensajeR);
                            com.google.gwt.user.client.Window.alert("No se puede realizar la venta");
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
//            com.google.gwt.user.client.Window.alert("error 1003");
                Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
            }
      }

   public void createCompradescontaracuenta(final EventObject ee) {
       
String fechaa = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
   String cobro111 = tex_cobro1.getValueAsString();
        String cobro221 = tex_cobro2.getValueAsString();
        String cobro331 = tex_cobro3.getValueAsString();
        String totalcaja = tex_totalcaja.getText();
        String montototal1 = tex_montototal.getText();
        String recibocomision = formulario_alm.tex_nombreC.getValueAsString();
        String montocomision = formulario_alm.tex_codigoC.getValueAsString().trim();
//        String mesplanilla =tex_planilla.getText();

         String chequebanco = formulario_alm.com_empleado.getValueAsString();
         String chequecuentabanco = formulario_alm.tex_cpagadoregistro.getValueAsString();
        String dolaresbs = formulario_alm.tex_efecbs.getText();
        String dolaressus = formulario_alm.tex_efecsus.getText();
        String dolaresequivbssus = formulario_alm.tex_efecmonedas.getText();
         String chequemontoefectivo = formulario_alm.tex_depbs.getText();
        String chequemonto = formulario_alm.tex_depsus.getText();

    Record[] records = grid1018.getStore().getModifiedRecords();
        JSONArray productos = new JSONArray();
        JSONObject productoObject;
     JSONObject compraObject = new JSONObject();
         compraObject.put("fecha", new JSONString(fechaa));
         compraObject.put("idempresa", new JSONString(idcliente));
// compraObject.put("mesplanilla", new JSONString(mesplanilla));
            compraObject.put("cobrototal1", new JSONString(cobro111));
            compraObject.put("cobrototal2", new JSONString(cobro221));
            compraObject.put("cobrototal3", new JSONString(cobro331));
            compraObject.put("totalcaja", new JSONString(totalcaja));
            compraObject.put("montototal", new JSONString(montototal1));

            compraObject.put("recibocomision", new JSONString(recibocomision));
 compraObject.put("montocomision", new JSONString(montocomision));
// if (formulario_alm.userFS.isCollapsed()==false) {
               compraObject.put("tipopago", new JSONString("pagodolares"));
               compraObject.put("dolaresbs", new JSONString(dolaresbs));
               compraObject.put("dolaressus", new JSONString(dolaressus));
               compraObject.put("dolaresequivbssus", new JSONString(dolaresequivbssus));
//              } else{
//              compraObject.put("tipopago", new JSONString("efectivo"));
//              }
 // if (formulario_alm.userFS1.isCollapsed()==false) {
  //             compraObject.put("tipopago", new JSONString("pagocheque"));
               compraObject.put("chequebanco", new JSONString(chequebanco));
               compraObject.put("chequecuentabanco", new JSONString(chequecuentabanco));
               compraObject.put("chequemontoefectivo", new JSONString(chequemontoefectivo));
               compraObject.put("chequemonto", new JSONString(chequemonto));
            //  }else{
              compraObject.put("tipopago", new JSONString("efectivo"));
              compraObject.put("acuenta", new JSONString("pagoacuenta"));
             // }
            for (int i = 0; i < records.length; i++) {
                productoObject = new JSONObject();
                 productoObject.put("idclienteempresa", new JSONString(records[i].getAsString("idclienteempresa")));
                 productoObject.put("idplanillaemitida", new JSONString(records[i].getAsString("idplanillaemitida")));
                productoObject.put("cobro1", new JSONString(records[i].getAsString("cobro1")));
                productoObject.put("cobro2", new JSONString(records[i].getAsString("cobro2")));
                productoObject.put("cobro3", new JSONString(records[i].getAsString("cobro3")));
               productoObject.put("totalcobro", new JSONString(records[i].getAsString("totalcobro")));
                productoObject.put("cobrador", new JSONString(records[i].getAsString("cobrador")));
                 productos.set(i, productoObject);
                productoObject = null;
            }
            JSONObject resultado = new JSONObject();
            resultado.put("cobro", compraObject);
            resultado.put("cobrocliente", productos);

            String datos = "resultado=" + resultado.toString();

            Utils.setErrorPrincipal("registrando", "cargar");
            // String url = "./php/VentaDetalle.php?funcion=insertarventa";
             String url = "php/Cobros.php?funcion=registrarcobroplanillacomisionacuenta&" + datos;

//            String url = "./php/VentaDetalle.php?funcion=txSaveVenta&" + datos;
//            final Conector conec = new Conector(url, false, "GET");
            final Conector conec = new Conector(url, false, "POST");

           //         final Conector conec = new Conector(url, false,"POST");
      try {
            conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {
 private EventObject e;
 private EventObject ee;
                public void onResponseReceived(Request request, Response response) {
                    String data = response.getText();
                    JSONValue jsonValue = JSONParser.parse(data);
                    JSONObject jsonObject;
                    if ((jsonObject = jsonValue.isObject()) != null) {
                        String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                        String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                        if (errorR.equalsIgnoreCase("true")) {
                             String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
                           //     String enlTemp = "funcion=reporteventaHTML&idventadetalle=" + idventaG;


kmenu.seleccionarOpcionRemove(null, "fun7000", ee, PanelCobro.this);
// String miplanilla = tex_planilla.getValueAsString().trim();
//reabrirpanel(e,idempresa,miplanilla,"nopendiente");
    //kmenu.seleccionarOpcionRemove(null, "fun7000", e, PanelCobrosEmpresa.this);
             //validaracuenta(e,codigoplanilla);

      //         GuardarEditarCliente(e,"nopendiente",montopendiente,planillafa);

                            Utils.setErrorPrincipal(mensajeR, "mensaje");

                        } else {
                            //Window.alert(mensajeR);
                            com.google.gwt.user.client.Window.alert("No se puede realizar la venta");
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
//            com.google.gwt.user.client.Window.alert("error 1003");
                Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
            }
      }

    public void reabrirpanel(EventObject e,String idempr,String planilla1,String pendiente) {
        this.idemp=idempr;
        this.planillaes= planilla1;
//         this.pendientes = pendiente;
//final String idempresa = com_marca.getValue();
 //     final String planilla = tex_monto.getValueAsString();
        String enlace = "php/Cobros.php?funcion=BuscarEmpresaCobradorClienteTienda&idempresa=" + idemp+"&planilla="+planillaes;
    Utils.setErrorPrincipal("Cargando parametros de empresa", "cargar");
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
                                    //Object[][] clientes = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo", "nombre", "item"});
                                    Object[][] vendedores = Utils.getArrayOfJSONObject(marcaO, "empleadoM", new String[]{"idempleado", "nombre"});
                                   // Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "tiendaM", new String[]{"idtienda", "nombre"});
                                    String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombre");
                                    String responsable = Utils.getStringOfJSONObject(marcaO, "responsable");
                                    String comision = Utils.getStringOfJSONObject(marcaO, "comision");
                                    String mes1 = Utils.getStringOfJSONObject(marcaO, "mes1");
                                    String mes2 = Utils.getStringOfJSONObject(marcaO, "mes2");
                                    String mes3 = Utils.getStringOfJSONObject(marcaO, "mes3");

                                     String cobro1 = Utils.getStringOfJSONObject(marcaO, "cobro1");
                                    String cobro2 = Utils.getStringOfJSONObject(marcaO, "cobro2");
                                    String cobro3 = Utils.getStringOfJSONObject(marcaO, "cobro3");
                                    String cobrototal = Utils.getStringOfJSONObject(marcaO, "cobrototal");
  Number cobrototal1 = Utils.getBigDecimalOfJSONObject(marcaO,"cobrototal");
 String porcobrar = Utils.getStringOfJSONObject(marcaO, "porcobrar");

                                    String mesanio1 = Utils.getStringOfJSONObject(marcaO, "mesanio1");
                                    String mesanio2 = Utils.getStringOfJSONObject(marcaO, "mesanio2");
                                    String mesanio3 = Utils.getStringOfJSONObject(marcaO, "mesanio3");
                                    String mesanio4 = Utils.getStringOfJSONObject(marcaO, "mesanio4");
                                    String mesanio5 = Utils.getStringOfJSONObject(marcaO, "mesanio5");
                                    String mesanio6 = Utils.getStringOfJSONObject(marcaO, "mesanio6");
                                    
                                         String esonopendiente = Utils.getStringOfJSONObject(marcaO, "espendiente");

                                         String fechapla = Utils.getStringOfJSONObject(marcaO, "fechaplanilla");
 // PanelCobro pan_compraDirecta = new PanelCobro(idemp, idplanilla,fechapla,codigo, nombre, responsable, comision, planillaes,mes1,mes2,mes3, vendedores, cobro1,cobro2,cobro3,cobrototal,cobrototal1,porcobrar,mesanio1,mesanio2,mesanio3,mesanio4,mesanio5,mesanio6, esonopendiente,montopendiente,SM,panell,kmenu);
  //                              kmenu.seleccionarOpcion(null, "fun7000", e, pan_compraDirecta);
                                    //ConsultaEmpresa.this.clear();
                                    //ConsultaEmpresa.this.close();
//
             //                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + idempresa, "mensaje");
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

            } catch (RequestException ea) {
                ea.getMessage();
                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
            }

        }
    }
 

    public void closeTabVentaDirecta() {

      panell.getTabPanel().remove("fun5015");

    }

 private void calculofinal(GridPanel grid1018, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
        String temp = newValue.toString();
  Float old1 = null;
  String un = "0";
  String unnum = "0";
        int uno = record.getAsInteger(un);
//  int old = 0;
  int old2 = 0;

int old = record.getAsInteger(un);
        int cob1 = record.getAsInteger("cobro1");
        int cob2 = record.getAsInteger("cobro2");
        int cob3 = record.getAsInteger("cobro3");
                int totalcob = record.getAsInteger("totalcobro");
                int totalsaldo = record.getAsInteger("saldo");
                int totalcobrado = record.getAsInteger("totalcobrado");
                  int total = record.getAsInteger("total");
                   int totalcobori = record.getAsInteger("totalcobrooriginal");
String v = "0";
        int valor = record.getAsInteger(v);
       // Float ne = old;
        try {
         //   ne = new Float(temp);
        } catch (Exception e) {
            com.google.gwt.user.client.Window.alert("error en el campo" + e.getMessage());
           // ne = old;
        }
        if (colIndex == 2) {
            // record.set("cantidad", ne);
        }
         if (colIndex == 3) {
            // record.set("cantidad", ne);
        }
         if (colIndex == 4) {
                 //record.set("cobro1", 0.0);
        }
         if (colIndex == 5) {
            // record.set("cantidad", ne);
        }
         if (colIndex == 11) {
            //record.set("sellosus", 0.0);
          //        record.set("total", 0.0);

  }
            if (colIndex == 12) {
            //record.set("sellosus", 0.0);
                //  record.set("totalcobro", 0.0);
  }
         if (colIndex == 13) {
            //record.set("sellosus", 0.0);
                  record.set("totalcobrado", 0);
  }
      //  primerfecha
      //  ultimofecha
       // old =oldn;
     //   old = Integer.parseInt(oldn);
         if (colIndex == 6) {
     if((cob1 > (record.getAsInteger("mes1")))&&(record.getAsInteger("mes2")==0)){
      
 // if ((record.getAsInteger("cobro1")) > (record.getAsInteger("saldo"))){
  //if ((record.getAsInteger("cobro1")) > (record.getAsInteger("saldo"))){

      com.google.gwt.user.client.Window.alert("El monto de cobro excede el saldo  de credito por favor verifique sus importes");

 //record.set("cobro1", valor);
//record.set("cobro2", valor);
//record.set("cobro3", valor);
//record.set("totalcobrado",valor);
                                }else{
      if ((record.getAsInteger("cobro1")) > (record.getAsInteger("mes1"))){
                     int difer = (cob1)-(record.getAsInteger("mes1"));
         record.set("cobro1", (record.getAsInteger("mes1")));
         if(difer > (record.getAsInteger("mes2")) ){
       int difer2 = (difer)-(record.getAsInteger("mes2"));

           record.set("cobro2", (record.getAsInteger("mes2")));
          record.set("cobro3", (difer2));
         // record.set("totalcobro",cob1 + cob2 + cob3);
            record.set("totalcobro",(record.getAsInteger("cobro1")+record.getAsInteger("cobro2")+record.getAsInteger("cobro3")));
          record.set("totalcobrado",(record.getAsInteger("totalcobro")- (record.getAsInteger("saldo"))));

          }else{
            record.set("cobro2", (difer));
          record.set("cobro3", valor);
          }
                }else{
           record.set("cobro1", cob1);
           record.set("cobro2", valor);
          record.set("cobro3", valor);
                }

    record.set("totalcobro",(record.getAsInteger("cobro1")+record.getAsInteger("cobro2")+record.getAsInteger("cobro3")));
          record.set("totalcobrado",(record.getAsInteger("totalcobro")- (record.getAsInteger("totalcobrooriginal"))));
                                }


        }
         if (colIndex == 7) {
            // record.set("cantidad", ne);
        }
        if (colIndex == 8) {
  //if (((cob1+cob2) > (record.getAsInteger("mes1")+(record.getAsInteger("mes2")))) &&((record.getAsInteger("mes3")=='0'))) {
 if((cob1+cob2 > (record.getAsInteger("mes1")+record.getAsInteger("mes2")))&&(record.getAsInteger("mes3")==0)){
com.google.gwt.user.client.Window.alert("El monto de cobro excede el saldo  de credito por favor verifique");
          record.set("cobro2", old);
         record.set("cobro3", valor);
//  record.set("totalcobrado", valor);

    }else{
       if ((record.getAsInteger("cobro2") != valor)&&(record.getAsInteger("cobro1") == valor)) {
                   com.google.gwt.user.client.Window.alert("En la columna anterior aun no se realizo ningun pago");
                   record.set("cobro2", valor);
             record.set("cobro3", valor);
             record.set("cobro1", valor);

                 //  record.set("totalcobrado", valor);
                  // record.set("cobro2", 0.00);

        }else{
         if ((record.getAsInteger("cobro2") != valor)&&(record.getAsInteger("cobro1") < record.getAsInteger("mes1"))) {
                   com.google.gwt.user.client.Window.alert("En la columna anterior existe un saldo pendiente (col-2), completelo antes de continuar");
                   record.set("cobro2", 0);
                   record.set("cobro3", 0);

              //    record.set("totalcobrado", valor);
                  // record.set("cobro2", 0.00);

                }else{
     if ((record.getAsInteger("cobro2") > record.getAsInteger("mes2"))&&(record.getAsInteger("cobro1")== record.getAsInteger("mes1"))) {
 int difer = (record.getAsInteger("cobro2"))-(record.getAsInteger("mes2"));
         record.set("cobro2", (record.getAsInteger("mes2")));
          record.set("cobro3", (difer));
        }else{
    if ((record.getAsInteger("cobro2") < record.getAsInteger("mes2"))&&(record.getAsInteger("cobro1") == record.getAsInteger("mes1"))) {
        record.set("cobro2", (record.getAsInteger("cobro2")));
      //  record.set("cobro2", (record.getAsInteger("cobro2") + old));
 int difer = (record.getAsInteger("cobro2"))-(record.getAsInteger("mes2"));
       //  record.set("cobro2", (record.getAsInteger("mes2")));
          record.set("cobro3", valor);
        //record.set("cobro3", valor);
        }
 if ((record.getAsInteger("cobro2") == record.getAsInteger("mes2"))&&(record.getAsInteger("cobro1") == record.getAsInteger("mes1"))) {
        record.set("cobro2", (record.getAsInteger("cobro2")));
      //  record.set("cobro2", (record.getAsInteger("cobro2") + old));
 int difer = (record.getAsInteger("cobro2"))-(record.getAsInteger("mes2"));
       //  record.set("cobro2", (record.getAsInteger("mes2")));
          record.set("cobro3", valor);
        //record.set("cobro3", valor);
        }
//      if (((record.getAsInteger("cobro2") ) > record.getAsInteger("mes2"))&&(record.getAsInteger("cobro1") == record.getAsInteger("mes1"))) {
//     //     int dd = cob2+old;
//        int difer = (cob2)-(record.getAsInteger("mes2"));
//         record.set("cobro2", (record.getAsInteger("mes2")));
//          record.set("cobro3", (difer));
//        }
       }
    }
    }
         record.set("totalcobro",(record.getAsInteger("cobro1")+record.getAsInteger("cobro2")+record.getAsInteger("cobro3")));
          record.set("totalcobrado",(record.getAsInteger("totalcobro")- (record.getAsInteger("totalcobrooriginal"))));

     }

       }

        if (colIndex == 10) {
  if (cob3 > (record.getAsInteger("mes3"))){
             com.google.gwt.user.client.Window.alert("El monto de cobro excede el saldo  de credito por favor verifique");
                  //  record.set("cobro1", 0);
//record.set("cobro2", old);
record.set("cobro3", old);
//  record.set("totalcobrado", valor);

    }else{
       if ((record.getAsInteger("cobro3") != valor)&&(record.getAsInteger("cobro2") == valor)) {
                   com.google.gwt.user.client.Window.alert("En la columna anterior aun no se realizo ningun pago");
              record.set("cobro2", valor);
             record.set("cobro3", valor);

                 //  record.set("totalcobrado", valor);
                  // record.set("cobro2", 0.00);

        }else{
         if ((record.getAsInteger("cobro3") != valor)&&(record.getAsInteger("cobro2") < record.getAsInteger("mes2"))) {
                   com.google.gwt.user.client.Window.alert("En la columna anterior existe un saldo pendiente (col-2), completelo antes de continuar");
                   //record.set("cobro2", 0);
                   record.set("cobro3", valor);
                }else{
        if ((record.getAsInteger("cobro3") < record.getAsInteger("mes3"))&&(record.getAsInteger("cobro2") == record.getAsInteger("mes2"))) {
        //record.set("cobro3", (cob3));
         record.set("cobro3", (record.getAsInteger("cobro3")));

        }

    }
    }
          record.set("totalcobro",(record.getAsInteger("cobro1")+record.getAsInteger("cobro2")+record.getAsInteger("cobro3")));
          record.set("totalcobrado",(record.getAsInteger("totalcobro")- (record.getAsInteger("totalcobrooriginal"))));

     }
 
      }

 
      Float total3 = new Float(0);
      Float total1 = new Float(0);
      Float total2 = new Float(0);
//       for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {

        for (int i = 0; i < grid1018.getStore().getModifiedRecords().length; i++) {
             total3 += grid1018.getStore().getModifiedRecords()[i].getAsInteger("cobro1");
            total1 += grid1018.getStore().getModifiedRecords()[i].getAsInteger("cobro2");
            total2 += grid1018.getStore().getModifiedRecords()[i].getAsInteger("cobro3");

        }

        tex_cobro1.setValue(total3.toString());
        tex_cobro2.setValue(total1.toString());
        tex_cobro3.setValue(total2.toString());
      Float total4 = new Float(0);
        for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
            total4 += grid1018.getStore().getRecords()[i].getAsInteger("totalcobrado");
          }
        tex_totalcaja.setValue(total4.toString());
         Float total41 = new Float(0);
        for (int i = 0; i < grid1018.getStore().getModifiedRecords().length; i++) {
            total41 += grid1018.getStore().getModifiedRecords()[i].getAsInteger("totalcobro");
          }

//       totalcobro =(cobro1.toString())+(cobro2.toString())+(cobro3.toString());
       totalc = total41.toString();


  // record.set("totalcobrado", ((record.getAsFloat("cobro1"))+(record.getAsFloat("cobro2"))+(record.getAsFloat("cobro3"))));
 Float total411 = new Float(0);
       if(espagopendiente == "SI"){

        for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
            total411 += grid1018.getStore().getRecords()[i].getAsFloat("totalcobrado");
          }

       }else{
            //Float total411 = new Float(0);
     if(esllenado == "SI"){
              for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
            total411 += grid1018.getStore().getRecords()[i].getAsFloat("totalcobrado");
          }
           }else{
          for (int i = 0; i < grid1018.getStore().getModifiedRecords().length; i++) {
            total411 += grid1018.getStore().getModifiedRecords()[i].getAsFloat("totalcobrado");
       
           }
          }

       }


            totalTotalV1073 = total411;
        descPorV1073 = totalTotalV1073 - cobrototall.floatValue();
          tex_montototal.setValue(total411.toString());


          Float total4112 = new Float(0);
        for (int i = 0; i < grid1018.getStore().getModifiedRecords().length; i++) {
            total4112 += grid1018.getStore().getModifiedRecords()[i].getAsFloat("totalcobro");
          }
totalmodif= total4112;
mivalorstring = tex_montototal.getValueAsString();
mivalor = Float.parseFloat(mivalorstring);

micobrototal = Float.parseFloat(cobrototal);
mivalor = mivalor + micobrototal;
//          tex_totalcaja.setValue(total4112.toString());
 tex_totalcaja.setValue(mivalor.toString());
// record.beginEdit();
 //record.reject();

    }
 

 

    public void creandoconfimacion() {
        //Record[] cambiados = grid.getStore().getModifiedRecords();
        Record[] produc = grid1018.getStore().getModifiedRecords();
       if(espagopendiente == "SI"){
           if(esllenado=="SI"){
                 panelpagoabrir();
 cargarcobropagollenado();
         
           }else{
            //    panelpagoabrir();
            cargarcobropago();
          
           }
          
       }else{
            if(esllenado=="SI"){
                  panelpagoabrir();

 cargarcobropagollenado();
            }else{
             if (produc.length <= 0) {
MessageBox.alert("No ha modificado ningun registro");
        } else {
       cargarcobropago();
      // panelpagoabrir();
        }
            }
      
       }
        
    }
     public void creandoconfimacionpagadopendiente() {
        //Record[] cambiados = grid.getStore().getModifiedRecords();\\\
  Record[] recordss = cbSelectionModel1018.getSelections();
   //cargarcobropagopagadopendiente();
   cargarcobropagopendiente();


    }

 


public void cargarcobropagopendiente() {
    if(escolumna2=="columna1"){
                    montototalpagado = tex_cobro1.getValueAsString().trim();
                                                   }
                        if(escolumna2=="columna2"){
                                                montototalpagado = tex_cobro2.getValueAsString().trim();
                                                   }
                         if(escolumna2=="columna3"){
                                                 montototalpagado = tex_cobro3.getValueAsString().trim();
                                                   }

Record[] records;
     final String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
//records = grid1018.getStore().getModifiedRecords();
records = grid1018.getStore().getRecords();
        //   records = lista1.cbSelectionModel.getSelections();
String montodia = tex_montototal.getValueAsString();
JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();

        compraObject.put("empresa", new JSONString(nombre));
         compraObject.put("comision", new JSONString(comision));
        compraObject.put("montodia", new JSONString(montodia));
           compraObject.put("fecha", new JSONString(fechaent));
       for (int i = 0; i < records.length; i++) {
             productoObject = new JSONObject();
                    productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                productoObject.put("totalcobrado", new JSONString(records[i].getAsString("totalcobrado")));

                productos.set(i, productoObject);
                productoObject = null;

           }
    //fin opciones
        JSONObject resultado = new JSONObject();
        resultado.put("detalle", compraObject);
        resultado.put("productos", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("generando", "cargar");
        String url;
        url = "funcion=imprimirclientesconmontos&" + datos;
         verReporteTraspasoP(url,escolumna2);
    }
     private void verReporteTraspasoP(String enlace,String escolumna) {
//        ReporteTraspasoPendiente print = new ReporteTraspasoPendiente(escolumna,enlace,PanelCobro.this);
//        print.show();
    }
public void cargarcobropagollenado() {
Record[] records;
     final String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
records = grid1018.getStore().getRecords();
        
        //   records = lista1.cbSelectionModel.getSelections();
String montodia = tex_montototal.getValueAsString();
JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();

        compraObject.put("empresa", new JSONString(nombre));
         compraObject.put("comision", new JSONString(comision));
        compraObject.put("montodia", new JSONString(montodia));
           compraObject.put("fecha", new JSONString(fechaent));
       for (int i = 0; i < records.length; i++) {
             productoObject = new JSONObject();
                    productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                productoObject.put("totalcobrado", new JSONString(records[i].getAsString("totalcobrado")));

                productos.set(i, productoObject);
                productoObject = null;

           }
    //fin opciones
        JSONObject resultado = new JSONObject();
        resultado.put("detalle", compraObject);
        resultado.put("productos", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("generando", "cargar");
        String url;
        url = "funcion=imprimirclientesconmontos&" + datos;
         verReporteTraspaso(url);
    }
     public void cargarcobropago() {
Record[] records;
     final String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
records = grid1018.getStore().getModifiedRecords();
        //   records = lista1.cbSelectionModel.getSelections();
String montodia = tex_montototal.getValueAsString();
JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();

        compraObject.put("empresa", new JSONString(nombre));
         compraObject.put("comision", new JSONString(comision));
        compraObject.put("montodia", new JSONString(montodia));
           compraObject.put("fecha", new JSONString(fechaent));
       for (int i = 0; i < records.length; i++) {
             productoObject = new JSONObject();
                    productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                productoObject.put("totalcobrado", new JSONString(records[i].getAsString("totalcobrado")));
              
                productos.set(i, productoObject);
                productoObject = null;

           }
    //fin opciones
        JSONObject resultado = new JSONObject();
        resultado.put("detalle", compraObject);
        resultado.put("productos", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("generando", "cargar");
        String url;
        url = "funcion=imprimirclientesconmontos&" + datos;
         verReporteTraspaso(url);
    }
     private void verReporteTraspaso(String enlace) {
//        ReporteTraspaso print = new ReporteTraspaso(enlace,PanelCobro.this);
//        print.show();
    }

public void panelpagoabrir() {
      
                 String empresaa = tex_empresa.getValueAsString();
           //   espagopendiente = "SI";
                    String msg = "";
                     String nombre = "";
                      String monto = "";
                     String montototal1="";
            if(espagopendiente == "SI"){
              Record[] records11 = grid1018.getStore().getRecords();

                        for (int i = 0; i <
                                records11.length; i++) {
                            Record record = records11[i];
                            msg +=
                                    record.getAsString("cliente")+ " Bs:"+record.getAsString("totalcobrado") + "      /";
                        }
                        if(escolumna2=="columna1"){
                                                     montototalpagado = tex_cobro1.getValueAsString().trim();

                                                   }
                        if(escolumna2=="columna2"){
                                                montototalpagado = tex_cobro2.getValueAsString().trim();
                                                   }
                         if(escolumna2=="columna3"){
                                                 montototalpagado = tex_cobro3.getValueAsString().trim();
                                                   }
             montototal1 = montototalpagado;
            }else{
                         if(esllenado == "SI"){
                             Record[] records1 = grid1018.getStore().getRecords();
                       // String msg = "";
                        for (int i = 0; i <
                                records1.length; i++) {
                            Record record = records1[i];
                            msg +=
                                    record.getAsString("cliente")+ " Bs:"+record.getAsString("totalcobrado") + "      /";
                            nombre +=
                                    record.getAsString("cliente")+ "      /";
                            monto +=
                                   record.getAsString("totalcobrado")+ "  Bs   ";

                        }
             montototal1 = tex_montototal.getText();
                         }else{
                          Record[] records1 = grid1018.getStore().getModifiedRecords();
                       // String msg = "";
                        for (int i = 0; i <
                                records1.length; i++) {
                            Record record = records1[i];
                            msg +=
                                    record.getAsString("cliente")+ " Bs:"+record.getAsString("totalcobrado") + "      /";
                            nombre +=
                                    record.getAsString("cliente")+ "      /";
                            monto +=
                                   record.getAsString("totalcobrado")+ "  Bs   ";
                        }
             montototal1 = tex_montototal.getText();
                         }
            }
 formulario_alm = new MostrarCobros(idcliente,empresaa,montototal1,comision,msg,nombre,monto,PanelCobro.this);
     formulario_alm.show();

}
    public void setGrid(EditorGridPanel grid) {
        this.grid1018 = grid;
    }
 private void verReporte(String enlace) {
//        ReporteMediaCartaChorroWindowPeque print = new ReporteMediaCartaChorroWindowPeque(enlace);
//        print.show();
    }

 
 public NumberField metodoFeli() {


        NumberField num_field1 = new NumberField();
        num_field1.setAllowDecimals(false);
        num_field1.setAllowBlank(false);

        num_field1.setAllowNegative(false);
num_field1.setCls("grande");
        return num_field1;
    }

}

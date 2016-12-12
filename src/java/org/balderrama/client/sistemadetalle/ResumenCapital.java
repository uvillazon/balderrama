/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

/**
 *
 * @author
 */
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
import com.gwtext.client.data.FieldDef;
import com.gwtext.client.data.JsonReader;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.ArrayReader;

import com.gwtext.client.data.RecordDef;
import com.gwtext.client.data.ScriptTagProxy;
import com.gwtext.client.data.Store;
import com.gwtext.client.data.StringFieldDef;
import com.gwtext.client.util.DateUtil;
import com.gwtext.client.widgets.Component;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.PaddedPanel;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.QuickTipsConfig;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.event.PanelListenerAdapter;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.NumberField;
import com.gwtext.client.widgets.form.TextArea;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.layout.BorderLayout;
import com.gwtext.client.widgets.layout.BorderLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.HorizontalLayout;
import com.gwtext.client.widgets.layout.TableLayout;
import com.gwtext.client.widgets.layout.TableLayoutData;
//import org.asia.client.almacen.venta.FormularioSeleccionarCliente;
//import org.asia.client.almacen.venta.MostrarAlmacenesWindow;
//import org.asia.client.bean.ProductoProforma;
//import org.asia.client.bean.Cliente;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import com.gwtext.client.widgets.grid.event.EditorGridListenerAdapter;
import com.gwtext.client.widgets.grid.GridView;

import com.gwtext.client.widgets.grid.RowParams;
import com.gwtext.client.widgets.grid.event.GridCellListenerAdapter;
import com.gwtext.client.widgets.grid.event.GridColumnListener;
import com.gwtext.client.widgets.layout.FormLayout;
import com.gwtextux.client.data.PagingMemoryProxy;
import org.balderrama.client.MainEntryPoint;
import org.balderrama.client.emergentes.SeleccionMarcaEstiloInventario;
import org.balderrama.client.util.Conector;
//import org.balderrama.client.marca.Marca;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
//import org.balderrama.client.util.Validacion;

public class ResumenCapital extends Panel {

 //   private Marca marca1;
    private SeleccionMarcaEstiloInventario SM;
    public EditorGridPanel grid1018;
    // private long idpanel;
   private final int ANCHO = 400;
    private final int ALTO = 290;
    //private Panel panel;
     private String COMPRA_DIRECTA_TABBED = "70091_deposito-";
    // private String COMPRA_DIRECTA_TABBED = "7000_cobro-";
    public DateField dat_fecha;
   // public KMenu padre;
 //   private EditorGridPanel grid;
    private Store store;
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
    PagingToolbar pagingToolbar;
    public TextField tex_comision;
    public TextField tex_planilla;
    private TextField tex_mes1;
    private TextField tex_mes2;
    private TextField tex_mes3;
    private TextField tex_mes4;
     private TextField tex_mesplanilla;
     private TextField tex_anterior;
    private TextField tex_pares;
    private TextField tex_totalventa;
       private TextField tex_mes5;
    private TextField tex_mes6;
       private TextField tex_mes7;
    private TextField tex_mes8;
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
  private ColumnConfig tarjeta1018;
    private ColumnConfig totales1018;
    private ToolbarButton kardexProducto1018;
     private ToolbarButton kardexProducto10181;
    protected ExtElement ext_element1018;
    private CheckboxSelectionModel cbSelectionModel1018;
    public Store store1018;
    public Store store1019;
    private BaseColumnConfig[] columns1018;
    private ColumnModel columnModel1018;
    private DataProxy dataProxy1018;
    private JsonReader reader1018;
    PagingToolbar pagingToolbar1018;


    //  private ListaPedidoCalzados lista;
    //private ListaClienteEmpresa lista1;
    boolean respuesta = false;
    private TextArea tea_descripcion;
    private Button but_aceptar;
     private Button but_aceptar1;
    private Button but_cancelar;

     String selecionado = "";
     String selecionado2 = "";
    String marca;
    String idmarca;
    String numeropedido;
    String modelo;
    String idempresa;
    String nombre;
    String codigo;
//    String direccion;
 //   String telefono;
    String responsable;
    String comision;
    String mes1;
    String mes2;
    String mes3;
String idemp;
String planillaes;
   // String ciudad;
    String planilla;
    String montototal;

     String cobro1;
    String cobro2;
    String cobro3;
    String cobrototal;
    String cobroanterior;
        String totalfin;
        Float cobro11;
        Float cobro22;
        Float cobro33;
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
 ArrayReader records;
// Boolean espagopendiente = false;
 String espagopendiente= "NO";
 String montototalpagado;
 String pendientes;
  String fechainicio;
    String fechafin;
    String cobrosbs;
    String cobrossus;
    String chequebs;
    String otrosingresos;
    String tarjetas;
     String comisionbs;
    String gastosbs;
    String gastossus;
    String depositosbs;
    String depositossus;
      String mesanio1;
    String mesanio2;
    String mesanio3;
    String mesanio4;
    String mesanio5;
    String mesanio6;
      String anterior;
      String saldototal;
      String totales;
      String tarjeta;

//    public ResumenCapital(String idkardex, String mesrango, String idmarca, String marca, String opcion, String formatomayor, Object[][] colores, Object[][] vendedorM, String totalcajas, String totalpares, String totalbs, String responsable, String almacen, String idalmacen, SeleccionMarcaEstiloInventario SM, KMenu kmenu) {
//        this.kmenu = kmenu;
//        this.SM = SM;
//       // this.panell= ma;
//        this.anterior = idkardex;
//           this.fechainicio = mesrango;
//        this.fechafin = idmarca;
//        this.cobrosbs= marca;
//        this.cobrossus = opcion;
//        this.chequebs = chequebs;
//        this.otrosingresos = otrosingresos;
//        this.comisionbs = comisionbs;
//        this.gastosbs = gastosbs;
//         this.tarjeta = formatomayor;
//        this.depositosbs = depositosbs;
//        this.depositossus = depositossus;
//        this.totales = totales;
////        this.gastossus = gastosus;
////        this.saldototal = saltotal;
//        //this.creditoM = materialM;
//        onModuleLoad();
//    }

//    public ResumenCapital(String fechaini, String fecha1, String fecha2, String anterior, String cobrobs, String cobrosus, String chequebs, String tarjeta, String otrosingresos, String comisionbs, String gastosbs, String gastosus, String depositosbs, String depositossus, String totales, String salant, SeleccionMarcaEstiloInventario aThis, MainEntryPoint panel, KMenu padre) {
//        throw new UnsupportedOperationException("Not yet implemented");
//    }

   public ResumenCapital(String fechaini,String fecha1,String fecha2,String anterio,String cobrobs,String cobrosus,String chequebs,String tarjetas1,String otrosingresos,String comisionbs,String gastosbs,String gastosus,String depositosbs,String depositossus,String totales,String saltotal,SeleccionMarcaEstiloInventario SM,MainEntryPoint ma,KMenu kmenu) {
        this.kmenu = kmenu;
        this.SM = SM;
        this.panell= ma;
this.anterior = anterio;
               this.fechainicio = fecha1;
        this.fechafin = fecha2;
        this.cobrosbs= cobrobs;
        this.cobrossus = cobrosus;
        this.chequebs = chequebs;
        this.otrosingresos = otrosingresos;
        this.comisionbs = comisionbs;
        this.gastosbs = gastosbs;
         this.tarjeta = tarjetas1;
        this.depositosbs = depositosbs;
        this.depositossus = depositossus;
        this.totales = totales;
        this.gastossus = gastosus;
        this.saldototal = saltotal;
        //this.creditoM = materialM;
        onModuleLoad();
    }




    public void onModuleLoad() {

  setId("tab-" + COMPRA_DIRECTA_TABBED);
        setTitle("Dep. Cobro");
        setLayout(new FitLayout());
        setBaseCls("x-plain");
        this.setClosable(true);
        this.setId("TPfun50292");
        setIconCls("tab-icon");

         Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");

        Panel pan_norte = new Panel();
        pan_norte.setLayout(new TableLayout(12));
        pan_norte.setBaseCls("x-plain");
        pan_norte.setHeight(80);
        pan_norte.setPaddings(5);

        Panel pan_sud = new Panel();
        pan_sud.setLayout(new TableLayout(7));
        pan_sud.setBaseCls("x-plain");
        pan_sud.setHeight(115);
        pan_sud.setWidth(600);
        pan_sud.setPaddings(5);
    //    pan_sud.setPaddings(5);
     //   pan_sud.setPaddings(5, 20, 5, 0);
 FormPanel for_panel5 = new FormPanel();
         for_panel5.setLabelAlign(Position.TOP);
         for_panel5.setBaseCls("x-plain");
         tex_anterior = new TextField("Sal Anterior", "anterior",60);
         for_panel5.add(tex_anterior);
         for_panel5.setWidth(90);
         for_panel5.setLabelWidth(50);

         FormPanel for_panel52 = new FormPanel();
         for_panel52.setLabelAlign(Position.TOP);
         for_panel52.setBaseCls("x-plain");
         tex_mesplanilla = new TextField("Cobros Bs", "cobrosbs",60);
         for_panel52.add(tex_mesplanilla);
         for_panel52.setWidth(90);
         for_panel52.setLabelWidth(50);
       // for_panel52.setMargins(0, 0, 1, 0);

         FormPanel for_panel51 = new FormPanel();
           for_panel51.setLabelAlign(Position.TOP);
       for_panel51.setBaseCls("x-plain");
        tex_pares = new TextField("Cobros sus", "pares",60);

        for_panel51.add(tex_pares);
   for_panel51.setWidth(90);
        for_panel51.setLabelWidth(50);


        FormPanel for_panel62 = new FormPanel();
         for_panel62.setLabelAlign(Position.TOP);
        for_panel62.setBaseCls("x-plain");
        tex_totalventa = new TextField("Cheques", "totalventa",60);
          for_panel62.add(tex_totalventa);

        for_panel62.setWidth(90);
        for_panel62.setLabelWidth(50);

             FormPanel for_panel628 = new FormPanel();
         for_panel628.setLabelAlign(Position.TOP);
        for_panel628.setBaseCls("x-plain");
        tex_mes8 = new TextField("Tarjeta", "tarjeta",60);
          for_panel628.add(tex_mes8);
        for_panel628.setWidth(90);
        for_panel628.setLabelWidth(50);


        //for_panel6.add(tex_cobro2);
        FormPanel for_panel61 = new FormPanel();
      for_panel61.setLabelAlign(Position.TOP);

        for_panel61.setBaseCls("x-plain");
        tex_mes1 = new TextField("otros", "mes1",60);
        for_panel61.add(tex_mes1);

        for_panel61.setWidth(90);
        for_panel61.setLabelWidth(50);



        FormPanel for_panel72 = new FormPanel();
          for_panel72.setLabelAlign(Position.TOP);
        for_panel72.setBaseCls("x-plain");
        tex_mes2 = new TextField("Comision", "mes2",60);
       tex_mes2.setReadOnly(true);

        for_panel72.add(tex_mes2);

        for_panel72.setWidth(90);
        for_panel72.setLabelWidth(50);

      //  for_panel7.add(tex_cobro3);
  FormPanel for_panel71 = new FormPanel();
  for_panel71.setLabelAlign(Position.TOP);
        for_panel71.setBaseCls("x-plain");
      tex_mes3 = new TextField("Gasto Bs", "mes3",60);
      for_panel71.add(tex_mes3);
 for_panel71.setWidth(90);
        for_panel71.setLabelWidth(50);


FormPanel for_panel41 = new FormPanel();
 for_panel41.setLabelAlign(Position.TOP);
        for_panel41.setBaseCls("x-plain");
        tex_mes4 = new TextField("Gasto Sus", "mes4",60);
   for_panel41.add(tex_mes4);
 for_panel41.setWidth(90);
        for_panel41.setLabelWidth(50);

        FormPanel for_panel55 = new FormPanel();
    for_panel55.setLabelAlign(Position.TOP);
        for_panel55.setBaseCls("x-plain");
        tex_mes5 = new TextField("Depositos Bs", "mes5",70);
     for_panel55.add(tex_mes5);
 for_panel55.setWidth(110);
        for_panel55.setLabelWidth(50);

        FormPanel for_panel66 = new FormPanel();
        for_panel66.setLabelAlign(Position.TOP);
        for_panel66.setBaseCls("x-plain");
        tex_mes6 = new TextField("Depositos Sus", "mes6",70);
    for_panel66.add(tex_mes6);
 for_panel66.setWidth(110);
        for_panel66.setLabelWidth(50);

        FormPanel for_panel667 = new FormPanel();
        for_panel667.setLabelAlign(Position.TOP);
        for_panel667.setBaseCls("x-plain");
        tex_mes7 = new TextField("Totales Sus", "mes7",70);
    for_panel667.add(tex_mes7);
 for_panel667.setWidth(110);
        for_panel667.setLabelWidth(50);

//        pan_norte.add(new PaddedPanel(for_panel1, 10));
//        pan_norte.add(new PaddedPanel(for_panel2, 10));
//       pan_norte.add(new PaddedPanel(for_panel3, 10));
          pan_norte.add(new PaddedPanel(for_panel5, 0, 0, 0, 0));

        pan_norte.add(new PaddedPanel(for_panel52, 0, 0, 0, 0));
         pan_norte.add(new PaddedPanel(for_panel51, 0, 0, 0, 0));
         pan_norte.add(new PaddedPanel(for_panel62, 0, 0, 0, 0));

                  pan_norte.add(new PaddedPanel(for_panel628, 0, 0, 0, 0));
         pan_norte.add(new PaddedPanel(for_panel61, 0, 0, 0, 0));
         pan_norte.add(new PaddedPanel(for_panel72, 0, 0, 0, 0));
        pan_norte.add(new PaddedPanel(for_panel71, 0, 0, 0, 0));
         pan_norte.add(new PaddedPanel(for_panel41, 0, 0, 0,0));
         pan_norte.add(new PaddedPanel(for_panel55, 0, 0, 0,0));
         pan_norte.add(new PaddedPanel(for_panel66, 0, 0, 0,0));
            pan_norte.add(new PaddedPanel(for_panel667, 0, 0, 0,0));
//        pan_norte.add(new PaddedPanel(for_panel12, 0, 0, 13, 10));


        //for_panel4.add(tex_comision);
      FormPanel for_panel4 = new FormPanel();
 for_panel4.setLabelAlign(Position.TOP);
        for_panel4.setBaseCls("x-plain");
          tex_comision = new TextField("TOTAL COBRADO", "saldototal",60);
        tex_comision.setReadOnly(true);
//
//        tex_totalcaja = new TextField("Total Cobrado", "totalmonto",90);
// tex_totalcaja.setCls("grande");
        for_panel4.add(tex_comision);
 for_panel4.setWidth(85);
// for_panel4.setHeight(25);
        for_panel4.setLabelWidth(50);


        Panel pan_botones = new Panel();
        pan_botones.setLayout(new HorizontalLayout(7));
        pan_botones.setBaseCls("x-plain");
        //       pan_botones.setHeight(40);
        but_aceptar = new Button("Confirmar Deposito");
         but_aceptar1 = new Button("Anular Confirmacion");
        but_cancelar = new Button("Cancelar/Salir");

        //but_verproducto = new Button("Ver Producto");
        pan_botones.add(but_aceptar);
         pan_botones.add(but_aceptar1);
        pan_botones.add(but_cancelar);


         pan_sud.add(new PaddedPanel(for_panel4, 0, 0, 100,0));
        pan_sud.add(new PaddedPanel(pan_botones, 10, 10, 10, 10), new TableLayoutData(4));



       Panel pan_centro = new Panel();
       pan_centro.setTitle("Sumatoria");
        pan_centro.setLayout(new FormLayout());
        // pan_centro.setHeight(200);
        //forthPanel.setPaddings(10);
      //   dataProxy1018 = new ScriptTagProxy("php/Depositos.php?funcion=buscardepositosmestotales&fechainicio="+fechainicio+"&fechafin="+fechafin);

               dataProxy1018 = new ScriptTagProxy("php/IngresoAlmacen.php?funcion=buscardatoscapital&fechainicio="+fechainicio+"&fechafin="+fechafin);
              final RecordDef recordDefb = new RecordDef(new FieldDef[]{
                    new StringFieldDef("id"),
                    new StringFieldDef("marca"),
                    new StringFieldDef("panterior"),
                    new StringFieldDef("santerior"),
                    new StringFieldDef("precibido"),
                    new StringFieldDef("srecibido"),
                    new StringFieldDef("pdev"),
                    new StringFieldDef("sdev"),
                     new StringFieldDef("pventa"),
                    new StringFieldDef("sventa"),
                    new StringFieldDef("cactual"),
                    new StringFieldDef("pactual"),
                    new StringFieldDef("sactual")
                });
        reader1018 = new JsonReader(recordDefb);
        reader1018.setRoot("resultado");
        reader1018.setTotalProperty("totalCount");

        store1018 = new Store(dataProxy1018, reader1018, true);


   idplanilla1018 = new ColumnConfig("idmarca", "id", 70, false);
        codigo1018 = new ColumnConfig("Marca", "marca", 140, false);
       codigof1018 = new ColumnConfig("P_anterior", "panterior", 80, false);
       meses1018 = new ColumnConfig("S_anterior", "santerior", 80, false);
      nombre1018 = new ColumnConfig("P_recibido", "precibido", 80,false);
        credito1018 = new ColumnConfig("S_recibido", "srecibido",80, false);
        preciosus1018 = new ColumnConfig("P_dev", "pdev", 80, true);
        totalcobro1018 = new ColumnConfig("sus_dev", "sdev", 80, true);
         totalcobrado1018 = new ColumnConfig("Pares Venta", "pventa", 100, true);
    tarjeta1018 = new ColumnConfig("Sus Venta", "sventa", 100, true);
        cobrador1018 = new ColumnConfig("C_Actual", "cactual", 100, true);
            totales1018 = new ColumnConfig("Pares", "pactual", 100, true);
 marca1018 = new ColumnConfig("Sus", "sactual", 90, true);


        cbSelectionModel1018 = new CheckboxSelectionModel();
        CheckboxColumnConfig checkBoxColumn = new CheckboxColumnConfig(cbSelectionModel1018);
        columns1018 = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel1018),
                    //column ID is company which is later used in setAutoExpandColumn
                    codigo1018,
                    codigof1018,
                    meses1018,
                    nombre1018,
                    credito1018,
                    preciosus1018,
                    totalcobro1018,
                    totalcobrado1018,
                    tarjeta1018,
                    cobrador1018,
                    totales1018,
                    marca1018
                };

        columnModel1018 = new ColumnModel(columns1018);
grid1018 = new EditorGridPanel();
       // grid1018 = new EditorGridPanel();
grid1018.setWidth("100%");
        grid1018.setHeight(ALTO);

        grid1018.setId("grid-lista-mensualdepositos");
      //  grid1018.setTitle("Lista de clientes");
        grid1018.setStore(store1018);
        grid1018.setColumnModel(columnModel1018);
        grid1018.setTrackMouseOver(true);
        grid1018.setLoadMask(true);
         grid1018.setSelectionModel(new RowSelectionModel());
        grid1018.setSelectionModel(cbSelectionModel1018);
        grid1018.setFrame(true);
        grid1018.setStripeRows(true);
        grid1018.setIconCls("grid-icon");
         grid1018.setAutoScroll(true);
         grid1018.setClicksToEdit(1);

    grid1018.setView(new GridView() {
            @Override
            public String getRowClass(Record record, int index, RowParams rowParams, Store store) {
                String estado = record.getAsString("estado");
                if (estado.equals("pendiente") == true) {
                    return "YELLOW";

                } else {
                    if (estado.equals("PENDIENTE") == true) {
                    return "YELLOW";

                } else
                    return "none";
                }

            }
        });

         kardexProducto1018 = new ToolbarButton("Ver Por Almacen");
        kardexProducto1018.setEnableToggle(true);
        QuickTipsConfig tipsConfig8 = new QuickTipsConfig();
        kardexProducto1018.setTitle("Ver Cobros para esa fecha");
        kardexProducto1018.setTooltip(tipsConfig8);

  kardexProducto10181 = new ToolbarButton("Ver Por Almacen");
        kardexProducto10181.setEnableToggle(true);
        QuickTipsConfig tipsConfig81 = new QuickTipsConfig();
        kardexProducto10181.setTitle("Ver Cobros para esa fecha");
        kardexProducto10181.setTooltip(tipsConfig81);


        pagingToolbar1018 = new PagingToolbar(store1018);
        pagingToolbar1018.setPageSize(100);
        pagingToolbar1018.setDisplayInfo(true);
        pagingToolbar1018.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar1018.setEmptyMsg("No topics to display");
        pagingToolbar1018.addSeparator();
        pagingToolbar1018.addButton(kardexProducto1018);
        pagingToolbar1018.addSeparator();
        pagingToolbar1018.addButton(kardexProducto10181);
        pagingToolbar1018.addSeparator();
        grid1018.setBottomToolbar(pagingToolbar1018);
         addListenersGrid();

        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centro, new BorderLayoutData(RegionPosition.CENTER));
        pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        add(pan_borderLayout);
        pan_centro.add(grid1018);
       // initCombos();
        initValues();
        addListeners();
      //  addListenerTotal();


    }
 public EditorGridPanel getGrid() {
        return grid1018;

    }
       private void initValues() {
tex_comision.setValue(saldototal);
 tex_anterior.setValue(anterior);
   tex_mesplanilla.setValue(cobrosbs);
   tex_pares.setValue(cobrossus);
   tex_totalventa.setValue(chequebs);
   tex_mes8.setValue(tarjeta);
   tex_mes1.setValue(otrosingresos);
   tex_mes2.setValue(comisionbs);
   tex_mes3.setValue(gastosbs);
   tex_mes4.setValue(gastossus);
   tex_mes5.setValue(depositosbs);
   tex_mes6.setValue(depositossus);
   tex_mes7.setValue(totales);
      //  tex_totalcaja.setValue(totalfin);
    }


 private void addListenersGrid() {

             kardexProducto1018.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel1018.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("id");


       // String idestilo = com_estilo.getValue();
         String idestilo = "alm-1";
         String idkardex = "042015";


 String enlace = "funcion=verDetalleCapitalMarcaAlmacen&idmarca=" + selecionado + "&idkardex="+idkardex;
               verReporte(enlace);
                } else {
                    MessageBox.alert("No hay marca seleccionada para ver  y/o selecciono mas de uno.");
                }
                kardexProducto1018.setPressed(false);
            }
        });
  kardexProducto10181.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel1018.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("id");


       // String idestilo = com_estilo.getValue();
         String idestilo = "alm-1";
         String idkardex = "042015";


 String enlace = "funcion=verDetalleCapitalMarca&idmarca=" + selecionado + "&idkardex="+idkardex;
               verReporte(enlace);

                } else {
                    MessageBox.alert("No hay fecha seleccionada para ver cobros y/o selecciono mas de uno.");
                }
                kardexProducto10181.setPressed(false);
            }
        });



        // grid.addGridColumnListener(listener)



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
                    public void onCellClick(GridPanel grid1018, int rowIndex, int colIndex, EventObject e) {

                            if (grid1018.getColumnModel().getDataIndex(colIndex).equals("indoor")) {
                            Record record = grid1018.getStore().getAt(rowIndex);
                            record.set("indoor", !record.getAsBoolean("indoor"));
                        //      record.set("depositosbs", record.getAsInteger("cobrosbs"));
                        }
                              if (grid1018.getColumnModel().getDataIndex(colIndex).equals("indoor") &&
                                e.getTarget(".checkbox", 1) != null) {
                            Record record = grid1018.getStore().getAt(rowIndex);
                            record.set("indoor", !record.getAsBoolean("indoor"));
                        }

                        if (grid1018.getColumnModel().getDataIndex(colIndex).equals("indoor")) {
                            int newcol = colIndex + 1;
                            if (e.getKey() == EventObject.ENTER) {
                                Record record1 = grid1018.getStore().getAt(newcol);
                                record1.set("indoor", record1);
                            }
                        }


                   if (grid1018.getColumnModel().getDataIndex(colIndex).equals("fecha")) {
                       int antcol = colIndex ;
                       columnaseleccionada = antcol;
                       escolumna="columna1";

                         abrirreporte(escolumna,"fecha");
                   }else{
                             if (grid1018.getColumnModel().getDataIndex(colIndex).equals("cobrosbs")) {
                       int antcol = colIndex ;
                       columnaseleccionada = antcol;
                       escolumna="columna2";
                        abrirreporte(escolumna,"cobrosbs");
                   }else{
                             if (grid1018.getColumnModel().getDataIndex(colIndex).equals("cobrossus")) {
                       int antcol = colIndex ;
                       columnaseleccionada = antcol;
                       escolumna="columna3";
                        abrirreporte(escolumna,"cobrossus");
                   }else{
                   if (grid1018.getColumnModel().getDataIndex(colIndex).equals("chequesbs")) {
                       int antcol = colIndex ;
                       columnaseleccionada = antcol;
                       escolumna="columna4";
                        abrirreporte(escolumna,"chequesbs");
                   }else{
                   if (grid1018.getColumnModel().getDataIndex(colIndex).equals("otrosingresos")) {
                       int antcol = colIndex ;
                       columnaseleccionada = antcol;
                       escolumna="columna5";
                        abrirreporte(escolumna,"otrosingresos");
                   }else{
                   if (grid1018.getColumnModel().getDataIndex(colIndex).equals("comisiones")) {
                       int antcol = colIndex ;
                       columnaseleccionada = antcol;
                       escolumna="columna6";
                        abrirreporte(escolumna,"comisiones");
                   }else{
                   if (grid1018.getColumnModel().getDataIndex(colIndex).equals("gastosbs")) {
                       int antcol = colIndex ;
                       columnaseleccionada = antcol;
                       escolumna="columna7";
                        abrirreporte(escolumna,"gastosbs");
                   }else{
                   if (grid1018.getColumnModel().getDataIndex(colIndex).equals("gastossus")) {
                       int antcol = colIndex ;
                       columnaseleccionada = antcol;
                       escolumna="columna8";
                        abrirreporte(escolumna,"gastossus");
                   }else{
                   if (grid1018.getColumnModel().getDataIndex(colIndex).equals("depositosbs")) {
                       int antcol = colIndex ;
                       columnaseleccionada = antcol;
                       escolumna="columna9";

                   }else{
                   if (grid1018.getColumnModel().getDataIndex(colIndex).equals("depositossus")) {
                       int antcol = colIndex ;
                       columnaseleccionada = antcol;
                       escolumna="columna10";
                        abrirreporte(escolumna,"depositossus");
                       }
                       }

                       }
                       }
                       }
                       }
                       }
                       }
                       }
                   }

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
           //   montocobrodecimal = record.getAsFloat("cobro1");
             // saldo = record.getAsFloat("saldo");

  record.set("depositosbs", record.getAsInteger("cobrosbs"));

  }


   public void doBeforeEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
                    Float total = new Float(0);
          Float total411 = new Float(0);



       record.set("depositosbs", record.getAsInteger("cobrosbs") - record.getAsInteger("comisiones") + record.getAsInteger("gastosbs"));
  record.set("depositosbs", record.getAsInteger("cobrosbs"));

//                for (int i = 0; i < grid.getStore().getRecords().length; i++) {
//                        total411 += grid.getStore().getModifiedRecords()[i].getAsFloat("totalcobrado");
//                      }



            }
         });

    }


    private void addListeners() {

      but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
 kmenu.seleccionarOpcionRemove(null, "fun7009", e, ResumenCapital.this);
 abrirpanelreporte();

                //closeTabCompraDirecta();
            }
        });

        //**************************************************
        //************* BOTON ACEPTAR *******************
        //**************************************************
        but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
             // createCompra();
            //  MessageBox.alert("Abriendo panel de  confirmacion");
              creandoconfimacion();
            }
        });
           but_aceptar1.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
             // createCompra();
            //  MessageBox.alert("Abriendo panel de  confirmacion");
             // creandoconfimacion();
                   creandoanulacion();
            }
        });
    }
     private void abrirreporte(String escolum, String dato){
          Record[] records = cbSelectionModel1018.getSelections();
                   selecionado = records[0].getAsString("id");
                   selecionado2 = records[0].getAsString("fecha");
                   //        String enlace = "php/Depositos.php?funcion=BuscarDatosdepositosmensual&idempresa=" + idempresa+"&planilla="+planilla+"&fecharango="+fechaini;

                    String enlTemp = "funcion=reportedepositosdetalladoHTML&id=" + selecionado+"&fecha="+selecionado2+"&idcelda="+dato+"&columna="+escolum;
                    verReporte(enlTemp);

     }
    private void abrirpanelreporte(){
  String enlace = "php/Anio.php?funcion=Consultamesanio";
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

                                        String mesanio = Utils.getStringOfJSONObject(marcaO, "mesanio");
                                      // SM = new SeleccionMarcaEstiloInventario(mesanio,kmenu);
                                       // SM.show();

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

   public void createComprapagadopendiente(String column,final EventObject ee) {
this.columna= column;

String fechaa = DateUtil.format(dat_fecha.getValue(), "Y-m-d");

        String mesplanilla =tex_planilla.getText();

    Record[] recordss = grid1018.getStore().getRecords();
        JSONArray productos = new JSONArray();
        JSONObject productoObject;


               // tex_montocancelado.setValue("0");
            JSONObject compraObject = new JSONObject();
         compraObject.put("fecha", new JSONString(fechaa));
         compraObject.put("idempresa", new JSONString(idempresa));
 compraObject.put("escolumna", new JSONString(columna));
 compraObject.put("mesplanilla", new JSONString(mesplanilla));


               compraObject.put("tipopago", new JSONString("pagadopendiente"));
             // }
            for (int i = 0; i < recordss.length; i++) {
                productoObject = new JSONObject();
                 productoObject.put("idclienteempresa", new JSONString(recordss[i].getAsString("idclienteempresa")));
                 productoObject.put("idplanillaemitida", new JSONString(recordss[i].getAsString("idplanillaemitida")));
                productoObject.put("cobro1", new JSONString(recordss[i].getAsString("cobro1")));
                productoObject.put("cobro2", new JSONString(recordss[i].getAsString("cobro2")));
                productoObject.put("cobro3", new JSONString(recordss[i].getAsString("cobro3")));
               productoObject.put("totalcobrado", new JSONString(recordss[i].getAsString("totalcobrado")));

                 productos.set(i, productoObject);
                productoObject = null;
            }
            JSONObject resultado = new JSONObject();
            resultado.put("cobro", compraObject);
            resultado.put("cobrocliente", productos);

            String datos = "resultado=" + resultado.toString();

            Utils.setErrorPrincipal("registrando", "cargar");
//             String url = "php/Cobros.php?funcion=registrarcobroplanillacomision&" + datos;
 String url = "php/Cobros.php?funcion=registrarcobroplanillapagadopendiente&" + datos;

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

                                                       //          verReporte(enlTemp);
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
        //




}



  private void calcularSubTotal2(GridPanel grid1018, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
        String temp = newValue.toString();
 Float old = new Float(oldValue.toString());
        int cob1 = record.getAsInteger("cobro1");
        int cob2 = record.getAsInteger("cobro2");
        int cob3 = record.getAsInteger("cobro3");
                int totalcob = record.getAsInteger("totalcobro");
String v = "0";
        int valor = record.getAsInteger(v);
        Float ne = old;
        try {
            ne = new Float(temp);
        } catch (Exception e) {
            com.google.gwt.user.client.Window.alert("error en el campo" + e.getMessage());
            ne = old;
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
                  record.set("totalcobrado", 0.0);
  }
         if (colIndex == 6) {


                    record.commit();
    if (record.getAsInteger("cobro1") == valor) {
        record.set("cobro1",cob1);
  record.set("cobro1", (record.getAsInteger("cobro1")));
  if ((record.getAsInteger("cobro1")) > (record.getAsInteger("total"))){
               com.google.gwt.user.client.Window.alert("El monto de cobro excede el saldo  de credito por favor verifique a");

 record.set("cobro1", valor);
record.set("cobro2", valor);
record.set("cobro3", valor);
                                }else{
   if ((record.getAsInteger("cobro1")) > (record.getAsInteger("mes1"))){
           //     int[] difer = new int[0];
       int difer = (record.getAsInteger("cobro1"))-(record.getAsInteger("mes1"));
         record.set("cobro1", (record.getAsInteger("mes1")));
          record.set("cobro2", (difer));
   }
   if ((record.getAsInteger("cobro2") == valor) &&(record.getAsInteger("mes1") == record.getAsInteger("cobro1") ) ) {
  record.set("cobro2", (record.getAsInteger("cobro2")));
   if ((record.getAsInteger("cobro2")) > (record.getAsInteger("mes2"))){
 //  Float difer = new Float(0);
        int difer = (record.getAsInteger("cobro2"))-(record.getAsInteger("mes2"));
         record.set("cobro2", (record.getAsInteger("mes2")));
          record.set("cobro3", (difer));
   }
    }
                                }

    }else{

           if ((record.getAsInteger("cobro1")+old) > (record.getAsInteger("total"))){
               com.google.gwt.user.client.Window.alert("El monto de cobro excede el saldo  de credito por favor verifique b" +old);

               record.set("cobro1", valor+old);
record.set("cobro2", valor);
record.set("cobro3", valor);
                                }else{
     if ((record.getAsInteger("cobro1")+ old) > (record.getAsInteger("mes1"))){
               record.set("cobro2", (record.getAsInteger("cobro1")+old)-(record.getAsInteger("mes1")));

              //  record.set("cobro1", record.getAsFloat("mes1") - (record.getAsFloat("cobro1")+old));
                record.set("cobro1", record.getAsInteger("mes1"));

            }
    else{
             record.set("cobro1", record.getAsInteger("cobro1") + old);
            }
      if ((record.getAsInteger("cobro1")) == old){
          record.set("cobro1", record.getAsInteger("cobro1") + record.getAsInteger("cobro1"));
      }
    }
    record.set("totalcobrado", cob1 + cob2 + cob3);

    }

        }
         if (colIndex == 7) {
            // record.set("cantidad", ne);
        }
        if (colIndex == 8) {

                    record.commit();
    //if (record.getAsInteger("cobro2") == 0) {
 // record.set("cobro2", (record.getAsInteger("cobro2")+ old));

  if (cob2 > (record.getAsInteger("total"))){
             com.google.gwt.user.client.Window.alert("El monto de cobro excede el saldo  de credito por favor verifique");
                  //  record.set("cobro1", 0);
record.set("cobro2", old);
record.set("cobro3", valor);
  record.set("totalcobrado", valor);

    }else{
       if ((record.getAsInteger("cobro2") != valor ||(record.getAsInteger("cobro2") != valor))&&(record.getAsInteger("cobro1") == valor)) {
                   com.google.gwt.user.client.Window.alert("En la columna anterior aun no se realizo ningun pago");
                   record.set("cobro2", valor);
                   record.set("totalcobrado", valor);
                  // record.set("cobro2", 0.00);

        }else{
         if ((record.getAsInteger("cobro2") != valor)&&(record.getAsInteger("cobro1") < record.getAsInteger("mes1"))) {
                   com.google.gwt.user.client.Window.alert("En la columna anterior existe un saldo pendiente (col-2), completelo antes de continuar");
                   record.set("cobro2", 0);
                   record.set("totalcobrado", 0);
                  // record.set("cobro2", 0.00);

        }else{
     if ((record.getAsInteger("cobro2") > record.getAsInteger("mes2"))&&(record.getAsInteger("cobro1") == record.getAsInteger("mes1"))) {
 int difer = (record.getAsInteger("cobro2"))-(record.getAsInteger("mes2"));
         record.set("cobro2", (record.getAsInteger("mes2")));
          record.set("cobro3", (difer));
        }
    if ((record.getAsInteger("cobro2") < record.getAsInteger("mes2"))&&(record.getAsInteger("cobro1") == record.getAsInteger("mes1"))) {
        record.set("cobro2", (cob2 + old));
      //  record.set("cobro2", (record.getAsInteger("cobro2") + old));

        record.set("cobro3", valor);
        }
      if ((cob2+old > record.getAsInteger("mes2"))&&(record.getAsInteger("cobro1") == record.getAsInteger("mes1"))) {
     //     int dd = cob2+old;
        int difer = (record.getAsInteger("cobro2"))-(record.getAsInteger("mes2"));
         record.set("cobro2", (record.getAsInteger("mes2")));
          record.set("cobro3", (difer));
        }
    }
    }
     }
    record.set("totalcobrado", cob2 + cob3);
   //record.endEdit();
        }

        if (colIndex == 10) {
          //  record.set("cobro3", cob3);
              if (record.getAsInteger("cobro3") != valor) {

             if ((record.getAsInteger("cobro3") != 0)&&(record.getAsInteger("cobro2") == 0)||(record.getAsInteger("cobro2") == 0)) {
                 com.google.gwt.user.client.Window.alert("Asigne el cobro en la columna correspondiente, la columna anterior es 0");
                  // record.set("cobro1", 0.00);
                  // record.set("cobro2", 0.00);
              }
             if ((record.getAsInteger("cobro3") != valor)&&(record.getAsInteger("cobro1") == 0)||(record.getAsInteger("cobro1") == 0)) {
                  com.google.gwt.user.client.Window.alert("Asigne el cobro en la columna correspondiente, la primera columna es 0");
                  // record.set("cobro1", 0.00);
                  // record.set("cobro2", 0.00);
              }
               if ((record.getAsInteger("cobro3") != 0)&&(record.getAsInteger("cobro2") < record.getAsInteger("mes2"))) {
                  com.google.gwt.user.client.Window.alert("En la columna anterior existe un saldo pendiente(col-3), completelo antes de continuar");
                   record.set("cobro3", valor);

                   record.set("totalcobrado", valor);
                  // record.set("cobro2", 0.00);
              }
              if ((record.getAsInteger("cobro3") < record.getAsInteger("mes3"))&&(record.getAsInteger("cobro2") == record.getAsInteger("mes2"))) {
        record.set("cobro3", (cob3 + old));
      //  record.set("cobro2", (record.getAsInteger("cobro2") + old));

    //    record.set("cobro3", 0);
        }

if ((record.getAsInteger("cobro2") == record.getAsInteger("mes2"))) {
 //int difer = (record.getAsInteger("cobro2"))-(record.getAsInteger("mes2"));
         record.set("cobro3", (record.getAsInteger("cobro3")));
          //record.set("cobro3", (difer));
        }

        }else{
        record.set("cobro3", cob3);
        }
                //  record.set("cobro3", 0.0);
                record.set("totalcobrado",  cob3);

      }



        record.commit();
         record.set("totalcobro", ((record.getAsInteger("cobro1"))+(record.getAsInteger("cobro2"))+(record.getAsInteger("cobro3"))));

      Float total = new Float(0);
      Float total1 = new Float(0);
      Float total2 = new Float(0);
        for (int i = 0; i < grid1018.getStore().getRecords().length; i++) {
            total += grid1018.getStore().getRecords()[i].getAsInteger("cobro1");
            total1 += grid1018.getStore().getRecords()[i].getAsInteger("cobro2");
            total2 += grid1018.getStore().getRecords()[i].getAsInteger("cobro3");

        }

         Float total41 = new Float(0);
        for (int i = 0; i < grid1018.getStore().getModifiedRecords().length; i++) {
            total41 += grid1018.getStore().getModifiedRecords()[i].getAsInteger("totalcobro");
          }

       totalcobro =(cobro1.toString())+(cobro2.toString())+(cobro3.toString());
       totalc = total41.toString();


  // record.set("totalcobrado", ((record.getAsFloat("cobro1"))+(record.getAsFloat("cobro2"))+(record.getAsFloat("cobro3"))));

          Float total411 = new Float(0);
        for (int i = 0; i < grid1018.getStore().getModifiedRecords().length; i++) {
            total411 += grid1018.getStore().getModifiedRecords()[i].getAsFloat("totalcobrado");
          }

            totalTotalV1073 = total411;
        descPorV1073 = totalTotalV1073 - cobrototall.floatValue();
//          tex_montototal.setValue(total411.toString());


    }

    public void creandoconfimacion() {
          final Record[] records;
      records = cbSelectionModel1018.getSelections();
       if (records.length > 0) {
                   MessageBox.confirm("Guardar", "Realmente desea confirmar: " + records.length + " item(s)?", new MessageBox.ConfirmCallback() {
                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                JSONArray productos = new JSONArray();
                                JSONObject productoObject;

                                for (int i = 0; i < records.length; i++) {
                                    productoObject = new JSONObject();

                               productoObject.put("id", new JSONString(records[i].getAsString("id")));
                               productoObject.put("fecha", new JSONString(records[i].getAsString("fecha")));
                               productoObject.put("estado", new JSONString(records[i].getAsString("estado")));
                           productos.set(i, productoObject);
                                    productoObject = null;
                                }
                                //eliminar
                                JSONObject resultado = new JSONObject();
                                 resultado.put("productos", productos);

                               String datos = "resultado=" + resultado.toString();
                               Utils.setErrorPrincipal("Confirmando Deposito(s)", "cargar");
                            //    String url = "./php/VentaCredito.php?funcion=GuardaryValidar&" + datos;
                                  String url = "php/Depositos.php?funcion=confirmardepositoestado&" + datos;

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

    }
     public void creandoanulacion() {
          final Record[] records;
      records = cbSelectionModel1018.getSelections();
       if (records.length > 0) {
                   MessageBox.confirm("Guardar", "Realmente desea anular la confirmacion: " + records.length + " item(s)?", new MessageBox.ConfirmCallback() {
                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                JSONArray productos = new JSONArray();
                                JSONObject productoObject;

                                for (int i = 0; i < records.length; i++) {
                                    productoObject = new JSONObject();

                               productoObject.put("id", new JSONString(records[i].getAsString("id")));
                               productoObject.put("fecha", new JSONString(records[i].getAsString("fecha")));
                               productoObject.put("estado", new JSONString(records[i].getAsString("estado")));
                           productos.set(i, productoObject);
                                    productoObject = null;
                                }
                                //eliminar
                                JSONObject resultado = new JSONObject();
                                 resultado.put("productos", productos);

                               String datos = "resultado=" + resultado.toString();
                               Utils.setErrorPrincipal("Revirtiendo(s)", "cargar");
                            //    String url = "./php/VentaCredito.php?funcion=GuardaryValidar&" + datos;
//                                  String url = "php/Depositos.php?funcion=confirmardepositoestado&" + datos;
  String url = "php/Depositos.php?funcion=anulardepositoestado&" + datos;

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

    }
    public void setGrid(EditorGridPanel grid) {
        this.grid1018 = grid;
    }
 private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }


 public NumberField metodoFeli() {


        NumberField num_field1 = new NumberField();
        num_field1.setAllowDecimals(false);
        num_field1.setAllowBlank(false);

        num_field1.setAllowNegative(false);

        return num_field1;
    }

}

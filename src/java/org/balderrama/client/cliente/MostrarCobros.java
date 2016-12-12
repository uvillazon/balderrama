/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.cliente;

import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.NumberField;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.google.gwt.user.client.ui.RadioButton;
import com.gwtext.client.widgets.TabPanel;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.ArrayReader;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.data.FieldDef;
import com.gwtext.client.data.JsonReader;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.RecordDef;
import com.gwtext.client.data.ScriptTagProxy;
import com.gwtext.client.data.Store;
import com.gwtext.client.data.StringFieldDef;
import com.gwtext.client.util.DateUtil;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.Window;

import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FieldSet;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.MultiFieldPanel;
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
import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtextux.client.data.PagingMemoryProxy;
import java.util.Date;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;

/**
 *
 * @author
 */
class MostrarCobros extends Window {

    private final int ANCHO = 500;
    private final int ALTO = 500;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("98%");
//FormularioProductoKardex kardex;
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanelCliente;
    private TextField tex_fecha;
 private Object[][] productoM;
  public TextField tex_montoPagar;
   // private TextField tex_montoTotal;
     public TextField tex_totalpares;
    public TextField tex_montocancelado1;
    private NumberField tex_caja;
    public TextField tex_montocancelado;
   // public TextField tex_montocanceladosus;
     public NumberField tex_montocanceladosus;
   // public PanelVenta padre;
//    private String total;
    private String montosusredondo;
  private TextField tex_codigo;
    private TextField tex_cambio;
    private TextField tex_nombre;
    private TextField tex_direccion;
    private TextField tex_telefono;
    private TextField nombreResponsable;
    private TextField apellidoResponsable;
     private TextField nitResponsable;
    private TextField telefonoResponasable;
    private TextField celularResponsable;
    private TextField emailResponsable;
    private TextField direccionresponsable;
    private TextField comisionResponsable;
    private TextField tex_saldoAnterior;
    private TextField tex_saldoActual;
    private TextField tex_planillaActual;
  //  private TextField tex_tipoPlanilla;

    private TextField tex_fax;

    public NumberField tex_montoTotal;
    public NumberField tex_montoTotalsus;
    public NumberField tex_devuelto;
    public NumberField tex_devueltosus;
      public NumberField tex_vcfactura;
        private TextField tex_idproducto;
    private ComboBox com_almacendestino;
   // private ComboBox com_empleado;
      public ComboBox com_empleado;
    private TextField tex_codigoBarra;
     private TextField tex_codigoBarra1;
    private TextArea tex_descripcion;
    private FormPanel for_panel;
    private EditorGridPanel grid;
    private Store store;
    private ColumnModel columnModel;
    private BaseColumnConfig[] columns;
    private CheckboxSelectionModel cbSelectionModel;
    private PagingMemoryProxy proxy;
    private ArrayReader reader;
    private ToolbarButton eliminarEntrega;
    private Button aceptar;
    private Button cancelar;
    private Button verproducto;
    protected ExtElement ext_element;
    public TabPanel tap_panel;
    
    public TextField tex_codigoC;
    public TextField tex_nombreC;
    public TextArea tex_area;
        public TextArea tex_area1;
  //  public TextField tex_area2;
     //  public HtmlEditor tex_area1;
   // private NumberField tex_cajanueva;
    public TextField tex_cpagadoregistro;
    private TextField tex_nuevaventa;
    private TextField tex_vsfactura;
    private TextField tex_vctarjeta;
    private TextField tex_vcredito;
    private TextField tex_extras;
    private TextField tex_cpagado;
    private TextField tex_devolucion;
    private TextField tex_gastos;
//    private TextField tex_total;
 private NumberField tex_total;
  public NumberField tex_efecsus;
    public NumberField tex_efecmonedas;
    public NumberField tex_depbs;
    public NumberField tex_depsus;
  public NumberField tex_efecbs;
   // private TextField tex_efecsus;
    private TextField tex_detalle;
boolean respuesta = false;
  private RecordDef recordDef;
    private Float totalcantidad;
    private Float totalBs;
    private Float totalTotalV1073;
    private Float descPorV1073;
    private Float descCalV1073;
    private Float totalTotalVsus;
    private Float devuelto;
   // private Float montocambio;
   // private Float tipocambio;
    private Float devueltosus;
    private Float montocancelado;
 //    private Float montodescuento;
    private Float montocanceladosus;
    private Float diferencia;
    private Float nuevobs;
     private Float cambio;
      private Float montocanceladosusenbs;
  private Float nuevomontodeuda;
  private Float montobscaja;

    private DateField dat_fecha;
  //   private Date fecha;
    private Button but_aceptar;
        private Button but_i;
 //      private Button but_eliminar;
   //  private Button but_aceptarv;
    private Button but_cancelar;
    private String fechad;
    private String caja;
    //   public FieldSet userFS;
    private Float vcfactura;
    private String vsfactura;
    private String vctarjeta;
    private String vcredito;
    private String extras;
    private String cpagado;
    private String devolucion;
    private String gastos;
    private Number total;
//private String total;
private Float ventaanterior;
    private Float ventanueva;
    private Float reintegro;
   private Float reintegron;

    private String credito;
    private String efecbs;
    private String efecsus;
    private String efecmonedas;
    private String depbs;
    private String depsus;
    private String cajanueva;
    private String cpagadoregistro;
  //   private String turno;
    private String[] estados;
    private Object[][] comunidadM;
    private Object[][] tipoM;
    private Store ciudadStore;
    private Store cobradorStore;
    private Store tipoStore;
   // private SeleccionFecha padre;
    private String fechab;
    private String idmarca;
    private String fecha;
     private String tipocambio;
     private Float tipocambio2;
private EditorGridPanel grid1015;
private ColumnConfig id1015;
        private ColumnConfig codigo1015;
    private ColumnConfig codigof1015;
    private ColumnConfig nombre1015;
    private ColumnConfig marca1015;
    private ColumnConfig pais1015;
    private ColumnConfig cantidad1015;
    private ColumnConfig preciobs1015;
    private ColumnConfig preciosus1015;
    private ColumnConfig pago7;
    private ColumnConfig car1015;
    private ToolbarButton editarProducto1015;
    private ToolbarButton eliminarProducto1015;
    private ToolbarButton nuevoProducto1015;
    private ToolbarButton duplicarProducto1015;
    private ToolbarButton caracProducto1015;
    private ToolbarButton inventarioProducto1015;
    private ToolbarButton kardexProducto1015;
    private ToolbarButton movimientoProducto1015;
    private ToolbarButton verProducto1015;
    protected ExtElement ext_element1015;
    private CheckboxSelectionModel cbSelectionModel1015;
    private Store store1015;
    private BaseColumnConfig[] columns1015;
    private ColumnModel columnModel1015;
    private DataProxy dataProxy1015;
    private JsonReader reader1015;
    PagingToolbar pagingToolbar1015;
private ComboBox com_vendedor;
 private PanelCobro padre;
 private String idempresa;
   private String codigoD;
   private String nombreD;
   private String direccionD;
   private String telefonoD;
   private String faxD;
   private String fechaD;
   private String fechaContratod;
   private String estadoD;
   private String ciudadD;
   private String cobradorD;
   private String nombresD;
   private String apellidosD;
    private String nitD;
   private String telefonoResD;
   private String celularResD;
   private String emailD;
   private String direccionResD;
   private String comisionD;
        private Float montobs;
     private String montobs1;
    private Float montosus;

    private Float monedas;
    private Float efectivobs;
    private Float montocancelarfin;
    private Float montocancelarfinsus;
     private Float montocancelarfinsustotal;
     public Float montobsacuenta;
     public Float montobscalculo;

        private Float montocajanueva;
          private Date fechahoy;


//   private String telefonoFijoD;
//   private String telefonoTrabajoD;
//   private String telefonoCelD;
 private String saldoAnteriorD;
   private String saldoActualD;
   private String planillaActualD;
    private String tipoPlanillaD;
   private String empleadoAsignadoD;
    private DateField dat_fecha1;
    private ComboBox com_estadoC;
    private ComboBox com_comisionC;
 private ComboBox com_tipoplanilla;
    private ComboBox com_ciudadC;
    private ComboBox com_cobradorC;
    private String[] estadoM;
    private String[] comisionM;
 private Object[][] tipoplanilla;
 private String[] tipoplanillaM;
 private String mesplanilla;
    private Object[][] ciudadM;
   private Object[][] cobradorM;
    private String[] pagoM;
        private ComboBox com_pago;
 private boolean nuevo;
 String valortotal;
    String comision;
    String empresanombre;
    String clientes;
String acuenta;
String resultado;
String comisiontotal;
String tipocomision;
String nombres;
String montos;
 public RadioButton facturaSi;
    private RadioButton facturaNo;
//private Number acuenta;
  //  public NuevaEmpresaForm(String idMarca, String tipodecambio,Credito panel) {

public MostrarCobros(String idempresa,String emp,String monto,String comision, String msg,String cliente,String montobs,PanelCobro panel)
{
  this.padre = panel;
        this.valortotal = monto;
        this.idempresa = idempresa;
         this.comision = comision;
        this.empresanombre = emp;

this.clientes = msg;
this.nombres = cliente;
this.montos = montobs;

    String tituloTabla ="Cobros-"+empresanombre ;
       padre=panel;
       String nombreBoton1 = "Grabar";
        String nombreBoton2 = "Cancelar";
         String nombreBoton3 = "I";
       
        setId("win-NuevaEmpresaForm");
        setTitle(tituloTabla);
        setWidth(500);
        setMinWidth(ANCHO);
        setHeight(300);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        setPlain(true);

        but_aceptar = new Button(nombreBoton1);
        but_cancelar = new Button(nombreBoton2);
        but_i = new Button(nombreBoton3);
     //   addButton(but_aceptarv);
        addButton(but_aceptar);
        addButton(but_cancelar);
      
        formPanelCliente = new FormPanel();
        formPanelCliente.setBaseCls("x-plain");
        //formPanelCliente.setLabelWidth(130);
        formPanelCliente.setUrl("save-form.php");
        formPanelCliente.setWidth(ANCHO);
        formPanelCliente.setHeight(ALTO);
        formPanelCliente.setLabelAlign(Position.LEFT);
 dat_fecha = new DateField("Fecha", "d-m-Y");
  //dat_fecha = new DateField("Fecha", "d-m-Y");
    //      private Date fechahoy;
        fechahoy = new Date();
              dat_fecha.setValue(fechahoy);

       formPanelCliente.setAutoWidth(true);
  

dat_fecha = new DateField("Fecha", "d-m-Y");
         fechahoy = new Date();
              dat_fecha.setValue(fechahoy);
 dat_fecha.setReadOnly(true);
        MultiFieldPanel namePanel311 = new MultiFieldPanel();
         tex_codigoBarra = new TextField("Total Pagado", "totalmonto" ,60);
         tex_codigoBarra.setValue(valortotal);
         tex_codigoBarra.focus();
               namePanel311.addToRow(tex_codigoBarra, 170);
             formPanelCliente.add(namePanel311);

        MultiFieldPanel namePanel31 = new MultiFieldPanel();
//          tex_codigoC = new TextField("Comision Bs", "comision", 60);
//             tex_codigoC.setValue("0");
//        tex_codigoC.setMaxLength(6);
       // tex_codigoC.setValue("0");
          tex_codigoC = new TextField("Comision Bs", "comision",60);
  //      tex_codigoC.setAllowBlank(true);
       //  tex_codigoC.setDecimalPrecision(2);
      //   tex_depsus.setValue(valortotal);
        addButton(but_i);

        tex_nombreC = new TextField("Num. Recibo", "recibo",60);
          tex_nombreC.setValue("0");
tex_nombreC.focus();
//        if(comision=="0"){
//       tex_codigoC.setReadOnly(true);
//       tex_nombreC.setReadOnly(true);
//       }else{
//       tex_codigoC.setReadOnly(false);
//       tex_nombreC.setReadOnly(false);
//       }
           initValues1();
          namePanel31.addToRow(tex_nombreC, 205);
           namePanel31.addToRow(tex_codigoC, 205);
       
            //detailsFS.add(namePanel31);
            // topPanel1.add(detailsFS);
    formPanelCliente.add(namePanel31);

      tex_efecbs = new NumberField("Monto BS", "efecbs",100);
               tex_efecbs.setAllowBlank(true);
         tex_efecbs.setDecimalPrecision(2);
        tex_efecbs.focus();
        tex_efecsus = new NumberField("Monto SUS", "efecsus",100);
        tex_efecsus.setAllowBlank(true);
         tex_efecsus.setDecimalPrecision(2);

        tex_efecmonedas = new NumberField("Equiv. BS", "efecbs",100);
       tex_efecmonedas.setAllowBlank(true);
 FieldSet userFS = new FieldSet();
         userFS.setCheckboxToggle(true);
         userFS.setFrame(true);
         userFS.setTitle("Pago en dolares");
         userFS.setCollapsed(true);


            MultiFieldPanel namePanel312 = new MultiFieldPanel();
          namePanel312.addToRow(tex_efecsus, 205);
           namePanel312.addToRow(tex_efecmonedas, 205);
            userFS.add(namePanel312);
           userFS.add(tex_efecbs);
                 formPanelCliente.add(userFS);

                   tex_depbs = new NumberField("Monto Bs", "depbs",100);
        tex_depbs.setAllowBlank(true);
         tex_depbs.setDecimalPrecision(2);

        tex_depsus = new NumberField("Monto cheque", "depsus",100);
        tex_depsus.setAllowBlank(true);
         tex_depsus.setDecimalPrecision(2);
         tex_depsus.setValue(valortotal);
         com_empleado = new ComboBox("Banco", "banco");
 initCombo();

        tex_cpagadoregistro = new TextField("Numero CHEQUE", "cpagado",100);

        FieldSet userFS1 = new FieldSet();
       userFS1.setCheckboxToggle(true);
         userFS1.setFrame(true);
         userFS1.setTitle("Pago con cheque");
         userFS1.setCollapsed(true);
          userFS1.add(com_empleado);
          userFS1.add(tex_cpagadoregistro);
          MultiFieldPanel namePanel3121 = new MultiFieldPanel();
          namePanel3121.addToRow(tex_depsus, 205);
           namePanel3121.addToRow(tex_depbs, 205);
            userFS1.add(namePanel3121);
                 formPanelCliente.add(userFS1);
                  facturaSi = new RadioButton("tarjetasi", "Pago con Tarjeta");
       // facturaNo = new RadioButton("facturano", "S/F");
        facturaSi.setEnabled(true);
        facturaSi.setChecked(false);
        
        formPanelCliente.add(facturaSi);
 initValues();

         
         tex_area = new TextArea("CLIENTES", "recibo");
          tex_area.setValue(nombres);
          tex_area.setHeight(200);
          tex_area.setWidth(170);
           tex_area1 = new TextArea("", "r");
          tex_area1.setValue(montos);
          tex_area1.setHeight(200);
          tex_area1.setWidth(80);

                FieldSet detailsFS = new FieldSet("");
        // detailsFS.setCollapsible(true);
        // detailsFS.setAutoHeight(true);
            detailsFS.setAutoHeight(true);
        detailsFS.setWidth(500);
          MultiFieldPanel namePanel317 = new MultiFieldPanel();
          namePanel317.addToRow(tex_area, 230);
           namePanel317.addToRow(tex_area1, 170);
            detailsFS.add(namePanel317);

             //  formPanelCliente.add(detailsFS);


         add(formPanelCliente);



//initCombo();
       // initValidators();
anadirListenersTexfield();
        addListeners();

    }

    MostrarCobros(String idcliente, String empresaa, String montototal1, String comision, String msg, String nombre, String monto, PanelCobroCuenta aThis) {
        throw new UnsupportedOperationException("Not yet implemented");
    }


private void anadirListenersTexfield() {

           com_empleado.addListener(new ComboBoxListenerAdapter() {

            @Override
            public void onSelect(ComboBox comboBox, Record record, int index) {

tex_cpagadoregistro.focus();
            }
        });
           com_empleado.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
               // recalcular2(false);
                 // recalcular2(true);
                  tex_cpagadoregistro.focus();

                }

            }
        });
 tex_codigoBarra.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
               // recalcular2(false);
                 // recalcular2(true);
                  tex_nombreC.focus();

                }

            }
        });
         tex_codigoC.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
               // recalcular2(false);
                 // recalcular2(true);

                     buscarcomision(comision);
                 // tex_nombreC.focus();

                }

            }
        });
 tex_nombreC.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                            tex_codigoC.focus();

                }

            }
        });
    tex_cpagadoregistro.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                  tex_depsus.focus();

                }
            }

        });
           tex_depsus.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                //  com_cobradorC.focus();
                     recalcular4(true);
                  tex_depbs.focus();
                }
            }

        });

         tex_efecsus.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                 findByCodigoCliente2();
                 // recalcular2(true);
                 tex_efecmonedas.focus();

                }

            }
        });

     tex_efecmonedas.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                  recalcular2(true);
                tex_efecbs.focus();
                }
                }
            });

      tex_efecbs.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                  recalcular2(true);
                 }
            }
        });
}
public void buscarcomision(final String acuenta){
//String planilla =padre.tex_planilla.getValueAsString().trim();
//String montocomision = tex_codigoC.getValueAsString().trim();
//String comision1 = padre.tex_comision.getValueAsString();
//String enlace = "php/Cobros.php?funcion=validarcomision&idempresa=" + idempresa+"&comision="+comision1+"&totalcobro="+valortotal+"&planilla="+planilla+"&montocomision="+montocomision;
////String enlace = "php/Cobros.php?funcion=validaracuentafecha&idempresa=" + idempresa+"&fecha="+fechapadre;
//
//         //    Utils.setErrorPrincipal("Buscando datos", "cargar");
//            final Conector conecaPB = new Conector(enlace, false);
//            try {
//                conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {
// private EventObject e;
//                    public void onResponseReceived(Request request, Response response) {
//                        String data = response.getText();
//                        JSONValue jsonValue = JSONParser.parse(data);
//                        JSONObject jsonObject;
//                        if ((jsonObject = jsonValue.isObject()) != null) {
//
//                            String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
//                            String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
//                            if (errorR.equalsIgnoreCase("true")) {
//                           //     Object[][] almacenM1109 = Utils.getArrayOfJSONObject(jsonObject, "tiendaM", new String[]{"idtienda", "nombre"});
//       //                       acuenta = Utils.getBigDecimalOfJSONObject(jsonObject, "acuenta");
//
//                                comisiontotal = Utils.getStringOfJSONObject(jsonObject, "comisiont");
// tipocomision = Utils.getStringOfJSONObject(jsonObject, "tipocomision");
// if(tipocomision=="si"){
// com.google.gwt.user.client.Window.alert(mensajeR);
// }else{}
//
//       // String valort =tex_codigoBarra.getValueAsString();
//
//
//MessageBox.confirm("Guardar", "El monto de comision es muy alto para este mes desea asignarlo de todas formas. : " + comisiontotal + " ?", new MessageBox.ConfirmCallback() {
//                        public void execute(String btnID) {
//                            if (btnID.equalsIgnoreCase("yes")) {
//                             tex_codigoC.focus();
//                           }else{
//                        //    tex_codigoC.setValue("0");
//                            tex_nombreC.focus();
//                           }//fin boton
//                        }
//                    });
//
//
//                            } else {
//                                 com.google.gwt.user.client.Window.alert(mensajeR);
//                            //  GuardarNuevoAlmacen();
////                        clear();
////                       close();
////                      destroy();
//                            }
//                        } else {
//                        }
//                    }
//
//                    public void onError(Request request, Throwable exception) {
//                        Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//                    }
//                });
//            } catch (RequestException ex) {
//                ex.getMessage();
//                Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//            }
}
private void recalcular4(boolean desc) {
      montobscaja = new Float(tex_codigoBarra.getText());

montosus = new Float(tex_depsus.getText());

montocancelarfin = new Float(tex_codigoBarra.getText());
montobscalculo =  montobscaja - montosus;
tex_depbs.setValue(montobscalculo.toString());


    }
  private void recalcular2(boolean desc) {
//      tex_efecbs = new NumberField("Monto BS", "efecbs",100);
//              tex_efecsus = new NumberField("Monto SUS", "efecsus",100);
//               tex_efecmonedas = new NumberField("Equiv. BS", "efecbs",100);
//             ddd
      montobscaja = new Float(tex_codigoBarra.getText());

montosus = new Float(tex_efecmonedas.getText());

//montocancelarfin = new Float(tex_codigoBarra.getText());
montobscalculo =  montobscaja - montosus;
tex_efecbs.setValue(montobscalculo.toString());

      // tex_cajanueva.setValue(cajanue.toString());
 monedas = new Float(tex_efecmonedas.getText());


    }
 private boolean findByCodigoCliente2() {
         respuesta = false;
   montobs1 = tex_efecsus.getValueAsString().trim();
//  tipocambio = new Float(String.valueOf(padre.cambioM));
  String enlace = "php/Cobros.php?funcion=BuscarRedondeo&montosus=" + montobs1;
//String enlace = "php/VentaDetalle.php?funcion=BuscarRedondeo&montobs=" + montobs+"&tipocambio="+tipocambio;

 final Conector conec1 = new Conector(enlace, false);

                try {
                    conec1.getRequestBuilder().sendRequest(null, new RequestCallback() {
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
                       montosusredondo = Utils.getStringOfJSONObject(clienteObject, "montobs");
                         tex_efecmonedas.setValue(montosusredondo);


                                        respuesta = true;
                                        recalcular2(true);
                                        //tex_montoTotal.setValue("0");
                                         //tex_efecbs.setValue("");
                                        tex_efecbs.focus();

                                    } else {
                                       // resetCamposCliente2();

                                        Utils.setErrorPrincipal("hubo un error", "error");
                                   tex_efecmonedas.setValue("0.00");
                                    tex_efecmonedas.focus();
                                //   tex_vendedor.setDisabled(true);

                                    }

                                } else {
                                   // resetCamposCliente2();

                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                           // resetCamposCliente2();

                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");

                        }
                    });

                } catch (RequestException ex) {
                    ex.getMessage();
                    //resetCamposCliente2();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }

                return respuesta;
            }

private void initCombo() {
  ScriptTagProxy dataProxyAlmacenes = new ScriptTagProxy("php/Cobros.php?funcion=ListarBancosActivos");
        final RecordDef recordDef1 = new RecordDef(new FieldDef[]{
                     new StringFieldDef("id"),
                    new StringFieldDef("banco"),
                     new StringFieldDef("estado")
                });
        JsonReader readerAlmacen = new JsonReader(recordDef1);
        readerAlmacen.setRoot("resultado");
        readerAlmacen.setTotalProperty("totalCount");
        Store storeAlmacen = new Store(dataProxyAlmacenes, readerAlmacen, true);
        storeAlmacen.load();
//   final SimpleStore proveedorStore1 = new SimpleStore(new String[]{"idcliente", "nombre"}, clienteM);
//        proveedorStore1.load();
//
        //com_empleado.setMinChars(1);
        com_empleado.setStore(storeAlmacen);
        com_empleado.setValueField("id");
        com_empleado.setDisplayField("banco");
        com_empleado.setForceSelection(false);
        com_empleado.setMode(ComboBox.LOCAL);
        com_empleado.setEmptyText("Seleccione un banco");
        com_empleado.setLoadingText("buscando...");
        com_empleado.setTypeAhead(true);
        com_empleado.setSelectOnFocus(true);
        com_empleado.setWidth(110);
        com_empleado.setLinked(true);
        com_empleado.setHideTrigger(true);


       }

    private void initValues() {
        tex_efecsus.setValue("0.00");
        tex_efecbs.setValue("0.00");
       tex_efecmonedas.setValue("0.00");
       tex_depbs.setValue("0.00");
        }
      private void initValues1() {
tex_nombreC.focus();

 }

    private void addListeners() {
       but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, final EventObject e) {
                dat_fecha.setValue(fechahoy);
 String fechadiahoy = dat_fecha.getValueAsString();
 String fechapadre = padre.dat_fecha.getValueAsString();

String fechapa = DateUtil.format(padre.dat_fecha.getValue(), "d-m-Y");

  if (fechadiahoy == fechapadre) {
                   MessageBox.confirm("Guardar", "La fecha de cobro es correcta: " + fechapa + " ?", new MessageBox.ConfirmCallback() {
                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
  validaracuenta(e);
                           }//fin boton
                        }
                    });
                }else{
       validaracuenta(e);
                  
                }
            }
        });
       // but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

        but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
            close();
            destroy();
            }
        });
         but_i.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
          showListProducto();
            }
        });
             


 
 }
    private void showListProducto() {
//                String vendedor = tex_codigoC.getValueAsString();
//
//                kardex = new FormularioProductoKardex(MostrarCobros.this,vendedor,idempresa,comision,valortotal);
//                kardex.showFormulario();
                //addListenerKardex();
            }
//               private void addListenerKardex() {
//                kardex.getListaProducto().getGrid().addGridRowListener(new GridRowListenerAdapter() {
//                      String vendedor = com_vendedor.getValueAsString();
//                    @Override
//                    public void onRowDblClick(GridPanel grid, int rowIndex, EventObject e) {
//
//                        ProductoProforma productoSeleccionado = kardex.getProductoSeleccionado2();
////                        Record registroCompra = lista.getRecordDef().createRecord(new Object[]{
////                                    productoSeleccionado.getIdProducto(),productoSeleccionado.getCodigo(), productoSeleccionado.getDetalle(), productoSeleccionado.getTalla(), 1,
////                                    productoSeleccionado.getPrecio2(),vendedor});
////                        lista.getGrid().stopEditing();
////                        lista.getGrid().getStore().insert(0, registroCompra);
////                        lista.getGrid().startEditing(0, 0);
//
//
//                    }
//                });
//
//
//            }
////     private void showListProducto() {
//                 String vendedor = com_vendedor.getValueAsString();
//                kardex = new FormularioProductoKardex(PanelVentaPlaza.this,vendedor);
//                kardex.showFormulario();
//                addListenerKardex();
//            }

public void validaracuenta(final EventObject e){
    // String idempresa = com_marca.getValue();
   // String planilla = tex_monto.getValueAsString().trim();
    // String fechapadre = padre.dat_fecha.getValueAsString();
String fechapadre = DateUtil.format(padre.dat_fecha.getValue(), "Y-m-d");
String montodia= padre.tex_montototal.getValueAsString();
             String enlace = "php/Cobros.php?funcion=validaracuentafecha&idempresa=" + idempresa+"&fecha="+fechapadre+"&montodia="+montodia;
//             String enlace = "php/Cobros.php?funcion=validaracuentafecha&idempresa=" + idempresa+"&fecha="+fechapadre;

             //  String enlace = "php/Cobros.php?funcion=validaracuenta&idempresa=" + idempresa+"&planilla="+planilla;

            Utils.setErrorPrincipal("Buscando datos", "cargar");
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
                           //     Object[][] almacenM1109 = Utils.getArrayOfJSONObject(jsonObject, "tiendaM", new String[]{"idtienda", "nombre"});
                            //  acuenta = Utils.getBigDecimalOfJSONObject(jsonObject, "acuenta");
       acuenta = Utils.getStringOfJSONObject(jsonObject, "acuenta");

                              //  MessageBox.alert(mensajeR);
verdescuentoacuenta(acuenta);
       
                            } else {
                                 //com.google.gwt.user.client.Window.alert(mensajeR);
                            String comision = tex_codigoC.getValueAsString();
                                padre.createCompraSin(e,comision);
                            
                        clear();
                       close();
                      destroy();
                            }
                        } else {
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

  public void verdescuentoacuenta(final String acuenta){
    // String idempresa = com_marca.getValue();
   // String planilla = tex_monto.getValueAsString().trim();
    // String fechapadre = padre.dat_fecha.getValueAsString();
      // montobsacuenta = new Float(tex_codigoBarra.getText());
       String montototalcobro = tex_codigoBarra.getValueAsString();
       String montodia= padre.tex_montototal.getValueAsString();
             String enlace = "php/Cobros.php?funcion=validarmontosiguales&montocobro=" + montototalcobro+"&acuenta="+acuenta;
//String enlace = "php/Cobros.php?funcion=validaracuentafecha&idempresa=" + idempresa+"&fecha="+fechapadre;

             Utils.setErrorPrincipal("Buscando datos", "cargar");
            final Conector conecaPB = new Conector(enlace, false);
            try {
                conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {
 private EventObject e;
                    public void onResponseReceived(Request request, Response response) {
                        String data = response.getText();
                        JSONValue jsonValue = JSONParser.parse(data);
                        JSONObject jsonObject;
                        if ((jsonObject = jsonValue.isObject()) != null) {

                            String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                            String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                            if (errorR.equalsIgnoreCase("true")) {
                           //     Object[][] almacenM1109 = Utils.getArrayOfJSONObject(jsonObject, "tiendaM", new String[]{"idtienda", "nombre"});
       //                       acuenta = Utils.getBigDecimalOfJSONObject(jsonObject, "acuenta");
       resultado = Utils.getStringOfJSONObject(jsonObject, "acuenta");

       com.google.gwt.user.client.Window.alert(mensajeR);
       // String valort =tex_codigoBarra.getValueAsString();


                   MessageBox.confirm("Guardar", "Desea descontar del acuenta?Si lo descuenta no se incluira el monto de comision que haya asignado,Existe un acuenta de: " + acuenta + " ?", new MessageBox.ConfirmCallback() {
                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                        padre.createCompradescontaracuenta(e);

                        clear();
                close();
            destroy();
                            }else{
                                String comision = tex_codigoC.getValueAsString();

                             padre.createCompraSin(e,comision);
                        clear();
                       close();
                      destroy();

                            }//fin boton
                        }
                    });


                            } else {
            //MessageBox.confirm("Guardar", "Desea descontar del acuenta?Si lo descuenta no se incluira el monto de comision que haya asignado,Existe un acuenta de: " + acuenta + " ?", new MessageBox.ConfirmCallback() {
//com.google.gwt.user.client.Window.alert("existe acuento. pero por ser monto diferente se registrara como cobro ");
                                 com.google.gwt.user.client.Window.alert(mensajeR);
                             String comision = tex_codigoC.getValueAsString();

                                 padre.createCompraSin(e,comision);
                            
                        clear();
                       close();
                      destroy();
                            }
                        } else {
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

           private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
}

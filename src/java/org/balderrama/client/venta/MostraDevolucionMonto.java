/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.venta;

import com.gwtext.client.widgets.form.DateField;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import com.google.gwt.user.client.ui.RadioButton;
import com.gwtext.client.widgets.TabPanel;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.data.ArrayReader;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.data.JsonReader;
import com.gwtext.client.data.RecordDef;
import com.gwtext.client.data.Store;
import com.gwtext.client.widgets.PagingToolbar;

import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtextux.client.data.PagingMemoryProxy;
import java.util.Date;

import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
//import org.balderrama.client.sistemadetalle.MarcaDetalle;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
//import org.balderrama.client.util.Validacion;
/**
 *
 * @author
 */
class MostraDevolucionMonto extends Window {

    private final int ANCHO = 750;
    private final int ALTO = 400;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("98%");
private TextField tex_boletamanual;
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanelCliente;
    private TextField tex_fecha;
 private Object[][] productoM;
     private String montosusredondo;
  //  public TextField tex_codigoBarra;
    private FormPanel for_panel;
    private EditorGridPanel grid;
    private Store store;
    private ColumnModel columnModel;
    private BaseColumnConfig[] columns;
    private CheckboxSelectionModel cbSelectionModel;
    private PagingMemoryProxy proxy;
    private ArrayReader reader;
 //    public ComboBox com_vendedor;
 //     public ComboBox com_cliente;
     // public ComboBox com_tipo;
    private ToolbarButton eliminarEntrega;
    private Button aceptar;
    private Button cancelar;
    private Button verproducto;
    protected ExtElement ext_element;
    public TabPanel tap_panel;
  //  public TextField tex_codigoC;
   // public TextField tex_nombreC;
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
 private Button but_aceptar;
     private Button but_aceptar2;
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
//private ComboBox com_vendedor;
 private ListaDevolucion padre;
  //private PanelInventario padre2;
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
  //  public DateField dat_fecha1;
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
String iddevo;
String idventas;
String montodevo;

 public RadioButton facturaSi;
    private RadioButton facturaNo;
   //   private Object[][] clienteM;
    //    private Object[][] vendedorM;
//private Number acuenta;
// private String[] tipoenvioM;
public MostraDevolucionMonto(String monto,String iddevolucion,String idven,ListaDevolucion panel)
{
  this.montodevo = monto;
  this.iddevo = iddevolucion;
  this.idventas = idven;
  this.padre = panel;
 
        String tituloTabla ="Confirmar Devolucion";
        String nombreBoton1 = "Confirmar Monto y Registro en cobros";
        String nombreBoton2 = "Cancelar";
        setId("win-NuevaEmpresaForm1-12523");
        setTitle(tituloTabla);
        setWidth(400);
        setMinWidth(ANCHO);
        setHeight(200);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        setPlain(true);

        but_aceptar = new Button(nombreBoton1);
        but_cancelar = new Button(nombreBoton2);
     //   addButton(but_aceptarv);
        addButton(but_aceptar);
        addButton(but_cancelar);

        formPanelCliente = new FormPanel();
        formPanelCliente.setBaseCls("x-plain");
        formPanelCliente.setUrl("save-form.php");
        formPanelCliente.setWidth(ANCHO);
        formPanelCliente.setHeight(ALTO);
        formPanelCliente.setLabelAlign(Position.LEFT);
        formPanelCliente.setAutoWidth(true);
        fechahoy = new Date();

tex_boletamanual = new TextField("Monto Total devolucion", "boletamanual", 200);
           initValues1();
  formPanelCliente.add(tex_boletamanual);

         add(formPanelCliente);
anadirListenersTexfield();
        addListeners();

    }

private void anadirListenersTexfield() {
    tex_boletamanual.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                     String boletamanual = tex_boletamanual.getValueAsString();
                      GuardarNuevoColor(boletamanual);
                }
            }
        });
  
}


    private void addListeners() {
       but_aceptar.addListener(new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, final EventObject e) {
         String boletamanual = tex_boletamanual.getValueAsString();
           GuardarNuevoColor(boletamanual);
        
            }
        });
       but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
            close();
            destroy();
            }
        });
 }

      private void initValues1() {
tex_boletamanual.setValue(montodevo);
     

//tex_nombreC.focus();
 }
public void GuardarNuevoColor(String boleta) {
   String cadena = "php/VentaMayor.php?funcion=ConfirmarDevolucion&monto=" + boleta+ "&iddevolucion="+iddevo;
        cadena = cadena + "&" + formPanelCliente.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Guardando", "guardar");
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
                    padre.cargarDatosconfirmar(iddevo,idventas);
                     close();
                     destroy();
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


    private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
}

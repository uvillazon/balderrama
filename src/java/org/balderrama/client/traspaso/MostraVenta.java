/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.traspaso;

import org.balderrama.client.sistemadetalle.*;
import com.gwtext.client.widgets.form.DateField;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import com.google.gwt.user.client.ui.RadioButton;
import com.gwtext.client.widgets.TabPanel;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.ArrayReader;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.data.JsonReader;
import com.gwtext.client.data.RecordDef;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.data.Store;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.Window;

import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtextux.client.data.PagingMemoryProxy;
import java.util.Date;
//import org.balderrama.client.util.Validacion;
/**
 *
 * @author
 */
class MostraVenta extends Window {

    private final int ANCHO = 900;
    private final int ALTO = 900;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("98%");

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
     public ComboBox com_vendedor;
      public ComboBox com_cliente;
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
//    private TextField tex_efecbs;
//    private TextField tex_efecsus;
//    private TextField tex_efecmonedas;
//    private TextField tex_depbs;
//    private TextField tex_depsus;
//    private TextField tex_cajanueva;
//    private TextField tex_cpagadoregistro;
//    private TextField tex_turno;

  //  private DateField dat_fecha;
  //   private Date fecha;
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
 private ListaTraspaso padre;
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
    public DateField dat_fecha1;
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
String idtraspaso;
 public RadioButton facturaSi;
    private RadioButton facturaNo;
      private Object[][] clienteM;
        private Object[][] vendedorM;
//private Number acuenta;
// private String[] tipoenvioM;
public MostraVenta(String idtrasp, Object[][] clienteM1, Object[][] vendedorM1, String idmarc, String responsable,ListaTraspaso panel)
{
  this.padre = panel;
         this.clienteM = clienteM1;
           this.vendedorM = vendedorM1;
           this.idtraspaso= idtrasp;
           this.idmarca=idmarc;
//this.tipoenvioM = new String[]{"INGRESO", "TRASPASO"};
    String tituloTabla ="Detalle Venta";
     //  padre=panel;
       String nombreBoton1 = "Registrar";
        String nombreBoton2 = "Cancelar";
       // String nombreBoton3 = "Eliminar Empresa";

        setId("win-NuevaEmpresaForm1");
        setTitle(tituloTabla);
        setWidth(400);
        setMinWidth(ANCHO);
        setHeight(250);
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
        //formPanelCliente.setLabelWidth(130);
        formPanelCliente.setUrl("save-form.php");
        formPanelCliente.setWidth(ANCHO);
        formPanelCliente.setHeight(ALTO);
        formPanelCliente.setLabelAlign(Position.LEFT);

    formPanelCliente.setAutoWidth(true);


dat_fecha1 = new DateField("Fecha", "d-m-Y");
         fechahoy = new Date();
              dat_fecha1.setValue(fechahoy);
 dat_fecha1.setReadOnly(true);

com_vendedor = new ComboBox("Vendedor al que enviamos", "idempleado");
com_cliente = new ComboBox("Clientes", "idcliente");
//com_tipo = new ComboBox("Tipo Envio", "idtipo");
           initValues1();



 formPanelCliente.add(dat_fecha1);
// formPanelCliente.add(com_tipo);
//             formPanelCliente.add(tex_nombreC);
// formPanelCliente.add(tex_codigoBarra);
 // formPanelCliente.add(tex_codigoC);
formPanelCliente.add(com_vendedor);
 formPanelCliente.add(com_cliente);
         add(formPanelCliente);
anadirListenersTexfield();
        addListeners();

    }




private void anadirListenersTexfield() {

     com_vendedor.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
com_cliente.focus();

                }
            }
        });
 com_cliente.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
         String idvendedor = com_vendedor.getValueAsString();
          String idcliente = com_cliente.getValueAsString();
           String fecha =dat_fecha1.getValueAsString();
  if ((!idvendedor.isEmpty()) && (!idcliente.isEmpty())) {
              padre.registrarventa(idtraspaso,idmarca,idvendedor,idcliente,fecha);

            }else{
               MessageBox.alert("Por favor complete los campos vendedor y cliente, por seleccion");
            }
                }
            }
        });
}


    private void addListeners() {
       but_aceptar.addListener(new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, final EventObject e) {

              String idvendedor = com_vendedor.getValueAsString();
          String idcliente = com_cliente.getValueAsString();
           String fecha =dat_fecha1.getValueAsString();

            if ((!idvendedor.isEmpty()) && (!idcliente.isEmpty())) {
              padre.registrarventa(idtraspaso,idmarca,idvendedor,idcliente,fecha);

            }else{
               MessageBox.alert("Por favor complete los campos vendedor y cliente, por seleccion");
            }

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

      SimpleStore proveedorStore123 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        proveedorStore123.load();
        com_vendedor.setMinChars(1);
        com_vendedor.setStore(proveedorStore123);
        com_vendedor.setValueField("idempleado");
        com_vendedor.setDisplayField("codigo");
        com_vendedor.setForceSelection(true);
        com_vendedor.setMode(ComboBox.LOCAL);
        com_vendedor.setEmptyText("Buscar vendedor ");
        com_vendedor.setLoadingText("buscando...");
        com_vendedor.setTypeAhead(true);
        com_vendedor.setSelectOnFocus(true);
        com_vendedor.setWidth(200);
        com_vendedor.setHideTrigger(true);

  SimpleStore proveedorStore1234 = new SimpleStore(new String[]{"idcliente", "codigo"}, clienteM);
        proveedorStore1234.load();
        com_cliente.setMinChars(1);
        com_cliente.setStore(proveedorStore1234);
        com_cliente.setValueField("idcliente");
        com_cliente.setDisplayField("codigo");
        com_cliente.setForceSelection(true);
        com_cliente.setMode(ComboBox.LOCAL);
        com_cliente.setEmptyText("Buscar cliente");
        com_cliente.setLoadingText("buscando...");
        com_cliente.setTypeAhead(true);
        com_cliente.setSelectOnFocus(true);
        com_cliente.setWidth(200);
        com_cliente.setHideTrigger(true);



//tex_nombreC.focus();
 }



           private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
}

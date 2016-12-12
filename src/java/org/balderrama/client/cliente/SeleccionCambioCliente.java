/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.cliente;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import java.util.Date;
import org.balderrama.client.util.Utils;

/**
 *
 * @author buggy
 */
public class SeleccionCambioCliente extends Window {

    private final int ANCHO = 500;
    private final int ALTO = 250;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private TextField tex_codigoC;
    public TextField tex_nombreC;
  //  private TextField tex_apellidoC;
    private TextField tex_telefonoC;
    private TextField tex_direccionC;
    private TextField tex_faxC;
 public ComboBox com_vendedor;
//    private Panel formpanel;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String idclienteC;
    private String nombreC;
    private String apellidoC;
    private String ciudadC;
    private String codigoC;
    private String tipoC;
    private String telefonoC;
    private String direccionC;
    private String faxC;
    private String estadoC;
    private Object[][] ciudadM;
   // private Object[][] tipoM;
    private String[] estadoM;
    private boolean nuevo;
 public DateField dat_fecha;
     private PanelCobroCuenta padre3;
String codigocliente;
//por cajas venta
String idventa;
String idcrecliente;
   Object[][] vendedorM;
    private String[] empresatM;
 //    private ComboBox com_empresatC;
//deade ingreso
  public SeleccionCambioCliente(String idcliente,Object[][] vendedores,String idventa, String idcrecliente, PanelCobroCuenta padred) {
         this.idclienteC = idcliente;
         this.vendedorM =vendedores;
         this.padre3 =padred;
        this.idventa = idventa;
        this.idcrecliente = idcrecliente;
      empresatM =  new String[]{"Efectivo", "Deposito", "Cheque", "Tarjeta", "Otros"};

       String nombreBoton1 = "Registrar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Cambiar Cuenta ";

        
        setId("win-Clientes-pago-cambio-h");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                      //  GuardarNuevoCliente3();
               //   MessageBox.alert("Se registro exitosamente");
                String idvend= com_vendedor.getValueAsString();
                String recibo = tex_nombreC.getValueAsString();
                      padre3.createCompraSin(idclienteC,idvend,recibo);
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionCambioCliente.this.close();
                SeleccionCambioCliente.this.setModal(false);
            }
        });
        setTitle(tituloTabla);
          setWidth(400);
        setMinWidth(ANCHO);
        setHeight(200);
//        setAutoWidth(true);
//        setAutoHeight(true);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        addButton(but_aceptarP);
        addButton(but_cancelarP);
        setCloseAction(Window.CLOSE);
        setPlain(true);
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        tex_codigoC = new TextField("Codigo", "codigo", 100);
        tex_codigoC.setMaxLength(6);
        tex_nombreC = new TextField("Recibo", "recibo", 200);
//        tex_apellidoC = new TextField("Monto Pago", "monto", 200);
        tex_telefonoC = new TextField("Observacion", "observacion", 200);
       
        tex_faxC = new TextField("Fax", "fax", 200);

        com_vendedor = new ComboBox("Vendedor", "idempleado");
dat_fecha = new DateField("Fecha", "d-m-Y");
        Date date = new Date();
        dat_fecha.setValue(Utils.getStringOfDate(date));

// com_empresatC = new ComboBox("Tipo", "tipoempresa",100);
        formPanel.add(dat_fecha);
         formPanel.add(tex_nombreC);
        formPanel.add(com_vendedor);
       
   //     formPanel.add(com_empresatC);
       
     //   formPanel.add(tex_apellidoC);
        
        add(formPanel);
       initCombos();
        initValues();
        addListeners();
    }

  private void addListeners() {

  tex_nombreC.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    com_vendedor.focus();
                     }
            }
        });
com_vendedor.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
               String idvend= com_vendedor.getValueAsString();
                String recibo = tex_nombreC.getValueAsString();
                
                      padre3.createCompraSin(idclienteC,idvend,recibo);
                }
            }
        });
//com_empresatC.addListener(new TextFieldListenerAdapter() {
//
//            @Override
//            public void onSpecialKey(Field field, EventObject e) {
//                if (e.getKey() == EventObject.ENTER) {
//                    tex_apellidoC.focus();
//                }
//            }
//        });
//        tex_apellidoC.addListener(new TextFieldListenerAdapter() {
//
//            @Override
//            public void onSpecialKey(Field field, EventObject e) {
//                if (e.getKey() == EventObject.ENTER) {
//                 GuardarNuevoCliente3();
//                }
//            }
//        });

      }
private void initCombos() {

//     SimpleStore comisionStore1 = new SimpleStore("tipopago", empresatM);
//        comisionStore1.load();
//        com_empresatC.setDisplayField("tipopago");
//        com_empresatC.setStore(comisionStore1);
//com_empresatC.setAllowBlank(false);
// com_empresatC.setWidth(100);
//com_empresatC.setValue("Efectivo");

 SimpleStore proveedorStore12 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        proveedorStore12.load();
        com_vendedor.setMinChars(1);
        com_vendedor.setStore(proveedorStore12);
        com_vendedor.setValueField("codigo");
        com_vendedor.setDisplayField("codigo");
        com_vendedor.setForceSelection(true);
        com_vendedor.setMode(ComboBox.LOCAL);
        com_vendedor.setEmptyText("Buscar vendedor");
        com_vendedor.setLoadingText("buscando...");
        com_vendedor.setTypeAhead(true);
        com_vendedor.setSelectOnFocus(true);
        com_vendedor.setWidth(200);
        com_vendedor.setHideTrigger(true);

    }


      

    private void initValues() {
     }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }




}
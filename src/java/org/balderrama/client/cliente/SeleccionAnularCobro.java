/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.cliente;
import com.gwtext.client.widgets.form.Field;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.util.DateUtil;
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
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;
import com.gwtext.client.widgets.MessageBox;

/**
 *
 * @author buggy
 */
public class SeleccionAnularCobro extends Window {

    private final int ANCHO = 500;
    private final int ALTO = 250;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private TextField tex_codigoC;
    private TextField tex_nombreC;
    private TextField tex_apellidoC;
    private TextField tex_vendedor;
    private TextField tex_monto;
    private TextField tex_faxC;
    //private TextField tex_vendedorR;
//    private Panel formpanel;
    private Button but_anularP;
    private Button but_cancelarP;
    private String idclienteC;
    private String idcuenta;
    //private Float salporpagar;
    //private String nombreC;
    //private String apellidoC;
    //private String ciudadC;
    //private String codigoC;
    //private String tipoC;
    //private String telefonoC;
    //private String direccionC;
    //private String faxC;
    //private String estadoC;
    //private Object[][] ciudadM;
   // private Object[][] tipoM;
    //private String[] estadoM;
    //private boolean nuevo;
    private DateField dat_fecha;
    private PanelCobroCuenta padre3;
    String codigocliente;
//por cajas venta
    String idventa;
    String idcrecliente;
    Object[][] vendedorM;
    //private String[] empresatM;
    //private String[] facturaM;
    private ComboBox com_empresatC;
    private ComboBox com_facturaC;
    String fechaINI;
    String fechaFIN;
//deade ingreso
    public SeleccionAnularCobro(String idcuent, String idcliente, Object[][] vendedores, String idventa, String idcrecliente, String fechaini, String fechafin, PanelCobroCuenta padred) {
        this.idclienteC = idcliente;
        this.idcuenta = idcuent;
        this.vendedorM =vendedores;
        this.padre3 =padred;
        this.idventa = idventa;
        this.idcrecliente = idcrecliente;
        this.fechaINI = fechaini;
        this.fechaFIN = fechafin;
//        empresatM =  new String[]{"Efectivo", "Deposito", "Cheque", "Tarjeta", "Otros"};
//        facturaM =  new String[]{"ConFactura", "SinFactura"};
        String nombreBoton1 = "Anular";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Anular Cobro/Rebaja";
        
        setId("win-Clientes-anula");
        but_anularP = new Button(nombreBoton1, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                //MessageBox.alert("monto " + tex_apellidoC.getValueAsString());
                if(tex_vendedor.getValueAsString()!=""){
                    //MessageBox.alert("vendedor " + tex_vendedor.getValueAsString());
                    AnularCobro();
                }
                else{
                    MessageBox.alert("No eligio el cobro para anular o no existe un cobro para esa fecha!!!");
                }
            }
        });

        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionAnularCobro.this.close();
                SeleccionAnularCobro.this.setModal(false);
            }
        });
        setTitle(tituloTabla);
        setWidth(400);
        setMinWidth(ANCHO);
        setHeight(400);
//        setAutoWidth(true);
//        setAutoHeight(true);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        addButton(but_anularP);
        addButton(but_cancelarP);
        setCloseAction(Window.CLOSE);
        setPlain(true);
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
  //      tex_codigoC = new TextField("Codigo", "codigo", 100);
  //      tex_codigoC.setMaxLength(6);
        tex_nombreC = new TextField("Recibo", "recibo", 200);
        tex_apellidoC = new TextField("Monto Pago", "montopago", 200);
        tex_monto = new TextField("Monto Rebaja", "montorebaja", 200);
        //tex_telefonoC = new TextField("Observacion", "observacion", 200);
        //tex_faxC = new TextField("Documento", "numero", 200);
        tex_vendedor = new TextField("Vendedor", "vendedor");
        dat_fecha = new DateField("Fecha", "d-m-Y");
        //Date date = new Date();
        //dat_fecha.setValue(Utils.getStringOfDate(date));
        dat_fecha.setValue(fechaINI);
        //com_empresatC = new ComboBox("Tipo", "tipoempresa",100);
        //com_facturaC = new ComboBox("Factura", "factura",100);
        formPanel.add(dat_fecha);
        formPanel.add(tex_nombreC);
        formPanel.add(tex_vendedor);
       
        //formPanel.add(com_empresatC);
       // formPanel.add(com_facturaC);
        //formPanel.add(tex_faxC);
        formPanel.add(tex_apellidoC);
        formPanel.add(tex_monto);
        
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
                    String fechacob = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
                    if((fechacob.compareTo(fechaINI)>=0)&&(fechacob.compareTo(fechaFIN)<=0)){
                        CargarCobro();
                    }else{
                        MessageBox.alert("No puede anular cobros pasados!!! " + fechacob);
                    }
                }
            }
        });
//        tex_vendedor.addListener(new TextFieldListenerAdapter() {

//            @Override
//            public void onSpecialKey(Field field, EventObject e) {
//                if (e.getKey() == EventObject.ENTER) {
//                    com_empresatC.focus();
//                }
//            }
//        });
//        com_empresatC.addListener(new TextFieldListenerAdapter() {

//            @Override
//            public void onSpecialKey(Field field, EventObject e) {
//                if (e.getKey() == EventObject.ENTER) {
//                    tex_apellidoC.focus();
//                }
//            }
//        });
//        tex_apellidoC.addListener(new TextFieldListenerAdapter() {

//            @Override
//            public void onSpecialKey(Field field, EventObject e) {
//                if (e.getKey() == EventObject.ENTER) {
//                    if(tex_apellidoC.getValueAsString()!=null){
//                        AnularCobro();
//                    }
//                    else{
//                        MessageBox.alert("No eligio el cobro para anular o no existe un cobro para esa fecha!!!");
//                    }
//                }
//            }
//        });
    }

    private void initCombos() {
//        SimpleStore comisionStore12 = new SimpleStore("factura", facturaM);
//        comisionStore12.load();
//        com_facturaC.setDisplayField("factura");
//        com_facturaC.setStore(comisionStore12);
//        com_facturaC.setAllowBlank(false);
//        com_facturaC.setWidth(100);
//        com_facturaC.setValue("SinFactura");
//        SimpleStore comisionStore1 = new SimpleStore("tipopago", empresatM);
//        comisionStore1.load();
//        com_empresatC.setDisplayField("tipopago");
//        com_empresatC.setStore(comisionStore1);
//        com_empresatC.setAllowBlank(false);
//        com_empresatC.setWidth(100);
//        com_empresatC.setValue("Efectivo");

//        SimpleStore proveedorStore12 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
//        proveedorStore12.load();
//        com_vendedor.setMinChars(1);
//        com_vendedor.setStore(proveedorStore12);
//        com_vendedor.setValueField("codigo");
//        com_vendedor.setDisplayField("codigo");
//        com_vendedor.setForceSelection(true);
//        com_vendedor.setMode(ComboBox.LOCAL);
//        com_vendedor.setEmptyText("Buscar vendedor");
//        com_vendedor.setLoadingText("buscando...");
//        com_vendedor.setTypeAhead(true);
//        com_vendedor.setSelectOnFocus(true);
//        com_vendedor.setWidth(200);
//        com_vendedor.setHideTrigger(true);

    }

    private void initValues() {
      
    }

    public Button getBut_anular() {
        return but_anularP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

    public void CargarCobro() {
        String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
        String reciboent = tex_nombreC.getValueAsString();
        //String fechadato = DateUtil.format(dat_fecha.getValue(), "mY");
        //MessageBox.alert("Fecha Cobro " + fechadato);
        String enlace = "php/CobroMayor.php?funcion=CargarPagoCliente&idcreditocliente=" + idcrecliente + "&fecha=" + fechaent + "&recibo=" + reciboent;
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
                                String vend = Utils.getStringOfJSONObject(marcaO, "vendedor");
                                String montop = Utils.getStringOfJSONObject(marcaO, "montopago");
                                String montor = Utils.getStringOfJSONObject(marcaO, "montorebaja");
                                tex_vendedor.setValue(vend);
                                tex_apellidoC.setValue(montop);
                                tex_monto.setValue(montor);
                            }
                        }else {
                            MessageBox.alert("No existen cobros para anular");
                        }                        
                    } else {
                        MessageBox.alert("No existen cobros para anular");
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

    public void AnularCobro() {
        String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
        String reciboent = tex_nombreC.getValueAsString();
        String cadena = "php/Cobros.php?funcion=AnularPagoCliente&idcliente=" + idclienteC + "&idcredito=" + idcuenta + "&idcreditocliente=" + idcrecliente + "&fecha=" + fechaent + "&recibo=" + reciboent;
        cadena = cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Guardando el Pago", "guardar");
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
                            codigocliente = Utils.getStringOfJSONObject(jsonObject, "resultado");
                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                            close();
                            padre3.reload();
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
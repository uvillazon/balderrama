/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.venta;


import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.data.Record;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FieldSet;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.data.Store;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.NumberField;
import java.util.Date;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;

/**
 *
 * @author example
 */
public class FormularioEntrega extends Window {

    private final int ANCHO = 400;
    private final int ALTO = 520;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");

    private final int WINDOW_PADDING = 5;
    private FormPanel formPanelCredito;
  //  private Button but_aceptar;
    private Button but_aceptarS;
    private DateField dat_fecha;
       private DateField dat_fechasalida;
          private DateField dat_fechallegada;
             private DateField dat_fechapago;
                  private DateField dat_fechapago2;
    private Button but_cancelar;
    public String nombre;
    public String opcion;
    public String nit;
    public String apellido;
       public String idempresa;
    public String nombreempresa;
//    public ComboBox com_empresa;

 private TextField tex_montocancelado3;
  private TextField tex_recibo2;
 private TextField tex_montocancelado2;
  private TextField tex_recibo;
   private TextField tex_flota;
    private TextField tex_guia;
     private TextField tex_responsable;

 private boolean respuesta;
  private Store proveedorStore1;

     public ComboBox com_empleado;
        private Float devuelto;
        private Float deudanueva;
 private Float tipocambio;

    private String montobs;
    public TextField tex_numBoleta;
     public TextField tex_empresa;
    public TextField tex_montoPapeleta;
    public TextField tex_montoDeuda;
   public TextField tex_montocancelado;
   public TextField tex_montocanceladosus;
    public TextField tex_devuelto;
       public TextField tex_devuelto2;
    private Float totalTotalV1073;
    private Float descPorV1073;
     private Float deuda;
        private String montosusredondo;

    public ListaVenta padre;
  //  public Object[][] empresasM;
    public Object[][] clienteM;
    private String total;
      private Float montocanceladosus;
String idventa;
String cajas;
String pares;
String sus;
String descuento;
String montopagar;
String fechacancelacion;
String fecha;
  FormularioEntrega(String idventa, String tcajas, String tpares, String tsus, String descuento, String montoapagar,String fech, String fechacancelacion, ListaVenta panel) {
      // Window.alert("hola entrada");
        String nombreBoton2 = "Cancelar";
        String nombreBoton3 = "Registrar Entrega";
        padre=panel;
       this.idventa = idventa;
         this.fecha = fech;
       this.cajas = tcajas;
          this.pares = tpares;
             this.sus = tsus;
                this.descuento = descuento;
                   this.montopagar = montoapagar;
                      this.fechacancelacion = fechacancelacion;

//        setId("win-Almacen");
        setTitle(nombre);

  but_aceptarS = new Button(nombreBoton3, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
               registropago();
            }
        });

        
        but_cancelar = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                FormularioEntrega.this.close();
                FormularioEntrega.this.setModal(false);
               
            }
        });
        addButton(but_aceptarS);

       // addButton(but_aceptar);
        addButton(but_cancelar);

        formPanelCredito = new FormPanel();

        formPanelCredito.setBaseCls("x-plain");
//        formPanelCredito.setLabelWidth(ANCHO - 400);
        formPanelCredito.setUrl("save-form.php");
        formPanelCredito.setWidth(ANCHO);
        formPanelCredito.setHeight(ALTO);

       initCombos(formPanelCredito);


        add(formPanelCredito);



    }

    public void registropago(){
  String cadena = "php/VentaMayor.php?funcion=Guardarentrega&venta=" + idventa;
    // String enlace = "php/VentaDetalle.php?funcion=CargarModificarVendedor&venta=" + idestilo;

  cadena =
                cadena + "&" + formPanelCredito.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Guardando ", "guardar");
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
                            close();

                            padre.reload();
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
    
 
private void initCombos( FormPanel formPanelCredito) {

tex_numBoleta = new TextField("fecha", "fecha");
tex_numBoleta.setValue(fecha);
tex_numBoleta.setDisabled(true);
 tex_montocancelado = new TextField("Total Venta SUS", "montocancelado");
 tex_montocancelado.setWidth(100);
 tex_montocancelado.setHeight(30);
 tex_montocancelado.setReadOnly(true);
 tex_montocancelado.setValue(montopagar);
tex_montoPapeleta = new TextField("Total Cajas", "tcajas");
tex_montoPapeleta.setValue(cajas);
tex_montoDeuda = new TextField("Total pares", "tpares");
tex_montoDeuda.setReadOnly(true);
tex_montoDeuda.setValue(pares);
tex_devuelto = new TextField("Descuento ", "descuento");
        tex_devuelto.setWidth(100);
        tex_devuelto.setValue(descuento);
      
//tex_empresa = new TextField("Empresa ", "empresa");
 dat_fechapago = new DateField("Fecha Pago Maxima", "d-m-Y");
  dat_fechapago2 = new DateField("Fecha Pago Maxima", "d-m-Y");
      //  Date date = new Date();
    //    dat_fechapago.setValue(Utils.getStringOfDate(date));
formPanelCredito.add(tex_numBoleta);
formPanelCredito.add(tex_montocancelado);
formPanelCredito.add(tex_montoPapeleta);
formPanelCredito.add(tex_montoDeuda);
formPanelCredito.add(tex_devuelto);
formPanelCredito.add(dat_fechapago);
 tex_montocancelado2= new TextField("Monto Venta Final", "montocancelado");
 tex_montocancelado2.setValue(montopagar);
tex_recibo= new TextField("Recibo", "recibo");
 tex_flota= new TextField("Flota", "flota");
 tex_flota.setValue("-");
 tex_guia= new TextField("Numero Guia", "guia");
  tex_guia.setValue("-");
 tex_responsable= new TextField("Responsable", "responsable");
 tex_responsable.setValue("-");
 dat_fechasalida = new DateField("Fecha Envio Cajas", "d-m-Y");
  Date date1 = new Date();
         dat_fechasalida.setValue(Utils.getStringOfDate(date1));
 dat_fechallegada = new DateField("Fecha legada cajas", "d-m-Y");
  Date date2 = new Date();
         dat_fechallegada.setValue(Utils.getStringOfDate(date2));
          tex_montocancelado3= new TextField("Monto Venta Final", "montocancelado");
 tex_montocancelado3.setValue(montopagar);
 tex_recibo2= new TextField("Recibo pago efectivo", "reciboefectivo");
// tex_devuelto2 = new TextField("Descuento ", "descuento");
  tex_recibo2.setValue("0");
//        tex_devuelto2.setWidth(100);
//        tex_devuelto2.setValue(descuento);
 FieldSet userFS12 = new FieldSet();
         userFS12.setCheckboxToggle(true);
         userFS12.setFrame(true);
         userFS12.setTitle("Entrega Simple/credito");
         userFS12.setCollapsed(true);
          userFS12.add(tex_montocancelado2);
   formPanelCredito.add(userFS12);

   FieldSet userFS = new FieldSet();
         userFS.setCheckboxToggle(true);
         userFS.setFrame(true);
         userFS.setTitle("Directa/ Efectivo");
         userFS.setCollapsed(true);
         userFS.add(tex_montocancelado3);
        // userFS.add(tex_devuelto2);
         userFS.add(tex_recibo2);
         userFS.add(dat_fechapago2);
         formPanelCredito.add(userFS);

 FieldSet userFS1 = new FieldSet();
         userFS1.setCheckboxToggle(true);
         userFS1.setFrame(true);
         userFS1.setTitle("ENVIO CAJAS");
         userFS1.setCollapsed(true);
          userFS1.add(tex_flota);
          userFS1.add(tex_guia);
          userFS1.add(tex_responsable);
          userFS1.add(tex_recibo);
          userFS1.add(dat_fechasalida);
          userFS1.add(dat_fechallegada);
          formPanelCredito.add(userFS1);



 
     //  initvalues();
addListenerskey();
    }

   private void initvalues() {


    }
   private void addListenerskey() {

    tex_numBoleta.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                validarboleta();

                   com_empleado.focus();

                }
                 if (e.getKey() == EventObject.END) {
                  tex_montoPapeleta.focus();

                }
            }

        });





tex_montoPapeleta.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    recalcular1(false);
                    tex_devuelto.focus();
                }

            }
        });


         tex_devuelto.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                        String boleta = tex_numBoleta.getText();
             if((boleta.equalsIgnoreCase("0"))||(boleta.equalsIgnoreCase("")))
             {
             MessageBox.alert("El numero de boleta es obligatorio");
             }else{
                            String boleta1 = tex_montocancelado.getValueAsString().trim();
                            


             }
                }
            }
        });


}
   


       private void validarboleta() {
             String boleta =tex_numBoleta.getValueAsString().trim();
     String enlace = "php/VentaDetalle.php?funcion=BuscarDatosBoleta&boleta="+boleta;
           //  Utils.setErrorPrincipal("Buscando Datos", "cargar");
                final Conector conec = new Conector(enlace, false);
               try {
                    conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
                        private String codigoCliente;
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

                                        codigoCliente = Utils.getStringOfJSONObject(clienteObject, "boleta");
                            com_empleado.focus();
                                      //  respuesta = true;
                                    }
                                } else {

                    MessageBox.alert("El numero de boleta ya fue registrado , la boleta se anadira a la venta");
                    tex_numBoleta.focus();
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
                    resetCamposCliente();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }

               // return respuesta;
            }

   
//    }
 

     private void recalcular1(boolean desc) {

        totalTotalV1073 = new Float(tex_montocancelado.getText());
        descPorV1073 = new Float(tex_montoPapeleta.getText());
        deuda = new Float(tex_montoDeuda.getText());

            if(descPorV1073 == 0){
          //  devuelto =  montocancelado  -totalTotalV1073 ;
            deudanueva = deuda+totalTotalV1073+ descPorV1073;
           //   tex_montoDeuda.setValue(deudanueva.toString());
            tex_devuelto.setValue(deudanueva.toString());

            }else{
             devuelto = new Float(tex_montoPapeleta.getText());
            deudanueva = deuda+totalTotalV1073 - descPorV1073;
           //   tex_montoDeuda.setValue(deudanueva.toString());
            tex_devuelto.setValue(deudanueva.toString());
            //  tex_devueltosus.setValue("0");
            }

    }

    @SuppressWarnings("empty-statement")

 public Button getBut_aceptarS() {
        return but_aceptarS;
    }

    public Button getBut_cancelar() {
        return but_cancelar;
    }
  private boolean findByCodigoCliente() {
         respuesta = false;
                final String idcliente = com_empleado.getValue();
          //      final String idmarca = com_almacen.getValue();

//String enlace = "php/VentaMayor.php?funcion=BuscarDatosClienteSaldo&idcliente="+idcliente;
String enlace = "php/VentaDetalle.php?funcion=BuscarDatosClienteSaldo&idcliente="+idcliente;

//       String enlace = "php/cliente.php?funcion=buscarclienteporid&nit=" + codigoBuscado;
               // Utils.setErrorPrincipal("Buscando Datos", "cargar");
                final Conector conec = new Conector(enlace, false);

                try {
                    conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        private String codigoCliente;
                        private String nombre;
                        private String nit;
                        private String idcliente;
                        private String saldo;

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

                                        codigoCliente = Utils.getStringOfJSONObject(clienteObject, "codigo");
                                        nombre = Utils.getStringOfJSONObject(clienteObject, "nombre");
                                        //nit = Utils.getStringOfJSONObject(clienteObject, "nit");
                                        saldo = Utils.getStringOfJSONObject(clienteObject, "saldo");
                                        idcliente = Utils.getStringOfJSONObject(clienteObject, "idcliente");
                                        idempresa = Utils.getStringOfJSONObject(clienteObject, "idempresa");
                                        nombreempresa = Utils.getStringOfJSONObject(clienteObject, "nombreempresa");
                                            recalcular1(false);
                                          tex_montoPapeleta.focus();
                                       //  padre.tex_saldoactual.setValue(clienteSeleccionado.getSaldo());
                                      //  tex_producto.focus();
                                       //  itemsText1.focus();
                                        respuesta = true;
                                    } else {
                                       // resetCamposCliente();

                                        Utils.setErrorPrincipal("El Cliente esta observado no se le puede dar credito", "error");
                                   tex_numBoleta.setValue("");
                                   tex_numBoleta.setDisabled(true);

                                    }

                                } else {
                                    resetCamposCliente();

                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            resetCamposCliente();

                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");

                        }
                    });

                } catch (RequestException ex) {
                    ex.getMessage();
                    resetCamposCliente();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }

                return respuesta;
            }
  public void resetCamposCliente() {

       // tex_idCliente.reset();
        tex_montoDeuda.reset();
        //tex_idCliente.focus();

    }

  public void resetCamposCliente2() {
   tex_montoDeuda.reset();
    }
    private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
}

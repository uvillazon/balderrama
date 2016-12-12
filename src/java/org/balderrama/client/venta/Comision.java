/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.venta;

import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.Store;
import com.gwtext.client.widgets.form.MultiFieldPanel;
import com.gwtext.client.widgets.form.NumberField;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
import com.google.gwt.user.client.ui.DecoratorPanel;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.google.gwt.user.client.ui.Label;
import com.gwtext.client.core.EventObject;

/**
 *
 * @author example
 */
public class Comision extends Window {

    private final int ANCHO = 400;
    private final int ALTO = 310;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private Button but_aceptar;
   // private Button but_aceptarS;
    private Button but_cancelar;
    public String nombre;
    public String opcion;
    public String nit;
    public String apellido;
       public String idempresa;
    public String nombreempresa;
//    public ComboBox com_empresa;
 private TextField passwordMulti;
 private boolean respuesta;
  private Store proveedorStore1;
  //ClienteSaldo clienteSeleccionado;

     //public ComboBox com_empleado;
   public TextField tex_cliente;
        private Float devuelto;
        private Float deudanueva;
 private Float tipocambio;

    private String montobs;
    public TextField tex_numBoleta;
      public NumberField tex_montoTotal;
    public NumberField tex_montoTotalsus;
   public NumberField tex_devueltosus;
     private TextField tex_cambio;
    public TextField tex_nit;
    public TextField tex_pares;
      public TextField tex_numerofactura;
  //  public ComboBox com_empleado;
   // public TextField tex_nombre;
    //public TextField tex_apellido;
   // public TextField tex_numero;
    public TextField tex_numero_montocancelado;
    public TextField tex_montocancelado2;
     private Float montocanceladosus;
     private Float montocanceladosusenbs;
  private Float nuevomontodeuda;
     private Float diferencia;
    private Float nuevobs;
   //  public TextField tex_empresa;
    public TextField tex_montoPapeleta;
    public TextField tex_montoDeuda;
   public TextField tex_montocancelado;
     public NumberField tex_montocanceladosus;

       public NumberField tex_devuelto;
    private Float totalTotalV1073;
    private Float descPorV1073;
     private Float deuda;
        private String montosusredondo;

    public VentaFeria padre;
  //  public Object[][] empresasM;
    public Object[][] clienteM;
    private String sus;
     private String par;
public Comision(Object [][] clientes,String par1,String sus1, VentaFeria panel) {

   // public Comision(String par1,String sus1, VentaFeria panel) {
        String nombreBoton1 = "FACTURAR";
        String nombreBoton2 = "Cancelar";
      // String nombreBoton3 = "Registrar la Venta";
         String tituloTabla = "Venta";
        this.sus = sus1;
        this.par = par1;
        padre=panel;
        this.clienteM = clientes;
        setTitle(nombre);
        setId("win-productos-FAC");
        but_aceptar = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
             GuardarVenta();
            }
        });
        but_cancelar = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Comision.this.close();
                Comision.this.setModal(false);
            //formulario = null;
            }
        });

        setTitle(tituloTabla);
        setAutoHeight(true);
        setAutoWidth(true);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        addButton(but_aceptar);
        addButton(but_cancelar);

        setCloseAction(Window.CLOSE);
        setPlain(true);
        DecoratorPanel decPanel = new DecoratorPanel();
        decPanel.setTitle("Registro ");
  formPanel = new FormPanel();

        formPanel.setBaseCls("x-plain");
//        formPanelCredito.setLabelWidth(ANCHO - 400);
        formPanel.setUrl("save-form.php");
        formPanel.setWidth(ANCHO);
        formPanel.setHeight(ALTO);
formPanel.setLabelAlign(Position.TOP);
 //com_empleado = new ComboBox("Cliente", "nombrecliente");
 tex_nit = new TextField("Nit", "nit");
 tex_cliente = new TextField("NOMBRE /Razon social", "nombrecliente");
//        com_empleado.setValueField("idcliente");
//        com_empleado.setDisplayField("nombrecliente");

         tex_pares = new TextField("PARES", "pares");
        tex_pares.setWidth(70);
         tex_pares.setValue(par);
       

 Label prueba = new Label("T0TAL VENTA");
        prueba.setTitle("Total");
        prueba.setText(sus);
 tex_montocancelado = new TextField("Venta BS", "montocancelado",75);
 tex_montocancelado.setWidth(50);
 tex_montocancelado.setReadOnly(true);
// total = padre.tex_montocancelado.getValueAsString().trim();
 tex_montocancelado.setValue(sus);
tex_montocancelado2 = new TextField("TOTAL VENTA", "montocancelado",75);
 tex_montocancelado2.setWidth(80);
 tex_montocancelado2.setHeight(30);
 tex_montocancelado2.setReadOnly(true);
  tex_montocancelado2.setCls("grandeextra");
// total = padre.tex_montocancelado.getValueAsString().trim();
 tex_montocancelado2.setValue(sus);
    //      montocancelado = new Float(tex_montocancelado.getText());
          // tex_montocanceladosus = NumberField("SUS", "montocanceladosus");
 tex_montocanceladosus = new NumberField("Equivalente en SUS", "montocanceladosus",75);
 tex_montocanceladosus.setWidth(50);
 tex_montocanceladosus.setReadOnly(true);
tex_montocanceladosus.setDecimalPrecision(2);
findByCodigoCliente2();

 tex_montoTotal = new NumberField("monto a Pagar BS", "cancelarbs",75);
        tex_montoTotal.setWidth(50);
        tex_montoTotal.setDecimalPrecision(2);
         tex_montoTotalsus = new NumberField("monto a Pagar SUS", "cancelarsus",75);
        tex_montoTotalsus.setWidth(50);
        tex_montoTotalsus.setValue("0.00");

         tex_montoTotal.setValue("0.00");
    tex_montoTotal.setReadOnly(false);
     tex_montoTotalsus.setReadOnly(false);



    tex_numerofactura = new NumberField("Numero Factura", "numfactura",50);
        tex_numerofactura.setWidth(50);
        tex_numerofactura.setDisabled(true);



       // tex_montoTotalsus.setValue(cambio.toString());

        tex_montoTotalsus.setDecimalPrecision(2);

tex_devuelto = new NumberField("Cambio BS", "cambio",75);
        tex_devuelto.setWidth(50);
        tex_devuelto.setDecimalPrecision(2);
           tex_devuelto.setReadOnly(true);

           tex_devueltosus = new NumberField("Cambio Sus", "cambiosus",75);
        tex_devueltosus.setWidth(50);

formPanel.add(tex_nit);
        formPanel.add(tex_cliente);
//formPanel.add(tex_pares);
      


  //      formPanel.add(tex_montocancelado2);


        MultiFieldPanel namePanela = new MultiFieldPanel();
      namePanela.addToRow(tex_pares, 100);
           namePanela.addToRow(tex_montocancelado2, 140);
          formPanel.add(namePanela);

 MultiFieldPanel namePanel = new MultiFieldPanel();
      namePanel.addToRow(tex_montocancelado, 140);
           namePanel.addToRow(tex_montocanceladosus, 140);
          formPanel.add(namePanel);
MultiFieldPanel namePanel1 = new MultiFieldPanel();
      namePanel1.addToRow(tex_montoTotal, 140);
           namePanel1.addToRow(tex_montoTotalsus, 140);
       //   formPanel.add(namePanel1);

         MultiFieldPanel namePanel2 = new MultiFieldPanel();
      namePanel2.addToRow(tex_devuelto, 140);
       //   formPanel.add(namePanel2);


     //   formPanel.add(hid_idmarca);

        decPanel.add(formPanel);
//        add(formPanel);
        add(decPanel);
//initvalues();
    }

 public void GuardarVenta(){
     String nit = tex_nit.getText();
     String cliente = tex_cliente.getText();

   padre.guardarventafin(nit,cliente);
   Comision.this.close();
                Comision.this.setModal(false);
 }

    


 private boolean findByCodigoCliente2() {
         respuesta = false;
   montobs = tex_montocancelado.getValueAsString().trim();
  String enlace = "php/VentaMayor.php?funcion=BuscarRedondeosus&montobs=" + montobs+"&tipocambio="+tipocambio;

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
                                if (errorR.equalsIgnoreCase("true")) {
                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
                                    JSONValue clienteValue = jsonObject.get("resultado");
                                    JSONObject clienteObject;
                                    if ((clienteObject = clienteValue.isObject()) != null) {
                       montosusredondo = Utils.getStringOfJSONObject(clienteObject, "montosus");
                         tex_montocanceladosus.setValue(montosusredondo);
//                                       tex_montoTotalsus.focus();
                                        respuesta = true;
                                    } else {
                                        resetCamposCliente2();

                                        Utils.setErrorPrincipal("El Vendedor esta inactivo", "error");
                                   tex_montoTotalsus.setValue("0.00");
                                //   tex_vendedor.setDisabled(true);

                                    }

                                } else {
                                    resetCamposCliente2();

                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            resetCamposCliente2();

                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");

                        }
                    });

                } catch (RequestException ex) {
                    ex.getMessage();
                    resetCamposCliente2();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }

                return respuesta;
            }
   private void initvalues() {

//com_empresa = new ComboBox("Empresa", "empresa");
//        final SimpleStore proveedorStore = new SimpleStore(new String[]{"idcliente", "nombrecliente"}, clienteM);
//        proveedorStore.load();
//        com_empleado.setMinChars(1);
//        com_empleado.setStore(proveedorStore);
//        com_empleado.setValueField("nombrecliente");
//        com_empleado.setDisplayField("nombrecliente");
//        com_empleado.setForceSelection(true);
//        com_empleado.setMode(ComboBox.LOCAL);
//        com_empleado.setEmptyText("Buscar cliente");
//        com_empleado.setLoadingText("buscando...");
//        com_empleado.setTypeAhead(true);
//        com_empleado.setSelectOnFocus(true);
//        com_empleado.setWidth(250);
//        com_empleado.setHideTrigger(true);
      //  com_empleado.setWidth(300);

        //com_empleado.setHideTrigger(true);

    }
 

 private void recalcular2(boolean desc) {
//             tipocambio = new Float(String.valueOf(padre.cambioM));
//        totalTotalVsus = new Float(tex_montocanceladosus.getText());
//montocanceladosus = new Float(tex_montoTotalsus.getText());
// montocancelado = new Float(tex_montoTotal.getText());
//  totalTotalV1073 = new Float(tex_montocancelado.getText());
//
//            if(montocanceladosus == 0){
//            tex_devueltosus.setValue("0");
//            }else{
//
//                if(montocanceladosus < totalTotalVsus){
//
//                    if(montocancelado==0){
//                    tex_devueltosus.setValue("0");
//                  // diferencia = totalTotalVsus - montocanceladosus;
//                   //nuevobs = diferencia*tipocambio;
//                   //diferencia =
//                   nuevobs= totalTotalV1073 - (montocanceladosus*tipocambio);
//                   tex_montoTotal.setValue(nuevobs.toString());
//                    tex_devuelto.setValue("0");
//
//            tex_montoTotal.focus();
//                    }else{
//                    tex_devueltosus.setValue("0");
//                   //diferencia = totalTotalVsus - montocanceladosus;
//                   //nuevobs = diferencia*tipocambio;
//                   nuevobs= montocanceladosus*tipocambio;
//                      montocancelado = new Float(tex_montoTotal.getText());
//
//                   //tex_montoTotal.setValue(nuevobs.toString());
//                   nuevomontodeuda = (montocancelado + nuevobs)-totalTotalV1073;
//                  //  tex_devuelto.setValue(nuevomontodeuda);
//                   if(nuevomontodeuda < 0 ){
//                     MessageBox.alert("Revise El monto ingresado, no cubre el monto de la venta");
//
//            tex_montoTotal.focus();
//                   }else{
//                        tex_montoTotal.setValue("0");
//                      tex_devuelto.setValue(nuevomontodeuda.toString());
//
//            tex_devuelto.focus();
//                     }
//                    }
//
//                }  else{
//
//                    if(montocancelado == 0){
//                         devueltosus =  montocanceladosus - totalTotalVsus ;
//          tex_devueltosus.setValue(devueltosus.toString());
//          tipocambio = new Float(String.valueOf(padre.cambioM));
//          devuelto = devueltosus*tipocambio;
//          if(devuelto < 0 ){
//                     MessageBox.alert("Revise El monto ingresado, no cubre el monto de la venta");
//
//            tex_montoTotal.focus();
//          }else{
//                  tex_devuelto.setValue(devuelto.toString());
//                   tex_montoTotal.setValue("0");
//
//            tex_devuelto.focus();
//                     }
//                    }else{
//
//                      tex_devueltosus.setValue("0");
//                   //diferencia = totalTotalVsus - montocanceladosus;
//                   //nuevobs = diferencia*tipocambio;
//                   nuevobs= montocanceladosus*tipocambio;
//
//                   //tex_montoTotal.setValue(nuevobs.toString());
//                   nuevomontodeuda = (montocancelado+nuevobs)-totalTotalV1073;
//                   // tex_devuelto.setValue(nuevomontodeuda);
//                   if(nuevomontodeuda < 0 ){
//                     MessageBox.alert("Revise El monto ingresado, no cubre el monto de la venta");
//
//            tex_montoTotal.focus();
//                   }else{
//                     tex_devuelto.setValue(nuevomontodeuda.toString());
//
//            tex_devuelto.focus();
//                     }
//                    }
//
//                }
//                        }

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
                        //    com_empleado.focus();
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

     private void asignarclientenulo() {
//        com_empleado.setDisplayField("-------------------------------");
//        com_empleado.setValue("XXXXXXX");
        tex_montoPapeleta.focus();
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

    public Button getBut_aceptar() {
        return but_aceptar;
    }


    public Button getBut_cancelar() {
        return but_cancelar;
    }
//  private boolean findByCodigoCliente() {
//         respuesta = false;
//                final String idcliente = com_empleado.getValue();
//          //      final String idmarca = com_almacen.getValue();
//
////String enlace = "php/VentaMayor.php?funcion=BuscarDatosClienteSaldo&idcliente="+idcliente;
//String enlace = "php/VentaDetalle.php?funcion=BuscarDatosClienteSaldo&idcliente="+idcliente;
//
////       String enlace = "php/cliente.php?funcion=buscarclienteporid&nit=" + codigoBuscado;
//               // Utils.setErrorPrincipal("Buscando Datos", "cargar");
//                final Conector conec = new Conector(enlace, false);
//
//                try {
//                    conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
//
//                        private String codigoCliente;
//                        private String nombre;
//                        private String nit;
//                        private String idcliente;
//                        private String saldo;
//
//                        public void onResponseReceived(Request request, Response response) {
//                            String data = response.getText();
//                            JSONValue jsonValue = JSONParser.parse(data);
//                            JSONObject jsonObject;
//                            if ((jsonObject = jsonValue.isObject()) != null) {
//                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
//                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
//                                if (errorR.equalsIgnoreCase("true")) {
//                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
//                                    JSONValue clienteValue = jsonObject.get("resultado");
//                                    JSONObject clienteObject;
//                                    if ((clienteObject = clienteValue.isObject()) != null) {
//
//                                        codigoCliente = Utils.getStringOfJSONObject(clienteObject, "codigo");
//                                        nombre = Utils.getStringOfJSONObject(clienteObject, "nombre");
//                                        //nit = Utils.getStringOfJSONObject(clienteObject, "nit");
//                                        saldo = Utils.getStringOfJSONObject(clienteObject, "saldo");
//                                        idcliente = Utils.getStringOfJSONObject(clienteObject, "idcliente");
//                                        idempresa = Utils.getStringOfJSONObject(clienteObject, "idempresa");
//                                        nombreempresa = Utils.getStringOfJSONObject(clienteObject, "nombreempresa");
//
//                                          recalcular1(false);
//                                          tex_montoPapeleta.focus();
//                                       //  padre.tex_saldoactual.setValue(clienteSeleccionado.getSaldo());
//                                      //  tex_producto.focus();
//                                       //  itemsText1.focus();
//                                        respuesta = true;
//                                    } else {
//                                       // resetCamposCliente();
//
//                                        Utils.setErrorPrincipal("El Cliente esta observado no se le puede dar credito", "error");
//                                   tex_numBoleta.setValue("");
//                                   tex_numBoleta.setDisabled(true);
//
//                                    }
//
//                                } else {
//                                    resetCamposCliente();
//
//                                    Utils.setErrorPrincipal(mensajeR, "error");
//                                }
//                            }
//                        }
//
//                        public void onError(Request request, Throwable exception) {
//                            resetCamposCliente();
//
//                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//
//                        }
//                    });
//
//                } catch (RequestException ex) {
//                    ex.getMessage();
//                    resetCamposCliente();
//                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//                }
//
//                return respuesta;
//            }
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

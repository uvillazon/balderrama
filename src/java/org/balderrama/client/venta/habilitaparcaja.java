/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.venta;

import com.gwtext.client.core.Position;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;
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
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.layout.FitLayout;

/**
 *
 * @author buggy
 */
public class habilitaparcaja extends Window {

    private final int ANCHO = 500;
    private final int ALTO = 150;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    public TextField tex_codigoC;
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
     private boolean nuevo;
    boolean respuesta = false;
    private PanelVentaCaja padre2;
        private Devolucion padre3;
String codigocliente;


private Float totalTotalV1073;

    private Float descPorV1073;
    private Float descCalV1073;
    private Float totalTotalVsus;
    private Float devuelto;
   // private Float montocambio;
    private Float tipocambio;
    private Float devueltosus;
    private Float montocancelado;
 //    private Float montodescuento;
   // private Float montocanceladosus;
    private Float cambio;
    private Float totalpagar;
    private String empresas;
    private String clientes;
  private String papeleta;
  private String boleta;
String idmarca;
String idvendedor;
    public habilitaparcaja(String idmar,String vendedor, PanelVentaCaja padred) {
   this.padre2 =padred;
   this.idmarca = idmar;
   this.idvendedor = vendedor;

        String nombreBoton1 = "Habilitar para Venta";
        String nombreBoton2 = "Cancelar";
  String tituloTabla = "Busqueda por codigo";
   setId("win-Clientes-ventam");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                String idproductos = tex_codigoC.getValueAsString().trim();
             if (idproductos != null)
     {             habilitarbarra(idproductos);
               
                    } else {
     MessageBox.alert("Por favor seleccione un codigo de barra valido ");
                }

            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                habilitaparcaja.this.close();
                habilitaparcaja.this.setModal(false);
            //formulario = null;
            }
        });
    setTitle(tituloTabla);
//        setAutoWidth(true);
//        setAutoHeight(true);
     setHeight(ALTO);
        setWidth(ANCHO);
        setMinWidth(ANCHO);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        addButton(but_aceptarP);
        addButton(but_cancelarP);
        setCloseAction(Window.CLOSE);
        setPlain(true);
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        tex_codigoC = new TextField("Codigo Barra", "codigo", 300);
        tex_codigoC.setMaxLength(13);
        tex_codigoC.setCls("grande");
        tex_codigoC.setHeight(60);
findByCodigoCliente2();
      formPanel.add(tex_codigoC);
add(formPanel);

        initValues();
       addListeners();
    }

   
    private boolean findByCodigoCliente2() {
                respuesta = false;
                 String enlace = "php/VentaMayor.php?funcion=BuscarRedondeo&idmarca=" + idmarca;
    final Conector conec = new Conector(enlace, false);

                try {
                    conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        private String idempresa;
                        private String planilla;

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
                                   //     planilla = Utils.getStringOfJSONObject(clienteObject, "planilla");
                                  //    tex_saldo.setValue(clienteSeleccionado.getSaldo());
                                         tex_codigoC.focus();
                                        respuesta = true;
                                    } else {
                                    //    resetCamposCliente();

                                        Utils.setErrorPrincipal("No se recuperaron correctamente lo valores", "error");
                                    }

                                } else {
                                  //  resetCamposCliente();

                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                          //  resetCamposCliente();

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



    private void addListeners() {
  tex_codigoC.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                   String idproductos = tex_codigoC.getValueAsString().trim();
             if (idproductos != null)

   {              habilitarbarra(idproductos);
               
                    } else {
     MessageBox.alert("Por favor seleccione un codigo de barra valido ");
                }

                }
                }
            });
     }
     public void habilitarbarra(final String buscando) {

             
  String cadena = "php/IngresoAlmacen.php?funcion=HabilitarParCaja&codigo=" + buscando+ "&idvendedor="+idvendedor;
//String cadena = "php/IngresoAlmacen.php?funcion=HabilitarPar&codigo=" + buscando;
         cadena = cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Habilitando par", "guardar");
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
                              padre2.findByCodigoProducto(buscando);
                                 habilitaparcaja.this.close();
                habilitaparcaja.this.setModal(false);
                          //  padre.reload();
                        } else {
                            Utils.setErrorPrincipal(mensajeR, "error");
//                            MessageBox.alert(mensajeR);

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

    private void initValues() {
       // tex_codigoC.setValue(codigoC);
     tex_codigoC.focus();


    }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

    

 
}
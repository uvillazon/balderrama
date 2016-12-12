/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.venta;


import com.gwtext.client.data.SimpleStore;
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
import com.gwtext.client.data.Record;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;



/**
 *
 * @author example
 */
public class FormularioConsultas extends Window {

    private final int ANCHO = 300;
    private final int ALTO = 75;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");

    private final int WINDOW_PADDING = 5;
    private FormPanel formPanelCredito;
    private Button but_aceptar;
    private Button but_cancelar;
    private String codigo;
    private String ciudad;
    private String usuario;
    private String nombre;
    private String direccion;
    private String FondoCaja;
    private String gestion;
    private String titulo = "No definido";
    private ComboBox com_empresa;
 private TextField passwordMulti;
  private Object[][] userM;
    private SimpleStore userStore;
//    private TextField tex_monto;
//    private TextArea are_observacion;
//    private ComboBox com_empresa;
//
//    private ComboBox com_empleado;
    private String idalmacen;
    private String[] estados;
//    private ListaAlmacen padre;
//    private Object[][] ciudadesM;
//    private Store ciudadesStore;
//    private Object[][] usuariosM;
   // public PanelVenta padre;
    public ListaVenta lista;
    private Object[][] empresasM;
    private Object[][] clienteM;
      private String idventadetalle;
//    private Store usuariosStore;

   

//ventas
    public FormularioConsultas(String idventa,Object [][] empresas, ListaVenta listar) {
        String nombreBoton1 = "Validar";
        String nombreBoton2 = "Cancelar";
          lista=listar;
        this.empresasM = empresas;
        this.idventadetalle = idventa;
      setTitle("Validar usuario");
      but_aceptar = new Button(nombreBoton1, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                    GuardarEliminarVenta(idventadetalle);
            }
        });
        but_cancelar = new Button(nombreBoton2, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                FormularioConsultas.this.close();
                FormularioConsultas.this.setModal(false);
            }
        });
        addButton(but_aceptar);
        addButton(but_cancelar);
        formPanelCredito = new FormPanel();
        formPanelCredito.setBaseCls("x-plain");
        formPanelCredito.setUrl("save-form.php");
        formPanelCredito.setWidth(ANCHO);
        formPanelCredito.setHeight(ALTO);
       initCombos(formPanelCredito);
        add(formPanelCredito);
    }

    public void GuardarNuevoCredito() {

        String idCliente=com_empresa.getText();
        String idAlmacen=passwordMulti.getText();
        //usuarioSoU.put("paswd1", new JSONString(Utils.md5(tex_nuevaContrania.getText())));

                 String cadena = "php/VentaDetalle.php?funcion=validarUsuario&idusuario=" + idCliente + "&password=" + idAlmacen;
       // cadena =
               // cadena + "&" + formPanelCredito.getForm().getValues();
         //        cadena + "&" + com_empresa.getText()+"&"+passwordMulti.getText();
 //String enlace = "php/cliente.php?funcion=buscarclienteporid&idcliente=" + idCliente + "&idalmacen=" + idAlmacen;
                            Utils.setErrorPrincipal("Validando el usuario", "cargar");
                final Conector conec = new Conector(cadena, false);
     //           try {
      //              conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {
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
                               //    padre.createCompra(com_usuarioMulti.getText());
                                // padre.initDescuentoEspecial("2");
                                 Utils.setErrorPrincipal(mensajeR, "mensaje");
                                    FormularioConsultas.this.destroy();
                                    FormularioConsultas.this.close();
                                } else {
                            //Window.alert(mensajeR);
                            com.google.gwt.user.client.Window.alert("No se puede realizar descuento");
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
public void GuardarEliminarVenta(final String idventadeta) {

        final String idCliente=com_empresa.getText();
        String idAlmacen=passwordMulti.getText();
        //usuarioSoU.put("paswd1", new JSONString(Utils.md5(tex_nuevaContrania.getText())));

                 String cadena = "php/VentaDetalle.php?funcion=validarUsuario&idusuario=" + idCliente + "&password=" + idAlmacen;
       // cadena =
               // cadena + "&" + formPanelCredito.getForm().getValues();
         //        cadena + "&" + com_empresa.getText()+"&"+passwordMulti.getText();
 //String enlace = "php/cliente.php?funcion=buscarclienteporid&idcliente=" + idCliente + "&idalmacen=" + idAlmacen;
                            Utils.setErrorPrincipal("Validando el usuario", "cargar");
                final Conector conec = new Conector(cadena, false);
     //           try {
      //              conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {
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
                               //    padre.createCompra(com_usuarioMulti.getText());

                                   // padre.initDescuentoEspecial("2");
//                                 lista.eliminarventa(idventadeta,idCliente);

                                 Utils.setErrorPrincipal(mensajeR, "mensaje");

                                 FormularioConsultas.this.destroy();
                                    FormularioConsultas.this.close();
                                } else {
                            //Window.alert(mensajeR);
                            com.google.gwt.user.client.Window.alert("No se puede eliminar la venta password incorrecto");
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
 
   com_empresa = new ComboBox("Usuario", "login");
        com_empresa.setValueField("idusuario");
        com_empresa.setDisplayField("login");
      //  com_empresa.setStore(proveedorStore);
        com_empresa.setForceSelection(true);
        com_empresa.setMinChars(1);
        com_empresa.setMode(ComboBox.LOCAL);
      //  com_empresa.setTriggerAction(ComboBox.ALL);
        com_empresa.setEmptyText("Seleccione un usuario");
        com_empresa.setLoadingText("Buscando");
        com_empresa.setTypeAhead(true);
        com_empresa.setSelectOnFocus(true);
        com_empresa.setHideTrigger(true);
        com_empresa.setReadOnly(true);
        com_empresa.focus();

  userStore = new SimpleStore(new String[]{"idusuario", "login"}, empresasM);
        userStore.load();
        com_empresa.setStore(userStore);

        passwordMulti = new TextField("Password", "paswd");
        passwordMulti.setPassword(true);
formPanelCredito.add(com_empresa);
formPanelCredito.add(passwordMulti);
addListenerskey();
      
    }
private void addListenerskey() {

       com_empresa.addListener(new ComboBoxListenerAdapter() {

            @Override
      public void onSelect(ComboBox comboBox, Record record, int index) {
                 passwordMulti.focus();
            }

        });
      com_empresa.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    passwordMulti.focus();
                //  GuardarEditarCliente(e);
                }
            }
        });
           passwordMulti.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                  GuardarEliminarVenta(idventadetalle);
                }
            }
        });


}
//

 private void initCombosdescuento( FormPanel formPanelCredito) {

   com_empresa = new ComboBox("Usuario", "login");
        com_empresa.setValueField("idusuario");
        com_empresa.setDisplayField("login");
      //  com_empresa.setStore(proveedorStore);
        com_empresa.setForceSelection(true);
        com_empresa.setMinChars(1);
        com_empresa.setMode(ComboBox.LOCAL);
      //  com_empresa.setTriggerAction(ComboBox.ALL);
        com_empresa.setEmptyText("Seleccione un usuario");
        com_empresa.setLoadingText("Buscando");
        com_empresa.setTypeAhead(true);
        com_empresa.setSelectOnFocus(true);
        com_empresa.setHideTrigger(true);
        com_empresa.setReadOnly(true);
        com_empresa.focus();

  userStore = new SimpleStore(new String[]{"idusuario", "login"}, empresasM);
        userStore.load();
        com_empresa.setStore(userStore);

        passwordMulti = new TextField("Password", "paswd");
        passwordMulti.setPassword(true);
formPanelCredito.add(com_empresa);
formPanelCredito.add(passwordMulti);
addListenerskeydescuento();

    }
private void addListenerskeydescuento() {

       com_empresa.addListener(new ComboBoxListenerAdapter() {

            @Override
      public void onSelect(ComboBox comboBox, Record record, int index) {
                 passwordMulti.focus();
            }

        });
      com_empresa.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    passwordMulti.focus();
                //  GuardarEditarCliente(e);
                }
            }
        });
           passwordMulti.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                      GuardarNuevoCredito();
                  //GuardarEliminarVenta(idventadetalle);
                  //
                }
            }
        });


}
    @SuppressWarnings("empty-statement")


    public Button getBut_aceptar() {
        return but_aceptar;
    }

    public Button getBut_cancelar() {
        return but_cancelar;
    }


    private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.tienda;

import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextArea;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;

/**
 *
 * @author buggy
 */
public class EditarVendedorForm extends Window {

    private final int ANCHO = 500;
    private final int ALTO = 490;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private TextField tex_codigo;
    private TextField tex_nombre;
    private TextField tex_apellido;
    private TextField tex_telefono;
    private TextField tex_direccion;
    private TextField tex_estado;
    
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String codigo;
    private String nombre;
    private String apellido;
    private String telefono;
    private String direccion;
    private String estado;
    
    private String idvendedor;
    
    private boolean nuevo;
    private Vendedores padre;

    public EditarVendedorForm(String idproveedorP, String codigoP, String nombreP, String telefonoP, String paisP, String ciudadP, String direccionP, String emailP, String webP, String representanteP) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");
//        this.idproveedorP = idproveedorP;
//        this.codigoP = codigoP;
//        this.nombreP = nombreP;
//        this.telefonoP = telefonoP;
//        this.paisP = paisP;
//        this.direccionP = direccionP;
//        this.ciudadP = ciudadP;
//        this.emailP = emailP;
//        this.webP = webP;
//        this.representanteP = representanteP;
//        this.padre = padre;

        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Registar nueva Proveedor";

        if (idproveedorP != null) {
            nombreBoton1 = "Modificar";
            tituloTabla = "Editar Proveedor";
            nuevo = false;
        } else {
//            this.idproveedorP = "nuevo";
            nuevo = true;

        }

        setId("win-productos");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                if (nuevo == false) {
//                    GuardarEditarProveedor();
                } else {
//                    GuardarNuevoProveedor();
                }
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
//                ProveedorNuevoForm.this.close();
//                ProveedorNuevoForm.this.setModal(false);
            //formulario = null;
            }
        });

        setTitle(tituloTabla);
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
        formPanel.setLabelWidth(ANCHO - 400);
        formPanel.setWidth(ANCHO);
        formPanel.setHeight(ALTO);

//        tex_codigoP = new TextField("Codigo", "codigo");
//        tex_nombreP = new TextField("Nombre Proveedor", "nombre");
//        tex_telefonoP = new TextField("Telefono", "telefono");
//        tex_paisP = new TextField("Pais", "pais");
//        tex_ciudadP = new TextField("Ciudad", "ciudad");
//        tex_direccionP = new TextField("Direccion", "direcion");
//        tex_emailP = new TextField("E-mail", "email");
//        tex_webP = new TextField("Pagina Web", "web");
//        tex_representanteP = new TextField("Representante", "representante");





        formPanel.setLabelWidth(ANCHO - 400 - 5);
//        formPanel.add(tex_codigoP, ANCHO_LAYOUT_DATA);
//        formPanel.add(tex_nombreP, ANCHO_LAYOUT_DATA);
//        formPanel.add(tex_telefonoP, ANCHO_LAYOUT_DATA);
//        formPanel.add(tex_paisP, ANCHO_LAYOUT_DATA);
//        formPanel.add(tex_ciudadP, ANCHO_LAYOUT_DATA);
//        formPanel.add(tex_direccionP, ANCHO_LAYOUT_DATA);
//        formPanel.add(tex_emailP, ANCHO_LAYOUT_DATA);
//        formPanel.add(tex_webP, ANCHO_LAYOUT_DATA);
//        formPanel.add(tex_representanteP, ANCHO_LAYOUT_DATA);
        add(formPanel);
        initValues();
    }

    private void initValues() {
//        tex_codigoP.setValue(codigoP);
//        tex_nombreP.setValue(nombreP);
//        tex_telefonoP.setValue(telefonoP);
//        tex_paisP.setValue(paisP);
//        tex_ciudadP.setValue(ciudadP);
//        tex_direccionP.setValue(direccionP);
//        tex_emailP.setValue(emailP);
//        tex_webP.setValue(webP);
//        tex_representanteP.setValue(representanteP);

    }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

//    public void GuardarNuevoProveedor() {
////        String cadena = "php/Proveedor.php?funcion=GuardarNuevoProveedor&idproveedor=" + idproveedorP;
//        cadena = cadena + "&" + formPanel.getForm().getValues();
//        final Conector conec = new Conector(cadena, false);
//        Utils.setErrorPrincipal("Guardando el nuevo proveedor", "guardar");
//        try {
//            conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
//
//                public void onResponseReceived(Request request, Response response) {
//                    String data = response.getText();
//                    JSONValue jsonValue = JSONParser.parse(data);
//                    JSONObject jsonObject;
//                    if ((jsonObject = jsonValue.isObject()) != null) {
//                        String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
//                        String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
//                        if (errorR.equalsIgnoreCase("true")) {
//                            Utils.setErrorPrincipal(mensajeR, "mensaje");
//                            close();
//                            padre.reload();
//                        } else {
//                            Utils.setErrorPrincipal(mensajeR, "error");
//                        }
//                    }
//
//                }
//
//                public void onError(Request request, Throwable exception) {
//                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//                }
//            });
//
//        } catch (RequestException ex) {
//            ex.getMessage();
//            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//        }
//    }

//    public void GuardarEditarProveedor() {
//        String cadena = "php/Proveedor.php?funcion=GuardarEditarProveedor&idproveedor=" + idproveedorP;
//        cadena = cadena + "&" + formPanel.getForm().getValues();
//        final Conector conec = new Conector(cadena, false);
//        Utils.setErrorPrincipal("Actualizando los cambios en Proveedor", "guardar");
//        try {
//            conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
//
//                public void onResponseReceived(Request request, Response response) {
//                    String data = response.getText();
//                    JSONValue jsonValue = JSONParser.parse(data);
//                    JSONObject jsonObject;
//                    if ((jsonObject = jsonValue.isObject()) != null) {
//                        String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
//                        String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
//                        if (errorR.equalsIgnoreCase("true")) {
//                            Utils.setErrorPrincipal(mensajeR, "mensaje");
//                            close();
//                            padre.reload();
//                        } else {
//                            Utils.setErrorPrincipal(mensajeR, "error");
//                        }
//                    }
//                }
//
//                public void onError(Request request, Throwable exception) {
//                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//                }
//            });
//
//        } catch (RequestException ex) {
//            ex.getMessage();
//            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//        }
//    }
}

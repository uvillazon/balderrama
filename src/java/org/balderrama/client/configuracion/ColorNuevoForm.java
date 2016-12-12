/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.configuracion;

import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.google.gwt.user.client.ui.DecoratorPanel;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.Hidden;
import com.gwtext.client.widgets.form.TextArea;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import org.balderrama.client.marca.Marca;
//import org.balderrama.client.sistemadetalle.MarcaDetalle;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;

/**
 *
 * @author buggy
 */
public class ColorNuevoForm extends Window {

    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private TextField tex_codigoColor;
    private TextField tex_nombreColor;
    private TextArea tex_descripcionColor;
    private TextField tex_codigoBarraColor;
    private TextField tex_marcaM;
    private Hidden hid_idmarca;
    private Button but_aceptarColor;
    private Button but_cancelarColor;
    private String codigoColor;
    private String idColor;
    private String nombreColor;
    private String codigoBarraColor;
    private String descripcionColor;
    private String idmarca;
    private String nombrem;
    private boolean nuevo;
    private ConfiguracionColor padre;
    private Marca padre1;
 //   private MarcaDetalle padre3;

    private ConfiguracionColorDetalle padre2;


    public ColorNuevoForm(String idcolor, String codigo, String nombre, String codigobarra, String descripcion, String nombrem, String idmarca, ConfiguracionColorDetalle padre2) {

 //public  ColorNuevoForm(Object object, String string, String string0, String string1, String string2, String nombrem, String idmarca, ConfiguracionColorDetalle aThis) {
         this.idColor = idcolor;
        this.codigoColor = codigo;
        this.nombreColor = nombre;
        this.codigoBarraColor = codigobarra;
        this.descripcionColor = descripcion;
        this.padre2 = padre2;
        this.idmarca = idmarca;
        this.nombrem = nombrem;

        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Registrar Nuevo Color";

        if (idColor != null) {
            nombreBoton1 = "Modificar";
            tituloTabla = "Editar Color";
            nuevo = false;
        } else {
            this.idColor = "nuevo";
            nuevo = true;

        }

        setId("win-productos");
        but_aceptarColor = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                if (nuevo == false) {
                    GuardarEditarColor();
                } else {
                    GuardarNuevoColor();
                }
            }
        });
        but_cancelarColor = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                ColorNuevoForm.this.close();
                ColorNuevoForm.this.setModal(false);
            //formulario = null;
            }
        });

        setTitle(tituloTabla);
        setAutoHeight(true);
        setAutoWidth(true);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        addButton(but_aceptarColor);
        addButton(but_cancelarColor);

        setCloseAction(Window.CLOSE);
        setPlain(true);
        DecoratorPanel decPanel = new DecoratorPanel();
        decPanel.setTitle("Registro De Colores");

        formPanel = new FormPanel();




        tex_codigoColor = new TextField("Codigo", "codigo");
        tex_nombreColor = new TextField("Nombre", "nombre", 200);
        tex_nombreColor.focus();
        tex_marcaM = new TextField("Marca", "marca", 200);

        tex_codigoBarraColor = new TextField("codigo Barra", "codigobarra", 200);
      //  tex_descripcionColor = new TextArea("Descripcion", "descripcion");
        hid_idmarca = new Hidden("idmarca", idmarca);



//        formPanel.add(tex_codigoColor, ANCHO_LAYOUT_DATA);
        formPanel.add(tex_marcaM);
        formPanel.add(tex_nombreColor);
       // formPanel.add(tex_descripcionColor);
        formPanel.add(hid_idmarca);

        decPanel.add(formPanel);
//        add(formPanel);
        add(decPanel);
        initValues();
    addListeners();
    }

    public ColorNuevoForm(String idcolor, String codigo, String nombre, String codigobarra, String descripcion, String nombrem, String idmarca, ConfiguracionColor padre) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");
        this.idColor = idcolor;
        this.codigoColor = codigo;
        this.nombreColor = nombre;
        this.codigoBarraColor = codigobarra;
        this.descripcionColor = descripcion;
        this.padre = padre;
        this.idmarca = idmarca;
        this.nombrem = nombrem;

        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Registrar Nuevo Color";

        if (idColor != null) {
            nombreBoton1 = "Modificar";
            tituloTabla = "Editar Color";
            nuevo = false;
        } else {
            this.idColor = "nuevo";
            nuevo = true;

        }

        setId("win-productos");
        but_aceptarColor = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                if (nuevo == false) {
                    GuardarEditarColor();
                } else {
                    GuardarNuevoColor();
                }
            }
        });
        but_cancelarColor = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                ColorNuevoForm.this.close();
                ColorNuevoForm.this.setModal(false);
            //formulario = null;
            }
        });

        setTitle(tituloTabla);
        setAutoHeight(true);
        setAutoWidth(true);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        addButton(but_aceptarColor);
        addButton(but_cancelarColor);

        setCloseAction(Window.CLOSE);
        setPlain(true);
        DecoratorPanel decPanel = new DecoratorPanel();
        decPanel.setTitle("Registro De Colores");

        formPanel = new FormPanel();




        tex_codigoColor = new TextField("Codigo", "codigo");
        tex_nombreColor = new TextField("Nombre", "nombre", 200);
        tex_nombreColor.focus();
        tex_marcaM = new TextField("Marca", "marca", 200);

        tex_codigoBarraColor = new TextField("codigo Barra", "codigobarra", 200);
       // tex_descripcionColor = new TextArea("Descripcion", "descripcion");
        hid_idmarca = new Hidden("idmarca", idmarca);



//        formPanel.add(tex_codigoColor, ANCHO_LAYOUT_DATA);
        formPanel.add(tex_marcaM);
        formPanel.add(tex_nombreColor);
       // formPanel.add(tex_descripcionColor);
        formPanel.add(hid_idmarca);

        decPanel.add(formPanel);
//        add(formPanel);
        add(decPanel);
        initValues();
    addListeners();
    }

   
     private void addListeners() {
           tex_nombreColor.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                 if (nuevo == false) {
                    GuardarEditarColor();
                } else {
                    GuardarNuevoColor();
                }

                }
            }

        });


    }

    private void initValues() {
        tex_codigoColor.setValue(codigoColor);
        tex_nombreColor.setValue(nombreColor);
        tex_codigoBarraColor.setValue(codigoBarraColor);
     //   tex_descripcionColor.setValue(descripcionColor);
        tex_marcaM.setValue(nombrem);
        tex_marcaM.setReadOnly(true);
    }

    public Button getBut_aceptar() {
        return but_aceptarColor;
    }

    public Button getBut_cancelar() {
        return but_cancelarColor;
    }

    public void GuardarNuevoColor() {
        String cadena = "php/Colores.php?funcion=GuardarNuevoColor&idcolor=" + idColor;
        cadena = cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Guardando el nuevo Color", "guardar");
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
                           // close();

                            padre.reload();
                           // padre2.reload();

                            limpiarVentanaVenta();
                            tex_nombreColor.focus();
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
 public void limpiarVentanaVenta() {
      tex_nombreColor.setValue("");
          
    }
    public void GuardarEditarColor() {
        String cadena = "php/Colores.php?funcion=GuardarEditarColor&idcolor=" + idColor;
        cadena = cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Actualizando los cambios de los colores", "guardar");
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
                            //padre2.reload();

                            limpiarVentanaVenta();
 tex_nombreColor.focus();
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

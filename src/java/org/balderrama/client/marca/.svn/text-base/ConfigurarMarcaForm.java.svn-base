/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.marca;

import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.form.Checkbox;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FieldSet;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextArea;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.HorizontalLayout;
import com.gwtext.client.widgets.layout.VerticalLayout;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;

/**
 *
 * @author buggy
 */
public class ConfigurarMarcaForm extends Window {

    private final int ANCHO = 900;
    private final int ALTO = 550;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private TextField tex_marcaM;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String idmarcaM;
    private String marcaM;
    private Object[][] coloresM;
    private Object[][] materialesM;
    private boolean nuevo;
    private Marca padre;

    public ConfigurarMarcaForm(String idmarcaM, String marcaM, Object[][] coloresM, Object[][] materialesM, Marca padre) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");
        this.idmarcaM = idmarcaM;
        this.marcaM = marcaM;
        this.coloresM = coloresM;
        this.materialesM = materialesM;


        this.padre = padre;

        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Configurar nueva Marca";

        if (idmarcaM != null) {
            nombreBoton1 = "Guardar Configuracion";
            tituloTabla = "Configuracion parametros de Marca";
            nuevo = false;
        } else {
            this.idmarcaM = "nuevo";
            nuevo = true;

        }

        setId("win-Marcas");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                if (nuevo == false) {
                    GuardarConfiguracionMarca();
                } else {
                    MessageBox.alert("Hola Mundo");
                }
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                ConfigurarMarcaForm.this.close();
                ConfigurarMarcaForm.this.setModal(false);
            //formulario = null;
            }
        });
        tex_marcaM = new TextField("Marca", "nombre");
        tex_marcaM.setReadOnly(true);
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



        formPanel.setLabelWidth(ANCHO - 400 - 5);
        formPanel.add(tex_marcaM);

        initcrearFielsetsColor();
        initcrearFielsetsMaterial();



        add(formPanel);

        initValues();
    }

    private void initcrearFielsetsColor() {

        Panel root = new Panel();
        root.setBaseCls("x-plain1");
        root.setId("root");
        root.setAutoScroll(true);

        root.setWidth(ANCHO - 30);
        root.setHeight(ALTO - 50);

        FieldSet field1 = new FieldSet("Colores");

        field1.setLayout(new HorizontalLayout(6));
        field1.setId("hola");
        field1.setAutoScroll(true);
        int auxFilas = 0;
        float auxCantFilasF = coloresM.length / 6;

        int auxCantFilas = 0;
        auxCantFilas = redondedo(auxCantFilasF);
        Checkbox manager1;


        //funcS = conec.getObjects(cadS, null);
        ////auxCantFilas = (int) Math.floor(funcS.length/4);
        Panel pan_checks = null;
        for (int ii = 0; ii < coloresM.length; ii++) {

            if (auxFilas == 0) {

                String idpanel = "Panelc" + ii;
                pan_checks = new Panel();
                pan_checks.setId(idpanel);
                pan_checks.setLayout(new VerticalLayout(10));
                pan_checks.setBaseCls("x-plain");
                field1.add(pan_checks);


            }

            auxFilas++;
            String nom = coloresM[ii][1].toString();
            String idchek = coloresM[ii][0].toString();
            manager1 = new Checkbox(nom);
            manager1.setStyleName("x-plain");
            manager1.setName(idchek);
            manager1.setId("F" + idchek);

            if (idmarcaM != null) {
                String existe = coloresM[ii][2].toString();
                if (existe.equalsIgnoreCase("si")) {
                    manager1.setChecked(true);
                }
            }
            if (auxFilas >= auxCantFilas) {
                auxFilas = 0;
            }
            pan_checks.add(manager1);



        }
//        field.add(pan_checks);
        root.add(field1);
        //pan_checks = null;


        formPanel.add(field1);

//        //Utils.getArrayOfJSONObject(jsonObject, "resultado");
//        for (int i = 0; i < cats.length; i++) {
//
////com.google.gwt.user.client.Window.alert(".........." + categoria.);
//        }
    }

    private void initcrearFielsetsMaterial() {

        Panel root1 = new Panel();
        root1.setBaseCls("x-plain");
        root1.setId("root1");
        root1.setAutoScroll(true);

        root1.setWidth(ANCHO - 30);
        root1.setHeight(ALTO - 50);

        FieldSet field = new FieldSet("Materiales");

        field.setLayout(new HorizontalLayout(6));
        field.setId("hola1");
        int auxFilas = 0;
        float auxCantFilasF = materialesM.length / 6;

        int auxCantFilas = 0;
        auxCantFilas = redondedo(auxCantFilasF);
        Checkbox manager12;


        //funcS = conec.getObjects(cadS, null);
        ////auxCantFilas = (int) Math.floor(funcS.length/4);
        Panel pan_checks = null;
        for (int ii = 0; ii < materialesM.length; ii++) {

            if (auxFilas == 0) {

                String idpanel = "Panel" + ii;
                pan_checks = new Panel();
                pan_checks.setId(idpanel);
                pan_checks.setLayout(new VerticalLayout(10));
                pan_checks.setBaseCls("x-plain");
                field.add(pan_checks);


            }

            auxFilas++;
            String idchekq = materialesM[ii][0].toString();
            String nom = materialesM[ii][1].toString();
            String existe = materialesM[ii][2].toString();
            manager12 = new Checkbox(nom);
            manager12.setStyleName("x-plain");
            manager12.setName(idchekq);
            manager12.setId("F" + idchekq);
            if (idmarcaM != null) {

                if (existe.equalsIgnoreCase("si")) {
                    manager12.setChecked(true);
                }
            }
            if (auxFilas >= auxCantFilas) {
                auxFilas = 0;
            }
            pan_checks.add(manager12);



        }
        root1.add(field);


        formPanel.add(field);

    }

    private void initValues() {
        tex_marcaM.setValue(marcaM);


    }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

    public void GuardarConfiguracionNuevaMarca() {
        String cadena = "php/Marca.php?funcion=GuardarConfiguracionMarca";
        cadena =
                cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Guardando el nuevo proveedor", "guardar");
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

    public void GuardarConfiguracionMarca() {
        String cadena = "php/Marca.php?funcion=GuardarConfigurarMarca&idmarca=" + idmarcaM;
        cadena =
                cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Actualizando los cambios en Proveedor", "guardar");
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

    public int redondedo(float f) {
        int aux = (int) f;
        if (aux < f) {
            aux = aux + 1;
        }
        return aux;
    }
}
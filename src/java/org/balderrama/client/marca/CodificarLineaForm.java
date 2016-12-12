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
public class CodificarLineaForm extends Window {

    private final int ANCHO = 500;
    private final int ALTO = 300;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private TextField tex_marcaM;
    private TextField tex_codigoM;
    private ComboBox com_lineaM;
    private ComboBox com_coleccionM;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String idmarcaM;
    private String marcaM;
    private Object[][] lineasM;
    private Object[][] coleccionesM;
    private boolean nuevo;
    private Marca padre;

    public CodificarLineaForm(String idmarcaM, String marcaM, Object[][] coloresM, Object[][] materialesM, Marca padre) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");
        this.idmarcaM = idmarcaM;
        this.marcaM = marcaM;
        this.lineasM = coloresM;
        this.coleccionesM = materialesM;


        this.padre = padre;

        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Codificar Linea Coleccion de una  Marca";

        if (idmarcaM != null) {
            nombreBoton1 = "Guardar";
            nombreBoton2 = "Cancelar";
            tituloTabla = "Codificar Linea Coleccion de una  Marca";
            nuevo = false;
        } else {
            this.idmarcaM = "nuevo";
            nuevo = true;

        }

        setId("win-Marcas2");
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
                CodificarLineaForm.this.close();
                CodificarLineaForm.this.setModal(false);
            //formulario = null;
            }
        });
        tex_marcaM = new TextField("Marca", "nombre");
        tex_codigoM = new TextField("Codigo", "codigo");
        tex_marcaM.setReadOnly(true);
        com_coleccionM = new ComboBox("Coleccion", "coleccion");
        com_lineaM = new ComboBox("Linea", "linea");
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
        formPanel.add(tex_marcaM, ANCHO_LAYOUT_DATA);
//        formPanel.add(com_coleccionM, ANCHO_LAYOUT_DATA);
        formPanel.add(com_lineaM, ANCHO_LAYOUT_DATA);
        formPanel.add(tex_codigoM, ANCHO_LAYOUT_DATA);



        add(formPanel);
        initCombos();
        initValues();
    }
     private void initCombos() {

        com_lineaM.setValueField("idlinea");
        com_lineaM.setDisplayField("nombre");
        com_lineaM.setForceSelection(true);
        com_lineaM.setMinChars(1);
        com_lineaM.setMode(ComboBox.LOCAL);
        com_lineaM.setTriggerAction(ComboBox.ALL);
        com_lineaM.setEmptyText("Seleccione una Linea");
        com_lineaM.setLoadingText("Buscando");
        com_lineaM.setTypeAhead(true);
        com_lineaM.setSelectOnFocus(true);
        com_lineaM.setHideTrigger(false);
        com_lineaM.setReadOnly(true);
        SimpleStore proveedorStore = new SimpleStore(new String[]{"idlinea", "nombre"}, lineasM);
        proveedorStore.load();
        com_lineaM.setStore(proveedorStore);

        com_coleccionM.setValueField("idcoleccion");
        com_coleccionM.setDisplayField("codigo");
        com_coleccionM.setForceSelection(true);
        com_coleccionM.setMinChars(1);
        com_coleccionM.setMode(ComboBox.LOCAL);
        com_coleccionM.setTriggerAction(ComboBox.ALL);
        com_coleccionM.setEmptyText("Seleccione una Coleccion");
        com_coleccionM.setLoadingText("Buscando");
        com_coleccionM.setTypeAhead(true);
        com_coleccionM.setSelectOnFocus(true);
        com_coleccionM.setHideTrigger(false);
        com_coleccionM.setReadOnly(true);
        SimpleStore cotegoriaStore = new SimpleStore(new String[]{"idcoleccion", "codigo"}, coleccionesM);
        cotegoriaStore.load();
        com_coleccionM.setStore(cotegoriaStore);




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
        String cadena = "php/Marca.php?funcion=GuardarCodificarLinea";
        cadena =
                cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Guardando Configuracion", "guardar");
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
        String cadena = "php/Marca.php?funcion=GuardarCodificarLinea&idmarca=" + idmarcaM;
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
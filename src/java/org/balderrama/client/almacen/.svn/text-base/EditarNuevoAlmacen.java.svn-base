/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.almacen;

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
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;

/**
 *
 * @author buggy
 */
public class EditarNuevoAlmacen extends Window {

    private final int ANCHO = 320;
    private final int ALTO = 250;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("50%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private TextField tex_codigoC;
    private TextField tex_nombreC;
    private TextField tex_telefonoC;
    private TextField tex_direccionC;
    private TextField tex_faxC;
    private ComboBox com_tipoalmacenC;
    private ComboBox com_ciudadC;
//    private ComboBox com_estadoC;
//    private Panel formpanel;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String idalmacenC;
    private String nombreC;
    private String tipoA;
    private String codigoC;
    private String ciudadC;
    private String telefonoC;
    private String direccionC;
    private String faxC;
//    private String estadoC;
    private Object[][] ciudadM;
    private String[] tipoalmacenM;
    private boolean nuevo;
    private Almacen padre;

    public EditarNuevoAlmacen(String idalmacen, String nombre, String codigo, String tipo, String direccion, String telefono, String fax, String ciudad, Object[][] responsables, Object[][] ciudades, Almacen padre) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");
        this.idalmacenC = idalmacen;
        this.codigoC = codigo;
        this.nombreC = nombre;
        this.tipoA = tipo;
        this.direccionC = direccion;
        this.telefonoC = telefono;
        this.faxC = fax;
        this.tipoalmacenM = new String[]{"ALMACEN", "TIENDA"};
        this.ciudadC = ciudad;
        this.ciudadM = ciudades;
//        this.estadoM = new String[]{"Activo", "Inactivo"};


        this.padre = padre;

        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Registar nuevo Almacen";

        if (idalmacenC != null) {
            nombreBoton1 = "Modificar";
            tituloTabla = "Editar Almacen";
            nuevo = false;
        } else {
            this.idalmacenC = "nuevo";
            nuevo = true;

        }

        setId("win-Almacenes");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                if (nuevo == false) {
                    GuardarEditarAlmacen();
                } else {
                    GuardarNuevoAlmacen();
                }
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                EditarNuevoAlmacen.this.close();
                EditarNuevoAlmacen.this.setModal(false);
            //formulario = null;

//                IngresoAlmacen ingreso =new IngresoAlmacen();
//                ingreso.show();
            }
        });

        setTitle(tituloTabla);
//        setWidth(ANCHO);
//        setMinWidth(ANCHO);
        setAutoWidth(true);
        setAutoHeight(true);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        addButton(but_aceptarP);
        addButton(but_cancelarP);

        setCloseAction(Window.CLOSE);
        setPlain(true);
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
//        formPanel.setLabelWidth(ANCHO - 400);



        tex_codigoC = new TextField("Codigo", "codigo", 60);
        tex_codigoC.setMaxLength(6);
        tex_nombreC = new TextField("Nombre", "nombre");

        tex_telefonoC = new TextField("Telefono", "telefono");
        tex_direccionC = new TextField("Direccion", "direccion");
        tex_faxC = new TextField("Fax", "fax");



        com_tipoalmacenC = new ComboBox("Tipo Almacen", "tipos");
        com_ciudadC = new ComboBox("Ciudad", "ciudad");
//        com_estadoC = new ComboBox("Estado", "estado");






//        formPanel.setLabelWidth(ANCHO - 400 - 5);
        formPanel.add(tex_codigoC);
        formPanel.add(tex_nombreC);
        formPanel.add(com_tipoalmacenC);

        formPanel.add(tex_direccionC);
        formPanel.add(tex_telefonoC);

        formPanel.add(tex_faxC);
        formPanel.add(com_ciudadC);
//        formPanel.add(com_estadoC, ANCHO_LAYOUT_DATA);



        add(formPanel);
        initCombos();
        initValues();
    }

    private void initCombos() {

        SimpleStore tiposStore = new SimpleStore("tipos", tipoalmacenM);
        tiposStore.load();
        com_tipoalmacenC.setDisplayField("tipos");
        com_tipoalmacenC.setStore(tiposStore);

        SimpleStore cotegoriaStore = new SimpleStore(new String[]{"idciudad", "nombre"}, ciudadM);
        cotegoriaStore.load();
        com_ciudadC.setMinChars(1);
        com_ciudadC.setFieldLabel("Ciudad");
        com_ciudadC.setStore(cotegoriaStore);
        com_ciudadC.setValueField("idciudad");
        com_ciudadC.setDisplayField("nombre");
        com_ciudadC.setForceSelection(true);
        com_ciudadC.setMode(ComboBox.LOCAL);
        com_ciudadC.setEmptyText("Buscar Ciudad");
        com_ciudadC.setLoadingText("buscando...");
        com_ciudadC.setTypeAhead(true);
        com_ciudadC.setSelectOnFocus(true);
        com_ciudadC.setWidth(200);

        com_ciudadC.setHideTrigger(true);

//        SimpleStore estadosStore = new SimpleStore("estados", estadoM);
//        estadosStore.load();
//        com_estadoC.setDisplayField("estados");
//        com_estadoC.setStore(estadosStore);


    }

    private void initValues() {
        tex_codigoC.setValue(codigoC);
        tex_nombreC.setValue(nombreC);
        tex_telefonoC.setValue(telefonoC);
        tex_direccionC.setValue(direccionC);
        tex_faxC.setValue(faxC);
        com_ciudadC.setValue(ciudadC);
        com_tipoalmacenC.setValue(tipoA);
//        com_estadoC.setValue(estadoC);


    }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

    public void GuardarNuevoAlmacen() {
        String cadena = "php/Almacen.php?funcion=GuardarNuevoAlmacen";
        cadena =
                cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Guardando el nuevo Almacen", "guardar");
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

    public void GuardarEditarAlmacen() {
        String cadena = "php/Almacen.php?funcion=GuardarEditarAlmacen&idalmacen=" + idalmacenC;
        cadena = cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Actualizando los cambios en Almacen", "guardar");
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
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.modelo;

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
import com.gwtext.client.data.Store;
import com.gwtext.client.widgets.Button;
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
public class ModeloNuevoMarcaColeccion extends Window {

    private final int ANCHO = 500;
    private final int ALTO = 200;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private FormPanel formPanelEtapas;
    private TextField tex_codigoM;
    private TextField tex_stylenameM;
    private TextArea tex_descripcionM;
    private TextField tex_lineaM;
    private TextField tex_imagenM;
    private ComboBox com_marcaM;
    private ComboBox com_coleccionM;
    private ComboBox com_lineaM;

    private Button but_aceptarP;
    private Button but_cancelarP;
    private String idmodeloM;
    private String idmarcaM;
    private String codigoM;
    private String descripcionM;
    private String idcoleccionM;
    private String stylenameM;
    private String lineaM;
    private String imagenM;

    private Object[][] marcasM;
    private Object[][] coleccionesM;
    private Object[][] lineasM;
  
    private boolean nuevo;
    private Modelo padre;

    public ModeloNuevoMarcaColeccion(String idmodelo, String idmarca, String idlinea, String idcoleccion, String codigo, String style, String detalle, String imagen, Object[][] marcas, Object[][] coleccion, Object[][] lineas, Modelo padre) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");
        this.idmodeloM = idmodelo;
        this.idmarcaM = idmarca;
        this.codigoM = codigo;
        this.descripcionM = detalle;
        this.stylenameM = style;
        this.imagenM = imagen;
        this.lineaM = idlinea;
        this.idcoleccionM = idcoleccion;


        this.marcasM = marcas;
        this.coleccionesM = coleccion;
        this.lineasM = lineas;



        this.padre = padre;

        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Registar Modelo nuevo";

        if (idmodeloM != null) {
            nombreBoton1 = "Modificar";
            tituloTabla = "Editar Modelo";
            nuevo = false;
        } else {
//            this.idmodeloM = "nuevo";
            nuevo = true;

        }

        setId("win-Marcas");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                if (nuevo == false) {
                    GuardarEditarModelo();
                } else {
                    //GuardarNuevaMarca();
                    GuardarNuevoModelo();

                }
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                ModeloNuevoMarcaColeccion.this.close();
                ModeloNuevoMarcaColeccion.this.setModal(false);
            //formulario = null;
            }
        });

        setTitle(tituloTabla);
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


        tex_codigoM = new TextField("Modelo", "modelo", 50);
        tex_codigoM.setMaxLength(6);
        tex_descripcionM = new TextArea("Detalle", "descripcion");
//        tex_lineaM = new TextField("Linea", "codigo");
        tex_stylenameM = new TextField("Stylename", "stylename", 200);
        tex_imagenM = new TextField("Path Imagen", "imagen");

        com_marcaM = new ComboBox("Marca", "idmarca", 150);
        com_coleccionM = new ComboBox("Coleccion", "idcoleccion", 150);
        com_lineaM = new ComboBox("Linea", "idlinea", 150);





        formPanel.add(com_marcaM);
        formPanel.add(com_coleccionM);
        formPanel.add(com_lineaM);
        formPanel.add(tex_codigoM);
        formPanel.add(tex_stylenameM);
        formPanel.add(tex_imagenM);
        formPanel.add(tex_descripcionM);

        add(formPanel);
        initCombos();
        initValues();
    }

    private void initCombos() {


        final SimpleStore proveedorStore = new SimpleStore(new String[]{"idmarca", "nombre"}, marcasM);
        proveedorStore.load();
        com_marcaM.setMinChars(1);
        //com_empresa.setFieldLabel("Ciudad");
        com_marcaM.setStore(proveedorStore);
        com_marcaM.setValueField("idmarca");
        com_marcaM.setDisplayField("nombre");
        com_marcaM.setForceSelection(true);
        com_marcaM.setMode(ComboBox.LOCAL);
        com_marcaM.setEmptyText("Seleccione una marca");
        com_marcaM.setLoadingText("buscando...");
        com_marcaM.setTypeAhead(true);
        com_marcaM.setSelectOnFocus(true);
        com_marcaM.setWidth(200);

        com_marcaM.setHideTrigger(true);

        final SimpleStore proveedorStore1 = new SimpleStore(new String[]{"idcoleccion", "codigo", "idmarca"}, coleccionesM);
        proveedorStore1.load();

        com_coleccionM.setMinChars(1);
        //com_empresa.setFieldLabel("Ciudad");

        com_coleccionM.setValueField("idcoleccion");
        com_coleccionM.setDisplayField("codigo");
        com_coleccionM.setForceSelection(true);
        com_coleccionM.setMode(ComboBox.LOCAL);
        com_coleccionM.setEmptyText("Seleccione un coleccion");
        com_coleccionM.setLoadingText("buscando...");
        com_coleccionM.setTypeAhead(true);
        com_coleccionM.setSelectOnFocus(true);
        com_coleccionM.setWidth(200);
        com_coleccionM.setLinked(true);
        com_coleccionM.setHideTrigger(true);

        com_coleccionM.setStore(proveedorStore1);

        com_marcaM.addListener(new ComboBoxListenerAdapter() {

            public void onSelect(ComboBox comboBox, Record record, int index) {
                com_coleccionM.setValue("");
                proveedorStore1.filter("idmarca", comboBox.getValue());
            }
        });

        final SimpleStore proveedorStore2 = new SimpleStore(new String[]{"idlinea", "idcoleccion", "codigo"}, lineasM);
        proveedorStore2.load();

        com_lineaM.setMinChars(1);
        //com_empresa.setFieldLabel("Ciudad");

        com_lineaM.setValueField("idlinea");
        com_lineaM.setDisplayField("codigo");
        com_lineaM.setForceSelection(true);
        com_lineaM.setMode(ComboBox.LOCAL);
        com_lineaM.setEmptyText("Seleccione una linea");
        com_lineaM.setLoadingText("buscando...");
        com_lineaM.setTypeAhead(true);
        com_lineaM.setSelectOnFocus(true);
        com_lineaM.setWidth(200);
        com_lineaM.setLinked(true);
        com_lineaM.setHideTrigger(true);

        com_lineaM.setStore(proveedorStore2);

        com_coleccionM.addListener(new ComboBoxListenerAdapter() {

            public void onSelect(ComboBox comboBox, Record record, int index) {
                com_lineaM.setValue("");
                proveedorStore2.filter("idcoleccion", comboBox.getValue());
            }
        });


    }//fin combo

    private void initValues() {
        com_marcaM.setValue(idmarcaM);
        com_coleccionM.setValue(idcoleccionM);
        com_lineaM.setValue(lineaM);
        tex_codigoM.setValue(codigoM);
        tex_descripcionM.setValue(descripcionM);
        tex_stylenameM.setValue(stylenameM);
        tex_imagenM.setValue(imagenM);

    }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

    public void GuardarNuevoModelo() {
        String cadena = "php/Modelo.php?funcion=GuardarNuevoModelo";
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

    public void GuardarEditarModelo() {
        String cadena = "php/Modelo.php?funcion=GuardarEditarModelo&idmodelo=" + idmodeloM;
        cadena =
                cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Actualizando...", "guardar");
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

   
}
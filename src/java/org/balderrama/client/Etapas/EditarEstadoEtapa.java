/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.Etapas;

import org.balderrama.client.marca.*;
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
import org.balderrama.client.sistemadetalle.IngresoAlmacen;
import org.balderrama.client.sistemadetalle.ListaIngresoAlmacen;

/**
 *
 * @author buggy
 */
public class EditarEstadoEtapa extends Window {

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
     private TextArea tea_descripcion;
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
    private Control padre;

    public EditarEstadoEtapa(String idalmacen, String nombre,String tipo,Control padre) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");
        this.idalmacenC = idalmacen;
       // this.codigoC = codigo;
         this.tipoA = tipo;
        this.nombreC = nombre;
        //this.ciudadC = ciudad;
        //this.ciudadM = ciudades;
        this.tipoalmacenM = new String[]{"PENDIENTE", "CONFIRMADO","PROGRESO"};

        this.padre = padre;

        String nombreBoton1 = "Cambiar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Cambiar Estado";

        

        setId("win-Almacenes");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                    GuardarEditarAlmacen();
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                EditarEstadoEtapa.this.close();
                EditarEstadoEtapa.this.setModal(false);
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



        //tex_codigoC = new TextField("Codigo", "codigo", 60);
        //tex_codigoC.setMaxLength(6);
        tex_nombreC = new TextField("Nombre", "nombre");
        


        com_tipoalmacenC = new ComboBox("Estado", "estado");
       // com_ciudadC = new ComboBox("Ciudad", "ciudad");
//        com_estadoC = new ComboBox("Estado", "estado");
tea_descripcion = new TextArea("Observacion", "observacion");
        tea_descripcion.setWidth("100%");






//        formPanel.setLabelWidth(ANCHO - 400 - 5);
        //formPanel.add(tex_codigoC);
        formPanel.add(tex_nombreC);
        formPanel.add(com_tipoalmacenC);

        formPanel.add(tea_descripcion);
      


        add(formPanel);
        initCombos();
        initValues();
    }

    private void initCombos() {

        SimpleStore tiposStore = new SimpleStore("tipos", tipoalmacenM);
        tiposStore.load();
        com_tipoalmacenC.setDisplayField("tipos");
        com_tipoalmacenC.setStore(tiposStore);

      
    }

    private void initValues() {
       // tex_codigoC.setValue(codigoC);
        tex_nombreC.setValue(nombreC);
        com_tipoalmacenC.setValue(tipoA);
//        com_estadoC.setValue(estadoC);


    }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

  
    public void GuardarEditarAlmacen() {
        //String cadena = "php/Almacen.php?funcion=GuardarEditarAlmacen&idalmacen=" + idalmacenC;
        String cadena = "php/Etapas.php?funcion=GuardarEditarEtapa&idetapa=" + idalmacenC;

        cadena = cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Actualizando el estado", "guardar");
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
                        //      MessageBox.alert("mensaje");

                            Utils.setErrorPrincipal(mensajeR, "mensaje");
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
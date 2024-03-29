/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.system;

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
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;

/**
 *
 * @author buggy
 */
public class EditarEmpleadoEstado extends Window {

    private final int ANCHO = 500;
    private final int ALTO = 250;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;

    private ComboBox com_estadoC;
 //   private ComboBox com_tipoEmpleado;
//    private Panel formpanel;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String idEmpleado;
   private String estado;
 
    private String estadoE;

    private String[] estadoM;
    private boolean nuevo;
    private Empleado padre;

    public EditarEmpleadoEstado(String idempleado,String estados, Empleado padre) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");
        this.idEmpleado = idempleado;
        this.estadoM = new String[]{"Activo", "Inactivo"};
        this.estado =estados;

        this.padre = padre;

        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Registrar nuevo";

        if (idEmpleado != null) {
            nombreBoton1 = "Modificar";
            tituloTabla = "Estado Empleado";
            nuevo = false;
        } else {
            this.idEmpleado = "nuevo";
            nuevo = true;

        }

        setId("win-Empleados");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
               GuardarEditarEmpleado();
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                EditarEmpleadoEstado.this.close();
                EditarEmpleadoEstado.this.setModal(false);
            //formulario = null;
            }
        });

        setTitle(tituloTabla);
        setAutoHeight(true);
        setAutoWidth(true);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        addButton(but_aceptarP);
        addButton(but_cancelarP);

        setCloseAction(Window.CLOSE);
        setPlain(true);
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");



     //    com_tienda = new ComboBox("Tienda", "tienda");
       // com_tipoEmpleado.setReadOnly(true);
        com_estadoC = new ComboBox("Estado", "estado");

com_estadoC.setValue(estado);





        formPanel.add(com_estadoC);

//
////        formPanel.add(com_estadoC, ANCHO_LAYOUT_DATA);



        add(formPanel);
      initCombos();
    //    initValues();
      //  addListenerskey();
    }

   private void initCombos() {


        SimpleStore estadosStore = new SimpleStore("estado", estadoM);
        estadosStore.load();
        com_estadoC.setDisplayField("estado");
        com_estadoC.setStore(estadosStore);


    }

  

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

   
    public void GuardarEditarEmpleado() {
       // String cadena = "php/Empleado.php?funcion=GuardarEditarEmpleado&idempleado=" + idEmpleado;
         String cadena = "php/Empleado.php?funcion=GuardarEstadoEmpleado&idempleado=" + idEmpleado;
        cadena = cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("cambiando estado...", "guardar");
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
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.cliente;

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
public class EditarNuevoClienteDetalle extends Window {

    private final int ANCHO = 500;
    private final int ALTO = 250;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private TextField tex_codigoC;
    private TextField tex_itemC;
    private TextField tex_nitC;
    private TextField tex_nombreC;
    private TextField tex_apellidoC;
    private TextField tex_telefonoC;
    private TextField tex_direccionC;
    private TextField tex_faxC;
    private ComboBox com_almacenC;
    private ComboBox com_tipoC;
    private ComboBox com_estadoC;
//    private Panel formpanel;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String idclienteC;
     private String idempresaC;
    private String nombreC;
    private String apellidoC;
    private String almacenC;
    private String nitC;
    private String itemC;
    private String telefonoC;
    private String direccionC;
    private String faxC;
    private String estadoC;
    private Object[][] AlmacenM;
    private Object[][] tipoM;
    private String[] estadoM;
    private boolean nuevo;
    private ClienteDetalle padre;

    public EditarNuevoClienteDetalle(String idcliente, String idempresa,String nombre,String apellido, String nit, String item, String telefono, String estado, String direccion, Object[][] almacenes, ClienteDetalle padre) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");
        this.idclienteC = idcliente;
        this.idempresaC = idempresa;
        this.nombreC = nombre;
        this.apellidoC = apellido;
        this.nitC = nit;
        this.itemC = item;
                this.telefonoC = telefono;
        this.direccionC = direccion;
        if (estado == null) {
            this.estadoC = "Activo";

        } else {
            this.estadoC = estado;
        }

//        this.tipoC = tipo;
//        this.tipoM = tipos;

        this.AlmacenM = almacenes;
        this.estadoM = new String[]{"Activo", "Inactivo"};


        this.padre = padre;

        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Registar nuevo Cliente";

        if (idclienteC != null) {
            nombreBoton1 = "Modificar";
            tituloTabla = "Editar Cliente";
            nuevo = false;
        } else {
            this.idclienteC = "nuevo";
            nuevo = true;

        }

        setId("win-Clientes");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                if (nuevo == false) {
                    GuardarEditarCliente();
                } else {
                    GuardarNuevoCliente();
                }
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                EditarNuevoClienteDetalle.this.close();
                EditarNuevoClienteDetalle.this.setModal(false);
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


        tex_itemC = new TextField("Item", "item",100);
        tex_nitC = new TextField("Nit /CI", "nit",100);

        tex_nombreC = new TextField("Nombre", "nombre",200);
        tex_apellidoC = new TextField("Apellido", "apellido",200);
        tex_telefonoC = new TextField("Telefono", "telefono",200);
        tex_direccionC = new TextField("Direccion", "direccion",200);
        com_almacenC = new ComboBox("Empresa", "empresa");
        com_estadoC = new ComboBox("Estado", "estado");


        formPanel.add(tex_nombreC);
        formPanel.add(tex_apellidoC);
        formPanel.add(tex_nitC);
        formPanel.add(tex_itemC);

        formPanel.add(com_almacenC);
//        formPanel.add(com_tipoC);
        formPanel.add(tex_telefonoC);
        formPanel.add(tex_direccionC);
          formPanel.add(com_estadoC);



        add(formPanel);
        initCombos();
        initValues();
    }


    private void initCombos() {

        com_almacenC.setValueField("idempresa");
        com_almacenC.setDisplayField("nombre");
        com_almacenC.setForceSelection(true);
        com_almacenC.setMinChars(1);
        com_almacenC.setMode(ComboBox.LOCAL);
        com_almacenC.setTriggerAction(ComboBox.ALL);
        com_almacenC.setEmptyText("Seleccione una empresa");
        com_almacenC.setLoadingText("Buscando");
        com_almacenC.setTypeAhead(true);
        com_almacenC.setSelectOnFocus(true);
        com_almacenC.setHideTrigger(false);
        com_almacenC.setReadOnly(true);
        SimpleStore proveedorStore = new SimpleStore(new String[]{"idempresa", "nombre"}, AlmacenM);
        proveedorStore.load();
        com_almacenC.setStore(proveedorStore);

        

        SimpleStore estadosStore = new SimpleStore("estados", estadoM);
        estadosStore.load();
        com_estadoC.setDisplayField("estados");
        com_estadoC.setStore(estadosStore);


    }

    private void initValues() {
        tex_nombreC.setValue(nombreC);
        tex_apellidoC.setValue(apellidoC);
        tex_nitC.setValue(nitC);
        tex_itemC.setValue(itemC);

        tex_telefonoC.setValue(telefonoC);
        tex_direccionC.setValue(direccionC);
        tex_faxC.setValue(faxC);
        com_almacenC.setValue(almacenC);
        com_estadoC.setValue(estadoC);


    }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

    public void GuardarNuevoCliente() {
        String cadena = "php/ClienteDetalle.php?funcion=insertnuevocliente";
        cadena =
                cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Guardando el nuevo Cliente", "guardar");
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

    public void GuardarEditarCliente() {
        String cadena = "php/ClienteDetalle.php?funcion=modificarcliente&idclienteempresa=" + idclienteC;
        cadena = cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Actualizando los cambios en Cliente", "guardar");
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
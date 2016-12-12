/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.cliente;

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
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import org.balderrama.client.sistemadetalle.PanelPedidoE;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;
import org.balderrama.client.venta.PanelVentaCaja;
import org.balderrama.client.venta.PanelVentaDetalle;

/**
 *
 * @author buggy
 */
public class EditarNuevoCliente extends Window {

    private final int ANCHO = 500;
    private final int ALTO = 250;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private TextField tex_codigoC;
    private TextField tex_nombreC;
    private TextField tex_apellidoC;
    private TextField tex_telefonoC;
    private TextField tex_direccionC;
    private TextField tex_faxC;
    private ComboBox com_almacenC;
   // private ComboBox com_tipoC;
    private ComboBox com_estadoC;
//    private Panel formpanel;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String idclienteC;
    private String nombreC;
    private String apellidoC;
    private String ciudadC;
    private String codigoC;
    private String tipoC;
    private String telefonoC;
    private String direccionC;
    private String faxC;
    private String estadoC;
    private Object[][] ciudadM;
   // private Object[][] tipoM;
    private String[] estadoM;
    private boolean nuevo;
//    private Cliente padre;
    private PanelVentaDetalle padre2;
    private PanelVentaCaja padre4;
     private PanelPedidoE padre3;
String codigocliente;
//por cajas venta
public EditarNuevoCliente(String idcliente, String nombre, String apellido, String codigo, String tipo, String ciudad, String telefono, String fax, String estado, String direccion, Object[][] almacenes, PanelVentaCaja padred) {

          this.idclienteC = idcliente;
         this.padre4 =padred;
        this.codigoC = codigo;
        this.nombreC = nombre;
        this.apellidoC = apellido;
        this.ciudadC = ciudad;
        this.telefonoC = telefono;
        this.faxC = fax;
        this.direccionC = direccion;
        if (estado == null) {
            this.estadoC = "Activo";

        } else {
            this.estadoC = estado;
        }

        this.ciudadM = almacenes;
        this.estadoM = new String[]{"Activo", "Inactivo"};

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
                    //GuardarNuevoCliente2();
                              String vendedor = tex_codigoC.getValueAsString();
                    String cliente = tex_nombreC.getValueAsString();
                     String boleta = tex_apellidoC.getValueAsString();

    if ((!boleta.isEmpty()) && (!cliente.isEmpty())&& (!vendedor.isEmpty())) {
                  GuardarNuevoCliente2caja();
     } else {
             MessageBox.alert("Asigne Codigo Nombre y Apellido es obligatorio,revise los campos ");
                }
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                EditarNuevoCliente.this.close();
                EditarNuevoCliente.this.setModal(false);
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
        tex_codigoC = new TextField("Codigo", "codigo", 100);
        tex_codigoC.setMaxLength(6);
        tex_codigoC.setAllowBlank(false);

        tex_nombreC = new TextField("Nombre", "nombre", 200);
        tex_apellidoC = new TextField("Apellido", "apellido", 200);
        tex_telefonoC = new TextField("Telefono", "telefono", 200);
        tex_direccionC = new TextField("Direccion", "direccion", 200);
        tex_faxC = new TextField("Fax", "fax", 200);
        com_almacenC = new ComboBox("Ciudad", "ciudad");
        com_estadoC = new ComboBox("Estado", "estado");
        formPanel.add(tex_codigoC);
        formPanel.add(tex_nombreC);
        formPanel.add(tex_apellidoC);
        formPanel.add(com_almacenC);
       // formPanel.add(com_tipoC);
        formPanel.add(tex_telefonoC);
        formPanel.add(tex_direccionC);
        formPanel.add(tex_faxC);
        add(formPanel);
        initCombos();
        initValues();
    }

   
//deade ingreso
  public EditarNuevoCliente(String idcliente, String nombre, String apellido, String codigo, String tipo, String ciudad, String telefono, String fax, String estado, String direccion, Object[][] almacenes, PanelPedidoE padred) {
         this.idclienteC = idcliente;
         this.padre3 =padred;
        this.codigoC = codigo;
        this.nombreC = nombre;
        this.apellidoC = apellido;
        this.ciudadC = ciudad;
        this.telefonoC = telefono;
        this.faxC = fax;
        this.direccionC = direccion;
        if (estado == null) {
            this.estadoC = "Activo";

        } else {
            this.estadoC = estado;
        }

        this.ciudadM = almacenes;
        this.estadoM = new String[]{"Activo", "Inactivo"};

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
                  //  GuardarNuevoCliente3();
                              String vendedor = tex_codigoC.getValueAsString();
                    String cliente = tex_nombreC.getValueAsString();
                     String boleta = tex_apellidoC.getValueAsString();

    if ((!boleta.isEmpty()) && (!cliente.isEmpty())&& (!vendedor.isEmpty())) {
                  GuardarNuevoCliente3();
     } else {
             MessageBox.alert("Asigne Codigo Nombre y Apellido es obligatorio,revise los campos ");
                }
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                EditarNuevoCliente.this.close();
                EditarNuevoCliente.this.setModal(false);
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
        tex_codigoC = new TextField("Codigo", "codigo", 100);
        tex_codigoC.setMaxLength(6);
        tex_nombreC = new TextField("Nombre", "nombre", 200);
        tex_apellidoC = new TextField("Apellido", "apellido", 200);
        tex_telefonoC = new TextField("Telefono", "telefono", 200);
        tex_direccionC = new TextField("Direccion", "direccion", 200);
        tex_faxC = new TextField("Fax", "fax", 200);
        com_almacenC = new ComboBox("Ciudad", "ciudad");
        com_estadoC = new ComboBox("Estado", "estado");
        formPanel.add(tex_codigoC);
        formPanel.add(tex_nombreC);
        formPanel.add(tex_apellidoC);
        formPanel.add(com_almacenC);
       // formPanel.add(com_tipoC);
        formPanel.add(tex_telefonoC);
        formPanel.add(tex_direccionC);
        formPanel.add(tex_faxC);
        add(formPanel);
        initCombos();
        initValues();
    }

      public EditarNuevoCliente(String idcliente, String nombre, String apellido, String codigo, String tipo, String ciudad, String telefono, String fax, String estado, String direccion, Object[][] almacenes, PanelVentaDetalle padred) {
      //desde panel venta
          this.idclienteC = idcliente;
         this.padre2 =padred;
        this.codigoC = codigo;
        this.nombreC = nombre;
        this.apellidoC = apellido;
        this.ciudadC = ciudad;
        this.telefonoC = telefono;
        this.faxC = fax;
        this.direccionC = direccion;
        if (estado == null) {
            this.estadoC = "Activo";

        } else {
            this.estadoC = estado;
        }

        this.ciudadM = almacenes;
        this.estadoM = new String[]{"Activo", "Inactivo"};

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
                    //GuardarNuevoCliente2();
                              String vendedor = tex_codigoC.getValueAsString();
                    String cliente = tex_nombreC.getValueAsString();
                     String boleta = tex_apellidoC.getValueAsString();

    if ((!boleta.isEmpty()) && (!cliente.isEmpty())&& (!vendedor.isEmpty())) {
                  GuardarNuevoCliente2();
     } else {
             MessageBox.alert("Asigne Codigo Nombre y Apellido es obligatorio,revise los campos ");
                }
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                EditarNuevoCliente.this.close();
                EditarNuevoCliente.this.setModal(false);
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
        tex_codigoC = new TextField("Codigo", "codigo", 100);
        tex_codigoC.setMaxLength(6);
        tex_codigoC.setAllowBlank(false);
        
        tex_nombreC = new TextField("Nombre", "nombre", 200);
        tex_apellidoC = new TextField("Apellido", "apellido", 200);
        tex_telefonoC = new TextField("Telefono", "telefono", 200);
        tex_direccionC = new TextField("Direccion", "direccion", 200);
        tex_faxC = new TextField("Fax", "fax", 200);
        com_almacenC = new ComboBox("Ciudad", "ciudad");
        com_estadoC = new ComboBox("Estado", "estado");
        formPanel.add(tex_codigoC);
        formPanel.add(tex_nombreC);
        formPanel.add(tex_apellidoC);
        formPanel.add(com_almacenC);
       // formPanel.add(com_tipoC);
        formPanel.add(tex_telefonoC);
        formPanel.add(tex_direccionC);
        formPanel.add(tex_faxC);
        add(formPanel);
        initCombos();
        initValues();
    }

//    public EditarNuevoCliente(String idcliente, String nombre, String apellido, String codigo, String tipo, String ciudad, String telefono, String fax, String estado, String direccion, Object[][] almacenes, Cliente padre) {
//         this.idclienteC = idcliente;
//        this.codigoC = codigo;
//        this.nombreC = nombre;
//        this.apellidoC = apellido;
//        this.ciudadC = ciudad;
//        this.telefonoC = telefono;
//        this.faxC = fax;
//        this.direccionC = direccion;
//        if (estado == null) {
//            this.estadoC = "Activo";
//
//        } else {
//            this.estadoC = estado;
//        }
//
//        this.tipoC = tipo;
//       // this.tipoM = tipos;
//
//        this.ciudadM = almacenes;
//        this.estadoM = new String[]{"Activo", "Inactivo"};
//
//
//        this.padre = padre;
//
//        String nombreBoton1 = "Guardar";
//        String nombreBoton2 = "Cancelar";
//        String tituloTabla = "Registar nuevo Cliente";
//
//        if (idclienteC != null) {
//            nombreBoton1 = "Modificar";
//            tituloTabla = "Editar Cliente";
//            nuevo = false;
//        } else {
//            this.idclienteC = "nuevo";
//            nuevo = true;
//
//        }
//
//        setId("win-Clientes");
//        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {
//
//            @Override
//            public void onClick(Button button, EventObject e) {
//                if (nuevo == false) {
//                  //  GuardarEditarCliente();
//                } else {
//                           String vendedor = tex_codigoC.getValueAsString();
//                    String cliente = tex_nombreC.getValueAsString();
//                     String boleta = tex_apellidoC.getValueAsString();
//
//    if ((!boleta.isEmpty()) && (!cliente.isEmpty())&& (!vendedor.isEmpty())) {
//                  GuardarNuevoCliente();
//     } else {
//             MessageBox.alert("Asigne Codigo Nombre y Apellido es obligatorio,revise los campos ");
//                }
//              }
//
//                }
//
//        });
//        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {
//
//            @Override
//            public void onClick(Button button, EventObject e) {
//                EditarNuevoCliente.this.close();
//                EditarNuevoCliente.this.setModal(false);
//            //formulario = null;
//            }
//        });
//
//        setTitle(tituloTabla);
//        setAutoWidth(true);
//        setAutoHeight(true);
//        setLayout(new FitLayout());
//        setPaddings(WINDOW_PADDING);
//        setButtonAlign(Position.CENTER);
//        addButton(but_aceptarP);
//        addButton(but_cancelarP);
//
//        setCloseAction(Window.CLOSE);
//        setPlain(true);
//        formPanel = new FormPanel();
//        formPanel.setBaseCls("x-plain");
//
//
//        tex_codigoC = new TextField("Codigo", "codigo", 100);
//        tex_codigoC.setMaxLength(6);
//        tex_nombreC = new TextField("Nombre", "nombre", 200);
//        tex_apellidoC = new TextField("Apellido", "apellido", 200);
//        tex_telefonoC = new TextField("Telefono", "telefono", 200);
//        tex_direccionC = new TextField("Direccion", "direccion", 200);
//        tex_faxC = new TextField("Fax", "fax", 200);
//
//
//
//        com_almacenC = new ComboBox("Ciudad", "ciudad");
//       // com_tipoC = new ComboBox("Tipo", "tipo");
//        com_estadoC = new ComboBox("Estado", "estado");
//
//
//        formPanel.add(tex_codigoC);
//        formPanel.add(tex_nombreC);
//        formPanel.add(tex_apellidoC);
//        formPanel.add(com_almacenC);
//       // formPanel.add(com_tipoC);
//        formPanel.add(tex_telefonoC);
//        formPanel.add(tex_direccionC);
//        formPanel.add(tex_faxC);
////        formPanel.add(com_estadoC);
//
//
//
//        add(formPanel);
//        initCombos();
//        initValues();
//    }

    private void initCombos() {

        com_almacenC.setValueField("idciudad");
        com_almacenC.setDisplayField("nombre");
        com_almacenC.setForceSelection(true);
        com_almacenC.setMinChars(1);
        com_almacenC.setMode(ComboBox.LOCAL);
        com_almacenC.setTriggerAction(ComboBox.ALL);
        com_almacenC.setEmptyText("Seleccione una Ciudad");
        com_almacenC.setLoadingText("Buscando");
        com_almacenC.setTypeAhead(true);
        com_almacenC.setSelectOnFocus(true);
        com_almacenC.setHideTrigger(false);
        com_almacenC.setReadOnly(true);
        SimpleStore proveedorStore = new SimpleStore(new String[]{"idciudad", "nombre"}, ciudadM);
        proveedorStore.load();
        com_almacenC.setStore(proveedorStore);

        SimpleStore estadosStore = new SimpleStore("estados", estadoM);
        estadosStore.load();
        com_estadoC.setDisplayField("estados");
        com_estadoC.setStore(estadosStore);


    }

    private void initValues() {
        tex_codigoC.setValue(codigoC);
        tex_nombreC.setValue(nombreC);
        tex_apellidoC.setValue(apellidoC);
        tex_telefonoC.setValue(telefonoC);
        tex_direccionC.setValue(direccionC);
        tex_faxC.setValue(faxC);
       // com_tipoC.setValue(tipoC);
        com_almacenC.setValue(ciudadC);
        com_estadoC.setValue(estadoC);


    }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

//    public void GuardarNuevoCliente() {
//        String cadena = "php/Cliente.php?funcion=GuardarNuevoCliente";
//        cadena =
//                cadena + "&" + formPanel.getForm().getValues();
//        final Conector conec = new Conector(cadena, false);
//        Utils.setErrorPrincipal("Guardando el nuevo Cliente", "guardar");
//        try {
//            conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
//
//                public void onResponseReceived(Request request, Response response) {
//                    String data = response.getText();
//                    JSONValue jsonValue = JSONParser.parse(data);
//                    JSONObject jsonObject;
//
//                    if ((jsonObject = jsonValue.isObject()) != null) {
//                        String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
//                        String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
//                        if (errorR.equalsIgnoreCase("true")) {
//                            Utils.setErrorPrincipal(mensajeR, "mensaje");
//                            close();
//
//                            padre.reload();
//                        } else {
//                            Utils.setErrorPrincipal(mensajeR, "error");
//                        }
//
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
//
//    }
public void GuardarNuevoCliente2() {
        String cadena = "php/Cliente.php?funcion=GuardarNuevoCliente";
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
                           codigocliente = Utils.getStringOfJSONObject(jsonObject, "resultado");
                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                            close();
//recargarlistaenventa();
                         //   padre2.reload();

                            padre2.com_cliente.setValue(codigocliente);
                        } else {
 codigocliente = Utils.getStringOfJSONObject(jsonObject, "resultado");
                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                            close();
//recargarlistaenventa();
                         //   padre2.reload();

                            padre2.com_cliente.setValue(codigocliente);
                           // Utils.setErrorPrincipal(mensajeR, "error");
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
public void GuardarNuevoCliente2caja() {
        String cadena = "php/Cliente.php?funcion=GuardarNuevoCliente";
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
                           codigocliente = Utils.getStringOfJSONObject(jsonObject, "resultado");
                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                            close();
//recargarlistaenventa();
                         //   padre2.reload();

                            padre4.com_cliente.setValue(codigocliente);
                        } else {
 codigocliente = Utils.getStringOfJSONObject(jsonObject, "resultado");
                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                            close();
//recargarlistaenventa();
                         //   padre2.reload();

                            padre4.com_cliente.setValue(codigocliente);
                           // Utils.setErrorPrincipal(mensajeR, "error");
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
public void GuardarNuevoCliente3() {
        String cadena = "php/Cliente.php?funcion=GuardarNuevoClienteIngreso";
      //  String cadena = "php/Cliente.php?funcion=GuardarNuevoCliente";
       
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
                           codigocliente = Utils.getStringOfJSONObject(jsonObject, "resultado");
                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                            close();
//recargarlistaenventa();
                         //   padre2.reload();
                            padre3.com_cliente.setValue(codigocliente);
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

//    public void GuardarEditarCliente() {
//        String cadena = "php/Cliente.php?funcion=GuardarEditarCliente&idcliente=" + idclienteC;
//        cadena = cadena + "&" + formPanel.getForm().getValues();
//        final Conector conec = new Conector(cadena, false);
//        Utils.setErrorPrincipal("Actualizando los cambios en Cliente", "guardar");
//        try {
//            conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
//
//                public void onResponseReceived(Request request, Response response) {
//                    String data = response.getText();
//                    JSONValue jsonValue = JSONParser.parse(data);
//                    JSONObject jsonObject;
//
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
//
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
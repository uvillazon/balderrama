/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.configuracion;

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
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import org.balderrama.client.marca.Marca;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;

/**
 *
 * @author buggy
 */
public class NuevaColeccionForm extends Window {

    private final int ANCHO = 500;
    private final int ALTO = 250;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private TextField tex_codigo;
     private TextField tex_marca;
    private TextField tex_codigobarra;
    private TextArea tex_detalle;
//    private TextField tex_direccionC;
//    private TextField tex_faxC;
    private ComboBox com_anio;
    private ComboBox com_marca;
//    private ComboBox com_tipoC;
    private ComboBox com_estado;
//    private Panel formpanel;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String idcoleccion;
    private String detalle;
    private String codigo;
    private String anio;
    private String nombre;
     private String nombremarca;
     private String estadof;
    
//    private String estadoC;
    private Object[][] marcaM;
    private Object[][] anioM;
//    private Object[][] tipoM;
    private String estado;
    private String[] estadoM;
    private boolean nuevo;
    private Coleccion padre;
     private Marca padre1;
     private String[] clienteM;
       private ComboBox com_cliente;

  public NuevaColeccionForm(String idcoleccion, String codigo, String detalle, String idmarca, String anio,String nombremarcaw,Object[][] marcas,Object[][] anios,String estadoM, Marca padre1) {

   // public NuevaColeccionForm(Object object, String string, String string0, String idmarca, String string1, Object[][] marca, Object[][] anio, String string2, MarcaDetalle padre1) {
       //com.google.gwt.user.client.Window.alert("Cuantas veces");
        this.idcoleccion = idcoleccion;
        this.codigo = codigo;
        this.detalle = detalle;
        this.anio = anio;
        this.nombre = idmarca;
        this.nombremarca = nombremarcaw;
        this.clienteM = new String[]{"VIGENTE", "PASADO"};
        this.estadof = estadoM;

        this.marcaM = marcas;
        this.anioM = anios;
//        this.estadoM = new String[]{"Activo", "Inactivo"};

        this.padre1 = padre1;

        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Registrar nueva Coleccion";

        if (idcoleccion != null) {
            nombreBoton1 = "Modificar";
            tituloTabla = "Editar Coleccion";
            nuevo = false;
        } else {
            this.idcoleccion = "nuevo";
            nuevo = true;

        }

        setId("win-Coleccion");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                if (nuevo == false) {
                    GuardarEditarColeccion();
                } else {
                    GuardarNuevacoleccion();
                }
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                NuevaColeccionForm.this.close();
                NuevaColeccionForm.this.setModal(false);
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

 tex_marca = new TextField("Marca", "marca",50);
      tex_marca.setValue(nombremarca);
      tex_marca.setReadOnly(true);
        tex_codigo = new TextField("# Coleccion", "codigo",50);
        tex_codigo.setMaxLength(3);
        tex_codigo.focus();
        tex_detalle = new TextArea("Detalle", "detalle");
        tex_detalle.setWidth(200);
        tex_detalle.setHeight(50);
        //        tex_direccionC = new TextField("Direccion", "direccion");
//        tex_faxC = new TextField("Fax", "fax");
        com_anio = new ComboBox("Anio", "anio", 100);
        com_marca = new ComboBox("Marca", "idmarca",100);
        com_marca.setEditable(false);
com_cliente = new ComboBox("Estado", "estado", 200);
       // com_cliente.setValue("VIGENTE");
        com_cliente.setReadOnly(true);
        formPanel.add(tex_marca);
        formPanel.add(tex_codigo);

        //formPanel.add(com_estado, ANCHO_LAYOUT_DATA);
        formPanel.add(com_anio);
        formPanel.add(com_marca);
 formPanel.add(com_cliente);

        //        formPanel.add(com_tipoC, ANCHO_LAYOUT_DATA);
        formPanel.add(tex_detalle);
//
        add(formPanel);
        initCombos();
        initValues();
        addListeners();
    }


    public NuevaColeccionForm(String idcoleccion, String codigo, String detalle, String idmarca, String anio,Object[][] marcas,Object[][] anios,String estadoM, Coleccion padre) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");
        this.idcoleccion = idcoleccion;
        this.codigo = codigo;
        this.detalle = detalle;
        this.anio = anio;
        this.nombre = idmarca;
        this.clienteM = new String[]{"VIGENTE", "PASADO"};
        this.estadof = estadoM;

        this.marcaM = marcas;
        this.anioM = anios;
//        this.estadoM = new String[]{"Activo", "Inactivo"};

        this.padre = padre;

        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Registrar nueva Coleccion";

        if (idcoleccion != null) {
            nombreBoton1 = "Modificar";
            tituloTabla = "Editar Coleccion";
            nuevo = false;
        } else {
            this.idcoleccion = "nuevo";
            nuevo = true;

        }

        setId("win-Coleccion");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                if (nuevo == false) {
                    GuardarEditarColeccion();
                } else {
                    GuardarNuevacoleccion();
                }
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                NuevaColeccionForm.this.close();
                NuevaColeccionForm.this.setModal(false);
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
        

        tex_codigo = new TextField("# Coleccion", "codigo",50);
        tex_codigo.setMaxLength(3);
        tex_codigo.focus();
        tex_detalle = new TextArea("Detalle", "detalle");
        tex_detalle.setWidth(200);
        tex_detalle.setHeight(50);
        //        tex_direccionC = new TextField("Direccion", "direccion");
//        tex_faxC = new TextField("Fax", "fax");
        com_anio = new ComboBox("Anio", "anio", 100);
        com_marca = new ComboBox("Marca", "idmarca",100);
com_cliente = new ComboBox("Estado", "estado", 200);
       // com_cliente.setValue("VIGENTE");
        com_cliente.setReadOnly(true);
      
        formPanel.add(tex_codigo);
        
        //formPanel.add(com_estado, ANCHO_LAYOUT_DATA);
        formPanel.add(com_anio);
        formPanel.add(com_marca);
 formPanel.add(com_cliente);

        //        formPanel.add(com_tipoC, ANCHO_LAYOUT_DATA);
        formPanel.add(tex_detalle);
//      
        add(formPanel);
        initCombos();
        initValues();
        addListeners();
    }

  private void addListeners() {
           tex_codigo.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                  com_anio.focus();

                }
            }

        });

  com_anio.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                  com_cliente.focus();         }
            }
        });
         com_cliente.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                  tex_detalle.focus();         }
            }
        });

    }


    private void initCombos() {

        SimpleStore tiposStore = new SimpleStore("estado", clienteM);
        tiposStore.load();
        com_cliente.setDisplayField("estado");
        com_cliente.setStore(tiposStore);





        com_anio.setValueField("anio");
        com_anio.setDisplayField("anio");
        com_anio.setForceSelection(true);
        com_anio.setMinChars(1);
        com_anio.setMode(ComboBox.LOCAL);
        com_anio.setFieldLabel("anio");

       // com_anio.setTriggerAction(ComboBox.ALL);

        com_anio.setEmptyText("Seleccione un Anio");
        com_anio.setLoadingText("Buscando");
        com_anio.setTypeAhead(true);
        com_anio.setSelectOnFocus(true);
        com_anio.setHideTrigger(true);
       // com_anio.setReadOnly(true);
        SimpleStore proveedorStore = new SimpleStore(new String[]{"anio","anio"}, anioM);
        proveedorStore.load();
        com_anio.setStore(proveedorStore);

        //marca
        com_marca.setValueField("idmarca");
        com_marca.setDisplayField("nombre");
        com_marca.setForceSelection(false);
        com_marca.setMinChars(1);
        com_marca.setMode(ComboBox.LOCAL);
        com_marca.setTriggerAction(ComboBox.ALL);
        com_marca.setEmptyText("Seleccione una marca");
        com_marca.setLoadingText("Buscando");
        com_marca.setTypeAhead(true);
        com_marca.setSelectOnFocus(true);
        com_marca.setHideTrigger(false);
        com_marca.setReadOnly(true);
      
        SimpleStore proveedorStore1 = new SimpleStore(new String[]{"idmarca","nombre"}, marcaM);
        proveedorStore1.load();
        com_marca.setStore(proveedorStore1);
        //estado

//        SimpleStore proveedorStore2 = new SimpleStore(estado, estadoM);
//        proveedorStore2.load();
//         com_estado.setDisplayField("Coleccion");
//         com_estado.setStore(proveedorStore2);
//       
    }

    private void initValues(){
        tex_codigo.setValue(codigo);
         tex_codigo.focus();
        tex_detalle.setValue(detalle);
//   
        com_anio.setValue(anio);
        com_marca.setValue(nombre);
         com_cliente.setValue(estadof);

        //com_estado.setValue("seleccione");
//        com_estadoC.setValue(estadoC);


    }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

    public void GuardarNuevacoleccion() {
        //String cadena = "php/Coleccion.php?funcion=GuardarNuevaColeccion";
        String cadena = "php/Coleccion.php?funcion=GuardarNuevaColeccion";
        cadena =
                cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Guardando el nueva Coleccion", "guardar");
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
                              padre1.reload();

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

    public void GuardarEditarColeccion() {
        String cadena = "php/Coleccion.php?funcion=GuardarEditarColeccion&idcoleccion=" + idcoleccion;
        cadena = cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Actualizando los cambios en Coleccion", "guardar");
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
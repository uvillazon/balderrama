/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package org.balderrama.client.system;

/**
 *
 * @author miguel
 */
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.google.gwt.user.client.ui.ClickListener;
import com.google.gwt.user.client.ui.KeyboardListenerAdapter;
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
import com.gwtext.client.widgets.form.Hidden;
import com.gwtext.client.widgets.form.TextArea;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.BorderLayout;
import com.gwtext.client.widgets.layout.BorderLayoutData;
import com.gwtext.client.widgets.layout.HorizontalLayout;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.layout.VerticalLayout;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.layout.TableLayout;
import com.gwtext.client.widgets.layout.TableLayoutData;
import com.gwtext.client.core.RegionPosition;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import org.balderrama.client.marca.Marca;
import org.balderrama.client.emergentes.FormularioSeleccionarModelo;
import org.balderrama.client.emergentes.FormularioSeleccionarColor;
import org.balderrama.client.emergentes.FormularioSeleccionarMaterial;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;
//import org.balderrama.client.util.EventoColor;
import org.balderrama.client.beans.Modelo;
import org.balderrama.client.beans.Color;
import org.balderrama.client.beans.Material;

public class NuevoCalzadoForm extends Window {

private final int ANCHO = 550;
    private final int ALTO = 300;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private FormPanel formPanelEtapas;

    boolean respuesta = false;
//    private TextField tex_codigoM;
    private TextField tex_modelo;
    private TextField tex_marca;
    private TextField tex_imagen;

    //text field color
    private TextField tex_color;
    private TextField tex_color1;
    private TextField tex_color2;
    private TextField tex_color3;
    private TextField tex_color4;
    private TextField tex_color5;
    //text field material
    private TextField tex_material;
    private TextField tex_material1;
    private TextField tex_material2;
    private TextField tex_material3;
    private TextField tex_material4;
    private TextField tex_material5;

//    private TextField tex_codigobarraM;
    //private TextArea tex_descripcion;
    private Button but_aceptarP;
    private Button but_cancelarP;

    Modelo modeloSeleccionado;
    Color colorSeleccionado;
    Material materialSeleccionado;
    EventoColor evento;
    EventoColor evento1;
    EventoColor evento2;
    EventoColor evento3;
    EventoColor evento4;
    EventoColor evento5;

    EventoMaterial event;
    EventoMaterial event1;
    EventoMaterial event2;
    EventoMaterial event3;
    EventoMaterial event4;
    EventoMaterial event5;

    private String idestiloM;
    private String nombreM;
    private String idcolor;
    private String idcolor1;
    private String idcolor2;
    private String idcolor3;
    private String idcolor4;
    private String idcolor5;
    private String idmaterial;
    private String idmaterial1;
    private String idmaterial2;
    private String idmaterial3;
    private String idmaterial4;
    private String idmaterial5;

    private String codigobarraM;
//    private String codigoM;
    private String descripcionM;
    private String mostrar;
    private Object[][] tallasM;
    private boolean nuevo;
    private Estilo padre;

    public NuevoCalzadoForm() {

        this.idestiloM = idestiloM;
//        this.nombreM = nombreM;
//        this.descripcionM = descripcionM;
//        this.tallasM = tallas;
//        this.padre = padre;

        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Registar Nuevo Calzado";

        if (idestiloM != null) {
            nombreBoton1 = "Modificar";
            tituloTabla = "Registro Nuevo Calzado";
            nuevo = false;
        } else {
            nuevo = true;
        }
        

        setId("win-Nuevo Calzados");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                if (nuevo == false) {
                    GuardarEditarCalzado();
                } else {
                    GuardarNuevoCalzado();
                }
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                NuevoCalzadoForm.this.close();
                NuevoCalzadoForm.this.setModal(false);
            //formulario = null;
            }
        });

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
        formPanel.setLabelWidth(ANCHO - 400 - 50);
        formPanel.setWidth(ANCHO);
        formPanel.setHeight(ALTO);


        tex_modelo = new TextField("Modelo","idmodelo");
        tex_modelo.setWidth(150);
        formPanel.add(tex_modelo);

        tex_marca = new TextField("Marca","idmarca");
        tex_marca.setWidth(150);
        formPanel.add(tex_marca);

        tex_imagen = new TextField(" Path Imagen","imagen");
        tex_imagen.setWidth(150);
        formPanel.add(tex_imagen);

        initcrearFielsetsColor();
        initcrearFielsetsMaterial();
        add(formPanel);

        initValues();
        addListeners();
        //eventos de los campos colores
        evento =new  EventoColor(0);
        evento1 =new EventoColor(1);
        evento2 =new EventoColor(2);
        evento3 =new EventoColor(3);
        evento4 =new EventoColor(4);
        evento5 =new EventoColor(5);
        tex_color.addListener(evento);
        tex_color1.addListener(evento1);
        tex_color2.addListener(evento2);
        tex_color3.addListener(evento3);
        tex_color4.addListener(evento4);
        tex_color5.addListener(evento5);
        //eventos de los campos de material
        event =new  EventoMaterial(0);
        event1 =new EventoMaterial(1);
        event2 =new EventoMaterial(2);
        event3 =new EventoMaterial(3);
        event4 =new EventoMaterial(4);
        event5 =new EventoMaterial(5);
        tex_material.addListener(event);
        tex_material1.addListener(event1);
        tex_material2.addListener(event2);
        tex_material3.addListener(event3);
        tex_material4.addListener(event4);
        tex_material5.addListener(event5);
    }

//
    private void initcrearFielsetsColor() {

        Panel root = new Panel();
        root.setLayout(new TableLayout(2));
        //root.setLabelWidth(20);
        root.setBaseCls("x-plain");
        root.setHeight(90);
        root.setPaddings(5);

        FieldSet field = new FieldSet("Color");
        field.setId("color-1");
        field.setLabelWidth(5);

        Panel uno =new Panel();
        uno.setBaseCls("x-plain");
        uno.setWidth(400);
        uno.setPaddings(5);
        
        
        //uno.setLabelWidth(100);
        tex_color = new TextField("idcolor","idcolor");
        //tex_color.setReadOnly(true);
        tex_color.setValue(idcolor);
        tex_color1 = new TextField("idcolor1","idcolor1");
        //tex_color1.setReadOnly(true);
        tex_color1.setValue(idcolor1);
        tex_color2 = new TextField("idcolor2","idcolor2");
        //tex_color2.setReadOnly(true);
        tex_color2.setValue(idcolor2);
        uno.add(tex_color);
        uno.add(tex_color1);
        uno.add(tex_color2);

        Panel dos =new Panel();
        dos.setBaseCls("x-plain");
        dos.setPaddings(5);
        dos.setWidth(400);
        //dos.setLabelWidth(10);

        tex_color3 = new TextField("idcolor3","idcolor3");
        tex_color3.setReadOnly(true);
        tex_color3.setValue(idcolor3);
        tex_color4 = new TextField("idcolor4","idcolor4");
        tex_color4.setReadOnly(true);
        tex_color4.setValue(idcolor4);
        tex_color5 = new TextField("idcolor5","idcolor5");
        tex_color5.setReadOnly(true);
        tex_color5.setValue(idcolor5);
        dos.add(tex_color3);
        dos.add(tex_color4);
        dos.add(tex_color5);

       //add
        field.add(uno);
        field.add(dos);
        root.add(field);
        formPanel.add(field);
               
    }

    private void initcrearFielsetsMaterial() {

        Panel root1 = new Panel();
        root1.setBaseCls("x-plain");
        root1.setId("root");
        root1.setLayout(new TableLayout(2));
        root1.setHeight(90);
        root1.setPaddings(5);

        FieldSet field = new FieldSet("Material");
        field.setId("material-1");

        Panel tres =new Panel();
        tres.setBaseCls("x-plain");
        tres.setPaddings(5);
        tres.setWidth(400);
        tex_material = new TextField("idmaterial","idmaterial");
        tex_material.setReadOnly(true);
        tex_material.setValue(idmaterial);
        tex_material1 = new TextField("idmaterial1","idmaterial1");
        tex_material1.setReadOnly(true);
        tex_material1.setValue(idmaterial1);
        tex_material2 = new TextField("idmaterial2","idmaterial2");
        tex_material2.setReadOnly(true);
        tex_material2.setValue(idmaterial2);
        tres.add(tex_material);
        tres.add(tex_material1);
        tres.add(tex_material2);

        Panel cuatro =new Panel();
        cuatro.setBaseCls("x-plain");
        cuatro.setPaddings(5);
        cuatro.setWidth(400);
        tex_material3 = new TextField("idmaterial3","idmaterial3");
        tex_material3.setReadOnly(true);
        tex_material3.setValue(idmaterial3);
        tex_material4 = new TextField("idmaterial4","idmaterial4");
        tex_material4.setReadOnly(true);
        tex_material4.setValue(idmaterial4);
        tex_material5 = new TextField("idmaterial5","idmaterial5");
        tex_material5.setReadOnly(true);
        tex_material5.setValue(idmaterial5);
        cuatro.add(tex_material3);
        cuatro.add(tex_material4);
        cuatro.add(tex_material5);

        field.add(tres);
        field.add(cuatro);
        root1.add(field);
        //pan_checks = null;
        formPanel.add(field);
    }

    private void initValues() {
        
//        tex_codigoM.setValue(codigoM);
        //tex_nombreM.setValue(nombreM);
//        tex_codigobarraM.setValue(codigobarraM);
        //tex_descripcion.setValue(descripcionM);
    }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

    public void GuardarNuevoCalzado() {
        String cadena = "php/GuardarCalzado.php?funcion=GuardarCalzado";
        cadena = cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Guardando el nuevo calzado", "guardar");
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

    public void GuardarEditarCalzado() {
//        String cadena = "php/Estilo.php?funcion=GuardarEditarEstilo&idestilo=" + idestiloM;
//        cadena =
//                cadena + "&" + formPanel.getForm().getValues();
//        final Conector conec = new Conector(cadena, false);
//        Utils.setErrorPrincipal("Actualizando los cambios en Estilos", "guardar");
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
    }
 private void addListeners() {

       //eventos de text_modelo
     tex_modelo.addListener(new TextFieldListenerAdapter() {

            private FormularioSeleccionarModelo for_modelo;

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    // abrir la lsita de productos for_proveedor
                    //MessageBox.alert(field.getValueAsString());
                    String codigoProveedor = field.getValueAsString().trim();
                    if (codigoProveedor.isEmpty() || findByCodigoProveedor(codigoProveedor)) {
                        if (for_modelo == null || for_modelo.isHidden()) {
                            //MessageBox.alert("evento ingreso");
                            showListProveedor();
                        } else {
                            //MessageBox.alert("evento no ingreso");
                            for_modelo.onFocus();

                        }

                    }
                }
            }

            private void addListenerFormularioSeleccionarModelo() {
                for_modelo.getLayout().getBut_aceptar().addListener(new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        openFormularioModelo(for_modelo);
                    }
                });
            }

            private boolean findByCodigoProveedor(final String codigoBuscado) {
                respuesta = false;
                String enlace = "php/Modelo.php?funcion=BuscarLineaColeccionMarcaPorId&idmodelo=" + codigoBuscado;
                Utils.setErrorPrincipal("Cargando parametros del modelo", "cargar");
                final Conector conec = new Conector(enlace, false);

                try {
                    conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        private String idmodelo;
                        private String idmarca;
                        private String idcoleccion;
                        private String marca;
                        private String detalle;
                        

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;

                            if ((jsonObject = jsonValue.isObject()) != null) {
                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
                                    JSONValue proveedorValue = jsonObject.get("resultado");
                                    JSONObject proveedorObject;

                                    if ((proveedorObject = proveedorValue.isObject()) != null) {

                                        idmodelo = Utils.getStringOfJSONObject(proveedorObject, "idmodelo");
                                        idmarca = Utils.getStringOfJSONObject(proveedorObject, "idmarca");
                                        idcoleccion = Utils.getStringOfJSONObject(proveedorObject, "idcoleccion");
                                        marca = Utils.getStringOfJSONObject(proveedorObject, "marca");
                                        detalle = Utils.getStringOfJSONObject(proveedorObject, "detalle");
//                                        fax = Utils.getStringOfJSONObject(proveedorObject, "fax");
//                                        paginaWeb = Utils.getStringOfJSONObject(proveedorObject, "paginaweb");

                                        modeloSeleccionado =new Modelo(idmodelo,idmarca,idcoleccion,marca,detalle);

                                        tex_modelo.setValue(modeloSeleccionado.getIdmodelo());
                                        tex_marca.setValue(modeloSeleccionado.getIdmarca());
                                        //tex_producto.focus();
                                        respuesta =true;
                                    } else {
                                        resetCamposModelo();

                                        Utils.setErrorPrincipal("No se recuperaron correctamente lo valores de modelo", "error");
                                    }

                                } else {
                                    resetCamposModelo();

                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }

                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            resetCamposModelo();

                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");

                        }
                    });

                } catch (RequestException ex) {
                    ex.getMessage();
                    resetCamposModelo();

                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }

                return respuesta;
            }

            private void showListProveedor() {
                for_modelo = new FormularioSeleccionarModelo();
                for_modelo.showFormulario();
                addListenerFormularioSeleccionarModelo();

            }
        });
      
 }
    public void resetCamposModelo() {

        tex_modelo.reset();
        tex_marca.reset();
        tex_modelo.focus();

    }
    public void openFormularioModelo(FormularioSeleccionarModelo for_modelo) {

        modeloSeleccionado = for_modelo.getProveedorSeleccionado();
        if (modeloSeleccionado == null) {
            MessageBox.alert("Por favor solo seleccione un modelo.");
        } else {
            for_modelo.closeFormulario();
            tex_modelo.setValue(modeloSeleccionado.getIdmodelo());
            tex_marca.setValue(modeloSeleccionado.getIdmarca());
            //tex_producto.focus();
        }

    }

    ///clase interna para evento de los colores
    public class EventoColor  extends TextFieldListenerAdapter {

    private FormularioSeleccionarColor for_color;
    private Color colorSeleccionado;
    boolean respuesta1 = false;
    private int nuevocolor;
    public EventoColor(int nuevocolor){
            this.nuevocolor=nuevocolor;
    }

    public void onSpecialKey(Field field, EventObject e) {

                if (e.getKey() == EventObject.ENTER) {
                    // abrir la lsita de productos for_proveedor
                    //MessageBox.alert(field.getValueAsString());
                    String codigoProveedor = field.getValueAsString().trim();
                    if (codigoProveedor.isEmpty() || findByCodigoProveedor(codigoProveedor)) {
                        if (for_color == null || for_color.isHidden()) {
                            //MessageBox.alert("evento ingreso");
                            showListColor();
                        } else {
                            //MessageBox.alert("evento no ingreso");
                            for_color.onFocus();

                        }

                    }
                }
            }

     private void addListenerFormularioSeleccionarColor() {
                for_color.getLayout().getBut_aceptar().addListener(new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        if(nuevocolor ==0){openFormularioColor(for_color);}
                        if(nuevocolor ==1){openFormularioColor1(for_color);}
                        if(nuevocolor ==2){openFormularioColor2(for_color);}
                        if(nuevocolor ==3){openFormularioColor3(for_color);}
                        if(nuevocolor ==4){openFormularioColor4(for_color);}
                        if(nuevocolor ==5){openFormularioColor5(for_color);}
                        
                    }
                });
    }

    private boolean findByCodigoProveedor(final String codigoBuscado) {
                respuesta1 = false;
                String enlace = "php/Colores.php?funcion=BuscarColorPorId&idmarca&idcolor=" + codigoBuscado;
                Utils.setErrorPrincipal("Cargando parametros del color", "cargar");
                final Conector conec = new Conector(enlace, false);

                try {
                    conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        private String idcolor;
                        private String nombre;
                        private String descripcion;
                        private String codigo;

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;

                            if ((jsonObject = jsonValue.isObject()) != null) {
                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
                                    JSONValue proveedorValue = jsonObject.get("resultado");
                                    JSONObject proveedorObject;

                                    if ((proveedorObject = proveedorValue.isObject()) != null) {

                                        idcolor = Utils.getStringOfJSONObject(proveedorObject, "idcolor");
                                        nombre = Utils.getStringOfJSONObject(proveedorObject, "nombre");
                                        descripcion = Utils.getStringOfJSONObject(proveedorObject, "descripcion");
                                        codigo = Utils.getStringOfJSONObject(proveedorObject, "codigo");
//                                        fax = Utils.getStringOfJSONObject(proveedorObject, "fax");
//                                        paginaWeb = Utils.getStringOfJSONObject(proveedorObject, "paginaweb");

                                        colorSeleccionado =new Color(idcolor,nombre,descripcion,codigo);
                                        if(nuevocolor ==0){
                                            tex_color.setValue(colorSeleccionado.getIdcolor());
                                        }
                                        if(nuevocolor==1){
                                            tex_color1.setValue(colorSeleccionado.getIdcolor());
                                        }
                                        if(nuevocolor==2){
                                            tex_color2.setValue(colorSeleccionado.getIdcolor());
                                        }
                                        if(nuevocolor==3){
                                            tex_color3.setValue(colorSeleccionado.getIdcolor());
                                        }
                                        if(nuevocolor==4){
                                            tex_color4.setValue(colorSeleccionado.getIdcolor());
                                        }
                                        if(nuevocolor==5){
                                            tex_color5.setValue(colorSeleccionado.getIdcolor());
                                        }
                                        //tex_marca.setValue(modeloSeleccionado.getIdmarca());
                                        //tex_producto.focus();
                                        respuesta1 =true;
                                    } else {
                                        if(nuevocolor ==0){resetCamposColor();}
                                        if(nuevocolor ==1){resetCamposColor1();}
                                        if(nuevocolor ==2){resetCamposColor2();}
                                        if(nuevocolor ==3){resetCamposColor3();}
                                        if(nuevocolor ==4){resetCamposColor4();}
                                        if(nuevocolor ==5){resetCamposColor5();}
                                        

                                        Utils.setErrorPrincipal("No se recuperaron correctamente lo valores de modelo", "error");
                                    }

                                } else {
                                        if(nuevocolor ==0){resetCamposColor();}
                                        if(nuevocolor ==1){resetCamposColor1();}
                                        if(nuevocolor ==2){resetCamposColor2();}
                                        if(nuevocolor ==3){resetCamposColor3();}
                                        if(nuevocolor ==4){resetCamposColor4();}
                                        if(nuevocolor ==5){resetCamposColor5();}

                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }

                            }
                        }

                        public void onError(Request request, Throwable exception) {
                                        if(nuevocolor ==0){resetCamposColor();}
                                        if(nuevocolor ==1){resetCamposColor1();}
                                        if(nuevocolor ==2){resetCamposColor2();}
                                        if(nuevocolor ==3){resetCamposColor3();}
                                        if(nuevocolor ==4){resetCamposColor4();}
                                        if(nuevocolor ==5){resetCamposColor5();}

                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");

                        }
                    });

                } catch (RequestException ex) {
                    ex.getMessage();
                    if(nuevocolor ==0){resetCamposColor();}
                                        if(nuevocolor ==1){resetCamposColor1();}
                                        if(nuevocolor ==2){resetCamposColor2();}
                                        if(nuevocolor ==3){resetCamposColor3();}
                                        if(nuevocolor ==4){resetCamposColor4();}
                                        if(nuevocolor ==5){resetCamposColor5();}

                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }

                return respuesta1;
            }

            private void showListColor() {
                for_color = new FormularioSeleccionarColor();
                for_color.showFormulario();
                addListenerFormularioSeleccionarColor();

            }

}
//clase de evento para los campos de material
public class EventoMaterial  extends TextFieldListenerAdapter {

    private FormularioSeleccionarMaterial for_material;
    private Material materialSeleccionado;
    boolean respuesta2 = false;
    private int nuevomaterial;
    public EventoMaterial(int nuevomaterial){
            this.nuevomaterial=nuevomaterial;
    }

    public void onSpecialKey(Field field, EventObject e) {

                if (e.getKey() == EventObject.ENTER) {
                    // abrir la lsita de productos for_proveedor
                    //MessageBox.alert(field.getValueAsString());
                    String codigoProveedor = field.getValueAsString().trim();
                    if (codigoProveedor.isEmpty() || findByCodigoProveedor(codigoProveedor)) {
                        if (for_material == null || for_material.isHidden()) {
                            //MessageBox.alert("evento ingreso");
                            showListMaterial();
                        } else {
                            //MessageBox.alert("evento no ingreso");
                            for_material.onFocus();

                        }

                    }
                }
            }

     private void addListenerFormularioSeleccionarMaterial() {
                for_material.getLayout().getBut_aceptar().addListener(new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        if(nuevomaterial ==0){openFormularioMaterial(for_material);}
                        if(nuevomaterial ==1){openFormularioMaterial1(for_material);}
                        if(nuevomaterial ==2){openFormularioMaterial2(for_material);}
                        if(nuevomaterial ==3){openFormularioMaterial3(for_material);}
                        if(nuevomaterial ==4){openFormularioMaterial4(for_material);}
                        if(nuevomaterial ==5){openFormularioMaterial5(for_material);}

                    }
                });
    }

    private boolean findByCodigoProveedor(final String codigoBuscado) {
                respuesta2 = false;
                String enlace = "php/Material.php?funcion=BuscarMaterialPorId&idmaterial=" + codigoBuscado;
                Utils.setErrorPrincipal("Cargando parametros del material", "cargar");
                final Conector conec = new Conector(enlace, false);

                try {
                    conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        private String idmaterial;
                        private String nombre;
                        private String descripcion;
                        private String codigo;

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;

                            if ((jsonObject = jsonValue.isObject()) != null) {
                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
                                    JSONValue proveedorValue = jsonObject.get("resultado");
                                    JSONObject proveedorObject;

                                    if ((proveedorObject = proveedorValue.isObject()) != null) {

                                        idmaterial = Utils.getStringOfJSONObject(proveedorObject, "idmaterial");
                                        nombre = Utils.getStringOfJSONObject(proveedorObject, "nombre");
                                        descripcion = Utils.getStringOfJSONObject(proveedorObject, "descripcion");
                                        codigo = Utils.getStringOfJSONObject(proveedorObject, "codigo");
//                                        fax = Utils.getStringOfJSONObject(proveedorObject, "fax");
//                                        paginaWeb = Utils.getStringOfJSONObject(proveedorObject, "paginaweb");

                                        materialSeleccionado =new Material(idmaterial,nombre,descripcion,codigo);
                                        if(nuevomaterial ==0){
                                            tex_material.setValue(materialSeleccionado.getIdmaterial());
                                        }
                                        if(nuevomaterial==1){
                                            tex_material1.setValue(materialSeleccionado.getIdmaterial());
                                        }
                                        if(nuevomaterial==2){
                                            tex_material2.setValue(materialSeleccionado.getIdmaterial());
                                        }
                                        if(nuevomaterial==3){
                                            tex_material3.setValue(materialSeleccionado.getIdmaterial());
                                        }
                                        if(nuevomaterial==4){
                                            tex_material4.setValue(materialSeleccionado.getIdmaterial());
                                        }
                                        if(nuevomaterial==5){
                                            tex_material5.setValue(materialSeleccionado.getIdmaterial());
                                        }
                                        //tex_marca.setValue(modeloSeleccionado.getIdmarca());
                                        //tex_producto.focus();
                                        respuesta2 =true;
                                    } else {
                                        if(nuevomaterial ==0){resetCamposMaterial();}
                                        if(nuevomaterial ==1){resetCamposMaterial1();}
                                        if(nuevomaterial ==2){resetCamposMaterial2();}
                                        if(nuevomaterial ==3){resetCamposMaterial3();}
                                        if(nuevomaterial ==4){resetCamposMaterial4();}
                                        if(nuevomaterial ==5){resetCamposMaterial5();}


                                        Utils.setErrorPrincipal("No se recuperaron correctamente lo valores de material", "error");
                                    }

                                } else {
                                        if(nuevomaterial ==0){resetCamposMaterial();}
                                        if(nuevomaterial ==1){resetCamposMaterial1();}
                                        if(nuevomaterial ==2){resetCamposMaterial2();}
                                        if(nuevomaterial ==3){resetCamposMaterial3();}
                                        if(nuevomaterial ==4){resetCamposMaterial4();}
                                        if(nuevomaterial ==5){resetCamposMaterial5();}

                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }

                            }
                        }

                        public void onError(Request request, Throwable exception) {
                                        if(nuevomaterial ==0){resetCamposMaterial();}
                                        if(nuevomaterial ==1){resetCamposMaterial1();}
                                        if(nuevomaterial ==2){resetCamposMaterial2();}
                                        if(nuevomaterial ==3){resetCamposMaterial3();}
                                        if(nuevomaterial ==4){resetCamposMaterial4();}
                                        if(nuevomaterial ==5){resetCamposMaterial5();}

                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");

                        }
                    });

                } catch (RequestException ex) {
                    ex.getMessage();
                                        if(nuevomaterial ==0){resetCamposMaterial();}
                                        if(nuevomaterial ==1){resetCamposMaterial1();}
                                        if(nuevomaterial ==2){resetCamposMaterial2();}
                                        if(nuevomaterial ==3){resetCamposMaterial3();}
                                        if(nuevomaterial ==4){resetCamposMaterial4();}
                                        if(nuevomaterial ==5){resetCamposMaterial5();}

                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }

                return respuesta2;
            }

            private void showListMaterial() {
                for_material = new FormularioSeleccionarMaterial();
                for_material.showFormulario();
                addListenerFormularioSeleccionarMaterial();

            }

}

//metodos para los colores
public void resetCamposColor() {

        tex_color.reset();
        tex_color.focus();

    }
public void resetCamposColor1() {

        tex_color1.reset();
        tex_color1.focus();

    }
public void resetCamposColor2() {

        tex_color2.reset();
        tex_color2.focus();

    }
public void resetCamposColor3() {

        tex_color3.reset();
        tex_color3.focus();

    }
public void resetCamposColor4() {

        tex_color4.reset();
        tex_color4.focus();

    }
public void resetCamposColor5() {

        tex_color5.reset();
        tex_color5.focus();

    }
public void openFormularioColor(FormularioSeleccionarColor for_color) {

        colorSeleccionado = for_color.getProveedorSeleccionado();
        if (colorSeleccionado == null) {
            MessageBox.alert("Por favor solo seleccione un color.");
        } else {
            for_color.closeFormulario();
            tex_color.setValue(colorSeleccionado.getIdcolor());
            //tex_producto.focus();
        }

    }
public void openFormularioColor1(FormularioSeleccionarColor for_color) {

        colorSeleccionado = for_color.getProveedorSeleccionado();
        if (colorSeleccionado == null) {
            MessageBox.alert("Por favor solo seleccione un color.");
        } else {
            for_color.closeFormulario();
            tex_color1.setValue(colorSeleccionado.getIdcolor());
            //tex_producto.focus();
        }

    }
public void openFormularioColor2(FormularioSeleccionarColor for_color) {

        colorSeleccionado = for_color.getProveedorSeleccionado();
        if (colorSeleccionado == null) {
            MessageBox.alert("Por favor solo seleccione un color.");
        } else {
            for_color.closeFormulario();
            tex_color2.setValue(colorSeleccionado.getIdcolor());
            //tex_producto.focus();
        }

    }
public void openFormularioColor3(FormularioSeleccionarColor for_color) {

        colorSeleccionado = for_color.getProveedorSeleccionado();
        if (colorSeleccionado == null) {
            MessageBox.alert("Por favor solo seleccione un color.");
        } else {
            for_color.closeFormulario();
            tex_color3.setValue(colorSeleccionado.getIdcolor());
            //tex_producto.focus();
        }

    }
public void openFormularioColor4(FormularioSeleccionarColor for_color) {

        colorSeleccionado = for_color.getProveedorSeleccionado();
        if (colorSeleccionado == null) {
            MessageBox.alert("Por favor solo seleccione un color.");
        } else {
            for_color.closeFormulario();
            tex_color4.setValue(colorSeleccionado.getIdcolor());
            //tex_producto.focus();
        }

    }
public void openFormularioColor5(FormularioSeleccionarColor for_color) {

        colorSeleccionado = for_color.getProveedorSeleccionado();
        if (colorSeleccionado == null) {
            MessageBox.alert("Por favor solo seleccione un color.");
        } else {
            for_color.closeFormulario();
            tex_color5.setValue(colorSeleccionado.getIdcolor());
            //tex_producto.focus();
        }

    }
//metodos de los materiales
public void resetCamposMaterial() {

        tex_material.reset();
        tex_material.focus();

    }
public void resetCamposMaterial1() {

        tex_material1.reset();
        tex_material1.focus();

    }
public void resetCamposMaterial2() {

        tex_material2.reset();
        tex_material2.focus();

    }
public void resetCamposMaterial3() {

        tex_material3.reset();
        tex_material3.focus();

    }
public void resetCamposMaterial4() {

        tex_material4.reset();
        tex_material4.focus();

    }
public void resetCamposMaterial5() {

        tex_material5.reset();
        tex_material5.focus();

    }
public void openFormularioMaterial(FormularioSeleccionarMaterial for_material) {

        materialSeleccionado = for_material.getProveedorSeleccionado();
        if (materialSeleccionado == null) {
            MessageBox.alert("Por favor solo seleccione un material.");
        } else {
            for_material.closeFormulario();
            tex_material.setValue(materialSeleccionado.getIdmaterial());
            //tex_producto.focus();
        }

    }
public void openFormularioMaterial1(FormularioSeleccionarMaterial for_material) {

        materialSeleccionado = for_material.getProveedorSeleccionado();
        if (materialSeleccionado == null) {
            MessageBox.alert("Por favor solo seleccione un material.");
        } else {
            for_material.closeFormulario();
            tex_material1.setValue(materialSeleccionado.getIdmaterial());
            //tex_producto.focus();
        }

    }
public void openFormularioMaterial2(FormularioSeleccionarMaterial for_material) {

        materialSeleccionado = for_material.getProveedorSeleccionado();
        if (materialSeleccionado == null) {
            MessageBox.alert("Por favor solo seleccione un material.");
        } else {
            for_material.closeFormulario();
            tex_material2.setValue(materialSeleccionado.getIdmaterial());
            //tex_producto.focus();
        }

    }
public void openFormularioMaterial3(FormularioSeleccionarMaterial for_material) {

        materialSeleccionado = for_material.getProveedorSeleccionado();
        if (materialSeleccionado == null) {
            MessageBox.alert("Por favor solo seleccione un material.");
        } else {
            for_material.closeFormulario();
            tex_material3.setValue(materialSeleccionado.getIdmaterial());
            //tex_producto.focus();
        }

    }
public void openFormularioMaterial4(FormularioSeleccionarMaterial for_material) {

        materialSeleccionado = for_material.getProveedorSeleccionado();
        if (materialSeleccionado == null) {
            MessageBox.alert("Por favor solo seleccione un material.");
        } else {
            for_material.closeFormulario();
            tex_material4.setValue(materialSeleccionado.getIdmaterial());
            //tex_producto.focus();
        }

    }
public void openFormularioMaterial5(FormularioSeleccionarMaterial for_material) {

        materialSeleccionado = for_material.getProveedorSeleccionado();
        if (materialSeleccionado == null) {
            MessageBox.alert("Por favor solo seleccione un material.");
        } else {
            for_material.closeFormulario();
            tex_material5.setValue(materialSeleccionado.getIdmaterial());
            //tex_producto.focus();
        }

    }
}

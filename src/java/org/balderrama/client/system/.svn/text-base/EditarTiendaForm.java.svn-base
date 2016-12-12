package org.balderrama.client.system;

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
public class EditarTiendaForm extends Window {

    private final int ANCHO = 500;
    private final int ALTO = 250;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private TextField tex_codigo;
    private TextField tex_nombre;
    private TextField tex_almacen;
    private TextField tex_telefono;
    private TextField tex_direccion;
    private TextField tex_email;
    private TextField tex_fax;
    private ComboBox com_usuario;
    private ComboBox com_estado;
//    private Panel formpanel;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String idtiendaC;
    private String nombreC;
    private String almacenC;
    private String codigoC;
    private String emailC;
    private String telefonoC;
    private String direccionC;
    private String faxC;
   private Object[][] UsuarioM;
    private String[] estadoM;
    private boolean nuevo;
    private Tienda padre;

    public EditarTiendaForm(String idtienda, String codigo,String nombre,String almacen,  String telefono, String direccion, String email, String fax,Object[][] usuarios, String estado, Tienda padre) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");
        this.idtiendaC = idtienda;
        this.codigoC = codigo;
        this.nombreC = nombre;
        this.almacenC = almacen;
        this.telefonoC = telefono;
        this.faxC = fax;
        this.direccionC = direccion;
        this.emailC = email;
//        if (estado == null) {
//            this.estadoC = "Activo";
//
//        } else {
//            this.estadoC = estado;
//        }




        this.padre = padre;

        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Registar nuevo Gasto";

        if (idtiendaC != null) {
            nombreBoton1 = "Modificar";
            tituloTabla = "Editar Tienda";
            nuevo = false;
        } else {
            this.idtiendaC = "nuevo";
            nuevo = true;

        }

        this.UsuarioM = usuarios;

        setId("win-Tienda");
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
                EditarTiendaForm.this.close();
                EditarTiendaForm.this.setModal(false);
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
        formPanel.setLabelWidth(ANCHO - 400);
        formPanel.setWidth(ANCHO);
        formPanel.setHeight(ALTO);

        tex_codigo = new TextField("Codigo", "codigo");
        tex_nombre = new TextField("Nombre", "nombre");
        tex_almacen = new TextField("Almacen", "almacen");
        tex_telefono = new TextField("Telefono", "telefono");
        tex_direccion = new TextField("Direccion", "direccion");
        tex_email = new TextField("Email", "email");
        tex_fax = new TextField("Fax", "fax");
        com_usuario = new ComboBox("Usuario", "usuario");
        com_estado = new ComboBox("Estado", "estado");
        

        formPanel.setLabelWidth(ANCHO - 400 - 5);
        formPanel.add(tex_codigo,ANCHO_LAYOUT_DATA);
        formPanel.add(tex_nombre, ANCHO_LAYOUT_DATA);
        formPanel.add(tex_almacen,ANCHO_LAYOUT_DATA);
        formPanel.add(tex_telefono,ANCHO_LAYOUT_DATA);
        formPanel.add(tex_direccion,ANCHO_LAYOUT_DATA);
        formPanel.add(tex_email,ANCHO_LAYOUT_DATA);
        formPanel.add(com_usuario,ANCHO_LAYOUT_DATA);
        formPanel.add(com_estado,ANCHO_LAYOUT_DATA);
       



        add(formPanel);
        //initCombos();
        initValues();
    }

   private void initCombos() {

        com_usuario.setValueField("idusuario");
        com_usuario.setDisplayField("nombre");
        com_usuario.setForceSelection(true);
        com_usuario.setMinChars(1);
        com_usuario.setMode(ComboBox.LOCAL);
        com_usuario.setTriggerAction(ComboBox.ALL);
        com_usuario.setEmptyText("Seleccione un Almacen");
        com_usuario.setLoadingText("Buscando");
        com_usuario.setTypeAhead(true);
        com_usuario.setSelectOnFocus(true);
        com_usuario.setHideTrigger(false);
        com_usuario.setReadOnly(true);
        SimpleStore
                proveedorStore = new SimpleStore(new String[]{"idusuario", "nombre"}, UsuarioM);
        proveedorStore.load();
        com_usuario.setStore(proveedorStore);


          //estadoM = new String[]{"Gasto Tienda", "Gasto Almacen"};



        SimpleStore estadosStore = new SimpleStore("estados", estadoM);
        estadosStore.load();
        com_estado.setDisplayField("estados");
        com_estado.setStore(estadosStore);


    }
    private void initValues() {
        tex_codigo.setValue(codigoC);
        tex_nombre.setValue(nombreC);
        tex_almacen.setValue(almacenC);
        tex_telefono.setValue(telefonoC);
        tex_direccion.setValue(direccionC);
        tex_email.setValue(emailC);
        tex_fax.setValue(faxC);




    }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

    public void GuardarNuevoAlmacen() {
        String cadena = "php/Gasto.php?funcion=GuardarNuevoGasto";
        cadena =
                cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Guardando el nuevo Gasto", "guardar");
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

    public void GuardarEditarAlmacen() {
        String cadena = "php/Almacen.php?funcion=GuardarEditarAlmacen&idalmacen=" + idtiendaC;
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
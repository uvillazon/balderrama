/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.system;

import com.google.gwt.json.client.JSONString;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.FieldSet;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.Store;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.TextField;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;

/**
 *
 * @author Administrador
 */
public class EditarUsuarioForm extends Window {

    private final int ANCHO = 500;
    private final int ALTO = 400;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private TextField tex_nombre;
    private TextField tex_primerAp;
    private TextField tex_segunAp;
    private TextField tex_telefono;
    private TextField tex_celular;
    private TextField tex_ci;
    private TextField tex_email;
    private ComboBox com_rol;
   // private ComboBox com_sucursal;
   // private ComboBox com_almacen;
    private ComboBox com_estado;
    private Button but_aceptar;
    private Button but_cancelar;
    private FieldSet fie_contrasenia;
    private TextField tex_login;
    private TextField tex_nuevaContrania;
    private TextField tex_confirmarContrasenia;
    private String nombre;
    private String primerAp;
    private String segundoAp;
    private String telefono;
    private String celular;
    private String ci;
    private String email;
    private String rol;
    private String sucursal;
    private String almacen;
    private String estado;
    private String login;
    private String idusuario;
    private String[] estados;
    private Object[][] rolesM;
    //private Object[][] sucursalesM;
   // private Object[][] almacenesM;
    private Store rolesStore;
    private SimpleStore sucursalesStore;
    private SimpleStore almacenesStore;
    private Usuario padre;

    /**
     * Si id usuario es null, quiere decir que es para crear un nuevo
     */
    public EditarUsuarioForm(String idUsuario, Usuario padred) {
        this.idusuario = idUsuario;
        this.padre = padred;
        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Registrar nuevo usuario";
        String setContrasenia = "Crear contraseña";
        boolean colapsado = false;
        if (idUsuario != null) {
            nombreBoton1 = "Modificar";
            tituloTabla = "Editar usuario";
            setContrasenia = "Cambiar contraseña";
            colapsado = true;
        } else {
            this.idusuario = "nuevo";
        }
        setId("win-usuario");
        setTitle(tituloTabla);
        setWidth(ANCHO);
        setMinWidth(ANCHO);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        setPlain(true);


        but_aceptar = new Button(nombreBoton1);
        but_cancelar = new Button(nombreBoton2);
        addButton(but_aceptar);
        addButton(but_cancelar);

        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        formPanel.setLabelWidth(ANCHO - 400);
        formPanel.setUrl("save-form.php");
        formPanel.setWidth(ANCHO);
        formPanel.setHeight(ALTO);

        tex_nombre = new TextField("Nombre", "nombre");
        tex_primerAp = new TextField("Primer apellido", "primerAp");
        tex_segunAp = new TextField("Segun apellido", "segunAp");
        tex_telefono = new TextField("Telefono", "telefono");
        tex_celular = new TextField("Telefono celular", "celular");
        tex_ci = new TextField("Ci", "ci");
        tex_email = new TextField("E-mail", "mail");
        com_rol = new ComboBox("Rol", "rol");
   //     com_sucursal = new ComboBox("Sucursal", "sucursal");
   //     com_almacen = new ComboBox("Almacen", "almacen");
        com_estado = new ComboBox("Estado", "estado");

        initCombos();

        fie_contrasenia = new FieldSet(setContrasenia);
        fie_contrasenia.setCollapsible(true);
        fie_contrasenia.setAutoHeight(true);
        fie_contrasenia.setCollapsed(colapsado);
        formPanel.setLabelWidth(ANCHO - 400 - 5);

        tex_login = new TextField("Login", "login");
        tex_nuevaContrania = new TextField("Contrasena", "nuevaCon");
        tex_nuevaContrania.setPassword(true);
        tex_confirmarContrasenia = new TextField("Confirmar contaseña", "confirmarCon");
        tex_confirmarContrasenia.setPassword(true);

        fie_contrasenia.add(tex_login, ANCHO_LAYOUT_DATA);
        fie_contrasenia.add(tex_nuevaContrania, ANCHO_LAYOUT_DATA);
        fie_contrasenia.add(tex_confirmarContrasenia, ANCHO_LAYOUT_DATA);


        if (idUsuario != null) {

            String enlace = "php/Usuario.php?funcion=findUsuarioByIdRolSucursalAlmacen&idusuario=" + idUsuario;
            Utils.setErrorPrincipal("Cargando parametros del usaurio", "cargar");
            final Conector conec = new Conector(enlace, false);

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
                                JSONValue userV = jsonObject.get("resultado");
                                JSONObject userO;
                                if ((userO = userV.isObject()) != null) {

                                    nombre = Utils.getStringOfJSONObject(userO, "nombre");
                                    primerAp = Utils.getStringOfJSONObject(userO, "apellido1");
                                    segundoAp = Utils.getStringOfJSONObject(userO, "apellido2");
                                    telefono = Utils.getStringOfJSONObject(userO, "telefono");
                                    celular = Utils.getStringOfJSONObject(userO, "celular");
                                    ci = Utils.getStringOfJSONObject(userO, "ci");
                                    email = Utils.getStringOfJSONObject(userO, "email");
                                    rol = Utils.getStringOfJSONObject(userO, "idrol");
//                                    sucursal = Utils.getStringOfJSONObject(userO, "sucursal");
                                    almacen = Utils.getStringOfJSONObject(userO, "idalmacen");
                                    estado = Utils.getStringOfJSONObject(userO, "estado");
                                    login = Utils.getStringOfJSONObject(userO, "login");
                                    String roles = Utils.getStringOfJSONObject(userO, "roles");
                                    if (roles.equalsIgnoreCase("true")) {

                                        rolesM = Utils.getArrayOfJSONObject(userO, "rolesM", new String[]{"idrol", "nombre"});
                                        if (rolesM != null) {
                                            rolesStore = new SimpleStore(new String[]{"idrol", "nombre"}, rolesM);
                                            rolesStore.load();
                                            com_rol.setStore(rolesStore);
                                            com_rol.reset();
                                            com_rol.setValue(rol);
                                        }

                                    }

                                   
                                    initValues();
                                } else {
                                    Utils.setErrorPrincipal("No se recuperaron correctamente lo valores de usuario", "error");
                                }

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
        } else {
            String enlace = "php/Usuario.php?funcion=findRolSucursalAlmacenForNewUsuario";
            Utils.setErrorPrincipal("Cargando parametros para el nuevo usuario", "cargar");
            final Conector conec = new Conector(enlace, false);

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
                                JSONValue userV = jsonObject.get("resultado");
                                JSONObject userO;
                                if ((userO = userV.isObject()) != null) {

                                    String roles = Utils.getStringOfJSONObject(userO, "roles");
                                    if (roles.equalsIgnoreCase("true")) {
                                        estado = "Activo";

                                        rolesM = Utils.getArrayOfJSONObject(userO, "rolesM", new String[]{"idrol", "nombre"});
                                        if (rolesM != null) {
                                            rolesStore = new SimpleStore(new String[]{"idrol", "nombre"}, rolesM);
                                            rolesStore.load();
                                            com_rol.setStore(rolesStore);
                                            com_rol.reset();
                                            rol = rolesM[0][0].toString();
                                            com_rol.setValue(rol);
                                        }

                                    }

                                    initValues();
                                } else {
                                    Utils.setErrorPrincipal("No se recuperaron correctamente lo valores de usuario", "error");
                                }

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

        formPanel.add(tex_nombre, ANCHO_LAYOUT_DATA);
        formPanel.add(tex_primerAp, ANCHO_LAYOUT_DATA);
        formPanel.add(tex_segunAp, ANCHO_LAYOUT_DATA);
        formPanel.add(tex_telefono, ANCHO_LAYOUT_DATA);
        formPanel.add(tex_celular, ANCHO_LAYOUT_DATA);
        formPanel.add(tex_ci, ANCHO_LAYOUT_DATA);
        formPanel.add(tex_email, ANCHO_LAYOUT_DATA);
        formPanel.add(com_rol, ANCHO_LAYOUT_DATA);
//        formPanel.add(com_sucursal, ANCHO_LAYOUT_DATA);
//        formPanel.add(com_almacen, ANCHO_LAYOUT_DATA);
        formPanel.add(com_estado, ANCHO_LAYOUT_DATA);

        formPanel.add(fie_contrasenia);

        add(formPanel);

        initValidators();

        addListeners();
    }

    private void initCombos() {
        estados = new String[]{"Activo", "Inactivo"};

        com_rol.setFieldLabel("Roles");
        com_rol.setDisplayField("nombre");
        com_rol.setMode(ComboBox.LOCAL);
        com_rol.setTriggerAction(ComboBox.ALL);
        com_rol.setForceSelection(true);
        com_rol.setValueField("idrol");
        com_rol.setReadOnly(true);

        SimpleStore estadosStore = new SimpleStore("estados", estados);
        estadosStore.load();
        com_estado.setDisplayField("estados");
        com_estado.setStore(estadosStore);
    }

    private void initValidators() {


        tex_nombre.setMaxLength(50);
        tex_primerAp.setMaxLength(50);
        tex_segunAp.setMaxLength(50);
        tex_ci.setMaxLength(10);
        tex_email.setMaxLength(50);
        tex_telefono.setMaxLength(12);
        tex_celular.setMaxLength(12);
        tex_login.setMaxLength(30);
        tex_confirmarContrasenia.setMaxLength(255);
        tex_nuevaContrania.setMaxLength(255);

    }

    private void initValues() {
        tex_nombre.setValue(nombre);
        tex_primerAp.setValue(primerAp);
        tex_segunAp.setValue(segundoAp);
        tex_telefono.setValue(telefono);
        tex_celular.setValue(celular);
        tex_ci.setValue(ci);
        tex_email.setValue(email);
        com_estado.setValue(estado);
        tex_login.setValue(login);
    }

    private void addListeners() {
        but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
String nombres = tex_nombre.getText();
String apellido1 = tex_primerAp.getText();
String apellido2 = tex_segunAp.getText();
String carnetidentidad = tex_ci.getText();
String email = tex_email.getText();
String telefono = tex_telefono.getText();
String celular = tex_celular.getText();
String login = tex_login.getText();
String paswd1 = Utils.md5(tex_nuevaContrania.getText());
String paswd2 = Utils.md5(tex_confirmarContrasenia.getText());
String idrol = com_rol.getText();
String estado = com_estado.getText();

                JSONObject usuarioSoU = new JSONObject();
                usuarioSoU.put("idusuario", new JSONString(idusuario));
                usuarioSoU.put("nombres", new JSONString(tex_nombre.getText()));
                usuarioSoU.put("apellido1", new JSONString(tex_primerAp.getText()));
                usuarioSoU.put("apellido2", new JSONString(tex_segunAp.getText()));
                usuarioSoU.put("carnetidentidad", new JSONString(tex_ci.getText()));
                usuarioSoU.put("email", new JSONString(tex_email.getText()));
                usuarioSoU.put("telefono", new JSONString(tex_telefono.getText()));
                usuarioSoU.put("celular", new JSONString(tex_celular.getText()));
                usuarioSoU.put("login", new JSONString(tex_login.getText()));
                usuarioSoU.put("paswd1", new JSONString(Utils.md5(tex_nuevaContrania.getText())));
                usuarioSoU.put("paswd2", new JSONString(Utils.md5(tex_confirmarContrasenia.getText())));
                usuarioSoU.put("idrol", new JSONString(com_rol.getValue()));
                usuarioSoU.put("estado", new JSONString(com_estado.getText()));
           //     usuarioSoU.put("idalmacen", new JSONString(com_almacen.getValue()));

                String datos = "resultado=" + usuarioSoU.toString();
  //  String enlace = "php/Usuario.php?funcion=findUsuarioByIdRolSucursalAlmacen&idusuario=" + idUsuario;

                if (!idusuario.equalsIgnoreCase("nuevo")) {
                   // String enlace = "php/Usuario.php?funcion=txUpdateUsuario&idusuario=" + idusuario;
String enlace = "php/Usuario.php?funcion=txUpdateUsuario&idusuario=" + idusuario+"&nombres=" + nombres+"&apellido1=" + apellido1+"&apellido2=" + apellido2+"&carnetidentidad=" + carnetidentidad+"&email=" + email+"&telefono=" + telefono+"&celular=" + celular+"&login=" + login+"&paswd1=" + paswd1+"&paswd2=" + paswd2+"&idrol=" + idrol+"&estado=" + estado;
//
Utils.setErrorPrincipal("Guardando los cambios en usuario", "cargar");
                    final Conector conec = new Conector(enlace, false, "GET");
                    try {
                        conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {

                            public void onResponseReceived(Request request, Response response) {

                                String data = response.getText();
                                JSONValue jsonValue = JSONParser.parse(data);
                                JSONObject jsonObject;
                                if ((jsonObject = jsonValue.isObject()) != null) {
                                    String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                    String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                    if (errorR.equalsIgnoreCase("true")) {
                                        padre.buscarSegunParametros();
                                        Utils.setErrorPrincipal(mensajeR, "mensaje");

                                        EditarUsuarioForm.this.destroy();
                                        EditarUsuarioForm.this.close();

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
                        Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                    }
                } else {
                    String enlace = "php/Usuario.php?funcion=GuardarNuevoUsuario&nombres=" + nombres+"&apellido1=" + apellido1+"&apellido2=" + apellido2+"&carnetidentidad=" + carnetidentidad+"&email=" + email+"&telefono=" + telefono+"&celular=" + celular+"&login=" + login+"&paswd1=" + paswd1+"&paswd2=" + paswd2+"&idrol=" + idrol+"&estado=" + estado;
             //       String enlace = "php/Usuario.php?funcion=txUpdateUsuario&idusuario=" + idusuario+"&nombres=" + nombres+"&apellido1=" + apellido1+"&apellido2=" + apellido2+"&carnetidentidad=" + carnetidentidad+"&email=" + email+"&telefono=" + telefono+"&celular=" + celular+"&login=" + login+"&paswd1=" + paswd1+"&paswd2=" + paswd2+"&idrol=" + idrol+"&estado=" + estado;

                    Utils.setErrorPrincipal("Guardando los cambios para el nuevo usuario", "cargar");
                    final Conector conec = new Conector(enlace, false, "GET");
                    try {
                        conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {

                            public void onResponseReceived(Request request, Response response) {
                                String data = response.getText();
                                JSONValue jsonValue = JSONParser.parse(data);
                                JSONObject jsonObject;
                                if ((jsonObject = jsonValue.isObject()) != null) {
                                    String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                    String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                    if (errorR.equalsIgnoreCase("true")) {
                                        padre.buscarSegunParametros();
                                        Utils.setErrorPrincipal(mensajeR, "mensaje");
                                        EditarUsuarioForm.this.destroy();
                                        EditarUsuarioForm.this.close();
                                    } else {
//                                        Window.alert(mensajeR);
                                        Utils.setErrorPrincipal(mensajeR, "error");
                                    }
                                }
                            }

                            public void onError(Request request, Throwable exception) {
                                Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                            //Window.alert("Ocurrio un error al conectar con el servidor ");
                            }
                        });
                    } catch (RequestException ex) {
                        Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                    }
                }

            }
        });

        but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                EditarUsuarioForm.this.destroy();
                EditarUsuarioForm.this.close();
            }
        });

    }
}
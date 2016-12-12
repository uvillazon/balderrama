/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.venta;

import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.ExtElement;
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
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;

/**
 *
 * @author Haydee
 */
public class Multivendedor extends Window {

    private final int ANCHOProductoWin = 300;
    private final int ALTOProductoWin = 90;
    protected ExtElement ext_elementProductoWin;
    private ComboBox com_usuarioMulti;
    private TextField passwordMulti;
    private Object[][] userM;
    private SimpleStore userStore;
    private PanelVenta padre;
    private Button aceptarMul;
    private Button cancelarMul;
    private FormPanel formPanel;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");

    public Multivendedor(PanelVenta ven, Object[][] user) {
        this.padre = ven;
        this.userM = user;
        setTitle("Confirmar Usuario");
        setWidth(ANCHOProductoWin);
        setMinWidth(ANCHOProductoWin);
        setLayout(new FitLayout());
        setPaddings(5);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        setPlain(true);

        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        formPanel.setLabelWidth(75);
        formPanel.setUrl("save-form.php");
        formPanel.setWidth(ANCHOProductoWin);
        formPanel.setHeight(ALTOProductoWin);

        com_usuarioMulti = new ComboBox("Usuario", "login");
        com_usuarioMulti.setValueField("idusuario");
        com_usuarioMulti.setDisplayField("idusuario");
        com_usuarioMulti.setForceSelection(true);
        com_usuarioMulti.setMinChars(1);
        com_usuarioMulti.setMode(ComboBox.LOCAL);
        com_usuarioMulti.setTriggerAction(ComboBox.ALL);
        com_usuarioMulti.setEmptyText("Seleccione un usuario");
        com_usuarioMulti.setLoadingText("Buscando");
        com_usuarioMulti.setTypeAhead(true);
        com_usuarioMulti.setSelectOnFocus(true);
        com_usuarioMulti.setHideTrigger(false);
        com_usuarioMulti.setReadOnly(true);

        userStore = new SimpleStore(new String[]{"idusuario", "login"}, userM);
        userStore.load();
        com_usuarioMulti.setStore(userStore);

        passwordMulti = new TextField("Password", "paswd");
        passwordMulti.setPassword(true);

        aceptarMul = new Button("Aceptar");
        cancelarMul = new Button("Cancelar");


        formPanel.add(com_usuarioMulti, ANCHO_LAYOUT_DATA);
        formPanel.add(passwordMulti, ANCHO_LAYOUT_DATA);
        formPanel.addButton(aceptarMul);
        formPanel.addButton(cancelarMul);
        add(formPanel);
        anadirListeners();
    }

    private void anadirListeners() {
        aceptarMul.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                ValidarMultivendedor();
            }
        });
        cancelarMul.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Multivendedor.this.destroy();
                Multivendedor.this.close();
            }
        });
    }

    private void ValidarMultivendedor() {
        String enlace = "php/dao/UsuarioValidarMultivendedor.php?function=validarUsuario";
        if ((!com_usuarioMulti.getText().equalsIgnoreCase("")) && (com_usuarioMulti.getText() != null)) {
            if ((!passwordMulti.getText().equalsIgnoreCase("")) && (passwordMulti.getText() != null)) {
                JSONObject usuarioSoU = new JSONObject();
                usuarioSoU.put("idusuario", new JSONString(com_usuarioMulti.getText()));
                usuarioSoU.put("password", new JSONString(Utils.md5(passwordMulti.getText())));

                String datos = "resultado=" + usuarioSoU.toString();
//                com.google.gwt.user.client.Window.alert(datos);
                Utils.setErrorPrincipal("Validando el usuario", "cargar");
                final Conector conec = new Conector(enlace, false, "POST");
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
                                //    padre.createCompra(com_usuarioMulti.getText());
                                    Multivendedor.this.destroy();
                                    Multivendedor.this.close();
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                            //Window.alert("Ocurrio un error al conectar con el servidor ");
                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                        }
                    });
                } catch (RequestException ex) {
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            } else {
                Utils.setErrorPrincipal("Por favor escriba su password", "error");
            }
        } else {
            Utils.setErrorPrincipal("Por favor seleccione un usuario", "error");
        }

    }
}

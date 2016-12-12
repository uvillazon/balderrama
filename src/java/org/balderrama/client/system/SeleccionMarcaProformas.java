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
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.Label;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.TabPanel;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;
import org.balderrama.client.MainEntryPoint;
import org.balderrama.client.util.KMenu;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import org.balderrama.client.system.CargarArchivo;

/**
 *
 * @author 
 */
public class SeleccionMarcaProformas extends Window {

    private final int ANCHO = 300;
    private final int ALTO = 120;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private ComboBox com_tienda;
    private ComboBox com_marca;
    private Label label = new Label("2");
    private Panel formpanel1;
    private Button but_aceptarP;
    private Button but_aceptar;
    private Button but_cancelarP;
    private String almacenC;
    private String tipoC;
    private Object[][] tiendaM;
    private Object[][] marcaM;
    boolean respuesta = false;
    String tipomarca;
    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;
    //para crear un nuevo tab
    public TabPanel tap_panel;
    public KMenu padre;
    public MainEntryPoint panel;
    CargarArchivo formCA;
    // private ComboBox com_cliente;

    public SeleccionMarcaProformas(Object[][] marca, KMenu kmenu) {

        padre = kmenu;
        marcaM = marca;
        String tituloTabla = "Procesar Archivo para la Marca";
        this.setClosable(true);
        this.setId("TPfun30045");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle(tituloTabla);
        setAutoWidth(true);
        setAutoHeight(true);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);

        setCloseAction(Window.CLOSE);
        //setPlain(true);
        onModuleLoad();

    }

    public void onModuleLoad() {

        //setId("win-Clientes");

        String nombreBoton1 = "Aceptar";
        ////String nombreBoton2 = "Cancelar";
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");

        but_aceptar = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                CargarArchivoAProcesar();
                String idmarca = com_marca.getValueAsString().trim();
            }
        });

//        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

//            @Override
//            public void onClick(Button button, EventObject e) {
//                SeleccionMarcaProformas.this.destroy();
//                SeleccionMarcaProformas.this.close();

//            }
//        });

        com_marca = new ComboBox("Marca", "marca", 200);
        formPanel.add(com_marca);
        addButton(but_aceptar);
//        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
        addListeners();
    }

    private void addListeners() {
        com_marca.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    CargarArchivoAProcesar();
                    String idmarca = com_marca.getValueAsString().trim();
                }
            }
        });
    }

    private void initCombos() {
        com_marca.setValueField("idmarca");
        com_marca.setDisplayField("nombre");
        com_marca.setMinChars(1);
        com_marca.setFieldLabel("nombre");
        com_marca.setMode(ComboBox.LOCAL);
        com_marca.setEmptyText("Seleccione una marca");
        com_marca.setLoadingText("Buscando");
        com_marca.setTypeAhead(true);
        com_marca.setSelectOnFocus(true);
        com_marca.setHideTrigger(true);

        SimpleStore cotegoriaStore = new SimpleStore(new String[]{"idmarca", "nombre"}, marcaM);
        cotegoriaStore.load();
        com_marca.setStore(cotegoriaStore);
    }
    public void CargarArchivoAProcesar() {
        final String idmarca = com_marca.getValueAsString().trim();

        String enlace = "php/VentaMayor.php?funcion=BuscardatosmarcaProcesar&idmarca=" + idmarca;
        Utils.setErrorPrincipal("Cargando parametros ", "cargar");
        final Conector conec = new Conector(enlace, false);
        {
            try {
                conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                    private EventObject e;
                    public void onResponseReceived(Request request, Response response) {
                        String data = response.getText();
                        JSONValue jsonValue = JSONParser.parse(data);
                        JSONObject jsonObject;
                        if ((jsonObject = jsonValue.isObject()) != null) {
                            String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                            String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                            if (errorR.equalsIgnoreCase("true")) {
                                Utils.setErrorPrincipal(mensajeR, "mensaje");
                                JSONValue marcaV = jsonObject.get("resultado");
                                JSONObject marcaO;
                                if ((marcaO = marcaV.isObject()) != null) {
                                    String marca = Utils.getStringOfJSONObject(marcaO, "marca");
                                    CargarArchivo formCA = new CargarArchivo(idmarca, marca, SeleccionMarcaProformas.this, padre);
                                    ////but_aceptar.setVisible(false);
                                    ////com_marca.setVisible(false);
                                    SeleccionMarcaProformas.this.clear();
                                    SeleccionMarcaProformas.this.close();
                                    formCA.show();
                                    //Utils.setErrorPrincipal("Se cargaron los parametros Correctamente", "mensaje");
                                } else {
                                    MessageBox.alert("No Hay datos en la consulta");
                                }
                            }
                        } else {
                        }
                        throw new UnsupportedOperationException("Not supported yet.");
                    }
                    public void onError(Request request, Throwable exception) {
                        throw new UnsupportedOperationException("Not supported yet.");
                    }
                });
            } catch (RequestException ea) {
                ea.getMessage();
                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
            }
        }
    }

}
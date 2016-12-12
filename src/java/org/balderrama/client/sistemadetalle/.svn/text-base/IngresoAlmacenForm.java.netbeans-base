/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

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

/**
 *
 * @author buggy
 */
public class IngresoAlmacenForm extends Window {

    private final int ANCHO = 300;
    private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private ComboBox com_tienda;
    private ComboBox com_marca;
    private Label label = new Label("2");
    private Panel formpanel1;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String almacenC;
    private String tipoC;
    private Object[][] tiendaM;
    private Object[][] marcaM;
    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;
    //para crear un nuevo tab
    public TabPanel tap_panel;
    public KMenu padre;
    public MainEntryPoint panel;
    IngresoAlmacen ing;


    public IngresoAlmacenForm(Object[][] tienda, Object[][] marca, KMenu kmenu) {
    //public IngresoAlmacenForm(KMenu kmenu,MainEntryPoint pan) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");

        // this.padre = padre
        padre=kmenu;
      //  panel=pan;
        tiendaM = tienda;
        marcaM = marca;
        //kmenu = menu;
        String tituloTabla = "Ingreso Almacen";
        this.setClosable(true);
        this.setId("TPfun5004");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle(tituloTabla);
        setWidth(ANCHO);
        setMinWidth(ANCHO);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);

        setCloseAction(Window.CLOSE);
        //setPlain(true);
        onModuleLoad();

    }

    public void onModuleLoad(){
        
        //setId("win-Clientes");

        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";

        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        //formPanel.setLabelWidth(ANCHO - 400);
        formPanel.setWidth(ANCHO);
        formPanel.setHeight(ALTO);
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                              GuardarEditarCliente(e);
//                            IngresoAlmacen ing=new IngresoAlmacen(IngresoAlmacenForm.this);
//                            padre.seleccionarOpcion(null,"fun5099",e, ing);
//
//                            IngresoAlmacenForm.this.close();
//                            IngresoAlmacenForm.this.setModal(false);
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                IngresoAlmacenForm.this.destroy();
                IngresoAlmacenForm.this.close();

              }
        });
//        formpanel1 = new Panel();
//        formpanel1.setWidth(50);
//        formpanel1.setHeight(50);
//        label.setHeight(50);
//        label.setWidth(50);
        //formpanel1.add(label);

        com_tienda = new ComboBox("Tienda", "tienda");
        com_marca = new ComboBox("Marca", "marca");
        //com_tipoC.setPosition(50, 50);

        // formPanel.setLabelWidth(ANCHO - 400 - 5);

        formPanel.add(com_tienda, ANCHO_LAYOUT_DATA);
        //formPanel.add(formpanel1);
        formPanel.add(com_marca, ANCHO_LAYOUT_DATA);
        addButton(but_aceptarP);
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
        initValues();
    }

    private void initCombos() {

        com_tienda.setValueField("idtienda");
        com_tienda.setDisplayField("nombre");
        com_tienda.setForceSelection(true);
        com_tienda.setMinChars(1);
        com_tienda.setMode(ComboBox.LOCAL);
        com_tienda.setTriggerAction(ComboBox.ALL);
        com_tienda.setEmptyText("Seleccione una tienda");
        com_tienda.setLoadingText("Buscando");
        com_tienda.setTypeAhead(true);
        com_tienda.setSelectOnFocus(true);
        com_tienda.setHideTrigger(false);
        com_tienda.setReadOnly(true);
        SimpleStore proveedorStore = new SimpleStore(new String[]{"idtienda", "nombre"}, tiendaM);
        proveedorStore.load();
        com_tienda.setStore(proveedorStore);

        com_marca.setValueField("idmarca");
        com_marca.setDisplayField("nombre");
        com_marca.setForceSelection(true);
        com_marca.setMinChars(1);
        com_marca.setMode(ComboBox.LOCAL);
        com_marca.setTriggerAction(ComboBox.ALL);
        com_marca.setEmptyText("Seleccione una marca");
        com_marca.setLoadingText("Buscando");
        com_marca.setTypeAhead(true);
        com_marca.setSelectOnFocus(true);
        com_marca.setHideTrigger(false);
        com_marca.setReadOnly(true);
        SimpleStore cotegoriaStore = new SimpleStore(new String[]{"idmarca", "nombre"}, marcaM);
        cotegoriaStore.load();
        com_marca.setStore(cotegoriaStore);




    }

    private void initValues() {

        com_marca.setValue(tipoC);
        com_tienda.setValue(almacenC);
    }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

    

    public void GuardarEditarCliente(EventObject e) {
        
        String idtienda = com_tienda.getValue();
        String idmarca = com_marca.getValue();

        String cadena = "php/IngresoAlmacen.php?funcion=BuscarModeloDetallePorMarca&idtienda=" +idtienda+"&idmarca="+idmarca;
        Utils.setErrorPrincipal("Cargando parametros de para ingreso almacen", "cargar");
        final Conector conec = new Conector(cadena, false);
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

                                    Object[][] modelos = Utils.getArrayOfJSONObject(marcaO, "modeloM", new String[]{"idmodelo","codigo"});
                                    String idmarca = Utils.getStringOfJSONObject(marcaO, "idmarca");

                                    String marca = Utils.getStringOfJSONObject(marcaO, "marca");
                                    String numerodoc= Utils.getStringOfJSONObject(marcaO,"numerodoc");
                                    String opcion = Utils.getStringOfJSONObject(marcaO, "opcion");

                                    IngresoAlmacen ing = new IngresoAlmacen(idmarca,marca,numerodoc,opcion,modelos,IngresoAlmacenForm.this);
                                    //IngresoAlmacen ing=new IngresoAlmacen(IngresoAlmacenForm.this);
                                    padre.seleccionarOpcion(null,"fun5099",e, ing);
                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente"+opcion, "mensaje");
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

            } catch (RequestException ex) {
                ex.getMessage();
                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
            }

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
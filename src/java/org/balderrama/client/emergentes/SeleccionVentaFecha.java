/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.emergentes;

import org.balderrama.client.cliente.PanelCobro;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.util.DateUtil;
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
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.Field;

import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import java.util.Date;

//import org.balderrama.client.pedido.Pedido;
//import org.balderrama.client.Almacenes.KardexAlmacen;
/**
 *
 * @author buggy
 */
public class SeleccionVentaFecha extends Window {

    private final int ANCHO = 300;
    private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private DateField dat_fecha;
    //  private ComboBox com_tienda;
    // private ComboBox com_marca;
    private Label label = new Label("2");
    private Panel formpanel1;
    private Button but_aceptarP;
    private Button but_aceptarPp;
    private Button but_cancelarP;
    private String almacenC;
    private String tipoC;
    private Object[][] tiendaM;
    private Object[][] marcaM;
    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;
    private ComboBox com_cliente;

    //para crear un nuevo tab
    private String[] clienteM;
    public TabPanel tap_panel;
    public KMenu padre;
    public MainEntryPoint panel;

    public SeleccionVentaFecha(Object[][] marca, KMenu kmenu) {
        padre = kmenu;
        //  panel=pan;

        marcaM = marca;
        //kmenu = menu;
        // this.clienteM = new String[]{"KARDEX", "SIN CODIGO"};

        String tituloTabla = "Buscar Fecha Para cerrar dia";
        this.setClosable(true);
        this.setId("TPfun30041");
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

        String nombreBoton1 = "Cerrar Dia Venta";
        String nombreBoton12 = "Cerrar Dia Devolucion";
        String nombreBoton2 = "Cancelar";

        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        //formPanel.setLabelWidth(ANCHO - 400);

        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                GuardarEditarCliente();
            }
        });
        but_aceptarPp = new Button(nombreBoton12, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                GuardarEditarCliente2();
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionVentaFecha.this.destroy();
                SeleccionVentaFecha.this.close();

            }
        });

        dat_fecha = new DateField("Fecha", "d-m-Y");
        Date date = new Date();
        dat_fecha.setValue(Utils.getStringOfDate(date));

        formPanel.add(dat_fecha);
//        com_marca = new ComboBox("Cliente", "cliente",200);
//
//        //formPanel.add(formpanel1);
//        formPanel.add(com_marca);
        addButton(but_aceptarP);
        addButton(but_aceptarPp);
        addButton(but_cancelarP);
        add(formPanel);
    // initCombos();
    //addListeners();
    }

//   private void onChangeempresa() {
//        if (com_marca.getValue().equalsIgnoreCase("")) {
//                   MessageBox.alert("Seleccione un cliente");
//
//        } else {
//         // String codigoCliente = com_marca.getValueAsString().trim();
//             GuardarEditarCliente();
//        }
// }
//    private void addListeners() {
//          com_marca.addListener(new ComboBoxListenerAdapter() {
//
//            @Override
//            public void onSelect(ComboBox comboBox, Record record, int index) {
//                onChangeempresa();
//            }
//        });
//
//           com_marca.addListener(new TextFieldListenerAdapter() {
//            @Override
//            public void onSpecialKey(Field field, EventObject e) {
//                if (e.getKey() == EventObject.ENTER) {
//              GuardarEditarCliente();
//
//                }
//            }
//
//
//        });
//
//
//    }
//    private void initCombos() {
//
//
//        com_marca.setValueField("idcliente");
//        com_marca.setDisplayField("codigo");
//        com_marca.setMinChars(1);
//        com_marca.setFieldLabel("codigo");
//        com_marca.setMode(ComboBox.LOCAL);
//        com_marca.setEmptyText("Seleccione un cliente");
//        com_marca.setLoadingText("Buscando");
//        com_marca.setTypeAhead(true);
//        com_marca.setSelectOnFocus(true);
//        com_marca.setHideTrigger(true);
//
//        SimpleStore cotegoriaStore = new SimpleStore(new String[]{"idcliente", "codigo"}, marcaM);
//        cotegoriaStore.load();
//        com_marca.setStore(cotegoriaStore);
//
//    }
    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_aceptarpp() {
        return but_aceptarPp;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

    public void GuardarEditarCliente() {
        String fechav = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
        String enlace = "php/Cobros.php?funcion=verificarcierrecobros&fechav=" + fechav;
        final Conector conec = new Conector(enlace, false, "POST");
        try {
            conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                public void onResponseReceived(Request request, Response response) {
                    //String dato;
                    String data = response.getText();
                    JSONValue jsonValue = JSONParser.parse(data);
                    JSONObject jsonObject;
                    if ((jsonObject = jsonValue.isObject()) != null) {
                        String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                        String valorcierre = Utils.getStringOfJSONObject(jsonObject, "resultado");
                        if((valorcierre=="true")||(valorcierre=="TRUE")){

                            final String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");

                            JSONObject usuarioSoU = new JSONObject();
                            usuarioSoU.put("fecha", new JSONString(fechaent));

                            String datos = "resultado=" + usuarioSoU.toString();

                            String enlace = "php/Cobros.php?funcion=Confirmarventas&" + datos;
                            Utils.setErrorPrincipal("Guardando ", "cargar");
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
                                                MessageBox.alert("Se confirmo exitosamente");
                                            } else {
                                                MessageBox.alert("Existen un error" + mensajeR);
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
                        }
                        else{
                            MessageBox.alert("No puede confirmar ventas no se realizo el cierre del cobro " + valorcierre);
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
    }

    public void GuardarEditarCliente2() {
        final String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
        JSONObject usuarioSoU = new JSONObject();
        usuarioSoU.put("fecha", new JSONString(fechaent));
        String datos = "resultado=" + usuarioSoU.toString();
        String enlace = "php/Cobros.php?funcion=Confirmardevolucion&" + datos;
        Utils.setErrorPrincipal("Guardando ", "cargar");
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
                            MessageBox.alert("Se confirmo exitosamente");
                        } else {
                            MessageBox.alert("Existen un error" + mensajeR);
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
    }
}
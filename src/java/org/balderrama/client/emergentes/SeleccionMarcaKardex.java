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
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.Record;
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

import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import org.balderrama.client.cliente.PanelCreditoRegistro;

public class SeleccionMarcaKardex extends Window {

    private final int ANCHO = 300;
    private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    //private ComboBox com_tienda;
    private ComboBox com_marca;
    private Label label = new Label("2");
    //private Panel formpanel1;
    private Button but_aceptar;
    private Button but_aceptarP;
    private Button but_cancelarP;
    //private String almacenC;
    //private String tipoC;
    //private Object[][] tiendaM;
    private Object[][] marcaM;
    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;
    //private ComboBox com_cliente;
    //para crear un nuevo tab
    //private String[] clienteM;

    public TabPanel tap_panel;
    public KMenu padre;
    public MainEntryPoint panel;
   
    public SeleccionMarcaKardex(Object[][] marca, KMenu kmenu) {
        padre = kmenu;
        marcaM = marca;
        String tituloTabla = "Buscar Cliente Historial Cobro";
        this.setClosable(true);
        this.setId("TPfun1030");
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

    public void onModuleLoad(){
        //setId("win-Clientes");
        String nombreBoton1 = "Mostrar Creditos";
        String nombreBoton12 = "Ver Saldo Real";
        String nombreBoton2 = "Cancelar";

        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        //formPanel.setLabelWidth(ANCHO - 400);
        but_aceptar = new Button(nombreBoton12, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                GuardarEditarClientenuevo();
            }
        });

        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                GuardarEditarCliente();
            }
        });

        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionMarcaKardex.this.destroy();
                SeleccionMarcaKardex.this.close();
              }
        });
        com_marca = new ComboBox("Cliente", "idcliente",200);
        //formPanel.add(formpanel1);
        formPanel.add(com_marca);
        addButton(but_aceptar);
        addButton(but_aceptarP);
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
        addListeners();
    }

    private void onChangeempresa() {
        if (com_marca.getValue().equalsIgnoreCase("")) {
            MessageBox.alert("Seleccione un cliente");

        } else {
         // String codigoCliente = com_marca.getValueAsString().trim();
            GuardarEditarCliente();
        }
    }

    private void addListeners() {
        com_marca.addListener(new ComboBoxListenerAdapter() {
            @Override
            public void onSelect(ComboBox comboBox, Record record, int index) {
               // onChangeempresa();
            }
        });

        com_marca.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                ////if (e.getKey() == EventObject.ENTER) {
                ////    GuardarEditarClientenuevo();
                ////}
            }
        });


    }

    private void initCombos() {     
        com_marca.setValueField("idcliente");
        com_marca.setDisplayField("codigo");
        com_marca.setMinChars(1);
        com_marca.setFieldLabel("codigo");
        com_marca.setMode(ComboBox.LOCAL);
        com_marca.setEmptyText("Seleccione un cliente");
        com_marca.setLoadingText("Buscando");
        com_marca.setTypeAhead(true);
        com_marca.setSelectOnFocus(true);
        com_marca.setHideTrigger(true);  
        SimpleStore cotegoriaStore = new SimpleStore(new String[]{"idcliente", "codigo"}, marcaM);
        cotegoriaStore.load();
        com_marca.setStore(cotegoriaStore);
    }

    public Button getBut_aceptara() {
        return but_aceptar;
    }


    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

    public void GuardarEditarCliente() {
    final String idcliente = com_marca.getValueAsString().trim();
    final String Todo = "todo";
    String enlace = "php/CobroMayor.php?funcion=BuscarCuentasCliente&idcliente=" + idcliente + "&idcuenta=" + Todo;
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
                                    //Object[][] clientes = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo", "nombre", "item"});
                                    Object[][] vendedores = Utils.getArrayOfJSONObject(marcaO, "empleadoM", new String[]{"idempleado", "codigo"});
                                   // Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "tiendaM", new String[]{"idtienda", "nombre"});
                                    String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombrecliente");
                                    String porpagar = Utils.getStringOfJSONObject(marcaO, "porpagar");
                                    String venta = Utils.getStringOfJSONObject(marcaO, "montoventa");
                                    String devolucion = Utils.getStringOfJSONObject(marcaO, "devolucion");
                                    String rebaja = Utils.getStringOfJSONObject(marcaO, "rebaja");
                                    String pagado = Utils.getStringOfJSONObject(marcaO, "pagado");
                                    String porcobrar = Utils.getStringOfJSONObject(marcaO, "porcobrar");
                                    PanelCobro pan_compraDirecta = new PanelCobro(idcliente, codigo, nombre, porpagar, venta, devolucion,rebaja,pagado,porcobrar,vendedores,SeleccionMarcaKardex.this,panel,padre);
                                  //  PanelCobrosEmpresa pan_compraDirecta = new PanelCobrosEmpresa(idempresa, codigo, nombre, responsable, comision, planilla,mes1,mes2,mes3, vendedores, cobro1,cobro2,cobro3,cobro11,cobro22,cobro33,mesanio1,mesanio2,mesanio3,mesanio4,mesanio5,mesanio6, ConsultaEmpresa.this,panel);
                                    padre.seleccionarOpcion(null, "fun5015", e, pan_compraDirecta);
                                    SeleccionMarcaKardex.this.clear();
                                    SeleccionMarcaKardex.this.close();
                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + idcliente, "mensaje");
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

    public void GuardarEditarClientenuevo() {
    //final String idkardex = "kar-0";
    final String idcliente = com_marca.getValueAsString().trim();
    String enlace = "php/IngresoAlmacen.php?funcion=Cargardatoscliente&idmarca=" + idcliente;
    Utils.setErrorPrincipal("Cargando parametros", "cargar");
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
                        String cliente = Utils.getStringOfJSONObject(marcaO, "codigo");
                        String saldo = Utils.getStringOfJSONObject(marcaO, "saldo");
                        Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                        Object[][] vendedor = Utils.getArrayOfJSONObject(marcaO, "empleadoM", new String[]{"idempleado", "codigo"});
                        String fechaini = Utils.getStringOfJSONObject(marcaO, "fechainicio");
                        String fechafin = Utils.getStringOfJSONObject(marcaO, "fechafin");
                        //com.google.gwt.user.client.Window.alert(" cliente " + cliente + " saldo " + saldo + " ini " + fechaini + " fin " + fechafin);
                        PanelCreditoRegistro pan_compraDirecta = new PanelCreditoRegistro(idcliente, saldo, cliente, colores, vendedor, fechaini, fechafin, SeleccionMarcaKardex.this, padre, panel);
                        padre.seleccionarOpcion(null, "fun50153", e, pan_compraDirecta);
                        SeleccionMarcaKardex.this.clear();
                        SeleccionMarcaKardex.this.close();
                        Utils.setErrorPrincipal("Se cargaron los parametros Correctamente"  , "mensaje");
                    } else {
                        MessageBox.alert("No Hay datos en la consulta");
                }
            }
            else{
                Utils.setErrorPrincipal(mensajeR, "mensaje");
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
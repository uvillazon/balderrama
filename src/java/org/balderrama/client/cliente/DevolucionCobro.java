package org.balderrama.client.cliente;
import org.balderrama.client.sistemadetalle.*;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.google.gwt.user.client.Window;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.core.RegionPosition;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.data.Store;
import com.gwtext.client.util.DateUtil;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.PaddedPanel;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextArea;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.event.EditorGridListenerAdapter;
import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;
import com.gwtext.client.widgets.layout.BorderLayout;
import com.gwtext.client.widgets.layout.BorderLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.FormLayout;
import com.gwtext.client.widgets.layout.HorizontalLayout;
import com.gwtext.client.widgets.layout.TableLayout;
import com.gwtext.client.widgets.layout.TableLayoutData;
import java.util.Date;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
import org.balderrama.client.sistemadetalle.ProductoProforma;
import org.balderrama.client.cliente.EditarNuevoCliente;

public class DevolucionCobro extends Panel {

    //private SeleccionMarcaCliente SM;
    private String COMPRA_DIRECTA_TABBED = "9610000_cobro-";
    private TextField tex_encargado;
    private TextField tex_boleta;
    private TextField tex_tipocambio;
    private TextField tex_modeloCP;
    private TextField tex_totalpares;
    private TextField tex_totalbs;
    private TextField tex_totalsus;
    private TextField tex_totalcaja;
    private DateField dat_fecha;
    //public ListaProductosDev lista2;
    boolean respuesta = false;
    private TextArea tea_descripcion;
    private Button but_aceptar;
    private Button but_cancelar;
    public KMenu kmenu;
    String selecionado = "";
    String marca;
    String idmarca;
    String numeropedido;
    String modelo;
    String opciona;
    String opcion;
    String opcionnueva;
    String opciontalla;
    String iddetalleingreso;
    private Store proveedorStore11;
    Object[][] clienteM;
    Object[][] marcaM;
    Object[][] vendedorM;
    private String[] tipoM;
    String opcionb;
    String encargado;
    String fmayor;
    public ComboBox com_cliente;
    public ComboBox com_tipo;
    public ComboBox com_marca;
    private ComboBox com_vendedor;
    public TextField tex_codigoBarra;
    //private EditarNuevoCliente formulario;
    private String[] estadoM;

    public DevolucionCobro(String idmarca, String marca, String boleta, String vendedor, Object[][] vendedores,Object[][] clientes, Object[][] marcass, String tipocambio, String almacen,  KMenu padre) {
        //this.SM = SM;
        estadoM = new String[]{"NORMAL", "FALLA", "CAMBIO"};
        this.kmenu = padre;
        this.marca = marca;
        this.idmarca = idmarca;
        this.numeropedido = boleta;
        this.opcionb = vendedor;
        this.vendedorM = vendedores;
        this.marcaM = marcass;
        this.clienteM = clientes;
        this.opcion = tipocambio;
        this.encargado = almacen;
        onModuleLoad();
    }

    public void onModuleLoad() {

        setId("tab-" + COMPRA_DIRECTA_TABBED);
        setTitle("Devolucion por Falla");
        setLayout(new FitLayout());
        setBaseCls("x-plain");
        this.setClosable(true);
        this.setId("TPfun50160");
        setIconCls("tab-icon");

        Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");

        Panel pan_centro = new Panel();
        pan_centro.setLayout(new FormLayout());
        //pan_centro.setWidth(10);
        //pan_centro.setHeight(6);

        Panel pan_norte = new Panel();
        pan_norte.setLayout(new TableLayout(4));
        pan_norte.setBaseCls("x-plain");
        pan_norte.setHeight(350);
        pan_norte.setPaddings(5);

        Panel pan_sud = new Panel();
        pan_sud.setLayout(new TableLayout(3));
        pan_sud.setBaseCls("x-plain");
        pan_sud.setHeight(150);
        pan_sud.setPaddings(5);
        
        FormPanel for_panel2 = new FormPanel();
        for_panel2.setBaseCls("x-plain");
        for_panel2.setWidth(360);
        for_panel2.setLabelWidth(120);
        
        tex_boleta = new TextField("#Boleta", "boleta", 200);      
        com_marca = new ComboBox("Marca", "idmarca");        
        com_tipo = new ComboBox("TIPO FALLA", "tipofalla");
        com_vendedor = new ComboBox("Vendedor que devuelve", "idempleado");
        com_vendedor.setDisabled(true);
        com_cliente = new ComboBox("Cliente Asignado", "idcliente");
        com_cliente.setDisabled(true);

        for_panel2.add(com_marca);
        for_panel2.add(com_vendedor);
        for_panel2.add(com_cliente);

        FormPanel for_panel3 = new FormPanel();
        for_panel3.setBaseCls("x-plain");
        for_panel3.setWidth(360);
        for_panel3.setLabelWidth(120);

        Panel pan_botonescliente = new Panel();
        pan_botonescliente.setLayout(new HorizontalLayout(2));
        pan_botonescliente.setBaseCls("x-plain");

        dat_fecha = new DateField("Fecha", "d-m-Y");
        Date date = new Date();
        dat_fecha.setValue(Utils.getStringOfDate(date));

        for_panel3.add(tex_boleta);
        for_panel3.add(com_tipo);
        for_panel3.add(dat_fecha);
        for_panel3.add(new PaddedPanel(pan_botonescliente, 5, 5, 5, 5), new TableLayoutData(3));

        pan_norte.add(new PaddedPanel(for_panel2, 15));
        pan_norte.add(new PaddedPanel(for_panel3, 15));

        FormPanel for_panel4 = new FormPanel();
        for_panel4.setBaseCls("x-plain");
        tex_totalpares = new TextField("Total Pares", "totalpares");
        tex_totalsus = new TextField("Total Sus", "totalsus");

        for_panel4.add(tex_totalpares);
        for_panel4.add(tex_totalsus);
      
        FormPanel for_panel6 = new FormPanel();
        for_panel6.setBaseCls("x-plain");
        tea_descripcion = new TextArea("OBS.", "observacion");
        tea_descripcion.setWidth(150);

        for_panel6.add(tea_descripcion);

        Panel pan_botones = new Panel();
        pan_botones.setLayout(new HorizontalLayout(10));
        pan_botones.setBaseCls("x-plain");
        but_aceptar = new Button("Registrar");
        but_cancelar = new Button("Cancelar");
        pan_botones.add(but_aceptar);
        pan_botones.add(but_cancelar);

        pan_sud.add(new PaddedPanel(for_panel4, 0, 0, 13, 10));       
        pan_sud.add(new PaddedPanel(for_panel6, 3, 0, 13, 10));
        pan_sud.add(new PaddedPanel(pan_botones, 10, 200, 10, 10), new TableLayoutData(3));

        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centro, new BorderLayoutData(RegionPosition.CENTER));
        pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        add(pan_borderLayout);

        initCombos();
        initValues();
        addListeners();
    }

    private void initCombos() {
        SimpleStore estadosStore = new SimpleStore("tipofalla", estadoM);
        estadosStore.load();
        com_tipo.setMinChars(1);
        com_tipo.setStore(estadosStore);
        com_tipo.setValueField("tipofalla");
        com_tipo.setFieldLabel("TIPO FALLA");
        com_tipo.setDisplayField("tipofalla");
        com_tipo.setForceSelection(true);
        com_tipo.setMode(ComboBox.LOCAL);
        com_tipo.setTypeAhead(true);
        com_tipo.setSelectOnFocus(true);
        com_tipo.setWidth(200);
        com_tipo.setHideTrigger(true);

        SimpleStore proveedorStore12 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        proveedorStore12.load();
        com_vendedor.setMinChars(1);
        com_vendedor.setStore(proveedorStore12);
        com_vendedor.setValueField("idempleado");
        com_vendedor.setDisplayField("codigo");
        com_vendedor.setForceSelection(true);
        com_vendedor.setMode(ComboBox.LOCAL);
        com_vendedor.setEmptyText("Buscar vendedor");
        com_vendedor.setLoadingText("buscando...");
        com_vendedor.setTypeAhead(true);
        com_vendedor.setSelectOnFocus(true);
        com_vendedor.setWidth(200);
        com_vendedor.setHideTrigger(true);

        SimpleStore proveedorStore123 = new SimpleStore(new String[]{"idcliente", "codigo"}, clienteM);
        proveedorStore123.load();
        com_cliente.setMinChars(1);
        com_cliente.setStore(proveedorStore123);
        com_cliente.setValueField("idcliente");
        com_cliente.setDisplayField("codigo");
        com_cliente.setForceSelection(true);
        com_cliente.setMode(ComboBox.LOCAL);
        com_cliente.setEmptyText("Buscar cliente");
        com_cliente.setLoadingText("buscando...");
        com_cliente.setTypeAhead(true);
        com_cliente.setSelectOnFocus(true);
        com_cliente.setWidth(200);
        com_cliente.setHideTrigger(true);

        SimpleStore proveedorStore1232 = new SimpleStore(new String[]{"idmarca", "nombre"}, marcaM);
        proveedorStore1232.load();
        com_marca.setMinChars(1);
        com_marca.setStore(proveedorStore1232);
        com_marca.setValueField("idmarca");
        com_marca.setDisplayField("nombre");
        com_marca.setForceSelection(true);
        com_marca.setMode(ComboBox.LOCAL);
        com_marca.setEmptyText("Buscar marca");
        com_marca.setLoadingText("buscando...");
        com_marca.setTypeAhead(true);
        com_marca.setSelectOnFocus(true);
        com_marca.setWidth(200);
        com_marca.setHideTrigger(true);

    }

    private void initValues() {
        tex_boleta.setValue(numeropedido);
        //tex_tipocambio.setValue(opcion);
        //tex_totalbs.setValue("0");
        tex_totalsus.setValue("0");
        tex_totalpares.setValue("0");
        //tex_totalcaja.setValue("0");
        com_tipo.setValue("NORMAL");
    }

    private void addListeners() {
        but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                kmenu.seleccionarOpcionRemove(null, "fun50160", e, DevolucionCobro.this);
            }
        });

        //**************************************************
        //************* BOTON ACEPTAR *******************
        //**************************************************
        but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                String vendedor = com_vendedor.getValueAsString();
                String cliente = com_cliente.getValueAsString();
                String marca = com_marca.getValueAsString();
                //String tipo = com_tipo.getValueAsString();
                //String boleta = tex_boleta.getValueAsString();

                if ((!marca.isEmpty())&& (!vendedor.isEmpty())&& (!cliente.isEmpty())) {
                    createCobro(idmarca);
                } else {
                    MessageBox.alert("Asigne Marca, Cliente,Vendedor y boleta .es obligatorio,revise los campos ");
                }
            }
        });

        tex_boleta.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    com_tipo.focus();
                }
            }
        });

        com_marca.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    com_vendedor.setDisabled(false);
                    com_vendedor.focus();
                }
            }
        });

        com_marca.addListener(new ComboBoxListenerAdapter() {

            @Override
            public void onSelect(ComboBox comboBox, Record record, int index) {
                onChangeCategoria();
            }
            private void onChangeCategoria() {
                com_vendedor.setDisabled(false);
                com_vendedor.focus();
            }
        });

        com_vendedor.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    com_cliente.setDisabled(false);
                    com_cliente.focus();
                }
            }
        });

        com_vendedor.addListener(new ComboBoxListenerAdapter() {
            @Override
            public void onSelect(ComboBox comboBox, Record record, int index) {
                onChangeCategoria1();
            }
            private void onChangeCategoria1() {
                com_cliente.setDisabled(false);
                com_cliente.focus();
            }
        });

        com_cliente.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    tex_boleta.setDisabled(false);
                    tex_boleta.focus();
                }
            }
        });
    }


    public void createCobro(String idmarcas) {
        String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");

        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "./php/VentaMayor.php?funcion=txSaveDevoCobro&fecha=" + fechaent;
        final Conector conec = new Conector(url, false, "POST");
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
                        String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
                        Window.alert(idventaG);
                        if (errorR.equalsIgnoreCase("true")) {
                            Utils.setErrorPrincipal(mensajeR, "resultado");
                            //Window.alert(mensajeR);
                            ////String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
                            //Window.alert("iddevolucion" + idventaG);
                            //String enlTemp = "funcion=verboletaventadevolucion&idventa=" + idventaG;
                            //verReporte(enlTemp);
                            //kmenu.seleccionarOpcionRemove(null, "fun50160", e, DevolucionCobro.this);
                            ////MessageBox.alert("Se gravo correctamente la devolucion");
                        } else {
                            Utils.setErrorPrincipal(mensajeR, "error");
                        }
                    } else {
                        Utils.setErrorPrincipal("Error en la respuesta del servidor", "error");
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

    public void closePanel() {
        this.destroy();
    }

//    public void closeTabCompraDirecta() {
//        this.remove("tab-" + COMPRA_DIRECTA_TABBED);
//       SM.panel.getTabPanel().remove("tab-" + COMPRA_DIRECTA_TABBED);
//       this.destroy();
//        }

    private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }

}

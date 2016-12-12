/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.cliente;

/**
 *
 * @author 
 */
import org.balderrama.client.emergentes.SeleccionMarcaKardex;
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
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.event.EditorGridListenerAdapter;
import com.gwtext.client.widgets.layout.BorderLayout;
import com.gwtext.client.widgets.layout.BorderLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.HorizontalLayout;
import com.gwtext.client.widgets.layout.TableLayout;
import com.gwtext.client.widgets.layout.TableLayoutData;

import java.util.Date;
import org.balderrama.client.MainEntryPoint;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;

public class PanelCreditoRegistro extends Panel {

    private clientedeudor SM;
    private SeleccionMarcaKardex SMA;
    //private Panel panel;
    private String COMPRA_DIRECTA_TABBED = "96000_venta-";
    private TextField tex_cliente;
    private TextField tex_fechaini;
    private TextField tex_fechafin;
    private TextField tex_monto;
    String selecionado = "";
    String selvendedor = "";
    private TextField tex_totalpares;
    private TextField tex_totalbs;
    private TextField tex_totalcaja;
    private DateField dat_fecha;
   // private ListaPedidoCalzados lista;
    private ListaDato lista1;
    boolean respuesta = false;
    private TextArea tea_descripcion;
    private Button but_aceptar;
    private Button but_aceptar1;
    private Button but_cancelar;
    private Button but_limpiar;
    private Button but_verproducto;
    public KMenu kmenu;
//    String selecionado = "";
    String cliente;
    String idcliente;
    public MainEntryPoint panel;
    //Object[][] modeloM;
    //Object[][] lineaM;
   //   Object[][] clienteM;
    Object[][] vendedorM;
    Object[][] marcaM;
    String fechaINI;
    String fechaFIN;
    //Object[][] materialM;
      //private String[] tipoM;
    public ComboBox com_cliente;
    public ComboBox com_vendedor;
    String opcionb;
    String opcion;
    private EditarNuevoCliente formulario;
    public KMenu padre;
    String saldocliente;

  public PanelCreditoRegistro(String idcliente, String saldoclient, String cliente, Object[][] marcaM, Object[][] vendedorM, String fechaini, String fechafin, clientedeudor SM,KMenu kmenu) {
    this.SM = SM;
    padre = kmenu;
    this.cliente = cliente;
    this.idcliente = idcliente;
    this.marcaM = marcaM;
    this.vendedorM = vendedorM;
    this.fechaINI = fechaini;
    this.fechaFIN = fechafin;
    this.saldocliente = saldoclient;
    onModuleLoad();
}

    public PanelCreditoRegistro(String idcliente, String saldoclient, String cliente,Object[][] marcaM, Object[][] vendedorM, String fechaini, String fechafin, SeleccionMarcaKardex SMA, KMenu kmenu, MainEntryPoint panel) {
        this.SMA = SMA;
        padre = kmenu;
        this.cliente = cliente;
        this.idcliente = idcliente;
        this.marcaM = marcaM;
        this.vendedorM = vendedorM;
        this.fechaINI = fechaini;
        this.fechaFIN = fechafin;
        this.saldocliente=saldoclient;        
        onModuleLoad();
    }

    public void onModuleLoad() {
        //panel = new Panel();
        setId("tab-" + COMPRA_DIRECTA_TABBED);
        setTitle("Cuentas Marca");
        setLayout(new FitLayout());
        setBaseCls("x-plain");
        this.setClosable(true);
        this.setId("TPfun50153");
        setIconCls("tab-icon");

        Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");

        Panel pan_norte = new Panel();
        pan_norte.setLayout(new TableLayout(4));
        pan_norte.setBaseCls("x-plain");
        pan_norte.setHeight(130);
        pan_norte.setPaddings(5);

        Panel pan_sud = new Panel();
        pan_sud.setLayout(new TableLayout(3));
        pan_sud.setBaseCls("x-plain");
        pan_sud.setHeight(120);
        pan_sud.setPaddings(5);
        
        lista1 = new ListaDato();
        lista1.onModuleLoad5(PanelCreditoRegistro.this, idcliente, vendedorM);
    
        Panel pan_centro = lista1.getPanel();

        FormPanel for_panel1 = new FormPanel();
        for_panel1.setBaseCls("x-plain");
        for_panel1.setWidth(330);
        for_panel1.setLabelWidth(100);
        tex_cliente = new TextField("cliente", "cliente", 200);
        tex_cliente.setValue(cliente);
        tex_cliente.setReadOnly(true);
               
        //com_cliente = new ComboBox("Marca", "idmarca");
        //com_vendedor = new ComboBox("Vendedor", "idempleado");
        tex_fechaini = new TextField("Cobro Inicial", "fechaini", 200);
        tex_fechaini.setValue(fechaINI);
        tex_fechaini.setReadOnly(true);
        tex_fechafin = new TextField("Cobro Final", "fechafin", 200);
        tex_fechafin.setValue(fechaFIN);
        tex_fechafin.setReadOnly(true);
        //tex_monto = new TextField("Monto inicial", "monto", 200);
    
        Panel pan_botonescliente = new Panel();
        pan_botonescliente.setLayout(new HorizontalLayout(2));
        pan_botonescliente.setBaseCls("x-plain");
 //pan_botonescliente.add(but_anadir);
        for_panel1.add(tex_cliente);
       
        FormPanel for_panel2 = new FormPanel();
        for_panel2.setBaseCls("x-plain");
        for_panel2.setWidth(330);
        for_panel2.setLabelWidth(100);

        for_panel2.add(tex_fechaini);
        for_panel2.add(tex_fechafin);
        //for_panel2.add(com_cliente);
        //for_panel2.add(com_vendedor);
        //for_panel2.add(tex_monto);
        for_panel2.add(new PaddedPanel(pan_botonescliente, 5, 5, 5, 5), new TableLayoutData(2));

        FormPanel for_panel3 = new FormPanel();
        for_panel3.setBaseCls("x-plain");
        for_panel3.setWidth(300);
        for_panel3.setLabelWidth(100);

        dat_fecha = new DateField("Fecha Actual", "d-m-Y");
        Date date = new Date();
        dat_fecha.setValue(Utils.getStringOfDate(date));

        for_panel3.add(dat_fecha);

        pan_norte.add(new PaddedPanel(for_panel1, 10));
        pan_norte.add(new PaddedPanel(for_panel2, 10));
        pan_norte.add(new PaddedPanel(for_panel3, 10));
//        pan_norte.add(new PaddedPanel(for_panel12, 0, 0, 13, 10));

        FormPanel for_panel4 = new FormPanel();
        for_panel4.setBaseCls("x-plain");
        //tex_totalpares = new TextField("Total Pares", "totalpares");
        tex_totalbs = new TextField("Total DEUDA POR COBRAR", "totalbs");
        tex_totalcaja = new TextField("Total dif", "totalcaja");
       // for_panel4.add(tex_totalpares);
        for_panel4.add(tex_totalbs);
        for_panel4.add(tex_totalcaja);

        FormPanel for_panel6 = new FormPanel();
        for_panel6.setBaseCls("x-plain");
        tea_descripcion = new TextArea("Observacion", "observacion");
        tea_descripcion.setWidth("100%");

        for_panel6.add(tea_descripcion);

        Panel pan_botones = new Panel();
        pan_botones.setLayout(new HorizontalLayout(10));
        pan_botones.setBaseCls("x-plain");
        //       pan_botones.setHeight(40);
        but_aceptar = new Button("Confirmar Registro");
        but_aceptar1 = new Button("Extracto");
        but_cancelar = new Button("Cancelar");
        but_limpiar = new Button("Limpiar");
        but_verproducto = new Button("VER CUENTA");
        ////pan_botones.add(but_aceptar);
        pan_botones.add(but_aceptar1);
        pan_botones.add(but_cancelar);
        ////pan_botones.add(but_limpiar);
        pan_botones.add(but_verproducto);

        pan_sud.add(new PaddedPanel(for_panel4, 0, 0, 13, 10));
        //pan_sud.add(new PaddedPanel(for_panel5, 0, 0, 13, 10));
        pan_sud.add(new PaddedPanel(for_panel6, 3, 0, 13, 10));
        pan_sud.add(new PaddedPanel(pan_botones, 10, 200, 10, 10), new TableLayoutData(3));


        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centro, new BorderLayoutData(RegionPosition.CENTER));
        pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        add(pan_borderLayout);
        initValues();
        addListeners();
    }

private void initValues() {
    tex_totalbs.setValue(saldocliente);
    tex_totalcaja.setValue("0");
}

private void addListeners() {
        //**************************************************
        //************* BOTON CANCELAR   *******************
        //**************************************************
       but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                padre.seleccionarOpcionRemove(null, "fun50153", e, PanelCreditoRegistro.this);
                AbrirSeleccionCliente();
            }
        });
     
        //**************************************************
        //************* BOTON ACEPTAR *******************
        //**************************************************
        but_verproducto.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                verpanelcuentas(idcliente);
            }
        });

        but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                //createPedido(idcliente);
                createPedidoTemporal(idcliente);
            }
        });

        but_aceptar1.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                final Record[] recordws = lista1.cbSelectionModel.getSelections();
                if (recordws.length > 0) {
//     dataProxy = new ScriptTagProxy("php/CobroMayor.php?funcion=Listardeudasclientepormarcatotal&idcliente=" + idmarca+ "&idcuenta=" + idcuenta);
                   MessageBox.confirm("Para extracto cuentas", "Realmente desea seleccionar " + recordws.length + " item(s)? ", new MessageBox.ConfirmCallback() {
                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                JSONArray productos = new JSONArray();
                                JSONObject productoObject;
                                for (int i = 0; i < recordws.length; i++) {
                                    productoObject = new JSONObject();
                                    productoObject.put("idcredito ", new JSONString(recordws[i].getAsString("idcreditocli")));
                                   // productoObject.put("idcrecliente", new JSONString(recordws[i].getAsString("idcrecliente")));

                                    productos.set(i, productoObject);
                                    productoObject = null;
                                }
                                final String datos = "resultado=" + productos.toString();
                                Utils.setErrorPrincipal("Reporte(s)", "cargar");
                                String url = "./php/Cobros.php?funcion=Registraridreportegral&idcliente=" + idcliente + "&"+datos;
//String url = "./php/IngresoAlmacen.php?funcion=Registrarcodigoporpar&" + datos;

                                final Conector conec = new Conector(url, false, "POST");
                                // com.google.gwt.user.client.Window.alert("error 9999 " + conec.toString());
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
                                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
                                                    Window.alert(mensajeR);
                                                    String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
                   // String enlTemp = "funcion=codbarraporpar&idimpresion=" + idventaG;
                                                    String enlTemp = "funcion=extractoclientegral&idimpresion=" + idventaG;
                                                    verReporte(enlTemp);
                    //  store.reload();
                                                } else {
                                                    //Window.alert(mensajeR);
                                                    com.google.gwt.user.client.Window.alert("error 1000");
                                                    Utils.setErrorPrincipal(mensajeR, "error");
                                                }
                                            } else {
                                                com.google.gwt.user.client.Window.alert("error 1001");
                                                Utils.setErrorPrincipal("Error en la respuesta del servidor", "error");
                                            }
                                        }

                                        public void onError(Request request, Throwable exception) {
                                            //Window.alert("Ocurrio un error al conectar con el servidor ");
                                            com.google.gwt.user.client.Window.alert("error 1002");
                                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                                        }
                                    });
                                } catch (RequestException ex) {
                                    //Window.alert("Ocurrio un error al conectar con el servidor");
                                    com.google.gwt.user.client.Window.alert("error 1003");
                                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                                }
                            }
                        }
                    });
                } else {
                    MessageBox.alert("No hay producto selecionado para editar y/o selecciono mas de uno.");
                }
                but_aceptar1.setPressed(false);

            }
        });
        but_limpiar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                limpiarVentanaVenta();
            }
        });

    }
     
    public void limpiarVentanaVenta() {
        lista1.LimpiarGrid();
        tex_totalpares.setValue("0");
        tex_totalcaja.setValue("0");
        tea_descripcion.setValue(""); 
        //com_empleado.setValue("No existe el Cliente");
    }

    public void createPedido(String idcliente) {
        String descripcion = tea_descripcion.getValueAsString();
        String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
        String marca = com_cliente.getValue();
        String vendedor = com_vendedor.getValue();
        String monto = tex_monto.getValueAsString();
        Record[] records = lista1.getStore().getRecords();
        JSONArray productos = new JSONArray();
        JSONObject productoObject;
        JSONObject compraObject = new JSONObject();
        compraObject.put("idcliente", new JSONString(idcliente));
        compraObject.put("fecharegistro", new JSONString(fechaent));
        compraObject.put("descripcion", new JSONString(descripcion));
        compraObject.put("marca", new JSONString(marca));
        compraObject.put("vendedor", new JSONString(vendedor));
        compraObject.put("monto", new JSONString(monto));
        for (int i = 0; i < records.length; i++) {
            productoObject = new JSONObject();
            productoObject.put("marca", new JSONString(records[i].getAsString("marca")));
            productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
            productoObject.put("saldoant", new JSONString(records[i].getAsString("saldoant")));
            productoObject.put("saldoact", new JSONString(records[i].getAsString("saldoact")));
            productos.set(i, productoObject);
            productoObject = null;       
        }
        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
          //Window.alert(resultado.toString());
        String url = "./php/Cobros.php?funcion=GuardarNuevoCredito&" + datos;
   //     String url = "./php/IngresoAlmacen.php?funcion=GuardarNuevoIngresoExtra&" + datos;
        final Conector conec = new Conector(url, false, "POST");
        try {
            conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {
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
                            Window.alert(mensajeR);
                            final String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
                            kmenu.seleccionarOpcionRemove(null, "fun50153", e, PanelCreditoRegistro.this);
                          // abrirpanelreporte();
                            //MessageBox.alert("Se registro exitosamente");
                            SM.reload();
                            ////AbrirSeleccionCliente();
                        } else {
                             Utils.setErrorPrincipal(mensajeR, "error");
                        }
                    } else {
//                        com.google.gwt.user.client.Window.alert("error 1001");
                        Utils.setErrorPrincipal("Error en la respuesta del servidor", "error");
                    }
                }
                public void onError(Request request, Throwable exception) {
                    //Window.alert("Ocurrio un error al conectar con el servidor ");
//                    com.google.gwt.user.client.Window.alert("error 1002");
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            });
        } catch (RequestException ex) {
            //Window.alert("Ocurrio un error al conectar con el servidor");
//            com.google.gwt.user.client.Window.alert("error 1003");
            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
        }
    //
    }

    public void createPedidoTemporal(String idcliente) {
        Utils.setErrorPrincipal("registrando datos", "cargar");
          //Window.alert(resultado.toString());
        String url = "./php/Cobros.php?funcion=GuardarNuevoCreditoTemporal&";
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
                        if (errorR.equalsIgnoreCase("true")) {
                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                            Window.alert(mensajeR);
                            final String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
                            kmenu.seleccionarOpcionRemove(null, "fun50153", e, PanelCreditoRegistro.this);
                            SM.reload();
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

    public void reload() {
        lista1.getStore().reload();
    }

    public void verpanelcuentas(final String idcliente) {
        Record[] records = lista1.cbSelectionModel.getSelections();
        if (records.length==1) {
            selecionado = records[0].getAsString("idcreditocli");
            selvendedor = records[0].getAsString("vendedor");
            String enlace = "php/CobroMayor.php?funcion=BuscarCuentasCliente&idcliente=" + idcliente + "&idcuenta=" + selecionado;
            Utils.setErrorPrincipal("Cargando parametros ", "cargar selecionado");
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
                                    Object[][] vendedores = Utils.getArrayOfJSONObject(marcaO, "empleadoM", new String[]{"idempleado", "codigo"});
                                    String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombrecliente");
                                    String porpagar = Utils.getStringOfJSONObject(marcaO, "porpagar");
                                    String venta = Utils.getStringOfJSONObject(marcaO, "montoventa");
                                    String devolucion = Utils.getStringOfJSONObject(marcaO, "devolucion");
                                    String rebaja = Utils.getStringOfJSONObject(marcaO, "rebaja");
                                    String pagado = Utils.getStringOfJSONObject(marcaO, "pagado");
                                    String porcobrar = Utils.getStringOfJSONObject(marcaO, "porcobrar");
                                    //MessageBox.alert(" codigo " + codigo + " nombre " + nombre + " porpagar " + porpagar + " venta " + venta + " devolucion " + devolucion + " rebaja " + rebaja + " pagado " + pagado + " porcobrar " + porcobrar + " vendedores " + vendedores  + " fechaini " + fechaINI  + " fechafin " + fechaFIN);
                                    PanelCobroCuenta pan_compraDirecta = new PanelCobroCuenta(selecionado,selvendedor, idcliente, codigo, nombre, porpagar, venta, devolucion, rebaja, pagado, porcobrar, vendedores, fechaINI, fechaFIN, PanelCreditoRegistro.this, panel, padre);
                                    padre.seleccionarOpcion(null, "fun50156", e, pan_compraDirecta);
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
//        }else {
//        if (records.length >1) {
//        selecionado = "todo";
//        String enlace = "php/CobroMayor.php?funcion=BuscarCuentasCliente&idcliente=" + idcliente+ "&idcuenta=" + selecionado;
//        Utils.setErrorPrincipal("Cargando parametros ", "cargar");
//        final Conector conec = new Conector(enlace, false);
//        {
//            try {
//                conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
//                    private EventObject e;
//                    public void onResponseReceived(Request request, Response response) {
//                        String data = response.getText();
//                        JSONValue jsonValue = JSONParser.parse(data);
//                        JSONObject jsonObject;
//                        if ((jsonObject = jsonValue.isObject()) != null) {
//                            String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
//                            String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
//                            if (errorR.equalsIgnoreCase("true")) {
//                                Utils.setErrorPrincipal(mensajeR, "mensaje");

//                                JSONValue marcaV = jsonObject.get("resultado");
//                                JSONObject marcaO;
//                                if ((marcaO = marcaV.isObject()) != null) {
//                                    //Object[][] clientes = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo", "nombre", "item"});
//                                    Object[][] vendedores = Utils.getArrayOfJSONObject(marcaO, "empleadoM", new String[]{"idempleado", "codigo"});
//                                   // Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "tiendaM", new String[]{"idtienda", "nombre"});
//                                    String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
//                                    String nombre = Utils.getStringOfJSONObject(marcaO, "nombrecliente");
//                                    String porpagar = Utils.getStringOfJSONObject(marcaO, "porpagar");
//                                    String venta = Utils.getStringOfJSONObject(marcaO, "montoventa");
//                                    String devolucion = Utils.getStringOfJSONObject(marcaO, "devolucion");
//                                    String rebaja = Utils.getStringOfJSONObject(marcaO, "rebaja");
//                                    String pagado = Utils.getStringOfJSONObject(marcaO, "pagado");
//                                    String porcobrar = Utils.getStringOfJSONObject(marcaO, "porcobrar");
//                                    PanelCobroCuenta pan_compraDirecta = new PanelCobroCuenta("todo",selvendedor,idcliente, codigo, nombre, porpagar, venta, devolucion,rebaja,pagado,porcobrar,vendedores,PanelCreditoRegistro.this,panel,padre);
//                                    padre.seleccionarOpcion(null, "fun50156", e, pan_compraDirecta);
//                                   // SeleccionMarcaKardex.this.clear();
//                                    //SeleccionMarcaKardex.this.close();//
//                                 Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + idcliente, "mensaje");
//                                } else {
//                                    MessageBox.alert("No Hay datos en la consulta");
//                                }
//                            }
//                        } else {
//                        }
//                        throw new UnsupportedOperationException("Not supported yet.");
//                    }
//                    public void onError(Request request, Throwable exception) {
//                        throw new UnsupportedOperationException("Not supported yet.");
//                    }
//                });
//            } catch (RequestException ea) {
//                ea.getMessage();
//                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
//            }

//        }
        }else {
//    MessageBox.alert("Seleccione solo una para ver detalle de esa marca, o todo para ver completo");
            MessageBox.alert("Seleccione solo una para ver detalle de esa marca");
        }
// }
    }

private void AbrirSeleccionCliente() {
    String enlace = "php/Cliente.php?funcion=BuscarClienteActivo";
    final Conector conecaPB = new Conector(enlace, false);
    try {
        conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

            public void onResponseReceived(Request request, Response response) {
                String data = response.getText();
                JSONValue jsonValue = JSONParser.parse(data);
                JSONObject jsonObject;
                if ((jsonObject = jsonValue.isObject()) != null) {
                    String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                    String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                    if (errorR.equalsIgnoreCase("true")) {
                        JSONValue marcaV = jsonObject.get("resultado");
                        JSONObject marcaO;
                        if ((marcaO = marcaV.isObject()) != null) {
                            Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
                            SMA = new SeleccionMarcaKardex(marcaM, padre);
                            SMA.show();
                        }
                    } else {
                        Utils.setErrorPrincipal(mensajeR, "error");                                }
                } else {
                    Utils.setErrorPrincipal("Error en los datos", "error");
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

    public void closePanel() {
        this.destroy();
    }

    public void closeTabCompraDirecta() {
//        this.remove("tab-" + COMPRA_DIRECTA_TABBED);
//       SM.panel.getTabPanel().remove("tab-" + COMPRA_DIRECTA_TABBED);
//       this.destroy();

        }

    private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }

}

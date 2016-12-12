/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.venta;

/**
 *
 * @author
 */
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.core.RegionPosition;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.PaddedPanel;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextArea;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.event.EditorGridListenerAdapter;
import com.gwtext.client.widgets.layout.BorderLayout;
import com.gwtext.client.widgets.layout.BorderLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.HorizontalLayout;
import com.gwtext.client.widgets.layout.TableLayout;
import com.gwtext.client.widgets.layout.TableLayoutData;

import org.balderrama.client.util.Conector;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
//import org.balderrama.client.util.Validacion;

public class PanelPedidoConfirmado1 extends Panel {

//   private Credito SM;
    //private Panel panel;
    private String COMPRA_DIRECTA_TABBED = "970_ventamod-";
   
    private DateField dat_fecha;
    //private ListaPedidoCalzados lista;
    private ListaDetalleVenta lista1;
    boolean respuesta = false;
    private TextArea tea_descripcion;
    private Button but_aceptar;
     private Button but_aceptarE;
    private Button but_aceptarR;
 private Button but_imprimir;
    private Button but_cancelar;
    private Button but_limpiar;
    public KMenu kmenu;
    String selecionado = "";

     String idventa;
//      String boleta;
//      String idcliente;
//      String cliente;
//      String idvendedor;
//      String vendedor;
//      String fecha;
//      String fechalimite;
//      String hora;
//      String totalpares;
//      String totalcajas;
//      String totalbs;
//      String marca;
//      String tipocambio;
//

     Object[][] clienteM;
     Object[][] empleadoM;
       Object[][] vendedorM;
        private ComboBox com_empleado;
    private ComboBox com_cliente;
      private SimpleStore responsablesStore;
       private ListaVenta SM;
    private TextField tex_marca;
    private TextField tex_fecha;
    private TextField tex_totalpares;
    private TextField tex_numeroboleta;
    private TextField tex_totalbs;
    private TextField tex_descuento;
 //   private TextField tex_papeleta;
    private TextField tex_facturanit;
    private TextField tex_tienda;
    private TextField tex_preciototal;
    private String boleta;
    private String idcliente;
    private String cliente;
    private String idvendedor;
    private String vendedor;
    private String fecha;
    private String fechalimite;
    private String totalpares;
    private String totalcajas;
    private String totalbs;
    private String marca;


public PanelPedidoConfirmado1(String idventa, String totalpare, String totalbs, String totalcaja, String marca, String boleta, String idvendedor, String vendedor, String idcliente, String nomcliente, String fecha, String fechalimite, String hora, String tipocambio, Object[][] clientes, Object[][] vendedors, ListaVenta pedido1, KMenu padre) {
          this.SM = pedido1;
         this.kmenu = padre;
        
      this.idventa = idventa;
     this.boleta = boleta;
      this.idcliente = idcliente ;
      this.cliente = nomcliente;
     this.idvendedor = idvendedor ;
      this.vendedor = vendedor;
     this.fecha = fecha;
      this.fechalimite = fechalimite;
//      this.hora = hora;
      this.totalpares = totalpare;
     this.totalcajas = totalcaja ;
     this.totalbs =totalbs ;
     this.marca = marca;
//      this.tipocambio= tipocambio ;
 this.clienteM = clientes;
this.empleadoM = vendedors;

        onModuleLoad();
    }


    

  
    public void onModuleLoad() {
        //panel = new Panel();
        setId("tab-" + COMPRA_DIRECTA_TABBED);
        setTitle("Modificar Venta");
        setLayout(new FitLayout());
        setBaseCls("x-plain");
        this.setClosable(true);
        this.setId("TPfun16089");
        setIconCls("tab-icon");
 //MessageBox.alert(totalbs);
        Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");

        Panel pan_norte = new Panel();
        pan_norte.setLayout(new TableLayout(4));
        pan_norte.setBaseCls("x-plain");
        pan_norte.setHeight(140);
        pan_norte.setPaddings(5);
        Panel pan_sud = new Panel();
        pan_sud.setLayout(new TableLayout(1));
        pan_sud.setBaseCls("x-plain");
        pan_sud.setHeight(60);
        pan_sud.setPaddings(5);
            lista1 = new ListaDetalleVenta();
              lista1.onModuleLoad9(idventa);

     
        Panel pan_centro = lista1.getPanel();

        FormPanel for_panel1 = new FormPanel();
        for_panel1.setBaseCls("x-plain");
        for_panel1.setWidth(350);
        for_panel1.setLabelWidth(100);
       
        tex_marca = new TextField("Cliente", "cliente");
        tex_marca.setValue(cliente);
        tex_marca.setReadOnly(true);
        //tex_marca.setValue(cliente);
        tex_numeroboleta = new TextField("Boleta", "empresa");
        tex_numeroboleta.setValue(boleta);
        tex_numeroboleta.setReadOnly(true);
        //tex_numeropedido.setValue(boleta);
 com_cliente = new ComboBox("Buscar Cliente", "cliente");
        com_cliente.setWidth(180);
 com_empleado = new ComboBox("Buscar Vendedor", "vendedor");
        com_empleado.setWidth(180);

          tex_fecha = new TextField("Fecha Venta", "fecha");
        tex_fecha.setReadOnly(true);
       tex_fecha.setValue(fecha);
        tex_totalpares = new TextField("Total Pares", "totalpares");
        tex_totalpares.setReadOnly(false);
        tex_totalpares.setValue(totalpares);

    tex_totalbs = new TextField("Total Sus", "totalbs");
        tex_totalbs.setReadOnly(false);
        tex_totalbs.setValue(totalbs);

 tex_descuento = new TextField("Marca", "marca");
        tex_descuento.setReadOnly(true);
        tex_descuento.setValue(marca);
     
         tex_facturanit = new TextField("Vendedor", "vendedor");
         tex_facturanit.setReadOnly(true);
       tex_facturanit.setValue(vendedor);

         tex_tienda = new TextField("Cajas", "cajas");
        tex_tienda.setReadOnly(false);
      tex_tienda.setValue(totalcajas);
        for_panel1.add(tex_marca);
        for_panel1.add(tex_facturanit);
  for_panel1.add(com_cliente);
        for_panel1.add(com_empleado);
        // for_panel1.add(tex_modeloCP);
        FormPanel for_panel2 = new FormPanel();
        for_panel2.setBaseCls("x-plain");
        for_panel2.setWidth(200);
        for_panel2.setLabelWidth(100);
        
for_panel2.add(tex_numeroboleta);
for_panel2.add(tex_descuento);
for_panel2.add(tex_fecha);
     //  for_panel2.add(tex_totalbs);
        FormPanel for_panel3 = new FormPanel();
        for_panel3.setBaseCls("x-plain");
        for_panel3.setWidth(300);
        for_panel3.setLabelWidth(100);
     
       // tex_facturanit.setReadOnly(true);
      //  tex_facturanit.setValue(vendedor);
        for_panel3.add(tex_totalpares);
        for_panel3.add(tex_totalbs);
        for_panel3.add(tex_tienda);
     //   for_panel3.add(tex_totalbs);


//        for_panel5.add(tex_mesplanilla);

        pan_norte.add(new PaddedPanel(for_panel1, 10));
        pan_norte.add(new PaddedPanel(for_panel2, 10));
        pan_norte.add(new PaddedPanel(for_panel3, 10));
//        pan_norte.add(new PaddedPanel(for_panel5, 10));
//        pan_norte.add(new PaddedPanel(for_panel12, 0, 0, 13, 10));


        Panel pan_botones = new Panel();
        pan_botones.setLayout(new HorizontalLayout(10));
        pan_botones.setBaseCls("x-plain");
        //       pan_botones.setHeight(40);
        but_aceptar = new Button("Registrar Cambios");
        but_cancelar = new Button("Cancelar");
        but_limpiar = new Button("Limpiar");
        but_aceptarR = new Button("Desglozar Venta");
but_imprimir = new Button("Imprimir Lista");
        //pan_botones.add(but_imprimir);
        //but_verproducto = new Button("Ver Producto");
        pan_botones.add(but_aceptar);
        pan_botones.add(but_cancelar);
     //  pan_botones.add(but_aceptarR);

        pan_sud.add(new PaddedPanel(pan_botones, 10, 200, 10, 10), new TableLayoutData(3));


        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centro, new BorderLayoutData(RegionPosition.CENTER));
        pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        add(pan_borderLayout);

        //initCombos();
       // initvalues();
        addListeners();
initvalues();

    }
private void initvalues() {


SimpleStore empresasStoreq = new SimpleStore(new String[]{"idempleado", "nombre"}, empleadoM);
        empresasStoreq.load();
        com_empleado.setMinChars(1);
        com_empleado.setFieldLabel("Vendedor Nuevo");
        com_empleado.setStore(empresasStoreq);
        com_empleado.setDisplayField("nombre");
        com_empleado.setValueField("idempleado");
        com_empleado.setMode(ComboBox.LOCAL);
        com_empleado.setEmptyText("Buscar Empleado");
        com_empleado.setLoadingText("buscando...");
        com_empleado.setTypeAhead(true);
        com_empleado.setHideTrigger(true);
     

        SimpleStore empresasStore = new SimpleStore(new String[]{"idcliente", "nombre"}, clienteM);
        empresasStore.load();
        com_cliente.setMinChars(1);
        com_cliente.setFieldLabel("Cliente Nuevo");
        com_cliente.setStore(empresasStore);
        com_cliente.setDisplayField("nombre");
        com_cliente.setValueField("idcliente");
        com_cliente.setMode(ComboBox.LOCAL);
        com_cliente.setEmptyText("Buscar Cliente Nuevo");
        com_cliente.setLoadingText("buscando...");
        com_cliente.setTypeAhead(true);
        com_cliente.setHideTrigger(true);

       

    }

    private void addListeners() {
        
       
but_imprimir.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
//                imprimirCompra("mismo");
            }
        });
        //**************************************************
        //************* BOTON CANCELAR   *******************
        //**************************************************
        but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
kmenu.seleccionarOpcionRemove(null, "fun16089", e, PanelPedidoConfirmado1.this);

 //               closeTabCompraDirecta();
            }
        });
        //**************************************************
        //************* BOTON ACEPTAR *******************
        //**************************************************
         but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
           String vendedor = com_empleado.getValueAsString();
                    String cliente = com_cliente.getValueAsString();

 if ( (!cliente.isEmpty())&& (!vendedor.isEmpty())) {
                 createPedido(idventa);
     } else {
             MessageBox.alert("Asigne Cliente,Vendedor es obligatorio,o solo confirmelos por favor revise los campos ");
                }
  
                
//                }
            }
        });
    but_aceptarR.addListener(new ButtonListenerAdapter() {

            @Override

            public void onClick(Button button, EventObject e) {
//                  formulario2 = null;

//        Record[] records = lista1.cbSelectionModel.getSelections();
//                if (records.length == 1) {
//                    selecionado = records[0].getAsString("precio2");
//                      }
                    Float to4 = new Float(0);
                                            for (int i = 0; i < lista1.cbSelectionModel.getSelections().length; i++) {
                                                Record[] records = lista1.cbSelectionModel.getSelections();
                                                to4 += records[i].getAsFloat("precio2");
                                            }
//          formulario2 = new NuevaBoleta(to4,idventa,PanelPedidoConfirmado1.this);
//                //  formulario2 = new NuevaBoleta(selecionado,idventa,PanelPedidoConfirmado1.this);
//                  formulario2.show();
        // createPedido2(idventa,idcredit);

            }
        });


        lista1.getGrid().addEditorGridListener(new EditorGridListenerAdapter() {

            @Override
            public void onAfterEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
             //   calcularSubTotal(grid, record, field, newValue, oldValue, rowIndex, colIndex);
            }
        });
    }
   
    public void createPedido(String idventa) {
         String idempresa1 = com_empleado.getValueAsString().trim();
        String idcliente1 = com_cliente.getValueAsString().trim();
     // String factura = tex_facturanit.getValueAsString().trim();
//    for_panel3.add(tex_totalpares);
//        for_panel3.add(tex_totalbs);
//        for_panel3.add(tex_tienda);
        String pares = tex_totalpares.getValueAsString().trim();
        String sus = tex_totalbs.getValueAsString().trim();
        String cajas = tex_tienda.getValueAsString().trim();
        Record[] records = lista1.getStore().getRecords();
   JSONArray productos = new JSONArray();
        JSONObject productoObject;
         JSONObject compraObject = new JSONObject();
            compraObject.put("idventa", new JSONString(idventa));
            // compraObject.put("idcredito", new JSONString(idcredit));
            compraObject.put("idempresa", new JSONString(idempresa1));
            compraObject.put("idcliente", new JSONString(idcliente1));
           compraObject.put("sus", new JSONString(sus));
              compraObject.put("cajas", new JSONString(cajas));
                 compraObject.put("pares", new JSONString(pares));
            
            for (int i = 0; i < records.length; i++) {
                   // MessageBox.alert("entro For Lista"+records[i].getAsString("iddetalleingreso"));
                                        productoObject = new JSONObject();
                productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
              //  productoObject.put("iditemventa", new JSONString(records[i].getAsString("iditemventa")));

                //productoObject.put("idempleado", new JSONString(records[i].getAsString("vendedor")));

                                        productos.set(i, productoObject);
                                        productoObject = null;
                                }
        JSONObject resultado = new JSONObject();
        resultado.put("venta", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "./php/VentaMayor.php?funcion=ActualizarVentaModificada&" + datos;
 final Conector conec = new Conector(url, false, "POST");
        // com.google.gwt.user.client.Window.alert("error 9999 " + conec.toString());
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
                             String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
                              //  String enlTemp = "funcion=reporteventaHTML&idventadetalle=" + idventaG;

kmenu.seleccionarOpcionRemove(null, "fun16089", e, PanelPedidoConfirmado1.this);
// String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
                    //  FormularioKardexVenta kardex;
  String enlTemp = "funcion=verboletaventa&idventa=" + idventaG;
  verReporte(enlTemp);
//SM.store1016.reload();
                 //           closeTabCompraDirecta();
//closeTabCompraDirectaFin();
  //closePanel();
        
//         verReporte(enlTemp);
                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                        } else {
                            //Window.alert(mensajeR);
                            com.google.gwt.user.client.Window.alert("No se puede realizar la venta");
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
//            com.google.gwt.user.client.Window.alert("error 1003");
                Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
            }
    //
    }

  

    public void closePanel() {
        this.destroy();
    }

           private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
    public void closeTabCompraDirecta() {
      
        this.destroy();
    }
}

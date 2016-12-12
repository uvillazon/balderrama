/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

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
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.event.EditorGridListenerAdapter;
import com.gwtext.client.widgets.layout.BorderLayout;
import com.gwtext.client.widgets.layout.BorderLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.FormLayout;
import com.gwtext.client.widgets.layout.HorizontalLayout;
import com.gwtext.client.widgets.layout.TableLayout;
import com.gwtext.client.widgets.layout.TableLayoutData;

import java.util.Date;
import org.balderrama.client.emergentes.SeleccionMarcaTienda;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;

//import org.balderrama.client.util.Validacion;


public class PanelPedidoEE extends Panel {

    private SeleccionMarcaTienda SM;
    //private Panel panel;
    private String COMPRA_DIRECTA_TABBED = "9610000_venta-";
  private TextField tex_marca;
   // private TextField tex_encargado;
    private TextField tex_boleta;
    private TextField tex_numeropedido;
    private TextField tex_modeloCP;
    private TextField tex_totalpares;
     private TextField tex_totalbs;
    private TextField tex_totalcaja;
    private DateField dat_fecha;
    private ListaCalzadoPedidoTalla lista1;
   public ListaCalzadoPedidoTalla2 lista2;
    boolean respuesta = false;
    private TextArea tea_descripcion;
    private Button but_aceptar;
    private Button but_cancelar;
    private Button but_limpiar;
    private Button but_anadir;
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
    //Object[][] estiloM;
    Object[][] colorM;
    Object[][] materialM;
       Object[][] vendedorM;
  private String[] tipoM;
     public ComboBox com_vendedor;
    String opcionb;
    String encargado;
    private ComboBox com_cliente;
  public PanelPedidoEE(String idmarca, String marca, String numeropedido, String encargado,String opcion,Object[][] clienteM, Object[][] colorM, Object[][] materialM, String opcionb,Object[][] vendedorM, SeleccionMarcaTienda SM,KMenu kmenu) {
//nike
      this.tipoM = new String[]{"M","W","GS"};
        this.SM = SM;
        this.kmenu = kmenu;
        this.marca = marca;
        this.idmarca = idmarca;
        this.numeropedido = numeropedido;
        this.opcionb = opcion;
        this.clienteM = clienteM;
        this.materialM = materialM;
     this.vendedorM = vendedorM;
        this.colorM = colorM;
        //this.modeloM = modeloM;
        this.opcion = opcionb;
        this.encargado = encargado;
        onModuleLoad();
    }


    public void onModuleLoad() {
        //panel = new Panel();
        setId("tab-" + COMPRA_DIRECTA_TABBED);
        setTitle("Items");
        setLayout(new FitLayout());
        setBaseCls("x-plain");
        this.setClosable(true);
        this.setId("TPfun50161");
        setIconCls("tab-icon");

        Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");
 Panel pan_centrofin = new Panel();
       pan_centrofin.setLayout(new FormLayout());
        pan_centrofin.setWidth(1300);
        pan_centrofin.setHeight(600);

        Panel pan_norte = new Panel();
        pan_norte.setLayout(new TableLayout(3));
        pan_norte.setBaseCls("x-plain");
        pan_norte.setHeight(98);
        pan_norte.setPaddings(5);

        Panel pan_sud = new Panel();
        pan_sud.setLayout(new TableLayout(3));
        pan_sud.setBaseCls("x-plain");
        pan_sud.setHeight(120);
        pan_sud.setPaddings(5);
//if (opcion.equalsIgnoreCase("4")) {
            //nike
//             lista1 = new ListaCalzadoPedidoTalla();
// lista1.onModuleLoad1();
// opcionnueva = "102";
  //      }


     //   Panel pan_centro = lista1.getPanel();

        FormPanel for_panel1 = new FormPanel();
        for_panel1.setBaseCls("x-plain");
        for_panel1.setWidth(330);
        for_panel1.setLabelWidth(100);
    tex_marca = new TextField("Marca", "marca", 200);
        tex_marca.setValue(marca);
        tex_marca.setReadOnly(true);
        com_vendedor = new ComboBox("Vendedor", "idempleado");
//         tex_encargado = new TextField("Encargado", "encargado", 200);
//        tex_encargado.setValue(encargado);
//        tex_encargado.setReadOnly(true);
        tex_boleta = new TextField("#Proforma", "boleta", 200);
tex_boleta.focus();
 com_cliente = new ComboBox("Cliente/almacen", "idcliente");
         // tex_modeloCP = new TextField("Modelo CP", "idmodelo", 200);
        //tex_modeloCP.setValue("idmodelo");
tex_numeropedido = new TextField("Codigo Registro", "numeropedido", 200);
        tex_numeropedido.setReadOnly(true);
        tex_numeropedido.setValue(numeropedido);
//com_estilo = new ComboBox("Estilos", "idestilo");
//com_estilo.focus();
        for_panel1.add(tex_marca);
         for_panel1.add(tex_numeropedido);
  for_panel1.add(com_vendedor);

        FormPanel for_panel2 = new FormPanel();
        for_panel2.setBaseCls("x-plain");
        for_panel2.setWidth(330);
        for_panel2.setLabelWidth(100);

        but_anadir = new Button("Anadir modelo nuevo");
        Panel pan_botonescliente = new Panel();
        pan_botonescliente.setLayout(new HorizontalLayout(2));
        pan_botonescliente.setBaseCls("x-plain");
 pan_botonescliente.add(but_anadir);

tex_modeloCP = new TextField("Registrar Modelos", "idmodelo", 200);
        for_panel2.add(tex_boleta);
        for_panel2.add(com_cliente);
      for_panel2.add(tex_modeloCP);

 //for_panel2.add(new PaddedPanel(pan_botonescliente, 5, 5, 5, 5), new TableLayoutData(2));

        FormPanel for_panel3 = new FormPanel();
        for_panel3.setBaseCls("x-plain");
        for_panel3.setWidth(300);
        for_panel3.setLabelWidth(100);

         dat_fecha = new DateField("Fecha", "d-m-Y");
        Date date = new Date();
        dat_fecha.setValue(Utils.getStringOfDate(date));

        for_panel3.add(dat_fecha);



        pan_norte.add(new PaddedPanel(for_panel1, 10));
        pan_norte.add(new PaddedPanel(for_panel2, 10));
        pan_norte.add(new PaddedPanel(for_panel3, 10));
//        pan_norte.add(new PaddedPanel(for_panel12, 0, 0, 13, 10));

        FormPanel for_panel4 = new FormPanel();
        for_panel4.setBaseCls("x-plain");
        tex_totalpares = new TextField("Total Pares", "totalpares");
        tex_totalbs = new TextField("Total Bs", "totalbs");

        tex_totalcaja = new TextField("Total Caja", "totalcaja");

        for_panel4.add(tex_totalpares);
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
        but_aceptar = new Button("registrar ");
        but_cancelar = new Button("Cancelar");
        but_limpiar = new Button("Limpiar");
        //but_verproducto = new Button("Ver Producto");
        pan_botones.add(but_aceptar);
        pan_botones.add(but_cancelar);
        pan_botones.add(but_limpiar);
        //pan_botones.add(but_verproducto);

        pan_sud.add(new PaddedPanel(for_panel4, 0, 0, 13, 10));
        //pan_sud.add(new PaddedPanel(for_panel5, 0, 0, 13, 10));
        pan_sud.add(new PaddedPanel(for_panel6, 3, 0, 13, 10));
        pan_sud.add(new PaddedPanel(pan_botones, 10, 200, 10, 10), new TableLayoutData(3));
//if (opcion.equalsIgnoreCase("4")) {
            //nike
             lista2 = new ListaCalzadoPedidoTalla2();
 lista2.onModuleLoad1(colorM,materialM,clienteM,tipoM,vendedorM,idmarca);
// lista2.onModuleLoad1(colorM,materialM,clienteM);

 opcionnueva = "102";
  //    }

  Panel pan_oeste = lista2.getPanel();
      //    pan_centrofin.add(pan_centro);
         pan_centrofin.add(pan_oeste);
        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centrofin, new BorderLayoutData(RegionPosition.CENTER));
        pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        add(pan_borderLayout);

       initCombos();
        initValues();
        addListeners();

    }
 private void initCombos() {


         SimpleStore proveedorStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, clienteM);
        proveedorStore1.load();


        com_cliente.setMinChars(1);
        //com_modeloCV.setFieldLabel("Modelo");
        com_cliente.setStore(proveedorStore1);
        com_cliente.setValueField("codigo");
        com_cliente.setDisplayField("codigo");
        com_cliente.setForceSelection(true);
        com_cliente.setMode(ComboBox.LOCAL);
        com_cliente.setEmptyText("Buscar almacen");
        com_cliente.setLoadingText("buscando...");
        com_cliente.setTypeAhead(true);
        com_cliente.setSelectOnFocus(true);
        com_cliente.setWidth(130);
//String valor = com_modeloCV.setDisplayField("codigo");
        com_cliente.setHideTrigger(true);
 SimpleStore proveedorStore13 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        proveedorStore13.load();
        com_vendedor.setMinChars(1);
        com_vendedor.setStore(proveedorStore13);
        com_vendedor.setValueField("codigo");
        com_vendedor.setDisplayField("codigo");
        com_vendedor.setForceSelection(true);
        com_vendedor.setMode(ComboBox.LOCAL);
       // com_cliente.setEmptyText("Buscar almacen");
        //com_cliente.setLoadingText("buscando...");
        com_vendedor.setTypeAhead(true);
        com_vendedor.setSelectOnFocus(true);
        com_vendedor.setWidth(200);
        com_vendedor.setHideTrigger(true);

    }
private void initValues() {
        //com.google.gwt.user.client.Window.alert("//" + tipocambio);
 tex_totalbs.setValue("0");
com_vendedor.setValue(encargado);
        tex_totalpares.setValue("0");
        tex_totalcaja.setValue("0");

    }
  private void addListeners() {

       but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
kmenu.seleccionarOpcionRemove(null, "fun50161", e, PanelPedidoEE.this);
 abrirpanelreporte();
              //  closeTabCompraDirecta();
            }
        });
        //**************************************************
        //************* BOTON ACEPTAR *******************
        //**************************************************
        but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
//                if (Multivendedo.equalsIgnoreCase("SI")) {
//                    procesoValidar();
//                } else {
                createPedido(idmarca);
//                }
            }
        });


        but_limpiar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                limpiarVentanaVenta();
            }
        });

        tex_boleta.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    com_cliente.focus();
                }
            }
        });
com_cliente.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    tex_modeloCP.focus();
                }
            }
        });
 tex_modeloCP.addListener(new TextFieldListenerAdapter() {
          @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                       String idmodelo = tex_modeloCP.getValueAsString().trim();
                    //String idproductos = tex_producto.getValueAsString().trim();
                    if (idmodelo.isEmpty()) {
                        MessageBox.alert("Por favor ingrese el modelo .");
                        tex_modeloCP.focus();
                    } else {
                      String idmodelo1 = tex_modeloCP.getValueAsString().trim();
                         cargarProducto(idmodelo1);
                         tex_modeloCP.setValue("");
                          tex_modeloCP.focus();

                    }
                }
            }
 private void cargarProducto(String modelo) {

                String idProducto;
                String nombre;
                String unidad;
                String preciounitario;
                if (modelo != null) {
                    String vendedor = com_vendedor.getValueAsString();
             String fecha = DateUtil.format(dat_fecha.getValue(), "m-Y");

 String cliente = com_cliente.getValueAsString();
 String talla = "M";
  Record registroCompra = lista2.getRecordDef().createRecord(new Object[]{
      "",modelo,"",cliente,vendedor,fecha,1, 0,0,talla,0,0,0,0,0,0, 0, 0, 0, 0, 0,0,0,0, 0, 0,0,0,0, 0,0,0,0, 0, 0,0,0,});
                                                lista2.getGrid().stopEditing();
                                                lista2.getGrid().getStore().insert(0, registroCompra);
                                                lista2.getGrid().startEditing(0, 0);

                                               Float to = new Float(0);
                                            for (int i = 0; i < lista2.getStore().getRecords().length; i++) {
                                                to += lista2.getStore().getRecords()[i].getAsFloat("totalpares");
                                            }
                                             tex_totalpares.setValue(to.toString());
                                             Float top = new Float(0);
                                            for (int i = 0; i < lista2.getStore().getRecords().length; i++) {
                                                top += lista2.getStore().getRecords()[i].getAsFloat("totalparesbs");
                                            }
                                             tex_totalbs.setValue(top.toString());
                                              Float toc = new Float(0);
                                            for (int i = 0; i < lista2.getStore().getRecords().length; i++) {
                                                toc += lista2.getStore().getRecords()[i].getAsFloat("totalcajas");
                                            }
                                             tex_totalcaja.setValue(toc.toString());

                                              tex_modeloCP.setValue("");
                                                tex_modeloCP.focus();

//                    tex_montoTotal.setValue(to.toString());
//                    com_producto.setValue("");
//                    com_producto.setEmptyText("");
//                    com_producto.focus();
                    respuesta = true;
                }
            }


        });




        //**************************************************
        //*************CALCULAR TOTAL DE COMPRA ************
        //**************************************************
        lista2.getGrid().addEditorGridListener(new EditorGridListenerAdapter() {

            @Override
            public void onAfterEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
                calcularSubTotal(grid, record, field, newValue, oldValue, rowIndex, colIndex);
            }
        });




    }
//      private boolean  GuardarItems(final String modelo){
      
  public void limpiarVentanaVenta() {
//        lista1.LimpiarGrid();
        lista2.LimpiarGrid();
        tex_totalpares.setValue("0");
        tex_totalcaja.setValue("0");
        tea_descripcion.setValue("");

        //com_empleado.setValue("No existe el Cliente");
    }
  
   public void calcularSubTotal(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
        String temp = newValue.toString();
        Float old = new Float(oldValue.toString());
        Float talla14 = record.getAsFloat("14");
        Float talla15 = record.getAsFloat("15");
        Float talla16 = record.getAsFloat("16");
        Float talla17 = record.getAsFloat("17");
        Float talla18 = record.getAsFloat("18");
        Float talla19 = record.getAsFloat("19");
        Float talla20 = record.getAsFloat("20");
        Float talla21 = record.getAsFloat("21");
        Float talla22 = record.getAsFloat("22");
        Float talla23 = record.getAsFloat("23");
        Float talla24 = record.getAsFloat("24");
        Float talla25 = record.getAsFloat("25");
        Float talla26 = record.getAsFloat("26");
        Float talla27 = record.getAsFloat("27");
        Float talla28 = record.getAsFloat("28");
        Float talla29 = record.getAsFloat("29");
        Float talla30 = record.getAsFloat("30");
        Float talla31 = record.getAsFloat("31");
        Float talla32 = record.getAsFloat("32");
        Float talla33 = record.getAsFloat("33");
        Float talla34 = record.getAsFloat("34");
        Float talla35 = record.getAsFloat("35");
        Float talla36 = record.getAsFloat("36");
        Float talla37 = record.getAsFloat("37");
        Float talla38 = record.getAsFloat("38");
        Float talla39 = record.getAsFloat("39");
        Float talla40 = record.getAsFloat("40");
        Float talla41 = record.getAsFloat("41");
        Float talla42 = record.getAsFloat("42");
        Float talla43 = record.getAsFloat("43");
        Float talla44 = record.getAsFloat("44");
        Float talla45 = record.getAsFloat("45");
        Float talla1 = record.getAsFloat("1");
        Float talla1m = record.getAsFloat("1m");
        Float talla2 = record.getAsFloat("2");
        Float talla2m = record.getAsFloat("2m");
        Float talla3 = record.getAsFloat("3");
        Float talla3m = record.getAsFloat("3m");
        Float talla4 = record.getAsFloat("4");
        Float talla4m = record.getAsFloat("4m");
        Float talla5 = record.getAsFloat("5");
        Float talla5m = record.getAsFloat("5m");
        Float talla6 = record.getAsFloat("6");
        Float talla6m = record.getAsFloat("6m");
        Float talla7 = record.getAsFloat("7");
        Float talla7m = record.getAsFloat("7m");
        Float talla8 = record.getAsFloat("8");
        Float talla8m = record.getAsFloat("8m");
        Float talla9 = record.getAsFloat("9");
        Float talla9m = record.getAsFloat("9m");
        Float talla10 = record.getAsFloat("10");
        Float talla10m = record.getAsFloat("10m");
        Float talla11 = record.getAsFloat("11");
        Float talla11m = record.getAsFloat("11m");
        Float talla12 = record.getAsFloat("12");
         Float talla12m = record.getAsFloat("12m");
        Float talla13 = record.getAsFloat("13");
Float talla13m = record.getAsFloat("13m");
         Float totalca = new Float(0);
        Float totalpa = new Float(0);
   Float totalpe = new Float(0);

        Float ne = old;
        try {
            ne = new Float(temp);
        } catch (Exception e) {
            com.google.gwt.user.client.Window.alert("atapadp  " + e.getMessage());
            ne = old;
        }

   Float totalbs = new Float(0);
        int cob3 = record.getAsInteger("totalcajas");
       int cobo = '0';
        int cobu = '1';
// if ((opcion.equalsIgnoreCase("4")) ) {
            record.commit();
              record.set("preciounitario", (record.getAsFloat("precio")/12));
           record.set("totalpares", talla1 + talla1m + talla2 + talla2m + talla3 + talla3m + talla4 + talla4m + talla5 + talla5m + talla6 + talla6m + talla7 + talla7m + talla8 + talla8m + talla9 + talla9m + talla10 + talla10m + talla11 + talla11m + talla12+ talla13);

      record.set("totalparescaja", (record.getAsInteger("totalpares")*record.getAsInteger("totalcajas")));
 record.set("totalparesbs", ((record.getAsFloat("precio")/12)*record.getAsInteger("totalparescaja")));
          if((record.getAsInteger("totalcajas")) < 1.0 ){
           record.set("totalparescaja", (record.getAsInteger("totalpares")));
             record.set("totalparesbs", ((record.getAsFloat("precio")/12)*record.getAsInteger("totalparescaja")));
           }else{
// record.set("totalparescaja", (record.getAsInteger("totalpares")*record.getAsInteger("totalcajas")));
   record.set("totalparesbs", ((record.getAsFloat("precio")/12)*record.getAsFloat("totalparescaja")));
           }

            if (record.getAsFloat("preciounitario") != 0.0) {
            record.set("preciototal", record.getAsFloat("cantidad") * record.getAsFloat("preciounitario"));
         }
     record.set("preciounitario", (record.getAsFloat("precio")/12));
            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
                totalca += grid.getStore().getRecords()[i].getAsFloat("totalcajas");
                totalpa += grid.getStore().getRecords()[i].getAsFloat("totalpares");
   totalpe += grid.getStore().getRecords()[i].getAsFloat("totalparescaja");
totalbs += grid.getStore().getRecords()[i].getAsFloat("totalparesbs");
            }

   tex_totalpares.setValue(totalpe.toString());
        tex_totalbs.setValue(totalbs.toString());
      tex_totalcaja.setValue(totalca.toString());
    }

    public void createPedido(final String idmarca) {


        String marca1 = tex_marca.getValueAsString();
        String numeropedido1 = tex_numeropedido.getValueAsString();
 String boleta = tex_boleta.getValueAsString();
 String encargado1 = com_vendedor.getValueAsString();

        String totalpares = tex_totalpares.getValueAsString();
        String totalcaja = tex_totalcaja.getValueAsString();
        String totalbs = tex_totalbs.getValueAsString();

        String descripcion = tea_descripcion.getValueAsString();

//        Date date = dat_fecha.getValue();

    String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");

        Record[] records = lista2.getStore().getRecords();
        JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();
        compraObject.put("idmarca", new JSONString(idmarca));
        compraObject.put("marca", new JSONString(marca1));
        compraObject.put("numeropedido", new JSONString(numeropedido1));
        compraObject.put("boleta", new JSONString(boleta));
        compraObject.put("encargado", new JSONString(encargado1));
        compraObject.put("fecharegistro", new JSONString(fechaent));
        compraObject.put("totalpares", new JSONString(totalpares));
        compraObject.put("totalbs", new JSONString(totalbs));
        compraObject.put("totalcaja", new JSONString(totalcaja));
        compraObject.put("descripcion", new JSONString(descripcion));
//        compraObject.put("fecha", new JSON(date));


        for (int i = 0; i < records.length; i++) {
 if (opcion.equalsIgnoreCase("4")) {
                productoObject = new JSONObject();

                 productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
               productoObject.put("material", new JSONString(records[i].getAsString("material")));
                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                 productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                 productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productoObject.put("talla", new JSONString(records[i].getAsString("talla")));
                 String opc = records[i].getAsString("talla");

            //     if (opc.equalsIgnoreCase("M")) {
                productoObject.put("1", new JSONString(records[i].getAsString("1")));
                productoObject.put("1m", new JSONString(records[i].getAsString("1m")));
                productoObject.put("2", new JSONString(records[i].getAsString("2")));
                productoObject.put("2m", new JSONString(records[i].getAsString("2m")));
                productoObject.put("3", new JSONString(records[i].getAsString("3")));
                productoObject.put("3m", new JSONString(records[i].getAsString("3m")));
                productoObject.put("4", new JSONString(records[i].getAsString("4")));
                productoObject.put("4m", new JSONString(records[i].getAsString("4m")));
                productoObject.put("5", new JSONString(records[i].getAsString("5")));
                productoObject.put("5m", new JSONString(records[i].getAsString("5m")));
                productoObject.put("6", new JSONString(records[i].getAsString("6")));
                productoObject.put("6m", new JSONString(records[i].getAsString("6m")));
                productoObject.put("7", new JSONString(records[i].getAsString("7")));
                productoObject.put("7m", new JSONString(records[i].getAsString("7m")));
                productoObject.put("8", new JSONString(records[i].getAsString("8")));
                productoObject.put("8m", new JSONString(records[i].getAsString("8m")));
                productoObject.put("9", new JSONString(records[i].getAsString("9")));
                productoObject.put("9m", new JSONString(records[i].getAsString("9m")));
                productoObject.put("10", new JSONString(records[i].getAsString("10")));
                productoObject.put("10m", new JSONString(records[i].getAsString("10m")));
                productoObject.put("11", new JSONString(records[i].getAsString("11")));
                productoObject.put("11m", new JSONString(records[i].getAsString("11m")));
                productoObject.put("12", new JSONString(records[i].getAsString("12")));
                productoObject.put("13", new JSONString(records[i].getAsString("13")));

             //    }
//                  if (opc.equalsIgnoreCase("W")) {
//                   productoObject.put("5", new JSONString(records[i].getAsString("5")));
//                productoObject.put("5m", new JSONString(records[i].getAsString("5m")));
//                productoObject.put("6", new JSONString(records[i].getAsString("6")));
//                productoObject.put("6m", new JSONString(records[i].getAsString("6m")));
//                productoObject.put("7", new JSONString(records[i].getAsString("7")));
//                productoObject.put("7m", new JSONString(records[i].getAsString("7m")));
//                productoObject.put("8", new JSONString(records[i].getAsString("8")));
//                productoObject.put("8m", new JSONString(records[i].getAsString("8m")));
//                productoObject.put("9", new JSONString(records[i].getAsString("9")));
//                productoObject.put("9m", new JSONString(records[i].getAsString("9m")));
//                productoObject.put("10", new JSONString(records[i].getAsString("10")));
//                  productoObject.put("10m", new JSONString(records[i].getAsString("10m")));
//                productoObject.put("11", new JSONString(records[i].getAsString("11")));
//                productoObject.put("11m", new JSONString(records[i].getAsString("11m")));
//                productoObject.put("12", new JSONString(records[i].getAsString("12")));
//
//                 }
//                 if (opc.equalsIgnoreCase("GS")) {
//                   productoObject.put("3m", new JSONString(records[i].getAsString("5")));
//                productoObject.put("4", new JSONString(records[i].getAsString("5m")));
//                productoObject.put("4m", new JSONString(records[i].getAsString("6")));
//                productoObject.put("5", new JSONString(records[i].getAsString("6m")));
//                productoObject.put("5m", new JSONString(records[i].getAsString("7")));
//                productoObject.put("6", new JSONString(records[i].getAsString("7m")));
//                productoObject.put("11", new JSONString(records[i].getAsString("8")));
//                productoObject.put("12", new JSONString(records[i].getAsString("8m")));
//                productoObject.put("13", new JSONString(records[i].getAsString("9")));
//                productoObject.put("1", new JSONString(records[i].getAsString("9m")));
//                productoObject.put("1m", new JSONString(records[i].getAsString("10")));
//                  productoObject.put("2", new JSONString(records[i].getAsString("10m")));
//                productoObject.put("2m", new JSONString(records[i].getAsString("11")));
//                productoObject.put("0", new JSONString(records[i].getAsString("11m")));
//                productoObject.put("3", new JSONString(records[i].getAsString("12")));
//                 }
               

               
               
                productos.set(i, productoObject);
                productoObject = null;
            }



        }

        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "./php/IngresoAlmacen.php?funcion=GuardarNuevoIngresoExtra&" + datos;

       // String url = "./php/Pedido.php?funcion=GuardarNuevoPedido&" + datos;
        //com.google.gwt.user.client.Window.alert("zzzz" + url);
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
                            Utils.setErrorPrincipal(mensajeR, "mensaje");

                           Window.alert(mensajeR);
                        final String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");


MessageBox.confirm("Guardar", "Desea Imprimir los codigos de barra :  ?", new MessageBox.ConfirmCallback() {
                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
//                                if(idmarca=="mar-3"){
//                                Window.alert("Se imprimira los codigos para cada par");
//                                 String enlTemp = "funcion=AdicionCodigoBarraIngresoHTMLNike&idingreso=" + idventaG;
//                                      verReporte(enlTemp);
//                                }else{
//                                 String enlTemp = "funcion=AdicionCodigoBarraIngresoHTML&idingreso=" + idventaG;
//                                      verReporte(enlTemp);
//                                }
Window.alert("Se imprimira los codigos para cada par");
                                 String enlTemp = "funcion=AdicionCodigoBarraIngresoHTMLNike&idingreso=" + idventaG;
                                      verReporte(enlTemp);
                       
                           }else{

                              }//fin boton
                        }
                    });
// String enlTemp = "funcion=AdicionCodigoBarraIngresoHTML&idingreso=" + idventaG;
 //                           verReporte(enlTemp);
//limpiarVentanaVenta();
//                            closeTabCompraDirecta();
                            kmenu.seleccionarOpcionRemove(null, "fun50161", e, PanelPedidoEE.this);
   abrirpanelreporte();
                          //  closePanel();

//                            Coleccion pan_compraDirecta = new Coleccion(Marca.this, idmarca, nombre);



                        } else {
                            //Window.alert(mensajeR);
//                            com.google.gwt.user.client.Window.alert("error 1000");
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

    public void closePanel() {
        this.destroy();
    }
 private void abrirpanelreporte(){
              String enlace = "php/Marca.php?funcion=BuscarMarca";
//                Utils.setErrorPrincipal("Cargando tienda y marca", "cargar");
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
                                 Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        SM = new SeleccionMarcaTienda(marcaM, kmenu);
                                        SM.show();
                                    }
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
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
    public void closeTabCompraDirecta() {
        this.remove("tab-" + COMPRA_DIRECTA_TABBED);
       SM.panel.getTabPanel().remove("tab-" + COMPRA_DIRECTA_TABBED);
       this.destroy();
        }


    private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }

}

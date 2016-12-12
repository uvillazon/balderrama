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
import org.balderrama.client.cliente.EditarNuevoCliente;
import org.balderrama.client.emergentes.SeleccionMarcaTienda;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;

public class PanelPedidoE extends Panel {

    private SeleccionMarcaTienda SM;
    //private Panel panel;
    private String COMPRA_DIRECTA_TABBED = "96000_venta-";
    private TextField tex_marca;
    //private TextField tex_encargado;
    private TextField tex_boleta;
    private TextField tex_numeropedido;
    private TextField tex_modeloCP;
    private TextField tex_totalpares;
     private TextField tex_totalbs;
    private TextField tex_totalcaja;
    private DateField dat_fecha;
   // private ListaPedidoCalzados lista;
    private ListaCalzadoPedido lista1;
    boolean respuesta = false;
    private TextArea tea_descripcion;
    private Button but_aceptar;
    private Button but_cancelar;
    private Button but_limpiar;
    public KMenu kmenu;
    String selecionado = "";
    String marca;
    String idmarca;
    String numeropedido;
    String modelo;
    String encargado;
    //Object[][] modeloM;
    //Object[][] lineaM;
      Object[][] clienteM;
    Object[][] vendedorM;
    Object[][] colorM;
    Object[][] materialM;
      private String[] tipoM;
    public ComboBox com_cliente;
     public ComboBox com_vendedor;
    String opcionb;
    String opcion;
    private Button but_anadir;
    private EditarNuevoCliente formulario;
public PanelPedidoE(String idmarca, String marca, String numeropedido, String opcion, Object[][] vendedorM, Object[][] colorM, String opcionb, SeleccionMarcaTienda SM) {
  this.SM = SM;
        this.marca = marca;
           this.tipoM = new String[]{"M","W","GS"};
        this.idmarca = idmarca;
        this.numeropedido = numeropedido;
        this.opcionb = opcion;
     //   this.clienteM = clienteM;
      //  this.estiloM = vendedorM;
        this.colorM = colorM;
        this.opcion = opcionb;

       // this.lineaM = LineaM;
        onModuleLoad();
    }

public PanelPedidoE(String idmarca, String marca, String numeropedido, String encargado,String opcion,Object[][] vendedorM,Object[][] clienteM, Object[][] colorM, Object[][] materialM, String opcionb, SeleccionMarcaTienda SM,KMenu kmenu) {
//ramarin
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
        setTitle("Registro");
        setLayout(new FitLayout());
        setBaseCls("x-plain");
        this.setClosable(true);
        this.setId("TPfun5016");
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

      
     if (opcion.equalsIgnoreCase("6")) {
            //ramarin color y material del 33 al 42
             lista1 = new ListaCalzadoPedido();
 lista1.onModuleLoad5(colorM,materialM,clienteM,vendedorM,idmarca,PanelPedidoE.this);
         }
     if (opcion.equalsIgnoreCase("12")) {
            //361 del 35 al 45
             lista1 = new ListaCalzadoPedido();
 lista1.onModuleLoad55(colorM,materialM,clienteM,vendedorM,tipoM,idmarca);
        }

//west 33 al 45
        if (opcion.equalsIgnoreCase("7")) {
      lista1 = new ListaCalzadoPedido();   
lista1.onModuleLoad8(materialM,clienteM,vendedorM,idmarca);

        }
       //cravo 33 al 45
          if (opcion.equalsIgnoreCase("11")) {
      lista1 = new ListaCalzadoPedido();
lista1.onModuleLoad88(clienteM,vendedorM);
            }
 //kidy 14 al 38
         if (opcion.equalsIgnoreCase("3")) {
      lista1 = new ListaCalzadoPedido();
lista1.onModuleLoad10(clienteM,vendedorM);
            }
         //FINOBEL 14 al 38
         if (opcion.equalsIgnoreCase("8")) {
      lista1 = new ListaCalzadoPedido();
lista1.onModuleLoad12(colorM,clienteM,vendedorM,idmarca);
            }
//          //Molekhina 14 al 38
         if (opcion.equalsIgnoreCase("9")) {
      lista1 = new ListaCalzadoPedido();
lista1.onModuleLoad13(colorM,materialM,clienteM,vendedorM,idmarca);
            }
        //accesorios
         if (opcion.equalsIgnoreCase("2")) {
                lista1 = new ListaCalzadoPedido();
            lista1.onModuleLoad99(colorM,materialM,clienteM,vendedorM,tipoM,idmarca);
        }
        //coca  color del 33 al 45
 if (opcion.equalsIgnoreCase("10")) {
      lista1 = new ListaCalzadoPedido();
lista1.onModuleLoad11(colorM,clienteM,vendedorM,idmarca);
            }
//colegial
         if (opcion.equalsIgnoreCase("13")) {
      lista1 = new ListaCalzadoPedido();
lista1.onModuleLoad15(colorM,clienteM,vendedorM,idmarca);
            }
     
        Panel pan_centro = lista1.getPanel();

        FormPanel for_panel1 = new FormPanel();
        for_panel1.setBaseCls("x-plain");
        for_panel1.setWidth(330);
        for_panel1.setLabelWidth(100);
        tex_marca = new TextField("Marca", "marca", 200);
        tex_marca.setValue(marca);
        tex_marca.setReadOnly(true);
        
        tex_boleta = new TextField("#Proforma", "boleta", 200);
tex_boleta.focus();
com_cliente = new ComboBox("Cliente/almacen", "idcliente");
com_vendedor = new ComboBox("Vendedor", "idempleado");

       // tex_modeloCP = new TextField("Modelo CP", "idmodelo", 200);
        //tex_modeloCP.setValue("idmodelo");
tex_numeropedido = new TextField("Codigo Registro", "numeropedido", 200);
        tex_numeropedido.setReadOnly(true);
        tex_numeropedido.setValue(numeropedido);
           but_anadir = new Button("Nuevo Cliente");

        Panel pan_botonescliente = new Panel();
        pan_botonescliente.setLayout(new HorizontalLayout(2));
        pan_botonescliente.setBaseCls("x-plain");
 pan_botonescliente.add(but_anadir);
        for_panel1.add(tex_marca);
         for_panel1.add(tex_numeropedido);
   for_panel1.add(com_vendedor);
        // for_panel1.add(tex_modeloCP);

        FormPanel for_panel2 = new FormPanel();
        for_panel2.setBaseCls("x-plain");
        for_panel2.setWidth(330);
        for_panel2.setLabelWidth(100);
  tex_modeloCP = new TextField("Registrar Modelos", "idmodelo", 200);
        for_panel2.add(tex_boleta);
        for_panel2.add(com_cliente);
      for_panel2.add(tex_modeloCP);
 for_panel2.add(new PaddedPanel(pan_botonescliente, 5, 5, 5, 5), new TableLayoutData(2));

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
        tex_totalbs = new TextField("Total SUS", "totalbs");

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
        but_aceptar = new Button("Registrar");
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


        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centro, new BorderLayoutData(RegionPosition.CENTER));
        pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        add(pan_borderLayout);

        initCombos();
        initValues();
        addListeners();
        addListenerskey();

    }

    public void creaduplicado(String cod, String mat, String col, String cli, String vend, String fecha, String caj, String prec, String uni, String t1, String t2, String t3, String t4, String t5, String t6, String t7, String t8, String t9, String t10, String tpar, String cparc, String parbs) {

               
                // dat_fecha = new DateField("Fecha", "d-m-Y");
            //     String fecha = dat_fecha.getValueAsString();
//String fecha = DateUtil.format(dat_fecha.getValue(), "m-Y");

                if (modelo != null) {
                       if (opcion.equalsIgnoreCase("6")) {
           
  Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
      "",cod,mat,col,cli,vend,fecha,caj,prec,uni,t1,t2,t3,t4,t5,t6, t7, t8, t9, t10, tpar,cparc,parbs,});
                                                lista1.getGrid().stopEditing();
                                                lista1.getGrid().getStore().insert(0, registroCompra);
                                                lista1.getGrid().startEditing(0, 0);
      }


                        Float tod = new Float(0);
                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
                                                tod += lista1.getStore().getRecords()[i].getAsFloat("totalparescaja");
                                            }
                                             Float to = new Float(0);
                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
                                                to += lista1.getStore().getRecords()[i].getAsFloat("totalpares");
                                            }
                                             tex_totalpares.setValue(to.toString());
                                             Float top = new Float(0);
                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
                                                top += lista1.getStore().getRecords()[i].getAsFloat("totalparesbs");
                                            }
                                             tex_totalbs.setValue(top.toString());
                                              Float toc = new Float(0);
                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
                                                toc += lista1.getStore().getRecords()[i].getAsFloat("totalcajas");
                                            }
                                             tex_totalcaja.setValue(toc.toString());

                                              tex_modeloCP.setValue("");
                                                tex_modeloCP.focus();
                    respuesta = true;
                }
            }

   
private void addListenerskey() {

  

}
private void initCombos() {

     SimpleStore proveedorStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, clienteM);
        proveedorStore1.load();
        com_cliente.setMinChars(1);
        com_cliente.setStore(proveedorStore1);
        com_cliente.setValueField("codigo");
        com_cliente.setDisplayField("codigo");
        com_cliente.setForceSelection(true);
        com_cliente.setMode(ComboBox.LOCAL);
        com_cliente.setEmptyText("Buscar almacen");
        com_cliente.setLoadingText("buscando...");
        com_cliente.setTypeAhead(true);
        com_cliente.setSelectOnFocus(true);
        com_cliente.setWidth(200);
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

        //**************************************************
        //************* BOTON CANCELAR   *******************
        //**************************************************
       but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
kmenu.seleccionarOpcionRemove(null, "fun5016", e, PanelPedidoE.this);
   abrirpanelreporte();
              //  closeTabCompraDirecta();
            }
        });
      but_anadir.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
//formulariocliente
CargarNuevoCliente();
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

            //private FormularioPedidoKardex kardex;
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
                 String cliente = com_cliente.getValueAsString();
                    String vendedor = com_vendedor.getValueAsString();
                // dat_fecha = new DateField("Fecha", "d-m-Y");
            //     String fecha = dat_fecha.getValueAsString();
String fecha = DateUtil.format(dat_fecha.getValue(), "m-Y");

                if (modelo != null) {
                       if (opcion.equalsIgnoreCase("6")) {
            //ramarin color y material del 33 al 42s
  Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
      "",modelo,"","",cliente,vendedor,fecha,1, 0,0,0,0,0,0,0,0, 0, 0, 0, 0, 0,0,0,});
                                                lista1.getGrid().stopEditing();
                                                lista1.getGrid().getStore().insert(0, registroCompra);
                                                lista1.getGrid().startEditing(0, 0);
      }
              if (opcion.equalsIgnoreCase("12")) {
            //361
               String talla = "M";
               
  Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
      "",modelo,"","",cliente,vendedor,fecha,talla,1, 0,0,0,0,0,0,0,0, 0, 0, 0, 0, 0,0,0,});
                                                lista1.getGrid().stopEditing();
                                                lista1.getGrid().getStore().insert(0, registroCompra);
                                                lista1.getGrid().startEditing(0, 0);
  }
   
//west 33 al 45

    //                    String[] nombreCaso8Columns = {"idmodelo", "codigo", "material","cliente","vendedor","fecha", "totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalpares","totalparescaja",  "totalparesbs"};
// String[] nombreCaso8Columns = {"idmodelo", "codigo", "material","cliente","vendedor","fecha", "totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalpares","totalparescaja",  "totalparesbs"};

        if (opcion.equalsIgnoreCase("7")) {
    Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
     "",modelo,"",cliente,vendedor,fecha,1, 0,0,0,0,0,0,0,0, 0, 0, 0, 0, 0,0,0,0,0,0,});
                                                lista1.getGrid().stopEditing();
                                                lista1.getGrid().getStore().insert(0, registroCompra);
                                                lista1.getGrid().startEditing(0, 0);

            }
                       //cravo 33 al 45
 //String[] nombreCaso88Columns = {"idmodelo", "codigo", "cliente", "vendedor","fecha","totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "totalpares","totalparescaja",  "totalparesbs"};

        if (opcion.equalsIgnoreCase("11")) {
    Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
     "",modelo,cliente,vendedor,fecha,1, 0,0,0,0,0,0,0,0, 0, 0, 0, 0, 0,0,0,});
                                                lista1.getGrid().stopEditing();
                                                lista1.getGrid().getStore().insert(0, registroCompra);
                                                lista1.getGrid().startEditing(0, 0);

            }
 //kidy 14 al 38
         if (opcion.equalsIgnoreCase("3")) {
      Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
      "",modelo,cliente,vendedor,fecha,1, 0,0,0,0,0,0,0,0, 0, 0, 0, 0, 0,0,0,0,0,0,0,0,0,0,0, 0, 0, 0, 0, 0,0,0,});
                                                lista1.getGrid().stopEditing();
                                                lista1.getGrid().getStore().insert(0, registroCompra);
                                                lista1.getGrid().startEditing(0, 0);
         }
                        //FIN 14 al 38 COLOR
         if (opcion.equalsIgnoreCase("8")) {
      Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
      "",modelo,"",cliente,vendedor,fecha,1, 0,0,0,0,0,0,0,0, 0, 0, 0, 0, 0,0,0,0,0,0,0,0,0,0,0, 0, 0, 0, 0, 0,0,0,});
                                                lista1.getGrid().stopEditing();
                                                lista1.getGrid().getStore().insert(0, registroCompra);
                                                lista1.getGrid().startEditing(0, 0);

         }
                                         //MKÑ 14 al 38 COLOR MATERIAL
         if (opcion.equalsIgnoreCase("9")) {

      Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
      "",modelo,"","",cliente,vendedor,fecha,1, 0,0,0,0,0,0,0,0, 0, 0, 0, 0, 0,0,0,0,0,0,0,0,0,0,0, 0, 0, 0, 0, 0,0,0,});
                                                lista1.getGrid().stopEditing();
                                                lista1.getGrid().getStore().insert(0, registroCompra);
                                                lista1.getGrid().startEditing(0, 0);

            }
  //accecsorios  COLOR MATERIAL
//      String[] nombreCaso99Columns = {"idmodelo","codigo", "material","color","cliente","vendedor","fecha","talla","totalcajas","precio","preciounitario", "34","35", "36", "37", "38", "39", "40", "totalpares","totalparescaja",  "totalparesbs"};

         if (opcion.equalsIgnoreCase("2")) {
 String talla = "M";
      Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
      "",modelo,"","",cliente,vendedor,fecha,talla,1, 0,0,0,0,0,0,0,0, 0, 0, 0, 0,});
                                                lista1.getGrid().stopEditing();
                                                lista1.getGrid().getStore().insert(0, registroCompra);
                                                lista1.getGrid().startEditing(0, 0);
           }
        //coca  color del 33 al 45
 if (opcion.equalsIgnoreCase("10")) {

    Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
      "",modelo,"",cliente,vendedor,fecha,1, 0,0,0,0,0,0,0,0, 0, 0, 0, 0, 0,0,0,0,0,0,});
                                                lista1.getGrid().stopEditing();
                                                lista1.getGrid().getStore().insert(0, registroCompra);
                                                lista1.getGrid().startEditing(0, 0);

     }
   //colegial del 26-38
 if (opcion.equalsIgnoreCase("13")) {

    Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
      "",modelo,"",cliente,vendedor,fecha,1, 0,0,0,0,0,0,0,0, 0, 0, 0, 0, 0,0,0,0,0,0,});
                                                lista1.getGrid().stopEditing();
                                                lista1.getGrid().getStore().insert(0, registroCompra);
                                                lista1.getGrid().startEditing(0, 0);

     }


                        Float tod = new Float(0);
                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
                                                tod += lista1.getStore().getRecords()[i].getAsFloat("totalparescaja");
                                            }
                                             Float to = new Float(0);
                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
                                                to += lista1.getStore().getRecords()[i].getAsFloat("totalpares");
                                            }
                                             tex_totalpares.setValue(to.toString());
                                             Float top = new Float(0);
                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
                                                top += lista1.getStore().getRecords()[i].getAsFloat("totalparesbs");
                                            }
                                             tex_totalbs.setValue(top.toString());
                                              Float toc = new Float(0);
                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
                                                toc += lista1.getStore().getRecords()[i].getAsFloat("totalcajas");
                                            }
                                             tex_totalcaja.setValue(toc.toString());

                                              tex_modeloCP.setValue("");
                                                tex_modeloCP.focus();
                    respuesta = true;
                }
            }
 //ini dupli
 
           //fin

        });

             


        //**************************************************
        //*************CALCULAR TOTAL DE COMPRA ************
        //**************************************************
        lista1.getGrid().addEditorGridListener(new EditorGridListenerAdapter() {

            @Override
            public void onAfterEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
                calcularSubTotal(grid, record, field, newValue, oldValue, rowIndex, colIndex);
            }
        });

   }
     private void CargarNuevoCliente() {
        String enlace = "php/Cliente.php?funcion=BuscarCiudadTipo";
        Utils.setErrorPrincipal("Cargando parametros de Nuevo Cliente", "cargar");
        final Conector conec = new Conector(enlace, false);
        {
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

                                JSONValue marcaV = jsonObject.get("resultado");
                                JSONObject marcaO;
                                if ((marcaO = marcaV.isObject()) != null) {
                                    Object[][] ciudades = Utils.getArrayOfJSONObject(marcaO, "ciudadM", new String[]{"idciudad", "nombre"});
                                 //   Object[][] tipos = Utils.getArrayOfJSONObject(marcaO, "tipoM", new String[]{"idtipocliente", "nombre"});

                                    formulario = null;
                                    formulario = new EditarNuevoCliente(null, "", "", "", "", "", "", "", null, "", ciudades, PanelPedidoE.this);
                                    formulario.show();
                                    //insertar en panel
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

            } catch (RequestException e) {
                e.getMessage();
                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
            }

        }
    }

  public void limpiarVentanaVenta() {
        lista1.LimpiarGrid();
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

        
        Float ne = old;
        try {
            ne = new Float(temp);
        } catch (Exception e) {
            com.google.gwt.user.client.Window.alert("atapadp  " + e.getMessage());
            ne = old;
        }
         Float totalca = new Float(0);
        Float totalpa = new Float(0);
         Float totalpe = new Float(0);
   Float totalbs = new Float(0);
        int cob3 = record.getAsInteger("totalcajas");
       int cobo = '0';
        int cobu = '1';



         if (opcion.equalsIgnoreCase("6")) {
        record.commit();
            record.set("totalpares", talla33 + talla34 + talla35 + talla36 + talla37 + talla38 + talla39 + talla40 + talla41 + talla42 );

        }
            if (opcion.equalsIgnoreCase("12")) {
         record.commit();
            record.set("totalpares", talla36 + talla37 + talla38 + talla39 + talla40 + talla41 + talla42+talla43 + talla44 + talla45);

        }
        
//west 33 al 45
         if ( (opcion.equalsIgnoreCase("7")) || (opcion.equalsIgnoreCase("10"))) {
            record.commit();
            record.set("totalpares", talla33 + talla34 + talla35 + talla36 + talla37 + talla38 + talla39 + talla40 + talla41 + talla42 + talla43 + talla44 + talla45);

            }
         if ( (opcion.equalsIgnoreCase("11"))) {
            record.commit();
            record.set("totalpares", talla33 + talla34 + talla35 + talla36 + talla37 + talla38 + talla39 + talla40 + talla41 + talla42 + talla43 + talla44 + talla45);

            }
         if ( (opcion.equalsIgnoreCase("13"))) {
            record.commit();
            record.set("totalpares", talla26 + talla27 + talla28 + talla29 + talla30 + talla31 + talla32 + talla33 + talla34 + talla35 + talla36 + talla37 + talla38);

            }
        //accesorios
     if (opcion.equalsIgnoreCase("2")) {
            record.commit();
            record.set("totalpares", talla34 +talla35 + talla36 + talla37 + talla38 + talla39 + talla40 );

        }
 //kidy 14 al 38
 if ( (opcion.equalsIgnoreCase("3")) || (opcion.equalsIgnoreCase("8")) || (opcion.equalsIgnoreCase("9"))) {

 //        if (opcion.equalsIgnoreCase("3")) {
              record.commit();
                 record.set("totalpares", talla14 + talla15 + talla16 + talla17 + talla18 + talla19 + talla20 + talla21 + talla22 + talla23 + talla24 + talla25 + talla26 + talla27 + talla28 + talla29 + talla30 + talla31 + talla32 + talla33 + talla34 + talla35 + talla36 + talla37 + talla38 );

            }
          if (opcion.equalsIgnoreCase("2")) {
record.set("totalparescaja", (record.getAsInteger("totalpares")*record.getAsInteger("totalcajas")));
 record.set("totalparesbs", ((record.getAsFloat("precio"))*record.getAsInteger("totalparescaja")));
          if((record.getAsInteger("totalcajas")) < 1.0 ){
           record.set("totalparescaja", (record.getAsInteger("totalpares")));
             record.set("totalparesbs", ((record.getAsFloat("precio"))*record.getAsInteger("totalparescaja")));
           }else{
          record.set("totalparesbs", ((record.getAsFloat("precio"))*record.getAsFloat("totalparescaja")));
           }

            if (record.getAsFloat("preciounitario") != 0.0) {
            record.set("preciototal", record.getAsFloat("cantidad") * record.getAsFloat("preciounitario"));
         }
     record.set("preciounitario", (record.getAsFloat("precio")));
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
           }else{
            //todos los demas
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
 

    }

    public void createPedido(String idmarca) {


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

        Record[] records = lista1.getStore().getRecords();
        JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();
        compraObject.put("idmarca", new JSONString(idmarca));
     //   compraObject.put("marca", new JSONString(marca1));
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
            //accesorios
              if (opcion.equalsIgnoreCase("2")) {
                productoObject = new JSONObject();
                 productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                productoObject.put("color", new JSONString(records[i].getAsString("color")));
               productoObject.put("material", new JSONString(records[i].getAsString("material")));
                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                 productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("talla", new JSONString(records[i].getAsString("talla")));

                productoObject.put("34", new JSONString(records[i].getAsString("34")));
                 productoObject.put("35", new JSONString(records[i].getAsString("35")));
                productoObject.put("36", new JSONString(records[i].getAsString("36")));

                productoObject.put("37", new JSONString(records[i].getAsString("37")));
                productoObject.put("38", new JSONString(records[i].getAsString("38")));

                 productoObject.put("39", new JSONString(records[i].getAsString("39")));
                productoObject.put("40", new JSONString(records[i].getAsString("40")));
          productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
            }
              //ramarim
        if (opcion.equalsIgnoreCase("6")) {
      productoObject = new JSONObject();
                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                productoObject.put("color", new JSONString(records[i].getAsString("color")));
               productoObject.put("material", new JSONString(records[i].getAsString("material")));
                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                 productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("33", new JSONString(records[i].getAsString("33")));
                productoObject.put("34", new JSONString(records[i].getAsString("34")));
                productoObject.put("35", new JSONString(records[i].getAsString("35")));
                productoObject.put("36", new JSONString(records[i].getAsString("36")));
                productoObject.put("37", new JSONString(records[i].getAsString("37")));
                productoObject.put("38", new JSONString(records[i].getAsString("38")));
                productoObject.put("39", new JSONString(records[i].getAsString("39")));
                productoObject.put("40", new JSONString(records[i].getAsString("40")));
                productoObject.put("41", new JSONString(records[i].getAsString("41")));
                productoObject.put("42", new JSONString(records[i].getAsString("42")));
                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
        }
              //361
          if (opcion.equalsIgnoreCase("12")) {
      productoObject = new JSONObject();
                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                productoObject.put("color", new JSONString(records[i].getAsString("color")));
               productoObject.put("material", new JSONString(records[i].getAsString("material")));
                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
                productoObject.put("talla", new JSONString(records[i].getAsString("talla")));

                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("36", new JSONString(records[i].getAsString("36")));
                productoObject.put("37", new JSONString(records[i].getAsString("37")));
                productoObject.put("38", new JSONString(records[i].getAsString("38")));
                productoObject.put("39", new JSONString(records[i].getAsString("39")));
                productoObject.put("40", new JSONString(records[i].getAsString("40")));
                productoObject.put("41", new JSONString(records[i].getAsString("41")));
                productoObject.put("42", new JSONString(records[i].getAsString("42")));
                 productoObject.put("43", new JSONString(records[i].getAsString("43")));
                productoObject.put("44", new JSONString(records[i].getAsString("44")));
                productoObject.put("45", new JSONString(records[i].getAsString("45")));

                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
        }
         
//west 33 al 45
        if (opcion.equalsIgnoreCase("7")) {
      productoObject = new JSONObject();
                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                 productoObject.put("material", new JSONString(records[i].getAsString("material")));

                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                 productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("33", new JSONString(records[i].getAsString("33")));
                productoObject.put("34", new JSONString(records[i].getAsString("34")));
                productoObject.put("35", new JSONString(records[i].getAsString("35")));
                productoObject.put("36", new JSONString(records[i].getAsString("36")));
                productoObject.put("37", new JSONString(records[i].getAsString("37")));
                productoObject.put("38", new JSONString(records[i].getAsString("38")));
                productoObject.put("39", new JSONString(records[i].getAsString("39")));
                productoObject.put("40", new JSONString(records[i].getAsString("40")));
                productoObject.put("41", new JSONString(records[i].getAsString("41")));
                productoObject.put("42", new JSONString(records[i].getAsString("42")));
                 productoObject.put("43", new JSONString(records[i].getAsString("43")));
                productoObject.put("44", new JSONString(records[i].getAsString("44")));
                productoObject.put("45", new JSONString(records[i].getAsString("45")));
                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
            }
        //cravo 33 al 45
        if (opcion.equalsIgnoreCase("11")) {
      productoObject = new JSONObject();
                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                  productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));

                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("33", new JSONString(records[i].getAsString("33")));
                productoObject.put("34", new JSONString(records[i].getAsString("34")));
                productoObject.put("35", new JSONString(records[i].getAsString("35")));
                productoObject.put("36", new JSONString(records[i].getAsString("36")));
                productoObject.put("37", new JSONString(records[i].getAsString("37")));
                productoObject.put("38", new JSONString(records[i].getAsString("38")));
                productoObject.put("39", new JSONString(records[i].getAsString("39")));
                productoObject.put("40", new JSONString(records[i].getAsString("40")));
                productoObject.put("41", new JSONString(records[i].getAsString("41")));
                productoObject.put("42", new JSONString(records[i].getAsString("42")));
              productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
            }
 //kidy 14 al 38
         if (opcion.equalsIgnoreCase("3")) {
       productoObject = new JSONObject();
                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                 productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("14", new JSONString(records[i].getAsString("14")));
                productoObject.put("15", new JSONString(records[i].getAsString("15")));
                productoObject.put("16", new JSONString(records[i].getAsString("16")));
                productoObject.put("17", new JSONString(records[i].getAsString("17")));
                productoObject.put("18", new JSONString(records[i].getAsString("18")));
                productoObject.put("19", new JSONString(records[i].getAsString("19")));
                productoObject.put("20", new JSONString(records[i].getAsString("20")));
                productoObject.put("21", new JSONString(records[i].getAsString("21")));
                productoObject.put("22", new JSONString(records[i].getAsString("22")));
                productoObject.put("23", new JSONString(records[i].getAsString("23")));
                productoObject.put("24", new JSONString(records[i].getAsString("24")));
                productoObject.put("25", new JSONString(records[i].getAsString("25")));
                productoObject.put("26", new JSONString(records[i].getAsString("26")));
                productoObject.put("27", new JSONString(records[i].getAsString("27")));
                productoObject.put("28", new JSONString(records[i].getAsString("28")));
                productoObject.put("29", new JSONString(records[i].getAsString("29")));
                productoObject.put("30", new JSONString(records[i].getAsString("30")));
                productoObject.put("31", new JSONString(records[i].getAsString("31")));
                productoObject.put("32", new JSONString(records[i].getAsString("32")));
                productoObject.put("33", new JSONString(records[i].getAsString("33")));
                productoObject.put("34", new JSONString(records[i].getAsString("34")));
                productoObject.put("35", new JSONString(records[i].getAsString("35")));
                productoObject.put("36", new JSONString(records[i].getAsString("36")));
                productoObject.put("37", new JSONString(records[i].getAsString("37")));
                productoObject.put("38", new JSONString(records[i].getAsString("38")));
                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
            }
        //FINO 14 al 38
         if (opcion.equalsIgnoreCase("8")) {
       productoObject = new JSONObject();
                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
               productoObject.put("color", new JSONString(records[i].getAsString("color")));
             //  productoObject.put("material", new JSONString(records[i].getAsString("material")));

                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                 productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("14", new JSONString(records[i].getAsString("14")));
                productoObject.put("15", new JSONString(records[i].getAsString("15")));
                productoObject.put("16", new JSONString(records[i].getAsString("16")));
                productoObject.put("17", new JSONString(records[i].getAsString("17")));
                productoObject.put("18", new JSONString(records[i].getAsString("18")));
                productoObject.put("19", new JSONString(records[i].getAsString("19")));
                productoObject.put("20", new JSONString(records[i].getAsString("20")));
                productoObject.put("21", new JSONString(records[i].getAsString("21")));
                productoObject.put("22", new JSONString(records[i].getAsString("22")));
                productoObject.put("23", new JSONString(records[i].getAsString("23")));
                productoObject.put("24", new JSONString(records[i].getAsString("24")));
                productoObject.put("25", new JSONString(records[i].getAsString("25")));
                productoObject.put("26", new JSONString(records[i].getAsString("26")));
                productoObject.put("27", new JSONString(records[i].getAsString("27")));
                productoObject.put("28", new JSONString(records[i].getAsString("28")));
                productoObject.put("29", new JSONString(records[i].getAsString("29")));
                productoObject.put("30", new JSONString(records[i].getAsString("30")));
                productoObject.put("31", new JSONString(records[i].getAsString("31")));
                productoObject.put("32", new JSONString(records[i].getAsString("32")));
                productoObject.put("33", new JSONString(records[i].getAsString("33")));
                productoObject.put("34", new JSONString(records[i].getAsString("34")));
                productoObject.put("35", new JSONString(records[i].getAsString("35")));
                productoObject.put("36", new JSONString(records[i].getAsString("36")));
                productoObject.put("37", new JSONString(records[i].getAsString("37")));
                productoObject.put("38", new JSONString(records[i].getAsString("38")));
                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
            }
        //mkñ 14 al 38
         if (opcion.equalsIgnoreCase("9")) {
       productoObject = new JSONObject();
                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
               productoObject.put("color", new JSONString(records[i].getAsString("color")));
            productoObject.put("material", new JSONString(records[i].getAsString("material")));
                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                 productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("14", new JSONString(records[i].getAsString("14")));
                productoObject.put("15", new JSONString(records[i].getAsString("15")));
                productoObject.put("16", new JSONString(records[i].getAsString("16")));
                productoObject.put("17", new JSONString(records[i].getAsString("17")));
                productoObject.put("18", new JSONString(records[i].getAsString("18")));
                productoObject.put("19", new JSONString(records[i].getAsString("19")));
                productoObject.put("20", new JSONString(records[i].getAsString("20")));
                productoObject.put("21", new JSONString(records[i].getAsString("21")));
                productoObject.put("22", new JSONString(records[i].getAsString("22")));
                productoObject.put("23", new JSONString(records[i].getAsString("23")));
                productoObject.put("24", new JSONString(records[i].getAsString("24")));
                productoObject.put("25", new JSONString(records[i].getAsString("25")));
                productoObject.put("26", new JSONString(records[i].getAsString("26")));
                productoObject.put("27", new JSONString(records[i].getAsString("27")));
                productoObject.put("28", new JSONString(records[i].getAsString("28")));
                productoObject.put("29", new JSONString(records[i].getAsString("29")));
                productoObject.put("30", new JSONString(records[i].getAsString("30")));
                productoObject.put("31", new JSONString(records[i].getAsString("31")));
                productoObject.put("32", new JSONString(records[i].getAsString("32")));
                productoObject.put("33", new JSONString(records[i].getAsString("33")));
                productoObject.put("34", new JSONString(records[i].getAsString("34")));
                productoObject.put("35", new JSONString(records[i].getAsString("35")));
                productoObject.put("36", new JSONString(records[i].getAsString("36")));
                productoObject.put("37", new JSONString(records[i].getAsString("37")));
                productoObject.put("38", new JSONString(records[i].getAsString("38")));
                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
            }
        //coca  color del 33 al 45
 if (opcion.equalsIgnoreCase("10")) {
        productoObject = new JSONObject();
             //String[] nombreCaso11Columns = {"idmodelo","codigo", "color","cliente", "totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45","totalpares","totalparescaja",  "totalparesbs"};

                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                productoObject.put("color", new JSONString(records[i].getAsString("color")));
                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("33", new JSONString(records[i].getAsString("33")));
                productoObject.put("34", new JSONString(records[i].getAsString("34")));
                productoObject.put("35", new JSONString(records[i].getAsString("35")));
                productoObject.put("36", new JSONString(records[i].getAsString("36")));
                productoObject.put("37", new JSONString(records[i].getAsString("37")));
                productoObject.put("38", new JSONString(records[i].getAsString("38")));
                productoObject.put("39", new JSONString(records[i].getAsString("39")));
                productoObject.put("40", new JSONString(records[i].getAsString("40")));
                productoObject.put("41", new JSONString(records[i].getAsString("41")));
                productoObject.put("42", new JSONString(records[i].getAsString("42")));
                 productoObject.put("43", new JSONString(records[i].getAsString("43")));
                productoObject.put("44", new JSONString(records[i].getAsString("44")));
                productoObject.put("45", new JSONString(records[i].getAsString("45")));
                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
            }
                   
//colegial 26-38
        if (opcion.equalsIgnoreCase("13")) {
        productoObject = new JSONObject();
             //String[] nombreCaso11Columns = {"idmodelo","codigo", "color","cliente", "totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45","totalpares","totalparescaja",  "totalparesbs"};

                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                productoObject.put("color", new JSONString(records[i].getAsString("color")));
                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
               productoObject.put("26", new JSONString(records[i].getAsString("26")));
                productoObject.put("27", new JSONString(records[i].getAsString("27")));
                productoObject.put("28", new JSONString(records[i].getAsString("28")));
                productoObject.put("29", new JSONString(records[i].getAsString("29")));
                productoObject.put("30", new JSONString(records[i].getAsString("30")));
                productoObject.put("31", new JSONString(records[i].getAsString("31")));
                productoObject.put("32", new JSONString(records[i].getAsString("32")));
                productoObject.put("33", new JSONString(records[i].getAsString("33")));
                productoObject.put("34", new JSONString(records[i].getAsString("34")));
                productoObject.put("35", new JSONString(records[i].getAsString("35")));
                productoObject.put("36", new JSONString(records[i].getAsString("36")));
                productoObject.put("37", new JSONString(records[i].getAsString("37")));
                productoObject.put("38", new JSONString(records[i].getAsString("38")));
                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
            }





        }

        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
        //  Window.alert(resultado.toString());

        String url = "./php/IngresoAlmacen.php?funcion=GuardarNuevoIngresoExtra&" + datos;
   //com.google.gwt.user.client.Window.alert("zzzz" + url);
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

                        //   Window.alert(mensajeR);
                        final String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");


MessageBox.confirm("Guardar", "Desea Imprimir los codigos de barra :  ?", new MessageBox.ConfirmCallback() {
                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                  Window.alert("Se imprimira los codigos para cada par");
                                 String enlTemp = "funcion=AdicionCodigoBarraIngresoHTMLNike&idingreso=" + idventaG;
                                      verReporte(enlTemp);
// String enlTemp = "funcion=AdicionCodigoBarraIngresoHTML&idingreso=" + idventaG;
                            verReporte(enlTemp);
                           }else{
                               
                              }//fin boton
                        }
                    });

                            kmenu.seleccionarOpcionRemove(null, "fun5016", e, PanelPedidoE.this);
                           abrirpanelreporte();

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

//                                        Object[][] tiendaM = Utils.getArrayOfJSONObject(marcaO, "tiendaM", new String[]{"idtienda", "nombre"});
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
                                        SM = new SeleccionMarcaTienda(marcaM, kmenu);
                                        SM.show();


                                    }

                                //
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
    public void closePanel() {
        this.destroy();
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

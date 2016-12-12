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
import org.balderrama.client.emergentes.SeleccionMarcaEstiloInventario;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
import com.google.gwt.user.client.Window;
import org.balderrama.client.traspaso.Cambiarvendedor;
import org.balderrama.client.util.ReporteTraspaso;

public class PanelInventario extends Panel {
private MostrarTraspasototal formulario_alm;
private MostrarEditarModelo formulario_alm1;
private MostraVenta formulario_almv;
    private SeleccionMarcaEstiloInventario SM;
      private IngresoTiendaMarca SMP;
        Object[][] vendedorM;
    private String COMPRA_DIRECTA_TABBED = "9777000_venta-";
    private TextField tex_marca;
    private TextField tex_numeropedido;
    private ComboBox com_cliente;
    private ComboBox com_vendedor;
      public Cambiarvendedor formulario2;
        public ValidarUsuario formulariousuario;
private TextField tex_totalpares;
     private TextField tex_totalbs;
    private TextField tex_totalcaja;
      //private TextField tex_responsable;

    private TextField tex_preciototal;
    private DateField dat_fecha;
    //private ListaPedidoCalzados lista;
    private ListaInventarioGrid lista1;
    boolean respuesta = false;
    private TextArea tea_descripcion;
    private Button but_aceptar;
       private Button but_feria;
    private Button but_eliminar;
     private Button but_editaritem;
    private Button but_detalle;
    private Button but_aceptarR;
    private Button but_traspasar;
    private Button but_editarmodelo;
    private Button but_venta;
    private Button but_cancelar;
    private Button but_limpiar;
    private TextField tex_rango;
    private TextField tex_proforma;
    private TextField tex_cliente;
    public KMenu kmenu;
    String selecionado = "";
    String marca;
    String idmarca;
    
    String opcion;
        String totalpares;
    String totalbs;
    String totalcajas;
    String formatomayor;
    String responsable;
    String almacen;
    String mesrango;
    String opcionnueva;
    String fecha;
    String idkardex;
    String idalmacen;
    String tipoestilonino;
    Object[][] colorM;
    String gestion="no";
    String idclientebusqueda;
    String idvendedorbusqueda;
    String itembusca;
    public String marcanombre;
String miinventario="1";
private FormularioKardexPar formularioc;
private FormularioKardexVentaCliente formulariocl;
   private MostrarEditarModeloitem formulario_alm12;
String tipoclave="";
//dessde seleccion
    public PanelInventario(String idkardex,String mesrango,String idmarca, String marca,String opcion, String formmayor,Object[][] materialM,Object[][] vendedorM,String cajas,String totalparess,String totalbss, String responsable,String almacen,String idalmacen,SeleccionMarcaEstiloInventario pedido1,KMenu kmenu) {
        this.SM = pedido1;
           this.kmenu = kmenu;
          this.vendedorM = vendedorM;
               this.idclientebusqueda ="";
                 this.itembusca ="";
        this.idvendedorbusqueda ="";
        this.marca = marca;
        this.marcanombre = marca;
        this.idmarca = idmarca;
        this.mesrango = mesrango;
        this.idkardex=idkardex;
        this.marca = marca;
         this.colorM = materialM;
         this.totalpares = totalparess;
         this.totalbs = totalbss;
         this.opcion = opcion;
this.formatomayor = formmayor;
this.totalcajas = cajas;
this.responsable = responsable;
this.almacen = almacen;
this.idalmacen = idalmacen;
this.gestion ="";
this.miinventario="1";
        onModuleLoad();
    }
//DESDE LISTA
      public PanelInventario(String idkardex,String mesrango,String idmarca, String marca,String opcion, String formmayor,Object[][] materialM,Object[][] vendedorM,String cajas,String totalparess,String totalbss, String responsable,String almacen,String idalmacen,IngresoTiendaMarca ped,KMenu kmenu) {
        this.SMP = ped;
           this.kmenu = kmenu;
          this.vendedorM = vendedorM;
               this.idclientebusqueda ="";
                this.itembusca ="";
        this.idvendedorbusqueda ="";
        this.marca = marca;
        this.marcanombre = marca;
        this.idmarca = idmarca;
        this.mesrango = mesrango;
        this.idkardex=idkardex;
        this.marca = marca;
         this.colorM = materialM;
         this.totalpares = totalparess;
         this.totalbs = totalbss;
         this.opcion = opcion;
this.formatomayor = formmayor;
this.totalcajas = cajas;
this.responsable = responsable;
this.almacen = almacen;
this.idalmacen = idalmacen;
this.gestion ="";
this.miinventario="1";
        onModuleLoad();
    }
//reabrirfin

  public PanelInventario(String idkardex,String gestion,String cliente,String vendedor,String mesrango,String idmarca, String marca,String opcion, String formmayor,Object[][] materialM,String cajas,String totalparess,String totalbss, String responsable,String almacen,String idalmacen,String item,KMenu kmenu) {
        //this.SMO = pedido12;
        this.gestion = gestion;
        this.idclientebusqueda =cliente;
         this.itembusca =item;
        this.idvendedorbusqueda =vendedor;
        //this.gestion ="";
        this.kmenu = kmenu;
        this.marca = marca;
        this.idmarca = idmarca;
        this.marcanombre = marca;
        this.mesrango = mesrango;
        this.idkardex=idkardex;
        this.marca = marca;
        this.colorM = materialM;
        this.totalpares = totalparess;
        this.totalbs = totalbss;
        this.opcion = opcion;
        this.formatomayor = formmayor;
        this.totalcajas = cajas;
        this.responsable = responsable;
        this.almacen = almacen;
        this.idalmacen = idalmacen;
        this.miinventario="1";
        onModuleLoad();
    }

//extra
    public PanelInventario(String idkardex,String gestion,String cliente,String vendedor,String mesrango,String idmarca, String marca,String opcion, String formmayor,Object[][] materialM,Object[][] vendedorM,String cajas,String totalparess,String totalbss, String responsable,String almacen,String idalmacen,String item,KMenu kmenu) {
       // this.SM = pedido1;
            this.gestion = gestion;
              this.idclientebusqueda =cliente;
               this.itembusca =item;
        this.idvendedorbusqueda =vendedor;
           this.kmenu = kmenu;
        this.marca = marca;
        this.idmarca = idmarca;
        this.mesrango = mesrango;
        this.idkardex=idkardex;
        this.marca = marca;
          this.vendedorM = vendedorM;
         this.marcanombre = marca;
         this.colorM = materialM;
         this.totalpares = totalparess;
         this.totalbs = totalbss;
         this.opcion = opcion;
this.formatomayor = formmayor;
this.totalcajas = cajas;
this.responsable = responsable;
this.almacen = almacen;
this.idalmacen = idalmacen;
this.miinventario="1";
        onModuleLoad();
    }
    //reabrir
public PanelInventario(String idkardex,String mesrango,String idmarca, String marca,String opcion, String formmayor,Object[][] materialM,Object[][] vendedorM,String cajas,String totalparess,String totalbss, String responsable,String almacen,String idalmacen,KMenu kmenu) {
       // this.SM = pedido1;
           this.kmenu = kmenu;
          this.vendedorM = vendedorM;
               this.idclientebusqueda ="";
                this.itembusca ="";
        this.idvendedorbusqueda ="";
        this.marca = marca;
        this.marcanombre = marca;
        this.idmarca = idmarca;
        this.mesrango = mesrango;
        this.idkardex=idkardex;
        this.marca = marca;
         this.colorM = materialM;
         this.totalpares = totalparess;
         this.totalbs = totalbss;
         this.opcion = opcion;
this.formatomayor = formmayor;
this.totalcajas = cajas;
this.responsable = responsable;
this.almacen = almacen;
this.idalmacen = idalmacen;
this.gestion ="";
this.miinventario="1";
        onModuleLoad();
         }
    //con ceros

public PanelInventario(String inventario,String idkardex,String gestion,String cliente,String vendedor,String mesrango,String idmarca, String marca,String opcion, String formmayor,Object[][] materialM,Object[][] vendedorM,String cajas,String totalparess,String totalbss, String responsable,String almacen,String idalmacen,String item,KMenu kmenu) {
       // this.SM = pedido1;
        this.gestion = gestion;
        this.idclientebusqueda =cliente;
         this.itembusca =item;
        this.idvendedorbusqueda =vendedor;
        this.kmenu = kmenu;
        this.marca = marca;
        this.idmarca = idmarca;
        this.mesrango = mesrango;
        this.idkardex=idkardex;
        this.marca = marca;
        this.vendedorM = vendedorM;
        this.marcanombre = marca;
        this.colorM = materialM;
        this.totalpares = totalparess;
        this.totalbs = totalbss;
        this.opcion = opcion;
        this.formatomayor = formmayor;
        this.totalcajas = cajas;
        this.responsable = responsable;
        this.almacen = almacen;
        this.idalmacen = idalmacen;
        this.miinventario="0";
        onModuleLoad();
    }
    
    public void onModuleLoad() {
        //panel = new Panel();
        setId("tab-" + COMPRA_DIRECTA_TABBED);
        setTitle("Marca "+ marca);
        setLayout(new FitLayout());
        setBaseCls("x-plain");
        this.setClosable(true);
        this.setId("TPfun5029");
        setIconCls("tab-icon");
 //MessageBox.alert(totalbs);
        Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");

        Panel pan_norte = new Panel();
        pan_norte.setLayout(new TableLayout(4));
        pan_norte.setBaseCls("x-plain");
        pan_norte.setHeight(90);
        pan_norte.setPaddings(5);
        Panel pan_sud = new Panel();
        pan_sud.setLayout(new TableLayout(1));
        pan_sud.setBaseCls("x-plain");
        pan_sud.setHeight(50);
        pan_sud.setPaddings(5);
//ramarim
       if (opcion.equalsIgnoreCase("6")) {
            lista1 = new ListaInventarioGrid();
       //     lista1.onModuleLoad5(idmarca, idalmacen,idkardex,colorM,gestion);
            lista1.onModuleLoad5(idmarca, idalmacen,idkardex,colorM,gestion,idclientebusqueda,idvendedorbusqueda,itembusca);

           }

        //361

               if (opcion.equalsIgnoreCase("12")) {
            lista1 = new ListaInventarioGrid();
     lista1.onModuleLoad55(idmarca, idalmacen,idkardex,colorM,gestion,idclientebusqueda,idvendedorbusqueda,itembusca);
               }
       //kidy 14 al 38
         if (opcion.equalsIgnoreCase("3")) {
      lista1 = new ListaInventarioGrid();
        lista1.onModuleLoad10(idmarca, idalmacen,idkardex,colorM,gestion,idclientebusqueda,idvendedorbusqueda,itembusca);

         }
//west 33 al 45
        if (opcion.equalsIgnoreCase("7")) {
      lista1 = new ListaInventarioGrid();
       lista1.onModuleLoad8(idmarca, idalmacen,idkardex,colorM,gestion,idclientebusqueda,idvendedorbusqueda,itembusca);
          }

 //    cravo 33 al 45
          if (opcion.equalsIgnoreCase("11")) {
      lista1 = new ListaInventarioGrid();
   lista1.onModuleLoad88(idmarca, idalmacen,idkardex,colorM,gestion,idclientebusqueda,idvendedorbusqueda,itembusca);

          }
//
         //FINOBEL 14 al 38
         if (opcion.equalsIgnoreCase("8")) {
      lista1 = new ListaInventarioGrid();
 lista1.onModuleLoad12(idmarca, idalmacen,idkardex,colorM,gestion,idclientebusqueda,idvendedorbusqueda,itembusca);

            }
//          //Molekhina 14 al 38
         if (opcion.equalsIgnoreCase("9")) {
      lista1 = new ListaInventarioGrid();
//lista1.onModuleLoad13(colorM,materialM,clienteM,vendedorM,idmarca);
 lista1.onModuleLoad13(idmarca, idalmacen,idkardex,colorM,gestion,idclientebusqueda,idvendedorbusqueda,itembusca);

            }
        //accesorios
         if (opcion.equalsIgnoreCase("2")) {
                lista1 = new ListaInventarioGrid();
         //   lista1.onModuleLoad99(colorM,materialM,clienteM,vendedorM,tipoM,idmarca);
             lista1.onModuleLoad99(idmarca, idalmacen,idkardex,colorM,gestion,idclientebusqueda,idvendedorbusqueda,itembusca);
          }

        //coca  color del 33 al 45

 if (opcion.equalsIgnoreCase("10")) {
      lista1 = new ListaInventarioGrid();
       lista1.onModuleLoad11(idmarca, idalmacen,idkardex,colorM,gestion,idclientebusqueda,idvendedorbusqueda,itembusca);
 //      lista1.onModuleLoad8(idmarca, idalmacen,idkardex,colorM,gestion,idclientebusqueda,idvendedorbusqueda);

 }
 if (opcion.equalsIgnoreCase("13")) {
      lista1 = new ListaInventarioGrid();
       lista1.onModuleLoad14(idmarca, idalmacen,idkardex,colorM,gestion,idclientebusqueda,idvendedorbusqueda,itembusca);
 //      lista1.onModuleLoad8(idmarca, idalmacen,idkardex,colorM,gestion,idclientebusqueda,idvendedorbusqueda);

 }

         Panel pan_centro = lista1.getPanel();
        FormPanel for_panel1 = new FormPanel();
        for_panel1.setBaseCls("x-plain");
        for_panel1.setWidth(230);
        for_panel1.setLabelWidth(100);
        tex_marca = new TextField("Marca", "marca", 120);
        tex_marca.setValue(marca);
        tex_marca.setReadOnly(true);
               tex_numeropedido = new TextField("Almacen", "estilo", 100);
        tex_numeropedido.setReadOnly(true);
        tex_numeropedido.setValue(almacen);
           dat_fecha = new DateField("Fecha", "d-m-Y");
        Date date = new Date();
        dat_fecha.setValue(Utils.getStringOfDate(date));

//      tex_responsable = new TextField("Encargado", "encargado", 200);
//        tex_responsable.setReadOnly(true);
//        tex_responsable.setValue(responsable);

        for_panel1.add(tex_marca);
        for_panel1.add(tex_numeropedido);
 for_panel1.add(dat_fecha);
        // for_panel1.add(tex_modeloCP);

        FormPanel for_panel2 = new FormPanel();
        for_panel2.setBaseCls("x-plain");
        for_panel2.setWidth(220);
        for_panel2.setLabelWidth(100);
          tex_totalcaja = new TextField("Total Cajas", "totalpares", 120);
        tex_totalcaja.setReadOnly(true);
        tex_totalcaja.setValue(totalcajas);

        tex_totalpares = new TextField("Total Pares", "totalpares", 120);
        tex_totalpares.setReadOnly(true);
        tex_totalpares.setValue(totalpares);
 
        tex_totalbs = new TextField("Total Sus", "totalbs", 120);
        tex_totalbs.setReadOnly(true);
        tex_totalbs.setValue(totalbs);

        but_aceptar = new Button("Precios");
        but_cancelar = new Button("Cancelar");
        but_traspasar = new Button("Traspasar");
        but_editarmodelo = new Button("Edita Modelo");
       but_venta = new Button("Venta Cliente");
       but_eliminar = new Button("eliminar Modelos");
       but_detalle = new Button("Ver Codigos");
        but_editaritem = new Button("Edita Item");
        but_feria = new Button("Feria");
    //but_ceros = new Button("En cero");
     for_panel2.add(tex_totalcaja);
        for_panel2.add(tex_totalpares);
       for_panel2.add(tex_totalbs);

 //for_panel2.add(new PaddedPanel(pan_botonescliente, 5, 5, 5, 5), new TableLayoutData(3));

        FormPanel for_panel3 = new FormPanel();
        for_panel3.setBaseCls("x-plain");
        for_panel3.setWidth(290);
        for_panel3.setLabelWidth(100);

     
        // dat_fecha.setValue(fecha);
         com_cliente = new ComboBox("Cliente/Buscar", "idcliente");
         com_vendedor = new ComboBox("Vendedor", "idempleado",300);
         tex_proforma = new TextField("Proforma", "proforma", 120);
           tex_rango = new TextField("Modelo", "rango", 120);

      //   tex_rango = new TextField("Filtrar por Item/Cliente", "rango", 200);
        for_panel3.add(com_vendedor);
for_panel3.add(tex_rango);
for_panel3.add(tex_proforma);
//for_panel3.add(com_cliente);
 FormPanel for_panel41 = new FormPanel();
        for_panel41.setBaseCls("x-plain");
        for_panel41.setWidth(300);
        for_panel41.setLabelWidth(100);


        // dat_fecha.setValue(fecha);

           tex_cliente = new TextField("Cliente", "cliente", 150);

      //   tex_rango = new TextField("Filtrar por Item/Cliente", "rango", 200);

  //    for_panel41.add(tex_cliente);
  for_panel41.add(com_cliente);
        pan_norte.add(new PaddedPanel(for_panel1, 10));
        pan_norte.add(new PaddedPanel(for_panel2, 10));
        pan_norte.add(new PaddedPanel(for_panel3, 10));
         pan_norte.add(new PaddedPanel(for_panel41, 10));
//        pan_norte.add(new PaddedPanel(for_panel12, 0, 0, 13, 10));

        FormPanel for_panel4 = new FormPanel();
        for_panel4.setBaseCls("x-plain");

        tex_preciototal = new TextField("", "totalprecio");
// tex_totalcaja.setValue(totalcajas);
        for_panel4.add(tex_preciototal);


        FormPanel for_panel6 = new FormPanel();
        for_panel6.setBaseCls("x-plain");
        tea_descripcion = new TextArea("Observacion", "observacion");
        tea_descripcion.setWidth("100%");

        for_panel6.add(tea_descripcion);

        Panel pan_botones = new Panel();
        pan_botones.setLayout(new HorizontalLayout(10));
        pan_botones.setBaseCls("x-plain");
        //       pan_botones.setHeight(40);
        
        but_limpiar = new Button("Limpiar");
        but_aceptarR = new Button("FORMATO IMPRESION");

//but_imprimir = new Button("Imprimir Lista");
 //       pan_botones.add(but_imprimir);
        //but_verproducto = new Button("Ver Producto");
        pan_botones.add(but_aceptar);
        pan_botones.add(but_cancelar);
        pan_botones.add(but_aceptarR);
        pan_botones.add(but_eliminar);
pan_botones.add(but_traspasar);
 pan_botones.add(but_detalle);
 pan_botones.add(but_venta);
  pan_botones.add(but_editarmodelo);
  pan_botones.add(but_editaritem);
  pan_botones.add(but_feria);
        pan_sud.add(new PaddedPanel(pan_botones, 10, 10, 10, 10), new TableLayoutData(3));


        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centro, new BorderLayoutData(RegionPosition.CENTER));
        pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        add(pan_borderLayout);

        initCombos();
        //  initValues();
        addListeners();


    }

    public void reload() {
        lista1.getStore().reload();
    }
private void initCombos() {


         SimpleStore proveedorStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, colorM);
        proveedorStore1.load();
        com_cliente.setMinChars(1);
        com_cliente.setStore(proveedorStore1);
        com_cliente.setValueField("idcliente");
        com_cliente.setDisplayField("codigo");
        com_cliente.setForceSelection(true);
        com_cliente.setMode(ComboBox.LOCAL);
     //   com_cliente.setEmptyText("Buscar almacen");
        com_cliente.setLoadingText("buscando...");
        com_cliente.setTypeAhead(true);
        com_cliente.setSelectOnFocus(true);
        com_cliente.setWidth(130);
        com_cliente.setHideTrigger(true);

  SimpleStore proveedorStore11 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        proveedorStore11.load();
        com_vendedor.setMinChars(1);
        com_vendedor.setStore(proveedorStore11);
        com_vendedor.setValueField("idempleado");
        com_vendedor.setDisplayField("codigo");
        com_vendedor.setForceSelection(true);
        com_vendedor.setMode(ComboBox.LOCAL);
       //com_vendedor.setEmptyText("Buscar vendedor");
        com_vendedor.setLoadingText("buscando...");
        com_vendedor.setTypeAhead(true);
        com_vendedor.setSelectOnFocus(true);
        com_vendedor.setWidth(200);
        com_vendedor.setHideTrigger(true);
    }
    private void addListeners() {
        tex_cliente.addListener(new TextFieldListenerAdapter() {

            //private FormularioPedidoKardex kardex;
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
             String mifecha = tex_rango.getValueAsString().trim();
              String mivendedor = com_vendedor.getValueAsString().trim();
               String micliente = tex_proforma.getValueAsString().trim();
                String miitem = com_cliente.getValueAsString().trim();

 // String micliente = com_cliente.getValueAsString().trim();
            kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);
            reabrirpanel(e,mifecha,micliente,mivendedor, idmarca, idalmacen,idkardex,colorM,miitem);

                }
            }
           });
         tex_proforma.addListener(new TextFieldListenerAdapter() {

            //private FormularioPedidoKardex kardex;
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
             String mifecha = tex_rango.getValueAsString().trim();
              String mivendedor = com_vendedor.getValueAsString().trim();
               String micliente = tex_proforma.getValueAsString().trim();
                String miitem = com_cliente.getValueAsString().trim();

 // String micliente = com_cliente.getValueAsString().trim();
            kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);
            reabrirpanel(e,mifecha,micliente,mivendedor, idmarca, idalmacen,idkardex,colorM,miitem);

                }
            }
           });
          tex_rango.addListener(new TextFieldListenerAdapter() {

            //private FormularioPedidoKardex kardex;
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
             String mifecha = tex_rango.getValueAsString().trim();
              String mivendedor = com_vendedor.getValueAsString().trim();
              String miitem = com_vendedor.getValueAsString().trim();
                String micliente = tex_proforma.getValueAsString().trim();

            kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);
            reabrirpanel(e,mifecha,micliente,mivendedor, idmarca, idalmacen,idkardex,colorM,miitem);

                }
            }
           });
         com_cliente.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                  String mifecha = tex_rango.getValueAsString().trim();
              String mivendedor = com_vendedor.getValueAsString().trim();
               String miitem = com_cliente.getValueAsString().trim();
               String micliente = tex_proforma.getValueAsString().trim();

            kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);
            reabrirpanel(e,mifecha,micliente,mivendedor, idmarca, idalmacen,idkardex,colorM,miitem);
                }
            }
        });

 com_vendedor.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                  String mifecha = tex_rango.getValueAsString().trim();
              String mivendedor = com_vendedor.getValueAsString().trim();
              String miitem = com_cliente.getValueAsString().trim();
              String micliente = tex_proforma.getValueAsString().trim();

            kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);
            reabrirpanel(e,mifecha,micliente,mivendedor, idmarca, idalmacen,idkardex,colorM,miitem);
                }
            }
        });

   but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
      kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);

  abrirpanelreporte();
            }
        });

          but_editarmodelo.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
               createEditar(idmarca,idkardex);
            }
        });
          but_traspasar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
               createTraspasar(idmarca,idkardex);
            }
        });
        but_editaritem.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
               createEditaritem(idmarca,idkardex);
            }
        });
         but_venta.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
               createVEnder(idmarca,idkardex);

            }
        });
        //**************************************************
        //************* BOTON ACEPTAR *******************
        //**************************************************
         but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                //ojo actualizacion
                tipoclave="precio";
                 datosusuario(idmarca,idalmacen,idkardex,tipoclave);
                //createPedido(idmarca,idalmacen,idkardex);

           //     createPedido(idmarca,idestilo,idkardex);
            }
        });
   but_feria.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                //ojo actualizacion
                tipoclave="precio";
               createPedidousuarioferia(idmarca, idalmacen, idkardex);
            }
        });
           but_eliminar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                //ojo actualizacion
                tipoclave="eliminar";
                 datosusuario(idmarca,idalmacen,idkardex,tipoclave);
           
            }
        });

//          but_vendedor.addListener(new ButtonListenerAdapter() {
//
//            @Override
//            public void onClick(Button button, EventObject e) {
//                // createcambio(idmarca,idalmacen,idkardex);
//               Record[] records = lista1.cbSelectionModel.getSelections();
//                if (records.length == 1) {
//                    selecionado = records[0].getAsString("idmodelo");
//                      //datosnuevotalla(idmarca,idalmacen,idkardex,selecionado);
//                      datosnuevovendedor(idmarca,idalmacen,idkardex,selecionado);
//                } else {
//                    MessageBox.alert("No hay item selecionado  y/o selecciono mas de uno.");
//                }
//
//           //     createPedido(idmarca,idestilo,idkardex);
//            }
//        });
         but_detalle.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
           
                 Record[] records = lista1.cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idmodelo");
                      //datosnuevotalla(idmarca,idalmacen,idkardex,selecionado);
                        formularioc = new FormularioKardexPar(PanelInventario.this,selecionado);
                            formularioc.show();
                } else {
                    MessageBox.alert("No hay item selecionado  y/o selecciono mas de uno.");
                }


            }
        });

    but_aceptarR.addListener(new ButtonListenerAdapter() {

            @Override

            public void onClick(Button button, EventObject e) {
       
                 String idclientes = tex_proforma.getValueAsString().trim();
String idvendedors = com_vendedor.getValueAsString();
String modelo = tex_rango.getValueAsString();

  String enlace = "funcion=ListaInventarioMarca&idmarca=" + idmarca + "&idcliente="+idclientes + "&idvendedor="+idvendedors+ "&modelo="+modelo+ "&idkardex="+idkardex;
verReporte(enlace);

            }
        });


         lista1.getGrid().addEditorGridListener(new EditorGridListenerAdapter() {

            @Override
            public void onAfterEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
                calcularSubTotal(grid, record, field, newValue, oldValue, rowIndex, colIndex);
            }
        });

    }


      public void createEditaritem(final String idmarca,final String responsable) {
      final Record[] records;

           records = lista1.cbSelectionModel.getSelections();
       if (records.length > 0) {
                   MessageBox.confirm("Guardar", "Realmente desea editar el item/cliente : " + records.length + " modelos(s)?", new MessageBox.ConfirmCallback() {
                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {

      String enlace = "php/VentaMayor.php?funcion=BuscarEmpleadomialmacenAlmacen&idmarca=" + idmarca;

      Utils.setErrorPrincipal("Cargando parametros del Traspaso", "cargar");
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
                      //               Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
        Object[][] vendedorM = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "nombre"});
        Object[][] almacenM = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{"idalmacen", "codigo"});
 formulario_alm12 = null;
 formulario_alm12 = new MostrarEditarModeloitem(vendedorM,PanelInventario.this);
//formulario_alm1 = new MostrarEditarModelo(idmodelo,codigo,color,material,cliente,idcliente,fechaingreso,nombrecliente,vendedorM,PanelInventario.this);
formulario_alm12.show();
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
                            }//fin boton
                        }
                    });
                } else {
                    MessageBox.alert("No hay modelos seleccionados para enviar.");
                }
             //   GuardarCat.setPressed(false);
    }
    

 private void datosusuario(final String idmarca,final String idalmacen,final String idkardex,final String tipoclave) {

         String enlace = "php/VentaMayor.php?funcion=BuscarEmpleadomialmacen&idmarca=" + idmarca;
        Utils.setErrorPrincipal("Cargando parametros ", "cargar");
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
        Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "nombre"});


                                    formulariousuario = null;
                                    formulariousuario = new ValidarUsuario( tipoclave,estiloM, idmarca,idalmacen,idkardex,PanelInventario.this);
                                    formulariousuario.show();
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
       public void registraredicionmodeloitem(String item,String clienteitem) {
  final Record[] records;
           records = lista1.cbSelectionModel.getSelections();
        JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();
          compraObject.put("item", new JSONString(item));
        compraObject.put("clienteitem", new JSONString(clienteitem));
 Float top = new Float(0);
  Float top1 = new Float(0);
   Float top2 = new Float(0);

        for (int i = 0; i < records.length; i++) {
// if (opcion.equalsIgnoreCase("4")) {
                productoObject = new JSONObject();

               productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
               productos.set(i, productoObject);
               productoObject = null;
         }
        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
      String url = "./php/VentaMayor.php?funcion=GuardarEdicionModeloitem&" + datos;
     // String url = "./php/VentaMayor.php?funcion=GuardarEdicionModelo&" + datos;

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
                        formulario_alm12.close();
            formulario_alm12.destroy();
          lista1.grid.getStore().reload();
                           Window.alert(mensajeR);
                        final String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");

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
    //

    }
    public void createTraspasar(final String idmarca,final String responsable) {
       final Record[] records;

           records = lista1.cbSelectionModel.getSelections();
       if (records.length > 0) {
                   MessageBox.confirm("Guardar", "Realmente desea traspasar : " + records.length + " modelos(s)?", new MessageBox.ConfirmCallback() {
                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
    
      String enlace = "php/VentaMayor.php?funcion=BuscarEmpleadomialmacenAlmacen&idmarca=" + idmarca;

      Utils.setErrorPrincipal("Cargando parametros del Traspaso", "cargar");
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
                      //               Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
        Object[][] vendedorM = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "nombre"});
        Object[][] almacenM = Utils.getArrayOfJSONObject(marcaO, "almacenM", new String[]{"idalmacen", "codigo"});
 formulario_alm = null;
 formulario_alm = new MostrarTraspasototal(almacenM,vendedorM,idmarca,responsable,PanelInventario.this);
 formulario_alm.show();
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
                            }//fin boton
                        }
                    });
                } else {
                    MessageBox.alert("No hay modelos seleccionados para enviar.");
                }
             //   GuardarCat.setPressed(false);
    }

     public void createEditar(final String idmarca,final String responsable) {
       final Record[] records;

//           records = lista1.cbSelectionModel.getSelections();
//       if (records.length > 0) {
             records = lista1.cbSelectionModel.getSelections();
                if (records.length == 1) {
         final String idmodelo = records[0].getAsString("idmodelo");
      String enlace = "php/VentaMayor.php?funcion=Buscarclientesmodelo&idmodelo=" + idmodelo;
    Utils.setErrorPrincipal("Cargando parametros...", "cargar");
        final Conector conec = new Conector(enlace, false);

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

                            JSONValue productoV = jsonObject.get("resultado");
                            JSONObject productoO;
                            if ((productoO = productoV.isObject()) != null) {

                                String codigo = Utils.getStringOfJSONObject(productoO, "codigo");
                                String color = Utils.getStringOfJSONObject(productoO, "color");
                                String material = Utils.getStringOfJSONObject(productoO, "material");
                                String cliente = Utils.getStringOfJSONObject(productoO, "cliente");
                                String idcliente = Utils.getStringOfJSONObject(productoO, "idcliente");
                                String fechaingreso = Utils.getStringOfJSONObject(productoO, "fechaingreso");
                                 String nombrecliente = Utils.getStringOfJSONObject(productoO, "nombrecliente");
 Object[][] vendedorM = Utils.getArrayOfJSONObject(productoO, "clienteM", new String[]{"idcliente", "codigo"});
 formulario_alm1 = null;
 formulario_alm1 = new MostrarEditarModelo(idmodelo,codigo,color,material,cliente,idcliente,fechaingreso,nombrecliente,vendedorM,PanelInventario.this);
 formulario_alm1.show();

                            } else {
                                Utils.setErrorPrincipal("Error en el objeto ", "error");
                            }
                        } else {
                            Utils.setErrorPrincipal(mensajeR, "error");
                        }
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
                        //    }//fin boton
                    //    }
               //     });
                } else {
                    MessageBox.alert("Selecciono ninguno o mas de uno");
                }
             //   GuardarCat.setPressed(false);
    }
public void createVEnder(final String idmarca,final String responsable) {
final Record[] records;
           records = lista1.cbSelectionModel.getSelections();
       if (records.length > 0) {
                   MessageBox.confirm("Guardar", "Realmente desea vender directamente: " + records.length + " modelos(s)?", new MessageBox.ConfirmCallback() {
                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
      String enlace = "php/VentaMayor.php?funcion=BuscarEmpleadoCliente&idmarca=" + idmarca;
      Utils.setErrorPrincipal("Cargando parametros venta", "cargar");
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
                      //               Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
        Object[][] vendedorM = Utils.getArrayOfJSONObject(marcaO, "vendedorM", new String[]{"idempleado", "codigo"});
Object[][] clienteM = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});


 formulario_almv = null;
 formulario_almv = new MostraVenta(clienteM,vendedorM,idmarca,responsable,PanelInventario.this);
 formulario_almv.show();
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
                            }//fin boton
                        }
                    });
                } else {
                    MessageBox.alert("No hay modelos seleccionados para enviar.");
                }
             //   GuardarCat.setPressed(false);
    }



     public void verdetalletraspaso(final String idmarca,final String idestilos,final String idkardex) {
  Record[] records;
 //this.marcanombre = marca;
     final String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");

           records = lista1.cbSelectionModel.getSelections();
          JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();

        compraObject.put("boleta", new JSONString(idmarca));
        compraObject.put("responsable", new JSONString(idestilos));
        compraObject.put("transporte", new JSONString(idkardex));
   compraObject.put("marca", new JSONString(marcanombre));
   //        compraObject.put("fecha", new JSONString(fechaent));
    //    String[] nombreCaso55Columns = {"idmodelo", "codigo", "material","color","cliente", "totalcajas","precio","preciounitario", "36", "37", "38", "39", "40", "41", "42","43", "44", "45",  "totalpares","totalparescaja",  "totalparesbs"};

       for (int i = 0; i < records.length; i++) {
             productoObject = new JSONObject();
                    productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
               productoObject.put("material", new JSONString(records[i].getAsString("material")));
                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                //productoObject.put("talla", new JSONString(records[i].getAsString("talla")));

                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));

                    productos.set(i, productoObject);
                productoObject = null;

        }
    //fin opciones
        JSONObject resultado = new JSONObject();
        resultado.put("detalle", compraObject);
        resultado.put("productos", productos);
      
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("generando", "cargar");
        String url;
        //url = "funcion=imprimirmodeloestilotalladetalletraspaso&" + datos;
        url = "funcion=imprimirmodeloestilotalladetalletraspaso&" + datos;
        verReporteTraspaso(url);
        
    }

//            reabrirpanel(e,mifecha,micliente,mivendedor, idmarca, idalmacen,idkardex,colorM);
  public void reabrirpanel(EventObject e,final String mifecha,final String cliente,final String vendedor, final String idmarca, String idestilos,final String idkardex,Object[][] MaterialM1,final String item) {
        String enlace = "php/IngresoAlmacen.php?funcion=CargarInventarioActual&idmarca=" + idmarca+"&idalmacen="+idestilos+ "&idkardex="+idkardex+ "&modelo="+mifecha+ "&cliente="+cliente+ "&vendedor="+vendedor;
//        String enlace = "php/IngresoAlmacen.php?funcion=CargarInventarioActual&idmarca=" + idmarca+"&idalmacen="+idestilos+ "&idkardex="+idkardex+ "&gestion="+mifecha;

        Utils.setErrorPrincipal("Cargando parametros de empresa", "cargar");
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
   Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
   Object[][] vendedorM = Utils.getArrayOfJSONObject(marcaO, "empleadoM", new String[]{"idempleado", "codigo"});

   String opcion = Utils.getStringOfJSONObject(marcaO, "opcionb");
                                                       String formatomayor = Utils.getStringOfJSONObject(marcaO, "formatomayor");
   String totalpares = Utils.getStringOfJSONObject(marcaO, "totalpares");
   String totalbs = Utils.getStringOfJSONObject(marcaO, "totalsus");
   String totalcajas = Utils.getStringOfJSONObject(marcaO, "totalcajas");
 String responsable = Utils.getStringOfJSONObject(marcaO, "responsable");
 String almacen = Utils.getStringOfJSONObject(marcaO, "almacen");

String mesrango = Utils.getStringOfJSONObject(marcaO, "mesrango");
//PanelInventario pan_compraDirecta = new PanelInventario(idkardex,mifecha,mesrango,idmarca, marca,opcion,formatomayor, colores,totalcajas,totalpares,totalbs,responsable, almacen,idalmacen,kmenu);
PanelInventario pan_compraDirecta = new PanelInventario(idkardex,mifecha,cliente,vendedor,mesrango,idmarca, marca,opcion,formatomayor, colores,vendedorM,totalcajas,totalpares,totalbs,responsable, almacen,idalmacen,item,kmenu);

kmenu.seleccionarOpcion(null, "fun5029", e, pan_compraDirecta);

                                 Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + idmarca, "mensaje");
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
 private void abrirpanelreporte(){
          String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaEstiloinventario";
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
         Object[][] kardexM = Utils.getArrayOfJSONObject(marcaO, "kardexM", new String[]{"idkardex", "mesrango","fechainicio","fechafin"});
//   Object[][] productos = Utils.getArrayOfJSONObject(jsonObject, "productoM", new String[]{"id", "detalle", "unidad", "preciounitario"});

        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
        Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "estiloM", new String[]{"idestilo", "idmarca","nombre"});
          String mesrango = Utils.getStringOfJSONObject(marcaO, "mesrango");
          String fechaini = Utils.getStringOfJSONObject(marcaO, "fechaini");
          String fechafin = Utils.getStringOfJSONObject(marcaO, "fechafin");
       // formMTEInventario = new SeleccionMarcaEstiloInventario(kardexM,marcaM,estiloM ,KMenu.this);

                                        SM = new SeleccionMarcaEstiloInventario(mesrango,fechaini,fechafin,kardexM,marcaM,estiloM ,kmenu);
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
 public void createPedido(final String idmarca,final String idestilos,final String idkardex) {
 final String totalpares1 = tex_totalpares.getValueAsString();
        final String totalcaja1 = tex_totalcaja.getValueAsString();
        final String totalbs1 = tex_totalbs.getValueAsString();

    final String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
   MessageBox.confirm("Guardar", "Confirma la modificacion de datos:  ? ,no olvide reimprimir  sus codigos de barra", new MessageBox.ConfirmCallback() {
                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("no")) {
// String enlTemp = "funcion=AdicionCodigoBarraIngresoHTML&idingreso=" + idventaG;
 //                           verReporte(enlTemp);
                           }else{

                               final String idesti = idestilos;
        Record[] records = lista1.getStore().getModifiedRecords();
   JSONArray productos = new JSONArray();
        JSONObject productoObject;
        JSONObject compraObject = new JSONObject();
        compraObject.put("fecharegistro", new JSONString(fechaent));
        compraObject.put("totalpares", new JSONString(totalpares1));
        compraObject.put("totalbs", new JSONString(totalbs1));
        compraObject.put("totalcaja", new JSONString(totalcaja1));
        compraObject.put("idmarca", new JSONString(idmarca));
         compraObject.put("idkardex", new JSONString(idkardex));

     //    compraObject.put("idalmacen", new JSONString(idestilos));
        //   String[] nombreCaso5Columns = {"idmodelo", "codigo", "material","color","cliente","vendedor", "fecha", "totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42",  "totalpares","totalparescaja",  "totalparesbs"};
  
        for (int i = 0; i < records.length; i++) {
           
 if (opcion.equalsIgnoreCase("2")) {
                productoObject = new JSONObject();
                 productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
              
//                 productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
//                productoObject.put("color", new JSONString(records[i].getAsString("color")));
//               productoObject.put("material", new JSONString(records[i].getAsString("material")));
//                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
//                 productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
//                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("talla", new JSONString(records[i].getAsString("talla")));
productoObject.put("preciooficina", new JSONString(records[i].getAsString("preciooficina")));

                productos.set(i, productoObject);
                productoObject = null;
            }
              //ramarim
        if (opcion.equalsIgnoreCase("6")) {
      productoObject = new JSONObject();
           productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("preciooficina", new JSONString(records[i].getAsString("preciooficina")));

//                productoObject.put("33", new JSONString(records[i].getAsString("33")));
//                productoObject.put("34", new JSONString(records[i].getAsString("34")));
//                productoObject.put("35", new JSONString(records[i].getAsString("35")));
//                productoObject.put("36", new JSONString(records[i].getAsString("36")));
//                productoObject.put("37", new JSONString(records[i].getAsString("37")));
//                productoObject.put("38", new JSONString(records[i].getAsString("38")));
//                productoObject.put("39", new JSONString(records[i].getAsString("39")));
//                productoObject.put("40", new JSONString(records[i].getAsString("40")));
//                productoObject.put("41", new JSONString(records[i].getAsString("41")));
//                productoObject.put("42", new JSONString(records[i].getAsString("42")));
//                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
//                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
//                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
//                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
        }
              //361
          if (opcion.equalsIgnoreCase("12")) {
      productoObject = new JSONObject();
           productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
//               productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
//                productoObject.put("color", new JSONString(records[i].getAsString("color")));
//               productoObject.put("material", new JSONString(records[i].getAsString("material")));
//                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
//                productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
//                productoObject.put("talla", new JSONString(records[i].getAsString("talla")));
//                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("preciooficina", new JSONString(records[i].getAsString("preciooficina")));

//                productoObject.put("36", new JSONString(records[i].getAsString("36")));
//                productoObject.put("37", new JSONString(records[i].getAsString("37")));
//                productoObject.put("38", new JSONString(records[i].getAsString("38")));
//                productoObject.put("39", new JSONString(records[i].getAsString("39")));
//                productoObject.put("40", new JSONString(records[i].getAsString("40")));
//                productoObject.put("41", new JSONString(records[i].getAsString("41")));
//                productoObject.put("42", new JSONString(records[i].getAsString("42")));
//                 productoObject.put("43", new JSONString(records[i].getAsString("43")));
//                productoObject.put("44", new JSONString(records[i].getAsString("44")));
//                productoObject.put("45", new JSONString(records[i].getAsString("45")));

//                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
//                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
//                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
//                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
        }

//west 33 al 45
        if (opcion.equalsIgnoreCase("7")) {
      productoObject = new JSONObject();
       productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
//                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
//                 productoObject.put("material", new JSONString(records[i].getAsString("material")));
//
//                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
//                 productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
//                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("preciooficina", new JSONString(records[i].getAsString("preciooficina")));

//                productoObject.put("33", new JSONString(records[i].getAsString("33")));
//                productoObject.put("34", new JSONString(records[i].getAsString("34")));
//                productoObject.put("35", new JSONString(records[i].getAsString("35")));
//                productoObject.put("36", new JSONString(records[i].getAsString("36")));
//                productoObject.put("37", new JSONString(records[i].getAsString("37")));
//                productoObject.put("38", new JSONString(records[i].getAsString("38")));
//                productoObject.put("39", new JSONString(records[i].getAsString("39")));
//                productoObject.put("40", new JSONString(records[i].getAsString("40")));
//                productoObject.put("41", new JSONString(records[i].getAsString("41")));
//                productoObject.put("42", new JSONString(records[i].getAsString("42")));
//                 productoObject.put("43", new JSONString(records[i].getAsString("43")));
//                productoObject.put("44", new JSONString(records[i].getAsString("44")));
//                productoObject.put("45", new JSONString(records[i].getAsString("45")));
//                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
//                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
//                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
//                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
            }
        //cravo 33 al 45
        if (opcion.equalsIgnoreCase("11")) {
      productoObject = new JSONObject();
       productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
//                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
//                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
//                  productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
//                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));

                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("preciooficina", new JSONString(records[i].getAsString("preciooficina")));

//                productoObject.put("33", new JSONString(records[i].getAsString("33")));
//                productoObject.put("34", new JSONString(records[i].getAsString("34")));
//                productoObject.put("35", new JSONString(records[i].getAsString("35")));
//                productoObject.put("36", new JSONString(records[i].getAsString("36")));
//                productoObject.put("37", new JSONString(records[i].getAsString("37")));
//                productoObject.put("38", new JSONString(records[i].getAsString("38")));
//                productoObject.put("39", new JSONString(records[i].getAsString("39")));
//                productoObject.put("40", new JSONString(records[i].getAsString("40")));
//                productoObject.put("41", new JSONString(records[i].getAsString("41")));
//                productoObject.put("42", new JSONString(records[i].getAsString("42")));
//              productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
//                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
//                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
//                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
            }
 //kidy 14 al 38
         if (opcion.equalsIgnoreCase("3")) {
       productoObject = new JSONObject();
        productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
//                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
//                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
//                 productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
//                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("preciooficina", new JSONString(records[i].getAsString("preciooficina")));

//                productoObject.put("14", new JSONString(records[i].getAsString("14")));
//                productoObject.put("15", new JSONString(records[i].getAsString("15")));
//                productoObject.put("16", new JSONString(records[i].getAsString("16")));
//                productoObject.put("17", new JSONString(records[i].getAsString("17")));
//                productoObject.put("18", new JSONString(records[i].getAsString("18")));
//                productoObject.put("19", new JSONString(records[i].getAsString("19")));
//                productoObject.put("20", new JSONString(records[i].getAsString("20")));
//                productoObject.put("21", new JSONString(records[i].getAsString("21")));
//                productoObject.put("22", new JSONString(records[i].getAsString("22")));
//                productoObject.put("23", new JSONString(records[i].getAsString("23")));
//                productoObject.put("24", new JSONString(records[i].getAsString("24")));
//                productoObject.put("25", new JSONString(records[i].getAsString("25")));
//                productoObject.put("26", new JSONString(records[i].getAsString("26")));
//                productoObject.put("27", new JSONString(records[i].getAsString("27")));
//                productoObject.put("28", new JSONString(records[i].getAsString("28")));
//                productoObject.put("29", new JSONString(records[i].getAsString("29")));
//                productoObject.put("30", new JSONString(records[i].getAsString("30")));
//                productoObject.put("31", new JSONString(records[i].getAsString("31")));
//                productoObject.put("32", new JSONString(records[i].getAsString("32")));
//                productoObject.put("33", new JSONString(records[i].getAsString("33")));
//                productoObject.put("34", new JSONString(records[i].getAsString("34")));
//                productoObject.put("35", new JSONString(records[i].getAsString("35")));
//                productoObject.put("36", new JSONString(records[i].getAsString("36")));
//                productoObject.put("37", new JSONString(records[i].getAsString("37")));
//                productoObject.put("38", new JSONString(records[i].getAsString("38")));
//                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
//                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
//                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
//                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
            }
        //FINO 14 al 38
         if (opcion.equalsIgnoreCase("8")) {
       productoObject = new JSONObject();
        productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
//                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
//               productoObject.put("color", new JSONString(records[i].getAsString("color")));
//             //  productoObject.put("material", new JSONString(records[i].getAsString("material")));
//
//                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
//                 productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
//                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("preciooficina", new JSONString(records[i].getAsString("preciooficina")));

//                productoObject.put("14", new JSONString(records[i].getAsString("14")));
//                productoObject.put("15", new JSONString(records[i].getAsString("15")));
//                productoObject.put("16", new JSONString(records[i].getAsString("16")));
//                productoObject.put("17", new JSONString(records[i].getAsString("17")));
//                productoObject.put("18", new JSONString(records[i].getAsString("18")));
//                productoObject.put("19", new JSONString(records[i].getAsString("19")));
//                productoObject.put("20", new JSONString(records[i].getAsString("20")));
//                productoObject.put("21", new JSONString(records[i].getAsString("21")));
//                productoObject.put("22", new JSONString(records[i].getAsString("22")));
//                productoObject.put("23", new JSONString(records[i].getAsString("23")));
//                productoObject.put("24", new JSONString(records[i].getAsString("24")));
//                productoObject.put("25", new JSONString(records[i].getAsString("25")));
//                productoObject.put("26", new JSONString(records[i].getAsString("26")));
//                productoObject.put("27", new JSONString(records[i].getAsString("27")));
//                productoObject.put("28", new JSONString(records[i].getAsString("28")));
//                productoObject.put("29", new JSONString(records[i].getAsString("29")));
//                productoObject.put("30", new JSONString(records[i].getAsString("30")));
//                productoObject.put("31", new JSONString(records[i].getAsString("31")));
//                productoObject.put("32", new JSONString(records[i].getAsString("32")));
//                productoObject.put("33", new JSONString(records[i].getAsString("33")));
//                productoObject.put("34", new JSONString(records[i].getAsString("34")));
//                productoObject.put("35", new JSONString(records[i].getAsString("35")));
//                productoObject.put("36", new JSONString(records[i].getAsString("36")));
//                productoObject.put("37", new JSONString(records[i].getAsString("37")));
//                productoObject.put("38", new JSONString(records[i].getAsString("38")));
//                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
//                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
//                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
//                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
            }
        //mkñ 14 al 38
         if (opcion.equalsIgnoreCase("9")) {
       productoObject = new JSONObject();
        productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
//                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
//               productoObject.put("color", new JSONString(records[i].getAsString("color")));
//            productoObject.put("material", new JSONString(records[i].getAsString("material")));
//
//                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
//                 productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
//                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("preciooficina", new JSONString(records[i].getAsString("preciooficina")));

//                productoObject.put("14", new JSONString(records[i].getAsString("14")));
//                productoObject.put("15", new JSONString(records[i].getAsString("15")));
//                productoObject.put("16", new JSONString(records[i].getAsString("16")));
//                productoObject.put("17", new JSONString(records[i].getAsString("17")));
//                productoObject.put("18", new JSONString(records[i].getAsString("18")));
//                productoObject.put("19", new JSONString(records[i].getAsString("19")));
//                productoObject.put("20", new JSONString(records[i].getAsString("20")));
//                productoObject.put("21", new JSONString(records[i].getAsString("21")));
//                productoObject.put("22", new JSONString(records[i].getAsString("22")));
//                productoObject.put("23", new JSONString(records[i].getAsString("23")));
//                productoObject.put("24", new JSONString(records[i].getAsString("24")));
//                productoObject.put("25", new JSONString(records[i].getAsString("25")));
//                productoObject.put("26", new JSONString(records[i].getAsString("26")));
//                productoObject.put("27", new JSONString(records[i].getAsString("27")));
//                productoObject.put("28", new JSONString(records[i].getAsString("28")));
//                productoObject.put("29", new JSONString(records[i].getAsString("29")));
//                productoObject.put("30", new JSONString(records[i].getAsString("30")));
//                productoObject.put("31", new JSONString(records[i].getAsString("31")));
//                productoObject.put("32", new JSONString(records[i].getAsString("32")));
//                productoObject.put("33", new JSONString(records[i].getAsString("33")));
//                productoObject.put("34", new JSONString(records[i].getAsString("34")));
//                productoObject.put("35", new JSONString(records[i].getAsString("35")));
//                productoObject.put("36", new JSONString(records[i].getAsString("36")));
//                productoObject.put("37", new JSONString(records[i].getAsString("37")));
//                productoObject.put("38", new JSONString(records[i].getAsString("38")));
//                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
//                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
//                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
//                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
            }
        //coca  color del 33 al 45
 if (opcion.equalsIgnoreCase("10")) {
        productoObject = new JSONObject();
             //String[] nombreCaso11Columns = {"idmodelo","codigo", "color","cliente", "totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45","totalpares","totalparescaja",  "totalparesbs"};
 productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
//                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
//                productoObject.put("color", new JSONString(records[i].getAsString("color")));
//                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
//                productoObject.put("vendedor", new JSONString(records[i].getAsString("vendedor")));
//                productoObject.put("fechai", new JSONString(records[i].getAsString("fecha")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("preciooficina", new JSONString(records[i].getAsString("preciooficina")));

//                productoObject.put("33", new JSONString(records[i].getAsString("33")));
//                productoObject.put("34", new JSONString(records[i].getAsString("34")));
//                productoObject.put("35", new JSONString(records[i].getAsString("35")));
//                productoObject.put("36", new JSONString(records[i].getAsString("36")));
//                productoObject.put("37", new JSONString(records[i].getAsString("37")));
//                productoObject.put("38", new JSONString(records[i].getAsString("38")));
//                productoObject.put("39", new JSONString(records[i].getAsString("39")));
//                productoObject.put("40", new JSONString(records[i].getAsString("40")));
//                productoObject.put("41", new JSONString(records[i].getAsString("41")));
//                productoObject.put("42", new JSONString(records[i].getAsString("42")));
//                 productoObject.put("43", new JSONString(records[i].getAsString("43")));
//                productoObject.put("44", new JSONString(records[i].getAsString("44")));
//                productoObject.put("45", new JSONString(records[i].getAsString("45")));
//                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
//                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
//                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
//                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
            }

        if (opcion.equalsIgnoreCase("12")) {
      productoObject = new JSONObject();
       productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
   // productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("preciooficina", new JSONString(records[i].getAsString("preciooficina")));
                productos.set(i, productoObject);
                productoObject = null;
            }
 if (opcion.equalsIgnoreCase("13")) {
      productoObject = new JSONObject();
       productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));

                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("preciooficina", new JSONString(records[i].getAsString("preciooficina")));
                productos.set(i, productoObject);
                productoObject = null;
            }

                               }
      
        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "./php/IngresoAlmacen.php?funcion=txNewUpdateDatosDetalleIngresoInventario&" + datos;
  
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
                           kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);

   kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);

 // abrirpanelreporte();
reabrirpanel(e,idmarca,idesti,idkardex);
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
                        }
                    });
    }

 public void createPedidousuario(final String idmarca,final String idestilos,final String idkardex) {
        final String totalpares1 = tex_totalpares.getValueAsString();
        final String totalcaja1 = tex_totalcaja.getValueAsString();
        final String totalbs1 = tex_totalbs.getValueAsString();
        final String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
        final String idesti = idestilos;
        Record[] records = lista1.getStore().getModifiedRecords();
   JSONArray productos = new JSONArray();
        JSONObject productoObject;
        JSONObject compraObject = new JSONObject();
        compraObject.put("fecharegistro", new JSONString(fechaent));
        compraObject.put("totalpares", new JSONString(totalpares1));
        compraObject.put("totalbs", new JSONString(totalbs1));
        compraObject.put("totalcaja", new JSONString(totalcaja1));
        compraObject.put("idmarca", new JSONString(idmarca));
         compraObject.put("idkardex", new JSONString(idkardex));

        for (int i = 0; i < records.length; i++) {
   productoObject = new JSONObject();
       productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
             //   productoObject.put("preciooficina", new JSONString(records[i].getAsString("preciooficina")));
                productos.set(i, productoObject);
                productoObject = null;
         }

        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "./php/IngresoAlmacen.php?funcion=txNewUpdateDatosDetalleIngresoInventario&" + datos;

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
                           kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);
                       //   lista1.grid.reconfigure(store, columnModel);
       // lista1.grid.getView().refresh();
  // lista1.grid.getStore().reload();

   kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);

 // abrirpanelreporte();
reabrirpanel(e,idmarca,idesti,idkardex);
//reabrirpanel(e,idmarca,idesti,idkardex);
                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                        } else {
                            //Window.alert(mensajeR);
                            com.google.gwt.user.client.Window.alert("No se puede realizar la transaccion");
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
         // }
    //
  //   }
                        }
                 //   });
    }



  public void createPedidousuarioferia(final String idmarca,final String idestilos,final String idkardex) {
        final String totalpares1 = tex_totalpares.getValueAsString();
        final String totalcaja1 = tex_totalcaja.getValueAsString();
        final String totalbs1 = tex_totalbs.getValueAsString();
        final String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
        final String idesti = idestilos;
        Record[] records = lista1.getStore().getModifiedRecords();
   JSONArray productos = new JSONArray();
        JSONObject productoObject;
        JSONObject compraObject = new JSONObject();
        compraObject.put("fecharegistro", new JSONString(fechaent));
        compraObject.put("totalpares", new JSONString(totalpares1));
        compraObject.put("totalbs", new JSONString(totalbs1));
        compraObject.put("totalcaja", new JSONString(totalcaja1));
        compraObject.put("idmarca", new JSONString(idmarca));
         compraObject.put("idkardex", new JSONString(idkardex));

        for (int i = 0; i < records.length; i++) {
   productoObject = new JSONObject();
       productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
               //productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
             //   productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("preciooficina", new JSONString(records[i].getAsString("preciooficina")));
                productos.set(i, productoObject);
                productoObject = null;
         }

        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "./php/IngresoAlmacen.php?funcion=txNewUpdateDatosDetalleIngresoInventarioFeria&" + datos;

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
                           kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);
                       //   lista1.grid.reconfigure(store, columnModel);
       // lista1.grid.getView().refresh();
  // lista1.grid.getStore().reload();

 //  kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);

 // abrirpanelreporte();
reabrirpanel(e,idmarca,idesti,idkardex);
//reabrirpanel(e,idmarca,idesti,idkardex);
                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                        } else {
                            //Window.alert(mensajeR);
                            com.google.gwt.user.client.Window.alert("No se puede realizar la transaccion");
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
         // }
    //
  //   }
                        }
                 //   });
    }


 public void createPedidomodelo(final String idmarca,final String idestilos,final String idkardex) {
        final String totalpares1 = tex_totalpares.getValueAsString();
        final String totalcaja1 = tex_totalcaja.getValueAsString();
        final String totalbs1 = tex_totalbs.getValueAsString();
        final String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
        final String idesti = idestilos;
     //   Record[] records = lista1.getStore().getModifiedRecords();
         Record[] records = lista1.cbSelectionModel.getSelections();
   JSONArray productos = new JSONArray();
        JSONObject productoObject;
        JSONObject compraObject = new JSONObject();
        compraObject.put("fecharegistro", new JSONString(fechaent));
        compraObject.put("idmarca", new JSONString(idmarca));
//         compraObject.put("idkardex", new JSONString(idkardex));
        for (int i = 0; i < records.length; i++) {
        productoObject = new JSONObject();
        productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
                productos.set(i, productoObject);
                productoObject = null;
         }

        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "php/IngresoAlmacen.php?funcion=txNewEliminarModelo&" + datos;
// String url = "./php/IngresoAlmacen.php?funcion=txNewUpdateDatosDetalleIngresoInventario&" + datos;

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
                             String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
                           kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);
                       //   lista1.grid.reconfigure(store, columnModel);
       // lista1.grid.getView().refresh();
  // lista1.grid.getStore().reload();

   kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);

reabrirpanel(e,idmarca,idesti,idkardex);

                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                        } else {
                            //Window.alert(mensajeR);
                            com.google.gwt.user.client.Window.alert("No se puede realizar la transaccion");
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
    }

    public void createcambio(final String idmarca,final String idestilos,final String idkardex) {

 final String totalpares1 = tex_totalpares.getValueAsString();
        final String totalcaja1 = tex_totalcaja.getValueAsString();
        final String totalbs1 = tex_totalbs.getValueAsString();

    final String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
MessageBox.confirm("Guardar", "Confirma la modificacion de datos:  ? ,no olvide reimprimir  sus codigos de barra", new MessageBox.ConfirmCallback() {
                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("no")) {
// String enlTemp = "funcion=AdicionCodigoBarraIngresoHTML&idingreso=" + idventaG;
 //                           verReporte(enlTemp);
                           }else{

                               final String idesti = idestilos;
        Record[] records = lista1.getStore().getModifiedRecords();
   JSONArray productos = new JSONArray();
        JSONObject productoObject;
        JSONObject compraObject = new JSONObject();
        compraObject.put("fecharegistro", new JSONString(fechaent));
        compraObject.put("totalpares", new JSONString(totalpares1));
        compraObject.put("totalbs", new JSONString(totalbs1));
        compraObject.put("totalcaja", new JSONString(totalcaja1));
        compraObject.put("idmarca", new JSONString(idmarca));
         compraObject.put("idkardex", new JSONString(idkardex));

     //    compraObject.put("idalmacen", new JSONString(idestilos));
        //   String[] nombreCaso5Columns = {"idmodelo", "codigo", "material","color","cliente","vendedor", "fecha", "totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42",  "totalpares","totalparescaja",  "totalparesbs"};

        for (int i = 0; i < records.length; i++) {

 if (opcion.equalsIgnoreCase("2")) {
                productoObject = new JSONObject();
                 productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));

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
           productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
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
           productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
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
       productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
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
       productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
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
        productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
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
        productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
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
        productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
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
 productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
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

                               }

        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "./php/IngresoAlmacen.php?funcion=txNewUpdateDatosDetalleIngresoInventario&" + datos;

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
                           kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);

   kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);

 // abrirpanelreporte();
reabrirpanel(e,idmarca,idesti,idkardex);
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
                        }
                    });
    }
 //   boleta,numguia,responsable,idvendedor,idalmacen,fecha
 public void registrartraspaso(final String boleta,String numguia,final String resp,String idvendedor,String fecha,String tipo) {
  final Record[] records;

           records = lista1.cbSelectionModel.getSelections();
//String fechar= formulario_alm.dat_fecha1.getValueAsString();
 final String fechar = DateUtil.format(formulario_alm.dat_fecha1.getValue(), "Y-m-d");
        JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();
        compraObject.put("idmarca", new JSONString(idmarca));
    //    compraObject.put("marca", new JSONString(marca1));
        compraObject.put("tipoingreso", new JSONString(tipo));

         compraObject.put("boleta", new JSONString(boleta));
        compraObject.put("responsable", new JSONString(resp));
        compraObject.put("transporteguia", new JSONString(numguia));
          compraObject.put("idvendedor", new JSONString(idvendedor));
              compraObject.put("idalmacen", new JSONString(idalmacen));
       // compraObject.put("marca", new JSONString(marca));
           compraObject.put("fecha", new JSONString(fechar));

 Float top = new Float(0);
  Float top1 = new Float(0);
   Float top2 = new Float(0);

        for (int i = 0; i < records.length; i++) {
// if (opcion.equalsIgnoreCase("4")) {
                productoObject = new JSONObject();

               productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
               productos.set(i, productoObject);
               productoObject = null;
         }
        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "./php/Traspaso.php?funcion=GuardarNuevoTraspasoEnvio&" + datos;

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
                        formulario_alm.close();
            formulario_alm.destroy();
            kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);

            abrirpanelreporte();
                           Window.alert(mensajeR);
                        final String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
 // String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
  String enlTemp = "funcion=verboletatraspaso&idtraspaso=" + idventaG;
  verReporte(enlTemp);
 // kmenu.seleccionarOpcionRemove(null, "fun60071", e, PanelTraspasoCaja.this);
////                            kmenu.seleccionarOpcionRemove(null, "fun50161", e, PanelPedidoEE.this);
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
    //

    }
//
 // padre.registraredicionmodelo(idmodelo,modelo,material,color,fecha,item,clientem);
 public void registraredicionmodelo(String idmodelo,String modelo,String material,String color,String fecha,String item,String clienteitem) {
  final Record[] records;

           records = lista1.cbSelectionModel.getSelections();
//String fechar= formulario_alm.dat_fecha1.getValueAsString();
 //final String fechar = DateUtil.format(formulario_alm.dat_fecha1.getValue(), "Y-m-d");
        JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();
        compraObject.put("idmodelo", new JSONString(idmodelo));
        compraObject.put("modelo", new JSONString(modelo));
        compraObject.put("material", new JSONString(material));
        compraObject.put("color", new JSONString(color));
        compraObject.put("fechaingreso", new JSONString(fecha));
        compraObject.put("item", new JSONString(item));
        compraObject.put("clienteitem", new JSONString(clienteitem));
      

 Float top = new Float(0);
  Float top1 = new Float(0);
   Float top2 = new Float(0);

        for (int i = 0; i < records.length; i++) {
// if (opcion.equalsIgnoreCase("4")) {
                productoObject = new JSONObject();

               productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
               productos.set(i, productoObject);
               productoObject = null;
         }
        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
     //   String url = "./php/Traspaso.php?funcion=GuardarNuevoTraspasoEnvio&" + datos;
 String url = "./php/VentaMayor.php?funcion=GuardarEdicionModelo&" + datos;
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
                        formulario_alm1.close();
            formulario_alm1.destroy();
          lista1.grid.getStore().reload();
                           Window.alert(mensajeR);
                        final String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");

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
    //

    }



  public void registrarventa(String idvendedor,String idcliente,String fecha,String boletamanual) {
  final Record[] records;

           records = lista1.cbSelectionModel.getSelections();
//String fechar= formulario_alm.dat_fecha1.getValueAsString();
 final String fechar = DateUtil.format(formulario_almv.dat_fecha1.getValue(), "Y-m-d");
        JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();
        compraObject.put("idmarca", new JSONString(idmarca));
   
          compraObject.put("idvendedor", new JSONString(idvendedor));
              compraObject.put("idcliente", new JSONString(idcliente));
            compraObject.put("boletamanual", new JSONString(boletamanual));
           compraObject.put("fecha", new JSONString(fechar));

 Float top = new Float(0);
  Float top1 = new Float(0);
   Float top2 = new Float(0);
//                                            for (int i = 0; i < records.length; i++) {
//                                                top += records[i].getAsFloat("totalpares");
//                                            }
// // tex_totalpares2.setValue(top.toString());
// compraObject.put("totalpares", new JSONString(top.toString()));
        for (int i = 0; i < records.length; i++) {
// if (opcion.equalsIgnoreCase("4")) {
                productoObject = new JSONObject();

               productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
               productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
               productos.set(i, productoObject);
               productoObject = null;
         }
        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "./php/VentaMayor.php?funcion=GuardarNuevoVentaCompleta&" + datos;
//String url = "./php/Traspaso.php?funcion=GuardarNuevoTraspasoEnvio&" + datos;
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
                           // Utils.setErrorPrincipal(mensajeR, "mensaje");

                             String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");

Utils.setErrorPrincipal("Ver formato para precios", "error");
                     // if (formularioc == null || formularioc.isHidden()) {
                     //   String montoventa = tex_totalsus.getValueAsString().trim();
                              showListProducto(idventaG);

                        formulario_almv.close();
            formulario_almv.destroy();
            kmenu.seleccionarOpcionRemove(null, "fun5029", e, PanelInventario.this);

            //abrirpanelreporte();
                           Window.alert(mensajeR);
                       // final String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");

////                            kmenu.seleccionarOpcionRemove(null, "fun50161", e, PanelPedidoEE.this);
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
    //

    }
 private void showListProducto(String idventa) {
               String montoventa="0";
                        formulariocl = new FormularioKardexVentaCliente(PanelInventario.this,idventa,montoventa);
                            formulariocl.show();
              }
 public void reabrirpanel1(EventObject e,String marca,String estilo,String kardex) {

     //       String enlace = "php/IngresoAlmacen.php?funcion=CargarInventarioActual&idmarca=" + idmarca+"&idestilo="+idestilo;
//    String enlace = "php/IngresoAlmacen.php?funcion=CargarInventarioActual&idmarca=" + idmarca+"&idestilo="+idestilo+ "&idkardex="+idkardex;
//
//         String enlace = "php/IngresoAlmacen.php?funcion=CargarConfirmarIngreso&idmarca=" + idmarca+"&idestilo="+idestilo;
//
//   Utils.setErrorPrincipal("Cargando parametros", "cargar");
//                        final Conector conec = new Conector(enlace, false);
//                        {
//                            try {
//                                conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
//
//                                    private EventObject e;
//
//                                    public void onResponseReceived(Request request, Response response) {
//                                        String data = response.getText();
//                                        JSONValue jsonValue = JSONParser.parse(data);
//                                        JSONObject jsonObject;
//                                        if ((jsonObject = jsonValue.isObject()) != null) {
//                                            String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
//                                            String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
//                                            if (errorR.equalsIgnoreCase("true")) {
//                                                Utils.setErrorPrincipal(mensajeR, "mensaje");
//
//                                                JSONValue marcaV = jsonObject.get("resultado");
//                                                JSONObject marcaO;
//                                                if ((marcaO = marcaV.isObject()) != null) {
//                                                    String idp = Utils.getStringOfJSONObject(marcaO, "idpedido");
//                                                    String marca = Utils.getStringOfJSONObject(marcaO, "marca");
//                                                    String estilo = Utils.getStringOfJSONObject(marcaO, "estilo");
//                                                    String fecha = Utils.getStringOfJSONObject(marcaO, "fecha");
//   Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "colorM", new String[]{"idcolor", "codigo"});
//
//                                                                   String opcion = Utils.getStringOfJSONObject(marcaO, "opcionb");
//   String totalpares = Utils.getStringOfJSONObject(marcaO, "totalpares");
//   String totalbs = Utils.getStringOfJSONObject(marcaO, "totalbs");
// String opcionestilo = Utils.getStringOfJSONObject(marcaO, "tipoestilo");
//String mesrango = Utils.getStringOfJSONObject(marcaO, "mesrango");
//     PanelPedidoConfirmado pan_compraDirecta = new PanelPedidoConfirmado(Pedido.this, idpedido1,idmarca,fecha,observacion,totalcajas,totalpares,nombre,numeropedido);
// PanelInventario pan_compraDirecta = new PanelInventario(idkardex,mesrango,idmarca, marca, idestilo, estilo,opcionestilo,opcion, colores,totalpares,totalbs,SeleccionMarcaEstiloInventario.this,padre);
//
//     PanelPedidoConfirmado pan_compraDirecta = new PanelPedidoConfirmado(Pedido.this, idpedido1,idmarca,fecha,observacion,totalcajas,totalpares,nombre,numeropedido);
// PanelInventario pan_compraDirecta = new PanelInventario(idkardex,mesrango,idmarca, marca, idestilo, estilo,opcionestilo,opcion, colores,totalpares,totalbs,SM,kmenu);
//
//
//                                                    PanelPedidoConfirmado pan_compraDirecta = new PanelPedidoConfirmado(Pedido.this, idpedido1,idmarca,fecha,observacion,totalcajas,totalpares,nombre,numeropedido);
//  kmenu.seleccionarOpcion(null, "fun5029", e, pan_compraDirecta);
//
//                                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + opcion, "mensaje");
//                                                } else {
//                                                    MessageBox.alert("No Hay datos en la consulta");
//                                                }
//                                            }
//                                            else{
//                                            Utils.setErrorPrincipal(mensajeR, "mensaje");
//                                            }
//                                        } else {
//                                        }
//                                        throw new UnsupportedOperationException("Not supported yet.");
//                                    }
//
//                                    public void onError(Request request, Throwable exception) {
//                                        throw new UnsupportedOperationException("Not supported yet.");
//                                    }
//                                });
//
//                            } catch (RequestException ea) {
//                                ea.getMessage();
//                                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
//                            }
//
//                        }


    }

      private void reabrirpanel(EventObject e,final String idmarca,final String idalmacen,final String idkardex) {

   String enlace = "php/IngresoAlmacen.php?funcion=CargarInventarioActual&idmarca=" + idmarca+"&idalmacen="+idalmacen+ "&idkardex="+idkardex;
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
                                                    String marca = Utils.getStringOfJSONObject(marcaO, "marca");
   Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "clienteM", new String[]{"idcliente", "codigo"});
  Object[][] vendedorM = Utils.getArrayOfJSONObject(marcaO, "empleadoM", new String[]{"idempleado", "codigo"});

   String opcion = Utils.getStringOfJSONObject(marcaO, "opcionb");
                                                       String formatomayor = Utils.getStringOfJSONObject(marcaO, "formatomayor");
   String totalpares = Utils.getStringOfJSONObject(marcaO, "totalpares");
   String totalbs = Utils.getStringOfJSONObject(marcaO, "totalsus");
   String totalcajas = Utils.getStringOfJSONObject(marcaO, "totalcajas");
 String responsable = Utils.getStringOfJSONObject(marcaO, "responsable");
 String almacen = Utils.getStringOfJSONObject(marcaO, "almacen");

String mesrango = Utils.getStringOfJSONObject(marcaO, "mesrango");

PanelInventario pan_compraDirecta = new PanelInventario(idkardex,mesrango,idmarca, marca,opcion,formatomayor, colores,vendedorM,totalcajas,totalpares,totalbs,responsable, almacen,idalmacen,kmenu);
  kmenu.seleccionarOpcion(null, "fun5029", e, pan_compraDirecta);



                                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + opcion, "mensaje");
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
      
           private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
       private void verReporteTraspaso(String enlace) {
        ReporteTraspaso print = new ReporteTraspaso(enlace,PanelInventario.this);
        print.show();
    }

}

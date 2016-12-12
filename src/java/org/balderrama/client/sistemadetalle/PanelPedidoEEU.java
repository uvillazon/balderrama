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
import org.balderrama.client.emergentes.SeleccionMarcaUnion;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;

//import org.balderrama.client.util.Validacion;


public class PanelPedidoEEU extends Panel {

    private SeleccionMarcaUnion SM;
    //private Panel panel;
    private String COMPRA_DIRECTA_TABBED = "960000_venta-";
    private TextField tex_marca;
    private ComboBox com_modeloCV;
    private ComboBox com_modeloCVA;
    private ComboBox com_estilo;

   // private TextField tex_numeropedido;
    private TextField tex_modeloCP;
    private TextField tex_totalpares;
     private TextField tex_totalpares2;
    private TextField tex_totalbs;

    public TextField tex_totalcaja;
    private DateField dat_fecha;
   // private ListaPedidoCalzados lista;
    private ListaCalzadoPedidoTallaUnion lista1;
   public ListaCalzadoPedidoTallaUnion2 lista2;
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
    Object[][] modeloM;
    //Object[][] colorM;
    //Object[][] materialM;
 Object[][] estiloM;
    String opciona;
    String opcion;
     String opcionnueva;
   String opciontalla;
  String iddetalleingreso;
   private Store proveedorStore11;

    public PanelPedidoEEU(String idmarca, String nombremarca, String opcionbb, String opciontalla, Object[][] modelM,Object[][] vendedorM,SeleccionMarcaUnion SM,KMenu kmenu) {
         this.SM = SM;
        this.marca = nombremarca;
        this.idmarca = idmarca;
        this.opcion = opcionbb;
        //this.opciona = opcion;
        this.modeloM = modelM;
         this.estiloM = vendedorM;
         this.opciontalla= opciontalla;
         this.kmenu = kmenu;

        onModuleLoad();
         }

    public void onModuleLoad() {
        //panel = new Panel();
        setId("tab-" + COMPRA_DIRECTA_TABBED);
        setTitle("Items");
        setLayout(new FitLayout());
        setBaseCls("x-plain");
        this.setClosable(true);
        this.setId("TPfun50151");
        setIconCls("tab-icon");

        Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");
 Panel pan_centrofin = new Panel();
       //pan_centro.setTitle("Lista de Clientes");
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

if (opcion.equalsIgnoreCase("3")) {
                lista1 = new ListaCalzadoPedidoTallaUnion();
            lista1.onModuleLoad4();
            opcionnueva = "101";
          }
        if (opcion.equalsIgnoreCase("6")) {
            lista1 = new ListaCalzadoPedidoTallaUnion();
            lista1.onModuleLoad5();
            opcionnueva = "100";
          }
         if (opcion.equalsIgnoreCase("7")) {
              lista1 = new ListaCalzadoPedidoTallaUnion();
            lista1.onModuleLoad5();
    opcionnueva = "100";
           }

        if (opcion.equalsIgnoreCase("10")) {
         lista1 = new ListaCalzadoPedidoTallaUnion();
            lista1.onModuleLoad5();
            opcionnueva = "100";
             }
        //init
        if (opcion.equalsIgnoreCase("14")) {
            lista1 = new ListaCalzadoPedidoTallaUnion();
            lista1.onModuleLoad33();
            opcionnueva = "102";
         }
        if (opcion.equalsIgnoreCase("15")) {
            lista1 = new ListaCalzadoPedidoTallaUnion();
            lista1.onModuleLoad33();
            opcionnueva = "102";
            //lista1.onModuleLoad5(idmarca,codigo,coleccionM,estiloM,nombre);
          }
        if (opcion.equalsIgnoreCase("4")) {
            lista1 = new ListaCalzadoPedidoTallaUnion();
            lista1.onModuleLoad33();
            opcionnueva = "102";
          }
        if (opcion.equalsIgnoreCase("2")) {
              lista1 = new ListaCalzadoPedidoTallaUnion();
            lista1.onModuleLoad5();
            opcionnueva = "100";
            }
         if (opcion.equalsIgnoreCase("31")) {
          lista1 = new ListaCalzadoPedidoTallaUnion();
            lista1.onModuleLoad5();
            opcionnueva = "100";
            }


        Panel pan_centro = lista1.getPanel();

        FormPanel for_panel1 = new FormPanel();
        for_panel1.setBaseCls("x-plain");
        for_panel1.setWidth(330);
        for_panel1.setLabelWidth(100);
        tex_marca = new TextField("Marca", "marca", 200);
        tex_marca.setValue(marca);
        tex_marca.setReadOnly(true);
com_estilo = new ComboBox("Estilos", "idestilo");
com_estilo.focus();
        // tex_modeloCP = new TextField("Modelo CP", "idmodelo", 200);
        //tex_modeloCP.setValue("idmodelo");

        for_panel1.add(tex_marca);

  for_panel1.add(com_estilo);
        // for_panel1.add(tex_modeloCP);

        FormPanel for_panel2 = new FormPanel();
        for_panel2.setBaseCls("x-plain");
        for_panel2.setWidth(330);
        for_panel2.setLabelWidth(100);

        but_anadir = new Button("Anadir modelo nuevo");
        Panel pan_botonescliente = new Panel();
        pan_botonescliente.setLayout(new HorizontalLayout(2));
        pan_botonescliente.setBaseCls("x-plain");
 pan_botonescliente.add(but_anadir);


        com_modeloCV = new ComboBox("Buscar Modelos Anadir", "idmodelo",400);
        com_modeloCVA = new ComboBox("Modelo Unido", "idmodelo",400);

tex_modeloCP = new TextField("codigo Nuevo", "idmodelonuevo", 400);
 tex_modeloCP.setDisabled(false);
  
    for_panel2.add(com_modeloCV);
    for_panel2.add(com_modeloCVA);
 //for_panel2.add(tex_modeloCP);
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
        tex_totalpares = new TextField("Total Pares sin unir", "totalpares");
         tex_totalpares2 = new TextField("Total Pares unidos", "totalparesunidos");
        tex_totalbs = new TextField("Total Bs", "totalbs");

        tex_totalcaja = new TextField("Codigo", "totalcaja");

        for_panel4.add(tex_totalpares);
       
        for_panel4.add(tex_totalpares2);
 for_panel4.add(tex_totalbs);

        FormPanel for_panel6 = new FormPanel();
        for_panel6.setBaseCls("x-plain");
        tea_descripcion = new TextArea("Observacion", "observacion");
        tea_descripcion.setWidth("100%");

        for_panel6.add(tea_descripcion);

        Panel pan_botones = new Panel();
        pan_botones.setLayout(new HorizontalLayout(10));
        pan_botones.setBaseCls("x-plain");
        //       pan_botones.setHeight(40);
        but_aceptar = new Button("registrar union");
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

if (opcionnueva.equalsIgnoreCase("3")) {
                lista2 = new ListaCalzadoPedidoTallaUnion2();
            lista2.onModuleLoad4();
             opcionnueva = "101";
          }
        if (opcion.equalsIgnoreCase("6")) {
            lista2 = new ListaCalzadoPedidoTallaUnion2();
            lista2.onModuleLoad5();
            opcionnueva = "100";
          }
         if (opcion.equalsIgnoreCase("7")) {
            lista2 = new ListaCalzadoPedidoTallaUnion2();
   lista2.onModuleLoad5();
    opcionnueva = "100";
           }

        if (opcion.equalsIgnoreCase("10")) {
         lista2 = new ListaCalzadoPedidoTallaUnion2();
            lista2.onModuleLoad5();
            opcionnueva = "100";
             }
        //init
        if (opcion.equalsIgnoreCase("14")) {
            lista2 = new ListaCalzadoPedidoTallaUnion2();
       lista2.onModuleLoad33();
               opcionnueva = "102";
         }
        if (opcion.equalsIgnoreCase("15")) {
            lista2 = new ListaCalzadoPedidoTallaUnion2();
            lista2.onModuleLoad33();
               opcionnueva = "102";
            //lista1.onModuleLoad5(idmarca,codigo,coleccionM,estiloM,nombre);
          }
        if (opcion.equalsIgnoreCase("4")) {
            lista2 = new ListaCalzadoPedidoTallaUnion2();
           lista2.onModuleLoad33();
               opcionnueva = "102";
          }
        if (opcion.equalsIgnoreCase("2")) {
        lista2 = new ListaCalzadoPedidoTallaUnion2();
            lista2.onModuleLoad5();
            opcionnueva = "100";
            }
        if (opcion.equalsIgnoreCase("31")) {
          lista2 = new ListaCalzadoPedidoTallaUnion2();
            lista2.onModuleLoad5();
            opcionnueva = "100";
            }

  Panel pan_oeste = lista2.getPanel();
          pan_centrofin.add(pan_centro);
         pan_centrofin.add(pan_oeste);
        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centrofin, new BorderLayoutData(RegionPosition.CENTER));
        pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        add(pan_borderLayout);

       initCombos();
        //initValues();
        addListeners();

    }
     



    private void initCombos() {



         SimpleStore proveedorStore1 = new SimpleStore(new String[]{"idestilo", "nombre"}, estiloM);
        proveedorStore1.load();


        com_estilo.setMinChars(1);
        //com_modeloCV.setFieldLabel("Modelo");
        com_estilo.setStore(proveedorStore1);
        com_estilo.setValueField("idestilo");
        com_estilo.setDisplayField("nombre");
        com_estilo.setForceSelection(true);
        com_estilo.setMode(ComboBox.LOCAL);
        com_estilo.setEmptyText("Buscar Estilo");
        com_estilo.setLoadingText("buscando...");
        com_estilo.setTypeAhead(true);
        com_estilo.setSelectOnFocus(true);
        com_estilo.setWidth(130);
//String valor = com_modeloCV.setDisplayField("codigo");
        com_estilo.setHideTrigger(true);



         com_modeloCV.setMinChars(1);
           com_modeloCV.setFieldLabel("Modelo ");
            com_modeloCV.setEmptyText("Seleccione un modelo");
           com_modeloCV.setDisplayField("nombre");
           com_modeloCV.setValueField("idmodelo");
           com_modeloCV.setMode(ComboBox.LOCAL);
           com_modeloCV.setTriggerAction(ComboBox.ALL);
          com_modeloCV.setLinked(true);
           com_modeloCV.setForceSelection(true);
//           com_cliente.setReadOnly();
           com_modeloCV.setHideTrigger(true);
           com_modeloCV.setSelectOnFocus(true);
           com_modeloCV.setTypeAhead(true);


            com_modeloCVA.setMinChars(1);
           com_modeloCVA.setFieldLabel("Modelo a unir");
            com_modeloCVA.setEmptyText("Unido");
           com_modeloCVA.setDisplayField("nombre");
           com_modeloCVA.setValueField("idmodelo");
           com_modeloCVA.setMode(ComboBox.LOCAL);
           com_modeloCVA.setTriggerAction(ComboBox.ALL);
          com_modeloCVA.setLinked(true);
           com_modeloCVA.setForceSelection(true);
//           com_cliente.setReadOnly();
           com_modeloCVA.setHideTrigger(true);
           com_modeloCVA.setSelectOnFocus(true);
           com_modeloCVA.setTypeAhead(true);
        
    }

    private void initValues() {
        //com.google.gwt.user.client.Window.alert("//" + tipocambio);

        tex_totalpares.setValue("0");
         tex_totalpares2.setValue("0");
        tex_totalbs.setValue("0");

    }

    private void addListeners() {
              com_estilo.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                   String codigoCliente = field.getValueAsString().trim();
                    if (findByCodigoCliente(codigoCliente)) {
                        // com_estilo.focus();
                                }
                }else{
                  MessageBox.alert("Despues de seleccionar la el estilo haga enter, para cargar su lista de modelos correspondiente.");
                }
            }
         private boolean findByCodigoCliente(final String codigoBuscado) {
                respuesta = false;
                 String enlace = "php/IngresoAlmacen.php?funcion=Buscarmodelos&idempresa="+codigoBuscado;
          //      String enlace = "php/Planilla.php?funcion=buscarplanillaempresa&empresa=" + codigoBuscado;

                // Utils.setErrorPrincipal("Cargando parametros ", "cargar");
                final Conector conec = new Conector(enlace, false);

                try {
                    conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        private Object[][] estiloM1;
                     //   private String planilla;

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
                                                   // String idp = Utils.getStringOfJSONObject(marcaO, "idpedido");
                      Object[][] estiloM2 = Utils.getArrayOfJSONObject(marcaO, "modeloM", new String[]{"idmodelo", "nombre"});
this.estiloM1 = estiloM2;
                       SimpleStore proveedorStore1 = new SimpleStore(new String[]{"idmodelo", "nombre"}, estiloM1);
        proveedorStore1.load();
com_modeloCV.setStore(proveedorStore1);
com_modeloCV.focus();

               SimpleStore proveedorStore2 = new SimpleStore(new String[]{"idmodelo", "nombre"}, estiloM1);
        proveedorStore2.load();
com_modeloCVA.setStore(proveedorStore2);
//com_modeloCVA.focus();

respuesta = true;
                                    } else {
                                    //    resetCamposCliente();

                                        Utils.setErrorPrincipal("No se recuperaron correctamente lo valores", "error");
                                    }

                                } else {
                                  //  resetCamposCliente();

                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                          //  resetCamposCliente();

                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");

                        }
                    });

                } catch (RequestException ex) {
                    ex.getMessage();
             //       resetCamposCliente();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }

                return respuesta;
            }


        });
           com_modeloCV.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {

                 if (e.getKey() == EventObject.ENTER) {
                // String vendedor = com_modeloCV.getValueAsString();
                  String idproductos = com_modeloCV.getValueAsString().trim();
   if (idproductos != null)
   {

        findByCodigoProducto(idproductos);

                    } else {
     MessageBox.alert("Por favor seleccione un modelo ");
                }

                }
                  if (e.getKey() == EventObject.END) {
                 //   MessageBox.alert("ErrrrNo hay producto seleccionado para quitar y/o selecciono mas de uno.");
                }
            }
        });

           com_modeloCVA.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {

                 if (e.getKey() == EventObject.ENTER) {
                // String vendedor = com_modeloCV.getValueAsString();
                  String idproductos = com_modeloCVA.getValueAsString().trim();
   if (idproductos != null)
   {    //findByCodigoProducto2(idproductos);
          crearitems(idproductos);
                    } else {
     MessageBox.alert("Por favor seleccione un modelo unido ");
                }

                }

            }
        });
        //**************************************************
        //************* BOTON CANCELAR   *******************
        //**************************************************
       but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
 kmenu.seleccionarOpcionRemove(null, "fun50151", e, PanelPedidoEEU.this);
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
 but_anadir.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {

         String modelo = tex_modeloCP.getValueAsString();

                if ((!modelo.isEmpty())) {
                    crearitems(modelo);

                } else {
                    MessageBox.alert("Tiene que registrar el modelo nuevo");
                }
                //createCompra();
            }

        });
       tex_modeloCP.addListener(new TextFieldListenerAdapter() {

           private FormularioProductoKardex kardex;

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    String codigoProducto = field.getValueAsString().trim();
                    // String idProveedor = tex_almacenorigen.getValueAsString().trim();
                    String idproductos = tex_modeloCP.getValueAsString().trim();

                }
            }

   
           

        });




         tex_totalcaja.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {

                if (e.getKey() == EventObject.ENTER) {
                     String idestilo = tex_totalcaja.getValueAsString().trim();
                    //String idproductos = tex_producto.getValueAsString().trim();

//                         lista2.recargarlista2(idestilo);
                            tex_totalcaja.focus();

                   }
                    // Utils.setErrorPrincipal("Usted debe introducir un id modelo antes.", "error");
                }
            });

              lista2.getGrid().addEditorGridListener(new EditorGridListenerAdapter() {

            @Override
            public void onAfterEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
                calcularSubTotal(grid, record, field, newValue, oldValue, rowIndex, colIndex);
            }
        });


    }


//               public void GuardarItems(final String modelo) {
//              Record registroCompra = lista2.getRecordDef().createRecord(new Object[]{
//                      id, marca, modelo, 0, 0, 0});
//
//                                lista2.getGrid().stopEditing();
//                                lista2.getGrid().getStore().insert(0, registroCompra);
//                                lista2.getGrid().startEditing(0, 0);
//
//            }
      private boolean findByCodigoProducto(final String buscando) {
//                String enlace = "php/KardexTienda.php?funcion=buscarporcodigobarra&codigo=" + buscando+"&vendedor="+vendedor;
  String enlace = "php/IngresoAlmacen.php?funcion=buscarmodeloinsertar&modelo=" + buscando;

                //String enlace = "php/Pedido.php?funcion=BuscarModeloPorId&idmodelo=" + buscando;
             //   Utils.setErrorPrincipal("Cargando parametros del codigo", "cargar");
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
  if (opcionnueva.equalsIgnoreCase("100")) {
        String idmodelo = Utils.getStringOfJSONObject(marcaO, "iddetalleingreso");
          String coleccion = Utils.getStringOfJSONObject(marcaO, "coleccion");
                                            String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                            String color = Utils.getStringOfJSONObject(marcaO, "color");
                                            Number precio2 = Utils.getBigDecimalOfJSONObject(marcaO, "precio");
                                         String t1 = Utils.getStringOfJSONObject(marcaO, "33");
                                         String t1m = Utils.getStringOfJSONObject(marcaO, "34");
                                         String t2 = Utils.getStringOfJSONObject(marcaO, "35");
                                         String t2m = Utils.getStringOfJSONObject(marcaO, "36");
                                         String t3 = Utils.getStringOfJSONObject(marcaO, "37");
                                         String t3m = Utils.getStringOfJSONObject(marcaO, "38");
                                         String t4 = Utils.getStringOfJSONObject(marcaO, "39");
                                         String t4m = Utils.getStringOfJSONObject(marcaO, "40");
                                         String t5 = Utils.getStringOfJSONObject(marcaO, "41");
                                         String t5m = Utils.getStringOfJSONObject(marcaO, "42");
                                         String t6 = Utils.getStringOfJSONObject(marcaO, "43");
                                         String t6m = Utils.getStringOfJSONObject(marcaO, "44");
                                         String t7 = Utils.getStringOfJSONObject(marcaO, "45");
                                         String totalpares = Utils.getStringOfJSONObject(marcaO, "totalpares");

    Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
                                                        idmodelo, coleccion,codigo, color,precio2, t1, t1m, t2,t2m,t3,t3m,t4,t4m,t5,t5m,t6,t6m,t7,totalpares});
 lista1.getGrid().stopEditing();
                                            lista1.getGrid().getStore().insert(0, registroCompra);
                                            lista1.getGrid().startEditing(0, 0);
                                            Float to = new Float(0);
                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
                                                to += lista1.getStore().getRecords()[i].getAsFloat("precio");
                                            }
                                           Float top = new Float(0);
                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
                                                top += lista1.getStore().getRecords()[i].getAsFloat("totalpares");
                                            }
                                            //tex_montoTotal.setValue(to.toString());
                                            tex_totalpares.setValue(top.toString());
                                             tex_totalbs.setValue(to.toString());
                                           // prueba.setText(to.toString());

                                    }
  if (opcionnueva.equalsIgnoreCase("101")) {
                                         String idmodelo = Utils.getStringOfJSONObject(marcaO, "iddetalleingreso");
                                            String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                            String color = Utils.getStringOfJSONObject(marcaO, "color");
                                            Number precio2 = Utils.getBigDecimalOfJSONObject(marcaO, "precio");
                                         String t1 = Utils.getStringOfJSONObject(marcaO, "14");
                                         String t1m = Utils.getStringOfJSONObject(marcaO, "15");
                                         String t2 = Utils.getStringOfJSONObject(marcaO, "16");
                                         String t2m = Utils.getStringOfJSONObject(marcaO, "17");
                                         String t3 = Utils.getStringOfJSONObject(marcaO, "18");
                                         String t3m = Utils.getStringOfJSONObject(marcaO, "19");
                                         String t4 = Utils.getStringOfJSONObject(marcaO, "20");
                                         String t4m = Utils.getStringOfJSONObject(marcaO, "21");
                                         String t5 = Utils.getStringOfJSONObject(marcaO, "22");
                                         String t5m = Utils.getStringOfJSONObject(marcaO, "23");
                                         String t6 = Utils.getStringOfJSONObject(marcaO, "24");
                                         String t6m = Utils.getStringOfJSONObject(marcaO, "25");
                                         String t7 = Utils.getStringOfJSONObject(marcaO, "26");
                                         String t7m = Utils.getStringOfJSONObject(marcaO, "27");
                                         String t8 = Utils.getStringOfJSONObject(marcaO, "28");
                                         String t8m = Utils.getStringOfJSONObject(marcaO, "29");
                                         String t9 = Utils.getStringOfJSONObject(marcaO, "30");
                                         String t9m = Utils.getStringOfJSONObject(marcaO, "31");
                                         String t10 = Utils.getStringOfJSONObject(marcaO, "32");
                                         String t100 = Utils.getStringOfJSONObject(marcaO, "33");
                                         String t11 = Utils.getStringOfJSONObject(marcaO, "34");
                                         String t110 = Utils.getStringOfJSONObject(marcaO, "35");
                                         String t12 = Utils.getStringOfJSONObject(marcaO, "36");
                                         String t120 = Utils.getStringOfJSONObject(marcaO, "37");
                                         String t13 = Utils.getStringOfJSONObject(marcaO, "38");
                                         String totalpares = Utils.getStringOfJSONObject(marcaO, "totalpares");
          Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
                      idmodelo, codigo, color,precio2, t1, t1m, t2,t2m,t3,t3m,t4,t4m,t5,t5m,t6,t6m,t7,t7m,t8,t8m,t9,t9m,t10,t100,t11,t110,t12,t120,t13,totalpares});
 lista1.getGrid().stopEditing();
                                            lista1.getGrid().getStore().insert(0, registroCompra);
                                            lista1.getGrid().startEditing(0, 0);
                                            Float to = new Float(0);
                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
                                                to += lista1.getStore().getRecords()[i].getAsFloat("precio");
                                            }
                                           Float top = new Float(0);
                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
                                                top += lista1.getStore().getRecords()[i].getAsFloat("totalpares");
                                            }
                                            //tex_montoTotal.setValue(to.toString());
                                            tex_totalpares.setValue(top.toString());
                                             tex_totalbs.setValue(to.toString());
                                    }
   if (opcionnueva.equalsIgnoreCase("102")) {
                                            String idmodelo = Utils.getStringOfJSONObject(marcaO, "iddetalleingreso");
                                            String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                            String color = Utils.getStringOfJSONObject(marcaO, "color");
                                            Number precio2 = Utils.getBigDecimalOfJSONObject(marcaO, "precio");
                                         String t1 = Utils.getStringOfJSONObject(marcaO, "1");
                                         String t1m = Utils.getStringOfJSONObject(marcaO, "1m");
                                         String t2 = Utils.getStringOfJSONObject(marcaO, "2");
                                         String t2m = Utils.getStringOfJSONObject(marcaO, "2m");
                                         String t3 = Utils.getStringOfJSONObject(marcaO, "3");
                                         String t3m = Utils.getStringOfJSONObject(marcaO, "3m");
                                         String t4 = Utils.getStringOfJSONObject(marcaO, "4");
                                         String t4m = Utils.getStringOfJSONObject(marcaO, "4m");
                                         String t5 = Utils.getStringOfJSONObject(marcaO, "5");
                                         String t5m = Utils.getStringOfJSONObject(marcaO, "5m");
                                         String t6 = Utils.getStringOfJSONObject(marcaO, "6");
                                         String t6m = Utils.getStringOfJSONObject(marcaO, "6m");
                                         String t7 = Utils.getStringOfJSONObject(marcaO, "7");
                                         String t7m = Utils.getStringOfJSONObject(marcaO, "7m");
                                         String t8 = Utils.getStringOfJSONObject(marcaO, "8");
                                         String t8m = Utils.getStringOfJSONObject(marcaO, "8m");
                                         String t9 = Utils.getStringOfJSONObject(marcaO, "9");
                                         String t9m = Utils.getStringOfJSONObject(marcaO, "9m");
                                         String t10 = Utils.getStringOfJSONObject(marcaO, "10");
                                         String t100 = Utils.getStringOfJSONObject(marcaO, "10m");
                                         String t11 = Utils.getStringOfJSONObject(marcaO, "11");
                                         String t110 = Utils.getStringOfJSONObject(marcaO, "11m");
                                         String t12 = Utils.getStringOfJSONObject(marcaO, "12");
                                         String t120 = Utils.getStringOfJSONObject(marcaO, "12m");
                                         String t13 = Utils.getStringOfJSONObject(marcaO, "13");
                                         String t130 = Utils.getStringOfJSONObject(marcaO, "13m");
                                         String totalpares = Utils.getStringOfJSONObject(marcaO, "totalpares");

    Record registroCompra = lista1.getRecordDef().createRecord(new Object[]{
                                                        idmodelo, codigo, color,precio2, t1, t1m, t2,t2m,t3,t3m,t4,t4m,t5,t5m,t6,t6m,t7,t7m,t8,t8m,t9,t9m,t10,t100,t11,t110,t12,t120,t13,t130,totalpares});
 lista1.getGrid().stopEditing();
                                            lista1.getGrid().getStore().insert(0, registroCompra);
                                            lista1.getGrid().startEditing(0, 0);
                                            Float to = new Float(0);
                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
                                                to += lista1.getStore().getRecords()[i].getAsFloat("precio");
                                            }
                                           Float top = new Float(0);
                                            for (int i = 0; i < lista1.getStore().getRecords().length; i++) {
                                                top += lista1.getStore().getRecords()[i].getAsFloat("totalpares");
                                            }
                                            //tex_montoTotal.setValue(to.toString());
                                            tex_totalpares.setValue(top.toString());
                                           // prueba.setText(to.toString());

                                            tex_totalbs.setValue(to.toString());
   }
                                           
                                         

                                        } else {

                                            //MessageBox.alert("No Hay datos en la consulta");
                                        }

                                    }

                                    else{
                                       //  Utils.setErrorPrincipal(mensajeR, "mensaje");
                                    com_modeloCV.setValue("");
                                            com_modeloCV.focus();
                                        MessageBox.alert(mensajeR);

                                    }
                                } else {
                                  com_modeloCV.setValue("");
                                            com_modeloCV.focus();
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
                    // Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");

                    }
                    return respuesta;
                }

            }
//      private boolean  GuardarItems(final String modelo){
       public void crearitems(final String modelo) {
 //       final String idesti = idestilos;
     Record[] records = lista1.getStore().getRecords();
            //   Record[] records = lista1.ggetRecords();
   JSONArray productos = new JSONArray();
        JSONObject productoObject;
        JSONObject compraObject = new JSONObject();
        compraObject.put("modelonuevo", new JSONString(modelo));
         compraObject.put("idmarca", new JSONString(idmarca));
    
        for (int i = 0; i < records.length; i++) {
 //if (opcion.equalsIgnoreCase("6")) {
                                        productoObject = new JSONObject();

                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                              productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
   //                             }

        }
////
        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("creando modelo nuevo", "cargar");
//        String url = "./php/IngresoAlmacen.php?funcion=txNewUpdateDatosDetalleIngreso&" + datos;
  String url = "./php/IngresoAlmacen.php?funcion=unirparesdemodelos&" + datos;
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

                                        JSONValue marcaV = jsonObject.get("resultado");
                                        JSONObject marcaO;

                                        if ((marcaO = marcaV.isObject()) != null) {
                            if (opcionnueva.equalsIgnoreCase("100")) {
                                        String idmodelo = Utils.getStringOfJSONObject(marcaO, "iddetalleingreso");
                                        String coleccion = Utils.getStringOfJSONObject(marcaO, "coleccion");
                                            String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                            String color = Utils.getStringOfJSONObject(marcaO, "color");
                                            Number precio2 = Utils.getBigDecimalOfJSONObject(marcaO, "precio");
                                         String t1 = Utils.getStringOfJSONObject(marcaO, "33");
                                         String t1m = Utils.getStringOfJSONObject(marcaO, "34");
                                         String t2 = Utils.getStringOfJSONObject(marcaO, "35");
                                         String t2m = Utils.getStringOfJSONObject(marcaO, "36");
                                         String t3 = Utils.getStringOfJSONObject(marcaO, "37");
                                         String t3m = Utils.getStringOfJSONObject(marcaO, "38");
                                         String t4 = Utils.getStringOfJSONObject(marcaO, "39");
                                         String t4m = Utils.getStringOfJSONObject(marcaO, "40");
                                         String t5 = Utils.getStringOfJSONObject(marcaO, "41");
                                         String t5m = Utils.getStringOfJSONObject(marcaO, "42");
                                         String t6 = Utils.getStringOfJSONObject(marcaO, "43");
                                         String t6m = Utils.getStringOfJSONObject(marcaO, "44");
                                         String t7 = Utils.getStringOfJSONObject(marcaO, "45");
                                         String totalpares = Utils.getStringOfJSONObject(marcaO, "totalpares");
    Record registroCompra = lista2.getRecordDef().createRecord(new Object[]{
                                                        idmodelo, coleccion,codigo, color,precio2, t1, t1m, t2,t2m,t3,t3m,t4,t4m,t5,t5m,t6,t6m,t7,totalpares});


                                            lista2.getGrid().stopEditing();
                                            lista2.getGrid().getStore().insert(0, registroCompra);
                                            lista2.getGrid().startEditing(0, 0);

                                           Float top = new Float(0);
                                            for (int i = 0; i < lista2.getStore().getRecords().length; i++) {
                                                top += lista2.getStore().getRecords()[i].getAsFloat("totalpares");
                                            }
                                            //tex_montoTotal.setValue(to.toString());
                                            tex_totalpares2.setValue(top.toString());

                                            }
                            if (opcionnueva.equalsIgnoreCase("101")) {
                                            String idmodelo = Utils.getStringOfJSONObject(marcaO, "iddetalleingreso");
                                            String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                            String color = Utils.getStringOfJSONObject(marcaO, "color");
                                            Number precio2 = Utils.getBigDecimalOfJSONObject(marcaO, "precio");
                                         String t1 = Utils.getStringOfJSONObject(marcaO, "14");
                                         String t1m = Utils.getStringOfJSONObject(marcaO, "15");
                                         String t2 = Utils.getStringOfJSONObject(marcaO, "16");
                                         String t2m = Utils.getStringOfJSONObject(marcaO, "17");
                                         String t3 = Utils.getStringOfJSONObject(marcaO, "18");
                                         String t3m = Utils.getStringOfJSONObject(marcaO, "19");
                                         String t4 = Utils.getStringOfJSONObject(marcaO, "20");
                                         String t4m = Utils.getStringOfJSONObject(marcaO, "21");
                                         String t5 = Utils.getStringOfJSONObject(marcaO, "22");
                                         String t5m = Utils.getStringOfJSONObject(marcaO, "23");
                                         String t6 = Utils.getStringOfJSONObject(marcaO, "24");
                                         String t6m = Utils.getStringOfJSONObject(marcaO, "25");
                                         String t7 = Utils.getStringOfJSONObject(marcaO, "26");
                                         String t7m = Utils.getStringOfJSONObject(marcaO, "27");
                                         String t8 = Utils.getStringOfJSONObject(marcaO, "28");
                                         String t8m = Utils.getStringOfJSONObject(marcaO, "29");
                                         String t9 = Utils.getStringOfJSONObject(marcaO, "30");
                                         String t9m = Utils.getStringOfJSONObject(marcaO, "31");
                                         String t10 = Utils.getStringOfJSONObject(marcaO, "32");
                                         String t100 = Utils.getStringOfJSONObject(marcaO, "33");
                                         String t11 = Utils.getStringOfJSONObject(marcaO, "34");
                                         String t110 = Utils.getStringOfJSONObject(marcaO, "35");
                                         String t12 = Utils.getStringOfJSONObject(marcaO, "36");
                                         String t120 = Utils.getStringOfJSONObject(marcaO, "37");
                                         String t13 = Utils.getStringOfJSONObject(marcaO, "38");
                                         String totalpares = Utils.getStringOfJSONObject(marcaO, "totalpares");
    Record registroCompra = lista2.getRecordDef().createRecord(new Object[]{
                                                        idmodelo, codigo, color,precio2, t1, t1m, t2,t2m,t3,t3m,t4,t4m,t5,t5m,t6,t6m,t7,t7m,t8,t8m,t9,t9m,t10,t100,t11,t110,t12,t120,t13,totalpares});

                                            lista2.getGrid().stopEditing();
                                            lista2.getGrid().getStore().insert(0, registroCompra);
                                            lista2.getGrid().startEditing(0, 0);

                                           Float top = new Float(0);
                                            for (int i = 0; i < lista2.getStore().getRecords().length; i++) {
                                                top += lista2.getStore().getRecords()[i].getAsFloat("totalpares");
                                            }
                                            //tex_montoTotal.setValue(to.toString());
                                            tex_totalpares2.setValue(top.toString());
                }
if (opcionnueva.equalsIgnoreCase("102")) {
                                            String idmodelo = Utils.getStringOfJSONObject(marcaO, "iddetalleingreso");
                                            String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                            String color = Utils.getStringOfJSONObject(marcaO, "color");
                                            Number precio2 = Utils.getBigDecimalOfJSONObject(marcaO, "precio");
                                         String t1 = Utils.getStringOfJSONObject(marcaO, "1");
                                         String t1m = Utils.getStringOfJSONObject(marcaO, "1m");
                                         String t2 = Utils.getStringOfJSONObject(marcaO, "2");
                                         String t2m = Utils.getStringOfJSONObject(marcaO, "2m");
                                         String t3 = Utils.getStringOfJSONObject(marcaO, "3");
                                         String t3m = Utils.getStringOfJSONObject(marcaO, "3m");
                                         String t4 = Utils.getStringOfJSONObject(marcaO, "4");
                                         String t4m = Utils.getStringOfJSONObject(marcaO, "4m");
                                         String t5 = Utils.getStringOfJSONObject(marcaO, "5");
                                         String t5m = Utils.getStringOfJSONObject(marcaO, "5m");
                                         String t6 = Utils.getStringOfJSONObject(marcaO, "6");
                                         String t6m = Utils.getStringOfJSONObject(marcaO, "6m");
                                         String t7 = Utils.getStringOfJSONObject(marcaO, "7");
                                         String t7m = Utils.getStringOfJSONObject(marcaO, "7m");
                                         String t8 = Utils.getStringOfJSONObject(marcaO, "8");
                                         String t8m = Utils.getStringOfJSONObject(marcaO, "8m");
                                         String t9 = Utils.getStringOfJSONObject(marcaO, "9");
                                         String t9m = Utils.getStringOfJSONObject(marcaO, "9m");
                                         String t10 = Utils.getStringOfJSONObject(marcaO, "10");
                                         String t100 = Utils.getStringOfJSONObject(marcaO, "10m");
                                         String t11 = Utils.getStringOfJSONObject(marcaO, "11");
                                         String t110 = Utils.getStringOfJSONObject(marcaO, "11m");
                                         String t12 = Utils.getStringOfJSONObject(marcaO, "12");
                                         String t120 = Utils.getStringOfJSONObject(marcaO, "12m");
                                         String t13 = Utils.getStringOfJSONObject(marcaO, "13");
                                         String t130 = Utils.getStringOfJSONObject(marcaO, "13m");
                                         String totalpares = Utils.getStringOfJSONObject(marcaO, "totalpares");
    Record registroCompra = lista2.getRecordDef().createRecord(new Object[]{
                                                        idmodelo, codigo, color,precio2, t1, t1m, t2,t2m,t3,t3m,t4,t4m,t5,t5m,t6,t6m,t7,t7m,t8,t8m,t9,t9m,t10,t100,t11,t110,t12,t120,t13,t130,totalpares});

                                            lista2.getGrid().stopEditing();
                                            lista2.getGrid().getStore().insert(0, registroCompra);
                                            lista2.getGrid().startEditing(0, 0);

                                           Float top = new Float(0);
                                            for (int i = 0; i < lista2.getStore().getRecords().length; i++) {
                                                top += lista2.getStore().getRecords()[i].getAsFloat("totalpares");
                                            }
                                            //tex_montoTotal.setValue(to.toString());
                                            tex_totalpares2.setValue(top.toString());
                }

                                                    } else {

                                            //MessageBox.alert("No Hay datos en la consulta");
                                        }

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


  public void limpiarVentanaVenta() {
        lista1.LimpiarGrid();
        lista2.LimpiarGrid();
        tex_totalpares.setValue("0");
         tex_totalpares2.setValue("0");
        tex_totalcaja.setValue("");
        tea_descripcion.setValue("");
    //   com_estilo.setValue("");
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
//         if (record.getAsFloat("totalpares") != 0.0) {
//            record.set("totalbs", record.getAsFloat("totalpares") * record.getAsFloat("precio"));
//          }
         if (opcionnueva.equalsIgnoreCase("100")) {
            record.commit();
            record.set("totalpares", talla33 + talla34 + talla35 + talla36 + talla37 + talla38 + talla39 + talla40 + talla41+ talla42 + talla43 + talla44 + talla45 );
           record.set("totalbs", record.getAsFloat("totalpares") * record.getAsFloat("precio"));

            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
                totalca += grid.getStore().getRecords()[i].getAsFloat("totalcajas");
                totalpa += grid.getStore().getRecords()[i].getAsFloat("totalpares");
   totalpe += grid.getStore().getRecords()[i].getAsFloat("totalbs");

            }
        }
        if (opcionnueva.equalsIgnoreCase("101")) {
            record.commit();
            record.set("totalpares", talla14 + talla15 + talla16 + talla17 + talla18 + talla19 + talla20 + talla21 + talla22 + talla23 + talla24 + talla25 + talla26 + talla27 + talla28 + talla29 + talla30 + talla31 + talla32 + talla33 + talla34 + talla35 + talla36 + talla37 + talla38);
                record.set("totalbs", record.getAsFloat("totalpares") * record.getAsFloat("precio"));

            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
        //        totalca += grid.getStore().getRecords()[i].getAsFloat("totalcajas");
              //  totalpa += grid.getStore().getRecords()[i].getAsFloat("totalpares");
totalpe += grid.getStore().getRecords()[i].getAsFloat("totalbs");

            }
        }
         
      if (opcionnueva.equalsIgnoreCase("102")) {
           record.commit();
            record.set("totalpares",talla1 + talla1m +talla2 + talla2m +talla3 +talla3m + talla4 +talla4m +talla5 +talla5m + talla6 +talla6m + talla7 + talla7m + talla8 + talla8m + talla9 + talla9m + talla10+ talla10m + talla11 + talla11m + talla12+ talla12m + talla13+ talla13m);
               record.set("totalbs", record.getAsFloat("totalpares") * record.getAsFloat("precio"));

            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
                totalca += grid.getStore().getRecords()[i].getAsFloat("totalcajas");
                totalpa += grid.getStore().getRecords()[i].getAsFloat("totalpares");
           totalpe += grid.getStore().getRecords()[i].getAsFloat("precio");

            }
 }
                 

       // tex_totalpares.setValue(totalpa.toString());
        tex_totalbs.setValue(totalpe.toString());
        //tex_totalpares.
      //  tex_totalcaja.setValue(totalca.toString());

    }

    public void createPedido(String idmarca) {
String idestilo = com_estilo.getValueAsString();
        String totalpares = tex_totalpares.getValueAsString();
        String totalpares2 = tex_totalpares2.getValueAsString();
        String descripcion = tea_descripcion.getValueAsString();
//        Date date = dat_fecha.getValue();

Record[] recordss = lista1.getStore().getRecords();
   JSONArray productoss = new JSONArray();
        JSONObject productoObjects;

        Record[] records = lista2.getStore().getRecords();
   JSONArray productos = new JSONArray();
        JSONObject productoObject;
  
        JSONObject compraObject = new JSONObject();
        compraObject.put("idmarca", new JSONString(idmarca));
     //   compraObject.put("marca", new JSONString(marca1));
       compraObject.put("idestilo", new JSONString(idestilo));

        //compraObject.put("numeropedido", new JSONString(numeropedido1));
        compraObject.put("totalpares", new JSONString(totalpares));
        compraObject.put("totalpares2", new JSONString(totalpares2));
        compraObject.put("descripcion", new JSONString(descripcion));
//        compraObject.put("fecha", new JSON(date));

  for (int i = 0; i < records.length; i++) {
                                    if (opcionnueva.equalsIgnoreCase("100")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                       productoObject.put("coleccion", new JSONString(records[i].getAsString("coleccion")));
                                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                                        productoObject.put("color", new JSONString(records[i].getAsString("color")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
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
                                         productos.set(i, productoObject);
                                        productoObject = null;
                                    }

                                     if (opcionnueva.equalsIgnoreCase("101")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                       productoObject.put("coleccion", new JSONString(records[i].getAsString("coleccion")));
                                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                                        productoObject.put("color", new JSONString(records[i].getAsString("color")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                                    //    productoObject.put("33", new JSONString(records[i].getAsString("33")));
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
                                         productos.set(i, productoObject);
                                        productoObject = null;
                                    }
                                    
                                   if (opcionnueva.equalsIgnoreCase("102")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                                        productoObject.put("color", new JSONString(records[i].getAsString("color")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                                       //    productoObject.put("33", new JSONString(records[i].getAsString("33")));
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
                                        productoObject.put("12m", new JSONString(records[i].getAsString("12m")));
                                        productoObject.put("13", new JSONString(records[i].getAsString("13")));
                                        productoObject.put("13m", new JSONString(records[i].getAsString("13m")));
                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                         productos.set(i, productoObject);
                                        productoObject = null;
                                    }


                                }
 for (int i = 0; i < recordss.length; i++) {
                                    //if (opcion.equalsIgnoreCase("6")) {
                                        productoObjects = new JSONObject();
                                        productoObjects.put("iddetalleingreso", new JSONString(recordss[i].getAsString("iddetalleingreso")));
                                       productoObjects.put("codigo", new JSONString(recordss[i].getAsString("codigo")));

                                        productoObjects.put("totalpares", new JSONString(recordss[i].getAsString("totalpares")));
                                         productoss.set(i, productoObjects);
                                        productoObjects = null;
                                    //}

                                }
       
        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        resultado.put("calzadoseliminar", productoss);
        String datos = "resultado=" + resultado.toString();
 //MessageBox.alert("guardar"+datos);

        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "./php/IngresoAlmacen.php?funcion=GuardarNuevoIngresoUnido&" + datos;

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
                      //  Window.alert(mensajeR);
                           Window.alert(mensajeR);
                //        String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
 String enlTemp = "funcion=AdicionCodigoBarraIngresoDetalleHTML&idimpresion=" + idventaG;
                    verReporte(enlTemp);
 kmenu.seleccionarOpcionRemove(null, "fun50151", e, PanelPedidoEEU.this);

                        } else {
                            //Window.alert(mensajeR);
//                            com.google.gwt.user.client.Window.alert("error 1000");
                            Utils.setErrorPrincipal(mensajeR, "error");
                                      Window.alert(mensajeR);

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
        }//



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

package org.balderrama.client.traspaso;
import org.balderrama.client.venta.*;
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
import org.balderrama.client.cliente.EditarNuevoCliente;
public class PanelTraspasoDetalle extends Panel {

    private SeleccionMarcaTraspaso SM;
    //private Panel panel;
    private String COMPRA_DIRECTA_TABBED = "9710000_venta-";
  private TextField tex_marca;
    private TextField tex_encargado;
    private TextField tex_boleta;
    private TextField tex_tipocambio;
   // private TextField tex_modeloCP;
    private TextField tex_totalpares;
     private TextField tex_totalbs;
      private TextField tex_totalsus;
    private TextField tex_totalcaja;
    private DateField dat_fecha;
    public ListaProductosVenta lista2;
    boolean respuesta = false;
    private TextArea tea_descripcion;
    private Button but_aceptar;
    private Button but_cancelar;
    private Button but_limpiar;
    private Button but_verproducto;
    //private Button but_anadir;
   // private Button but_vender;
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
   private Store proveedorStore13;
    Object[][] clienteM;
    //Object[][] estiloM;
    Object[][] almacenM;
    Object[][] vendedorM;
  private String[] tipoM;
    String vendedor;
    String encargado;
    String fmayor;
   //public ComboBox com_cliente;
     private ComboBox com_vendedor;
       public ComboBox com_empresa;
      private ComboBox com_responsables;
 public TextField tex_codigoBarra;
  private EditarNuevoCliente formulario;
    private ventasimple formularioventa;
    PanelTraspasoDetalle(String tipomarca, String idmarca, String marca, String boleta, String vendedor, Object[][] almacenes,Object[][] vendedores, String tipocambio, String almacen, SeleccionMarcaTraspaso SM, KMenu padre) {
      //    this.tipoM = new String[]{"M","W","GS"};
        this.SM = SM;
        this.fmayor = tipomarca;
        this.kmenu = padre;
        this.marca = marca;
        this.idmarca = idmarca;
        this.numeropedido = boleta;
        this.vendedor = vendedor;
        this.almacenM = almacenes;
         this.vendedorM = vendedores;
          this.clienteM = vendedores;
       // this.clienteM = clientes;
         this.opcion = tipocambio;
        this.encargado = almacen;
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

        setId("tab-" + COMPRA_DIRECTA_TABBED);

        setTitle(marca);

        Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");
 Panel pan_centro = new Panel();
       pan_centro.setLayout(new FormLayout());
        pan_centro.setWidth(1300);
        pan_centro.setHeight(600);

        Panel pan_norte = new Panel();
        pan_norte.setLayout(new TableLayout(4));
        pan_norte.setBaseCls("x-plain");
        pan_norte.setHeight(140);
        pan_norte.setPaddings(5);

        Panel pan_sud = new Panel();
        pan_sud.setLayout(new TableLayout(3));
        pan_sud.setBaseCls("x-plain");
        pan_sud.setHeight(120);
        pan_sud.setPaddings(5);

        FormPanel for_panel1 = new FormPanel();
        for_panel1.setBaseCls("x-plain");
        for_panel1.setWidth(330);
        for_panel1.setLabelWidth(100);
       lista2 = new ListaProductosVenta();
       lista2.onModuleLoad();
      pan_centro = lista2.getPanel();


    tex_marca = new TextField("Marca", "marca", 200);
tex_marca.setValue(marca);
        tex_marca.setReadOnly(true);

        tex_boleta = new TextField("#Boleta", "boleta", 200);

        tex_codigoBarra = new TextField("CODIGO", "codigobarra",200);
       tex_codigoBarra.setDisabled(true);
         tex_codigoBarra.setCls("grande");
        tex_codigoBarra.setHeight(30);

 com_empresa = new ComboBox("Almacen", "idempleado");
 com_responsables = new ComboBox("VEndedor", "idalmacen");
  com_vendedor = new ComboBox("Vendedor", "idempleado");
tex_tipocambio = new TextField("Tipo Cambio", "tipocambio", 100);
        //tex_numeropedido.setReadOnly(true);
         for_panel1.add(com_vendedor);
        for_panel1.add(tex_codigoBarra);
         for_panel1.add(tex_boleta);
        FormPanel for_panel2 = new FormPanel();
        for_panel2.setBaseCls("x-plain");
        for_panel2.setWidth(400);
        for_panel2.setLabelWidth(110);

      //  but_anadir = new Button("Nuevo Cliente");
//        but_vender = new Button("TRASPASAR");

        Panel pan_botonescliente = new Panel();
        pan_botonescliente.setLayout(new HorizontalLayout(2));
        pan_botonescliente.setBaseCls("x-plain");

        for_panel2.add(com_empresa);
        for_panel2.add(com_responsables);
      //for_panel2.add(tex_modeloCP);

 for_panel2.add(new PaddedPanel(pan_botonescliente, 5, 5, 5, 5), new TableLayoutData(3));

        FormPanel for_panel3 = new FormPanel();
        for_panel3.setBaseCls("x-plain");
        for_panel3.setWidth(300);
        for_panel3.setLabelWidth(100);

         dat_fecha = new DateField("Fecha", "d-m-Y");
        Date date = new Date();
        dat_fecha.setValue(Utils.getStringOfDate(date));

        for_panel3.add(dat_fecha);
        for_panel3.add(tex_tipocambio);
        pan_norte.add(new PaddedPanel(for_panel1, 10));
        pan_norte.add(new PaddedPanel(for_panel2, 10));
        pan_norte.add(new PaddedPanel(for_panel3, 10));

        FormPanel for_panel4 = new FormPanel();
        for_panel4.setBaseCls("x-plain");
        tex_totalpares = new TextField("Total Pares", "totalpares");
        tex_totalbs = new TextField("En Bs", "totalbs");
        tex_totalsus = new TextField("Total Sus", "totalsus");
        tex_totalcaja = new TextField("Total Caja", "totalcaja");

        for_panel4.add(tex_totalcaja);
        for_panel4.add(tex_totalpares);
        for_panel4.add(tex_totalbs);
        for_panel4.add(tex_totalsus);




        FormPanel for_panel6 = new FormPanel();
        for_panel6.setBaseCls("x-plain");
        tea_descripcion = new TextArea("Observacion", "observacion");
        tea_descripcion.setWidth("100%");

        for_panel6.add(tea_descripcion);

        Panel pan_botones = new Panel();
        pan_botones.setLayout(new HorizontalLayout(10));
        pan_botones.setBaseCls("x-plain");
        //       pan_botones.setHeight(40);
        but_aceptar = new Button("Generar Boleta");
        but_cancelar = new Button("Cancelar");
        but_limpiar = new Button("Limpiar");
        but_verproducto = new Button("Quitar");
        pan_botones.add(but_aceptar);
        pan_botones.add(but_cancelar);
        pan_botones.add(but_limpiar);
        pan_botones.add(but_verproducto);

        pan_sud.add(new PaddedPanel(for_panel4, 0, 0, 13, 10));
        //pan_sud.add(new PaddedPanel(for_panel5, 0, 0, 13, 10));
        pan_sud.add(new PaddedPanel(for_panel6, 3, 0, 13, 10));
        pan_sud.add(new PaddedPanel(pan_botones, 10, 200, 10, 10), new TableLayoutData(3));

            //nike

        //  pan_centrofin.add(pan_centro);
     //    pan_centrofin.add(pan_oeste);
        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centro, new BorderLayoutData(RegionPosition.CENTER));
        pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        add(pan_borderLayout);
findByCodigoCliente2();
       initCombos();
        initValues();
        addListeners();

 }
     private boolean findByCodigoCliente2() {
                respuesta = false;
                 String enlace = "php/VentaMayor.php?funcion=BuscarRedondeo&idmarca=" + idmarca;
    final Conector conec = new Conector(enlace, false);

                try {
                    conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        private String idempresa;
                        private String planilla;

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {
                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
                                    JSONValue clienteValue = jsonObject.get("resultado");
                                    JSONObject clienteObject;
                                    if ((clienteObject = clienteValue.isObject()) != null) {

                                        idempresa = Utils.getStringOfJSONObject(clienteObject, "idempresa");
                                   //     planilla = Utils.getStringOfJSONObject(clienteObject, "planilla");
                                  //    tex_saldo.setValue(clienteSeleccionado.getSaldo());
                                         tex_codigoBarra.setValue("");
                                          tex_codigoBarra.focus();
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

 private void initCombos() {

 com_responsables.setMinChars(1);
        com_responsables.setFieldLabel("Vendedor,escriba la primera inicial del nombre");

       com_responsables.setDisplayField("nombre");
        com_responsables.setValueField("idempleado");

        SimpleStore empresasStore = new SimpleStore(new String[]{"idalmacen", "codigo"}, almacenM);
        empresasStore.load();
        com_empresa.setMinChars(1);
        com_empresa.setFieldLabel("Almacen a quien enviamos");
        com_empresa.setStore(empresasStore);
        com_empresa.setDisplayField("codigo");
        com_empresa.setValueField("idalmacen");
        com_empresa.setMode(ComboBox.LOCAL);
        com_empresa.setEmptyText("Buscar Almacen");
        com_empresa.setLoadingText("buscando...");
        com_empresa.setTypeAhead(true);
        com_empresa.setHideTrigger(true);

SimpleStore proveedorStore12 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        proveedorStore12.load();
        com_vendedor.setMinChars(1);
        com_vendedor.setStore(proveedorStore12);
        com_vendedor.setValueField("idempleado");
        com_vendedor.setDisplayField("codigo");
          com_vendedor.setFieldLabel("Vendedor que Envia");
        com_vendedor.setForceSelection(true);
        com_vendedor.setMode(ComboBox.LOCAL);
        com_vendedor.setEmptyText("Buscar vendedor");
        com_vendedor.setLoadingText("buscando...");
        com_vendedor.setTypeAhead(true);
        com_vendedor.setSelectOnFocus(true);
        com_vendedor.setWidth(200);
        com_vendedor.setHideTrigger(true);

    }
private void initValues() {
        //com.google.gwt.user.client.Window.alert("//" + tipocambio);
        tex_boleta.setValue(numeropedido);
        tex_tipocambio.setValue(opcion);
        tex_totalbs.setValue("0");
        tex_totalsus.setValue("0");
        tex_totalpares.setValue("0");
        tex_totalcaja.setValue("0");

    }
  private void addListeners() {

       but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
kmenu.seleccionarOpcionRemove(null, "fun6010", e, PanelTraspasoDetalle.this);

              //  closeTabCompraDirecta();
            }
        });

        //**************************************************
        //************* BOTON ACEPTAR *******************
        //**************************************************
        but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {

                   String almacen = com_empresa.getValueAsString();

                     String vendedor = com_responsables.getValueAsString();
//                    String cliente = com_cliente.getValueAsString();
                     String boleta = tex_boleta.getValueAsString();
//String string = "004-034556";
String[] parts = almacen.split("/");
String ciudadvendedor = parts[1]; // 034556
String[] parts1 = vendedor.split("/");
String ciudadalmacen = parts1[1]; // 034556

    if ((!boleta.isEmpty()) &&  (!vendedor.isEmpty())&&  (!almacen.isEmpty())) {
   MessageBox.confirm("Registrar TRaspaso", "Esta seguro del traspaso?. el vendedor al que envia debe ser de la misma ciudad/almacen al que envia", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                //eliminar
                             createventa(idmarca);
                            }else{
                            }
                        }
                    });
       

    } else {
             MessageBox.alert("Asigne Almacen ,Vendedor y boleta .es obligatorio,revise los campos ");
                }
              }
        });



        but_limpiar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                limpiarVentanaVenta();
            }
        });
 but_verproducto.addListener(new ButtonListenerAdapter() {
 private boolean procederAEliminar;
            int repeat = 0;

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = lista2.getSelectionModel().getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idkardexunico");
                    lista2.getGrid().stopEditing();
                    lista2.getStore().remove(lista2.getSelectionModel().getSelected());
                    lista2.getGrid().startEditing(0, 0);
                    Float to = new Float(0);
                    Float cantt = new Float(0);
                    for (int i = 0; i < lista2.getStore().getRecords().length; i++) {
                        to += lista2.getStore().getRecords()[i].getAsFloat("preciou");
                        cantt += lista2.getStore().getRecords()[i].getAsInteger("cantidad");
                    }
                    tex_totalpares.setValue(cantt.toString());
                                           tex_totalsus.setValue(to.toString());
                                            Float caja = new Float(0);
                                          //  double docena=12.00;
                                            caja =cantt/12;
                                          tex_totalcaja.setValue(caja.toString());


                                          Float enbs = new Float(0);
                                          Float tipocam = new Float(0);
                                          enbs = new Float(tex_tipocambio.getText());
                                          tipocam = (to * enbs);
                                          tex_totalbs.setValue(tipocam.toString());
                                          tex_codigoBarra.setValue("");
                                          tex_codigoBarra.focus();

                } else {
                    MessageBox.alert("No hay producto selecionado para quitar y/o selecciono mas de uno.");
                }
                but_verproducto.setPressed(false);
            }
        });
        tex_boleta.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                     com_empresa.focus();
                     }
            }
        });

   com_empresa.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    com_responsables.focus();
                    String idalmacen = com_empresa.getValueAsString().trim();
                    if (!idalmacen.isEmpty()) {
  //   String enlace = "php/VentaCredito.php?funcion=BuscarClientesporid&idempresa="+idempresa;
      String enlace = "php/Traspaso.php?funcion=Listarempleadosmarca&idalmacen="+idalmacen+ "&idmarca="+idmarca;
 
     final Conector conec = new Conector(enlace, false);
            try {
                conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
                private Object[][] clienteM1;
                    public void onResponseReceived(Request request, Response response) {
                        String data = response.getText();
                        JSONValue jsonValue = JSONParser.parse(data);
                        JSONObject jsonObject;
                        if ((jsonObject = jsonValue.isObject()) != null) {
                            String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                            String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                            if (errorR.equalsIgnoreCase("true")) {
                                Utils.setErrorPrincipal(mensajeR, "mensaje");
                                JSONValue userV = jsonObject.get("resultado");
                                JSONObject userO;
                                if ((userO = userV.isObject()) != null) {
           clienteM1 = Utils.getArrayOfJSONObject(userO, "empleadoM", new String[]{"idempleado", "nombre","idalmacen"});
           SimpleStore proveedorStore11 = new SimpleStore(new String[]{"idempleado", "nombre","idalmacen"}, clienteM1);
          proveedorStore11.load();
          com_responsables.setStore(proveedorStore11);
        com_responsables.setMinChars(1);
        com_responsables.setForceSelection(true);
        com_responsables.setMode(ComboBox.LOCAL);
        com_responsables.setSelectOnFocus(true);
        com_responsables.setWidth(300);
                                } else {
                                    Utils.setErrorPrincipal("No se recuperaron correctamente lo valores ", "error");
                                }
                            } else {

                                       com.google.gwt.user.client.Window.alert(mensajeR +"La empresa no tiene clientes asignados");
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

                    }
                }
            }
        });
        com_responsables.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    tex_codigoBarra.focus();
                }
            }
        });


        tex_codigoBarra.addListener(new TextFieldListenerAdapter() {

            private FormularioProductoKardex kardex;

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    String codigoProducto = field.getValueAsString().trim();
                    String idproductos = tex_codigoBarra.getValueAsString().trim();
             if (idproductos != null)
   {              findByCodigoProducto(idproductos);
                    } else {
     MessageBox.alert("Por favor seleccione un codigo de barra valido ");
                }


                }

            }


            public boolean findByCodigoProducto(final String buscando) {

        //        String enlace = "php/VentaMayor.php?funcion=buscarcodigo&codigo=" + buscando+ "&idmarca="+idmarca;
  String vendedor= com_vendedor.getValueAsString().trim();
                String enlace = "php/VentaMayor.php?funcion=buscarcodigotraspaso&codigo=" + buscando+ "&idmarca="+idmarca+ "&vendedor="+vendedor;
// String enlace = "php/VentaMayor.php?funcion=buscarcodigotraspaso&codigo=" + buscando+ "&idmarca="+idmarca;

                Utils.setErrorPrincipal("Cargando parametros del codigo", "cargar");
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
         // String[] nombreComlumns = {"idkardexunico", "idmodelo", "modelo","detalle","talla", "item","cantidad", "preciou","preciocaja"};
//                                           String idkardex = Utils.getStringOfJSONObject(marcaO, "idkardexunico");
//                                            String idmodelo = Utils.getStringOfJSONObject(marcaO, "idmodelo");
//                                            String codigo = Utils.getStringOfJSONObject(marcaO, "modelo");
//                                            String detalle = Utils.getStringOfJSONObject(marcaO, "detalle");
//                                            String talla = Utils.getStringOfJSONObject(marcaO, "talla");
//                                            String item = Utils.getStringOfJSONObject(marcaO, "item");
//                                             String cantidad = Utils.getStringOfJSONObject(marcaO, "cantidad");
//                                              String preciou = Utils.getStringOfJSONObject(marcaO, "preciou");
//                                               String preciocaja = Utils.getStringOfJSONObject(marcaO, "preciocaja");
//                                              String vendedor = Utils.getStringOfJSONObject(marcaO, "vendedor");
 String idkardex = Utils.getStringOfJSONObject(marcaO, "idkardexunico");
                                            String idmodelo = Utils.getStringOfJSONObject(marcaO, "idmodelo");
                                            String codigo = Utils.getStringOfJSONObject(marcaO, "modelo");
                                            String detalle = Utils.getStringOfJSONObject(marcaO, "detalle");
                                            //String talla = Utils.getStringOfJSONObject(marcaO, "talla");
                                            //String item = Utils.getStringOfJSONObject(marcaO, "item");
                                             String cantidad = Utils.getStringOfJSONObject(marcaO, "cantidad");
                                              String preciou = Utils.getStringOfJSONObject(marcaO, "preciou");
                                               //Number cantidad = 1.0;  String detalle = Utils.getBigDecimalOfJSONObject(marcaO, "detalle");

                       //     Record registroCompra = lista2.getRecordDef().createRecord(new Object[]{
                        //                  idkardex,idmodelo, codigo, detalle,talla, item,cantidad, preciou,preciocaja,vendedor});

  Record registroCompra = lista2.getRecordDef().createRecord(new Object[]{
                                          idkardex,idmodelo, codigo, detalle,cantidad, preciou});



                                            lista2.getGrid().stopEditing();
                                            lista2.getGrid().getStore().insert(0, registroCompra);
                                            lista2.getGrid().startEditing(0, 0);
                                            Float to = new Float(0);
                                            for (int i = 0; i < lista2.getStore().getRecords().length; i++) {
                                                to += lista2.getStore().getRecords()[i].getAsFloat("preciou");
                                            }
                                           Float top = new Float(0);
                                            for (int i = 0; i < lista2.getStore().getRecords().length; i++) {
                                                top += lista2.getStore().getRecords()[i].getAsFloat("cantidad");
                                            }
                                          //   tex_montoPagar.setValue(to.toString());

                                        //    tex_montocancelado.setValue(to.toString());
                                         tex_totalpares.setValue(top.toString());
                                           tex_totalsus.setValue(to.toString());
                                            Float caja = new Float(0);
                                          //  double docena=12.00;
                                            caja =top/12;
                                           tex_totalcaja.setValue(caja.toString());
                                             Float enbs = new Float(0);
                                          Float tipocam = new Float(0);
                                          enbs = new Float(tex_tipocambio.getText());
                                          tipocam = (to * enbs);
                                          tex_totalbs.setValue(tipocam.toString());
                                          tex_codigoBarra.setValue("");
                                            tex_codigoBarra.focus();
                                      //    totalTotalV1073 = new Float(tex_montoPagar.getText());
                                    //   montocancelado = new Float(tex_montocancelado.getText());

                                        } else {
 MessageBox.alert("Por favor seleccione un codigo de barra valido ");
                                            //MessageBox.alert("No Hay datos en la consulta");
                                        }

                                    }

                                    else{
                                       //  Utils.setErrorPrincipal(mensajeR, "mensaje");
                                    tex_codigoBarra.setValue("");
                                            tex_codigoBarra.focus();
                                        MessageBox.alert(mensajeR);

                                    }
                                } else {
                                    tex_codigoBarra.setValue("");
                                            tex_codigoBarra.focus();
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

        });


com_vendedor.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                          tex_codigoBarra.setDisabled(false);
                                         tex_codigoBarra.focus();
                }
            }
        });
    com_vendedor.addListener(new ComboBoxListenerAdapter() {

            @Override
      public void onSelect(ComboBox comboBox, Record record, int index) {
                onChangeCategoria();
            }

              private void onChangeCategoria() {
              tex_codigoBarra.setDisabled(false);
              tex_codigoBarra.focus();
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
 //    String enlace = "php/Traspaso.php?funcion=Listarempleadosmarca&idalmacen="+idalmacen+ "&idmarca="+idmarca;




      public void anadirProducto(String idproducto, String codigo, String detalle, String talla, String cantidad, Float precio2) {
        Record registroCompra = lista2.getRecordDef().createRecord(new Object[]{
                    idproducto, codigo, detalle, talla, "1", precio2});
                                            lista2.getGrid().stopEditing();
                                            lista2.getGrid().getStore().insert(0, registroCompra);
                                            lista2.getGrid().startEditing(0, 0);
                                            Float to = new Float(0);
                                            for (int i = 0; i < lista2.getStore().getRecords().length; i++) {
                                                to += lista2.getStore().getRecords()[i].getAsFloat("precio2");
                                            }

                                          tex_totalpares.setValue(to.toString());
                                      //      tex_montoPagar.setValue(to.toString());
//     tex_totalpares = new TextField("Total Pares", "totalpares");
//        tex_totalbs = new TextField("Total Bs", "totalbs");
//
//        tex_totalcaja = new TextField("Total Caja", "totalcaja");

                                             //tex_montoPagar

                                           Float top = new Float(0);
                                            for (int i = 0; i < lista2.getStore().getRecords().length; i++) {
                                                top += lista2.getStore().getRecords()[i].getAsFloat("cantidad");
                                            }

                                           // prueba.setText(to.toString());

                                            tex_totalbs.setValue(to.toString());
                                         tex_totalcaja.setValue(top.toString());


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
        public  void findByCodigoProducto(final String buscando) {

                String enlace = "php/VentaMayor.php?funcion=buscarcodigo&codigo=" + buscando+ "&idmarca="+idmarca;

                Utils.setErrorPrincipal("Cargando parametros del codigo", "cargar");
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
         // String[] nombreComlumns = {"idkardexunico", "idmodelo", "modelo","detalle","talla", "item","cantidad", "preciou","preciocaja"};
                                           String idkardex = Utils.getStringOfJSONObject(marcaO, "idkardexunico");
                                            String idmodelo = Utils.getStringOfJSONObject(marcaO, "idmodelo");
                                            String codigo = Utils.getStringOfJSONObject(marcaO, "modelo");
                                            String detalle = Utils.getStringOfJSONObject(marcaO, "detalle");
                                            String talla = Utils.getStringOfJSONObject(marcaO, "talla");
                                            String item = Utils.getStringOfJSONObject(marcaO, "item");
                                             String cantidad = Utils.getStringOfJSONObject(marcaO, "cantidad");
                                              String preciou = Utils.getStringOfJSONObject(marcaO, "preciou");
                                               String preciocaja = Utils.getStringOfJSONObject(marcaO, "preciocaja");
                                            //Number cantidad = 1.0;  String detalle = Utils.getBigDecimalOfJSONObject(marcaO, "detalle");

                            Record registroCompra = lista2.getRecordDef().createRecord(new Object[]{
                                          idkardex,idmodelo, codigo, detalle,talla, item,cantidad, preciou,preciocaja});


                                            lista2.getGrid().stopEditing();
                                            lista2.getGrid().getStore().insert(0, registroCompra);
                                            lista2.getGrid().startEditing(0, 0);
                                            Float to = new Float(0);
                                            for (int i = 0; i < lista2.getStore().getRecords().length; i++) {
                                                to += lista2.getStore().getRecords()[i].getAsFloat("preciou");
                                            }
                                           Float top = new Float(0);
                                            for (int i = 0; i < lista2.getStore().getRecords().length; i++) {
                                                top += lista2.getStore().getRecords()[i].getAsFloat("cantidad");
                                            }
                                          //   tex_montoPagar.setValue(to.toString());

                                        //    tex_montocancelado.setValue(to.toString());
                                         tex_totalpares.setValue(top.toString());
                                           tex_totalsus.setValue(to.toString());
                                            Float caja = new Float(0);
                                          //  double docena=12.00;
                                            caja =top/12;
                                           tex_totalcaja.setValue(caja.toString());
                                             Float enbs = new Float(0);
                                          Float tipocam = new Float(0);
                                          enbs = new Float(tex_tipocambio.getText());
                                          tipocam = (to * enbs);
                                          tex_totalbs.setValue(tipocam.toString());
                                        //  tex_codigoBarra.setValue("");
                                         //   tex_codigoBarra.focus();
                                           formularioventa.tex_codigoC.setValue("");
                                            formularioventa.tex_codigoC.focus();
                                      //    totalTotalV1073 = new Float(tex_montoPagar.getText());
                                    //   montocancelado = new Float(tex_montocancelado.getText());

                                        } else {
                              }

                                    }

                                    else{
                                            formularioventa.tex_codigoC.setValue("");
                                            formularioventa.tex_codigoC.focus();
                                        MessageBox.alert(mensajeR);

                                    }
                                } else {
                                 formularioventa.tex_codigoC.setValue("");
                                            formularioventa.tex_codigoC.focus();
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
         //           return respuesta;
                }

            }

   public void calcularSubTotal(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
        String temp = newValue.toString();
        Float old = new Float(oldValue.toString());

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




           record.commit();
           // record.set("totalpares",talla1 + talla1m +talla2 + talla2m +talla3 +talla3m + talla4 +talla4m +talla5 +talla5m + talla6 +talla6m + talla7 + talla7m + talla8 + talla8m + talla9 + talla9m + talla10+ talla10m + talla11 + talla11m + talla12+ talla12m + talla13+ talla13m);
           //    record.set("totalbs", record.getAsFloat("totalpares") * record.getAsFloat("precio"));

            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
             //   totalca += grid.getStore().getRecords()[i].getAsFloat("totalcajas");
                totalpa += grid.getStore().getRecords()[i].getAsFloat("cantidad");
           totalpe += grid.getStore().getRecords()[i].getAsFloat("preciou");

            }
              tex_totalsus.setValue(totalpe.toString());
        tex_totalpares.setValue(totalpa.toString());



 Float to = new Float(0);


                                            Float caja = new Float(0);
                                          //  double docena=12.00;
                                            caja =totalpa/12;
                                           tex_totalcaja.setValue(caja.toString());
                                             Float enbs = new Float(0);
                                          Float tipocam = new Float(0);
                                          enbs = new Float(tex_tipocambio.getText());
                                          tipocam = (to * enbs);
                                          tex_totalbs.setValue(tipocam.toString());
    }



    public void createventa(String idmarca) {



//   String cliente = com_cliente.getValueAsString();

        String idalmacenenvio = com_empresa.getValueAsString();
        String idvendedoreniado = com_responsables.getValueAsString();
        String tipocambio = tex_tipocambio.getValueAsString();
 String boleta = tex_boleta.getValueAsString();

        String totalpares = tex_totalpares.getValueAsString();
        String totalcaja = tex_totalcaja.getValueAsString();
        String totalbs = tex_totalbs.getValueAsString();
     String totalsus = tex_totalsus.getValueAsString();

        String descripcion = tea_descripcion.getValueAsString();
  String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");

        Record[] records = lista2.getStore().getRecords();
        JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();
        compraObject.put("idmarca", new JSONString(idmarca));
        compraObject.put("boleta", new JSONString(boleta));
        compraObject.put("fecharegistro", new JSONString(fechaent));
        compraObject.put("totalpares", new JSONString(totalpares));
        compraObject.put("totalbs", new JSONString(totalbs));
        compraObject.put("totalcaja", new JSONString(totalcaja));
         compraObject.put("totalsus", new JSONString(totalsus));
        compraObject.put("descripcion", new JSONString(descripcion));
         compraObject.put("vendedor", new JSONString(idvendedoreniado));
          compraObject.put("almacen", new JSONString(idalmacenenvio));
           compraObject.put("tipocambio", new JSONString(tipocambio));
//        compraObject.put("fecha", new JSON(date));


        for (int i = 0; i < records.length; i++) {

                productoObject = new JSONObject();
                 productoObject.put("idkardexunico", new JSONString(records[i].getAsString("idkardexunico")));
                 productoObject.put("preciou", new JSONString(records[i].getAsString("preciou")));
               //  productoObject.put("cantidad", new JSONString(records[i].getAsString("cantidad")));

               // String opc = records[i].getAsString("talla");

                productos.set(i, productoObject);
                productoObject = null;




        }

        JSONObject resultado = new JSONObject();
        resultado.put("venta", compraObject);
        resultado.put("productos", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
       // String url = "./php/VentaMayor.php?funcion=txSaveVenta&" + datos;
           String url = "./php/Traspaso.php?funcion=txSaveTraspaso&" + datos;
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
                            Utils.setErrorPrincipal(mensajeR, "resultado");
                           Window.alert(mensajeR);
                        String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");

//  String enlTemp = "funcion=verboletaventa&idventa=" + idventaG;
  String enlTemp = "funcion=verboletatraspaso&idtraspaso=" + idventaG;
  //String enlTemp = "funcion=AdicionCodigoBarraIngresoHTML&idingreso=" + idventaG;

  verReporte(enlTemp);

                       // kmenu.seleccionarOpcionRemove(null, "6010", e, PanelTraspasoDetalle.this);
kmenu.seleccionarOpcionRemove(null, "fun6010", e, PanelTraspasoDetalle.this);


                        } else {
                         //   kmenu.seleccionarOpcionRemove(null, "fun6010", e, PanelTraspasoDetalle.this);

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

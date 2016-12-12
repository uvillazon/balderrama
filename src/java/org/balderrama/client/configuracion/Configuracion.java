/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.configuracion;

import org.balderrama.client.MainEntryPoint;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
//import org.balderrama.client.pedido.Reportes;

/**
 *
 * @author 
 */
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
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
import com.google.gwt.user.client.ui.ClickListener;
import com.google.gwt.user.client.ui.RadioButton;
import com.google.gwt.user.client.ui.Widget;
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
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.event.EditorGridListenerAdapter;
import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;
import com.gwtext.client.widgets.layout.BorderLayout;
import com.gwtext.client.widgets.layout.BorderLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.HorizontalLayout;
import com.gwtext.client.widgets.layout.TableLayout;
import com.gwtext.client.widgets.layout.TableLayoutData;
import java.lang.String;


/**
 *
 * @author example
 */
public class Configuracion {

    private final int ANCHO = 800;
    private final int ALTO = 560;
    private Panel panel;
    private String COMPRA_DIRECTA_TABBED = "9600_venta-";
    private TextField tex_nit;
    private TextField tex_idcliente;
    private TextField tex_nombre;
    private TextField tex_apellido;
    private TextField tex_codigoBarra;
    // private TextField tex_almacenorigen;
    private TextField tex_numBoleta;
    private TextField tex_numero;
    private TextField tex_numeroDocumento;
    private TextField tex_cambio;
    private DateField dat_fecha;
    private TextField tex_validez;
    private RadioButton creditoSi;
    private RadioButton creditoNo;
    private RadioButton tarjetaSi;
    private RadioButton facturaSi;
    private RadioButton facturaNo;
//    private RadioButton entregaSi;
//    private Multivendedor multivendedor;
//    private RadioButton entregaNo;
    private ComboBox com_empresa;
    private ComboBox com_empleado;
    private ComboBox com_vendedor;
      private ComboBox com_tipoalmacenC;
//    private TextField tex_referencia;
    private TextField tex_montoPagar;
    private TextField tex_montoTotal;
    private TextField tex_montocancelado;
    private TextField tex_montocanceladosus;
//    Cliente clienteSeleccionado;
    private TextField tex_devuelto;
    private TextField tex_devueltosus;
    private TextField tex_descuentoPorcentaje;
    private TextField tex_descuento;
    private ListaProformaProducto lista;
    private String Multivendedor;
   // private Multivendedor multivendedor;
  //  private FormularioConsultas formularioConsultas;
 //   private MostrarAlmacenesWindow formulario_alm;
  //  Cliente proveedorSeleccionado;
    private Object[][] empresaA;
    private Object[][] usuariosA;
    // private Object[][] empresasM;
    private Object[][] clienteM;
     private Object empresaC[][];
    private Object clienteC[][];
    //   private Object[][] empleadoA;
    private Object empleadoA[][];
    private Object[][] vendedorM;
    private String[] tipoalmacenM;
    private String Multivendedo;
    private String idalmacen;
    private String nombrealmanen;
    private String cambioM;
    public String idcliente = "";
    boolean respuesta = false;
    private TextField tex_montoPapeleta;
    private TextArea tea_descripcion;
    private Button but_aceptar;
    private Button but_cancelar;
 //   ListaVenta listaCompra;
   private Button but_limpiar;
   private Button but_descuento;

//    private Button but_verproducto;
    String selecionado = "";
    private Float totalTotalV1073;
    private Float descPorV1073;
    private Float descCalV1073;
    private Float pagarV1073;
    private Float devuelto;
    private Float montocambio;
    private Float tipocambio;
    private Float devueltosus;
    private Float montocancelado;
    private Float montocanceladosus;
    private Float cambio;
    private Float totalpagar;
    private Double cambiotipo;
 private long idpanel;
 String opcion;
 public MainEntryPoint pan;
      public Configuracion(long idpanel, MainEntryPoint panel) {
     this.pan = panel;
        this.idpanel = idpanel;
        this.opcion="1";
   //         this.tipoalmacenM = new String[]{"0", "1", "2", "3", "4", "5"};
             //    this.tipoalmacenM = new String[]{"6", "7", "8", "10", "12", "15"};
    }

    public void onModuleLoad() {
        panel = new Panel();
        panel.setId("tab-" + COMPRA_DIRECTA_TABBED + idpanel);
        panel.setTitle("Venta" + idpanel);
        panel.setLayout(new FitLayout());
        panel.setBaseCls("x-plain");

        Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");

        Panel pan_norte = new Panel();
        pan_norte.setLayout(new TableLayout(6));
        pan_norte.setBaseCls("x-plain");
        pan_norte.setHeight(110);
        pan_norte.setPaddings(5);

        Panel pan_sud = new Panel();
        pan_sud.setLayout(new TableLayout(3));
        pan_sud.setBaseCls("x-plain");
        pan_sud.setHeight(180);
//        pan_sud.setWidth(1000);
        pan_sud.setPaddings(5);


        lista = new ListaProformaProducto();
        // lista.onModuleLoad();
        lista.onModuleLoad();
        Panel pan_centro = lista.getPanel();

        FormPanel for_panel1 = new FormPanel();
        for_panel1.setBaseCls("x-plain");
        for_panel1.setWidth(250);
        for_panel1.setLabelWidth(100);

        tex_codigoBarra = new TextField("Articulo Cod. Barra", "codigobarra");
        tex_codigoBarra.focus();
//        Validacion.validar("Id proveedor", tex_nit, false);
        for_panel1.add(tex_codigoBarra);

       
        pan_norte.add(new PaddedPanel(for_panel1, 0, 0, 13, 10));
        FormPanel for_panel4 = new FormPanel();

        for_panel4.setBaseCls("x-plain");
        for_panel4.setWidth(340);
        //    tex_montoTotal = new TextField();
        //   tex_montoTotal.setName("montototal");
//        Label prueba = new Label("montototal");
//        prueba.setTitle("Total");
//
        tex_montoTotal = new TextField("Monto total", "montototal");
        tex_montoTotal.setReadOnly(true);

      
        for_panel4.add(tex_montoTotal);
      
        //        for_panel4.add(prueba);

      
        Panel pan_botones = new Panel();
        pan_botones.setLayout(new HorizontalLayout(10));
        pan_botones.setBaseCls("x-plain");
        //       pan_botones.setHeight(40);
        but_aceptar = new Button("Guardar");
        but_cancelar = new Button("Cancelar");
        but_limpiar = new Button("Limpiar");
         but_descuento = new Button("Descuento Especial");
//        but_verproducto = new Button("Ver Producto");
        pan_botones.add(but_aceptar);
        pan_botones.add(but_cancelar);
//        Panel panTotal = new Panel();
//        panTotal.setLayout(new HorizontalLayout(10));
//        panTotal.setBaseCls("x-plain");
//        panTotal.setBodyBorder(true);
//        panTotal.setBodyStyle("border-style:dotted;border-color:black;");
//       // panTotal.add(prueba);

        pan_botones.add(but_limpiar);
         pan_botones.add(but_descuento);
//        pan_botones.add(but_verproducto);

        pan_sud.add(new PaddedPanel(for_panel4, 5));
        pan_sud.add(new PaddedPanel(pan_botones, 5, 210, 10, 15), new TableLayoutData(3));


        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centro, new BorderLayoutData(RegionPosition.CENTER));
        pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        panel.add(pan_borderLayout);
//initCombos();
//initDescuentos();
//initDescuentoEspecial(opcion);

//initValues();
        addListeners();
//addListenerskey();
    }


 //esta es la parte a modificar
 

  

    private void addListeners() {

        //**************************************************
        //************* BOTON CANCELAR   *******************
        //**************************************************




        but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {

             //   closeTabCompraDirecta();
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
            //    createCompra();
//                }
            }
        });


        but_limpiar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                limpiarVentanaVenta();
            }
        });

         but_descuento.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e)
            {

//                 procesoValidar();

            }


        });

    

        //**************************************************
        //*************BUSCAR PRODUCTO   *******************
        //**************************************************

        tex_codigoBarra.addListener(new TextFieldListenerAdapter() {

           // private FormularioProductoKardex kardex;

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    // abrir la lsita de productos for_proveedor
                    //MessageBox.alert(field.getValueAsString());
                    String codigoProducto = field.getValueAsString().trim();
                    // String idProveedor = tex_almacenorigen.getValueAsString().trim();
                    String idproductos = tex_codigoBarra.getValueAsString().trim();

                    if (idproductos.isEmpty() || findByCodigoProducto(idproductos)) {
//                        if (kardex == null || kardex.isHidden()) {
//                               showListProducto();
//                            } else {
//                            kardex.onFocus();
//                        }


                    }
                //  Utils.setErrorPrincipal("Usted debe introducir un id almacen antes.", "error");


                }
            }

            // private boolean addListenerModelo(final String buscando) {
            private boolean findByCodigoProducto(final String buscando) {
                String enlace = "php/KardexTienda.php?funcion=buscarporcodigobarra&codigo=" + buscando;

                //String enlace = "php/Pedido.php?funcion=BuscarModeloPorId&idmodelo=" + buscando;
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
                                            String idmodelo = Utils.getStringOfJSONObject(marcaO, "idkardextienda");
                                            String codigo = Utils.getStringOfJSONObject(marcaO, "codigo");
                                            Number precio2 = Utils.getBigDecimalOfJSONObject(marcaO, "precio2");
                                            String detalle = Utils.getStringOfJSONObject(marcaO, "detalle");
                                            String talla = Utils.getStringOfJSONObject(marcaO, "talla");
                                            String vendedor = com_vendedor.getValue();
                                          //  String idecliente = com_empleado.getValueAsString();
                                            //  vendedor = Utils.getStringOfJSONObject(productoObject, "idempleado");
                                            //      vendedor = Utils.getBigDecimalOfJSONObject(productoObject,"idempleado");
                                            Number cantidad = 1.0;
                                            // total = 3.0;
                                            //Object[][] lineas = Utils.getArrayOfJSONObject(marcaO, "lineaM", new String[]{"idcliente", "codigo"});
                                            Record registroCompra = lista.getRecordDef().createRecord(new Object[]{
                                                        idmodelo, codigo, detalle,talla, cantidad, precio2,vendedor});


                                            lista.getGrid().stopEditing();
                                            lista.getGrid().getStore().insert(0, registroCompra);
                                            lista.getGrid().startEditing(0, 0);
                                            Float to = new Float(0);
                                            for (int i = 0; i < lista.getStore().getRecords().length; i++) {
                                                to += lista.getStore().getRecords()[i].getAsFloat("precio2");
                                            }

                                            tex_montoTotal.setValue(to.toString());
                                            tex_montoPagar.setValue(to.toString());

                                            tex_codigoBarra.setValue("");
                                            tex_codigoBarra.focus();

                                        } else {
                                            //MessageBox.alert("No Hay datos en la consulta");
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
                    // Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");

                    }
                    return respuesta;
                }

            }
            
          
        });



        //**************************************************
        //*************BUSCAR CLIENTE*******************cambio
        //**************************************************
       


    
        //**************************************************
        //*************CALCULAR TOTAL DE COMPRA ************
        //**************************************************
        lista.getGrid().addEditorGridListener(new EditorGridListenerAdapter() {

            @Override
            public void onAfterEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
                calcularSubTotal(grid, record, field, newValue, oldValue, rowIndex, colIndex);
            }
        });


    }

 


    private void calcularSubTotal(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
        String temp = newValue.toString();
        Float old = new Float(oldValue.toString());

        Float ne = old;
        try {
            ne = new Float(temp);
        } catch (Exception e) {
            com.google.gwt.user.client.Window.alert("atapadp  " + e.getMessage());
            ne = old;
        }

        record.commit();
        // Float precio = record.getAsFloat("precio");
        Float precio2 = record.getAsFloat("precio2");
//        if (record.getAsString("tipoventa").equalsIgnoreCase("Por Unidad")) {
//            record.set("precio2", 0);
//            record.set("total", record.getAsFloat("cantidad") * record.getAsFloat("precio"));
//
//
//        } else {
//            record.set("precio", 0);
//            record.set("total", record.getAsFloat("cantidad") * record.getAsFloat("precio2"));
//        }
        record.set("precio2", 0);

        record.set("total", record.getAsFloat("cantidad") * record.getAsFloat("precio2"));

        Float total = new Float(0);
        for (int i = 0; i <
                grid.getStore().getRecords().length; i++) {
            total += grid.getStore().getRecords()[i].getAsFloat("total");

        }

        tex_montoTotal.setValue(total.toString());
        tex_montoPagar.setValue(total.toString());

    }

    public void resetCamposProveedor() {

        tex_nit.reset();
        tex_nombre.reset();
        tex_apellido.reset();
        tex_nit.focus();

    }

    public Panel getPanel() {
        return panel;
    }

    public void resetCamposCliente() {

        tex_nit.reset();
        tex_nombre.reset();
        tex_apellido.reset();

    }

    private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }

    public void limpiarVentanaVenta() {
        lista.LimpiarGrid();
        tex_montoTotal.setValue("0");
        tex_montoPagar.setValue("0");
        tex_montocancelado.setValue("0");
        tex_montocanceladosus.setValue("0");
        tex_montoPapeleta.setValue("");
        tex_montocancelado.setValue("0");
        tex_montocanceladosus.setValue("0");
        tex_devuelto.setValue("0");
        tex_numeroDocumento.setValue("");
        com_tipoalmacenC.setValue("0");
        dat_fecha.setValue("");
        tex_nombre.setValue("");
        tex_nit.setValue("");
        tex_apellido.setValue("");
        tex_descuento.setValue("0");
        com_tipoalmacenC.setValue("0");
        //com_empleado.setValue("No existe el Cliente");
    }
  
   

    public void anadirProducto(String idproducto, String codigo, String detalle, String talla, String cantidad, String precio2, String vendedor) {
        Record registroCompra = lista.getRecordDef().createRecord(new Object[]{
                    idproducto, codigo, detalle, talla, "1", precio2, vendedor});
                                            lista.getGrid().stopEditing();
                                            lista.getGrid().getStore().insert(0, registroCompra);
                                            lista.getGrid().startEditing(0, 0);
                                            Float to = new Float(0);
                                            for (int i = 0; i < lista.getStore().getRecords().length; i++) {
                                                to += lista.getStore().getRecords()[i].getAsFloat("precio2");
                                            }

                                            tex_montoTotal.setValue(to.toString());
                                            tex_montoPagar.setValue(to.toString());

    }

 

}


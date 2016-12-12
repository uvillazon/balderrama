/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.traspaso;

import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.widgets.TabPanel;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.Position;
import com.gwtext.client.core.TextAlign;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.data.FieldDef;
import com.gwtext.client.data.JsonReader;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.RecordDef;
import com.gwtext.client.data.ScriptTagProxy;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.data.Store;
import com.gwtext.client.data.StringFieldDef;
import com.gwtext.client.util.DateUtil;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Component;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.QuickTipsConfig;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.form.Checkbox;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.event.PanelListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FieldSet;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextArea;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.HorizontalLayout;
import com.gwtext.client.widgets.layout.VerticalLayout;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.FormLayout;
import java.util.Date;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;


/**
 *
 * @author buggy
 */
public class ConfigurarMaterialForm extends Window {

    private final int ANCHO = 900;
    private final int ALTO = 550;
     private String ANCHO2 = "80%";
    private String ALTO2 = "250px";
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    public TextField tex_codigoM;
    private TextField tex_origenM;
    private TextField tex_destinoM;
    private TextField tex_fechaM;
    private TextField tex_estadoM;
 private DateField dat_fecha;
 private Date fechahoy;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String idmarcaM;
    private String codigoM;
    private String origenM;
    private String destinoM;
    private String fechaM;
    private String estadoM;
    private Object[][] coloresM;
    private Object[][] materialesM;
    private boolean nuevo;
    private ListaTraspaso padre;
    private String enlaceReporte;
   // private ScriptTagProxy dataProxy1015;
    private String idclienteD;
    //private JsonReader reader1015;
    private GridPanel grid1015;
        private ColumnConfig codigo1015;
    private ColumnConfig codigof1015;
    private ColumnConfig nombre1015;
    private ColumnConfig marca1015;
    private ColumnConfig pais1015;
    private ColumnConfig cantidad1015;
    private ColumnConfig preciobs1015;
    private ColumnConfig preciosus1015;
    private ColumnConfig pago7;
    private ColumnConfig car1015;
    private ToolbarButton editarProducto1015;
    private ToolbarButton eliminarProducto1015;
    private ToolbarButton nuevoProducto1015;
    private ToolbarButton duplicarProducto1015;
    private ToolbarButton caracProducto1015;
    private ToolbarButton inventarioProducto1015;
    private ToolbarButton kardexProducto1015;
    private ToolbarButton movimientoProducto1015;
    private ToolbarButton verProducto1015;
    protected ExtElement ext_element1015;
    private CheckboxSelectionModel cbSelectionModel1015;
   // private CheckboxSelectionModel cbSelectionModel;
    private Store store1015;
    private BaseColumnConfig[] columns1015;
    private ColumnModel columnModel1015;
    private DataProxy dataProxy1015;
    private JsonReader reader1015;
    PagingToolbar pagingToolbar1015;



    public ConfigurarMaterialForm(String idmarcaM, String codigoM,String origenM,String destinoM,String fechaM,String estadoM, ListaTraspaso padr) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");
        this.idmarcaM = idmarcaM;
        this.codigoM = codigoM;
        this.origenM = origenM;
        this.destinoM = destinoM;
        this.fechaM = fechaM;
        this.estadoM = estadoM;
        //this.coloresM = coloresM;
       // this.materialesM = materialesM;

 this.enlaceReporte = "php/ReporteHTML.php?" + idmarcaM;

        this.padre = padr;

        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Configurar nueva Marca";

        if (idmarcaM != null) {
            nombreBoton1 = "Confirmar Traspaso";
            tituloTabla = "Verificar llegada de productos y Traspaso";
            nuevo = false;
        } else {
            this.idmarcaM = "nuevo";
            nuevo = true;

        }

        setId("win-Marcas");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {
int repeat = 0;
            Record[] records;

            @Override
            public void onClick(Button button, EventObject e) {
                 records = cbSelectionModel1015.getSelections();

                //Record[] cambiados = grid.getStore().getModifiedRecords();

                if (records.length > 0) {
                    //selecionado = records[0].getAsString("idproducto");
                    //com.google.gwt.user.client.Window.alert(selecionado);

                    MessageBox.confirm("Guardar", "Realmente desea registrar " + records.length + " producto(s)?", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                    //GuardarConfiguracionMarca();
                     GuardarConfiguracionMarca2(records);

                              }//fin boton
                        }
                    });
                } else {
                    MessageBox.alert("No hay producto selecionado para confirmar.");
                }
                //GuardarCat.setPressed(false);
              
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
LimpiarGrid();
                ConfigurarMaterialForm.this.close();
                ConfigurarMaterialForm.this.setModal(false);
            //formulario = null;
            }
        });
dat_fecha = new DateField("Fecha", "d-m-Y");
         fechahoy = new Date();
              dat_fecha.setValue(fechahoy);
 dat_fecha.setReadOnly(true);
        tex_codigoM = new TextField("Codigo", "codigo");
        tex_codigoM.setReadOnly(true);
        tex_origenM = new TextField("Origen", "origen");
        tex_origenM.setReadOnly(true);
        tex_destinoM = new TextField("Destino", "destino");
        tex_destinoM.setReadOnly(true);
        tex_fechaM = new TextField("Fecha Envio", "fecha");
        tex_fechaM.setReadOnly(true);
        tex_estadoM = new TextField("Estado", "estado");
        tex_estadoM.setReadOnly(true);

        setTitle(tituloTabla);
        setWidth(ANCHO);
        setMinWidth(ANCHO);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        addButton(but_aceptarP);
        addButton(but_cancelarP);

        setCloseAction(Window.CLOSE);
        setPlain(true);
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        formPanel.setLabelWidth(ANCHO - 400);
        formPanel.setWidth(ANCHO);
        formPanel.setHeight(300);



        formPanel.setLabelWidth(ANCHO - 400 - 5);
         formPanel.add(dat_fecha);
        formPanel.add(tex_codigoM);
formPanel.add(tex_origenM);
formPanel.add(tex_destinoM);
formPanel.add(tex_fechaM);
formPanel.add(tex_estadoM);

        //initcrearFielsetsColor();
      //  initcrearFielsetsMaterial();
         listaproductosdetalle();

//formPanel.addListener(listener)

        add(formPanel);

        initValues();
    }


private void listaproductosdetalle() {
TabPanel tabPanel = new TabPanel();
        tabPanel.setPlain(true);
        tabPanel.setActiveTab(0);
        tabPanel.setHeight(410);
            Panel firstPanel = new Panel();
       firstPanel.setTitle("CALZADOS");
        firstPanel.setLayout(new FormLayout());
        //firstPanel.setPaddings(10);
//         dataProxy1015 = new ScriptTagProxy("php/Cobros.php?funcion=buscarcreditos");
                  dataProxy1015 = new ScriptTagProxy("./php/TraspasoDetalle.php?funcion=buscarproductostraspaso&idtraspaso="+idmarcaM);

        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("iddetalletraspaso"),
                     new StringFieldDef("idkardextienda"),
                    new StringFieldDef("codigo"),
                    new StringFieldDef("talla"),
                    new StringFieldDef("cantidad"),
                    new StringFieldDef("precio"),
                    new StringFieldDef("detalle")
                });

        reader1015 = new JsonReader(recordDef);
        reader1015.setRoot("resultado");
        reader1015.setTotalProperty("totalCount");


        store1015 = new Store(dataProxy1015, reader1015, true);
        //chanchadita(store);

        codigo1015 = new ColumnConfig("Articulo", "codigo", 80, false);
        /* columnade ci  */
        codigof1015 = new ColumnConfig("Talla", "talla", 70, false);
        /* columnade nombre  */
        nombre1015 = new ColumnConfig("Cantidad", "cantidad", 90,false);
        nombre1015.setAlign(TextAlign.CENTER);
        /* columnade primer apellido  */
        marca1015 = new ColumnConfig("Precio", "precio", 90 ,false);
        marca1015.setAlign(TextAlign.CENTER);

        /* columnade rol  */
        pais1015 = new ColumnConfig("Detalle", "detalle",350, false);
        pais1015.setAlign(TextAlign.LEFT);

        cbSelectionModel1015 = new CheckboxSelectionModel();
        CheckboxColumnConfig checkBoxColumnc = new CheckboxColumnConfig(cbSelectionModel1015);
        columns1015 = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel1015),
                    //column ID is company which is later used in setAutoExpandColumn
                    codigo1015,
                    codigof1015,
                    nombre1015,
                    marca1015,
                    pais1015
                };

        columnModel1015 = new ColumnModel(columns1015);
       grid1015 = new EditorGridPanel();
       grid1015.setWidth(ANCHO);
        grid1015.setHeight(ALTO);
        //  grid.setTitle("Lista de productos");
     //   grid1015.setStore(reader1015);
             grid1015.setStore(store1015);
        grid1015.setColumnModel(columnModel1015);
        grid1015.setTrackMouseOver(true);
        grid1015.setLoadMask(true);
        grid1015.setSelectionModel(new RowSelectionModel());
        grid1015.setSelectionModel(cbSelectionModel1015);
        grid1015.setFrame(true);
        grid1015.setStripeRows(true);
        grid1015.setIconCls("grid-icon");

        pagingToolbar1015 = new PagingToolbar(store1015);
        pagingToolbar1015.setPageSize(100);
        pagingToolbar1015.setDisplayInfo(true);
        pagingToolbar1015.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar1015.setEmptyMsg("No existen productos para mostrar");

         kardexProducto1015 = new ToolbarButton("Ver Venta");
        kardexProducto1015.setEnableToggle(true);
        QuickTipsConfig tipsConfig5 = new QuickTipsConfig();
        kardexProducto1015.setTitle("Ver Venta");
        kardexProducto1015.setTooltip(tipsConfig5);

     
        pagingToolbar1015.addSeparator();
        pagingToolbar1015.addButton(kardexProducto1015);
        pagingToolbar1015.addSeparator();

        grid1015.setBottomToolbar(pagingToolbar1015);

        grid1015.setWidth(ANCHO2);
        grid1015.setHeight(ALTO2);
        grid1015.addListener(
                new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store1015.load(0, 100);
                    }
                });


        firstPanel.add(grid1015);
     tabPanel.add(firstPanel);


        formPanel.add(tabPanel);
    }
 private void LimpiarGrid() {
store1015.removeAll();

        grid1015.setStore(store1015);
        grid1015.reconfigure(store1015, columnModel1015);

 }
    private void initValues() {
        tex_codigoM.setValue(codigoM);
        tex_origenM.setValue(origenM);
   tex_destinoM.setValue(destinoM);
   tex_fechaM.setValue(fechaM);
   tex_estadoM.setValue(estadoM);

    }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }
  public void GuardarConfiguracionMarca2(Record[] records) {
        //php/TraspasoDetalle.php?funcion=GuardarConfiguracionTraspaso---GuardarConfigurarMarcaMaterial
        //String cadena = "php/TraspasoDetalle.php?funcion=GuardarConfiguracionTraspaso&idtraspaso=" + idmarcaM;
Record[] recordss ;
recordss = cbSelectionModel1015.getSelections();
       String codigotraspaso = this.tex_codigoM.getText();
       String idtraspaso = this.idmarcaM;
    String fecha = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
     
 //String idempresa = this.formularioSinFactura.com_empresa.getValueAsString();
   // Record[] records = cbSelectionModel1015.getSelections();
   //  records = cbSelectionModel1015.getSelections();
        JSONArray productos = new JSONArray();
        JSONObject productoObject;
           
               // tex_montocancelado.setValue("0");
            JSONObject compraObject = new JSONObject();
         compraObject.put("fecha", new JSONString(fecha));
            compraObject.put("codigotraspaso", new JSONString(codigotraspaso));
            compraObject.put("idtraspaso", new JSONString(idtraspaso));

            for (int i = 0; i < recordss.length; i++) {
                productoObject = new JSONObject();
                productoObject.put("iddetalletraspaso", new JSONString(recordss[i].getAsString("iddetalletraspaso")));
                productoObject.put("idkardextienda", new JSONString(recordss[i].getAsString("idkardextienda")));
                productoObject.put("codigo", new JSONString(recordss[i].getAsString("codigo")));
                productoObject.put("cantidad", new JSONString(recordss[i].getAsString("cantidad")));
                
                productos.set(i, productoObject);
                productoObject = null;
            }
            JSONObject resultado = new JSONObject();
            resultado.put("traspaso", compraObject);
            resultado.put("productos", productos);

            String datos = "resultado=" + resultado.toString();

            Utils.setErrorPrincipal("registrando", "cargar");
            // String url = "./php/VentaDetalle.php?funcion=insertarventa";
             //String cadena = "php/TraspasoDetalle.php?funcion=GuardarConfiguracionTraspaso&idtraspaso=" + idmarcaM;

            String url = "./php/TraspasoDetalle.php?funcion=GuardarConfiguracionTraspaso&" + datos;
//            final Conector conec = new Conector(url, false, "GET");
            final Conector conec = new Conector(url, false, "POST");

           //         final Conector conec = new Conector(url, false,"POST");
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
                            String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
                                String enlTemp = "funcion=traspasoHTML&idtraspaso=" + idventaG;
                                verReporte(enlTemp);
                                Utils.setErrorPrincipal(mensajeR, "mensaje");
                                ConfigurarMaterialForm.this.close();
                ConfigurarMaterialForm.this.setModal(false);
                                                      grid1015.getStore().reload();
                                                      padre.reload();
                                                                      //   verReporte(enlTemp);
                            Utils.setErrorPrincipal(mensajeR, "mensaje");

                        } else {
                            //Window.alert(mensajeR);
                            com.google.gwt.user.client.Window.alert("hubo un error en no de los items por confirmar");
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
    

  private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
    public int redondedo(float f) {
        int aux = (int) f;
        if (aux < f) {
            aux = aux + 1;
        }
        return aux;
    }
}
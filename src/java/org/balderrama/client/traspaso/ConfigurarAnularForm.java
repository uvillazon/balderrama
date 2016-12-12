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
import com.gwtext.client.data.ArrayReader;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.data.FieldDef;
import com.gwtext.client.data.JsonReader;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.RecordDef;
import com.gwtext.client.data.ScriptTagProxy;
import com.gwtext.client.data.Store;
import com.gwtext.client.data.StringFieldDef;
import com.gwtext.client.util.DateUtil;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Component;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.event.PanelListenerAdapter;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.FormLayout;
import com.gwtextux.client.data.PagingMemoryProxy;
import java.util.Date;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;

/**
 *
 * @author buggy
 */
public class ConfigurarAnularForm extends Window {

    private final int ANCHO = 900;
    private final int ALTO = 500;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    public TextField tex_codigoM;
    private TextField tex_origenM;
    private TextField tex_destinoM;
    private TextField tex_fechaM;
    private TextField tex_estadoM;
   // private TextField tex_codigoBarra;
     private ColumnConfig Columnid;
    private ColumnConfig Columncodigo;
    private ColumnConfig Columnproducto;
    private ColumnConfig Columntalla;
    private ColumnConfig Columncantidad;
    private ColumnConfig Columnpreciobs2;
     private ColumnModel columnModel;
    private BaseColumnConfig[] columns;
    private PagingMemoryProxy proxy;
    private RecordDef recordDef;
     private RecordDef recordDef2;
      private Float totalcantidad;
    private Float totalBs;
      private CheckboxSelectionModel cbSelectionModel;
     private Store store;
    private ArrayReader reader;
    private ToolbarButton eliminarEntrega;
   // private Object[][] productoM;
  //    private EditorGridPanel grid;
      PagingToolbar pagingToolbar;
 private DateField dat_fecha;
 private Date fechahoy;
     boolean respuesta = false;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String idtraspaso;
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
    private ColumnConfig color1015;
    private ColumnConfig material1015;
    private ColumnConfig preciobs1015;
    private ColumnConfig preciosus1015;
    private ColumnConfig pago7;
    private ColumnConfig car1015;
    private ToolbarButton kardexProducto1015;
    protected ExtElement ext_element1015;
    private CheckboxSelectionModel cbSelectionModel1015;
   // private CheckboxSelectionModel cbSelectionModel;
    private Store store1015;
    private BaseColumnConfig[] columns1015;
    private ColumnModel columnModel1015;
    private DataProxy dataProxy1015;
    private JsonReader reader1015;
    PagingToolbar pagingToolbar1015;



 public ConfigurarAnularForm(String idmarcaM, String codigoM,String origenM,String destinoM,String fechaM,String estadoM, ListaTraspaso padre) {
       this.idtraspaso = idmarcaM;
        this.codigoM = codigoM;
        this.origenM = origenM;
        this.destinoM = destinoM;
        this.fechaM = fechaM;
        this.estadoM = estadoM;
   

 this.enlaceReporte = "php/ReporteHTML.php?" + idtraspaso;

        this.padre = padre;

        String nombreBoton1 = "";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "";

        if (idtraspaso != null) {
            nombreBoton1 = "Anular Traspaso";
            tituloTabla = "Verificar Modelos";
            nuevo = false;
        } else {
            this.idtraspaso = "nuevo";
            nuevo = true;

        }


        setMinWidth(700);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        setPlain(true);
        setPaddings(WINDOW_PADDING);
        setWidth(950);
        setHeight(550);
        setId("win-AnularTraspaso-2");
        but_aceptarP = new Button("Registrar Anulacion");
        but_cancelarP = new Button("Cancelar");

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
        formPanel.setHeight(520);



        formPanel.setLabelWidth(ANCHO - 400 - 5);
        formPanel.add(dat_fecha);
        formPanel.add(tex_codigoM);
        formPanel.add(tex_origenM);
        formPanel.add(tex_destinoM);
        formPanel.add(tex_fechaM);
        formPanel.add(tex_estadoM);
//formPanel.add(tex_codigoBarra);

listaproductosdetalle();
//formPanel.addListener(listener)

        add(formPanel);
           initValues();
            addListeners();
    }

   private void addListeners() {

   but_cancelarP.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
              //  LimpiarGrid();
            close();
            destroy();

            }
        });

     
   but_aceptarP.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
           GuardarConfiguracionMarca2();
            }
        });




    }


public void LimpiarGrid() {
        store.removeAll();

//        grid.setStore(store);
//        grid.reconfigure(store, columnModel);

        store1015.removeAll();

        grid1015.setStore(store1015);
        grid1015.reconfigure(store1015, columnModel1015);


}
   

private void listaproductosdetalle() {
TabPanel tabPanel = new TabPanel();
        tabPanel.setPlain(true);
        tabPanel.setActiveTab(0);
        tabPanel.setHeight(220);
            Panel firstPanel = new Panel();
      // firstPanel.setTitle("CALZADOS");
        firstPanel.setLayout(new FormLayout());
                   dataProxy1015 = new ScriptTagProxy("./php/Traspaso.php?funcion=buscarproductostraspaso&idtraspaso="+idtraspaso);
//                  dataProxy1015 = new ScriptTagProxy("./php/Traspaso.php?funcion=buscarproductostraspaso&idtraspaso="+idmarcaM);

        recordDef2 = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idmodelo"),
                    new StringFieldDef("codigo"),
                    new StringFieldDef("color"),
                    new StringFieldDef("material"),
                    new StringFieldDef("pares"),
                    new StringFieldDef("precio")
                });
        reader1015 = new JsonReader(recordDef2);
        reader1015.setRoot("resultado");
        reader1015.setTotalProperty("totalCount");

        store1015 = new Store(dataProxy1015, reader1015, true);
        //chanchadita(store);

        codigo1015 = new ColumnConfig("Modelo", "codigo", 100, false);
        /* columnade ci  */
        color1015 = new ColumnConfig("Color", "color", 100, false);
        /* columnade nombre  */
        material1015 = new ColumnConfig("Material", "material",100, false);
        material1015.setAlign(TextAlign.CENTER);
        nombre1015 = new ColumnConfig("Cantidad", "pares", 100,false);
        nombre1015.setAlign(TextAlign.CENTER);
        /* columnade primer apellido  */
        marca1015 = new ColumnConfig("Precio", "precio", 100 ,false);
        marca1015.setAlign(TextAlign.LEFT);


        cbSelectionModel1015 = new CheckboxSelectionModel();
        CheckboxColumnConfig checkBoxColumnc = new CheckboxColumnConfig(cbSelectionModel1015);
        columns1015 = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel1015),
                    //column ID is company which is later used in setAutoExpandColumn
                    codigo1015,
                    color1015,
                    material1015,
                    nombre1015,
                    marca1015
                   
                };

        columnModel1015 = new ColumnModel(columns1015);
grid1015 = new EditorGridPanel();
       // grid1015 = new EditorGridPanel();
        grid1015.setId("grid-lista-productos-marca");
        //grid1015.setTitle("Calzados");
        grid1015.setStore(store1015);
        grid1015.setColumnModel(columnModel1015);
        grid1015.setTrackMouseOver(true);
        grid1015.setLoadMask(true);
        grid1015.setSelectionModel(cbSelectionModel1015);
        grid1015.setFrame(true);
        grid1015.setStripeRows(true);
        grid1015.setIconCls("grid-icon");

      

        pagingToolbar1015 = new PagingToolbar(store1015);
        pagingToolbar1015.setPageSize(100);
        pagingToolbar1015.setDisplayInfo(true);
          pagingToolbar1015.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar1015.setEmptyMsg("No topics to display");
        pagingToolbar1015.addSeparator();
        
        grid1015.setBottomToolbar(pagingToolbar1015);

        grid1015.setWidth(ANCHO);
        grid1015.setHeight(205);
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
   public void GuardarConfiguracionMarca2() {
     Record[] records = grid1015.getStore().getRecords();
        JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();
        compraObject.put("idmarca", new JSONString(idtraspaso));


        for (int i = 0; i < records.length; i++) {

                productoObject = new JSONObject();
                 productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));

                productos.set(i, productoObject);
                productoObject = null;

        }

        JSONObject resultado = new JSONObject();
        resultado.put("venta", compraObject);
        resultado.put("productos", productos);
        String datos = "resultado=" + resultado.toString();
     //   Utils.setErrorPrincipal("registrando datos", "cargar");
 //String url = "./php/Traspaso.php?funcion=txSaveTraspasoCaja&" + datos;
           String url = "./php/Traspaso.php?funcion=txanularTraspaso&" + datos;

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
                          // Window.alert(mensajeR);
                      //  String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
         close();
            destroy();
             MessageBox.alert("Se anulo correctamente");
             padre.reload();
                        } else {

                         //   Utils.setErrorPrincipal(mensajeR, "error");
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
   

    public int redondedo(float f) {
        int aux = (int) f;
        if (aux < f) {
            aux = aux + 1;
        }
        return aux;
    }
}
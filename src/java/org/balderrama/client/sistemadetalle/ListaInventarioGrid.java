/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;
import com.google.gwt.user.client.Window;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.data.*;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Component;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.QuickTipsConfig;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.event.PanelListenerAdapter;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.NumberField;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.grid.GridEditor;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import com.gwtext.client.widgets.grid.event.*;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.ReporteImagen;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;

/**
 *
 * @author example
 */
public class ListaInventarioGrid {

    public EditorGridPanel grid;
    private final int ALTO = 350;
      private final int ALTO2 = 300;
 //   private ToolbarButton eliminarProducto;
    private ToolbarButton guardarProducto;
     private ToolbarButton seleccionarProducto;
     private ToolbarButton unirProducto;
     private ToolbarButton imagen;
    // private FormularioConsultas formularioConsultas;
    protected ExtElement ext_element;
    public CheckboxSelectionModel cbSelectionModel;
    private Store store;
    private ColumnConfig idColumn;
    private BaseColumnConfig[] columns;
    private ColumnModel columnModel;
    protected String buscaCodigo;
    protected String buscarNombre;
    private DataProxy dataProxy;
    private JsonReader reader;
    PagingToolbar pagingToolbar;
    String selecionado = "";
      String selecionado2 = "";
    private Panel panel;
    private ColumnConfig codigoColumn;
    private ColumnConfig colorColumn;
    private ColumnConfig materialColumn;
    private ColumnConfig lineaColumn;
    private ColumnConfig stylenameColumn;
    private ColumnConfig clienteColumn;
    private ColumnConfig vendedorColumn;
    private ColumnConfig totalparesColumn;
    private ColumnConfig totalcajasColumn;
    private ColumnConfig precioColumn;
    private ColumnConfig preciototalColumn;
    private ColumnConfig talla1Column;
    private ColumnConfig talla1mColumn;
    private ColumnConfig talla2Column;
    private ColumnConfig talla2mColumn;
    private ColumnConfig talla3Column;
    private ColumnConfig talla3mColumn;
    private ColumnConfig talla4Column;
    private ColumnConfig talla4mColumn;
    private ColumnConfig talla5Column;
    private ColumnConfig talla5mColumn;
    private ColumnConfig talla6Column;
    private ColumnConfig talla6mColumn;
    private ColumnConfig talla7Column;
    private ColumnConfig talla7mColumn;
    private ColumnConfig talla8Column;
    private ColumnConfig talla8mColumn;
    private ColumnConfig talla9Column;
    private ColumnConfig talla9mColumn;
    private ColumnConfig talla10Column;
    private ColumnConfig talla10mColumn;
    private ColumnConfig talla11Column;
    private ColumnConfig talla11mColumn;
    private ColumnConfig talla12Column;
    private ColumnConfig talla12mColumn;
    private ColumnConfig talla13Column;
    private ColumnConfig talla13mColumn;
    private ColumnConfig talla14Column;
    private ColumnConfig talla15Column;
    private ColumnConfig talla16Column;
    private ColumnConfig talla17Column;
    private ColumnConfig talla18Column;
    private ColumnConfig talla19Column;
    private ColumnConfig talla20Column;
    private ColumnConfig talla21Column;
    private ColumnConfig talla22Column;
    private ColumnConfig talla23Column;
    private ColumnConfig talla24Column;
    private ColumnConfig talla25Column;
    private ColumnConfig talla26Column;
    private ColumnConfig talla27Column;
    private ColumnConfig talla28Column;
    private ColumnConfig talla29Column;
    private ColumnConfig talla30Column;
    private ColumnConfig talla31Column;
    private ColumnConfig talla32Column;
    private ColumnConfig talla33Column;
    private ColumnConfig talla34Column;
    private ColumnConfig talla35Column;
    private ColumnConfig talla36Column;
    private ColumnConfig talla37Column;
    private ColumnConfig talla38Column;
    private ColumnConfig talla39Column;
    private ColumnConfig talla40Column;
    private ColumnConfig talla41Column;
    private ColumnConfig talla42Column;
    private ColumnConfig talla43Column;
    private ColumnConfig talla44Column;
    private ColumnConfig talla45Column;
    private ColumnConfig preciounitarioColumn;
  private ColumnConfig totalparesbsColumn;
    private ColumnConfig preciooficinaColumn;
   private ColumnConfig fechaColumn;
   private ColumnConfig totalparescajaColumn;
     private ColumnConfig talla;
      private String idpedido;
    //  private String ;
    private String idestilo;
     private String idkardex;
     private String item;
    private String opcion;
    private Object[][] vendedorM;
    private Object[][] colorM;
    private Object[][] materialM;
        private Object[][] clienteM;
     private String[] tipoM;
     String esgestion;
        String[] nombreCaso5Columns = {"idmodelo", "codigo", "material","color","cliente","vendedor", "fecha", "totalcajas","preciooficina","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42",  "totalpares","totalparescaja",  "totalparesbs"};
  String[] nombreCaso55Columns = {"idmodelo", "codigo", "material","color","cliente","vendedor", "fecha","talla","totalcajas","preciooficina","precio","preciounitario","36", "37", "38", "39", "40", "41", "42", "43", "44", "45",  "totalpares","totalparescaja",  "totalparesbs"};
  String[] nombreCaso10Columns = {"idmodelo", "codigo", "cliente","vendedor", "fecha", "totalcajas","preciooficina","precio","preciounitario","14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38",  "totalpares","totalparescaja",  "totalparesbs"};
  String[] nombreCaso13Columns = {"idmodelo", "codigo","material","color", "cliente","vendedor", "fecha", "totalcajas","preciooficina","precio","preciounitario","14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38",  "totalpares","totalparescaja",  "totalparesbs"};

    String[] nombreCaso8Columns = {"idmodelo", "codigo", "material","cliente", "vendedor", "fecha","totalcajas","preciooficina","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalpares","totalparescaja",  "totalparesbs"};
  String[] nombreCaso88Columns = {"idmodelo", "codigo", "cliente","vendedor", "fecha", "totalcajas","preciooficina","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42",  "totalpares","totalparescaja",  "totalparesbs"};
 String[] nombreCaso11Columns = {"idmodelo", "codigo", "color","cliente","vendedor", "fecha", "totalcajas","preciooficina","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalpares","totalparescaja",  "totalparesbs"};
 String[] nombreCaso14Columns = {"idmodelo", "codigo", "color","cliente","vendedor", "fecha", "totalcajas","preciooficina","precio","preciounitario","26", "27", "28", "29", "30", "31", "32","33", "34", "35", "36", "37", "38",  "totalpares","totalparescaja",  "totalparesbs"};

 String[] nombreCaso12Columns = {"idmodelo", "codigo", "color","cliente","vendedor", "fecha", "totalcajas","preciooficina","precio","preciounitario","14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38",  "totalpares","totalparescaja",  "totalparesbs"};
//String[] nombreCaso52Columns = {"idmodelo", "codigo", "material","cliente","vendedor", "fecha", "totalcajas","precio","preciounitario","talla","1", "1m", "2", "2m","3", "3m", "4", "4m", "5", "5m", "6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12","12m", "13", "totalpares","totalparescaja",  "totalparesbs"};

  String[] nombreCaso52Columns = {"idmodelo", "codigo", "material","cliente","vendedor", "fecha", "totalcajas","preciooficina","precio","preciounitario","talla","1", "1m", "2", "2m","3", "3m", "4", "4m", "5", "5m", "6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12","12m", "13", "totalpares","totalparescaja",  "totalparesbs"};
    //String[] nombreCaso99Columns = {"idmodelo", "codigo", "material","cliente", "vendedor", "fecha","totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalpares","totalparescaja",  "totalparesbs"};
     String[] nombreCaso99Columns = {"idmodelo","codigo", "material","color","cliente","vendedor","fecha","talla","totalcajas","precio","preciounitario", "34","35", "36", "37", "38", "39", "40", "totalpares","totalparescaja",  "totalparesbs"};

     String[] nombreCaso51Columns = {"idmodelo", "codigo", "material","cliente", "totalcajas","precio","preciounitario","talla","5", "5m", "6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12",  "totalpares","totalparescaja",  "totalparesbs"};

    private RecordDef recordDef;
    private ColumnConfig coleccionColumn;

   
//ojo 24/11/2016
    public void onModuleLoad5(String idmarca, String idestilos,String idkardex,Object[][] MaterialM1,String gestion,String idcliente,String idvendedor,String iditem) {
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        this.item = iditem;
        this.idkardex = idkardex;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "12";
        this.colorM = MaterialM1;
        this.esgestion= gestion;
dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idalmacen=" + idestilo+ "&idkardex=" + idkardex+ "&gestion=" + esgestion+ "&idcliente=" + idcliente+ "&idvendedor=" + idvendedor+ "&item=" + item);
//dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idalmacen=" + idestilo+ "&idkardex=" + idkardex+ "&gestion=" + esgestion+ "&idcliente=" + idcliente+ "&idvendedor=" + idvendedor);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso5Columns[0]),
                    new StringFieldDef(nombreCaso5Columns[1]),
                    new StringFieldDef(nombreCaso5Columns[2]),
                    new StringFieldDef(nombreCaso5Columns[3]),
                    new StringFieldDef(nombreCaso5Columns[4]),
                    new StringFieldDef(nombreCaso5Columns[5]),
                    new StringFieldDef(nombreCaso5Columns[6]),
                    new FloatFieldDef(nombreCaso5Columns[7]),
                    new FloatFieldDef(nombreCaso5Columns[8]),
                    new FloatFieldDef(nombreCaso5Columns[9]),
                    new FloatFieldDef(nombreCaso5Columns[10]),
                    new FloatFieldDef(nombreCaso5Columns[11]),
                    new FloatFieldDef(nombreCaso5Columns[12]),
                    new FloatFieldDef(nombreCaso5Columns[13]),
                    new FloatFieldDef(nombreCaso5Columns[14]),
                    new FloatFieldDef(nombreCaso5Columns[15]),
                    new FloatFieldDef(nombreCaso5Columns[16]),
                    new FloatFieldDef(nombreCaso5Columns[17]),
                    new FloatFieldDef(nombreCaso5Columns[18]),
                    new FloatFieldDef(nombreCaso5Columns[19]),
                    new FloatFieldDef(nombreCaso5Columns[20]),
                    new FloatFieldDef(nombreCaso5Columns[21]),
                    new FloatFieldDef(nombreCaso5Columns[22]),
                    new FloatFieldDef(nombreCaso5Columns[23])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso5Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso5Columns[1], 100, true);
        materialColumn = new ColumnConfig("Material", nombreCaso5Columns[2], 100, true);
        colorColumn = new ColumnConfig("Color", nombreCaso5Columns[3], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso5Columns[4], 100, true);
        SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, colorM);
        paisStore1.load();
        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);


        clienteColumn.setEditor(new GridEditor(cbVendedor));
    vendedorColumn = new ColumnConfig("Vendedor", nombreCaso5Columns[5], 100, true);
        fechaColumn = new ColumnConfig("Fecha", nombreCaso5Columns[6], 100, true);

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso5Columns[7], 80, true, null);
         preciooficinaColumn = new ColumnConfig("FERIA BS", nombreCaso5Columns[8], 100, true);

        precioColumn = new ColumnConfig("Precio Venta", nombreCaso5Columns[9], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso5Columns[10], 100, true);
        talla33Column = new ColumnConfig("33", nombreCaso5Columns[11], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso5Columns[12], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso5Columns[13], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso5Columns[14], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso5Columns[15], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso5Columns[16], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso5Columns[17], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso5Columns[18], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso5Columns[19], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso5Columns[20], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso5Columns[21], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso5Columns[22], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso5Columns[23], 80, true, null);
 TextField tex_detalle11 = new TextField();
        codigoColumn.setEditor(new GridEditor(tex_detalle11));
    TextField tex_detalle = new TextField();
        colorColumn.setEditor(new GridEditor(tex_detalle));
    TextField tex_detalle12 = new TextField();
        fechaColumn.setEditor(new GridEditor(tex_detalle12));
         TextField tex_detalle1 = new TextField();
        materialColumn.setEditor(new GridEditor(tex_detalle1));
     //   TextField tex_detalle2 = new TextField();
      //  clienteColumn.setEditor(new GridEditor(tex_detalle2));
         preciooficinaColumn.setEditor(new GridEditor(metodoFeli()));
       precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
        talla39Column.setEditor(new GridEditor(metodoFeli()));
        talla40Column.setEditor(new GridEditor(metodoFeli()));
        talla41Column.setEditor(new GridEditor(metodoFeli()));
        talla42Column.setEditor(new GridEditor(metodoFeli()));

        //totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        //totalparesColumn.setEditor(new GridEditor(metodoFeli()));

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    colorColumn,
                    clienteColumn,
                     vendedorColumn,
                      fechaColumn,
                          totalcajasColumn,
                          preciooficinaColumn,
                    precioColumn,
                          preciounitarioColumn,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                    talla39Column,
                    talla40Column,
                    talla41Column,
                    talla42Column,
                   totalparescajaColumn,
                    totalparesbsColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Calzados");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(false);
        grid.setClicksToEdit(1);
//
//        eliminarProducto = new ToolbarButton("Eliminar Modelo");
//        eliminarProducto.setEnableToggle(true);
//        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
//        tipsConfig2.setText("Quitar producto(s)");
//        //tipsConfig.setTitle("Tip Title");
//        eliminarProducto.setTooltip(tipsConfig2);

        guardarProducto = new ToolbarButton("Ver detalle Historial");
        guardarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Guardar cambio(s)");
        guardarProducto.setTooltip(tipsConfig3);

         imagen = new ToolbarButton("Imagen");
        imagen.setEnableToggle(true);
        QuickTipsConfig tipsConfig31 = new QuickTipsConfig();
        tipsConfig31.setText("ver imagen y registro");
        imagen.setTooltip(tipsConfig31);

        seleccionarProducto = new ToolbarButton("Seleccionar/ para cod barra");
        seleccionarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d = new QuickTipsConfig();
        tipsConfig3d.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        seleccionarProducto.setTooltip(tipsConfig3d);

     unirProducto = new ToolbarButton("Unir Modelos");
        unirProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d1 = new QuickTipsConfig();
        tipsConfig3d1.setText("seleccionar modelo(s)");
        //tipsConfig.setTitle("Tip Title");
        unirProducto.setTooltip(tipsConfig3d1);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
        pagingToolbar.addButton(guardarProducto);
 pagingToolbar.addSeparator();
         pagingToolbar.addButton(seleccionarProducto);
 pagingToolbar.addSeparator();
     pagingToolbar.addButton(unirProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(imagen);


        grid.setBottomToolbar(pagingToolbar);
  aniadirListenersProductoEspecial();
       // aniadirListenersProducto();
        panel.add(grid);
    }
 public void onModuleLoad99(String idmarca, String idestilos,String idkardex,Object[][] MaterialM1,String gestion,String idcliente,String idvendedor,String iditem) {
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        this.idkardex = idkardex;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.item = iditem;
        this.opcion = "12";
       // this.tipoM = tipo;
         this.colorM = MaterialM1;
         this.esgestion= gestion;
dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idalmacen=" + idestilo+ "&idkardex=" + idkardex+ "&gestion=" + esgestion+ "&idcliente=" + idcliente+ "&idvendedor=" + idvendedor+ "&item=" + item);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso99Columns[0]),
                    new StringFieldDef(nombreCaso99Columns[1]),
                    new StringFieldDef(nombreCaso99Columns[2]),
                    new StringFieldDef(nombreCaso99Columns[3]),
                    new StringFieldDef(nombreCaso99Columns[4]),
                    new StringFieldDef(nombreCaso99Columns[5]),
                    new StringFieldDef(nombreCaso99Columns[6]),
                    new StringFieldDef(nombreCaso99Columns[7]),
                    new FloatFieldDef(nombreCaso99Columns[8]),
                    new FloatFieldDef(nombreCaso99Columns[9]),
                    new FloatFieldDef(nombreCaso99Columns[10]),
                    new FloatFieldDef(nombreCaso99Columns[11]),
                    new FloatFieldDef(nombreCaso99Columns[12]),
                    new FloatFieldDef(nombreCaso99Columns[13]),
                    new FloatFieldDef(nombreCaso99Columns[14]),
                    new FloatFieldDef(nombreCaso99Columns[15]),
                    new FloatFieldDef(nombreCaso99Columns[16]),
                    new FloatFieldDef(nombreCaso99Columns[17]),
                    new FloatFieldDef(nombreCaso99Columns[18]),
                    new FloatFieldDef(nombreCaso99Columns[19]),
                    new FloatFieldDef(nombreCaso99Columns[20]),
                    new FloatFieldDef(nombreCaso99Columns[21])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
  //      String[] nombreCaso99Columns = {"idmodelo","codigo", "material","color","cliente","vendedor","fecha","talla","totalcajas","precio","preciounitario", "34","35", "36", "37", "38", "39", "40", "totalpares","totalparescaja",  "totalparesbs"};

        idColumn = new ColumnConfig("Id modelo", nombreCaso99Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso99Columns[1], 100, true);
        materialColumn = new ColumnConfig("Material", nombreCaso99Columns[2], 100, true);
        colorColumn = new ColumnConfig("Color", nombreCaso99Columns[3], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso99Columns[4], 100, true);
        SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, colorM);
        paisStore1.load();
        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);


        clienteColumn.setEditor(new GridEditor(cbVendedor));
    vendedorColumn = new ColumnConfig("Vendedor", nombreCaso99Columns[5], 100, true);

        fechaColumn = new ColumnConfig("Ingreso", nombreCaso99Columns[6], 80, true);
     //fechaColumn.setEditor(new GridEditor(metodoFeli()));
  talla = new ColumnConfig("Talla", nombreCaso99Columns[7], 50, true);
//  SimpleStore tiposStore = new SimpleStore("talla", tipoM);
//        tiposStore.load();
//         ComboBox com_cliente = new ComboBox();
//      //  com_cliente.setStore(paisStore1);
//        com_cliente.setDisplayField("talla");
//        com_cliente.setStore(tiposStore);
//  talla.setEditor(new GridEditor(com_cliente));

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso99Columns[8], 65, true, null);
        preciooficinaColumn = new ColumnConfig("FERIA BS", nombreCaso99Columns[8], 100, true);

        precioColumn = new ColumnConfig("Precio Venta", nombreCaso99Columns[9], 100, true);
        preciounitarioColumn = new ColumnConfig("Unit", nombreCaso99Columns[10], 100, true);
         talla34Column = new ColumnConfig("Unidad", nombreCaso99Columns[11], 30, true, null);
        talla35Column = new ColumnConfig("XS", nombreCaso99Columns[12], 30, true, null);
        talla36Column = new ColumnConfig("S", nombreCaso99Columns[13], 30, true, null);
        talla37Column = new ColumnConfig("P", nombreCaso99Columns[14], 30, true, null);
        talla38Column = new ColumnConfig("M", nombreCaso99Columns[15], 30, true, null);
        talla39Column = new ColumnConfig("L", nombreCaso99Columns[16], 30, true, null);
        talla40Column = new ColumnConfig("XL", nombreCaso99Columns[17], 30, true, null);
         totalparesColumn = new ColumnConfig("Tot. Unidades", nombreCaso99Columns[18], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso99Columns[19], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso99Columns[20], 80, true, null);
        
 TextField tex_detalle11 = new TextField();
        codigoColumn.setEditor(new GridEditor(tex_detalle11));

    TextField tex_detalle12 = new TextField();
        fechaColumn.setEditor(new GridEditor(tex_detalle12));
         TextField tex_detalle1 = new TextField();
        materialColumn.setEditor(new GridEditor(tex_detalle1));
     //   TextField tex_detalle2 = new TextField();
      //  clienteColumn.setEditor(new GridEditor(tex_detalle2));
        preciooficinaColumn.setEditor(new GridEditor(metodoFeli()));

       precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
        talla39Column.setEditor(new GridEditor(metodoFeli()));
        talla40Column.setEditor(new GridEditor(metodoFeli()));
       
        //totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        //totalparesColumn.setEditor(new GridEditor(metodoFeli()));

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    colorColumn,
                    clienteColumn,
                    vendedorColumn,
                    fechaColumn,
                     talla,
                    totalcajasColumn,
                    preciooficinaColumn,
                    precioColumn,
                   // preciounitarioColumn,

                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                    talla39Column,
                    talla40Column,
                   totalparescajaColumn,
                    totalparesbsColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Calzados");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(false);
        grid.setClicksToEdit(1);
//
//        eliminarProducto = new ToolbarButton("Eliminar Modelo");
//        eliminarProducto.setEnableToggle(true);
//        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
//        tipsConfig2.setText("Quitar producto(s)");
//        //tipsConfig.setTitle("Tip Title");
//        eliminarProducto.setTooltip(tipsConfig2);

        guardarProducto = new ToolbarButton("Ver detalle");
        guardarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Guardar cambio(s)");
        guardarProducto.setTooltip(tipsConfig3);

 seleccionarProducto = new ToolbarButton("Seleccionar/ para cod barra");
        seleccionarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d = new QuickTipsConfig();
        tipsConfig3d.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        seleccionarProducto.setTooltip(tipsConfig3d);

          unirProducto = new ToolbarButton("Unir Modelos");
        unirProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d1 = new QuickTipsConfig();
        tipsConfig3d1.setText("seleccionar modelo(s)");
        //tipsConfig.setTitle("Tip Title");
        unirProducto.setTooltip(tipsConfig3d1);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        

         imagen = new ToolbarButton("Imagen");
        imagen.setEnableToggle(true);
        QuickTipsConfig tipsConfig31 = new QuickTipsConfig();
        tipsConfig31.setText("ver imagen y registro");
        imagen.setTooltip(tipsConfig31);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
       
        pagingToolbar.addButton(imagen);
//pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();


   pagingToolbar.addButton(seleccionarProducto);
 pagingToolbar.addSeparator();
  pagingToolbar.addButton(unirProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(guardarProducto);


        grid.setBottomToolbar(pagingToolbar);
  aniadirListenersProductoEspecial();
       // aniadirListenersProducto();
        panel.add(grid);
    }

public void onModuleLoad11(String idmarca, String idestilos,String idkardex,Object[][] MaterialM1,String gestion,String idcliente,String idvendedor,String iditem) {
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        this.idkardex = idkardex;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.item = iditem;
        this.opcion = "12";
       // this.tipoM = tipo;
         this.colorM = MaterialM1;
         this.esgestion= gestion;
dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idalmacen=" + idestilo+ "&idkardex=" + idkardex+ "&gestion=" + esgestion+ "&idcliente=" + idcliente+ "&idvendedor=" + idvendedor+ "&item=" + item);
 //String[] nombreCaso11Columns = {"idmodelo", "codigo", "color","cliente","vendedor", "fecha", "totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalpares","totalparescaja",  "totalparesbs"};

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso11Columns[0]),
                    new StringFieldDef(nombreCaso11Columns[1]),
                    new StringFieldDef(nombreCaso11Columns[2]),
                    new StringFieldDef(nombreCaso11Columns[3]),
                    new StringFieldDef(nombreCaso11Columns[4]),
                    new StringFieldDef(nombreCaso11Columns[5]),
                    new FloatFieldDef(nombreCaso11Columns[6]),
                    new FloatFieldDef(nombreCaso11Columns[7]),
                    new FloatFieldDef(nombreCaso11Columns[8]),
                    new FloatFieldDef(nombreCaso11Columns[9]),
                    new FloatFieldDef(nombreCaso11Columns[10]),
                    new FloatFieldDef(nombreCaso11Columns[11]),
                    new FloatFieldDef(nombreCaso11Columns[12]),
                    new FloatFieldDef(nombreCaso11Columns[13]),
                    new FloatFieldDef(nombreCaso11Columns[14]),
                    new FloatFieldDef(nombreCaso11Columns[15]),
                    new FloatFieldDef(nombreCaso11Columns[16]),
                    new FloatFieldDef(nombreCaso11Columns[17]),
                    new FloatFieldDef(nombreCaso11Columns[18]),
                    new FloatFieldDef(nombreCaso11Columns[19]),
                    new FloatFieldDef(nombreCaso11Columns[20]),
                    new FloatFieldDef(nombreCaso11Columns[21]),
                    new FloatFieldDef(nombreCaso11Columns[22]),
                    new FloatFieldDef(nombreCaso11Columns[23]),
                    new FloatFieldDef(nombreCaso11Columns[24]),
                    new FloatFieldDef(nombreCaso11Columns[25])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso11Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso11Columns[1], 100, true);
        materialColumn = new ColumnConfig("Color", nombreCaso11Columns[2], 100, true);
      //  colorColumn = new ColumnConfig("Color", nombreCaso11Columns[3], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso11Columns[3], 100, true);
        SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, colorM);
        paisStore1.load();
        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);


        clienteColumn.setEditor(new GridEditor(cbVendedor));
    vendedorColumn = new ColumnConfig("Vendedor", nombreCaso11Columns[4], 100, true);
        fechaColumn = new ColumnConfig("Fecha", nombreCaso11Columns[5], 100, true);

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso11Columns[6], 80, true, null);
        preciooficinaColumn = new ColumnConfig("FERIA BS", nombreCaso11Columns[7], 100, true);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso11Columns[8], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso11Columns[9], 100, true);
        talla33Column = new ColumnConfig("33", nombreCaso11Columns[10], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso11Columns[11], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso11Columns[12], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso11Columns[13], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso11Columns[14], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso11Columns[15], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso11Columns[16], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso11Columns[17], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso11Columns[18], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso11Columns[19], 30, true, null);
        talla43Column = new ColumnConfig("43", nombreCaso11Columns[20], 30, true, null);
        talla44Column = new ColumnConfig("44", nombreCaso11Columns[21], 30, true, null);
        talla45Column = new ColumnConfig("45", nombreCaso11Columns[22], 30, true, null);

        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso11Columns[23], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso11Columns[24], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso11Columns[25], 80, true, null);
 TextField tex_detalle11 = new TextField();
        codigoColumn.setEditor(new GridEditor(tex_detalle11));

    TextField tex_detalle12 = new TextField();
        fechaColumn.setEditor(new GridEditor(tex_detalle12));
         TextField tex_detalle1 = new TextField();
        materialColumn.setEditor(new GridEditor(tex_detalle1));
     //   TextField tex_detalle2 = new TextField();
      //  clienteColumn.setEditor(new GridEditor(tex_detalle2));
         preciooficinaColumn.setEditor(new GridEditor(metodoFeli()));

       precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
        talla39Column.setEditor(new GridEditor(metodoFeli()));
        talla40Column.setEditor(new GridEditor(metodoFeli()));
        talla41Column.setEditor(new GridEditor(metodoFeli()));
        talla42Column.setEditor(new GridEditor(metodoFeli()));
 talla43Column.setEditor(new GridEditor(metodoFeli()));
        talla44Column.setEditor(new GridEditor(metodoFeli()));
        talla45Column.setEditor(new GridEditor(metodoFeli()));
        //totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        //totalparesColumn.setEditor(new GridEditor(metodoFeli()));

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                  
                    clienteColumn,
                     vendedorColumn,
                      fechaColumn,
                          totalcajasColumn,
                   //       preciooficinaColumn,
                    precioColumn,
                   preciounitarioColumn,
                  
                   talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                    talla39Column,
                    talla40Column,
                    talla41Column,
                    talla42Column,
                    totalparescajaColumn,
                    totalparesbsColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Calzados");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(false);
        grid.setClicksToEdit(1);

//        eliminarProducto = new ToolbarButton("Eliminar Modelo");
//        eliminarProducto.setEnableToggle(true);
//        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
//        tipsConfig2.setText("Quitar producto(s)");
//        //tipsConfig.setTitle("Tip Title");
//        eliminarProducto.setTooltip(tipsConfig2);

        guardarProducto = new ToolbarButton("Ver detalle");
        guardarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Guardar cambio(s)");
        guardarProducto.setTooltip(tipsConfig3);
 seleccionarProducto = new ToolbarButton("Seleccionar/ para cod barra");
        seleccionarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d = new QuickTipsConfig();
        tipsConfig3d.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        seleccionarProducto.setTooltip(tipsConfig3d);

 unirProducto = new ToolbarButton("Unir Modelos");
        unirProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d1 = new QuickTipsConfig();
        tipsConfig3d1.setText("seleccionar modelo(s)");
        //tipsConfig.setTitle("Tip Title");
        unirProducto.setTooltip(tipsConfig3d1);

         imagen = new ToolbarButton("Imagen");
        imagen.setEnableToggle(true);
        QuickTipsConfig tipsConfig31 = new QuickTipsConfig();
        tipsConfig31.setText("ver imagen y registro");
        imagen.setTooltip(tipsConfig31);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
        pagingToolbar.addButton(guardarProducto);

 pagingToolbar.addSeparator();


   pagingToolbar.addButton(seleccionarProducto);
 pagingToolbar.addSeparator();
 pagingToolbar.addButton(unirProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(imagen);


        grid.setBottomToolbar(pagingToolbar);
  aniadirListenersProductoEspecial();
       // aniadirListenersProducto();
        panel.add(grid);
    }

public void onModuleLoad14(String idmarca, String idestilos,String idkardex,Object[][] MaterialM1,String gestion,String idcliente,String idvendedor,String iditem) {
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        this.idkardex = idkardex;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.item = iditem;
        this.opcion = "12";
       // this.tipoM = tipo;
         this.colorM = MaterialM1;
         this.esgestion= gestion;
dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idalmacen=" + idestilo+ "&idkardex=" + idkardex+ "&gestion=" + esgestion+ "&idcliente=" + idcliente+ "&idvendedor=" + idvendedor+ "&item=" + item);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso14Columns[0]),
                    new StringFieldDef(nombreCaso14Columns[1]),
                    new StringFieldDef(nombreCaso14Columns[2]),
                    new StringFieldDef(nombreCaso14Columns[3]),
                    new StringFieldDef(nombreCaso14Columns[4]),
                    new StringFieldDef(nombreCaso14Columns[5]),
                    new FloatFieldDef(nombreCaso14Columns[6]),
                    new FloatFieldDef(nombreCaso14Columns[7]),
                    new FloatFieldDef(nombreCaso14Columns[8]),
                    new FloatFieldDef(nombreCaso14Columns[9]),
                    new FloatFieldDef(nombreCaso14Columns[10]),
                    new FloatFieldDef(nombreCaso14Columns[11]),
                    new FloatFieldDef(nombreCaso14Columns[12]),
                    new FloatFieldDef(nombreCaso14Columns[13]),
                    new FloatFieldDef(nombreCaso14Columns[14]),
                    new FloatFieldDef(nombreCaso14Columns[15]),
                    new FloatFieldDef(nombreCaso14Columns[16]),
                    new FloatFieldDef(nombreCaso14Columns[17]),
                    new FloatFieldDef(nombreCaso14Columns[18]),
                    new FloatFieldDef(nombreCaso14Columns[19]),
                    new FloatFieldDef(nombreCaso14Columns[20]),
                    new FloatFieldDef(nombreCaso14Columns[21]),
                    new FloatFieldDef(nombreCaso14Columns[22]),
                    new FloatFieldDef(nombreCaso14Columns[23]),
                    new FloatFieldDef(nombreCaso14Columns[24]),
                    new FloatFieldDef(nombreCaso14Columns[25])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso14Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso14Columns[1], 100, true);
        materialColumn = new ColumnConfig("Color", nombreCaso14Columns[2], 100, true);
      //  colorColumn = new ColumnConfig("Color", nombreCaso14Columns[3], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso14Columns[3], 100, true);
        SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, colorM);
        paisStore1.load();
        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);


        clienteColumn.setEditor(new GridEditor(cbVendedor));
    vendedorColumn = new ColumnConfig("Vendedor", nombreCaso14Columns[4], 100, true);
        fechaColumn = new ColumnConfig("Fecha", nombreCaso14Columns[5], 100, true);

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso14Columns[6], 80, true, null);
        preciooficinaColumn = new ColumnConfig("FERIA BS", nombreCaso14Columns[7], 100, true);

        precioColumn = new ColumnConfig("Precio Venta", nombreCaso14Columns[8], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso14Columns[9], 100, true);
        talla33Column = new ColumnConfig("26", nombreCaso14Columns[10], 30, true, null);
        talla34Column = new ColumnConfig("27", nombreCaso14Columns[11], 30, true, null);
        talla35Column = new ColumnConfig("28", nombreCaso14Columns[12], 30, true, null);
        talla36Column = new ColumnConfig("29", nombreCaso14Columns[13], 30, true, null);
        talla37Column = new ColumnConfig("30", nombreCaso14Columns[14], 30, true, null);
        talla38Column = new ColumnConfig("31", nombreCaso14Columns[15], 30, true, null);
        talla39Column = new ColumnConfig("32", nombreCaso14Columns[16], 30, true, null);
        talla40Column = new ColumnConfig("33", nombreCaso14Columns[17], 30, true, null);
        talla41Column = new ColumnConfig("34", nombreCaso14Columns[18], 30, true, null);
        talla42Column = new ColumnConfig("35", nombreCaso14Columns[19], 30, true, null);
        talla43Column = new ColumnConfig("36", nombreCaso14Columns[20], 30, true, null);
        talla44Column = new ColumnConfig("37", nombreCaso14Columns[21], 30, true, null);
        talla45Column = new ColumnConfig("38", nombreCaso14Columns[22], 30, true, null);

        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso14Columns[23], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso14Columns[24], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso14Columns[25], 80, true, null);
 TextField tex_detalle11 = new TextField();
        codigoColumn.setEditor(new GridEditor(tex_detalle11));

    TextField tex_detalle12 = new TextField();
        fechaColumn.setEditor(new GridEditor(tex_detalle12));
         TextField tex_detalle1 = new TextField();
        materialColumn.setEditor(new GridEditor(tex_detalle1));
     //   TextField tex_detalle2 = new TextField();
      //  clienteColumn.setEditor(new GridEditor(tex_detalle2));
         preciooficinaColumn.setEditor(new GridEditor(metodoFeli()));

       precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
        talla39Column.setEditor(new GridEditor(metodoFeli()));
        talla40Column.setEditor(new GridEditor(metodoFeli()));
        talla41Column.setEditor(new GridEditor(metodoFeli()));
        talla42Column.setEditor(new GridEditor(metodoFeli()));
 talla43Column.setEditor(new GridEditor(metodoFeli()));
        talla44Column.setEditor(new GridEditor(metodoFeli()));
        talla45Column.setEditor(new GridEditor(metodoFeli()));
        //totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        //totalparesColumn.setEditor(new GridEditor(metodoFeli()));

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                   // colorColumn,
                    clienteColumn,
                     vendedorColumn,
                      fechaColumn,
                          totalcajasColumn,
                          preciooficinaColumn,
                    precioColumn,
                          preciounitarioColumn,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                    talla39Column,
                    talla40Column,
                    talla41Column,
                    talla42Column,
                     talla43Column,
                    talla44Column,
                    talla45Column,
                   totalparescajaColumn,
                    totalparesbsColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Calzados");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(false);
        grid.setClicksToEdit(1);

//        eliminarProducto = new ToolbarButton("Eliminar Modelo");
//        eliminarProducto.setEnableToggle(true);
//        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
//        tipsConfig2.setText("Quitar producto(s)");
//        //tipsConfig.setTitle("Tip Title");
//        eliminarProducto.setTooltip(tipsConfig2);

        guardarProducto = new ToolbarButton("Ver detalle");
        guardarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Guardar cambio(s)");
        guardarProducto.setTooltip(tipsConfig3);
 seleccionarProducto = new ToolbarButton("Seleccionar/ para cod barra");
        seleccionarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d = new QuickTipsConfig();
        tipsConfig3d.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        seleccionarProducto.setTooltip(tipsConfig3d);

 unirProducto = new ToolbarButton("Unir Modelos");
        unirProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d1 = new QuickTipsConfig();
        tipsConfig3d1.setText("seleccionar modelo(s)");
        //tipsConfig.setTitle("Tip Title");
        unirProducto.setTooltip(tipsConfig3d1);

         imagen = new ToolbarButton("Imagen");
        imagen.setEnableToggle(true);
        QuickTipsConfig tipsConfig31 = new QuickTipsConfig();
        tipsConfig31.setText("ver imagen y registro");
        imagen.setTooltip(tipsConfig31);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
 pagingToolbar.addButton(unirProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(guardarProducto);

 pagingToolbar.addSeparator();


   pagingToolbar.addButton(seleccionarProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(imagen);


        grid.setBottomToolbar(pagingToolbar);
  aniadirListenersProductoEspecial();
       // aniadirListenersProducto();
        panel.add(grid);
    }



    public void onModuleLoad88(String idmarca, String idestilos,String idkardex,Object[][] MaterialM1,String gestion,String idcliente,String idvendedor,String iditem) {
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        this.idkardex = idkardex;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "12";
       // this.tipoM = tipo;
         this.colorM = MaterialM1;
         this.esgestion= gestion;
         this.item = iditem;
dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idalmacen=" + idestilo+ "&idkardex=" + idkardex+ "&gestion=" + esgestion+ "&idcliente=" + idcliente+ "&idvendedor=" + idvendedor+ "&item=" + item);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso88Columns[0]),
                    new StringFieldDef(nombreCaso88Columns[1]),
                    new StringFieldDef(nombreCaso88Columns[2]),
                    new StringFieldDef(nombreCaso88Columns[3]),
                    new StringFieldDef(nombreCaso88Columns[4]),
                    new FloatFieldDef(nombreCaso88Columns[5]),
                    new FloatFieldDef(nombreCaso88Columns[6]),
                    new FloatFieldDef(nombreCaso88Columns[7]),
                    new FloatFieldDef(nombreCaso88Columns[8]),
                    new FloatFieldDef(nombreCaso88Columns[9]),
                    new FloatFieldDef(nombreCaso88Columns[10]),
                    new FloatFieldDef(nombreCaso88Columns[11]),
                    new FloatFieldDef(nombreCaso88Columns[12]),
                    new FloatFieldDef(nombreCaso88Columns[13]),
                    new FloatFieldDef(nombreCaso88Columns[14]),
                    new FloatFieldDef(nombreCaso88Columns[15]),
                    new FloatFieldDef(nombreCaso88Columns[16]),
                    new FloatFieldDef(nombreCaso88Columns[17]),
                    new FloatFieldDef(nombreCaso88Columns[18]),
                    new FloatFieldDef(nombreCaso88Columns[19]),
                    new FloatFieldDef(nombreCaso88Columns[20]),
                    new FloatFieldDef(nombreCaso88Columns[21])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso88Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso88Columns[1], 100, true);
           clienteColumn = new ColumnConfig("Cliente", nombreCaso88Columns[2], 100, true);
        SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, colorM);
        paisStore1.load();
        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);


        clienteColumn.setEditor(new GridEditor(cbVendedor));
    vendedorColumn = new ColumnConfig("Vendedor", nombreCaso88Columns[3], 100, true);
    fechaColumn = new ColumnConfig("Fecha", nombreCaso88Columns[4], 100, true);

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso88Columns[5], 80, true, null);
         preciooficinaColumn = new ColumnConfig("FERIA BS", nombreCaso88Columns[6], 100, true);

        precioColumn = new ColumnConfig("Precio Venta", nombreCaso88Columns[7], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso88Columns[8], 100, true);
        talla33Column = new ColumnConfig("33", nombreCaso88Columns[9], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso88Columns[10], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso88Columns[11], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso88Columns[12], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso88Columns[13], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso88Columns[14], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso88Columns[15], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso88Columns[16], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso88Columns[17], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso88Columns[18], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso88Columns[19], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso88Columns[20], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso88Columns[21], 80, true, null);
 TextField tex_detalle11 = new TextField();
        codigoColumn.setEditor(new GridEditor(tex_detalle11));

    TextField tex_detalle12 = new TextField();
        fechaColumn.setEditor(new GridEditor(tex_detalle12));
preciooficinaColumn.setEditor(new GridEditor(metodoFeli()));
       precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
        talla39Column.setEditor(new GridEditor(metodoFeli()));
        talla40Column.setEditor(new GridEditor(metodoFeli()));
        talla41Column.setEditor(new GridEditor(metodoFeli()));
        talla42Column.setEditor(new GridEditor(metodoFeli()));

        //totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        //totalparesColumn.setEditor(new GridEditor(metodoFeli()));

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    clienteColumn,
                     vendedorColumn,
                      fechaColumn,
                          totalcajasColumn,
                          preciooficinaColumn,
                    precioColumn,
                          preciounitarioColumn,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                    talla39Column,
                    talla40Column,
                    talla41Column,
                    talla42Column,
                   totalparescajaColumn,
                    totalparesbsColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Calzados");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(false);
        grid.setClicksToEdit(1);

//        eliminarProducto = new ToolbarButton("Eliminar Modelo");
//        eliminarProducto.setEnableToggle(true);
//        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
//        tipsConfig2.setText("Quitar producto(s)");
//        //tipsConfig.setTitle("Tip Title");
//        eliminarProducto.setTooltip(tipsConfig2);

        guardarProducto = new ToolbarButton("Ver detalle");
        guardarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Guardar cambio(s)");
        guardarProducto.setTooltip(tipsConfig3);


 seleccionarProducto = new ToolbarButton("Seleccionar/ para cod barra");
        seleccionarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d = new QuickTipsConfig();
        tipsConfig3d.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        seleccionarProducto.setTooltip(tipsConfig3d);

 unirProducto = new ToolbarButton("Unir Modelos");
        unirProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d1 = new QuickTipsConfig();
        tipsConfig3d1.setText("seleccionar modelo(s)");
        //tipsConfig.setTitle("Tip Title");
        unirProducto.setTooltip(tipsConfig3d1);

         imagen = new ToolbarButton("Imagen");
        imagen.setEnableToggle(true);
        QuickTipsConfig tipsConfig31 = new QuickTipsConfig();
        tipsConfig31.setText("ver imagen y registro");
        imagen.setTooltip(tipsConfig31);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
        pagingToolbar.addButton(guardarProducto);

 pagingToolbar.addSeparator();

   pagingToolbar.addButton(seleccionarProducto);
 pagingToolbar.addSeparator();

 pagingToolbar.addButton(unirProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(imagen);


        grid.setBottomToolbar(pagingToolbar);
  aniadirListenersProductoEspecial();
       // aniadirListenersProducto();
        panel.add(grid);
    }

    public void onModuleLoad55(String idmarca, String idestilos,String idkardex,Object[][] MaterialM1,String gestion,String idcliente,String idvendedor,String iditem) {
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        this.idkardex = idkardex;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "12";
       // this.tipoM = tipo;
        this.item = iditem;
         this.colorM = MaterialM1;
         this.esgestion= gestion;
dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idalmacen=" + idestilo+ "&idkardex=" + idkardex+ "&gestion=" + esgestion+ "&idcliente=" + idcliente+ "&idvendedor=" + idvendedor+ "&item=" + item);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso55Columns[0]),
                    new StringFieldDef(nombreCaso55Columns[1]),
                    new StringFieldDef(nombreCaso55Columns[2]),
                    new StringFieldDef(nombreCaso55Columns[3]),
                    new StringFieldDef(nombreCaso55Columns[4]),
                    new StringFieldDef(nombreCaso55Columns[5]),
                    new StringFieldDef(nombreCaso55Columns[6]),
                    new StringFieldDef(nombreCaso55Columns[7]),
                    new FloatFieldDef(nombreCaso55Columns[8]),
                    new FloatFieldDef(nombreCaso55Columns[9]),
                    new FloatFieldDef(nombreCaso55Columns[10]),
                    new FloatFieldDef(nombreCaso55Columns[11]),
                    new FloatFieldDef(nombreCaso55Columns[12]),
                    new FloatFieldDef(nombreCaso55Columns[13]),
                    new FloatFieldDef(nombreCaso55Columns[14]),
                    new FloatFieldDef(nombreCaso55Columns[15]),
                    new FloatFieldDef(nombreCaso55Columns[16]),
                    new FloatFieldDef(nombreCaso55Columns[17]),
                    new FloatFieldDef(nombreCaso55Columns[18]),
                    new FloatFieldDef(nombreCaso55Columns[19]),
                    new FloatFieldDef(nombreCaso55Columns[20]),
                    new FloatFieldDef(nombreCaso55Columns[21]),
                    new FloatFieldDef(nombreCaso55Columns[22]),
                    new FloatFieldDef(nombreCaso55Columns[23]),
                    new FloatFieldDef(nombreCaso55Columns[24])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso55Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso55Columns[1], 100, true);
        materialColumn = new ColumnConfig("Material", nombreCaso55Columns[2], 100, true);
        colorColumn = new ColumnConfig("Color", nombreCaso55Columns[3], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso55Columns[4], 100, true);
         SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, colorM);
        //SimpleStore paisStore = new SimpleStore(new String[]{"idcliente", "codigo"},nombreCaso3Columns[2]);
        paisStore1.load();

        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);


        clienteColumn.setEditor(new GridEditor(cbVendedor));
    vendedorColumn = new ColumnConfig("Vendedor", nombreCaso55Columns[5], 100, true);
        fechaColumn = new ColumnConfig("Ingreso", nombreCaso55Columns[6], 100, true);
 talla = new ColumnConfig("Talla", nombreCaso55Columns[7], 40, true);

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso55Columns[8], 80, true, null);
    preciooficinaColumn = new ColumnConfig("FERIA BS", nombreCaso55Columns[9], 100, true);

        precioColumn = new ColumnConfig("Precio Venta", nombreCaso55Columns[10], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso55Columns[11], 100, true);
       
        talla36Column = new ColumnConfig("36", nombreCaso55Columns[12], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso55Columns[13], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso55Columns[14], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso55Columns[15], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso55Columns[16], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso55Columns[17], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso55Columns[18], 30, true, null);

        talla43Column = new ColumnConfig("43", nombreCaso55Columns[19], 30, true, null);
        talla44Column = new ColumnConfig("44", nombreCaso55Columns[20], 30, true, null);
        talla45Column = new ColumnConfig("45", nombreCaso55Columns[21], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso55Columns[22], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso55Columns[23], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso55Columns[24], 80, true, null);
 TextField tex_detalle15 = new TextField();
        talla.setEditor(new GridEditor(tex_detalle15));
        TextField tex_detalle5 = new TextField();
        codigoColumn.setEditor(new GridEditor(tex_detalle5));
    TextField tex_detalle = new TextField();
        colorColumn.setEditor(new GridEditor(tex_detalle));
    TextField tex_detalle12 = new TextField();
        fechaColumn.setEditor(new GridEditor(tex_detalle12));
         TextField tex_detalle1 = new TextField();
        materialColumn.setEditor(new GridEditor(tex_detalle1));
     //   TextField tex_detalle2 = new TextField();
      //  clienteColumn.setEditor(new GridEditor(tex_detalle2));
        preciooficinaColumn.setEditor(new GridEditor(metodoFeli()));
       precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
      
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
        talla39Column.setEditor(new GridEditor(metodoFeli()));
        talla40Column.setEditor(new GridEditor(metodoFeli()));
        talla41Column.setEditor(new GridEditor(metodoFeli()));
        talla42Column.setEditor(new GridEditor(metodoFeli()));
  talla43Column.setEditor(new GridEditor(metodoFeli()));
        talla44Column.setEditor(new GridEditor(metodoFeli()));
        talla45Column.setEditor(new GridEditor(metodoFeli()));

       // totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        //totalparesColumn.setEditor(new GridEditor(metodoFeli()));

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    colorColumn,
                    clienteColumn,
                     vendedorColumn,
                      fechaColumn,
                      talla,
                          totalcajasColumn,
                          preciooficinaColumn,
                    precioColumn,
                          preciounitarioColumn,
                   
                    talla36Column,
                    talla37Column,
                    talla38Column,
                    talla39Column,
                    talla40Column,
                    talla41Column,
                    talla42Column,
                     talla43Column,
                    talla44Column,
                    talla45Column,

                   totalparescajaColumn,
                    totalparesbsColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Calzados");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(false);
        grid.setClicksToEdit(1);

//        eliminarProducto = new ToolbarButton("Eliminar Modelo");
//        eliminarProducto.setEnableToggle(true);
//        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
//        tipsConfig2.setText("Quitar producto(s)");
//        //tipsConfig.setTitle("Tip Title");
//        eliminarProducto.setTooltip(tipsConfig2);

        guardarProducto = new ToolbarButton("VEr DEtalle");
        guardarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("VER(s)");
        guardarProducto.setTooltip(tipsConfig3);


 seleccionarProducto = new ToolbarButton("Seleccionar/ para cod barra");
        seleccionarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d = new QuickTipsConfig();
        tipsConfig3d.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        seleccionarProducto.setTooltip(tipsConfig3d);

        unirProducto = new ToolbarButton("Unir Modelos");
        unirProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d1 = new QuickTipsConfig();
        tipsConfig3d1.setText("seleccionar modelo(s)");
        //tipsConfig.setTitle("Tip Title");
        unirProducto.setTooltip(tipsConfig3d1);

         imagen = new ToolbarButton("Imagen");
        imagen.setEnableToggle(true);
        QuickTipsConfig tipsConfig31 = new QuickTipsConfig();
        tipsConfig31.setText("ver imagen y registro");
        imagen.setTooltip(tipsConfig31);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
        pagingToolbar.addButton(guardarProducto);

 pagingToolbar.addSeparator();
  pagingToolbar.addButton(seleccionarProducto);
 pagingToolbar.addSeparator();
  pagingToolbar.addButton(unirProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(imagen);


        grid.setBottomToolbar(pagingToolbar);
  aniadirListenersProductoEspecial();
       // aniadirListenersProducto();
        panel.add(grid);
    }

   
 
    public void onModuleLoad10(String idmarca, String idestilos,String idkardex,Object[][] MaterialM1,String gestion,String idcliente,String idvendedor,String iditem) {
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        this.idkardex = idkardex;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.item = iditem;
        this.opcion = "12";
       // this.tipoM = tipo;
         this.colorM = MaterialM1;
         this.esgestion= gestion;
dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idalmacen=" + idestilo+ "&idkardex=" + idkardex+ "&gestion=" + esgestion+ "&idcliente=" + idcliente+ "&idvendedor=" + idvendedor+ "&item=" + item);

        recordDef = new RecordDef(new FieldDef[]{
                  new StringFieldDef(nombreCaso10Columns[0]),
                    new StringFieldDef(nombreCaso10Columns[1]),
                    new StringFieldDef(nombreCaso10Columns[2]),
                    new StringFieldDef(nombreCaso10Columns[3]),
                    new StringFieldDef(nombreCaso10Columns[4]),
                    new FloatFieldDef(nombreCaso10Columns[5]),
                    new FloatFieldDef(nombreCaso10Columns[6]),
                    new FloatFieldDef(nombreCaso10Columns[7]),
                    new FloatFieldDef(nombreCaso10Columns[8]),
                    new FloatFieldDef(nombreCaso10Columns[9]),
                    new FloatFieldDef(nombreCaso10Columns[10]),
                    new FloatFieldDef(nombreCaso10Columns[11]),
                    new FloatFieldDef(nombreCaso10Columns[12]),
                    new FloatFieldDef(nombreCaso10Columns[13]),
                    new FloatFieldDef(nombreCaso10Columns[14]),
                    new FloatFieldDef(nombreCaso10Columns[15]),
                    new FloatFieldDef(nombreCaso10Columns[16]),
                    new FloatFieldDef(nombreCaso10Columns[17]),
                    new FloatFieldDef(nombreCaso10Columns[18]),
                    new FloatFieldDef(nombreCaso10Columns[19]),
                    new FloatFieldDef(nombreCaso10Columns[20]),
                    new FloatFieldDef(nombreCaso10Columns[21]),
                    new FloatFieldDef(nombreCaso10Columns[22]),
                    new FloatFieldDef(nombreCaso10Columns[23]),
                    new FloatFieldDef(nombreCaso10Columns[24]),
                    new FloatFieldDef(nombreCaso10Columns[25]),
                    new FloatFieldDef(nombreCaso10Columns[26]),
                    new FloatFieldDef(nombreCaso10Columns[27]),
                    new FloatFieldDef(nombreCaso10Columns[28]),
                    new FloatFieldDef(nombreCaso10Columns[29]),
                    new FloatFieldDef(nombreCaso10Columns[30]),
                    new FloatFieldDef(nombreCaso10Columns[31]),
                    new FloatFieldDef(nombreCaso10Columns[32]),
                    new FloatFieldDef(nombreCaso10Columns[33]),
                    new FloatFieldDef(nombreCaso10Columns[34]),
                    new FloatFieldDef(nombreCaso10Columns[35]),
                    new FloatFieldDef(nombreCaso10Columns[36])

                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso10Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso10Columns[1], 100, true);
         clienteColumn = new ColumnConfig("Cliente", nombreCaso10Columns[2], 100, true);
         SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, colorM);
        //SimpleStore paisStore = new SimpleStore(new String[]{"idcliente", "codigo"},nombreCaso3Columns[2]);
        paisStore1.load();

        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);


        clienteColumn.setEditor(new GridEditor(cbVendedor));
    vendedorColumn = new ColumnConfig("Vendedor", nombreCaso10Columns[3], 100, true);
        fechaColumn = new ColumnConfig("Ingreso", nombreCaso10Columns[4], 100, true);

           totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso10Columns[5], 80, true, null);
           preciooficinaColumn = new ColumnConfig("FERIA BS", nombreCaso10Columns[6], 100, true);

        precioColumn = new ColumnConfig("Precio Venta", nombreCaso10Columns[7], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso10Columns[8], 100, true);
        talla14Column = new ColumnConfig("14", nombreCaso10Columns[9], 30, true, null);
        talla15Column = new ColumnConfig("15", nombreCaso10Columns[10], 30, true, null);
        talla16Column = new ColumnConfig("16", nombreCaso10Columns[11], 30, true, null);
        talla17Column = new ColumnConfig("17", nombreCaso10Columns[12], 30, true, null);
        talla18Column = new ColumnConfig("18", nombreCaso10Columns[13], 30, true, null);
        talla19Column = new ColumnConfig("19", nombreCaso10Columns[14], 30, true, null);
        talla20Column = new ColumnConfig("20", nombreCaso10Columns[15], 30, true, null);
        talla21Column = new ColumnConfig("21", nombreCaso10Columns[16], 30, true, null);
        talla22Column = new ColumnConfig("22", nombreCaso10Columns[17], 30, true, null);
        talla23Column = new ColumnConfig("23", nombreCaso10Columns[18], 30, true, null);
        talla24Column = new ColumnConfig("24", nombreCaso10Columns[19], 30, true, null);
        talla25Column = new ColumnConfig("25", nombreCaso10Columns[20], 30, true, null);
        talla26Column = new ColumnConfig("26", nombreCaso10Columns[21], 30, true, null);
        talla27Column = new ColumnConfig("27", nombreCaso10Columns[22], 30, true, null);
        talla28Column = new ColumnConfig("28", nombreCaso10Columns[23], 30, true, null);
        talla29Column = new ColumnConfig("29", nombreCaso10Columns[24], 30, true, null);
        talla30Column = new ColumnConfig("30", nombreCaso10Columns[25], 30, true, null);
        talla31Column = new ColumnConfig("31", nombreCaso10Columns[26], 30, true, null);
        // talla31Column = new ColumnConfig("21", nombreCso1Columns[10], 200, true, null);
        talla32Column = new ColumnConfig("32", nombreCaso10Columns[27], 30, true, null);
        talla33Column = new ColumnConfig("33", nombreCaso10Columns[28], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso10Columns[29], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso10Columns[30], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso10Columns[31], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso10Columns[32], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso10Columns[33], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso10Columns[34], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso10Columns[35], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso10Columns[36], 80, true, null);



        TextField tex_detalle5 = new TextField();
        codigoColumn.setEditor(new GridEditor(tex_detalle5));

    TextField tex_detalle12 = new TextField();
        fechaColumn.setEditor(new GridEditor(tex_detalle12));
preciooficinaColumn.setEditor(new GridEditor(metodoFeli()));

       precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));

       talla14Column.setEditor(new GridEditor(metodoFeli()));
        talla15Column.setEditor(new GridEditor(metodoFeli()));
        talla16Column.setEditor(new GridEditor(metodoFeli()));
        talla17Column.setEditor(new GridEditor(metodoFeli()));
        talla18Column.setEditor(new GridEditor(metodoFeli()));
        talla19Column.setEditor(new GridEditor(metodoFeli()));
        talla20Column.setEditor(new GridEditor(metodoFeli()));
        talla21Column.setEditor(new GridEditor(metodoFeli()));
        talla22Column.setEditor(new GridEditor(metodoFeli()));
        talla23Column.setEditor(new GridEditor(metodoFeli()));
        talla24Column.setEditor(new GridEditor(metodoFeli()));
        talla25Column.setEditor(new GridEditor(metodoFeli()));
        talla26Column.setEditor(new GridEditor(metodoFeli()));
        talla27Column.setEditor(new GridEditor(metodoFeli()));
        talla28Column.setEditor(new GridEditor(metodoFeli()));
        talla29Column.setEditor(new GridEditor(metodoFeli()));
        talla30Column.setEditor(new GridEditor(metodoFeli()));
        talla31Column.setEditor(new GridEditor(metodoFeli()));
        talla32Column.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,

                    clienteColumn,
                     vendedorColumn,
                      fechaColumn,

                          totalcajasColumn,
                          preciooficinaColumn,
                    precioColumn,
                          preciounitarioColumn,
                           talla14Column,
                    talla15Column,
                    talla16Column,
                    talla17Column,
                    talla18Column,
                    talla19Column,
                    talla20Column,
                    talla21Column,
                    talla22Column,
                    talla23Column,
                    talla24Column,
                    talla25Column,
                    talla26Column,
                    talla27Column,
                    talla28Column,
                    talla29Column,
                    talla30Column,
                    talla31Column,
                    talla32Column,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,

                   totalparescajaColumn,
                    totalparesbsColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Calzados");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(false);
        grid.setClicksToEdit(1);

//        eliminarProducto = new ToolbarButton("Eliminar Modelo");
//        eliminarProducto.setEnableToggle(true);
//        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
//        tipsConfig2.setText("Quitar producto(s)");
//        //tipsConfig.setTitle("Tip Title");
//        eliminarProducto.setTooltip(tipsConfig2);

        guardarProducto = new ToolbarButton("Ver detalle");
        guardarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Guardar cambio(s)");
        guardarProducto.setTooltip(tipsConfig3);

 seleccionarProducto = new ToolbarButton("Seleccionar/ para cod barra");
        seleccionarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d = new QuickTipsConfig();
        tipsConfig3d.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        seleccionarProducto.setTooltip(tipsConfig3d);

         unirProducto = new ToolbarButton("Unir Modelos");
        unirProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d1 = new QuickTipsConfig();
        tipsConfig3d1.setText("seleccionar modelo(s)");
        //tipsConfig.setTitle("Tip Title");
        unirProducto.setTooltip(tipsConfig3d1);

         imagen = new ToolbarButton("Imagen");
        imagen.setEnableToggle(true);
        QuickTipsConfig tipsConfig31 = new QuickTipsConfig();
        tipsConfig31.setText("ver imagen y registro");
        imagen.setTooltip(tipsConfig31);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
        pagingToolbar.addButton(guardarProducto);

 pagingToolbar.addSeparator();

   pagingToolbar.addButton(seleccionarProducto);
 pagingToolbar.addSeparator();
 pagingToolbar.addButton(unirProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(imagen);


        grid.setBottomToolbar(pagingToolbar);
  aniadirListenersProductoEspecial();
       // aniadirListenersProducto();
        panel.add(grid);
    }
      public void onModuleLoad12(String idmarca, String idestilos,String idkardex,Object[][] MaterialM1,String gestion,String idcliente,String idvendedor,String iditem) {
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        this.idkardex = idkardex;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.item = iditem;
        this.opcion = "12";
       // this.tipoM = tipo;
         this.colorM = MaterialM1;
         this.esgestion= gestion;
dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idalmacen=" + idestilo+ "&idkardex=" + idkardex+ "&gestion=" + esgestion+ "&idcliente=" + idcliente+ "&idvendedor=" + idvendedor+ "&item=" + item);

        recordDef = new RecordDef(new FieldDef[]{
                  new StringFieldDef(nombreCaso12Columns[0]),
                    new StringFieldDef(nombreCaso12Columns[1]),
                    new StringFieldDef(nombreCaso12Columns[2]),
                    new StringFieldDef(nombreCaso12Columns[3]),
                    new StringFieldDef(nombreCaso12Columns[4]),
                    new StringFieldDef(nombreCaso12Columns[5]),
                    new FloatFieldDef(nombreCaso12Columns[6]),
                    new FloatFieldDef(nombreCaso12Columns[7]),
                    new FloatFieldDef(nombreCaso12Columns[8]),
                    new FloatFieldDef(nombreCaso12Columns[9]),
                    new FloatFieldDef(nombreCaso12Columns[10]),
                    new FloatFieldDef(nombreCaso12Columns[11]),
                    new FloatFieldDef(nombreCaso12Columns[12]),
                    new FloatFieldDef(nombreCaso12Columns[13]),
                    new FloatFieldDef(nombreCaso12Columns[14]),
                    new FloatFieldDef(nombreCaso12Columns[15]),
                    new FloatFieldDef(nombreCaso12Columns[16]),
                    new FloatFieldDef(nombreCaso12Columns[17]),
                    new FloatFieldDef(nombreCaso12Columns[18]),
                    new FloatFieldDef(nombreCaso12Columns[19]),
                    new FloatFieldDef(nombreCaso12Columns[20]),
                    new FloatFieldDef(nombreCaso12Columns[21]),
                    new FloatFieldDef(nombreCaso12Columns[22]),
                    new FloatFieldDef(nombreCaso12Columns[23]),
                    new FloatFieldDef(nombreCaso12Columns[24]),
                    new FloatFieldDef(nombreCaso12Columns[25]),
                    new FloatFieldDef(nombreCaso12Columns[26]),
                    new FloatFieldDef(nombreCaso12Columns[27]),
                    new FloatFieldDef(nombreCaso12Columns[28]),
                    new FloatFieldDef(nombreCaso12Columns[29]),
                    new FloatFieldDef(nombreCaso12Columns[30]),
                    new FloatFieldDef(nombreCaso12Columns[31]),
                    new FloatFieldDef(nombreCaso12Columns[32]),
                    new FloatFieldDef(nombreCaso12Columns[33]),
                    new FloatFieldDef(nombreCaso12Columns[34]),
                    new FloatFieldDef(nombreCaso12Columns[35]),
                    new FloatFieldDef(nombreCaso12Columns[36]),
                    new FloatFieldDef(nombreCaso12Columns[37])

                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso12Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso12Columns[1], 100, true);
        colorColumn = new ColumnConfig("Color", nombreCaso12Columns[2], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso12Columns[3], 100, true);
         SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, colorM);
        //SimpleStore paisStore = new SimpleStore(new String[]{"idcliente", "codigo"},nombreCaso3Columns[2]);
        paisStore1.load();

        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);


        clienteColumn.setEditor(new GridEditor(cbVendedor));
    vendedorColumn = new ColumnConfig("Vendedor", nombreCaso12Columns[4], 100, true);
        fechaColumn = new ColumnConfig("Ingreso", nombreCaso12Columns[5], 100, true);

           totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso12Columns[6], 80, true, null);
           preciooficinaColumn = new ColumnConfig("FERIA BS", nombreCaso12Columns[7], 100, true);

        precioColumn = new ColumnConfig("Precio Venta", nombreCaso12Columns[8], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso12Columns[9], 100, true);
        talla14Column = new ColumnConfig("14", nombreCaso12Columns[10], 30, true, null);
        talla15Column = new ColumnConfig("15", nombreCaso12Columns[11], 30, true, null);
        talla16Column = new ColumnConfig("16", nombreCaso12Columns[12], 30, true, null);
        talla17Column = new ColumnConfig("17", nombreCaso12Columns[13], 30, true, null);
        talla18Column = new ColumnConfig("18", nombreCaso12Columns[14], 30, true, null);
        talla19Column = new ColumnConfig("19", nombreCaso12Columns[15], 30, true, null);
        talla20Column = new ColumnConfig("20", nombreCaso12Columns[16], 30, true, null);
        talla21Column = new ColumnConfig("21", nombreCaso12Columns[17], 30, true, null);
        talla22Column = new ColumnConfig("22", nombreCaso12Columns[18], 30, true, null);
        talla23Column = new ColumnConfig("23", nombreCaso12Columns[19], 30, true, null);
        talla24Column = new ColumnConfig("24", nombreCaso12Columns[20], 30, true, null);
        talla25Column = new ColumnConfig("25", nombreCaso12Columns[21], 30, true, null);
        talla26Column = new ColumnConfig("26", nombreCaso12Columns[22], 30, true, null);
        talla27Column = new ColumnConfig("27", nombreCaso12Columns[23], 30, true, null);
        talla28Column = new ColumnConfig("28", nombreCaso12Columns[24], 30, true, null);
        talla29Column = new ColumnConfig("29", nombreCaso12Columns[25], 30, true, null);
        talla30Column = new ColumnConfig("30", nombreCaso12Columns[26], 30, true, null);
        talla31Column = new ColumnConfig("31", nombreCaso12Columns[27], 30, true, null);
        // talla31Column = new ColumnConfig("21", nombreCso1Columns[10], 200, true, null);
        talla32Column = new ColumnConfig("32", nombreCaso12Columns[28], 30, true, null);
        talla33Column = new ColumnConfig("33", nombreCaso12Columns[28], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso12Columns[30], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso12Columns[31], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso12Columns[32], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso12Columns[33], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso12Columns[34], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso12Columns[35], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso12Columns[36], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso12Columns[37], 80, true, null);



        TextField tex_detalle5 = new TextField();
        codigoColumn.setEditor(new GridEditor(tex_detalle5));
 TextField tex_detalle = new TextField();
        colorColumn.setEditor(new GridEditor(tex_detalle));
    TextField tex_detalle12 = new TextField();
        fechaColumn.setEditor(new GridEditor(tex_detalle12));
 preciooficinaColumn.setEditor(new GridEditor(metodoFeli()));
       precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));

       talla14Column.setEditor(new GridEditor(metodoFeli()));
        talla15Column.setEditor(new GridEditor(metodoFeli()));
        talla16Column.setEditor(new GridEditor(metodoFeli()));
        talla17Column.setEditor(new GridEditor(metodoFeli()));
        talla18Column.setEditor(new GridEditor(metodoFeli()));
        talla19Column.setEditor(new GridEditor(metodoFeli()));
        talla20Column.setEditor(new GridEditor(metodoFeli()));
        talla21Column.setEditor(new GridEditor(metodoFeli()));
        talla22Column.setEditor(new GridEditor(metodoFeli()));
        talla23Column.setEditor(new GridEditor(metodoFeli()));
        talla24Column.setEditor(new GridEditor(metodoFeli()));
        talla25Column.setEditor(new GridEditor(metodoFeli()));
        talla26Column.setEditor(new GridEditor(metodoFeli()));
        talla27Column.setEditor(new GridEditor(metodoFeli()));
        talla28Column.setEditor(new GridEditor(metodoFeli()));
        talla29Column.setEditor(new GridEditor(metodoFeli()));
        talla30Column.setEditor(new GridEditor(metodoFeli()));
        talla31Column.setEditor(new GridEditor(metodoFeli()));
        talla32Column.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
colorColumn,
                    clienteColumn,
                     vendedorColumn,
                      fechaColumn,

                          totalcajasColumn,
                           preciooficinaColumn,
                    precioColumn,
                          preciounitarioColumn,
                           talla14Column,
                    talla15Column,
                    talla16Column,
                    talla17Column,
                    talla18Column,
                    talla19Column,
                    talla20Column,
                    talla21Column,
                    talla22Column,
                    talla23Column,
                    talla24Column,
                    talla25Column,
                    talla26Column,
                    talla27Column,
                    talla28Column,
                    talla29Column,
                    talla30Column,
                    talla31Column,
                    talla32Column,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,

                   totalparescajaColumn,
                    totalparesbsColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Calzados");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(false);
        grid.setClicksToEdit(1);

//        eliminarProducto = new ToolbarButton("Eliminar Modelo");
//        eliminarProducto.setEnableToggle(true);
//        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
//        tipsConfig2.setText("Quitar producto(s)");
//        //tipsConfig.setTitle("Tip Title");
//        eliminarProducto.setTooltip(tipsConfig2);


 seleccionarProducto = new ToolbarButton("Seleccionar/ para cod barra");
        seleccionarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d = new QuickTipsConfig();
        tipsConfig3d.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        seleccionarProducto.setTooltip(tipsConfig3d);

unirProducto = new ToolbarButton("Unir Modelos");
        unirProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d1 = new QuickTipsConfig();
        tipsConfig3d1.setText("seleccionar modelo(s)");
        //tipsConfig.setTitle("Tip Title");
        unirProducto.setTooltip(tipsConfig3d1);

        guardarProducto = new ToolbarButton("Ver detalle");
        guardarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Guardar cambio(s)");
        guardarProducto.setTooltip(tipsConfig3);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        
         imagen = new ToolbarButton("Imagen");
        imagen.setEnableToggle(true);
        QuickTipsConfig tipsConfig31 = new QuickTipsConfig();
        tipsConfig31.setText("ver imagen y registro");
        imagen.setTooltip(tipsConfig31);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
        pagingToolbar.addButton(guardarProducto);

 pagingToolbar.addSeparator();
  pagingToolbar.addButton(unirProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(imagen);



   pagingToolbar.addButton(seleccionarProducto);
 pagingToolbar.addSeparator();
        grid.setBottomToolbar(pagingToolbar);
  aniadirListenersProductoEspecial();
       // aniadirListenersProducto();
        panel.add(grid);
    }
    public void onModuleLoad13(String idmarca, String idestilos,String idkardex,Object[][] MaterialM1,String gestion,String idcliente,String idvendedor,String iditem) {
        panel = new Panel();

        //panel.setId("panel-lista-productosproveedor");
        this.idkardex = idkardex;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.item = iditem;
        this.opcion = "12";
       // this.tipoM = tipo;
         this.colorM = MaterialM1;
         this.esgestion= gestion;
dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idalmacen=" + idestilo+ "&idkardex=" + idkardex+ "&gestion=" + esgestion+ "&idcliente=" + idcliente+ "&idvendedor=" + idvendedor+ "&item=" + item);

        recordDef = new RecordDef(new FieldDef[]{
                  new StringFieldDef(nombreCaso13Columns[0]),
                    new StringFieldDef(nombreCaso13Columns[1]),
                    new StringFieldDef(nombreCaso13Columns[2]),
                    new StringFieldDef(nombreCaso13Columns[3]),
                    new StringFieldDef(nombreCaso13Columns[4]),
                    new StringFieldDef(nombreCaso13Columns[5]),
                    new StringFieldDef(nombreCaso13Columns[6]),
                    new FloatFieldDef(nombreCaso13Columns[7]),
                    new FloatFieldDef(nombreCaso13Columns[8]),
                    new FloatFieldDef(nombreCaso13Columns[9]),
                    new FloatFieldDef(nombreCaso13Columns[10]),
                    new FloatFieldDef(nombreCaso13Columns[11]),
                    new FloatFieldDef(nombreCaso13Columns[12]),
                    new FloatFieldDef(nombreCaso13Columns[13]),
                    new FloatFieldDef(nombreCaso13Columns[14]),
                    new FloatFieldDef(nombreCaso13Columns[15]),
                    new FloatFieldDef(nombreCaso13Columns[16]),
                    new FloatFieldDef(nombreCaso13Columns[17]),
                    new FloatFieldDef(nombreCaso13Columns[18]),
                    new FloatFieldDef(nombreCaso13Columns[19]),
                    new FloatFieldDef(nombreCaso13Columns[20]),
                    new FloatFieldDef(nombreCaso13Columns[21]),
                    new FloatFieldDef(nombreCaso13Columns[22]),
                    new FloatFieldDef(nombreCaso13Columns[23]),
                    new FloatFieldDef(nombreCaso13Columns[24]),
                    new FloatFieldDef(nombreCaso13Columns[25]),
                    new FloatFieldDef(nombreCaso13Columns[26]),
                    new FloatFieldDef(nombreCaso13Columns[27]),
                    new FloatFieldDef(nombreCaso13Columns[28]),
                    new FloatFieldDef(nombreCaso13Columns[29]),
                    new FloatFieldDef(nombreCaso13Columns[30]),
                    new FloatFieldDef(nombreCaso13Columns[31]),
                    new FloatFieldDef(nombreCaso13Columns[32]),
                    new FloatFieldDef(nombreCaso13Columns[33]),
                    new FloatFieldDef(nombreCaso13Columns[34]),
                    new FloatFieldDef(nombreCaso13Columns[35]),
                    new FloatFieldDef(nombreCaso13Columns[36]),
                    new FloatFieldDef(nombreCaso13Columns[37]),
                    new FloatFieldDef(nombreCaso13Columns[38])

                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso13Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso13Columns[1], 100, true);
         materialColumn = new ColumnConfig("Material", nombreCaso13Columns[2], 100, true);
        colorColumn = new ColumnConfig("Color", nombreCaso55Columns[3], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso13Columns[4], 100, true);
         SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, colorM);
        paisStore1.load();
        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);
        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);

        clienteColumn.setEditor(new GridEditor(cbVendedor));
       vendedorColumn = new ColumnConfig("Vendedor", nombreCaso13Columns[5], 100, true);
        fechaColumn = new ColumnConfig("Ingreso", nombreCaso13Columns[6], 100, true);

           totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso13Columns[7], 80, true, null);
           preciooficinaColumn = new ColumnConfig("FERIA BS", nombreCaso13Columns[8], 100, true);

        precioColumn = new ColumnConfig("Precio Venta", nombreCaso13Columns[9], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso13Columns[10], 100, true);
        talla14Column = new ColumnConfig("14", nombreCaso13Columns[11], 30, true, null);
        talla15Column = new ColumnConfig("15", nombreCaso13Columns[12], 30, true, null);
        talla16Column = new ColumnConfig("16", nombreCaso13Columns[13], 30, true, null);
        talla17Column = new ColumnConfig("17", nombreCaso13Columns[14], 30, true, null);
        talla18Column = new ColumnConfig("18", nombreCaso13Columns[15], 30, true, null);
        talla19Column = new ColumnConfig("19", nombreCaso13Columns[16], 30, true, null);
        talla20Column = new ColumnConfig("20", nombreCaso13Columns[17], 30, true, null);
        talla21Column = new ColumnConfig("21", nombreCaso13Columns[18], 30, true, null);
        talla22Column = new ColumnConfig("22", nombreCaso13Columns[19], 30, true, null);
        talla23Column = new ColumnConfig("23", nombreCaso13Columns[20], 30, true, null);
        talla24Column = new ColumnConfig("24", nombreCaso13Columns[21], 30, true, null);
        talla25Column = new ColumnConfig("25", nombreCaso13Columns[22], 30, true, null);
        talla26Column = new ColumnConfig("26", nombreCaso13Columns[23], 30, true, null);
        talla27Column = new ColumnConfig("27", nombreCaso13Columns[24], 30, true, null);
        talla28Column = new ColumnConfig("28", nombreCaso13Columns[25], 30, true, null);
        talla29Column = new ColumnConfig("29", nombreCaso13Columns[26], 30, true, null);
        talla30Column = new ColumnConfig("30", nombreCaso13Columns[27], 30, true, null);
        talla31Column = new ColumnConfig("31", nombreCaso13Columns[28], 30, true, null);
        // talla31Column = new ColumnConfig("21", nombreCso1Columns[10], 200, true, null);
        talla32Column = new ColumnConfig("32", nombreCaso13Columns[29], 30, true, null);
        talla33Column = new ColumnConfig("33", nombreCaso13Columns[30], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso13Columns[31], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso13Columns[32], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso13Columns[33], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso13Columns[34], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso13Columns[35], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso13Columns[36], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso13Columns[37], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso13Columns[38], 80, true, null);




    TextField tex_detalle5 = new TextField();
        codigoColumn.setEditor(new GridEditor(tex_detalle5));
    TextField tex_detalle = new TextField();
        colorColumn.setEditor(new GridEditor(tex_detalle));
    TextField tex_detalle12 = new TextField();
        fechaColumn.setEditor(new GridEditor(tex_detalle12));
         TextField tex_detalle1 = new TextField();
        materialColumn.setEditor(new GridEditor(tex_detalle1));
preciooficinaColumn.setEditor(new GridEditor(metodoFeli()));
       precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));

       talla14Column.setEditor(new GridEditor(metodoFeli()));
        talla15Column.setEditor(new GridEditor(metodoFeli()));
        talla16Column.setEditor(new GridEditor(metodoFeli()));
        talla17Column.setEditor(new GridEditor(metodoFeli()));
        talla18Column.setEditor(new GridEditor(metodoFeli()));
        talla19Column.setEditor(new GridEditor(metodoFeli()));
        talla20Column.setEditor(new GridEditor(metodoFeli()));
        talla21Column.setEditor(new GridEditor(metodoFeli()));
        talla22Column.setEditor(new GridEditor(metodoFeli()));
        talla23Column.setEditor(new GridEditor(metodoFeli()));
        talla24Column.setEditor(new GridEditor(metodoFeli()));
        talla25Column.setEditor(new GridEditor(metodoFeli()));
        talla26Column.setEditor(new GridEditor(metodoFeli()));
        talla27Column.setEditor(new GridEditor(metodoFeli()));
        talla28Column.setEditor(new GridEditor(metodoFeli()));
        talla29Column.setEditor(new GridEditor(metodoFeli()));
        talla30Column.setEditor(new GridEditor(metodoFeli()));
        talla31Column.setEditor(new GridEditor(metodoFeli()));
        talla32Column.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
 materialColumn,
        colorColumn,
                    clienteColumn,
                     vendedorColumn,
                      fechaColumn,

                          totalcajasColumn,
                          preciooficinaColumn,
                    precioColumn,
                          preciounitarioColumn,
                           talla14Column,
                    talla15Column,
                    talla16Column,
                    talla17Column,
                    talla18Column,
                    talla19Column,
                    talla20Column,
                    talla21Column,
                    talla22Column,
                    talla23Column,
                    talla24Column,
                    talla25Column,
                    talla26Column,
                    talla27Column,
                    talla28Column,
                    talla29Column,
                    talla30Column,
                    talla31Column,
                    talla32Column,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,

                   totalparescajaColumn,
                    totalparesbsColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Calzados");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(false);
        grid.setClicksToEdit(1);

//        eliminarProducto = new ToolbarButton("Eliminar Modelo");
//        eliminarProducto.setEnableToggle(true);
//        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
//        tipsConfig2.setText("Quitar producto(s)");
//        //tipsConfig.setTitle("Tip Title");
//        eliminarProducto.setTooltip(tipsConfig2);

        guardarProducto = new ToolbarButton("Ver detalle");
        guardarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Guardar cambio(s)");
        guardarProducto.setTooltip(tipsConfig3);

 seleccionarProducto = new ToolbarButton("Seleccionar/ para cod barra");
        seleccionarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d = new QuickTipsConfig();
        tipsConfig3d.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        seleccionarProducto.setTooltip(tipsConfig3d);

  unirProducto = new ToolbarButton("Unir Modelos");
        unirProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d1 = new QuickTipsConfig();
        tipsConfig3d1.setText("seleccionar modelo(s)");
        //tipsConfig.setTitle("Tip Title");
        unirProducto.setTooltip(tipsConfig3d1);
         imagen = new ToolbarButton("Imagen");
        imagen.setEnableToggle(true);
        QuickTipsConfig tipsConfig31 = new QuickTipsConfig();
        tipsConfig31.setText("ver imagen y registro");
        imagen.setTooltip(tipsConfig31);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
        pagingToolbar.addButton(guardarProducto);

 pagingToolbar.addSeparator();


   pagingToolbar.addButton(seleccionarProducto);
 pagingToolbar.addSeparator();
 pagingToolbar.addButton(unirProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(imagen);


        grid.setBottomToolbar(pagingToolbar);
  aniadirListenersProductoEspecial();
       // aniadirListenersProducto();
        panel.add(grid);
    }

    public void onModuleLoad8(String idmarca, String idestilos,String idkardex,Object[][] MaterialM1,String gestion,String idcliente,String idvendedor,String iditem) {
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        this.idkardex = idkardex;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.item = iditem;
        this.opcion = "12";
       // this.tipoM = tipo;
         this.colorM = MaterialM1;
         this.esgestion= gestion;
dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idalmacen=" + idestilo+ "&idkardex=" + idkardex+ "&gestion=" + esgestion+ "&idcliente=" + idcliente+ "&idvendedor=" + idvendedor+ "&item=" + item);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso8Columns[0]),
                    new StringFieldDef(nombreCaso8Columns[1]),
                    new StringFieldDef(nombreCaso8Columns[2]),
                    new StringFieldDef(nombreCaso8Columns[3]),
                    new StringFieldDef(nombreCaso8Columns[4]),
                    new StringFieldDef(nombreCaso8Columns[5]),
                    new FloatFieldDef(nombreCaso8Columns[6]),
                    new FloatFieldDef(nombreCaso8Columns[7]),
                    new FloatFieldDef(nombreCaso8Columns[8]),
                    new FloatFieldDef(nombreCaso8Columns[9]),
                    new FloatFieldDef(nombreCaso8Columns[10]),
                    new FloatFieldDef(nombreCaso8Columns[11]),
                    new FloatFieldDef(nombreCaso8Columns[12]),
                    new FloatFieldDef(nombreCaso8Columns[13]),
                    new FloatFieldDef(nombreCaso8Columns[14]),
                    new FloatFieldDef(nombreCaso8Columns[15]),
                    new FloatFieldDef(nombreCaso8Columns[16]),
                    new FloatFieldDef(nombreCaso8Columns[17]),
                    new FloatFieldDef(nombreCaso8Columns[18]),
                    new FloatFieldDef(nombreCaso8Columns[19]),
                    new FloatFieldDef(nombreCaso8Columns[20]),
                    new FloatFieldDef(nombreCaso8Columns[21]),
                    new FloatFieldDef(nombreCaso8Columns[22]),
                    new FloatFieldDef(nombreCaso8Columns[23]),
                    new FloatFieldDef(nombreCaso8Columns[24]),
                    new FloatFieldDef(nombreCaso8Columns[25])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso8Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso8Columns[1], 100, true);
        materialColumn = new ColumnConfig("Material", nombreCaso8Columns[2], 100, true);
      //  colorColumn = new ColumnConfig("Color", nombreCaso8Columns[3], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso8Columns[3], 100, true);
        SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, colorM);
        paisStore1.load();
        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);


        clienteColumn.setEditor(new GridEditor(cbVendedor));
    vendedorColumn = new ColumnConfig("Vendedor", nombreCaso8Columns[4], 100, true);
        fechaColumn = new ColumnConfig("Fecha", nombreCaso8Columns[5], 100, true);

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso8Columns[6], 80, true, null);
        preciooficinaColumn = new ColumnConfig("FERIA BS", nombreCaso8Columns[7], 100, true);


        precioColumn = new ColumnConfig("Precio Venta", nombreCaso8Columns[8], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso8Columns[9], 100, true);
        talla33Column = new ColumnConfig("33", nombreCaso8Columns[10], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso8Columns[11], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso8Columns[12], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso8Columns[13], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso8Columns[14], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso8Columns[15], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso8Columns[16], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso8Columns[17], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso8Columns[18], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso8Columns[19], 30, true, null);
        talla43Column = new ColumnConfig("43", nombreCaso8Columns[20], 30, true, null);
        talla44Column = new ColumnConfig("44", nombreCaso8Columns[21], 30, true, null);
        talla45Column = new ColumnConfig("45", nombreCaso8Columns[22], 30, true, null);

        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso8Columns[23], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso8Columns[24], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso8Columns[25], 80, true, null);
 TextField tex_detalle11 = new TextField();
        codigoColumn.setEditor(new GridEditor(tex_detalle11));

    TextField tex_detalle12 = new TextField();
        fechaColumn.setEditor(new GridEditor(tex_detalle12));
         TextField tex_detalle1 = new TextField();
        materialColumn.setEditor(new GridEditor(tex_detalle1));
     //   TextField tex_detalle2 = new TextField();
      //  clienteColumn.setEditor(new GridEditor(tex_detalle2));

         preciooficinaColumn.setEditor(new GridEditor(metodoFeli()));
       precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
        talla33Column.setEditor(new GridEditor(metodoFeli()));
        talla34Column.setEditor(new GridEditor(metodoFeli()));
        talla35Column.setEditor(new GridEditor(metodoFeli()));
        talla36Column.setEditor(new GridEditor(metodoFeli()));
        talla37Column.setEditor(new GridEditor(metodoFeli()));
        talla38Column.setEditor(new GridEditor(metodoFeli()));
        talla39Column.setEditor(new GridEditor(metodoFeli()));
        talla40Column.setEditor(new GridEditor(metodoFeli()));
        talla41Column.setEditor(new GridEditor(metodoFeli()));
        talla42Column.setEditor(new GridEditor(metodoFeli()));
 talla43Column.setEditor(new GridEditor(metodoFeli()));
        talla44Column.setEditor(new GridEditor(metodoFeli()));
        talla45Column.setEditor(new GridEditor(metodoFeli()));
        //totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        //totalparesColumn.setEditor(new GridEditor(metodoFeli()));

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                   // colorColumn,
                    clienteColumn,
                     vendedorColumn,
                      fechaColumn,
                          totalcajasColumn,
                          preciooficinaColumn,
                    precioColumn,
                          preciounitarioColumn,
                    talla33Column,
                    talla34Column,
                    talla35Column,
                    talla36Column,
                    talla37Column,
                    talla38Column,
                    talla39Column,
                    talla40Column,
                    talla41Column,
                    talla42Column,
                     talla43Column,
                    talla44Column,
                    talla45Column,
                   totalparescajaColumn,
                    totalparesbsColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Calzados");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(false);
        grid.setClicksToEdit(1);

//        eliminarProducto = new ToolbarButton("Eliminar Modelo");
//        eliminarProducto.setEnableToggle(true);
//        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
//        tipsConfig2.setText("Quitar producto(s)");
//        //tipsConfig.setTitle("Tip Title");
//        eliminarProducto.setTooltip(tipsConfig2);

 seleccionarProducto = new ToolbarButton("Seleccionar/ para cod barra");
        seleccionarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d = new QuickTipsConfig();
        tipsConfig3d.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        seleccionarProducto.setTooltip(tipsConfig3d);

unirProducto = new ToolbarButton("Unir Modelos");
        unirProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d1 = new QuickTipsConfig();
        tipsConfig3d1.setText("seleccionar modelo(s)");
        //tipsConfig.setTitle("Tip Title");
        unirProducto.setTooltip(tipsConfig3d1);

        guardarProducto = new ToolbarButton("Ver detalle");
        guardarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Guardar cambio(s)");
        guardarProducto.setTooltip(tipsConfig3);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        

         imagen = new ToolbarButton("Imagen");
        imagen.setEnableToggle(true);
        QuickTipsConfig tipsConfig31 = new QuickTipsConfig();
        tipsConfig31.setText("ver imagen y registro");
        imagen.setTooltip(tipsConfig31);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(unirProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(imagen);
pagingToolbar.addSeparator();
//        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
        pagingToolbar.addButton(guardarProducto);


   pagingToolbar.addButton(seleccionarProducto);
 pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);
  aniadirListenersProductoEspecial();
       // aniadirListenersProducto();
        panel.add(grid);
    }

//nike americana
    
 public void onModuleLoad52(String idmarca, String idestilos,String idkardex,Object[][] MaterialM1,String gestion,String idcliente,String idvendedor) {
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        this.idkardex = idkardex;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "12";
       // this.tipoM = tipo;
         this.colorM = MaterialM1;
         this.esgestion= gestion;
dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idalmacen=" + idestilo+ "&idkardex=" + idkardex+ "&gestion=" + esgestion+ "&idcliente=" + idcliente+ "&idvendedor=" + idvendedor);

      recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso52Columns[0]),
                    new StringFieldDef(nombreCaso52Columns[1]),
                    new StringFieldDef(nombreCaso52Columns[2]),
                    new StringFieldDef(nombreCaso52Columns[3]),
                    new StringFieldDef(nombreCaso52Columns[4]),
                    new StringFieldDef(nombreCaso52Columns[5]),
                    new FloatFieldDef(nombreCaso52Columns[6]),
                    new FloatFieldDef(nombreCaso52Columns[7]),
                    new FloatFieldDef(nombreCaso52Columns[8]),
                    new FloatFieldDef(nombreCaso52Columns[9]),
                    new StringFieldDef(nombreCaso52Columns[10]),
                    new FloatFieldDef(nombreCaso52Columns[11]),
                    new FloatFieldDef(nombreCaso52Columns[12]),
                    new FloatFieldDef(nombreCaso52Columns[13]),
                    new FloatFieldDef(nombreCaso52Columns[14]),
                    new FloatFieldDef(nombreCaso52Columns[15]),
                    new FloatFieldDef(nombreCaso52Columns[16]),
                    new FloatFieldDef(nombreCaso52Columns[17]),
                    new FloatFieldDef(nombreCaso52Columns[18]),
                    new FloatFieldDef(nombreCaso52Columns[19]),
                    new FloatFieldDef(nombreCaso52Columns[20]),
                    new FloatFieldDef(nombreCaso52Columns[21]),
                    new FloatFieldDef(nombreCaso52Columns[22]),
                    new FloatFieldDef(nombreCaso52Columns[23]),
                    new FloatFieldDef(nombreCaso52Columns[24]),
                    new FloatFieldDef(nombreCaso52Columns[25]),
                    new FloatFieldDef(nombreCaso52Columns[26]),
                    new FloatFieldDef(nombreCaso52Columns[27]),
                    new FloatFieldDef(nombreCaso52Columns[28]),
                    new FloatFieldDef(nombreCaso52Columns[29]),
                    new FloatFieldDef(nombreCaso52Columns[30]),
                    new FloatFieldDef(nombreCaso52Columns[31]),
                    new FloatFieldDef(nombreCaso52Columns[32]),
                    new FloatFieldDef(nombreCaso52Columns[33]),
                    new FloatFieldDef(nombreCaso52Columns[34]),
                    new FloatFieldDef(nombreCaso52Columns[35]),
                    new FloatFieldDef(nombreCaso52Columns[36]),
                    new StringFieldDef(nombreCaso52Columns[37]),
                    new StringFieldDef(nombreCaso52Columns[38])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);

        idColumn = new ColumnConfig("Id modelo", nombreCaso52Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso52Columns[1], 80, true);
        materialColumn = new ColumnConfig("Material", nombreCaso52Columns[2], 150, true);
       clienteColumn = new ColumnConfig("Cliente", nombreCaso52Columns[3], 100, true);
         SimpleStore paisStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, colorM);
        //SimpleStore paisStore = new SimpleStore(new String[]{"idcliente", "codigo"},nombreCaso3Columns[2]);
        paisStore1.load();

        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);


        clienteColumn.setEditor(new GridEditor(cbVendedor));
 //clienteColumn = new ColumnConfig("Cliente", nombreCaso5Columns[3], 100, true);
        vendedorColumn = new ColumnConfig("Vendedor", nombreCaso52Columns[4], 100, true);
        fechaColumn = new ColumnConfig("FEcha", nombreCaso52Columns[5], 40, true);
// String[] nombreCaso52Columns = {"idmodelo", "codigo", "material","cliente","vendedor", "fecha", "totalcajas","precio","preciounitario","talla","1", "1m", "2", "2m","3", "3m", "4", "4m", "5", "5m", "6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12","12m", "13", "totalpares","totalparescaja",  "totalparesbs"};

        totalcajasColumn = new ColumnConfig("Cajas", nombreCaso52Columns[6], 40, true, null);
 preciooficinaColumn = new ColumnConfig("FERIA BS", nombreCaso52Columns[7], 100, true);
        precioColumn = new ColumnConfig("Venta", nombreCaso52Columns[8], 60, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso52Columns[9], 60, true);
         talla = new ColumnConfig("GS", nombreCaso52Columns[10], 50, true, null);
         talla1Column = new ColumnConfig("1", nombreCaso52Columns[11], 25, true, null);
         talla1mColumn = new ColumnConfig("1m", nombreCaso52Columns[12], 25, true, null);
        talla2Column = new ColumnConfig("2", nombreCaso52Columns[13], 25, true, null);
        talla2mColumn = new ColumnConfig("2m", nombreCaso52Columns[14], 25, true, null);
        talla3Column = new ColumnConfig("3", nombreCaso52Columns[15], 25, true, null);
        talla3mColumn = new ColumnConfig("3m", nombreCaso52Columns[16], 25, true, null);
        talla4Column = new ColumnConfig("4", nombreCaso52Columns[17], 25, true, null);
        talla4mColumn = new ColumnConfig("4m", nombreCaso52Columns[18], 25, true, null);
        talla5Column = new ColumnConfig("5", nombreCaso52Columns[19], 25, true, null);
        talla5mColumn = new ColumnConfig("5m", nombreCaso52Columns[20], 25, true, null);
        talla6Column = new ColumnConfig("6", nombreCaso52Columns[21], 25, true, null);
        talla6mColumn = new ColumnConfig("6m", nombreCaso52Columns[22], 25, true, null);
       talla7Column = new ColumnConfig("7", nombreCaso52Columns[23], 25, true, null);
               talla7mColumn = new ColumnConfig("7m", nombreCaso52Columns[24], 25, true, null);
        talla8Column = new ColumnConfig("8", nombreCaso52Columns[25], 25, true, null);
           talla8mColumn = new ColumnConfig("8m", nombreCaso52Columns[26], 25, true, null);
        talla9Column = new ColumnConfig("9", nombreCaso52Columns[27], 25, true, null);
        talla9mColumn = new ColumnConfig("9m", nombreCaso52Columns[28], 25, true, null);
        talla10Column = new ColumnConfig("10", nombreCaso52Columns[29], 25, true, null);
        talla10mColumn = new ColumnConfig("10m", nombreCaso52Columns[30], 25, true, null);
        talla11Column = new ColumnConfig("11", nombreCaso52Columns[31], 25, true, null);
        talla11mColumn = new ColumnConfig("11m", nombreCaso52Columns[32], 25, true, null);
        talla12Column = new ColumnConfig("12", nombreCaso52Columns[33], 25, true, null);
      talla12mColumn = new ColumnConfig("12m", nombreCaso52Columns[34], 25, true, null);
      talla13Column = new ColumnConfig("13", nombreCaso52Columns[35], 25, true, null);

        totalparesColumn = new ColumnConfig("Pares", nombreCaso52Columns[36], 80, true, null);
        totalparescajaColumn = new ColumnConfig("caja", nombreCaso52Columns[37], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Sus", nombreCaso52Columns[38], 80, true, null);


       //TextField tex_detalle = new TextField();
     //   colorColumn.setEditor(new GridEditor(tex_detalle));
         TextField tex_detalle1 = new TextField();
        materialColumn.setEditor(new GridEditor(tex_detalle1));
                 TextField tex_detalle12 = new TextField();
        fechaColumn.setEditor(new GridEditor(tex_detalle12));
     //   TextField tex_detalle2 = new TextField();
      //  clienteColumn.setEditor(new GridEditor(tex_detalle2));

         preciooficinaColumn.setEditor(new GridEditor(metodoFeli()));
       precioColumn.setEditor(new GridEditor(metodoFeli()));
 preciounitarioColumn.setEditor(new GridEditor(metodoFeli()));
        talla1Column.setEditor(new GridEditor(metodoFeli()));
         talla1mColumn.setEditor(new GridEditor(metodoFeli()));
          talla2Column.setEditor(new GridEditor(metodoFeli()));
         talla2mColumn.setEditor(new GridEditor(metodoFeli()));
            talla3Column.setEditor(new GridEditor(metodoFeli()));
         talla3mColumn.setEditor(new GridEditor(metodoFeli()));
            talla4Column.setEditor(new GridEditor(metodoFeli()));
             talla4mColumn.setEditor(new GridEditor(metodoFeli()));
             talla5Column.setEditor(new GridEditor(metodoFeli()));
         talla5mColumn.setEditor(new GridEditor(metodoFeli()));
            talla6Column.setEditor(new GridEditor(metodoFeli()));
         talla6mColumn.setEditor(new GridEditor(metodoFeli()));
            talla7Column.setEditor(new GridEditor(metodoFeli()));
         talla7mColumn.setEditor(new GridEditor(metodoFeli()));
            talla8Column.setEditor(new GridEditor(metodoFeli()));
         talla8mColumn.setEditor(new GridEditor(metodoFeli()));
            talla9Column.setEditor(new GridEditor(metodoFeli()));
         talla9mColumn.setEditor(new GridEditor(metodoFeli()));

talla10Column.setEditor(new GridEditor(metodoFeli()));
        talla10mColumn.setEditor(new GridEditor(metodoFeli()));
        talla11Column.setEditor(new GridEditor(metodoFeli()));
        talla11mColumn.setEditor(new GridEditor(metodoFeli()));
        talla12Column.setEditor(new GridEditor(metodoFeli()));
         talla12mColumn.setEditor(new GridEditor(metodoFeli()));
          talla13Column.setEditor(new GridEditor(metodoFeli()));
        totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        totalparesColumn.setEditor(new GridEditor(metodoFeli()));



        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    //colorColumn,
                    clienteColumn,
                     vendedorColumn,
                      fechaColumn,
                     totalcajasColumn,
                       preciooficinaColumn,
                    precioColumn,
                          preciounitarioColumn,
                          talla,
                    talla1Column,
                    talla1mColumn,
                       talla2Column,
                    talla2mColumn,
                       talla3Column,
                    talla3mColumn,
                       talla4Column,
                          talla4mColumn,
                             talla5Column,
                    talla5mColumn,
                       talla6Column,
                    talla6mColumn,
                       talla7Column,
                    talla7mColumn,
                       talla8Column,
                    talla8mColumn,
                       talla9Column,
                      talla9mColumn,
                     talla10Column,
                    talla10mColumn,
                    talla11Column,
                    talla11mColumn,
                    talla12Column,
                      talla12mColumn,
                    talla13Column,
                    totalparesColumn,
                   totalparescajaColumn,
                    totalparesbsColumn
                   };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Calzados");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(false);
        grid.setClicksToEdit(1);
//
//        eliminarProducto = new ToolbarButton("Eliminar Modelo");
//        eliminarProducto.setEnableToggle(true);
//        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
//        tipsConfig2.setText("Quitar producto(s)");
//        //tipsConfig.setTitle("Tip Title");
//        eliminarProducto.setTooltip(tipsConfig2);



        guardarProducto = new ToolbarButton("Ver detalle");
        guardarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Guardar cambio(s)");
        guardarProducto.setTooltip(tipsConfig3);

 seleccionarProducto = new ToolbarButton("Seleccionar/ para cod barra");
        seleccionarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d = new QuickTipsConfig();
        tipsConfig3d.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        seleccionarProducto.setTooltip(tipsConfig3d);

          unirProducto = new ToolbarButton("Unir Modelos");
        unirProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3d1 = new QuickTipsConfig();
        tipsConfig3d1.setText("seleccionar modelo(s)");
        //tipsConfig.setTitle("Tip Title");
        unirProducto.setTooltip(tipsConfig3d1);

         imagen = new ToolbarButton("Imagen");
        imagen.setEnableToggle(true);
        QuickTipsConfig tipsConfig31 = new QuickTipsConfig();
        tipsConfig31.setText("ver imagen y registro");
        imagen.setTooltip(tipsConfig31);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
        pagingToolbar.addButton(guardarProducto);

 pagingToolbar.addSeparator();

   pagingToolbar.addButton(seleccionarProducto);
 pagingToolbar.addSeparator();
 pagingToolbar.addButton(unirProducto);
 pagingToolbar.addSeparator();
        pagingToolbar.addButton(imagen);


        grid.setBottomToolbar(pagingToolbar);
  aniadirListenersProductoEspecial();
       // aniadirListenersProducto();
        panel.add(grid);
    }

    public NumberField metodoFeli() {


        NumberField num_field1 = new NumberField();
        num_field1.setAllowDecimals(false);
        num_field1.setAllowBlank(false);

        num_field1.setAllowNegative(false);

        return num_field1;
    }

    public EditorGridPanel getGrid() {
        return grid;
    }

    public void setGrid(EditorGridPanel grid) {
        this.grid = grid;
    }

    public Panel getPanel() {
        return panel;
    }

     public void InsertRowColor(int rowIndex, int colIndex, String dato) {
        grid.getColumnModel().getDataIndex(rowIndex).equals("color");
        Record rs = grid.getStore().getRecordAt(rowIndex);
        rs.set("color", dato);

    }
    private void aniadirListenersProductoEspecial() {
        //**************************************************
        //***********ELIMINAR PRODUCTO
        //**************************************************
imagen.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idmodelo");
                     selecionado2 = records[0].getAsString("codigo");
                   //  dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario
                     //&idmarca=" + idpedido + "&idalmacen=" + idestilo+ "&idkardex=" + idkardex+ "&gestion=" + esgestion+ "&idcliente=" + idcliente+ "&idvendedor=" + idvendedor);

                         String enlTemp = "funcion=verimagendelmodelo&idmodelo=" + selecionado+ "&modelo=" + selecionado2;
                                      verReporteTraspaso(enlTemp);

                } else {
                    MessageBox.alert("No hay item seleccionado, para ver tu imagen.");
                }
                imagen.setPressed(false);
            }
        });

//oficial
//        eliminarProducto.addListener(new ButtonListenerAdapter() {
//
//            @Override
//            public void onClick(Button button, EventObject e) {
//                //ini detail
//
//                Record[] records = cbSelectionModel.getSelections();
//                if (records.length == 1) {
//                    selecionado = records[0].getAsString("idmodelo");
//                    MessageBox.confirm("Eliminar Item", "Realmente desea eliminar este Item, todo historial de este modelo desaparecera??", new MessageBox.ConfirmCallback() {
//
//                        public void execute(String btnID) {
//                            if (btnID.equalsIgnoreCase("yes")) {
//                                //eliminar
//                                String enlace = "php/IngresoAlmacen.php?funcion=EliminarModelo&idmodelo=" + selecionado;
//                           //       String enlace = "php/IngresoAlmacen.php?funcion=EliminarMarca&iddetalleingreso=" + selecionado;
//
//                                Utils.setErrorPrincipal("Eliminando ", "cargar");
//                                final Conector conec = new Conector(enlace, false);
//                                try {
//                                    conec.getRequestBuilder().sendRequest("asdf", new RequestCallback() {
//
//                                        public void onResponseReceived(Request request, Response response) {
//                                            String data = response.getText();
//                                            JSONValue jsonValue = JSONParser.parse(data);
//                                            JSONObject jsonObject;
//                                            if ((jsonObject = jsonValue.isObject()) != null) {
//                                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
//                                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
//                                                if (errorR.equalsIgnoreCase("true")) {
//                                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
//                                                    reload();
//                                                } else {
//                                                    //Window.alert(mensajeR);
//                                                    Utils.setErrorPrincipal(mensajeR, "error");
//                                                }
//                                            }
//                                        }
//
//                                        public void onError(Request request, Throwable exception) {
//                                            //Window.alert("Ocurrio un error al conectar con el servidor ");
//                                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//                                        }
//
//                                        public void reload() {
//                                            store.reload();
//                                            grid.reconfigure(store, columnModel);
//                                            grid.getView().refresh();
//                                        }
//                                    });
//                                } catch (RequestException ex) {
//                                    //Window.alert("Ocurrio un error al conectar con el servidor");
//                                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//                                }
//                            //end yes
//                            }
//                        }
//                    });
//                } else {
//                    MessageBox.alert("No hay item selecionado para eliminar y/o selecciono mas de uno.");
//                }
//
//                //fin detail
//                eliminarProducto.setPressed(false);
//            }
//        });
  guardarProducto.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("idmodelo");
                     String enlTemp = "funcion=verdetallemodelo&idmodelo=" + selecionado;
                                      verReporte(enlTemp);
                } else {
                    MessageBox.alert("No hay item selecionado para eliminar y/o selecciono mas de uno.");
                }
                guardarProducto.setPressed(false);
            }
        });
    seleccionarProducto.addListener(new ButtonListenerAdapter() {

            private boolean procederAEliminar;
            int repeat = 0;
           // Record[] records;

            @Override
            public void onClick(Button button, EventObject e) {
              //  records = cbSelectionModel.getSelections();
 final Record[] recordws = cbSelectionModel.getSelections();
                //Record[] cambiados = grid.getStore().getModifiedRecords();

                if (recordws.length > 0) {
                   MessageBox.confirm("Para cod Barras", "Realmente desea seleccionar " + recordws.length + " item(s)? ", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                JSONArray productos = new JSONArray();
                                JSONObject productoObject;

                                for (int i = 0; i < recordws.length; i++) {
                                    productoObject = new JSONObject();
                                    productoObject.put("idmodelo", new JSONString(recordws[i].getAsString("idmodelo")));
                                   // productoObject.put("idkardex", new JSONString(records[i].getAsString("idkardex")));

                                    productos.set(i, productoObject);
                                    productoObject = null;
                                }
                                //eliminar
                                final String datos = "resultado=" + productos.toString();
                                //com.google.gwt.user.client.Window.alert("error 9998 " + datos);
                                Utils.setErrorPrincipal("Impresion codigo(s)", "cargar");
                 //                    String url = "./php/IngresoAlmacen.php?funcion=Registrarcodigo&" + datos;
  String url = "./php/IngresoAlmacen.php?funcion=Registrarcodigoporpar&" + datos;

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
//cajascc
//                                    String enlTemp = "funcion=AdicionCodigoBarraIngresoDetalleHTML&idimpresion=" + idventaG;
//                    verReporte(enlTemp);
       //pares
                    String enlTemp = "funcion=codbarraporpar&idimpresion=" + idventaG;
                    verReporte(enlTemp);
                      store.reload();

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
                seleccionarProducto.setPressed(false);
            }
        });

        unirProducto.addListener(new ButtonListenerAdapter() {

            private boolean procederAEliminar;
            int repeat = 0;
            @Override
            public void onClick(Button button, EventObject e) {
             
 final Record[] recordws = cbSelectionModel.getSelections();
                 if (recordws.length > 0) {
                   MessageBox.confirm("Para UNION", "Realmente desea unir " + recordws.length + " item(s)? ", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                JSONArray productos = new JSONArray();
                                JSONObject productoObject;

                                for (int i = 0; i < recordws.length; i++) {
                                    productoObject = new JSONObject();
                                    productoObject.put("idmodelo", new JSONString(recordws[i].getAsString("idmodelo")));
                                     productos.set(i, productoObject);
                                    productoObject = null;
                                }
                                //eliminar
                                final String datos = "resultado=" + productos.toString();
                                //com.google.gwt.user.client.Window.alert("error 9998 " + datos);
                                Utils.setErrorPrincipal("Impresion codigo(s)", "cargar");
                 //                    String url = "./php/IngresoAlmacen.php?funcion=Registrarcodigo&" + datos;
  String url = "./php/IngresoAlmacen.php?funcion=Registrarcodigounion&" + datos;
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
                         createCompra(idventaG);

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
                    MessageBox.alert("No hay modelo selecionado para editar y/o selecciono mas de uno.");
                }
                unirProducto.setPressed(false);
            }
        });
        //**************************************************
        //*********** LISTENERS DE LA TABLA
        //**************************************************
         grid.addListener(
                new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store.load(0, 100);
                    }
                });
        grid.addGridCellListener(
                new GridCellListenerAdapter() {

                    @Override
                    public void onCellClick(GridPanel grid, int rowIndex, int colIndex, EventObject e) {
                        if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor")) {
                            Record record = grid.getStore().getAt(rowIndex);
                            record.set("indoor", !record.getAsBoolean("indoor"));
                        }
                   if (grid.getColumnModel().getDataIndex(colIndex).equals("color")) {
                         //   colorpedido = new ColorPedido(colorM, ListaInventarioGrid.this, colIndex, rowIndex);
                          //  colorpedido.show();
                        }

                 if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor")) {
                               int newcol = colIndex +1;
                            if (e.getKey() == EventObject.ENTER) {
                                          Record record1 = grid.getStore().getAt(newcol);
                                     record1.set("indoor",record1);
                                      }
                             }
                      }
                });
    // grid.addGridColumnListener(listener)
     grid.addGridColumnListener(new GridColumnListener() {


            public void onColumnMove(GridPanel grid, int oldIndex, int newIndex) {
             if (grid.getColumnModel().getDataIndex(oldIndex).equals("precio")) {
                            Record record = grid.getStore().getAt(newIndex);
                            record.set("indoor", !record.getAsBoolean("indoor"));
                        }
            }

            public void onColumnResize(GridPanel grid, int colIndex, int newSize) {
                throw new UnsupportedOperationException("Not supported yet.");
            }
         });

    }

        private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
public void createCompra(String unionitem){

                    JSONObject usuarioSoU = new JSONObject();

                    usuarioSoU.put("itemunion", new JSONString(unionitem));
                    String datos = "resultado=" + usuarioSoU.toString();

                        String enlace = "./php/IngresoAlmacen.php?funcion=Registrarunionmodelos&" + datos;
                   //  Utils.setErrorPrincipal("Guardando", "cargar");
                    final Conector conec = new Conector(enlace, false, "POST");
                    try {
                        conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {
                            public void onResponseReceived(Request request, Response response) {
                                String data = response.getText();
                                JSONValue jsonValue = JSONParser.parse(data);
                                JSONObject jsonObject;
                                if ((jsonObject = jsonValue.isObject()) != null) {
                                    String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                              //      String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                    if (errorR.equalsIgnoreCase("true")) {
                                            store.reload();
                                            grid.reconfigure(store, columnModel);
                                            grid.getView().refresh();

                                    } else {
                                  MessageBox.alert("Existen un error ");
                                  //      Utils.setErrorPrincipal(mensajeR, "mensaje");
                                    }
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


    private void quitarEsteItem(Record quitar) {

        store.remove(quitar);
        grid.setStore(store);
        grid.startEditing(0, 0);
    }

    public void initDescuentoEspecial(String opcion) {

//if (opcion.equalsIgnoreCase("1")) {
//             tipoalmacenM = new String[]{"0", "5", "4", "3"};
        //       SimpleStore tiposStore = new SimpleStore("desuentoporcentaje", tipoalmacenM);
        //      tiposStore.load();
    }

    public RecordDef getRecordDef() {
        return recordDef;
    }

    public void LimpiarGrid() {
        store.removeAll();

        grid.setStore(store);
        grid.reconfigure(store, columnModel);

    }
     private void verReporteTraspaso(String enlace) {
        ReporteImagen print = new ReporteImagen(enlace,ListaInventarioGrid.this);
        print.show();
    }

    public Store getStore() {
        return store;
    }

    public Record[] getRecords() {
        Record[] records = cbSelectionModel.getSelections();
        return records;
    }

    public ColumnModel getColumnModel() {
        return columnModel;
    }
}
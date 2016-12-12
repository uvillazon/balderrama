/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.traspaso;

import org.balderrama.client.sistemadetalle.*;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
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
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.data.*;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.NumberField;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.grid.GridEditor;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import com.gwtext.client.widgets.grid.event.*;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;

/**
 *
 * @author example
 */
public class Listadetallecrearcaja {

    private EditorGridPanel grid;
    private final int ALTO = 360;
      private final int ALTO2 = 300;
    private ToolbarButton eliminarProducto;
    private ToolbarButton guardarProducto;
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
   private ColumnConfig totalparescajaColumn;
     private ColumnConfig talla;
      private String idpedido;
    //  private String ;
    private String idestilo;
     private String idkardex;
    private String opcion;
    private Object[][] vendedorM;
    private Object[][] colorM;
    private Object[][] materialM;
        private Object[][] clienteM;
     private String[] tipoM;
    String[] nombreCaso5Columns = {"idmodelo", "codigo", "material","color","cliente", "totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42",  "totalpares","totalparescaja",  "totalparesbs"};
 // String[] nombreCaso2Columns = {"iddetalleingreso", "codigo", "color", "material", "precio", "5", "5m","6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "totalcajas", "totalpares"};
     String[] nombreCaso52Columns = {"idmodelo", "codigo", "material","cliente", "totalcajas","precio","preciounitario","talla","5", "5m", "6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12",  "totalpares","totalparescaja",  "totalparesbs"};
String[] nombreCaso51Columns = {"idmodelo", "codigo", "material","cliente", "totalcajas","precio","preciounitario","talla","5", "5m", "6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12",  "totalpares","totalparescaja",  "totalparesbs"};

    String[] nombreCaso55Columns = {"idmodelo", "codigo", "material","cliente", "totalcajas","precio","preciounitario","talla","5", "5m", "6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12",  "totalpares","totalparescaja",  "totalparesbs"};

    String[] nombreCaso6Columns = {"iddetalleingreso", "coleccion", "codigo", "material", "precio", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalcajas", "totalpares"};
    //    String[] nombreCaso1Columns = {"iddetalleingreso", "codigo","color","material", "precio","6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12", "totalcajas", "totalpares"};
    String[] nombreCaso4Columns = {"iddetalleingreso", "linea", "codigo", "color", "opciont", "precio", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "totalcajas", "totalpares"};
    String[] nombreCaso41Columns = {"iddetalleingreso", "codigo", "color",  "precio", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "39","40","totalcajas", "totalpares"};

    //String[] nombreCaso4Columns = {"idmodelo", "linea","codigo", "color","opciont", "precio", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "totalcajas", "totalpares"};
    String[] nombreCaso9Columns = {"iddetalleingreso", "codigo", "precio", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalcajas", "totalpares"};
    String[] nombreCaso10Columns = {"iddetalleingreso", "codigo", "color", "precio", "30", "31", "32","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalcajas", "totalpares"};
    String[] nombreCaso7Columns = {"iddetalleingreso", "codigo", "color", "precio", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "totalcajas", "totalpares"};
    
    String[] nombreCaso1Columns = {"iddetalleingreso", "codigo", "color", "material", "precio","6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12","12m","13", "totalcajas", "totalpares"};

    String[] nombreCaso3Columns = {"iddetalleingreso", "codigo", "color", "material", "precio",  "1", "1m", "2", "2m", "3", "3m", "4", "4m", "5", "5m","6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12", "12m", "13", "totalcajas", "totalpares"};

    String[] nombreCaso11Columns = {"iddetalleingreso", "codigo", "color", "precio", "6","6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12", "totalcajas", "totalpares"};
    String[] nombreCaso22Columns = {"iddetalleingreso", "codigo", "color", "precio", "5", "5m", "6","6m", "7", "7m", "8", "8m", "9", "9m", "10","10m", "11", "totalcajas", "totalpares"};
    String[] nombreCaso33Columns = {"iddetalleingreso", "codigo", "color", "precio", "1", "1m", "2", "2m", "3", "3m", "4", "4m", "5", "5m", "6","6m", "7", "7m", "8", "8m", "9", "9m", "10","10m", "11", "11m","12", "12m", "13", "13m","totalcajas", "totalpares"};
    //String[] nombreCaso33Columns = {"iddetalleingreso", "codigo", "color", "precio", "01", "19", "02", "20", "03", "30", "04", "40", "05", "50", "06", "60", "07", "70", "08", "80", "09", "90", "10", "100", "11", "110", "12", "120", "13", "totalcajas", "totalpares"};

    String[] nombreCaso111Columns = {"iddetalleingreso", "codigo", "precio", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12", "totalcajas", "totalpares"};
    String[] nombreCaso222Columns = {"iddetalleingreso", "codigo", "precio", "4", "4m","5", "5m","6","6m", "7", "7m", "8", "8m", "9", "9m", "10", "totalcajas", "totalpares"};
    String[] nombreCaso333Columns = {"iddetalleingreso", "codigo", "precio", "1", "1m", "2", "2m", "3", "3m", "4", "4m", "5", "5m","6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12", "12m", "13","13m", "totalcajas", "totalpares"};
   // String[] nombreCaso333Columns = {"iddetalleingreso", "codigo", "precio", "01", "19", "02", "20", "03", "30", "04", "40", "05", "50", "06", "60", "07", "70", "08", "80", "09", "90", "10", "100", "11", "110", "12", "120", "13", "totalcajas", "totalpares"};

    private RecordDef recordDef;
    private ColumnConfig coleccionColumn;

    public void onModuleLoad1(String idmarca, String idestilos,String idkardexx) {
        panel = new Panel();
        this.idkardex =idkardexx;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "3";
        dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoColorinventario&idmarca=" + idpedido + "&idestilo=" + idestilo+ "&idkardex=" + idkardex);
//dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoColor&idmarca=" + idpedido + "&idestilo=" + idestilo);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso1Columns[0]),
                    new StringFieldDef(nombreCaso1Columns[1]),
                    new StringFieldDef(nombreCaso1Columns[2]),
                    new StringFieldDef(nombreCaso1Columns[3]),
                    new FloatFieldDef(nombreCaso1Columns[4]),
                    new FloatFieldDef(nombreCaso1Columns[5]),
                    new FloatFieldDef(nombreCaso1Columns[6]),
                    new FloatFieldDef(nombreCaso1Columns[7]),
                    new FloatFieldDef(nombreCaso1Columns[8]),
                    new FloatFieldDef(nombreCaso1Columns[9]),
                    new FloatFieldDef(nombreCaso1Columns[10]),
                    new FloatFieldDef(nombreCaso1Columns[11]),
                    new FloatFieldDef(nombreCaso1Columns[12]),
                    new FloatFieldDef(nombreCaso1Columns[13]),
                    new FloatFieldDef(nombreCaso1Columns[14]),
                    new FloatFieldDef(nombreCaso1Columns[15]),
                    new FloatFieldDef(nombreCaso1Columns[16]),
                    new FloatFieldDef(nombreCaso1Columns[17]),
                    new FloatFieldDef(nombreCaso1Columns[18]),
                    new FloatFieldDef(nombreCaso1Columns[19]),
                    new FloatFieldDef(nombreCaso1Columns[20]),
                    new FloatFieldDef(nombreCaso1Columns[21])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso1Columns[0], 20, true);
        lineaColumn = new ColumnConfig("Modelo", nombreCaso1Columns[1], 80, true);
        colorColumn = new ColumnConfig("Color", nombreCaso1Columns[2], 55, true);
        materialColumn = new ColumnConfig("Stylename", nombreCaso1Columns[3], 180, true);

        precioColumn = new ColumnConfig("Precio", nombreCaso1Columns[4], 55, true);
        talla6Column = new ColumnConfig("6 ", nombreCaso1Columns[5], 35, true, null);

        talla6mColumn = new ColumnConfig("6 1/2", nombreCaso1Columns[6], 35, true, null);
        talla7Column = new ColumnConfig("7", nombreCaso1Columns[7], 30, true, null);
        talla7mColumn = new ColumnConfig("7 1/2", nombreCaso1Columns[8], 35, true, null);
        talla8Column = new ColumnConfig("8", nombreCaso1Columns[9], 30, true, null);
        talla8mColumn = new ColumnConfig("8 1/2", nombreCaso1Columns[10], 35, true, null);
        talla9Column = new ColumnConfig("9", nombreCaso1Columns[11], 30, true, null);
        talla9mColumn = new ColumnConfig("9 1/2", nombreCaso1Columns[12], 35, true, null);
        talla10Column = new ColumnConfig("10", nombreCaso1Columns[13], 30, true, null);
        talla10mColumn = new ColumnConfig("10 1/2", nombreCaso1Columns[14], 40, true, null);
        talla11Column = new ColumnConfig("11", nombreCaso1Columns[15], 30, true, null);
        talla11mColumn = new ColumnConfig("11 1/2", nombreCaso1Columns[16], 40, true, null);
        talla12Column = new ColumnConfig("12", nombreCaso1Columns[17], 30, true, null);
  talla12mColumn = new ColumnConfig("12 1/2", nombreCaso1Columns[18], 40, true, null);
        talla13Column = new ColumnConfig("13", nombreCaso1Columns[19], 30, true, null);

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso1Columns[20], 5, true, null);
        totalparesColumn = new ColumnConfig("# Pares", nombreCaso1Columns[21], 80, true, null);
       // TextField tex_detalle11 = new TextField();
        // lineaColumn.setEditor(new GridEditor(tex_detalle11));
        
         precioColumn.setEditor(new GridEditor(metodoFeli()));
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
                    lineaColumn,
                    colorColumn,
                    materialColumn,
                    precioColumn,
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
                    totalcajasColumn,
                    totalparesColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        grid.setTitle("Lista de Calzados");
        grid.setId("grid-lista-clientes-cobro-in");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);





      
        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);

        guardarProducto = new ToolbarButton("Guardar Cambios");
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
        pagingToolbar.addButton(eliminarProducto);
//pagingToolbar.addSeparator();
//        pagingToolbar.addButton(guardarProducto);
        grid.setBottomToolbar(pagingToolbar);
        aniadirListenersProducto();
        panel.add(grid);
    }

   

    public void onModuleLoad4(String idmarca, String idestilos,String idkardex) {
        panel = new Panel();
        this.idkardex=idkardex;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "2";
        dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoLineaModeloColorinventario&idmarca=" + idpedido + "&idestilo=" + idestilo+ "&idkardex=" + idkardex);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso4Columns[0]),
                    new StringFieldDef(nombreCaso4Columns[1]),
                    new StringFieldDef(nombreCaso4Columns[2]),
                    new StringFieldDef(nombreCaso4Columns[3]),
                    new FloatFieldDef(nombreCaso4Columns[4]),
                    new FloatFieldDef(nombreCaso4Columns[5]),
                    new FloatFieldDef(nombreCaso4Columns[6]),
                    new FloatFieldDef(nombreCaso4Columns[7]),
                    new FloatFieldDef(nombreCaso4Columns[8]),
                    new FloatFieldDef(nombreCaso4Columns[9]),
                    new FloatFieldDef(nombreCaso4Columns[10]),
                    new FloatFieldDef(nombreCaso4Columns[11]),
                    new FloatFieldDef(nombreCaso4Columns[12]),
                    new FloatFieldDef(nombreCaso4Columns[13]),
                    new FloatFieldDef(nombreCaso4Columns[14]),
                    new FloatFieldDef(nombreCaso4Columns[15]),
                    new FloatFieldDef(nombreCaso4Columns[16]),
                    new FloatFieldDef(nombreCaso4Columns[17]),
                    new FloatFieldDef(nombreCaso4Columns[18]),
                    new FloatFieldDef(nombreCaso4Columns[19]),
                    new FloatFieldDef(nombreCaso4Columns[20]),
                    new FloatFieldDef(nombreCaso4Columns[21]),
                    new FloatFieldDef(nombreCaso4Columns[22]),
                    new FloatFieldDef(nombreCaso4Columns[23]),
                    new FloatFieldDef(nombreCaso4Columns[24]),
                    new FloatFieldDef(nombreCaso4Columns[25]),
                    new FloatFieldDef(nombreCaso4Columns[26]),
                    new FloatFieldDef(nombreCaso4Columns[27]),
                    new FloatFieldDef(nombreCaso4Columns[28]),
                    new FloatFieldDef(nombreCaso4Columns[29]),
                    new FloatFieldDef(nombreCaso4Columns[30]),
                    new FloatFieldDef(nombreCaso4Columns[31]),
                    new FloatFieldDef(nombreCaso4Columns[32])
                });

        reader = new JsonReader(recordDef);
        reader.setRoot(
                "resultado");
        reader.setTotalProperty(
                "totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso4Columns[0], 20, true);
        lineaColumn = new ColumnConfig("Lin", nombreCaso4Columns[1], 40, true);

        codigoColumn = new ColumnConfig("Mod", nombreCaso4Columns[2], 40, true);
        colorColumn = new ColumnConfig("Color", nombreCaso4Columns[3], 50, true);
        coleccionColumn = new ColumnConfig("Opcion", nombreCaso4Columns[4], 20, true);


        precioColumn = new ColumnConfig("Precio", nombreCaso4Columns[5], 80, true);


        talla14Column = new ColumnConfig("14", nombreCaso4Columns[6], 30, true, null);
        talla15Column = new ColumnConfig("15", nombreCaso4Columns[7], 30, true, null);
        talla16Column = new ColumnConfig("16", nombreCaso4Columns[8], 30, true, null);
        talla17Column = new ColumnConfig("17", nombreCaso4Columns[9], 30, true, null);
        talla18Column = new ColumnConfig("18", nombreCaso4Columns[10], 30, true, null);
        talla19Column = new ColumnConfig("19", nombreCaso4Columns[11], 30, true, null);
        talla20Column = new ColumnConfig("20", nombreCaso4Columns[12], 30, true, null);
        talla21Column = new ColumnConfig("21", nombreCaso4Columns[13], 30, true, null);
        talla22Column = new ColumnConfig("22", nombreCaso4Columns[14], 30, true, null);
        talla23Column = new ColumnConfig("23", nombreCaso4Columns[15], 30, true, null);
        talla24Column = new ColumnConfig("24", nombreCaso4Columns[16], 30, true, null);
        talla25Column = new ColumnConfig("25", nombreCaso4Columns[17], 30, true, null);
        talla26Column = new ColumnConfig("26", nombreCaso4Columns[18], 30, true, null);
        talla27Column = new ColumnConfig("27", nombreCaso4Columns[19], 30, true, null);
        talla28Column = new ColumnConfig("28", nombreCaso4Columns[20], 30, true, null);
        talla29Column = new ColumnConfig("29", nombreCaso4Columns[21], 30, true, null);
        talla30Column = new ColumnConfig("30", nombreCaso4Columns[22], 30, true, null);
        talla31Column = new ColumnConfig("31", nombreCaso4Columns[23], 30, true, null);
        // talla31Column = new ColumnConfig("21", nombreCso1Columns[10], 200, true, null);
        talla32Column = new ColumnConfig("32", nombreCaso4Columns[24], 30, true, null);
        talla33Column = new ColumnConfig("33", nombreCaso4Columns[25], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso4Columns[26], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso4Columns[27], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso4Columns[28], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso4Columns[29], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso4Columns[30], 30, true, null);
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso4Columns[31], 5, true, null);
        totalparesColumn = new ColumnConfig("# Pares", nombreCaso4Columns[32], 80, true, null);


        precioColumn.setEditor(new GridEditor(metodoFeli()));

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
        totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        totalparesColumn.setEditor(new GridEditor(metodoFeli()));
        cbSelectionModel = new CheckboxSelectionModel();

        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    lineaColumn,
                    codigoColumn,
                    colorColumn,
                    coleccionColumn,
                    precioColumn,
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
                    totalcajasColumn,
                    totalparesColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

        grid.addGridCellListener(new GridCellListenerAdapter() {

            @Override
            public void onCellClick(GridPanel grid, int rowIndex, int colIndex, EventObject e) {
                if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor") &&
                        e.getTarget(".checkbox", 1) != null) {
                    Record record = grid.getStore().getAt(rowIndex);
                    record.set("indoor", !record.getAsBoolean("indoor"));
                }
            }
        });

        eliminarProducto = new ToolbarButton("Quitar");

        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();

        tipsConfig2.setText("Quitar producto(s)");
        //tipsConfig.setTitle("Tip Title");

        eliminarProducto.setTooltip(tipsConfig2);

        guardarProducto = new ToolbarButton("Guardar Cambios");
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
        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
//        pagingToolbar.addButton(guardarProducto);

        grid.setBottomToolbar(pagingToolbar);

//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();
        aniadirListenersProducto();

        panel.add(grid);
    }
    public void onModuleLoad41(String idmarca, String idestilos,String idkardex) {
        panel = new Panel();
        this.idkardex=idkardex;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "2";
     //   dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoLineaModeloColor&idmarca=" + idpedido + "&idestilo=" + idestilo);
 dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idestilo=" + idestilo+ "&idkardex=" + idkardex);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso41Columns[0]),
                    new StringFieldDef(nombreCaso41Columns[1]),
                    new StringFieldDef(nombreCaso41Columns[2]),
                    new StringFieldDef(nombreCaso41Columns[3]),
                    new FloatFieldDef(nombreCaso41Columns[4]),
                    new FloatFieldDef(nombreCaso41Columns[5]),
                    new FloatFieldDef(nombreCaso41Columns[6]),
                    new FloatFieldDef(nombreCaso41Columns[7]),
                    new FloatFieldDef(nombreCaso41Columns[8]),
                    new FloatFieldDef(nombreCaso41Columns[9]),
                    new FloatFieldDef(nombreCaso41Columns[10]),
                    new FloatFieldDef(nombreCaso41Columns[11]),
                    new FloatFieldDef(nombreCaso41Columns[12]),
                    new FloatFieldDef(nombreCaso41Columns[13]),
                    new FloatFieldDef(nombreCaso41Columns[14]),
                    new FloatFieldDef(nombreCaso41Columns[15]),
                    new FloatFieldDef(nombreCaso41Columns[16]),
                    new FloatFieldDef(nombreCaso41Columns[17]),
                    new FloatFieldDef(nombreCaso41Columns[18]),
                    new FloatFieldDef(nombreCaso41Columns[19]),
                    new FloatFieldDef(nombreCaso41Columns[20]),
                    new FloatFieldDef(nombreCaso41Columns[21]),
                    new FloatFieldDef(nombreCaso41Columns[22]),
                    new FloatFieldDef(nombreCaso41Columns[23]),
                    new FloatFieldDef(nombreCaso41Columns[24]),
                    new FloatFieldDef(nombreCaso41Columns[25]),
                    new FloatFieldDef(nombreCaso41Columns[26]),
                    new FloatFieldDef(nombreCaso41Columns[27]),
                    new FloatFieldDef(nombreCaso41Columns[28]),
                     new FloatFieldDef(nombreCaso41Columns[29]),
                    new FloatFieldDef(nombreCaso41Columns[30]),
                    new FloatFieldDef(nombreCaso41Columns[31]),
                    new FloatFieldDef(nombreCaso41Columns[32])
                });

        reader = new JsonReader(recordDef);
        reader.setRoot(
                "resultado");
        reader.setTotalProperty(
                "totalCount");
        store = new Store(dataProxy, reader, true);
          idColumn = new ColumnConfig("Id modelo", nombreCaso41Columns[0], 20, true);
      //  lineaColumn = new ColumnConfig("Linea", nombreCaso4Columns[1], 50, true);

        codigoColumn = new ColumnConfig("Modelo", nombreCaso41Columns[1], 70, true);
         colorColumn = new ColumnConfig("Color", nombreCaso41Columns[2], 70, true);
        //  coleccionColumn = new ColumnConfig("Opcion", nombreCaso4Columns[4], 40, true);


         precioColumn = new ColumnConfig("Precio", nombreCaso41Columns[3], 80, true);


        talla14Column = new ColumnConfig("14", nombreCaso41Columns[4], 30, true, null);
        talla15Column = new ColumnConfig("15", nombreCaso41Columns[5], 30, true, null);
        talla16Column = new ColumnConfig("16", nombreCaso41Columns[6], 30, true, null);
        talla17Column = new ColumnConfig("17", nombreCaso41Columns[7], 30, true, null);
        talla18Column = new ColumnConfig("18", nombreCaso41Columns[8], 30, true, null);
        talla19Column = new ColumnConfig("19", nombreCaso41Columns[9], 30, true, null);
        talla20Column = new ColumnConfig("20", nombreCaso41Columns[10], 30, true, null);
        talla21Column = new ColumnConfig("21", nombreCaso41Columns[11], 30, true, null);
        talla22Column = new ColumnConfig("22", nombreCaso41Columns[12], 30, true, null);
        talla23Column = new ColumnConfig("23", nombreCaso41Columns[13], 30, true, null);
        talla24Column = new ColumnConfig("24", nombreCaso41Columns[14], 30, true, null);
        talla25Column = new ColumnConfig("25", nombreCaso41Columns[15], 30, true, null);
        talla26Column = new ColumnConfig("26", nombreCaso41Columns[16], 30, true, null);
        talla27Column = new ColumnConfig("27", nombreCaso41Columns[17], 30, true, null);
        talla28Column = new ColumnConfig("28", nombreCaso41Columns[18], 30, true, null);
        talla29Column = new ColumnConfig("29", nombreCaso41Columns[19], 30, true, null);
        talla30Column = new ColumnConfig("30", nombreCaso41Columns[20], 30, true, null);
        talla31Column = new ColumnConfig("31", nombreCaso41Columns[21], 30, true, null);
        // talla31Column = new ColumnConfig("21", nombreCso1Columns[10], 200, true, null);
        talla32Column = new ColumnConfig("32", nombreCaso41Columns[22], 30, true, null);
        talla33Column = new ColumnConfig("33", nombreCaso41Columns[23], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso41Columns[24], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso41Columns[25], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso41Columns[26], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso41Columns[27], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso41Columns[28], 30, true, null);
         talla39Column = new ColumnConfig("39", nombreCaso41Columns[29], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso41Columns[30], 30, true, null);
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso41Columns[31], 5, true, null);
        totalparesColumn = new ColumnConfig("# Pares", nombreCaso41Columns[32], 80, true, null);


        precioColumn.setEditor(new GridEditor(metodoFeli()));

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
        totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        totalparesColumn.setEditor(new GridEditor(metodoFeli()));
        cbSelectionModel = new CheckboxSelectionModel();

        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                   // lineaColumn,
                    codigoColumn,
                    colorColumn,
                   // coleccionColumn,
                    precioColumn,
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
                    talla39Column,
                    talla40Column,

                    totalcajasColumn,
                    totalparesColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

        grid.addGridCellListener(new GridCellListenerAdapter() {

            @Override
            public void onCellClick(GridPanel grid, int rowIndex, int colIndex, EventObject e) {
                if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor") &&
                        e.getTarget(".checkbox", 1) != null) {
                    Record record = grid.getStore().getAt(rowIndex);
                    record.set("indoor", !record.getAsBoolean("indoor"));
                }
            }
        });

        eliminarProducto = new ToolbarButton("Quitar");

        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();

        tipsConfig2.setText("Quitar producto(s)");
        //tipsConfig.setTitle("Tip Title");

        eliminarProducto.setTooltip(tipsConfig2);

        guardarProducto = new ToolbarButton("Guardar Cambios");
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
        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
//        pagingToolbar.addButton(guardarProducto);

        grid.setBottomToolbar(pagingToolbar);

//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();
        aniadirListenersProducto();

        panel.add(grid);
    }

 public void onModuleLoad2(String idmarca, String idestilos,String idkardex) {
//        panel = new Panel();
//        this.idkardex=idkardex;
//        this.idpedido = idmarca;
//        this.idestilo = idestilos;
//        this.opcion = "4";
//        dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoColorinventario&idmarca=" + idpedido + "&idestilo=" + idestilo+ "&idkardex=" + idkardex);
//
//        recordDef = new RecordDef(new FieldDef[]{
//                    new StringFieldDef(nombreCaso2Columns[0]),
//                    new StringFieldDef(nombreCaso2Columns[1]),
//                    new StringFieldDef(nombreCaso2Columns[2]),
//                    new StringFieldDef(nombreCaso2Columns[3]),
//                    new FloatFieldDef(nombreCaso2Columns[4]),
//                    new FloatFieldDef(nombreCaso2Columns[5]),
//                    new FloatFieldDef(nombreCaso2Columns[6]),
//                    new FloatFieldDef(nombreCaso2Columns[7]),
//                    new FloatFieldDef(nombreCaso2Columns[8]),
//                    new FloatFieldDef(nombreCaso2Columns[9]),
//                    new FloatFieldDef(nombreCaso2Columns[10]),
//                    new FloatFieldDef(nombreCaso2Columns[11]),
//                    new FloatFieldDef(nombreCaso2Columns[12]),
//                    new FloatFieldDef(nombreCaso2Columns[13]),
//                    new FloatFieldDef(nombreCaso2Columns[14]),
//                    new FloatFieldDef(nombreCaso2Columns[15]),
//                    new FloatFieldDef(nombreCaso2Columns[16]),
//                    new FloatFieldDef(nombreCaso2Columns[17])
//                });
//        reader = new JsonReader(recordDef);
//        reader.setRoot("resultado");
//        reader.setTotalProperty("totalCount");
//        store = new Store(dataProxy, reader, true);
//        idColumn = new ColumnConfig("Id modelo", nombreCaso2Columns[0], 20, true);
//        lineaColumn = new ColumnConfig("Modelo", nombreCaso2Columns[1], 80, true);
//        colorColumn = new ColumnConfig("Color", nombreCaso2Columns[2], 55, true);
//        materialColumn = new ColumnConfig("Stylename", nombreCaso2Columns[3], 180, true);
//
//        precioColumn = new ColumnConfig("Precio", nombreCaso2Columns[4], 55, true);
//        talla11Column = new ColumnConfig("5", nombreCaso2Columns[5], 30, true, null);
//        talla11mColumn = new ColumnConfig("5 1/2", nombreCaso2Columns[6], 40, true, null);
//        talla12Column = new ColumnConfig("6", nombreCaso2Columns[7], 30, true, null);
//
//        talla6mColumn = new ColumnConfig("6 1/2", nombreCaso2Columns[8], 35, true, null);
//        talla7Column = new ColumnConfig("7", nombreCaso2Columns[9], 30, true, null);
//        talla7mColumn = new ColumnConfig("7 1/2", nombreCaso2Columns[10], 35, true, null);
//        talla8Column = new ColumnConfig("8", nombreCaso2Columns[11], 30, true, null);
//        talla8mColumn = new ColumnConfig("8 1/2", nombreCaso2Columns[12], 35, true, null);
//        talla9Column = new ColumnConfig("9", nombreCaso2Columns[13], 30, true, null);
//        talla9mColumn = new ColumnConfig("9 1/2", nombreCaso2Columns[14], 35, true, null);
//        talla10Column = new ColumnConfig("10", nombreCaso2Columns[15], 30, true, null);
//
//        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso2Columns[16], 5, true, null);
//        totalparesColumn = new ColumnConfig("# Pares", nombreCaso2Columns[17], 80, true, null);
//       //    TextField tex_detalle11 = new TextField();
//       //  lineaColumn.setEditor(new GridEditor(tex_detalle11));
////         TextField tex_detalle = new TextField();
////         colorColumn.setEditor(new GridEditor(tex_detalle));
////         TextField tex_detalle1 = new TextField();
////         materialColumn.setEditor(new GridEditor(tex_detalle1));
//    // colorColumn.setEditor(new GridEditor(metodoFeli()));
//        precioColumn.setEditor(new GridEditor(metodoFeli()));
//        talla11Column.setEditor(new GridEditor(metodoFeli()));
//        talla11mColumn.setEditor(new GridEditor(metodoFeli()));
//        talla12Column.setEditor(new GridEditor(metodoFeli()));
//
//        talla6mColumn.setEditor(new GridEditor(metodoFeli()));
//        talla7Column.setEditor(new GridEditor(metodoFeli()));
//        talla7mColumn.setEditor(new GridEditor(metodoFeli()));
//        talla8Column.setEditor(new GridEditor(metodoFeli()));
//        talla8mColumn.setEditor(new GridEditor(metodoFeli()));
//        talla9Column.setEditor(new GridEditor(metodoFeli()));
//        talla9mColumn.setEditor(new GridEditor(metodoFeli()));
//        talla10Column.setEditor(new GridEditor(metodoFeli()));
//        totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
//        totalparesColumn.setEditor(new GridEditor(metodoFeli()));
//
//        cbSelectionModel = new CheckboxSelectionModel();
//        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
//                    new CheckboxColumnConfig(cbSelectionModel),
//                    lineaColumn,
//                    colorColumn,
//                    materialColumn,
//                    precioColumn,
//                    talla11Column,
//                    talla11mColumn,
//                    talla12Column,
//                    talla6mColumn,
//                    talla7Column,
//                    talla7mColumn,
//                    talla8Column,
//                    talla8mColumn,
//                    talla9Column,
//                    talla9mColumn,
//                    talla10Column,
//                    totalcajasColumn,
//                    totalparesColumn
//                };
//
//        columnModel = new ColumnModel(columns);
//
//        grid = new EditorGridPanel();
//        //grid.setId("grid-lista-productosproveedor");
//        grid.setWidth("100%");
//        grid.setHeight(ALTO);
//        grid.setTitle("Lista de Calzados");
//        grid.setStore(store);
//        grid.setColumnModel(columnModel);
//        grid.setTrackMouseOver(true);
//        grid.setLoadMask(true);
//        grid.setSelectionModel(new RowSelectionModel());
//        grid.setSelectionModel(cbSelectionModel);
//        grid.setFrame(true);
//        grid.setStripeRows(true);
//        grid.setIconCls("grid-icon");
//        grid.setAutoScroll(true);
//        grid.setClicksToEdit(1);
//
//        eliminarProducto = new ToolbarButton("Quitar");
//        eliminarProducto.setEnableToggle(true);
//        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
//        tipsConfig2.setText("Quitar producto(s)");
//        //tipsConfig.setTitle("Tip Title");
//        eliminarProducto.setTooltip(tipsConfig2);
//        guardarProducto = new ToolbarButton("Guardar Cambios");
//        guardarProducto.setEnableToggle(true);
//        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
//        tipsConfig3.setText("Guardar cambio(s)");
//        guardarProducto.setTooltip(tipsConfig3);
//
//        pagingToolbar = new PagingToolbar(store);
//        pagingToolbar.setPageSize(100);
//        pagingToolbar.setDisplayInfo(false);
//        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
//        pagingToolbar.setEmptyMsg("No topics to display");
//        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(eliminarProducto);
//// pagingToolbar.addSeparator();
////        pagingToolbar.addButton(guardarProducto);
//        grid.setBottomToolbar(pagingToolbar);
//        aniadirListenersProducto();
//        panel.add(grid);
    }

    public void onModuleLoad5(String idmarca, String idestilos,String idkardex,Object[][] MaterialM1) {
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        this.idkardex = idkardex;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "12";
         this.colorM = MaterialM1;
        //this.colorM = colorM;
        // String enlace = "php/Co.php?funcion=CargarConfirmarPedido&idmarca=" + idmarca+"&idestilo"+idestilo;

        dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idalmacen=" + idestilo+ "&idkardex=" + idkardex);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso5Columns[0]),
                    new StringFieldDef(nombreCaso5Columns[1]),
                    new StringFieldDef(nombreCaso5Columns[2]),
                    new StringFieldDef(nombreCaso5Columns[3]),
                    new StringFieldDef(nombreCaso5Columns[4]),
                    new StringFieldDef(nombreCaso5Columns[5]),
                    new StringFieldDef(nombreCaso5Columns[6]),
                    new StringFieldDef(nombreCaso5Columns[7]),
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
                    new StringFieldDef(nombreCaso5Columns[19]),
                    new StringFieldDef(nombreCaso5Columns[20])
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
        //SimpleStore paisStore = new SimpleStore(new String[]{"idcliente", "codigo"},nombreCaso3Columns[2]);
        paisStore1.load();

        final ComboBox cbVendedor = new ComboBox();
        cbVendedor.setStore(paisStore1);

        cbVendedor.setDisplayField("codigo");
        cbVendedor.setFieldLabel("codigo");
        cbVendedor.setValueField("codigo");
        cbVendedor.setMinChars(1);


        clienteColumn.setEditor(new GridEditor(cbVendedor));

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso5Columns[5], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso5Columns[6], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso5Columns[7], 100, true);
        talla33Column = new ColumnConfig("33", nombreCaso5Columns[8], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso5Columns[9], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso5Columns[10], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso5Columns[11], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso5Columns[12], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso5Columns[13], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso5Columns[14], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso5Columns[15], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso5Columns[16], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso5Columns[17], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso5Columns[18], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso5Columns[19], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso5Columns[20], 80, true, null);

    TextField tex_detalle = new TextField();
        colorColumn.setEditor(new GridEditor(tex_detalle));
         TextField tex_detalle1 = new TextField();
        materialColumn.setEditor(new GridEditor(tex_detalle1));
     //   TextField tex_detalle2 = new TextField();
      //  clienteColumn.setEditor(new GridEditor(tex_detalle2));
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

        totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        totalparesColumn.setEditor(new GridEditor(metodoFeli()));



        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    colorColumn,
                    clienteColumn,
                      totalcajasColumn,
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

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);

        guardarProducto = new ToolbarButton("Guardar Cambios");
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
        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
//        pagingToolbar.addButton(guardarProducto);


        grid.setBottomToolbar(pagingToolbar);

//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();
  aniadirListenersProductoEspecial();
       // aniadirListenersProducto();
        panel.add(grid);
    }

public void onModuleLoad52(String idmarca, String idestilos,String idkardex,Object[][] MaterialM1, String[] tipo) {
        panel = new Panel();
        //panel.setId("panel-lista-productosproveedor");
        this.idkardex = idkardex;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "12";
        this.tipoM = tipo;
         this.colorM = MaterialM1;
        //this.colorM = colorM;
        // String enlace = "php/Co.php?funcion=CargarConfirmarPedido&idmarca=" + idmarca+"&idestilo"+idestilo;
//        dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idalmacen=" + idestilo+ "&idkardex=" + idkardex);

        dataProxy = new ScriptTagProxy("");

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso52Columns[0]),
                    new StringFieldDef(nombreCaso52Columns[1]),
                    new StringFieldDef(nombreCaso52Columns[2]),
                    new StringFieldDef(nombreCaso52Columns[3]),
                    new StringFieldDef(nombreCaso52Columns[4]),
                    new StringFieldDef(nombreCaso52Columns[5]),
                    new StringFieldDef(nombreCaso52Columns[6]),
                    new StringFieldDef(nombreCaso52Columns[7]),
                    new FloatFieldDef(nombreCaso52Columns[8]),
                    new FloatFieldDef(nombreCaso52Columns[9]),
                    new FloatFieldDef(nombreCaso52Columns[10]),
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
                    new StringFieldDef(nombreCaso52Columns[24]),
                    new StringFieldDef(nombreCaso52Columns[25])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso52Columns[0], 100, true);
        codigoColumn = new ColumnConfig("", nombreCaso52Columns[1], 80, true);
        materialColumn = new ColumnConfig("", nombreCaso52Columns[2], 100, true);
       // colorColumn = new ColumnConfig("Color", nombreCaso52Columns[3], 100, true);

        clienteColumn = new ColumnConfig("", nombreCaso52Columns[3], 100, true);
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

        totalcajasColumn = new ColumnConfig("Cajas", nombreCaso52Columns[4], 70, true, null);
        precioColumn = new ColumnConfig("Venta", nombreCaso52Columns[5], 80, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso52Columns[6], 80, true);
         talla = new ColumnConfig("GS", nombreCaso52Columns[7], 50, true, null);
        talla33Column = new ColumnConfig("3m", nombreCaso52Columns[8], 35, true, null);
        talla34Column = new ColumnConfig("4", nombreCaso52Columns[9], 35, true, null);
        talla35Column = new ColumnConfig("4m", nombreCaso52Columns[10], 35, true, null);
        talla36Column = new ColumnConfig("5", nombreCaso52Columns[11], 35, true, null);
        talla37Column = new ColumnConfig("5m", nombreCaso52Columns[12], 35, true, null);
        talla38Column = new ColumnConfig("6", nombreCaso52Columns[13], 35, true, null);
        talla39Column = new ColumnConfig("11", nombreCaso52Columns[14], 35, true, null);
        talla40Column = new ColumnConfig("12", nombreCaso52Columns[15], 35, true, null);
        talla41Column = new ColumnConfig("13", nombreCaso52Columns[16], 35, true, null);
        talla42Column = new ColumnConfig("1", nombreCaso52Columns[17], 35, true, null);
        talla10Column = new ColumnConfig("1m", nombreCaso52Columns[18], 35, true, null);
        talla10mColumn = new ColumnConfig("2", nombreCaso52Columns[19], 35, true, null);
        talla11Column = new ColumnConfig("2m", nombreCaso52Columns[20], 35, true, null);
        talla11mColumn = new ColumnConfig("-", nombreCaso52Columns[21], 35, true, null);
        talla12Column = new ColumnConfig("3", nombreCaso52Columns[22], 35, true, null);
        totalparesColumn = new ColumnConfig("Pares", nombreCaso52Columns[23], 80, true, null);
        totalparescajaColumn = new ColumnConfig("caja", nombreCaso52Columns[24], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Sus", nombreCaso5Columns[25], 80, true, null);

    //TextField tex_detalle = new TextField();
     //   colorColumn.setEditor(new GridEditor(tex_detalle));
         TextField tex_detalle1 = new TextField();
        materialColumn.setEditor(new GridEditor(tex_detalle1));
     //   TextField tex_detalle2 = new TextField();
      //  clienteColumn.setEditor(new GridEditor(tex_detalle2));
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
talla10Column.setEditor(new GridEditor(metodoFeli()));
        talla10mColumn.setEditor(new GridEditor(metodoFeli()));
        talla11Column.setEditor(new GridEditor(metodoFeli()));
        talla11mColumn.setEditor(new GridEditor(metodoFeli()));
        talla12Column.setEditor(new GridEditor(metodoFeli()));
        totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        totalparesColumn.setEditor(new GridEditor(metodoFeli()));



        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    //colorColumn,
                    clienteColumn,
                      totalcajasColumn,
                    precioColumn,
                          preciounitarioColumn,
                          talla,
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
                    talla10Column,
                    talla10mColumn,
                    talla11Column,
                    talla11mColumn,
                    talla12Column,
                   totalparescajaColumn,
                    totalparesbsColumn
                   };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        //grid.setTitle("Lista de Calzados");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(false);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setAutoScroll(false);
        grid.setClicksToEdit(1);

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);

        guardarProducto = new ToolbarButton("Guardar Cambios");
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
        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
//        pagingToolbar.addButton(guardarProducto);


        grid.setBottomToolbar(pagingToolbar);

//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();
  aniadirListenersProductoEspecial();
       // aniadirListenersProducto();
        panel.add(grid);
    }

    
    public void onModuleLoad6(String idmarca, String idestilos,String idkardex) {
        panel = new Panel();
        this.idkardex=idkardex;
        //panel.setId("panel-lista-productosproveedor");
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "13";
        //this.colorM = colorM;
        // String enlace = "php/Co.php?funcion=CargarConfirmarPedido&idmarca=" + idmarca+"&idestilo"+idestilo;

      //  dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterial&idmarca=" + idpedido + "&idestilo=" + idestilo);
 dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialinventarioinventario&idmarca=" + idpedido + "&idestilo=" + idestilo+ "&idkardex=" + idkardex);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso6Columns[0]),
                    new StringFieldDef(nombreCaso6Columns[1]),
                    new StringFieldDef(nombreCaso6Columns[2]),
                    new StringFieldDef(nombreCaso6Columns[3]),
                    new FloatFieldDef(nombreCaso6Columns[4]),
                    new FloatFieldDef(nombreCaso6Columns[5]),
                    new FloatFieldDef(nombreCaso6Columns[6]),
                    new FloatFieldDef(nombreCaso6Columns[7]),
                    new FloatFieldDef(nombreCaso6Columns[8]),
                    new FloatFieldDef(nombreCaso6Columns[9]),
                    new FloatFieldDef(nombreCaso6Columns[10]),
                    new FloatFieldDef(nombreCaso6Columns[11]),
                    new FloatFieldDef(nombreCaso6Columns[12]),
                    new FloatFieldDef(nombreCaso6Columns[13]),
                    new FloatFieldDef(nombreCaso6Columns[14]),
                    new FloatFieldDef(nombreCaso6Columns[15]),
                    new FloatFieldDef(nombreCaso6Columns[16]),
                    new FloatFieldDef(nombreCaso6Columns[17]),
                    new FloatFieldDef(nombreCaso6Columns[18]),
                    new FloatFieldDef(nombreCaso6Columns[19])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso6Columns[0], 100, true);
        coleccionColumn = new ColumnConfig("Col.", nombreCaso6Columns[1], 70, true);

        codigoColumn = new ColumnConfig("Modelo", nombreCaso6Columns[2], 80, true);
        colorColumn = new ColumnConfig("Material", nombreCaso6Columns[3], 85, true);
        precioColumn = new ColumnConfig("Precio", nombreCaso6Columns[4], 80, true);

        talla33Column = new ColumnConfig("33", nombreCaso6Columns[5], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso6Columns[6], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso6Columns[7], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso6Columns[8], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso6Columns[9], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso6Columns[10], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso6Columns[11], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso6Columns[12], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso6Columns[13], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso6Columns[14], 30, true, null);
        talla43Column = new ColumnConfig("43", nombreCaso6Columns[15], 30, true, null);
        talla44Column = new ColumnConfig("44", nombreCaso6Columns[16], 30, true, null);
        talla45Column = new ColumnConfig("45", nombreCaso6Columns[17], 30, true, null);

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso6Columns[18], 5, true, null);
        totalparesColumn = new ColumnConfig("# Pares", nombreCaso6Columns[19], 80, true, null);
        //colorColumn.setEditor(new GridEditor(metodoFeli()));
      
        precioColumn.setEditor(new GridEditor(metodoFeli()));

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

        totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        totalparesColumn.setEditor(new GridEditor(metodoFeli()));
        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    coleccionColumn,
                    codigoColumn,
                    colorColumn,
                    precioColumn,
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
                    totalcajasColumn,
                    totalparesColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);

        guardarProducto = new ToolbarButton("Guardar Cambios");
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
        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
//        pagingToolbar.addButton(guardarProducto);


        grid.setBottomToolbar(pagingToolbar);

//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();

        aniadirListenersProducto();
        panel.add(grid);
    }

    public void onModuleLoad7(String idmarca, String idestilos,String idkardex) {
        panel = new Panel();
        this.idkardex=idkardex;
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "14";
        dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoColorinventario&idmarca=" + idpedido + "&idestilo=" + idestilo+ "&idkardex=" + idkardex);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso7Columns[0]),
                    new StringFieldDef(nombreCaso7Columns[1]),
                    new StringFieldDef(nombreCaso7Columns[2]),
                    new StringFieldDef(nombreCaso7Columns[3]),
                    new FloatFieldDef(nombreCaso7Columns[4]),
                    new FloatFieldDef(nombreCaso7Columns[5]),
                    new FloatFieldDef(nombreCaso7Columns[6]),
                    new FloatFieldDef(nombreCaso7Columns[7]),
                    new FloatFieldDef(nombreCaso7Columns[8]),
                    new FloatFieldDef(nombreCaso7Columns[9]),
                    new FloatFieldDef(nombreCaso7Columns[10]),
                    new FloatFieldDef(nombreCaso7Columns[11]),
                    new FloatFieldDef(nombreCaso7Columns[12]),
                    new FloatFieldDef(nombreCaso7Columns[13]),
                    new FloatFieldDef(nombreCaso7Columns[14]),
                    new FloatFieldDef(nombreCaso7Columns[15]),
                    new FloatFieldDef(nombreCaso7Columns[16]),
                    new FloatFieldDef(nombreCaso7Columns[17]),
                    new FloatFieldDef(nombreCaso7Columns[18]),
                    new FloatFieldDef(nombreCaso7Columns[19]),
                    new FloatFieldDef(nombreCaso7Columns[20]),
                    new FloatFieldDef(nombreCaso7Columns[21]),
                    new FloatFieldDef(nombreCaso7Columns[22]),
                    new FloatFieldDef(nombreCaso7Columns[23]),
                    new FloatFieldDef(nombreCaso7Columns[24]),
                    new FloatFieldDef(nombreCaso7Columns[25]),
                    new FloatFieldDef(nombreCaso7Columns[26]),
                    new FloatFieldDef(nombreCaso7Columns[27]),
                    new FloatFieldDef(nombreCaso7Columns[28]),
                    new FloatFieldDef(nombreCaso7Columns[29]),
                    new FloatFieldDef(nombreCaso7Columns[30])
                });

        reader = new JsonReader(recordDef);
        reader.setRoot(
                "resultado");
        reader.setTotalProperty(
                "totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso7Columns[0], 20, true);
        codigoColumn = new ColumnConfig("Modelo", nombreCaso7Columns[1], 70, true);
        colorColumn = new ColumnConfig("Color", nombreCaso7Columns[2], 70, true);
        precioColumn = new ColumnConfig("Precio", nombreCaso7Columns[3], 80, true);


        talla14Column = new ColumnConfig("14", nombreCaso7Columns[4], 30, true, null);
        talla15Column = new ColumnConfig("15", nombreCaso7Columns[5], 30, true, null);
        talla16Column = new ColumnConfig("16", nombreCaso7Columns[6], 30, true, null);
        talla17Column = new ColumnConfig("17", nombreCaso7Columns[7], 30, true, null);
        talla18Column = new ColumnConfig("18", nombreCaso7Columns[8], 30, true, null);
        talla19Column = new ColumnConfig("19", nombreCaso7Columns[9], 30, true, null);
        talla20Column = new ColumnConfig("20", nombreCaso7Columns[10], 30, true, null);
        talla21Column = new ColumnConfig("21", nombreCaso7Columns[11], 30, true, null);
        talla22Column = new ColumnConfig("22", nombreCaso7Columns[12], 30, true, null);
        talla23Column = new ColumnConfig("23", nombreCaso7Columns[13], 30, true, null);
        talla24Column = new ColumnConfig("24", nombreCaso7Columns[14], 30, true, null);
        talla25Column = new ColumnConfig("25", nombreCaso7Columns[15], 30, true, null);
        talla26Column = new ColumnConfig("26", nombreCaso7Columns[16], 30, true, null);
        talla27Column = new ColumnConfig("27", nombreCaso7Columns[17], 30, true, null);
        talla28Column = new ColumnConfig("28", nombreCaso7Columns[18], 30, true, null);
        talla29Column = new ColumnConfig("29", nombreCaso7Columns[19], 30, true, null);
        talla30Column = new ColumnConfig("30", nombreCaso7Columns[20], 30, true, null);
        talla31Column = new ColumnConfig("31", nombreCaso7Columns[21], 30, true, null);
        // talla31Column = new ColumnConfig("21", nombreC7o1Columns[10], 200, true, null);
        talla32Column = new ColumnConfig("32", nombreCaso7Columns[22], 30, true, null);
        talla33Column = new ColumnConfig("33", nombreCaso7Columns[23], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso7Columns[24], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso7Columns[25], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso7Columns[26], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso7Columns[27], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso7Columns[28], 30, true, null);
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso7Columns[29], 5, true, null);
        totalparesColumn = new ColumnConfig("# Pares", nombreCaso7Columns[30], 80, true, null);
       
        precioColumn.setEditor(new GridEditor(metodoFeli()));

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
        totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        totalparesColumn.setEditor(new GridEditor(metodoFeli()));
        cbSelectionModel = new CheckboxSelectionModel();

        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    colorColumn,
                    precioColumn,
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
                    totalcajasColumn,
                    totalparesColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

        grid.addGridCellListener(new GridCellListenerAdapter() {

            @Override
            public void onCellClick(GridPanel grid, int rowIndex, int colIndex, EventObject e) {
                if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor") &&
                        e.getTarget(".checkbox", 1) != null) {
                    Record record = grid.getStore().getAt(rowIndex);
                    record.set("indoor", !record.getAsBoolean("indoor"));
                }
            }
        });

        eliminarProducto = new ToolbarButton("Quitar");

        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();

        tipsConfig2.setText("Quitar producto(s)");
        //tipsConfig.setTitle("Tip Title");

        eliminarProducto.setTooltip(tipsConfig2);
        guardarProducto = new ToolbarButton("Guardar Cambios");
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
        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
//        pagingToolbar.addButton(guardarProducto);

        grid.setBottomToolbar(pagingToolbar);

//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();
        aniadirListenersProducto();

        panel.add(grid);
    }

    public void onModuleLoad9(String idmarca, String idestilos,String idkardex) {
        panel = new Panel();
        this.idkardex=idkardex;
        //panel.setId("panel-lista-productosproveedor");
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "1";
        //this.colorM = colorM;
        // String enlace = "php/Co.php?funcion=CargarConfirmarPedido&idmarca=" + idmarca+"&idestilo"+idestilo;

        dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoinventario&idmarca=" + idpedido + "&idestilo=" + idestilo+ "&idkardex=" + idkardex);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso9Columns[0]),
                    new StringFieldDef(nombreCaso9Columns[1]),
                    new FloatFieldDef(nombreCaso9Columns[2]),
                    new FloatFieldDef(nombreCaso9Columns[3]),
                    new FloatFieldDef(nombreCaso9Columns[4]),
                    new FloatFieldDef(nombreCaso9Columns[5]),
                    new FloatFieldDef(nombreCaso9Columns[6]),
                    new FloatFieldDef(nombreCaso9Columns[7]),
                    new FloatFieldDef(nombreCaso9Columns[8]),
                    new FloatFieldDef(nombreCaso9Columns[9]),
                    new FloatFieldDef(nombreCaso9Columns[10]),
                    new FloatFieldDef(nombreCaso9Columns[11]),
                    new FloatFieldDef(nombreCaso9Columns[12]),
                    new FloatFieldDef(nombreCaso9Columns[13]),
                    new FloatFieldDef(nombreCaso9Columns[14]),
                    new FloatFieldDef(nombreCaso9Columns[15]),
                    new FloatFieldDef(nombreCaso9Columns[16]),
                    new FloatFieldDef(nombreCaso9Columns[17])
                });

        reader = new JsonReader(recordDef);
        reader.setRoot(
                "resultado");
        reader.setTotalProperty(
                "totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso9Columns[0], 20, true);
        codigoColumn = new ColumnConfig("Modelo", nombreCaso9Columns[1], 140, true);
        precioColumn = new ColumnConfig("Precio", nombreCaso9Columns[2], 80, true);
        talla14Column = new ColumnConfig("33", nombreCaso9Columns[3], 30, true, null);
        talla15Column = new ColumnConfig("34", nombreCaso9Columns[4], 30, true, null);
        talla16Column = new ColumnConfig("35", nombreCaso9Columns[5], 30, true, null);
        talla17Column = new ColumnConfig("36", nombreCaso9Columns[6], 30, true, null);
        talla18Column = new ColumnConfig("37", nombreCaso9Columns[7], 30, true, null);
        talla19Column = new ColumnConfig("38", nombreCaso9Columns[8], 30, true, null);
        talla20Column = new ColumnConfig("39", nombreCaso9Columns[9], 30, true, null);
        talla21Column = new ColumnConfig("40", nombreCaso9Columns[10], 30, true, null);
        talla22Column = new ColumnConfig("41", nombreCaso9Columns[11], 30, true, null);

        talla8Column = new ColumnConfig("42", nombreCaso9Columns[12], 30, true, null);
        talla8mColumn = new ColumnConfig("43", nombreCaso9Columns[13], 35, true, null);
        talla9Column = new ColumnConfig("44", nombreCaso9Columns[14], 30, true, null);
        talla9mColumn = new ColumnConfig("45", nombreCaso9Columns[15], 35, true, null);
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso9Columns[16], 5, true, null);
        totalparesColumn = new ColumnConfig("# Pares", nombreCaso9Columns[17], 80, true, null);
      //  colorColumn.setEditor(new GridEditor(metodoFeli()));
        // TextField tex_detalle1 = new TextField();
        // codigoColumn.setEditor(new GridEditor(tex_detalle1));
        precioColumn.setEditor(new GridEditor(metodoFeli()));

        talla14Column.setEditor(new GridEditor(metodoFeli()));
        talla15Column.setEditor(new GridEditor(metodoFeli()));
        talla16Column.setEditor(new GridEditor(metodoFeli()));
        talla17Column.setEditor(new GridEditor(metodoFeli()));
        talla18Column.setEditor(new GridEditor(metodoFeli()));
        talla19Column.setEditor(new GridEditor(metodoFeli()));
        talla20Column.setEditor(new GridEditor(metodoFeli()));
        talla21Column.setEditor(new GridEditor(metodoFeli()));
        talla22Column.setEditor(new GridEditor(metodoFeli()));
        talla8Column.setEditor(new GridEditor(metodoFeli()));
        talla8mColumn.setEditor(new GridEditor(metodoFeli()));
        talla9Column.setEditor(new GridEditor(metodoFeli()));
        talla9mColumn.setEditor(new GridEditor(metodoFeli()));

        totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        totalparesColumn.setEditor(new GridEditor(metodoFeli()));
        cbSelectionModel = new CheckboxSelectionModel();

        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    precioColumn,
                    talla14Column,
                    talla15Column,
                    talla16Column,
                    talla17Column,
                    talla18Column,
                    talla19Column,
                    talla20Column,
                    talla21Column,
                    talla22Column,
                    talla8Column,
                    talla8mColumn,
                    talla9Column,
                    talla9mColumn,
                    totalcajasColumn,
                    totalparesColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

        grid.addGridCellListener(new GridCellListenerAdapter() {

            @Override
            public void onCellClick(GridPanel grid, int rowIndex, int colIndex, EventObject e) {
                if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor") &&
                        e.getTarget(".checkbox", 1) != null) {
                    Record record = grid.getStore().getAt(rowIndex);
                    record.set("indoor", !record.getAsBoolean("indoor"));
                }
            }
        });

        eliminarProducto = new ToolbarButton("Eliminar modelo");

        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();

        tipsConfig2.setText("Quitar producto(s)");
        //tipsConfig.setTitle("Tip Title");

        eliminarProducto.setTooltip(tipsConfig2);
        guardarProducto = new ToolbarButton("Guardar Cambios");
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
        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
//        pagingToolbar.addButton(guardarProducto);

        grid.setBottomToolbar(pagingToolbar);

//        aniadirListenersBuscador();
//
//        aniadirListenersBuscadoresText();
        aniadirListenersProducto();

        panel.add(grid);
    }

    public void onModuleLoad10(String idmarca, String idestilos,String idkardex,Object[][] MaterialM1) {
        panel = new Panel();
        this.idkardex = idkardex;
        //panel.setId("panel-lista-productosproveedor");
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "15";
         this.colorM = MaterialM1;
        //this.colorM = colorM;
        // String enlace = "php/Co.php?funcion=CargarConfirmarPedido&idmarca=" + idmarca+"&idestilo"+idestilo;

        dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idestilo=" + idestilo+ "&idkardex=" + idkardex);
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso10Columns[0]),
                    new StringFieldDef(nombreCaso10Columns[1]),
                    new StringFieldDef(nombreCaso10Columns[2]),
                    new FloatFieldDef(nombreCaso10Columns[3]),
                    new FloatFieldDef(nombreCaso10Columns[4]),
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
                    new FloatFieldDef(nombreCaso10Columns[21])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso10Columns[0], 20, true);
        lineaColumn = new ColumnConfig("Codigo", nombreCaso10Columns[1], 80, true);
        //    colorColumn = new ColumnConfig("Color", nombreCaso8Columns[2], 55, true);
        materialColumn = new ColumnConfig("Color", nombreCaso10Columns[2], 180, true);

        precioColumn = new ColumnConfig("Precio", nombreCaso10Columns[3], 55, true);
          talla30Column = new ColumnConfig("30", nombreCaso10Columns[4], 30, true, null);
        talla31Column = new ColumnConfig("31", nombreCaso10Columns[5], 35, true, null);
        talla32Column = new ColumnConfig("32", nombreCaso10Columns[6], 30, true, null);
        talla3mColumn = new ColumnConfig("33", nombreCaso10Columns[7], 35, true, null);
        talla4Column = new ColumnConfig("34", nombreCaso10Columns[8], 30, true, null);
        talla4mColumn = new ColumnConfig("35", nombreCaso10Columns[9], 35, true, null);
        talla5Column = new ColumnConfig("36", nombreCaso10Columns[10], 30, true, null);
        talla5mColumn = new ColumnConfig("37", nombreCaso10Columns[11], 35, true, null);
        talla6Column = new ColumnConfig("38", nombreCaso10Columns[12], 30, true, null);
        talla6mColumn = new ColumnConfig("39", nombreCaso10Columns[13], 35, true, null);
        talla7Column = new ColumnConfig("40", nombreCaso10Columns[14], 30, true, null);
        talla7mColumn = new ColumnConfig("41", nombreCaso10Columns[15], 35, true, null);
        talla8Column = new ColumnConfig("42", nombreCaso10Columns[16], 30, true, null);
        talla8mColumn = new ColumnConfig("43", nombreCaso10Columns[17], 35, true, null);
        talla9Column = new ColumnConfig("44", nombreCaso10Columns[18], 30, true, null);
        talla9mColumn = new ColumnConfig("45", nombreCaso10Columns[19], 35, true, null);
        // talla10Column = new ColumnConfig("10", nombreCaso3Columns[18], 30, true, null);
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso10Columns[20], 5, true, null);
        totalparesColumn = new ColumnConfig("# Pares", nombreCaso10Columns[21], 80, true, null);

        precioColumn.setEditor(new GridEditor(metodoFeli()));
talla30Column.setEditor(new GridEditor(metodoFeli()));
        talla31Column.setEditor(new GridEditor(metodoFeli()));
        talla32Column.setEditor(new GridEditor(metodoFeli()));
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


        totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        totalparesColumn.setEditor(new GridEditor(metodoFeli()));



        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    lineaColumn,
                    //   colorColumn,
                    materialColumn,
                    precioColumn,
                     talla30Column,
                    talla31Column,
                    talla32Column,
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
                    //        talla10Column,
                    totalcajasColumn,
                    totalparesColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);
        guardarProducto = new ToolbarButton("Guardar Cambios");
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
        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();we
//        pagingToolbar.addButton(guardarProducto);

        grid.setBottomToolbar(pagingToolbar);
       // aniadirListenersProducto();
      aniadirListenersProductoEspecial();
        panel.add(grid);
    }

    public void onModuleLoad101(String idmarca, String idestilos,String idkardex) {
        panel = new Panel();
        this.idkardex=idkardex;
        //panel.setId("panel-lista-productosproveedor");
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "9";
        dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idestilo=" + idestilo+ "&idkardex=" + idkardex);
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso11Columns[0]),
                    new StringFieldDef(nombreCaso11Columns[1]),
                    new StringFieldDef(nombreCaso11Columns[2]),
                    new StringFieldDef(nombreCaso11Columns[3]),
                    new FloatFieldDef(nombreCaso11Columns[4]),
                    new FloatFieldDef(nombreCaso11Columns[5]),
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
                    new FloatFieldDef(nombreCaso11Columns[18])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso11Columns[0], 20, true);
        lineaColumn = new ColumnConfig("Modelo", nombreCaso11Columns[1], 80, true);
        colorColumn = new ColumnConfig("Color", nombreCaso11Columns[2], 55, true);


        precioColumn = new ColumnConfig("Precio", nombreCaso11Columns[3], 55, true);
        talla6Column = new ColumnConfig("6", nombreCaso11Columns[4], 35, true, null);
        talla6mColumn = new ColumnConfig("6 1/2", nombreCaso11Columns[5], 35, true, null);
        talla7Column = new ColumnConfig("7", nombreCaso11Columns[6], 30, true, null);
        talla7mColumn = new ColumnConfig("7 1/2", nombreCaso11Columns[7], 35, true, null);
        talla8Column = new ColumnConfig("8", nombreCaso11Columns[8], 30, true, null);
        talla8mColumn = new ColumnConfig("8 1/2", nombreCaso11Columns[9], 35, true, null);
        talla9Column = new ColumnConfig("9", nombreCaso11Columns[10], 30, true, null);
        talla9mColumn = new ColumnConfig("9 1/2", nombreCaso11Columns[11], 35, true, null);
        talla10Column = new ColumnConfig("10", nombreCaso11Columns[12], 30, true, null);
        talla10mColumn = new ColumnConfig("10 1/2", nombreCaso11Columns[13], 40, true, null);
        talla11Column = new ColumnConfig("11", nombreCaso11Columns[14], 30, true, null);
        talla11mColumn = new ColumnConfig("11 1/2", nombreCaso11Columns[15], 40, true, null);
        talla12Column = new ColumnConfig("12", nombreCaso11Columns[16], 30, true, null);

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso11Columns[17], 5, true, null);
        totalparesColumn = new ColumnConfig("# Pares", nombreCaso11Columns[18], 80, true, null);
      
        precioColumn.setEditor(new GridEditor(metodoFeli()));
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

        totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        totalparesColumn.setEditor(new GridEditor(metodoFeli()));
        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    lineaColumn,
                    colorColumn,
                    precioColumn,
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
                    totalcajasColumn,
                    totalparesColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);
        guardarProducto = new ToolbarButton("Guardar Cambios");
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
        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
//        pagingToolbar.addButton(guardarProducto);

        grid.setBottomToolbar(pagingToolbar);
        aniadirListenersProducto();
        panel.add(grid);
    }

    public void onModuleLoad102(String idmarca, String idestilos,String idkardex) {
        panel = new Panel();
        this.idkardex=idkardex;
        //panel.setId("panel-lista-productosproveedor");
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "10";
        dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idestilo=" + idestilo+ "&idkardex=" + idkardex);
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso22Columns[0]),
                    new StringFieldDef(nombreCaso22Columns[1]),
                    new StringFieldDef(nombreCaso22Columns[2]),
                    new FloatFieldDef(nombreCaso22Columns[3]),
                    new FloatFieldDef(nombreCaso22Columns[4]),
                    new FloatFieldDef(nombreCaso22Columns[5]),
                    new FloatFieldDef(nombreCaso22Columns[6]),
                    new FloatFieldDef(nombreCaso22Columns[7]),
                    new FloatFieldDef(nombreCaso22Columns[8]),
                    new FloatFieldDef(nombreCaso22Columns[9]),
                    new FloatFieldDef(nombreCaso22Columns[10]),
                    new FloatFieldDef(nombreCaso22Columns[11]),
                    new FloatFieldDef(nombreCaso22Columns[12]),
                    new FloatFieldDef(nombreCaso22Columns[13]),
                    new FloatFieldDef(nombreCaso22Columns[14]),
                    new FloatFieldDef(nombreCaso22Columns[15]),
                    new FloatFieldDef(nombreCaso22Columns[16]),
                    new FloatFieldDef(nombreCaso22Columns[17]),
                    new FloatFieldDef(nombreCaso22Columns[18])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso22Columns[0], 20, true);
        lineaColumn = new ColumnConfig("Modelo", nombreCaso22Columns[1], 80, true);
        colorColumn = new ColumnConfig("Color", nombreCaso22Columns[2], 90, true);

        precioColumn = new ColumnConfig("Precio", nombreCaso22Columns[3], 55, true);
        talla5Column = new ColumnConfig("5", nombreCaso22Columns[4], 30, true, null);
        talla5mColumn = new ColumnConfig("5 1/2", nombreCaso22Columns[5], 40, true, null);
        talla12Column = new ColumnConfig("6", nombreCaso22Columns[6], 30, true, null);

        talla6mColumn = new ColumnConfig("6 1/2", nombreCaso22Columns[7], 35, true, null);
        talla7Column = new ColumnConfig("7", nombreCaso22Columns[8], 30, true, null);
        talla7mColumn = new ColumnConfig("7 1/2", nombreCaso22Columns[9], 35, true, null);
        talla8Column = new ColumnConfig("8", nombreCaso22Columns[10], 30, true, null);
        talla8mColumn = new ColumnConfig("8 1/2", nombreCaso22Columns[11], 35, true, null);
        talla9Column = new ColumnConfig("9", nombreCaso22Columns[12], 30, true, null);
        talla9mColumn = new ColumnConfig("9 1/2", nombreCaso22Columns[13], 35, true, null);
        talla10Column = new ColumnConfig("10", nombreCaso22Columns[14], 30, true, null);
talla10mColumn = new ColumnConfig("10 1/2", nombreCaso22Columns[15], 35, true, null);
        talla11Column = new ColumnConfig("11", nombreCaso22Columns[16], 30, true, null);

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso22Columns[17], 5, true, null);
        totalparesColumn = new ColumnConfig("# Pares", nombreCaso22Columns[18], 55, true, null);
       
        precioColumn.setEditor(new GridEditor(metodoFeli()));

        talla5Column.setEditor(new GridEditor(metodoFeli()));
        talla5mColumn.setEditor(new GridEditor(metodoFeli()));
        talla12Column.setEditor(new GridEditor(metodoFeli()));

        talla6mColumn.setEditor(new GridEditor(metodoFeli()));
        talla7Column.setEditor(new GridEditor(metodoFeli()));
        talla7mColumn.setEditor(new GridEditor(metodoFeli()));
        talla8Column.setEditor(new GridEditor(metodoFeli()));
        talla8mColumn.setEditor(new GridEditor(metodoFeli()));
        talla9Column.setEditor(new GridEditor(metodoFeli()));
        talla9mColumn.setEditor(new GridEditor(metodoFeli()));
        talla10Column.setEditor(new GridEditor(metodoFeli()));
 talla11Column.setEditor(new GridEditor(metodoFeli()));
        talla10mColumn.setEditor(new GridEditor(metodoFeli()));

        totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        totalparesColumn.setEditor(new GridEditor(metodoFeli()));
        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    lineaColumn,
                    colorColumn,
                    precioColumn,
                    talla5Column,
                    talla5mColumn,
                    talla12Column,
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
                    totalparesColumn,
                    totalcajasColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);
        guardarProducto = new ToolbarButton("Guardar Cambios");
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
        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
//        pagingToolbar.addButton(guardarProducto);

        grid.setBottomToolbar(pagingToolbar);
        aniadirListenersProducto();
        panel.add(grid);
    }

    public void onModuleLoad103(String idmarca, String idestilos,String idkardex) {
        panel = new Panel();
        this.idkardex=idkardex;
        //panel.setId("panel-lista-productosproveedor");
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "11";
        dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idestilo=" + idestilo+ "&idkardex=" + idkardex);
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso33Columns[0]),
                    new StringFieldDef(nombreCaso33Columns[1]),
                    new StringFieldDef(nombreCaso33Columns[2]),
                    new FloatFieldDef(nombreCaso33Columns[3]),
                    new FloatFieldDef(nombreCaso33Columns[4]),
                    new FloatFieldDef(nombreCaso33Columns[5]),
                    new FloatFieldDef(nombreCaso33Columns[6]),
                    new FloatFieldDef(nombreCaso33Columns[7]),
                    new FloatFieldDef(nombreCaso33Columns[8]),
                    new FloatFieldDef(nombreCaso33Columns[9]),
                    new FloatFieldDef(nombreCaso33Columns[10]),
                    new FloatFieldDef(nombreCaso33Columns[11]),
                    new FloatFieldDef(nombreCaso33Columns[12]),
                    new FloatFieldDef(nombreCaso33Columns[13]),
                    new FloatFieldDef(nombreCaso33Columns[14]),
                    new FloatFieldDef(nombreCaso33Columns[15]),
                    new FloatFieldDef(nombreCaso33Columns[16]),
                    new FloatFieldDef(nombreCaso33Columns[17]),
                    new FloatFieldDef(nombreCaso33Columns[18]),
                    new FloatFieldDef(nombreCaso33Columns[19]),
                    new FloatFieldDef(nombreCaso33Columns[20]),
                    new FloatFieldDef(nombreCaso33Columns[21]),
                    new FloatFieldDef(nombreCaso33Columns[22]),
                    new FloatFieldDef(nombreCaso33Columns[23]),
                    new FloatFieldDef(nombreCaso33Columns[24]),
                    new FloatFieldDef(nombreCaso33Columns[25]),
                    new FloatFieldDef(nombreCaso33Columns[26]),
                    new FloatFieldDef(nombreCaso33Columns[27]),
                    new FloatFieldDef(nombreCaso33Columns[28]),
                    new FloatFieldDef(nombreCaso33Columns[29]),
                    new FloatFieldDef(nombreCaso33Columns[30]),
                    new FloatFieldDef(nombreCaso33Columns[31])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso33Columns[0], 20, true);
        lineaColumn = new ColumnConfig("Modelo", nombreCaso33Columns[1], 80, true);
        colorColumn = new ColumnConfig("Color", nombreCaso33Columns[2], 55, true);

        precioColumn = new ColumnConfig("Precio", nombreCaso33Columns[3], 55, true);
        talla1Column = new ColumnConfig("1", nombreCaso33Columns[4], 30, true, null);
        talla1mColumn = new ColumnConfig("1 1/2", nombreCaso33Columns[5], 35, true, null);
        talla2Column = new ColumnConfig("2", nombreCaso33Columns[6], 30, true, null);
        talla2mColumn = new ColumnConfig("2 1/2", nombreCaso33Columns[7], 35, true, null);
        talla3Column = new ColumnConfig("3", nombreCaso33Columns[8], 30, true, null);
        talla3mColumn = new ColumnConfig("3 1/2", nombreCaso33Columns[9], 35, true, null);
        talla4Column = new ColumnConfig("4", nombreCaso33Columns[10], 30, true, null);
        talla4mColumn = new ColumnConfig("4 1/2", nombreCaso33Columns[11], 35, true, null);
        talla5Column = new ColumnConfig("5", nombreCaso33Columns[12], 30, true, null);
        talla5mColumn = new ColumnConfig("5 1/2", nombreCaso33Columns[13], 35, true, null);
        talla6Column = new ColumnConfig("6", nombreCaso33Columns[14], 30, true, null);

        talla6mColumn = new ColumnConfig("6 1/2", nombreCaso33Columns[15], 35, true, null);
        talla7Column = new ColumnConfig("7", nombreCaso33Columns[16], 30, true, null);
        talla7mColumn = new ColumnConfig("7 1/2", nombreCaso33Columns[17], 35, true, null);
        talla8Column = new ColumnConfig("8", nombreCaso33Columns[18], 30, true, null);
        talla8mColumn = new ColumnConfig("8 1/2", nombreCaso33Columns[19], 35, true, null);
        talla9Column = new ColumnConfig("9", nombreCaso33Columns[20], 30, true, null);
        talla9mColumn = new ColumnConfig("9 1/2", nombreCaso33Columns[21], 35, true, null);
        talla10Column = new ColumnConfig("10", nombreCaso33Columns[22], 30, true, null);
        talla10mColumn = new ColumnConfig("10 1/2", nombreCaso33Columns[23], 40, true, null);
        talla11Column = new ColumnConfig("11", nombreCaso33Columns[24], 30, true, null);
        talla11mColumn = new ColumnConfig("11 1/2", nombreCaso33Columns[25], 40, true, null);
        talla12Column = new ColumnConfig("12", nombreCaso33Columns[26], 30, true, null);
        talla12mColumn = new ColumnConfig("12 1/2", nombreCaso33Columns[27], 30, true, null);
        talla13Column = new ColumnConfig("13", nombreCaso33Columns[28], 30, true, null);
        talla13mColumn = new ColumnConfig("13 1/2", nombreCaso33Columns[29], 30, true, null);


        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso33Columns[30], 5, true, null);
        totalparesColumn = new ColumnConfig("# Pares", nombreCaso33Columns[31], 80, true, null);
     
        precioColumn.setEditor(new GridEditor(metodoFeli()));

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
talla13mColumn.setEditor(new GridEditor(metodoFeli()));
        totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        totalparesColumn.setEditor(new GridEditor(metodoFeli()));

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    lineaColumn,
                    colorColumn,
                    precioColumn,
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
                    talla13mColumn,
                    totalcajasColumn,
                    totalparesColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);
        guardarProducto = new ToolbarButton("Guardar Cambios");
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
        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
//        pagingToolbar.addButton(guardarProducto);

        grid.setBottomToolbar(pagingToolbar);
        aniadirListenersProducto();
        panel.add(grid);
    }
    //fin mm

    public void onModuleLoad1011(String idmarca, String idestilos,String idkardex) {
        panel = new Panel();
        this.idkardex=idkardex;
        //panel.setId("panel-lista-productosproveedor");
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "6";
       
       //MessageBox.alert("entro For Lista");
        dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idestilo=" + idestilo+ "&idkardex=" + idkardex);
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso111Columns[0]),
                    new StringFieldDef(nombreCaso111Columns[1]),
                    new FloatFieldDef(nombreCaso111Columns[2]),
                    new FloatFieldDef(nombreCaso111Columns[3]),
                    new FloatFieldDef(nombreCaso111Columns[4]),
                    new FloatFieldDef(nombreCaso111Columns[5]),
                    new FloatFieldDef(nombreCaso111Columns[6]),
                    new FloatFieldDef(nombreCaso111Columns[7]),
                    new FloatFieldDef(nombreCaso111Columns[8]),
                    new FloatFieldDef(nombreCaso111Columns[9]),
                    new FloatFieldDef(nombreCaso111Columns[10]),
                    new FloatFieldDef(nombreCaso111Columns[11]),
                    new FloatFieldDef(nombreCaso111Columns[12]),
                    new FloatFieldDef(nombreCaso111Columns[13]),
                    new FloatFieldDef(nombreCaso111Columns[14]),
                    new FloatFieldDef(nombreCaso111Columns[15]),
                    new FloatFieldDef(nombreCaso111Columns[16])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso111Columns[0], 20, true);
        lineaColumn = new ColumnConfig("Modelo", nombreCaso111Columns[1], 80, true);

        precioColumn = new ColumnConfig("Precio", nombreCaso111Columns[2], 55, true);
        talla6mColumn = new ColumnConfig("6 1/2", nombreCaso111Columns[3], 35, true, null);
        talla7Column = new ColumnConfig("7", nombreCaso111Columns[4], 30, true, null);
        talla7mColumn = new ColumnConfig("7 1/2", nombreCaso111Columns[5], 35, true, null);
        talla8Column = new ColumnConfig("8", nombreCaso111Columns[6], 30, true, null);
        talla8mColumn = new ColumnConfig("8 1/2", nombreCaso111Columns[7], 35, true, null);
        talla9Column = new ColumnConfig("9", nombreCaso111Columns[8], 30, true, null);
        talla9mColumn = new ColumnConfig("9 1/2", nombreCaso111Columns[9], 35, true, null);
        talla10Column = new ColumnConfig("10", nombreCaso111Columns[10], 30, true, null);
        talla10mColumn = new ColumnConfig("10 1/2", nombreCaso111Columns[11], 40, true, null);
        talla11Column = new ColumnConfig("11", nombreCaso111Columns[12], 30, true, null);
        talla11mColumn = new ColumnConfig("11 1/2", nombreCaso111Columns[13], 40, true, null);
        talla12Column = new ColumnConfig("12", nombreCaso111Columns[14], 30, true, null);

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso111Columns[15], 5, true, null);
        totalparesColumn = new ColumnConfig("# Pares", nombreCaso111Columns[16], 80, true, null);
      
        precioColumn.setEditor(new GridEditor(metodoFeli()));

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

        totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        totalparesColumn.setEditor(new GridEditor(metodoFeli()));
        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    lineaColumn,
                    precioColumn,
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
                    totalcajasColumn,
                    totalparesColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);
        guardarProducto = new ToolbarButton("Guardar Cambios");
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
        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
//        pagingToolbar.addButton(guardarProducto);
        grid.setBottomToolbar(pagingToolbar);
        aniadirListenersProducto();
        panel.add(grid);
    }

    public void onModuleLoad1022(String idmarca, String idestilos,String idkardex) {
        panel = new Panel();
        this.idkardex=idkardex;
        //panel.setId("panel-lista-productosproveedor");
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "7";
        dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idestilo=" + idestilo+ "&idkardex=" + idkardex);
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso222Columns[0]),
                    new StringFieldDef(nombreCaso222Columns[1]),
                    new FloatFieldDef(nombreCaso222Columns[2]),
                    new FloatFieldDef(nombreCaso222Columns[3]),
                    new FloatFieldDef(nombreCaso222Columns[4]),
                    new FloatFieldDef(nombreCaso222Columns[5]),
                    new FloatFieldDef(nombreCaso222Columns[6]),
                    new FloatFieldDef(nombreCaso222Columns[7]),
                    new FloatFieldDef(nombreCaso222Columns[8]),
                    new FloatFieldDef(nombreCaso222Columns[9]),
                    new FloatFieldDef(nombreCaso222Columns[10]),
                    new FloatFieldDef(nombreCaso222Columns[11]),
                    new FloatFieldDef(nombreCaso222Columns[12]),
                    new FloatFieldDef(nombreCaso222Columns[13]),
                    new FloatFieldDef(nombreCaso222Columns[14]),
                    new FloatFieldDef(nombreCaso222Columns[15]),
                    new FloatFieldDef(nombreCaso222Columns[16]),
                    new FloatFieldDef(nombreCaso222Columns[17])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso222Columns[0], 20, true);
        lineaColumn = new ColumnConfig("Modelo", nombreCaso222Columns[1], 80, true);

        precioColumn = new ColumnConfig("Precio", nombreCaso222Columns[2], 55, true);
        talla4Column = new ColumnConfig("4", nombreCaso222Columns[3], 30, true, null);
        talla4mColumn = new ColumnConfig("4 1/2", nombreCaso222Columns[4], 40, true, null);

        talla11Column = new ColumnConfig("5", nombreCaso222Columns[5], 30, true, null);
        talla11mColumn = new ColumnConfig("5 1/2", nombreCaso222Columns[6], 40, true, null);
        talla12Column = new ColumnConfig("6", nombreCaso222Columns[7], 30, true, null);

        talla6mColumn = new ColumnConfig("6 1/2", nombreCaso222Columns[8], 35, true, null);
        talla7Column = new ColumnConfig("7", nombreCaso222Columns[9], 30, true, null);
        talla7mColumn = new ColumnConfig("7 1/2", nombreCaso222Columns[10], 35, true, null);
        talla8Column = new ColumnConfig("8", nombreCaso222Columns[11], 30, true, null);
        talla8mColumn = new ColumnConfig("8 1/2", nombreCaso222Columns[12], 35, true, null);
        talla9Column = new ColumnConfig("9", nombreCaso222Columns[13], 30, true, null);
        talla9mColumn = new ColumnConfig("9 1/2", nombreCaso222Columns[14], 35, true, null);
        talla10Column = new ColumnConfig("10", nombreCaso222Columns[15], 30, true, null);

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso222Columns[16], 5, true, null);
        totalparesColumn = new ColumnConfig("# Pares", nombreCaso222Columns[17], 80, true, null);

        precioColumn.setEditor(new GridEditor(metodoFeli()));
        talla4Column.setEditor(new GridEditor(metodoFeli()));
        talla4mColumn.setEditor(new GridEditor(metodoFeli()));
        talla11Column.setEditor(new GridEditor(metodoFeli()));
        talla11mColumn.setEditor(new GridEditor(metodoFeli()));
        talla12Column.setEditor(new GridEditor(metodoFeli()));

        talla6mColumn.setEditor(new GridEditor(metodoFeli()));
        talla7Column.setEditor(new GridEditor(metodoFeli()));
        talla7mColumn.setEditor(new GridEditor(metodoFeli()));
        talla8Column.setEditor(new GridEditor(metodoFeli()));
        talla8mColumn.setEditor(new GridEditor(metodoFeli()));
        talla9Column.setEditor(new GridEditor(metodoFeli()));
        talla9mColumn.setEditor(new GridEditor(metodoFeli()));
        talla10Column.setEditor(new GridEditor(metodoFeli()));

        totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        totalparesColumn.setEditor(new GridEditor(metodoFeli()));



        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    lineaColumn,
                    precioColumn,
                    talla4Column,
                    talla4mColumn,
                    talla11Column,
                    talla11mColumn,
                    talla12Column,
                    talla6mColumn,
                    talla7Column,
                    talla7mColumn,
                    talla8Column,
                    talla8mColumn,
                    talla9Column,
                    talla9mColumn,
                    talla10Column,
                    totalcajasColumn,
                    totalparesColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);
        guardarProducto = new ToolbarButton("Guardar Cambios");
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
        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
//        pagingToolbar.addButton(guardarProducto);

        grid.setBottomToolbar(pagingToolbar);
        aniadirListenersProducto();
        panel.add(grid);
    }

    public void onModuleLoad1033(String idmarca, String idestilos,String idkardex) {
        panel = new Panel();
        this.idkardex=idkardex;
        //panel.setId("panel-lista-productosproveedor");
        this.idpedido = idmarca;
        this.idestilo = idestilos;
        this.opcion = "8";
        dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetallePedidoMaterialColorinventario&idmarca=" + idpedido + "&idestilo=" + idestilo+ "&idkardex=" + idkardex);
        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso333Columns[0]),
                    new StringFieldDef(nombreCaso333Columns[1]),
                    new FloatFieldDef(nombreCaso333Columns[2]),
                    new FloatFieldDef(nombreCaso333Columns[3]),
                    new FloatFieldDef(nombreCaso333Columns[4]),
                    new FloatFieldDef(nombreCaso333Columns[5]),
                    new FloatFieldDef(nombreCaso333Columns[6]),
                    new FloatFieldDef(nombreCaso333Columns[7]),
                    new FloatFieldDef(nombreCaso333Columns[8]),
                    new FloatFieldDef(nombreCaso333Columns[9]),
                    new FloatFieldDef(nombreCaso333Columns[10]),
                    new FloatFieldDef(nombreCaso333Columns[11]),
                    new FloatFieldDef(nombreCaso333Columns[12]),
                    new FloatFieldDef(nombreCaso333Columns[13]),
                    new FloatFieldDef(nombreCaso333Columns[14]),
                    new FloatFieldDef(nombreCaso333Columns[15]),
                    new FloatFieldDef(nombreCaso333Columns[16]),
                    new FloatFieldDef(nombreCaso333Columns[17]),
                    new FloatFieldDef(nombreCaso333Columns[18]),
                    new FloatFieldDef(nombreCaso333Columns[19]),
                    new FloatFieldDef(nombreCaso333Columns[20]),
                    new FloatFieldDef(nombreCaso333Columns[21]),
                    new FloatFieldDef(nombreCaso333Columns[22]),
                    new FloatFieldDef(nombreCaso333Columns[23]),
                    new FloatFieldDef(nombreCaso333Columns[24]),
                    new FloatFieldDef(nombreCaso333Columns[25]),
                    new FloatFieldDef(nombreCaso333Columns[26]),
                    new FloatFieldDef(nombreCaso333Columns[27]),
                    new FloatFieldDef(nombreCaso333Columns[28]),
                    new FloatFieldDef(nombreCaso333Columns[29]),
                     new FloatFieldDef(nombreCaso333Columns[30])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);

        idColumn = new ColumnConfig("Id modelo", nombreCaso333Columns[0], 20, true);
        lineaColumn = new ColumnConfig("Modelo", nombreCaso333Columns[1], 80, true);
        precioColumn = new ColumnConfig("Precio", nombreCaso333Columns[2], 55, true);
        talla1Column = new ColumnConfig("1", nombreCaso333Columns[3], 30, true, null);
        talla1mColumn = new ColumnConfig("1 1/2", nombreCaso333Columns[4], 35, true, null);
        talla2Column = new ColumnConfig("2", nombreCaso333Columns[5], 30, true, null);
        talla2mColumn = new ColumnConfig("2 1/2", nombreCaso333Columns[6], 35, true, null);
        talla3Column = new ColumnConfig("3", nombreCaso333Columns[7], 30, true, null);
        talla3mColumn = new ColumnConfig("3 1/2", nombreCaso333Columns[8], 35, true, null);
        talla4Column = new ColumnConfig("4", nombreCaso333Columns[9], 30, true, null);
        talla4mColumn = new ColumnConfig("4 1/2", nombreCaso333Columns[10], 35, true, null);
        talla5Column = new ColumnConfig("5", nombreCaso333Columns[11], 30, true, null);
        talla5mColumn = new ColumnConfig("5 1/2", nombreCaso333Columns[12], 35, true, null);
        talla6Column = new ColumnConfig("6", nombreCaso333Columns[13], 30, true, null);

        talla6mColumn = new ColumnConfig("6 1/2", nombreCaso333Columns[14], 35, true, null);
        talla7Column = new ColumnConfig("7", nombreCaso333Columns[15], 30, true, null);
        talla7mColumn = new ColumnConfig("7 1/2", nombreCaso333Columns[16], 35, true, null);
        talla8Column = new ColumnConfig("8", nombreCaso333Columns[17], 30, true, null);
        talla8mColumn = new ColumnConfig("8 1/2", nombreCaso333Columns[18], 35, true, null);
        talla9Column = new ColumnConfig("9", nombreCaso333Columns[19], 30, true, null);
        talla9mColumn = new ColumnConfig("9 1/2", nombreCaso333Columns[20], 35, true, null);
        talla10Column = new ColumnConfig("10", nombreCaso333Columns[21], 30, true, null);
        talla10mColumn = new ColumnConfig("10 1/2", nombreCaso333Columns[22], 40, true, null);
        talla11Column = new ColumnConfig("11", nombreCaso333Columns[23], 30, true, null);
        talla11mColumn = new ColumnConfig("11 1/2", nombreCaso333Columns[24], 40, true, null);
        talla12Column = new ColumnConfig("12", nombreCaso333Columns[25], 30, true, null);
        talla12mColumn = new ColumnConfig("12 1/2", nombreCaso333Columns[26], 30, true, null);
        talla13Column = new ColumnConfig("13", nombreCaso333Columns[27], 30, true, null);
 talla13mColumn = new ColumnConfig("13 1/2", nombreCaso333Columns[28], 30, true, null);

        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso333Columns[29], 5, true, null);
        totalparesColumn = new ColumnConfig("# Pares", nombreCaso333Columns[30], 80, true, null);
        //colorColumn.setEditor(new GridEditor(metodoFeli()));
     //      TextField tex_detalle11 = new TextField();
      // lineaColumn.setEditor(new GridEditor(tex_detalle11));
        precioColumn.setEditor(new GridEditor(metodoFeli()));
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
talla13mColumn.setEditor(new GridEditor(metodoFeli()));
        totalcajasColumn.setEditor(new GridEditor(metodoFeli()));
        totalparesColumn.setEditor(new GridEditor(metodoFeli()));



        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    lineaColumn,
                    precioColumn,
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
                    talla13mColumn,
                    totalcajasColumn,
                    totalparesColumn
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
        grid.setAutoScroll(true);
        grid.setClicksToEdit(1);

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("Quitar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);

        guardarProducto = new ToolbarButton("Guardar Cambios");
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
        pagingToolbar.addButton(eliminarProducto);
// pagingToolbar.addSeparator();
//        pagingToolbar.addButton(guardarProducto);

        grid.setBottomToolbar(pagingToolbar);
        aniadirListenersProducto();
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


        eliminarProducto.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("iddetalleingreso");
                    MessageBox.confirm("Eliminar Item", "Realmente desea eliminar este Item??", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                //eliminar
                                String enlace = "php/IngresoAlmacen.php?funcion=EliminarMarca&iddetalleingreso=" + selecionado;
                                Utils.setErrorPrincipal("Eliminando ", "cargar");
                                final Conector conec = new Conector(enlace, false);
                                try {
                                    conec.getRequestBuilder().sendRequest("asdf", new RequestCallback() {

                                        public void onResponseReceived(Request request, Response response) {
                                            String data = response.getText();
                                            JSONValue jsonValue = JSONParser.parse(data);
                                            JSONObject jsonObject;
                                            if ((jsonObject = jsonValue.isObject()) != null) {
                                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                                if (errorR.equalsIgnoreCase("true")) {
                                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
                                                    reload();
                                                } else {
                                                    //Window.alert(mensajeR);
                                                    Utils.setErrorPrincipal(mensajeR, "error");
                                                }
                                            }
                                        }

                                        public void onError(Request request, Throwable exception) {
                                            //Window.alert("Ocurrio un error al conectar con el servidor ");
                                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                                        }

                                        public void reload() {
                                            store.reload();
                                            grid.reconfigure(store, columnModel);
                                            grid.getView().refresh();
                                        }
                                    });
                                } catch (RequestException ex) {
                                    //Window.alert("Ocurrio un error al conectar con el servidor");
                                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                                }
                            //end yes
                            }
                        }
                    });
                } else {
                    MessageBox.alert("No hay dato selecionado para editar y/o selecciono mas de uno.");
                }
                eliminarProducto.setPressed(false);
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

    private void aniadirListenersProducto() {
        //**************************************************
        //***********ELIMINAR PRODUCTO
        //**************************************************

        eliminarProducto.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("iddetalleingreso");
                    MessageBox.confirm("Eliminar Item", "Realmente desea eliminar este Item??", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                //eliminar
                                String enlace = "php/IngresoAlmacen.php?funcion=EliminarMarca&iddetalleingreso=" + selecionado;
                                Utils.setErrorPrincipal("Eliminando ", "cargar");
                                final Conector conec = new Conector(enlace, false);
                                try {
                                    conec.getRequestBuilder().sendRequest("asdf", new RequestCallback() {

                                        public void onResponseReceived(Request request, Response response) {
                                            String data = response.getText();
                                            JSONValue jsonValue = JSONParser.parse(data);
                                            JSONObject jsonObject;
                                            if ((jsonObject = jsonValue.isObject()) != null) {
                                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                                if (errorR.equalsIgnoreCase("true")) {
                                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
                                                    reload();
                                                } else {
                                                    //Window.alert(mensajeR);
                                                    Utils.setErrorPrincipal(mensajeR, "error");
                                                }
                                            }
                                        }

                                        public void onError(Request request, Throwable exception) {
                                            //Window.alert("Ocurrio un error al conectar con el servidor ");
                                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                                        }

                                        public void reload() {
                                            store.reload();
                                            grid.reconfigure(store, columnModel);
                                            grid.getView().refresh();
                                        }
                                    });
                                } catch (RequestException ex) {
                                    //Window.alert("Ocurrio un error al conectar con el servidor");
                                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                                }
                            //end yes
                            }
                        }
                    });
                } else {
                    MessageBox.alert("No hay dato selecionado para editar y/o selecciono mas de uno.");
                }
                eliminarProducto.setPressed(false);
            }
        });

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
//                        if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor")) {
//                            Record record = grid.getStore().getAt(rowIndex);
//                            record.set("indoor", !record.getAsBoolean("indoor"));
//                        }
                        if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor") &&
                                e.getTarget(".checkbox", 1) != null) {
                            Record record = grid.getStore().getAt(rowIndex);
                            record.set("indoor", !record.getAsBoolean("indoor"));
                        }
                        if (grid.getColumnModel().getDataIndex(colIndex).equals("color")) {
                            // colorpedido = new ColorPedido(colorM, ListaCalzadoPedidoTalla.this, colIndex, rowIndex);
                            //colorpedido.show();
                        }

                        if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor")) {
                            int newcol = colIndex + 1;
                            if (e.getKey() == EventObject.ENTER) {
                                Record record1 = grid.getStore().getAt(newcol);
                                record1.set("indoor", record1);
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
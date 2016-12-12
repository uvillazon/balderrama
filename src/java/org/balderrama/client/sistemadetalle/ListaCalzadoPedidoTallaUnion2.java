/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONString;
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
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.UrlParam;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.data.*;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.widgets.Toolbar;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.NumberField;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.grid.GridEditor;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import com.gwtext.client.widgets.grid.event.GridCellListenerAdapter;
import com.gwtext.client.widgets.grid.event.GridColumnListener;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;

/**
 *
 * @author example
 */
public class ListaCalzadoPedidoTallaUnion2 {

    private EditorGridPanel grid;
   // private final int ALTO = 355;
     private final int ALTO = 128;
    private ToolbarButton eliminarProducto;
      PagingToolbar pagingToolbar1124;
    String selecionado1124 = "";
     private String[] coleccionM;
   private ComboBox com_coleccion;
    private String[] estiloM;
   private ComboBox com_estilo;
    protected String buscarCodigo;
    protected String buscarMarca;
    protected String buscarAnio;
    private String idmarca;
    private String nombrem;
    private TextField tex_codigo;
    private TextField tex_marca;
    private TextField tex_anio;
    private Toolbar too_busquedaCBWW;
    private ToolbarButton too_buscarCBWW;
    protected ExtElement ext_element;
    private CheckboxSelectionModel cbSelectionModel;
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
    String total = "";
    private Panel panel;
    private ColumnConfig codigoColumn;
    private ColumnConfig colorColumn;
    private ColumnConfig materialColumn;
    private ColumnConfig lineaColumn;
    private ColumnConfig stylenameColumn;
    private ColumnConfig clienteColumn;
    private ColumnConfig vendedorColumn;
    private ColumnConfig totalparesColumn;
 //   private ColumnConfig totalcajasColumn;
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
    private ColumnConfig precio1Column;
    private ColumnConfig cantidadColumn;
    private ColumnConfig totalColumn;
    private ColumnConfig tipoventaColumn;
    private ColorPedido colorpedido;
    private MaterialPedido materialpedido;
    private Object[][] clienteM;
     private Object[][] coleccionMO;
      private Object[][] estiloMO;
    private String idpedido;
      private String nombremarca;
        private String idestilo;
     private String opcion;
    private Object[][] vendedorM;
    private Object[][] colorM;
    private Object[][] materialM;
    //clienteM = nombreCaso3Columns[2];
    String[] nombreCaso7Columns = {"iddetalleingreso", "codigo", "color", "precio", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "totalpares"};

    //String[] nombreCaso4Columns = {"iddetalleingreso","coleccion", "codigo", "color", "precio", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "totalcajas", "totalpares"};
    String[] nombreCaso5Columns = {"iddetalleingreso","coleccion", "codigo", "color", "precio","33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45",  "totalpares"};
//    String[] nombreCaso33Columns = {"iddetalleingreso", "coleccion","codigo", "color", "precio", "05", "50", "06", "60", "07", "70", "08", "80", "09", "90", "10",  "totalpares"};

    //String[] nombreCaso6Columns = {"iddetalleingreso","coleccion", "codigo", "material", "precio", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalpares"};

    //String[] nombreCaso9Columns = {"iddetalleingreso", "codigo", "precio", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalpares"};
    String[] nombreCaso33Columns = {"iddetalleingreso", "codigo", "color", "precio", "1", "1m", "2", "2m", "3", "3m", "4", "4m", "5", "5m", "6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12", "12m", "13","13m", "totalpares"};
   // String[] nombreCaso33Columns = {"iddetalleingreso", "codigo", "color", "precio", "01", "10", "02", "20", "03", "30", "04", "40", "05", "50", "06", "60", "07", "70", "08", "80", "09", "90", "10", "100", "11", "110", "12", "120", "13", "totalcajas", "totalpares"};

    //String[] nombreCaso333Columns = {"iddetalleingreso", "codigo", "precio", "1", "01", "02", "20", "03", "30", "04", "40", "05", "50", "06", "60", "07", "70", "08", "80", "09", "90", "10", "100", "11", "110", "12", "120", "13","130", "totalcajas", "totalpares"};

    private RecordDef recordDef;

    private ColumnConfig coleccionColumn;

// public void onModuleLoad333() {
//        panel = new Panel();
//
//         dataProxy = new ScriptTagProxy("");
//// dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetalleIngreso&idmarca=" + idpedido+"&codigo="+idestilo);
//         recordDef = new RecordDef(new FieldDef[]{
//                    new StringFieldDef(nombreCaso333Columns[0]),
//                    new StringFieldDef(nombreCaso333Columns[1]),
//                    new FloatFieldDef(nombreCaso333Columns[2]),
//                    new FloatFieldDef(nombreCaso333Columns[3]),
//                    new FloatFieldDef(nombreCaso333Columns[4]),
//                    new FloatFieldDef(nombreCaso333Columns[5]),
//                    new FloatFieldDef(nombreCaso333Columns[6]),
//                    new FloatFieldDef(nombreCaso333Columns[7]),
//                    new FloatFieldDef(nombreCaso333Columns[8]),
//                    new FloatFieldDef(nombreCaso333Columns[9]),
//                    new FloatFieldDef(nombreCaso333Columns[10]),
//                    new FloatFieldDef(nombreCaso333Columns[11]),
//                    new FloatFieldDef(nombreCaso333Columns[12]),
//                    new FloatFieldDef(nombreCaso333Columns[13]),
//                    new FloatFieldDef(nombreCaso333Columns[14]),
//                    new FloatFieldDef(nombreCaso333Columns[15]),
//                    new FloatFieldDef(nombreCaso333Columns[16]),
//                    new FloatFieldDef(nombreCaso333Columns[17]),
//                    new FloatFieldDef(nombreCaso333Columns[18]),
//                    new FloatFieldDef(nombreCaso333Columns[19]),
//                    new FloatFieldDef(nombreCaso333Columns[20]),
//                    new FloatFieldDef(nombreCaso333Columns[21]),
//                    new FloatFieldDef(nombreCaso333Columns[22]),
//                    new FloatFieldDef(nombreCaso333Columns[23]),
//                    new FloatFieldDef(nombreCaso333Columns[24]),
//                    new FloatFieldDef(nombreCaso333Columns[25]),
//                    new FloatFieldDef(nombreCaso333Columns[26]),
//                    new FloatFieldDef(nombreCaso333Columns[27]),
//                    new FloatFieldDef(nombreCaso333Columns[28]),
//                    new FloatFieldDef(nombreCaso333Columns[29])
//                });
//        reader = new JsonReader(recordDef);
//        reader.setRoot("resultado");
//        reader.setTotalProperty("totalCount");
//        store = new Store(dataProxy, reader, true);
//
//        idColumn = new ColumnConfig("Id modelo", nombreCaso333Columns[0], 20, true);
//        lineaColumn = new ColumnConfig("Modelo", nombreCaso333Columns[1], 80, true);
//        precioColumn = new ColumnConfig("Precio", nombreCaso333Columns[2], 55, true);
//        talla1Column = new ColumnConfig("1", nombreCaso333Columns[3], 30, true, null);
//        talla1mColumn = new ColumnConfig("1 1/2", nombreCaso333Columns[4], 35, true, null);
//        talla2Column = new ColumnConfig("2", nombreCaso333Columns[5], 30, true, null);
//        talla2mColumn = new ColumnConfig("2 1/2", nombreCaso333Columns[6], 35, true, null);
//        talla3Column = new ColumnConfig("3", nombreCaso333Columns[7], 30, true, null);
//        talla3mColumn = new ColumnConfig("3 1/2", nombreCaso333Columns[8], 35, true, null);
//        talla4Column = new ColumnConfig("4", nombreCaso333Columns[9], 30, true, null);
//        talla4mColumn = new ColumnConfig("4 1/2", nombreCaso333Columns[10], 35, true, null);
//        talla5Column = new ColumnConfig("5", nombreCaso333Columns[11], 30, true, null);
//        talla5mColumn = new ColumnConfig("5 1/2", nombreCaso333Columns[12], 35, true, null);
//        talla6Column = new ColumnConfig("6", nombreCaso333Columns[13], 30, true, null);
//
//        talla6mColumn = new ColumnConfig("6 1/2", nombreCaso333Columns[14], 35, true, null);
//        talla7Column = new ColumnConfig("7", nombreCaso333Columns[15], 30, true, null);
//        talla7mColumn = new ColumnConfig("7 1/2", nombreCaso333Columns[16], 35, true, null);
//        talla8Column = new ColumnConfig("8", nombreCaso333Columns[17], 30, true, null);
//        talla8mColumn = new ColumnConfig("8 1/2", nombreCaso333Columns[18], 35, true, null);
//        talla9Column = new ColumnConfig("9", nombreCaso333Columns[19], 30, true, null);
//        talla9mColumn = new ColumnConfig("9 1/2", nombreCaso333Columns[20], 35, true, null);
//        talla10Column = new ColumnConfig("10", nombreCaso333Columns[21], 30, true, null);
//        talla10mColumn = new ColumnConfig("10 1/2", nombreCaso333Columns[22], 40, true, null);
//        talla11Column = new ColumnConfig("11", nombreCaso333Columns[23], 30, true, null);
//        talla11mColumn = new ColumnConfig("11 1/2", nombreCaso333Columns[24], 40, true, null);
//        talla12Column = new ColumnConfig("12", nombreCaso333Columns[25], 30, true, null);
//        talla12mColumn = new ColumnConfig("12 1/2", nombreCaso333Columns[26], 30, true, null);
//        talla13Column = new ColumnConfig("13", nombreCaso333Columns[27], 30, true, null);
// talla13mColumn = new ColumnConfig("13 1/2", nombreCaso333Columns[28], 30, true, null);
//
//  totalparesColumn = new ColumnConfig("# Pares", nombreCaso333Columns[29], 80, true, null);
//        //colorColumn.setEditor(new GridEditor(metodoFeli()));
//               cbSelectionModel = new CheckboxSelectionModel();
//        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
//                    new CheckboxColumnConfig(cbSelectionModel),
//                    lineaColumn,
//                    precioColumn,
//                    talla1Column,
//                    talla1mColumn,
//                    talla2Column,
//                    talla2mColumn,
//                    talla3Column,
//                    talla3mColumn,
//                    talla4Column,
//                    talla4mColumn,
//                    talla5Column,
//                    talla5mColumn,
//                    talla6Column,
//                    talla6mColumn,
//                    talla7Column,
//                    talla7mColumn,
//                    talla8Column,
//                    talla8mColumn,
//                    talla9Column,
//                    talla9mColumn,
//                    talla10Column,
//                    talla10mColumn,
//                    talla11Column,
//                    talla11mColumn,
//                    talla12Column,
//                    talla12mColumn,
//                    talla13Column,
//                    talla13mColumn,
//                    totalparesColumn
//                };
//
//        columnModel = new ColumnModel(columns);
//
//       grid = new EditorGridPanel();
//        //grid.setId("grid-lista-productosproveedor");
//        grid.setWidth("100%");
//        grid.setHeight(ALTO);
//
//        grid.setTitle("Modelo Unido");
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
//
//        eliminarProducto = new ToolbarButton("Quitar");
//        eliminarProducto.setEnableToggle(true);
//        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
//        tipsConfig2.setText("seleccionar producto(s)");
//        //tipsConfig.setTitle("Tip Title");
//        eliminarProducto.setTooltip(tipsConfig2);
//
//
//        pagingToolbar = new PagingToolbar(store);
//        pagingToolbar.setPageSize(100);
//        pagingToolbar.setDisplayInfo(true);
//        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
//        pagingToolbar.setEmptyMsg("No topics to display");
//        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(eliminarProducto);
//        pagingToolbar.addSeparator();
//          grid.setBottomToolbar(pagingToolbar);
//
//        aniadirListenersProducto();
//        panel.add(grid);
//
//    }
//
//
//
// public void onModuleLoad9() {
//        panel = new Panel();
//
//         dataProxy = new ScriptTagProxy("");
//         recordDef = new RecordDef(new FieldDef[]{
//                      new StringFieldDef(nombreCaso9Columns[0]),
//                    new StringFieldDef(nombreCaso9Columns[1]),
//                    new FloatFieldDef(nombreCaso9Columns[2]),
//                    new FloatFieldDef(nombreCaso9Columns[3]),
//                    new FloatFieldDef(nombreCaso9Columns[4]),
//                    new FloatFieldDef(nombreCaso9Columns[5]),
//                    new FloatFieldDef(nombreCaso9Columns[6]),
//                    new FloatFieldDef(nombreCaso9Columns[7]),
//                    new FloatFieldDef(nombreCaso9Columns[8]),
//                    new FloatFieldDef(nombreCaso9Columns[9]),
//                    new FloatFieldDef(nombreCaso9Columns[10]),
//                    new FloatFieldDef(nombreCaso9Columns[11]),
//                    new FloatFieldDef(nombreCaso9Columns[12]),
//                    new FloatFieldDef(nombreCaso9Columns[13]),
//                    new FloatFieldDef(nombreCaso9Columns[14]),
//                    new FloatFieldDef(nombreCaso9Columns[15]),
//                    new FloatFieldDef(nombreCaso9Columns[16])
//                });
//
//        reader = new JsonReader(recordDef);
//        reader.setRoot(
//                "resultado");
//        reader.setTotalProperty(
//                "totalCount");
//        store = new Store(dataProxy, reader, true);
//        idColumn = new ColumnConfig("Id modelo", nombreCaso9Columns[0], 20, true);
//        codigoColumn = new ColumnConfig("Modelo", nombreCaso9Columns[1], 70, true);
//        precioColumn = new ColumnConfig("Precio", nombreCaso9Columns[2], 80, true);
//        talla14Column = new ColumnConfig("33", nombreCaso9Columns[3], 30, true, null);
//        talla15Column = new ColumnConfig("34", nombreCaso9Columns[4], 30, true, null);
//        talla16Column = new ColumnConfig("35", nombreCaso9Columns[5], 30, true, null);
//        talla17Column = new ColumnConfig("36", nombreCaso9Columns[6], 30, true, null);
//        talla18Column = new ColumnConfig("37", nombreCaso9Columns[7], 30, true, null);
//        talla19Column = new ColumnConfig("38", nombreCaso9Columns[8], 30, true, null);
//        talla20Column = new ColumnConfig("39", nombreCaso9Columns[9], 30, true, null);
//        talla21Column = new ColumnConfig("40", nombreCaso9Columns[10], 30, true, null);
//        talla22Column = new ColumnConfig("41", nombreCaso9Columns[11], 30, true, null);
//
//        talla8Column = new ColumnConfig("42", nombreCaso9Columns[12], 30, true, null);
//        talla8mColumn = new ColumnConfig("43", nombreCaso9Columns[13], 35, true, null);
//        talla9Column = new ColumnConfig("44", nombreCaso9Columns[14], 30, true, null);
//        talla9mColumn = new ColumnConfig("45", nombreCaso9Columns[15], 35, true, null);
//        totalparesColumn = new ColumnConfig("# Pares", nombreCaso9Columns[16], 80, true, null);
//      //  colorColumn.setEditor(new GridEditor(metodoFeli()));
//
//        cbSelectionModel = new CheckboxSelectionModel();
//
//        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
//                    new CheckboxColumnConfig(cbSelectionModel),
//                    codigoColumn,
//                    precioColumn,
//                    talla14Column,
//                    talla15Column,
//                    talla16Column,
//                    talla17Column,
//                    talla18Column,
//                    talla19Column,
//                    talla20Column,
//                    talla21Column,
//                    talla22Column,
//                    talla8Column,
//                    talla8mColumn,
//                    talla9Column,
//                    talla9mColumn,
//                    totalparesColumn
//                };
//
//    columnModel = new ColumnModel(columns);
//
//       grid = new EditorGridPanel();
//        //grid.setId("grid-lista-productosproveedor");
//        grid.setWidth("100%");
//        grid.setHeight(ALTO);
//
//        grid.setTitle("Lista modelos");
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
//
//
//        eliminarProducto = new ToolbarButton("Quitar");
//        eliminarProducto.setEnableToggle(true);
//        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
//        tipsConfig2.setText("seleccionar producto(s)");
//        //tipsConfig.setTitle("Tip Title");
//        eliminarProducto.setTooltip(tipsConfig2);
//
//
//
//        pagingToolbar = new PagingToolbar(store);
//        pagingToolbar.setPageSize(100);
//        pagingToolbar.setDisplayInfo(true);
//        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
//        pagingToolbar.setEmptyMsg("No topics to display");
//        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(eliminarProducto);
//        pagingToolbar.addSeparator();
//
//        grid.setBottomToolbar(pagingToolbar);
//        aniadirListenersProducto();
//        panel.add(grid);
//
//    }

   public void onModuleLoad4() {
        panel = new Panel();

         dataProxy = new ScriptTagProxy("");
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
                    new FloatFieldDef(nombreCaso7Columns[29])
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
        totalparesColumn = new ColumnConfig("# Pares", nombreCaso7Columns[29], 80, true, null);
//        //num_field4.setMaxValue(1000);
   // TextField tex_detalle = new TextField();
    //     coleccionColumn.setEditor(new GridEditor(tex_detalle));
    TextField tex_detalle1 = new TextField();
         colorColumn.setEditor(new GridEditor(tex_detalle1));
//        colorColumn.setEditor(new GridEditor(metodoFeli()));
        precioColumn.setEditor(new GridEditor(metodoFeli()));


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
                    totalparesColumn
                };

  columnModel = new ColumnModel(columns);

       grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);

        grid.setTitle("Lista de modelos");
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
        tipsConfig2.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);



        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
        pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);
        aniadirListenersProducto();
        panel.add(grid);

    }
// ske 5 a 10 m
    public void onModuleLoad33() {
        panel = new Panel();

         dataProxy = new ScriptTagProxy("");
         recordDef = new RecordDef(new FieldDef[]{
                  new StringFieldDef(nombreCaso33Columns[0]),
                    new StringFieldDef(nombreCaso33Columns[1]),
                    new StringFieldDef(nombreCaso33Columns[2]),
                    new StringFieldDef(nombreCaso33Columns[3]),
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
                    new FloatFieldDef(nombreCaso33Columns[30])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso33Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Modelo", nombreCaso33Columns[1], 100, true);
         colorColumn = new ColumnConfig("Color", nombreCaso33Columns[2], 100, true);
        precioColumn = new ColumnConfig("Precio", nombreCaso33Columns[3], 80, true);
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
  totalparesColumn = new ColumnConfig("# Pares", nombreCaso33Columns[30], 80, true, null);
  //        //num_field4.setMaxValue(1000);
//    TextField tex_detalle = new TextField();
 //        coleccionColumn.setEditor(new GridEditor(tex_detalle));
    TextField tex_detalle1 = new TextField();
         colorColumn.setEditor(new GridEditor(tex_detalle1));
//        colorColumn.setEditor(new GridEditor(metodoFeli()));
        precioColumn.setEditor(new GridEditor(metodoFeli()));


      cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
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
                    totalparesColumn
                };


        columnModel = new ColumnModel(columns);

       grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);

        grid.setTitle("Lista de Modelos");
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
        tipsConfig2.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);



        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
        pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);
        aniadirListenersProducto();
        panel.add(grid);

    }

//ramarin

    public void onModuleLoad5() {
        panel = new Panel();

         dataProxy = new ScriptTagProxy("");
         recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso5Columns[0]),
                    new StringFieldDef(nombreCaso5Columns[1]),
                    new StringFieldDef(nombreCaso5Columns[2]),
                    new StringFieldDef(nombreCaso5Columns[3]),
                    new FloatFieldDef(nombreCaso5Columns[4]),
                    new FloatFieldDef(nombreCaso5Columns[5]),
                    new FloatFieldDef(nombreCaso5Columns[6]),
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
                    new FloatFieldDef(nombreCaso5Columns[18])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso5Columns[0], 100, true);
        coleccionColumn = new ColumnConfig("Col.", nombreCaso5Columns[1], 80, true);

        codigoColumn = new ColumnConfig("Modelo", nombreCaso5Columns[2], 100, true);
         colorColumn = new ColumnConfig("Color", nombreCaso5Columns[3], 120, true);
        precioColumn = new ColumnConfig("Precio", nombreCaso5Columns[4], 100, true);

        talla33Column = new ColumnConfig("33", nombreCaso5Columns[5], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso5Columns[6], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso5Columns[7], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso5Columns[8], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso5Columns[9], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso5Columns[10], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso5Columns[11], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso5Columns[12], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso5Columns[13], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso5Columns[14], 30, true, null);
        talla43Column = new ColumnConfig("43", nombreCaso5Columns[15], 30, true, null);
        talla44Column = new ColumnConfig("44", nombreCaso5Columns[16], 30, true, null);
        talla45Column = new ColumnConfig("45", nombreCaso5Columns[17], 30, true, null);
    totalparesColumn = new ColumnConfig("# Pares", nombreCaso5Columns[18], 80, true, null);


//        //num_field4.setMaxValue(1000);
    TextField tex_detalle = new TextField();
         coleccionColumn.setEditor(new GridEditor(tex_detalle));
    TextField tex_detalle1 = new TextField();
         colorColumn.setEditor(new GridEditor(tex_detalle1));
//        colorColumn.setEditor(new GridEditor(metodoFeli()));
        precioColumn.setEditor(new GridEditor(metodoFeli()));



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
                    totalparesColumn
                };


        columnModel = new ColumnModel(columns);

       grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);

     //   grid.setTitle("Lista de Modelos");
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
        tipsConfig2.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);



        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
        pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);
        aniadirListenersProducto();
        panel.add(grid);

    }

//     public void onModuleLoad6() {
//        panel = new Panel();
//
//         dataProxy = new ScriptTagProxy("");
//         recordDef = new RecordDef(new FieldDef[]{
//                    new StringFieldDef(nombreCaso6Columns[0]),
//                    new StringFieldDef(nombreCaso6Columns[1]),
//                    new StringFieldDef(nombreCaso6Columns[2]),
//                    new StringFieldDef(nombreCaso6Columns[3]),
//                    new FloatFieldDef(nombreCaso6Columns[4]),
//                    new FloatFieldDef(nombreCaso6Columns[5]),
//                    new FloatFieldDef(nombreCaso6Columns[6]),
//                    new FloatFieldDef(nombreCaso6Columns[7]),
//                    new FloatFieldDef(nombreCaso6Columns[8]),
//                    new FloatFieldDef(nombreCaso6Columns[9]),
//                    new FloatFieldDef(nombreCaso6Columns[10]),
//                    new FloatFieldDef(nombreCaso6Columns[11]),
//                    new FloatFieldDef(nombreCaso6Columns[12]),
//                    new FloatFieldDef(nombreCaso6Columns[13]),
//                    new FloatFieldDef(nombreCaso6Columns[14]),
//                    new FloatFieldDef(nombreCaso6Columns[15]),
//                    new FloatFieldDef(nombreCaso6Columns[16]),
//                     new FloatFieldDef(nombreCaso6Columns[17]),
//                    new FloatFieldDef(nombreCaso6Columns[18])
//                });
//        reader = new JsonReader(recordDef);
//        reader.setRoot("resultado");
//        reader.setTotalProperty("totalCount");
//        store = new Store(dataProxy, reader, true);
//        idColumn = new ColumnConfig("Id modelo", nombreCaso6Columns[0], 100, true);
//        coleccionColumn = new ColumnConfig("Col.", nombreCaso6Columns[1], 80, true);
//
//        codigoColumn = new ColumnConfig("Modelo", nombreCaso6Columns[2], 100, true);
//         colorColumn = new ColumnConfig("Material", nombreCaso6Columns[3], 120, true);
//        precioColumn = new ColumnConfig("Precio", nombreCaso6Columns[4], 100, true);
//
//        talla33Column = new ColumnConfig("33", nombreCaso6Columns[5], 30, true, null);
//        talla34Column = new ColumnConfig("34", nombreCaso6Columns[6], 30, true, null);
//        talla35Column = new ColumnConfig("35", nombreCaso6Columns[7], 30, true, null);
//        talla36Column = new ColumnConfig("36", nombreCaso6Columns[8], 30, true, null);
//        talla37Column = new ColumnConfig("37", nombreCaso6Columns[9], 30, true, null);
//        talla38Column = new ColumnConfig("38", nombreCaso6Columns[10], 30, true, null);
//        talla39Column = new ColumnConfig("39", nombreCaso6Columns[11], 30, true, null);
//        talla40Column = new ColumnConfig("40", nombreCaso6Columns[12], 30, true, null);
//        talla41Column = new ColumnConfig("41", nombreCaso6Columns[13], 30, true, null);
//        talla42Column = new ColumnConfig("42", nombreCaso6Columns[14], 30, true, null);
//        talla43Column = new ColumnConfig("43", nombreCaso6Columns[15], 30, true, null);
//        talla44Column = new ColumnConfig("44", nombreCaso6Columns[16], 30, true, null);
//        talla45Column = new ColumnConfig("45", nombreCaso6Columns[17], 30, true, null);
//        totalparesColumn = new ColumnConfig("# Pares", nombreCaso6Columns[18], 80, true, null);
//
//
//
//        cbSelectionModel = new CheckboxSelectionModel();
//        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
//                    new CheckboxColumnConfig(cbSelectionModel),
//                    coleccionColumn,
//                    codigoColumn,
//                    colorColumn,
//                    precioColumn,
//                    talla33Column,
//                    talla34Column,
//                    talla35Column,
//                    talla36Column,
//                    talla37Column,
//                    talla38Column,
//                    talla39Column,
//                    talla40Column,
//                    talla41Column,
//                    talla42Column,
//                    talla43Column,
//                    talla44Column,
//                    talla45Column,
//                    totalparesColumn
//                };
//
//
//        columnModel = new ColumnModel(columns);
//
//       grid = new EditorGridPanel();
//        //grid.setId("grid-lista-productosproveedor");
//        grid.setWidth("100%");
//        grid.setHeight(ALTO);
//
//        grid.setTitle("Lista de Ingresos Modelos" );
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
//
//
//        eliminarProducto = new ToolbarButton("Quitar");
//        eliminarProducto.setEnableToggle(true);
//        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
//        tipsConfig2.setText("seleccionar producto(s)");
//        //tipsConfig.setTitle("Tip Title");
//        eliminarProducto.setTooltip(tipsConfig2);
//
//
//
//        pagingToolbar = new PagingToolbar(store);
//        pagingToolbar.setPageSize(100);
//        pagingToolbar.setDisplayInfo(true);
//        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
//        pagingToolbar.setEmptyMsg("No topics to display");
//        pagingToolbar.addSeparator();
//        pagingToolbar.addButton(eliminarProducto);
//        pagingToolbar.addSeparator();
//
//        grid.setBottomToolbar(pagingToolbar);
//        aniadirListenersProducto();
//        panel.add(grid);
//
//    }
//


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

    public void aniadirListenersBuscador() {

                too_buscarCBWW.addListener(new ButtonListenerAdapter() {

                    @Override
                    public void onClick(Button button, EventObject e) {
                        Utils.setErrorPrincipal("Se realizo la busqueda", "mensaje");
                        buscarSegunParametros();
                    }
                });
            }

         public void aniadirListenersBuscadoresText() {

                com_coleccion.addListener(new TextFieldListenerAdapter() {

                    @Override
                    public void onSpecialKey(Field field, EventObject e) {
                        if (e.getKey() == EventObject.ENTER) {
                            buscarSegunParametros();
                        //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 2");
                        }
                    }
                });
 com_estilo.addListener(new TextFieldListenerAdapter() {

                    @Override
                    public void onSpecialKey(Field field, EventObject e) {
                        if (e.getKey() == EventObject.ENTER) {
                            buscarSegunParametros();
                        //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 2");
                        }
                    }
                });

            }
  public void buscarSegunParametros() {
                store.reload(new UrlParam[]{new UrlParam("start", 0), new UrlParam("limit", 100),
                            new UrlParam("buscarcoleccion", com_coleccion.getText()),new UrlParam("buscarestilo", com_estilo.getText())}, false);
            }

    private void aniadirListenersProducto() {
        //**************************************************
        //***********ELIMINAR PRODUCTO
        //**************************************************

        eliminarProducto.addListener(new ButtonListenerAdapter() {

            private boolean procederAEliminar;
            int repeat = 0;
//modseleccion
            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("iddetalleingreso");
                    grid.stopEditing();
                    store.remove(cbSelectionModel.getSelected());
                    grid.startEditing(0, 0);


                } else {
                    MessageBox.alert("No hay producto seleccionado para quitar y/o selecciono mas de uno.");
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
                   //         colorpedido = new ColorPedido(colorM, ListaCalzadoPedidoTallaUnion2.this, colIndex, rowIndex);
                     //       colorpedido.show();
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

    }
 private void aniadirListenersProductoespecial() {
        //**************************************************
        //***********ELIMINAR PRODUCTO
        //**************************************************

        eliminarProducto.addListener(new ButtonListenerAdapter() {

            private boolean procederAEliminar;
            int repeat = 0;
//modseleccion
            @Override
            public void onClick(Button button, EventObject e) {
                Record[] records = cbSelectionModel.getSelections();
                if (records.length == 1) {
                    selecionado = records[0].getAsString("iddetalleingreso");
                    grid.stopEditing();
                    store.remove(cbSelectionModel.getSelected());
                    grid.startEditing(0, 0);


                } else {
                    MessageBox.alert("No hay producto seleccionado para quitar y/o selecciono mas de uno.");
                }

                eliminarProducto.setPressed(false);
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
//                   if (grid.getColumnModel().getDataIndex(colIndex).equals("color")) {
//                            colorpedido = new ColorPedido(colorM, ListaCalzadoPedidoTallaUnion2.this, colIndex, rowIndex);
//                            colorpedido.show();
//                        }

                 if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor")) {
                               int newcol = colIndex +1;
                            if (e.getKey() == EventObject.ENTER) {
                                          Record record1 = grid.getStore().getAt(newcol);
                                     record1.set("indoor",record1);
                                      }
                             }
                      }
                });
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
  public void InsertRowColor(int rowIndex, int colIndex, String dato) {
        grid.getColumnModel().getDataIndex(rowIndex).equals("color");
        Record rs = grid.getStore().getRecordAt(rowIndex);
        rs.set("color", dato);

    }
   public void imprimirCompra(String usuario) {


//        String marcas = tex_marca.getText();
//        String estilos = tex_numeropedido.getText();
//        String pares = tex_totalpares.getValueAsString();
//        String bs = tex_totalbs.getValueAsString();
//       String opcionn = opcionnueva;
        Record[] records = grid.getStore().getRecords();
        JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();

        compraObject.put("mar", new JSONString(nombremarca));
//        compraObject.put("est", new JSONString(estilos));
//        compraObject.put("par", new JSONString(pares));
//        compraObject.put("bs", new JSONString(bs));
//        compraObject.put("opcion", new JSONString(opcionn));


//opciones por marca

        for (int i = 0; i < records.length; i++) {
             productoObject = new JSONObject();
     productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));

                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
        }
    //fin opciones
        JSONObject resultado = new JSONObject();
        resultado.put("v", compraObject);
        resultado.put("p", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("generando", "cargar");
        String url;
        url = "funcion=imprimirmodeloestilotalladetalle&" + datos;
        verReporte(url);
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
   private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }




}
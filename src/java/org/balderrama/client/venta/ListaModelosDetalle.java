/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.venta;

//import com.google.gwt.user.client.Window;
//import com.google.gwt.http.client.Request;
//import com.google.gwt.http.client.RequestCallback;
//import com.google.gwt.http.client.RequestException;
//import com.google.gwt.http.client.Response;
//import com.google.gwt.json.client.JSONArray;
//import com.google.gwt.json.client.JSONObject;
//import com.google.gwt.json.client.JSONParser;
//import com.google.gwt.json.client.JSONString;
//import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.data.*;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Component;
//import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.Panel;
//import com.gwtext.client.widgets.QuickTipsConfig;
import com.gwtext.client.widgets.ToolbarButton;
//import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.event.PanelListenerAdapter;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.data.DataProxy;
//import com.gwtext.client.widgets.form.ComboBox;
//import com.gwtext.client.widgets.form.NumberField;
//import com.gwtext.client.widgets.form.TextField;
//import com.gwtext.client.widgets.grid.GridEditor;
import com.gwtext.client.widgets.grid.RowSelectionModel;
import com.gwtext.client.widgets.grid.event.*;
//import org.balderrama.client.util.Conector;
//import org.balderrama.client.util.ReporteImagen;
//import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
//import org.balderrama.client.util.Utils;

/**
 *
 * @author example
 */
public class ListaModelosDetalle {

    public EditorGridPanel grid;
    private final int ALTO = 350;
    private final int ALTO2 = 300;
    protected ExtElement ext_element;
    public CheckboxSelectionModel cbSelectionModel;
    private Store store;
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
//    private ColumnConfig vendedorColumn;
//    private ColumnConfig preciototalColumn;
    private ColumnConfig talla1mColumn;
    private ColumnConfig talla2mColumn;
    private ColumnConfig talla3mColumn;
    private ColumnConfig talla4mColumn;
    private ColumnConfig talla5mColumn;
    private ColumnConfig talla6mColumn;
    private ColumnConfig talla7mColumn;
    private ColumnConfig talla8mColumn;
    private ColumnConfig talla9mColumn;
    private ColumnConfig talla10mColumn;
    private ColumnConfig talla11mColumn;
    private ColumnConfig talla12mColumn;
    private ColumnConfig talla13mColumn;
//    private ColumnConfig preciooficinaColumn;
//    private ColumnConfig talla;
//    private String idpedido;
//    private String idestilo;
//    private String idkardex;
//    private String opcion;
//    private Object[][] vendedorM;
//    private Object[][] colorM;
//    private Object[][] materialM;
//    private Object[][] clienteM;
//    private String[] tipoM;
    String esgestion;
//    private ColumnConfig coleccionColumn;
    private RecordDef recordDef;
//    private Button but_aceptar;
//    private Button but_cancelar;
//    private String fechad;
//    private String[] pagoM;
//    private String[] facturaM;
//    private String marca;
//    private String vendedor;
    private ColumnConfig idColumn;
    private ColumnConfig kardexColumn;
    private ColumnConfig codigoColumn;
    private ColumnConfig colorColumn;
    private ColumnConfig materialColumn;
    private ColumnConfig clienteColumn;
    private ColumnConfig preciounitarioColumn;
    private ColumnConfig totalparesbsColumn;
    private ColumnConfig fechaColumn;
    private ColumnConfig totalparescajaColumn;
    private ColumnConfig totalparesColumn;
    private ColumnConfig totalcajasColumn;
    private ColumnConfig precioColumn;
    private ColumnConfig talla1Column;
    private ColumnConfig talla2Column;
    private ColumnConfig talla3Column;
    private ColumnConfig talla4Column;
    private ColumnConfig talla5Column;
    private ColumnConfig talla6Column;
    private ColumnConfig talla7Column;
    private ColumnConfig talla8Column;
    private ColumnConfig talla9Column;
    private ColumnConfig talla10Column;
    private ColumnConfig talla11Column;
    private ColumnConfig talla12Column;
    private ColumnConfig talla13Column;
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
    String[] nombreCaso2Columns = {"idmodelo", "idkardex", "codigo", "material", "color", "cliente", "fecha", "totalcajas", "precio", "preciounitario", "34", "35", "36", "37", "38", "39", "40", "totalpares", "totalparescaja", "totalparesbs"};
    String[] nombreCaso3Columns = {"idmodelo", "idkardex", "codigo", "cliente", "fecha", "totalcajas", "precio", "preciounitario", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "totalpares", "totalparescaja", "totalparesbs"};
    String[] nombreCaso4Columns = {"idmodelo", "idkardex", "codigo", "material", "cliente", "fecha", "totalcajas", "precio", "preciounitario", "1", "1m", "2", "2m", "3", "3m", "4", "4m", "5", "5m", "6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12", "12m", "13", "totalpares", "totalparescaja", "totalparesbs"};
    String[] nombreCaso6Columns = {"idmodelo", "idkardex", "codigo", "material", "color", "cliente", "fecha", "totalcajas", "precio", "preciounitario", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "totalpares", "totalparescaja", "totalparesbs"};
    String[] nombreCaso7Columns = {"idmodelo", "idkardex", "codigo", "material", "cliente", "fecha", "totalcajas", "precio", "preciounitario", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalpares", "totalparescaja", "totalparesbs"};
    String[] nombreCaso8Columns = {"idmodelo", "idkardex", "codigo", "color", "cliente", "fecha", "totalcajas", "precio", "preciounitario", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "totalpares", "totalparescaja", "totalparesbs"};
    String[] nombreCaso9Columns = {"idmodelo", "idkardex", "codigo", "material", "color", "cliente", "fecha", "totalcajas", "precio", "preciounitario", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "totalpares", "totalparescaja", "totalparesbs"};
    String[] nombreCaso10Columns = {"idmodelo", "idkardex", "codigo", "color", "cliente", "fecha", "totalcajas", "precio", "preciounitario", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalpares", "totalparescaja", "totalparesbs"};
    String[] nombreCaso11Columns = {"idmodelo", "idkardex", "codigo", "cliente", "fecha", "totalcajas", "precio", "preciounitario", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "totalpares", "totalparescaja", "totalparesbs"};
    String[] nombreCaso13Columns = {"idmodelo", "idkardex", "codigo", "color", "cliente", "fecha", "totalcajas", "precio", "preciounitario", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "totalpares", "totalparescaja", "totalparesbs"};

    String[] nombreCaso12Columns = {"idmodelo", "idkardex", "codigo", "material", "color", "cliente", "fecha", "totalcajas", "precio", "preciounitario", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalpares", "totalparescaja", "totalparesbs"};
    String codigo;
    String idmarca;
    String idvendedor;

    public void onModuleLoad2(String codigobarra, String marca, String vendedo) {
        panel = new Panel();
        this.codigo = codigobarra;
        this.idmarca = marca;
        this.idvendedor = vendedo;
        //Accesorios; Accesorios: Talla=33-45
        dataProxy = new ScriptTagProxy("./php/VentaMayor.php?funcion=ListarDetalleModelosVenta&codigo=" + codigo + "&idmarca=" + idmarca + "&idvendedor=" + idvendedor);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso2Columns[0]),
                    new StringFieldDef(nombreCaso2Columns[1]),
                    new StringFieldDef(nombreCaso2Columns[2]),
                    new StringFieldDef(nombreCaso2Columns[3]),
                    new StringFieldDef(nombreCaso2Columns[4]),
                    new StringFieldDef(nombreCaso2Columns[5]),
                    new StringFieldDef(nombreCaso2Columns[6]),
                    new FloatFieldDef(nombreCaso2Columns[7]),
                    new FloatFieldDef(nombreCaso2Columns[8]),
                    new FloatFieldDef(nombreCaso2Columns[9]),
                    new FloatFieldDef(nombreCaso2Columns[10]),
                    new FloatFieldDef(nombreCaso2Columns[11]),
                    new FloatFieldDef(nombreCaso2Columns[12]),
                    new FloatFieldDef(nombreCaso2Columns[13]),
                    new FloatFieldDef(nombreCaso2Columns[14]),
                    new FloatFieldDef(nombreCaso2Columns[15]),
                    new FloatFieldDef(nombreCaso2Columns[16]),
                    new FloatFieldDef(nombreCaso2Columns[17]),
                    new FloatFieldDef(nombreCaso2Columns[18]),
                    new FloatFieldDef(nombreCaso2Columns[19])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso2Columns[0], 100, true);
        kardexColumn = new ColumnConfig("Id kardex", nombreCaso2Columns[1], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso2Columns[2], 80, true);
        materialColumn = new ColumnConfig("Material", nombreCaso2Columns[3], 120, true);
        colorColumn = new ColumnConfig("Color", nombreCaso2Columns[4], 100, true);
        clienteColumn = new ColumnConfig("Cliente", nombreCaso2Columns[5], 100, true);
        fechaColumn = new ColumnConfig("Fecha", nombreCaso2Columns[6], 100, true);
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso2Columns[7], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso2Columns[8], 100, true);
        preciounitarioColumn = new ColumnConfig("Unit", nombreCaso2Columns[9], 100, true);
        talla33Column = new ColumnConfig("34", nombreCaso2Columns[10], 30, true, null);
        talla34Column = new ColumnConfig("35", nombreCaso2Columns[11], 30, true, null);
        talla35Column = new ColumnConfig("36", nombreCaso2Columns[12], 30, true, null);
        talla36Column = new ColumnConfig("37", nombreCaso2Columns[13], 30, true, null);
        talla37Column = new ColumnConfig("38", nombreCaso2Columns[14], 30, true, null);
        talla38Column = new ColumnConfig("39", nombreCaso2Columns[15], 30, true, null);
        talla39Column = new ColumnConfig("40", nombreCaso2Columns[16], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso2Columns[17], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso2Columns[18], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso2Columns[19], 80, true, null);

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    colorColumn,
                    clienteColumn,
                    fechaColumn,
                    totalcajasColumn,
                    precioColumn,
                    preciounitarioColumn,
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
        grid.setId("grid-lista-modelos-venta-unidad");
        grid.setTitle("Modelos a vender");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setClicksToEdit(1);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);

//        grid.setWidth(ANCHO - 80);
        grid.setHeight(350);
        grid.addListener(new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store.load(0, 100);
                    }
                });
////        aniadirListenersModelosVenta();
        panel.add(grid);
    }

    public void onModuleLoad3(String codigobarra, String marca, String vendedo) {
        panel = new Panel();
        this.codigo = codigobarra;
        this.idmarca = marca;
        this.idvendedor = vendedo;
        //Kidy: Talla=14-38
        dataProxy = new ScriptTagProxy("./php/VentaMayor.php?funcion=ListarDetalleModelosVenta&codigo=" + codigo + "&idmarca=" + idmarca + "&idvendedor=" + idvendedor);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso3Columns[0]),
                    new StringFieldDef(nombreCaso3Columns[1]),
                    new StringFieldDef(nombreCaso3Columns[2]),
                    new StringFieldDef(nombreCaso3Columns[3]),
                    new StringFieldDef(nombreCaso3Columns[4]),
                    new FloatFieldDef(nombreCaso3Columns[5]),
                    new FloatFieldDef(nombreCaso3Columns[6]),
                    new FloatFieldDef(nombreCaso3Columns[7]),
                    new FloatFieldDef(nombreCaso3Columns[8]),
                    new FloatFieldDef(nombreCaso3Columns[9]),
                    new FloatFieldDef(nombreCaso3Columns[10]),
                    new FloatFieldDef(nombreCaso3Columns[11]),
                    new FloatFieldDef(nombreCaso3Columns[12]),
                    new FloatFieldDef(nombreCaso3Columns[13]),
                    new FloatFieldDef(nombreCaso3Columns[14]),
                    new FloatFieldDef(nombreCaso3Columns[15]),
                    new FloatFieldDef(nombreCaso3Columns[16]),
                    new FloatFieldDef(nombreCaso3Columns[17]),
                    new FloatFieldDef(nombreCaso3Columns[18]),
                    new FloatFieldDef(nombreCaso3Columns[19]),
                    new FloatFieldDef(nombreCaso3Columns[20]),
                    new FloatFieldDef(nombreCaso3Columns[21]),
                    new FloatFieldDef(nombreCaso3Columns[22]),
                    new FloatFieldDef(nombreCaso3Columns[23]),
                    new FloatFieldDef(nombreCaso3Columns[24]),
                    new FloatFieldDef(nombreCaso3Columns[25]),
                    new FloatFieldDef(nombreCaso3Columns[26]),
                    new FloatFieldDef(nombreCaso3Columns[27]),
                    new FloatFieldDef(nombreCaso3Columns[28]),
                    new FloatFieldDef(nombreCaso3Columns[29]),
                    new FloatFieldDef(nombreCaso3Columns[30]),
                    new FloatFieldDef(nombreCaso3Columns[31]),
                    new FloatFieldDef(nombreCaso3Columns[32]),
                    new FloatFieldDef(nombreCaso3Columns[33]),
                    new FloatFieldDef(nombreCaso3Columns[34]),
                    new FloatFieldDef(nombreCaso3Columns[35])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso3Columns[0], 100, true);
        kardexColumn = new ColumnConfig("Id kardex", nombreCaso3Columns[1], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso3Columns[2], 80, true);
        clienteColumn = new ColumnConfig("Cliente", nombreCaso3Columns[3], 100, true);
        fechaColumn = new ColumnConfig("Ingreso", nombreCaso3Columns[4], 100, true);
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso3Columns[5], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso3Columns[6], 100, true);
        preciounitarioColumn = new ColumnConfig("Unit", nombreCaso3Columns[7], 100, true);
        talla14Column = new ColumnConfig("14", nombreCaso3Columns[8], 30, true, null);
        talla15Column = new ColumnConfig("15", nombreCaso3Columns[9], 30, true, null);
        talla16Column = new ColumnConfig("16", nombreCaso3Columns[10], 30, true, null);
        talla17Column = new ColumnConfig("17", nombreCaso3Columns[11], 30, true, null);
        talla18Column = new ColumnConfig("18", nombreCaso3Columns[12], 30, true, null);
        talla19Column = new ColumnConfig("19", nombreCaso3Columns[13], 30, true, null);
        talla20Column = new ColumnConfig("20", nombreCaso3Columns[14], 30, true, null);
        talla21Column = new ColumnConfig("21", nombreCaso3Columns[15], 30, true, null);
        talla22Column = new ColumnConfig("22", nombreCaso3Columns[16], 30, true, null);
        talla23Column = new ColumnConfig("23", nombreCaso3Columns[17], 30, true, null);
        talla24Column = new ColumnConfig("24", nombreCaso3Columns[18], 30, true, null);
        talla25Column = new ColumnConfig("25", nombreCaso3Columns[19], 30, true, null);
        talla26Column = new ColumnConfig("26", nombreCaso3Columns[20], 30, true, null);
        talla27Column = new ColumnConfig("27", nombreCaso3Columns[21], 30, true, null);
        talla28Column = new ColumnConfig("28", nombreCaso3Columns[22], 30, true, null);
        talla29Column = new ColumnConfig("29", nombreCaso3Columns[23], 30, true, null);
        talla30Column = new ColumnConfig("30", nombreCaso3Columns[24], 30, true, null);
        talla31Column = new ColumnConfig("31", nombreCaso3Columns[25], 30, true, null);
        talla32Column = new ColumnConfig("32", nombreCaso3Columns[26], 30, true, null);
        talla33Column = new ColumnConfig("33", nombreCaso3Columns[27], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso3Columns[28], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso3Columns[29], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso3Columns[30], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso3Columns[31], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso3Columns[32], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso3Columns[33], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso3Columns[34], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso3Columns[35], 80, true, null);

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    clienteColumn,
                    fechaColumn,
                    totalcajasColumn,
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
        grid.setId("grid-lista-modelos-venta-unidad");
        grid.setTitle("Modelos a vender");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setClicksToEdit(1);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);

//        grid.setWidth(ANCHO - 80);
        grid.setHeight(350);
        grid.addListener(new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store.load(0, 100);
                    }
                });
////        aniadirListenersModelosVenta();
        panel.add(grid);
    }

    public void onModuleLoad4(String codigobarra, String marca, String vendedo) {
        panel = new Panel();
        this.codigo = codigobarra;
        this.idmarca = marca;
        this.idvendedor = vendedo;
        //361, Nike
        dataProxy = new ScriptTagProxy("./php/VentaMayor.php?funcion=ListarDetalleModelosVenta&codigo=" + codigo + "&idmarca=" + idmarca + "&idvendedor=" + idvendedor);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso4Columns[0]),
                    new StringFieldDef(nombreCaso4Columns[1]),
                    new StringFieldDef(nombreCaso4Columns[2]),
                    new StringFieldDef(nombreCaso4Columns[3]),
                    new StringFieldDef(nombreCaso4Columns[4]),
                    new StringFieldDef(nombreCaso4Columns[5]),
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
                    new FloatFieldDef(nombreCaso4Columns[32]),
                    new FloatFieldDef(nombreCaso4Columns[33]),
                    new FloatFieldDef(nombreCaso4Columns[34]),
                    new FloatFieldDef(nombreCaso4Columns[35]),
                    new FloatFieldDef(nombreCaso4Columns[36])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);

        idColumn = new ColumnConfig("Id modelo", nombreCaso4Columns[0], 100, true);
        kardexColumn = new ColumnConfig("Id kardex", nombreCaso4Columns[1], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso4Columns[2], 80, true);
        materialColumn = new ColumnConfig("Material", nombreCaso4Columns[3], 150, true);
        clienteColumn = new ColumnConfig("Cliente", nombreCaso4Columns[4], 100, true);
        fechaColumn = new ColumnConfig("Ingreso", nombreCaso4Columns[5], 40, true);
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso4Columns[6], 40, true, null);
        precioColumn = new ColumnConfig("Venta", nombreCaso4Columns[7], 60, true);
        preciounitarioColumn = new ColumnConfig("Unit", nombreCaso4Columns[8], 60, true);
        talla1Column = new ColumnConfig("1", nombreCaso4Columns[9], 25, true, null);
        talla1mColumn = new ColumnConfig("1m", nombreCaso4Columns[10], 25, true, null);
        talla2Column = new ColumnConfig("2", nombreCaso4Columns[11], 25, true, null);
        talla2mColumn = new ColumnConfig("2m", nombreCaso4Columns[12], 25, true, null);
        talla3Column = new ColumnConfig("3", nombreCaso4Columns[13], 25, true, null);
        talla3mColumn = new ColumnConfig("3m", nombreCaso4Columns[14], 25, true, null);
        talla4Column = new ColumnConfig("4", nombreCaso4Columns[15], 25, true, null);
        talla4mColumn = new ColumnConfig("4m", nombreCaso4Columns[16], 25, true, null);
        talla5Column = new ColumnConfig("5", nombreCaso4Columns[17], 25, true, null);
        talla5mColumn = new ColumnConfig("5m", nombreCaso4Columns[18], 25, true, null);
        talla6Column = new ColumnConfig("6", nombreCaso4Columns[19], 25, true, null);
        talla6mColumn = new ColumnConfig("6m", nombreCaso4Columns[20], 25, true, null);
        talla7Column = new ColumnConfig("7", nombreCaso4Columns[21], 25, true, null);
        talla7mColumn = new ColumnConfig("7m", nombreCaso4Columns[22], 25, true, null);
        talla8Column = new ColumnConfig("8", nombreCaso4Columns[23], 25, true, null);
        talla8mColumn = new ColumnConfig("8m", nombreCaso4Columns[24], 25, true, null);
        talla9Column = new ColumnConfig("9", nombreCaso4Columns[25], 25, true, null);
        talla9mColumn = new ColumnConfig("9m", nombreCaso4Columns[26], 25, true, null);
        talla10Column = new ColumnConfig("10", nombreCaso4Columns[27], 25, true, null);
        talla10mColumn = new ColumnConfig("10m", nombreCaso4Columns[28], 25, true, null);
        talla11Column = new ColumnConfig("11", nombreCaso4Columns[29], 25, true, null);
        talla11mColumn = new ColumnConfig("11m", nombreCaso4Columns[30], 25, true, null);
        talla12Column = new ColumnConfig("12", nombreCaso4Columns[31], 25, true, null);
        talla12mColumn = new ColumnConfig("12m", nombreCaso4Columns[32], 25, true, null);
        talla13Column = new ColumnConfig("13", nombreCaso4Columns[33], 25, true, null);
        totalparesColumn = new ColumnConfig("Pares", nombreCaso4Columns[34], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total Pares", nombreCaso4Columns[35], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Sus", nombreCaso4Columns[36], 80, true, null);

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    clienteColumn,
                    fechaColumn,
                    totalcajasColumn,
                    precioColumn,
                    preciounitarioColumn,
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
                    totalparescajaColumn,
                    totalparesbsColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-modelos-venta-unidad");
        grid.setTitle("Modelos a vender");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setClicksToEdit(1);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);

//        grid.setWidth(ANCHO - 80);
        grid.setHeight(350);
        grid.addListener(new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store.load(0, 100);
                    }
                });
////        aniadirListenersModelosVenta();
        panel.add(grid);
    }

    public void onModuleLoad6(String codigobarra, String marca, String vendedo) {
        panel = new Panel();
        this.codigo = codigobarra;
        this.idmarca = marca;
        this.idvendedor = vendedo;
        //Ramarin: Talla=33-42, Modare, Moleca, Beirario, Vizzano, Via Beach, Adrum: Talla=33-45
        dataProxy = new ScriptTagProxy("./php/VentaMayor.php?funcion=ListarDetalleModelosVenta&codigo=" + codigo + "&idmarca=" + idmarca + "&idvendedor=" + idvendedor);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso6Columns[0]),
                    new StringFieldDef(nombreCaso6Columns[1]),
                    new StringFieldDef(nombreCaso6Columns[2]),
                    new StringFieldDef(nombreCaso6Columns[3]),
                    new StringFieldDef(nombreCaso6Columns[4]),
                    new StringFieldDef(nombreCaso6Columns[5]),
                    new StringFieldDef(nombreCaso6Columns[6]),
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
                    new FloatFieldDef(nombreCaso6Columns[19]),
                    new FloatFieldDef(nombreCaso6Columns[20]),
                    new FloatFieldDef(nombreCaso6Columns[21]),
                    new FloatFieldDef(nombreCaso6Columns[22])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso6Columns[0], 100, true);
        kardexColumn = new ColumnConfig("Id kardex", nombreCaso6Columns[1], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso6Columns[2], 80, true);
        materialColumn = new ColumnConfig("Material", nombreCaso6Columns[3], 120, true);
        colorColumn = new ColumnConfig("Color", nombreCaso6Columns[4], 100, true);
        clienteColumn = new ColumnConfig("Cliente", nombreCaso6Columns[5], 100, true);
        fechaColumn = new ColumnConfig("Ingreso", nombreCaso6Columns[6], 100, true);
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso6Columns[7], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso6Columns[8], 100, true);
        preciounitarioColumn = new ColumnConfig("Unit", nombreCaso6Columns[9], 100, true);
        talla33Column = new ColumnConfig("33", nombreCaso6Columns[10], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso6Columns[11], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso6Columns[12], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso6Columns[13], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso6Columns[14], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso6Columns[15], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso6Columns[16], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso6Columns[17], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso6Columns[18], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso6Columns[19], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso6Columns[20], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso6Columns[21], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso6Columns[22], 80, true, null);

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    colorColumn,
                    clienteColumn,
                    fechaColumn,
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
        grid.setId("grid-lista-modelos-venta-unidad");
        grid.setTitle("Modelos a vender");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setClicksToEdit(1);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);

//        grid.setWidth(ANCHO - 80);
        grid.setHeight(350);
        grid.addListener(new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store.load(0, 100);
                    }
                });
////        aniadirListenersModelosVenta();
        panel.add(grid);
    }

    public void onModuleLoad7(String codigobarra, String marca, String vendedo) {
        panel = new Panel();
        this.codigo = codigobarra;
        this.idmarca = marca;
        this.idvendedor = vendedo;
        //Francajel, West Coast: Talla=33-45
        dataProxy = new ScriptTagProxy("./php/VentaMayor.php?funcion=ListarDetalleModelosVenta&codigo=" + codigo + "&idmarca=" + idmarca + "&idvendedor=" + idvendedor);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso7Columns[0]),
                    new StringFieldDef(nombreCaso7Columns[1]),
                    new StringFieldDef(nombreCaso7Columns[2]),
                    new StringFieldDef(nombreCaso7Columns[3]),
                    new StringFieldDef(nombreCaso7Columns[4]),
                    new StringFieldDef(nombreCaso7Columns[5]),
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
                    new FloatFieldDef(nombreCaso7Columns[24])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso7Columns[0], 100, true);
        kardexColumn = new ColumnConfig("Id kardex", nombreCaso7Columns[1], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso7Columns[2], 100, true);
        materialColumn = new ColumnConfig("Material", nombreCaso7Columns[3], 100, true);
        clienteColumn = new ColumnConfig("Cliente", nombreCaso7Columns[4], 100, true);
        fechaColumn = new ColumnConfig("Ingreso", nombreCaso7Columns[5], 100, true);
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso7Columns[6], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso7Columns[7], 100, true);
        preciounitarioColumn = new ColumnConfig("Unit", nombreCaso7Columns[8], 100, true);
        talla33Column = new ColumnConfig("33", nombreCaso7Columns[9], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso7Columns[10], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso7Columns[11], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso7Columns[12], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso7Columns[13], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso7Columns[14], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso7Columns[15], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso7Columns[16], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso7Columns[17], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso7Columns[18], 30, true, null);
        talla43Column = new ColumnConfig("43", nombreCaso7Columns[19], 30, true, null);
        talla44Column = new ColumnConfig("44", nombreCaso7Columns[20], 30, true, null);
        talla45Column = new ColumnConfig("45", nombreCaso7Columns[21], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso7Columns[22], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso7Columns[23], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso7Columns[24], 80, true, null);

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    clienteColumn,
                    fechaColumn,
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
                    talla43Column,
                    talla44Column,
                    talla45Column,
                    totalparescajaColumn,
                    totalparesbsColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-modelos-venta-unidad");
        grid.setTitle("Modelos a vender");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setClicksToEdit(1);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);

//        grid.setWidth(ANCHO - 80);
        grid.setHeight(350);
        grid.addListener(new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store.load(0, 100);
                    }
                });
////        aniadirListenersModelosVenta();
        panel.add(grid);
    }

    public void onModuleLoad8(String codigobarra, String marca, String vendedo) {
        panel = new Panel();
        this.codigo = codigobarra;
        this.idmarca = marca;
        this.idvendedor = vendedo;
        //Finobel: Talla=14-38
        dataProxy = new ScriptTagProxy("./php/VentaMayor.php?funcion=ListarDetalleModelosVenta&codigo=" + codigo + "&idmarca=" + idmarca + "&idvendedor=" + idvendedor);

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
                    new FloatFieldDef(nombreCaso8Columns[25]),
                    new FloatFieldDef(nombreCaso8Columns[26]),
                    new FloatFieldDef(nombreCaso8Columns[27]),
                    new FloatFieldDef(nombreCaso8Columns[28]),
                    new FloatFieldDef(nombreCaso8Columns[29]),
                    new FloatFieldDef(nombreCaso8Columns[30]),
                    new FloatFieldDef(nombreCaso8Columns[31]),
                    new FloatFieldDef(nombreCaso8Columns[32]),
                    new FloatFieldDef(nombreCaso8Columns[33]),
                    new FloatFieldDef(nombreCaso8Columns[34]),
                    new FloatFieldDef(nombreCaso8Columns[35]),
                    new FloatFieldDef(nombreCaso8Columns[36])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso8Columns[0], 100, true);
        kardexColumn = new ColumnConfig("Id kardex", nombreCaso8Columns[1], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso8Columns[2], 100, true);
        colorColumn = new ColumnConfig("Color", nombreCaso8Columns[3], 100, true);
        clienteColumn = new ColumnConfig("Cliente", nombreCaso7Columns[4], 100, true);
        fechaColumn = new ColumnConfig("Ingreso", nombreCaso8Columns[5], 100, true);
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso8Columns[6], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso8Columns[7], 100, true);
        preciounitarioColumn = new ColumnConfig("Unit", nombreCaso8Columns[8], 100, true);
        talla14Column = new ColumnConfig("14", nombreCaso8Columns[9], 30, true, null);
        talla15Column = new ColumnConfig("15", nombreCaso8Columns[10], 30, true, null);
        talla16Column = new ColumnConfig("16", nombreCaso8Columns[11], 30, true, null);
        talla17Column = new ColumnConfig("17", nombreCaso8Columns[12], 30, true, null);
        talla18Column = new ColumnConfig("18", nombreCaso8Columns[13], 30, true, null);
        talla19Column = new ColumnConfig("19", nombreCaso8Columns[14], 30, true, null);
        talla20Column = new ColumnConfig("20", nombreCaso8Columns[15], 30, true, null);
        talla21Column = new ColumnConfig("21", nombreCaso8Columns[16], 30, true, null);
        talla22Column = new ColumnConfig("22", nombreCaso8Columns[17], 30, true, null);
        talla23Column = new ColumnConfig("23", nombreCaso8Columns[18], 30, true, null);
        talla24Column = new ColumnConfig("24", nombreCaso8Columns[19], 30, true, null);
        talla25Column = new ColumnConfig("25", nombreCaso8Columns[20], 30, true, null);
        talla26Column = new ColumnConfig("26", nombreCaso8Columns[21], 30, true, null);
        talla27Column = new ColumnConfig("27", nombreCaso8Columns[22], 30, true, null);
        talla28Column = new ColumnConfig("28", nombreCaso8Columns[23], 30, true, null);
        talla29Column = new ColumnConfig("29", nombreCaso8Columns[24], 30, true, null);
        talla30Column = new ColumnConfig("30", nombreCaso8Columns[25], 30, true, null);
        talla31Column = new ColumnConfig("31", nombreCaso8Columns[26], 30, true, null);
        talla32Column = new ColumnConfig("32", nombreCaso8Columns[27], 30, true, null);
        talla33Column = new ColumnConfig("33", nombreCaso8Columns[28], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso8Columns[29], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso8Columns[30], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso8Columns[31], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso8Columns[32], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso8Columns[33], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso8Columns[34], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso8Columns[35], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso8Columns[36], 80, true, null);

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    colorColumn,
                    clienteColumn,
                    fechaColumn,
                    totalcajasColumn,
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
        grid.setId("grid-lista-modelos-venta-unidad");
        grid.setTitle("Modelos a vender");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setClicksToEdit(1);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);

//        grid.setWidth(ANCHO - 80);
        grid.setHeight(350);
        grid.addListener(new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store.load(0, 100);
                    }
                });
////        aniadirListenersModelosVenta();
        panel.add(grid);
    }

    public void onModuleLoad9(String codigobarra, String marca, String vendedo) {
        panel = new Panel();
        this.codigo = codigobarra;
        this.idmarca = marca;
        this.idvendedor = vendedo;
        //Molekinha, Via Beach Nino: Talla=14-38
        dataProxy = new ScriptTagProxy("./php/VentaMayor.php?funcion=ListarDetalleModelosVenta&codigo=" + codigo + "&idmarca=" + idmarca + "&idvendedor=" + idvendedor);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso9Columns[0]),
                    new StringFieldDef(nombreCaso9Columns[1]),
                    new StringFieldDef(nombreCaso9Columns[2]),
                    new StringFieldDef(nombreCaso9Columns[3]),
                    new StringFieldDef(nombreCaso9Columns[4]),
                    new StringFieldDef(nombreCaso9Columns[5]),
                    new StringFieldDef(nombreCaso9Columns[6]),
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
                    new FloatFieldDef(nombreCaso9Columns[17]),
                    new FloatFieldDef(nombreCaso9Columns[18]),
                    new FloatFieldDef(nombreCaso9Columns[19]),
                    new FloatFieldDef(nombreCaso9Columns[20]),
                    new FloatFieldDef(nombreCaso9Columns[21]),
                    new FloatFieldDef(nombreCaso9Columns[22]),
                    new FloatFieldDef(nombreCaso9Columns[23]),
                    new FloatFieldDef(nombreCaso9Columns[24]),
                    new FloatFieldDef(nombreCaso9Columns[25]),
                    new FloatFieldDef(nombreCaso9Columns[26]),
                    new FloatFieldDef(nombreCaso9Columns[27]),
                    new FloatFieldDef(nombreCaso9Columns[28]),
                    new FloatFieldDef(nombreCaso9Columns[29]),
                    new FloatFieldDef(nombreCaso9Columns[30]),
                    new FloatFieldDef(nombreCaso9Columns[31]),
                    new FloatFieldDef(nombreCaso9Columns[32]),
                    new FloatFieldDef(nombreCaso9Columns[33]),
                    new FloatFieldDef(nombreCaso9Columns[34]),
                    new FloatFieldDef(nombreCaso9Columns[35]),
                    new FloatFieldDef(nombreCaso9Columns[36]),
                    new FloatFieldDef(nombreCaso9Columns[37])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso9Columns[0], 100, true);
        kardexColumn = new ColumnConfig("Id kardex", nombreCaso9Columns[1], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso9Columns[2], 100, true);
        materialColumn = new ColumnConfig("Material", nombreCaso9Columns[3], 100, true);
        colorColumn = new ColumnConfig("Color", nombreCaso9Columns[4], 100, true);
        clienteColumn = new ColumnConfig("Cliente", nombreCaso9Columns[5], 100, true);
        fechaColumn = new ColumnConfig("Ingreso", nombreCaso9Columns[6], 100, true);
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso9Columns[7], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso9Columns[8], 100, true);
        preciounitarioColumn = new ColumnConfig("Unit", nombreCaso9Columns[9], 100, true);
        talla14Column = new ColumnConfig("14", nombreCaso9Columns[10], 30, true, null);
        talla15Column = new ColumnConfig("15", nombreCaso9Columns[11], 30, true, null);
        talla16Column = new ColumnConfig("16", nombreCaso9Columns[12], 30, true, null);
        talla17Column = new ColumnConfig("17", nombreCaso9Columns[13], 30, true, null);
        talla18Column = new ColumnConfig("18", nombreCaso9Columns[14], 30, true, null);
        talla19Column = new ColumnConfig("19", nombreCaso9Columns[15], 30, true, null);
        talla20Column = new ColumnConfig("20", nombreCaso9Columns[16], 30, true, null);
        talla21Column = new ColumnConfig("21", nombreCaso9Columns[17], 30, true, null);
        talla22Column = new ColumnConfig("22", nombreCaso9Columns[18], 30, true, null);
        talla23Column = new ColumnConfig("23", nombreCaso9Columns[19], 30, true, null);
        talla24Column = new ColumnConfig("24", nombreCaso9Columns[20], 30, true, null);
        talla25Column = new ColumnConfig("25", nombreCaso9Columns[21], 30, true, null);
        talla26Column = new ColumnConfig("26", nombreCaso9Columns[22], 30, true, null);
        talla27Column = new ColumnConfig("27", nombreCaso9Columns[23], 30, true, null);
        talla28Column = new ColumnConfig("28", nombreCaso9Columns[24], 30, true, null);
        talla29Column = new ColumnConfig("29", nombreCaso9Columns[25], 30, true, null);
        talla30Column = new ColumnConfig("30", nombreCaso9Columns[26], 30, true, null);
        talla31Column = new ColumnConfig("31", nombreCaso9Columns[27], 30, true, null);
        talla32Column = new ColumnConfig("32", nombreCaso9Columns[28], 30, true, null);
        talla33Column = new ColumnConfig("33", nombreCaso9Columns[29], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso9Columns[30], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso9Columns[31], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso9Columns[32], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso9Columns[33], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso9Columns[34], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso9Columns[35], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso9Columns[36], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso9Columns[37], 80, true, null);

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    colorColumn,
                    clienteColumn,
                    fechaColumn,
                    totalcajasColumn,
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
        grid.setId("grid-lista-modelos-venta-unidad");
        grid.setTitle("Modelos a vender");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setClicksToEdit(1);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);

//        grid.setWidth(ANCHO - 80);
        grid.setHeight(350);
        grid.addListener(new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store.load(0, 100);
                    }
                });
////        aniadirListenersModelosVenta();
        panel.add(grid);
    }

    public void onModuleLoad10(String codigobarra, String marca, String vendedo) {
        panel = new Panel();
        this.codigo = codigobarra;
        this.idmarca = marca;
        this.idvendedor = vendedo;
        //Coca Cola: Talla=33-45
        dataProxy = new ScriptTagProxy("./php/VentaMayor.php?funcion=ListarDetalleModelosVenta&codigo=" + codigo + "&idmarca=" + idmarca + "&idvendedor=" + idvendedor);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso10Columns[0]),
                    new StringFieldDef(nombreCaso10Columns[1]),
                    new StringFieldDef(nombreCaso10Columns[2]),
                    new StringFieldDef(nombreCaso10Columns[3]),
                    new StringFieldDef(nombreCaso10Columns[4]),
                    new StringFieldDef(nombreCaso10Columns[5]),
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
                    new FloatFieldDef(nombreCaso10Columns[24])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso10Columns[0], 100, true);
        kardexColumn = new ColumnConfig("Id kardex", nombreCaso10Columns[1], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso10Columns[2], 100, true);
        colorColumn = new ColumnConfig("Color", nombreCaso10Columns[3], 100, true);
        clienteColumn = new ColumnConfig("Cliente", nombreCaso10Columns[4], 100, true);
        fechaColumn = new ColumnConfig("Fecha", nombreCaso10Columns[5], 100, true);
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso10Columns[6], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso10Columns[7], 100, true);
        preciounitarioColumn = new ColumnConfig("Unit", nombreCaso10Columns[8], 100, true);
        talla33Column = new ColumnConfig("33", nombreCaso10Columns[9], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso10Columns[10], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso10Columns[11], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso10Columns[12], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso10Columns[13], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso10Columns[14], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso10Columns[15], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso10Columns[16], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso10Columns[17], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso10Columns[18], 30, true, null);
        talla43Column = new ColumnConfig("43", nombreCaso10Columns[19], 30, true, null);
        talla44Column = new ColumnConfig("44", nombreCaso10Columns[20], 30, true, null);
        talla45Column = new ColumnConfig("45", nombreCaso10Columns[21], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso10Columns[22], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso10Columns[23], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso10Columns[24], 80, true, null);

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    colorColumn,
                    clienteColumn,
                    fechaColumn,
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
        grid.setId("grid-lista-modelos-venta-unidad");
        grid.setTitle("Modelos a vender");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setClicksToEdit(1);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);

//        grid.setWidth(ANCHO - 80);
        grid.setHeight(350);
        grid.addListener(new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store.load(0, 100);
                    }
                });
////        aniadirListenersModelosVenta();
        panel.add(grid);
    }

    public void onModuleLoad11(String codigobarra, String marca, String vendedo) {
        panel = new Panel();
        this.codigo = codigobarra;
        this.idmarca = marca;
        this.idvendedor = vendedo;
        //Cravo/Canela: Talla=33-45
        dataProxy = new ScriptTagProxy("./php/VentaMayor.php?funcion=ListarDetalleModelosVenta&codigo=" + codigo + "&idmarca=" + idmarca + "&idvendedor=" + idvendedor);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso11Columns[0]),
                    new StringFieldDef(nombreCaso11Columns[1]),
                    new StringFieldDef(nombreCaso11Columns[2]),
                    new StringFieldDef(nombreCaso11Columns[3]),
                    new StringFieldDef(nombreCaso11Columns[4]),
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
                    new FloatFieldDef(nombreCaso11Columns[18]),
                    new FloatFieldDef(nombreCaso11Columns[19]),
                    new FloatFieldDef(nombreCaso11Columns[20])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso11Columns[0], 100, true);
        kardexColumn = new ColumnConfig("Id kardex", nombreCaso11Columns[1], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso11Columns[2], 100, true);
        clienteColumn = new ColumnConfig("Cliente", nombreCaso11Columns[3], 100, true);
        fechaColumn = new ColumnConfig("Ingreso", nombreCaso11Columns[4], 100, true);
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso11Columns[5], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso11Columns[6], 100, true);
        preciounitarioColumn = new ColumnConfig("Unit", nombreCaso11Columns[7], 100, true);
        talla33Column = new ColumnConfig("33", nombreCaso11Columns[8], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso11Columns[9], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso11Columns[10], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso11Columns[11], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso11Columns[12], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso11Columns[13], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso11Columns[14], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso11Columns[15], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso11Columns[16], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso11Columns[17], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso11Columns[18], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso11Columns[19], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso11Columns[20], 80, true, null);

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    clienteColumn,
                    fechaColumn,
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
        grid.setId("grid-lista-modelos-venta-unidad");
        grid.setTitle("Modelos a vender");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setClicksToEdit(1);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);

//        grid.setWidth(ANCHO - 80);
        grid.setHeight(350);
        grid.addListener(new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store.load(0, 100);
                    }
                });
////        aniadirListenersModelosVenta();
        panel.add(grid);
    }

    public void onModuleLoad13(String codigobarra, String marca, String vendedo) {
        panel = new Panel();
        this.codigo = codigobarra;
        this.idmarca = marca;
        this.idvendedor = vendedo;
        //Colegial Novamoda: Talla=26-38
        dataProxy = new ScriptTagProxy("./php/VentaMayor.php?funcion=ListarDetalleModelosVenta&codigo=" + codigo + "&idmarca=" + idmarca + "&idvendedor=" + idvendedor);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso13Columns[0]),
                    new StringFieldDef(nombreCaso13Columns[1]),
                    new StringFieldDef(nombreCaso13Columns[2]),
                    new StringFieldDef(nombreCaso13Columns[3]),
                    new StringFieldDef(nombreCaso13Columns[4]),
                    new StringFieldDef(nombreCaso13Columns[5]),
                    new FloatFieldDef(nombreCaso13Columns[6]),
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
                    new FloatFieldDef(nombreCaso13Columns[24])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso13Columns[0], 100, true);
        kardexColumn = new ColumnConfig("Id kardex", nombreCaso13Columns[1], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso13Columns[2], 100, true);
        colorColumn = new ColumnConfig("Color", nombreCaso13Columns[3], 100, true);
        clienteColumn = new ColumnConfig("Cliente", nombreCaso13Columns[4], 100, true);
        fechaColumn = new ColumnConfig("Ingreso", nombreCaso13Columns[5], 100, true);
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso13Columns[6], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso13Columns[7], 100, true);
        preciounitarioColumn = new ColumnConfig("Unit", nombreCaso13Columns[8], 100, true);
        talla33Column = new ColumnConfig("26", nombreCaso13Columns[9], 30, true, null);
        talla34Column = new ColumnConfig("27", nombreCaso13Columns[10], 30, true, null);
        talla35Column = new ColumnConfig("28", nombreCaso13Columns[11], 30, true, null);
        talla36Column = new ColumnConfig("29", nombreCaso13Columns[12], 30, true, null);
        talla37Column = new ColumnConfig("30", nombreCaso13Columns[13], 30, true, null);
        talla38Column = new ColumnConfig("31", nombreCaso13Columns[14], 30, true, null);
        talla39Column = new ColumnConfig("32", nombreCaso13Columns[15], 30, true, null);
        talla40Column = new ColumnConfig("33", nombreCaso13Columns[16], 30, true, null);
        talla41Column = new ColumnConfig("34", nombreCaso13Columns[17], 30, true, null);
        talla42Column = new ColumnConfig("35", nombreCaso13Columns[18], 30, true, null);
        talla43Column = new ColumnConfig("36", nombreCaso13Columns[19], 30, true, null);
        talla44Column = new ColumnConfig("37", nombreCaso13Columns[20], 30, true, null);
        talla45Column = new ColumnConfig("38", nombreCaso13Columns[21], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso13Columns[22], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso13Columns[23], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso13Columns[24], 80, true, null);

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    colorColumn,
                    clienteColumn,
                    fechaColumn,
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
                    talla43Column,
                    talla44Column,
                    talla45Column,
                    totalparescajaColumn,
                    totalparesbsColumn
                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-modelos-venta-unidad");
        grid.setTitle("Modelos a vender");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setClicksToEdit(1);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);

//        grid.setWidth(ANCHO - 80);
        grid.setHeight(350);
        grid.addListener(new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store.load(0, 100);
                    }
                });
////        aniadirListenersModelosVenta();
        panel.add(grid);
    }

    public void onModuleLoad12(String codigobarra, String marca, String vendedo) {
        panel = new Panel();
        this.codigo = codigobarra;
        this.idmarca = marca;
        this.idvendedor = vendedo;

        dataProxy = new ScriptTagProxy("./php/VentaMayor.php?funcion=ListarDetalleModelosVenta&codigo=" + codigo + "&idmarca=" + idmarca + "&idvendedor=" + idvendedor);

        recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso12Columns[0]),
                    new StringFieldDef(nombreCaso12Columns[1]),
                    new StringFieldDef(nombreCaso12Columns[2]),
                    new StringFieldDef(nombreCaso12Columns[3]),
                    new StringFieldDef(nombreCaso12Columns[4]),
                    new StringFieldDef(nombreCaso12Columns[5]),
                    new StringFieldDef(nombreCaso12Columns[6]),
                    new StringFieldDef(nombreCaso12Columns[7]),
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
                    new FloatFieldDef(nombreCaso12Columns[22])
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
        idColumn = new ColumnConfig("Id modelo", nombreCaso12Columns[0], 100, true);
        kardexColumn = new ColumnConfig("Id kardex", nombreCaso12Columns[1], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso12Columns[2], 100, true);
        materialColumn = new ColumnConfig("Material", nombreCaso12Columns[3], 100, true);
        colorColumn = new ColumnConfig("Color", nombreCaso12Columns[4], 100, true);
        clienteColumn = new ColumnConfig("Cliente", nombreCaso12Columns[5], 100, true);
        fechaColumn = new ColumnConfig("Ingreso", nombreCaso12Columns[6], 100, true);
        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso12Columns[7], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso12Columns[8], 100, true);
        preciounitarioColumn = new ColumnConfig("Unit", nombreCaso12Columns[9], 100, true);
        talla36Column = new ColumnConfig("36", nombreCaso12Columns[10], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso12Columns[11], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso12Columns[12], 30, true, null);
        talla39Column = new ColumnConfig("39", nombreCaso12Columns[13], 30, true, null);
        talla40Column = new ColumnConfig("40", nombreCaso12Columns[14], 30, true, null);
        talla41Column = new ColumnConfig("41", nombreCaso12Columns[15], 30, true, null);
        talla42Column = new ColumnConfig("42", nombreCaso12Columns[16], 30, true, null);
        talla43Column = new ColumnConfig("43", nombreCaso12Columns[17], 30, true, null);
        talla44Column = new ColumnConfig("44", nombreCaso12Columns[18], 30, true, null);
        talla45Column = new ColumnConfig("45", nombreCaso12Columns[19], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso12Columns[20], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso12Columns[21], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso12Columns[22], 80, true, null);

        cbSelectionModel = new CheckboxSelectionModel();
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    codigoColumn,
                    materialColumn,
                    colorColumn,
                    clienteColumn,
                    fechaColumn,
                    totalcajasColumn,
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
        grid.setId("grid-lista-modelos-venta-unidad");
        grid.setTitle("Modelos a vender");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");
        grid.setClicksToEdit(1);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(false);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();

        grid.setBottomToolbar(pagingToolbar);

//        grid.setWidth(ANCHO - 80);
        grid.setHeight(350);
        grid.addListener(new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store.load(0, 100);
                    }
                });
////        aniadirListenersModelosVenta();
        panel.add(grid);
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

    private void aniadirListenersModelosVenta() {        
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

                        if (grid.getColumnModel().getDataIndex(colIndex).equals("indoor")) {
                            int newcol = colIndex + 1;
                            if (e.getKey() == EventObject.ENTER) {
                                Record record1 = grid.getStore().getAt(newcol);
                                record1.set("indoor", record1);
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

    public RecordDef getRecordDef() {
        return recordDef;
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
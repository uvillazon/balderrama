/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

import com.google.gwt.core.client.EntryPoint;
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
import com.gwtext.client.widgets.grid.RowSelectionModel;
import com.gwtext.client.widgets.grid.event.*;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;

/**
 *
 * @author example
 */
public class ListaCalzadoTienda {

    private EditorGridPanel grid;
   // private final int ALTO = 355;
     private final int ALTO = Utils.getScreenHeight() - 270;
    private ToolbarButton eliminarProducto;
      private ToolbarButton seleccionarProducto;
      private ToolbarButton but_aceptarR;
 private ToolbarButton but_imprimir;
  //  private ToolbarButton desglozarProducto;
    // private FormularioConsultas formularioConsultas;
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
    private ColumnConfig totalcajasColumn;
    private ColumnConfig totalparesColumn;
 //   private ColumnConfig totalcajasColumn;
    private ColumnConfig precioColumn;
    private ColumnConfig preciototalColumn;
 private ColumnConfig preciounitarioColumn;
  private ColumnConfig totalparesbsColumn;
   private ColumnConfig idcajaColumn;
   private ColumnConfig totalparescajaColumn;
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
          private String formatomayor;
            private String opcionb;
     private String opcion;
    private Object[][] vendedorM;
    private Object[][] colorM;
    private Object[][] materialM;
    //clienteM = nombreCaso3Columns[2];
   // String[] nombreCaso7Columns = {"iddetalleingreso", "codigo", "color", "precio", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "totalpares"};
    String[] nombreCaso7Columns = {"idmodelo", "codigo", "material","color","cliente", "totalcajas","precio","preciounitario","14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30", "31", "32", "33", "34", "35", "36", "37", "38", "totalpares","totalparescaja",  "totalparesbs","idkardex"};

    String[] nombreCaso5Columns = {"idmodelo", "codigo", "material","color","cliente", "totalcajas","precio","preciounitario","33", "34", "35", "36", "37", "38", "39", "40", "41", "42","43", "44", "45",  "totalpares","totalparescaja",  "totalparesbs","idkardex"};
   String[] nombreCaso333Columns = {"idmodelo", "codigo", "material","color","cliente", "totalcajas","precio","preciounitario", "1", "1m", "2", "2m", "3", "3m", "4", "4m", "5", "5m", "6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12", "12m", "13","13m",  "totalpares","totalparescaja",  "totalparesbs","idkardex"};
//     String[] nombreCaso52Columns = {"idmodelo", "codigo", "material","cliente", "totalcajas","precio","preciounitario","talla","5", "5m", "6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12",  "totalpares","totalparescaja",  "totalparesbs"};

    String[] nombreCaso6Columns = {"iddetalleingreso","coleccion", "codigo", "material", "precio", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalpares"};

    String[] nombreCaso9Columns = {"iddetalleingreso", "codigo", "precio", "33", "34", "35", "36", "37", "38", "39", "40", "41", "42", "43", "44", "45", "totalpares"};
  
    private RecordDef recordDef;

    private ColumnConfig coleccionColumn;

 public void onModuleLoad333(String idmarca,String codigo,String marca,String opcion,String formato) {
        panel = new Panel();
        this.idpedido = idmarca;
        this.idestilo = codigo;
         this.nombremarca = marca;
         this.formatomayor=formato;
         this.opcionb=opcion;

 dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetalleIngreso&idmarca=" + idpedido+"&codigo="+idestilo+"&formatomayor="+formatomayor+"&opcionb="+opcionb);


         recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso333Columns[0]),
                    new StringFieldDef(nombreCaso333Columns[1]),
                    new StringFieldDef(nombreCaso333Columns[2]),
                    new StringFieldDef(nombreCaso333Columns[3]),
                    new StringFieldDef(nombreCaso333Columns[4]),
                    new StringFieldDef(nombreCaso333Columns[5]),
                    new StringFieldDef(nombreCaso333Columns[6]),
                    new StringFieldDef(nombreCaso333Columns[7]),
                    new StringFieldDef(nombreCaso333Columns[8]),
                    new StringFieldDef(nombreCaso333Columns[9]),
                    new StringFieldDef(nombreCaso333Columns[10]),
                    new StringFieldDef(nombreCaso333Columns[11]),
                    new StringFieldDef(nombreCaso333Columns[12]),
                    new StringFieldDef(nombreCaso333Columns[13]),
                    new StringFieldDef(nombreCaso333Columns[14]),
                    new StringFieldDef(nombreCaso333Columns[15]),
                    new StringFieldDef(nombreCaso333Columns[16]),
                    new StringFieldDef(nombreCaso333Columns[17]),
                    new StringFieldDef(nombreCaso333Columns[18]),
                    new StringFieldDef(nombreCaso333Columns[19]),
                    new StringFieldDef(nombreCaso333Columns[20]),
                    new StringFieldDef(nombreCaso333Columns[21]),
                    new StringFieldDef(nombreCaso333Columns[22]),
                    new StringFieldDef(nombreCaso333Columns[23]),
                    new StringFieldDef(nombreCaso333Columns[24]),
                    new StringFieldDef(nombreCaso333Columns[25]),
                    new StringFieldDef(nombreCaso333Columns[26]),
                    new StringFieldDef(nombreCaso333Columns[27]),
                    new StringFieldDef(nombreCaso333Columns[28]),
                    new StringFieldDef(nombreCaso333Columns[29]),
                    new StringFieldDef(nombreCaso333Columns[30]),
                    new StringFieldDef(nombreCaso333Columns[31]),
                    new StringFieldDef(nombreCaso333Columns[32]),
                    new StringFieldDef(nombreCaso333Columns[33]),
                    new StringFieldDef(nombreCaso333Columns[34]),
                    new StringFieldDef(nombreCaso333Columns[35]),
                    new StringFieldDef(nombreCaso333Columns[36]),
                    new StringFieldDef(nombreCaso333Columns[37]),
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
      idColumn = new ColumnConfig("Id modelo", nombreCaso333Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso333Columns[1], 100, true);
        materialColumn = new ColumnConfig("Material", nombreCaso333Columns[2], 100, true);
        colorColumn = new ColumnConfig("Color", nombreCaso333Columns[3], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso333Columns[4], 100, true);


        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso333Columns[5], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso333Columns[6], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso333Columns[7], 100, true);
        talla1Column = new ColumnConfig("1", nombreCaso333Columns[8], 30, true, null);
        talla1mColumn = new ColumnConfig("1 1/2", nombreCaso333Columns[9], 35, true, null);
        talla2Column = new ColumnConfig("2", nombreCaso333Columns[10], 30, true, null);
        talla2mColumn = new ColumnConfig("2 1/2", nombreCaso333Columns[11], 35, true, null);
        talla3Column = new ColumnConfig("3", nombreCaso333Columns[12], 30, true, null);
        talla3mColumn = new ColumnConfig("3 1/2", nombreCaso333Columns[13], 35, true, null);
        talla4Column = new ColumnConfig("4", nombreCaso333Columns[14], 30, true, null);
        talla4mColumn = new ColumnConfig("4 1/2", nombreCaso333Columns[15], 35, true, null);
        talla5Column = new ColumnConfig("5", nombreCaso333Columns[16], 30, true, null);
        talla5mColumn = new ColumnConfig("5 1/2", nombreCaso333Columns[17], 35, true, null);
        talla6Column = new ColumnConfig("6", nombreCaso333Columns[18], 30, true, null);

        talla6mColumn = new ColumnConfig("6 1/2", nombreCaso333Columns[19], 35, true, null);
        talla7Column = new ColumnConfig("7", nombreCaso333Columns[20], 30, true, null);
        talla7mColumn = new ColumnConfig("7 1/2", nombreCaso333Columns[21], 35, true, null);
        talla8Column = new ColumnConfig("8", nombreCaso333Columns[22], 30, true, null);
        talla8mColumn = new ColumnConfig("8 1/2", nombreCaso333Columns[23], 35, true, null);
        talla9Column = new ColumnConfig("9", nombreCaso333Columns[24], 30, true, null);
        talla9mColumn = new ColumnConfig("9 1/2", nombreCaso333Columns[25], 35, true, null);
        talla10Column = new ColumnConfig("10", nombreCaso333Columns[26], 30, true, null);
        talla10mColumn = new ColumnConfig("10 1/2", nombreCaso333Columns[27], 40, true, null);
        talla11Column = new ColumnConfig("11", nombreCaso333Columns[28], 30, true, null);
        talla11mColumn = new ColumnConfig("11 1/2", nombreCaso333Columns[29], 40, true, null);
        talla12Column = new ColumnConfig("12", nombreCaso333Columns[30], 30, true, null);
        talla12mColumn = new ColumnConfig("12 1/2", nombreCaso333Columns[31], 30, true, null);
        talla13Column = new ColumnConfig("13", nombreCaso333Columns[32], 30, true, null);
 talla13mColumn = new ColumnConfig("13 1/2", nombreCaso333Columns[33], 30, true, null);
totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso333Columns[34], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso333Columns[35], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso333Columns[36], 80, true, null);
idcajaColumn = new ColumnConfig("idcaja", nombreCaso333Columns[37], 80, true, null);



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
                    totalparescajaColumn,
                    totalparesbsColumn
               };


        columnModel = new ColumnModel(columns);

       grid = new EditorGridPanel();
        //grid.setId("grid-lista-productosproveedor");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
          if (idestilo == "KARDEX") {
               grid.setTitle("Ingresado en Kardex/ Generados los codigos con anterioridad - Lista de Ingresos Marca " + nombremarca);
        } else {
               grid.setTitle("Sin Codigo/Aun no ingreso en Kardex/Primera impresion codigos de barra - Lista de Ingresos Marca " + nombremarca);
        }
        //grid.setTitle("Lista de Ingresos Marca " + nombremarca);
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

      seleccionarProducto = new ToolbarButton("Seleccionar/ para cod barra");
        seleccionarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        seleccionarProducto.setTooltip(tipsConfig3);

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);


        but_aceptarR = new ToolbarButton("Ver reporte totales");
        but_aceptarR.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig21.setText("ver productos(s)");
        //tipsConfig.setTitle("Tip Title");
        but_aceptarR.setTooltip(tipsConfig21);

        but_imprimir = new ToolbarButton("Imprimir Con pares");
        but_imprimir.setEnableToggle(true);
        QuickTipsConfig tipsConfig22 = new QuickTipsConfig();
        tipsConfig22.setText("todos los pares");
        //tipsConfig.setTitle("Tip Title");
        but_imprimir.setTooltip(tipsConfig22);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
        pagingToolbar.addSeparator();
         pagingToolbar.addButton(seleccionarProducto);
         pagingToolbar.addSeparator();
         pagingToolbar.addButton(but_aceptarR);
         pagingToolbar.addSeparator();
         pagingToolbar.addButton(but_imprimir);
        //buscador
        //buscador
   too_busquedaCBWW = new Toolbar();

        tex_codigo = new TextField("Codigo", "codigo");
        tex_marca = new TextField("Boleta", "boleta");
       // com_cliente = new TextField("Anio", "anio");
        com_coleccion = new ComboBox("Coleccion", "coleccion");
        com_estilo = new ComboBox("Estilo", "estilo");

        too_buscarCBWW = new ToolbarButton("Buscar");
        too_buscarCBWW.setPressed(true);

       // too_busquedaCBWW.addText("Codigo:");
        //too_busquedaCBWW.addField(tex_codigo);

        too_busquedaCBWW.addText("Codigo:");
 too_busquedaCBWW.addField(tex_codigo);
  too_busquedaCBWW.addText("Boleta:");
too_busquedaCBWW.addField(tex_marca);


        too_busquedaCBWW.addButton(too_buscarCBWW);
        grid.setTopToolbar(too_busquedaCBWW);


        grid.setBottomToolbar(pagingToolbar);

        aniadirListenersProducto();
        panel.add(grid);
    //     recuperarAlmacenes();
          aniadirListenersBuscador();
        aniadirListenersBuscadoresText();
    }



   public void onModuleLoad4(String idmarca,String codigo,String marca,String opcion,String formato) {
        panel = new Panel();
        this.idpedido = idmarca;
        this.idestilo = codigo;
         this.nombremarca = marca;
         this.formatomayor=formato;
         this.opcionb=opcion;
 dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetalleIngreso&idmarca=" + idpedido+"&codigo="+idestilo+"&formatomayor="+formatomayor+"&opcionb="+opcionb);
          recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef(nombreCaso7Columns[0]),
                    new StringFieldDef(nombreCaso7Columns[1]),
                    new StringFieldDef(nombreCaso7Columns[2]),
                    new StringFieldDef(nombreCaso7Columns[3]),
                    new StringFieldDef(nombreCaso7Columns[4]),
                    new StringFieldDef(nombreCaso7Columns[5]),
                    new StringFieldDef(nombreCaso7Columns[6]),
                    new StringFieldDef(nombreCaso7Columns[7]),
                    new StringFieldDef(nombreCaso7Columns[8]),
                    new StringFieldDef(nombreCaso7Columns[9]),
                    new StringFieldDef(nombreCaso7Columns[10]),
                    new StringFieldDef(nombreCaso7Columns[11]),
                    new StringFieldDef(nombreCaso7Columns[12]),
                    new StringFieldDef(nombreCaso7Columns[13]),
                    new StringFieldDef(nombreCaso7Columns[14]),
                    new StringFieldDef(nombreCaso7Columns[15]),
                    new StringFieldDef(nombreCaso7Columns[16]),
                    new StringFieldDef(nombreCaso7Columns[17]),
                    new StringFieldDef(nombreCaso7Columns[18]),
                    new StringFieldDef(nombreCaso7Columns[19]),
                    new StringFieldDef(nombreCaso7Columns[20]),
                    new StringFieldDef(nombreCaso7Columns[21]),
                    new StringFieldDef(nombreCaso7Columns[22]),
                    new StringFieldDef(nombreCaso7Columns[23]),
                    new StringFieldDef(nombreCaso7Columns[24]),
                    new StringFieldDef(nombreCaso7Columns[25]),
                    new StringFieldDef(nombreCaso7Columns[26]),
                    new StringFieldDef(nombreCaso7Columns[27]),
                    new StringFieldDef(nombreCaso7Columns[28]),
                    new StringFieldDef(nombreCaso7Columns[29]) ,
                    new StringFieldDef(nombreCaso7Columns[30]),
                    new StringFieldDef(nombreCaso7Columns[31]),
                    new StringFieldDef(nombreCaso7Columns[32]),
                    new StringFieldDef(nombreCaso7Columns[33]),
                    new StringFieldDef(nombreCaso7Columns[34]),
                    new StringFieldDef(nombreCaso7Columns[35]),
                    new StringFieldDef(nombreCaso7Columns[36])

                    });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);
      idColumn = new ColumnConfig("Id modelo", nombreCaso7Columns[0], 100, true);
        codigoColumn = new ColumnConfig("Codigo", nombreCaso7Columns[1], 100, true);
        materialColumn = new ColumnConfig("Material", nombreCaso7Columns[2], 100, true);
        colorColumn = new ColumnConfig("Color", nombreCaso7Columns[3], 100, true);

        clienteColumn = new ColumnConfig("Cliente", nombreCaso7Columns[4], 100, true);


        totalcajasColumn = new ColumnConfig("# Cajas", nombreCaso7Columns[5], 80, true, null);
        precioColumn = new ColumnConfig("Precio Venta", nombreCaso7Columns[6], 100, true);
         preciounitarioColumn = new ColumnConfig("Unit", nombreCaso7Columns[7], 100, true);
        talla14Column = new ColumnConfig("14", nombreCaso7Columns[8], 30, true, null);
        talla15Column = new ColumnConfig("15", nombreCaso7Columns[9], 30, true, null);
        talla16Column = new ColumnConfig("16", nombreCaso7Columns[10], 30, true, null);
        talla17Column = new ColumnConfig("17", nombreCaso7Columns[11], 30, true, null);
        talla18Column = new ColumnConfig("18", nombreCaso7Columns[12], 30, true, null);
        talla19Column = new ColumnConfig("19", nombreCaso7Columns[13], 30, true, null);
        talla20Column = new ColumnConfig("20", nombreCaso7Columns[14], 30, true, null);
        talla21Column = new ColumnConfig("21", nombreCaso7Columns[15], 30, true, null);
        talla22Column = new ColumnConfig("22", nombreCaso7Columns[16], 30, true, null);
        talla23Column = new ColumnConfig("23", nombreCaso7Columns[17], 30, true, null);
        talla24Column = new ColumnConfig("24", nombreCaso7Columns[18], 30, true, null);
        talla25Column = new ColumnConfig("25", nombreCaso7Columns[19], 30, true, null);
        talla26Column = new ColumnConfig("26", nombreCaso7Columns[20], 30, true, null);
        talla27Column = new ColumnConfig("27", nombreCaso7Columns[21], 30, true, null);
        talla28Column = new ColumnConfig("28", nombreCaso7Columns[22], 30, true, null);
        talla29Column = new ColumnConfig("29", nombreCaso7Columns[23], 30, true, null);
        talla30Column = new ColumnConfig("30", nombreCaso7Columns[24], 30, true, null);
        talla31Column = new ColumnConfig("31", nombreCaso7Columns[25], 30, true, null);
        // talla31Column = new ColumnConfig("21", nombreC7o1Columns[10], 200, true, null);
        talla32Column = new ColumnConfig("32", nombreCaso7Columns[26], 30, true, null);
        talla33Column = new ColumnConfig("33", nombreCaso7Columns[27], 30, true, null);
        talla34Column = new ColumnConfig("34", nombreCaso7Columns[28], 30, true, null);
        talla35Column = new ColumnConfig("35", nombreCaso7Columns[29], 30, true, null);
        talla36Column = new ColumnConfig("36", nombreCaso7Columns[30], 30, true, null);
        talla37Column = new ColumnConfig("37", nombreCaso7Columns[31], 30, true, null);
        talla38Column = new ColumnConfig("38", nombreCaso7Columns[32], 30, true, null);
        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso7Columns[33], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso7Columns[34], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso7Columns[35], 80, true, null);
idcajaColumn = new ColumnConfig("idcaja", nombreCaso7Columns[36], 80, true, null);



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
          if (idestilo == "KARDEX") {
               grid.setTitle("Ingresado en Kardex/ Generados los codigos con anterioridad - Lista de Ingresos Marca " + nombremarca);
        } else {
               grid.setTitle("Sin Codigo/Aun no ingreso en Kardex/Primera impresion codigos de barra - Lista de Ingresos Marca " + nombremarca);
        }
        //grid.setTitle("Lista de Ingresos Marca " + nombremarca);
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

      seleccionarProducto = new ToolbarButton("Seleccionar/ para cod barra");
        seleccionarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        seleccionarProducto.setTooltip(tipsConfig3);

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);


        but_aceptarR = new ToolbarButton("Ver reporte totales");
        but_aceptarR.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig21.setText("ver productos(s)");
        //tipsConfig.setTitle("Tip Title");
        but_aceptarR.setTooltip(tipsConfig21);

        but_imprimir = new ToolbarButton("Imprimir Con pares");
        but_imprimir.setEnableToggle(true);
        QuickTipsConfig tipsConfig22 = new QuickTipsConfig();
        tipsConfig22.setText("todos los pares");
        //tipsConfig.setTitle("Tip Title");
        but_imprimir.setTooltip(tipsConfig22);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
        pagingToolbar.addSeparator();
         pagingToolbar.addButton(seleccionarProducto);
         pagingToolbar.addSeparator();
         pagingToolbar.addButton(but_aceptarR);
         pagingToolbar.addSeparator();
         pagingToolbar.addButton(but_imprimir);
        //buscador
        //buscador
   too_busquedaCBWW = new Toolbar();

        tex_codigo = new TextField("Codigo", "codigo");
        tex_marca = new TextField("Boleta", "boleta");
       // com_cliente = new TextField("Anio", "anio");
        com_coleccion = new ComboBox("Coleccion", "coleccion");
        com_estilo = new ComboBox("Estilo", "estilo");

        too_buscarCBWW = new ToolbarButton("Buscar");
        too_buscarCBWW.setPressed(true);

       // too_busquedaCBWW.addText("Codigo:");
        //too_busquedaCBWW.addField(tex_codigo);

        too_busquedaCBWW.addText("Codigo:");
 too_busquedaCBWW.addField(tex_codigo);
  too_busquedaCBWW.addText("Boleta:");
too_busquedaCBWW.addField(tex_marca);


        too_busquedaCBWW.addButton(too_buscarCBWW);
        grid.setTopToolbar(too_busquedaCBWW);


        grid.setBottomToolbar(pagingToolbar);

        aniadirListenersProducto();
        panel.add(grid);
    //     recuperarAlmacenes();
          aniadirListenersBuscador();
        aniadirListenersBuscadoresText();
    }

// ske 5 a 10 m
  
  

//ramarin

    public void onModuleLoad5(String idmarca,String codigo,String marca,String opcion,String formato) {
        panel = new Panel();
        this.idpedido = idmarca;
        this.idestilo = codigo;
         this.nombremarca = marca;
         this.formatomayor=formato;
         this.opcionb=opcion;

 dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetalleIngreso&idmarca=" + idpedido+"&codigo="+idestilo+"&formatomayor="+formatomayor+"&opcionb="+opcionb);

//         dataProxy = new ScriptTagProxy("./php/IngresoAlmacen.php?funcion=ListarDetalleIngreso&idmarca=" + idpedido+"&codigo="+idestilo);
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
                    new StringFieldDef(nombreCaso5Columns[20]),
                     new StringFieldDef(nombreCaso5Columns[21]),
                    new StringFieldDef(nombreCaso5Columns[22]),
                    new StringFieldDef(nombreCaso5Columns[23]),
                    new StringFieldDef(nombreCaso5Columns[24])
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
        talla43Column = new ColumnConfig("43", nombreCaso5Columns[18], 30, true, null);
        talla44Column = new ColumnConfig("44", nombreCaso5Columns[19], 30, true, null);
        talla45Column = new ColumnConfig("45", nombreCaso5Columns[20], 30, true, null);

        totalparesColumn = new ColumnConfig("Tot. Pares", nombreCaso5Columns[21], 80, true, null);
        totalparescajaColumn = new ColumnConfig("Total pares caja", nombreCaso5Columns[22], 80, true, null);
        totalparesbsColumn = new ColumnConfig("Total Sus", nombreCaso5Columns[23], 80, true, null);
idcajaColumn = new ColumnConfig("idcaja", nombreCaso5Columns[24], 80, true, null);



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
          if (idestilo == "KARDEX") {
               grid.setTitle("Ingresado en Kardex/ Generados los codigos con anterioridad - Lista de Ingresos Marca " + nombremarca);
        } else {
               grid.setTitle("Sin Codigo/Aun no ingreso en Kardex/Primera impresion codigos de barra - Lista de Ingresos Marca " + nombremarca);
        }
        //grid.setTitle("Lista de Ingresos Marca " + nombremarca);
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

      seleccionarProducto = new ToolbarButton("Seleccionar/ para cod barra");
        seleccionarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        seleccionarProducto.setTooltip(tipsConfig3);

        eliminarProducto = new ToolbarButton("Quitar");
        eliminarProducto.setEnableToggle(true);
        QuickTipsConfig tipsConfig2 = new QuickTipsConfig();
        tipsConfig2.setText("seleccionar producto(s)");
        //tipsConfig.setTitle("Tip Title");
        eliminarProducto.setTooltip(tipsConfig2);


        but_aceptarR = new ToolbarButton("Ver reporte totales");
        but_aceptarR.setEnableToggle(true);
        QuickTipsConfig tipsConfig21 = new QuickTipsConfig();
        tipsConfig21.setText("ver productos(s)");
        //tipsConfig.setTitle("Tip Title");
        but_aceptarR.setTooltip(tipsConfig21);

        but_imprimir = new ToolbarButton("Imprimir Con pares");
        but_imprimir.setEnableToggle(true);
        QuickTipsConfig tipsConfig22 = new QuickTipsConfig();
        tipsConfig22.setText("todos los pares");
        //tipsConfig.setTitle("Tip Title");
        but_imprimir.setTooltip(tipsConfig22);

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No topics to display");
        pagingToolbar.addSeparator();
        pagingToolbar.addButton(eliminarProducto);
        pagingToolbar.addSeparator();
         pagingToolbar.addButton(seleccionarProducto);
         pagingToolbar.addSeparator();
         pagingToolbar.addButton(but_aceptarR);
         pagingToolbar.addSeparator();
         pagingToolbar.addButton(but_imprimir);
        //buscador
        //buscador
   too_busquedaCBWW = new Toolbar();

        tex_codigo = new TextField("Codigo", "codigo");
        tex_marca = new TextField("Boleta", "boleta");
       // com_cliente = new TextField("Anio", "anio");
        com_coleccion = new ComboBox("Coleccion", "coleccion");
        com_estilo = new ComboBox("Estilo", "estilo");

        too_buscarCBWW = new ToolbarButton("Buscar");
        too_buscarCBWW.setPressed(true);

       // too_busquedaCBWW.addText("Codigo:");
        //too_busquedaCBWW.addField(tex_codigo);

        too_busquedaCBWW.addText("Codigo:");
 too_busquedaCBWW.addField(tex_codigo);
  too_busquedaCBWW.addText("Boleta:");
too_busquedaCBWW.addField(tex_marca);


        too_busquedaCBWW.addButton(too_buscarCBWW);
        grid.setTopToolbar(too_busquedaCBWW);


        grid.setBottomToolbar(pagingToolbar);

        aniadirListenersProducto();
        panel.add(grid);
    //     recuperarAlmacenes();
          aniadirListenersBuscador();
        aniadirListenersBuscadoresText();
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

                tex_codigo.addListener(new TextFieldListenerAdapter() {

                    @Override
                    public void onSpecialKey(Field field, EventObject e) {
                        if (e.getKey() == EventObject.ENTER) {
                            buscarSegunParametros();
                        //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 2");
                        }
                    }
                });
 tex_marca.addListener(new TextFieldListenerAdapter() {

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
                            new UrlParam("buscarcodigo", tex_codigo.getText()),
                            new UrlParam("buscarmarca", tex_marca.getText())}, false);
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

//            seleccionarProducto.addListener(new ButtonListenerAdapter() {
//
//            private boolean procederAEliminar;
//            int repeat = 0;
//            Record[] records;
//
//            @Override
//            public void onClick(Button button, EventObject e) {
//                records = cbSelectionModel.getSelections();
//
//                //Record[] cambiados = grid.getStore().getModifiedRecords();
//
//                if (records.length > 0) {
//                   MessageBox.confirm("Para cod Barras", "Realmente desea seleccionar " + records.length + " item(s)? ", new MessageBox.ConfirmCallback() {
//
//                        public void execute(String btnID) {
//                            if (btnID.equalsIgnoreCase("yes")) {
//                                JSONArray productos = new JSONArray();
//                                JSONObject productoObject;
//
//                                for (int i = 0; i < records.length; i++) {
//                                    productoObject = new JSONObject();
//                                    productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
//                                    productos.set(i, productoObject);
//                                    productoObject = null;
//                                }
//                                //eliminar
//                                final String datos = "resultado=" + productos.toString();
//                                //com.google.gwt.user.client.Window.alert("error 9998 " + datos);
//                                Utils.setErrorPrincipal("Impresion codigo(s)", "cargar");
//                                     String url = "./php/IngresoAlmacen.php?funcion=Registrarcodigo&" + datos;
//                          // String url = "./php/productos.php?funcion=eliminarproductos&" + datos;
//
//                                final Conector conec = new Conector(url, false, "POST");
//                                // com.google.gwt.user.client.Window.alert("error 9999 " + conec.toString());
//                                try {
//                                    conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {
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
//
//                                                    Window.alert(mensajeR);
//                                    String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
// String enlTemp = "funcion=AdicionCodigoBarraIngresoDetalleHTML&idimpresion=" + idventaG;
//                    verReporte(enlTemp);
//                      store.reload();
//
//                                                } else {
//                                                    //Window.alert(mensajeR);
//                                                    com.google.gwt.user.client.Window.alert("error 1000");
//                                                    Utils.setErrorPrincipal(mensajeR, "error");
//                                                }
//                                            } else {
//                                                com.google.gwt.user.client.Window.alert("error 1001");
//                                                Utils.setErrorPrincipal("Error en la respuesta del servidor", "error");
//                                            }
//                                        }
//
//                                        public void onError(Request request, Throwable exception) {
//                                            //Window.alert("Ocurrio un error al conectar con el servidor ");
//                                            com.google.gwt.user.client.Window.alert("error 1002");
//                                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//                                        }
//                                    });
//                                } catch (RequestException ex) {
//                                    //Window.alert("Ocurrio un error al conectar con el servidor");
//                                    com.google.gwt.user.client.Window.alert("error 1003");
//                                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
//                                }
//                            }
//                        }
//                    });
//                } else {
//                    MessageBox.alert("No hay producto selecionado para editar y/o selecciono mas de uno.");
//                }
//                seleccionarProducto.setPressed(false);
//            }
//        });
            seleccionarProducto.addListener(new ButtonListenerAdapter() {

            private boolean procederAEliminar;
            int repeat = 0;
            Record[] records;

            @Override
            public void onClick(Button button, EventObject e) {
                records = cbSelectionModel.getSelections();

                //Record[] cambiados = grid.getStore().getModifiedRecords();

                if (records.length > 0) {
                   MessageBox.confirm("Para cod Barras", "Realmente desea seleccionar " + records.length + " item(s)? ", new MessageBox.ConfirmCallback() {

                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
                                JSONArray productos = new JSONArray();
                                JSONObject productoObject;

                                for (int i = 0; i < records.length; i++) {
                                    productoObject = new JSONObject();
                                    productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
                                    productoObject.put("idkardex", new JSONString(records[i].getAsString("idkardex")));

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
 but_aceptarR.addListener(new ButtonListenerAdapter() {

            private boolean procederAEliminar;
            int repeat = 0;
//modseleccion
            @Override
            public void onClick(Button button, EventObject e) {
               // Record[] records = cbSelectionModel.getSelections();
              
               String enlace = "funcion=verIngresosMarcaHTML&idmarca=" + idpedido;
               verReporte(enlace);

                but_aceptarR.setPressed(false);
            }
        });


         but_imprimir.addListener(new ButtonListenerAdapter() {

            private boolean procederAEliminar;
            int repeat = 0;
//modseleccion
            @Override
            public void onClick(Button button, EventObject e) {

                imprimirCompra("mismo");
                but_imprimir.setPressed(false);
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
    private void recuperarAlmacenes() {
       // SimpleStore tiposStore = new SimpleStore("anio", clienteM);
       // tiposStore.load();

        com_coleccion.setDisplayField("codigo");
        com_coleccion.setValueField("idcoleccion");
        com_coleccion.setForceSelection(true);
        com_coleccion.setMinChars(1);
        com_coleccion.setMode(ComboBox.LOCAL);
        com_coleccion.setFieldLabel("codigo");
        com_coleccion.setEmptyText("Seleccione una Coleccion");
        com_coleccion.setLoadingText("Buscando");
        com_coleccion.setTypeAhead(true);
        com_coleccion.setSelectOnFocus(true);
        com_coleccion.setHideTrigger(true);
       // SimpleStore proveedorStore = new SimpleStore("anio", coleccionMO);
        SimpleStore proveedorStore = new SimpleStore(new String[]{"idcoleccion", "codigo"}, coleccionMO);
        proveedorStore.load();
        com_coleccion.setStore(proveedorStore);


  com_estilo.setDisplayField("nombre");
        com_estilo.setValueField("idestilo");
        com_estilo.setForceSelection(true);
        com_estilo.setMinChars(1);
        com_estilo.setMode(ComboBox.LOCAL);
        com_estilo.setFieldLabel("nombre");
        com_estilo.setEmptyText("Seleccione un estilo");
        com_estilo.setLoadingText("Buscando");
        com_estilo.setTypeAhead(true);
        com_estilo.setSelectOnFocus(true);
        com_estilo.setHideTrigger(true);
        SimpleStore proveedorStore1 = new SimpleStore(new String[]{"idestilo", "nombre"}, estiloMO);
        proveedorStore1.load();
        com_estilo.setStore(proveedorStore1);

    }



}
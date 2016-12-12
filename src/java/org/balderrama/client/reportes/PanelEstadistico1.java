/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.reportes;

import com.google.gwt.core.client.EntryPoint;
import com.gwtext.client.data.*;
import org.balderrama.client.MainEntryPoint;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.Viewport;
import com.gwtext.client.widgets.chart.yui.PieChart;
import com.gwtext.client.widgets.form.NumberField;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.grid.*;
import com.gwtext.client.widgets.grid.event.EditorGridListenerAdapter;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.VerticalLayout;
import org.balderrama.client.emergentes.SeleccionEstadistico;
import org.balderrama.client.util.KMenu;

//public class PanelEstadistico1 implements EntryPoint {
public class PanelEstadistico1 extends Panel {
     private String COMPRA_DIRECTA_TABBED = "7000_venta-";
     public PanelEstadistico1(SeleccionEstadistico SM, MainEntryPoint ma, KMenu kmenu) {
//         this.kmenu = kmenu;
//        this.SM = SM;
//        this.panell= ma;
// this.vendedorM = vendedores;
//
//        this.idcliente = idclient;
//        this.codigo = codigo;
//        this.nombre = nombre;
//        this.mes1 = venta;
//        this.mes2 = devolucion;
//        this.mes3 = rebaja;
//
//          this.cobro3 = porpagar;
//          this.cobrototal = pagado;
//       this.porcobrar = porcobrar;
////this.montopendiente= pagopendiente;
//            this.opciondescuento="1";
//            pagadopendiente="";
//  //          this.pendientes = pendientess;
//            opciongrid ="1";
//            esprimerpago="SI";
        //this.creditoM = materialM;
        onModuleLoad();
    }
    public void onModuleLoad() {
 setId("tab-" + COMPRA_DIRECTA_TABBED);
        setTitle("Cobros por Marca");
        setLayout(new FitLayout());
        setBaseCls("x-plain");
        this.setClosable(true);
        this.setId("TPfun11041");
        setIconCls("tab-icon");
        Panel panel = new Panel();
        panel.setPaddings(15);

        panel.setLayout(new VerticalLayout(15));

        MemoryProxy proxy = new MemoryProxy(getData());
        RecordDef recordDef = new RecordDef(
                new FieldDef[]{
                        new StringFieldDef("response"),
                        new IntegerFieldDef("count"),
                        new StringFieldDef("legend")
                }
        );

        ArrayReader reader = new ArrayReader(recordDef);
        final Store store = new Store(proxy, reader);
        store.load();

        final PieChart chart = new PieChart();
        chart.setTitle("Survey Chart");
        chart.setWMode("transparent");
        chart.setStore(store);
        chart.setDataField("count");
        chart.setCategoryField("response");

        chart.setExpressInstall("js/yui/assets/expressinstall.swf");
        chart.setWidth(500);
        chart.setHeight(400);

        panel.add(chart);

        ColumnConfig responseConfig = new ColumnConfig("Response", "response", 100, true);
        TextField textField = new TextField();
        textField.setSelectOnFocus(true);
        //responseConfig.setEditor(new GridEditor(textField));

        NumberField numberField = new NumberField();
        numberField.setSelectOnFocus(true);

        ColumnConfig countConfig = new ColumnConfig("Count", "count", 130, true);
        //countConfig.setEditor(new GridEditor(numberField));

        ColumnConfig legendConfig = new ColumnConfig("Legend", "legend", 60, true);
        legendConfig.setRenderer(new Renderer() {
            public String render(Object value, CellMetadata cellMetadata, Record record, int rowIndex, int colNum, Store store) {
                cellMetadata.setHtmlAttribute("style=\"background:" + value + ";\"");
                return "";
            }
        });

        ColumnModel columnModel = new ColumnModel(new ColumnConfig[]{
                responseConfig,
                countConfig,
                legendConfig
        });

        EditorGridPanel grid = new EditorGridPanel();
        grid.setStore(store);
        grid.setClicksToEdit(1);
        grid.setColumnModel(columnModel);
        grid.setWidth(300);

        grid.addEditorGridListener(new EditorGridListenerAdapter() {
            public void onAfterEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
                store.commitChanges();
                chart.refresh();
            }
        });

        panel.add(grid);

        Viewport viewport = new Viewport(panel);
    }

    private static Object[][] getData() {
        return new Object[][]{
                new Object[]{"Summer", new Integer(564815), "#00b8bf"},
                new Object[]{"Fall", new Double(664182), "#8dd5e7"},
                new Object[]{"Spring", new Double(248124), "#c0fff6"},
                new Object[]{"Winter", new Double(271214), "#ffa928"},
                new Object[]{"Undecided", new Double(81845), "#edff9f"}
        };
    }
}
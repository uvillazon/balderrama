/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package org.balderrama.client.configuracion;

/**
 *
 * @author miguel
 */
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

import com.gwtext.client.widgets.Component;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.event.PanelListenerAdapter;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.event.GridCellListenerAdapter;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.data.*;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.widgets.grid.RowSelectionModel;

/**
 *
 * @author example
 */
public class ListaMaterialSimple {

    private GridPanel grid;
    private String ANCHO = "100%";
    private String ALTO = "400px";
    private CheckboxSelectionModel cbSelectionModel;
    private Store store;
    private BaseColumnConfig[] columns;
    private ColumnModel columnModel;
    private DataProxy dataProxy;
    private JsonReader reader;
    PagingToolbar pagingToolbar;
    String selecionado = "";
    private Panel panel;
    private ColumnConfig idmaterialColumn;
    private ColumnConfig nombreColumn;
    private ColumnConfig descripcionColumn;
    private ColumnConfig codigoColumn;


    public ListaMaterialSimple(String ancho, String alto) {
        this.ANCHO = ancho;
        this.ALTO = alto;

    }

    public ListaMaterialSimple(){

    }

    public void onModuleLoad() {
        panel = new Panel();
        dataProxy = new ScriptTagProxy("php/Material.php?funcion=ListarMateriales");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idmaterial"),
                    new StringFieldDef("nombre"),
                    new StringFieldDef("descripcion"),
                    new StringFieldDef("codigo")
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);

        /* columna de idproveedor  */
        idmaterialColumn = new ColumnConfig("IdMaterial", "idmaterial", 100, false);
        nombreColumn = new ColumnConfig("Nombre", "nombre", 100, false);
        /* columnade nombre  */
        descripcionColumn = new ColumnConfig("Descripcion", "descripcion", 100, false);
        /* columna de cantidad  */
        codigoColumn = new ColumnConfig("Codigo", "codigo", 100, false);

        cbSelectionModel = new CheckboxSelectionModel();
        CheckboxColumnConfig checkBoxColumn = new CheckboxColumnConfig(cbSelectionModel);
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    idmaterialColumn,
                    nombreColumn,
                    descripcionColumn,
                    codigoColumn

                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-Colores");
        grid.setWidth("100%");
        grid.setHeight(ALTO);
        //  grid.setTitle("Lista de proveedors");
        grid.setStore(store);
        grid.setColumnModel(columnModel);
        grid.setTrackMouseOver(true);
        grid.setLoadMask(true);
        grid.setSelectionModel(new RowSelectionModel());
        grid.setSelectionModel(cbSelectionModel);
        grid.setFrame(true);
        grid.setStripeRows(true);
        grid.setIconCls("grid-icon");

        pagingToolbar = new PagingToolbar(store);
        pagingToolbar.setPageSize(100);
        pagingToolbar.setDisplayInfo(true);
        pagingToolbar.setDisplayMsg("Mostrando {0} - {1} de {2}");
        pagingToolbar.setEmptyMsg("No existen materiales para mostar");

        grid.setBottomToolbar(pagingToolbar);

        aniadirListenersProveedor();
        panel.add(grid);
    }

    public GridPanel getGrid() {
        return grid;
    }

    public void setGrid(GridPanel grid) {
        this.grid = grid;
    }

    public Panel getPanel() {
        return panel;
    }

    private void aniadirListenersProveedor() {

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

                    }
                });
    }

    public CheckboxSelectionModel getCbSelectionModel() {
        return cbSelectionModel;
    }

}

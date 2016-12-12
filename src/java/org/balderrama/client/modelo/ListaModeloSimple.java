/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package org.balderrama.client.modelo;

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
public class ListaModeloSimple {

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
    private ColumnConfig idmodeloColumn;
    private ColumnConfig idmarcaColumn;
    private ColumnConfig idcoleccionColumn;
    private ColumnConfig marcaColumn;
    private ColumnConfig detalleColumn;
    private ColumnConfig stylenameColumn;
    private ColumnConfig idlineaColumn;

    public ListaModeloSimple(String ancho, String alto) {
        this.ANCHO = ancho;
        this.ALTO = alto;

    }

    public ListaModeloSimple(){

    }

    public void onModuleLoad() {
        panel = new Panel();
        dataProxy = new ScriptTagProxy("php/Modelo.php?funcion=ListaModelo");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idmodelo"),
                    new StringFieldDef("idmarca"),
                    new StringFieldDef("idcoleccion"),
                    new StringFieldDef("marca"),
                    new StringFieldDef("stylename"),
                    new StringFieldDef("idlinea"),
                    new StringFieldDef("detalle")
                });
        reader = new JsonReader(recordDef);
        reader.setRoot("resultado");
        reader.setTotalProperty("totalCount");
        store = new Store(dataProxy, reader, true);

        /* columna de idproveedor  */
        idmodeloColumn = new ColumnConfig("IdModelo", "idmodelo", 100, false);
        idmarcaColumn = new ColumnConfig("IdMarca", "idmarca", 100, false);
        /* columnade nombre  */
        idcoleccionColumn = new ColumnConfig("IdColeccion", "idcoleccion", 100, false);
        /* columna de cantidad  */
        marcaColumn = new ColumnConfig("Marca", "marca", 100, false);

        stylenameColumn = new ColumnConfig("StyleName", "stylename", 100, false);
        idlineaColumn = new ColumnConfig("IdLinea", "idlinea", 100, false);
        /* columna de nit */
        detalleColumn = new ColumnConfig("Detalle", "detalle", 100, false);


        cbSelectionModel = new CheckboxSelectionModel();
        CheckboxColumnConfig checkBoxColumn = new CheckboxColumnConfig(cbSelectionModel);
        columns = new BaseColumnConfig[]{new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel),
                    idmodeloColumn,
                    idmarcaColumn,
                    idcoleccionColumn,
                    marcaColumn,
                    stylenameColumn,
                    idlineaColumn,
                    detalleColumn

                };

        columnModel = new ColumnModel(columns);

        grid = new EditorGridPanel();
        grid.setId("grid-lista-Modelos");
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
        pagingToolbar.setEmptyMsg("No existen modelos para mostar");

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

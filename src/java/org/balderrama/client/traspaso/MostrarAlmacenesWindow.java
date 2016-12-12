/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.traspaso;

import com.gwtext.client.data.DataProxy;
import com.gwtext.client.data.FieldDef;
import com.gwtext.client.data.JsonReader;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.RecordDef;
import com.gwtext.client.data.ScriptTagProxy;
import com.gwtext.client.data.Store;
import com.gwtext.client.data.StringFieldDef;
import com.gwtext.client.widgets.Component;
import com.gwtext.client.widgets.event.PanelListenerAdapter;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.event.GridCellListenerAdapter;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.RowNumberingColumnConfig;
import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;

/**
 *
 * @author buggy
 */
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
public class MostrarAlmacenesWindow extends Window {

    private GridPanel grid1124;
    private ColumnConfig codigoColumn1124;
    private ColumnConfig comunidadColumn1124;
    private ColumnConfig nombreColumn1124;
    private ColumnConfig direccionColumn1124;
    private ColumnConfig telefonoColumn1124;
    private ColumnConfig tipoColumn1124;
    private final int ANCHO = 500;
    private final int ALTO = 500;
    protected ExtElement ext_element1124;
    private CheckboxSelectionModel cbSelectionModel1124;
    private Store store1124;
    private ColumnConfig idColumn1124;
    private BaseColumnConfig[] columns1124;
    private ColumnModel columnModel1124;
    private DataProxy dataProxy1124;
    private JsonReader reader1124;
    String selecionado1124 = "";
    private TraspasoWindow padre;
    String dato;

    public MostrarAlmacenesWindow(TraspasoWindow padred) {
        this.padre = padred;
        this.setClosable(true);
        this.setId("TPfun1124Window");
        setIconCls("tab-icon");
        setAutoScroll(true);
        setTitle("Listado de Almacenes");
        onModuleLoad();
    }

    public MostrarAlmacenesWindow(TraspasoWindow padred, String dato) {
        this.padre = padred;
        this.dato = dato;
        this.setClosable(true);
        this.setId("TPfun1124Window");
        setIconCls("tab-icon");
        setAutoScroll(true);
        setTitle("Listado de Almacenes");
        onModuleLoad1();
    }

    public void onModuleLoad() {
        dataProxy1124 = new ScriptTagProxy("php/almacen.php?funcion=listaralmacen");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idalmacen"),
                    new StringFieldDef("codigo"),
                    new StringFieldDef("comunidad"),
                    new StringFieldDef("nombre"),
                    new StringFieldDef("direccion"),
                    new StringFieldDef("telefono"),
                    new StringFieldDef("tipo"),});
        reader1124 = new JsonReader(recordDef);
        reader1124.setRoot("resultado");
        reader1124.setTotalProperty("totalCount");

        store1124 = new Store(dataProxy1124, reader1124, true);
        //chanchadita(store);

        /* columnade id categoria de documento  */
        idColumn1124 = new ColumnConfig("Id Almacen.", "idlamacen", 100, true);
        /* columnade codigo  */
        codigoColumn1124 = new ColumnConfig("Codigo.", "codigo", 100, true);
        /* columnade nombre  */

        comunidadColumn1124 = new ColumnConfig("Comunidad", "comunidad", 100);


        nombreColumn1124 = new ColumnConfig("Nombre", "nombre", 100);
        /* columnade correlativo  */
        direccionColumn1124 = new ColumnConfig("Direccion", "direccion", 110, true);
        /* columnade nota fiscal  */
        telefonoColumn1124 = new ColumnConfig("Telefono", "telefono", 120, true);
        /* columnade formato  */
        tipoColumn1124 = new ColumnConfig("Tipo", "tipo", 100, true);
        /* columnade moneda  */

        cbSelectionModel1124 = new CheckboxSelectionModel();
        CheckboxColumnConfig checkBoxColumn = new CheckboxColumnConfig(cbSelectionModel1124);
        columns1124 = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel1124),
                    //column ID is company which is later used in setAutoExpandColumn
                    codigoColumn1124,
                    comunidadColumn1124,
                    nombreColumn1124,
                    direccionColumn1124,
                    telefonoColumn1124,
                    tipoColumn1124,};

        columnModel1124 = new ColumnModel(columns1124);

        grid1124 = new EditorGridPanel();
        grid1124.setId("grid-lista-Almacen");

        grid1124.setTitle("Lista de categoria de documentos");
        grid1124.setStore(store1124);
        grid1124.setColumnModel(columnModel1124);
        grid1124.setTrackMouseOver(true);
        grid1124.setLoadMask(true);
        //grid.setSelectionModel(new RowSelectionModel());
        grid1124.setSelectionModel(cbSelectionModel1124);
        grid1124.setFrame(true);
        grid1124.setStripeRows(true);
        grid1124.setIconCls("grid-icon");


        add(grid1124);
        aniadirListenersBuscadoresText();


        aniadirListenersUsuario();
        grid1124.setWidth(ANCHO);
        grid1124.setHeight(ALTO);
    }

    public void onModuleLoad1() {
        dataProxy1124 = new ScriptTagProxy("php/almacen.php?funcion=listaralmacen1");
        final RecordDef recordDef = new RecordDef(new FieldDef[]{
                    new StringFieldDef("idalmacen"),
                    new StringFieldDef("codigo"),
                    new StringFieldDef("comunidad"),
                    new StringFieldDef("nombre"),
                    new StringFieldDef("direccion"),
                    new StringFieldDef("telefono"),
                    new StringFieldDef("tipo"),});
        reader1124 = new JsonReader(recordDef);
        reader1124.setRoot("resultado");
        reader1124.setTotalProperty("totalCount");

        store1124 = new Store(dataProxy1124, reader1124, true);
        //chanchadita(store);

        /* columnade id categoria de documento  */
        idColumn1124 = new ColumnConfig("Id Almacen.", "idlamacen", 100, true);
        /* columnade codigo  */
        codigoColumn1124 = new ColumnConfig("Codigo.", "codigo", 100, true);
        /* columnade nombre  */

        comunidadColumn1124 = new ColumnConfig("Comunidad", "comunidad", 100);


        nombreColumn1124 = new ColumnConfig("Nombre", "nombre", 100);
        /* columnade correlativo  */
        direccionColumn1124 = new ColumnConfig("Direccion", "direccion", 110, true);
        /* columnade nota fiscal  */
        telefonoColumn1124 = new ColumnConfig("Telefono", "telefono", 120, true);
        /* columnade formato  */
        tipoColumn1124 = new ColumnConfig("Tipo", "tipo", 100, true);
        /* columnade moneda  */

        cbSelectionModel1124 = new CheckboxSelectionModel();
        CheckboxColumnConfig checkBoxColumn = new CheckboxColumnConfig(cbSelectionModel1124);
        columns1124 = new BaseColumnConfig[]{
                    new RowNumberingColumnConfig(),
                    new CheckboxColumnConfig(cbSelectionModel1124),
                    //column ID is company which is later used in setAutoExpandColumn
                    codigoColumn1124,
                    comunidadColumn1124,
                    nombreColumn1124,
                    direccionColumn1124,
                    telefonoColumn1124,
                    tipoColumn1124,};

        columnModel1124 = new ColumnModel(columns1124);

        grid1124 = new EditorGridPanel();
        grid1124.setId("grid-lista-Almacen");

        grid1124.setTitle("Lista de categoria de documentos");
        grid1124.setStore(store1124);
        grid1124.setColumnModel(columnModel1124);
        grid1124.setTrackMouseOver(true);
        grid1124.setLoadMask(true);
        //grid.setSelectionModel(new RowSelectionModel());
        grid1124.setSelectionModel(cbSelectionModel1124);
        grid1124.setFrame(true);
        grid1124.setStripeRows(true);
        grid1124.setIconCls("grid-icon");


        add(grid1124);
        aniadirListenersBuscadoresText1();


        aniadirListenersUsuario();
        grid1124.setWidth(ANCHO);
        grid1124.setHeight(ALTO);
    }

    private void aniadirListenersUsuario() {

        grid1124.addListener(
                new PanelListenerAdapter() {

                    @Override
                    public void onRender(Component component) {
                        store1124.load(0, 100);
                    }
                });
        grid1124.addGridCellListener(
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

    public void aniadirListenersBuscadoresText() {
        //**************************************************
        //*********** BUSCADOR CI
        //**************************************************

        grid1124.addGridRowListener(new GridRowListenerAdapter() {

            @Override
            public void onRowDblClick(GridPanel grid, int rowIndex, EventObject e) {
                Record data = grid1124.getStore().getRecordAt(rowIndex);
                padre.recuperarAlmacenOrigen(data.getAsString("idalmacen"), data.getAsString("nombre"));
                MostrarAlmacenesWindow.this.destroy();
                MostrarAlmacenesWindow.this.close();

            }
        });
    }
    public void aniadirListenersBuscadoresText1() {
        //**************************************************
        //*********** BUSCADOR CI
        //**************************************************

        grid1124.addGridRowListener(new GridRowListenerAdapter() {

            @Override
            public void onRowDblClick(GridPanel grid, int rowIndex, EventObject e) {
                Record data = grid1124.getStore().getRecordAt(rowIndex);
                padre.recuperarAlmacenDestino(data.getAsString("idalmacen"), data.getAsString("nombre"));
                MostrarAlmacenesWindow.this.destroy();
                MostrarAlmacenesWindow.this.close();

            }
        });
    }

    public void recargarTabla() {
        store1124.reload();
        grid1124.reconfigure(store1124, columnModel1124);
        grid1124.getView().refresh();
    }
}



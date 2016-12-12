/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;


import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.RegionPosition;
import com.gwtext.client.data.Store;
import com.gwtext.client.widgets.PaddedPanel;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.NumberField;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.layout.BorderLayout;
import com.gwtext.client.widgets.layout.BorderLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.TableLayout;

/**
 *
 * @author haydee
 */
public class IngresoTiendaCodigo extends Panel {

    private GridPanel grid;
     private final int ANCHO = 1000;
    private final int ALTO = 540;
    protected String buscarModelo;
    protected String buscarMarca;
    protected String buscarColeccion;
    protected String buscarLinea;
   //  private Object[][] productoM;
        // private Object[][] tallaM;
 //    private ComboBox com_codigoproducto;
      boolean respuesta = false;
       private TextField tex_marca;
    // private EditarMarcaForm formulario;
       private ListaCalzadoTiendaCodigo lista1;
    protected ExtElement ext_element;
    CheckboxSelectionModel cbSelectionModel;
    Store store;
    ColumnModel columnModel;
    String idmarca;
   String marca;
 //  String idestilo;
   // String estilo;
   // Object[][] coleccionM;
      Object[][] estiloM;
       private NumberField tex_montoTotal;
    public IngresoTiendaCodigo(String idmarcam, String nombrem,Object[][] modelo) {
   // public IngresoTiendaCodigo(String idmarcam, String nombrem,String estilom, Object[][] coleccion,Object[][] modelo,Object[][] producto,Object[][] tall) {

        this.setClosable(true);
        this.setId("TPfun5028");
        this.idmarca = idmarcam;
        this.marca = nombrem;
        this.estiloM = modelo;
     //    this.tallaM = tall;
        setIconCls("tab-icon");
        setAutoScroll(false);
 setTitle("Impresiones codigo de Barra");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setLayout(new FitLayout());
        //onModuleLoad(true);
       onModuleLoad();
    }


    public void onModuleLoad() {

        Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");

        Panel pan_norte = new Panel();
        pan_norte.setLayout(new TableLayout(2));
        pan_norte.setBaseCls("x-plain");
        pan_norte.setHeight(35);
        pan_norte.setPaddings(5);
        pan_norte.setAutoWidth(true);

         Panel pan_sud = new Panel();
        pan_sud.setLayout(new TableLayout(1));
        pan_sud.setBaseCls("x-plain");
        pan_sud.setHeight(10);
        pan_sud.setPaddings(5);

       lista1 = new ListaCalzadoTiendaCodigo();
   lista1.onModuleLoad(idmarca,marca,estiloM);

 Panel pan_centro = lista1.getPanel();

        FormPanel for_panel1 = new FormPanel();
        for_panel1.setBaseCls("x-plain");
        tex_marca = new TextField("Marca", "totalprecio");
        for_panel1.add(tex_marca);
        pan_norte.add(new PaddedPanel(for_panel1, 0, 5, 5, 0));
        FormPanel for_panel4 = new FormPanel();
        for_panel4.setBaseCls("x-plain");
        for_panel4.setWidth(400);
        for_panel4.setLabelWidth(70);
        tex_montoTotal = new NumberField("total", "montototal", 200);
        tex_montoTotal.setHeight(30);
        tex_montoTotal.setValue("0");
        tex_montoTotal.setReadOnly(true);
        tex_montoTotal.setCls("grande");

        for_panel4.add(tex_montoTotal);
        pan_sud.add(new PaddedPanel(for_panel4, 5, 150, 13, 0));
        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centro, new BorderLayoutData(RegionPosition.CENTER));
         pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        add(pan_borderLayout);
           initValues();
           // aniadirgrid();
           //    addListeners();
    }

    public GridPanel getGrid() {
        return grid;
    }

    public void setGrid(GridPanel grid) {
        this.grid = grid;
    }


    public void reload() {
        store.reload();
        grid.reconfigure(store, columnModel);
        grid.getView().refresh();
    }

    private void initValues() {
         tex_marca.setValue(marca);
    }

  
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.venta;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;

import org.balderrama.client.sistemadetalle.ProductoVenta;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.Record;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.form.FormPanel;

import com.gwtext.client.widgets.layout.ColumnLayout;
import com.gwtext.client.widgets.layout.ColumnLayoutData;
import com.gwtext.client.widgets.layout.FormLayout;
import com.gwtextux.client.data.PagingMemoryProxy;
/**
 *
 * @author example
 */
public class FormularioProductoKardex1 extends Window{
    private LayoutFormPanel layout;
    FormPanel for_formulario;
    String tipo;
    String titulo = "No definido";
    String idTraspaso;
    private ListaProductoSimple listaProducto;
    private VentaFeria padre;
      private FormPanel for_panel;
String modelo;
String vendedor;
 private PagingMemoryProxy proxy;
 //private Button aceptar;
  //  private Button cancelar;

    FormularioProductoKardex1(VentaFeria padred, String modelos, String vend) {
        this.tipo = "Nuevo";
        this.modelo =modelos;
        this.vendedor=vend;
        this.padre = padred;
        this.setId("win-usuario-venta-tra");
        this.setWidth(700);
        this.setMinWidth(700);
        this.setHeight(400);
        this.setButtonAlign(Position.CENTER);
        this.setCloseAction(Window.CLOSE);
        this.setPlain(true);
        this.setTitle("modelos ");
        this.setCloseAction(Window.CLOSE);
        this.setPlain(true);
        initComponents();
        addListeners();
    }

     private void initComponents() {

        for_panel = new FormPanel();
        for_panel.setLabelWidth(60);
        for_panel.setLabelAlign(Position.LEFT);
        for_panel.setBaseCls("x-plain");



        Panel topPanel = new Panel();
        topPanel.setLayout(new ColumnLayout());
        topPanel.setBaseCls("x-plain");

        Panel columnOnePanel = new Panel();
        columnOnePanel.setBaseCls("x-plain");
        columnOnePanel.setLayout(new FormLayout());

        Panel columnTwoPanel = new Panel();
        columnTwoPanel.setBaseCls("x-plain");
        columnTwoPanel.setLayout(new FormLayout());


        //initCombos();
        topPanel.add(columnOnePanel, new ColumnLayoutData(0.3));
       listaProducto = new ListaProductoSimple("./php/VentaFeria.php?funcion=listarproductosalmacen&modelo="+modelo+ "&vendedor="+ vendedor);
       listaProducto.onModuleLoad(padre);

        for_panel.add(topPanel);
        add(for_panel);
        add(listaProducto.getGrid());
       // cancelar = new Button("Cerrar Buscador");
       // addButton(cancelar);
    }

    private void addListeners() {

//         this.cancelar.addListener(new ButtonListenerAdapter() {
//
//            @Override
//            public void onClick(Button button, EventObject e) {
//                LimpiarGrid();
//               clear();
//                destroy();
//                 close();
//
//
//            }
//        });
    }



    public ListaProductoSimple getListaProducto() {
        return listaProducto;
    }
    public void LimpiarGrid() {
        listaProducto.getGrid().destroy();
         listaProducto.getGrid().clear();
//        listaProducto.e.removeAll();
//
//        lista1.grid.setStore(store);
//        grid.reconfigure(store, columnModel);
}
}


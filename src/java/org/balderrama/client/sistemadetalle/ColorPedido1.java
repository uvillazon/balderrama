/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

/**
 *
 * @author miguel
 */
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.layout.FitLayout;

public class ColorPedido1 extends Window {

    private Object[][] colorM;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private boolean nuevo;
    private FormPanel formPanel;
    private ComboBox com_color1;
    private ComboBox com_color2;
    private ComboBox com_color3;
    private ComboBox com_color4;
    private ComboBox com_color5;
    private ComboBox com_color6;
    ListaCalzadoPedido padre;
    private int col;
    private int row;

    public ColorPedido1(Object[][] colorM, ListaCalzadoPedido padre, int col, int row) {

        this.colorM = colorM;
        this.padre = padre;
        this.col = col;
        this.row = row;
        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";

        setTitle("Seleccionar Colores");
        setAutoHeight(true);
        setLayout(new FitLayout());
        setPaddings(8);
        setButtonAlign(Position.CENTER);

        setCloseAction(Window.CLOSE);
        setPlain(true);
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");

        //eventos a los botones
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                if (nuevo == false) {
                    GuardarEditarAlmacen();
                //JasperReportBasic jasper=new JasperReportBasic();

                } 
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                ColorPedido1.this.close();
                ColorPedido1.this.setModal(false);
                 ColorPedido1.this.destroy();
            //formulario = null;
            }
        });

        //combos
        com_color1 = new ComboBox("color1", "idcolor1");
        com_color2 = new ComboBox("Color2", "idcolor2");
        com_color3 = new ComboBox("Color3", "idcolor3");
        com_color4 = new ComboBox("Color4", "idcolor4");
        com_color5 = new ComboBox("Color5", "idcolor5");
        com_color6 = new ComboBox("Color6", "idcolor6");


        formPanel.add(com_color1);
        formPanel.add(com_color2);
        formPanel.add(com_color3);
        formPanel.add(com_color4);
        formPanel.add(com_color5);
        formPanel.add(com_color6);

        addButton(but_aceptarP);
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
    }

    private void initCombos() {

        //color1
        SimpleStore proveedorStore = new SimpleStore(new String[]{"idcolor", "codigo"}, colorM);
        proveedorStore.load();
        com_color1.setMinChars(1);
        com_color1.setFieldLabel("COLOR");
        com_color1.setStore(proveedorStore);
        com_color1.setValueField("codigo");
        com_color1.setDisplayField("codigo");
        com_color1.setForceSelection(true);
        com_color1.setMode(ComboBox.LOCAL);
        com_color1.setEmptyText("Buscar color");
        com_color1.setLoadingText("buscando...");
        com_color1.setTypeAhead(true);
        com_color1.setSelectOnFocus(true);
        com_color1.setWidth(150);

        com_color1.setHideTrigger(true);

        //color 2
        SimpleStore proveedorStore2 = new SimpleStore(new String[]{"idcolor", "codigo"}, colorM);
        proveedorStore2.load();
        com_color2.setMinChars(1);
        com_color2.setFieldLabel("COLOR");
        com_color2.setStore(proveedorStore);
        com_color2.setValueField("codigo");
        com_color2.setDisplayField("codigo");
        com_color2.setForceSelection(true);
        com_color2.setMode(ComboBox.LOCAL);
        com_color2.setEmptyText("Buscar color");
        com_color2.setLoadingText("buscando...");
        com_color2.setTypeAhead(true);
        com_color2.setSelectOnFocus(true);
        com_color2.setWidth(150);

        com_color2.setHideTrigger(true);

        //color3
        SimpleStore proveedorStore3 = new SimpleStore(new String[]{"idcolor", "codigo"}, colorM);
        proveedorStore3.load();
        com_color3.setMinChars(1);
        com_color3.setFieldLabel("COLOR");
        com_color3.setStore(proveedorStore);
        com_color3.setValueField("codigo");
        com_color3.setDisplayField("codigo");
        com_color3.setForceSelection(true);
        com_color3.setMode(ComboBox.LOCAL);
        com_color3.setEmptyText("Buscar color");
        com_color3.setLoadingText("buscando...");
        com_color3.setTypeAhead(true);
        com_color3.setSelectOnFocus(true);
        com_color3.setWidth(150);

        com_color3.setHideTrigger(true);

        //color4
        SimpleStore proveedorStore4 = new SimpleStore(new String[]{"idcolor", "codigo"}, colorM);
        proveedorStore4.load();
        com_color4.setMinChars(1);
        com_color4.setFieldLabel("COLOR");
        com_color4.setStore(proveedorStore);
        com_color4.setValueField("codigo");
        com_color4.setDisplayField("codigo");
        com_color4.setForceSelection(true);
        com_color4.setMode(ComboBox.LOCAL);
        com_color4.setEmptyText("Buscar color");
        com_color4.setLoadingText("buscando...");
        com_color4.setTypeAhead(true);
        com_color4.setSelectOnFocus(true);
        com_color4.setWidth(150);

        com_color4.setHideTrigger(true);

        //color5
        SimpleStore proveedorStore5 = new SimpleStore(new String[]{"idcolor", "codigo"}, colorM);
        proveedorStore5.load();
        com_color5.setMinChars(1);
        com_color5.setFieldLabel("COLOR");
        com_color5.setStore(proveedorStore);
        com_color5.setValueField("codigo");
        com_color5.setDisplayField("codigo");
        com_color5.setForceSelection(true);
        com_color5.setMode(ComboBox.LOCAL);
        com_color5.setEmptyText("Buscar color");
        com_color5.setLoadingText("buscando...");
        com_color5.setTypeAhead(true);
        com_color5.setSelectOnFocus(true);
        com_color5.setWidth(150);

        com_color5.setHideTrigger(true);

        //color6
        SimpleStore proveedorStore6 = new SimpleStore(new String[]{"idcolor", "codigo"}, colorM);
        proveedorStore6.load();
        com_color6.setMinChars(1);
        com_color6.setFieldLabel("COLOR");
        com_color6.setStore(proveedorStore);
        com_color6.setValueField("codigo");
        com_color6.setDisplayField("codigo");
        com_color6.setForceSelection(true);
        com_color6.setMode(ComboBox.LOCAL);
        com_color6.setEmptyText("Buscar color");
        com_color6.setLoadingText("buscando...");
        com_color6.setTypeAhead(true);
        com_color6.setSelectOnFocus(true);
        com_color6.setWidth(150);

        com_color6.setHideTrigger(true);

    }

  

    public void GuardarEditarAlmacen() {

        String color1 = com_color1.getValue();
        String color2 = com_color2.getValue();
        String color3 = com_color3.getValue();
        String color4 = com_color4.getValue();
        String color5 = com_color5.getValue();
        String color6 = com_color6.getValue();
        String[] colores = {color1, color2, color3, color4, color5, color6};
//        String color = color1 + "/" + color2 + "/" + color3 + "/" + color4 + "/" + color5 + "/" + color6;
        String color = null;
        int i;
        for (i = 0; i < 6; i++) {
            if (colores[i] != null) {
                if (color != null) {
                    color = color + "/" + colores[i] ;
                } else {
                    color = colores[i];
                }

            }

        }
//        String color1 = formPanel.getForm().getValues();
//        String cadena = formPanel.getForm().getValues();
        padre.InsertRowColor(row, col, color);
        ColorPedido1.this.destroy();
        close();

    }
}

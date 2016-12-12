/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package org.balderrama.client.emergentes;

/**
 *
 * @author miguel
 */
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

import org.balderrama.client.configuracion.ListaMaterialSimple;
//import org.balderrama.client.system.ListaCalzados;
import com.gwtext.client.data.Record;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.form.FormPanel;
import org.balderrama.client.beans.Material;
import org.balderrama.client.util.LayoutFormPanel;

/**
 *
 * @author example
 */
public class FormularioSeleccionarMaterial {

    private LayoutFormPanel layout;
    FormPanel for_formulario;
    String tipo;
    String titulo = "No definido";
    private ListaMaterialSimple listaProveedor;

    public FormularioSeleccionarMaterial() {
        this.tipo = "Nuevo";
        setTitulo();
        layout = new LayoutFormPanel(titulo, tipo, 670, 400);
        creatForm();
    }

    public LayoutFormPanel getLayout() {
        return layout;
    }

    public Material getProveedorSeleccionado() {
        Material proveedorSelected = null;

        Record[] records;

        records = this.listaProveedor.getCbSelectionModel().getSelections();

        if (records.length == 1) {
            proveedorSelected = new Material(records[0].getAsString("idmaterial"), records[0].getAsString("nombre"),
                    records[0].getAsString("descripcion"), records[0].getAsString("codigo"));

        }

        return proveedorSelected;
    }

    private void addComponets() {
        for_formulario.add(listaProveedor.getGrid());
    }

    private void creatForm() {
        for_formulario = layout.getForm_formualario();
        layout.setTitulo(titulo);
        createComponents();
        addComponets();
    }

    private void createComponents() {
        listaProveedor = new ListaMaterialSimple();
        listaProveedor.onModuleLoad();
    }

    public void setTitulo() {
        this.titulo = "Lista de material";
    }

    public void closeFormulario() {
        layout.getWin_ventana().close();
        layout.getWin_ventana().destroy();
    }

    public void showFormulario() {
        layout.getWin_ventana().show();
    }

    public void onFocus() {
        layout.getWin_ventana().setVisible(true);
    }

    public boolean isHidden() {
        return layout.isHidden();
    }
}



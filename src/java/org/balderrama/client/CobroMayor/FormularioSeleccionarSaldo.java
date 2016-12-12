/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.CobroMayor;

import com.gwtext.client.data.Record;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.form.FormPanel;
import org.balderrama.client.beans.ClienteSaldoRecibo;
import org.balderrama.client.util.LayoutFormPanel;

/** 
 *
 * @author example
 */
public class FormularioSeleccionarSaldo {

    private LayoutFormPanel layout;
    FormPanel for_formulario;
    String tipo;
    String idcliente;
    String idmarca;
    String titulo = "No definido";
    public ListaClienteSimple listaProveedor;

    public FormularioSeleccionarSaldo() {
        this.tipo = "Nuevo";
        setTitulo();
        layout = new LayoutFormPanel(titulo, tipo, 670, 400);
        creatForm();
    }
 public FormularioSeleccionarSaldo(String idclienteM,String idmarcaM) {
        this.tipo = "Nuevo";
        this.idcliente = idclienteM;
        this.idmarca = idmarcaM;
        setTitulo();
        layout = new LayoutFormPanel(titulo, tipo, 670, 400);
        creatForm();
    }

    public LayoutFormPanel getLayout() {
        return layout;
    }



 ClienteSaldoRecibo getClienteSeleccionado() {
        ClienteSaldoRecibo clienteSelected = null;

        Record[] records;

        records = this.listaProveedor.getCbSelectionModel().getSelections();

        if (records.length == 1) {
            clienteSelected = new ClienteSaldoRecibo(records[0].getAsString("idcliente"), records[0].getAsString("codigo"),
                    records[0].getAsString("nombre"),records[0].getAsString("saldo"),
                    records[0].getAsString("factura"));

        }

        return clienteSelected;
    }
    public ClienteSaldoRecibo getProveedorSeleccionado() {
        ClienteSaldoRecibo proveedorSelected = null;

        Record[] records;

        records = this.listaProveedor.getCbSelectionModel().getSelections();

        if (records.length == 1) {
            proveedorSelected = new ClienteSaldoRecibo(records[0].getAsString("idcliente"), records[0].getAsString("codigo"),
                    records[0].getAsString("nombre"),records[0].getAsString("saldo"),records[0].getAsString("factura")
                    );

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
        listaProveedor = new ListaClienteSimple(titulo);
        listaProveedor.onModuleLoad(idcliente,idmarca);
    }

    public void setTitulo() {
        this.titulo = "Lista de Boletas Adeudadas";
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


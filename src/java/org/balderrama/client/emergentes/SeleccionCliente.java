/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.emergentes;

import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.TabPanel;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import org.balderrama.client.MainEntryPoint;
import org.balderrama.client.util.KMenu;
//import org.balderrama.client.cliente.Cliente;

/**
 *
 * @author buggy
 */
public class SeleccionCliente extends Window {

    private final int ANCHO = 300;
    private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private ComboBox com_cliente;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String[] clienteM;
    CheckboxSelectionModel cbSelectionModel;
    public TabPanel tap_panel;
    public KMenu padre;
    public MainEntryPoint panel;
   // Pedido ped;

    public SeleccionCliente(KMenu kmenu) {
        //public IngresoAlmacenForm(KMenu kmenu,MainEntryPoint pan) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");

        // this.padre = padre
        padre = kmenu;
        //  panel=pan;

        this.clienteM = new String[]{"CLIENTE MAYOR", "CLIENTE DETALLE"};
        String tituloTabla = "Seleccionar tipo de Cliente";
        this.setClosable(true);
        this.setId("TPfun100211");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle(tituloTabla);
        setAutoWidth(true);
        setAutoHeight(true);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);

        setCloseAction(Window.CLOSE);
        //setPlain(true);
        onModuleLoad();

    }

    public void onModuleLoad() {

        //setId("win-Clientes");

        String nombreBoton1 = "Ingresar";
        String nombreBoton2 = "cerrar";

        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        //formPanel.setLabelWidth(ANCHO - 400);

        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                GuardarEditarCliente(e);
//                            IngresoAlmacen ing=new IngresoAlmacen(IngresoAlmacenForm.this);
//                            padre.seleccionarOpcion(null,"fun5099",e, ing);
//
//                            IngresoAlmacenForm.this.close();
//                            IngresoAlmacenForm.this.setModal(false);
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionCliente.this.destroy();
                SeleccionCliente.this.close();

            }
        });
//        formpanel1 = new Panel();
//        formpanel1.setWidth(50);
//        formpanel1.setHeight(50);
//        label.setHeight(50);
//        label.setWidth(50);
        //formpanel1.add(label);


        com_cliente = new ComboBox("Cliente", "cliente", 200);
        com_cliente.setValue("CLIENTE MAYOR");
        com_cliente.setReadOnly(true);
        //com_tipoC.setPosition(50, 50);

        // formPanel.setLabelWidth(ANCHO - 400 - 5);


        //formPanel.add(formpanel1);
        formPanel.add(com_cliente);
        addButton(but_aceptarP);
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();

    }

    private void initCombos() {


        SimpleStore tiposStore = new SimpleStore("tipos", clienteM);
        tiposStore.load();
        com_cliente.setDisplayField("tipos");
        com_cliente.setStore(tiposStore);




    }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

    public void GuardarEditarCliente(EventObject e) {


        String idmarca = com_cliente.getValue();


        if (idmarca == "CLIENTE MAYOR") {
//            Cliente cliente = new Cliente();
//            padre.seleccionarOpcion(null, "fun10021", e, cliente);
//            SeleccionCliente.this.clear();
//            SeleccionCliente.this.close();
        } else {
//            ClienteDetalle cliente = new ClienteDetalle();
//            padre.seleccionarOpcion(null, "fun10022", e, cliente);
//            SeleccionCliente.this.clear();
//            SeleccionCliente.this.close();
        }
    }

    public int redondedo(float f) {
        int aux = (int) f;
        if (aux < f) {
            aux = aux + 1;
        }
        return aux;
    }
}
package org.balderrama.client.system;

//import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.Window;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.TabPanel;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.BorderLayout;
import com.gwtext.client.widgets.layout.TableLayout;
import com.gwtext.client.widgets.layout.BorderLayoutData;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.RegionPosition;
//import java.io.File;
import java.io.File;
//import javax.swing.JFileChooser;
import org.balderrama.client.MainEntryPoint;
import org.balderrama.client.util.KMenu;

public class BuscarArchivo extends Panel {

    private final int WINDOW_PADDING = 5;
    //private FormPanel formPanel;
    //private TextField tex_marca;
    private TextField tex_buscaarchivo;
    private Button but_examinar;
    private Button but_procesar;
    private Button but_cancelar;
    public TabPanel tap_panel;
    public ComboBox com_marca;
    public KMenu padre;
    public MainEntryPoint panel;

    public BuscarArchivo(KMenu kmenu) {
        padre = kmenu;
        onModuleLoad();
    }

    public void onModuleLoad() {
        setTitle("Proceso de Archivos para Proformas");
        setLayout(new FitLayout());
        setBaseCls("x-plain");
        this.setClosable(true);
        this.setId("TPfun30045");
        setIconCls("tab-icon");

        Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");

        Panel for_panel = new Panel();
        for_panel.setLayout(new TableLayout(3));
        for_panel.setBaseCls("x-plain");
        for_panel.setHeight(120);
        for_panel.setPaddings(5);

        com_marca = new ComboBox("Marca", "idmarca");
        tex_buscaarchivo = new TextField("Archivo a Procesar", "buscaarchivo", 200);
        but_examinar = new Button("Examinar");
        but_procesar = new Button("Procesar");
        but_cancelar = new Button("Cancelar");

        com_marca = new ComboBox("Cliente", "idcliente", 200);

        //for_panel.add(tex_marca);
        for_panel.add(com_marca);
        for_panel.add(tex_buscaarchivo);
        for_panel.add(but_examinar);
        for_panel.add(but_procesar);
        for_panel.add(but_cancelar);
        pan_borderLayout.add(for_panel, new BorderLayoutData(RegionPosition.CENTER));
        //add(for_panel);
        add(pan_borderLayout);
        //initCombos();
        addListeners();
    }

    private void addListeners() {
        but_examinar.addListener(new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                //File fichero = new File("0048Vizzano.csv");
                //Window.alert("Archivo a Procesar! " + fichero.getAbsolutePath());
            }
        });

        but_procesar.addListener(new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                //createPedidoTemporal(idcliente);
            }
        });

        but_cancelar.addListener(new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                BuscarArchivo ordenproduccion = (BuscarArchivo) BuscarArchivo.this;
                panel.getTabPanel().remove(ordenproduccion);
            }
        });
    }
}
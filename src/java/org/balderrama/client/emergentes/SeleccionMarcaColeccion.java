/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.emergentes;

import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.Label;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.TabPanel;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;
import org.balderrama.client.MainEntryPoint;
import org.balderrama.client.util.KMenu;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.form.TextField;
//import org.balderrama.client.muestra.ListaRecibidos;
//import org.balderrama.client.muestra.PanelPedidoMuestra;
//import org.balderrama.client.pedido.Pedido;

/**
 *
 * @author buggy
 */
public class SeleccionMarcaColeccion extends Window {

   // private final int ANCHO = 300;
    //private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
   
    private ComboBox com_marca;

    private TextField tex_monto;

    private Label label = new Label("3");
    private Panel formpanel1;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String almacenC;
    private String tipoC;
    private Object[][] tiendaM;
    private Object[][] marcaM;
    private Object[][] oficinaM;
   private String coleccion;

    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;
    //para crear un nuevo tab
    public TabPanel tap_panel;
    public KMenu padre;
    public MainEntryPoint panel;
   // Pedido ped;


    public SeleccionMarcaColeccion(Object[][] marca,String coleccionM, KMenu kmenu) {
    //public IngresoAlmacenForm(KMenu kmenu,MainEntryPoint pan) {
        //com.google.gwt.user.client.Window.alert("Cuantas veces");

        // this.padre = padre
        padre=kmenu;
      //  panel=pan;
       
        marcaM = marca;
        //oficinaM = oficina;
        coleccion = coleccionM;

        //kmenu = menu;
        String tituloTabla = "Seleccion Marca";
        this.setClosable(true);
        this.setId("TPfun10401");
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

    public void onModuleLoad(){

        //setId("win-Clientes");

        String nombreBoton1 = "Entrar";
        String nombreBoton2 = "Cancelar";

        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        //formPanel.setLabelWidth(ANCHO - 400);
      
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                              GuardarEditarCliente(e);

            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionMarcaColeccion.this.destroy();
                SeleccionMarcaColeccion.this.close();

              }
        });
//        formpanel1 = new Panel();
//        formpanel1.setWidth(50);
//        formpanel1.setHeight(50);
//        label.setHeight(50);
//        label.setWidth(50);
        //formpanel1.add(label);
 
      tex_monto = new TextField("Coleccion", "coleccion",60);

        com_marca = new ComboBox("Marca", "marca",200);
        //com_tipoC.setPosition(50, 50);

        // formPanel.setLabelWidth(ANCHO - 400 - 5);

    

        //formPanel.add(formpanel1);
        formPanel.add(com_marca);
       formPanel.add(tex_monto);

        addButton(but_aceptarP);
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
     initValues();
    }

    private void initCombos() {

      
        com_marca.setValueField("idmarca");
        com_marca.setDisplayField("nombre");
        com_marca.setMinChars(1);
        com_marca.setForceSelection(true);
        com_marca.setMode(ComboBox.LOCAL);
        com_marca.setEmptyText("Seleccione una marca");
        com_marca.setLoadingText("Buscando");
        com_marca.setTypeAhead(true);
        com_marca.setSelectOnFocus(true);
        com_marca.setHideTrigger(true);  
        
        SimpleStore cotegoriaStore = new SimpleStore(new String[]{"idmarca", "nombre"}, marcaM);
        cotegoriaStore.load();
        com_marca.setStore(cotegoriaStore);


    }

 private void initValues() {
        tex_monto.setValue(coleccion);


    }
  

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }



   public void GuardarEditarCliente(EventObject e) {


        String idmarca = com_marca.getValue();
  String coleccion1 = tex_monto.getValueAsString();

         //   ListaRecibidos lista = new ListaRecibidos(idmarca,coleccion1);
           // padre.seleccionarOpcion(null, "fun10411", e, lista);
            SeleccionMarcaColeccion.this.clear();
            SeleccionMarcaColeccion.this.close();
        }
    

   
}
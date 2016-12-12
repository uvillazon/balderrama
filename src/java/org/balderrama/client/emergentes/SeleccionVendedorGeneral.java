/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.emergentes;

import org.balderrama.client.cliente.PanelCobro;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.Record;
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
import com.gwtext.client.widgets.form.Field;

import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import org.balderrama.client.cliente.PanelCreditoRegistro;
import org.balderrama.client.util.ReporteMediaCartaChorroWindowg;

//import org.balderrama.client.pedido.Pedido;
//import org.balderrama.client.Almacenes.KardexAlmacen;

/**
 *
 * @author buggy
 */
public class SeleccionVendedorGeneral extends Window {

    private final int ANCHO = 300;
    private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private ComboBox com_tienda;
    private ComboBox com_kardex;
    private ComboBox com_marca;
    private Label label = new Label("2");
    private Panel formpanel1;
    private Button but_aceptar;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String almacenC;
    private String tipoC;
    private Object[][] tiendaM;
    private Object[][] vendedorM;
    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;
    private ComboBox com_cliente;
    //para crear un nuevo tab
    private String[] clienteM;

    public TabPanel tap_panel;
    public KMenu padre;
    public MainEntryPoint panel;
   
  private Object[][] kardexM;
     private TextField tex_fechaini;
     private TextField tex_fechafin;
     String mesperiodo;
     String fechainicio;
     String fechafin;

   public SeleccionVendedorGeneral(String mesper,String fechaini,String fechaf,Object[][] kardex,Object[][] vendedor, KMenu kmenu) {
        padre=kmenu;
        kardexM = kardex;
        vendedorM =vendedor;
        fechainicio= fechaini;
        fechafin=fechaf;
        mesperiodo=mesper;
        //kmenu = menu;
        String tituloTabla = "Por Vendedor";
        this.setClosable(true);
        this.setId("TPfun1102");
        setIconCls("tab-icon");
        setAutoScroll(true);
        setTitle(tituloTabla);
        setAutoWidth(true);
        setAutoHeight(true);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        onModuleLoad();
    }

    public void onModuleLoad(){
        //setId("win-Clientes");
        String nombreBoton1 = "Resumen Marcas Vendedor";
        String nombreBoton12 = "Planificacion Vendedor";
        String nombreBoton2 = "Cancelar";

        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        //formPanel.setLabelWidth(ANCHO - 400);
        but_aceptar = new Button(nombreBoton12, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
             String idvendedor = com_marca.getValue();
                       String idkardex = com_kardex.getValue();
                    String fechainicio = tex_fechaini.getValueAsString();
                           String fechafin = tex_fechafin.getValueAsString();
      String enlace = "funcion=VerPlanificacion&idvendedor=" + idvendedor + "&idkardex="+idkardex+ "&fechainicio="+fechainicio+ "&fechafin="+fechafin;
        verReporteGrande(enlace);
            }
        });

        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
               String idvendedor = com_marca.getValue();
      
                 String idkardex = com_kardex.getValue();
                    String fechainicio = tex_fechaini.getValueAsString();
                           String fechafin = tex_fechafin.getValueAsString();
      String enlace = "funcion=VerRecapitulacionMarcaVendedor&idvendedor=" + idvendedor + "&idkardex="+idkardex+ "&fechainicio="+fechainicio+ "&fechafin="+fechafin;
        verReporteGrande(enlace);
            }
        });

        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionVendedorGeneral.this.destroy();
                SeleccionVendedorGeneral.this.close();
              }
        });
         com_kardex = new ComboBox("Inf Buscar", "kardex");


         tex_fechaini = new TextField("Fecha ini", "totalpares");
        tex_fechafin = new TextField("Fecha fin", "totalbs");
  //com_estilo.setDisabled(true);
  // formPanel.add(com_marca);
   //     formPanel.add(com_estilo);
 formPanel.add(com_kardex);
  formPanel.add(tex_fechaini);
  formPanel.add(tex_fechafin);
        com_marca = new ComboBox("Vendedor", "idcliente",200);
        //formPanel.add(formpanel1);
        formPanel.add(com_marca);
        addButton(but_aceptar);
        addButton(but_aceptarP);
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
         initvalues();
        addListeners();
    }

    private void onChangeempresa() {
        if (com_marca.getValue().equalsIgnoreCase("")) {
            MessageBox.alert("Seleccione un cliente");

        } else {
         // String codigoCliente = com_marca.getValueAsString().trim();
          
        }
    }

    private void addListeners() {
        com_marca.addListener(new ComboBoxListenerAdapter() {
            @Override
            public void onSelect(ComboBox comboBox, Record record, int index) {
               // onChangeempresa();
            }
        });

        com_marca.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                ////if (e.getKey() == EventObject.ENTER) {
                ////    GuardarEditarClientenuevo();
                ////}
            }
        });


    }
 private void initvalues() {

     com_kardex.setValue(mesperiodo);
     tex_fechaini.setValue(fechainicio);
     tex_fechafin.setValue(fechafin);
 }
    private void initCombos() {
        com_kardex.setValueField("idkardex");
        com_kardex.setDisplayField("mesrango");
        com_kardex.setMinChars(1);
        com_kardex.setFieldLabel("mesrango");
        com_kardex.setMode(ComboBox.LOCAL);
        com_kardex.setEmptyText("Seleccione Rango");
        com_kardex.setLoadingText("Buscando");
        com_kardex.setTypeAhead(true);
        com_kardex.setSelectOnFocus(true);
        com_kardex.setHideTrigger(true);

        SimpleStore cotegoriaStore1 = new SimpleStore(new String[]{"idkardex", "mesrango"}, kardexM);
        cotegoriaStore1.load();
        com_kardex.setStore(cotegoriaStore1);

        com_marca.setValueField("idempleado");
        com_marca.setDisplayField("nombre");
        com_marca.setMinChars(1);
        com_marca.setFieldLabel("nombre");
        com_marca.setMode(ComboBox.LOCAL);
        com_marca.setEmptyText("Seleccione un vendedor");
        com_marca.setLoadingText("Buscando");
        com_marca.setTypeAhead(true);
        com_marca.setSelectOnFocus(true);
        com_marca.setHideTrigger(true);  
        SimpleStore cotegoriaStore = new SimpleStore(new String[]{"idempleado", "nombre"}, vendedorM);
        cotegoriaStore.load();
        com_marca.setStore(cotegoriaStore);
    }

    public Button getBut_aceptara() {
        return but_aceptar;
    }


    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

  
 private void verReporteGrande(String enlace) {
        ReporteMediaCartaChorroWindowg print = new ReporteMediaCartaChorroWindowg(enlace);
        print.show();
    }
 

}
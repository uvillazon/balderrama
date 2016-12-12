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
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.Label;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.TabPanel;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import org.balderrama.client.MainEntryPoint;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.layout.VerticalLayout;
//import org.balderrama.client.pedido.Pedido;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.ReporteMediaCartaChorroWindowp;
import org.balderrama.client.util.KMenu;

/**
 *
 * @author 
 */
public class SeleccionBuscadorModelo extends Window {

  //  private final int ANCHO = 300;
    //private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private ComboBox com_tienda;
       // private ComboBox com_kardex;
         private ComboBox com_almacen;
    private Label label = new Label("2");
    private Panel formpanel1;
       private Button but_actualizar;
          private Button but_barra;
    private Button but_cancelarP;
    private String almacenC;
    private String tipoC;
    private Object[][] almacenM;
   // private Object[][] marcaM;
    private Object[][] kardexM;
    boolean respuesta = false;
   // Object[][] estiloM;
    public Object[][] estiloM1;
    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;
    //para crear un nuevo tab
    public TabPanel tap_panel;
    public KMenu padre;
    public MainEntryPoint panel;
     private TextField tex_fechaini;
     private TextField tex_fechafin;
       String opcion;

  public SeleccionBuscadorModelo(Object[][] kardex,Object[][] almace, KMenu kmenu) {
        padre=kmenu;
        kardexM = kardex;
        almacenM =almace;
        String tituloTabla = "Buscador Modelo";
        this.setClosable(true);
        this.setId("TPfun2309");
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

        String nombreBoton13 = "Buscar por Modelo";
          String nombreBoton14 = "Buscar por CodigoBarra";
        String nombreBoton2 = "Cancelar";
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        //formPanel.setLabelWidth(ANCHO - 400);
       Panel pan_botones = new Panel();
        pan_botones.setLayout(new VerticalLayout(10));
        pan_botones.setBaseCls("x-plain");


          but_actualizar = new Button(nombreBoton13, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
    
  String idalmacen = com_almacen.getValue();
         String fecha1 = tex_fechaini.getValueAsString().trim();
          if ((fecha1.equalsIgnoreCase("") || fecha1 == null))
        {  MessageBox.alert("Por favor escriba el nombre del modelo a buscar");

           //   Utils.setErrorPrincipal("Por favor escriba el nombre del modelo a buscar", "error");
        }
        else{
         String enlace = "funcion=verConsultamodelo&idalmacen="+ idalmacen +"&modelo=" +fecha1 ;
         verReporte(enlace);
          }
            }
        });
        but_barra = new Button(nombreBoton14, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
   String idalmacen = com_almacen.getValue();
       String fecha2 = tex_fechafin.getValueAsString().trim();

        if ((fecha2.equalsIgnoreCase("") || fecha2 == null))
        {//Utils.setErrorPrincipal("Por favor haga leer el codigo de barra del par a buscar", "error");
        MessageBox.alert("Por favor haga leer el codigo de barra del par a buscar");
        }
        else{
          String enlace = "funcion=verConsultamodeloBarra&codigobarra=" +fecha2 +"&idalmacen=" +idalmacen ;
        verReporte(enlace);
          }
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionBuscadorModelo.this.destroy();
                SeleccionBuscadorModelo.this.close();

              }
        });
   //     com_kardex = new ComboBox("Vendedor", "vendedor");
        com_almacen = new ComboBox("Almacen", "almacen");

         tex_fechaini = new TextField("Modelo", "modelo");
        tex_fechafin = new TextField("Codigo Barra", "codigo");
        formPanel.add(com_almacen);
     //   formPanel.add(com_kardex);

  formPanel.add(tex_fechaini);
  formPanel.add(tex_fechafin);
        addButton(but_barra);
        addButton(but_actualizar);
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
     addListeners();
    }

  
    
   private void addListeners() {

        tex_fechaini.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {

         String idalmacen = com_almacen.getValue();
         String fecha1 = tex_fechaini.getValueAsString().trim();
          if ((fecha1.equalsIgnoreCase("") || fecha1 == null))
        {  MessageBox.alert("Por favor escriba el nombre del modelo a buscar");

           //   Utils.setErrorPrincipal("Por favor escriba el nombre del modelo a buscar", "error");
        }
        else{
         String enlace = "funcion=verConsultamodelo&idalmacen="+ idalmacen +"&modelo=" +fecha1 ;
         verReporte(enlace);
          }

                }else{
                //  MessageBox.alert("Despues de seleccionar la marca haga enter, para cargar su lista de estilos correspondiente.");
                }
            }
        });

        tex_fechafin.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
         String idalmacen = com_almacen.getValue();
       String fecha2 = tex_fechafin.getValueAsString().trim();

        if ((fecha2.equalsIgnoreCase("") || fecha2 == null))
        {//Utils.setErrorPrincipal("Por favor haga leer el codigo de barra del par a buscar", "error");
        MessageBox.alert("Por favor haga leer el codigo de barra del par a buscar");
        }
        else{
          String enlace = "funcion=verConsultamodeloBarra&codigobarra=" +fecha2 +"&idalmacen=" +idalmacen ;
        verReporte(enlace);
          }


                }else{
                //  MessageBox.alert("Despues de seleccionar la marca haga enter, para cargar su lista de estilos correspondiente.");
                }
            }
        });

    }
 

    private void initCombos() {
// com_kardex.setValueField("idkardex");
//        com_kardex.setDisplayField("mesrango");
//        com_kardex.setMinChars(1);
//        com_kardex.setFieldLabel("Vendedor");
//        com_kardex.setMode(ComboBox.LOCAL);
//        com_kardex.setEmptyText("Seleccione Rango");
//        com_kardex.setLoadingText("Buscando");
//        com_kardex.setTypeAhead(true);
//        com_kardex.setSelectOnFocus(true);
//        com_kardex.setHideTrigger(true);
//
//        SimpleStore cotegoriaStore1 = new SimpleStore(new String[]{"idkardex", "mesrango"}, kardexM);
//        cotegoriaStore1.load();
//        com_kardex.setStore(cotegoriaStore1);

         com_almacen.setValueField("idalmacen");
        com_almacen.setDisplayField("nombre");
        com_almacen.setMinChars(1);
        com_almacen.setFieldLabel("Almacen");
        com_almacen.setMode(ComboBox.LOCAL);
        com_almacen.setEmptyText("Seleccione Almacen");
        com_almacen.setLoadingText("Buscando");
        com_almacen.setTypeAhead(true);
        com_almacen.setSelectOnFocus(true);
        com_almacen.setHideTrigger(true);

        SimpleStore cotegoriaStore12 = new SimpleStore(new String[]{"idalmacen", "nombre"}, almacenM);
        cotegoriaStore12.load();
        com_almacen.setStore(cotegoriaStore12);
    }
  

    public Button getBut_actualizar() {
        return but_actualizar;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

     private void verReportePeque(String enlace) {
        ReporteMediaCartaChorroWindowp print = new ReporteMediaCartaChorroWindowp(enlace);
        print.show();
    }

           private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }

}
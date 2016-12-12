/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.emergentes;


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
import org.balderrama.client.MainEntryPoint;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.layout.VerticalLayout;
//import org.balderrama.client.pedido.Pedido;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.ReporteMediaCartaChorroWindowg;
import org.balderrama.client.util.KMenu;

/**
 *
 * @author 
 */
public class SeleccionAlmacenGeneral extends Window {

    private final int ANCHO = 300;
    private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private ComboBox com_tienda;
   // private ComboBox com_marca;
  //  private ComboBox com_estilo;
        private ComboBox com_kardex;
    private Label label = new Label("2");
    private Panel formpanel1;
   private Button but_nacresumen;
  //  private Button but_inventarioventas;
    // private Button but_editar1;
        private Button but_nacalmacen;
           private Button but_nacmarca;
           
    private Button but_cancelarP;
    private String almacenC;
    private String tipoC;
    private Object[][] tiendaM;
  //  private Object[][] marcaM;
    private Object[][] kardexM;
    boolean respuesta = false;
    Object[][] almacenM;
    public Object[][] estiloM1;
    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;
    //para crear un nuevo tab
    public TabPanel tap_panel;
    public KMenu padre;
       public KMenu kmenu;
    public MainEntryPoint panel;
  //  Pedido ped;
   // private ComboBox com_estilo;
     private TextField tex_fechaini;
     private TextField tex_fechafin;
     String mesperiodo;
     String fechainicio;
     String fechafin;
       subseleccion subselec;
//desde ccabecera

  public SeleccionAlmacenGeneral(String mesper,String fechaini,String fechaf,Object[][] kardex,Object[][] almacen, KMenu kmenu) {
        padre=kmenu;
        kardexM = kardex;
        almacenM =almacen;
        fechainicio= fechaini;
        fechafin=fechaf;
        mesperiodo=mesper;
        //kmenu = menu;
        String tituloTabla = "Recapitulacion General";
        this.setClosable(true);
        this.setId("TPfun1103");
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
              formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        //formPanel.setLabelWidth(ANCHO - 400);
        Panel pan_botones = new Panel();
        pan_botones.setLayout(new VerticalLayout(10));
        pan_botones.setBaseCls("x-plain");
  but_nacresumen = new Button("General RECAPITULACION * Marca", new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
    //             String idmarca = com_estilo.getValue();
       String idestilo = "alm-1";
                 String idkardex = com_kardex.getValue();
                    String fechainicio = tex_fechaini.getValueAsString();
                           String fechafin = tex_fechafin.getValueAsString();
      String enlace = "funcion=VerRecapitulacion&idkardex="+idkardex+ "&fechainicio="+fechainicio+ "&fechafin="+fechafin;
        verReporteGrande(enlace);
            }
        });
    but_nacmarca = new Button("General X Marca", new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
           //      String idmarca = com_estilo.getValue();
      // String idestilo = "alm-1";
                 String idkardex = com_kardex.getValue();
                    String fechainicio = tex_fechaini.getValueAsString();
                           String fechafin = tex_fechafin.getValueAsString();
            String enlace = "funcion=VerRecapitulacion&idkardex="+idkardex+ "&fechainicio="+fechainicio+ "&fechafin="+fechafin;
            verReporteGrande(enlace);
            }
        });
         but_nacalmacen = new Button("General X Almacen", new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
       //          String idmarca = com_estilo.getValue();
       //String idestilo = "alm-1";
                 String idkardex = com_kardex.getValue();
                    String fechainicio = tex_fechaini.getValueAsString();
                           String fechafin = tex_fechafin.getValueAsString();
      String enlace = "funcion=VerResumenAlmacen&idkardex="+idkardex+ "&fechainicio="+fechainicio+ "&fechafin="+fechafin;
        verReporteGrande(enlace);
            }
        });
//recapitulacion general
      
      but_cancelarP = new Button("Cancelar", new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionAlmacenGeneral.this.destroy();
                SeleccionAlmacenGeneral.this.close();
              }
        });
        com_kardex = new ComboBox("Inf Buscar", "kardex");

      // com_estilo = new ComboBox("Almacen", "estilos");
         tex_fechaini = new TextField("Fecha ini", "totalpares");
        tex_fechafin = new TextField("Fecha fin", "totalbs");

  formPanel.add(com_kardex);
  formPanel.add(tex_fechaini);
  formPanel.add(tex_fechafin);
//  formPanel.add(com_estilo);
   
   addButton(but_nacalmacen);
  // addButton(but_nacmarca);
   addButton(but_nacresumen);
   //addButton(but_editar1);
   addButton(but_cancelarP);
   add(formPanel);
        initCombos();
        initvalues();
     addListeners();
    }


 private void initvalues() {
     
     com_kardex.setValue(mesperiodo);
     tex_fechaini.setValue(fechainicio);
     tex_fechafin.setValue(fechafin);
 }
   

   
   
   private void addListeners() {


            com_kardex.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                   String codigoCliente = field.getValueAsString().trim();
                   String idproductosproc = com_kardex.getValueAsString().trim();
                    if (!idproductosproc.isEmpty()) {
                        cargarProducto(idproductosproc);
                    //    com_estilo.focus();
                        //com_kardex.setValue("");
                        //com_productoProc.setEmptyText("");

                    }
                }else{
                  MessageBox.alert("Despues de seleccionar la marca haga enter, para cargar su lista de estilos correspondiente.");
                }
            }
        });


    }
     
  private void cargarProducto(String id) {

        String idProducto = "";
        String detalle = "";
        String unidad = "";
        String fecha = "";
        if (id != null) {
                 SimpleStore producto = new SimpleStore(new String[]{"idkardex", "mesrango","fechainicio","fechafin"}, kardexM);
                    producto.load();
                    producto.filter("idkardex", id);
                    Record r = producto.getRecords()[0];
                    idProducto = r.getAsString("idkardex");
                    detalle = r.getAsString("fechainicio");
                    unidad = r.getAsString("fechafin");
//                    fecha = r.getAsString("fecha");
                    tex_fechaini.setValue(detalle);
                    tex_fechafin.setValue(unidad);


            //                        respuesta = true;

        }
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


//         com_estilo.setMinChars(1);
//           com_estilo.setFieldLabel("Almacen");
//            com_estilo.setEmptyText("Seleccione un almacen");
//           com_estilo.setDisplayField("nombre");
//           com_estilo.setValueField("idalmacen");
//           com_estilo.setMode(ComboBox.LOCAL);
//           com_estilo.setTriggerAction(ComboBox.ALL);
//          com_estilo.setLinked(true);
//           com_estilo.setForceSelection(true);
////           com_cliente.setReadOnly();
//           com_estilo.setHideTrigger(true);
//           com_estilo.setSelectOnFocus(true);
//           com_estilo.setTypeAhead(true);
//     SimpleStore proveedorStore1 = new SimpleStore(new String[]{"idalmacen", "nombre"}, almacenM);
//        proveedorStore1.load();
//com_estilo.setStore(proveedorStore1);
//com_estilo.focus();

    }
  


    public Button getBut_cancelar() {
        return but_cancelarP;
    }
 public Button getBut_nacalmacenp() {
        return but_nacalmacen;
    }
  public Button getBut_nacmarcap() {
        return but_nacmarca;
    }
   public Button getBut_nacresuemn() {
        return but_nacresumen;
    }
  
 private void verReporteGrande(String enlace) {
        ReporteMediaCartaChorroWindowg print = new ReporteMediaCartaChorroWindowg(enlace);
        print.show();
    }
           private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }

}
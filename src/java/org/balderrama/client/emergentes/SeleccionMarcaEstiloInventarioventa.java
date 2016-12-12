/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.emergentes;


import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.util.DateUtil;
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
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.Field;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.KMenu;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import java.util.Date;

/**
 *
 * @author 
 */
public class SeleccionMarcaEstiloInventarioventa extends Window {

    private final int ANCHO = 300;
    private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private ComboBox com_tienda;
    private ComboBox com_marca;
    private Label label = new Label("2");
    private Panel formpanel1;
    private Button but_aceptarPp;
    //    private Button but_ingresos;
     //    private Button but_ingresosinventario;
     private Button but_reporte;
      private Button but_reportemodelo;
//      private Button but_rebaja;
//    private Button but_traint;
  //      private Button but_habilita;
   //  private Button but_general;
     //    private Button but_generalmarca;
        private Button but_cambio;
        private Button but_vendedorferia;
         private Button but_marcaferia;
         private Button but_modeloferia;
     private Button but_devolucion;
//  private Button but_traspaso;
     private Button but_cancelarP;
    private String almacenC;
    private String tipoC;
    private Object[][] tiendaM;
    private Object[][] marcaM;
    boolean respuesta = false;
    Object[][] vendedorM;
    public Object[][] estiloM1;
    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;
    //para crear un nuevo tab
    public TabPanel tap_panel;
    public KMenu padre;
    public MainEntryPoint panel;
  //  Pedido ped;
    private ComboBox com_estilo;
   private DateField dat_fechaini1109;
    private DateField dat_fechafin1109;
     private Date fechahoy;

    public SeleccionMarcaEstiloInventarioventa(Object[][] marca,Object[][] estilo, KMenu kmenu) {
        padre=kmenu;
      //  panel=pan;
       
        marcaM = marca;
        vendedorM =estilo;
        //kmenu = menu;
        String tituloTabla = "Reportes de Ventas";
        this.setClosable(true);
        this.setId("TPfun23041");
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
  dat_fechaini1109 = new DateField("Fecha Inicio", "Y-m-d",200);
        fechahoy = new Date();
                 dat_fechaini1109.setValue(fechahoy);
        dat_fechafin1109 = new DateField("Fecha Fin ", "Y-m-d",200);
        dat_fechafin1109.setValue(fechahoy);

          String nombreBoton3 = "Ventas Gral";
        String nombreBoton2 = "Cancelar";
    String nombreBoton4 = "VentaXMarca";
     String nombreBoton44 = "VentasXMod";
      //  String nombreBoton31 = "Recibido";
      //    String nombreBoton313 = "Rec-X-Modelo";
        String nombreBoton32 = "Ventas/Vendedor";
     //    String nombreBoton34 = "Trasp Enviados";
      String nombreBoton33 = "Devolucion";
 String nombreBoton321 = "Feria/Vendedor";
 String nombreBoton322 = "Feria/Modelo";
 String nombreBoton323 = "Feria/Marca";
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");

//por vendedor
        but_cambio = new Button(nombreBoton32, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                          String idmarca = com_marca.getValue();
        String idestilo = com_estilo.getValue();
         String fecha1 = DateUtil.format(dat_fechaini1109.getValue(), "Y-m-d");
           String fecha2 = DateUtil.format(dat_fechafin1109.getValue(), "Y-m-d");
       String enlace = "funcion=verventalistavendedor&idmarca=" + idmarca + "&idvendedor="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;
               verReporte(enlace);
              }
        });
         but_marcaferia = new Button(nombreBoton323, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                          String idmarca = com_marca.getValue();
        String idestilo = com_estilo.getValue();
         String fecha1 = DateUtil.format(dat_fechaini1109.getValue(), "Y-m-d");
           String fecha2 = DateUtil.format(dat_fechafin1109.getValue(), "Y-m-d");
       String enlace = "funcion=verventaferiamarca&idmarca=" + idmarca + "&idvendedor="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;
               verReporte(enlace);
              }
        });
 but_vendedorferia = new Button(nombreBoton321, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                          String idmarca = com_marca.getValue();
        String idestilo = com_estilo.getValue();
         String fecha1 = DateUtil.format(dat_fechaini1109.getValue(), "Y-m-d");
           String fecha2 = DateUtil.format(dat_fechafin1109.getValue(), "Y-m-d");
       String enlace = "funcion=verventaferiavendedor&idmarca=" + idmarca + "&idvendedor="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;
               verReporte(enlace);
              }
        });
         but_modeloferia = new Button(nombreBoton322, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                          String idmarca = com_marca.getValue();
        String idestilo = com_estilo.getValue();
         String fecha1 = DateUtil.format(dat_fechaini1109.getValue(), "Y-m-d");
           String fecha2 = DateUtil.format(dat_fechafin1109.getValue(), "Y-m-d");
       String enlace = "funcion=verventaferiamodelo&idmarca=" + idmarca + "&idvendedor="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;
               verReporte(enlace);
              }
        });
         but_devolucion = new Button(nombreBoton33, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                 String idmarca = com_marca.getValue();
        String idestilo = com_estilo.getValue();
         String fecha1 = DateUtil.format(dat_fechaini1109.getValue(), "Y-m-d");
           String fecha2 = DateUtil.format(dat_fechafin1109.getValue(), "Y-m-d");
        String enlace = "funcion=verDevoluciones&idmarca=" + idmarca + "&idestilo="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;
               verReporte(enlace);
            }
        });



         but_aceptarPp = new Button(nombreBoton3, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {

                     String idmarca = com_marca.getValue();
        String idestilo = com_estilo.getValue();
         String fecha1 = DateUtil.format(dat_fechaini1109.getValue(), "Y-m-d");
           String fecha2 = DateUtil.format(dat_fechafin1109.getValue(), "Y-m-d");
       String enlace = "funcion=verventalista&idmarca=" + idmarca + "&idvendedor="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;
               verReporte(enlace);
            }
        });

 but_reportemodelo = new Button(nombreBoton44, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                 String idmarca = com_marca.getValue();
        String idestilo = com_estilo.getValue();
         String fecha1 = DateUtil.format(dat_fechaini1109.getValue(), "Y-m-d");
           String fecha2 = DateUtil.format(dat_fechafin1109.getValue(), "Y-m-d");
       String enlace = "funcion=verventalistamarcamodelo&idmarca=" + idmarca + "&idvendedor="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;
               verReporte(enlace);
           }
        });
     but_reporte = new Button(nombreBoton4, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                 String idmarca = com_marca.getValue();
        String idestilo = com_estilo.getValue();
         String fecha1 = DateUtil.format(dat_fechaini1109.getValue(), "Y-m-d");
           String fecha2 = DateUtil.format(dat_fechafin1109.getValue(), "Y-m-d");
       String enlace = "funcion=verventalistamarca&idmarca=" + idmarca + "&idvendedor="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;
               verReporte(enlace);
           }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionMarcaEstiloInventarioventa.this.destroy();
                SeleccionMarcaEstiloInventarioventa.this.close();

              }
        });
        formPanel.add(dat_fechaini1109);
  formPanel.add(dat_fechafin1109);
        com_marca = new ComboBox("Marca", "marcas",200);
        com_estilo = new ComboBox("Vendedor", "vendedores");
//  com_estilo.setDisabled(true);
        formPanel.add(com_marca);
        formPanel.add(com_estilo);

        addButton(but_reporte);
         addButton(but_cambio);
          addButton(but_aceptarPp);
        addButton(but_reportemodelo);
        addButton(but_devolucion);
        addButton(but_vendedorferia);
         addButton(but_marcaferia);
       addButton(but_modeloferia);
//        addButton(but_ingresos);
//       addButton(but_ingresosinventario);
//        addButton(but_rebaja);
//        addButton(but_traspaso);
//       addButton(but_traint);
//   addButton(but_habilita);
        addButton(but_cancelarP);
        // addButton(but_general);
          // addButton(but_generalmarca);
        add(formPanel);
        initCombos();
     addListeners();
    }
   
   private void addListeners() {
        dat_fechaini1109.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                dat_fechafin1109.focus();
                }
            }
        });
         dat_fechafin1109.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                com_marca.focus();
                }
            }
        });

        com_marca.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                   String codigoCliente = field.getValueAsString().trim();
//                    if (findByCodigoCliente(codigoCliente)) {
//                               }
                   com_estilo.focus();
                }else{
                  MessageBox.alert("Despues de seleccionar la marca haga enter, para cargar su lista de estilos correspondiente.");
                }
            }


        });
    

    }

    private void initCombos() {

         com_marca.setValueField("idmarca");
        com_marca.setDisplayField("nombre");
        com_marca.setMinChars(1);
        com_marca.setFieldLabel("Marca");
        com_marca.setMode(ComboBox.LOCAL);
        com_marca.setEmptyText("Seleccione Marca");
        com_marca.setLoadingText("Buscando");
        com_marca.setTypeAhead(true);
        com_marca.setSelectOnFocus(true);
        com_marca.setHideTrigger(true);

        SimpleStore cotegoriaStore = new SimpleStore(new String[]{"idmarca", "nombre"}, marcaM);
        cotegoriaStore.load();
        com_marca.setStore(cotegoriaStore);



         com_estilo.setMinChars(1);
           com_estilo.setFieldLabel("Vendedor");
            com_estilo.setEmptyText("Seleccione un vendedor");
           com_estilo.setDisplayField("nombre");
           com_estilo.setValueField("idempleado");
           com_estilo.setMode(ComboBox.LOCAL);
           com_estilo.setTriggerAction(ComboBox.ALL);
          com_estilo.setLinked(true);
           com_estilo.setForceSelection(true);
//           com_cliente.setReadOnly();
           com_estilo.setHideTrigger(true);
           com_estilo.setSelectOnFocus(true);
           com_estilo.setTypeAhead(true);


        SimpleStore cotegoriaStoreq = new SimpleStore(new String[]{"idempleado", "nombre"}, vendedorM);
        cotegoriaStoreq.load();
        com_estilo.setStore(cotegoriaStoreq);


    }
  
    public Button getBut_cancelar() {
        return but_cancelarP;
    }



           private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }

}
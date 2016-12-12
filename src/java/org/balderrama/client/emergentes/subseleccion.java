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
import org.balderrama.client.util.ReporteMediaCartaChorroWindowg;
import org.balderrama.client.util.KMenu;

/**
 *
 * @author 
 */
public class subseleccion extends Window {

    private final int ANCHO = 300;
    private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
     private ComboBox com_cliente;
    private ComboBox com_vendedor;
    //private ComboBox com_tienda;
   // private ComboBox com_marca;
    //    private ComboBox com_kardex;
    private Label label = new Label("2");
    private Panel formpanel1;
//    private Button but_aceptarP;
   // private Button but_inventarioventas;
    private Button but_inventarioventas1;
     subseleccion subselec;
  //   private Button but_inventarioventas2;
 //   private Button but_aceptarPp;
   // private Button but_editar;
    private Button but_cancelarP;
    private String almacenC;
    private String tipoC;
   // private Object[][] tiendaM;
    //private Object[][] marcaM;
    private Object[][] clienteM;
        private Object[][] vendedorM;
    boolean respuesta = false;
    Object[][] estiloM;
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
     private TextField tex_rango;
     private TextField tex_modelo;
     String mesperiodo;
     String fechainicio;
     String fechafin;
     String idmarca;
     String idkardex;
     String marca;
 //subseleccion(String idmarca, String idkardex, String fechai, String fechaf, Object[][] clientes, Object[][] vendedorM) {

  public subseleccion(String idmarc,String mar,String idkard,String fechaini,String fechaf,Object[][] cliente,Object[][] vendedor) {
        padre=kmenu;
      //  panel=pan;
        idmarca=idmarc;
        marca=mar;
        idkardex=idkard;
       clienteM = cliente;
       vendedorM=vendedor;
       // marcaM = marca;
        //stiloM =estilo;
        fechainicio= fechaini;
        fechafin=fechaf;
        //mesperiodo=mesper;
        //kmenu = menu;
        String tituloTabla = "Marca:"+marca;
        this.setClosable(true);
       // this.setId("TPfun2303");
        setIconCls("tab-icon");
        setAutoScroll(true);
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
       String nombreBoton3 = "Ver/Editar Inventario";
        String nombreBoton2 = "Cancelar";
   String nombreBoton4 = "Capital de operacion General";
String nombreBoton5 = "Resumen Capital Marca";
String nombreBoton51 = "Formato Impresion Marca";
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        //formPanel.setLabelWidth(ANCHO - 400);
 Panel pan_botones = new Panel();
        pan_botones.setLayout(new VerticalLayout(10));
        pan_botones.setBaseCls("x-plain");


//ver editar inventario



         but_inventarioventas1 = new Button(nombreBoton51, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
           //      String idmarca = com_marca.getValue();
       String idcliente = "cli";
         String rango = "rango";
            String idvendedor = "idvendedor";
String idclientes = com_cliente.getValueAsString();
String idvendedors = com_vendedor.getValueAsString();
String rangos = tex_rango.getValueAsString();
String modelo = tex_modelo.getValueAsString();

  String enlace = "funcion=ListaInventarioMarca&idmarca=" + idmarca + "&idcliente="+idclientes + "&rango="+rangos + "&idvendedor="+idvendedors+ "&modelo="+modelo+ "&idkardex="+idkardex;
  // String enlace = "funcion=ListaInventarioMarca&idmarca=" + idmarca + "&idcliente="+idclientes + "&rango="+rangos + "&idvendedor="+idvendedors+ "&modelo="+modelo;

                    verReporte(enlace);
               
                 //   SeleccionMarcaEstiloInventario.this.destroy();
                  //     SeleccionMarcaEstiloInventario.this.close();
        }
        });

      but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                subseleccion.this.destroy();
                subseleccion.this.close();

              }
        });
        com_cliente = new ComboBox("Cliente", "cliente",400);

        com_vendedor = new ComboBox("Vendedor", "vendedor",200);
      //  com_estilo = new ComboBox("Almacen", "estilos");
         tex_rango = new TextField("Fecha Ingreso mm-yyyy", "rango");
        tex_modelo = new TextField("Modelo", "modelo");
  //com_estilo.setDisabled(true);
  // formPanel.add(com_marca);
   //     formPanel.add(com_estilo);
  formPanel.add(com_cliente);
  formPanel.add(com_vendedor);
  formPanel.add(tex_rango);
   formPanel.add(tex_modelo);

       //  addButton(but_aceptarPp);
         //impresion
         addButton(but_inventarioventas1);
         //resumen
        //addButton(but_inventarioventas);
         // addButton(but_editar);
        //      addButton(but_inventarioventas2);
       
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
 //       initvalues();
     addListeners();
    }


 

   
    
   private void addListeners() {
                com_cliente.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                   //String codigoCliente = field.getValueAsString().trim();
      //             com_estilo.focus();
com_vendedor.focus();
                }else{
                  MessageBox.alert("Despues de seleccionar la marca haga enter, para cargar su lista de estilos correspondiente.");
                }
            }


        });

            com_vendedor.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                   String codigoCliente = field.getValueAsString().trim();
                  // String idproductosproc = com_kardex.getValueAsString().trim();
                   tex_rango.focus();
                                   }else{
                  MessageBox.alert("Despues de seleccionar la marca haga enter, para cargar su lista de estilos correspondiente.");
                }
            }
        });
     


    }
    
//     com_estilo.addListener(new TextFieldListenerAdapter() {
//            @Override
//            public void onSpecialKey(Field field, EventObject e) {
//                if (e.getKey() == EventObject.ENTER) {
//
//                 String idmarca = com_marca.getValue();
//        String idestilo = com_estilo.getValue();
//        String idkardex = com_kardex.getValue();
//             cargarDatosPanelPedido2(idmarca,idestilo,idkardex);
//                SeleccionMarcaEstiloInventario.this.destroy();
//                       SeleccionMarcaEstiloInventario.this.close();
//
//                }
//            }
//
//        });

   

    private void initCombos() {
        SimpleStore proveedorStore1 = new SimpleStore(new String[]{"idcliente", "codigo"}, clienteM);
        proveedorStore1.load();
        com_cliente.setMinChars(1);
        com_cliente.setStore(proveedorStore1);
        com_cliente.setValueField("idcliente");
        com_cliente.setDisplayField("codigo");
        com_cliente.setForceSelection(true);
        com_cliente.setMode(ComboBox.LOCAL);
        com_cliente.setEmptyText("Buscar Cliente u Oficina");
        com_cliente.setLoadingText("buscando...");
        com_cliente.setTypeAhead(true);
        com_cliente.setSelectOnFocus(true);
        com_cliente.setWidth(130);
        com_cliente.setHideTrigger(true);

  SimpleStore proveedorStore11 = new SimpleStore(new String[]{"idempleado", "codigo"}, vendedorM);
        proveedorStore11.load();
        com_vendedor.setMinChars(1);
        com_vendedor.setStore(proveedorStore11);
        com_vendedor.setValueField("idempleado");
        com_vendedor.setDisplayField("codigo");
        com_vendedor.setForceSelection(true);
        com_vendedor.setMode(ComboBox.LOCAL);
       // com_cliente.setEmptyText("Buscar almacen");
        com_vendedor.setLoadingText("buscando...");
        com_vendedor.setTypeAhead(true);
        com_vendedor.setSelectOnFocus(true);
        com_vendedor.setWidth(130);
        com_vendedor.setHideTrigger(true);

    }

public Button getBut_inventarioventas1() {
        return but_inventarioventas1;
    }
//public Button getBut_inventarioventas2() {
//        return but_inventarioventas2;
//    }
    public Button getBut_cancelar() {
        return but_cancelarP;
    }

     private void verReportePeque(String enlace) {
        ReporteMediaCartaChorroWindowp print = new ReporteMediaCartaChorroWindowp(enlace);
        print.show();
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
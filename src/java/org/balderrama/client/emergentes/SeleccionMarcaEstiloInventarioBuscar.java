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
import com.google.gwt.json.client.JSONString;
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
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import org.balderrama.client.util.Utils;
import org.balderrama.client.MainEntryPoint;
import org.balderrama.client.util.KMenu;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.layout.VerticalLayout;
import org.balderrama.client.sistemadetalle.PanelPedidoE;
//import org.balderrama.client.pedido.Pedido;
import org.balderrama.client.sistemadetalle.PanelInventario;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.ReporteMediaCartaChorroWindowp;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.Utils;

/**
 *
 * @author 
 */
public class SeleccionMarcaEstiloInventarioBuscar extends Window {

    private final int ANCHO = 300;
    private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private ComboBox com_tienda;
    private ComboBox com_marca;
  //      private ComboBox com_kardex;
    private Label label = new Label("2");
    private Panel formpanel1;
    private Button but_aceptarP;
    private Button but_inventarioventas;
    private Button but_aceptarPp;
    private Button but_editar;
        private Button but_nuevo;
        private Button but_actualizar;
          private Button but_entradas;
          private Button but_trasrecibidos;
          private Button but_regularizacion;
          private Button but_traspdespachados;
          private Button but_devueltos;

    private Button but_cancelarP;
    private String almacenC;
    private String tipoC;
    private Object[][] tiendaM;
    private Object[][] marcaM;
    private Object[][] kardexM;
    boolean respuesta = false;
    Object[][] estiloM;
    public Object[][] estiloM1;
    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;
    //para crear un nuevo tab
    public TabPanel tap_panel;
    public KMenu padre;
    public MainEntryPoint panel;
  //  Pedido ped;
    private ComboBox com_estilo;
       private TextField tex_modelo;
 
  public SeleccionMarcaEstiloInventarioBuscar(Object[][] kardex,Object[][] marca,Object[][] estilo, KMenu kmenu) {
        padre=kmenu;
      //  panel=pan;
kardexM = kardex;
        marcaM = marca;
        estiloM =estilo;
        //kmenu = menu;
        String tituloTabla = "Control Inventario";
        this.setClosable(true);
        this.setId("TPfun2308");
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

 
        String nombreBoton2 = "Cancelar";
  
String nombreBoton5 = "Consultar modelo";
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        //formPanel.setLabelWidth(ANCHO - 400);
 Panel pan_botones = new Panel();
        pan_botones.setLayout(new VerticalLayout(10));
        pan_botones.setBaseCls("x-plain");


         but_inventarioventas = new Button(nombreBoton5, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
           String idmarca = com_marca.getValue();
        String idestilo = com_estilo.getValue();
        String modelo = tex_modelo.getValueAsString().trim();
       String enlace = "funcion=verIngresosMarcaEstiloModeloHTML&idmarca=" + idmarca + "&idestilo="+idestilo + "&modelo="+modelo;

 //String enlace = "funcion=verIngresosMarcaEstiloHTMLInventarioVentas&idmarca=" + idmarca + "&idestilo="+idestilo;
               verReporte(enlace);

                 //   SeleccionMarcaEstiloInventario.this.destroy();
                  //     SeleccionMarcaEstiloInventario.this.close();
        }
        });
        
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionMarcaEstiloInventarioBuscar.this.destroy();
                SeleccionMarcaEstiloInventarioBuscar.this.close();

              }
        });
       
        com_marca = new ComboBox("Marca", "marcas",200);
        com_estilo = new ComboBox("Estilos", "estilos");
        
  com_estilo.setDisabled(true);
   tex_modelo = new TextField("Modelo", "modelo");

        formPanel.add(com_marca);
        formPanel.add(com_estilo);
       formPanel.add(tex_modelo);
        addButton(but_inventarioventas);
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
     addListeners();
    }

  
    
   private void addListeners() {
      
           com_marca.addListener(new ComboBoxListenerAdapter() {

            @Override
      public void onSelect(ComboBox comboBox, Record record, int index) {
//               String codigoCliente = field.getValueAsString().trim();
//                    if (findByCodigoCliente(codigoCliente)) {
//                        // com_estilo.focus();
//                                }
            }

        
        });
             com_marca.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                   String codigoCliente = field.getValueAsString().trim();
                    if (findByCodigoCliente(codigoCliente)) {
                        // com_estilo.focus();
                                }
                }else{
                  MessageBox.alert("Despues de seleccionar la marca haga enter, para cargar su lista de estilos correspondiente.");
                }
            }
         private boolean findByCodigoCliente(final String codigoBuscado) {
                respuesta = false;
                String enlace = "php/Marca.php?funcion=BuscarEstiloPorMarca&idmarca=" + codigoBuscado;
          //      String enlace = "php/Planilla.php?funcion=buscarplanillaempresa&empresa=" + codigoBuscado;

                // Utils.setErrorPrincipal("Cargando parametros ", "cargar");
                final Conector conec = new Conector(enlace, false);

                try {
                    conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        private Object[][] estiloM1;
                     //   private String planilla;

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {
                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    Utils.setErrorPrincipal(mensajeR, "mensaje");
                                     JSONValue marcaV = jsonObject.get("resultado");
                                                JSONObject marcaO;
                                                if ((marcaO = marcaV.isObject()) != null) {
                                                   // String idp = Utils.getStringOfJSONObject(marcaO, "idpedido");
                      Object[][] estiloM2 = Utils.getArrayOfJSONObject(marcaO, "estiloM", new String[]{"idestilo", "nombre"});
this.estiloM1 = estiloM2;
                       SimpleStore proveedorStore1 = new SimpleStore(new String[]{"idestilo", "nombre"}, estiloM1);
        proveedorStore1.load();
com_estilo.setStore(proveedorStore1);
com_estilo.focus();

respuesta = true;
                                    } else {
                                    //    resetCamposCliente();

                                        Utils.setErrorPrincipal("No se recuperaron correctamente lo valores", "error");
                                    }

                                } else {
                                  //  resetCamposCliente();

                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            }
                        }

                        public void onError(Request request, Throwable exception) {
                          //  resetCamposCliente();

                            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");

                        }
                    });

                } catch (RequestException ex) {
                    ex.getMessage();
             //       resetCamposCliente();
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }

                return respuesta;
            }


        });
           com_marca.addListener(new ComboBoxListenerAdapter() {

            @Override
      public void onSelect(ComboBox comboBox, Record record, int index) {
                onChangeCategoria();
            }

              private void onChangeCategoria() {
                   com_estilo.setDisabled(false);
                   com_estilo.focus();

    }
        });
     com_estilo.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
               
                tex_modelo.focus();
                }
            }

        });

         tex_modelo.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {

                 String idmarca = com_marca.getValue();
        String idestilo = com_estilo.getValue();
        String modelo = tex_modelo.getValueAsString().trim();
       String enlace = "funcion=verIngresosMarcaEstiloModeloHTML&idmarca=" + idmarca + "&idestilo="+idestilo + "&modelo="+modelo;

 //String enlace = "funcion=verIngresosMarcaEstiloHTMLInventarioVentas&idmarca=" + idmarca + "&idestilo="+idestilo;
               verReporte(enlace);
                SeleccionMarcaEstiloInventarioBuscar.this.destroy();
                       SeleccionMarcaEstiloInventarioBuscar.this.close();

                }
            }

        });

    }

    private void initCombos() {


         com_marca.setValueField("idmarca");
        com_marca.setDisplayField("nombre");
        com_marca.setMinChars(1);
        com_marca.setFieldLabel("nombre");
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
           com_estilo.setFieldLabel("Estilo ");
            com_estilo.setEmptyText("Seleccione un estilo");
           com_estilo.setDisplayField("nombre");
           com_estilo.setValueField("idestilo");
           com_estilo.setMode(ComboBox.LOCAL);
           com_estilo.setTriggerAction(ComboBox.ALL);
          com_estilo.setLinked(true);
           com_estilo.setForceSelection(true);
//           com_cliente.setReadOnly();
           com_estilo.setHideTrigger(true);
           com_estilo.setSelectOnFocus(true);
           com_estilo.setTypeAhead(true);


    }
  
 public Button getBut_aceptarpp() {
        return but_aceptarPp;
    }
 public Button getBut_aceptarp() {
        return but_aceptarP;
    }
  public Button getBut_nuevo() {
        return but_nuevo;
    }
   public Button getBut_actualizar() {
        return but_actualizar;
    }
    public Button getBut_entradas() {
        return but_entradas;
    }
     public Button getBut_trasrecibidos() {
        return but_trasrecibidos;
    }
      public Button getBut_regularizacion() {
        return but_regularizacion;
    }
       public Button getBut_traspdespachados() {
        return but_traspdespachados;
    }
        public Button getBut_devuletos() {
        return but_devueltos;
    }
    
  public Button getBut_editar() {
        return but_editar;
    }
   public Button getBut_inventarioventas() {
        return but_inventarioventas;
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
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
import com.gwtext.client.widgets.form.event.ComboBoxListenerAdapter;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import org.balderrama.client.sistemadetalle.PanelPedidoE;
//import org.balderrama.client.pedido.Pedido;
import org.balderrama.client.sistemadetalle.IngresoTiendaCodigo;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.Utils;

/**
 *
 * @author 
 */
public class SeleccionMarcaEstiloCodigo extends Window {

    private final int ANCHO = 300;
    private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private ComboBox com_tienda;
    private ComboBox com_marca;
    private Label label = new Label("2");
    private Panel formpanel1;
   // private Button but_aceptarP;
    private Button but_aceptarPp;
    private Button but_cancelarP;
    private String almacenC;
    private String tipoC;
    private Object[][] tiendaM;
    private Object[][] marcaM;
    boolean respuesta = false;
 //   Object[][] estiloM;
    public Object[][] estiloM1;
    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;
    //para crear un nuevo tab
    public TabPanel tap_panel;
    public KMenu padre;
    public MainEntryPoint panel;
  //  Pedido ped;
 //   private ComboBox com_estilo;


    public SeleccionMarcaEstiloCodigo(Object[][] marca,KMenu kmenu) {
    
        padre=kmenu;
      //  panel=pan;
       
        marcaM = marca;
 //       estiloM =estilo;
        //kmenu = menu;
        String tituloTabla = "Buscar ";
        this.setClosable(true);
        this.setId("TPfun5021");
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

     //   String nombreBoton1 = "Buscar Reporte";
          String nombreBoton3 = "Buscar";
        String nombreBoton2 = "Cancelar";

        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        //formPanel.setLabelWidth(ANCHO - 400);
         but_aceptarPp = new Button(nombreBoton3, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                 String idmarca = com_marca.getValue();
       
              cargarDatosPanelPedido(idmarca);
                    SeleccionMarcaEstiloCodigo.this.destroy();
                       SeleccionMarcaEstiloCodigo.this.close();

//                              GuardarEditarCliente(e);

            }

         
        });
    
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionMarcaEstiloCodigo.this.destroy();
                SeleccionMarcaEstiloCodigo.this.close();

              }
        });
   
        com_marca = new ComboBox("Marca", "marcas",200);
        formPanel.add(com_marca);
       // addButton(but_aceptarP);
        addButton(but_aceptarPp);
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
     addListeners();
    }
             private void cargarDatosPanelPedido(final String idmarca) {
  String enlace = "php/Marca.php?funcion=BuscarColeccionModeloPorMarca&idmarca=" + idmarca;

        Utils.setErrorPrincipal("Cargando parametros ", "cargar");
        final Conector conec = new Conector(enlace, false);
        {
            try {
                conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                    private EventObject e;

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
                                    String marca = Utils.getStringOfJSONObject(marcaO, "marca");
           Object[][] modeloM = Utils.getArrayOfJSONObject(marcaO, "modeloM", new String[]{"idmodelo", "codigo"});
        //  Object[][] tallasM = Utils.getArrayOfJSONObject(marcaO, "tallaM", new String[]{"idtalla", "talla"});
  IngresoTiendaCodigo pan_compraDirecta = new IngresoTiendaCodigo(idmarca, marca,modeloM);
   padre.seleccionarOpcion(null, "fun5028", e, pan_compraDirecta);
                                    SeleccionMarcaEstiloCodigo.this.clear();
                                    SeleccionMarcaEstiloCodigo.this.close();
                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente", "mensaje");
                                } else {
                                    MessageBox.alert("No Hay datos en la consulta");
                                }
                            }
                        } else {

                        }
                        throw new UnsupportedOperationException("Not supported yet.");
                    }

                    public void onError(Request request, Throwable exception) {
                        throw new UnsupportedOperationException("Not supported yet.");
                    }
                });

            } catch (RequestException e) {
                e.getMessage();
                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
            }

        }
    }
   private void addListeners() {
             com_marca.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                  
                   
                }else{
                  MessageBox.alert("No selecciono ninguna marca.");
                }
            }
        


        });
           com_marca.addListener(new ComboBoxListenerAdapter() {

            @Override
      public void onSelect(ComboBox comboBox, Record record, int index) {
                     String idmarca = com_marca.getValue();

              cargarDatosPanelPedido(idmarca);
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



    }
  

    public Button getBut_aceptar() {
        return but_aceptarPp;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }



           private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
    
   
}
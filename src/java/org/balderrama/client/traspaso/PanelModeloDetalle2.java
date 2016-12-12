/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.traspaso;

//import com.google.gwt.json.client.JSONString;

//import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.venta.*;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
//import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.widgets.TabPanel;
//import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.Position;
//import com.gwtext.client.widgets.Component;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.Window;
//import com.gwtext.client.widgets.QuickTipsConfig;
//import com.gwtext.client.widgets.event.PanelListenerAdapter;
//import com.gwtext.client.widgets.form.FieldSet;
import com.gwtext.client.widgets.form.FormPanel;
//import com.gwtext.client.widgets.grid.event.EditorGridListenerAdapter;
//import com.gwtext.client.widgets.grid.event.GridRowListenerAdapter;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.FormLayout;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;
import com.gwtext.client.core.EventObject;
//import com.gwtext.client.core.TextAlign;
import com.gwtext.client.data.*;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Panel;
//import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
//import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.NumberField;
import com.gwtext.client.widgets.form.TextField;
//import com.gwtext.client.widgets.grid.*;
//import com.gwtext.client.widgets.grid.event.GridCellListenerAdapter;

/**
 *
 * @author
 */
public class PanelModeloDetalle2 extends Window {

    private final int ANCHO = 800;
    private final int ALTO = 420;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("98%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanelCliente;
    //private TextField tex_fecha;
    boolean respuesta = false;
    private ListaModelosDetalle lista;
    private Button but_aceptar;
    private Button but_cancelar;
    //private String fechad;
    PagingToolbar pagingToolbar1015;
    public PanelVentaDetalle padre;
    public PanelTraspasoCaja padre2;
    private String marca;
    private String vendedo;
    private String opcion;

    String codigobarra;

    public PanelModeloDetalle2(PanelTraspasoCaja panel, String buscando, String idmarca, String vendedor, String opcion) {

        this.codigobarra = buscando;
        this.marca = idmarca;
        this.vendedo = vendedor;
        this.opcion = opcion;
        this.padre2 = panel;

        String nombreBoton1 = "Registrar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Marcar Modelos para la VEnta";
        tituloTabla = "Modelos de venta por caja";

        setId("win-FormularioCambio");
        setTitle(tituloTabla);
        setWidth(ANCHO);
        setMinWidth(ANCHO);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        setPlain(true);

        but_aceptar = new Button(nombreBoton1);
        but_cancelar = new Button(nombreBoton2);
        addButton(but_aceptar);
        addButton(but_cancelar);

        formPanelCliente = new FormPanel();
        formPanelCliente.setBaseCls("x-plain");
        formPanelCliente.setLabelWidth(150);
        formPanelCliente.setUrl("save-form.php");
        formPanelCliente.setWidth(ANCHO);
        formPanelCliente.setHeight(ALTO);
        formPanelCliente.setLabelAlign(Position.LEFT);
        formPanelCliente.setAutoWidth(true);

        TabPanel tabPanel = new TabPanel();
        tabPanel.setPlain(true);
        tabPanel.setActiveTab(0);
        tabPanel.setHeight(370);
        tabPanel.setWidth(ANCHO);
        Panel firstPanel = new Panel();
        firstPanel.setLayout(new FormLayout());
        if (opcion.equalsIgnoreCase("2")) {
            lista = new ListaModelosDetalle();
            lista.onModuleLoad2(codigobarra, marca, vendedo);
        }
        if (opcion.equalsIgnoreCase("3")) {
            lista = new ListaModelosDetalle();
            lista.onModuleLoad3(codigobarra, marca, vendedo);
        }
        if (opcion.equalsIgnoreCase("4")) {
            lista = new ListaModelosDetalle();
            lista.onModuleLoad4(codigobarra, marca, vendedo);
        }
        if (opcion.equalsIgnoreCase("6")) {
            lista = new ListaModelosDetalle();
            lista.onModuleLoad6(codigobarra, marca, vendedo);
        }
        if (opcion.equalsIgnoreCase("7")) {
            lista = new ListaModelosDetalle();
            lista.onModuleLoad7(codigobarra, marca, vendedo);
        }
        if (opcion.equalsIgnoreCase("8")) {
            lista = new ListaModelosDetalle();
            lista.onModuleLoad8(codigobarra, marca, vendedo);
        }
        if (opcion.equalsIgnoreCase("9")) {
            lista = new ListaModelosDetalle();
            lista.onModuleLoad9(codigobarra, marca, vendedo);
        }
        if (opcion.equalsIgnoreCase("10")) {
            lista = new ListaModelosDetalle();
            lista.onModuleLoad10(codigobarra, marca, vendedo);
        }
        if (opcion.equalsIgnoreCase("11")) {
            lista = new ListaModelosDetalle();
            lista.onModuleLoad11(codigobarra, marca, vendedo);
        }
        if (opcion.equalsIgnoreCase("12")) {
            lista = new ListaModelosDetalle();
            lista.onModuleLoad12(codigobarra, marca, vendedo);
        }
        if (opcion.equalsIgnoreCase("13")) {
            lista = new ListaModelosDetalle();
            lista.onModuleLoad13(codigobarra, marca, vendedo);
        }        
        firstPanel.add(lista.getPanel());
        tabPanel.add(firstPanel);

        formPanelCliente.add(tabPanel);

        add(formPanelCliente);
        addListeners();

    }

    private void addListeners() {
        but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                createModeloVenta(marca);
            }
        });

        but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                close();
                destroy();
            }
        });
    }


    public void createModeloVenta(String idmarca) {
        final Record[] records;
        records = lista.cbSelectionModel.getSelections();
        if (records.length > 0) {
            for (int i = 0; i < records.length; i++) {
                String kardex = records[i].getAsString("idkardex");
                String modelo = records[i].getAsString("idmodelo");
                String cod = records[i].getAsString("codigo");
                String det = records[i].getAsString("color") + "-" + records[i].getAsString("material");
                String cant = records[i].getAsString("totalparescaja");
                String precioventa = records[i].getAsString("precio");
                String preciopares = records[i].getAsString("totalparesbs");
                if(cant=="12"){
                    padre2.MostrarVentaProducto(kardex, modelo, cod, det, cant, precioventa);
                }else{                
                    padre2.MostrarVentaProducto(kardex, modelo, cod, det, cant, preciopares);
                }                
                String enlace = ("php/VentaMayor.php?funcion=cambiarestadoparcaja&idkardexunico=" + kardex + "&idkardex=" + kardex + "&idmodelo=" + modelo);
                final Conector conec = new Conector(enlace, false);
                {
                    try {
                        conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                            public void onResponseReceived(Request request, Response response) {
                                //MessageBox.alert("Correcto ");
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
            close();
            destroy();
        }
        else {
            MessageBox.alert("No hay modelos seleccionados para vender.");
        }
    }

}

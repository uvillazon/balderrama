/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

import org.balderrama.client.traspaso.*;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.ArrayReader;
import com.gwtext.client.data.DataProxy;
import com.gwtext.client.data.JsonReader;
import com.gwtext.client.data.RecordDef;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.data.Store;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.PagingToolbar;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtextux.client.data.PagingMemoryProxy;
import java.util.Date;
import org.balderrama.client.sistemadetalle.PanelInventario;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;

/**
 *
 * @author buggy
 */
public class ValidarUsuario extends Window {

    private final int ANCHO = 400;
    private final int ALTO = 300;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    public TextField tex_codigoM;
    private TextField tex_origenM;
    private TextField tex_destinoM;
    private TextField tex_fechaM;
    private TextField tex_estadoM;
    private TextField tex_codigoBarra;
     private ColumnConfig Columnid;
    private ColumnConfig Columncodigo;
    private ColumnConfig Columnproducto;
    private ColumnConfig Columntalla;
    private ColumnConfig Columncantidad;
    private ColumnConfig Columnpreciobs2;
     private ColumnModel columnModel;
    private BaseColumnConfig[] columns;
    private PagingMemoryProxy proxy;
    private RecordDef recordDef;
     private RecordDef recordDef2;
      private Float totalcantidad;
    private Float totalBs;
      private CheckboxSelectionModel cbSelectionModel;
     private Store store;
    private ArrayReader reader;
    private ToolbarButton eliminarEntrega;
    private Object[][] productoM;
      private EditorGridPanel grid;
      PagingToolbar pagingToolbar;
// private DateField dat_fecha;
 private Date fechahoy;
     boolean respuesta = false;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String idmarcaM;
    private String codigoM;
    private String origenM;
    private String destinoM;
    private String fechaM;
    private String estadoM;
    //private Object[][] marcaM;
    private Object[][] clienteM;
    private boolean nuevo;
    private ListaTraspaso padre;
      private PanelInventario padre1;
       private PanelInventarioM padre2;
    private String enlaceReporte;
   // private ScriptTagProxy dataProxy1015;
    private String idclienteD;
    //private JsonReader reader1015;
    private GridPanel grid1015;
        private ColumnConfig codigo1015;
    private ColumnConfig codigof1015;
    private ColumnConfig nombre1015;
    private ColumnConfig marca1015;
    private ColumnConfig pais1015;
    private ColumnConfig cantidad1015;
    private ColumnConfig preciobs1015;
    private ColumnConfig preciosus1015;
    private ColumnConfig pago7;
    private ColumnConfig car1015;
    // public ComboBox com_cliente;
    private ToolbarButton kardexProducto1015;
    protected ExtElement ext_element1015;
    private CheckboxSelectionModel cbSelectionModel1015;
   // private CheckboxSelectionModel cbSelectionModel;
    private Store store1015;
    private BaseColumnConfig[] columns1015;
    private ColumnModel columnModel1015;
    private DataProxy dataProxy1015;
    private JsonReader reader1015;
    PagingToolbar pagingToolbar1015;
String idtraspaso;
String idkardex;
String idmarca;
String idalmacen;
String tipoclave;
    private TextField passwordMulti;
      private TextField login;
//    public Cambiarvendedor(Object[][] estiloM, String idmarca, String responsable, PanelInventario aThis) {
//        throw new UnsupportedOperationException("Not yet implemented");
//    }
//desde inventario
  public ValidarUsuario(String tipoclave1,Object[][] estiloM,final String idmarcag,final String idalmaceng,final String idkardexg, PanelInventario padre11) {
      this.tipoclave =  tipoclave1;
      this.clienteM = estiloM;
       this.idmarca=idmarcag;
       this.idalmacen=idalmaceng;
       this.idkardex=idkardexg;
     // this.idres= idres;

        this.padre1 = padre11;
        String nombreBoton1 = "";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "";
            nombreBoton1 = "Confirmar contraseña";
            tituloTabla = "Modificar Precios";
            nuevo = false;
         setMinWidth(200);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        setPlain(true);
        setPaddings(WINDOW_PADDING);
        setWidth(300);
        setHeight(200);
        setId("win-cambiarusuario");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
             // String idvendedor =com_cliente.getValueAsString().trim();
                if(tipoclave=="precio"){
                GuardarEliminarVenta(tipoclave);
             }else{
             GuardarEliminarmodelo(tipoclave);

             }
          }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                close();
                destroy();
            }
        });
        //dat_fecha = new DateField("Fecha", "d-m-Y");
      //   fechahoy = new Date();
//              dat_fecha.setValue(fechahoy);
  //      dat_fecha.setReadOnly(true);
        tex_codigoM = new TextField("Login", "login");
      //  tex_codigoM.setReadOnly(true);
      //  com_cliente = new ComboBox("Vendedor al que enviamos", "idempleado");
        setTitle(tituloTabla);
        setWidth(ANCHO);
        setMinWidth(ANCHO);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        addButton(but_aceptarP);
        addButton(but_cancelarP);

        setCloseAction(Window.CLOSE);
        setPlain(true);
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        formPanel.setLabelWidth(ANCHO - 400);
        formPanel.setWidth(ANCHO);
        formPanel.setHeight(200);



        formPanel.setLabelWidth(ANCHO - 400 - 5);
         passwordMulti = new TextField("Password", "paswd");
        passwordMulti.setPassword(true);
formPanel.add(tex_codigoM);
formPanel.add(passwordMulti);
         //formPanel.add(dat_fecha);
        //formPanel.add(com_cliente);
        add(formPanel);
    //    initValues();
    }

   public ValidarUsuario(String tipoclave1,Object[][] estiloM,final String idmarcag,final String idalmaceng,final String idkardexg, PanelInventarioM padre12) {
      this.tipoclave =  tipoclave1;
      this.clienteM = estiloM;
       this.idmarca=idmarcag;
       this.idalmacen=idalmaceng;
       this.idkardex=idkardexg;
     // this.idres= idres;
        this.padre2 = padre12;
        String nombreBoton1 = "";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "";
            nombreBoton1 = "Confirmar contraseña";
            tituloTabla = "Modificar Precios";
            nuevo = false;
         setMinWidth(200);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        setPlain(true);
        setPaddings(WINDOW_PADDING);
        setWidth(300);
        setHeight(200);
        setId("win-cambiarusuario");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
             // String idvendedor =com_cliente.getValueAsString().trim();
                if(tipoclave=="precio"){
                GuardarEliminarVenta(tipoclave);
             }else{
             GuardarEliminarmodeloM(tipoclave);

             }
          }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                close();
                destroy();
            }
        });
        //dat_fecha = new DateField("Fecha", "d-m-Y");
      //   fechahoy = new Date();
//              dat_fecha.setValue(fechahoy);
  //      dat_fecha.setReadOnly(true);
        tex_codigoM = new TextField("Login", "login");
      //  tex_codigoM.setReadOnly(true);
      //  com_cliente = new ComboBox("Vendedor al que enviamos", "idempleado");
        setTitle(tituloTabla);
        setWidth(ANCHO);
        setMinWidth(ANCHO);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        addButton(but_aceptarP);
        addButton(but_cancelarP);

        setCloseAction(Window.CLOSE);
        setPlain(true);
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        formPanel.setLabelWidth(ANCHO - 400);
        formPanel.setWidth(ANCHO);
        formPanel.setHeight(200);



        formPanel.setLabelWidth(ANCHO - 400 - 5);
         passwordMulti = new TextField("Password", "paswd");
        passwordMulti.setPassword(true);
formPanel.add(tex_codigoM);
formPanel.add(passwordMulti);
         //formPanel.add(dat_fecha);
        //formPanel.add(com_cliente);
        add(formPanel);
    //    initValues();
    }
   
public void GuardarEliminarVenta(String tipoclave) {

        final String idCliente=tex_codigoM.getText();
        String idAlmacen=passwordMulti.getText();
        //usuarioSoU.put("paswd1", new JSONString(Utils.md5(tex_nuevaContrania.getText())));
          String cadena = "php/VentaMayor.php?funcion=validarUsuarioInventario&idusuario=" + idCliente + "&password=" + idAlmacen + "&idalmacen=" + tipoclave;
                                 Utils.setErrorPrincipal("Validando el usuario", "cargar");
                final Conector conec = new Conector(cadena, false);
   try {
            conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {
                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                               //    padre.createCompra(com_usuarioMulti.getText());
                  padre1.createPedidousuario(idmarca, idalmacen, idkardex);
//                                 Utils.setErrorPrincipal(mensajeR, "mensaje");
                                 ValidarUsuario.this.destroy();
                                 ValidarUsuario.this.close();
                                } else {
                            //Window.alert(mensajeR);
                            com.google.gwt.user.client.Window.alert("No se modificar, password incorrecto");
                            Utils.setErrorPrincipal(mensajeR, "error");
                        }
                            }
                        }

                       public void onError(Request request, Throwable exception) {
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            });

        } catch (RequestException ex) {
            ex.getMessage();
            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
        }

    }
public void GuardarEliminarmodelo(String tipoclave) {

        final String idCliente=tex_codigoM.getText();
        String idAlmacen=passwordMulti.getText();
        //usuarioSoU.put("paswd1", new JSONString(Utils.md5(tex_nuevaContrania.getText())));
          String cadena = "php/VentaMayor.php?funcion=validarUsuarioInventario&idusuario=" + idCliente + "&password=" + idAlmacen + "&idalmacen=" + tipoclave;
                                 Utils.setErrorPrincipal("Validando el usuario", "cargar");
                final Conector conec = new Conector(cadena, false);
   try {
            conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {
                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                               //    padre.createCompra(com_usuarioMulti.getText());
                  padre1.createPedidomodelo(idmarca, idalmacen, idkardex);
                  
//                                 Utils.setErrorPrincipal(mensajeR, "mensaje");
                                 ValidarUsuario.this.destroy();
                                 ValidarUsuario.this.close();
                                } else {
                            //Window.alert(mensajeR);
                            com.google.gwt.user.client.Window.alert("No se modificar, password incorrecto");
                            Utils.setErrorPrincipal(mensajeR, "error");
                        }
                            }
                        }

                       public void onError(Request request, Throwable exception) {
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            });

        } catch (RequestException ex) {
            ex.getMessage();
            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
        }

    }

public void GuardarEliminarmodeloM(String tipoclave) {

        final String idCliente=tex_codigoM.getText();
        String idAlmacen=passwordMulti.getText();
        //usuarioSoU.put("paswd1", new JSONString(Utils.md5(tex_nuevaContrania.getText())));
          String cadena = "php/VentaMayor.php?funcion=validarUsuarioInventario&idusuario=" + idCliente + "&password=" + idAlmacen + "&idalmacen=" + tipoclave;
                                 Utils.setErrorPrincipal("Validando el usuario", "cargar");
                final Conector conec = new Conector(cadena, false);
   try {
            conec.getRequestBuilder().sendRequest(null, new RequestCallback() {
                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {
                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                               //    padre.createCompra(com_usuarioMulti.getText());
                  padre2.createPedidomodeloM(idmarca, idalmacen, idkardex);

//                                 Utils.setErrorPrincipal(mensajeR, "mensaje");
                                 ValidarUsuario.this.destroy();
                                 ValidarUsuario.this.close();
                                } else {
                            //Window.alert(mensajeR);
                            com.google.gwt.user.client.Window.alert("No se modificar, password incorrecto");
                            Utils.setErrorPrincipal(mensajeR, "error");
                        }
                            }
                        }

                       public void onError(Request request, Throwable exception) {
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            });

        } catch (RequestException ex) {
            ex.getMessage();
            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
        }

    }
    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }


    public int redondedo(float f) {
        int aux = (int) f;
        if (aux < f) {
            aux = aux + 1;
        }
        return aux;
    }
}
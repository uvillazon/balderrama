/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.system;

import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;
import com.google.gwt.user.client.ui.DecoratorPanel;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.Hidden;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.layout.AnchorLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;

/**
 *
 * @author buggy
 */
public class NuevoMarcaEmpleadoEstado extends Window {

    private final int ANCHO = 500;
    private final int ALTO = 120;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
 //   private TextField tex_codigoM;
  //  private TextField tex_nombreM;
  //  private TextArea text_descripcion;
   private Hidden hid_idmarca;
   private Hidden hid_idempleado;
    private TextField tex_marcaM;
      private TextField tex_estado;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private String idmaterial;
   // private String nombreL;
    //private String codigoL;
    private String estado;
    private boolean nuevo;
    private EditarMarcaEmpleado padre;
    private String idmarca;
    private String nombrem;
//private Object[][] marcaM;
//    private ComboBox com_ciudadE;
    private String idempleado;

     // NuevoMarcaEmpleadoEstado(idmarca, idempleado, marca,estado, EditarMarcaEmpleado.this);

    public NuevoMarcaEmpleadoEstado (String idmarcas, String idempleados, String marca,String estados, EditarMarcaEmpleado padre) {
        this.idempleado = idempleados;
        this.idmarca = idmarcas;
        this.nombrem = marca;
        this.padre = padre;
        this.estado = estados;
    //this.marcaM = ciudades;
        String nombreBoton1 = "Registrar";
        String nombreBoton2 = "Cancelar";
        String tituloTabla = "Registrar nueva Marca Asignada";
       // if (idmarca != null) {
            nombreBoton1 = "Modificar";
            tituloTabla = "Editar";
            nuevo = false;
//        } else {
//            this.idmaterial = "nuevo";
//            nuevo = true;
//        }

        setId("win-MarcaForm");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {

                   GuardarNuevoMaterial();
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                NuevoMarcaEmpleadoEstado.this.close();
                NuevoMarcaEmpleadoEstado.this.setModal(false);
            }
        });

        setTitle(tituloTabla);
        setAutoHeight(true);
        setAutoWidth(true);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        addButton(but_aceptarP);
        addButton(but_cancelarP);

        setCloseAction(Window.CLOSE);
        setPlain(true);
        DecoratorPanel decPanel = new DecoratorPanel();
        decPanel.setTitle("Registro De Colores");
        formPanel = new FormPanel();
       tex_estado = new TextField("Estado", "estado", 100);
//        tex_nombreM = new TextField("Nombre", "nombre", 200);
//        tex_nombreM.focus();
        tex_marcaM = new TextField("Marca", "marca", 200);
       hid_idmarca = new Hidden("idmarca", idmarca );
          hid_idempleado = new Hidden("idempleado", idempleado);
//    com_ciudadE = new ComboBox("Marcas", "idmarca");
    //    com_ciudadE.setReadOnly(true);
     formPanel.add(tex_marcaM);
      formPanel.add(tex_estado);
       formPanel.add(hid_idmarca);
         formPanel.add(hid_idempleado);
       initValues();
 //formPanel.add(com_ciudadE);
        decPanel.add(formPanel);
        add(decPanel);

    //    addListeners();
    }

 private void initValues() {
     tex_marcaM.setValue(nombrem);
       tex_estado.setValue(estado);
     

     }


    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }

    public void GuardarNuevoMaterial() {
      //  String cadena = "php/Empleado.php?funcion=insertarMarcaEmpleado";
          String cadena = "php/Empleado.php?funcion=EditarMarcaEstado";
        cadena = cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
        Utils.setErrorPrincipal("Cambio Estado Marca/Vendedor", "guardar");
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
                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                            padre.reload();
                             NuevoMarcaEmpleadoEstado.this.close();
                NuevoMarcaEmpleadoEstado.this.setModal(false);
                          //  com_ciudadE.focus();
                        } else {
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
  public void limpiarVentanaVenta() {
   //   com_ciudadE.setValue("");
    }

    public int redondedo(float f) {
        int aux = (int) f;
        if (aux < f) {
            aux = aux + 1;
        }
        return aux;
    }
}

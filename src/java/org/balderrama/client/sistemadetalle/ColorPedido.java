/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

/**
 *
 * @author haydee
 */
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONValue;

import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.layout.FitLayout;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;

public class ColorPedido extends Window {

    private Object[][] colorM;
    private Button but_aceptarP;
    private Button but_cancelarP;
      private final int WINDOW_PADDING = 5;
    private boolean nuevo;
    private FormPanel formPanel;
    private ComboBox com_color1;
  //  private ComboBox com_color2;
    private ComboBox com_color3;
    private ComboBox com_color4;
    private ComboBox com_color5;
    private ComboBox com_color6;
      private TextField tex_boleta;
    ListaCalzadoPedido padre;
   //  ListaCalzadoPedidoTalla padre1;
    //  ListaCalzadoPedidoConfirmado padre2;
   //   ListaCalzadoPedidoTallaUnion2 padre3;
    private int col;
    private int row;
  private String idmarca;
private void addListenerskey() {

    com_color1.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    validarexistente();
// String color1 = com_color1.getValueAsString();
 
                //     GuardarEditarAlmacen();
                 // com_color2.focus();

                }
            }

        });
tex_boleta.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    //validarexistente();
                    String colorn=tex_boleta.getValueAsString();
         GuardarNuevoColor(colorn);
         padre.InsertRowColor(row, col, colorn);
        ColorPedido.this.destroy();
        close();
                }
            }

        });

}
//registro nuevo producto
    public ColorPedido(String idmar,Object[][] colorM, final ListaCalzadoPedido padre, final int col, final int row) {

        this.colorM = colorM;
        this.padre = padre;
        this.col = col;
        this.row = row;
        this.idmarca=idmar;
        
        String nombreBoton1 = "Insertar";
        String nombreBoton2 = "Cancelar";
        setTitle("Seleccionar Colores");
         setAutoWidth(true);
        setAutoHeight(true);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        setAutoHeight(true);
        setLayout(new FitLayout());
        setPaddings(8);
        setButtonAlign(Position.CENTER);

        setCloseAction(Window.CLOSE);
        setPlain(true);
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");

        //eventos a los botones
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
          
                  String colorn=tex_boleta.getValueAsString();
           if (colorn.equalsIgnoreCase("")) {
               String color1 = com_color1.getValueAsString();
 
        padre.InsertRowColor(row, col, color1);
        ColorPedido.this.destroy();
        close();
          }else{
        //      String colorn=tex_boleta.getValueAsString();
         GuardarNuevoColor(colorn);
         padre.InsertRowColor(row, col, colorn);
        ColorPedido.this.destroy();
        close();

          }
              //      GuardarEditarAlmacen();
                //JasperReportBasic jasper=new JasperReportBasic();
  
                  
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                ColorPedido.this.close();
                ColorPedido.this.setModal(false);
                 ColorPedido.this.destroy();
            //formulario = null;
            }
        });

        //combos
        com_color1 = new ComboBox("Color", "idcolor1");
              tex_boleta = new TextField("Nuevo Color", "boleta", 200);

        formPanel.add(com_color1);
          formPanel.add(tex_boleta);

        addButton(but_aceptarP);
        addButton(but_cancelarP);
        add(formPanel);

          initCombos();
        addListenerskey();
    }

      private void validarexistente() {
         String color1 = com_color1.getValueAsString();
   if (color1.equalsIgnoreCase("")) {
       tex_boleta.focus();

   }else{
        GuardarEditarAlmacen();

   }
           
      }
    private void initCombos() {

        //color1
        SimpleStore proveedorStore = new SimpleStore(new String[]{"idcolor", "codigo"}, colorM);
        proveedorStore.load();
        com_color1.setMinChars(1);
        com_color1.setFieldLabel("COLOR");
        com_color1.setStore(proveedorStore);
        com_color1.setValueField("codigo");
        com_color1.setDisplayField("codigo");
        com_color1.setForceSelection(false);
        com_color1.setMode(ComboBox.LOCAL);
        com_color1.setEmptyText("Buscar color");
        com_color1.setLoadingText("buscando...");
        com_color1.setTypeAhead(true);
        com_color1.setEditable(true);
        com_color1.setSelectOnFocus(true);
        com_color1.setWidth(150);

        com_color1.setHideTrigger(true);
com_color1.focus();
        //color 2

    }
public void GuardarNuevoColor(String idColor) {
    
        String cadena = "php/Colores.php?funcion=GuardarNuevoColorform&idmarca=" + idmarca;
        cadena = cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
     //   Utils.setErrorPrincipal("Guardando el nuevo Color", "guardar");
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
                           // Utils.setErrorPrincipal(mensajeR, "mensaje");
                           // close();

                        } else {
                           // Utils.setErrorPrincipal(mensajeR, "error");
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

     public void GuardarEditarAlmacen() {

        String color1 = com_color1.getValueAsString();
      String color = color1;
        padre.InsertRowColor(row, col, color1);
        ColorPedido.this.destroy();
        close();

    }


}

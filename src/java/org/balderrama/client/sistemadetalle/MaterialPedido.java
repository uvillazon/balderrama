/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

/**
 *
 * @author 
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

public class MaterialPedido extends Window {

    private Object[][] materialM;
    private Button but_aceptarP;
    private Button but_cancelarP;
    private boolean nuevo;
    private ComboBox com_material1;
        private TextField tex_boleta;


    ListaCalzadoPedido padre;
    ListaCalzadoPedidoTalla2 padre2;
    private FormPanel formPanel;
    private int col;


    int row;
    private String idmarca;

    public MaterialPedido(String idmar,Object[][] materialM, final ListaCalzadoPedido padre, final int col, final int row) {

        this.materialM = materialM;
        this.padre = padre;
        this.idmarca=idmar;
        this.col = col;
        this.row = row;
        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";

        setTitle("Seleccionar ");
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
               String color1 = com_material1.getValueAsString();

        padre.InsertRowMaterial(row, col, color1);
        MaterialPedido.this.destroy();
        close();
          }else{
          GuardarNuevoColor(colorn);
         padre.InsertRowMaterial(row, col, colorn);
        MaterialPedido.this.destroy();
        close();
          }
             }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                MaterialPedido.this.close();
                MaterialPedido.this.destroy();
                MaterialPedido.this.setModal(false);
            }
        });
        com_material1 = new ComboBox("Buscar Existente", "idmaterial");
        tex_boleta = new TextField("Nuevo Valor", "boleta", 200);
     //   formPanel.add(com_material1);
        formPanel.add(com_material1);
        formPanel.add(tex_boleta);
        addButton(but_aceptarP);
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
        addListenerskey();
        
    }

     public MaterialPedido(String idmar,Object[][] materialM, final ListaCalzadoPedidoTalla2 padre21, final int col, final int row) {

        this.materialM = materialM;
        this.padre2 = padre21;
        this.idmarca=idmar;
        this.col = col;
        this.row = row;
        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";

        setTitle("Seleccionar Stylename");
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
               String color1 = com_material1.getValueAsString();

        padre2.InsertRowMaterial(row, col, color1);
        MaterialPedido.this.destroy();
        close();
          }else{
          GuardarNuevoColor(colorn);
         padre2.InsertRowMaterial(row, col, colorn);
        MaterialPedido.this.destroy();
        close();
          }
             }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                MaterialPedido.this.close();
                MaterialPedido.this.destroy();
                MaterialPedido.this.setModal(false);
            }
        });
        com_material1 = new ComboBox("Dato existente", "idmaterial");
        tex_boleta = new TextField("Nuevo Color", "boleta", 200);
        //formPanel.add(com_material1);
        formPanel.add(com_material1);
        formPanel.add(tex_boleta);
        addButton(but_aceptarP);
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
        addListenerskey2();
    }


private void addListenerskey() {
  com_material1.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    validarexistente();
    String colorn=tex_boleta.getValueAsString();
           if (colorn.equalsIgnoreCase("")) {
               String color1 = com_material1.getValueAsString();

        padre.InsertRowMaterial(row, col, color1);
        MaterialPedido.this.destroy();
        close();
          }else{
          GuardarNuevoColor(colorn);
         padre.InsertRowMaterial(row, col, colorn);
        MaterialPedido.this.destroy();
        close();
          }
                }
            }

        });
//    com_material1.addListener(new TextFieldListenerAdapter() {
//            @Override
//            public void onSpecialKey(Field field, EventObject e) {
//                if (e.getKey() == EventObject.ENTER) {
//               //   com_material2.focus();
//    GuardarEditarAlmacen() ;
//                }
//            }
//
//        });
        tex_boleta.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    //validarexistente();
                    String colorn=tex_boleta.getValueAsString();
GuardarNuevoColor(colorn);

         padre.InsertRowMaterial(row, col, colorn);
        MaterialPedido.this.destroy();
        close();
                }
            }

        });


}
   private void validarexistente() {
      String colorn=tex_boleta.getValueAsString();
   if (colorn.equalsIgnoreCase("")) {
               String color1 = com_material1.getValueAsString();

        padre.InsertRowMaterial(row, col, color1);
        MaterialPedido.this.destroy();
        close();
          }else{
          GuardarNuevoColor(colorn);
         padre.InsertRowMaterial(row, col, colorn);
        MaterialPedido.this.destroy();
        close();
          }
      }
private void addListenerskey2() {

    com_material1.addListener(new TextFieldListenerAdapter() {
            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
               //   com_material2.focus();
    GuardarEditarAlmacen2() ;
    
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

         padre.InsertRowMaterial(row, col, colorn);
        MaterialPedido.this.destroy();
        close();
                }
            }

        });


}
public void GuardarNuevoColor(String idColor) {
      String cadena = "php/Colores.php?funcion=GuardarNuevoMaterialform&idmarca=" + idmarca;
//      String cadena = "php/Colores.php?funcion=GuardarNuevoColorform&idmarca=" + idmarca;

      cadena = cadena + "&" + formPanel.getForm().getValues();
        final Conector conec = new Conector(cadena, false);
      //  Utils.setErrorPrincipal("Guardando el nuevo Color", "guardar");
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
                          //  Utils.setErrorPrincipal(mensajeR, "mensaje");
                           // close();

                        } else {
                            //Utils.setErrorPrincipal(mensajeR, "error");
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


    private void initCombos() {

        //color1
        SimpleStore proveedorStore = new SimpleStore(new String[]{"idmaterial", "codigo"}, materialM);
        proveedorStore.load();
        com_material1.setMinChars(1);
        com_material1.setFieldLabel("Datos existentes");
        com_material1.setStore(proveedorStore);
        com_material1.setValueField("codigo");
        com_material1.setDisplayField("codigo");
        com_material1.setForceSelection(true);
        com_material1.setMode(ComboBox.LOCAL);
        com_material1.setEmptyText("Buscar datos");
        com_material1.setLoadingText("buscando...");
        com_material1.setTypeAhead(true);
        com_material1.setSelectOnFocus(true);
        com_material1.setWidth(150);

        com_material1.setHideTrigger(true);

    }

  

    public void GuardarEditarAlmacen() {

        String color1 = com_material1.getValue();
       String[] colores = {color1};
//String[] colores = {color1, color2, color3, color4, color5, color6};

        String color = null;
        int i;
        for (i = 0; i < 6; i++) {
            if (colores[i] != null) {
                if (color != null) {
                    color = color + "/" + colores[i];
                } else {
                    color = colores[i];
                }

            }

        }

        padre.InsertRowMaterial(row, col, color);
        close();
this.destroy();
    }
    public void GuardarEditarAlmacen2() {

        String color1 = com_material1.getValue();
       String[] colores = {color1};
//String[] colores = {color1, color2, color3, color4, color5, color6};

        String color = null;
        int i;
        for (i = 0; i < 6; i++) {
            if (colores[i] != null) {
                if (color != null) {
                    color = color + "/" + colores[i];
                } else {
                    color = colores[i];
                }

            }

        }

        padre2.InsertRowMaterial(row, col, color);
        close();
this.destroy();
    }
}

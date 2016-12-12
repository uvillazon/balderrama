/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.sistemadetalle;

import org.balderrama.client.modelo.*;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.ExtElement;
import com.gwtext.client.core.UrlParam;
import com.gwtext.client.data.Store;
import com.gwtext.client.widgets.grid.BaseColumnConfig;
import com.gwtext.client.widgets.grid.CheckboxSelectionModel;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.form.Field;
import org.balderrama.client.util.BuscadorToolBar;

/**
 *
 * @author haydee
 */
public class IngresoTiendaDetalle extends Panel {

    private GridPanel grid;
     private ColumnConfig idColumn;
    private ColumnConfig totalcajasColumn;
    private ColumnConfig numerofacturaColumn;
    private ColumnConfig marcaColumn;
    private ColumnConfig numeropedidoColumn;
    private ColumnConfig totalparesColumn;
    private ColumnConfig fechaColumn;
    private ColumnConfig observacionColumn;
    private ColumnConfig responsableColumn;
   private ColumnConfig estadoColumn;
    private final int ANCHO = Utils.getScreenWidth() - 24;
    private final int ALTO = Utils.getScreenHeight() - 275;
    private ToolbarButton anularIngreso;
    private ToolbarButton eliminarModelo;
    private ToolbarButton buscar;
    private BuscadorToolBar buscadorToolBar;
    protected String buscarModelo;
    protected String buscarMarca;
    protected String buscarColeccion;
    protected String buscarLinea;
    private EditarModeloForm formulario;
    private ToolbarButton CodigoBarra;
    private ToolbarButton codlineaMarca;
    private ToolbarButton codcolorMarca;
    private ToolbarButton codmaterialMarca;
    private ToolbarButton configurarMarca;
    private ToolbarButton cargarimagenMarca;
    // private EditarMarcaForm formulario;
       private ListaCalzadoTienda lista1;
    protected ExtElement ext_element;
    CheckboxSelectionModel cbSelectionModel;
    Store store;
    private String selecionado;
    private BaseColumnConfig[] columns;
    ColumnModel columnModel;
    String idmarca;
   String codigo;
   String opcion;
    String nombre;
    String formatomayor;
   // Object[][] coleccionM;
    //  Object[][] estiloM;
    public IngresoTiendaDetalle(String idmarcam, String nombrem, String opcionb,String codigob,String formato) {
        this.setClosable(true);
        this.setId("TPfun5026");
        this.idmarca = idmarcam;
        this.codigo = codigob;
        this.opcion = opcionb;
        this.nombre = nombrem;
        this.formatomayor = formato;
        setIconCls("tab-icon");
        setAutoScroll(false);

        if (codigo == "KARDEX") {
               setTitle("Kardex/Generados");
        } else {
               setTitle("Sin Codigo");
        }
       onModuleLoad();
    }


    public void onModuleLoad() {
if (opcion.equalsIgnoreCase("6")) {
            lista1 = new ListaCalzadoTienda();
            lista1.onModuleLoad5(idmarca,codigo,nombre,opcion,formatomayor);
         }
if (opcion.equalsIgnoreCase("12")) {
            lista1 = new ListaCalzadoTienda();
            lista1.onModuleLoad5(idmarca,codigo,nombre,opcion,formatomayor);
         }
if (opcion.equalsIgnoreCase("7")) {
            lista1 = new ListaCalzadoTienda();
            lista1.onModuleLoad5(idmarca,codigo,nombre,opcion,formatomayor);
         }
if (opcion.equalsIgnoreCase("11")) {
            lista1 = new ListaCalzadoTienda();
            lista1.onModuleLoad5(idmarca,codigo,nombre,opcion,formatomayor);
         }
if (opcion.equalsIgnoreCase("10")) {
            lista1 = new ListaCalzadoTienda();
            lista1.onModuleLoad5(idmarca,codigo,nombre,opcion,formatomayor);
         }
if (opcion.equalsIgnoreCase("3")) {
 lista1 = new ListaCalzadoTienda();
lista1.onModuleLoad4(idmarca,codigo,nombre,opcion,formatomayor);
 // lista1.onModuleLoad5(idmarca,codigo,nombre,opcion,formatomayor);

  }

if (opcion.equalsIgnoreCase("8")) {
 lista1 = new ListaCalzadoTienda();
lista1.onModuleLoad4(idmarca,codigo,nombre,opcion,formatomayor);
  }
if (opcion.equalsIgnoreCase("9")) {
 lista1 = new ListaCalzadoTienda();
lista1.onModuleLoad4(idmarca,codigo,nombre,opcion,formatomayor);
  }
if (opcion.equalsIgnoreCase("4")) {
 lista1 = new ListaCalzadoTienda();
lista1.onModuleLoad333(idmarca,codigo,nombre,opcion,formatomayor);
  }
if (opcion.equalsIgnoreCase("2")) {
 lista1 = new ListaCalzadoTienda();
//onModuleLoad0(idmarca,codigo,nombre,opcion,formatomayor);
  }

//
//if (opcion.equalsIgnoreCase("3")) {
//                lista1 = new ListaCalzadoTienda();
//            lista1.onModuleLoad4(idmarca,codigo,coleccionM,estiloM,nombre);
//          }
//
//         if (opcion.equalsIgnoreCase("7")) {
//            lista1 = new ListaCalzadoTienda();
//    lista1.onModuleLoad6(idmarca,codigo,coleccionM,estiloM,nombre);
//           }
//
//        if (opcion.equalsIgnoreCase("10")) {
//         lista1 = new ListaCalzadoTienda();
//            lista1.onModuleLoad5(idmarca,codigo,coleccionM,estiloM,nombre);
//             }
//        //init
//        if (opcion.equalsIgnoreCase("14")) {
//            lista1 = new ListaCalzadoTienda();
//            lista1.onModuleLoad333(idmarca,codigo,coleccionM,estiloM,nombre);
//         }
//        if (opcion.equalsIgnoreCase("15")) {
//            lista1 = new ListaCalzadoTienda();
//            lista1.onModuleLoad33(idmarca,codigo,coleccionM,estiloM,nombre);
//            //lista1.onModuleLoad5(idmarca,codigo,coleccionM,estiloM,nombre);
//          }
//        if (opcion.equalsIgnoreCase("4")) {
//            lista1 = new ListaCalzadoTienda();
//            lista1.onModuleLoad333(idmarca,codigo,coleccionM,estiloM,nombre);
//          }
//        if (opcion.equalsIgnoreCase("2")) {
//            lista1 = new ListaCalzadoTienda();
//            lista1.onModuleLoad9(idmarca,codigo,coleccionM,estiloM,nombre);
//            }



 Panel pan_centro = lista1.getPanel();
add(pan_centro);
    //RootPanel.get().add(panel);
    }

    public GridPanel getGrid() {
        return grid;
    }

    public void setGrid(GridPanel grid) {
        this.grid = grid;
    }

    private void addListenersBuscadoresText() {

        //*********************************************************************
        //***************BUSCADOR ID************************************
        //*********************************************************************
        buscadorToolBar.getItemsText1().addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

        //*********************************************************************
        //***************BUSCADOR DE NOMBRE************************************
        //*********************************************************************
        buscadorToolBar.getItemsText2().addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

        //*********************************************************************
        //***************BUSCADOR DE TIPO************************************
        //*********************************************************************
        buscadorToolBar.getItemsText3().addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

        buscadorToolBar.getItemsText4().addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                    buscarSegunParametros();
                //com.google.gwt.user.client.Window.alert("apreto el enter en el campo 1");
                }
            }
        });

    }

    public void aniadirListenersBuscador() {

        buscar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Utils.setErrorPrincipal("Se realizo la busqueda", "mensaje");
                buscarSegunParametros();
            }
        });
    }

    public void reload() {
        store.reload();
        grid.reconfigure(store, columnModel);
        grid.getView().refresh();
    }

    private void addListenersBuscador() {
        buscar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                buscarSegunParametros();
            }
        });
    }

   public void buscarSegunParametros() {
        buscarModelo = buscadorToolBar.getItemsText1().getText();
        buscarColeccion = buscadorToolBar.getItemsText2().getText();
        buscarLinea = buscadorToolBar.getItemsText3().getText();
        buscarMarca = buscadorToolBar.getItemsText4().getText();
        store.reload(new UrlParam[]{
                    new UrlParam("start", 0), new UrlParam("limit", 100),
                    new UrlParam("buscarfactura", buscarModelo),
                    new UrlParam("buscarfecha", buscarColeccion),
                    new UrlParam("buscarresponsable", buscarLinea),
                    new UrlParam("buscarmodelo",buscarMarca ),}, false);
    }




    private void verReporte(String enlace) {
       ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);

  //      ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace,"PDF");
        print.show();
    }
}

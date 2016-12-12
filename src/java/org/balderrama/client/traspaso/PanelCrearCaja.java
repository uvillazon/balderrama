/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.traspaso;

/**
 *
 * @author
 */
import org.balderrama.client.sistemadetalle.*;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONArray;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.google.gwt.user.client.Window;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.core.RegionPosition;
import com.gwtext.client.data.Record;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.util.DateUtil;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.PaddedPanel;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.TextArea;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import com.gwtext.client.widgets.grid.GridPanel;
import com.gwtext.client.widgets.grid.event.EditorGridListenerAdapter;
import com.gwtext.client.widgets.layout.BorderLayout;
import com.gwtext.client.widgets.layout.BorderLayoutData;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.layout.FormLayout;
import com.gwtext.client.widgets.layout.HorizontalLayout;
import com.gwtext.client.widgets.layout.TableLayout;
import com.gwtext.client.widgets.layout.TableLayoutData;

import java.util.Date;
import org.balderrama.client.emergentes.SeleccionMarcaEstiloInventario;
import org.balderrama.client.util.Conector;
import org.balderrama.client.marca.Marca;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
import org.balderrama.client.util.ReporteTraspaso;
//import org.balderrama.client.util.Validacion;

public class PanelCrearCaja extends Panel {
//private MostrarTraspasototal formulario_alm;
    private ListaTraspaso SM;
    private IngresoTiendaMarca SMO;
     private ListaCalzadoPedidoTalla lista2;
    //private Panel panel;
    private String COMPRA_DIRECTA_TABBED = "97770001_unircaja-";
    private TextField tex_marca;
    //private ComboBox com_modeloCV;
    private TextField tex_numeropedido;
    private TextField tex_rango;
    // private TextField tex_modeloCP;
   private TextField tex_totalpares;
     private TextField tex_totalbs;
    private TextField tex_totalcaja;
      private TextField tex_responsable;

    private TextField tex_preciototal;
    private DateField dat_fecha;
    //private ListaPedidoCalzados lista;
    private Listadetallecrearcaja lista1;
    boolean respuesta = false;
    private TextArea tea_descripcion;
    private Button but_aceptar;
     private Button but_aceptar2;
    private Button but_aceptarR;
 private Button but_traspasar;
    private Button but_cancelar;
    private Button but_cancelar2;
    private Button but_limpiar;
    public KMenu kmenu;
    String selecionado = "";
    String marca;
    String idmarca;
    
    String opcion;
        String totalpares;
    String totalbs;
    String totalcajas;
    String formatomayor;
    String responsable;
    String almacen;
  String mesrango;
    String opcionnueva;
    String fecha;
     String idkardex;
     String idalmacen;
    String tipoestilonino;
     Object[][] colorM;
       private String[] tipoM;

    public PanelCrearCaja(String idkardex,String mesrango,String idmarca, String marca,String opcion, String formmayor,Object[][] materialM,String cajas,String totalparess,String totalbss, String responsable,String almacen,String idalmacen,ListaTraspaso pedido1,KMenu kmenu) {
        this.SM = pedido1;
        this.tipoM = new String[]{"M","W","GS"};
           this.kmenu = kmenu;
        this.marca = marca;
        this.idmarca = idmarca;
        this.mesrango = mesrango;
        this.idkardex=idkardex;
        this.marca = marca;
         this.colorM = materialM;
         this.totalpares = totalparess;
         this.totalbs = totalbss;
         this.opcion = opcion;
this.formatomayor = formmayor;
this.totalcajas = cajas;
this.responsable = responsable;
this.almacen = almacen;
this.idalmacen = idalmacen;
        onModuleLoad();
    }
public PanelCrearCaja(String idkardex,String mesrango,String idmarca, String marca,String opcion, String formmayor,Object[][] clienteM,String cajas,String totalparess,String totalbss, String responsable,String almacen,String idalmacen,IngresoTiendaMarca pedido12,KMenu kmenu) {
        this.SMO = pedido12;
        this.tipoM = new String[]{"M","W","GS"};
           this.kmenu = kmenu;
        this.marca = marca;
        this.idmarca = idmarca;
        this.mesrango = mesrango;
        this.idkardex=idkardex;
        this.marca = marca;
         this.colorM = clienteM;
         this.totalpares = totalparess;
         this.totalbs = totalbss;
         this.opcion = opcion;
this.formatomayor = formmayor;
this.totalcajas = cajas;
this.responsable = responsable;
this.almacen = almacen;
this.idalmacen = idalmacen;
        onModuleLoad();
    }

   

    public void onModuleLoad() {
        //panel = new Panel();
        setId("tab-" + COMPRA_DIRECTA_TABBED);
        setTitle("Marca "+ marca);
        setLayout(new FitLayout());
        setBaseCls("x-plain");
        this.setClosable(true);
        this.setId("TPfun10431");
        setIconCls("tab-icon");
 //MessageBox.alert(totalbs);
        Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");
 Panel pan_centrofin = new Panel();
       pan_centrofin.setLayout(new FormLayout());
        pan_centrofin.setWidth(1300);
        pan_centrofin.setHeight(600);

        Panel pan_norte = new Panel();
        pan_norte.setLayout(new TableLayout(3));
        pan_norte.setBaseCls("x-plain");
        pan_norte.setHeight(90);
        pan_norte.setPaddings(5);
        Panel pan_sud = new Panel();
        pan_sud.setLayout(new TableLayout(1));
        pan_sud.setBaseCls("x-plain");
        pan_sud.setHeight(50);
        pan_sud.setPaddings(5);
            //nike
             lista2 = new ListaCalzadoPedidoTalla();
 lista2.onModuleLoad1();

Panel pan_centro = lista2.getPanel();
//                if (opcion.equalsIgnoreCase("4")) {
          

        FormPanel for_panel1 = new FormPanel();
        for_panel1.setBaseCls("x-plain");
        for_panel1.setWidth(330);
        for_panel1.setLabelWidth(100);
        tex_marca = new TextField("Marca", "marca", 200);
        tex_marca.setValue(marca);
        tex_marca.setReadOnly(true);
               tex_numeropedido = new TextField("Almacen", "estilo", 200);
        tex_numeropedido.setReadOnly(true);
        tex_numeropedido.setValue(almacen);
      tex_responsable = new TextField("Encargado", "encargado", 200);
        tex_responsable.setReadOnly(true);
        tex_responsable.setValue(responsable);

        for_panel1.add(tex_marca);
        for_panel1.add(tex_numeropedido);
 for_panel1.add(tex_responsable);
        // for_panel1.add(tex_modeloCP);

        FormPanel for_panel2 = new FormPanel();
        for_panel2.setBaseCls("x-plain");
        for_panel2.setWidth(330);
        for_panel2.setLabelWidth(100);
          tex_totalcaja = new TextField("Total Cajas", "totalpares", 200);
        tex_totalcaja.setReadOnly(true);
        tex_totalcaja.setValue(totalcajas);

        tex_totalpares = new TextField("Total Pares", "totalpares", 200);
        tex_totalpares.setReadOnly(true);
        tex_totalpares.setValue(totalpares);
 
    tex_totalbs = new TextField("Total Sus", "totalbs", 200);
        tex_totalbs.setReadOnly(true);
        tex_totalbs.setValue(totalbs);
        but_aceptar = new Button("Guardar");
        but_cancelar = new Button("Cancelar");
         but_aceptar2 = new Button("Registrar Cambios");
        but_cancelar2 = new Button("Cancelar");
  Panel pan_botonescliente = new Panel();
        pan_botonescliente.setLayout(new HorizontalLayout(2));
        pan_botonescliente.setBaseCls("x-plain");

        pan_botonescliente.add(but_aceptar2);
        pan_botonescliente.add(but_cancelar2);
      //  pan_botonescliente.add(but_traspasar);
     for_panel2.add(tex_totalcaja);
        for_panel2.add(tex_totalpares);
       for_panel2.add(tex_totalbs);

 //for_panel2.add(new PaddedPanel(pan_botonescliente, 5, 5, 5, 5), new TableLayoutData(3));

        FormPanel for_panel3 = new FormPanel();
        for_panel3.setBaseCls("x-plain");
        for_panel3.setWidth(300);
        for_panel3.setLabelWidth(100);

        dat_fecha = new DateField("Fecha", "d-m-Y");
        Date date = new Date();
        dat_fecha.setValue(Utils.getStringOfDate(date));
        // dat_fecha.setValue(fecha);
         tex_rango = new TextField("Detalle", "rango", 200);
        tex_rango.setReadOnly(true);
        tex_rango.setValue(mesrango);
        for_panel3.add(dat_fecha);
for_panel3.add(tex_rango);


        pan_norte.add(new PaddedPanel(for_panel1, 10));
        pan_norte.add(new PaddedPanel(for_panel2, 10));
        pan_norte.add(new PaddedPanel(for_panel3, 10));
//        pan_norte.add(new PaddedPanel(for_panel12, 0, 0, 13, 10));

        FormPanel for_panel4 = new FormPanel();
        for_panel4.setBaseCls("x-plain");

        tex_preciototal = new TextField("", "totalprecio");
// tex_totalcaja.setValue(totalcajas);
        for_panel4.add(tex_preciototal);


        FormPanel for_panel6 = new FormPanel();
        for_panel6.setBaseCls("x-plain");
        tea_descripcion = new TextArea("Observacion", "observacion");
        tea_descripcion.setWidth("100%");

        for_panel6.add(tea_descripcion);

        Panel pan_botones = new Panel();
        pan_botones.setLayout(new HorizontalLayout(10));
        pan_botones.setBaseCls("x-plain");
        //       pan_botones.setHeight(40);
        
        but_limpiar = new Button("Limpiar");
        but_aceptarR = new Button("Reporte");
          but_traspasar = new Button("Traspasar");
//but_imprimir = new Button("Imprimir Lista");
 //       pan_botones.add(but_imprimir);
        //but_verproducto = new Button("Ver Producto");
        pan_botones.add(but_aceptar);
        pan_botones.add(but_cancelar);
        pan_botones.add(but_aceptarR);
  pan_botones.add(but_traspasar);
        pan_sud.add(new PaddedPanel(pan_botones, 10, 200, 10, 10), new TableLayoutData(3));
  lista1 = new Listadetallecrearcaja();
  lista1.onModuleLoad52(idmarca, idalmacen,idkardex,colorM,tipoM);
 //lista1.onModuleLoad55(idmarca, idalmacen,idkardex,colorM,tipoM);

 Panel pan_oeste = lista1.getPanel();
          pan_centrofin.add(pan_centro);
         pan_centrofin.add(pan_oeste);
        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centrofin, new BorderLayoutData(RegionPosition.CENTER));
        pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        add(pan_borderLayout);

  //      pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
   //     pan_borderLayout.add(pan_centro, new BorderLayoutData(RegionPosition.CENTER));
   //     pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
     //   add(pan_borderLayout);

        //initCombos();
        //  initValues();
        addListeners();


    }

    private void addListeners() {
        
   but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
      kmenu.seleccionarOpcionRemove(null, "fun10431", e, PanelCrearCaja.this);

  abrirpanelreporte();
            }
        });
          but_cancelar2.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
      kmenu.seleccionarOpcionRemove(null, "fun10431", e, PanelCrearCaja.this);

  abrirpanelreporte();
            }
        });
        //**************************************************
        //************* BOTON ACEPTAR *******************
        //**************************************************
         but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
           //     createPedido(idmarca,idestilo,idkardex);
            }
        });
         but_traspasar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
               createTraspasar();
            }
        });
          but_aceptar2.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
              createPedido(idmarca,idalmacen,idkardex);
              
            }
        });
    but_aceptarR.addListener(new ButtonListenerAdapter() {

            @Override

            public void onClick(Button button, EventObject e) {
           //      String idmarca = com_marca.getValue();
        //String idestilo = com_estilo.getValue();

            //        String enlace = "funcion=verIngresosMarcaEstiloHTML&idmarca=" + idmarca + "&idestilo="+idestilo;
             //  verReporte(enlace);

            }
        });


        lista1.getGrid().addEditorGridListener(new EditorGridListenerAdapter() {

            @Override
            public void onAfterEdit(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
                calcularSubTotal(grid, record, field, newValue, oldValue, rowIndex, colIndex);
            }
        });
    }
  
    public void calcularSubTotal(GridPanel grid, Record record, String field, Object newValue, Object oldValue, int rowIndex, int colIndex) {
        String temp = newValue.toString();
        Float old = new Float(oldValue.toString());
        Float talla14 = record.getAsFloat("14");
        Float talla15 = record.getAsFloat("15");
        Float talla16 = record.getAsFloat("16");
        Float talla17 = record.getAsFloat("17");
        Float talla18 = record.getAsFloat("18");
        Float talla19 = record.getAsFloat("19");
        Float talla20 = record.getAsFloat("20");
        Float talla21 = record.getAsFloat("21");
        Float talla22 = record.getAsFloat("22");
        Float talla23 = record.getAsFloat("23");
        Float talla24 = record.getAsFloat("24");
        Float talla25 = record.getAsFloat("25");
        Float talla26 = record.getAsFloat("26");
        Float talla27 = record.getAsFloat("27");
        Float talla28 = record.getAsFloat("28");
        Float talla29 = record.getAsFloat("29");
        Float talla30 = record.getAsFloat("30");
        Float talla31 = record.getAsFloat("31");
        Float talla32 = record.getAsFloat("32");
        Float talla33 = record.getAsFloat("33");
        Float talla34 = record.getAsFloat("34");
        Float talla35 = record.getAsFloat("35");
        Float talla36 = record.getAsFloat("36");
        Float talla37 = record.getAsFloat("37");
        Float talla38 = record.getAsFloat("38");
        Float talla39 = record.getAsFloat("39");
        Float talla40 = record.getAsFloat("40");
        Float talla41 = record.getAsFloat("41");
        Float talla42 = record.getAsFloat("42");
        Float talla43 = record.getAsFloat("43");
        Float talla44 = record.getAsFloat("44");
        Float talla45 = record.getAsFloat("45");
        Float talla1 = record.getAsFloat("1");
        Float talla1m = record.getAsFloat("1m");
        Float talla2 = record.getAsFloat("2");
        Float talla2m = record.getAsFloat("2m");
        Float talla3 = record.getAsFloat("3");
        Float talla3m = record.getAsFloat("3m");
        Float talla4 = record.getAsFloat("4");
        Float talla4m = record.getAsFloat("4m");
        Float talla5 = record.getAsFloat("5");
        Float talla5m = record.getAsFloat("5m");
        Float talla6 = record.getAsFloat("6");
        Float talla6m = record.getAsFloat("6m");
        Float talla7 = record.getAsFloat("7");
        Float talla7m = record.getAsFloat("7m");
        Float talla8 = record.getAsFloat("8");
        Float talla8m = record.getAsFloat("8m");
        Float talla9 = record.getAsFloat("9");
        Float talla9m = record.getAsFloat("9m");
        Float talla10 = record.getAsFloat("10");
        Float talla10m = record.getAsFloat("10m");
        Float talla11 = record.getAsFloat("11");
        Float talla11m = record.getAsFloat("11m");
        Float talla12 = record.getAsFloat("12");
        Float talla12m = record.getAsFloat("12m");
        Float talla13 = record.getAsFloat("13");
Float talla13m = record.getAsFloat("13m");
       

        Float ne = old;
        try {
            ne = new Float(temp);
        } catch (Exception e) {
            com.google.gwt.user.client.Window.alert("atapadp  " + e.getMessage());
            ne = old;
        }
         Float totalca = new Float(0);
        Float totalpa = new Float(0);
         Float totalpe = new Float(0);
   Float totalbs = new Float(0);
        int cob3 = record.getAsInteger("totalcajas");
       int cobo = '0';
        int cobu = '1';
 if ((opcion.equalsIgnoreCase("6")) ) {
            record.commit();
            record.set("totalpares", talla33 + talla34 + talla35 + talla36 + talla37 + talla38 + talla39 + talla40 + talla41 + talla42 );

            if ((record.getAsInteger("totalcajas")) == cobo){
     //  int difer = (record.getAsInteger("cobro1"))-(record.getAsInteger("mes1"));
  record.set("totalparescaja", (record.getAsInteger("totalpares")*cobu));
   record.set("totalparesbs", ((record.getAsInteger("precio")/12)*record.getAsInteger("totalparescaja")));

   }else{

  record.set("totalparescaja", (record.getAsInteger("totalpares")*record.getAsInteger("totalcajas")));
   record.set("totalparesbs", ((record.getAsFloat("precio")/12)*record.getAsFloat("totalparescaja")));
   }
            if (record.getAsFloat("preciounitario") != 0.0) {
            record.set("preciototal", record.getAsFloat("cantidad") * record.getAsFloat("preciounitario"));

        }
     record.set("preciounitario", (record.getAsFloat("precio")/12));
            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
                totalca += grid.getStore().getRecords()[i].getAsFloat("totalcajas");
                totalpa += grid.getStore().getRecords()[i].getAsFloat("totalpares");
   totalpe += grid.getStore().getRecords()[i].getAsFloat("totalparescaja");
totalbs += grid.getStore().getRecords()[i].getAsFloat("totalparesbs");


            }
   tex_totalpares.setValue(totalpe.toString());
        tex_totalbs.setValue(totalbs.toString());
      tex_totalcaja.setValue(totalca.toString());
        }
        if ((opcionnueva.equalsIgnoreCase("12")) || (opcionnueva.equalsIgnoreCase("13")) || (opcionnueva.equalsIgnoreCase("1"))) {
            record.commit();
            record.set("totalpares", talla33 + talla34 + talla35 + talla36 + talla37 + talla38 + talla39 + talla40 + talla41 + talla42 + talla43 + talla44 + talla45);

            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
                totalca += grid.getStore().getRecords()[i].getAsFloat("totalcajas");
                totalpa += grid.getStore().getRecords()[i].getAsFloat("totalpares");

            }
        }
         if (opcionnueva.equalsIgnoreCase("15")) {
            record.commit();
            record.set("totalpares", talla30 + talla31 + talla32 +talla33 + talla34 + talla35 + talla36 + talla37 + talla38 + talla39 + talla40 + talla41 + talla42 + talla43 + talla44 + talla45);

            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
                totalca += grid.getStore().getRecords()[i].getAsFloat("totalcajas");
                totalpa += grid.getStore().getRecords()[i].getAsFloat("totalpares");

            }
        }
        if (opcionnueva.equalsIgnoreCase("2")|| (opcionnueva.equalsIgnoreCase("14")))  {
            record.commit();
            record.set("totalpares", talla14 + talla15 + talla16 + talla17 + talla18 + talla19 + talla20 + talla21 + talla22 + talla23 + talla24 + talla25 + talla26 + talla27 + talla28 + talla29 + talla30 + talla31 + talla32 + talla33 + talla34 + talla35 + talla36 + talla37 + talla38);

            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
                totalca += grid.getStore().getRecords()[i].getAsFloat("totalcajas");
                totalpa += grid.getStore().getRecords()[i].getAsFloat("totalpares");

            }
        }
        if (opcionnueva.equalsIgnoreCase("21"))  {
            record.commit();
            record.set("totalpares", talla14 + talla15 + talla16 + talla17 + talla18 + talla19 + talla20 + talla21 + talla22 + talla23 + talla24 + talla25 + talla26 + talla27 + talla28 + talla29 + talla30 + talla31 + talla32 + talla33 + talla34 + talla35 + talla36 + talla37 + talla38+ talla39 + talla40);

            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
                totalca += grid.getStore().getRecords()[i].getAsFloat("totalcajas");
                totalpa += grid.getStore().getRecords()[i].getAsFloat("totalpares");

            }
        }
      
      if ((opcionnueva.equalsIgnoreCase("9")) || (opcionnueva.equalsIgnoreCase("6"))) {
              //    if (((opcion.equalsIgnoreCase("15"))||(opcion.equalsIgnoreCase("14"))||(opcion.equalsIgnoreCase("4")))&&(opciontalla.equalsIgnoreCase("M")) ){

            record.commit();
            record.set("totalpares",talla6  +talla6m  + talla7 + talla7m + talla8 + talla8m + talla9 + talla9m + talla10 + talla10m + talla11 + talla11m + talla12);
            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
                totalca += grid.getStore().getRecords()[i].getAsFloat("totalcajas");
                totalpa += grid.getStore().getRecords()[i].getAsFloat("totalpares");
            }
        }
         if ((opcionnueva.equalsIgnoreCase("3"))) {
              //    if (((opcion.equalsIgnoreCase("15"))||(opcion.equalsIgnoreCase("14"))||(opcion.equalsIgnoreCase("4")))&&(opciontalla.equalsIgnoreCase("M")) ){

            record.commit();
            record.set("totalpares",talla6+ talla6m  + talla7 + talla7m + talla8 + talla8m + talla9 + talla9m + talla10 + talla10m + talla11 + talla11m + talla12+ talla12m + talla13);
            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
                totalca += grid.getStore().getRecords()[i].getAsFloat("totalcajas");
                totalpa += grid.getStore().getRecords()[i].getAsFloat("totalpares");
            }
        }
          if ((opcionnueva.equalsIgnoreCase("7"))) {
              //    if (((opcion.equalsIgnoreCase("15"))||(opcion.equalsIgnoreCase("14"))||(opcion.equalsIgnoreCase("4")))&&(opciontalla.equalsIgnoreCase("M")) ){

            record.commit();
            record.set("totalpares",talla4 + talla4m +talla5 + talla5m +talla6+ talla6m  + talla7 + talla7m + talla8 + talla8m + talla9 + talla9m + talla10 );
            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
                totalca += grid.getStore().getRecords()[i].getAsFloat("totalcajas");
                totalpa += grid.getStore().getRecords()[i].getAsFloat("totalpares");
            }
        }
      if ((opcionnueva.equalsIgnoreCase("4")) || (opcionnueva.equalsIgnoreCase("10"))) {

            record.commit();
            record.set("totalpares", talla5 + talla5m + talla6 + talla6m + talla7 + talla7m + talla8 + talla8m + talla9 + talla9m + talla10+ talla10m +talla11);
            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
                totalca += grid.getStore().getRecords()[i].getAsFloat("totalcajas");
                totalpa += grid.getStore().getRecords()[i].getAsFloat("totalpares");
            }
        }

        if (opcionnueva.equalsIgnoreCase("5")) {

            record.commit();
            record.set("totalpares", talla1 + talla1m + talla2 + talla2m + talla3 + talla3m + talla4 + talla4m + talla5 + talla5m + talla6 + talla6m + talla7 + talla7m + talla8 + talla8m + talla9 + talla9m + talla10 + talla10m + talla11 + talla11m + talla12 + talla12m + talla13);
            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
                totalca += grid.getStore().getRecords()[i].getAsFloat("totalcajas");
                totalpa += grid.getStore().getRecords()[i].getAsFloat("totalpares");
            }
        }
        
      if ((opcionnueva.equalsIgnoreCase("8")) || (opcionnueva.equalsIgnoreCase("11")) ) {

            record.commit();
            record.set("totalpares", talla1 + talla1m + talla2 + talla2m + talla3 + talla3m + talla4 + talla4m + talla5 + talla5m + talla6 + talla6m + talla7 + talla7m + talla8 + talla8m + talla9 + talla9m + talla10 + talla10m + talla11 + talla11m + talla12 + talla12m + talla13+ talla13m );
            for (int i = 0; i <
                    grid.getStore().getRecords().length; i++) {
                totalca += grid.getStore().getRecords()[i].getAsFloat("totalcajas");
                totalpa += grid.getStore().getRecords()[i].getAsFloat("totalpares");
            }
        }

        //15
        
        tex_totalpares.setValue(totalpa.toString());
        //tex_totalpares.
  //      tex_totalcaja.setValue(totalca.toString());

    }
 private void abrirpanelreporte(){
          String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaEstiloinventario";
                final Conector conecaPB = new Conector(enlace, false);
                try {
                    conecaPB.getRequestBuilder().sendRequest(null, new RequestCallback() {

                        public void onResponseReceived(Request request, Response response) {
                            String data = response.getText();
                            JSONValue jsonValue = JSONParser.parse(data);
                            JSONObject jsonObject;
                            if ((jsonObject = jsonValue.isObject()) != null) {

                                String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                                String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                                if (errorR.equalsIgnoreCase("true")) {
                                    JSONValue marcaV = jsonObject.get("resultado");
                                    JSONObject marcaO;
                                    if ((marcaO = marcaV.isObject()) != null) {
         Object[][] kardexM = Utils.getArrayOfJSONObject(marcaO, "kardexM", new String[]{"idkardex", "mesrango","fechainicio","fechafin"});
//   Object[][] productos = Utils.getArrayOfJSONObject(jsonObject, "productoM", new String[]{"id", "detalle", "unidad", "preciounitario"});

        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
        Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "estiloM", new String[]{"idestilo", "idmarca","nombre"});

       // formMTEInventario = new SeleccionMarcaEstiloInventario(kardexM,marcaM,estiloM ,KMenu.this);

                                 //       SM = new SeleccionMarcaEstiloInventario(kardexM,marcaM,estiloM ,kmenu);
                                  //      SM.show();


                                    }

                                //
                                } else {
                                    Utils.setErrorPrincipal(mensajeR, "error");
                                }
                            } else {
                                Utils.setErrorPrincipal("Error en los datos", "error");
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
    public void createPedido(final String idmarca,final String idestilos,final String idkardex) {

 final String totalpares = tex_totalpares.getValueAsString();
        final String totalcaja = tex_totalcaja.getValueAsString();
        final String totalbs = tex_totalbs.getValueAsString();

    final String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
MessageBox.confirm("Guardar", "Confirma la modificacion de datos:  ? ,no olvide reimprimir  sus codigos de barra", new MessageBox.ConfirmCallback() {
                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("no")) {
// String enlTemp = "funcion=AdicionCodigoBarraIngresoHTML&idingreso=" + idventaG;
 //                           verReporte(enlTemp);
                           }else{

                               final String idesti = idestilos;
        Record[] records = lista1.getStore().getModifiedRecords();
   JSONArray productos = new JSONArray();
        JSONObject productoObject;
        JSONObject compraObject = new JSONObject();
        compraObject.put("fecharegistro", new JSONString(fechaent));
        compraObject.put("totalpares", new JSONString(totalpares));
        compraObject.put("totalbs", new JSONString(totalbs));
        compraObject.put("totalcaja", new JSONString(totalcaja));
        compraObject.put("idmarca", new JSONString(idmarca));
         compraObject.put("idkardex", new JSONString(idkardex));
         compraObject.put("idalmacen", new JSONString(idestilos));
        for (int i = 0; i < records.length; i++) {
            if (opcion.equalsIgnoreCase("6")) {
                  productoObject = new JSONObject();
                    productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                productoObject.put("color", new JSONString(records[i].getAsString("color")));
               productoObject.put("material", new JSONString(records[i].getAsString("material")));
                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("33", new JSONString(records[i].getAsString("33")));
                productoObject.put("34", new JSONString(records[i].getAsString("34")));
                productoObject.put("35", new JSONString(records[i].getAsString("35")));
                productoObject.put("36", new JSONString(records[i].getAsString("36")));
                productoObject.put("37", new JSONString(records[i].getAsString("37")));
                productoObject.put("38", new JSONString(records[i].getAsString("38")));
                productoObject.put("39", new JSONString(records[i].getAsString("39")));
                productoObject.put("40", new JSONString(records[i].getAsString("40")));
                productoObject.put("41", new JSONString(records[i].getAsString("41")));
                productoObject.put("42", new JSONString(records[i].getAsString("42")));
                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;
               
                                    }
 if (opcion.equalsIgnoreCase("4")) {
                  productoObject = new JSONObject();
                    productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
               productoObject.put("material", new JSONString(records[i].getAsString("material")));
                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;

                                    }
  

                                }
        

////
        JSONObject resultado = new JSONObject();
        resultado.put("ingreso", compraObject);
        resultado.put("calzados", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("registrando datos", "cargar");
        String url = "./php/IngresoAlmacen.php?funcion=txNewUpdateDatosDetalleIngresoInventario&" + datos;
   // String url = "./php/Pedido.php?funcion=GuardarNuevoPedido&" + datos;
        //com.google.gwt.user.client.Window.alert("zzzz" + url);
        final Conector conec = new Conector(url, false, "POST");
        // com.google.gwt.user.client.Window.alert("error 9999 " + conec.toString());
     try {
            conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {
 private EventObject e;
                public void onResponseReceived(Request request, Response response) {
                    String data = response.getText();
                    JSONValue jsonValue = JSONParser.parse(data);
                    JSONObject jsonObject;
                    if ((jsonObject = jsonValue.isObject()) != null) {
                        String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                        String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                        if (errorR.equalsIgnoreCase("true")) {
                             String idventaG = Utils.getStringOfJSONObject(jsonObject, "resultado");
                           kmenu.seleccionarOpcionRemove(null, "fun50291", e, PanelCrearCaja.this);

 //String miestilo = tex_numeropedido.getValueAsString().trim();
 //String mimarca = tex_marca.getValueAsString().trim();
reabrirpanel(e,idmarca,idesti,idkardex);
                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                        } else {
                            //Window.alert(mensajeR);
                            com.google.gwt.user.client.Window.alert("No se puede realizar la venta");
                            Utils.setErrorPrincipal(mensajeR, "error");
                        }
                    } else {
                        com.google.gwt.user.client.Window.alert("error 1001");
                        Utils.setErrorPrincipal("Error en la respuesta del servidor", "error");
                    }
                }

                public void onError(Request request, Throwable exception) {
                    //Window.alert("Ocurrio un error al conectar con el servidor ");
                    com.google.gwt.user.client.Window.alert("error 1002");
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            });
        } catch (RequestException ex) {
                //Window.alert("Ocurrio un error al conectar con el servidor");
//            com.google.gwt.user.client.Window.alert("error 1003");
                Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
            }
    //
     }
                        }
                    });
    }
     public void createTraspasar() {
final Record[] records;

           records = lista1.cbSelectionModel.getSelections();
       if (records.length > 0) {
                   MessageBox.confirm("Guardar", "Realmente desea traspasar : " + records.length + " modelos(s)?", new MessageBox.ConfirmCallback() {
                        public void execute(String btnID) {
                            if (btnID.equalsIgnoreCase("yes")) {
  // Record[] records = grid.getStore().getRecords();
      
        
    // formulario_alm = new MostrarTraspasototal(PanelCrearCaja.this);
    // formulario_alm.show();
                            }//fin boton
                        }
                    });
                } else {
                    MessageBox.alert("No hay modelos seleccionados para enviar.");
                }
             //   GuardarCat.setPressed(false);
    }
      public void verdetalletraspaso(final String idmarca,final String idestilos,final String idkardex) {
  final Record[] records;
     final String fechaent = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
      
           records = lista1.cbSelectionModel.getSelections();
          JSONArray productos = new JSONArray();
        JSONObject productoObject;

        JSONObject compraObject = new JSONObject();

        compraObject.put("boleta", new JSONString(idmarca));
        compraObject.put("responsable", new JSONString(idestilos));
        compraObject.put("transporte", new JSONString(idkardex));
        compraObject.put("marca", new JSONString(marca));
           compraObject.put("fecha", new JSONString(fechaent));
       for (int i = 0; i < records.length; i++) {
             productoObject = new JSONObject();
    //         String[] nombreCaso52Columns = {"idmodelo", "codigo", "material","cliente", "totalcajas","precio","preciounitario","talla","5", "5m", "6", "6m", "7", "7m", "8", "8m", "9", "9m", "10", "10m", "11", "11m", "12",  "totalpares","totalparescaja",  "totalparesbs"};
     // if (opcion.equalsIgnoreCase("4")) {
      //            productoObject = new JSONObject();
                    productoObject.put("idmodelo", new JSONString(records[i].getAsString("idmodelo")));
                productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
               productoObject.put("material", new JSONString(records[i].getAsString("material")));
                productoObject.put("cliente", new JSONString(records[i].getAsString("cliente")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                productoObject.put("preciounitario", new JSONString(records[i].getAsString("preciounitario")));
                productoObject.put("talla", new JSONString(records[i].getAsString("talla")));

                productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                productoObject.put("totalparescaja", new JSONString(records[i].getAsString("totalparescaja")));
                productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                   productoObject.put("totalparesbs", new JSONString(records[i].getAsString("totalparesbs")));
                productos.set(i, productoObject);
                productoObject = null;

   //                                 }

     
   //  productos.set(i, productoObject);
    // productoObject = null;

        }
    //fin opciones
        JSONObject resultado = new JSONObject();
        resultado.put("detalle", compraObject);
        resultado.put("productos", productos);
        String datos = "resultado=" + resultado.toString();
        Utils.setErrorPrincipal("generando", "cargar");
        String url;
     //   url = "funcion=imprimirmodeloestilotalladetalle&" + datos;
        url = "funcion=imprimirmodeloestilotalladetalletraspaso&" + datos;
        verReporteTraspaso(url);
    }
 public void reabrirpanel(EventObject e,String marca,String estilo,String kardex) {


    }
public void registrartraspaso() {


    }
   
           private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }

           private void verReporteTraspaso(String enlace) {
//        ReporteTraspaso print = new ReporteTraspaso(enlace,PanelCrearCaja.this);
  //      print.show();
    }
   
}

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
import com.gwtext.client.widgets.layout.HorizontalLayout;
import com.gwtext.client.widgets.layout.TableLayout;
import com.gwtext.client.widgets.layout.TableLayoutData;

import java.util.Date;
import org.balderrama.client.emergentes.SeleccionMarcaEstilo;

import org.balderrama.client.util.Conector;
import org.balderrama.client.marca.Marca;
import org.balderrama.client.util.KMenu;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.Utils;
//import org.balderrama.client.util.Validacion;

public class PanelPedidoConfirmado1 extends Panel {

    private SeleccionMarcaEstilo SM;
    //private Panel panel;
    private String COMPRA_DIRECTA_TABBED = "977700_venta-";
    private TextField tex_marca;
    //private ComboBox com_modeloCV;
    private TextField tex_numeropedido;
    private TextField tex_numeroproforma;
    // private TextField tex_modeloCP;
    private TextField tex_totalpares;
    private TextField tex_totalbs;
    private TextField tex_preciototal;
    private DateField dat_fecha;
    //private ListaPedidoCalzados lista;
    private ListaCalzadoPedidoConfirmado lista1;
    boolean respuesta = false;
    private TextArea tea_descripcion;
    private Button but_aceptar;
     private Button but_aceptar2;
    private Button but_aceptarR;
 private Button but_imprimir;
    private Button but_cancelar;
    private Button but_cancelar2;
    private Button but_limpiar;
    public KMenu kmenu;
    String selecionado = "";
    String marca;
    String idmarca;
    String idestilo;
    String estilo;
    String opcion;
        String totalpares;
    String totalbs;

    String opcionnueva;
    String fecha;
    String tipoestilonino;
     Object[][] colorM;

    public PanelPedidoConfirmado1(String idmarca, String marca, String idestilo, String estilo, String opcionestilo,String opcion, Object[][] materialM,String totalparess,String totalbss, SeleccionMarcaEstilo pedido1,KMenu kmenu) {
        this.SM = pedido1;
           this.kmenu = kmenu;
        this.marca = marca;
        this.idmarca = idmarca;
        this.marca = marca;
        this.idestilo = idestilo;
        this.estilo = estilo;
        this.colorM = materialM;
         this.totalpares = totalparess;
         this.totalbs = totalbss;
this.tipoestilonino= opcionestilo;
         this.opcion = opcion;

        onModuleLoad();
    }

    public void onModuleLoad() {
        //panel = new Panel();
        setId("tab-" + COMPRA_DIRECTA_TABBED);
        setTitle("Consulta Estilos");
        setLayout(new FitLayout());
        setBaseCls("x-plain");
        this.setClosable(true);
        this.setId("TPfun5025");
        setIconCls("tab-icon");
 //MessageBox.alert(totalbs);
        Panel pan_borderLayout = new Panel();
        pan_borderLayout.setLayout(new BorderLayout());
        pan_borderLayout.setBaseCls("x-plain");

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
        if (opcion.equalsIgnoreCase("2")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad9(idmarca, idestilo);
            this.opcionnueva = "1";
        }
        if (opcion.equalsIgnoreCase("3")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad4(idmarca, idestilo);
            this.opcionnueva = "2";
        }
 if (opcion.equalsIgnoreCase("31")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad41(idmarca, idestilo);
            this.opcionnueva = "21";
        }
        if (opcion.equalsIgnoreCase("4") && idestilo.equalsIgnoreCase("est-19")) {
            //lista1 = new ListaCalzadoPedido(PanelPedidoE.this, opcion,colorM,materialM);
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad1(idmarca, idestilo);
            this.opcionnueva = "3";
        //pan_centro = lista1.getPanel();
        }
        if (opcion.equalsIgnoreCase("4") && idestilo.equalsIgnoreCase("est-21")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad3(idmarca, idestilo);
            this.opcionnueva = "5";

        //pan_centro = lista1.getPanel();
        }
        if (opcion.equalsIgnoreCase("4") && idestilo.equalsIgnoreCase("est-20")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad2(idmarca, idestilo);
            this.opcionnueva = "4";

        //pan_centro = lista1.getPanel();
        }
        if (opcion.equalsIgnoreCase("14") && idestilo.equalsIgnoreCase("est-56")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad1011(idmarca, idestilo);
            this.opcionnueva = "6";
        }
        if (opcion.equalsIgnoreCase("14") && idestilo.equalsIgnoreCase("est-58")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad1022(idmarca, idestilo);
            this.opcionnueva = "7";
        }

        if (opcion.equalsIgnoreCase("14") && tipoestilonino.equalsIgnoreCase("nino")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad1033(idmarca, idestilo);
            this.opcionnueva = "8";
        }
//         if (opcion.equalsIgnoreCase("14") && idestilo.equalsIgnoreCase("est-64")) {
//            lista1 = new ListaCalzadoPedidoConfirmado();
//            lista1.onModuleLoad1033(idmarca, idestilo);
//            this.opcionnueva = "8";
//        }

        if (opcion.equalsIgnoreCase("15") && tipoestilonino.equalsIgnoreCase("nino")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad103(idmarca, idestilo);
            this.opcionnueva = "11";
        }
//        if (opcion.equalsIgnoreCase("15") && idestilo.equalsIgnoreCase("est-61")) {
//            lista1 = new ListaCalzadoPedidoConfirmado();
//            lista1.onModuleLoad103(idmarca, idestilo);
//            this.opcionnueva = "11";
//        }

        //
        if (opcion.equalsIgnoreCase("14") && idestilo.equalsIgnoreCase("est-62")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad1011(idmarca, idestilo);
            this.opcionnueva = "6";
        }
        if (opcion.equalsIgnoreCase("14") && idestilo.equalsIgnoreCase("est-63")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad1022(idmarca, idestilo);
            this.opcionnueva = "7";
        }
        

        //opcion 15
        if (opcion.equalsIgnoreCase("15") && idestilo.equalsIgnoreCase("est-52")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad101(idmarca, idestilo);
            this.opcionnueva = "9";
        }
        if (opcion.equalsIgnoreCase("15") && idestilo.equalsIgnoreCase("est-53")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad102(idmarca, idestilo);
            this.opcionnueva = "10";
        }
        if (opcion.equalsIgnoreCase("15") && idestilo.equalsIgnoreCase("est-59")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad102(idmarca, idestilo);
            this.opcionnueva = "10";
        }
        if (opcion.equalsIgnoreCase("15") && idestilo.equalsIgnoreCase("est-77")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad102(idmarca, idestilo);
            this.opcionnueva = "10";
        }
        if (opcion.equalsIgnoreCase("15") && idestilo.equalsIgnoreCase("est-78")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad102(idmarca, idestilo);
            this.opcionnueva = "10";
        }
        
        
        if (opcion.equalsIgnoreCase("6")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad5(idmarca, idestilo,colorM);
            this.opcionnueva = "12";
        //Panel pan_centro = lista1.getPanel();
        }
        if (opcion.equalsIgnoreCase("7")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad6(idmarca, idestilo);
            this.opcionnueva = "13";
        }
        if (opcion.equalsIgnoreCase("9")) {
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad7(idmarca, idestilo);
            this.opcionnueva = "14";
        }
        if (opcion.equalsIgnoreCase("10")) {
            //lista1 = new ListaCalzadoPedido(PanelPedidoE.this, opcion,colorM,materialM);
            lista1 = new ListaCalzadoPedidoConfirmado();
            lista1.onModuleLoad10(idmarca, idestilo,colorM);
            this.opcionnueva = "15";
        }

        Panel pan_centro = lista1.getPanel();

        FormPanel for_panel1 = new FormPanel();
        for_panel1.setBaseCls("x-plain");
        for_panel1.setWidth(330);
        for_panel1.setLabelWidth(100);
        tex_marca = new TextField("Marca", "marca", 200);
        tex_marca.setValue(marca);
        tex_marca.setReadOnly(true);
               tex_numeropedido = new TextField("Estilo", "estilo", 200);
        tex_numeropedido.setReadOnly(true);
        tex_numeropedido.setValue(estilo);


        for_panel1.add(tex_marca);
        for_panel1.add(tex_numeropedido);

        // for_panel1.add(tex_modeloCP);

        FormPanel for_panel2 = new FormPanel();
        for_panel2.setBaseCls("x-plain");
        for_panel2.setWidth(330);
        for_panel2.setLabelWidth(100);
        tex_totalpares = new TextField("Total Pares", "totalpares", 200);
        tex_totalpares.setReadOnly(true);
        tex_totalpares.setValue(totalpares);
 
    tex_totalbs = new TextField("Total Bs", "totalbs", 200);
        tex_totalbs.setReadOnly(true);
        tex_totalbs.setValue(totalbs);
        but_aceptar = new Button("Guardar");
        but_cancelar = new Button("Cancelar");
         but_aceptar2 = new Button("Guardar");
        but_cancelar2 = new Button("Cancelar");
  Panel pan_botonescliente = new Panel();
        pan_botonescliente.setLayout(new HorizontalLayout(2));
        pan_botonescliente.setBaseCls("x-plain");

        pan_botonescliente.add(but_aceptar2);
        pan_botonescliente.add(but_cancelar2);
     for_panel2.add(tex_totalpares);
       for_panel2.add(tex_totalbs);
 for_panel2.add(new PaddedPanel(pan_botonescliente, 5, 5, 5, 5), new TableLayoutData(3));

        FormPanel for_panel3 = new FormPanel();
        for_panel3.setBaseCls("x-plain");
        for_panel3.setWidth(300);
        for_panel3.setLabelWidth(100);

        dat_fecha = new DateField("Fecha", "d-m-Y");
        Date date = new Date();
        dat_fecha.setValue(Utils.getStringOfDate(date));
        // dat_fecha.setValue(fecha);
        for_panel3.add(dat_fecha);



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
but_imprimir = new Button("Imprimir Lista");
        pan_botones.add(but_imprimir);
        //but_verproducto = new Button("Ver Producto");
        pan_botones.add(but_aceptar);
        pan_botones.add(but_cancelar);
        pan_botones.add(but_aceptarR);

        pan_sud.add(new PaddedPanel(pan_botones, 10, 200, 10, 10), new TableLayoutData(3));


        pan_borderLayout.add(pan_norte, new BorderLayoutData(RegionPosition.NORTH));
        pan_borderLayout.add(pan_centro, new BorderLayoutData(RegionPosition.CENTER));
        pan_borderLayout.add(pan_sud, new BorderLayoutData(RegionPosition.SOUTH));
        add(pan_borderLayout);

        //initCombos();
        //  initValues();
        addListeners();


    }

    private void addListeners() {
        
but_imprimir.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
               // imprimirCompra("mismo");
            }
        });
        //**************************************************
        //************* BOTON CANCELAR   *******************
        //**************************************************
        but_cancelar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
      kmenu.seleccionarOpcionRemove(null, "fun5025", e, PanelPedidoConfirmado1.this);

  abrirpanelreporte();
            }
        });
          but_cancelar2.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
      kmenu.seleccionarOpcionRemove(null, "fun5025", e, PanelPedidoConfirmado1.this);

  abrirpanelreporte();
            }
        });
        //**************************************************
        //************* BOTON ACEPTAR *******************
        //**************************************************
         but_aceptar.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                createPedido(idmarca,idestilo);
            }
        });
          but_aceptar2.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                createPedido(idmarca,idestilo);
            }
        });
    but_aceptarR.addListener(new ButtonListenerAdapter() {

            @Override

            public void onClick(Button button, EventObject e) {
           //      String idmarca = com_marca.getValue();
        //String idestilo = com_estilo.getValue();

                    String enlace = "funcion=verIngresosMarcaEstiloHTML&idmarca=" + idmarca + "&idestilo="+idestilo;
               verReporte(enlace);

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
        Float talla1m = record.getAsFloat("01");
        Float talla2 = record.getAsFloat("02");
        Float talla2m = record.getAsFloat("20");
        Float talla3 = record.getAsFloat("03");
        Float talla3m = record.getAsFloat("30");
        Float talla4 = record.getAsFloat("04");
        Float talla4m = record.getAsFloat("40");
        Float talla5 = record.getAsFloat("05");
        Float talla5m = record.getAsFloat("50");
        Float talla6 = record.getAsFloat("06");
        Float talla6m = record.getAsFloat("60");
        Float talla7 = record.getAsFloat("07");
        Float talla7m = record.getAsFloat("70");
        Float talla8 = record.getAsFloat("08");
        Float talla8m = record.getAsFloat("80");
        Float talla9 = record.getAsFloat("09");
        Float talla9m = record.getAsFloat("90");
        Float talla10 = record.getAsFloat("10");
        Float talla10m = record.getAsFloat("100");
        Float talla11 = record.getAsFloat("11");
        Float talla11m = record.getAsFloat("110");
        Float talla12 = record.getAsFloat("12");
        Float talla12m = record.getAsFloat("120");
        Float talla13 = record.getAsFloat("13");
Float talla13m = record.getAsFloat("130");
        Float totalca = new Float(0);
        Float totalpa = new Float(0);

        Float ne = old;
        try {
            ne = new Float(temp);
        } catch (Exception e) {
            com.google.gwt.user.client.Window.alert("atapadp  " + e.getMessage());
            ne = old;
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
      if ((opcionnueva.equalsIgnoreCase("4")) || (opcionnueva.equalsIgnoreCase("7")) || (opcionnueva.equalsIgnoreCase("10"))) {

            record.commit();
            record.set("totalpares", talla5 + talla5m + talla6 + talla6m + talla7 + talla7m + talla8 + talla8m + talla9 + talla9m + talla10);
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
       String enlace = "php/IngresoAlmacen.php?funcion=BuscarMarcaEstilo";
                //String enlace = "php/Marca.php?funcion=BuscarMarca";
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

//                                        Object[][] tiendaM = Utils.getArrayOfJSONObject(marcaO, "tiendaM", new String[]{"idtienda", "nombre"});
                                        Object[][] marcaM = Utils.getArrayOfJSONObject(marcaO, "marcaM", new String[]{"idmarca", "nombre"});
          //Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "estiloM", new String[]{"idestilo", "nombre"});
        Object[][] estiloM = Utils.getArrayOfJSONObject(marcaO, "estiloM", new String[]{"idestilo", "idmarca","nombre"});
                                        SM = new SeleccionMarcaEstilo(marcaM,estiloM ,kmenu);
                                        SM.show();


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
    public void createPedido(final String idmarca,String idestilos) {
        final String idesti = idestilos;
        Record[] records = lista1.getStore().getModifiedRecords();
   JSONArray productos = new JSONArray();
        JSONObject productoObject;
        JSONObject compraObject = new JSONObject();
        compraObject.put("idmarca", new JSONString(idmarca));
        for (int i = 0; i < records.length; i++) {
             if (opcionnueva.equalsIgnoreCase("13")) {

                   // MessageBox.alert("entro For Lista"+records[i].getAsString("iddetalleingreso"));
                                        productoObject = new JSONObject();
                   productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                       productoObject.put("coleccion", new JSONString(records[i].getAsString("coleccion")));

                                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                                        productoObject.put("material", new JSONString(records[i].getAsString("material")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));

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
                                        productoObject.put("43", new JSONString(records[i].getAsString("43")));
                                        productoObject.put("44", new JSONString(records[i].getAsString("44")));
                                        productoObject.put("45", new JSONString(records[i].getAsString("45")));

//                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
//                productoObject.put("totalbs", new JSONString(records[i].getAsString("totalbs")));
                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
                                    }

                             if (opcionnueva.equalsIgnoreCase("1")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
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

                                        productoObject.put("43", new JSONString(records[i].getAsString("43")));
                                        productoObject.put("44", new JSONString(records[i].getAsString("44")));
                                        productoObject.put("45", new JSONString(records[i].getAsString("45")));
                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
                                    }
                                    if (opcionnueva.equalsIgnoreCase("2")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                         productoObject.put("linea", new JSONString(records[i].getAsString("linea")));
                                         productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));

                                        productoObject.put("color", new JSONString(records[i].getAsString("color")));
  productoObject.put("opciont", new JSONString(records[i].getAsString("opciont")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));

                                        productoObject.put("14", new JSONString(records[i].getAsString("14")));
                                        productoObject.put("15", new JSONString(records[i].getAsString("15")));
                                        productoObject.put("16", new JSONString(records[i].getAsString("16")));
                                        productoObject.put("17", new JSONString(records[i].getAsString("17")));
                                        productoObject.put("18", new JSONString(records[i].getAsString("18")));
                                        productoObject.put("19", new JSONString(records[i].getAsString("19")));
                                        productoObject.put("20", new JSONString(records[i].getAsString("20")));
                                        productoObject.put("21", new JSONString(records[i].getAsString("21")));
                                        productoObject.put("22", new JSONString(records[i].getAsString("22")));
                                        productoObject.put("23", new JSONString(records[i].getAsString("23")));
                                        productoObject.put("24", new JSONString(records[i].getAsString("24")));
                                        productoObject.put("25", new JSONString(records[i].getAsString("25")));
                                        productoObject.put("26", new JSONString(records[i].getAsString("26")));
                                        productoObject.put("27", new JSONString(records[i].getAsString("27")));
                                        productoObject.put("28", new JSONString(records[i].getAsString("28")));
                                        productoObject.put("29", new JSONString(records[i].getAsString("29")));
                                        productoObject.put("30", new JSONString(records[i].getAsString("30")));
                                        productoObject.put("31", new JSONString(records[i].getAsString("31")));
                                        productoObject.put("32", new JSONString(records[i].getAsString("32")));
                                        productoObject.put("33", new JSONString(records[i].getAsString("33")));
                                        productoObject.put("34", new JSONString(records[i].getAsString("34")));
                                        productoObject.put("35", new JSONString(records[i].getAsString("35")));
                                        productoObject.put("36", new JSONString(records[i].getAsString("36")));
                                        productoObject.put("37", new JSONString(records[i].getAsString("37")));
                                        productoObject.put("38", new JSONString(records[i].getAsString("38")));

                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
                                    }
              if (opcionnueva.equalsIgnoreCase("21")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                               //          productoObject.put("linea", new JSONString(records[i].getAsString("linea")));
                                         productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));

                                        productoObject.put("color", new JSONString(records[i].getAsString("color")));
  //productoObject.put("opciont", new JSONString(records[i].getAsString("opciont")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));

                                        productoObject.put("14", new JSONString(records[i].getAsString("14")));
                                        productoObject.put("15", new JSONString(records[i].getAsString("15")));
                                        productoObject.put("16", new JSONString(records[i].getAsString("16")));
                                        productoObject.put("17", new JSONString(records[i].getAsString("17")));
                                        productoObject.put("18", new JSONString(records[i].getAsString("18")));
                                        productoObject.put("19", new JSONString(records[i].getAsString("19")));
                                        productoObject.put("20", new JSONString(records[i].getAsString("20")));
                                        productoObject.put("21", new JSONString(records[i].getAsString("21")));
                                        productoObject.put("22", new JSONString(records[i].getAsString("22")));
                                        productoObject.put("23", new JSONString(records[i].getAsString("23")));
                                        productoObject.put("24", new JSONString(records[i].getAsString("24")));
                                        productoObject.put("25", new JSONString(records[i].getAsString("25")));
                                        productoObject.put("26", new JSONString(records[i].getAsString("26")));
                                        productoObject.put("27", new JSONString(records[i].getAsString("27")));
                                        productoObject.put("28", new JSONString(records[i].getAsString("28")));
                                        productoObject.put("29", new JSONString(records[i].getAsString("29")));
                                        productoObject.put("30", new JSONString(records[i].getAsString("30")));
                                        productoObject.put("31", new JSONString(records[i].getAsString("31")));
                                        productoObject.put("32", new JSONString(records[i].getAsString("32")));
                                        productoObject.put("33", new JSONString(records[i].getAsString("33")));
                                        productoObject.put("34", new JSONString(records[i].getAsString("34")));
                                        productoObject.put("35", new JSONString(records[i].getAsString("35")));
                                        productoObject.put("36", new JSONString(records[i].getAsString("36")));
                                        productoObject.put("37", new JSONString(records[i].getAsString("37")));
                                        productoObject.put("38", new JSONString(records[i].getAsString("38")));

                                        productoObject.put("39", new JSONString(records[i].getAsString("39")));
                                        productoObject.put("40", new JSONString(records[i].getAsString("40")));

                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
                                    }
                                    if (opcionnueva.equalsIgnoreCase("14")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
  
                                        productoObject.put("color", new JSONString(records[i].getAsString("color")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));

                                        productoObject.put("14", new JSONString(records[i].getAsString("14")));
                                        productoObject.put("15", new JSONString(records[i].getAsString("15")));
                                        productoObject.put("16", new JSONString(records[i].getAsString("16")));
                                        productoObject.put("17", new JSONString(records[i].getAsString("17")));
                                        productoObject.put("18", new JSONString(records[i].getAsString("18")));
                                        productoObject.put("19", new JSONString(records[i].getAsString("19")));
                                        productoObject.put("20", new JSONString(records[i].getAsString("20")));
                                        productoObject.put("21", new JSONString(records[i].getAsString("21")));
                                        productoObject.put("22", new JSONString(records[i].getAsString("22")));
                                        productoObject.put("23", new JSONString(records[i].getAsString("23")));
                                        productoObject.put("24", new JSONString(records[i].getAsString("24")));
                                        productoObject.put("25", new JSONString(records[i].getAsString("25")));
                                        productoObject.put("26", new JSONString(records[i].getAsString("26")));
                                        productoObject.put("27", new JSONString(records[i].getAsString("27")));
                                        productoObject.put("28", new JSONString(records[i].getAsString("28")));
                                        productoObject.put("29", new JSONString(records[i].getAsString("29")));
                                        productoObject.put("30", new JSONString(records[i].getAsString("30")));
                                        productoObject.put("31", new JSONString(records[i].getAsString("31")));
                                        productoObject.put("32", new JSONString(records[i].getAsString("32")));
                                        productoObject.put("33", new JSONString(records[i].getAsString("33")));
                                        productoObject.put("34", new JSONString(records[i].getAsString("34")));
                                        productoObject.put("35", new JSONString(records[i].getAsString("35")));
                                        productoObject.put("36", new JSONString(records[i].getAsString("36")));
                                        productoObject.put("37", new JSONString(records[i].getAsString("37")));
                                        productoObject.put("38", new JSONString(records[i].getAsString("38")));


//                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
//                productoObject.put("totalbs", new JSONString(records[i].getAsString("totalbs")));
                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
                                    }
                                    if (opcionnueva.equalsIgnoreCase("15")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));

                                        productoObject.put("color", new JSONString(records[i].getAsString("color")));
                                        //   productoObject.put("material", new JSONString(records[i].getAsString("material")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                                        productoObject.put("30", new JSONString(records[i].getAsString("30")));
                                        productoObject.put("31", new JSONString(records[i].getAsString("31")));

                                        productoObject.put("32", new JSONString(records[i].getAsString("32")));
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
                                        productoObject.put("43", new JSONString(records[i].getAsString("43")));
                                        productoObject.put("44", new JSONString(records[i].getAsString("44")));
                                        productoObject.put("45", new JSONString(records[i].getAsString("45")));
                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
                                    }
                                    if (opcionnueva.equalsIgnoreCase("16")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                       productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));

                                        productoObject.put("color", new JSONString(records[i].getAsString("color")));
                                        productoObject.put("material", new JSONString(records[i].getAsString("material")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                                        productoObject.put("37", new JSONString(records[i].getAsString("37")));
                                        productoObject.put("38", new JSONString(records[i].getAsString("38")));

                                        productoObject.put("39", new JSONString(records[i].getAsString("39")));
                                        productoObject.put("40", new JSONString(records[i].getAsString("40")));
                                        productoObject.put("41", new JSONString(records[i].getAsString("41")));
                                        productoObject.put("42", new JSONString(records[i].getAsString("42")));
                                        productoObject.put("43", new JSONString(records[i].getAsString("43")));
                                        productoObject.put("44", new JSONString(records[i].getAsString("44")));
                                        productoObject.put("45", new JSONString(records[i].getAsString("45")));

//                productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
//                productoObject.put("totalbs", new JSONString(records[i].getAsString("totalbs")));
                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
                                    }
                                    if (opcionnueva.equalsIgnoreCase("6")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                                        productoObject.put("6m", new JSONString(records[i].getAsString("60")));
                                        productoObject.put("7", new JSONString(records[i].getAsString("07")));
                                        productoObject.put("7m", new JSONString(records[i].getAsString("70")));
                                        productoObject.put("8", new JSONString(records[i].getAsString("08")));
                                        productoObject.put("8m", new JSONString(records[i].getAsString("80")));
                                        productoObject.put("9", new JSONString(records[i].getAsString("09")));
                                        productoObject.put("9m", new JSONString(records[i].getAsString("90")));
                                        productoObject.put("10", new JSONString(records[i].getAsString("10")));
                                        productoObject.put("10m", new JSONString(records[i].getAsString("100")));
                                        productoObject.put("11", new JSONString(records[i].getAsString("11")));
                                        productoObject.put("11m", new JSONString(records[i].getAsString("110")));
                                        productoObject.put("12", new JSONString(records[i].getAsString("12")));

                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
                                    }
                                    if (opcionnueva.equalsIgnoreCase("7")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                                        productoObject.put("5", new JSONString(records[i].getAsString("05")));
                                        productoObject.put("5m", new JSONString(records[i].getAsString("50")));
                                        productoObject.put("6", new JSONString(records[i].getAsString("06")));
                                        productoObject.put("6m", new JSONString(records[i].getAsString("60")));
                                        productoObject.put("7", new JSONString(records[i].getAsString("07")));
                                        productoObject.put("7m", new JSONString(records[i].getAsString("70")));
                                        productoObject.put("8", new JSONString(records[i].getAsString("08")));
                                        productoObject.put("8m", new JSONString(records[i].getAsString("80")));
                                        productoObject.put("9", new JSONString(records[i].getAsString("09")));
                                        productoObject.put("9m", new JSONString(records[i].getAsString("90")));
                                        productoObject.put("10", new JSONString(records[i].getAsString("10")));
                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
                                    }
                                    if (opcionnueva.equalsIgnoreCase("10")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));

                                        productoObject.put("color", new JSONString(records[i].getAsString("color")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                                        productoObject.put("5", new JSONString(records[i].getAsString("05")));
                                        productoObject.put("5m", new JSONString(records[i].getAsString("50")));
                                        productoObject.put("6", new JSONString(records[i].getAsString("06")));
                                        productoObject.put("6m", new JSONString(records[i].getAsString("60")));
                                        productoObject.put("7", new JSONString(records[i].getAsString("07")));
                                        productoObject.put("7m", new JSONString(records[i].getAsString("70")));
                                        productoObject.put("8", new JSONString(records[i].getAsString("08")));
                                        productoObject.put("8m", new JSONString(records[i].getAsString("80")));
                                        productoObject.put("9", new JSONString(records[i].getAsString("09")));
                                        productoObject.put("9m", new JSONString(records[i].getAsString("90")));
                                        productoObject.put("10", new JSONString(records[i].getAsString("10")));
                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
                                    }
                                    if (opcionnueva.equalsIgnoreCase("11")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));

                                        productoObject.put("color", new JSONString(records[i].getAsString("color")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                                        productoObject.put("1", new JSONString(records[i].getAsString("1")));
                                        productoObject.put("1m", new JSONString(records[i].getAsString("01")));
                                        productoObject.put("2", new JSONString(records[i].getAsString("02")));
                                        productoObject.put("2m", new JSONString(records[i].getAsString("20")));
                                        productoObject.put("3", new JSONString(records[i].getAsString("03")));

                                        productoObject.put("3m", new JSONString(records[i].getAsString("30")));
                                        productoObject.put("4", new JSONString(records[i].getAsString("04")));
                                        productoObject.put("4m", new JSONString(records[i].getAsString("40")));
                                        productoObject.put("5", new JSONString(records[i].getAsString("05")));
                                        productoObject.put("5m", new JSONString(records[i].getAsString("50")));
                                        productoObject.put("6", new JSONString(records[i].getAsString("06")));
                                        productoObject.put("6m", new JSONString(records[i].getAsString("60")));
                                        productoObject.put("7", new JSONString(records[i].getAsString("07")));
                                        productoObject.put("7m", new JSONString(records[i].getAsString("70")));
                                        productoObject.put("8", new JSONString(records[i].getAsString("08")));
                                        productoObject.put("8m", new JSONString(records[i].getAsString("80")));
                                        productoObject.put("9", new JSONString(records[i].getAsString("09")));
                                        productoObject.put("9m", new JSONString(records[i].getAsString("90")));
                                        productoObject.put("10", new JSONString(records[i].getAsString("10")));
                                        productoObject.put("10m", new JSONString(records[i].getAsString("100")));
                                        productoObject.put("11", new JSONString(records[i].getAsString("11")));
                                        productoObject.put("11m", new JSONString(records[i].getAsString("110")));
                                        productoObject.put("12", new JSONString(records[i].getAsString("12")));
                                        productoObject.put("12m", new JSONString(records[i].getAsString("120")));
                                        productoObject.put("13", new JSONString(records[i].getAsString("13")));
                                        productoObject.put("13m", new JSONString(records[i].getAsString("130")));
                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
                                    }

                                    if (opcionnueva.equalsIgnoreCase("9")) {
                                    //     Window.alert("hooola");
                                    //       MessageBox.alert("entro For Lista"+records[i].getAsString("iddetalleingreso"));

                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                                        productoObject.put("color", new JSONString(records[i].getAsString("color")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                                        productoObject.put("6", new JSONString(records[i].getAsString("06")));

                                        productoObject.put("6m", new JSONString(records[i].getAsString("60")));
                                        productoObject.put("7", new JSONString(records[i].getAsString("07")));
                                        productoObject.put("7m", new JSONString(records[i].getAsString("70")));
                                        productoObject.put("8", new JSONString(records[i].getAsString("08")));
                                        productoObject.put("8m", new JSONString(records[i].getAsString("80")));
                                        productoObject.put("9", new JSONString(records[i].getAsString("09")));
                                        productoObject.put("9m", new JSONString(records[i].getAsString("90")));
                                        productoObject.put("10", new JSONString(records[i].getAsString("10")));
                                        productoObject.put("10m", new JSONString(records[i].getAsString("100")));
                                        productoObject.put("11", new JSONString(records[i].getAsString("11")));
                                        productoObject.put("11m", new JSONString(records[i].getAsString("110")));
                                        productoObject.put("12", new JSONString(records[i].getAsString("12")));

                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                                        productos.set(i, productoObject);
                                        productoObject = null;

                                    }
                                    if (opcionnueva.equalsIgnoreCase("8")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                        // productoObject.put("color", new JSONString(records[i].getAsString("color")));
                                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));

                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                                        productoObject.put("1", new JSONString(records[i].getAsString("1")));
                                        productoObject.put("1m", new JSONString(records[i].getAsString("01")));
                                        productoObject.put("2", new JSONString(records[i].getAsString("02")));
                                        productoObject.put("2m", new JSONString(records[i].getAsString("20")));
                                        productoObject.put("3", new JSONString(records[i].getAsString("03")));
                                        productoObject.put("3m", new JSONString(records[i].getAsString("30")));
                                        productoObject.put("4", new JSONString(records[i].getAsString("04")));
                                        productoObject.put("4m", new JSONString(records[i].getAsString("40")));
                                        productoObject.put("5", new JSONString(records[i].getAsString("05")));
                                        productoObject.put("5m", new JSONString(records[i].getAsString("50")));
                                        productoObject.put("6", new JSONString(records[i].getAsString("06")));
                                        productoObject.put("6m", new JSONString(records[i].getAsString("60")));
                                        productoObject.put("7", new JSONString(records[i].getAsString("07")));
                                        productoObject.put("7m", new JSONString(records[i].getAsString("70")));
                                        productoObject.put("8", new JSONString(records[i].getAsString("08")));
                                        productoObject.put("8m", new JSONString(records[i].getAsString("80")));
                                        productoObject.put("9", new JSONString(records[i].getAsString("09")));
                                        productoObject.put("9m", new JSONString(records[i].getAsString("90")));
                                        productoObject.put("10", new JSONString(records[i].getAsString("10")));
                                        productoObject.put("10m", new JSONString(records[i].getAsString("100")));
                                        productoObject.put("11", new JSONString(records[i].getAsString("11")));
                                        productoObject.put("11m", new JSONString(records[i].getAsString("110")));
                                        productoObject.put("12", new JSONString(records[i].getAsString("12")));
                                        productoObject.put("12m", new JSONString(records[i].getAsString("120")));
                                        productoObject.put("13", new JSONString(records[i].getAsString("13")));
                                        productoObject.put("13m", new JSONString(records[i].getAsString("130")));
                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
                                    }

                                    if (opcionnueva.equalsIgnoreCase("3")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                                        productoObject.put("color", new JSONString(records[i].getAsString("color")));
                                        productoObject.put("material", new JSONString(records[i].getAsString("material")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                                        productoObject.put("6", new JSONString(records[i].getAsString("06")));
                                        productoObject.put("6m", new JSONString(records[i].getAsString("60")));
                                        productoObject.put("7", new JSONString(records[i].getAsString("07")));
                                        productoObject.put("7m", new JSONString(records[i].getAsString("70")));
                                        productoObject.put("8", new JSONString(records[i].getAsString("08")));
                                        productoObject.put("8m", new JSONString(records[i].getAsString("80")));
                                        productoObject.put("9", new JSONString(records[i].getAsString("09")));
                                        productoObject.put("9m", new JSONString(records[i].getAsString("90")));
                                        productoObject.put("10", new JSONString(records[i].getAsString("10")));
                                        productoObject.put("10m", new JSONString(records[i].getAsString("100")));
                                        productoObject.put("11", new JSONString(records[i].getAsString("11")));
                                        productoObject.put("11m", new JSONString(records[i].getAsString("110")));
                                        productoObject.put("12", new JSONString(records[i].getAsString("12")));

                                        productoObject.put("12m", new JSONString(records[i].getAsString("120")));
                                        productoObject.put("13", new JSONString(records[i].getAsString("13")));

                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
                                    }

                                    if (opcionnueva.equalsIgnoreCase("4")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                                        productoObject.put("color", new JSONString(records[i].getAsString("color")));
                                        productoObject.put("material", new JSONString(records[i].getAsString("material")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                                        productoObject.put("5", new JSONString(records[i].getAsString("05")));
                                        productoObject.put("5m", new JSONString(records[i].getAsString("50")));
                                        productoObject.put("6", new JSONString(records[i].getAsString("06")));
                                        productoObject.put("6m", new JSONString(records[i].getAsString("60")));
                                        productoObject.put("7", new JSONString(records[i].getAsString("07")));
                                        productoObject.put("7m", new JSONString(records[i].getAsString("70")));
                                        productoObject.put("8", new JSONString(records[i].getAsString("08")));
                                        productoObject.put("8m", new JSONString(records[i].getAsString("80")));
                                        productoObject.put("9", new JSONString(records[i].getAsString("09")));
                                        productoObject.put("9m", new JSONString(records[i].getAsString("90")));
                                        productoObject.put("10", new JSONString(records[i].getAsString("10")));
                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
                                    }

                                    if (opcionnueva.equalsIgnoreCase("5")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                                        productoObject.put("color", new JSONString(records[i].getAsString("color")));
                                        productoObject.put("material", new JSONString(records[i].getAsString("material")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
                                         productoObject.put("1", new JSONString(records[i].getAsString("1")));
                                        productoObject.put("1m", new JSONString(records[i].getAsString("01")));
                                        productoObject.put("2", new JSONString(records[i].getAsString("02")));
                                        productoObject.put("2m", new JSONString(records[i].getAsString("20")));
                                        productoObject.put("3", new JSONString(records[i].getAsString("03")));
                                        productoObject.put("3m", new JSONString(records[i].getAsString("30")));
                                        productoObject.put("4", new JSONString(records[i].getAsString("04")));
                                        productoObject.put("4m", new JSONString(records[i].getAsString("40")));
                                        productoObject.put("5", new JSONString(records[i].getAsString("05")));
                                        productoObject.put("5m", new JSONString(records[i].getAsString("50")));
                                        productoObject.put("6", new JSONString(records[i].getAsString("06")));
                                        productoObject.put("6m", new JSONString(records[i].getAsString("60")));
                                        productoObject.put("7", new JSONString(records[i].getAsString("07")));
                                        productoObject.put("7m", new JSONString(records[i].getAsString("70")));
                                        productoObject.put("8", new JSONString(records[i].getAsString("08")));
                                        productoObject.put("8m", new JSONString(records[i].getAsString("80")));
                                        productoObject.put("9", new JSONString(records[i].getAsString("09")));
                                        productoObject.put("9m", new JSONString(records[i].getAsString("90")));
                                        productoObject.put("10", new JSONString(records[i].getAsString("10")));
                                        productoObject.put("10m", new JSONString(records[i].getAsString("100")));
                                        productoObject.put("11", new JSONString(records[i].getAsString("11")));
                                        productoObject.put("11m", new JSONString(records[i].getAsString("110")));
                                        productoObject.put("12", new JSONString(records[i].getAsString("12")));
                                        productoObject.put("12m", new JSONString(records[i].getAsString("120")));
                                        productoObject.put("13", new JSONString(records[i].getAsString("13")));
                              productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
                                        productos.set(i, productoObject);
                                        productoObject = null;
                                    }
//ramarin inv
                                    if (opcionnueva.equalsIgnoreCase("12")) {
                                        productoObject = new JSONObject();
                                        productoObject.put("iddetalleingreso", new JSONString(records[i].getAsString("iddetalleingreso")));
                                       productoObject.put("coleccion", new JSONString(records[i].getAsString("coleccion")));
                                        productoObject.put("codigo", new JSONString(records[i].getAsString("codigo")));
                                        productoObject.put("color", new JSONString(records[i].getAsString("color")));
                                        productoObject.put("precio", new JSONString(records[i].getAsString("precio")));
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
                                        productoObject.put("43", new JSONString(records[i].getAsString("43")));
                                        productoObject.put("44", new JSONString(records[i].getAsString("44")));
                                        productoObject.put("45", new JSONString(records[i].getAsString("45")));
                                        productoObject.put("totalpares", new JSONString(records[i].getAsString("totalpares")));
                                        productoObject.put("totalcajas", new JSONString(records[i].getAsString("totalcajas")));
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
        String url = "./php/IngresoAlmacen.php?funcion=txNewUpdateDatosDetalleIngreso&" + datos;


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
                           kmenu.seleccionarOpcionRemove(null, "fun5025", e, PanelPedidoConfirmado1.this);

 //String miestilo = tex_numeropedido.getValueAsString().trim();
 //String mimarca = tex_marca.getValueAsString().trim();
reabrirpanel(e,idmarca,idesti);
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
 public void reabrirpanel(EventObject e,String marca,String estilo) {
        this.idmarca= marca;
         this.idestilo = estilo;

    String enlace = "php/IngresoAlmacen.php?funcion=CargarConfirmarIngreso&idmarca=" + idmarca+"&idestilo="+idestilo;

                    //    String enlace = "php/ConfirmarPedido.php?funcion=CargarConfirmarPedido&idpedido=" + idpedido;
                        Utils.setErrorPrincipal("Cargando parametros", "cargar");
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
                                                   // String idp = Utils.getStringOfJSONObject(marcaO, "idpedido");
                                                    String marca = Utils.getStringOfJSONObject(marcaO, "marca");
                                                    String estilo = Utils.getStringOfJSONObject(marcaO, "estilo");
                                                   // String fecha = Utils.getStringOfJSONObject(marcaO, "fecha");
   Object[][] colores = Utils.getArrayOfJSONObject(marcaO, "colorM", new String[]{"idcolor", "codigo"});

                                                    String opcion = Utils.getStringOfJSONObject(marcaO, "opcionb");
   String totalpares = Utils.getStringOfJSONObject(marcaO, "totalpares");
   String totalbs = Utils.getStringOfJSONObject(marcaO, "totalbs");
 String opcionestilo = Utils.getStringOfJSONObject(marcaO, "tipoestilo");
     //PanelPedidoConfirmado pan_compraDirecta = new PanelPedidoConfirmado(Pedido.this, idpedido1,idmarca,fecha,observacion,totalcajas,totalpares,nombre,numeropedido);
 PanelPedidoConfirmado1 pan_compraDirecta = new PanelPedidoConfirmado1(idmarca, marca, idestilo, estilo,opcionestilo,opcion, colores,totalpares,totalbs,SM,kmenu);


//                                                    PanelPedidoConfirmado pan_compraDirecta = new PanelPedidoConfirmado(Pedido.this, idpedido1,idmarca,fecha,observacion,totalcajas,totalpares,nombre,numeropedido);
  kmenu.seleccionarOpcion(null, "fun5025", e, pan_compraDirecta);
    
                                                    Utils.setErrorPrincipal("Se cargaron los parametros Correctamente" + opcion, "mensaje");
                                                } else {
                                                    MessageBox.alert("No Hay datos en la consulta");
                                                }
                                            }
                                            else{
                                            Utils.setErrorPrincipal(mensajeR, "mensaje");
                                            }
                                        } else {
                                        }
                                        throw new UnsupportedOperationException("Not supported yet.");
                                    }

                                    public void onError(Request request, Throwable exception) {
                                        throw new UnsupportedOperationException("Not supported yet.");
                                    }
                                });

                            } catch (RequestException ea) {
                                ea.getMessage();
                                MessageBox.alert("Ocurrio un error al conectarse con el SERVIDOR");
                            }

                        }


    }
    public void closePanel() {
        this.destroy();
    }

           private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
    public void closeTabCompraDirecta() {
        // this.remove("tab-" + COMPRA_DIRECTA_TABBED);
        //SM.panel.getTabPanel().remove("tab-" + COMPRA_DIRECTA_TABBED);
        //SM.pan.getTabPanel().remove("tab-" + COMPRA_DIRECTA_TABBED);
        this.destroy();
    }
}

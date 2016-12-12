/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.emergentes;


import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.util.DateUtil;
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
import org.balderrama.client.MainEntryPoint;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.Field;
import com.gwtext.client.widgets.form.TextField;
import org.balderrama.client.util.ReporteMediaCartaChorroWindow;
import org.balderrama.client.util.KMenu;
import com.gwtext.client.widgets.form.event.TextFieldListenerAdapter;
import java.util.Date;

/**
 *
 * @author 
 */
public class SeleccionInformesCliente extends Window {

    private final int ANCHO = 300;
    private final int ALTO = 90;
    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;
    private FormPanel formPanel;
    private ComboBox com_almacen;
    private ComboBox com_marca;
    private ComboBox com_vendedor;
    private ComboBox com_cliente;
    private Label label = new Label("2");
    private Panel formpanel1;
////    private Button but_ingresos;
////    private Button but_ingresosinventario;
    private Button but_cierre;
    private Button but_rebaja;
    private Button but_resumen;
    private Button but_resumenvendedor;
    private Button but_cambio;
    private Button but_devolucion;
    private Button but_traspaso;
    private Button but_reporte1;
    private Button but_reporte2;
    private Button but_reportecobrosueldo;
    private Button but_reportecobromorosidad;
    private Button but_cancelarP;
    private String almacenC;
    private String tipoC;
    private Object[][] almacenM;
    private Object[][] marcaM;
    private Object[][] vendedorM;
    private Object[][] clienteM;
    boolean respuesta = false;

    public Object[][] estiloM1;
    CheckboxSelectionModel cbSelectionModel;
    private boolean nuevo;

    //para crear un nuevo tab
    public TabPanel tap_panel;
    public KMenu padre;
    public MainEntryPoint panel;
    private TextField tex_mescierre;
    private DateField dat_fechaini;
    private DateField dat_fechafin;
    String mescierre;
    String fechainicio;
    String fechafin;
    
//    subseleccion subselec;
    private Date fechahoy;

    public SeleccionInformesCliente(Object[][] almacen, String mesc, String fechaini, String fechaf, Object[][] marca, Object[][] vendedor, Object[][] cliente, KMenu kmenu) {
        padre = kmenu;
      //  panel=pan;
        almacenM = almacen;
        mescierre = mesc;
        fechainicio = fechaini;
        fechafin = fechaf;
        marcaM = marca;
        vendedorM = vendedor;
        clienteM = cliente;
        //kmenu = menu;
        String tituloTabla = "Reportes Generales - Opcional";
        this.setClosable(true);
        this.setId("TPfun300424");
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

        String nombreBoton0 = "Cierre Cobro";
        String nombreBoton1 = "Por Clientes";
        String nombreBoton2 = "Por Marcas";
        String nombreBoton3 = "Marca-Vendedor";
        String nombreBoton4 = "Ventas";
        //String nombreBoton5 = "Cobros";
        String nombreBoton5 = "Res.Cobro Sueldo";
        //String nombreBoton6 = "Morosos";
        String nombreBoton6 = "Res.Cobro Morosidad";
        String nombreBoton61 = "Res. Informe";
        String nombreBoton611 = "Res.Informe por Vendedor";
        String nombreBoton7 = "Cobro Sueldo";
        String nombreBoton8 = "Cobro Morosidad";
        //String nombreBoton9 = "Trasp Recibidos";
        String nombreBoton10 = "Cancelar";
       // String nombreBoton42 = "Uniones";
        formPanel = new FormPanel();
        formPanel.setBaseCls("x-plain");
        //formPanel.setLabelWidth(ANCHO - 400);
        but_cierre = new Button(nombreBoton0, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                String mesp = tex_mescierre.getValueAsString();                                
                MessageBox.confirm("Cierre de Cobro", "Se realizara el cierre de: " + mesp + " es correcto el mes a cerrar??", new MessageBox.ConfirmCallback() {

                    public void execute(String btnID) {
                        if (btnID.equalsIgnoreCase("yes")) {
                            String mesp = tex_mescierre.getValueAsString();
                            String mesproceso = GenerarMesDeProceso();
                            //MessageBox.alert("mesp: " + mesp + " mesproceso: " + mesproceso);
                            String enlace = "funcion=ProcesarCierreCobro&mesproceso=" + mesproceso;
                            verReporte(enlace);
                        }
                    }
                });
            }
        });
        but_traspaso = new Button(nombreBoton1, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                String idcliente = com_cliente.getValue();
      // String enlace = "funcion=verventalistamarca&idmarca=" + idmarca + "&idvendedor="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;
                String enlace = "funcion=porclientescobro&idcliente=" + idcliente;
// String enlace = "funcion=vertraspasomarca&idmarca=" + idmarca + "&idvendedor="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;
                verReporte(enlace);
            }
        });
        but_rebaja = new Button(nombreBoton2, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                String idcliente = com_cliente.getValue();
                String enlace = "funcion=pormarcascobro&idcliente=" + idcliente;
                verReporte(enlace);
            }
        });
//por vendedor
        but_cambio = new Button(nombreBoton3, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                String idcliente = com_cliente.getValue();
                String enlace = "funcion=pormarcavendedorcobro&idcliente=" + idcliente;
      // String enlace = "funcion=verventalistavendedor&idmarca=" + idmarca + "&idvendedor="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;
                verReporte(enlace);
            }
        });
        but_devolucion = new Button(nombreBoton4, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                String idcliente = com_cliente.getValue();
                String enlace = "funcion=porventas&idcliente=" + idcliente;
       // String enlace = "funcion=verDevoluciones&idmarca=" + idmarca + "&idestilo="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;
                verReporte(enlace);
            }
        });
//        but_ingresos = new Button(nombreBoton5, new ButtonListenerAdapter() {
//            @Override
//            public void onClick(Button button, EventObject e) {
//                String idcliente = com_cliente.getValue();
//                String enlace = "funcion=porcobrostodo&idcliente=" + idcliente;
//                verReporte(enlace);
//            }
//        });
//         but_ingresosinventario = new Button(nombreBoton6, new ButtonListenerAdapter() {
//            @Override
//            public void onClick(Button button, EventObject e) {
//                String idcliente = com_cliente.getValue();
//                String enlace = "funcion=pormorososclientes&idcliente=" + idcliente;
//                verReporte(enlace);
//            }
//        });
        but_reportecobrosueldo = new Button(nombreBoton5, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                String idalmacen = com_almacen.getValue();
                //String almacen = com_almacen.getXType();
                //MessageBox.alert("id: " + idalmacen + " nombre: " + almacen);
                String mesp = tex_mescierre.getValueAsString();
                String enlace = "funcion=poroficinamesreportesueldo&idalmacen=" + idalmacen + "&mescierre=" + mesp;
                verReporte(enlace);
            }
        });
        but_reportecobromorosidad = new Button(nombreBoton6, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                String idalmacen = com_almacen.getValue();
                //String almacen = com_almacen.getText();
                String mesp = tex_mescierre.getValueAsString();
                ////if(idalmacen!=""){
                    String enlace = "funcion=poroficinamesreportemorosidad&idalmacen=" + idalmacen + "&mescierre=" + mesp;
                    verReporte(enlace);
                ////} else {
                ////    MessageBox.alert("Debe ingresar el almacen!!!");
                ////}
            }
        });
        but_resumen = new Button(nombreBoton61, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                String idcliente = com_cliente.getValue();
                String enlace = "funcion=pormarcavendedorcobroresumen&idcliente=" + idcliente;
      // String enlace = "funcion=verventalistavendedor&idmarca=" + idmarca + "&idvendedor="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;
                verReporte(enlace);
            }
        });
        but_resumenvendedor = new Button(nombreBoton611, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                String mesp = tex_mescierre.getValueAsString();
                String enlace = "funcion=pormarcavendedorcobroresumenvendedor&mescierre=" + mesp;
                // String enlace = "funcion=verventalistavendedor&idmarca=" + idmarca + "&idvendedor="+ idestilo +"&fecha1=" +fecha1 + "&fecha2="+ fecha2;
                verReporte(enlace);
            }
        });
        but_reporte1 = new Button(nombreBoton7, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                String idalmacen = com_almacen.getValue();
                String mesp = tex_mescierre.getValueAsString();
                String enlace = "funcion=poroficinamesreporte1&idalmacen=" + idalmacen + "&mescierre=" + mesp;
                verReporte(enlace);
            }
        });
        but_reporte2 = new Button(nombreBoton8, new ButtonListenerAdapter() {
            @Override
            public void onClick(Button button, EventObject e) {
                String idalmacen = com_almacen.getValue();
                String mesp = tex_mescierre.getValueAsString();
                String enlace = "funcion=poroficinamesreporte2&idalmacen=" + idalmacen + "&mescierre=" + mesp;
                verReporte(enlace);
            }
        });
        but_cancelarP = new Button(nombreBoton10, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                SeleccionInformesCliente.this.destroy();
                SeleccionInformesCliente.this.close();

              }
        });
//        ;
        com_almacen = new ComboBox("almacen", "idalmacen",200);
        tex_mescierre = new TextField("Mes cierre", "mescierre");
        dat_fechaini = new DateField("Fecha Inicio", "Y-m-d",200);
        dat_fechafin = new DateField("Fecha Fin ", "Y-m-d",200);
        com_marca = new ComboBox("marca", "idmarca",200);
        com_vendedor = new ComboBox("Vendedor", "vendedores",200);
        com_cliente = new ComboBox("cliente", "idcliente",200);
        formPanel.add(com_almacen);
        formPanel.add(tex_mescierre);
        formPanel.add(dat_fechaini);
        formPanel.add(dat_fechafin);
        formPanel.add(com_marca);
        formPanel.add(com_vendedor);
        formPanel.add(com_cliente);
        addButton(but_cierre);
        addButton(but_resumenvendedor);
        addButton(but_resumen);
        addButton(but_cambio);     
////        addButton(but_ingresos);
////        addButton(but_ingresosinventario);
        addButton(but_traspaso);
        addButton(but_reporte1);
        addButton(but_reporte2);
        addButton(but_reportecobrosueldo);
        addButton(but_reportecobromorosidad);
        addButton(but_cancelarP);
        add(formPanel);
        initCombos();
        initvalues();
        addListeners();
    }

    private void initvalues() {
        tex_mescierre.setValue(mescierre);        
        dat_fechaini.setValue(fechainicio);        
        dat_fechafin.setValue(fechafin);
    }

    private void addListeners() {
        dat_fechaini.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                dat_fechafin.focus();
                }
            }
        });
         dat_fechafin.addListener(new TextFieldListenerAdapter() {

            @Override
            public void onSpecialKey(Field field, EventObject e) {
                if (e.getKey() == EventObject.ENTER) {
                com_marca.focus();
                }
            }
        });
    }

    private void initCombos() {
        com_almacen.setValueField("idalmacen");
        com_almacen.setDisplayField("nombre");
        com_almacen.setMinChars(1);
        com_almacen.setFieldLabel("almacen");
        com_almacen.setMode(ComboBox.LOCAL);
        com_almacen.setEmptyText("Seleccione una oficina");
        com_almacen.setLoadingText("Buscando");
        com_almacen.setTypeAhead(true);
        com_almacen.setSelectOnFocus(true);
        com_almacen.setHideTrigger(true);

        SimpleStore categoriaStore0 = new SimpleStore(new String[]{"idalmacen", "nombre"}, almacenM);
        categoriaStore0.load();
        com_almacen.setStore(categoriaStore0);

        com_marca.setValueField("idmarca");
        com_marca.setDisplayField("nombre");
        com_marca.setMinChars(1);
        com_marca.setFieldLabel("marca");
        com_marca.setMode(ComboBox.LOCAL);
        com_marca.setEmptyText("Seleccione una marca");
        com_marca.setLoadingText("Buscando");
        com_marca.setTypeAhead(true);
        com_marca.setSelectOnFocus(true);
        com_marca.setHideTrigger(true);

        SimpleStore categoriaStore = new SimpleStore(new String[]{"idmarca", "nombre"}, marcaM);
        categoriaStore.load();
        com_marca.setStore(categoriaStore);

        com_vendedor.setMinChars(1);
        com_vendedor.setValueField("idempleado");
        com_vendedor.setDisplayField("nombre");
        com_vendedor.setMinChars(1);
        com_vendedor.setFieldLabel("vendedor");
        com_vendedor.setMode(ComboBox.LOCAL);
        com_vendedor.setEmptyText("Seleccione un vendedor");
        com_vendedor.setLoadingText("Buscando");
        com_vendedor.setTypeAhead(true);
        com_vendedor.setSelectOnFocus(true);
        com_vendedor.setHideTrigger(true);

        SimpleStore categoriaStore1 = new SimpleStore(new String[]{"idempleado", "nombre"}, vendedorM);
        categoriaStore1.load();
        com_vendedor.setStore(categoriaStore1);

        com_cliente.setValueField("idcliente");
        com_cliente.setDisplayField("nombre");
        com_cliente.setMinChars(1);
        com_cliente.setFieldLabel("cliente");
        com_cliente.setMode(ComboBox.LOCAL);
        com_cliente.setEmptyText("Seleccione un cliente");
        com_cliente.setLoadingText("Buscando");
        com_cliente.setTypeAhead(true);
        com_cliente.setSelectOnFocus(true);
        com_cliente.setHideTrigger(true);

        SimpleStore categoriaStore2 = new SimpleStore(new String[]{"idcliente", "nombre"}, clienteM);
        categoriaStore2.load();
        com_cliente.setStore(categoriaStore2);
    }

    private String GenerarMesDeProceso() {
        String mesproc = tex_mescierre.getValueAsString();
        String mesc = mesproc.substring(0,2);
        mesc = mesc.trim();
        String anioc = mesproc.substring(2,6);
        anioc = anioc.trim();
        if(mesc.equals("01")){
            mesc = "02";
        }
        else{
            if(mesc.equals("02")){
                mesc = "03";
            }
            else{
                if(mesc.equals("03")){
                    mesc = "04";
                }
                else{
                    if(mesc.equals("04")){
                        mesc = "05";
                    }
                    else{
                        if(mesc.equals("05")){
                            mesc = "06";
                        }
                        else{
                            if(mesc.equals("06")){
                                mesc = "07";
                            }
                            else{
                                if(mesc.equals("07")){
                                    mesc = "08";
                                }
                                else{
                                    if(mesc.equals("08")){
                                        mesc = "09";
                                    }
                                    else{
                                        if(mesc.equals("09")){
                                            mesc = "10";
                                        }
                                        else{
                                            if(mesc.equals("10")){
                                                mesc = "11";
                                            }
                                            else{
                                                if(mesc.equals("11")){
                                                    mesc = "12";
                                                }
                                                else{
                                                    if(mesc.equals("12")){
                                                        mesc = "01";
                                                        int anio = Integer.parseInt(anioc);
                                                        anio = anio + 1;
                                                        anioc = Integer.toString(anio);
                                                    }
                                                }
                                            }
                                        }
                                    }    
                                }
                            }
                        }
                    }
                }
            }
        }
//        MessageBox.alert("mesc: " + mesc);
        mesproc = mesc.concat(anioc);
        return mesproc;
    }
  
    public Button getBut_cancelar() {
        return but_cancelarP;
    }

    private void verReporte(String enlace) {
        ReporteMediaCartaChorroWindow print = new ReporteMediaCartaChorroWindow(enlace);
        print.show();
    }
}
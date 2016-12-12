/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.procesos;

import com.gwtext.client.core.EventObject;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.google.gwt.core.client.EntryPoint;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.json.client.JSONObject;
import com.google.gwt.json.client.JSONParser;
import com.google.gwt.json.client.JSONString;
import com.google.gwt.json.client.JSONValue;
import com.gwtext.client.core.Position;
import com.gwtext.client.data.SimpleStore;
import com.gwtext.client.util.DateUtil;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.TabPanel;
import com.gwtext.client.widgets.form.ComboBox;
import com.gwtext.client.widgets.form.DateField;
import com.gwtext.client.widgets.form.FormPanel;
import com.gwtext.client.widgets.form.HtmlEditor;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.layout.*;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;

public class ModificarForm implements EntryPoint {

    private DateField dat_fecha;
    private DateField dat_fecha1;
    private ComboBox com_estadoC;
    private ComboBox com_ciudadC;
    private ComboBox com_cobradorC;
    private String[] estadoM;
   private Object[][] ciudadM;
   private Object[][] cobradorM;
    private TextField codigo;
    private TextField nombre;
    private TextField direccion;
    private TextField telefono;
    private TextField nombreResponsable;
    private TextField apellidoResponsable;
    private TextField telefonoResponasable;
    private TextField celularResponsable;
    private TextField emailResponsable;
    private TextField direccionresponsable;
    private TextField comisionResponsable;
//    private TextField telefonoFijo;
//    private TextField telefonoTrabajo;
//    private TextField telefonoCelular;
    private TextField saldoAnterior;
    private TextField saldoActual;
    private TextField planillaActual;
    private TextField tipoPlanilla;
    private TextField empleadoAsignado;

    private TextField fax;

    private Button but_aceptarP;
    private Button but_cancelarP;

    private Periodo padre;


   private String idempresaD;
   private String codigoD;
   private String nombreD;
   private String direccionD;
   private String telefonoD;
   private String faxD;
   private String fechaD;
   private String fechaContratod;
   private String estadoD;
   private String ciudadD;
   private String cobradorD;
   private String nombresD;
   private String apellidosD;
   private String telefonoResD;
   private String celularResD;
   private String emailD;
   private String direccionResD;
   private String comisionD;
//   private String telefonoFijoD;
//   private String telefonoTrabajoD;
//   private String telefonoCelD;
 private String saldoAnteriorD;
   private String saldoActualD;
   private String planillaActualD;
    private String tipoPlanillaD;
   private String empleadoAsignadoD;

   private boolean nuevo;
   // private Object window;
    

    public ModificarForm(String idempresa,Object[][] ciudades,Object[][] cobrador, String codigo,String nombre, String direccion,String telefono,String fax,String fecha, String fechaContrato, String estado,String ciudad, String nombres, String apellidos, String telefonoRes, String celularRes, String email, String direccionRes, String comision, String saldoAnterior, String saldoActual, String planillaActual, String tipoPlanilla,String empleadoAsignado,Periodo padre)
   // public NuevaEmpresaForm(String idempresa,Object[][] ciudades, String codigo,String nombre, String direccion,String telefono,String fax,String fecha, String fechaContrato, String estado,String ciudad, String nombres, String apellidos, String telefonoRes, String celularRes, String email, String direccionRes, String comision, String saldoAnterior, String saldoActual, String planillaActual, String tipoPlanilla,String empleadoAsignado,Empresa padre)

    {

        this.idempresaD = idempresa;
       this.ciudadM = ciudades;
        this.cobradorM = cobrador;
        this.codigoD = codigo;
        this.nombreD = nombre;
        this.direccionD = direccion;
        this.telefonoD = telefono;
        this.faxD  = fax;
        this.fechaD = fecha;
        this.fechaContratod = fechaContrato;
        this.estadoD = estado;
         this.ciudadD = ciudad;
        this.nombresD = nombres;
        this.apellidosD = apellidos;
        this.telefonoResD = telefonoRes;
        this.celularResD = celularRes;
        this.emailD = email;
        this.direccionResD = direccionRes;
        this.comisionD = comision;
        this.saldoAnteriorD = saldoAnterior;
        this.saldoActualD = saldoActual;
        this.planillaActualD = planillaActual;
        this.tipoPlanillaD = tipoPlanilla;
 this.empleadoAsignadoD = empleadoAsignado;

        this.padre = padre;



        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cancelar";
//        String tituloTabla = "Registar nueva Modelo";

        if (idempresa != null) {
            nombreBoton1 = "Modificar";
//            tituloTabla = "Editar Empresa";
            nuevo = false;
        } else {
            this.idempresaD = "nuevo";
            nuevo = true;

        }

//        setId("win-Modelos");
        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                if (nuevo == false) {
                 //   GuardarEditarAlmacen();
                } else {
                    GuardarNuevoAlmacen();
                }
            }
        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                
              //  NuevaEmpresaForm.this.
//                NuevaEmpresaForm.this.setModal(false);
            //formulario = null;
            }
        });
    }


    public void onModuleLoad() {
        Panel panel = new Panel();
        panel.setBorder(false);
        panel.setPaddings(15);

        Window window = new Window();
        window.setTitle("Nueva Empresa");

         window.setCloseAction(Window.HIDE);
//         window.setPlain(true);
//




        panel.setBorder(false);
        panel.setPaddings(15);

        FormPanel formPanel = new FormPanel();
        formPanel.setLabelAlign(Position.TOP);
        formPanel.setTitle("Nueva Empresa");
        formPanel.setPaddings(5);
        formPanel.setWidth(600);

        Panel topPanel = new Panel();
        topPanel.setLayout(new ColumnLayout());
        topPanel.setBorder(false);

        Panel firstColumn = new Panel();
        firstColumn.setLayout(new FormLayout());
        firstColumn.setBorder(false);




        //SimpleStore cotegoriaStore  = new SimpleStore("estados", estadoM);
com_cobradorC = new ComboBox("Cobrador", "empleado");
        SimpleStore cotegoriaStore1 = new SimpleStore(new String[]{"idempleado", "nombre"}, cobradorM);
        cotegoriaStore1.load();
        com_cobradorC.setMinChars(1);
        com_cobradorC.setFieldLabel("Cobrador");
        com_cobradorC.setStore(cotegoriaStore1);
        com_cobradorC.setValueField("idempleado");
        com_cobradorC.setDisplayField("nombre");
        com_cobradorC.setForceSelection(true);
        com_cobradorC.setMode(ComboBox.LOCAL);
        com_cobradorC.setEmptyText("Buscar Cobrador");
        com_cobradorC.setLoadingText("buscando...");
        com_cobradorC.setTypeAhead(true);
        com_cobradorC.setSelectOnFocus(true);
        com_cobradorC.setWidth(200);

        com_cobradorC.setHideTrigger(true);



        firstColumn.add(codigo = new TextField("codigo", "codigo"), new AnchorLayoutData("95%"));
        firstColumn.add(nombre = new TextField("Nombre", "nombre"), new AnchorLayoutData("95%"));
        firstColumn.add(direccion = new TextField("Direccion", "direccion"), new AnchorLayoutData("95%"));
        firstColumn.add(telefono = new TextField("Telefono", "telefono"), new AnchorLayoutData("95%"));
      firstColumn.add(com_cobradorC, new AnchorLayoutData("95%"));

        topPanel.add(firstColumn, new ColumnLayoutData(0.5));

        Panel secondColumn = new Panel();
        secondColumn.setLayout(new FormLayout());
        secondColumn.setBorder(false);

        secondColumn.add(fax = new TextField("Fax", "fax"), new AnchorLayoutData("95%"));


        dat_fecha = new DateField("Fecha", "d-m-Y");
        dat_fecha1 = new DateField("Fecha Contrato", "d-m-Y");

        estadoM = new String[]{"Activo", "Inactivo", "Pendiente"};

        com_estadoC = new ComboBox("Estado", "estado");
        SimpleStore estadosStore = new SimpleStore("estados", estadoM);
        estadosStore.load();
        com_estadoC.setDisplayField("estados");
        com_estadoC.setStore(estadosStore);


        //SimpleStore cotegoriaStore  = new SimpleStore("estados", estadoM);
com_ciudadC = new ComboBox("Ciudad", "ciudad");
        SimpleStore cotegoriaStore = new SimpleStore(new String[]{"idciudad", "nombre"}, ciudadM);
        cotegoriaStore.load();
        com_ciudadC.setMinChars(1);
        com_ciudadC.setFieldLabel("Ciudad");
        com_ciudadC.setStore(cotegoriaStore);
        com_ciudadC.setValueField("idciudad");
        com_ciudadC.setDisplayField("nombre");
        com_ciudadC.setForceSelection(true);
        com_ciudadC.setMode(ComboBox.LOCAL);
        com_ciudadC.setEmptyText("Buscar Ciudad");
        com_ciudadC.setLoadingText("buscando...");
        com_ciudadC.setTypeAhead(true);
        com_ciudadC.setSelectOnFocus(true);
        com_ciudadC.setWidth(200);

        com_ciudadC.setHideTrigger(true);


        secondColumn.add(dat_fecha, new AnchorLayoutData("95%"));
        secondColumn.add(dat_fecha1, new AnchorLayoutData("95%"));
        secondColumn.add(com_estadoC, new AnchorLayoutData("95%"));
        secondColumn.add(com_ciudadC, new AnchorLayoutData("95%"));
        topPanel.add(secondColumn, new ColumnLayoutData(0.5));

        formPanel.add(topPanel);

        TabPanel tabPanel = new TabPanel();
        tabPanel.setPlain(true);
        tabPanel.setActiveTab(0);
        tabPanel.setHeight(410);

        Panel firstTab = new Panel();
        firstTab.setTitle("Detalle Responsable");
        firstTab.setLayout(new FormLayout());
        firstTab.setPaddings(10);

        firstTab.add(nombreResponsable = new TextField("Nombre", "nombre", 230));
        firstTab.add(apellidoResponsable = new TextField("Apellidos", "apellido", 230));
        firstTab.add(telefonoResponasable = new TextField("Telefono", "telefono", 230));
        firstTab.add(celularResponsable = new TextField("Celular", "celular", 230));
        firstTab.add(emailResponsable = new TextField("Email", "email", 230));
        firstTab.add(direccionresponsable = new TextField("Direccion", "direccion", 230));
        firstTab.add(comisionResponsable = new TextField("Comision", "comision", 230));
        tabPanel.add(firstTab);

        Panel secondTab = new Panel();
        secondTab.setTitle("Estado Cuentas");
        secondTab.setLayout(new FormLayout());
        secondTab.setPaddings(10);

        secondTab.add(saldoAnterior = new TextField("Saldo Anterior", "saldoant", 230));
        secondTab.add(saldoActual = new TextField("saldo Actual", "saldoac", 230));
        secondTab.add(planillaActual = new TextField("Planilla Actual", "plaactual", 230));
       secondTab.add(tipoPlanilla = new TextField("Tipo Planilla", "tipopla", 230));
        secondTab.add(empleadoAsignado = new TextField("Cobrador", "cobradpr", 230));

        tabPanel.add(secondTab);

        Panel thirdPanel = new Panel();
        thirdPanel.setTitle("Detalle");
        thirdPanel.setLayout(new FitLayout());
        thirdPanel.add(new HtmlEditor("observacion"));
        tabPanel.add(thirdPanel);

        formPanel.add(tabPanel);
        
        formPanel.addButton(but_aceptarP);
        formPanel.addButton(but_cancelarP);
        panel.add(formPanel);

        window.add(panel);
        window.show();
        initValues();
    }

    public void initValues() {


        codigo.setValue(codigoD);
        nombre.setValue(nombreD);
        direccion.setValue(direccionD);
        telefono.setValue(telefonoD);
        com_cobradorC.setValue(nombresD);

        fax.setValue(faxD);
        dat_fecha.setValue(fechaD);
        dat_fecha1.setValue(fechaContratod);
        com_estadoC.setValue(estadoD);
        com_ciudadC.setValue(ciudadD);
        nombreResponsable.setValue(nombresD);
        apellidoResponsable.setValue(apellidosD);
        telefonoResponasable.setValue(telefonoResD);
        celularResponsable.setValue(celularResD);
        emailResponsable.setValue(emailD);
        direccionresponsable.setValue(direccionResD);
        comisionResponsable.setValue(comisionD);
        saldoAnterior.setValue(saldoAnteriorD);
        saldoActual.setValue(saldoActualD);
        planillaActual.setValue(planillaActualD);
        tipoPlanilla.setValue(tipoPlanillaD);
        empleadoAsignado.setValue(empleadoAsignadoD);
    }

      public void GuardarNuevoAlmacen() {
              //String nit = tex_nit.getText();
        //String idcliente = tex_idcliente.getText();
        String codigoD = codigo.getValueAsString();
        String nombreD = nombre.getValueAsString();
        String direccionD = direccion.getValueAsString();
        String telefonoD = telefono.getText();
        String idempleado = com_cobradorC.getValueAsString();
        String faxD = fax.getValueAsString();
         String fecha = DateUtil.format(dat_fecha.getValue(), "Y-m-d");
         String fecha1 = DateUtil.format(dat_fecha1.getValue(), "Y-m-d");
        String estadoD = com_estadoC.getValueAsString();
        String idciudad = com_ciudadC.getValueAsString();
        String nombreresp = nombreResponsable.getText();
        String aperesp = apellidoResponsable.getText();
        String telefresp = telefonoResponasable.getText();
        String celresp = celularResponsable.getText();
        String mailresp = emailResponsable.getText();
        String dirresp = direccionresponsable.getText();
        String comisresp = comisionResponsable.getText();
        String saldoant = saldoAnterior.getValueAsString();
        String saldoact = saldoActual.getText();
        String planilla = planillaActual.getText();
         String tipoplanilla = tipoPlanilla.getText();
          String empasig = empleadoAsignado.getText();
        //  String cantidad = tex_montoTotal.getText();
            JSONObject compraObject = new JSONObject();
            // compraObject.put("idcliente", new JSONString(idcliente));
            compraObject.put("codigo", new JSONString(codigoD));
            compraObject.put("nombre", new JSONString(nombreD));
            compraObject.put("direccion", new JSONString(direccionD));
            compraObject.put("telefono", new JSONString(telefonoD));
            compraObject.put("idempleado", new JSONString(idempleado));
            compraObject.put("fax", new JSONString(faxD));
             compraObject.put("fecha", new JSONString(fecha));
              compraObject.put("fecha1", new JSONString(fecha1));
            compraObject.put("estado", new JSONString(estadoD));
            compraObject.put("idciudad", new JSONString(idciudad));
            compraObject.put("nombreresp", new JSONString(nombreresp));
            compraObject.put("aperesp", new JSONString(aperesp));
            compraObject.put("telefresp", new JSONString(telefresp));
            compraObject.put("celresp", new JSONString(celresp));
            compraObject.put("mailresp", new JSONString(mailresp));
            // compraObject.put("cantidad", new JSONString(cantidad));

            compraObject.put("dirresp", new JSONString(dirresp));
            compraObject.put("comisresp", new JSONString(comisresp));
            compraObject.put("saldoant", new JSONString(saldoant));
//        compraObject.put("devuelto", new JSONString(devuelto1));
//        compraObject.put("devueltosus", new JSONString(devueltosus1));

            compraObject.put("saldoact", new JSONString(saldoact));

            compraObject.put("planilla", new JSONString(planilla));

            compraObject.put("tipoplanilla", new JSONString(tipoplanilla));
            compraObject.put("empasig", new JSONString(empasig));



            JSONObject resultado = new JSONObject();
            resultado.put("empresa", compraObject);
          //  resultado.put("productos", productos);

            String datos = "resultado=" + resultado.toString();

            Utils.setErrorPrincipal("registrando", "cargar");
            // String url = "./php/VentaDetalle.php?funcion=insertarventa";
            String url = "./php/Empresa.php?funcion=GuardarNuevaEmpresa&" + datos;

            //  enlace = "php/dao/VentaGuardar.php?function=txSaveVenta&" + datos;


            //com.google.gwt.user.client.Window.alert("zzzz" + url);
//            final Conector conec = new Conector(url, false, "GET");
            final Conector conec = new Conector(url, false, "POST");

           
      try {
            conec.getRequestBuilder().sendRequest(datos, new RequestCallback() {

                public void onResponseReceived(Request request, Response response) {
                    String data = response.getText();
                    JSONValue jsonValue = JSONParser.parse(data);
                    JSONObject jsonObject;
                    if ((jsonObject = jsonValue.isObject()) != null) {
                        String errorR = Utils.getStringOfJSONObject(jsonObject, "error");
                        String mensajeR = Utils.getStringOfJSONObject(jsonObject, "mensaje");
                        if (errorR.equalsIgnoreCase("true")) {
                             Utils.setErrorPrincipal(mensajeR, "mensaje");
                           // this.destroy();
                            padre.reload();
                         closeTabCompraDirecta();

                          //  closeTabCompraDirecta();
                          //  listaCompra.store.reload();

                        } else {
                            //Window.alert(mensajeR);
                            com.google.gwt.user.client.Window.alert("No se puede realizar ");
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
   public void closeTabCompraDirecta() {
//        window.setCloseAction(Window.HIDE);
//      window.this.clear();
//            TraspasoWindow.this.destroy();
//            TraspasoWindow.this.close();
//       formPanel.
//        listaCompra.getTap_panel().remove("tab-" + COMPRA_DIRECTA_TABBED + idpanel);
//  //      listaCompra.reload();
    }

    public void GuardarEditarAlmacen() {

    }



}
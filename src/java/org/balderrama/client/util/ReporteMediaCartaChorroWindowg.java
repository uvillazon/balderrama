/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.util;

/**
 *
 * @author Foreground
 */
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.google.gwt.user.client.ui.HTML;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.Toolbar;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.layout.FitLayout;

public class ReporteMediaCartaChorroWindowg extends Window {

    private final int ANCHOClienteWin = 1250;
    private final int ALTOClienteWin = 600;
    private ToolbarButton imprimirR;
    private ToolbarButton guardarXLS;
    private ToolbarButton guardarPDF;
     private ToolbarButton salir;
//    private Panel panel;
    private String mostar;
    private HTML html;
    private String enlaceReporte;
    private String enlaceReporteXLS;
    private String enlaceReportePDF;

    public ReporteMediaCartaChorroWindowg(String enlace) {
        setTitle("Reporte");
        this.enlaceReporte = "php/ReporteHTML.php?" + enlace;
        this.enlaceReporteXLS = "php/ReporteXLS.php?" + enlace;
        this.enlaceReportePDF = "php/ReportePDF.php?" + enlace;
        setWidth(1250);
        setMinWidth(1000);
        setHeight(580);
        setAutoScroll(true);
        setLayout(new FitLayout());
        setPaddings(5);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        setPlain(true);
        onModuleLoad();
    }

    public ReporteMediaCartaChorroWindowg(String enlace, boolean vistaPrevia) {
        setTitle("Reporte");
        this.enlaceReporte = enlace;
        this.enlaceReporteXLS = null;
        this.enlaceReportePDF = null;
        setWidth(ANCHOClienteWin);
        setMinWidth(ANCHOClienteWin);
        setHeight(ALTOClienteWin);
        setAutoScroll(true);
        setLayout(new FitLayout());
        setPaddings(5);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        setPlain(true);
        onModuleLoad();
        imprimirR.setDisabled(true);
        guardarXLS.setDisabled(true);
        guardarPDF.setDisabled(true);
        salir.setDisabled(true);
    }

    public void onModuleLoad() {

        Utils.setErrorPrincipal("Cargando el reporte .... ", "cargar");
        final Conector conec = new Conector(enlaceReporte, false);

        try {
            conec.getRequestBuilder().sendRequest(null, new RequestCallback() {

                public void onResponseReceived(Request request, Response response) {
                    Utils.setErrorPrincipal("El reporte fue cargado correctamente", "mensaje");
                    String data = response.getText();
                    setHtml(data);
                    mostar = data;
                }

                public void onError(Request request, Throwable exception) {
                    Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                }
            });

        } catch (RequestException ex) {
            ex.getMessage();
            Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
        }

        imprimirR = new ToolbarButton("Imprimir");
        guardarXLS = new ToolbarButton("Guardar XLS");
        guardarPDF = new ToolbarButton("Guardar PDF");
        salir = new ToolbarButton("Salir");
   salir.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
        close();
            destroy();
            //padre.destroy();
            }
        });
        imprimirR.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                Utils.imprimirDivSinCabecera(mostar);
            }
        });
        guardarXLS.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                com.google.gwt.user.client.Window.Location.assign(enlaceReporteXLS);
            }
        });
        guardarPDF.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                com.google.gwt.user.client.Window.Location.assign(enlaceReportePDF);
            }
        });
//        add(panel);

        Toolbar botonesPiePagina = new Toolbar();
        botonesPiePagina.addButton(imprimirR);
        botonesPiePagina.addButton(guardarXLS);
        botonesPiePagina.addButton(guardarPDF);
   botonesPiePagina.addButton(salir);
        setBottomToolbar(botonesPiePagina);
    }
}

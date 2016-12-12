/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.util;

/**
 *
 * @author haydee
 */
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.Toolbar;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.layout.FitLayout;
import org.balderrama.client.sistemadetalle.ListaInventarioGrid;
import org.balderrama.client.sistemadetalle.PanelInventario;
import org.balderrama.client.sistemadetalle.PanelInventarioM;
import com.google.gwt.http.client.Request;
import com.google.gwt.http.client.RequestCallback;
import com.google.gwt.http.client.RequestException;
import com.google.gwt.http.client.Response;
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;

public class ReporteImagen extends Window {

    private final int ANCHOClienteWin = 820;
    private final int ALTOClienteWin = 600;
    private final int WINDOW_PADDING = 5;
     private ToolbarButton imprimirR;
      private ToolbarButton confirmarR;
    //private ToolbarButton guardarXLS;
    //private ToolbarButton guardarPDF;
      private ToolbarButton salir;
    private Panel panel;
    private String mostar;
    private String enlaceReporte;
    private String enlaceReporteXLS;
    private String enlaceReportePDF;
    private Button but_cancelarP;
 private PanelInventarioM padre;
 private ListaInventarioGrid padre2;

//    public ReporteImagen(String enlace, ListaInventarioGrid aThis) {
//        throw new UnsupportedOperationException("Not yet implemented");
//    }
  public ReporteImagen(String enlace,ListaInventarioGrid panel)
{
  this.padre2 = panel;
        setTitle("Mostrar imagen");
        this.enlaceReporte = "php/ReporteHTML.php?" + enlace;
        this.enlaceReporteXLS = "php/ReporteXLS.php?" + enlace;
        this.enlaceReportePDF = "php/ReportePDF.php?" + enlace;
        setWidth(ANCHOClienteWin);
        setMinWidth(ANCHOClienteWin);
        setHeight(ALTOClienteWin);
        setAutoScroll(true);
        setLayout(new FitLayout());
        setPaddings(5);
        setButtonAlign(Position.CENTER);
        setCloseAction(Window.CLOSE);
        setPlain(true);
        onModuleLoad2();

    }

 
public void onModuleLoad2() {

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
confirmarR = new ToolbarButton("Anadir Imagen");
        imprimirR = new ToolbarButton("Imprimir");
 //       guardarXLS = new ToolbarButton("Guardar XLS");
  //      guardarPDF = new ToolbarButton("Guardar PDF");
  salir = new ToolbarButton("Salir/Cancelar");
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
//padre2.registrartraspaso();
                Utils.imprimirDivSinCabecera(mostar);
            }
        });
         confirmarR.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
//padre2.registrartraspaso();
          //      Utils.imprimirDivSinCabecera(mostar);
            }
        });
        
      
//        add(panel);

        Toolbar botonesPiePagina = new Toolbar();
          botonesPiePagina.addButton(confirmarR);
        botonesPiePagina.addButton(imprimirR);
       // botonesPiePagina.addButton(guardarXLS);
       // botonesPiePagina.addButton(guardarPDF);
        botonesPiePagina.addButton(salir);

        setBottomToolbar(botonesPiePagina);
    }

}

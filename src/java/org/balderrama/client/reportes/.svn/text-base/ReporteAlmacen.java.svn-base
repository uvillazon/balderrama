/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

package org.balderrama.client.reportes;

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.Position;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.layout.FitLayout;
import com.google.gwt.user.client.ui.Frame;
/**
 *
 * @author buggy
 */
public class ReporteAlmacen extends Window {

//    private final int ANCHO = 1000;
//    private final int ALTO = 1800;
//    private final AnchorLayoutData ANCHO_LAYOUT_DATA = new AnchorLayoutData("90%");
    private final int WINDOW_PADDING = 5;

    private Button but_aceptarP;
    private Button but_cancelarP;


    public  ReporteAlmacen() {

        String nombreBoton1 = "Guardar";
        String nombreBoton2 = "Cerrar";
        String tituloTabla = "Registar nuevo Almacen";

        setId("win-Reporte Almacen");
//        but_aceptarP = new Button(nombreBoton1, new ButtonListenerAdapter() {
//
//            @Override
//            public void onClick(Button button, EventObject e) {
//
//            }
//        });
        but_cancelarP = new Button(nombreBoton2, new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {

                ReporteAlmacen.this.close();
                ReporteAlmacen.this.setModal(false);

           }
        });

        setTitle("REPORTES ALMACEN");
        setWidth(1000);
        setMinWidth(100);
        setHeight(500);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);
        //addButton(but_aceptarP);
        addButton(but_cancelarP);

        setCloseAction(Window.CLOSE);
        setPlain(true);
        Frame pdfFrame = new Frame();
        pdfFrame.setSize("100%", "100%");
        String parametro1="ROJO";

        //sin parametros
        pdfFrame.setUrl("http://localhost:8080/report/index.jsp?dato="+parametro1);

        //pdfFrame.setUrl("http://localhost:8080/reportes/index.jsp?dato=col-1");

        add(pdfFrame);
    }

    public Button getBut_aceptar() {
        return but_aceptarP;
    }

    public Button getBut_cancelar() {
        return but_cancelarP;
    }
}

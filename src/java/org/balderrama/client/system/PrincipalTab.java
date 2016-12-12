/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.system;

import com.gwtext.client.widgets.Panel;
import com.google.gwt.user.client.ui.Frame;
import com.google.gwt.user.client.ui.HTML;
import com.google.gwt.user.client.ui.Image;
import com.google.gwt.user.client.ui.VerticalPanel;
import org.balderrama.client.util.Utils;

/**
 *
 * @author Ubaldo
 */
public class PrincipalTab extends Panel {

    private final int ANCHO1050 = 975;
    private final int ALTO1050 = 460;
    private final int ANCHO = Utils.getScreenWidth() - 24;
    private final int ALTO = Utils.getScreenHeight() - 270;

  public PrincipalTab() {

        this.setTitle("Panel Principal");
        this.ensureDebugId("tabPrincipal");
        HTML homeText = new HTML();
        Frame google = new Frame("");
//        google.setSize(ANCHO, ALTO);
        google.setPixelSize(ANCHO, ANCHO);


//        this.load("http://www.google.com/");
        this.setId("tabPrincipal");
//        this.setAnimationEnabled(true);
        VerticalPanel vPanel = new VerticalPanel();
        vPanel.add(new Image("images/logobalderrama.jpg"));
        this.add(google);
//        this.setHtml("hola este es la pantalla principal");
//        onModuleLoad();
    }
//    public void onModuleLoad() {
//    }
}

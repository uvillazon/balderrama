
package org.balderrama.client.system;

//import com.google.gwt.user.client.Window;
import com.google.gwt.user.client.ui.Button;
import com.google.gwt.user.client.ui.ClickListener;
import com.google.gwt.user.client.ui.FileUpload;
import com.google.gwt.user.client.ui.FormHandler;
import com.google.gwt.user.client.ui.FormPanel;
import com.google.gwt.user.client.ui.FormSubmitCompleteEvent;
import com.google.gwt.user.client.ui.FormSubmitEvent;
//import com.google.gwt.user.client.ui.HorizontalPanel;
import com.google.gwt.user.client.ui.VerticalPanel;
import com.google.gwt.user.client.ui.Widget;
import com.gwtext.client.core.Position;
//import com.gwtext.client.data.SimpleStore;
//import com.gwtext.client.widgets.form.ComboBox;
//import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.Window;
//import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.layout.FitLayout;
import com.gwtext.client.widgets.MessageBox;
import org.balderrama.client.util.Utils;
import org.balderrama.client.MainEntryPoint;
import org.balderrama.client.util.KMenu;



public class CargarArchivo extends Window {

    private final int WINDOW_PADDING = 5;
    //private ComboBox com_marca;
    private String marcaM;
    private String idmarcaM;
    private FormPanel form;
    private SeleccionMarcaProformas SMP1;
    //private TextField tex_marca;
    //private FileUpload cargarCD;
    //private Panel panel;
    public MainEntryPoint panel;
    public KMenu padre;
    //public MainEntryPoint panel;

    public CargarArchivo(String idmarca, String marca, SeleccionMarcaProformas SMP, KMenu kmenu) {
        SMP1 = SMP;
        padre = kmenu;
        marcaM = marca;
        idmarcaM = idmarca;
        this.setClosable(true);
        //this.setId("TPfun300451");
        setIconCls("tab-icon");
        setAutoScroll(false);
        setTitle("Procesar Archivos de " + marcaM);
        setAutoWidth(true);
        setAutoHeight(true);
        setLayout(new FitLayout());
        setPaddings(WINDOW_PADDING);
        setButtonAlign(Position.CENTER);

        setCloseAction(Window.CLOSE);
        onModuleLoad();
        //com.google.gwt.user.client.Window.alert("idmarca " + idmarcaM + " Marca " + marcaM );
    }

    public void onModuleLoad() {

        //panel = new Panel();
        form = new FormPanel();
        form.setEncoding(FormPanel.ENCODING_MULTIPART);
        form.setMethod(FormPanel.METHOD_POST);
        form.setAction("php/CargarArchivo.php?idmarca=" + idmarcaM + "&marca=" + marcaM);
////        form.addStyleName("table-center");
////        form.addStyleName("demo-panel-padded");
        //form.setWidth("675px");
        //form.setTitle(marcaM);

        VerticalPanel holder = new VerticalPanel();

        //com.google.gwt.user.client.Window.alert("idmarca " + idmarcaM + " Marca " + marcaM );
        final FileUpload upload = new FileUpload();
        upload.setName("file");
        

        holder.add(upload);
        //HorizontalPanel holder = new HorizontalPanel();
        holder.add(new Button("Procesar", new ClickListener() {

            public void onClick(Widget sender) {

                String filename = upload.getFilename();
                if (filename.length() == 0) {
                    MessageBox.alert("No selecciono un archivo para procesar!");
                } else {

                    ////Window.alert("Archivo a Procesar! " + filename + " getName " + upload.getName() + " directorio actual ");
                    //submit the form
                    form.submit();
                }
            }
        }));

//        holder.add(new Button("Cancelar", new ClickListener() {

//            public void onClick(Widget sender) {
                //salir
//            }
//        }));

        form.add(holder);
        form.addFormHandler(
                new FormHandler() {

                    public void onSubmit(FormSubmitEvent event) {
                        Utils.setErrorPrincipal("Procesando el archivo", "Procesar");

                    }

                    public void onSubmitComplete(FormSubmitCompleteEvent event) {
                        ////Utils.setErrorPrincipal(event.getResults(), "mensaje");
                        com.google.gwt.user.client.Window.alert(event.getResults());
                    //storeCD.reload(new UrlParam[]{new UrlParam("start", 0), new UrlParam("limit", 100)});
                    //uploadedFilePath = upload.getFilename();
                    }
                });        
        add(form);
        //add(panel);
    }

}

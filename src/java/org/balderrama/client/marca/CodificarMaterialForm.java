/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.marca;

/**
 *
 * @author Administrador
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
import com.gwtext.client.core.EventObject;
import com.gwtext.client.core.SortDir;
import com.gwtext.client.core.TextAlign;
import com.gwtext.client.data.*;
import com.gwtext.client.widgets.Button;
import com.gwtext.client.widgets.MessageBox;
import com.gwtext.client.widgets.Panel;
import com.gwtext.client.widgets.QuickTipsConfig;
import com.gwtext.client.widgets.ToolbarButton;
import com.gwtext.client.widgets.Window;
import com.gwtext.client.widgets.event.ButtonListenerAdapter;
import com.gwtext.client.widgets.form.TextField;
import com.gwtext.client.widgets.grid.ColumnConfig;
import com.gwtext.client.widgets.grid.ColumnModel;
import com.gwtext.client.widgets.grid.EditorGridPanel;
import com.gwtext.client.widgets.grid.GridEditor;
import com.gwtext.client.widgets.grid.GroupingView;
import org.balderrama.client.util.Conector;
import org.balderrama.client.util.Utils;

public class CodificarMaterialForm extends Window {

    private Object[][] datos1017;
    private Marca padres1017;
    private ToolbarButton editarProducto1017;
    private String esnuevo;
    private EditorGridPanel grid1017;
    private ColumnConfig idmaterial;
    private ColumnConfig material;
    private String idmarca;

    public CodificarMaterialForm(String idmarca ,Object[][] data, Marca padre) {
        this.padres1017 = padre;
        this.datos1017 = data;
        this.esnuevo = null;
        this.idmarca = idmarca;

        this.setTitle("Codificar Color Por Marca");
        onModuleLoad();
    }

    public void onModuleLoad() {
        Panel panel = new Panel();
        panel.setBorder(false);
        panel.setPaddings(15);

        MemoryProxy proxy = new MemoryProxy(datos1017);
        RecordDef recordDef = new RecordDef(
                new FieldDef[]{
                    new StringFieldDef("idmateria"),
                    new StringFieldDef("material"),
                    new StringFieldDef("codigo")
                });

        ArrayReader reader = new ArrayReader(recordDef);

        Store store = new Store(proxy, reader, true);
        store.load();



        idmaterial = new ColumnConfig("Id Material", "idmateria", 150, true);

        material = new ColumnConfig("Material", "material", 200, true);

        ColumnConfig codigo = new ColumnConfig("Codigo", "codigo", 150, true);
        codigo.setAlign(TextAlign.RIGHT);
        codigo.setEditor(new GridEditor(new TextField()));


        //ColumnConfig ubicacion1017 = new ColumnConfig("Ubicacion", "ubicacion", 100);
        //ubicacion1017.setEditor(new GridEditor(new TextField()));

        ColumnConfig[] columns = new ColumnConfig[]{
            //column ID is company which is later used in setAutoExpandColumn
            idmaterial,
            material,
            codigo,};

        ColumnModel columnModel = new ColumnModel(columns);

        grid1017 = new EditorGridPanel();
        grid1017.setId("grid-lista-Configurar-Material");
        grid1017.setStore(store);
        grid1017.setColumnModel(columnModel);
        grid1017.setTrackMouseOver(true);
        grid1017.setLoadMask(true);
        grid1017.setFrame(true);
        grid1017.setStripeRows(true);
        grid1017.setHeight(350);
        grid1017.setWidth(600);

        editarProducto1017 = new ToolbarButton("Guardar cambios");
        editarProducto1017.setEnableToggle(true);
        QuickTipsConfig tipsConfig3 = new QuickTipsConfig();
        tipsConfig3.setText("Guardar");
        editarProducto1017.setTooltip(tipsConfig3);
        editarProducto1017.addListener(new ButtonListenerAdapter() {

            @Override
            public void onClick(Button button, EventObject e) {
                guardarCambiosInventarioProductos();
                editarProducto1017.setPressed(false);
            }
        });

        grid1017.setBottomToolbar(editarProducto1017);
        add(grid1017);
    }

    private void guardarCambiosInventarioProductos() {
        Record[] records;


        records = grid1017.getStore().getModifiedRecords();

        if (records.length >= 1) {
//            com.google.gwt.user.client.Window.alert("" + records.length);
            JSONArray funcS = new JSONArray();
            JSONObject pa = null;
            String temp;
            for (int i = 0; i < records.length; i++) {
                pa = new JSONObject();
                pa.put("idmateria", new JSONString(records[i].getAsString("idmateria")));
                pa.put("material", new JSONString(records[i].getAsString("material")));
                pa.put("codigo", new JSONString(records[i].getAsString("codigo")));

                funcS.set(i, pa);
                pa = null;
            }
            JSONObject joo = new JSONObject();
            joo.put("materiales", funcS);
            joo.put("idmarca",new JSONString(idmarca));
            String datos = "resultado=" + joo.toString();
            String enlace = "php/Marca.php?funcion=InsertarCodificarMaterialPorMarca&" + datos;
//            com.google.gwt.user.client.Window.alert(enlace);
            Utils.setErrorPrincipal("Guardando los datos de Codificar Material", "cargar");
            final Conector conec = new Conector(enlace, false, "GET");
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
                                //MessageBox.alert(mensajeR);
                                Utils.setErrorPrincipal(mensajeR, "mensaje");
                                CodificarMaterialForm.this.close();

                            } else {
                                //Window.alert(mensajeR);
                                Utils.setErrorPrincipal(mensajeR, "error");
                            }
                        }
                    }

                    public void onError(Request request, Throwable exception) {
                        //Window.alert("Ocurrio un error al conectar con el servidor ");
                        Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
                    }
                });
            } catch (RequestException ex) {
                Utils.setErrorPrincipal("Ocurrio un error al conectar con el servidor", "error");
            }
        } else {
            MessageBox.alert("No existen cambios para guardar.. ");
        }
    }
}  
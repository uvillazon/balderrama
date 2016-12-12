package org.balderrama.client.sistemadetalle;

/**
 *
 * @author 
 */

import com.gwtext.client.data.Record;
import com.gwtext.client.widgets.form.FormPanel;
//import org.balderrama.client.beans.Producto;
import org.balderrama.client.util.LayoutFormPanel;
import org.balderrama.client.venta.Devolucion;
import org.balderrama.client.venta.PanelVenta;

/**
 *
 * @author example
 */
public class FormularioProductoKardex2 {

    private LayoutFormPanel layout;
    FormPanel for_formulario;
    String tipo;
    String titulo = "No definido";
    String idTraspaso;
    String idAlmacen;
    String idcliente;
    String modelo;
    String idmarca;
    String opcion;
     String vendedor;
      String cliente;
       String marca;
        String boleta;

    private ListaProductoSimpleDev listaProducto;
   // private PanelProforma padre;
    private PanelPedidoEEU padre1;
private Devolucion padred1;

    
   public FormularioProductoKardex2(Devolucion padred1,String vendedor,String cliente,String marca,String boleta) {
        this.tipo = "Nuevo";
this.vendedor = vendedor;
this.cliente = cliente;
this.marca = marca;
this.boleta = boleta;
        this.padred1 = padred1;
        setTitulo();
        layout = new LayoutFormPanel(titulo, tipo, 670, 400);
        creatForm();

    }

   

  public ProductoProforma getProductoSeleccionado2() {
        ProductoProforma productoSelected = null;

        Record[] records;

        records = this.listaProducto.getCbSelectionModel().getSelections();

        if (records.length == 1) {

padred1.anadirProducto(records[0].getAsString("idkardextienda"), records[0].getAsString("codigo"), records[0].getAsString("detalle"), records[0].getAsString("talla"), records[0].getAsString("cantidad"), records[0].getAsFloat("precio2"));

        }

        return productoSelected;
    }
    public ListaProductoSimpleDev getListaProducto() {
        return listaProducto;
    }




    public LayoutFormPanel getLayout() {
        return layout;
    }

    private void addComponets() {
        for_formulario.add(listaProducto.getGrid());
    }

    private void creatForm() {
        for_formulario = layout.getForm_formualario();
        layout.setTitulo(titulo);
        createComponents();
        addComponets();
    }

    private void createComponents() {
      //  listaProducto = new ListaProductoSimple("php/IngresoAlmacen.php?funcion=listarmodeloscoleccion&modelo="+modelo+ "&idmarca="+idmarca);
     
       listaProducto = new ListaProductoSimpleDev("php/VentaMayor.php?funcion=listaboletasventa&idvendedor="+vendedor+ "&idcliente="+cliente+ "&idmarca="+marca+ "&boleta="+boleta);
       
        listaProducto.onModuleLoad();
    }
 
    public void setTitulo() {
        this.titulo = "Lista de Boletas Disponibles";
    }

    public void closeFormulario() {
        layout.getWin_ventana().close();
        layout.getWin_ventana().destroy();
    }

    public void showFormulario() {
        layout.getWin_ventana().show();
    }

    public void onFocus() {
        layout.getWin_ventana().setVisible(true);
    }

    public boolean isHidden() {
        return layout.isHidden();
    }

     public ProductoProforma getProductoSeleccionado1() {
        ProductoProforma productoSelected = null;

        Record[] records;

        records = this.listaProducto.getCbSelectionModel().getSelections();

        if (records.length == 1) {
//    padre1.anadirProducto(records[0].getAsString("idmodelo"),records[0].getAsString("linea"),  records[0].getAsString("codigo"),records[0].getAsString("color"),  records[0].getAsString("opciont"), records[0].getAsString("precio"),records[0].getAsString("totalpares"),records[0].getAsString("14"), records[0].getAsString("15"), records[0].getAsString("16"), records[0].getAsString("17"), records[0].getAsString("18"), records[0].getAsString("19"), records[0].getAsString("20"), records[0].getAsString("21"), records[0].getAsString("22"), records[0].getAsString("23"), records[0].getAsString("24"), records[0].getAsString("25"), records[0].getAsString("26"), records[0].getAsString("27"), records[0].getAsString("28"), records[0].getAsString("29"), records[0].getAsString("30"), records[0].getAsString("31"), records[0].getAsString("32"), records[0].getAsString("33"), records[0].getAsString("34"), records[0].getAsString("35"), records[0].getAsString("36"), records[0].getAsString("37"), records[0].getAsString("38"), records[0].getAsString("totalcajas"),records[0].getAsString("totalbs"));
     
        }

        return productoSelected;
    }

   
}


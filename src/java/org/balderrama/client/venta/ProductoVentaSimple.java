/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.venta;

import org.balderrama.client.sistemadetalle.*;

/**
 *
 * @author example
 */
public class ProductoVentaSimple {

    String idProducto;
    //String proveedor;
    String codigo;
    String detalle;
    String talla;
    String cantidad;
    String precio2;
String talla14;
String talla15;
String talla16;
String talla17;
String talla18;
String talla19;
String talla20;
String talla21;
String talla22;
String talla23;
String talla24;
String talla25;
String talla26;
String talla27;
String talla28;
String talla29;
String talla30;
String talla31;
String talla32;
String talla33;
String talla34;
String talla35;
String talla36;
String talla37;
String talla38;

String pares;
    public ProductoVentaSimple() {
    }

    public ProductoVentaSimple(String idProdcuto , String codigo,String detalle, String cantidad,String talla,String precio2,String paress) {
        this.idProducto = idProdcuto;
        this.codigo = codigo;
        this.detalle = detalle;
        this.cantidad = cantidad;
        this.talla = talla;
        this.precio2 = precio2;
         this.pares = paress;
       }

   
    public String getIdProducto() {
        return idProducto;
    }

    public void setIdProducto(String idProducto) {
        this.idProducto = idProducto;
    }

    public String getCodigo() {
        return codigo;
    }

    public void setCodigo(String codigo) {
        this.codigo = codigo;
    }
     

    public String getDetalle() {
        return detalle;
    }

    public void setDetalle(String detalle) {
        this.detalle = detalle;
    }
      public String getTalla() {
        return talla;
    }

    public void setTalla(String talla) {
        this.talla = talla;
    }
      public String getPrecio2() {
        return precio2;
    }

    public void setPrecio2(String precio2) {
        this.precio2 = precio2;
    }
    public String getPares() {
        return pares;
    }

    public void setPares(String paress) {
        this.pares = paress;
    }


}

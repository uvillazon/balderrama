/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.beans;

/**
 *
 * @author example
 */
public class ProductoProforma {

    String idProducto;
    //String proveedor;
    String codigo;
    String detalle;
    String talla;
    String cantidad;
    String precio2;

    public ProductoProforma() {
    }

    public ProductoProforma(String idProdcuto , String codigo,String detalle, String cantidad,String talla,String precio2) {
        this.idProducto = idProdcuto;
        this.codigo = codigo;
        this.detalle = detalle;
        this.cantidad = cantidad;
        this.talla = talla;
        this.precio2 = precio2;
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

}

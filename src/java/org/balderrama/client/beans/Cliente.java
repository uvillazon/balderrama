/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.beans;

/**
 *
 * @author example
 */
public class Cliente {

    String idproveedor;
    String codigo;
    String nombre;
     String apellido;

    String nit;


    public Cliente(String idProveedor, String codigo, String nombre,String apellido, String nit
             ) {

        this.idproveedor = idProveedor;
        this.codigo = codigo;
        this.nombre = nombre;
 this.apellido = apellido;

        this.nit = nit;

       }

    public Cliente(){

    }



    public String getCodigo() {
        return codigo;
    }

    public void setCodigo(String codigo) {
        this.codigo = codigo;
    }

    

    public String getIdproveedor() {
        return idproveedor;
    }

    public void setIdproveedor(String idproveedor) {
        this.idproveedor = idproveedor;
    }

    public String getNit() {
        return nit;
    }

    public void setNit(String nit) {
        this.nit = nit;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }
  public String getApellido() {
        return apellido;
    }

    public void setApellido(String apellido) {
        this.apellido = apellido;
    }
   

   

}

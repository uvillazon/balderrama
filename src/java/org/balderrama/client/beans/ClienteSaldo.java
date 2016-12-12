/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.beans;

/**
 *
 * @author example
 */
public class ClienteSaldo {

    String idcliente;
    String codigo;
    String nombre;
    String ciudad;
    String tipo;
  //  String nit;
    String respresentante;
     String saldo;

   // public Cliente(String codigoBuscado, String codigoCliente, String nombre, String nit, String email, String telefono, String direccion) {
     //   throw new UnsupportedOperationException("Not yet implemented");
   // }

   
    public ClienteSaldo(String idCliente, String codigo, String nombre,
           String saldo) {

        this.idcliente = idCliente;
        this.codigo = codigo;
        this.nombre = nombre;
       // this.nit = nit;
        this.saldo = saldo;

    }

    public ClienteSaldo(){

    }

   

    
    public String getCiudad() {
        return ciudad;
    }

    public void setCiudad(String ciudad) {
        this.ciudad = ciudad;
    }

    public String getCodigo() {
        return codigo;
    }

    public void setCodigo(String codigo) {
        this.codigo = codigo;
    }
public String getSaldo() {
        return saldo;
    }
 public void setSaldo(String saldo) {
        this.saldo = saldo;
    }

    

    public String getIdcliente() {
        return idcliente;
    }

    public void setIdcliente(String idcliente) {
        this.idcliente = idcliente;
    }

    

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getRespresentante() {
        return respresentante;
    }

    public void setRespresentante(String respresentante) {
        this.respresentante = respresentante;
    }

   
    public String getTipo() {
        return tipo;
    }

    public void setTipo(String tipo) {
        this.tipo = tipo;
    }

}

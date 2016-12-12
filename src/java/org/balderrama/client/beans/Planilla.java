/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.beans;

/**
 *
 * @author example
 */
public class Planilla {

    String idempresa;
    String planilla;

   // public Cliente(String codigoBuscado, String codigoCliente, String nombre, String nit, String email, String telefono, String direccion) {
     //   throw new UnsupportedOperationException("Not yet implemented");
   // }

   
    public Planilla(String idEmpresa, String Planilla) {

        this.idempresa = idEmpresa;
        this.planilla = Planilla;
    }

    public Planilla(){

    }

    public String getIdempresa() {
        return idempresa;
    }

    public void setIdcliente(String idempresa) {
        this.idempresa = idempresa;
    }

    
    public String getPlanilla() {
        return planilla;
    }

    public void setPlanilla(String planilla) {
        this.planilla = planilla;
    }


}

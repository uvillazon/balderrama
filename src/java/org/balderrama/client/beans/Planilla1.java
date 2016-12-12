/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package org.balderrama.client.beans;

/**
 *
 * @author example
 */
public class Planilla1 {

    String idempresa;
    String planilla;
Object[][] estiloM;
    public Planilla1(Object[][] estiloMM) {
        this.estiloM = estiloMM;
    }

   // public Cliente(String codigoBuscado, String codigoCliente, String nombre, String nit, String email, String telefono, String direccion) {
     //   throw new UnsupportedOperationException("Not yet implemented");
   // }

   
    public Planilla1(String idEmpresa, String Planilla) {

        this.idempresa = idEmpresa;
        this.planilla = Planilla;
    }

    public Planilla1(){

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
 public Object[][] getEstilo() {
        return estiloM;
    }

    public void setPlanilla(Object[][] planilla) {
        this.estiloM = planilla;
    }

}

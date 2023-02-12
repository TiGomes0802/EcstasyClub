package com.example.ecstasyclub.modelo;

public class Pulseiras {
    private int idPulseira;
    private String estado, tipo, codigorp, nomeEvento, nomeCliente;

    public Pulseiras(int idPulseira, String estado, String tipo, String codigorp, String nomeEvento, String nomeCliente) {
        this.idPulseira = idPulseira ;
        this.estado = estado;
        this.tipo = tipo;
        this.codigorp = codigorp;
        this.nomeEvento = nomeEvento;
        this.nomeCliente = nomeCliente;
    }

    public int getId() {
        return idPulseira;
    }

    public void setId(int id) {
        this.idPulseira = idPulseira;
}

    public String getEstado() {
        return estado;
    }

    public void setEstado(String estado) {
        this.estado = Pulseiras.this.estado;
    }

    public String getTipo() {
        return this.tipo;
    }

    public void setTipo(String tipo) {
        this.tipo = tipo;
    }

    public String getCodigorp() {
        return codigorp;
    }

    public void setCodigorp(String codigorp) {
        this.codigorp = codigorp;
    }

    public String getIdevento() {
        return nomeEvento;
    }

    public void setIdevento(String nomeEvento) {this.nomeEvento = Pulseiras.this.nomeEvento;}

    public String getIdcliente() { return nomeCliente; }

    public void  setIdcliente(String nomeCliente) {this.nomeCliente = Pulseiras.this.nomeCliente;}

}
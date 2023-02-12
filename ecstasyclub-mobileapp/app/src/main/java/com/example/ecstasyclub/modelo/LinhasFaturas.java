package com.example.ecstasyclub.modelo;

public class LinhasFaturas {
    private int idLinhaFatura, idFatura;
    private String bebida;

    public LinhasFaturas(int idLinhaFatura, String bebida, int idFatura) {
        this.idLinhaFatura = idLinhaFatura ;
        this.bebida = bebida;
        this.idFatura = idFatura;
    }

    public int getId() {
        return idLinhaFatura;
    }
    public void setId(int id) {
        this.idLinhaFatura = idLinhaFatura;
    }

    public String getBebida() {return bebida;}
    public void setBebida(String bebida) {this.bebida = bebida;}

    public int getIdFatura() {
        return idFatura;
    }
    public void setIdFatura(int idFatura) {this.idFatura = idFatura;}
}
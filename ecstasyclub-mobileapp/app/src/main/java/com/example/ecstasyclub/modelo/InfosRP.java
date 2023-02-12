package com.example.ecstasyclub.modelo;

public class InfosRP {

    private String nomeEvento;
    private int bilhetes, id;

    public InfosRP(int id, String nomeEvento, int bilhetes) {
        this.id = id;
        this.nomeEvento = nomeEvento ;
        this.bilhetes = bilhetes;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {this.id = id;}

    public String getNomeEvento() {
        return nomeEvento;
    }

    public void setNomeEvento(String nomeEvento) {
        this.nomeEvento = nomeEvento;
    }

    public int getBilhetes() {
        return bilhetes;
    }

    public void setBilhetes(int bilhetes) {this.bilhetes = bilhetes;}
}
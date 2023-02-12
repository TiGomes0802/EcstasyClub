package com.example.ecstasyclub.modelo;

public class Faturas {
    private int id;
    private String data, tipo_pulseira, nome_evento;
    private float preco;

    public Faturas(int idFatura, String data, float preco, String tipo_pulseira, String nome_evento) {
        this.id = idFatura ;
        this.data = data;
        this.preco = preco;
        this.tipo_pulseira = tipo_pulseira;
        this.nome_evento = nome_evento;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getData() {
        return data;
    }

    public void setData(String data) {
        this.data = data;
    }

    public float getPreco() {
        return preco;
    }

    public void setPreco(float preco) {
        this.preco = preco;
    }

    public String getTipoPulseira() {
        return tipo_pulseira;
    }

    public void setTipoPulseira(String tipo_pulseira) {
        this.tipo_pulseira = tipo_pulseira;
    }

    public String getNomeEvento() {
        return nome_evento;
    }

    public void setNomeEvento(String nome_evento) {
        this.nome_evento = nome_evento;
    }

}
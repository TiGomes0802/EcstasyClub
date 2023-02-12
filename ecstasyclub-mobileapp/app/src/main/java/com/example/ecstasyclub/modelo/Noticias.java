package com.example.ecstasyclub.modelo;

public class Noticias {
    private int idNoticia;
    private String titulo, descricao, datanoticia, criador;

    public Noticias(int idNoticia, String titulo, String descricao, String datanoticia, String criador) {
        this.idNoticia = idNoticia ;
        this.titulo = titulo;
        this.descricao = descricao;
        this.datanoticia = datanoticia;
        this.criador = criador;

    }


    public int getId() {
        return idNoticia;
    }

    public void setId(int id) {
        this.idNoticia = idNoticia;
    }

    public String getTitulo() {
        return titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }

    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }

    public String getDatanoticia() {
        return datanoticia;
    }

    public void SetDatanoticia(String datanoticia) { this.datanoticia = datanoticia; }

    public String getCriador() {
        return criador;
    }

    public void setCriador(String criador) {
        this.criador = criador;
    }


}
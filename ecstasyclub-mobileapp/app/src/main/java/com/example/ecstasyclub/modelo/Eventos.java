package com.example.ecstasyclub.modelo;

public class Eventos {
    private int idEvento, numbilhetesdisp;
    private String nome, descricao, cartaz, dataevento, estado, criador, tipoEvento;
    private float preco;

    public Eventos(int idEvento, String nome, String descricao, String cartaz, String dataevento, int numbilhetesdisp, float preco, String estado, String criador, String tipoEvento) {
        this.idEvento = idEvento ;
        this.nome = nome;
        this.descricao = descricao;
        this.cartaz = cartaz;
        this.dataevento = dataevento;
        this.numbilhetesdisp = numbilhetesdisp;
        this.preco = preco;
        this.estado = estado;
        this.criador = criador;
        this.tipoEvento = tipoEvento;
    }

    public int getId() {
        return idEvento;
    }

    public void setId(int id) {
        this.idEvento = idEvento;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getDescricao() {
        return descricao;
    }

    public void setDescricao(String descricao) {
        this.descricao = descricao;
    }

    public String getCartaz() {
        return cartaz;
    }

    public void setCartaz(String cartaz) {
        this.cartaz = cartaz;
    }

    public String getDataevento() {
        return dataevento;
    }

    public void setDataevento(String dataevento) {
        this.dataevento = dataevento;
    }

    public int getNumbilhetesdisp() {
        return numbilhetesdisp;
    }

    public void setNumbilhetesdisp(int numbilhetesdisp) {
        this.numbilhetesdisp = numbilhetesdisp;
    }

    public float getPreco() {
        return preco;
    }

    public void setPreco(float preco) {
        this.preco = preco;
    }

    public String getEstado() {
        return estado;
    }

    public void setEstado(String estado) {
        this.estado = estado;
    }

    public String getCriador() {
        return criador;
    }

    public void setCriador(String criador) {
        this.criador = criador;
    }

    public String getTipoEvento() {return tipoEvento;}

    public void setTipoEvento(String tipoEvento) {this.tipoEvento = tipoEvento;}
}
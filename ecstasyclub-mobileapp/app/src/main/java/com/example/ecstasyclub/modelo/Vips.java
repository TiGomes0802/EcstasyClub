package com.example.ecstasyclub.modelo;

public class Vips {
    private int idEvento, npessoas, nbebidas;
    private float preco;

    public Vips(int idEvento,int npessoas, int nbebidas, float preco) {
        this.idEvento = idEvento ;
        this.npessoas = npessoas;
        this.nbebidas = nbebidas;
        this.preco = preco;
    }

    public int getId() {
        return idEvento;
    }

    public void setId(int id) {
        this.idEvento = idEvento;
    }

    public int getNpessoas() {
        return npessoas;
    }

    public void setNpessoas(int npessoas) {this.npessoas = npessoas;}

    public int getNbebidas() {return nbebidas;}

    public void setNbebidas(int nbebidas) {this.nbebidas = nbebidas;}

    public float getPreco() {return preco;}

    public void setPreco(float preco) {this.preco = preco;}
}
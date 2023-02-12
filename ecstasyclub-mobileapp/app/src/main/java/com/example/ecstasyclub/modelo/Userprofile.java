package com.example.ecstasyclub.modelo;

public class Userprofile {
    private int idUserprofile;
    private String nome, apelido, username, email, datanascimento, sexo, role;

    public Userprofile(int idUserprofile, String nome, String apelido, String username, String email, String datanascimento, String sexo, String role) {
        this.idUserprofile = idUserprofile ;
        this.nome = nome;
        this.apelido = apelido;
        this.username = username;
        this.email = email;
        this.datanascimento = datanascimento;
        this.sexo = sexo;
        this.role = role;
    }

    public int getId() {return idUserprofile;}

    public void setId(int id) {this.idUserprofile = idUserprofile;}

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getApelido() {
        return apelido;
    }

    public void setApelido(String apelido) {
        this.apelido = apelido;
    }

    public String getUsername() {return username;}

    public void setUsername(String username) {
        this.username = username;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getDatanascimento() {
        return datanascimento;
    }

    public void setDatanascimento(String datanascimento) {
        this.datanascimento = datanascimento;
    }

    public String getSexo() {
        return sexo;
    }

    public void setSexo(String sexo) {
        this.sexo = sexo;
    }

    public String getRole() {return role;}

    public void setRole(String role) {this.role = role;}
}
package com.example.ecstasyclub.listeners;

import com.example.ecstasyclub.modelo.Noticias;

import java.util.ArrayList;

public interface NoticiasListener {
    void onRefreshListaNoticias(ArrayList<Noticias> noticias);
}

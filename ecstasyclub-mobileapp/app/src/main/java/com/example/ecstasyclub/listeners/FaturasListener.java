package com.example.ecstasyclub.listeners;

import com.example.ecstasyclub.modelo.Faturas;

import java.util.ArrayList;

public interface FaturasListener {
    void onRefreshListaFaturas(ArrayList<Faturas> faturas);
}

package com.example.ecstasyclub.listeners;

import com.example.ecstasyclub.modelo.LinhasFaturas;

import java.util.ArrayList;

public interface LinhasFaturasListener {
    void onRefreshListaLinhasFaturas(ArrayList<LinhasFaturas> linhasfaturas);
}
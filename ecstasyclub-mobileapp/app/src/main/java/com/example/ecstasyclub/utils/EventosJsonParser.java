package com.example.ecstasyclub.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.ecstasyclub.modelo.Eventos;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.math.BigDecimal;
import java.util.ArrayList;

public class EventosJsonParser {

    public static ArrayList<Eventos> parseJsonEventos (JSONArray response){
        ArrayList<Eventos> eventos = new ArrayList<>();
        try {
            for(int i = 0; i <response.length(); i++){
                JSONObject evento = (JSONObject) response.get(i);
                int id = evento.getInt("id");
                String nome = evento.getString("nome");
                String descricao = evento.getString("descricao");
                String cartaz = evento.getString("cartaz");
                String dataevento = evento.getString("dataevento");
                int numbilhetesdisp = evento.getInt("numbilhetesdisp");
                float preco = BigDecimal.valueOf(evento.getDouble("preco")).floatValue();
                String estado = evento.getString("estado");
                String criador = evento.getString("id_criador");
                String tipoEvento = evento.getString("id_tipo_evento");
                Eventos auxEventos = new Eventos(id, nome, descricao, cartaz, dataevento, numbilhetesdisp, preco, estado, criador, tipoEvento);
                eventos.add(auxEventos);
            }
        }catch (JSONException e) {
            e.printStackTrace();
        }
        return eventos;
    }

    public static Boolean isConnectionInternet(Context context){
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = cm.getActiveNetworkInfo();
        return networkInfo != null && networkInfo.isConnected();
    }
}
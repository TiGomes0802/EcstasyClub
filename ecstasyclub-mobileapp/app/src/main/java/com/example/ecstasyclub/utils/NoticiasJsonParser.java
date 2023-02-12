package com.example.ecstasyclub.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.ecstasyclub.modelo.Noticias;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class NoticiasJsonParser {

    public static ArrayList<Noticias> parseJsonNoticias (JSONArray response){
        ArrayList<Noticias> noticias = new ArrayList<>();
        try {
            for(int i = 0; i <response.length(); i++){
                JSONObject noticia = (JSONObject) response.get(i);
                int id = noticia.getInt("id");
                String titulo = noticia.getString("titulo");
                String datanoticia = noticia.getString("datanoticia");
                String descricao = noticia.getString("descricao");
                String criador = noticia.getString("id_criador");
                Noticias auxNoticias = new Noticias(id, titulo, descricao, datanoticia, criador);
                noticias.add(auxNoticias);
            }
        }catch (JSONException e) {
            e.printStackTrace();
        }
        return noticias;
    }

    public static Boolean isConnectionInternet(Context context){
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = cm.getActiveNetworkInfo();
        return networkInfo != null && networkInfo.isConnected();
    }
}
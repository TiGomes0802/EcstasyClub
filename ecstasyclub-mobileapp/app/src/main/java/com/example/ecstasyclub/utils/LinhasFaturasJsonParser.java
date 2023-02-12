package com.example.ecstasyclub.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.ecstasyclub.modelo.LinhasFaturas;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class LinhasFaturasJsonParser {

    public static ArrayList<LinhasFaturas> parseJsonLinhasFaturas (JSONArray response){
        ArrayList<LinhasFaturas> linhasfaturas = new ArrayList<>();
        try {
            for(int i = 0; i <response.length(); i++){
                JSONObject linhafatura = (JSONObject) response.get(i);
                int id = linhafatura.getInt("id");
                String bebida = linhafatura.getString("id_bebida");
                int idFatura = linhafatura.getInt("id_fatura");
                LinhasFaturas auxLinhasFaturas = new LinhasFaturas(id, bebida, idFatura);
                linhasfaturas.add(auxLinhasFaturas);
            }
        }catch (JSONException e) {
            e.printStackTrace();
        }
        return linhasfaturas;
    }

    public static Boolean isConnectionInternet(Context context){
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = cm.getActiveNetworkInfo();
        return networkInfo != null && networkInfo.isConnected();
    }
}
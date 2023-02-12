package com.example.ecstasyclub.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.ecstasyclub.modelo.Faturas;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.math.BigDecimal;
import java.util.ArrayList;

public class FaturasJsonParser {

    public static ArrayList<Faturas> parseJsonFaturas (JSONArray response){
        ArrayList<Faturas> faturas = new ArrayList<>();
        try {
            for(int i = 0; i <response.length(); i++){
                JSONObject fatura = (JSONObject) response.get(i);
                int id = fatura.getInt("id_fatura");
                String data = fatura.getString("data");
                float preco = BigDecimal.valueOf(fatura.getDouble("preco")).floatValue();
                String tipo_pulseira = fatura.getString("tipo_pulseira");
                String nome_evento = fatura.getString("nome_evento");
                Faturas auxFaturas = new Faturas(id, data, preco, tipo_pulseira, nome_evento);
                faturas.add(auxFaturas);
            }
        }catch (JSONException e) {
            e.printStackTrace();
        }
        return faturas;
    }

    public static Boolean isConnectionInternet(Context context){
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = cm.getActiveNetworkInfo();
        return networkInfo != null && networkInfo.isConnected();
    }
}
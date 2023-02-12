package com.example.ecstasyclub.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.ecstasyclub.modelo.Pulseiras;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.math.BigDecimal;
import java.util.ArrayList;

public class PulseirasJsonParser {

    public static ArrayList<Pulseiras> parseJsonPulseiras (JSONArray response){
        ArrayList<Pulseiras> pulseiras = new ArrayList<>();
        try {
            for(int i = 0; i <response.length(); i++){
                JSONObject pulseira = (JSONObject) response.get(i);
                int id = pulseira.getInt("id");
                String estado = pulseira.getString("estado");
                String tipo = pulseira.getString("tipo");
                String codigorp = pulseira.getString("codigorp");
                String id_evento = pulseira.getString("id_evento");
                String id_cliente = pulseira.getString("id_cliente");
                Pulseiras auxPulseiras = new Pulseiras(id, estado, tipo, codigorp, id_evento, id_cliente);
                pulseiras.add(auxPulseiras);
            }
        }catch (JSONException e) {
            e.printStackTrace();
        }
        return pulseiras;
    }

    public static ArrayList<Pulseiras> parseJsonPulseirasNULL(JSONArray response) {
        ArrayList<Pulseiras> pulseiras = new ArrayList<>();
        try {
            for(int i = 0; i <response.length(); i++){
                JSONObject pulseira = (JSONObject) response.get(i);
                int id = pulseira.getInt("id");
                String estado = pulseira.getString("estado");
                String tipo = pulseira.getString("tipo");
                String codigorp = pulseira.getString("codigorp");
                String id_evento = pulseira.getString("id_evento");
                String id_cliente = pulseira.getString("id_cliente");
                Pulseiras auxPulseiras = new Pulseiras(id, estado, tipo, codigorp, id_evento, id_cliente);
                pulseiras.add(auxPulseiras);
            }
        }catch (JSONException e) {
            e.printStackTrace();
        }
        return pulseiras;
    }

    public static Object parseJsonPulseira(JSONObject response) {
        Object pulseira = new Object();
        try {
            int id = response.getInt("id");
            String estado = response.getString("estado");
            String tipo = response.getString("tipo");
            String codigorp = response.getString("codigorp");
            String id_evento = response.getString("id_evento");
            String id_cliente = response.getString("id_cliente");
            pulseira = new Pulseiras(id, estado, tipo, codigorp, id_evento, id_cliente);
        }catch (JSONException e) {
            e.printStackTrace();
        }
        return pulseira;
    }

    public static Pulseiras parseJsonBilhete (String response){
        Pulseiras auxPulseiras = null;
        try {
            JSONObject pulseira = new JSONObject(response);
            int id = pulseira.getInt("id");
            String estado = pulseira.getString("estado");
            String tipo = pulseira.getString("tipo");
            String codigorp = pulseira.getString("codigorp");
            String id_evento = pulseira.getString("id_evento");
            String id_cliente = pulseira.getString("id_cliente");
            auxPulseiras = new Pulseiras(id, estado, tipo, codigorp, id_evento, id_cliente);
        } catch (JSONException e) {
            e.printStackTrace();
        }
        return auxPulseiras;
    }

    public static Boolean isConnectionInternet(Context context){
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = cm.getActiveNetworkInfo();
        return networkInfo != null && networkInfo.isConnected();
    }
}
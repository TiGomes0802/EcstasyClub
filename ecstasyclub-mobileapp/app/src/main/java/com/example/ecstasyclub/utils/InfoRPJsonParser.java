package com.example.ecstasyclub.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.ecstasyclub.modelo.InfosRP;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class InfoRPJsonParser {

    public static ArrayList<InfosRP> parseJsonInfosRP (JSONArray response){
        ArrayList<InfosRP> infosrp = new ArrayList<>();
        try {
            for(int i = 0; i <response.length(); i++){
                JSONObject inforp = (JSONObject) response.get(i);
                int id = inforp.getInt("id_evento");
                String nomeEvento = inforp.getString("nomeEvento");
                int bilhetes = inforp.getInt("bilhetes_vendidos");
                InfosRP auxInfosRP = new InfosRP(id, nomeEvento, bilhetes);
                infosrp.add(auxInfosRP);
            }
        }catch (JSONException e) {
            e.printStackTrace();
        }
        return infosrp;
    }

    public static Boolean isConnectionInternet(Context context){
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = cm.getActiveNetworkInfo();
        return networkInfo != null && networkInfo.isConnected();
    }
}
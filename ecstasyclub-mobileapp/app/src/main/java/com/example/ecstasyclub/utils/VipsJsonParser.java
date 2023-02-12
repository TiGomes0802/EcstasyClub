package com.example.ecstasyclub.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.ecstasyclub.modelo.Userprofile;
import com.example.ecstasyclub.modelo.Vips;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.math.BigDecimal;
import java.util.ArrayList;

public class VipsJsonParser {

    public static ArrayList<Vips> parseJsonVips (JSONArray response){
        ArrayList<Vips> vips = new ArrayList<>();
        try {
            for(int i = 0; i <response.length(); i++){
                JSONObject vip = (JSONObject) response.get(i);
                int id = vip.getInt("id");
                int npessoas = vip.getInt("npessoas");
                int nbebidas = vip.getInt("nbebidas");
                float preco = BigDecimal.valueOf(vip.getDouble("preco")).floatValue();
                Vips auxVips = new Vips(id, npessoas, nbebidas, preco);
                vips.add(auxVips);
            }
        }catch (JSONException e) {
            e.printStackTrace();
        }
        return vips;
    }

    public static Object parseJsonVip (JSONObject response){
        Object vip = new Object();
        try {
            int id = response.getInt("id");
            int npessoas = response.getInt("npessoas");
            int nbebidas = response.getInt("nbebidas");
            float preco = BigDecimal.valueOf(response.getDouble("preco")).floatValue();
            vip = new Vips(id, npessoas, nbebidas, preco);
        }catch (JSONException e) {
            e.printStackTrace();
        }
        return vip;
    }

    public static Boolean isConnectionInternet(Context context){
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = cm.getActiveNetworkInfo();
        return networkInfo != null && networkInfo.isConnected();
    }
}
package com.example.ecstasyclub.utils;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

import com.example.ecstasyclub.modelo.Userprofile;

import org.json.JSONException;
import org.json.JSONObject;

public class UserprofileJsonParser {

    public static Object parseJsonUserprofile (JSONObject response){
        Object userprofiles = new Object();
        try {
            int id = response.getInt("id");
            String nome = response.getString("nome");
            String apelido = response.getString("apelido");
            String username = response.getString("username");
            String email = response.getString("email");
            String datanascimento = response.getString("datanascimento");
            String sexo = response.getString("sexo");
            String role = response.getString("role");
            userprofiles = new Userprofile(id, nome, apelido, username, email, datanascimento, sexo, role);
        }catch (JSONException e) {
            e.printStackTrace();
        }
        return userprofiles;
    }

    public static Boolean isConnectionInternet(Context context){
        ConnectivityManager cm = (ConnectivityManager) context.getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = cm.getActiveNetworkInfo();
        return networkInfo != null && networkInfo.isConnected();
    }
}
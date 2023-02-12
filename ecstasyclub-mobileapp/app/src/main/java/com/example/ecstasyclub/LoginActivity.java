package com.example.ecstasyclub;

import android.content.Intent;
import android.os.Bundle;
import android.util.Patterns;
import android.view.View;
import android.widget.EditText;

import androidx.appcompat.app.AppCompatActivity;

import com.example.ecstasyclub.listeners.UserprofileListener;
import com.example.ecstasyclub.modelo.SingletonEcstasyClub;
import com.example.ecstasyclub.modelo.Userprofile;

import java.util.Objects;

public class LoginActivity extends AppCompatActivity implements UserprofileListener {


    private EditText etUsername,etPassword;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        etUsername=findViewById(R.id.etUsername);
        etPassword=findViewById(R.id.etPassword);

        SingletonEcstasyClub.getInstance(this).setUserprofileListener(this);
    }

    public void onClickLogin(View view) {
        String username = etUsername.getText().toString();
        String pass = etPassword.getText().toString();

        SingletonEcstasyClub.getInstance(this).getLoginAPI(this, username, pass);
    }

    @Override
    public void onRefreshUserprofile(Object userprofile) {
        Userprofile user = (Userprofile) SingletonEcstasyClub.getInstance(this).getUserprofile();
        if(Objects.equals(user.getRole(), "seguranca")){
            Intent intent = new Intent(this,SegurancaActivity.class);
            startActivity(intent);
            finish();
        } else {
            if(user.getRole() != null){
                Intent intent = new Intent(this,ClienteActivity.class);
                startActivity(intent);
                finish();
            }
        }
    }
}
package com.example.ecstasyclub;

import android.content.Intent;
import android.os.Bundle;
import android.view.MenuItem;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;
import androidx.fragment.app.Fragment;

import android.Manifest;
import android.content.pm.PackageManager;
import android.os.Bundle;
import android.view.MenuItem;
import android.widget.Toast;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class SegurancaActivity extends AppCompatActivity {

    private final int CAMERA_PERMISSION_CODE = 112;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_seguranca);

        checkPermission(Manifest.permission.CAMERA, CAMERA_PERMISSION_CODE);

        //Bottom nav
        BottomNavigationView btnNav = findViewById(R.id.bottomNavigationview);
        btnNav.setOnNavigationItemSelectedListener(navListener);

        getSupportFragmentManager().beginTransaction().replace(R.id.framgment_layout, new EventosFragment()).commit();
    }

    private final BottomNavigationView.OnNavigationItemSelectedListener navListener = new BottomNavigationView.OnNavigationItemSelectedListener() {
        @Override
        public boolean onNavigationItemSelected(@NonNull MenuItem item) {
            Fragment selectedFragment = null;

            switch (item.getItemId()) {
                case R.id.item1:
                    selectedFragment = new EventosFragment();
                    break;
                case R.id.item2:
                    selectedFragment = new PerfilSegurancaFragment();
                    break;
            }

            //Begin Transaction
            getSupportFragmentManager().beginTransaction().replace(R.id.framgment_layout, selectedFragment).commit();

            return true;
        }

    };

    public void checkPermission(String permission, int requestCode){
        if(ContextCompat.checkSelfPermission(SegurancaActivity.this,permission) == PackageManager.PERMISSION_DENIED){
            //Take Permissão
            ActivityCompat.requestPermissions(SegurancaActivity.this, new String[]{permission}, requestCode);
        }else{
            Toast.makeText(SegurancaActivity.this, "Permissão garantida", Toast.LENGTH_SHORT).show();
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);

        if (requestCode == CAMERA_PERMISSION_CODE)  {
            if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                Toast.makeText(this, "Permission GRANTED", Toast.LENGTH_SHORT).show();
            } else {
                Toast.makeText(this, "Permission DENIED", Toast.LENGTH_SHORT).show();
            }
        }
    }
}
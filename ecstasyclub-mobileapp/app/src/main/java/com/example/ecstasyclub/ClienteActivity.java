package com.example.ecstasyclub;

import android.os.Bundle;
import android.view.MenuItem;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import com.google.android.material.bottomnavigation.BottomNavigationView;

public class ClienteActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cliente);

        //Bottom nav
        BottomNavigationView btnNav = findViewById(R.id.bottomNavigationview);
        btnNav.setOnNavigationItemSelectedListener(navListener);

        getSupportFragmentManager().beginTransaction()
                .replace(R.id.framgment_layout, new PulseiraFragment()).commit();
    }

    private final BottomNavigationView.OnNavigationItemSelectedListener navListener = new BottomNavigationView.OnNavigationItemSelectedListener() {
        @Override
        public boolean onNavigationItemSelected(@NonNull MenuItem item) {
            Fragment selectedFragment = null;

            switch (item.getItemId()) {
                case R.id.item1:
                    selectedFragment = new PulseiraFragment();
                    break;
                case R.id.item2:
                    selectedFragment = new EventosFragment();
                    break;
                case R.id.item3:
                    selectedFragment = new NoticiasFragment();
                    break;
                case R.id.item4:
                    selectedFragment = new PerfilFragment();
                    break;
            }

            //Begin Transaction
            getSupportFragmentManager().beginTransaction()
                    .replace(R.id.framgment_layout, selectedFragment).commit();

            return true;
        }

    };
}
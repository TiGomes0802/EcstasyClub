package com.example.ecstasyclub;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;

import androidx.fragment.app.Fragment;

public class PulseiraFragment extends Fragment {

    private Button btn_naousado, btn_usado;

    public PulseiraFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_pulseira, container, false);

        btn_naousado = (Button) view.findViewById(R.id.btn_naousado);
        btn_usado = (Button) view.findViewById(R.id.btn_usado);



        getParentFragmentManager().beginTransaction()
                .replace(R.id.fragment_pulseira, new PulseiraNaoUsadaFragment()).commit();

        btn_naousado.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(v.getId() == R.id.btn_naousado){
                    getParentFragmentManager().beginTransaction()
                            .replace(R.id.fragment_pulseira, new PulseiraNaoUsadaFragment()).commit();

                    btn_naousado.setBackgroundResource(R.drawable.ativo_naousada);
                    btn_usado.setBackgroundResource(R.drawable.desativo_usado);
                }
            }

        });

        btn_usado.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(v.getId() == R.id.btn_usado){
                    getParentFragmentManager().beginTransaction()
                            .replace(R.id.fragment_pulseira, new PulseiraUsadaFragment()).commit();

                    btn_naousado.setBackgroundResource(R.drawable.desativo_naousada);
                    btn_usado.setBackgroundResource(R.drawable.ativo_usado);
                }
            }

        });
        return view;
    }
}
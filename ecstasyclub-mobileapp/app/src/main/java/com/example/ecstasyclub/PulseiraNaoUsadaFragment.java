package com.example.ecstasyclub;

import android.annotation.SuppressLint;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListView;

import androidx.fragment.app.Fragment;

import com.example.ecstasyclub.adaptadores.ListaPulseirasNaoUsadasAdaptador;
import com.example.ecstasyclub.listeners.PulseirasListener;
import com.example.ecstasyclub.modelo.Pulseiras;
import com.example.ecstasyclub.modelo.SingletonEcstasyClub;
import com.example.ecstasyclub.modelo.Userprofile;

import java.util.ArrayList;


public class PulseiraNaoUsadaFragment extends Fragment implements PulseirasListener {

    private ListView listapulseiras;

    public PulseiraNaoUsadaFragment() {
        // Required empty public constructor
    }

    @SuppressLint("MissingInflatedId")
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_pulseira_nao_usada, container, false);
        setHasOptionsMenu(true);

        listapulseiras = view.findViewById(R.id.listapulseiras);

        SingletonEcstasyClub.getInstance(getContext()).setPulseirasListener(this);
        Userprofile user = (Userprofile) SingletonEcstasyClub.getInstance(getContext()).getUserprofile();
        SingletonEcstasyClub.getInstance(getContext()).getallPulseirasAPI(getContext(), user.getId(),"ativa");

        return view;
    }

    @Override
    public void onRefreshListaPulseiras(ArrayList<Pulseiras> pulseiras) {
        if(pulseiras != null)
            listapulseiras.setAdapter(new ListaPulseirasNaoUsadasAdaptador(pulseiras,getContext()));
    }
}
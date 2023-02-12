package com.example.ecstasyclub;

import android.annotation.SuppressLint;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListView;

import androidx.fragment.app.Fragment;

import com.example.ecstasyclub.adaptadores.ListaInfosRPAdaptador;
import com.example.ecstasyclub.listeners.InfosRPListener;
import com.example.ecstasyclub.modelo.SingletonEcstasyClub;
import com.example.ecstasyclub.modelo.InfosRP;

import java.util.ArrayList;

public class ListaInfosRPFragment extends Fragment implements InfosRPListener {
    private ListView listaInfoRP;

    public ListaInfosRPFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_lista_inforp, container, false);
        setHasOptionsMenu(true);

        assert getArguments() != null;
        int id_user = getArguments().getInt("ID_RP");

        listaInfoRP = view.findViewById(R.id.listaInfoRP);
        SingletonEcstasyClub.getInstance(getContext()).setInfosRPListener(this);
        SingletonEcstasyClub.getInstance(getContext()).getAllInfoCodigoRPAPI(getContext(), id_user);

        return view;
    }

    @Override
    public void onRefreshListaInfosRP(ArrayList<InfosRP> infosrp) {
        if(infosrp != null)
            listaInfoRP.setAdapter(new ListaInfosRPAdaptador(infosrp,getContext()));
    }
}
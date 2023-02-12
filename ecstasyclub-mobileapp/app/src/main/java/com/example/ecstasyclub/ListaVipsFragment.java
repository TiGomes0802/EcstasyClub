package com.example.ecstasyclub;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;

import com.example.ecstasyclub.adaptadores.ListaVipsAdaptador;
import com.example.ecstasyclub.listeners.VipsListener;
import com.example.ecstasyclub.modelo.SingletonEcstasyClub;
import com.example.ecstasyclub.modelo.Userprofile;
import com.example.ecstasyclub.modelo.Vips;

import java.util.ArrayList;
import java.util.Objects;

public class ListaVipsFragment extends Fragment implements VipsListener {
    private ListView listaTipoPulseiras;
    private int id_evento;
    private String codigorp , tipo;

    public ListaVipsFragment() {
        // Required empty public constructor
    }

    @SuppressLint("MissingInflatedId")
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_lista_vips, container, false);
        setHasOptionsMenu(true);

        assert getArguments() != null;
        codigorp = getArguments().getString("CODIGORP");
        id_evento = getArguments().getInt("ID_EVENTO");

        listaTipoPulseiras = view.findViewById(R.id.listaTipoPulseiras);
        SingletonEcstasyClub.getInstance(getContext()).setVipsListener(this);
        Userprofile user = (Userprofile) SingletonEcstasyClub.getInstance(getContext()).getUserprofile();
        SingletonEcstasyClub.getInstance(getContext()).getAllVipsDisponiveisAPI(getContext(), id_evento);

        listaTipoPulseiras.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int position, long id) {
                Vips vip = (Vips) SingletonEcstasyClub.getInstance(getContext()).getVip((int) id);
                if(vip.getId() == 0){
                    tipo = "normal";
                }else{
                    tipo = "vip";
                }
                SingletonEcstasyClub.getInstance(getContext()).adicionarPulseiraAPI(getContext(), id_evento, user.getId(), vip.getId(),vip.getPreco(), codigorp, tipo);

                Intent intent = new Intent(getActivity(), ClienteActivity.class);
                startActivity(intent);
            }

        });
        return view;
    }

    @Override
    public void onRefreshListaVips(ArrayList<Vips> vips) {
        if(vips != null)
            listaTipoPulseiras.setAdapter(new ListaVipsAdaptador(vips,getContext()));
    }
}
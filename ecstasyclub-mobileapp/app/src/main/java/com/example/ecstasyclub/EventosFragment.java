package com.example.ecstasyclub;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import android.widget.AdapterView;
import android.widget.ListView;

import com.example.ecstasyclub.adaptadores.ListaEventosAdaptador;
import com.example.ecstasyclub.listeners.EventosListener;
import com.example.ecstasyclub.modelo.Eventos;
import com.example.ecstasyclub.modelo.SingletonEcstasyClub;
import com.example.ecstasyclub.modelo.Userprofile;

import java.util.ArrayList;
import java.util.Objects;

public class EventosFragment extends Fragment implements EventosListener {
    private ListView listaEventos;

    public EventosFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_eventos, container, false);
        setHasOptionsMenu(true);

        listaEventos=view.findViewById(R.id.listaEventos);

        SingletonEcstasyClub.getInstance(getContext()).setEventosListener(this);
        SingletonEcstasyClub.getInstance(getContext()).getAllEventosAPI(getContext(), "ativo");

        listaEventos.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int position, long id) {
                Userprofile user = (Userprofile) SingletonEcstasyClub.getInstance(getContext()).getUserprofile();
                Fragment fragment;
                if(Objects.equals(user.getRole(), "seguranca")){
                    fragment = new ScanFragment();
                } else {
                    fragment = new DetalhesEvento();
                }
                FragmentManager fragmentManager = getParentFragmentManager();
                FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                Bundle bundle = new Bundle();
                bundle.putInt("ID_EVENTO", (int) id);
                fragment.setArguments(bundle);
                fragmentTransaction.replace(R.id.framgment_layout, fragment);
                fragmentTransaction.commit();
            }
        });
        return view;
    }

    @Override
    public void onRefreshListaEventos(ArrayList<Eventos> eventos) {
        if(eventos != null)
            listaEventos.setAdapter(new ListaEventosAdaptador(eventos,getContext()));
    }
}
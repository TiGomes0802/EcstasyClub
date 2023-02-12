package com.example.ecstasyclub;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ListView;

import androidx.fragment.app.Fragment;

import com.example.ecstasyclub.adaptadores.ListaNoticiasAdaptador;
import com.example.ecstasyclub.listeners.NoticiasListener;
import com.example.ecstasyclub.modelo.Noticias;
import com.example.ecstasyclub.modelo.SingletonEcstasyClub;

import java.util.ArrayList;

public class NoticiasFragment extends Fragment implements NoticiasListener {
    private ListView ListaNoticias;

    public NoticiasFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_noticias, container, false);
        setHasOptionsMenu(true);

        ListaNoticias=view.findViewById(R.id.ListaNoticias);
        SingletonEcstasyClub.getInstance(getContext()).setNoticiasListener(this);
        SingletonEcstasyClub.getInstance(getContext()).GetAllNoticiasAPI(getContext());

        return view;
    }

    @Override
    public void onRefreshListaNoticias(ArrayList<Noticias> noticias) {
        if(noticias != null)
            ListaNoticias.setAdapter(new ListaNoticiasAdaptador(noticias,getContext()));
    }
}
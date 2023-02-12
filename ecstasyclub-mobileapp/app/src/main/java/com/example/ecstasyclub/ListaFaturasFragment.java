package com.example.ecstasyclub;

import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ListView;

import com.example.ecstasyclub.adaptadores.ListaFaturasAdaptador;
import com.example.ecstasyclub.adaptadores.ListaVipsAdaptador;
import com.example.ecstasyclub.listeners.FaturasListener;
import com.example.ecstasyclub.modelo.Faturas;
import com.example.ecstasyclub.modelo.SingletonEcstasyClub;
import com.example.ecstasyclub.modelo.Userprofile;

import java.util.ArrayList;
import java.util.Objects;

public class ListaFaturasFragment extends Fragment implements FaturasListener {
    private ListView listaFaturas;
    private int id;

    public ListaFaturasFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_lista_faturas, container, false);
        setHasOptionsMenu(true);

        assert getArguments() != null;
        id = getArguments().getInt("ID_USER");

        listaFaturas=view.findViewById(R.id.listaFaturas);
        SingletonEcstasyClub.getInstance(getContext()).setFaturasListener(this);
        SingletonEcstasyClub.getInstance(getContext()).getAllFaturasAPI(getContext(), id);

        listaFaturas.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int position, long id) {
                Fragment fragment = new DetalhesFaturasFragment();
                FragmentManager fragmentManager = getParentFragmentManager();
                FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                Bundle bundle = new Bundle();
                bundle.putInt("ID_FATURA", (int) id);
                fragment.setArguments(bundle);
                fragmentTransaction.replace(R.id.framgment_layout, fragment);
                fragmentTransaction.commit();
            }
        });
        return view;
    }

    @Override
    public void onRefreshListaFaturas(ArrayList<Faturas> faturas) {
        if(faturas != null)
            listaFaturas.setAdapter(new ListaFaturasAdaptador(faturas,getContext()));
    }
}
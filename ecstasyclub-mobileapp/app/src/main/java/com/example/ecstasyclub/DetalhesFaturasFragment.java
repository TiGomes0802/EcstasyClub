package com.example.ecstasyclub;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;

import androidx.fragment.app.Fragment;

import com.example.ecstasyclub.adaptadores.ListaEventosAdaptador;
import com.example.ecstasyclub.adaptadores.ListaLinhasFaturasAdaptador;
import com.example.ecstasyclub.listeners.LinhasFaturasListener;
import com.example.ecstasyclub.modelo.Faturas;
import com.example.ecstasyclub.modelo.LinhasFaturas;
import com.example.ecstasyclub.modelo.SingletonEcstasyClub;
import com.example.ecstasyclub.modelo.Userprofile;

import java.util.ArrayList;
import java.util.Objects;

public class DetalhesFaturasFragment extends Fragment implements LinhasFaturasListener {

    private int id;
    private TextView etNomef, etEmailf, etNomeevf, etDataf, etPrecof;
    private ListView lista_linha_fatura;

    private Userprofile user;
    private Faturas fatura;

    public DetalhesFaturasFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_detalhes_faturas, container, false);

        etNomef = view.findViewById(R.id.etNomef);
        etEmailf = view.findViewById(R.id.etEmailf);
        etNomeevf = view.findViewById(R.id.etNomeEvf);
        etDataf = view.findViewById(R.id.etDataf);
        etPrecof = view.findViewById(R.id.etPrecof);
        lista_linha_fatura = view.findViewById(R.id.lista_linha_fatura);

        assert getArguments() != null;
        id = getArguments().getInt("ID_FATURA");

        user = (Userprofile) SingletonEcstasyClub.getInstance(getContext()).getUserprofile();
        fatura =  SingletonEcstasyClub.getInstance(getContext()).getFatura(id);
        if(Objects.equals(fatura.getTipoPulseira(), "vip")){
            SingletonEcstasyClub.getInstance(getContext()).setLinhasFaturas(this);
            SingletonEcstasyClub.getInstance(getContext()).getAllLinhasFaturasAPI(getContext(), fatura.getId());
        }

        etNomef.setText(user.getNome() + " " + user.getApelido());
        etEmailf.setText(user.getEmail());
        etNomeevf.setText(fatura.getNomeEvento());
        etDataf.setText(fatura.getData());
        etPrecof.setText(String.format("%.2f", fatura.getPreco())+ "€");

        return view;
    }

    @Override
    public void onRefreshListaLinhasFaturas(ArrayList<LinhasFaturas> linhasfaturas) {
        if(linhasfaturas != null)
            lista_linha_fatura.setAdapter(new ListaLinhasFaturasAdaptador(linhasfaturas,getContext()));
    }
}
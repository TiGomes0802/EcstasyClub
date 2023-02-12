package com.example.ecstasyclub;

import android.os.Bundle;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import com.example.ecstasyclub.listeners.CodigoRPListener;
import com.example.ecstasyclub.listeners.PulseirasListener;
import com.example.ecstasyclub.modelo.Eventos;
import com.example.ecstasyclub.modelo.Pulseiras;
import com.example.ecstasyclub.modelo.SingletonEcstasyClub;
import com.example.ecstasyclub.modelo.Userprofile;

import java.util.ArrayList;

public class DetalhesEvento extends Fragment implements PulseirasListener, CodigoRPListener {

    private TextView tvNomeEvento, tvDescricao, tvData, tvPreco;
    private EditText etCodigoRP;
    private Button btnComprarPulseira, btnVerifyCodigoRP;
    private int id;
    private Eventos evento;
    private Pulseiras pulseira;
    private View view;
    private Bundle bundle = new Bundle();

    public DetalhesEvento() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {

        view = inflater.inflate(R.layout.fragment_detalhes_evento, container, false);

        tvNomeEvento = view.findViewById(R.id.tvNomeEvento);
        tvDescricao = view.findViewById(R.id.tvDescricao);
        tvData = view.findViewById(R.id.tvNbebidas);
        tvPreco = view.findViewById(R.id.tvPreco);

        etCodigoRP = view.findViewById(R.id.etCodigoRP);

        btnComprarPulseira = view.findViewById(R.id.btnComprarPulseira);
        btnVerifyCodigoRP = view.findViewById(R.id.btnVerifyCodigoRP);

        assert getArguments() != null;
        id = getArguments().getInt("ID_EVENTO");
        evento = SingletonEcstasyClub.getInstance(getContext()).getEvento(id);
        Userprofile user = (Userprofile) SingletonEcstasyClub.getInstance(getContext()).getUserprofile();
        SingletonEcstasyClub.getInstance(getContext()).setPulseirasListener(this);
        SingletonEcstasyClub.getInstance(getContext()).setCodigoRPListener(this);
        SingletonEcstasyClub.getInstance(getContext()).getallPulseirasAPI(getContext(), user.getId(), "ativa");
        pulseira = SingletonEcstasyClub.getInstance(getContext()).getPulseirasEvento(evento.getNome());

        tvNomeEvento.setText(evento.getNome());
        tvDescricao.setText(Html.fromHtml(evento.getDescricao()).toString());
        tvData.setText(evento.getDataevento());
        tvPreco.setText(String.format("%.2f", evento.getPreco())+ "");

        Fragment fragment = new ListaVipsFragment();
        FragmentManager fragmentManager = getParentFragmentManager();
        FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();

        bundle.putInt("ID_EVENTO", id);
        bundle.putString("CODIGORP", "");
        btnComprarPulseira.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                fragment.setArguments(bundle);
                fragmentTransaction.replace(R.id.framgment_layout, fragment);
                fragmentTransaction.commit();
            }
        });

        btnVerifyCodigoRP.setOnClickListener(new View.OnClickListener()
        {
            @Override
            public void onClick(View v)
            {
                SingletonEcstasyClub.getInstance(getContext()).getAllCodigoRPAPI(getContext(), etCodigoRP.getText().toString());
            }
        });

        return view;
    }

    @Override
    public void onRefreshListaPulseiras(ArrayList<Pulseiras> pulseiras) {
        if(evento.getNumbilhetesdisp() <= 0){
            btnComprarPulseira.setText("Pulseiras esgotadas");
            btnComprarPulseira.setEnabled(false);
        }

        if(pulseira != null){
            btnComprarPulseira.setText("Pulseira adquirida");
            btnComprarPulseira.setEnabled(false);
            etCodigoRP.setVisibility(View.INVISIBLE);
            btnVerifyCodigoRP.setVisibility(View.INVISIBLE);
        }
    }

    @Override
    public void onRefreshCodigoRP(String respota) {
        Boolean verify = SingletonEcstasyClub.getInstance(getContext()).getverify();

        if(verify){
            bundle.putString("CODIGORP", etCodigoRP.getText().toString());
            etCodigoRP.setEnabled(false);
            btnVerifyCodigoRP.setEnabled(false);
            etCodigoRP.setError("Codigo valido");
        } else {
            etCodigoRP.setError("Codigo invalido");
        }
    }
}
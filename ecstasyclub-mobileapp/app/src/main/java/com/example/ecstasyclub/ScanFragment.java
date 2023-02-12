package com.example.ecstasyclub;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.core.content.ContextCompat;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import com.budiyev.android.codescanner.CodeScanner;
import com.budiyev.android.codescanner.CodeScannerView;
import com.budiyev.android.codescanner.DecodeCallback;
import com.example.ecstasyclub.listeners.PulseirasListener;
import com.example.ecstasyclub.listeners.VipListener;
import com.example.ecstasyclub.listeners.VipsListener;
import com.example.ecstasyclub.modelo.Eventos;
import com.example.ecstasyclub.modelo.Pulseiras;
import com.example.ecstasyclub.modelo.SingletonEcstasyClub;
import com.example.ecstasyclub.modelo.Vips;
import com.google.zxing.Result;

import java.util.ArrayList;
import java.util.Objects;

public class ScanFragment extends Fragment implements PulseirasListener, VipListener {

    private CodeScanner mCodeScanner;
    private Pulseiras pulseira;
    private int id_evento;
    private String estado = "desativa", resultadoscan;
    private TextView validadePulseira , tvNomeEvento;
    private View view;
    private Activity activity;
    private CodeScannerView scannerView;

    public ScanFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        activity = getActivity();
        view = inflater.inflate(R.layout.fragment_scan, container, false);
        scannerView = view.findViewById(R.id.scanner_view);
        validadePulseira = view.findViewById(R.id.validadePulseira);
        tvNomeEvento = view.findViewById(R.id.tvNomeEvento);

        assert getArguments() != null;
        id_evento = getArguments().getInt("ID_EVENTO");

        Eventos evento = SingletonEcstasyClub.getInstance(getContext()).getEvento(id_evento);
        tvNomeEvento.setText(evento.getNome());

        mCodeScanner = new CodeScanner(activity, scannerView);

        mCodeScanner.setDecodeCallback(new DecodeCallback() {
            @Override
            public void onDecoded(@NonNull final Result result) {

                activity.runOnUiThread(new Runnable() {
                    @Override
                    public void run() {
                        resultadoscan = result.getText();
                        SingletonEcstasyClub.getInstance(getContext()).getallPulseirasSegurançaAPI(getContext());
                    }

                    @NonNull
                    private Runnable getRunnable() {
                        return this;
                    }
                });
            }
        });
        scannerView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mCodeScanner.startPreview();
                validadePulseira.setText("");
                validadePulseira.setTextColor(ContextCompat.getColor(getContext(), R.color.white));
            }
        });
        SingletonEcstasyClub.getInstance(getContext()).setVipListener(this);
        SingletonEcstasyClub.getInstance(getContext()).setPulseirasListener(this);
        return view;
    }

    @Override
    public void onResume() {
        super.onResume();
        mCodeScanner.startPreview();
    }

    @Override
    public void onPause() {
        mCodeScanner.releaseResources();
        super.onPause();
    }

    @SuppressLint("SetTextI18n")
    @Override
    public void onRefreshListaVip(Object vip) {
        Vips infovip = (Vips) SingletonEcstasyClub.getInstance(getContext()).getInfoVip();

        validadePulseira.setText("Pulseira VIP válida!\n vip para " + infovip.getNpessoas() + " pessoas com " + infovip.getNbebidas() + " bebidas.");
        validadePulseira.setTextColor(ContextCompat.getColor(getContext(), R.color.white));

        pulseira.setId(pulseira.getId());
        pulseira.setEstado(estado);
        SingletonEcstasyClub.getInstance(getContext()).atualizarPulseiraAPI(getContext(), pulseira.getId());
    }

    @Override
    public void onRefreshListaPulseiras(ArrayList<Pulseiras> pulseiras) {
        pulseira = SingletonEcstasyClub.getInstance(getContext()).getPulseiras(Integer.parseInt(resultadoscan));

        if (pulseira != null)
        {
            if (pulseira.getEstado().equals("ativa") && pulseira.getIdevento().equals(String.valueOf(id_evento)))
            {
                if (pulseira.getTipo().equals("vip")){
                    SingletonEcstasyClub.getInstance(getContext()).getVipAPI(getContext(),pulseira.getId());

                }else{
                    validadePulseira.setText("Válida!");
                    validadePulseira.setTextColor(ContextCompat.getColor(getContext(), R.color.white));

                    pulseira.setId(pulseira.getId());
                    pulseira.setEstado(estado);
                    SingletonEcstasyClub.getInstance(getContext()).atualizarPulseiraAPI(getContext(), Integer.parseInt(resultadoscan));
                }
            } else
            {
                validadePulseira.setText("Não válida!");
                validadePulseira.setTextColor(ContextCompat.getColor(getContext(), R.color.white));
            }
        }else{
            mCodeScanner.startPreview();
        }
    }
}
package com.example.ecstasyclub;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.fragment.app.Fragment;

import com.example.ecstasyclub.modelo.SingletonEcstasyClub;
import com.example.ecstasyclub.modelo.Userprofile;


public class PerfilSegurancaFragment extends Fragment {

    private TextView logout, etNome, etEmail, etDataNascimento;

    public PerfilSegurancaFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view =inflater.inflate(R.layout.fragment_perfil_seguranca, container, false);

        logout = (TextView) view.findViewById(R.id.LogOut);

        etNome = view.findViewById(R.id.etNomePerfilC);
        etEmail = view.findViewById(R.id.etEmailC);
        etDataNascimento = view.findViewById(R.id.etDataNascimentoC);

        logout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(view.getContext(), LoginActivity.class);
                startActivity(intent);
                requireActivity().finish();
            }
        });

        Userprofile user = (Userprofile) SingletonEcstasyClub.getInstance(getContext()).getUserprofile();

        etNome.setText(" " + user.getNome() + " " + user.getApelido());
        etEmail.setText(" " +user.getEmail());
        etDataNascimento.setText(" " + user.getDatanascimento());

        return view;
    }
}
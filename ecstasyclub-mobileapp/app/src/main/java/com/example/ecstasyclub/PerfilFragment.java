package com.example.ecstasyclub;

import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;

import com.example.ecstasyclub.modelo.SingletonEcstasyClub;
import com.example.ecstasyclub.modelo.Userprofile;

import java.util.Objects;

public class PerfilFragment extends Fragment{

    private TextView logout, faturas, inforp, etNome, etEmail, etDataNascimento;

    public PerfilFragment() {
        // Required empty public constructor
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        View view =inflater.inflate(R.layout.fragment_perfil, container, false);

        Userprofile user = (Userprofile) SingletonEcstasyClub.getInstance(getContext()).getUserprofile();

        logout = (TextView) view.findViewById(R.id.LogOut);
        faturas = (TextView) view.findViewById(R.id.Faturas);
        inforp = (TextView) view.findViewById(R.id.infoRP);

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

        faturas.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Fragment fragment = new ListaFaturasFragment();
                FragmentManager fragmentManager = getParentFragmentManager();
                FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                Bundle bundle = new Bundle();
                bundle.putInt("ID_USER", user.getId());
                fragment.setArguments(bundle);
                fragmentTransaction.replace(R.id.framgment_layout, fragment);
                fragmentTransaction.commit();
            }
        });

        if(Objects.equals(user.getRole(), "rp")){
            inforp.setVisibility(View.VISIBLE);
        }

        inforp.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Fragment fragment = new ListaInfosRPFragment();
                FragmentManager fragmentManager = getParentFragmentManager();
                FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
                Bundle bundle = new Bundle();
                bundle.putInt("ID_RP", user.getId());
                fragment.setArguments(bundle);
                fragmentTransaction.replace(R.id.framgment_layout, fragment);
                fragmentTransaction.commit();
            }
        });

        etNome.setText(" " + user.getNome() + " " + user.getApelido());
        etEmail.setText(" " +user.getEmail());
        etDataNascimento.setText(" " + user.getDatanascimento());

        return view;
    }
}
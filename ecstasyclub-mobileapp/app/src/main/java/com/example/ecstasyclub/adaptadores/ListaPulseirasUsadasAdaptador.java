package com.example.ecstasyclub.adaptadores;

import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.Color;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.appcompat.app.AlertDialog;

import com.example.ecstasyclub.ClienteActivity;
import com.example.ecstasyclub.R;
import com.example.ecstasyclub.modelo.Pulseiras;
import com.example.ecstasyclub.modelo.SingletonEcstasyClub;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import java.util.ArrayList;

import androidmads.library.qrgenearator.QRGContents;
import androidmads.library.qrgenearator.QRGEncoder;

public class ListaPulseirasUsadasAdaptador extends BaseAdapter {


    private ArrayList<Pulseiras> pulseiras;
    private LayoutInflater inflater;
    private Context context;

    public ListaPulseirasUsadasAdaptador(ArrayList<Pulseiras> pulseiras, Context context) {
        this.pulseiras = pulseiras;
        this.context = context;
    }

    @Override
    public int getCount() {
        return pulseiras.size();
    }

    @Override
    public Object getItem(int position) {
        return pulseiras.get(position);
    }

    @Override
    public long getItemId(int position) {
        return pulseiras.get(position).getId();
    }

    @Override
    public View getView(int position, View view, ViewGroup viewGroup) {
        if(inflater==null)
            inflater=(LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        if(view == null)
            view = inflater.inflate(R.layout.item_usado,null);

        /*otimização para não estar a repetir várias vezes*/
        ViewHolderLista viewHolder=(ViewHolderLista) view.getTag();
        if(viewHolder==null){
            viewHolder=new ViewHolderLista(view);
            view.setTag(viewHolder);
        }

        viewHolder.update(pulseiras.get(position));

        return view;
    }

    private class ViewHolderLista{
        private TextView tvNomeEvento, tvEstado;
        private FloatingActionButton floating_removeBilhete;

        public ViewHolderLista(View view){
            tvNomeEvento = view.findViewById(R.id.tvNomeEvento);
            tvEstado = view.findViewById(R.id.tvEstado);
            floating_removeBilhete = view.findViewById(R.id.floating_removeBilhete);
        }

        public void update(Pulseiras pulseiras){
            tvNomeEvento.setText(pulseiras.getIdevento() + "");
            tvEstado.setText(pulseiras.getEstado() + "");

            floating_removeBilhete.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    dialogRemover(pulseiras);
                }
            });
        }
    }

    private void dialogRemover(Pulseiras pulseira) {
        AlertDialog.Builder builder = new AlertDialog.Builder(context);
        builder.setTitle("Remover o pulseira").setMessage("Pretende mesmo remover a pulseira tambem irá apagar a sua fatura?").setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        SingletonEcstasyClub.getInstance(context.getApplicationContext()).removerPulseiraAPI(context, pulseira.getId());
                        Intent intent = new Intent(context, ClienteActivity.class);
                        context.startActivity(intent);
                    }
                })
                .setNegativeButton(android.R.string.no, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {

                    }
                })
                .setIcon(android.R.drawable.ic_delete)
                .show();
    }
}

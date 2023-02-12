package com.example.ecstasyclub.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.ecstasyclub.R;
import com.example.ecstasyclub.modelo.Eventos;

import java.util.ArrayList;

public class ListaEventosAdaptador extends BaseAdapter {


    private ArrayList<Eventos> eventos;
    private LayoutInflater inflater;
    private Context context;

    public ListaEventosAdaptador(ArrayList<Eventos> eventos, Context context) {
        this.eventos = eventos;
        this.context = context;
    }

    @Override
    public int getCount() {
        return eventos.size();
    }

    @Override
    public Object getItem(int position) {
        return eventos.get(position);
    }

    @Override
    public long getItemId(int position) {
        return eventos.get(position).getId();
    }

    @Override
    public View getView(int position, View view, ViewGroup viewGroup) {
        if(inflater==null)
            inflater=(LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        if(view == null)
            view = inflater.inflate(R.layout.item_evento,null);

        /*otimização para não estar a repetir várias vezes*/
        ViewHolderLista viewHolder=(ViewHolderLista) view.getTag();
        if(viewHolder==null){
            viewHolder=new ViewHolderLista(view);
            view.setTag(viewHolder);
        }

        viewHolder.update(eventos.get(position));

        return view;
    }

    private class ViewHolderLista{
        private TextView tvNome, tvPreco, tvData;

        public ViewHolderLista(View view){
            tvNome=view.findViewById(R.id.tvNome);
            tvData=view.findViewById(R.id.tvDataCompra);
            tvPreco=view.findViewById(R.id.tvPreco);
        }

        public void update(Eventos eventos){
            tvNome.setText(eventos.getNome());
            tvData.setText(eventos.getDataevento());
            tvPreco.setText(String.format("%.2f", eventos.getPreco())+ "");
        }

    }
}

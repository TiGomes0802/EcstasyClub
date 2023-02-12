package com.example.ecstasyclub.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.ecstasyclub.R;
import com.example.ecstasyclub.modelo.InfosRP;

import java.util.ArrayList;

public class ListaInfosRPAdaptador extends BaseAdapter {


    private ArrayList<InfosRP> infosrp;
    private LayoutInflater inflater;
    private Context context;

    public ListaInfosRPAdaptador(ArrayList<InfosRP> infosrp, Context context) {
        this.infosrp = infosrp;
        this.context = context;
    }

    @Override
    public int getCount() {
        return infosrp.size();
    }

    @Override
    public Object getItem(int position) {
        return infosrp.get(position);
    }

    @Override
    public long getItemId(int position) {
        return infosrp.get(position).getId();
    }

    @Override
    public View getView(int position, View view, ViewGroup viewGroup) {
        if(inflater==null)
            inflater=(LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        if(view == null)
            view = inflater.inflate(R.layout.item_inforp,null);

        /*otimização para não estar a repetir várias vezes*/
        ViewHolderLista viewHolder=(ViewHolderLista) view.getTag();
        if(viewHolder==null){
            viewHolder=new ViewHolderLista(view);
            view.setTag(viewHolder);
        }

        viewHolder.update(infosrp.get(position));

        return view;
    }

    private class ViewHolderLista{
        private TextView tvNEvento, tvLinhaFatura;

        public ViewHolderLista(View view){
            tvNEvento=view.findViewById(R.id.tvNEvento);
            tvLinhaFatura=view.findViewById(R.id.tvLinhaFatura);
        }

        public void update(InfosRP infosrp){
            tvNEvento.setText(infosrp.getNomeEvento());
            tvLinhaFatura.setText("Número de pulseiras vendidas: " + infosrp.getBilhetes() + "");
        }

    }
}

package com.example.ecstasyclub.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.ecstasyclub.R;
import com.example.ecstasyclub.modelo.Faturas;

import java.util.ArrayList;

public class ListaFaturasAdaptador extends BaseAdapter {


    private ArrayList<Faturas> faturas;
    private LayoutInflater inflater;
    private Context context;

    public ListaFaturasAdaptador(ArrayList<Faturas> faturas, Context context) {
        this.faturas = faturas;
        this.context = context;
    }

    @Override
    public int getCount() {
        return faturas.size();
    }

    @Override
    public Object getItem(int position) {
        return faturas.get(position);
    }

    @Override
    public long getItemId(int position) {
        return faturas.get(position).getId();
    }

    @Override
    public View getView(int position, View view, ViewGroup viewGroup) {
        if(inflater==null)
            inflater=(LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        if(view == null)
            view = inflater.inflate(R.layout.item_fatura,null);

        /*otimização para não estar a repetir várias vezes*/
        ViewHolderLista viewHolder=(ViewHolderLista) view.getTag();
        if(viewHolder==null){
            viewHolder=new ViewHolderLista(view);
            view.setTag(viewHolder);
        }

        viewHolder.update(faturas.get(position));

        return view;
    }

    private class ViewHolderLista{
        private TextView tvNome, tvPreco, tvData;

        public ViewHolderLista(View view){
            tvNome=view.findViewById(R.id.tvNome);
            tvData=view.findViewById(R.id.tvDataCompra);
            tvPreco=view.findViewById(R.id.tvPreco);
        }

        public void update(Faturas faturas){
            tvNome.setText(faturas.getNomeEvento());
            tvData.setText(faturas.getData());
            tvPreco.setText(String.format("%.2f", faturas.getPreco())+ "");
        }

    }
}

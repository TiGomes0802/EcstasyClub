package com.example.ecstasyclub.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.ecstasyclub.R;
import com.example.ecstasyclub.modelo.LinhasFaturas;

import java.util.ArrayList;

public class ListaLinhasFaturasAdaptador extends BaseAdapter {


    private ArrayList<LinhasFaturas> linhasfaturas;
    private LayoutInflater inflater;
    private Context context;

    public ListaLinhasFaturasAdaptador(ArrayList<LinhasFaturas> linhasfaturas, Context context) {
        this.linhasfaturas = linhasfaturas;
        this.context = context;
    }

    @Override
    public int getCount() {
        return linhasfaturas.size();
    }

    @Override
    public Object getItem(int position) {
        return linhasfaturas.get(position);
    }

    @Override
    public long getItemId(int position) {
        return linhasfaturas.get(position).getId();
    }

    @Override
    public View getView(int position, View view, ViewGroup viewGroup) {
        if(inflater==null)
            inflater=(LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        if(view == null)
            view = inflater.inflate(R.layout.item_linha_fatura,null);

        /*otimização para não estar a repetir várias vezes*/
        ViewHolderLista viewHolder=(ViewHolderLista) view.getTag();
        if(viewHolder==null){
            viewHolder=new ViewHolderLista(view);
            view.setTag(viewHolder);
        }

        viewHolder.update(linhasfaturas.get(position));

        return view;
    }

    private class ViewHolderLista{
        private TextView tvLinhaFatura;

        public ViewHolderLista(View view){
            tvLinhaFatura=view.findViewById(R.id.tvLinhaFatura);
        }

        public void update(LinhasFaturas linhasfaturas){
            tvLinhaFatura.setText(linhasfaturas.getBebida());
        }

    }
}

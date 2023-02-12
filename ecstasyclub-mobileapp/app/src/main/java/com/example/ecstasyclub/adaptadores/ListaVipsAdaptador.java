package com.example.ecstasyclub.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.ecstasyclub.R;
import com.example.ecstasyclub.modelo.Vips;

import java.util.ArrayList;

public class ListaVipsAdaptador extends BaseAdapter {


    private ArrayList<Vips> vips;
    private LayoutInflater inflater;
    private Context context;

    public ListaVipsAdaptador(ArrayList<Vips> vips, Context context) {
        this.vips = vips;
        this.context = context;
    }

    @Override
    public int getCount() {
        return vips.size();
    }

    @Override
    public Object getItem(int position) {
        return vips.get(position);
    }

    @Override
    public long getItemId(int position) {
        return vips.get(position).getId();
    }

    @Override
    public View getView(int position, View view, ViewGroup viewGroup) {
        if(inflater==null)
            inflater=(LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        if(view == null)
            view = inflater.inflate(R.layout.item_vip,null);

        /*otimização para não estar a repetir várias vezes*/
        ViewHolderLista viewHolder=(ViewHolderLista) view.getTag();
        if(viewHolder==null){
            viewHolder=new ViewHolderLista(view);
            view.setTag(viewHolder);
        }

        viewHolder.update(vips.get(position));

        return view;
    }

    private class ViewHolderLista{
        private TextView tvNpessoas, tvNbebidas, tvPreco;

        public ViewHolderLista(View view){
            tvNpessoas=view.findViewById(R.id.tvLinhaFatura);
            tvNbebidas=view.findViewById(R.id.tvNbebidas);
            tvPreco=view.findViewById(R.id.tvPreco);
        }

        public void update(Vips vips){
            tvNpessoas.setText("Número de pessoas: " + vips.getNpessoas());
            tvNbebidas.setText("Número de bebidas: " + vips.getNbebidas());
            tvPreco.setText(String.format("%.2f", vips.getPreco())+ "");
        }

    }
}

package com.example.ecstasyclub.adaptadores;

import android.content.Context;
import android.text.Html;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.ecstasyclub.R;
import com.example.ecstasyclub.modelo.Noticias;

import java.util.ArrayList;

public class ListaNoticiasAdaptador extends BaseAdapter {


    private ArrayList<Noticias> noticias;
    private LayoutInflater inflater;
    private Context context;

    public ListaNoticiasAdaptador(ArrayList<Noticias> noticias, Context context) {
        this.noticias = noticias;
        this.context = context;
    }

    @Override
    public int getCount() {
        return noticias.size();
    }

    @Override
    public Object getItem(int position) {
        return noticias.get(position);
    }

    @Override
    public long getItemId(int position) {
        return noticias.get(position).getId();
    }

    @Override
    public View getView(int position, View view, ViewGroup viewGroup) {
        if(inflater==null)
            inflater=(LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);

        if(view == null)
            view = inflater.inflate(R.layout.item_noticia,null);

        /*otimização para não estar a repetir várias vezes*/
        ViewHolderLista viewHolder=(ViewHolderLista) view.getTag();
        if(viewHolder==null){
            viewHolder=new ViewHolderLista(view);
            view.setTag(viewHolder);
        }

        viewHolder.update(noticias.get(position));

        return view;
    }

    private class ViewHolderLista{
        private TextView tvtitulon, tvdescricaon, tvDatan;

        public ViewHolderLista(View view){
            tvtitulon=view.findViewById(R.id.tvTitulon);
            tvdescricaon=view.findViewById(R.id.tvDescricaon);
            tvDatan=view.findViewById(R.id.tvDatan);
        }

        public void update(Noticias noticias){
            tvtitulon.setText(noticias.getTitulo());
            tvdescricaon.setText(Html.fromHtml(noticias.getDescricao()).toString());
            tvDatan.setText(noticias.getDatanoticia());
        }

    }
}

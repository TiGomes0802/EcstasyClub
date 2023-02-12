package com.example.ecstasyclub.adaptadores;

import android.content.Context;
import android.graphics.Bitmap;
import android.graphics.Color;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.ecstasyclub.R;
import com.example.ecstasyclub.modelo.Pulseiras;

import java.util.ArrayList;

import androidmads.library.qrgenearator.QRGContents;
import androidmads.library.qrgenearator.QRGEncoder;

public class ListaPulseirasNaoUsadasAdaptador extends BaseAdapter {


    private ArrayList<Pulseiras> pulseiras;
    private LayoutInflater inflater;
    private Context context;

    public ListaPulseirasNaoUsadasAdaptador(ArrayList<Pulseiras> pulseiras, Context context) {
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
            view = inflater.inflate(R.layout.item_naousado,null);

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
        private TextView tvNomeEvento;
        private ImageView smQRcode;

        public ViewHolderLista(View view){
            tvNomeEvento = view.findViewById(R.id.tvnaousadoNomeEvento);
            smQRcode = view.findViewById(R.id.smQRcode);
        }

        public void update(Pulseiras pulseiras){
            tvNomeEvento.setText(pulseiras.getIdevento() + "");
            smQRcode.setImageBitmap(makeqr(pulseiras.getId() + ""));
        }
    }

    public static Bitmap makeqr(String id){
        String inputValue = id;
        if (inputValue.length() == 0) {
            inputValue = "!!VAZIO!!";
        }
        QRGEncoder qrgEncoder = new QRGEncoder(inputValue , null, QRGContents.Type.TEXT, 500);
        qrgEncoder.setColorBlack(Color.WHITE);
        qrgEncoder.setColorWhite(Color.BLACK);
        try {
            Bitmap bitmap = qrgEncoder.getBitmap();
            return bitmap;
        } catch (Exception e) {
            e.printStackTrace();
            return null;
        }
    }
}

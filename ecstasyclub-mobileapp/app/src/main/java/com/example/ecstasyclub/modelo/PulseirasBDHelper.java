package com.example.ecstasyclub.modelo;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import androidx.annotation.Nullable;

import java.util.ArrayList;

public class PulseirasBDHelper extends SQLiteOpenHelper {

    private static final String DB_NAME="bdpulseiras";
    private static final int DB_VERSION=1;
    private static final String TABLE_PULSEIRAS="Pulseiras";
    private static final String ID="id", ESTADO="estado", TIPO="tipo", CODIGORP="codigorp", ID_EVENTO="id_evento", ID_CLIENTE="id_cliente";
    private final SQLiteDatabase db;


    public PulseirasBDHelper(@Nullable Context context) {
        super(context, DB_NAME, null, DB_VERSION);
        db = getWritableDatabase();
    }

    @Override
    public void onCreate(SQLiteDatabase sqLiteDatabase) {
        String createTablePulseiras="CREATE TABLE "+TABLE_PULSEIRAS+ " ("+
                ID + " INTEGER PRIMARY KEY, "+
                ESTADO + " TEXT, "+
                TIPO + " TEXT NOT NULL, "+
                CODIGORP + " TEXT, "+
                ID_EVENTO + " TEXT NOT NULL, "+
                ID_CLIENTE + " TEXT NOT NULL );";
        sqLiteDatabase.execSQL(createTablePulseiras);
    }

    @Override
    public void onUpgrade(SQLiteDatabase sqLiteDatabase, int i, int i1) {
        String droptablePulseiras="DROP TABLE IF EXISTS "+TABLE_PULSEIRAS;
        sqLiteDatabase.execSQL(droptablePulseiras);
        onCreate(sqLiteDatabase);
    }



// insert
    public void adicionarPulseirasBD(Pulseiras p){
        ContentValues values=new ContentValues();
        values.put(ID,p.getId());
        values.put(ESTADO,p.getEstado());
        values.put(TIPO,p.getTipo());
        values.put(CODIGORP,p.getCodigorp());
        values.put(ID_EVENTO,p.getIdevento());
        values.put(ID_CLIENTE,p.getIdcliente());

        db.insert(TABLE_PULSEIRAS,null,values);
        }

    // update
    public boolean editarPulseirasBD(Pulseiras b) {
        ContentValues values=new ContentValues();
        values.put(ID,b.getId());
        values.put(ESTADO,b.getEstado());
        values.put(TIPO,b.getEstado());
        values.put(CODIGORP,b.getCodigorp());
        values.put(ID_EVENTO,b.getIdevento());
        values.put(ID_CLIENTE,b.getIdcliente());

// update devolve o numero de linhas atualizadas
        int numlinhas=db.update(TABLE_PULSEIRAS,values,ID+"= ?",new String[] {b.getId()+""});
        return (numlinhas>0);
    }

    //delete
    public boolean removerPulseirasBD(int id) {
        //devolve o numero de linhas eliminadas
        int numlinhas=db.delete(TABLE_PULSEIRAS,ID+"= ?",new String[] {id+""});
        return (numlinhas>0);
    }

    public void removerAllPulseirasBD( ) {
        db.delete(TABLE_PULSEIRAS,null,null);

    }

    //select
    public ArrayList<Pulseiras> getAllPulseirasBD() {
        ArrayList<Pulseiras> pulseiras = new ArrayList<>();
        Cursor cursor = db.query(TABLE_PULSEIRAS, new String[]{ID, ESTADO, TIPO, CODIGORP, ID_EVENTO, ID_CLIENTE}, null, null, null, null, null, null);
        if (cursor.moveToFirst()) {
            do {
                Pulseiras b = new Pulseiras(cursor.getInt(0), cursor.getString(1), cursor.getString(2), cursor.getString(3), cursor.getString(4), cursor.getString(5));
                pulseiras.add(b);
            } while (cursor.moveToNext());
        }
        return pulseiras;
    }
}
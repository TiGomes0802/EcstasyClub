package com.example.ecstasyclub.modelo;

import android.content.Context;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import com.example.ecstasyclub.listeners.CodigoRPListener;
import  com.example.ecstasyclub.listeners.EventosListener;
import com.example.ecstasyclub.listeners.InfosRPListener;
import com.example.ecstasyclub.listeners.NoticiasListener;
import com.example.ecstasyclub.listeners.FaturasListener;
import com.example.ecstasyclub.listeners.PulseirasListener;
import  com.example.ecstasyclub.listeners.UserprofileListener;
import com.example.ecstasyclub.listeners.VipListener;
import  com.example.ecstasyclub.listeners.VipsListener;
import  com.example.ecstasyclub.listeners.LinhasFaturasListener;

import com.example.ecstasyclub.utils.CodigoRPJsonParser;
import com.example.ecstasyclub.utils.EventosJsonParser;
import com.example.ecstasyclub.utils.InfoRPJsonParser;
import com.example.ecstasyclub.utils.NoticiasJsonParser;
import com.example.ecstasyclub.utils.FaturasJsonParser;
import com.example.ecstasyclub.utils.PulseirasJsonParser;
import com.example.ecstasyclub.utils.UserprofileJsonParser;
import com.example.ecstasyclub.utils.VipsJsonParser;
import com.example.ecstasyclub.utils.LinhasFaturasJsonParser;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;
import java.util.Objects;

public class SingletonEcstasyClub {
    private static SingletonEcstasyClub instance = null;
    private static RequestQueue volleyQueue = null;

    private static final String mUrlAPI = "http://192.168.1.72/ecstasyclub/backend/web/index.php?r=api/";

    public static synchronized SingletonEcstasyClub getInstance(Context context) {
        if (instance == null) {
            instance = new SingletonEcstasyClub(context);
            volleyQueue = Volley.newRequestQueue(context);
        }
        return instance;
    }

    public SingletonEcstasyClub(Context context) {
        pulseiras = new ArrayList<>();
        PulseirasBD = new PulseirasBDHelper(context);
    }

//region métodos Eventos
    private EventosListener eventosListener;
    private ArrayList<Eventos> eventos;
    public void setEventosListener(EventosListener eventosListener) {
        this.eventosListener = eventosListener;
    }

    public void getAllEventosAPI(final Context context, String estado) {
        if (!EventosJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "Sem internet", Toast.LENGTH_SHORT).show();

        } else {
            JsonArrayRequest req = new JsonArrayRequest(Request.Method.GET, mUrlAPI + "eventos/viewalleventos&estado=" + estado, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    eventos = EventosJsonParser.parseJsonEventos(response);

                    if (eventosListener != null)
                        eventosListener.onRefreshListaEventos(eventos);

                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, "erro", Toast.LENGTH_SHORT).show();
                }
            });
            volleyQueue.add(req);
        }
    }

    public Eventos getEvento(int id) {
        for (Eventos b : eventos)
            if (b.getId() == id)
                return b;
        return null;
    }
//endregion

//region métodos User
    private UserprofileListener userprofileListener;
    private Object userprofile;
    public void setUserprofileListener(UserprofileListener userprofileListener) {
        this.userprofileListener = userprofileListener;
    }

    public void getLoginAPI(final Context context, String username, String passaword) {
        if (!UserprofileJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "Sem internet", Toast.LENGTH_SHORT).show();

        } else {
            JsonObjectRequest req = new JsonObjectRequest(Request.Method.GET, mUrlAPI + "userprofile/login&username=" + username + "&password=" + passaword, null, new Response.Listener<JSONObject>() {
                @Override
                public void onResponse(JSONObject response) {
                    userprofile = UserprofileJsonParser.parseJsonUserprofile(response);

                    if (userprofileListener != null)
                        userprofileListener.onRefreshUserprofile(userprofile);
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, "erro", Toast.LENGTH_SHORT).show();
                }
            });
            volleyQueue.add(req);
        }
    }

    public Object getUserprofile() {
        return userprofile;
    }
//endregion

//region métodos Vips
    private VipsListener vipsListener;
    private VipListener vipListener;
    private ArrayList<Vips> vips;
    private Object vip;
    public void setVipsListener(VipsListener vipsListener) {
        this.vipsListener = vipsListener;
    }
    public void setVipListener(VipListener vipListener) {
        this.vipListener = vipListener;
    }

    public void getVipAPI(final Context context, int id) {
        if (!VipsJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "Sem internet", Toast.LENGTH_SHORT).show();

        } else {
            JsonObjectRequest req = new JsonObjectRequest(Request.Method.GET, mUrlAPI + "vip/viewvip&id=" + id, null, new Response.Listener<JSONObject>() {

                @Override
                public void onResponse(JSONObject response) {
                    vip = VipsJsonParser.parseJsonVip(response);

                    if (vipListener != null)
                        vipListener.onRefreshListaVip(vip);

                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, "erro", Toast.LENGTH_SHORT).show();
                }
            });
            volleyQueue.add(req);
        }
    }

    public void getAllVipsDisponiveisAPI(final Context context, int id) {
        if (!VipsJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "Sem internet", Toast.LENGTH_SHORT).show();

        } else {
            JsonArrayRequest req = new JsonArrayRequest(Request.Method.GET, mUrlAPI + "vip/vipsocupados&id_evento=" + id, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    vips = VipsJsonParser.parseJsonVips(response);

                    if (vipsListener != null)
                        vipsListener.onRefreshListaVips(vips);

                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, "erro", Toast.LENGTH_SHORT).show();
                }
            });
            volleyQueue.add(req);
        }
    }

    public Vips getVip(int id) {
        for (Vips b : vips)
            if (b.getId() == id)
                return b;
        return null;
    }

    public Object getInfoVip() {
        return (Vips) vip;
    }

//endregion

//region métodos pulseiras

    private PulseirasListener pulseirasListener;
    private ArrayList<Pulseiras> pulseiras;
    private PulseirasBDHelper PulseirasBD = null;
    public void setPulseirasListener(PulseirasListener pulseirasListener) {
        this.pulseirasListener = pulseirasListener;
    }

    public Pulseiras getPulseiras(int id) {
        for (Pulseiras b : pulseiras)
            if (b.getId() == id)
                return b;
        return null;
    }

    public Pulseiras getPulseirasEvento(String nomeevento) {
        for (Pulseiras b : pulseiras)
            if (Objects.equals(b.getIdevento(), nomeevento))
                return b;
        return null;
    }

    //region metodos BD Pulseiras

    public ArrayList<Pulseiras> getPulseiras() {
        pulseiras = PulseirasBD.getAllPulseirasBD();
        return pulseiras;
    }

    public void adicionarPulseirasBD(Pulseiras p) {
        PulseirasBD.adicionarPulseirasBD(p);
    }

    public void adicionarPulseirasBD(ArrayList<Pulseiras> pulseiras) {
        PulseirasBD.removerAllPulseirasBD();
        for (Pulseiras p : pulseiras)
            adicionarPulseirasBD(p);
    }

    public void editarPulseirasBD(Pulseiras p) {
        Pulseiras Pulseirasaux = getPulseiras(p.getId());

        if (Pulseirasaux != null) {
            boolean result = PulseirasBD.editarPulseirasBD(p);
            if (result) {
                Pulseirasaux.setEstado(p.getEstado());
                Pulseirasaux.setTipo(p.getTipo());
                Pulseirasaux.setCodigorp(p.getCodigorp());
                Pulseirasaux.setIdevento(p.getIdevento());
                Pulseirasaux.setIdcliente(p.getIdcliente());
            }
        }
    }

    public void removerPulseirasBD(int id) {
        Pulseiras Pulseirasaux = getPulseiras(id);

        if (Pulseirasaux != null) {
            boolean result = PulseirasBD.removerPulseirasBD(id);
            if (result)
                pulseiras.remove(Pulseirasaux);
        }
    }
    //endregion

    public void getallPulseirasSegurançaAPI(final Context context) {
        if (!PulseirasJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "Sem Internet", Toast.LENGTH_SHORT).show();

            if (pulseirasListener != null)
                pulseirasListener.onRefreshListaPulseiras(PulseirasBD.getAllPulseirasBD());

        } else {
            JsonArrayRequest req = new JsonArrayRequest(Request.Method.GET, mUrlAPI + "pulseiras/viewallpulseirasevento", null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    pulseiras = PulseirasJsonParser.parseJsonPulseirasNULL(response);
                    adicionarPulseirasBD(pulseiras);

                    if (pulseirasListener != null)
                        pulseirasListener.onRefreshListaPulseiras(pulseiras);
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, "Erro!", Toast.LENGTH_SHORT).show();
                }
            });
            volleyQueue.add(req);
        }
    }

    public void getallPulseirasAPI(final Context context, int id_cliente, String estado) {
        if (!PulseirasJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "Sem Internet", Toast.LENGTH_SHORT).show();

            if(Objects.equals(estado, "ativa")){
                if (pulseirasListener != null)
                    pulseirasListener.onRefreshListaPulseiras(PulseirasBD.getAllPulseirasBD());
            }

        } else {
            JsonArrayRequest req = new JsonArrayRequest(Request.Method.GET, mUrlAPI + "pulseiras/viewallpulseiras&id=" + id_cliente + "&estado=" + estado, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    pulseiras = PulseirasJsonParser.parseJsonPulseirasNULL(response);

                    if(Objects.equals(estado, "ativa")){
                        adicionarPulseirasBD(pulseiras);
                    }

                    if (pulseirasListener != null)
                        pulseirasListener.onRefreshListaPulseiras(pulseiras);
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, "Erro!", Toast.LENGTH_SHORT).show();
                }
            });
            volleyQueue.add(req);
        }
    }

    public void adicionarPulseiraAPI(final Context context, int id_evento, int id_cliente, int id_vip, float preco, String codigorp, String tipo) {
        if (!PulseirasJsonParser.isConnectionInternet(context))
            Toast.makeText(context, "Sem internet", Toast.LENGTH_SHORT).show();
        else {
            StringRequest req = new StringRequest(Request.Method.POST, mUrlAPI + "pulseiras/comprarpulseira", new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    adicionarPulseirasBD(PulseirasJsonParser.parseJsonBilhete(response));
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }) {

                @Override
                protected Map<String, String> getParams() {
                    Map<String, String> params = new HashMap<String, String>();
                    params.put("id_evento", id_evento + "");
                    params.put("id_cliente", id_cliente + "");
                    params.put("estado", "ativa");
                    params.put("tipo", tipo);
                    params.put("codigorp", codigorp);
                    params.put("preco", preco + "");
                    params.put("id_vip", id_vip + "");
                    return params;
                }
            };
            volleyQueue.add(req);
        }
    }

    public void atualizarPulseiraAPI(final Context context, int id_pulseira) {
        if (!PulseirasJsonParser.isConnectionInternet(context))
            Toast.makeText(context, "Sem internet", Toast.LENGTH_SHORT).show();
        else {
            StringRequest req = new StringRequest(Request.Method.POST, mUrlAPI + "pulseiras/atulizarestadopulseira", new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {

                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }) {

                @Override
                protected Map<String, String> getParams() {
                    Map<String, String> params = new HashMap<String, String>();
                    params.put("id", id_pulseira + "");
                    params.put("estado", "desativa");
                    return params;
                }
            };
            volleyQueue.add(req);
        }
    }

    public void removerPulseiraAPI(final Context context, int id_pulseira) {
        if (!PulseirasJsonParser.isConnectionInternet(context))
            Toast.makeText(context, "Sem internet", Toast.LENGTH_SHORT).show();
        else {
            StringRequest req = new StringRequest(Request.Method.DELETE, mUrlAPI + "pulseiras/apagarpulseira&id=" + id_pulseira, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    removerPulseirasBD(id_pulseira);

                }
            },new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, error.getMessage(), Toast.LENGTH_SHORT).show();
                }
            });
            volleyQueue.add(req);
        }
    }

//endregion

//region metodos noticias

    private NoticiasListener noticiasListener;
    private ArrayList<Noticias> noticias;

    public void setNoticiasListener(NoticiasListener noticiasListener) {
        this.noticiasListener = noticiasListener;
    }

    public void GetAllNoticiasAPI(final Context context ){
        if (!NoticiasJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "Sem internet", Toast.LENGTH_SHORT).show();

        } else {
            JsonArrayRequest req = new JsonArrayRequest(Request.Method.GET, mUrlAPI + "noticias/viewnoticias", null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    noticias = NoticiasJsonParser.parseJsonNoticias(response);

                    if (noticiasListener != null)
                        noticiasListener.onRefreshListaNoticias(noticias);
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, "erro", Toast.LENGTH_SHORT).show();
                }
            });
            volleyQueue.add(req);
        }
    }
//endregion

//region métodos Faturas
    private FaturasListener faturasListener;
    private ArrayList<Faturas> faturas;
    public void setFaturasListener(FaturasListener faturasListener) {
        this.faturasListener = faturasListener;
    }

    public void getAllFaturasAPI(final Context context, int id) {
        if (!FaturasJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "Sem internet", Toast.LENGTH_SHORT).show();

        } else {
            JsonArrayRequest req = new JsonArrayRequest(Request.Method.GET, mUrlAPI + "faturas/viewfaturas&id_cliente=" + id, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    faturas = FaturasJsonParser.parseJsonFaturas(response);

                    if (faturasListener != null)
                        faturasListener.onRefreshListaFaturas(faturas);

                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, "erro", Toast.LENGTH_SHORT).show();
                }
            });
            volleyQueue.add(req);
        }
    }

    public Faturas getFatura(int id) {
        for (Faturas f : faturas)
            if (f.getId() == id)
                return f;
        return null;
    }
//endregion

//region métodos LinhasFaturas
    private LinhasFaturasListener linhasfaturasListener;
    private ArrayList<LinhasFaturas> linhasfaturas;
    public void setLinhasFaturas(LinhasFaturasListener linhasfaturasListener) {
        this.linhasfaturasListener = linhasfaturasListener;
    }

    public void getAllLinhasFaturasAPI(final Context context, int id_fatura) {
        if (!LinhasFaturasJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "Sem internet", Toast.LENGTH_SHORT).show();

        } else {
            JsonArrayRequest req = new JsonArrayRequest(Request.Method.GET, mUrlAPI + "linhafatura/viewlinhafatura&id_fatura=" + id_fatura, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    linhasfaturas = LinhasFaturasJsonParser.parseJsonLinhasFaturas(response);

                    if (linhasfaturasListener != null)
                        linhasfaturasListener.onRefreshListaLinhasFaturas(linhasfaturas);

                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, "erro", Toast.LENGTH_SHORT).show();
                }
            });
            volleyQueue.add(req);
        }
    }

//endregion

//region método Codigo RP
    private CodigoRPListener codigorpListener;
    private InfosRPListener infosRPListener;
    private String CodigoRP;
    private ArrayList<InfosRP> infosrp;

    public void setCodigoRPListener(CodigoRPListener codigorpListener) {
        this.codigorpListener = codigorpListener;
    }

    public void setInfosRPListener(InfosRPListener infosRPListener) {
        this.infosRPListener = infosRPListener;
    }

    public void getAllCodigoRPAPI(final Context context, String codigo) {
        if (!CodigoRPJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "Sem internet", Toast.LENGTH_SHORT).show();

        } else {
            StringRequest req = new StringRequest(Request.Method.GET, mUrlAPI + "userprofile/verifycodigorp&codigo=" + codigo,  new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    CodigoRP = response;

                    if (codigorpListener != null)
                        codigorpListener.onRefreshCodigoRP(CodigoRP);
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, "erro", Toast.LENGTH_SHORT).show();
                }
            });
            volleyQueue.add(req);
        }
    }

    public void getAllInfoCodigoRPAPI(final Context context, int id_rp) {
        if (!CodigoRPJsonParser.isConnectionInternet(context)) {
            Toast.makeText(context, "Sem internet", Toast.LENGTH_SHORT).show();

        } else {
            JsonArrayRequest req = new JsonArrayRequest(Request.Method.GET, mUrlAPI + "userprofile/allinfocodigorp&id_rp=" + id_rp, null, new Response.Listener<JSONArray>() {
                @Override
                public void onResponse(JSONArray response) {
                    infosrp = InfoRPJsonParser.parseJsonInfosRP(response);

                    if (infosRPListener != null)
                        infosRPListener.onRefreshListaInfosRP(infosrp);

                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(context, "erro", Toast.LENGTH_SHORT).show();
                }
            });
            volleyQueue.add(req);
        }
    }

    public Boolean getverify() {
        String result = CodigoRP.substring(1, CodigoRP.length() - 1);
        if (Objects.equals(result, "valido")){
            return true;
        }else {
            return false;
        }

    }
//endregion
}
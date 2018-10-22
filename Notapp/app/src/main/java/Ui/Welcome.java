package Ui;

import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.JsonRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import Entities.User;
import layer.notapp.R;

public class Welcome extends AppCompatActivity implements Response.Listener<JSONObject>, Response.ErrorListener {
    RequestQueue rq;
    JsonRequest jrq;
    EditText cajaUser, cajaPwd;
    Button btnConsultar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_welcome);

        cajaUser=(EditText) findViewById(R.id.Caja_id);
        cajaPwd=(EditText) findViewById(R.id.Caja_password);
        btnConsultar=(Button) findViewById(R.id.button_acceso);
        rq= Volley.newRequestQueue(getApplicationContext());
        btnConsultar.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View view) {

                iniciarsesion();



            }
                final String username=cajaUser.getText().toString();

                final String passsword=cajaUser.getText().toString();
                Response.Listener<String> responseListener=new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject jsonResponse=new JSONObject(response);
                            boolean success=jsonResponse.getBoolean("success");
                            if(success){


                            }else{
                                AlertDialog.Builder builder=new AlertDialog.Builder(Welcome.this);
                                builder.setMessage("error autenticando").setNegativeButton("retry", null)
                                        .create().show();
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }
                    }
                };
               LoginRequest loginRequest=new LoginRequest(username,passsword, responseListener);


        });
    }




    @Override
    public void onErrorResponse(VolleyError error) {  //cuando la rta es negativa


        Toast.makeText(getApplicationContext(), "No se ha encontrado el usuario" + error.toString(),
                Toast.LENGTH_SHORT).show();
        //aquí está fallando la aplicación porque muestra no se ha encontrado el usuario


    }




    @Override
    public void onResponse(JSONObject response) {  //cuando la rta es positiva
        Toast.makeText(getApplicationContext(), "se ha encontrado el usuario" + cajaUser.getText().toString(),
                Toast.LENGTH_SHORT).show();
        User usuario=new User();

        JSONArray jsonArray= null;
        try {
            jsonArray = response.getJSONArray("usuario");
        } catch (JSONException e) {
            e.printStackTrace();
        }
        Log.d("======================",jsonArray.toString()); //ver que datos llega del json
        JSONArray jsonObject= null;

        try {
            jsonObject = jsonArray.getJSONArray(0);
            usuario.setUsuer(jsonObject.optString(jsonObject.getInt(0)));
            usuario.setPwd(jsonObject.optString(jsonObject.getInt(0)));




        } catch (JSONException e) {
            e.printStackTrace();
        }
        //si too es correcto que cargue la siguiente vista

        Intent intent=new Intent(getApplicationContext(),infoactivity.class);
        intent.putExtra(infoactivity.nombres,cajaUser.getText().toString());
        startActivity(intent);




    }


    private void iniciarsesion(){
        String url="http://192.168.1.5/proyecto_notapp2/regjson.php?usuario="+cajaUser.getText().toString()+
                "&nip="+cajaPwd.getText().toString();
        jrq=new JsonObjectRequest(Request.Method.GET, url, null, this, this);
        rq.add(jrq);

//lo que se consulta en la url:
        //http://localhost/proyecto_notapp2/regjson.php?usuario=332799&nip=332799
    }







}

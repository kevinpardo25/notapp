package Ui;

import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import Entities.User;
import layer.notapp.R;

public class infoactivity extends AppCompatActivity implements Response.Listener<JSONObject>,Response.ErrorListener {
    public static final String nombres="names";
    //id,nombre,identificacion,carrera,estado,nivel
    TextView txtid,txtnombre,txtidentificacion,txtcarrera,txtestado,txtnivel;
    Button btnnotas;


    RequestQueue request;
    JsonObjectRequest jsonObjectRequest;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_infoactivity);
        TextView cajausuario=(TextView)findViewById(R.id.CajaNombreUsuario);
        String usuario=getIntent().getStringExtra("names");
        cajausuario.setText(usuario);
        request= Volley.newRequestQueue(getApplicationContext());
        btnnotas=(Button) findViewById(R.id.btn_consultar);
       btnnotas.setOnClickListener(new View.OnClickListener() {
           @Override
           public void onClick(View view) {
                cargarWebService();
            }
           Response.Listener<String> responseListener=new Response.Listener<String>() {
               @Override
               public void onResponse(String response) {
                   try {
                       JSONObject jsonResponse=new JSONObject(response);
                       boolean success=jsonResponse.getBoolean("success");
                       if(success){


                       }else{
                           AlertDialog.Builder builder=new AlertDialog.Builder(infoactivity.this);
                           builder.setMessage("error autenticando").setNegativeButton("retry", null)
                                   .create().show();
                       }
                   } catch (JSONException e) {
                       e.printStackTrace();
                   }
               }
           };

       });

    }
    private void cargarWebService() {
        TextView cajausuario=(TextView)findViewById(R.id.CajaNombreUsuario);
        String usuario=cajausuario.getText().toString();
        String url="http://192.168.1.5/proyecto_notapp2/consultainfojson.php?id="+usuario;
        jsonObjectRequest=new JsonObjectRequest(Request.Method.GET,url,null,this,this);
        request.add(jsonObjectRequest);

    }

    @Override
    public void onErrorResponse(VolleyError volleyError) {

        Toast.makeText(getApplicationContext(),"no se pudo consultar"+volleyError.toString(),Toast.LENGTH_SHORT).show();
        Log.i("ERROR==================",volleyError.toString());
    }

    @Override
    public void onResponse(JSONObject response) {

        Toast.makeText(getApplicationContext(),"mensaje"+response,Toast.LENGTH_SHORT).show();
        User miuser=new User();
        JSONArray json=response.optJSONArray("id");
        JSONObject jsonObject=null;
        try {
            jsonObject=json.getJSONObject(0);
            miuser.setId(jsonObject.optInt("id"));
            miuser.setNombre(jsonObject.optString("nombre"));
            miuser.setIdentificacion(jsonObject.optInt("identificacion"));
            miuser.setCarrera(jsonObject.optString("carrera"));
            miuser.setEstado(jsonObject.optString("estado"));
            miuser.setNivel(jsonObject.optInt("nivel"));
        } catch (JSONException e) {
            e.printStackTrace();
        }

        TextView txtid=(TextView)findViewById(R.id.txtid);
        TextView txtnombre=(TextView)findViewById(R.id.txtnombre);
        TextView txtidentificacion=(TextView)findViewById(R.id.txtidentificacion);
        TextView txtcarrera=(TextView)findViewById(R.id.txtcarrera);
        TextView txtnivel=(TextView)findViewById(R.id.txtnivel);
        TextView txtestado=(TextView)findViewById(R.id.txtestado);
       txtid.setText("id:"+miuser.getId());
        txtnombre.setText("nombre:"+miuser.getNombre());
        txtidentificacion.setText("identificación:"+miuser.getIdentificacion());
        txtcarrera.setText("carrera:"+miuser.getCarrera());
        txtnivel.setText("nivel:"+miuser.getNivel());
        txtestado.setText("estado:"+miuser.getEstado());
    }


    public void cerrarsesion(View view){

        //cuando pulse el boton se va hacía la pagina de logeo de nuevo
        Intent intent=new Intent(this, Welcome.class);
        startActivity(intent);
    }

    public void Vernotas(View view){

        //cuando pulse va hacía la pagina donde se muestra las notas actuales
        Intent intent=new Intent(this,notasvista.class);
        TextView cajausuario=(TextView)findViewById(R.id.CajaNombreUsuario);
        String cajaUser=cajausuario.getText().toString();
        intent.putExtra(Ui.notasvista.nombres,cajaUser);
        startActivity(intent);

    }



}

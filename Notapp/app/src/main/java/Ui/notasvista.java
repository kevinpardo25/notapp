package Ui;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;

import layer.notapp.R;

public class notasvista extends AppCompatActivity {
    public static final String nombres="names";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_notasvista);
        TextView cajausuario=(TextView)findViewById(R.id.caja_usuario);
        String usuario=getIntent().getStringExtra("names");
        cajausuario.setText(usuario);
    }
}

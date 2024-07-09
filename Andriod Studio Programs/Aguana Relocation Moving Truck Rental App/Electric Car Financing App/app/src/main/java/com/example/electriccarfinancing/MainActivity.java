package com.example.electriccarfinancing;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {
    int Check;
    int intDays;
    float decKilometrage;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        getSupportActionBar() .hide();

        final RadioButton Ten = (RadioButton) findViewById(R.id.TenFootTruck);
        final RadioButton Seventeen = (RadioButton)findViewById(R.id.SeventeenFootTruck);
        final RadioButton twentysix = (RadioButton)findViewById(R.id.twentysixFootTruck);

final EditText days = (EditText) findViewById(R.id.days);
final EditText kilometrage = (EditText) findViewById(R.id.kilometrage);
final SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
        Button button = (Button) findViewById(R.id.btnPayment);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(Ten.isChecked()) {
                    Check = 1;
                }
                if(Seventeen.isChecked()) {
                    Check = 2;
                }
                if(twentysix.isChecked()) {
                    Check = 3;
                }

        intDays = Integer.parseInt(days.getText().toString());
        decKilometrage = Float.parseFloat(kilometrage.getText().toString());

        SharedPreferences.Editor editor = sharedPref.edit();
        editor.putBoolean("key1", Ten.isChecked());
        editor.putBoolean("key2", Seventeen.isChecked());
        editor.putBoolean("key3", twentysix.isChecked());
        editor.putInt("key4", Check);
        editor.putInt("key5", intDays);
        editor.putFloat("key6", decKilometrage);
        editor.apply();

        startActivity(new Intent(MainActivity.this, Payment.class));
            }
        });


    }
}
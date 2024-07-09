package com.example.mohsin.customlistview;

import android.content.Intent;
import android.content.SharedPreferences;
import android.preference.PreferenceManager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;

public class CaviteSpotJAVA extends AppCompatActivity {
    int Check;
    int SpotDays;
    int SpotGuests;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.cavite_spot);
        getSupportActionBar() .hide();
        final RadioButton Spot1 = (RadioButton) findViewById(R.id.Spot1);
        final RadioButton Spot2 = (RadioButton)findViewById(R.id.Spot2);
        final RadioButton Spot3 = (RadioButton)findViewById(R.id.Spot3);
        final EditText days = (EditText) findViewById(R.id.SpotBulacanDays);
        final EditText guests = (EditText) findViewById(R.id.SpotBulacanGuests);
        final SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
        Button button = (Button) findViewById(R.id.btnButacanSpot);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(Spot1.isChecked()) {
                    Check = 1;

                }
                if(Spot2.isChecked()) {
                    Check = 2;
                }
                if(Spot3.isChecked()) {
                    Check = 3;
                }
                SpotDays = Integer.parseInt(days.getText().toString());
                SpotGuests = Integer.parseInt(guests.getText().toString());

                SharedPreferences.Editor editor = sharedPref.edit();
                editor.putBoolean("key1", Spot1.isChecked());
                editor.putBoolean("key2", Spot2.isChecked());
                editor.putBoolean("key3", Spot3.isChecked());
                editor.putInt("key4", Check);
                editor.putInt("key5", SpotDays);
                editor.putFloat("key6", SpotGuests);
                editor.apply();
                startActivity(new Intent(CaviteSpotJAVA.this,CaviteSpotPayment.class));
            }
        });


    }
}
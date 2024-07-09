package com.example.mohsin.customlistview;

import android.content.Intent;
import android.content.SharedPreferences;
import android.media.MediaPlayer;
import android.preference.PreferenceManager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;

public class BulacanHotelJAVA extends AppCompatActivity {
    int Check;
    int IntHotelBulacanDays;
    int IntHotelBulacanRoom;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.bulacan_hotel);
        getSupportActionBar() .hide();



        final RadioButton Hotel1 = (RadioButton) findViewById(R.id.HotelID1);
        final RadioButton Hotel2 = (RadioButton)findViewById(R.id.HotelID2);
        final RadioButton Hotel3 = (RadioButton)findViewById(R.id.HotelID3);
        final EditText days = (EditText) findViewById(R.id.HotelBulacanDays);
        final EditText room = (EditText) findViewById(R.id.HotelBulacanRoom);
        final SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
        Button button = (Button) findViewById(R.id.btnButacanHotels);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(Hotel1.isChecked()) {
                    Check = 1;
                }
                if(Hotel2.isChecked()) {
                    Check = 2;
                }
                if(Hotel3.isChecked()) {
                    Check = 3;
                }
                IntHotelBulacanDays = Integer.parseInt(days.getText().toString());
                IntHotelBulacanRoom = Integer.parseInt(room.getText().toString());

                SharedPreferences.Editor editor = sharedPref.edit();
                editor.putBoolean("key1", Hotel1.isChecked());
                editor.putBoolean("key2", Hotel2.isChecked());
                editor.putBoolean("key3", Hotel3.isChecked());
                editor.putInt("key4", Check);
                editor.putInt("key5", IntHotelBulacanDays);
                editor.putFloat("key6", IntHotelBulacanRoom);
                editor.apply();
                startActivity(new Intent(BulacanHotelJAVA.this, BulacanHotelPayment.class));

            }
        });


    }
}
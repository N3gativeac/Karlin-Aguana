package com.example.Aguanawowphapp;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.RadioButton;
import android.widget.RadioGroup;

public class Javadumaguete extends AppCompatActivity {




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.dumaguete_cat);
        getSupportActionBar().setTitle("Dumaguete Page");
        getSupportActionBar().setDisplayShowHomeEnabled(true);
        getSupportActionBar().setLogo(R.mipmap.ic_launcher);
        getSupportActionBar().setDisplayUseLogoEnabled(true);



        final RadioGroup group = (RadioGroup) findViewById(R.id.radioGroup);
        final RadioButton Dum_hotel = (RadioButton)findViewById(R.id.Dum_hotel);
        final RadioButton Dum_spots = (RadioButton)findViewById(R.id.Dum_spots);
        final RadioButton Dum_malls = (RadioButton)findViewById(R.id.Dum_malls);
        final RadioButton Dum_restaurants = (RadioButton)findViewById(R.id.Dum_restaurants);
        Button button = (Button)findViewById(R.id.btn);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(Dum_hotel.isChecked()) {
                    startActivity(new Intent(new Intent(Javadumaguete.this, jdumhotel.class)));
                }
                if(Dum_spots.isChecked()) {
                    startActivity(new Intent(new Intent(Javadumaguete.this,jdumspots.class)));
                }
                if(Dum_malls.isChecked()) {
                    startActivity(new Intent(new Intent(Javadumaguete.this,jdummalls.class)));
                }
                if(Dum_restaurants.isChecked()) {
                    startActivity(new Intent(new Intent(Javadumaguete.this, jdumres.class)));
                }
            }
        });
    }
}
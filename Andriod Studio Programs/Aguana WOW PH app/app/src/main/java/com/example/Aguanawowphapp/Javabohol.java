package com.example.Aguanawowphapp;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.RadioButton;
import android.widget.RadioGroup;

public class Javabohol extends AppCompatActivity {




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.bohol_cat);
        getSupportActionBar().setTitle("Bohol Page");
        getSupportActionBar().setDisplayShowHomeEnabled(true);
        getSupportActionBar().setLogo(R.mipmap.ic_launcher);
        getSupportActionBar().setDisplayUseLogoEnabled(true);

        final RadioGroup group = (RadioGroup) findViewById(R.id.radioGroup);
        final RadioButton Bo_hotel = (RadioButton)findViewById(R.id.Bo_hotel);
        final RadioButton Bo_spots = (RadioButton)findViewById(R.id.Bo_spots);
        final RadioButton Bo_malls = (RadioButton)findViewById(R.id.Bo_malls);
        final RadioButton Bo_restaurants = (RadioButton)findViewById(R.id.Bo_restaurants);
        Button button = (Button)findViewById(R.id.btn);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(Bo_hotel.isChecked()) {
                    startActivity(new Intent(new Intent(Javabohol.this, jbohotel.class)));
                }
                if(Bo_spots.isChecked()) {
                    startActivity(new Intent(new Intent(Javabohol.this,jbospots.class)));
                }
                if(Bo_malls.isChecked()) {
                    startActivity(new Intent(new Intent(Javabohol.this,jbomalls.class)));
                }
                if(Bo_restaurants.isChecked()) {
                    startActivity(new Intent(new Intent(Javabohol.this, jbores.class)));
                }
            }
        });
    }
}
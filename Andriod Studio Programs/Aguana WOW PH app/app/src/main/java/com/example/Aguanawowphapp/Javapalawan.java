package com.example.Aguanawowphapp;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.RadioButton;
import android.widget.RadioGroup;

public class Javapalawan extends AppCompatActivity {




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.palawan_cat);
        getSupportActionBar().setDisplayShowHomeEnabled(true);
        getSupportActionBar().setLogo(R.mipmap.ic_launcher);
        getSupportActionBar().setDisplayUseLogoEnabled(true);
        getSupportActionBar().setTitle("Palawan Page");



        final RadioGroup group = (RadioGroup) findViewById(R.id.radioGroup);
        final RadioButton Pal_Hotels = (RadioButton)findViewById(R.id.Pal_hotel);
        final RadioButton Pal_spots = (RadioButton)findViewById(R.id.Pal_spots);
        final RadioButton Pal_malls = (RadioButton)findViewById(R.id.Pal_malls);
        final RadioButton Pal_restaurants = (RadioButton)findViewById(R.id.Pal_restaurants);
        Button button = (Button)findViewById(R.id.btn);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(Pal_Hotels.isChecked()) {
                    startActivity(new Intent(new Intent(Javapalawan.this, jpalhotel.class)));
                }
                if(Pal_spots.isChecked()) {
                    startActivity(new Intent(new Intent(Javapalawan.this,jpalspots.class)));
                }
                if(Pal_malls.isChecked()) {
                    startActivity(new Intent(new Intent(Javapalawan.this,jpalmalls.class)));
                }
                if(Pal_restaurants.isChecked()) {
                    startActivity(new Intent(new Intent(Javapalawan.this, jpalres.class)));
                }
            }
        });
    }
}
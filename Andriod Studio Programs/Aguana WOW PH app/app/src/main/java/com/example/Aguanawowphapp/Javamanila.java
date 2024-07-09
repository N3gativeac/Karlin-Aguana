package com.example.Aguanawowphapp;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.RadioButton;
import android.widget.RadioGroup;

public class Javamanila extends AppCompatActivity {




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.manila_cat);
        getSupportActionBar().setTitle("Aklan Page");
        getSupportActionBar().setDisplayShowHomeEnabled(true);
        getSupportActionBar().setLogo(R.mipmap.ic_launcher);
        getSupportActionBar().setDisplayUseLogoEnabled(true);


        final RadioGroup group = (RadioGroup) findViewById(R.id.radioGroup);
        final RadioButton Man_Hotels = (RadioButton)findViewById(R.id.Man_Hotels);
        final RadioButton Man_spots = (RadioButton)findViewById(R.id.Man_spots);
        final RadioButton Man_malls = (RadioButton)findViewById(R.id.Man_malls);
        final RadioButton Man_restaurants = (RadioButton)findViewById(R.id.Man_restaurants);
        Button button = (Button)findViewById(R.id.btn);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(Man_Hotels.isChecked()) {
                    startActivity(new Intent(new Intent(Javamanila.this, jmanhotel.class)));
                }
                if(Man_spots.isChecked()) {
                    startActivity(new Intent(new Intent(Javamanila.this,jmanspots.class)));
                }
                if(Man_malls.isChecked()) {
                    startActivity(new Intent(new Intent(Javamanila.this,jmanmalls.class)));
                }
                if(Man_restaurants.isChecked()) {
                    startActivity(new Intent(new Intent(Javamanila.this, jmanres.class)));
                }
            }
        });
    }
}
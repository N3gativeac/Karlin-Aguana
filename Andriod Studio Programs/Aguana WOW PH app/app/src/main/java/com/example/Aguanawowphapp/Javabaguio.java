package com.example.Aguanawowphapp;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.RadioButton;
import android.widget.RadioGroup;

public class Javabaguio extends AppCompatActivity {




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.baguio_cat);
        getSupportActionBar().setTitle("Baguio Page");
        getSupportActionBar().setDisplayShowHomeEnabled(true);
        getSupportActionBar().setLogo(R.mipmap.ic_launcher);
        getSupportActionBar().setDisplayUseLogoEnabled(true);

        final RadioGroup group = (RadioGroup) findViewById(R.id.radioGroup);
        final RadioButton Bag_hotel = (RadioButton)findViewById(R.id.Bag_hotel);
        final RadioButton Bag_spots = (RadioButton)findViewById(R.id.Bag_spots);
        final RadioButton Bag_malls = (RadioButton)findViewById(R.id.Bag_malls);
        final RadioButton Bag_restaurants = (RadioButton)findViewById(R.id.Bag_restaurants);
        Button button = (Button)findViewById(R.id.btn);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(Bag_hotel.isChecked()) {
                    startActivity(new Intent(new Intent(Javabaguio.this,jbaghotel.class)));
                }
                if(Bag_spots.isChecked()) {
                    startActivity(new Intent(new Intent(Javabaguio.this,jbagspots.class)));
                }
                if(Bag_malls.isChecked()) {
                    startActivity(new Intent(new Intent(Javabaguio.this,jbagmalls.class)));
                }
                if(Bag_restaurants.isChecked()) {
                    startActivity(new Intent(new Intent(Javabaguio.this, jbagres.class)));
                }
            }
        });
    }
}
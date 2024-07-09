package com.example.Aguanawowphapp;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.RadioButton;
import android.widget.RadioGroup;

public class Javatagaytay extends AppCompatActivity {




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.tagaytay_cat);
        getSupportActionBar().setTitle("Tagaytay Page");
        getSupportActionBar().setDisplayShowHomeEnabled(true);
        getSupportActionBar().setLogo(R.mipmap.ic_launcher);
        getSupportActionBar().setDisplayUseLogoEnabled(true);



        final RadioGroup group = (RadioGroup) findViewById(R.id.radioGroup);
        final RadioButton Tag_hotel = (RadioButton)findViewById(R.id.Tag_hotel);
        final RadioButton Tag_spots = (RadioButton)findViewById(R.id.Tag_spots);
        final RadioButton Tag_malls = (RadioButton)findViewById(R.id.Tag_malls);
        final RadioButton Tag_restaurants = (RadioButton)findViewById(R.id.Tag_restaurants);
        Button button = (Button)findViewById(R.id.btn);
        button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(Tag_hotel.isChecked()) {
                    startActivity(new Intent(new Intent(Javatagaytay.this, jtaghotel.class)));
                }
                if(Tag_spots.isChecked()) {
                    startActivity(new Intent(new Intent(Javatagaytay.this,jtagspots.class)));
                }
                if(Tag_malls.isChecked()) {
                    startActivity(new Intent(new Intent(Javatagaytay.this,jtagmalls.class)));
                }
                if(Tag_restaurants.isChecked()) {
                    startActivity(new Intent(new Intent(Javatagaytay.this, jtagres.class)));
                }
            }
        });
    }
}
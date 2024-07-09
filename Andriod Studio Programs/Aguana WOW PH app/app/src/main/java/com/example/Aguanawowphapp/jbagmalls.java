package com.example.Aguanawowphapp;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;

public class jbagmalls extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.bagmalls);
        getSupportActionBar().setTitle("Baguio Malls");
        getSupportActionBar().setDisplayShowHomeEnabled(true);
        getSupportActionBar().setLogo(R.mipmap.ic_launcher);
        getSupportActionBar().setDisplayUseLogoEnabled(true);
    }
}
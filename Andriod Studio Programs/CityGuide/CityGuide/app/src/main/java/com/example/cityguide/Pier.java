package com.example.cityguide;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;

public class Pier extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pier);
        getSupportActionBar().setTitle("Navy Pier");
    }
}
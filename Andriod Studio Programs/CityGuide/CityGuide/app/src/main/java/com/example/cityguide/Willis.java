package com.example.cityguide;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;

public class Willis extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_willis);
        getSupportActionBar().setTitle("Willis Tower");
    }
}
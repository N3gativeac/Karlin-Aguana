package com.example.alohamusic;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;

import java.util.Timer;
import java.util.TimerTask;

public class SplashActivity extends AppCompatActivity {

        @Override
        protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);

        getSupportActionBar() .hide();
        TimerTask task = new TimerTask( ) {
            @Override
            public void run() {
                finish( );
                startActivity(new Intent(SplashActivity.this, MainActivity.class));
            }
        };
        Timer opening = new Timer( );
        opening.schedule(task, 6000);

    }
}
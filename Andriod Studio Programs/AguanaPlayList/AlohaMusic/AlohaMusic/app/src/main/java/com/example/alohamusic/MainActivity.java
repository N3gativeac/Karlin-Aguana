package com.example.alohamusic;

import androidx.appcompat.app.AppCompatActivity;

import android.media.MediaPlayer;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class MainActivity extends AppCompatActivity {
    Button button1, button2 , button3;
    MediaPlayer mpNF, mpJacquees, mpRuss;
    int playing;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        getSupportActionBar().setDisplayShowHomeEnabled(true);
        getSupportActionBar().setLogo(R.mipmap.ic_launcher);
        getSupportActionBar().setDisplayUseLogoEnabled(true);

        button1 = (Button) findViewById(R.id.btnNF);
        button2 = (Button) findViewById(R.id.btnJacquees);
        button3 = (Button) findViewById(R.id.btnRuss);


        button1.setOnClickListener(bNF);
        button2.setOnClickListener(bJacquees);
        button3.setOnClickListener(bRuss);


        mpNF = new MediaPlayer();
        mpNF = MediaPlayer.create(this, R.raw.gotyouonmymind);
        mpJacquees = new MediaPlayer();
        mpJacquees = MediaPlayer.create(this, R.raw.you);
        mpRuss = new MediaPlayer();
        mpRuss = MediaPlayer.create(this, R.raw.nobodyknows);
        playing = 0;

    }

    Button.OnClickListener bNF = new Button.OnClickListener() {

        @Override
        public void onClick(View v) {
            switch (playing) {
                case 0:
                    mpNF.start();
                    playing = 1;
                    button1.setText("Pause Got You On My Mind");
                    button2.setVisibility(View.INVISIBLE);
                    button3.setVisibility(View.INVISIBLE);
                    break;
                case 1:
                    mpNF.pause();
                    playing = 0;
                    button1.setText("Play Got You On My Mind");
                    button2.setVisibility(View.VISIBLE);
                    button3.setVisibility(View.VISIBLE);

                    break;


            }
        }

        ;
    };

        Button.OnClickListener bJacquees = new Button.OnClickListener() {

            @Override
            public void onClick(View v) {
                switch (playing) {
                    case 0:
                        mpJacquees.start();
                        playing = 1;
                        button2.setText("Pause You");
                        button1.setVisibility(View.INVISIBLE);
                        button3.setVisibility(View.INVISIBLE);
                        break;
                    case 1:
                        mpJacquees.pause();
                        playing = 0;
                        button2.setText("Play You");
                        button1.setVisibility(View.VISIBLE);
                        button3.setVisibility(View.VISIBLE);
                        break;

                }
            }

        };

    Button.OnClickListener bRuss = new Button.OnClickListener() {

        @Override
        public void onClick(View v) {
            switch (playing) {
                case 0:
                    mpRuss.start();
                    playing = 1;
                    button3.setText("Pause Nobody Knows");
                    button1.setVisibility(View.INVISIBLE);
                    button2.setVisibility(View.INVISIBLE);

                    break;
                case 1:
                    mpRuss.pause();
                    playing = 0;
                    button3.setText("Play Nobody Knows");
                    button1.setVisibility(View.VISIBLE);
                    button2.setVisibility(View.VISIBLE);
                    break;

            }
        }

    };
    };

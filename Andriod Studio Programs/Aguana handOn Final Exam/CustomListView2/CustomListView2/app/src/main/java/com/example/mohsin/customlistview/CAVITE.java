package com.example.mohsin.customlistview;

import android.content.Context;
import android.content.Intent;
import android.media.MediaPlayer;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

public class CAVITE extends AppCompatActivity {
    MediaPlayer music;


    ListView listView;
    String mTitle[] = {"Hotels", "Tourist Spots", "Malls"};
    String mDescription[] = {"Go to Cavite Hotels",
            "Go to Cavite Tourist Spots",
            "Go to Cavite Malls"};
    int images[] = {R.drawable.h, R.drawable.st, R.drawable.m};

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        getSupportActionBar().setTitle("Cavite");

        music = new MediaPlayer();
        music = MediaPlayer.create(this, R.raw.cavitehymn);


        listView = findViewById(R.id.listView);

        CAVITE.MyAdapter adapter = new CAVITE.MyAdapter(this, mTitle, mDescription, images);
        listView.setAdapter(adapter);

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                switch (position){
                    case 0:
                        startActivity(new Intent(CAVITE.this, CaviteHotelJAVA.class));
                        break;
                    case 1:
                        startActivity(new Intent(CAVITE.this, CaviteSpotJAVA.class));
                        break;
                    case 2:
                        startActivity(new Intent(CAVITE.this, CaviteMalls.class));
                }
            }
        });
        music.start();
    }

    class MyAdapter extends ArrayAdapter<String> {

        Context context;
        String rTitle[];
        String rDescription[];
        int rImgs[];

        MyAdapter (Context c, String title[], String description[], int imgs[]) {
            super(c, R.layout.row, R.id.textView1, title);
            this.context = c;
            this.rTitle = title;
            this.rDescription = description;
            this.rImgs = imgs;


        }

        @NonNull
        @Override
        public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
            LayoutInflater layoutInflater = (LayoutInflater)getApplicationContext().getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            View row = layoutInflater.inflate(R.layout.row, parent, false);
            ImageView images = row.findViewById(R.id.image);
            TextView myTitle = row.findViewById(R.id.textView1);
            TextView myDescription = row.findViewById(R.id.textView2);

            images.setImageResource(rImgs[position]);
            myTitle.setText(rTitle[position]);
            myDescription.setText(rDescription[position]);

            return row;
        }
    }
    public void onBackPressed() {
        music.pause();
        finish();
    }
}



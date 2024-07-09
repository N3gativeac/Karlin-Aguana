package com.example.Aguanawowphapp;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {

    ListView listView;
    String[] Sub= {"Aklan", "Bohol", "Palawan",
                     "Baguio", "Tagaytay","Dumaguete",
                       "Boracay(TEST)","Siargao Island(TEST)",
                         "Sagada(TEST)","Banaue(TEST)"};
    String[] Des={"A province of the Philippines in the Western Visayas Region.",
            "Philippine island with Chocolate Hills & tarsiers (tiny primates), plus diving & dolphin-watching.",
            "Philippine island known for Puerto Princesa Subterranean River National Park & Tubbataha Reefs Park.",
            "Philippines mountain town, home to universities, resorts like Camp John Hay & Burnham Park.",
            "Town on a ridge overlooking Taal Lake & Taal Volcano Island is a popular holiday & recreation site.",
            "Philippine city with Rizal Boulevard, Silliman University Anthropology Museum & Casaroro Falls.",
            "YPhilippine island known for White Beach, Bulabog Beach water sports & Mount Luho views.",
            "Text for Siargao",
            "Filipino mountain town with coffins hung on cliffs, Bomod-ok Falls & the limestone Sumaging Cave.",
            "Text for Banaue"};
    int img[] = {R.drawable.aklan, R.drawable.bohol,
            R.drawable.palawan, R.drawable.baguio,
            R.drawable.tagaytay, R.drawable.dumaguete,
            R.drawable.boracay, R.drawable.siargao,
            R.drawable.sagada, R.drawable.banaue};




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        getSupportActionBar().setDisplayShowHomeEnabled(true);
        getSupportActionBar().setLogo(R.mipmap.ic_launcher);
        getSupportActionBar().setDisplayUseLogoEnabled(true);

        listView = findViewById(R.id.listView);

        MyAdapter adapter = new MyAdapter(this, Sub, Des, img);
        listView.setAdapter(adapter);

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {


            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                switch (position){
                    case 0:
                        startActivity(new Intent(MainActivity.this, Javamanila.class));
                        break;
                    case 1:
                        startActivity(new Intent(MainActivity.this, Javabohol.class));
                        break;
                    case 2:
                        startActivity(new Intent(MainActivity.this, Javapalawan.class));
                        break;
                    case 3:
                        startActivity(new Intent(MainActivity.this, Javabaguio.class));
                        break;
                    case 4:
                        startActivity(new Intent(MainActivity.this, Javatagaytay.class));
                        break;
                    case 5:
                        startActivity(new Intent(MainActivity.this, Javadumaguete.class));
                        break;
                    case 6:
                        startActivity(new Intent(MainActivity.this, test0.class));
                        break;
                    case 7:
                        startActivity(new Intent(MainActivity.this, test0.class));
                        break;
                    case 8:
                        startActivity(new Intent(MainActivity.this, test0.class));
                        break;
                    case 9:
                        startActivity(new Intent(MainActivity.this, test0.class));
                        break;
                }
            }
        });
    }
//------------------------------------------------------------------------------------------------

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
            ImageView images = row.findViewById(R.id.img);
            TextView myTitle = row.findViewById(R.id.textView1);
            TextView myDescription = row.findViewById(R.id.textView2);

            // now set our resources on views
            images.setImageResource(rImgs[position]);
            myTitle.setText(rTitle[position]);
            myDescription.setText(rDescription[position]);

            return row;
        }
    }
}
package com.example.mohsin.customlistview;

import android.content.Context;
import android.content.Intent;
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

public class MainActivity extends AppCompatActivity {

    ListView listView;
    String mTitle[] = {"Bulacan", "Cavite", "Cebu", "Laguna", "Pangasinan","Rizal"};
    String mDescription[] = {"Bulacan is a province in the Philippines located in the Central Luzon region. Its capital is the city of Malolos.",
            "Cavite City, officially the City of Cavite, is a 4th class component city in the province of Cavite, Philippines.",
            "Cebu is a province of the Philippines, in the country’s Central Visayas region, comprising Cebu Island and more than 150 smaller surrounding islands and islets.",
            "Laguna is a province just southeast of Manila and Laguna de Bay, in the Philippines. In Calamba, the Jose Rizal Shrine is a reconstruction of the national hero's childhood home. ",
            "Pangasinan is a province in the Philippines located in the Ilocos Region of Luzon. Its capital is Lingayen.",
            "Rizal, officially the Province of Rizal, is a province in the Philippines located in the Calabarzon region in Luzon."};
    int images[] = {R.drawable.aguanabulacan, R.drawable.aguanacavite, R.drawable.aguanacebu, R.drawable.aguanalaguna, R.drawable.aguanapangasinan, R.drawable.aguanarizal};

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


        listView = findViewById(R.id.listView);

        MyAdapter adapter = new MyAdapter(this, mTitle, mDescription, images);
        listView.setAdapter(adapter);

        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                switch (position){
                    case 0:
                       startActivity(new Intent(MainActivity.this, BULACAN.class));
                        break;
                    case 1:
                        startActivity(new Intent(MainActivity.this, CAVITE.class));
                        break;
                    case 2:
                        startActivity(new Intent(MainActivity.this, CEBU.class));
                        break;
                    case 3:
                        startActivity(new Intent(MainActivity.this, TestPage.class));
                        break;
                    case 4:
                        startActivity(new Intent(MainActivity.this, TestPage.class));
                        break;
                    case 5:
                        startActivity(new Intent(MainActivity.this, TestPage.class));
                        break;
                }
            }
        });

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

            // now set our resources on views
            images.setImageResource(rImgs[position]);
            myTitle.setText(rTitle[position]);
            myDescription.setText(rDescription[position]);

            return row;
        }
    }
}

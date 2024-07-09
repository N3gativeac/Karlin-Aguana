package com.example.mohsin.customlistview;

import android.content.Context;
import android.content.Intent;
import android.net.Uri;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;

public class MainActivity extends AppCompatActivity {

    ListView listView;
    String mTitle[] = {"Manila", "Bohol", "Palawan",
            "Baguio", "Boracay","Siargao Island",
            "Tagaytay","Dumaguete","Sagada","Banaue",};
    String mDescription[] = {"The Philippines’ bustling, bayside capital, with Spanish colonial landmarks & museums.",
            "Philippine island with Chocolate Hills & tarsiers (tiny primates), plus diving & dolphin-watching.",
            "Philippine island known for Puerto Princesa Subterranean River National Park & Tubbataha Reefs Park.",
            "Philippines mountain town, home to universities, resorts like Camp John Hay & Burnham Park.",
            "YPhilippine island known for White Beach, Bulabog Beach water sports & Mount Luho views.",
            "....",
            "Town on a ridge overlooking Taal Lake & Taal Volcano Island is a popular holiday & recreation site.",
            "Philippine city with Rizal Boulevard, Silliman University Anthropology Museum & Casaroro Falls.",
            "Filipino mountain town with coffins hung on cliffs, Bomod-ok Falls & the limestone Sumaging Cave.",
            "...."
    };
    int images[] = {R.drawable.manila, R.drawable.bohol,
            R.drawable.palawan, R.drawable.baguio,
            R.drawable.boracay, R.drawable.siargao,
            R.drawable.tagaytay, R.drawable.dumaguete,
            R.drawable.sagada, R.drawable.banaue,};
    // so our images and other things are set in array

    // now paste some images in drawable

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getSupportActionBar().setTitle("Bucket list");
        setContentView(R.layout.activity_main);

        getSupportActionBar().setDisplayShowHomeEnabled(true);
        getSupportActionBar().setLogo(R.mipmap.ic_launcher);
        getSupportActionBar().setDisplayUseLogoEnabled(true);

        listView = findViewById(R.id.listView);
        // now create an adapter class

        MyAdapter adapter = new MyAdapter(this, mTitle, mDescription, images);
        listView.setAdapter(adapter);
        // there is my mistake...
        // now again check this..

        // now set item click on list view
        listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id)

            {
                switch (position){
                    case 0:
                        startActivity(new Intent(MainActivity.this, manila.class));
                        break;
                    case 1:
                        startActivity(new Intent(MainActivity.this, manila.class));
                        break;
                    case 2:
                        startActivity(new Intent(MainActivity.this, manila.class));
                        break;
                    case 3:
                        startActivity(new Intent(MainActivity.this, manila.class));
                        break;
                    case 4:
                        startActivity(new Intent(MainActivity.this, manila.class));
                        break;
                    case 5:
                        startActivity(new Intent(MainActivity.this, manila.class));
                        break;
                    case 6:
                        startActivity(new Intent(MainActivity.this, manila.class));
                        break;
                    case 7:
                        startActivity(new Intent(MainActivity.this, manila.class));
                        break;
                    case 8:
                        startActivity(new Intent(MainActivity.this, manila.class));
                        break;
                    case 9:
                        startActivity(new Intent(MainActivity.this, manila.class));
                        break;
                }
            }
        });
        // so item click is done now check list view
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

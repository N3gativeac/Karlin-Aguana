package com.example.endangeredspecies;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Context;
import android.os.Bundle;
import android.view.Gravity;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.BaseAdapter;
import android.widget.GridView;
import android.widget.ImageView;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {
    Integer[] Animals = {R.drawable.veganblueberry,R.drawable.easypumpkin,R.drawable.roastedkabocha,R.drawable.mangococonut,R.drawable.blueberrybanana,R.drawable.shrimpceviche
    ,R.drawable.skinnycheddar,R.drawable.pineapplesalsa};
    ImageView pic;

    String[] snack = new String[]
            {
                    "Vegan Blueberry Scones",
                    "Pumpkin Chickpea Fritters",
                    "Roasted Kabocha Squash Dip",
                    "Mango Coconut Shrimp Pops",
                    "Blueberry Banana Smoothie",
                    "Shrimp Ceviche Sonora Style",
                    "Skinny Cheddar Bay Biscuits",
                    "Pineapple Salsa"
            };

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        getSupportActionBar().setDisplayShowHomeEnabled(true);
        getSupportActionBar().setLogo(R.mipmap.ic_launcher);
        getSupportActionBar().setDisplayUseLogoEnabled(true);

        GridView grid = (GridView)findViewById(R.id.gridView);
        final ImageView pic = (ImageView)findViewById(R.id.imgLarge);
        grid.setAdapter(new ImageAdapter(this));
        grid.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Toast.makeText(getBaseContext()," Snack no. " + (position + 1)+" : "+ snack[position], Toast.LENGTH_LONG).show();
                pic.setImageResource(Animals[position]);

            }
        });
    }
    public class ImageAdapter extends BaseAdapter {
        private Context context;

        public ImageAdapter(Context c) {
            context=c;
        }

        @Override
        public int getCount() {
            return Animals.length;
        }

        @Override
        public Object getItem(int position) {
            return null;
        }

        @Override
        public long getItemId(int position) {
            return 0;
        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {
            pic = new ImageView(context);
            pic.setImageResource(Animals[position]);
            pic.setScaleType(ImageView.ScaleType.FIT_XY);
            pic.setLayoutParams(new ViewGroup.LayoutParams(250,250));
            return pic;
        }
    }
}
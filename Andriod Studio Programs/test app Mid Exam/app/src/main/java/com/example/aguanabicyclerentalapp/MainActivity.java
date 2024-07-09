package com.example.aguanabicyclerentalapp;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ListActivity;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;

public class MainActivity extends ListActivity {


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        String[] menu={"Mountain Bike Rental","Road Bike Rental","BMX/Trial Bike Rental","Triathlon/Time Trial Bikes Rental","Tandem Bikes Rental","Adult Trike Bikes Rental","Bikes Rental Website"};
setListAdapter(new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1, menu));
    }
    protected void onListItemClick(ListView l, View v, int position, long id){
switch(position){
    case 0:
        startActivity(new Intent(MainActivity.this, Mountain_Bike.class));
        break;
    case 1:
        startActivity(new Intent(MainActivity.this, Road_Bikes.class));
        break;
    case 2:
        startActivity(new Intent(MainActivity.this, BMX_Tric_kBikes.class));
        break;
    case 3:
        startActivity(new Intent(MainActivity.this, Triathlon_Bikes.class));
        break;
    case 4:
        startActivity(new Intent(MainActivity.this, Tandem_Bikes.class));
        break;
    case 5:
        startActivity(new Intent(MainActivity.this, Adult_Bikes.class));
        break;
    case 6:
        startActivity (new Intent( Intent. ACTION_VIEW , Uri.parse ("http://www.bimbimbikes.com")));
        break;
}
    }
}
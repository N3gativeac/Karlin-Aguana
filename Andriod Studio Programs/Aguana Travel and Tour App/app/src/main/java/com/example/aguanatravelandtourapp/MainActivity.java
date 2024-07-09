package com.example.aguanatravelandtourapp;

import android.annotation.SuppressLint;
import android.os.Bundle;
import android.widget.ListView;

import androidx.appcompat.app.AppCompatActivity;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {

    ListView listView;

    @SuppressLint("WrongViewCast")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super .onCreate(savedInstanceState);
        //setContentView(R.layout.activity_main);

        listView = findViewById(R.id.listView);


        ArrayList<place> arrayList = new ArrayList<>();

        arrayList.add(new place(R.drawable.china,"asdadasdffw","asfeqqqqqqq"));
        arrayList.add(new place(R.drawable.bhutan,"asdadasdffw","asfeqqqqqqq"));
        arrayList.add(new place(R.drawable.india,"asdadasdffw","asfeqqqqqqq"));
        arrayList.add(new place(R.drawable.nepal,"asdadasdffw","asfeqqqqqqq"));
        arrayList.add(new place(R.drawable.china,"asdadasdffw","asfeqqqqqqq"));

        placeAdapter PlaceAdapter = new placeAdapter(this,R.layout.list_row,arrayList);

        listView.setAdapter(PlaceAdapter);
    }
}

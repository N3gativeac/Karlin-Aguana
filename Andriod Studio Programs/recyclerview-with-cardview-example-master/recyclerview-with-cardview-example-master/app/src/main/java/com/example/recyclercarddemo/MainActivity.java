package com.example.recyclercarddemo;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.View;

import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {
    RecyclerView recyclerView;
    Adapter adapter;
    ArrayList<String> items;
    ArrayList<String> DES;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        items = new ArrayList<>();
        items.add("First CardView Item");
        items.add("Second CardView Item");
        items.add("Third CardView Item");
        items.add("Fourth CardView Item");
        items.add("Fifth CardView Item");
        items.add("Sixth CardView Item");

        DES = new ArrayList<>();
        DES.add("aaaaaaaaaaaaaaaaaaa");
        DES.add("bbbbbbbbbbbbbbbbb");
        DES.add("wwwwwwwwwwwwwwwwwwwwwww");
        DES.add("eeeeeeeeeeeeeeeeeeee");
        DES.add("rrrrrrrrrrrrrrrrrrrrr");
        DES.add("qqqqqqqqqqqqqqqqqqqqq");


        recyclerView = findViewById(R.id.recyclerView);
        recyclerView.setLayoutManager(new LinearLayoutManager(this));
        adapter = new Adapter(this,items);
        recyclerView.setAdapter(adapter);



    }
}

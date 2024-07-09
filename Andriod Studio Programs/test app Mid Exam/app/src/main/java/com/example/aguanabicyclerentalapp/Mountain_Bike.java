package com.example.aguanabicyclerentalapp;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;

import java.text.DecimalFormat;

public class Mountain_Bike extends AppCompatActivity {
    int HintEntered;
    double ComputeCost;
    double Mountain = 1200.00;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_mountain__bike);
        getSupportActionBar().setTitle("Mountain Bike Rental");
        final EditText number = (EditText)findViewById(R.id.txtNumberofDays);
        final TextView result = (TextView)findViewById(R.id.txtResult);
        Button convert = (Button)findViewById(R.id.btnComputeCost);
        convert.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                HintEntered=Integer.parseInt(number.getText().toString());
                DecimalFormat tenth = new DecimalFormat("Php##,###.##");
                        ComputeCost = HintEntered * Mountain;
                        result.setText("Mountain Bike rent for " + HintEntered +" days will cost " + tenth.format(ComputeCost));
            }
        });
    }
}
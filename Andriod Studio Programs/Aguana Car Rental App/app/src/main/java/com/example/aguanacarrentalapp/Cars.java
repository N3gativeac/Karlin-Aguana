package com.example.aguanacarrentalapp;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import java.text.BreakIterator;
import java.text.DecimalFormat;

public class Cars extends AppCompatActivity {
    int HintEntered;
    double ComputeCost;
    double SUVcost = 5530.25;
    double TruckCost = 4750.75;
    double CoupeCost = 8326.30;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cars);
        getSupportActionBar().setDisplayShowHomeEnabled(true);
        getSupportActionBar().setLogo(R.mipmap.ic_launcher);
        getSupportActionBar().setDisplayUseLogoEnabled(true);


        final EditText number = (EditText)findViewById(R.id.txtHint);
        final RadioGroup group = (RadioGroup) findViewById(R.id.radioGroup);
        final RadioButton SUV = (RadioButton)findViewById(R.id.SUV);
        final RadioButton Truck = (RadioButton)findViewById(R.id.Truck);
        final RadioButton Coupe = (RadioButton)findViewById(R.id.Coupe);
        final TextView result = (TextView)findViewById(R.id.txtResult);
        Button convert = (Button)findViewById(R.id.btnComputeCost);
        convert.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                HintEntered=Integer.parseInt(number.getText().toString());
                DecimalFormat tenth = new DecimalFormat("Php##,###.##");
                if(SUV.isChecked()) {
                    if (HintEntered <7) {
                        ComputeCost = HintEntered * SUVcost;
                        result.setText("SUV rent for " + HintEntered +" days will cost " + tenth.format(ComputeCost));

                    }else {
                        Toast.makeText(Cars.this,"You should enter less than 7 days", Toast.LENGTH_LONG).show( );
                    }
                }
                if(Truck.isChecked()) {
                    if (HintEntered <4) {
                        ComputeCost = HintEntered * TruckCost;
                        result.setText("Truck rent for " + HintEntered +" days will cost " + tenth.format(ComputeCost));

                    }else {
                        Toast.makeText(Cars.this,"You should enter less than 4 days", Toast.LENGTH_LONG).show( );
                    }
                }
                if(Coupe.isChecked()) {
                    if (HintEntered <3) {
                        ComputeCost = HintEntered * CoupeCost;
                        result.setText("Coupe rent for " + HintEntered +" days will cost " + tenth.format(ComputeCost));

                    }else {
                        Toast.makeText(Cars.this,"You should enter less than 3 days", Toast.LENGTH_LONG).show( );
                    }
                }
            }
        });
    }
}
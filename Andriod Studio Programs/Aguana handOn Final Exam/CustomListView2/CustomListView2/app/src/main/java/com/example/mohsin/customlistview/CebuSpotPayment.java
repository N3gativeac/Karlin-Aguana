package com.example.mohsin.customlistview;

import android.content.SharedPreferences;
import android.preference.PreferenceManager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import java.text.DecimalFormat;

public class CebuSpotPayment extends AppCompatActivity {
    float total;
    float convDays;
    float convGuests;
    float totalCost;
    float Spot1 = 100;
    float Spot2 = 500;
    float Spot3 = 700;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cebu_spot_payment);
        getSupportActionBar() .hide();
        TextView Result = (TextView) findViewById(R.id.ResultBulacantxt);
        TextView Result1 = (TextView) findViewById(R.id.SpotCost);
        TextView ResultNumDays = (TextView) findViewById(R.id.SpotNumDays);
        TextView ResultNumGuests = (TextView) findViewById(R.id.SpotNumGuests);

        ImageView image = (ImageView) findViewById(R.id.imgYears);
        SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
        int Check = sharedPref.getInt("key4", 0);
        int IntSpotBulacanDays = sharedPref.getInt("key5", 0);
        float IntSpotBulacanGuests = sharedPref.getFloat("key6", 0);
        DecimalFormat currency =new DecimalFormat("Php###,###.##");
        DecimalFormat NO = new DecimalFormat("###,###,###");
        convDays = (float) IntSpotBulacanDays;
        convGuests = (float) IntSpotBulacanGuests;

        if (Check == 1) {
            total = (Spot1 * convGuests);
            totalCost = total * convDays;
            Spot1 = 100;
            Result1.setText("Entrance fee Cost: " + currency.format(Spot1));
            ResultNumDays.setText("Total number of days: " + NO.format(convDays));
            ResultNumGuests.setText("total number of guests: " + NO.format(convGuests));
            Result.setText("Total payment: " + currency.format(totalCost));
            image.setImageResource(R.drawable.leah);
            Toast.makeText(CebuSpotPayment.this,"Cebu Taoist Temple", Toast.LENGTH_LONG).show( );
        }
        if (Check == 2) {
            total = (Spot2 * convGuests);
            totalCost = total * convDays;
            Spot2 = 500;
            Result1.setText("Entrance fee Cost: " + currency.format(Spot2));
            ResultNumDays.setText("Total number of days: " + NO.format(convDays));
            ResultNumGuests.setText("total number of guests: " + NO.format(convGuests));
            Result.setText("Total payment: " + currency.format(totalCost));
            image.setImageResource(R.drawable.sirao);
            Toast.makeText(CebuSpotPayment.this,"Temple of Leah", Toast.LENGTH_LONG).show( );
        }
        if (Check == 3) {
            total = (Spot3 * convGuests);
            totalCost = total * convDays;
            Spot3 = 700;
            Result1.setText("Entrance fee Cost: " + currency.format(Spot3));
            ResultNumDays.setText("Total number of days: " + NO.format(convDays));
            ResultNumGuests.setText("total number of guests: " + NO.format(convGuests));
            Result.setText("Total payment: " + currency.format(totalCost));
            image.setImageResource(R.drawable.taoist);
            Toast.makeText(CebuSpotPayment.this,"Sirao Flower Garden", Toast.LENGTH_LONG).show( );
        }



    }
}
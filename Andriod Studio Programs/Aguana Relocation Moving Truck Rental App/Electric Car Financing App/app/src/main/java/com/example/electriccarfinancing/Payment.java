package com.example.electriccarfinancing;

import androidx.appcompat.app.AppCompatActivity;

import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.widget.ImageView;
import android.widget.TextView;

import java.text.DecimalFormat;

public class Payment extends AppCompatActivity {
    float totalCost;
float convNuDaysRest;
float convDecInterest;
float txtdaytotal;
float MileTotal;
float TenT = 10000;
float SevenT = 17000;
float TwentyST = 22000;
float Miles = 175;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_payment);
        getSupportActionBar() .hide();
        TextView monthlyPayment = (TextView) findViewById(R.id.txtMonthlyPayment);


        ImageView image = (ImageView) findViewById(R.id.imgYears);
        SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
        int Check = sharedPref.getInt("key4", 0);
        int intDays = sharedPref.getInt("key5", 0);
        float decKilometrage = sharedPref.getFloat("key6", 0);
        convNuDaysRest = (float) intDays;
        convDecInterest = (float) decKilometrage;

        DecimalFormat currency =new DecimalFormat("Php###,###.##");

        if (Check == 1) {
            txtdaytotal = (TenT * convNuDaysRest);
            MileTotal = (convDecInterest * Miles);
            totalCost = txtdaytotal + MileTotal;
            monthlyPayment.setText("Total payment: " + currency.format(totalCost));
            image.setImageResource(R.drawable.ten);
        }
        if (Check == 2) {
            txtdaytotal = (SevenT * convNuDaysRest);
            MileTotal = (convDecInterest * Miles);
            totalCost = txtdaytotal + MileTotal;
            monthlyPayment.setText("Total payment: " + currency.format(totalCost));
            image.setImageResource(R.drawable.seventeen);
        }
        if (Check == 3) {
            txtdaytotal = (TwentyST * convNuDaysRest);
            MileTotal = (convDecInterest * Miles);
            totalCost = txtdaytotal + MileTotal;
            monthlyPayment.setText("Total payment: " + currency.format(totalCost));
            image.setImageResource(R.drawable.twentysix);
        }
    }
}
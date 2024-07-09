package com.example.mohsin.customlistview;

import android.content.SharedPreferences;
import android.media.MediaPlayer;
import android.preference.PreferenceManager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import java.text.DecimalFormat;

public class CaviteHotelPayment extends AppCompatActivity {
    float total;
    float convDays;
    float convRooms;
    float totalCost;
    float hotel1 = 2500;
    float hotel2 = 2800;
    float hotel3 = 2000;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cavite_hotel_payment);
        getSupportActionBar() .hide();
        TextView Result = (TextView) findViewById(R.id.ResultTxt);
        TextView Result1 = (TextView) findViewById(R.id.HotelCost);
        TextView ResultNumDays = (TextView) findViewById(R.id.HotelNumDays);
        TextView ResultNumRooms = (TextView) findViewById(R.id.HotelNumRooms);

        ImageView image = (ImageView) findViewById(R.id.imgYears);
        SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
        int Check = sharedPref.getInt("key4", 0);
        int IntHotelBulacanDays = sharedPref.getInt("key5", 0);
        float IntHotelBulacanRoom = sharedPref.getFloat("key6", 0);
        DecimalFormat currency =new DecimalFormat("Php###,###.##");
        DecimalFormat NO = new DecimalFormat("###,###,###");
        convDays = (float) IntHotelBulacanDays;
        convRooms = (float) IntHotelBulacanRoom;

        if (Check == 1) {
            total = (hotel1 * convRooms);
            totalCost = total * convDays;
            hotel1 = 2500;
            Result1.setText("Hotel Cost: " + currency.format(hotel1));
            ResultNumDays.setText("Total number of days: " + NO.format(convDays));
            ResultNumRooms.setText("total number of rooms: " + NO.format(convRooms));
            Result.setText("Total payment: " + currency.format(totalCost));
            image.setImageResource(R.drawable.one);
            Toast.makeText(CaviteHotelPayment.this,"One Serenata Hotel", Toast.LENGTH_LONG).show( );
        }
        if (Check == 2) {
            total = (hotel2 * convRooms);
            totalCost = total * convDays;
            hotel2 = 2800;
            Result1.setText("Hotel Cost: " + currency.format(hotel2));
            ResultNumDays.setText("Total number of days: " + NO.format(convDays));
            ResultNumRooms.setText("total number of rooms: " + NO.format(convRooms));
            Result.setText("Total payment: " + currency.format(totalCost));
            image.setImageResource(R.drawable.the);
            Toast.makeText(CaviteHotelPayment.this,"The Bayleaf Cavite", Toast.LENGTH_LONG).show( );
        }
        if (Check == 3) {
            total = (hotel3 * convRooms);
            totalCost = total * convDays;
            hotel3 = 2000;
            Result1.setText("Hotel Cost: " + currency.format(hotel3));
            ResultNumDays.setText("Total number of days: " + NO.format(convDays));
            ResultNumRooms.setText("total number of rooms: " + NO.format(convRooms));
            Result.setText("Total payment: " + currency.format(totalCost));
            image.setImageResource(R.drawable.courtyard);
            Toast.makeText(CaviteHotelPayment.this,"88 Courtyard Hotel", Toast.LENGTH_LONG).show( );
        }

    }
}
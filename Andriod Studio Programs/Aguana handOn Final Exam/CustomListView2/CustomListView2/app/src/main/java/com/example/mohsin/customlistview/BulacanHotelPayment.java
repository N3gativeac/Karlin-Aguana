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

public class BulacanHotelPayment extends AppCompatActivity {
    float total;
    float convDays;
    float convRooms;
    float totalCost;
    float hotel1 = 1500;
    float hotel2 = 1800;
    float hotel3 = 1600;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_bulacan_hotel_payment);
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
            hotel1 = 1500;
            Result1.setText("Hotel Cost: " + currency.format(hotel1));
            ResultNumDays.setText("Total number of days: " + NO.format(convDays));
            ResultNumRooms.setText("total number of rooms: " + NO.format(convRooms));
            Result.setText("Total payment: " + currency.format(totalCost));
            image.setImageResource(R.drawable.aerostop);
            Toast.makeText(BulacanHotelPayment.this,"Aerostop Hotel and Restaurant", Toast.LENGTH_LONG).show( );
        }
        if (Check == 2) {
            total = (hotel2 * convRooms);
            totalCost = total * convDays;
            hotel2 = 1800;
            Result1.setText("Hotel Cost: " + currency.format(hotel2));
            ResultNumDays.setText("Total number of days: " + NO.format(convDays));
            ResultNumRooms.setText("total number of rooms: " + NO.format(convRooms));
            Result.setText("Total payment: " + currency.format(totalCost));
            image.setImageResource(R.drawable.jbs);
            Toast.makeText(BulacanHotelPayment.this,"Jbs Tourist Inn", Toast.LENGTH_LONG).show( );
        }
        if (Check == 3) {
            total = (hotel3 * convRooms);
            totalCost = total * convDays;
            hotel3 = 1600;
            Result1.setText("Hotel Cost: " + currency.format(hotel3));
            ResultNumDays.setText("Total number of days: " + NO.format(convDays));
            ResultNumRooms.setText("total number of rooms: " + NO.format(convRooms));
            Result.setText("Total payment: " + currency.format(totalCost));
            image.setImageResource(R.drawable.zen);
            Toast.makeText(BulacanHotelPayment.this,"ZEN Rooms Green Ville Bulacan", Toast.LENGTH_LONG).show( );
        }

    }
}
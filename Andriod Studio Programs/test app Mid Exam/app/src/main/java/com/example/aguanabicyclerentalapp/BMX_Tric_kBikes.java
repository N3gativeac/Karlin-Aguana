package com.example.aguanabicyclerentalapp;

        import androidx.appcompat.app.AppCompatActivity;

        import android.os.Bundle;
        import android.view.View;
        import android.widget.Button;
        import android.widget.EditText;
        import android.widget.TextView;

        import java.text.DecimalFormat;

public class BMX_Tric_kBikes extends AppCompatActivity {
    int HintEntered;
    double ComputeCost;
    double BMX = 1300.25;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_b_m_x__tric_k_bikes);
        getSupportActionBar().setTitle("BMX/Trick Bike Rental");
        final EditText number = (EditText)findViewById(R.id.txtNumberofDays);
        final TextView result = (TextView)findViewById(R.id.txtResult);
        Button convert = (Button)findViewById(R.id.btnComputeCost);
        convert.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                HintEntered=Integer.parseInt(number.getText().toString());
                DecimalFormat tenth = new DecimalFormat("Php##,###.##");
                ComputeCost = HintEntered * BMX;
                result.setText("BMX/Trick Bike rent for " + HintEntered +" days will cost " + tenth.format(ComputeCost));
            }
        });
    }
}
package net.simplifiedcoding.simplifiedcoding;
import android.content.Intent;
import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

public class ProfileActivity extends AppCompatActivity {
    //specify params
    TextView textViewId, textViewUsername, textViewEmail, textViewGender, textViewMeterID, textViewUserBalance;
    String textViewUserBalanceString;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

        //if the user is not logged in
        //starting the login activity
        if (!SharedPrefManager.getInstance(this).isLoggedIn()) {
            finish();
            startActivity(new Intent(this, LoginActivity.class));
        }

        //parse declaration from resources
        textViewId = (TextView) findViewById(R.id.textViewId);
        textViewUsername = (TextView) findViewById(R.id.textViewUsername);
        textViewEmail = (TextView) findViewById(R.id.textViewEmail);
        textViewGender = (TextView) findViewById(R.id.textViewGender);
        textViewMeterID = (TextView) findViewById(R.id.textViewMeterID);
        textViewUserBalance = (TextView) findViewById(R.id.textViewUserBalance);



        //getting the current user
        User user = SharedPrefManager.getInstance(this).getUser();

        //setting the values to the textViews
        textViewId.setText(String.valueOf(user.getId()));
        textViewUsername.setText(user.getUsername());
        textViewEmail.setText(user.getEmail());
        textViewGender.setText(user.getGender());
        textViewMeterID.setText(user.getMeterID());
        textViewUserBalanceString = Float.toString(user.getUserBalance());
        textViewUserBalance.setText(textViewUserBalanceString);


        //when the user presses logout button
        //calling the logout method
        findViewById(R.id.buttonLogout).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
                SharedPrefManager.getInstance(getApplicationContext()).logout();
            }
        });
    }
}
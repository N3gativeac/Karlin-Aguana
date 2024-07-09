package net.simplifiedcoding.simplifiedcoding;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import androidx.appcompat.app.AppCompatActivity;
import android.text.TextUtils;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Spinner;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;

public class MainActivity extends AppCompatActivity{
    //declare variables
    EditText editTextUsername, editTextFullName, editTextEmail, editTextPassword,editTextRetypePassword, editTextMeterID, editTextPurokStreet;
    Spinner spinnerTownCityPicker, spinnerBarangayPicker;
    RadioGroup radioGroupGender;
    String tempTown, tempBarangay;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //if the user is already logged in we will directly start the profile activity
        if (SharedPrefManager.getInstance(this).isLoggedIn()) {
            finish();
            startActivity(new Intent(this, CustomerMainActivity.class));
            return;
        }
        //Auto map from elements
        //Personal Info
        editTextUsername = (EditText) findViewById(R.id.editTextUsername);
        editTextFullName = (EditText) findViewById(R.id.editTextFullName);
        editTextEmail = (EditText) findViewById(R.id.editTextEmail);
        editTextPassword = (EditText) findViewById(R.id.editTextPassword);
        editTextRetypePassword = (EditText) findViewById(R.id.editTextRetypePassword);
        radioGroupGender = (RadioGroup) findViewById(R.id.radioGender);
        //Address
        spinnerTownCityPicker = (Spinner) findViewById(R.id.spinnerTownCityPicker);
        spinnerBarangayPicker = (Spinner) findViewById(R.id.spinnerBarangayPicker);
        editTextPurokStreet = (EditText) findViewById(R.id.editTextPurokStreet);
        //SUKELCO Meter ID
        editTextMeterID = (EditText) findViewById(R.id.editTextMeterID);

        //Dual spinner stuff
        //First spinner (spinnerTownCityPicker)
        spinnerTownCityPicker.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                String selectedCity = adapterView.getItemAtPosition(i).toString();
                //assign each town to set the value for the barangay array and set the town directly
                switch (selectedCity)
                {
                    case "Bagumbayan":
                        spinnerBarangayPicker.setAdapter(new ArrayAdapter<String>(MainActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.BagumbayanBarangay)));
                        tempTown = selectedCity;
                        break;
                    case "Columbio":
                        spinnerBarangayPicker.setAdapter(new ArrayAdapter<String>(MainActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.ColumbioBarangay)));
                        tempTown = selectedCity;
                        break;
                    case "Esperanza":
                        spinnerBarangayPicker.setAdapter(new ArrayAdapter<String>(MainActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.EsperanzaBarangays)));
                        tempTown = selectedCity;
                        break;
                    case "Isulan":
                        spinnerBarangayPicker.setAdapter(new ArrayAdapter<String>(MainActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.IsulanBarangays)));
                        tempTown = selectedCity;
                        break;
                    case "Kalamansig":
                        spinnerBarangayPicker.setAdapter(new ArrayAdapter<String>(MainActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.KalamansigBarangays)));
                        tempTown = selectedCity;
                        break;
                    case "Lambayong":
                        spinnerBarangayPicker.setAdapter(new ArrayAdapter<String>(MainActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.LabayongBarangays)));
                        tempTown = selectedCity;
                        break;
                    case "Lebak":
                        spinnerBarangayPicker.setAdapter(new ArrayAdapter<String>(MainActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.LebakBarangays)));
                        tempTown = selectedCity;
                        break;
                    case "Lutayan":
                        spinnerBarangayPicker.setAdapter(new ArrayAdapter<String>(MainActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.LutayanBarangays)));
                        tempTown = selectedCity;
                        break;
                    case "Palimbang":
                        spinnerBarangayPicker.setAdapter(new ArrayAdapter<String>(MainActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.PalimbangBarangays)));
                        tempTown = selectedCity;

                        break;
                    case "President Quirino":
                        spinnerBarangayPicker.setAdapter(new ArrayAdapter<String>(MainActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.PresQuirinoBarangays)));
                        tempTown = selectedCity;
                        break;
                    case "Senator Ninoy Aquino":
                        spinnerBarangayPicker.setAdapter(new ArrayAdapter<String>(MainActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.SenNinoyAquinoBarangays)));
                        tempTown = selectedCity;
                        break;
                    case "Tacurong City":
                        spinnerBarangayPicker.setAdapter(new ArrayAdapter<String>(MainActivity.this, android.R.layout.simple_spinner_dropdown_item,getResources().getStringArray(R.array.TacurongBarangays)));
                        tempTown = selectedCity;
                        break;
                    default:
                        Toast.makeText(getApplicationContext(), "Please select a town or city", Toast.LENGTH_SHORT).show();
                        break;
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {
                //Pretend there is data here
            }
        });
        //Second Spinner (spinnerBarangayPicker)
        spinnerBarangayPicker.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {

            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                //Set the appropriate barangay
                String selectedBarangays = adapterView.getItemAtPosition(i).toString();
                tempBarangay = selectedBarangays;
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {
                //filler data
            }
        });

        //Registration button

        findViewById(R.id.buttonRegister).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //if user pressed on button register
                //here we will register the user to server
                registerUser();
            }
        });
        //Login button (redirected later)
        findViewById(R.id.textViewLogin).setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //if user pressed on login
                //we will open the login screen
                finish();
                startActivity(new Intent(MainActivity.this, LoginActivity.class));
            }
        });

    }
    //private class for parsing user info to the database
    private void registerUser() {
        final String username = editTextUsername.getText().toString().trim();
        final String fullname = editTextFullName.getText().toString().trim();
        final String email = editTextEmail.getText().toString().trim();
        final String password = editTextPassword.getText().toString().trim();
        final String rePassword = editTextRetypePassword.getText().toString().trim();
        final String purok = editTextPurokStreet.getText().toString().trim();
        final String barangay = spinnerBarangayPicker.getSelectedItem().toString().trim();
        final String town = spinnerTownCityPicker.getSelectedItem().toString().trim();
        final String meterID = editTextMeterID.getText().toString().trim();
        final String gender = ((RadioButton) findViewById(radioGroupGender.getCheckedRadioButtonId())).getText().toString();

        //first we will do the validations
        //Empty username
        if (TextUtils.isEmpty(username)) {
            editTextUsername.setError("Please enter username");
            editTextUsername.requestFocus();
            return;
        }
        //Empty fullname
        if (TextUtils.isEmpty(fullname))
        {
            editTextFullName.setError("Please enter full name");
            editTextUsername.requestFocus();
        }
        //Empty email
        if (TextUtils.isEmpty(email)) {
            editTextEmail.setError("Please enter your email");
            editTextEmail.requestFocus();
            return;
        }
        //Invalid e-mail pattern
        if (!android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            editTextEmail.setError("Enter a valid email");
            editTextEmail.requestFocus();
            return;
        }
        //Empty password
        if (TextUtils.isEmpty(password)) {
            editTextPassword.setError("Enter a password");
            editTextPassword.requestFocus();
            return;
        }
        //Tell user to add more characters to password (for security purposes)
        if (password.length() < 8)
        {
            editTextPassword.setError("Password length at least 8 or more");
            editTextPassword.requestFocus();
            return;
        }
        if (!password.equals(rePassword))
        {
            editTextPassword.setError("Passwords does not match");
            editTextPassword.requestFocus();
            return;
        }
        //Empty MeterID
        if (TextUtils.isEmpty(meterID)){
            editTextMeterID.setError("Enter a valid Meter ID");
            editTextMeterID.requestFocus();
            return;
        }

        //if it passes all the validations

        class RegisterUser extends AsyncTask<Void, Void, String> {

            private ProgressBar progressBar;

            @Override
            protected String doInBackground(Void... voids) {
                //creating request handler object
                RequestHandler requestHandler = new RequestHandler();

                //creating request parameters
                HashMap<String, String> params = new HashMap<>();
                params.put("username", username);
                params.put("fullname",fullname);
                params.put("email", email);
                params.put("password", password);
                params.put("gender", gender);
                params.put("purok",purok);
                params.put("barangay", barangay);
                params.put("town", town);
                params.put("meterid", meterID);

                //returning the response
                return requestHandler.sendPostRequest(URLs.URL_REGISTER, params);
            }

            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                //displaying the progress bar while user registers on the server
                progressBar = (ProgressBar) findViewById(R.id.progressBar);
                progressBar.setVisibility(View.VISIBLE);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                //hiding the progressbar after completion
                progressBar.setVisibility(View.GONE);

                try {
                    //converting response to json object
                    JSONObject obj = new JSONObject(s);

                    //if no error in response
                    if (!obj.getBoolean("error")) {
                        Toast.makeText(getApplicationContext(), obj.getString("message"), Toast.LENGTH_SHORT).show();

                        //getting the user from the response
                        JSONObject userJson = obj.getJSONObject("user");

                        ///creating a new user object
                        User user = new User(
                                userJson.getInt("id"),
                                userJson.getString("username"),
                                userJson.getString("fullname"),
                                userJson.getString("email"),
                                userJson.getString("gender"),
                                userJson.getString("purok"),
                                userJson.getString("barangay"),
                                userJson.getString("town"),
                                userJson.getString("meterid"),
                                userJson.getString("getKWH"),
                                (float) userJson.getDouble("customerbalance")
                        );

                        //storing the user in shared preferences
                        SharedPrefManager.getInstance(getApplicationContext()).userLogin(user);

                        //starting the profile activity
                        finish();
                        startActivity(new Intent(getApplicationContext(), CustomerMainActivity.class));

                    } else {
                        Toast.makeText(getApplicationContext(), "Some error occurred", Toast.LENGTH_SHORT).show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }

        //executing the async task
        RegisterUser ru = new RegisterUser();
        ru.execute();
    }
}
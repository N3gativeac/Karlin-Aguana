package xyz.infinitydoki.sukelco.consumer.app;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;


//here for this class we are using a singleton pattern

public class SharedPrefManager {

    //the constants
    private static final String SHARED_PREF_NAME = "simplifiedcodingsharedpref";
    private static final String KEY_USERNAME = "keyusername";
    private static final String KEY_FULLNAME = "keyfullname";
    private static final String KEY_FULLADDRESS = "keyfulladdress";
    private static final String KEY_EMAIL = "keyemail";
    private static final String KEY_GENDER = "keygender";
    private static final String KEY_METERID = "keymeterid";
    private static final String KEY_PUROK = "keypurok";
    private static final String KEY_BARANGAY = "keybarangay";
    private static final String KEY_TOWN = "keytown";
    private static final String KEY_USERBALANCE = "keyuserbalance";
    private static final String KEY_TOTALKWH = "keytotalkwh";
    private static final String KEY_ID = "keyid";

    private static SharedPrefManager mInstance;
    private static Context mCtx;

    private SharedPrefManager(Context context) {
        mCtx = context;
    }

    public static synchronized SharedPrefManager getInstance(Context context) {
        if (mInstance == null) {
            mInstance = new SharedPrefManager(context);
        }
        return mInstance;
    }

    //method to let the user login
    //this method will store the user data in shared preferences
    public void userLogin(User user) {
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putInt(KEY_ID, user.getId());
        editor.putString(KEY_USERNAME, user.getUsername());
        editor.putString(KEY_FULLNAME, user.getFullname());
        editor.putString(KEY_EMAIL, user.getEmail());
        editor.putString(KEY_GENDER, user.getGender());
        editor.putString(KEY_PUROK, user.getPurok());
        editor.putString(KEY_BARANGAY, user.getBarangay());
        editor.putString(KEY_TOWN, user.getTown());
        editor.putString(KEY_FULLADDRESS, user.getFullAddress());
        editor.putString(KEY_METERID, user.getMeterID());
        editor.putString(KEY_TOTALKWH, user.getTotalKWH());
        editor.putFloat(KEY_USERBALANCE, user.getUserBalance());
        editor.apply();
    }

    //this method will checker whether user is already logged in or not
    public boolean isLoggedIn() {
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(KEY_USERNAME, null) != null;
    }

    //this method will give the logged in user
    public User getUser() {
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);

        User user = new User(
                sharedPreferences.getInt(KEY_ID, -1),
                sharedPreferences.getString(KEY_USERNAME, null),
                sharedPreferences.getString(KEY_FULLNAME, null),
                sharedPreferences.getString(KEY_EMAIL, null),
                sharedPreferences.getString(KEY_GENDER, null),
                sharedPreferences.getString(KEY_PUROK, null),
                sharedPreferences.getString(KEY_BARANGAY, null),
                sharedPreferences.getString(KEY_TOWN, null),
                sharedPreferences.getString(KEY_METERID, null),
                sharedPreferences.getString(KEY_TOTALKWH, null),
                sharedPreferences.getFloat(KEY_USERBALANCE, 0.5F)
        );
        return user;
    }

    //this method will logout the user
    public void logout() {
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.clear();
        editor.apply();
        Intent logOutIntent = new Intent(mCtx, LoginActivity.class);
        logOutIntent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
       mCtx.startActivity(logOutIntent);

    }
}

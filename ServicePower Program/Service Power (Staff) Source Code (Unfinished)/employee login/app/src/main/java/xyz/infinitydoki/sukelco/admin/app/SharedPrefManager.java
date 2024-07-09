package xyz.infinitydoki.sukelco.admin.app;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;

//here for this class we are using a singleton pattern

public class SharedPrefManager {

    //the constants
    private static final String SHARED_PREF_NAME = "simplifiedcodingsharedpref";
    private static final String KEY_USERNAME= "keyusername";
    private static final String KEY_EMPLOYEENAME = "keyemployeename";
    private static final String KEY_EMPLOYEEAGE = "keyemployeeage";
    private static final String KEY_EMPLOYEEPOSITION = "keyemployeeposition";
    private static final String KEY_EMPLOYEEADDRESS = "keyemployeeaddress";

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
        editor.putString(KEY_USERNAME, user.getUsername());
        editor.putString(KEY_EMPLOYEENAME, user.getEmployeeName());
        editor.putInt(KEY_EMPLOYEEAGE, user.getEmployeeAge());
        editor.putString(KEY_EMPLOYEEPOSITION, user.getEmployeePosition());
        editor.putString(KEY_EMPLOYEEADDRESS, user.getEmployeeAddress());
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
        return new User(

                sharedPreferences.getString(KEY_USERNAME, null),
                sharedPreferences.getString(KEY_EMPLOYEENAME, null),
                sharedPreferences.getInt(KEY_EMPLOYEEAGE, -1),
                sharedPreferences.getString(KEY_EMPLOYEEPOSITION, null),
                sharedPreferences.getString(KEY_EMPLOYEEADDRESS, null)

        );
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

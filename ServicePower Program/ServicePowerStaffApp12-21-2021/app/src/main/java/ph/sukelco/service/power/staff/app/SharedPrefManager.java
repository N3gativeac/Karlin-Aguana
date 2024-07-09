package ph.sukelco.service.power.staff.app;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;


//here for this class we are using a singleton pattern

public class SharedPrefManager {

    //the constants
    private static final String SHARED_PREF_NAME = "simplifiedcodingsharedpref";
    private static final String KEY_USERNAME = "keyusername";
    private static final String KEY_FIRSTNAME = "keyfirstname";
    private static final String KEY_MIDDLENAME = "keymiddlename";
    private static final String KEY_LASTNAME = "keylastname";
    private static final String KEY_BIRTHDATE = "keybirthdate";
    private static final String KEY_FULLADDRESS = "keyfulladdress";
    private static final String KEY_SEX = "keysex";
    private static final String KEY_POSITION = "keyposition";
    private static final String KEY_LINE_OF_WORK = "keylineofwork";

    private static SharedPrefManager mInstance;
    private static Context mCtx;

    public SharedPrefManager(Context context) {
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
        //init sharedPreferences
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        //editor mode
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putString(KEY_USERNAME, user.getUsername());
        editor.putString(KEY_FIRSTNAME, user.getFirstname());
        editor.putString(KEY_MIDDLENAME, user.getMiddlename());
        editor.putString(KEY_LASTNAME, user.getLastname());
        editor.putString(KEY_BIRTHDATE, user.getBirthdate());
        editor.putString(KEY_SEX, user.getSex());
        editor.putString(KEY_POSITION, user.getPosition());
        editor.putString(KEY_LINE_OF_WORK, user.getLineOfWork());
        editor.putString(KEY_FULLADDRESS, user.getFullAddress());
        //apply edit
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
                sharedPreferences.getString(KEY_USERNAME, null),
                sharedPreferences.getString(KEY_FIRSTNAME, null),
                sharedPreferences.getString(KEY_MIDDLENAME, null),
                sharedPreferences.getString(KEY_LASTNAME, null),
                sharedPreferences.getString(KEY_BIRTHDATE, null),
                sharedPreferences.getString(KEY_SEX, null),
                sharedPreferences.getString(KEY_POSITION, null),
                sharedPreferences.getString(KEY_LINE_OF_WORK, null),
                sharedPreferences.getString(KEY_FULLADDRESS, null)
        );
        return user;
    }

    //this method will logout the user
    public void logout() {
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.clear();
        editor.apply();
        Intent logOutIntent = new Intent(mCtx, login_activity.class);
        logOutIntent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
       mCtx.startActivity(logOutIntent);

    }

}

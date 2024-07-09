package xyz.infinitydoki.sukelco.admin.app;

import android.annotation.SuppressLint;
import android.os.StrictMode;
import android.util.Log;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class connectionBridgeUpdateCustomerData {
    String SQLDriver = "com.mysql.jdbc.Driver"; //use the MySQL driver as a java class
    //MySQL credentials
    String url = "jdbc:mysql://192.168.254.157/sukelco_db"; //MySQL server host
    String un = "root"; //MySQL username
    String password = ""; //MySQL password


    //creates connection to the MySQL thingies
    @SuppressLint("NewApi")
    public Connection CONN() {
        StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder()
                .permitAll().build();
        StrictMode.setThreadPolicy(policy);
        Connection conn = null;
        String ConnURL = null;
        try {

            Class.forName(SQLDriver);

            conn = DriverManager.getConnection(url, un, password);


            //conn = DriverManager.getConnection(ConnURL);
        } catch (SQLException se) {
            Log.e("ERRO", se.getMessage());
        } catch (ClassNotFoundException e) {
            Log.e("ERRO", e.getMessage());
        } catch (Exception e) {
            Log.e("ERRO", e.getMessage());
        }
        return conn;
    }
}

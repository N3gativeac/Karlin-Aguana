package ph.sukelco.service.power.staff.app;

import android.annotation.SuppressLint;
import android.os.StrictMode;
import android.util.Log;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class connBridgeFetchLatestBillingInfo {
    String SQLDriver = "com.mysql.jdbc.Driver"; //use the MySQL driver as a java class
    //MySQL credentials
    String url = "jdbc:mysql://192.168.254.157/sukelco_admin"; //MySQL server host
    String un = "sukelco_adminmanip"; //MySQL username
    String password = "-b8Hek43pW5.K26"; //MySQL password


    //creates connection to the MySQL thingies
    @SuppressLint("NewApi")
    public Connection CONN() {
        StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder().permitAll().build();
        StrictMode.setThreadPolicy(policy);
        Connection conn = null;
        String ConnURL = url;
        Log.d("SQL url: ", url);
        Log.d("SQL username: ", un);
        Log.d("SQL password: ", password);
        try {

            Class.forName(SQLDriver);

            conn = DriverManager.getConnection(url, un, password);
            Log.d("SQL url: ", url);
            Log.d("SQL username: ", un);
            Log.d("SQL password: ", password);


            //conn = DriverManager.getConnection(ConnURL);
        }
        catch (SQLException se) {
            Log.e("ERROR (SQL Exception)", se.getMessage());
        }
        catch (ClassNotFoundException e) {
            Log.e("ERROR (Class not found)", e.getMessage());
        }
        catch (Exception e) {
            Log.e("ERROR (Exception)", e.getMessage());
        }
        return conn;
    }
}

import java.awt.Component;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;


public class dbConnection {
    public static Connection connect(){
        Connection conn=null;
    try{
        conn=DriverManager.getConnection("jdbc:mysql://localhost:3306/dummysystemtest?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC","root",""); 
        Component rootPane=null;
        System.out.println("Connected");
    }catch (SQLException ex) {
            System.out.println(ex.getMessage());
    }
    return conn;
    }
}


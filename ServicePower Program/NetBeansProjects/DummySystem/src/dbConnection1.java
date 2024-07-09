import java.awt.Component;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

public class dbConnection1 {
    
    public static Connection connect(){
        Connection conn1=null;
    try{
        conn1 = DriverManager.getConnection("jdbc:mysql://localhost:3306/user1?useUnicode=true&useJDBCCompliantTimezoneShift=true&useLegacyDatetimeCode=false&serverTimezone=UTC","root","");
        Component rootPane=null;
        System.out.println("Connected1");
    }catch (SQLException ex) {
            System.out.println(ex.getMessage());
    }
    return conn1;
    }
    
}

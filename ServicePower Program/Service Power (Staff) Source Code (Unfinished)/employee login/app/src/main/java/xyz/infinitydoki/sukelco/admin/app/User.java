package xyz.infinitydoki.sukelco.admin.app;

public class User {

    private String empusername, empfullname, emppos, empaddress;
    private Integer empfullage;
    public User(String empusername, String empfullname, Integer empfullage, String emppos, String empaddress) {
        this.empusername = empusername;
        this.empfullname = empfullname;
        this.empfullage = empfullage;
        this.emppos = emppos;
        this.empaddress = empaddress;
    }
    public String getUsername(){return empusername;}
    public String getEmployeeName() {
        return empfullname;
    }
    public Integer getEmployeeAge(){return empfullage;}
    public String getEmployeePosition() {
        return emppos;
    }
    public String getEmployeeAddress() { return empaddress; }
}
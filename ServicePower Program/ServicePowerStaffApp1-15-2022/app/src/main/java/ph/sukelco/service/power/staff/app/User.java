package ph.sukelco.service.power.staff.app;

public class User {

    private String username, firstname, middlename, lastname,birthdate, sex, position, lineOfWork, fullAddress;

    public User(String username, String firstname, String middlename, String lastname, String birthdate, String sex, String position, String lineOfWork, String fullAddress)
    {
        this.username = username;
        this.firstname = firstname;
        this.middlename = middlename;
        this.lastname = lastname;
        this.birthdate = birthdate;
        this.sex = sex;
        this.position = position;
        this.lineOfWork = lineOfWork;
        this.fullAddress = fullAddress;
    }




    public String getFirstname(){return  firstname;}

    public String getMiddlename(){return  middlename;}

    public String getLastname(){return  lastname;}

    public String getFullName(){
        String fullName = firstname + " \n" + middlename + " \n" + lastname;
        return  fullName;
    }

    public String getBirthdate(){return birthdate;}

    public String getUsername() {
        return username;
    }

    public String getSex() {
        return sex;
    }

    public String getPosition(){return  position;}

    public String getLineOfWork(){return lineOfWork;}

    public String getFullAddress(){
        return fullAddress;
    }


}


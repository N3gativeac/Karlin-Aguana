package net.simplifiedcoding.simplifiedcoding;

public class User {

    private int id;
    private String username, fullname, email, gender, meterID, totalKWH, purok, barangay, town, fullAddress;
    private Float userbalance;

    public User(int id, String username, String fullname, String email, String gender, String purok, String barangay,String town,  String meterID, String totalKWH, Float userbalance) {
        this.id = id;
        this.username = username;
        this.fullname = fullname;
        this.email = email;
        this.gender = gender;
        this.purok = purok;
        this.barangay = barangay;
        this.town = town;
        this.fullAddress = purok + ", " + barangay + ", " + town;
        this.meterID = meterID;
        this.totalKWH = totalKWH;
        this.userbalance = userbalance;
    }



    public int getId() {
        return id;
    }

    public String getFullname(){return  fullname;}

    public String getUsername() {
        return username;
    }

    public String getEmail() {
        return email;
    }

    public String getGender() {
        return gender;
    }

    public String getPurok(){return purok;}

    public String getBarangay(){return barangay;}

    public String getTown(){return town; }

    public String getFullAddress(){
        return fullAddress;
    }

    public String getMeterID(){return meterID;}

    public String getTotalKWH(){return totalKWH;}

    public Float getUserBalance(){return userbalance;}
}


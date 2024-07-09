public class TechnicalStaff {
    String tech_id, Last_Name, First_Name, Middle_Name,Contact_Number , AddressStreet, AddressBarangay, AddressCity_municipality, AddressProvince, AddressZipcode, Birthday , Line_of_Work, Position;
    
    public TechnicalStaff(String tech_id,String Last_Name,String First_Name,String Middle_Name,String Contact_Number ,String AddressStreet, String AddressBarangay, String AddressCity_municipality, String AddressProvince, String AddressZipcode, String Birthday ,String Line_of_Work,String Position){
        
        this.tech_id = tech_id;
        this.Last_Name = Last_Name;
        this.First_Name = First_Name;
        this.Middle_Name = Middle_Name;
        this.Contact_Number = Contact_Number;
        
        this.AddressStreet = AddressStreet;
        this.AddressBarangay = AddressBarangay;
        this.AddressCity_municipality = AddressCity_municipality;
        this.AddressProvince = AddressProvince;
        this.AddressZipcode = AddressZipcode;
        
        this.Birthday = Birthday;
        this.Line_of_Work = Line_of_Work;
        this.Position = Position;
    }

    TechnicalStaff(String string, String string0, String string1, String string2, String string3, String string4, String string5, String string6, String string7, String string8, String string9, String string10, String string11, String string12, String string13, String string14, String string15) {
        throw new UnsupportedOperationException("Not supported yet."); //To change body of generated methods, choose Tools | Templates.
    }
    
    //getters

   // public int getid(){
   //     return this.id;
   //}
    public String gettech_id(){
        return this.tech_id;
    }
    public String getLast_Name(){
        return this.Last_Name;
    }
    public String getFirst_Name(){
        return this.First_Name;
    }
    public String getMiddle_Name(){
        return this.Middle_Name;
    }
    public String getContact_Number(){
        return this.Contact_Number;
    }
    
    public String getAddressStreet(){
        return this.AddressStreet;
    }
    public String getAddressBarangay(){
        return this.AddressBarangay;
    }
    public String getAddressCity_municipality(){
        return this.AddressCity_municipality;
    }
    public String getAddressProvince(){
        return this.AddressProvince;
    }
    public String getAddressZipcode(){
        return this.AddressZipcode;
    }
    
    
    public String getBirthday(){
        return this.Birthday;
    }
    public String getLine_of_Work(){
        return this.Line_of_Work;
    }
    public String getPosition(){
        return this.Position;
    }               
    
}
public class Complaint {
    String name,contact, purok, barangay, town, requesttype, requestinfo;
    //int id;
    
    public Complaint(String name,String contact, String purok,String barangay,String town,String requesttype,String requestinfo){
        //this.id = id;
        this.name = name;
        this.contact = contact;
        this.purok = purok;
        this.barangay = barangay;
        this.town = town;
        this.requesttype = requesttype;
        this.requestinfo = requestinfo;
    }
    
    //getters

   // public int getid(){
   //     return this.id;
   //}
    public String getname(){
        return this.name;
    }
    public String getcontact(){
        return this.contact;
    }
    public String getpurok(){
        return this.purok;
    }
    public String getbarangay(){
        return this.barangay;
    }
    public String gettown(){
        return this.town;
    }
    public String getrequesttype(){
        return this.requesttype;
    }
    public String getrequestinfo(){
        return this.requestinfo;
    }

   
    
}

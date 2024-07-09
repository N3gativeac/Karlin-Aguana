public class User {
    String Ann_Code,Ann_Text,AnnDate;
    
    public User(String Ann_Code,String Ann_Text, String AnnDate){
        this.Ann_Code = Ann_Code;
        this.Ann_Text = Ann_Text;
        this.AnnDate = AnnDate;
    }
    
    //getters

    public String getAnn_Code(){
        return this.Ann_Code;
    }
    public String getFname(){
        return this.Ann_Text;
    }
    public String getAnnDate(){
        return this.AnnDate;
    }
    
}

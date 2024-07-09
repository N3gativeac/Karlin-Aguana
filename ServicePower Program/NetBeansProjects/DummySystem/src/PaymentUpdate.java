
public class PaymentUpdate {
     String id,F_name,L_name,Balance;
    
    public PaymentUpdate(String id,String F_name, String L_name, String Balance){
        this.id = id;
        this.F_name = F_name;
        this.L_name = L_name;
        this.Balance = Balance;
    }
    
    //getters

    public String getid(){
        return this.id;
    }
    public String getF_name(){
        return this.F_name;
    }
    public String getL_name(){
        return this.L_name;
    }
    public String getBalance(){
        return this.Balance;
    }
}

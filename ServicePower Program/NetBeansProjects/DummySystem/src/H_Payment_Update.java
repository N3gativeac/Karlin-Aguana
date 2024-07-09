
public class H_Payment_Update {
    String Meter_Number,Balance,DateOfUpdate;
    
    public H_Payment_Update(String Meter_Number, String Balance, String DateOfUpdate){

        this.Meter_Number = Meter_Number;
        this.Balance = Balance;

        this.DateOfUpdate = DateOfUpdate;
    }
    
    //getters


    public String getMeter_Number(){
        return this.Meter_Number;
    }
    public String getBalance(){
        return this.Balance;
    }

    public String getDateOfUpdate(){
        return this.DateOfUpdate;
    }
}

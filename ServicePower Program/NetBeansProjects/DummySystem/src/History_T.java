/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author User
 */
class History_T {
    private int client_id, Paymnet;
   
    
    public History_T(int id,int Paymnet)
    {
        this.client_id=client_id;
        this.Paymnet=Paymnet;
    }
    public int getclient_id(){
        return client_id;
    }
    public int getPaymnet(){
        return Paymnet;
    }
   
}

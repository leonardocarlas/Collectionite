

import java.net.URLEncoder;
import java.util.ArrayList;
import java.io.*;



public class download_en64_priceguide {

    public static void main(String[] args){

        //String nomecarta = str;

        String mkmAppToken = "D5lSR859bgB50sVj" ;
        String mkmAppSecret = "DLszKXEZCrNbZRQ8dTc1kLo6QxyDkicR" ;
        String mkmAccessToken = "" ;
        String mkmAccessTokenSecret = "" ;


        ApiRequest app = new ApiRequest(mkmAppToken, mkmAppSecret, mkmAccessToken, mkmAccessTokenSecret);

        //"https://api.cardmarket.com/ws/v2.0/productlist"  ---- CARDS
        //"https://api.cardmarket.com/ws/v2.0/games/3/expansions"   ----EXPANSIONS
        //GET https://api.cardmarket.com/ws/v2.0/priceguide?idGame=3  ---- PRICEGUIDE
        app.setDebug(false);
        int[] id_collezioni = new int[]{1,2,3,5,6,7,8,9,10,11,12,13,15};
        for (int i = 0; i < id_collezioni.length ; i++)  {
        	int idGame = id_collezioni[i];
	        if (app.request("https://api.cardmarket.com/ws/v2.0/priceguide?idGame=" + idGame)) {

	          String response = app.responseContent();

	          //String path = "C:/Users/liode/Desktop/U/Priceguide/"+idGame+".txt";
				String path = "txt/"+idGame+".txt";
	          try {
	              File file = new File(path);
	              FileWriter fw = new FileWriter(file);
	              BufferedWriter bw = new BufferedWriter(fw);
	              bw.write(response);
	              bw.flush();
	              bw.close();
	              }
	              catch(IOException e) {
	              e.printStackTrace();
	          }
	            

	        }
	    }

        
           

           
    }

}

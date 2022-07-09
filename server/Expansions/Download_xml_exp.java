import java.net.URLEncoder;
import java.util.ArrayList;
import java.io.*;



public class Download_xml_exp{

    public static void main(String[] args){

    String folder = "txt/";

    int[] idcollezioni = {1,3,5,6,7,8,9,2,10,11,12,13,15};

    for (int id : idcollezioni)
    {
    	String output_file = "";

		//String output_file = id + ".txt";

		switch (id) {
		  case 1:
		    output_file = folder + "1.txt";
		    break;
		  case 3:
		    output_file = folder + "3.txt";
		    break;
		  case 5:
		    output_file = folder + "5.txt";
		    break;
		  case 6:
		    output_file = folder + "6.txt";
		    break;
		  case 7:
		    output_file = folder + "7.txt";
		    break;
		  case 8:
		    output_file = folder + "8.txt";
		    break;
		  case 9:
		    output_file = folder + "9.txt";
		    break;
		  case 2:
		    output_file = folder + "2.txt";
		    break;
		  case 10:
		    output_file = folder + "10.txt";
		    break;
		  case 11:
		    output_file = folder + "11.txt";
		    break;
		  case 13:
		    output_file = folder + "13.txt";
		    break;
		  case 15:
		    output_file = folder + "15.txt";
		    break;
		  case 12:
		    output_file = folder + "12.txt";
		    break;
		}

        String mkmAppToken = "D5lSR859bgB50sVj" ;
        String mkmAppSecret = "DLszKXEZCrNbZRQ8dTc1kLo6QxyDkicR" ;
        String mkmAccessToken = "" ;
        String mkmAccessTokenSecret = "" ;


        ApiRequest app = new ApiRequest(mkmAppToken, mkmAppSecret, mkmAccessToken, mkmAccessTokenSecret);

        //"https://api.cardmarket.com/ws/v2.0/productlist"  ---- CARDS
        //"https://api.cardmarket.com/ws/v2.0/games/3/expansions"   ----EXPANSIONS
        app.setDebug(false);
        if (app.request("https://api.cardmarket.com/ws/v2.0/games/" + id + "/expansions")) {

          String response = app.responseContent();

          String path = "C:/Users/liode/Desktop/U/Expansions/" + output_file;
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
		  System.out.println("Fatto una richiesta");
            

        }

    }   
           

           
    }

}

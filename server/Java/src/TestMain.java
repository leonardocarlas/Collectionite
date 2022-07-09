import org.json.JSONArray;
import org.json.JSONObject;

import java.io.PrintWriter;
import java.util.ArrayList;
import java.util.concurrent.TimeUnit;

public class TestMain {
    //Time in seconds to put the process in stop
    static final long SLEEP = 60;

    public static void main(String[] args) throws Exception {

        int[] collections = new int[]{1, 2, 3, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15};

        String mkmAppToken = "D5lSR859bgB50sVj" ;
        String mkmAppSecret = "DLszKXEZCrNbZRQ8dTc1kLo6QxyDkicR";

        //Counters
        int totalCardCounter = 0;
        int totalExpectedExpansions = 0;
        int totalExpansionsDownloaded = 0;

        //Object to do the request
        ApiRequest app = new ApiRequest(mkmAppToken, mkmAppSecret);
        app.setDebug(true);

        long start = System.currentTimeMillis();

        //Print the result in a file
        try (PrintWriter out = new PrintWriter("testCard_.txt")) {
            //Iterate over the collections
            for (int idCollection : collections) {
                out.println("--------------COLLECTION "+idCollection+"--------------");

                //Local counters
                int localCardCounter = 0;
                int localExpectedExpansions = 0;
                int localExpansionsDownloaded = 0;

                ArrayList<Integer> idExpansions = new ArrayList<>();

                //Flag to exit the cycle, it becomes true when the request is done correct
                //it remains false otherwise
                boolean exit = false;
                while(!exit){
                    if (app.request("https://api.cardmarket.com/ws/v2.0/output.json/games/"
                            + String.valueOf(idCollection) + "/expansions")) {
                        JSONObject obj = new JSONObject(app.responseContent());
                        JSONArray expansions = obj.getJSONArray("expansion");

                        localExpectedExpansions = expansions.length();
                        totalExpectedExpansions += expansions.length();

                        //Saves the id of the expansions into the arraylist
                        for (int i = 0; i < expansions.length(); i++) {
                            idExpansions.add(expansions.getJSONObject(i).getInt("idExpansion"));
                        }

                        exit = true;
                    }
                    //If the request gone wrong print a message of error and stops the application for SLEEP seconds
                    if(app.responseCode() != 200){
                        exit = false;
                        out.println("Collection had an the error -> " + app.responseCode() + "\t\tRetrying");
                        TimeUnit.SECONDS.sleep(SLEEP);
                    }
                }

                //Iterate over the expansions found in the collections
                for (int idExpInt : idExpansions) {
                    String idExpString = String.valueOf(idExpInt);
                    String single_line = "";

                    //The same process I've done to retrieve the expansions ids
                    exit = false;
                    while(!exit){
                        if (app.request("https://api.cardmarket.com/ws/v2.0/output.json/expansions/" + idExpString + "/singles")) {
                            JSONObject obj = new JSONObject(app.responseContent());
                            JSONObject info = obj.getJSONObject("expansion");
                            JSONArray expansions = obj.getJSONArray("single");

                            totalCardCounter += expansions.length();
                            localCardCounter += expansions.length();

                            single_line = String.format("name: %-60s id: %-10d-> %10d", info.getString("enName"),
                                    info.getInt("idExpansion"), expansions.length());

                            localExpansionsDownloaded++;
                            totalExpansionsDownloaded++;

                            exit = true;
                        }
                        if(app.responseCode() != 200){
                            out.println("Error code -> " + app.responseCode() +"\t\t id: " + idExpInt + "\t\tRetrying");
                            exit = false;
                            TimeUnit.SECONDS.sleep(SLEEP);
                        } else {
                            out.println(single_line);
                        }
                    }

                }
                out.println("\n");
                out.println("Expected expansions -> " + localExpectedExpansions);
                out.println("Obtained expansions -> " + localExpansionsDownloaded);
                out.println("Total cards -> " + localCardCounter);
                long finish = System.currentTimeMillis();
                System.out.println("TIME ELAPSED: " + (finish - start) / 1000);
                out.println("TIME ELAPSED -> " + (finish - start) / 1000 + "s\n");
            }
            long finish = System.currentTimeMillis();
            out.println("\n\n\n------------------FINAL STATS------------------");
            out.println("Expected expansions -> " + totalExpectedExpansions);
            out.println("Obtained expansions -> " + totalExpansionsDownloaded);
            out.println("Total cards -> " + totalCardCounter);
            out.println("FINAL TIME ELAPSED -> " + (finish - start) / 1000 + "s");
        }
    }
}


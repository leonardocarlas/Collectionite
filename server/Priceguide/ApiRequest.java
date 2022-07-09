import javax.crypto.Mac;
import javax.crypto.spec.SecretKeySpec;
import javax.xml.bind.DatatypeConverter;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.UnsupportedEncodingException;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.util.*;


public class ApiRequest {
    private String _mkmAppToken;
    private String _mkmAppSecret;
    private String _mkmAccessToken;
    private String _mkmAccessTokenSecret;

    private Throwable _lastError;
    private int _lastCode;
    private String _lastContent;
    private boolean _debug;

    /**
     * Constructor. Fill parameters according to given MKM profile app parameters.
     *
     * @param appToken
     * @param appSecret
     * @param accessToken
     * @param accessSecret
     */
    public ApiRequest(String appToken, String appSecret, String accessToken, String accessSecret) {
        _mkmAppToken = appToken;
        _mkmAppSecret = appSecret;
        _mkmAccessToken = accessToken;
        _mkmAccessTokenSecret = accessSecret;

        _lastError = null;
        _debug = false;
    }

    /**
     * Activates the console debug messages
     * @param flag true if you want to enable console messages; false to disable any notification.
     */
    public void setDebug(boolean flag) {
        _debug = flag;
    }

    /**
     * Encoding function. To avoid deprecated version, the encoding used is UTF-8.
     * @param str
     * @return
     * @throws UnsupportedEncodingException
     */
    private String rawurlencode(String str) throws UnsupportedEncodingException {
            return URLEncoder.encode(str, "UTF-8");
    }

    private void _debug(String msg) {
        if (_debug) {
            System.out.print(GregorianCalendar.getInstance().getTime());
            System.out.print(" > ");
            System.out.println(msg);
        }
    }

    /**
     * Get last Error exception.
     * @return null if no errors; instead the raised exception.
     */
    public Throwable lastError() {
        return _lastError;
    }

    /**
     * Perform the request to given url with OAuth 1.0a API.
     *
     * @param requestURL url to be requested. Ex. https://api.cardmarket.com/ws/v1.1/products/island/1/1/false
     * @return true if request was successfully executed. You can retrieve the content with responseContent();
     */
    public boolean request(String requestURL) {
        _lastError = null;
        _lastCode = 0;
        _lastContent = "";
        try {

            _debug("Requesting "+requestURL);

            //Find the index of the beginning of the query parameters, if it founds them it
            //creates the realm with characters before the ?
            int characterIndex = requestURL.indexOf('?');
            String realm = (characterIndex != -1) ? requestURL.substring(0, characterIndex) : requestURL;
            String oauth_version = "1.0" ;
            String oauth_consumer_key = _mkmAppToken ;
            String oauth_token = _mkmAccessToken ;
            String oauth_signature_method = "HMAC-SHA1" ;
            String oauth_timestamp = "" + (System.currentTimeMillis()/1000) ;
            String oauth_nonce = "" + System.currentTimeMillis() ;


            //To use the encoded URL I use the realm value because it's the same string
            String encodedRequestURL = rawurlencode(realm) ;
            String baseString = "GET&" + encodedRequestURL + "&" ;


            //Using an HashMap so we can easily sort the parameters using a TreeMap
            Map<String, String> unsortedParameters = new HashMap<String, String>();
            unsortedParameters.put("oauth_consumer_key=", rawurlencode(oauth_consumer_key));
            unsortedParameters.put("oauth_nonce=", rawurlencode(oauth_nonce));
            unsortedParameters.put("oauth_signature_method=", rawurlencode(oauth_signature_method));
            unsortedParameters.put("oauth_timestamp=", rawurlencode(oauth_timestamp));
            unsortedParameters.put("oauth_token=", rawurlencode(oauth_token));
            unsortedParameters.put("oauth_version=", rawurlencode(oauth_version));

            //QUERY PARAMETERS
            //Use a tokenizer with predefined delimiters to separate the key and the values, and then it
            //puts them into the unsortedParameters Map
            if(characterIndex != -1){
                StringTokenizer tokenizer = new StringTokenizer(requestURL.substring(characterIndex+1), "&=");
                while(tokenizer.hasMoreTokens()){
                    String key = tokenizer.nextToken() + "=";
                    String value = tokenizer.nextToken(); //if in future doesn't work anymore than maybe we need to use rawurlencode();
                    unsortedParameters.put(key, value);
                }
            }


            /*unsortedParameters.put("idGame=", rawurlencode("1"));
            unsortedParameters.put("idLanguage=", rawurlencode("1"));
            unsortedParameters.put("search=", rawurlencode("Springleaf"));*/

            //Creates a sortedMap and then access to the key-value pairs in order to build the
            //correct string requested from the Cardmarket server
            Map<String, String> sortedParameters = new TreeMap<String, String>(unsortedParameters);
            StringBuilder paramStrings = new StringBuilder();
            int totalElements = sortedParameters.size();
            int cycleCounter  = 0;
            for (Map.Entry<String, String> entry : sortedParameters.entrySet()) {
                paramStrings.append(entry.getKey());
                paramStrings.append(entry.getValue());
                //Skips the append if the "&" if there are no more elements to append
                if(cycleCounter < totalElements - 1){
                    paramStrings.append("&");
                }
                cycleCounter++;
            }

            //Creates the final string use to create the signature
            baseString = baseString + rawurlencode(paramStrings.toString()) ;

            //Creates the signing key
            String signingKey = rawurlencode(_mkmAppSecret) + "&";


            //I have to go deeper with this
            Mac mac = Mac.getInstance("HmacSHA1");
            SecretKeySpec secret = new SecretKeySpec(signingKey.getBytes(), mac.getAlgorithm());
            mac.init(secret);
            byte[] digest = mac.doFinal(baseString.getBytes());
            String oauth_signature = DatatypeConverter.printBase64Binary(digest);    //Base64.encode(digest) ;


            String authorizationProperty =
                    "OAuth " +
                            "realm=\"" + realm + "\", " +
                            "oauth_version=\"" + oauth_version + "\", " +
                            "oauth_timestamp=\"" + oauth_timestamp + "\", " +
                            "oauth_nonce=\"" + oauth_nonce + "\", " +
                            "oauth_consumer_key=\"" + oauth_consumer_key + "\", " +
                            "oauth_token=\"\", " +
                            "oauth_signature_method=\"" + oauth_signature_method + "\", " +
                            "oauth_signature=\"" + oauth_signature + "\"" ;

            HttpURLConnection connection = (HttpURLConnection) new URL(requestURL).openConnection();
            connection.addRequestProperty("Authorization", authorizationProperty) ;
            connection.connect() ;

            // from here standard actions...
            // read response code... read input stream.... close connection...

            _lastCode = connection.getResponseCode();

            //Headers of the response
            /*Map<String, List<String>> map = connection.getHeaderFields();
            for (Map.Entry<String, List<String>> entry : map.entrySet()) {
                System.out.println("Key : " + entry.getKey() +
                        " ,Value : " + entry.getValue());
            }*/

            _debug("Response Code is "+_lastCode);

            if (200 == _lastCode || 401 == _lastCode || 404 == _lastCode) {
                BufferedReader rd = new BufferedReader(new InputStreamReader(_lastCode==200?connection.getInputStream():connection.getErrorStream()));
                StringBuffer sb = new StringBuffer();
                String line;
                while ((line = rd.readLine()) != null) {
                    sb.append(line);
                }
                rd.close();
                _lastContent = sb.toString();
                _debug("Response Content is \n"+_lastContent);


            }

            return (_lastCode == 200);

        } catch (Exception e) {
            _debug("(!) Error while requesting "+requestURL);
            _lastError = e;
        }
        return false;
    }

    /**
     * Get response code from last request.
     * @return
     */
    public int responseCode() {
        return _lastCode;
    }

    /**
     * Get response content from last request.
     * @return
     */
    public String responseContent() {
        return _lastContent;
    }
}

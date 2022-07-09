import glob
import base64
import os
import gzip
import csv

def main():
    decode("txt/")
    convert("gz/")
    create_sql_table()

def decode(folder):
    """Decode and save all the file in folder
    into .gz files with the same name as the
    encoded file.

    Keyword arguments:
    folder -- the folder where to retrieve the encoded files
    """
    for single_file in glob.glob(folder+"*.txt"):
        encoded_file = open(single_file).read()

        start = encoded_file.find('<priceguidefile>') + 16
        end = encoded_file.find('</priceguidefile>', start)
        final_string = encoded_file[start:end]

        encoded_bytes = final_string.encode('ascii')
        decoded_file = base64.b64decode(encoded_bytes)

        base_name = os.path.basename(single_file)
        gz_file = open("gz/"+os.path.splitext(base_name)[0]+".gz", "wb")
        gz_file.write(decoded_file)

        gz_file.close()

def convert(folder):
    """Converts all the gzipped files in folder into a 
    single csv file in order to be used. Only the first row
    of the first file is saved, in the others file is deleted.

    Keyword arguments:
    folder -- the folder where to retrieve the gzipped files
    """
    flag = 0
    csv_file = open("all_datas.csv", "w")
    for single_file in glob.glob(folder+"*.gz"):
        with gzip.open(single_file, 'rt') as gz_file:
            intermediate_csv_file = gz_file.read()
            
            #If it isn't the first file removes the name of the columns
            if(flag > 0):
                intermediate_csv_file = intermediate_csv_file.split('\n', 1)[1]

            csv_file.write(intermediate_csv_file)
            flag = flag + 1
    
    csv_file.close()

def create_sql_table():
    """Creates the table "prices" putting in a SQL file all the row mandatory for creating
    the table. It reads alla the datas from the csv file "all_datas.csv"
    """
    whole_text = ""
    whole_text = "CREATE TABLE prices (Idcard int(11) NOT NULL, Min_value double(16,2) DEFAULT 0.00, Trend_value double(16,2) DEFAULT 0.00, Suggested_price double(16,2) DEFAULT 0.00, AVG1 double(16,2) DEFAULT 0.00, AVG7 double(16,2) DEFAULT 0.00, AVG30 double(16,2) DEFAULT 0.00, Foil_sell double(16,2) DEFAULT 0.00, Foil_low double(16,2) DEFAULT 0.00, Foil_trend double(16,2) DEFAULT 0.00, Foil_avg1 double(16,2) DEFAULT 0.00, Foil_avg7 double(16,2) DEFAULT 0.00, Foil_avg30 double(16,2) DEFAULT 0.00 ); "
    whole_text = whole_text + "INSERT INTO prices (Idcard, Min_value, Trend_value, Suggested_price, AVG1, AVG7, AVG30, Foil_sell, Foil_low, Foil_trend, Foil_avg1, Foil_avg7, Foil_avg30) VALUES " + "\n"

    with open('all_datas.csv') as csv_file:
        csv_reader = csv.reader(csv_file, delimiter=',')
        line_count = 0
        for row in csv_reader:
            
            if line_count == 0:
                line_count += 1
            else:
                id_card = "'" + str(row[0]) + "'"

                if row[2] in (None, ""):
                    min_value = "'" + str(0.00) + "'"
                else:
                    min_value = "'" + str(row[2]) + "'"
                if row[3] in (None, ""):
                    trend_value = "'" + str(0.00) + "'"
                else:
                    trend_value = "'" + str(row[3]) + "'"
                if row[5] in (None, ""):
                    suggested_price = "'" + str(0.00) + "'"
                else:
                    suggested_price = "'" + str(row[5]) + "'"
                if row[10] in (None, ""):
                    avg1 = "'" + str(0.00) + "'"
                else:
                    avg1 = "'" + str(row[10]) + "'"
                if row[11] in (None, ""):
                    avg7 = "'" + str(0.00) + "'"
                else:
                    avg7 = "'" + str(row[11]) + "'"
                if row[12] in (None, ""):
                    avg30 = "'" + str(0.00) + "'"
                else:
                    avg30 = "'" + str(row[12]) + "'"
                if row[6] in (None, ""):
                    foil_sell = "'" + str(0.00) + "'"
                else:
                    foil_sell = "'" + str(row[6]) + "'"
                if row[7] in (None, ""):
                    foil_low = "'" + str(0.00) + "'"
                else:
                    foil_low = "'" + str(row[7]) + "'"
                if row[8] in (None, ""):
                    foil_trend = "'" + str(0.00) + "'"
                else:
                    foil_trend = "'" + str(row[8]) + "'"
                if row[13] in (None, ""):
                    foil_avg1 = "'" + str(0.00) + "'"
                else:
                    foil_avg1 = "'" + str(row[13]) + "'"
                if row[14] in (None, ""):
                    foil_avg7 = "'" + str(0.00) + "'"
                else:
                    foil_avg7 = "'" + str(row[14]) + "'"
                if row[15] in (None, ""):
                    foil_avg30 = "'" + str(0.00) + "'"
                else:
                    foil_avg30 = "'" + str(row[15]) + "'"

                sql_statement = ""
                sql_statement = sql_statement + "(" +  id_card + ", " + min_value + ", " + trend_value + ", " + suggested_price 
                sql_statement = sql_statement + ", " + avg1 + ", " + avg7 + ", " + avg30 + ", " + foil_sell + ", " 
                sql_statement = sql_statement + foil_low + ", " + foil_trend + ", " + foil_avg1 + ", " + foil_avg7
                sql_statement = sql_statement + ", " + foil_avg30 + ")"

                line_count += 1
                whole_text = whole_text + sql_statement + "," + "\n"

        print(f'Processed {line_count} lines.')


    # Tolgo l'ultimo elemento del whole_text document
    whole_text = whole_text[:-1]
    whole_text = whole_text[:-1]
    whole_text = whole_text +";"


    file = open("update_cards_prices.sql","a", encoding='utf-8')
    file.write(whole_text)
    file.close()

if __name__ == "__main__":
    main()
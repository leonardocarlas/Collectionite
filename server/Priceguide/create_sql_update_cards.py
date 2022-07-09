import csv

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
            #print('Id product = ' ,row[0])
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

            #tonde = "(" + ide + ", " + nome + ", " +  id_collezione + ", " + data + ")"
            sql_statement = ""
            sql_statement = sql_statement + "(" +  id_card + ", " + min_value + ", " + trend_value + ", " + suggested_price 
            sql_statement = sql_statement + ", " + avg1 + ", " + avg7 + ", " + avg30 + ", " + foil_sell + ", " 
            sql_statement = sql_statement + foil_low + ", " + foil_trend + ", " + foil_avg1 + ", " + foil_avg7
            sql_statement = sql_statement + ", " + foil_avg30 + ")"
            #print(sql_statement)

            line_count += 1

            whole_text = whole_text + sql_statement + "," + "\n"

            #if line_count == 10:
            #    break

    print(f'Processed {line_count} lines.')


#tolgo ultimo elemento
whole_text = whole_text[:-1]
whole_text = whole_text[:-1]
whole_text = whole_text +";"


file = open("update_cards_prices.sql","a", encoding='utf-8')
file.write(whole_text)
file.close()

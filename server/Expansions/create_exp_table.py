
import json
import sys

 



json_files = ['1.json','2.json','3.json','5.json','6.json','7.json','8.json','9.json','10.json','11.json','12.json','13.json','15.json']
whole_text = "CREATE TABLE Expansion (Idset int(11) NOT NULL PRIMARY KEY, \n English_set_name tinytext NOT NULL, \n French_set_name tinytext, \n German_set_name tinytext, \n Spanish_set_name tinytext, \n Italian_set_name tinytext, \n Idcollection int(11) NOT NULL, \n Release_date DATETIME NOT NULL); \n INSERT INTO Expansion (Idset, English_set_name, Idcollection, Release_date) VALUES \n "

for file in json_files:

	

	with open(file) as json_file:
		data = json.load(json_file)
		for p in data['expansions']:
			
			ide = "'" + p['idExpansion'] + "'"
			
			nome_espansione = p['nameExpansion']
			posizione_asterisco = nome_espansione.find('\'')
			if posizione_asterisco != -1 :
				nome_espansione = nome_espansione[:posizione_asterisco] + "\\" + "\'"+ nome_espansione[posizione_asterisco+1:]
			nome = "'" + nome_espansione + "'"
			
			posizione__punto = file.index('.')
			id_collezione = "'" + file[:posizione__punto] + "'"
			data = "'" + p['releaseDate'] + "'"
			tonde = "(" + ide + ", " + nome + ", " +  id_collezione + ", " + data + ")"


			whole_text = whole_text + tonde + "," + "\n"

#tolgo ultimo elemento
whole_text = whole_text[:-1]
whole_text = whole_text[:-1]
whole_text = whole_text +";"

print(whole_text)


file = open("insert_exp.sql","a", encoding='utf-8')
file.write(whole_text)
file.close()
			

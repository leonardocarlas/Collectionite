import xml.etree.ElementTree as et
import json
import os
import sys


def main():
	txt_to_json("txt/")
	



def txt_to_json(folder_in):

	whole_text = "CREATE TABLE Expansion (Idset int(11) NOT NULL PRIMARY KEY, \n English_set_name tinytext NOT NULL, \n French_set_name tinytext NOT NULL, \n German_set_name tinytext NOT NULL, \n Spanish_set_name tinytext NOT NULL, \n Italian_set_name tinytext NOT NULL, \n Idcollection int(11) NOT NULL,\n Abbreviation tinytext NOT NULL, \n Release_date DATETIME NOT NULL); \n INSERT INTO Expansion (Idset, English_set_name, French_set_name, German_set_name,  Spanish_set_name, Italian_set_name, Idcollection, Abbreviation ,Release_date) VALUES \n "
	
	input_files = ['1.txt','2.txt','3.txt','5.txt','6.txt','7.txt','8.txt','9.txt','10.txt','11.txt','12.txt','13.txt','15.txt']
	for name in input_files:

		tree = et.parse(folder_in + name)
		root = tree.getroot()
		

		for child in root.findall("expansion"):

		    idExpansion = "'" + child[0].text + "'"

		    localization_english = child[2]
		    english_with_coma = localization_english[0].text
		    posizione_asterisco = english_with_coma.find('\'')
		    if posizione_asterisco != -1 :
		    	english_with_coma = english_with_coma[:posizione_asterisco] + "\\" + "\'"+ english_with_coma[posizione_asterisco+1:]
		    english = "'" + english_with_coma + "'"

		    localization_french = child[3]
		    french_with_coma = localization_french[0].text
		    posizione_asterisco = french_with_coma.find('\'')
		    if posizione_asterisco != -1 :
		    	french_with_coma = french_with_coma[:posizione_asterisco] + "\\" + "\'"+ french_with_coma[posizione_asterisco+1:]
		    french = "'" + french_with_coma + "'"

		    localization_german = child[4]
		    german_with_coma = localization_german[0].text
		    posizione_asterisco = german_with_coma.find('\'')
		    if posizione_asterisco != -1 :
		    	german_with_coma = german_with_coma[:posizione_asterisco] + "\\" + "\'"+ german_with_coma[posizione_asterisco+1:]
		    german = "'" + german_with_coma + "'"

		    localization_spanish = child[5]
		    spanish_with_coma = localization_spanish[0].text
		    posizione_asterisco = spanish_with_coma.find('\'')
		    if posizione_asterisco != -1 :
		    	spanish_with_coma = spanish_with_coma[:posizione_asterisco] + "\\" + "\'"+ spanish_with_coma[posizione_asterisco+1:]
		    spanish = "'" + spanish_with_coma + "'"

		    localization_italian = child[6]
		    italian_with_coma = localization_italian[0].text
		    posizione_asterisco = italian_with_coma.find('\'')
		    if posizione_asterisco != -1 :
		    	italian_with_coma = italian_with_coma[:posizione_asterisco] + "\\" + "\'"+ italian_with_coma[posizione_asterisco+1:]
		    italian = "'" + italian_with_coma + "'"

		    abbreviation = "'" + child[7].text + "'"

		    release_date = "'" + child[9].text + "'"

		    id_collection = "'" + child[11].text + "'"

		    sql_statement = "(" + idExpansion + ", " + english+ ", " +  french + ", " +  german + ", " +  spanish + ", "+  italian + ", " +  id_collection + ", " +  abbreviation + ", " +  release_date + ")"
		    whole_text += sql_statement + "," + "\n"

	# Viene eliminato l'ultimo elemento
	whole_text = whole_text[:-1]
	whole_text = whole_text[:-1]
	whole_text = whole_text +";"
	file = open("insert_exp.sql","a", encoding='utf-8')
	file.write(whole_text)
	file.close()


if __name__ == '__main__':
	main()

	

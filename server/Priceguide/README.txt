1. Scaricare i dati encoded64 dei prezzi delle carte in .txt 

   download_en64_priceguide.java  ----->   1.txt, 2.txt...

2. Utilizzare il decode.py per trasfomare da 1.txt a 1.gz (che sia estraibile il contenuto)

	1.txt --> 1.gz
	2.txt --> 2.gz
	3.txt --> 3.gz
	4.txt --> 4.gz
	...

3. Utilizzare l'extractor.py per estrarre da 1.gz alla cartella CSV/all_datas.csv

	1.gz
	2.gz
	3.gz  -->   all_datas.csv
	4.gz
	...
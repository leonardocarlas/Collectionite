import sys
from service import get_html_content_from_url
from bs4 import BeautifulSoup
from typing import List

from src.main.utils import link_generator

if __name__ == "__main__":
    print("Collection Scraper")
    links: List[str] = link_generator("https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=",2)
    for link in links:
        document: str = get_html_content_from_url(link)
        print(document)
        soup = BeautifulSoup(document, 'html.parser')



import sys
from service import curl
from bs4 import BeautifulSoup
from typing import List


def getUrls(base_url: str) -> List[str]:
    return [
        "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=1", 
        "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=2"
    ]

for i in range(1,13):
    url: str = f"https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site={i}"
    print(url)

if __name__ == "__main__":
    print(sys.version)
    print("Collection Scraper")
    # urls: List[str] = getUrls("https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=")
    document: str = curl("test")
    print(document)
    soup = BeautifulSoup(document, 'html.parser')
    print(soup)



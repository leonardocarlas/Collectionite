import sys
from service import get_html_content_from_url
from bs4 import BeautifulSoup, Tag
from typing import List

from src.main.utils import link_generator, extract_divs_from_document, extract_data_from_single_div

if __name__ == "__main__":
    print("Collection Scraper")
    links: List[str] = link_generator(url="https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?mode=gallery&site=",max=2)
    for link in links:
        document: str = get_html_content_from_url(link)
        soup = BeautifulSoup(document, 'html.parser')
        divs: List[Tag] = extract_divs_from_document(document)
        for div in divs:
            card_data = extract_data_from_single_div(div)
            print(card_data, '\n')



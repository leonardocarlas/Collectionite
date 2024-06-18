import sys
from encodings import undefined

from service import get_html_content_from_url
from bs4 import BeautifulSoup, Tag
from typing import List

from src.main.card import Card
from src.main.formatter import create_component, add_style
from src.main.utils import link_generator, extract_divs_from_document, extract_data_from_single_div, \
    extract_id_expansion_from_document

if __name__ == "__main__":
    print("Collection Scraper")
    links: List[str] = link_generator(url="https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces"
                                          "?mode=gallery&site=", max=14)
    cards: List[Card] = []
    for link in links:
        document: str = get_html_content_from_url(link)
        id_expansion: str = extract_id_expansion_from_document(document)
        soup = BeautifulSoup(document, 'html.parser')
        divs: List[Tag] = extract_divs_from_document(document)
        for div in divs:
            cards.append(extract_data_from_single_div(div))
    with open(file='pages/output.html', mode='w') as file:
        file.write(f"Expansion Id: {id_expansion}")
        for card in cards:
            file.write(create_component(card))
        file.write(add_style())
    with open(file='pages/expansion.json', mode='w') as file:
        file.write("{[")
        # for card in cards:
        #     file.write(create_component(card))
        #     file.write(add_style())
        file.write("]}")




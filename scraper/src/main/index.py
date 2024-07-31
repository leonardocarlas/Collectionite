import time
from encodings import undefined

from service import get_html_content_from_url
from bs4 import BeautifulSoup, Tag
from typing import List, Dict

from src.main.card import Card
from src.main.formatter import create_component, add_style, create_image
from src.main.gallery_provider import extract_image_urls_from_document
from src.main.utils import link_generator, extract_divs_from_document, extract_data_from_single_div, \
    extract_id_expansion_from_document

if __name__ == "__main__":
    print("Collection Scraper")
    links: List[str] = link_generator(
        url="https://www.cardmarket.com/en/Pokemon/Products/Singles/151?idCategory=51&idExpansion=5402&idRarity=0"
            "&sortBy=collectorsnumber_asc&mode=gallery&site=",
        max=12)
    gallery_url: str = "https://tcg.pokemon.com/en-us/galleries/151/"
    gallery_document: str = get_html_content_from_url(gallery_url)
    urls_dic: Dict[str, str] = extract_image_urls_from_document(gallery_document)

    # cards: List[Card] = []
    # for link in links:
    #     document: str = get_html_content_from_url(link)
    #     id_expansion: str = extract_id_expansion_from_document(document)
    #     soup = BeautifulSoup(document, 'html.parser')
    #     divs: List[Tag] = extract_divs_from_document(document)
    #     for div in divs:
    #         cards.append(extract_data_from_single_div(div))  # qua c'e da passare anche il dictionary
    #     time.sleep(2)

    with open(file='pages/output.html', mode='w') as file:
        for key in urls_dic:
            file.write(create_image(urls_dic[key]) + "\n")
        # file.write(f"Expansion Id: {id_expansion}")
        # for card in cards:
        #     file.write(create_component(card))
        # file.write(add_style())
    # with open(file='pages/expansion.json', mode='w') as file:
        # for card in cards:
        #     file.write(card.to_json())

import os
from typing import List, Any
from typing import Dict
import re

from bs4 import BeautifulSoup, Tag

from src.main.card import Card


class DriverNotFoundException(Exception):
    pass


class DataNotValidException(Exception):
    pass


def verify_driver_file_path(path: str) -> bool:
    absolute_directory_path = os.path.abspath(path)

    if os.path.exists(absolute_directory_path):
        if os.path.isfile(absolute_directory_path):
            return True
        else:
            raise DriverNotFoundException(f"{absolute_directory_path} is not a file.")
    else:
        raise DriverNotFoundException(f"The file {absolute_directory_path} does not exist.")


def link_generator(url: str, max: int) -> List[str]:
    links: List[str] = []
    for i in range(1, max):
        links.append(url + str(i))
    return links


def extract_data_from_single_div(div: Tag) -> Card:
    if div is None:
        raise DataNotValidException("Warning: div is None")

    if not isinstance(div, Tag):
        raise DataNotValidException(f"Warning: div is not a BeautifulSoup Tag, it is {type(div)}")

    card_name = div.find('h2').text.strip() if div.find('h2') else 'Unknown'
    image_url = div.find('img')['src'] if div.find('img')['src'].__contains__("product") else div.find('img')[
        'data-echo']
    link_url = div.find('a')['href'] if div.find('a') else 'Unknown'

    card: Card = Card(id_card=extract_id_from_link(image_url), link_image=image_url, card_name=card_name,
                      marketplace_link=link_url)

    return card


def extract_divs_from_document(html_document: str) -> List[Tag]:
    divs: List[Tag] = []
    soup = BeautifulSoup(html_document, 'html.parser')
    try:
        divs = soup.find_all(name='div', class_='d-flex mb-4 col-12 col-sm-6 col-md-4 col-lg-3')
    except FileNotFoundError:
        print("Not Found")
    return divs


def extract_id_from_link(link: str) -> str:
    # Use a regular expression to find the ID in the URL
    match = re.search(r'/(\d+)\.jpg$', link)
    if match:
        return match.group(1)
    return ""


def extract_id_expansion_from_document(html_document: str) -> str:
    id_expansion = ""
    soup = BeautifulSoup(html_document, 'html.parser')
    try:
        a_tag = soup.find('a', class_='filterToggle')
        print(a_tag)
        if a_tag:
            pattern = re.compile(r'idExpansion=(\d+)')
            data_modal = a_tag.get('data-modal', '')
            print(data_modal)
            match = pattern.search(data_modal)
            if match:
                id_expansion = match.group(1)  # Estrai solo il numero
                return id_expansion
    except Exception as e:
        print(f"An error occurred: {e}")

    print("Not Found")
    return id_expansion


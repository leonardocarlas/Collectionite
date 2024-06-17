import os
from typing import List
from typing import Dict
import re

from bs4 import BeautifulSoup, Tag


class DriverNotFoundException(Exception):
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


def extract_data_from_single_div(div: Tag) -> Dict:
    data: Dict = {}

    if div is None:
        print("Warning: div is None")
        return data

    if not isinstance(div, Tag):
        print(f"Warning: div is not a BeautifulSoup Tag, it is {type(div)}")
        return data

    card_name = div.find('h2').text.strip() if div.find('h2') else 'Unknown'
    image_url = div.find('img')['src'] if div.find('img')['src'].__contains__("product") else div.find('img')['data-echo']
    link_url = div.find('a')['href'] if div.find('a') else 'Unknown'

    data['link_url'] = link_url
    data['image_url'] = image_url
    data['card_name'] = card_name

    return data


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

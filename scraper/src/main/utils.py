import os
from typing import List
from typing import Dict

from bs4 import BeautifulSoup


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


def extract_data_from_single_div(div: str) -> Dict:
    data: Dict = {}
    if div is None:
        print("Warning: div is None")
        return data

    if not isinstance(div, str):
        print(f"Warning: div is not a string, it is {type(div)}")
        return data
    soup = BeautifulSoup(div, 'html.parser')
    print(soup.prettify())
    card_name = soup.find('h2').text.strip()
    image_url = soup.find('img')['data-echo']
    link_url = soup.find('a')['href']
    print(type(link_url))
    data['link_url'] = link_url
    data['image_url'] = image_url
    data['card_name'] = card_name

    return data


def extract_divs_from_document(html_document: str) -> List[str]:
    divs: List[str] = []
    soup = BeautifulSoup(html_document, 'html.parser')
    try:
        divs = soup.find_all(name='div', class_='d-flex mb-4 col-12 col-sm-6 col-md-4 col-lg-3')
    except FileNotFoundError:
        print("Not Found")
    return divs

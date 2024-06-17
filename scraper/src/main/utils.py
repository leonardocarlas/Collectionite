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
    soup = BeautifulSoup(div, 'html.parser')
    data['link_url'] = soup.find('a', class_='card text-center w-100 galleryBox')['href']
    data['image_url'] = soup.find('img', class_='lazy card-img-top img-fluid')['data-echo']
    data['card_title'] = soup.find('h2', class_='card-title h3').get_text(strip=True)

    return data

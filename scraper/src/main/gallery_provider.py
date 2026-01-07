from typing import Dict

from bs4 import BeautifulSoup


def extract_image_urls_from_document(html_document: str) -> Dict[str, str]:
    li_elements = find_li_elements(html_document)
    urls_map = {}

    for idx, li in enumerate(li_elements, start=1):
        key = f"{idx:03}"  # Create a key with leading zeros, e.g., "001", "002"
        img_src = extract_img_src(str(li))
        if img_src:
            urls_map[key] = img_src

    return urls_map


def find_li_elements(html_content):
    """Find all <li> elements with class 'column' and data-category='seeall' in the given HTML content."""
    # Parse the HTML content with BeautifulSoup
    soup = BeautifulSoup(html_content, 'html.parser')

    # Find all <li> elements with the specified class and data-category
    li_elements = soup.find_all('li', class_='column', attrs={'data-category': 'seeall'})

    return li_elements


def extract_img_src(li_element):
    """Extract the image link from the src attribute within the given <li> element."""
    # Parse the li element with BeautifulSoup
    soup = BeautifulSoup(li_element, 'html.parser')

    # Find the img tag within the li element
    img_tag = soup.find('img', {'src': True})

    # Extract the src attribute value
    if img_tag:
        img_src = img_tag['src']
        return img_src
    else:
        return None
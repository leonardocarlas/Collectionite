# from selenium import webdriver
# from selenium.webdriver.chrome.service import Service
# from selenium.webdriver.chrome.options import Options
# from bs4 import BeautifulSoup
import os
from utils import verify_driver_directory_path
from driver_not_found_exception import DriverNotFoundException


def curl(url: str) -> str:
    relative_directory_path_chrome = 'drivers/chrome-linux64'
    relative_directory_path_chromedriver = 'drivers/chromedriver-linux64'
    html_content: str = ""

    try:
        verify_driver_directory_path(relative_directory_path_chrome)

    except DriverNotFoundException as e:
        print(f"Caught custom exception: {e}")

    #
    # chrome_options = Options()
    # chrome_options.add_argument("--disable-gpu")
    # chrome_options.add_argument("--no-sandbox")
    # chrome_options.add_argument("--disable-dev-shm-usage")
    # chrome_options.add_argument("--remote-debugging-port=9222")
    # chrome_options.binary_location = chrome_binary_path
    #
    # # Set up the ChromeDriver service
    # service = Service(webdriver_path)
    #
    # # Launch the browser
    # driver = webdriver.Chrome(service=service, options=chrome_options)
    # driver.get(url)
    #
    # # Get the page source
    # html_content = driver.page_source
    # driver.quit()

    return html_content


# def extract_ray_id(html_content: str) -> str:
#     # Parse the HTML content using BeautifulSoup
#     soup = BeautifulSoup(html_content, 'lxml')
#
#     # Find the Ray ID
#     ray_id_div = soup.find('div', class_='ray-id')
#     ray_id_code = ray_id_div.find('code').text if ray_id_div else 'Ray ID not found'

# return ray_id_code

# Example usage
url = "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=13"
html_content = curl(url)

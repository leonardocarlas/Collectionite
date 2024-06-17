import os
from typing import List


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
    for i in range(1,max):
        links.append(url + str(i))
    return links



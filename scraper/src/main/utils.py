import os
from driver_not_found_exception import DriverNotFoundException


def verify_driver_directory_path(path: str):

    absolute_directory_path = os.path.abspath(path)

    if os.path.exists(absolute_directory_path):
        if os.path.isdir(absolute_directory_path):
            pass
        else:
            raise DriverNotFoundException(f"{absolute_directory_path} is not a directory.")
    else:
        raise DriverNotFoundException(f"The path {absolute_directory_path} does not exist.")

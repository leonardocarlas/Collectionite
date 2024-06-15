import os


class DriverNotFoundException(Exception):
    pass


def verify_driver_directory_path(path: str) -> bool:

    absolute_directory_path = os.path.abspath(path)

    if os.path.exists(absolute_directory_path):
        if os.path.isdir(absolute_directory_path):
            return True
        else:
            raise DriverNotFoundException(f"{absolute_directory_path} is not a directory.")
    else:
        raise DriverNotFoundException(f"The path {absolute_directory_path} does not exist.")

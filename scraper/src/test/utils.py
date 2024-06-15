import unittest

from src.main.utils import verify_driver_directory_path


class UtilTestCase(unittest.TestCase):
    def test_it_should_not_validate_a_wrong_path(self):
        path: str = 'src/pippo'

        is_path_valid: bool = verify_driver_directory_path(path)

        self.assertEqual(is_path_valid, False)

    def test_it_should_validate_a_correct_path(self):
        path: str = 'src/'

        is_path_valid: bool = verify_driver_directory_path(path)

        self.assertEqual(is_path_valid, True)


if __name__ == '__main__':
    unittest.main()

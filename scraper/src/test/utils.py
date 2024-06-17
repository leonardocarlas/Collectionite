import unittest

from src.main.utils import verify_driver_file_path, DriverNotFoundException


class UtilTestCase(unittest.TestCase):
    def test_invalid_directory_path(self):
        path = 'src/pippo/file.txt'

        with self.assertRaises(DriverNotFoundException) as context:
            verify_driver_file_path(path)

    def test_it_should_validate_a_correct_path(self):
        path: str = 'utils.py'

        is_valid: bool = verify_driver_file_path(path)

        self.assertTrue(is_valid)


if __name__ == '__main__':
    unittest.main()

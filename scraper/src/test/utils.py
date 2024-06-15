import unittest

from src.main.utils import verify_driver_directory_path, DriverNotFoundException


class UtilTestCase(unittest.TestCase):
    def test_invalid_directory_path(self):
        path = 'src/pippo'

        with self.assertRaises(DriverNotFoundException) as context:
            verify_driver_directory_path(path)

    def test_it_should_validate_a_correct_path(self):
        path: str = ''

        is_valid: bool = verify_driver_directory_path(path)

        self.assertTrue(is_valid)


if __name__ == '__main__':
    unittest.main()

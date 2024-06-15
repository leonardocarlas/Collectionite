import unittest
from src.main.service import curl


class MyTestCase(unittest.TestCase):
    def test_it_should_return_a_string(self):
        returned_value: str = curl("https://www.google.it/")

        self.assertIsInstance(returned_value, str)


if __name__ == '__main__':
    unittest.main()

import unittest
from src.main.service import get_html_content_from_url


class MyTestCase(unittest.TestCase):
    def test_it_should_return_a_string(self):
        returned_value: str = get_html_content_from_url("https://www.google.it/")

        self.assertIsInstance(returned_value, str)

    def test_it_should_not_return_an_empty_string(self):
        html_content: str = get_html_content_from_url("https://www.google.it/")

        self.assertGreater(len(html_content), 0)


if __name__ == '__main__':
    unittest.main()

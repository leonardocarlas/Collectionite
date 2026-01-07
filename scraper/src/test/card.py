import unittest

from src.main.card import Card


class MyTestCase(unittest.TestCase):

    def test_card_fields(self):
        card: Card = Card(
            id_card="12",
            card_name="card-name",
            link_image="link-image",
            marketplace_link="marketplace-link",
            position="001"
        )

        relative_dictionary = card.__dict__

        self.assertEqual({"id_card": "12", "card_name": "card-name", "link_image": "link-image",
                          "marketplace_link": "https://www.cardmarket.com/marketplace-link",
                          "position": "001"}, relative_dictionary)

    def test_json_conversion(self):
        card: Card = Card(
            id_card="12",
            card_name="card-name",
            link_image="link-image",
            marketplace_link="marketplace-link",
            position="001"
        )

        json_output: str = card.to_json()

        self.assertEqual(
            first=json_output,
            second="""{"card_name": "card-name","marketplace_link": "https://www.cardmarket.com/marketplace-link",
            "link_image": "link-image","id_card": "12","position": "001"}""")


if __name__ == '__main__':
    unittest.main()

import unittest

from src.main.card import Card
from src.main.formatter import create_component


class MyTestCase(unittest.TestCase):

    def test_it_should_create_a_component(self):
        card = Card(id_card="123", link_image="link", marketplace_link="link", card_name="Charizard")
        html_component: str = create_component(card=card)

        self.assertEqual(first=html_component, second='''<div class="card">
                            <img src="link" alt="Card Image" class="card-image">
                            <div class="card-content">
                                <h2 class="card-name">Charizard</h2>
                                <p class="card-id">ID: 123</p>
                                <a href="link" class="marketplace-link">View on Marketplace</a>
                            </div>
                        </div>''')


if __name__ == '__main__':
    unittest.main()

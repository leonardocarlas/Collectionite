from src.main.constants import Constants


class Card:

    def __init__(self, id_card: str, card_name: str, link_image: str, marketplace_link: str, position: str):
        self.id_card = id_card
        self.card_name = card_name
        self.link_image = link_image
        self.marketplace_link = Constants.MARKETPLACE_DOMAIN + marketplace_link
        self.position = position

    def test_url(self):
        print(f"Marketplace link: {self.marketplace_link}")

    def to_json(self) -> str:
        return self.__dict__.__str__()

import unittest
from typing import List, Dict

from src.main.utils import verify_driver_file_path, DriverNotFoundException, link_generator, \
    extract_data_from_single_div


class UtilTestCase(unittest.TestCase):
    def test_invalid_directory_path(self):
        path = 'src/pippo/file.txt'

        with self.assertRaises(DriverNotFoundException) as context:
            verify_driver_file_path(path)

    def test_it_should_validate_a_correct_path(self):
        path: str = 'utils.py'

        is_valid: bool = verify_driver_file_path(path)

        self.assertTrue(is_valid)

    def test_it_should_generate_a_list_of_urls(self):
        url: str = "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site="
        max: int = 14

        links: List[str] = link_generator(url=url, max=max)

        self.assertEqual(links,[
            "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=1",
            "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=2",
            "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=3",
            "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=4",
            "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=5",
            "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=6",
            "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=7",
            "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=8",
            "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=9",
            "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=10",
            "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=11",
            "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=12",
            "https://www.cardmarket.com/en/Pokemon/Products/Singles/Temporal-Forces?idCategory=51&idExpansion=5589&idRarity=0&sortBy=collectorsnumber_asc&site=13",
        ])

    def test_it_should_retrieve_values_from_single_div(self):
        div: str = '''
        <div class="d-flex mb-4 col-12 col-sm-6 col-md-4 col-lg-3">
            <a class="card text-center w-100 galleryBox" href="/en/Pokemon/Products/Singles/Temporal-Forces/Raging-Bolt-ex-V1-TEF123">
            <img alt="Raging Bolt ex " class="lazy card-img-top img-fluid" data-echo="https://product-images.s3.cardmarket.com/51/TEF/760753/760753.jpg" src="/img/transparent.gif"/>
            <div class="card-body d-flex flex-column">
                <h2 class="card-title h3">
                <span aria-label="Temporal Forces" class="expansion-symbol is-pokemon icon is-24x24" data-bs-html="true" data-bs-original-title="Temporal Forces" data-bs-placement="bottom" data-bs-toggle="tooltip">
                <span style="display: inline-block; width: 21px; height: 21px; background-image: url('//static.cardmarket.com/img/ed0b9795fe1c1b416fd56983a180f8b0/expansionicons/expicons.png'); background-position: -126px -2121px;">
                </span>
                </span>
                Raging Bolt ex (TEF 123)
                </h2>
                <p class="card-text h5">
                </p>
                <p class="card-text text-muted">
                From
                <b>
                0,75 €
                </b>
                </p>
            </div>
            </a>
            </div>
        '''

        data: Dict = extract_data_from_single_div(div)

        self.assertEqual(
            first=data,
            second={
                "link_url": "/en/Pokemon/Products/Singles/Temporal-Forces/Raging-Bolt-ex-V1-TEF123",
                "image_url": "https://product-images.s3.cardmarket.com/51/TEF/760753/760753.jpg",
                "card_title": "Raging Bolt ex (TEF 123)"
            }
        )





if __name__ == '__main__':
    unittest.main()

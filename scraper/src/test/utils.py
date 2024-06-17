import unittest
from typing import List, Dict

from bs4 import Tag, BeautifulSoup

from src.main.utils import verify_driver_file_path, DriverNotFoundException, link_generator, \
    extract_data_from_single_div, extract_divs_from_document, extract_id_from_link


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

        data: Dict = extract_data_from_single_div(BeautifulSoup(div, 'html.parser'))

        self.assertEqual(
            first=data,
            second={
                "link_url": "/en/Pokemon/Products/Singles/Temporal-Forces/Raging-Bolt-ex-V1-TEF123",
                "image_url": "https://product-images.s3.cardmarket.com/51/TEF/760753/760753.jpg",
                "card_name": "Raging Bolt ex (TEF 123)"
            }
        )

    def test_it_should_extract_divs_from_document(self):
        html_document: str = '''
            <a class="filterToggle d-md-none btn btn-lg btn-primary btn-rounded btn-fixed" data-backdrop="true" data-bs-target="#modal" data-bs-toggle="modal" data-modal="/en/Pokemon/Modal/Category_FilterProducts?idCategory=51&amp;idExpansion=5589&amp;mode=gallery" href="#">
         <span class="fonticon-filter">
         </span>
        </a>
        <div class="row my-3 align-items-center">
         <div class="col-auto d-none d-md-block">
          244 Hits
         </div>
         <div class="col-auto ms-auto">
          <div>
           <a class="btn btn-primary btn-sm ms-1" href="/en/Pokemon/Products/Singles/Temporal-Forces?mode=list&amp;site=1" role="button">
            <span class="fonticon-table">
            </span>
            <span class="d-none d-md-inline">
             List View
            </span>
           </a>
           <a class="btn btn-sm ms-1 btn-primary disabled" role="button">
            <span class="fonticon-gallery">
            </span>
            <span class="d-none d-md-inline">
             Grid View
            </span>
           </a>
          </div>
         </div>
        </div>
        <div class="row">
         <div class="d-flex mb-4 col-12 col-sm-6 col-md-4 col-lg-3">
          <a class="card text-center w-100 galleryBox" href="/en/Pokemon/Products/Singles/Temporal-Forces/Live-Code-Card-Booster-TEF">
           <img alt="Live Code Card (Booster)" class="lazy card-img-top img-fluid" src="https://product-images.s3.cardmarket.com/51/TEF/750382/750382.jpg"/>
           <div class="card-body d-flex flex-column">
            <h2 class="card-title h3">
             <span aria-label="Temporal Forces" class="expansion-symbol is-pokemon icon is-24x24" data-bs-html="true" data-bs-original-title="Temporal Forces" data-bs-placement="bottom" data-bs-toggle="tooltip">
              <span style="display: inline-block; width: 21px; height: 21px; background-image: url('//static.cardmarket.com/img/ed0b9795fe1c1b416fd56983a180f8b0/expansionicons/expicons.png'); background-position: -126px -2121px;">
              </span>
             </span>
             Live Code Card (Booster) (TEF)
            </h2>
            <p class="card-text h5">
            </p>
            <p class="card-text text-muted">
             From
             <b>
              0,02 €
             </b>
            </p>
           </div>
          </a>
         </div>
         <div class="d-flex mb-4 col-12 col-sm-6 col-md-4 col-lg-3">
          <a class="card text-center w-100 galleryBox" href="/en/Pokemon/Products/Singles/Temporal-Forces/Buddy-Buddy-Poffin-TEF144">
           <img alt="Buddy-Buddy Poffin" class="lazy card-img-top img-fluid" src="https://product-images.s3.cardmarket.com/51/TEF/760774/760774.jpg"/>
           <div class="card-body d-flex flex-column">
            <h2 class="card-title h3">
             <span aria-label="Temporal Forces" class="expansion-symbol is-pokemon icon is-24x24" data-bs-html="true" data-bs-original-title="Temporal Forces" data-bs-placement="bottom" data-bs-toggle="tooltip">
              <span style="display: inline-block; width: 21px; height: 21px; background-image: url('//static.cardmarket.com/img/ed0b9795fe1c1b416fd56983a180f8b0/expansionicons/expicons.png'); background-position: -126px -2121px;">
              </span>
             </span>
             Buddy-Buddy Poffin (TEF 144)
            </h2>
            <p class="card-text h5">
            </p>
            <p class="card-text text-muted">
             From
             <b>
              0,02 €
             </b>
            </p>
           </div>
          </a>
         </div>
        '''

        divs: List[Tag] = extract_divs_from_document(html_document=html_document)

        self.assertEqual(len(divs), 2)

    def test_it_should_extract_id_from_link(self):
        link: str = "https://product-images.s3.cardmarket.com/51/TEF/760781/760781.jpg"

        id: str = extract_id_from_link(link=link)

        self.assertEqual(id, "760781")

if __name__ == '__main__':
    unittest.main()

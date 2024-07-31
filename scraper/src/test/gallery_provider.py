import unittest
from typing import Dict

from src.main.gallery_provider import extract_image_urls_from_document


class MyTestCase(unittest.TestCase):
    def test_it_should_extract_image_urls(self):
        html_document: str = '''
            <ul>
                <li class="column" data-category="seeall">
                    <div class="card-placeholder">
                        <div
                            class="perspective-card card perspective-card--clickable"
                            data-zoom="20"
                            data-decorator="ClickablePerspectiveCard"
                            data-track-card-name="001"
                            style="display: block; height: 392.688px; width: 281.109px; transform: scale(1.00002);"
                        >
                            <div class="card__img-wrapper perspective-card__transformer" style="transform: matrix3d(1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1);">
                                <div class="card__img card__img--front">
                                    <img
                                        src="https://dz3we2x72f7ol.cloudfront.net/expansions/twilight-masquerade/en-us/SV06_EN_1.png"
                                        srcset="https://dz3we2x72f7ol.cloudfront.net/expansions/twilight-masquerade/en-us/SV06_EN_1.png 1x, https://dz3we2x72f7ol.cloudfront.net/expansions/twilight-masquerade/en-us/SV06_EN_1-2x.png 2x"
                                        alt=""
                                    />
                                </div>
                                <div class="card__img card__img--back"><img src="../../../assets/img/global/tcg-card-back.jpg" srcset="../../../assets/img/global/tcg-card-back.jpg 1x, ../../../assets/img/global/tcg-card-back-2x.jpg 2x" alt="" /></div>
                                <div class="card__shine perspective-card__shine" style="background: linear-gradient(3.06411rad, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0.04) 5%, rgba(255, 255, 255, 0) 80%);"></div>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- Other li elements -->
            </ul>
            '''

        urls_map: Dict[str, str] = extract_image_urls_from_document(html_document)

        self.assertEqual(
            first=urls_map,
            second={
                "001": "https://dz3we2x72f7ol.cloudfront.net/expansions/twilight-masquerade/en-us/SV06_EN_1.png"
            }
        )


if __name__ == '__main__':
    unittest.main()

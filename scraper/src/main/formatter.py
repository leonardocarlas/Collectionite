from src.main.card import Card


def create_component(card: Card) -> str:
    return (
        f'''<div class="card">
        <img src="{card.link_image}" alt="Card Image" class="card-image">
        <div class="card-content">
            <h2 class="card-name">{card.card_name}</h2>
            <p class="card-id">ID: {card.id_card}</p>
            <a href="{card.marketplace_link}" class="marketplace-link">View on Marketplace</a>
        </div>
    </div>'''
    )


def add_style() -> str:
    return '''
    <style>
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            text-align: center;
        }
        
        .card-image {
            width: 100%;
            height: auto;
        }
        
        .card-content {
            padding: 16px;
        }
        
        .card-name {
            font-size: 1.5em;
            margin: 0;
        }
        
        .card-id {
            color: #888;
            margin: 8px 0;
        }
        
        .marketplace-link {
            display: inline-block;
            margin-top: 12px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        
        .marketplace-link:hover {
            background-color: #0056b3;
        }

    </style>
    '''

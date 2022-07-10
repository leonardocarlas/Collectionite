import praw
import json
import pprint

reddit = praw.Reddit(
    client_id="qycD99v8-kvy0A",
    client_secret="JVkhceHcqm0nCIBdisgOXlsgt_vhNQ",
    user_agent="collection sight integration test by u/collection_sight",
    username="collection_sight",
    password="Dragalge3",
)



id_tcg = ['1','6','3','7','8']
list_of_subs = ['magicTCG','pokemontcg','yugioh','FoWtcg','cardfightvanguard']


list_of_items = []
fields = ('title', 'url', 'permalink', 'created_utc', 'num_comments', 'selftext_html', 'media_metadata')

for i in range(0,5):
    for submission in reddit.subreddit(list_of_subs[i]).hot(limit=15):
        to_dict = vars(submission)

        sub_dict = {}

        for field in fields:
            if field in to_dict:
                sub_dict[field]=to_dict[field]
            else: 
                sub_dict[field]=''

        list_of_items.append(sub_dict)

    pprint.pprint(list_of_items)

    json_str = json.dumps(list_of_items)

    with open('REDDITPOSTS/'+ id_tcg[i] +'.json', 'w') as f:
        json.dump(list_of_items, f)




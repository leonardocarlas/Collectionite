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



list_of_items = []
fields = ('title', 'url', 'permalink', 'created_utc', 'num_comments', 'selftext_html', 'media_metadata')

for submission in reddit.subreddit('pokemontcg').hot(limit=15):
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

with open('REDDITPOSTS/6.json', 'w') as f:
    json.dump(list_of_items, f)




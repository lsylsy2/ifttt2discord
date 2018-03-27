# ifttt2discord

Sample Youtube to Discord Request Body:
POST application/json to https://your.script.address/ifttt2discord/webhook.php
```
{ "setting":{ "target_url":"https://discordapp.com/api/webhooks/YOUR_WEBHOOK/ADDRESS", "type":"youtube_filtrated", "content_filter":"ml" }, "data":{ "created_at":"{{CreatedAt}}", "title":"{{Title}}", "authorname":"{{AuthorName}}", "description":"<<<{{Description}}>>>", "url":"{{Url}}" } }
```

Sample Twitter to Discord Request Body:
POST application/json to https://your.script.address/ifttt2discord/webhook.php
```
{ "setting":{ "target_url":"https://discordapp.com/api/webhooks/YOUR_WEBHOOK/ADDRESS", "type":"twitter_filtrated", "content_filter":"karaage" }, "data":{ "text":"<<<{{Text}}>>>", "username":"{{UserName}}", "link_to_tweet":"{{LinkToTweet}}", "created_at":"{{CreatedAt}}" } }
```
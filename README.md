# debit-cards-api

`composer require sergeevpasha/debit-cards-api`

Use examples

```
$api = new Sergeevpasha\DebitCardsApi\DebitCard('key');
$api->country()->get(1);
$api->card()->getPin(1);
```
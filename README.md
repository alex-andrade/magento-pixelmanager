# magento-pixelmanager
Pixel manager for Magento 1.x

After install, go to CMS > Pixel Manager

With this extension you are able to add pixels at:
All Pages, Product Page, Category Page, Cart Page, Checkout and Checkout Success Pages.

## How to buld pixels
Example All Pages
```javascript
<script>
//All Pages
var content = 'all pages';
</script>
```
Result Example All Pages 
```javascript
<script>
//All Pages
var content = 'all pages';
</script>
```

Example Sucess Page
```javascript
<script>
//Sucess Page
var incrementId = '{{var order.increment_id}}';
var grandTotal = '{{var order.grand_total}}';
var items = [
{{loop order.all_visible_items delimiter=,}} 
{
product : '{{item name}}',
sku :  '{{item sku}}' 
}
{{pool}} 
];
</script>
```
Result Example Sucess Page
```javascript
<script>
//Sucess Page
var incrementId = '100000071';
var grandTotal = '200.0000';
var items = [ 
{
product : 'Havaina Brasil-Azul-G',
sku :  'havaina-brasil-Azul-G' 
}
, 
{
product : 'Havaina Brasil-Branco-GG',
sku :  'havaina-brasil-Branco-GG' 
}
];
</script>
```

## Contributing
Have you found a bug or do you want to contribute with some feature?

* Make a fork.
* Add your feature or bug fix.
* Send a pull request no [GitHub].

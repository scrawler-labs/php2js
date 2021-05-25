# PHP2JS
Convert php code to javascript code that can run on browser

### Installation 
package can be installed via composer<br>
```
composer require piqon/php2js
```

### Usage
If You want to create a copiled javascript file , you can run the following code: <br>

```php
<?php
include __DIR__ . '/vendor/autoload.php';

/*
* Replace test.php with path of your input php file
* Replace test.js with path for your js file output
*/

\PHP2JS\PHP2JS::compileFile(__DIR__.'/test.php',__DIR__.'/test.js');
```

If you just want to convert a small block of code , you can run the following code:

```php
<?php
include __DIR__ . '/vendor/autoload.php';

$code = "
$name='1';
echo 'hi'; 
"

\PHP2JS\PHP2JS::compile($code);
```

### Demo

Input code :

```php
<?php
$name = 'Pranjal';
$cars = ['BMW','Audi'];
$cars->push('Ferrari');
echo $name;
echo $cars;

function click(){
    echo 'button clicked!';
}
```

Output code:
```javascript

let name = 'Pranjal';
let cars = ['BMW', 'Audi'];
cars.push('Ferrari');
console.log( name);
console.log( cars);

function click()
{
    console.log( 'button clicked!');
}

```


### Note
This was designed to convert php scripts to javascript code , this might not work with full blown php classes !
You can call javascript functions like console.log etc right from your php code and it will work as expected in the browser.
This compiler does not support magic variables and magic functions of PHP.


### Changelog

#### v0.3.0
- Added support for import : `include 'test'` now converts to `import test from './test.js'`
You can also use import_from() php function to define path of module.
Example:
```php
import_from('test','./component/test.js');
```
will compile to 
```js
import test from './component/test.js';
```
<br>

- Added support for async function declaration via comment:
```php
// @async
function abc(){
return 'hi';
}
```
will compile to 
```js
async function abc(){
return 'hi';
}
```

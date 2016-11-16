# Prybar
Bypasses [OOP visibility rules][1] in PHP so you can get, set, and call private or protected members.

```php
class Sealed {
    private $value = 'foo';
    private function secret() { return 'bar'; }
    private static function say($value) { return $value; }
}

$sealed = new Sealed;

$opened = new \Haldayne\Prybar($sealed);
echo $opened->value . PHP_EOL;
echo $opened->secret() . PHP_EOL;
echo say($opened, 'baz') . PHP_EOL;
```

Normally, you do not want to do this.

[1]: http://php.net/manual/en/language.oop5.visibility.php

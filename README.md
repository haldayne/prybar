# Prybar
Bypasses [PHP OOP visibility rules][1] so you can get, set, and call private
or protected members. Normally, you do not want to do this.

```php
class Sealed {
    private $value = 'foo';
    private function secret() { return $this->value; }
}

$sealed = new Sealed;

$opened = new \Haldayne\Prybar($sealed);
$opened->value = 'bar';
echo $opened->value;
echo $opened->secret();
```

[1]: http://php.net/manual/en/language.oop5.visibility.php
[2]: http://cerebriform.blogspot.com/2016/11/bypassing-private-protected-visibility.html

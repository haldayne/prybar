<?php
namespace Haldayne\Prybar;

class SealedFixture
{
    public        $public_value                   = 'foo';
    public static $public_value_static            = 'bar';
    public        function public_func($x)        { return $x; }
    public static function public_static_func($x) { return $x; }

    protected        $protected_value                   = 'foo';
    protected static $protected_value_static            = 'bar';
    protected        function protected_func($x)        { return $x; }
    protected static function protected_static_func($x) { return $x; }

    private        $private_value                   = 'foo';
    private static $private_value_static            = 'bar';
    private        function private_func($x)        { return $x; }
    private static function private_static_func($x) { return $x; }
}

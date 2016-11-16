<?php
namespace Haldayne\Prybar;

class PrybarTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->sealed = new SealedFixture;
        $this->opened = new Prybar($this->sealed);
    }

    /**
     * @dataProvider provides_instance_properties
     */
    public function test_get_on_existing_property($property)
    {
        $this->assertSame('foo', $this->opened->get($property));
    }

    /**
     * @dataProvider provides_instance_properties
     */
    public function test_get_by_reference_on_existing_property($property)
    {
        $value =& $this->opened->get($property);
        $value = strtoupper($value);
        $this->assertSame($value, $this->opened->get($property));
    }

    /**
     * @dataProvider provides_instance_properties
     */
    public function test_set_on_existing_property($property)
    {
        $value = strtoupper($this->opened->get($property));
        $this->opened->set($property, $value);
        $this->assertSame($value, $this->opened->get($property));
    }

    /**
     * @dataProvider provides_instance_methods
     */
    public function test_call_on_existing_method($method)
    {
        $value = 'quux';
        $this->assertSame($value, $this->opened->call($method, $value));
    }

    public function test_set_on_new_property()
    {
        $this->opened->set('missing', 'x');
        $this->assertSame('x', $this->opened->get('missing'));
    }

    public function test_get_on_new_property()
    {
        $this->assertNull($this->opened->get('missing'));
    }

    public function test_get_by_reference_on_new_property()
    {
        $value =& $this->opened->get('missing');
        $value = 'x';
        $this->assertSame('x', $this->opened->get('missing'));
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function test_call_on_missing_method()
    {
        $this->opened->call('missing');
    }

    // -=-= Data Providers =-=-

    public static function provides_instance_properties()
    {
        return [
            [ 'public_value' ],
            [ 'protected_value' ],
            [ 'private_value' ],
        ];
    }

    public static function provides_instance_methods()
    {
        return [
            [ 'public_func' ],
            [ 'protected_func' ],
            [ 'private_func' ],
        ];
    }
}

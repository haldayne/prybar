<?php
namespace Haldayne\Prybar;

/**
 * Wraps a target object, exposing that target object's private or protected
 * properties and methods.
 *
 * @see http://cerebriform.blogspot.com/2016/11/bypassing-private-protected-visibility.html
 * @see http://ocramius.github.io/blog/accessing-private-php-class-members-without-reflection/
 */
class Prybar
{
    /**
     * Create a prybar around the given object. All private or protected
     * members and methods will be made available.
     *
     * @param object $target The object to pry open.
     */
    public function __construct($target)
    {
        $this->target = $target;
    }

    /**
     * Set the instance property to the given value on the pry target,
     * regardless of the property's defined visibility.
     *
     * @param string $property
     * @param mixed $value
     * @return null
     */
    public function set($property, $value)
    {
        \Closure::bind(
            function () use ($property, $value) { $this->$property = $value; },
            $this->target,
            $this->target
        )->__invoke();
    }

    /**
     * Get a reference to the instance property on the pry target, regardless
     * of the property's defined visibility.
     *
     * @param string $property
     * @return mixed
     */
    public function &get($property)
    {
        return \Closure::bind(
            function &() use ($property) { return $this->$property; },
            $this->target,
            $this->target
        )->__invoke();
    }

    /**
     * Call the instance method on the pry target, regardless of the method's
     * defined visibility.
     *
     * @param string $method
     * @param mixed ...$arguments
     * @return mixed
     * @throws \BadMethodCallException If the method does not exist on the pry target
     */
    public function call($method, ...$arguments)
    {
        return \Closure::bind(
            function () use ($method, $arguments) {
                if (method_exists($this, $method)) {
                    return $this->$method(...$arguments);
                } else {
                    throw new \BadMethodCallException;
                }
            },
            $this->target,
            $this->target
        )->__invoke();
    }

    // PRIVATE API

    /** 
     * @var object $target
     */
    private $target;
}

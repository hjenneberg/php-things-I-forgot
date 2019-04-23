<?php
/**
 * Demonstrates late static binding in PHP
 *
 * Using self always references the class where it is defined, e.g. in a function that is defined
 * in a class. Using this function in an extending class will reference the class that is extended from.
 * There is (was) no way of referencing the extending class. Here comes a second meaning of the static keyword.
 *
 * @see https://stackoverflow.com/a/1913030
 */

declare(strict_types=1);

/**
 * Class BaseClass
 */
class BaseClass
{
    /**
     * Using self always references the class where it is defined
     *
     * Using self in an extending class will always
     * reference this class, i.e. the BaseClass
     * where the code is located
     *
     * @return string
     */
    public static function whoAmI()
    {
        return self::class;
    }

    /**
     * Using static references the class where it is called
     *
     * Using static in an extending class will always
     * reference the extending class, i.e. the ExtendingClass
     * where the code is called
     *
     * @return string
     */
    public static function whoAmIReally()
    {
        return static::class;
    }
}

/**
 * Class ExtendingClass
 */
class ExtendingClass extends BaseClass
{
}

echo PHP_EOL;

echo 'When I am the BASE class I do not care:' . PHP_EOL;
echo '- I think of myself as ' . BaseClass::whoAmI() . '.' . PHP_EOL;
echo '- In the end I am just ' . BaseClass::whoAmIReally() . '.' . PHP_EOL;
echo PHP_EOL;

echo 'When I am an EXTENDING class there is a difference:' . PHP_EOL;
echo '- I think of myself as ' . ExtendingClass::whoAmI() . '.' . PHP_EOL;
echo '- In the end I am just ' . ExtendingClass::whoAmIReally() . '.' . PHP_EOL;
echo PHP_EOL;

/**
 * So what is the use case?
 */
class A
{
    protected static $table = "table";

    public static function connect()
    {
        echo static::$table;

        return null;
    }
}

class B extends A
{
    protected static $table = "subtable";
}

$table = B::connect();

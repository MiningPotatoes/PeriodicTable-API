<?php

require_once(__DIR__ . '/../config.php');

require_once(BASE_PATH . '/vendor/autoload.php');

require_once(BASE_PATH . '/core/ApiException.php');
require_once(BASE_PATH . '/core/Router.php');
require_once(BASE_PATH . '/core/BaseController.php');
require_once(BASE_PATH . '/Controller.php');


class ControllerTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $initialRequestData = ['a' => 'b'];

        $bc = new \app\Controller($initialRequestData);

        $this->assertTrue($bc instanceof \app\Controller);
        $this->assertTrue($bc instanceof \app\core\BaseController);

        $requestProperty = $this->getPrivateProperty(\app\core\BaseController::class, 'request');

        $this->assertEquals($initialRequestData, $requestProperty->getValue($bc));
    }

    public function testExecute()
    {
        $bc = new \app\Controller([]);

        $result = $bc->execute('getDankmemes');

        $this->assertSame([69 => "( ͡° ͜ʖ ͡°)"], $result);
    }

    public function testGetAllNames()
    {
        $bc = new \app\Controller(['mode' => 'names']);
        $result = $bc->execute('getNames');

        $this->assertTrue(count($result) === 118);

        $this->assertContains('Yttrium', $result);
        $this->assertNotContains('Decalithium', $result);
    }

    public function testGetNames()
    {
        $bc = new \app\Controller([
            'mode' => 'names',
            'elements' => 'F,G,H',
        ]);

        $result = $bc->execute('getNames');

        $this->assertTrue(count($result) === 3);

        $this->assertContains('Fluorine', $result);
        $this->assertContains('Hydrogen', $result);

        // G element
        $this->assertContains(['error' => 'Invalid element!'], $result);
    }

    public function testGetAllOrbitals()
    {
        // todo refactor
        $this->testGetAllElectrons();
    }

    public function testGetOrbitals()
    {
        // todo refactor
        $this->testGetElectrons();
    }

    public function testGetAllElectrons()
    {
        $bc = new \app\Controller([
            'mode' => 'electrons',
        ]);

        $result = $bc->execute('getElectrons');

        $this->assertTrue(count($result) === 118);
    }

    public function testGetElectrons()
    {
        $bc = new \app\Controller([
            'mode' => 'electrons',
            'elements' => 'F,G,H',
        ]);

        $result = $bc->execute('getElectrons');

        $this->assertTrue(count($result) === 3);

        // Fluorine electrons:
        $this->assertContains(['config' => '1s2 2s2 2p5', 'short' => '[He] 2s2 2p5'], $result);

        // G element
        $this->assertContains(['error' => 'Invalid element!'], $result);
    }

    public function testGetAllNumbers()
    {
        $bc = new \app\Controller([
            'mode' => 'numbers',
        ]);

        $result = $bc->execute('getNumbers');

        $this->assertTrue(count($result) === 118);

        foreach (range(1, 118) as $i) {
            $this->assertContains(['atomic' => $i], $result);
        }
    }

    public function testGetNumbers()
    {
        $bc = new \app\Controller([
            'mode' => 'numbers',
            'elements' => 'F,G,H',
        ]);

        $result = $bc->execute('getNumbers');

        $this->assertTrue(count($result) === 3);

        // Fluorine:
        $this->assertContains(['atomic' => 9], $result);

        // Hydrogen:
        $this->assertContains(['atomic' => 1], $result);

        // G element
        $this->assertContains(['error' => 'Invalid element!'], $result);
    }

    /**
     * getPrivateProperty
     *
     * @author Joe Sexton <joe@webtipblog.com>
     * @param string $className
     * @param string $propertyName
     * @return \ReflectionProperty
     */
    private function getPrivateProperty($className, $propertyName)
    {
        $property = (new \ReflectionClass($className))->getProperty($propertyName);
        $property->setAccessible(true);

        return $property;
    }

    /**
     * getPrivateMethod
     *
     * @author Joe Sexton <joe@webtipblog.com>
     * @param string $className
     * @param string $methodName
     * @return \ReflectionMethod
     */
    private function getPrivateMethod($className, $methodName)
    {
        $method = (new ReflectionClass($className))->getMethod($methodName);
        $method->setAccessible(true);

        return $method;
    }
}

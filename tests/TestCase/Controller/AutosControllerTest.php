<?php
namespace App\Test\TestCase\Controller;

use Cake\TestSuite\IntegrationTestTrait;
use Cake\TestSuite\TestCase;

class AutosControllerTest extends TestCase
{
    use IntegrationTestTrait;

    public function testIndex()
    {
        $this->get('/autos');
        $this->assertResponseCode(302); // Redirige a login
    }
}

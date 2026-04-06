<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersTable;
use Authentication\PasswordHasher\DefaultPasswordHasher;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersTable Test Case
 */
class UsersTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersTable
     */
    protected $Users;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Users') ? [] : ['className' => UsersTable::class];
        $this->Users = $this->getTableLocator()->get('Users', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Users);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @link \App\Model\Table\UsersTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $entity = $this->Users->newEntity([
            'name' => 'Test',
            'last_name' => 'User',
            'correo' => 'test-user@example.com',
            'password' => 'secret123',
            'rol' => 'user',
            'idioma' => 'es_ES',
            'telefono' => '70000001',
        ]);

        $this->assertEmpty($entity->getErrors());
    }

    public function testPasswordUpdateIsPersisted(): void
    {
        $user = $this->Users->get(1);
        $user->password = 'newpass123';

        $this->assertNotFalse($this->Users->save($user));

        $savedUser = $this->Users->get(1);
        $this->assertNotSame('newpass123', $savedUser->password);
        $this->assertTrue((new DefaultPasswordHasher())->check('newpass123', (string)$savedUser->password));
    }

    public function testProfileFieldsUpdateIsPersisted(): void
    {
        $user = $this->Users->get(1);
        $user->idioma = 'en_US';
        $user->telefono = '77777777';

        $this->assertNotFalse($this->Users->save($user));

        $savedUser = $this->Users->get(1);
        $this->assertSame('en_US', $savedUser->idioma);
        $this->assertSame('77777777', $savedUser->telefono);
    }
}

<?php

require __DIR__ . '/../vendor/autoload.php';

class UserRepository implements SplObserver
{
    /**
     * @var \Medoo\Medoo
     */
    private $db;

    public function __construct(\Medoo\Medoo $db)
    {
        $this->db = $db;
    }

    public function update(SplSubject $subject, $event = null, $data = null)
    {
        echo $event;
        var_dump($data);
    }

    public function getUsers()
    {

        return $this->db->select('users', ['id', 'name', 'email'], ['id[<]' => 20]);
    }
}
use Medoo\Medoo;
$db = new Medoo();

$user = new UserRepository($db);
$db->attach($user);
$user1 = new UserRepository($db);
$db = $db->connect([
    'database_type'     => 'mysql',
    'server'     => '127.0.0.1',
    'port'     => '3306',
    'database_name'   => 'db_permit',
    'username'     => 'root',
    'password' => 'dg@machine'
]);

var_dump($user1->getUsers());
//var_dump($user->getUsers());

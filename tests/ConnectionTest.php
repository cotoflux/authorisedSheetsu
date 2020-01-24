
<?php


use PHPUnit\Framework\TestCase;
use Sheetsu\Connection;
use Sheetsu\Response;
class ConnectionTest extends TestCase
{
    public function testConstructSetsBasicHttpAuthWhenValidConfigurationGiven()
    {
        $config = [
            'key'    => 'MY_KEY',
            'secret' => 'MY_SECRET',
            'method' => 'get',
            'url'    => 'https://sheetsu.com/apis/v1.0/dc31e735c9ce',
            'limit'  => 0,
            'offset' => 0
        ];
        $connection = new Connection($config);
        $config = $connection->getConfig();
        $this->assertTrue(isset($config['key']) && isset($config['secret']));
    }
}
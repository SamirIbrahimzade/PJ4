<?php

include 'index.php';


class LoginTest extends \PHPUnit\Framework\TestCase {

    /*
    public function testLogin1(){

        //$this->assertTrue($condition);
        $result = login("a","a");
        $this->assertEquals(1,$result);
    }
*/
    public function testLogin2(){

        //$this->assertTrue($condition);
        $result = login("a","c");
        $this->assertEquals(0,$result);
    }
}
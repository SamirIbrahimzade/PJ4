<?php

include 'sign_up.php';


class RegisterTest extends \PHPUnit\Framework\TestCase {

    public function testRegister1(){

        $result = signup("test3","test3","test3","test3");
        $this->assertEquals(0,$result);
    }

    public function testRegister2(){

        //$this->assertTrue($condition);
        $result = signup("test5","test5","test5","test5");
        $this->assertEquals(0,$result);
    }
}
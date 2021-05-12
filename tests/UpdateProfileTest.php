<?php

include 'profile.php';


class UpdateProfileTest extends \PHPUnit\Framework\TestCase {

    
    public function testUpdateProfile(){

        $result = updateprofile("male", "single", "2000-10-27", "75", "178", "b");
        $this->assertEquals(1,$result);
    }

}
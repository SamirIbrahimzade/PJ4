<?php

include 'entry.php';


class SymptomTest extends \PHPUnit\Framework\TestCase {

    
    public function testSymptom(){

        $result = submit_symptoms("b", "2021-5-12", "90", "38", "Difficult");
        $this->assertEquals(1,$result);
    }

}
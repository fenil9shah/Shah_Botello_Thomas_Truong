<?php
    
    use PHPUnit\Framework\TestCase;
    
    require_once 'class.php';
    
    

    class functiontest2 extends TestCase
    {
        //require 'class.php';
        $newregister = new User();
        
        /** @test */
        public function testcheckregistration()
        {
            //
            $inputfieldsfullname = 'king';
            $inputfieldsusername = 'fen';
            $inputfieldsemail = 'fen@gmail.com';
            $inputfieldspassword = '123456';
            
            $result1 = $newregister->register($inputfieldsfullname,$inputfieldsusername,$inputfieldsemail,$inputfieldspassword);
            $expectedresult = true;
            $this->assertEquals($expectedresult, $result1);
        }

    }


?>
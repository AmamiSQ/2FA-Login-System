<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>
</head>

<body>
    <!-- HTML for text boxes and submit buttons -->
    <form action="test.php" method="post">
    Name: <input type="text" name="name"><br>
    Password: <input type="password" name="pass"><br>
    <input type="submit">
    </form>

    <!-- start PHP code -->
    <?php
       require_once("vendor/autoload.php"); //load in packages
       use RobThree\Auth\TwoFactorAuth;
       error_reporting(E_ERROR | E_PARSE); //don't print warnings to the screen
       
       /* $tfa = new TwoFactorAuth();
       $secret = $tfa->createSecret();
    ?>

    <img src="<?php echo $tfa->getQRCodeImageAsDataUri('Testing', $secret);?>"><br>
    <form action="test.php" method="post">
    Code: <input type="number" name="ncode"><br>
    <input type="submit">
    </form>

    <?php
        
        $code = $tfa->getCode($secret);
        echo $code;
        
        if ($tfa->verifyCode($code, $_POST['ncode']) === true) { 
            echo "login succesful";
        } 
        else { 
            echo "login failed";
        }

        try {
            $tfa->ensureCorrectTime();
            echo 'Your hosts time seems to be correct / within margin';
        } catch (RobThree\Auth\TwoFactorAuthException $ex) {
            echo '<b>Warning:</b> Your hosts time seems to be off: ' . $ex->getMessage();
        } */
        class Google2FA {
            const keyRegeneration   = 30;   // Interval between key regeneration
            const otpLength     = 6;    // Length of the Token generated
    
            private static $lut = array(    // Lookup needed for Base32 encoding
                "A" => 0,    "B" => 1,
                "C" => 2,    "D" => 3,
                "E" => 4,    "F" => 5,
                "G" => 6,    "H" => 7,
                "I" => 8,    "J" => 9,
                "K" => 10,   "L" => 11,
                "M" => 12,   "N" => 13,
                "O" => 14,   "P" => 15,
                "Q" => 16,   "R" => 17,
                "S" => 18,   "T" => 19,
                "U" => 20,   "V" => 21,
                "W" => 22,   "X" => 23,
                "Y" => 24,   "Z" => 25,
                "2" => 26,   "3" => 27,
                "4" => 28,   "5" => 29,
                "6" => 30,   "7" => 31
            );
    
            public static function generate_secret_key($length = 16) {
                $b32    = "234567QWERTYUIOPASDFGHJKLZXCVBNM";
                $s  = "";
    
                for ($i = 0; $i < $length; $i++){
                    $s .= $b32[rand(0,31)];
                    return $s;
                }
            }
    
            public static function get_timestamp() {
                return floor(microtime(true)/self::keyRegeneration);
            }
    
            public static function base32_decode($b32) {
                $b32    = strtoupper($b32);
                
                if (!preg_match('/^[ABCDEFGHIJKLMNOPQRSTUVWXYZ234567]+$/', $b32, $match)){
                    throw new Exception('Invalid characters in the base32 string.');
                }
                
                $l  = strlen($b32);
                $n  = 0;
                $j  = 0;
                $binary = "";
    
                for ($i = 0; $i < $l; $i++) {
    
                    $n = $n << 5; // Move buffer left by 5 to make room $n = $n + self::$lut[$b32[$i]]; // Add value into buffer $j = $j + 5; // Keep track of number of bits in buffer
                    if ($j >= 8) {
                        $j = $j - 8;
                        $binary .= chr(($n & (0xFF << $j)) >> $j);
                    }
                }
                echo $binary;
                return $binary;
            }
    
            public static function oath_hotp($key, $counter){
                if (strlen($key) < 8)
                    echo "error";
                    throw new Exception('Secret key is too short. Must be at least 16 base 32 characters');
    
                $bin_counter = pack('N*', 0) . pack('N*', $counter);        // Counter must be 64-bit int
                $hash    = hash_hmac ('sha1', $bin_counter, $key, true);
    
                return str_pad(self::oath_truncate($hash), self::otpLength, '0', STR_PAD_LEFT);
            }
    
            public static function verify_key($b32seed, $key, $window = 4, $useTimeStamp = true) {
                $timeStamp = self::get_timestamp();
    
                if ($useTimeStamp !== true) $timeStamp = (int)$useTimeStamp;
    
                $binarySeed = self::base32_decode($b32seed);
    
                for ($ts = $timeStamp - $window; $ts <= $timeStamp + $window; $ts++){
                    if (self::oath_hotp($binarySeed, $ts) == $key)
                        return true;
                }
                return false;
            }
    
            public static function oath_truncate($hash){
                $offset = ord($hash[19]) & 0xf;
                return (
                    ((ord($hash[$offset+0]) & 0x7f) << 24 ) |
                    ((ord($hash[$offset+1]) & 0xff) << 16 ) |
                    ((ord($hash[$offset+2]) & 0xff) << 8 ) |
                    (ord($hash[$offset+3]) & 0xff)
                ) % pow(10, self::otpLength);
            }
        }
        
        $InitalizationKey = "coralwebdesignss";                  // Set the inital key
        
        $TimeStamp    = Google2FA::get_timestamp();
        $secretkey    = Google2FA::base32_decode($InitalizationKey);    // Decode it into binary
        echo $secretkey . "<br>";
        $otp          = Google2FA::oath_hotp($secretkey, $TimeStamp);   // Get current token
        
        
        echo("Init key: $InitalizationKey\n");
        echo("Timestamp: $TimeStamp\n");
        echo("One time password: $otp\n");
    
        // Use this to verify a key as it allows for some time drift.
    
        $result = Google2FA::verify_key($InitalizationKey, "123456");
    
        var_dump($result); 
        
    ?>
   <!-- end PHP code --> 
</body>

</html>
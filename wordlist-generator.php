<?php
if(php_sapi_name() == 'cli')
{
    function writeToFile($file, $content)
    {
        $f = fopen($file, 'a+');
        if(!$f)
        {
            echo 'Error opening file!';
            exit;
        }
        fwrite($f, $content);
        fclose($f);
    }
    function generatePassword($length)
    {
        $string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{};:,./<>?';
        $output = '';
        for($i = 0; $i < $length; $i++)
        {
            $output .= $string[mt_rand(0,strlen($string)-1)];
        }
        return $output;
    }
    $red = "\033[91m";
    $blue = "\033[34m";
    $green = "\033[32m";
    echo $red."Hello, this is Wordlist generator by Riste Dimitrievski.\nGithub: https://github.com/RisteDimitrievski/wordlist-generator\n\n";
    echo $red."Use this for generator for testing purposes only.I'm not responsible for any damages that may occur while using my tool!.\n\n";
    echo "\033[31m\n";
    $filePath = readline('Enter the path to the file: ');
    $passwordLength = readline('Enter the length of the password: ');
    $passwordCount = readline('Enter the number of passwords to generate: ');
    if(!$filePath)
    {
        echo $red.'You must enter the path to the file!';
        exit;
    }
    if(!$passwordLength)
    {
        echo $red.'You must enter the length of the password!';
        exit;
    }
    if(!$passwordCount || $passwordLength < 1)
    {
        echo $red.'You must enter the number of passwords to generate!';
        exit;
    }
    echo $green."Generating passwords...\n";
    $passwords = [];
    for($i = 0; $i < $passwordCount; $i++)
    {
        $passwords[] = generatePassword($passwordLength);
    }
    echo $green."Writing passwords to file...\n";
    writeToFile($filePath, implode("\n", $passwords));
    echo $green."Done!\n";
    echo $green.'Passwords are written to '.$blue.$filePath;
}

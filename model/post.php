<?php

class post
{
    // table fields
    public $id;
    public $username;
    public $content;
    // constructor set default value
    function __construct()
    {
        $id=0;$username=$content="";
    }
}

?>
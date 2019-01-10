<?php
    /**
     * Created by PhpStorm.
     * User: smoon
     * Date: 7/20/2018
     * Time: 8:45 AM
     */

    namespace app\presenter;


    class Presenter
    {
        protected $status = false;
        protected $text = '';

        function __construct(string $status, string $text)
        {
            $this->status = $status;
            $this->text = $text;
        }

        function __toString() : string
        {

        }
    }

<?php

namespace Anax\CFlashMessage;

class CFlashMessage
{

    function __construct()
    {
        if(!isset($_SESSION['flash'])) {
        $_SESSION['flash'] = array();
        }
    }

    public function setMessage($type , $message)
    {

        $_SESSION['flash'][] = [
        'type' => $type,
        'message' => $message,
        ];
    }

    public function getMessages()
    {
        $messages = null;
        if(isset($_SESSION['flash'])) {
            foreach($_SESSION['flash'] as $flashes => $flash) {
            $type = $flash['type'];
            $message = $flash['message'];
            $messages .= "<div class='flash_{$type}'>\n";
            $messages .= "  " . $message . "\n</div>\n";
            }
        $_SESSION['flash'] = null;
        }
        return $messages;
    }

}

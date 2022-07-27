<?php

namespace app\controllers;

use yii\base\Controller;
use Pusher\Pusher;

class ChatController extends Controller
{
/**
     * Renders chat page
     * 
     * @return string
     */
    public function actionChat()
    {
        $options = [
            'cluster' => 'ap2',
            'encrypted' => true
        ];
         
        $pusher = new Pusher(
            '42894xxxx1bfbaxxxx65',
            '60cfxxxxfa4031bxxxxe',
            '45xxx07',
            $options
        );
        // Check the receive message
         
        if(isset($_POST['message']) && !empty($_POST['message'])) {
            $data = $_POST['message'];
            
            // Return the received message
            if($pusher->trigger('test_channel', 'my_event', $data)) {
                echo 'success';
            } else {
                echo 'error';
            }
        
        }
        
        return $this->renderPartial('chat');
    }
}
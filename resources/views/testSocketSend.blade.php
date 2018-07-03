<?php

        use ElephantIO\Client ;
        use ElephantIO\Engine\SocketIO\Version1X ;

        $version = new Version1X ("http://localhost:3001") ;

        $client = new Client ( $version ) ;


        $client->initialize() ;
        $client->emit("new_order" , ["name"=>"wadah" , "what"=>"whaaaaaaaaat"]) ;
        $client->close() ;
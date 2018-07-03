<?php

        use ElephantIO\Client ;
        use ElephantIO\Engine\SocketIO\Version2X ;

        $version = new Version2X ("http://localhost:3010") ;

        $client = new Client ( $version ) ;


        $client->initialize() ;
        $client->emit("new_order" , ["name"=>"wadah" , "what"=>"whaaaaaaaaat"]) ;
        $client->close() ;
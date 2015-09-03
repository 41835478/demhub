<?php
return array( 

    /*
    |--------------------------------------------------------------------------
    | oAuth Config
    |--------------------------------------------------------------------------
    */

    /**
     * Storage
     */
    'storage' => 'Session', 

    /**
     * Consumers
     */
    'consumers' => array(

        /**
         * Facebook
         */
        'Facebook' => array(
            'client_id'     => '',
            'client_secret' => '',
            'scope'         => array(),
        ),
        'Google' => array(
            'client_id'     => '518734991464-gj9nf0eiusug467n3jpsihns4pccabch.apps.googleusercontent.com',
            'client_secret' => 'ABZ_Y6W9dkw6afmew4gQSiws',
            'scope'         => array('userinfo_email', 'userinfo_profile'),
        ),
        'linkedin' => array(
            'clientId'     => '785y5med7h97c5',
            'clientSecret' => 'v911EVQopiSlQBCz',
            'redirectUri'   =>  url('http://localhost/demhub_v3/public'),
            'scope'         => 'r_basicprofile r_emailaddress',
        ),


    )

);
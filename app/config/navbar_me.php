<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',

    // Here comes the menu strcture
    'items' => [

        // This is a menu item
        'home'  => [
            'text'  => 'Home <i class="fa fa-home"></i>',
            'url'   => $this->di->get('url')->create(''),
            'title' => 'Home'
        ],


        'question' => [
            'text'  =>'Frågor <i class="fa fa-question"></i>',
            'url'   => $this->di->get('url')->create('question'),
            'title' => 'Question',

            'submenu' => [
                'items' => [

                        // This is a menu item of the submenu
                        'setupComment'  => [
                            'text'  => 'Ny fråga <i class="fa fa-plus"></i>',
                            'url'   => $this->di->get('url')->create('question/add/'),
                            'title' => 'Ny fråga'
                        ],

                    ],
                ],

        ],

        'tag'  => [
            'text'  => 'Taggar <i class="fa fa-tags"></i>',
            'url'   => $this->di->get('url')->create('tag'),
            'title' => 'Taggar',
        ],

        'users'  => [
            'text'  => 'Användare <i class="fa fa-users fa-lg"></i>',
            'url'   => $this->di->get('url')->create('users/list'),
            'title' => 'Användare',

            'submenu' => [
                'items' => [

                        // This is a menu item of the submenu
                        'changeuser'  => [
                            'text'  => 'Redigera användaren <i class="fa fa-pencil-square-o"></i>',
                            'url'   => $this->di->get('url')->create('users/update/'),
                            'title' => 'Redigera användaren'
                        ],

                    ],
                ],

        ],

        'login' => [
            'text'  =>'Logga in <i class="fa fa-sign-in"></i>',
            'url'   => $this->di->get('url')->create('authenticate/login'),
            'title' => 'Logga in'
        ],
        'logout' => [
            'text'  =>'Logga ut <i class="fa fa-sign-out"></i>',
            'url'   => $this->di->get('url')->create('authenticate/logout'),
            'title' => 'Logga ut'
        ],

        'register' => [
            'text'  =>'Registrera <i class="fa fa-plus"></i>',
            'url'   => $this->di->get('url')->create('users/register'),
            'title' => 'Registrera'
        ],

        'about' => [
            'text'  =>'Om <i class="fa fa-question"></i>',
            'url'   => $this->di->get('url')->create('about'),
            'title' => 'Om'
        ],
    ],



    /**
     * Callback tracing the current selected menu item base on scriptname
     *
     */
    'callback' => function ($url) {
        if ($url == $this->di->get('request')->getCurrentUrl(false)) {
            return true;
        }
    },



    /**
     * Callback to check if current page is a decendant of the menuitem, this check applies for those
     * menuitems that has the setting 'mark-if-parent' set to true.
     *
     */
    'is_parent' => function ($parent) {
        $route = $this->di->get('request')->getRoute();
        return !substr_compare($parent, $route, 0, strlen($parent));
    },


   /**
     * Callback to create the url, if needed, else comment out.
     *
     */
   /*
    'create_url' => function ($url) {
        return $this->di->get('url')->create($url);
    },
    */
];

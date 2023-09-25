<?php
namespace App\Helper;
class SocialMedia{
    public static function getName(){
        return [
            [
                'name' => 'Facebook',
                'icon' => 'fa fa-facebook',
                'color' => '#17A6FC',
            ],
            [
                'name' => 'Youtube',
                'icon' => 'fa fa-youtube',
                'color' => '#FF0000'
            ],
            [
                'name' => 'Twitter',
                'icon' => 'fa fa-twitter',
                'color' => '#1DA1F2'
            ],
            [
                'name' => 'Instagram',
                'icon' => 'fa fa-instagram',
                'color' => '#B406E3'
            ],
            [
                'name' => 'LinkedIn',
                'icon' => 'fa fa-linkedin',
                'color' => '#0077B5'
            ]
        ];
    }
}
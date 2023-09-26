<?php
namespace App\Helper;
class SocialMedia{
    public static function getName(){
        return [
            [
                'name' => 'Facebook',
                'icon' => 'fa fa-facebook',
                'color' => '#39569E',
            ],
            [
                'name' => 'Youtube',
                'icon' => 'fa fa-youtube',
                'color' => '#DC472E'
            ],
            [
                'name' => 'Twitter',
                'icon' => 'fa fa-twitter',
                'color' => '#52AAF4'
            ],
            [
                'name' => 'Instagram',
                'icon' => 'fa fa-instagram',
                'color' => '#C8359D'
            ],
            [
                'name' => 'LinkedIn',
                'icon' => 'fa fa-linkedin',
                'color' => '#0185AE'
            ]
        ];
    }
}
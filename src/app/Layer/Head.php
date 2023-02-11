<?php
namespace App\Layer;

use App\Models\Wishlist;

class Head {

    public $title, $desc, $keywords, $author, $mobileTitle, $appName, $countWishlist;

    public function check()
    {

        $this->controlAndDD(
            $this->title,
            'Please Enter Page Title'
        );

        $this->controlAndDD(
            $this->desc,
            'Please Enter Page Description'
        );

        $this->controlAndDD(
            $this->keywords,
            'Please Enter Page Keywords'
        );

        $this->controlAndDD(
            $this->mobileTitle,
            'Please Enter Page Mobile Title'
        );

        $this->controlAndDD(
            $this->appName,
            'Please Enter Page App Name'
        );

        $this->controlAndDD(
            $this->appName,
            'Please Enter Page App Name'
        );

        $this->controlAndDD(
            $this->countWishlist = (new Wishlist())->countWishlist(),
            '$countWishlist is undefined'
        );
    }

    private function controlAndDD($check, $message)
    {
        if (empty($check))
        {
            dd($message);
        }
    }

    public function defineHead(  $title, $desc, $keywords, $author, $mobileTitle, $appName)
    {
        $head = new Head();
        $head->title = $title;
        $head->desc = $desc;
        $head->keywords = $keywords;
        $head->mobileTitle = $mobileTitle;
        $head->appName = $appName;
        $head->author = $author;

        return $head;
    }





}

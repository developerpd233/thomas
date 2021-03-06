<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Checksite
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (env('SITE') == 'ENG') {
            //usercommission page url
            Session::put('amount', '$50');
            Session::put('amount_tax', '$59.7');
            Session::put('comm', '$25');
            Session::put('total', 50);
            Session::put('total_comm', 25);
            Session::put('curr', '$');
            //site urls
            Session::put('facebook_url', 'https://www.facebook.com/DNAsbookDigitalMarketing');
            Session::put('telegram_url', 'https://t.me/DNAsbookGl');
            Session::put('twitter_url', 'https://twitter.com/?lang=en');
            Session::put('instagram_url', 'https://www.instagram.com/dnasbookdigimarket/?fbclid=IwAR3LgDXQfRxvagyOJGn9MMdJTZtKxCtrx0XMcRQVbvHxbnDOVzL3PxShTy4');
            Session::put('youtube_url', 'https://www.youtube.com/channel/UCY6gIihF58UEZhHy5mnks5g?view_as=subscriber&fbclid=IwAR27zvtui43k6UejNaEjvW6cM3ar-DkTpl3p8XqeMmPJz9CfjWB3WR7KC38');
            //flash message for online-payment/add and active and addnew1
            Session::put('flash-message-english', 'Our monthly fees payment is $59.7(monthly fees $50 and taxes and other fees: $9.7)');
            Session::put('flash-message-french', 'Le paiement de nos frais mensuels est de 59,7 $ (frais mensuels de 50 $ et taxes et autres frais: 9,7 $)');
            Session::put('youtube_video_link', 'https://www.youtube.com/watch?v=sYqB8Gl45os&feature=youtu.be&fbclid=IwAR0RqL_twhvA6fIEKp-TLV4qdNtcdKteN6NKG9r_Io253WOKAqe_wYZX9WM');
            session::put('youtube_video_link_fr', 'https://www.youtube.com/watch?v=nmMcEircrxU&feature=youtu.be&fbclid=IwAR0cvNaU_36HcogtV_18iK45c8yDMXHnbiW3Z0bWt9QAmZ5XxCOcoWcrsuo');
            session::put('combine_eng', "You are in your trial period. You have to pay your fees before the 30th of this month to keep your account open. Our monthly fees are 59.7(monthly fees $50 and taxes and other fees: $9.7). To pay your fees");
            session::put('combine_fr', "Vous ??tes dans votre p??riode d'essai. Vous devez payer vos frais avant le 30 de ce mois pour que votre compte reste ouvert. Nos frais mensuels sont de  59,7 $  (frais mensuels de 50 $ et taxes et autres frais: 9,7 $). Pour payer vos frais");
            // this is how to
            session::put("this_is_how_eng", ' This is how to pay on Opportunity "4": ');
            session::put("this_is_link_eng", 'https://www.dnasbookdigimarket.com/pages/how-to-pay-in-opportunity-4');
            session::put("this_is_how_fr", 'Voici comment payer sur Opportunit?? "4": ');
            session::put("this_is_link_fr", 'https://www.dnasbookdigimarket.com/pages/comment-payer-en-opportunity-4');
        } else {
            //usercommission page url
            Session::put('amount', '1000F');
            Session::put('amount_tax', '1600F');
            Session::put('comm', '500F');
            Session::put('total', 1000);
            Session::put('total_comm', 500);
            Session::put('curr', 'F');
            //site urls sd
            Session::put('facebook_url', 'https://www.facebook.com/DNAsbookDigitaarketingAfrica/?modal=admin_todo_tour');
            Session::put('twitter_url', 'https://twitter.com/?lang=en');
            Session::put('instagram_url', 'https://www.instagram.com/dnasbookdigimarket/?fbclid=IwAR3LgDXQfRxvagyOJGn9MMdJTZtKxCtrx0XMcRQVbvHxbnDOVzL3PxShTy4');
            Session::put('youtube_url', 'https://www.youtube.com/channel/UCY6gIihF58UEZhHy5mnks5g?view_as=subscriber&fbclid=IwAR27zvtui43k6UejNaEjvW6cM3ar-DkTpl3p8XqeMmPJz9CfjWB3WR7KC38');
            //flash message for online-payment/add and active and addnew1
            Session::put('flash-message-english', 'Our monthly fees payment is 1600F(monthly fees 1000F and taxes and other fees: 600F)');
            Session::put('flash-message-french', 'Le paiement de nos frais mensuels est de 1600F (frais mensuels de 1000F et taxes et autres frais: 600F)');
            Session::put('youtube_video_link', 'https://www.youtube.com/watch?v=VA0bO1T9I5c&feature=youtu.be&fbclid=IwAR2rzUHpM40SMKPIKhOez403sHino86jPHOPB6hfx0S5YCJlmk03bk1Zo9g');
            session::put('youtube_video_link_fr', 'https://www.youtube.com/watch?v=RpHeXDvXM1U&feature=youtu.be&fbclid=IwAR2B4oWwZSl9rBIe6h-Lqg3FAe8hnPnubRDIUutqz_SWsLLztWnE6nZzauc');
            session::put('combine_eng', 'You are in your trial period. You have to pay your fees before the 30th of this month to keep your account open. Our monthly fees are 1600F(monthly fees 1000F and taxes and other fees: 600F). To pay your fees,');
            session::put('combine_fr', "Vous ??tes dans votre p??riode d'essai. Vous devez payer vos frais avant le 30 de ce mois pour que votre compte reste ouvert. Nos frais mensuels sont de 1600F (frais mensuels de 1000F et taxes et autres frais: 600F). Pour payer vos frais,");
            session::put('this_is_how_eng', 'This is how to pay on Opportunity "4":');
            session::put('this_is_link_eng', 'https://www.dnasbookdigimarketafrica.com/pages/how-to-pay-in-opportunity-4');
            session::put('this_is_how_fr', ' Voici comment payer sur Opportunit?? "4": ');
            session::put('this_is_link_fr', 'https://www.dnasbookdigimarketafrica.com/pages/comment-payer-sur-opportunity-4');
        }
        return $next($request);
    }
}

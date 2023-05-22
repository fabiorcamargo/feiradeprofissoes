<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\ServerSide\ActionSource;
use FacebookAds\Object\ServerSide\Content;
use FacebookAds\Object\ServerSide\CustomData;
use FacebookAds\Object\ServerSide\DeliveryCategory;
use FacebookAds\Object\ServerSide\Event;
use FacebookAds\Object\ServerSide\EventRequest;
use FacebookAds\Object\ServerSide\UserData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ConversionApiFB extends Controller
{
    
    public function geraid() {
        $data = openssl_random_pseudo_bytes(16);
    
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
    
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
      }

    public function Lead($data){

        //dd(json_decode($data));

        $caracteres_sem_acento = array(
            ' ' => '', 'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Â'=>'Z', 'Â'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
            'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
            'Ï'=>'I', 'Ñ'=>'N', 'Å'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
            'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
            'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
            'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'Å'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
            'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
            'Ä'=>'a', 'î'=>'i', 'â'=>'a', 'È'=>'s', 'È'=>'t', 'Ä'=>'A', 'Î'=>'I', 'Â'=>'A', 'È'=>'S', 'È'=>'T',
        );
        $data->city = strtolower($data->city);
        
        $data->city = strtr($data->city, $caracteres_sem_acento);
        
        $data->state = strtolower($data->state);

        if (env('APP_DEBUG') == false){
            $tempo = time();

            $page = url()->current();
            $eventid = ((string) Str::uuid());
            Cookie::queue('fbid1', $eventid, 0);
            Cookie::queue('fbtime', $tempo, 0);
            Cookie::queue('fbpage', $page, 0);

            $access_token = env('CONVERSIONS_API_ACCESS_TOKEN');
            $pixel_id = env('CONVERSIONS_API_PIXEL_ID');

            $api = Api::init(null, null, $access_token);
            $api->setLogger(new CurlLogger());

            if(isset($_COOKIE['_fbp'])){
                $fbp = $_COOKIE['_fbp'];
                $user_data = (new UserData())  
                ->setEmail(($data->email))
                ->setPhone(($data->cellphone))
                ->setLastName(($data->lastname))
                ->setFirstName(($data->name))
                ->setCities([$data->city])
                ->setState($data->state)
                ->setCountryCode("br")
                /*
                ->setStates(array("0510eddd781102030eb8860671503a28e6a37f5346de429bdd47c0a37c77cc7d"))
                ->setCountryCodes(array("885036a0da3dff3c3e05bc79bf49382b12bc5098514ed57ce0875aba1aa2c40d"))*/
                ->setClientIpAddress(isset($_SERVER['HTTP_CF_CONNECTING_IP']) ?  $_SERVER['HTTP_CF_CONNECTING_IP'] : '')
                ->setClientUserAgent($_SERVER['HTTP_USER_AGENT'])
                ->setFbc($fbp . "." . $eventid)
                ->setFbp($fbp);
            }else{
                $user_data = (new UserData())  
                ->setEmail(($data->email))
                ->setPhone(($data->cellphone))
                ->setLastName(($data->lastname))
                ->setFirstName(($data->name))
                ->setCities([$data->city])
                ->setState($data->state)
                ->setCountryCode("br")
                /*
                ->setCities(array("08809a7d1404509f5ca572eea923bad7c334d16bf92bb4ffc1e576ef34572176"))
                ->setStates(array("0510eddd781102030eb8860671503a28e6a37f5346de429bdd47c0a37c77cc7d"))
                ->setCountryCodes(array("885036a0da3dff3c3e05bc79bf49382b12bc5098514ed57ce0875aba1aa2c40d"))*/
                ->setClientIpAddress(isset($_SERVER['HTTP_CF_CONNECTING_IP']) ?  $_SERVER['HTTP_CF_CONNECTING_IP'] : '')
                ->setClientUserAgent($_SERVER['HTTP_USER_AGENT']);
            }

            $event = (new Event())
            ->setEventName("Lead")
            ->setEventTime($tempo)
            ->setUserData($user_data)
            //->setCustomData($custom_data)
            //->setActionSource("website")
            ->setEventSourceUrl($page)
            ->setEventId($eventid);
                
            $events = array();
            array_push($events, $event);
            //dd($events);

            if(env('CONVERSIONS_API_TEST') == true){
                $request = (new EventRequest($pixel_id))
                    ->setTestEventCode(env('CONVERSIONS_API_TEST_CODE'))
                    ->setEvents($events);
                }else{
                    $request = (new EventRequest($pixel_id))
                    ->setEvents($events);
                }

                $response = $request->execute();
            //dd($response);

            //header('Location: ' . $url, true, $permanent ? 301 : 302);

            unset($pixel);
            unset($token);
            unset($url);
            //exit();
            return;
        }
    }

    public function ViewContent($data){

        $object =($data);
        //dd($object->slug);
        
        if (env('APP_DEBUG') == false){
            
            $tempo = time();
            $page = url()->current();
            $eventid = Cookie::get('fbid');

            $access_token = env('CONVERSIONS_API_ACCESS_TOKEN');
            $pixel_id = env('CONVERSIONS_API_PIXEL_ID');
            

            $api = Api::init(null, null, $access_token);

            if (Auth::check()) {
                
                return;
                //die;
                if(isset($_COOKIE['_fbp'])){
                    
                    $fbp = $_COOKIE['_fbp'];
                    $user_data = (new UserData())  
                    ->setEmail((auth()->user()->email))
                    ->setPhone((auth()->user()->cellphone))
                    ->setLastName((auth()->user()->lastname))
                    ->setFirstName((auth()->user()->name))/*
                    ->setCities(array("08809a7d1404509f5ca572eea923bad7c334d16bf92bb4ffc1e576ef34572176"))
                    ->setStates(array("0510eddd781102030eb8860671503a28e6a37f5346de429bdd47c0a37c77cc7d"))
                    ->setCountryCodes(array("885036a0da3dff3c3e05bc79bf49382b12bc5098514ed57ce0875aba1aa2c40d"))*/
                    ->setClientIpAddress(isset($_SERVER['HTTP_CF_CONNECTING_IP']) ?  $_SERVER['HTTP_CF_CONNECTING_IP'] : '')
                    ->setClientUserAgent($_SERVER['HTTP_USER_AGENT'])
                    ->setFbc($fbp . "." . $eventid)
                    ->setFbp($fbp);
                    }else{
                        
                    $user_data = (new UserData())  
                    ->setEmail((auth()->user()->email))
                    ->setPhone((auth()->user()->cellphone))
                    ->setLastName((auth()->user()->lastname))
                    ->setFirstName((auth()->user()->name))/*
                    ->setCities(array("08809a7d1404509f5ca572eea923bad7c334d16bf92bb4ffc1e576ef34572176"))
                    ->setStates(array("0510eddd781102030eb8860671503a28e6a37f5346de429bdd47c0a37c77cc7d"))
                    ->setCountryCodes(array("885036a0da3dff3c3e05bc79bf49382b12bc5098514ed57ce0875aba1aa2c40d"))*/
                    ->setClientIpAddress(isset($_SERVER['HTTP_CF_CONNECTING_IP']) ?  $_SERVER['HTTP_CF_CONNECTING_IP'] : '')
                    ->setClientUserAgent($_SERVER['HTTP_USER_AGENT']);
                    }
                
            } else {
                if(isset($_COOKIE['_fbp'])){
                    
                    $fbp = $_COOKIE['_fbp'];
                    $user_data = (new UserData())  
                    ->setClientIpAddress(isset($_SERVER['HTTP_CF_CONNECTING_IP']) ?  $_SERVER['HTTP_CF_CONNECTING_IP'] : '')
                    ->setClientUserAgent($_SERVER['HTTP_USER_AGENT'])
                    ->setFbc($fbp . "." . $eventid)
                    ->setFbp($fbp);
                }else{
                    
                    $user_data = (new UserData())  
                    ->setClientIpAddress(isset($_SERVER['HTTP_CF_CONNECTING_IP']) ?  $_SERVER['HTTP_CF_CONNECTING_IP'] : '')
                    ->setClientUserAgent($_SERVER['HTTP_USER_AGENT']);
            }

        }
            
            $customdata = (new CustomData())
            ->setContentName($object->title)
            ->setContentIds($object->slug)
            ->setContentCategory($object->tag);

            $event = (new Event())
            ->setEventName("ViewContent")
            ->setEventTime($tempo)
            ->setUserData($user_data)
            ->setActionSource("website")
            ->setEventSourceUrl($page)
            ->setEventId($eventid)
            ->setCustomData($customdata);

                
            $events = array();
            array_push($events, $event);
            
            if(env('CONVERSIONS_API_TEST') == true){
                
            $request = (new EventRequest($pixel_id))
                ->setTestEventCode(env('CONVERSIONS_API_TEST_CODE'))
                ->setEvents($events);
            }else{
                
                $request = (new EventRequest($pixel_id))
                ->setEvents($events);
            }

            //dd($request);
            $response = $request->execute();
            //dd($response['events_received']);

            //header('Location: ' . $url, true, $permanent ? 301 : 302);

            unset($pixel);
            unset($token);
            unset($url);
            //exit();
            
            return ("Evento recebido: " . $response['events_received'] . " | id: " . $response['fbtrace_id']);
            
}
return;
}

public function AddToWishlist($data){

    $object =json_decode($data);
    if (env('APP_DEBUG') == false){
        $tempo = time();
        $page = url()->current();
        $eventid = Cookie::get('fbid');

        $access_token = env('CONVERSIONS_API_ACCESS_TOKEN');
        $pixel_id = env('CONVERSIONS_API_PIXEL_ID');
        

        $api = Api::init(null, null, $access_token);

        if (Auth::check()) {
            if(isset($_COOKIE['_fbp'])){
                $fbp = $_COOKIE['_fbp'];
                $user_data = (new UserData())  
                ->setEmail((auth()->user()->email))
                ->setPhone((auth()->user()->cellphone))
                ->setLastName((auth()->user()->lastname))
                ->setFirstName((auth()->user()->name))/*
                ->setCities(array("08809a7d1404509f5ca572eea923bad7c334d16bf92bb4ffc1e576ef34572176"))
                ->setStates(array("0510eddd781102030eb8860671503a28e6a37f5346de429bdd47c0a37c77cc7d"))
                ->setCountryCodes(array("885036a0da3dff3c3e05bc79bf49382b12bc5098514ed57ce0875aba1aa2c40d"))*/
                ->setClientIpAddress(isset($_SERVER['HTTP_CF_CONNECTING_IP']) ?  $_SERVER['HTTP_CF_CONNECTING_IP'] : '')
                ->setClientUserAgent($_SERVER['HTTP_USER_AGENT'])
                ->setFbc($fbp . "." . $eventid)
                ->setFbp($fbp);
                }else{
                $user_data = (new UserData())  
                ->setEmail((auth()->user()->email))
                ->setPhone((auth()->user()->cellphone))
                ->setLastName((auth()->user()->lastname))
                ->setFirstName((auth()->user()->name))/*
                ->setCities(array("08809a7d1404509f5ca572eea923bad7c334d16bf92bb4ffc1e576ef34572176"))
                ->setStates(array("0510eddd781102030eb8860671503a28e6a37f5346de429bdd47c0a37c77cc7d"))
                ->setCountryCodes(array("885036a0da3dff3c3e05bc79bf49382b12bc5098514ed57ce0875aba1aa2c40d"))*/
                ->setClientIpAddress(isset($_SERVER['HTTP_CF_CONNECTING_IP']) ?  $_SERVER['HTTP_CF_CONNECTING_IP'] : '')
                ->setClientUserAgent($_SERVER['HTTP_USER_AGENT']);
                }
            
        } else {
            if(isset($_COOKIE['_fbp'])){
                $fbp = $_COOKIE['_fbp'];
                $user_data = (new UserData())  
                ->setClientIpAddress(isset($_SERVER['HTTP_CF_CONNECTING_IP']) ?  $_SERVER['HTTP_CF_CONNECTING_IP'] : '')
                ->setClientUserAgent($_SERVER['HTTP_USER_AGENT'])
                ->setFbc($fbp . "." . $eventid)
                ->setFbp($fbp);
            }else{
                $user_data = (new UserData())  
                ->setClientIpAddress(isset($_SERVER['HTTP_CF_CONNECTING_IP']) ?  $_SERVER['HTTP_CF_CONNECTING_IP'] : '')
                ->setClientUserAgent($_SERVER['HTTP_USER_AGENT']);
        }

    }
        
        $customdata = (new CustomData())
        ->setContentName("product_$object->name")
        ->setContentIds("product_$object->id")
        ->setContentCategory(json_decode($object->tag)[0]->value);

        $event = (new Event())
        ->setEventName("AddToWishlist")
        ->setEventTime($tempo)
        ->setUserData($user_data)
        ->setActionSource("website")
        ->setEventSourceUrl($page)
        ->setEventId($eventid)
        ->setCustomData($customdata);

            
        $events = array();
        array_push($events, $event);
        
        if(env('CONVERSIONS_API_TEST') == true){
        $request = (new EventRequest($pixel_id))
            ->setTestEventCode(env('CONVERSIONS_API_TEST_CODE'))
            ->setEvents($events);
        }else{
            $request = (new EventRequest($pixel_id))
            ->setEvents($events);
        }

        //dd($request);
        $response = $request->execute();
        //dd($response['events_received']);

        //header('Location: ' . $url, true, $permanent ? 301 : 302);

        unset($pixel);
        unset($token);
        unset($url);
        //exit();
        
        return ("Evento recebido: " . $response['events_received'] . " | id: " . $response['fbtrace_id']);
        
}
return;
}

public function PageView(){

    if (env('APP_DEBUG') == false){
        $tempo = time();
        $page = url()->current();
        $eventid = Cookie::get('fbid');

        $access_token = env('CONVERSIONS_API_ACCESS_TOKEN');
        $pixel_id = env('CONVERSIONS_API_PIXEL_ID');

        $api = Api::init(null, null, $access_token);
        $api->setLogger(new CurlLogger());

        if (Auth::check()) {
            return ;
            exit();
            if(isset($_COOKIE['_fbp'])){
                $fbp = $_COOKIE['_fbp'];
                $user_data = (new UserData())  
                ->setEmail((auth()->user()->email))
                ->setPhone((auth()->user()->cellphone))
                ->setFirstName((auth()->user()->name))
                ->setLastName((auth()->user()->lastname))
                /*
                ->setCities(array("08809a7d1404509f5ca572eea923bad7c334d16bf92bb4ffc1e576ef34572176"))
                ->setStates(array("0510eddd781102030eb8860671503a28e6a37f5346de429bdd47c0a37c77cc7d"))
                ->setCountryCodes(array("885036a0da3dff3c3e05bc79bf49382b12bc5098514ed57ce0875aba1aa2c40d"))*/
                ->setClientIpAddress(isset($_SERVER['HTTP_CF_CONNECTING_IP']) ?  $_SERVER['HTTP_CF_CONNECTING_IP'] : '')
                ->setClientUserAgent($_SERVER['HTTP_USER_AGENT'])
                ->setFbc($fbp . "." . $eventid)
                ->setFbp($fbp);
                }else{
                $user_data = (new UserData())  
                ->setEmail((auth()->user()->email))
                ->setPhone((auth()->user()->cellphone))
                ->setLastName((auth()->user()->lastname))
                ->setFirstName((auth()->user()->name))/*
                ->setCities(array("08809a7d1404509f5ca572eea923bad7c334d16bf92bb4ffc1e576ef34572176"))
                ->setStates(array("0510eddd781102030eb8860671503a28e6a37f5346de429bdd47c0a37c77cc7d"))
                ->setCountryCodes(array("885036a0da3dff3c3e05bc79bf49382b12bc5098514ed57ce0875aba1aa2c40d"))*/
                ->setClientIpAddress(isset($_SERVER['HTTP_CF_CONNECTING_IP']) ?  $_SERVER['HTTP_CF_CONNECTING_IP'] : '')
                ->setClientUserAgent($_SERVER['HTTP_USER_AGENT']);
                }
            
        } else {
            if(isset($_COOKIE['_fbp'])){
                $fbp = $_COOKIE['_fbp'];
                $user_data = (new UserData())  
                ->setClientIpAddress(isset($_SERVER['HTTP_CF_CONNECTING_IP']) ?  $_SERVER['HTTP_CF_CONNECTING_IP'] : '')
                ->setClientUserAgent($_SERVER['HTTP_USER_AGENT'])
                ->setFbc($fbp . "." . $eventid)
                ->setFbp($fbp);
            }else{
                $user_data = (new UserData())  
                ->setClientIpAddress(isset($_SERVER['HTTP_CF_CONNECTING_IP']) ?  $_SERVER['HTTP_CF_CONNECTING_IP'] : '')
                ->setClientUserAgent($_SERVER['HTTP_USER_AGENT']);
        }

    }

        $event = (new Event())
        ->setEventName("PageView")
        ->setEventTime($tempo)
        ->setUserData($user_data)
        //->setCustomData($custom_data)
        //->setActionSource("website")
        ->setEventSourceUrl($page)
        ->setEventId($eventid);
            
        $events = array();
        array_push($events, $event);
        
        if(env('CONVERSIONS_API_TEST') == true){
        $request = (new EventRequest($pixel_id))
            ->setTestEventCode(env('CONVERSIONS_API_TEST_CODE'))
            ->setEvents($events);
            $response = $request->execute();
        }else{
            $request = (new EventRequest($pixel_id))
            ->setEvents($events);
            $response = $request->execute();
        }

        //dd($request);
        
        //dd($response);

        //header('Location: ' . $url, true, $permanent ? 301 : 302);

        unset($pixel);
        unset($token);
        unset($url);
        //exit();
        
        return;
        
}
return;
}

}
    @props(['page' => 'text', 'event' => 'text', 'lead' => 'json'])
    @php 
    if($event == "ViewContent"){
        $event = new App\Http\Controllers\ConversionApiFB;
        $page->tag = "premilitar";
        $event->ViewContent($page);
    }elseif($event == "AddToWishlist"){
    $event = new App\Http\Controllers\ConversionApiFB;
    $event->AddToWishlist($object);
    }elseif($event == "Lead"){
    $event = new App\Http\Controllers\ConversionApiFB;
    $event->Lead($lead);
    }elseif($event == "PageView"){
    $event = new App\Http\Controllers\ConversionApiFB;
    $event->PageView();
    };
    @endphp

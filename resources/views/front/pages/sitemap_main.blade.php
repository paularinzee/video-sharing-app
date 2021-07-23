@php
echo '<?xml version="1.0" encoding="UTF-8"?>';
@endphp
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc>{{url('/')}}</loc>
    </url>
    <url>
        <loc>{{url('/')}}</loc>
    </url>
    @foreach($pages as $page)
    <url>
        <loc>{{$page->url}}</loc>
    </url>
    @endforeach

    <url>
        <loc>{{route('trending')}}</loc>
    </url>    
    <url>
        <loc>{{route('contact')}}</loc>
    </url>
    @foreach($categories as $category)
    <url>
        <loc>{{$category->url}}</loc>
    </url> 
    @endforeach  
    
</urlset>
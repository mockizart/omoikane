<?xml version="1.0" encoding="UTF-8"?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <url>

        <loc>http://www.example.com/</loc>

        <lastmod>2005-01-01</lastmod>

        <changefreq>monthly</changefreq>

        <priority>0.8</priority>

    </url>

    @foreach($posts as $post)

        <url>
            <loc>{{ route($routeName, utf8_encode($post->slug)) }}</loc>
            <lastmod>{{ date('Y-m-d', strtotime($post->updated_at)) }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>1.0</priority>
        </url>

        @endforeach

</urlset>

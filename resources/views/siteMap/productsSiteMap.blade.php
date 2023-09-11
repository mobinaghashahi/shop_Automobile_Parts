<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    @foreach ($products as $product)
        <url>
            <loc>
                https://{{request()->getHost()}}/productDetails/{{$product->id}}
            </loc>
            <lastmod>
                @php
                    echo str_replace(' ','T',$product->updated_at)."+03:30";
                @endphp
            </lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
            <image:image>
                @if (File::exists('products/'.$product->id.'/'.$product->imageName))
                    <image:loc>
                        https://{{request()->getHost()}}/products/{{$product->id}}/{{$product->imageName}}
                    </image:loc>
                @else
                    <image:loc>
                        https://{{request()->getHost()}}/logo/notFound.png
                    </image:loc>
                @endif
                <image:caption>{{$product->name}}</image:caption>
                <image:title>{{$product->name}}</image:title>
            </image:image>
        </url>
    @endforeach
</urlset>

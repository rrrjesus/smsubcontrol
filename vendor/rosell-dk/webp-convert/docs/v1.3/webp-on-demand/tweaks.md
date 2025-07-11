# Tweaks

## Store converted images in separate folder

In most cases, you probably want the cache of converted images to be stored in their own folder rather than have them mingled with the source files.

To have have the cache folder contain a file structure mirroring the structure of the original files, you can do this:

```php
$applicationRoot = $_SERVER["DOCUMENT_ROOT"];               // If your application is not in document root, you can change accordingly.
$imageRoot = $applicationRoot . '/webp-images';             // Change to where you want the webp images to be saved
$sourceRel = substr($source, strlen($applicationRoot));
$destination = $imageRoot . $sourceRel . '.webp';
```

If your images are stored outside document root (a rare case), you can simply use the complete absolute path:
```php
$destination = $imageRoot . $source . '.webp';      // pst: $source is an absolute path, and starts with '/'
```
This will ie store a converted image in */var/www/example.com/public_html/beta/webp-images/var/www/example.com/images/logo.jpg.webp*

If your application can be configured to store outside document root, but rarely is, you can go for this structure:

```php
$docRoot = $_SERVER["DOCUMENT_ROOT"];
$imageRoot = $contentDirAbs . '/webp-images';

if (substr($source, 0, strlen($docRoot)) === $docRoot) {
    // Source file is residing inside document root.
    // We can store relative to that.
    $sourceRel = substr($source, strlen($docRoot));
    $destination = $imageRoot . '/doc-root' . $sourceRel . '.webp';
} else {
    // Source file is residing outside document root.
    // we must add complete path to structure
    $destination = $imageRoot . '/abs' . $source . '.webp';
}
```

If you do not know the application root beforehand, and thus do not know the appropriate root for the converted images, see next tweak.


## Get the application root automatically
When you want destination files to be put in their own folder, you need to know the root of the application (the folder in which the .htaccess rules resides). In most applications, you know the root. In many cases, it is simply the document root. However, if you are writing an extension, plugin or module to a framework that can be installed in a subfolder, you may have trouble finding it. Many applications have a *index.php* in the root, which can get it with `__DIR__`. However, you do not want to run an entire bootstrap each time you serve an image. Obviously, to get around this, you can place *webp-on-demand.php* in the webroot. However, some frameworks, such as Wordpress, will not allow a plugin to put a file in the root. Now, how could we determine the application root from a file inside some subdir? Here are three suggestions:

1. You could traverse parent folders until you find a file you expect to be in application root (ie a .htaccess containing the string "webp-on-demand.php"). This should work.
2. If the rules in the *.htaccess* file are generated by your application, you probably have access to the path at generation time. You can then simply put the path in the *.htaccess*, as an extra parameter to the script (or better: the relative path from document root to the application).
3. You can use the following hack:

### The hack
The idea is to grab the URL path of the image in the *.htaccess* and pass it to the script. Assuming that the URL paths always matches the file paths, we can get the application root by subtracting that relative path to source from the absolute path to source.

In *.htaccess*, we grab the url-path by appending "&url-path=$1.$2" to the rewrite rule:
```
RewriteRule ^(.*)\.(jpe?g|png)$ webp-on-demand.php?source=%{SCRIPT_FILENAME}&url-path=$1.$2 [NC,L]
```

In the script, we can then calculate the application root like this:

```php
$applicationRoot = substr($_GET['source'], 0, -strlen($_GET['url-path']));
```

## CDN
To work properly with a CDN, a "Vary Accept" header should be added when serving images. This is a declaration that the response varies with the *Accept* header (recall that we inspect *Accept* header in the .htaccess to determine if the browsers supports webp images). If this header is missing, the CDN will see no reason to cache separate images depending on the Accept header.

Add this snippet to the *.htaccess* to make webp-on-demand work with CDN's:

```
<IfModule mod_headers.c>
    SetEnvIf Request_URI "\.(jpe?g|png)" ADDVARY

    # Declare that the response varies depending on the accept header.
    # The purpose is to make CDN cache both original images and converted images.
    Header append "Vary" "Accept" env=ADDVARY
</IfModule>
```

***Note:*** When configuring the CDN, you must make sure to set it up to forward the the "Accept" header to your origin server.



## Make .htaccess route directly to existing images

There may be a performance benefit of using the *.htaccess* file to route to already converted images, instead of letting the PHP script serve it. Note however:
- If you do the routing in .htaccess, the solution will not be able to discard converted images when original images are updated.
- Performance benefit may be insignificant (*WebPConvertAndServe* class is not autoloaded when serving existing images)

Add the following to the *.htaccess* to make it route to existing converted images. Place it above the # Redirect images to webp-on-demand.php" comment. Take care of replacing [[your-base-path]] with the directory your *.htaccess* lives in (relative to document root, and [[your-destination-root]] with the directory the converted images resides.
```
    # Redirect to existing converted image (under appropriate circumstances)
    RewriteCond %{HTTP_ACCEPT} image/webp
    RewriteCond %{DOCUMENT_ROOT}/[[your-base-path]]/[[your-destination-root]]/$1.$2.webp -f
    RewriteRule ^\/?(.*)\.(jpe?g|png)$ /[[your-base-path]]/[[your-destination-root]]/$1.$2.webp [NC,T=image/webp,L]
```
*edit:* Removed the QSD flag from the RewriteRule because it is not supported in Apache < 2.4 (and it [triggers error](https://github.com/rosell-dk/webp-express/issues/155))

### Redirect with CDN support
If you are using a CDN, and want to redirect to existing images with the .htaccess, it is a good idea to add a "Vary Accept" header. This instructs the CDN that the response varies with the *Accept* header (we do not need to do that when routing to webp-on-demand.php, because the script takes care of adding this header, when appropriate.)

You can achieve redirect with CDN support with the following rules:
```
<IfModule mod_rewrite.c>

    RewriteEngine On

    # Redirect to existing converted image (under appropriate circumstances)
    RewriteCond %{HTTP_ACCEPT} image/webp
    RewriteCond %{DOCUMENT_ROOT}/[[your-base-path]]/[[your-destination-root]]/$1.$2.webp -f
    RewriteRule ^\/?(.*)\.(jpe?g|png)$ /[[your-base-path]]/[[your-destination-root]]/$1.$2.webp [NC,T=image/webp,QSD,E=WEBPACCEPT:1,L]

    # Redirect images to webp-on-demand.php (if browser supports webp)
    RewriteCond %{HTTP_ACCEPT} image/webp
    RewriteRule ^(.*)\.(jpe?g|png)$ webp-on-demand.php?source=%{SCRIPT_FILENAME}&url-path=$1.$2 [NC,L]

</IfModule>

<IfModule mod_headers.c>
    # Apache appends "REDIRECT_" in front of the environment variables, but LiteSpeed does not.
    # These next line is for Apache, in order to set environment variables without "REDIRECT_"
    SetEnvIf REDIRECT_WEBPACCEPT 1 WEBPACCEPT=1

    # Make CDN caching possible.
    # The effect is that the CDN will cache both the webp image and the jpeg/png image and return the proper
    # image to the proper clients (for this to work, make sure to set up CDN to forward the "Accept" header)
    Header append Vary Accept env=WEBPACCEPT
</IfModule>

AddType image/webp .webp
```

## Forward the querystring
By forwarding the query string, you can allow control directly from the URL. You could for example make it possible to add "?debug" to an image URL, and thereby getting a conversion report. Or make "?reconvert" force reconversion.

In order to forward the query string, you need to add this condition before the RewriteRule that redirects to *webp-on-demand.php*:
```
RewriteCond %{QUERY_STRING} (.*)
```
That condition will always be met. The side effect is that it stores the match (the complete querystring). That match will be available as %1 in the RewriteRule. So, in the RewriteRule, we will have to add "&%1" after the last argument. Here is a complete solution:
```
<IfModule mod_rewrite.c>
    RewriteEngine On

    # Redirect images to webp-on-demand.php (if browser supports webp)
    RewriteCond %{HTTP_ACCEPT} image/webp
    RewriteCond %{QUERY_STRING} (.*)
    RewriteRule ^(.*)\.(jpe?g|png)$ webp-on-demand.php?source=%{SCRIPT_FILENAME}&%1 [NC,L]
</IfModule>

AddType image/webp .webp
```

Of course, in order to *do* something with that querystring, you must use them in your *webp-on-demand.php* script. You could for example use them directly in the options array sent to the *convertAndServe()* method. To achieve the mentioned "debug" and "reconvert" features, do this:
```php
$options = [
    'show-report' => isset($_GET['debug']),
    'reconvert' => isset($_GET['reconvert']),
    'serve-original' => isset($_GET['original']),
];
```

*EDIT:*
I have just discovered a simpler way to achieve the querystring forward: The [QSA flag](https://httpd.apache.org/docs/trunk/rewrite/flags.html).
So, simply set the QSA flag in the RewriteRule, and nothing more:
```
RewriteRule ^(.*)\.(jpe?g|png)$ webp-on-demand.php?source=%{SCRIPT_FILENAME} [NC,QSA,L]
```

#WP-Nebula

A Wordpress theme starting point that utilizes many libraries and custom functions for extremely fast development by acting as a "Living Repository".

##Installation

To install, simply download the .zip, extract its contents, and upload to the /themes directory via FTP.

##Setup

- Rename theme in style.css
- Activate theme
- Make "Home" page (set as Homepage template)
- General Settings
	- Remove Tagline
	- Timezone "New York" (or appropriate timezone)
	- Week Starts On Sunday
- Reading Settings
	- Front page displays "A static page" > Front page: "Home"
	- Check "Discourage search engines from indexing this site"
- Permalinks Settings
	- Select "Post name"
- Set (at least) Primary Menu (Appearance > Menus)
- Google Analytics tracking number
- [Theme development goes here]
- Update screenshot.png
- Uncheck "Discourage search engines from indexing this site" (Reading Settings)
- Launch website
- Enable W3 Total Cache


##Recommended Plugins
These can be downloaded from Wordpress.org, or installed from the Wordpress Admin under the Plugins > Add New.
- Admin Menu Tree Page View
- Contact Form 7
- Contact Form 7 DB
- Custom Field Suite or Advanced Custom Fields
- Regenerate Thumbnails
- Reveal IDs
- W3 Total Cache
- WP-PageNavi

##Documentation

####nebula_the_excerpt()

#####Description
This function is a replacement for both the_excerpt() and get_the_excerpt() because it can be called both inside or outside the loop! This function queries the specified excerpt of the requested post and if it is empty, it looks for the content instead. Unlike the_excerpt() and get_the_excerpt(), the "Read More" text and word count can be changed on an individual basis (instead of globally).

*As of May 21, 2014 this function automatically echos (instead of returning)! Be careful when retrofitting (change function to return instead of echo)!!*

#####Usage

```html
<?php nebula_the_excerpt( $postID, $more, $length, $hellip ); ?>
```

#####Parameters

**$postID**
(optional) The post ID (integer). Used when outside the loop.
Default: *None*

**$more**
(optional) The linked string for the custom "Continue Reading" text.
Default: *None*

**$length**
(optional) How many words are pulled for the excerpt (integer).
Default: 55

**$hellip**
(optional) Whether to show an ellipses at the end of the excerpt if there are more words than the $length specifies (boolean).
Default: 0

#####Examples
To call nebula_the_excerpt() from inside the loop, or outside the loop (for current post/page)
```html
<?php nebula_the_excerpt('Read More &raquo;', 30, 1); ?>
```

To call nebula_the_excerpt() from outside the loop (for a specific post/page)
```html
<?php nebula_the_excerpt(572, 'Read More &raquo;', 30, 1); ?>
```

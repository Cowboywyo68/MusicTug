<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://underscorejs.org/underscore-min.js"></script>


<script type="text/javascript">

    var mt = {
        opt: {
            w:           $(window),
            panelContId: '#mt-container',
            panelCont:   '<div id="mt-container" class="mt-container"></div>',
            tplBody:     '<div id="mt-panel"><table><tr><td><div class="mt-white"><%= mtOrigTrack %></div><div><span><%= mtTrack %></span></div></td></tr><tr><td>by</td></tr><tr><td><div class="mt-white"><%= mtOrigAlbum %></div><div><span><%= mtAlbum %></span></div></td></tr><tr><td>on</td></tr><tr><td><div class="mt-white"><%= mtOrigArtist %></div><div><span><%= mtArtist %></span></div></td></tr></table><table><tr><td><div>Tags: <span class="<%= mtTagsStatusCls %>"><%= mtTagsStatus %></span></div></td></tr><tr><td><div>Chain:<span><%= mtChain %></span></div><div>Genre:<span><%= mtGenre %></span>, №:<span><%= mtNum %></span>, Y:<span><%= mtYear %></span>, BPM:<span><%= mtBpm %></spam></div><div>Similar:<span><%= mtSimilar %></span> (from <% _.each(mtSimilarArr, function(item, key, list) { var text = item; if (key != list.length - 1) { text += ","; } %><%= text %><% }) %>)</div></td></tr></table><table><tr><td>Lyrics: <span class="<%= mtLyricsStatusCls %>"><%= mtLyricsStatus %></span></td></tr><tr><td><div>Links:<span><a target="_blank" href="<%= mtXmlUrl %>">[XML page]</a></span><span><a target="_blank" href="<%= mtPageUrl %>">[Lyrics page]</a></span>, Length:<span><%= mtChars %></span>, </div><div>Title:<span><%= mtLyricsTitle %></span></div><div class="mt-lyrics">Text:<span class="mt-lyrics-text"><%= mtLyricsText %></span></div></td></tr></table><table><tr><td style="width:45px;">Flags:</td><td></td></tr><tr><td>Track</td><td>- <span class="<%= mtFlagsTrackCls %>"><%= mtFlagsTrack %></span></td></tr><tr><td>Artwork</td><td>- <span class="<%= mtFlagsArtCls %>"><%= mtFlagsArt %></span>, <span class="<%= mtFlagsArt2Cls %>"><%= mtFlagsArt2 %></span></td></tr><tr><td>Lyrics</td><td>- <span class="<%= mtFlagsLyricsCls %>"><%= mtFlagsLyrics %></span>, <span class="<%= mtFlagsLyrics2Cls %>"><%= mtFlagsLyrics2 %></span></td></tr><tr><td>Tags</td><td>- <span class="<%= mtFlagsTagsCls %>"><%= mtFlagsTags %></span>, <span class="<%= mtFlagsTags2Cls %>"><%= mtFlagsTags2 %></span></td></tr><tr><td>Links</td><td>-<span><a href="<%= mtDir %>" target="_blank">[DIR]</a></span>, <span><a href="<%= mtTrackDir %>" target="_blank">[Track]</a></span>, <span><a href="<%= mtAtDir %>" target="_blank">[Artwork]</a></span>, <span><a href="<%= mtLyricsDir %>" target="_blank">[Lyrics file]</a></span></td></tr></table></div>',
            cssBody:     '<style>#mt-container {position: fixed; right: 10; top: 10;} #mt-panel, #mt-panel table, #mt-panel a {color: #939393; line-height: 11px; font-size: 10px; font-family: "Lucida Console"; /*font-family: "Verdana";*/ } #mt-panel { border: 1px solid blue; width: 330px; height: 300px; background: black; padding: 4px; } #mt-panel table {width: 100%; border-collapse: collapse;} #mt-panel table, #mt-panel .pad-bot {margin-bottom: 6px;} #mt-panel table td {padding: 0;} #mt-panel span, #mt-panel span a {color: #3399FF;} #mt-panel .mt-green {color: #70FF2D;} #mt-panel .mt-red {color: #FF2D2D;} #mt-panel .mt-white {color: white;} #mt-panel .mt-lyrics { height: 22px; } #mt-panel .mt-lyrics-text { cursor: pointer; display: inline-block; height: 22px; width: 290px; overflow: hidden; vertical-align: top; padding: 0 0 0 5px; border: 1px solid #3F3F3F; } #mt-panel .mt-lyrics-text:hover { height: auto; width: 290px; max-height: 400px; overflow: scroll; background: none repeat scroll 0 0 black; position: absolute; z-index: 99;}</style>',
            tplData:     {
                mtOrigTrack:        'null',
                mtTrack:            'null',
                mtOrigAlbum:        'null',
                mtAlbum:            'null',
                mtOrigArtist:       'null',
                mtArtist:           'null',
                mtTagsStatus:       'null',
                mtTagsStatusCls:    'mt-white',
                mtChain:            'null',
                mtGenre:            'null',
                mtNum:              'null',
                mtYear:             'null',
                mtBpm:              'null',
                mtSimilar:          'null',
                mtSimilarArr:       [''],
                mtLyricsStatus:     'null',
                mtLyricsStatusCls:  'mt-white',
                mtXmlUrl:           '#',
                mtPageUrl:          '#',
                mtChars:            'null',
                mtLyricsTitle:      'null',
                mtLyricsText:       'null',
                mtFlagsTrack:       'null',
                mtFlagsTrackCls:    'mt-white',
                mtFlagsArt:         'null',
                mtFlagsArtCls:      'mt-white',
                mtFlagsLyrics:      'null',
                mtFlagsLyricsCls:   'mt-white',
                mtFlagsArt2:        'null',
                mtFlagsArt2Cls:     'mt-white',
                mtFlagsLyrics2:     'null',
                mtFlagsLyrics2Cls:  'mt-white',
                mtFlagsTags:        'null',
                mtFlagsTagsCls:     'mt-white',
                mtFlagsTags2:       'null',
                mtFlagsTags2Cls:    'mt-white',
                mtDir:              '#',
                mtTrackDir:         '#',
                mtAtDir:            '#',
                mtLyricsDir:        '#',
            },

            parsedData:  {},
        },


        init: function() {
            var _this = this;

            // Insert panel-container tag
            if ( $( '#mt-container' ).length == 0 ) {
                $( 'body' ).append( _this.opt.panelCont );
                $( 'head' ).append( _this.opt.cssBody );
            }
        },

        updatePanel: function( parsedData ) {
            var _this   = this;

            tplData = $.extend( true, {}, _this.opt.tplData, parsedData ) ;
            tpl     = _.template( _this.opt.tplBody );
            mtPanel = tpl(tplData);

            $( _this.opt.panelContId ).html( mtPanel );

            return _this;
        },

        // setParsedData: function( parsedData ) {
        //     var _this = this;
        //     _this.opt.parsedData = parsedData;
        // },
        
    };




    var parsedData = {
        mtOrigTrack:    'I\'m Not Alone (Deadmau5 Mix)',
        mtTrack:        'I\'m Not Alone (Deadmau5 Mix)',
        mtOrigAlbum:    'Calvin Harris',
        mtAlbum:        'Calvin Harris',
        mtOrigArtist:   'I\'m Not Alone (Single)',
        mtArtist:       'I\'m Not Alone (Single)',

        mtTagsStatus:   'Success',
        mtTagsStatusCls: 'mt-green',

        mtChain:        'Alternative & Punk->Trance->Trance',
        mtGenre:        'Alternative & Punk',
        mtNum:          '1',
        mtYear:         '2013',
        mtBpm:          '120',
        mtSimilar:      '93%',
        mtSimilarArr:   [65, 77, 93],
        mtLyricsStatus: 'Success',
        mtLyricsStatusCls: 'mt-green',

        mtXmlUrl:       '#',
        mtPageUrl:      '#',
        mtChars:        '1281/40',
        mtLyricsTitle:  'Calvin Harris:I\'m Not Alone (Deadmau5 Mix)',
        mtLyricsText:   'Some Lyrics Text<br> Some Lyrics Text<br> Some Lyrics Text<br> Some Lyrics Text<br> Some Lyrics Text<br> Some Lyrics Text<br> Some Lyrics Text<br> Some Lyrics Text<br> Some Lyrics Text<br> Some Lyrics Text<br> Some Lyrics Text<br> Some Lyrics Text<br> Some Lyrics Text<br> ',

        mtFlagsTrack:       'Stored',
        mtFlagsTrackCls:    'mt-green',
        mtFlagsArt:         'Stored',
        mtFlagsArtCls:      'mt-green',
        mtFlagsLyrics:      'Stored',
        mtFlagsLyricsCls:   'mt-red',
        mtFlagsArt2:        'Embed',
        mtFlagsArt2Cls:     'mt-green',
        mtFlagsLyrics2:     'Embed',
        mtFlagsLyrics2Cls:  'mt-red',
        mtFlagsTags:        'Parsed',
        mtFlagsTagsCls:     'mt-green',
        mtFlagsTags2:       'Embed',
        mtFlagsTags2Cls:    'mt-green',

        mtDir:              '#',
        mtTrackDir:         '#',
        mtAtDir:            '#',
        mtLyricsDir:        '#',
    };

    $(function() {
        mt.init();
        mt.updatePanel( parsedData );
    });
</script>








<?php
define('MT_CONFIG_FILE', 'Index.config.php');
require_once 'Include/Config.php';



$response[trackData] = array(
    title      => 'Im Not Alone (Deadmau5 Mix)',
    album      => 'Calvin Harris',
    artist     => 'Im Not Alone (Single)',
    trackUrl   => '',
    artworkUrl => 'http://3.avatars.yandex.net/get-music-content/5560c9b4.a.1606291-1/200x200',
);

$response[tagsStream] = array(
    0 => array(
        origin  => 'remote',
        opt     => array(),
        similar => '93',
        meta    => array(
            title  => 'Im Not Alone (Deadmau5 Mix)',
            album  => 'Calvin Harris',
            artist => 'Im Not Alone (Single)',
        ),
    ),
    1 => array(
        origin  => 'remote',
        opt     => array(),
        similar => '77',
        meta    => array(
            title  => 'Im Not Alone (Deadmau5 Mix)',
            album  => 'Calvin Harris',
            artist => 'Im Not Alone',
        ),
    ),
);

$response[tags] = array(
    success => true,
    chain   => 'Alternative & Punk->Trance->Trance',
    genre   => 'Alternative & Punk',
    number  => '1',
    year    => '2013',
    bpm     => '120',
    similar => '93',
    similarStr => '65, 77, 93',
);

$response[lyrics] = array(
    success => true,
    xmlUrl  => 'xmlUrl',
    textUrl => 'textUrl',
    chars   => '1281',
    rows    => '40',
    title   => 'Calvin Harris:Im Not Alone (Deadmau5 Mix)',
    text    => 'Some Lyrics Text',
);

$response[flags] = array(
    success => true,    
    track   => array(
        stored => true
    ),
    artwork => array(
        stored => true,
        embed  => true
    ),
    lyrics  => array(
        stored => false,
        embed  => false
    ),
    tags    => array(
        stored => true,
        embed  => true
    ),
);

$response[links] = array(
    dir     => 'dir',
    track   => 'track',
    artwork => 'artwork',
    lyrics  => 'lyrics',

);




dbg($response);
exit;







$trackData = array(
    'title'      => 'Hey Now',
    'album'      => 'If You Wait',
    'artist'     => 'London Grammar',
    'trackUrl'   => 'http://elisto04d.music.yandex.ru/get-mp3/07bf38af482ec38b2c6dce5f51fa7626/506963ade3b08/34/data-0.12:38452698079:4973504?track-id=14671865&play=false&experiments=%7B%22similarities%22%3A%22default%22%2C%22genreRadio%22%3A%22new-ichwill%22%2C%22newMusic%22%3A%22no%22%2C%22recommendedArtists%22%3A%22ichwill_similar_artists%22%2C%22recommendedTracks%22%3A%22recommended_tracks_by_artist_from_history%22%2C%22recommendedAlbumsOfFavoriteGenre%22%3A%22recent%22%2C%22recommendedSimilarArtists%22%3A%22default%22%2C%22recommendedArtistsWithArtistsFromHistory%22%3A%22default%22%2C%22adv%22%3A%22a%22%2C%22myMusicButton%22%3A%22yes%22%7D&from=web-artist_albums-album-track-fridge&albumId=1606291',
    'artworkUrl' => 'http://3.avatars.yandex.net/get-music-content/5560c9b4.a.1606291-1/200x200',
    
    // 'trackUrl'   => 'http://t1-2.p-cdn.com/access/?version=4&lid=946783457&token=cqf%2Bh%2BdUKV1%2BM4GARZanyUV%2BXk6ZfdmDfSeUE90%2ByDaT%2FaFexRhOhSxZD0qA28G351vbJgiKhv3303dABMMyvwZZSC0sj5MUMUTQujGHkoU29CGoniWCTX9zNILTE7puwclRvXOpA3nDGD1eWpbC0wtEIk6z1onkPn7EFtt2gPXZ7dvyfMZcPKwPF9e2nmzU3MFeS6s4TieSNbbWz1vsgXjjwlMQQFZ0jUOPbHpbD3h7h9Ih55bRksx1BD16Kab3Zb89Xcr%2BSRbnGl41NsbhhbJiD8uYI92pOoliu9KNK5XuyE1ffDJqHqdDHLlONo1XAoJIYPMhmK1ht9GHymUsZJHv8U0jR7ZZ%2FRl17DSineIzMB0%2FaIfCaEj0ms8cAjIS',
    // 'artworkUrl' => 'http://cont-dc6-2.pandora.com/images/public/amz/2/6/1/5/800015162_500W_500H.jpg',
    // 'artworkUrl' => 'http://www.queness.com/resources/images/png/apple_ex.png',
    // 'artworkUrl' => 'http://www.newyorker.com/wp-content/uploads/2012/12/Gif-1.gif',

    // 'title'      => 'Confusion (Instrumental)',
    // 'title'      => 'Confusion',
    // 'artist'     => 'New Order',

    
);

$options = array();

// $fi = new finfo(FILEINFO_MIME,'/usr/share/file/magic');
// $mime_type = $fi->buffer(file_get_contents($file));


$musicTug = new MusicTug($trackData, $options);

// $musicTug->init();

// $l = $musicTug->getTagsStream();
// $l = $musicTug->getLyricsStream();
// $l = $musicTug->getArtworkStream();
// $l = $musicTug->getTrackStream();
// $l[file] = null;
// dbg($l);

// $b = new MusicTugApi();
// $b->route('here?');
// dbg(MusicTugHelper::getConfig());
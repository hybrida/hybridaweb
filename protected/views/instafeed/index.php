<div class="instafeed">
    
    <img class="banner" alt="Instagram Feed Logo"
			 width="700"
			 src="/upc/files/images/instafeed/instafeed_logo.png" />

    <div id="instafeed-header"></div> 
    
    <h2>Bruk <b>#hybridantnu</b>, og del dine opplevelser med oss!</h2>

    <div id="instafeed-body"></div>

</div>


<script type="text/template" id="instafeed-header-template">
    <div class="header">
        <h2>-- Nyeste bilde --</h2>
        <a href="{{link}}"><img src="{{image}}" </br></br> Likes: {{likes}}</a>
    </div>
</script>

<script type="text/javascript">
    require(['instafeed'], function(insta) {
        var feed = new insta.Instafeed({
            target: 'instafeed-header',
            get: 'tagged',
            sortBy: 'most-liked',
            tagName: 'hybridantnu',
            clientId: '4607d54615d045968654b06a038c3d4d',
            template: $('#instafeed-header-template').html(),
            resolution: 'low_resolution',
            limit: 1
        });
        feed.run();
    });
</script>

<script type="text/template" id="instafeed-body-template">
    <div class="body">
        <a href="{{link}}"><img src="{{image}}" </br></br> Likes: {{likes}} </a>
    </div>
</script>

<script type="text/javascript">
    require(['instafeed'], function(insta) {
        var feed = new insta.Instafeed({
            target: 'instafeed-body',
            get: 'tagged',
            sortBy: 'random',
            tagName: 'hybridantnu',
            clientId: '4607d54615d045968654b06a038c3d4d',
            template: $('#instafeed-body-template').html()
        });
        feed.run();
    });
</script>


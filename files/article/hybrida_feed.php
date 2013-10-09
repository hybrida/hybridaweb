<img id="banner" alt="Instagram Feed Logo"
			 width="751"
			 src="/upc/files/images/instafeed/instafeed_logo.png" />


<div id="instafeedpage"></div> 

<div id="instafeed"></div>

<style>
    .instawrapper {
        float: left;
        height: 180px;
        box-shadow: 0px 0px 10px #999;
        margin-left: 5px;
        margin-right: 5px;
        margin-bottom: 10px;
        padding: 8px;
    } 
    .instawrapperbig {
        float: left;
        height: 400px;
        box-shadow: 0px 0px 10px #999;
        margin-left: 180px;
        margin-right: 100px;
        margin-bottom: 50px;
        margin-top: 10px;
        padding: 15px;
    }
    
    .instaheader {
        margin-left:60px;
    }
    
</style>

<script type="text/javascript">
    require(['instafeedpage'], function() {
        var feed = new Instafeed({
            get: 'tagged',
            sortBy: 'most-liked',
            tagName: 'hybridantnu',
            clientId: '4607d54615d045968654b06a038c3d4d',
            template: '<div class="instawrapperbig"> <div class="instaheader"> <h2>-- Nyeste bilde --</h2> </div> <a href="{{link}}"><img src="{{image}}" </br></br> Likes: {{likes}}</a> </div>',
            resolution: 'low_resolution',
            limit: 1
        });
        feed.run();
    });
</script>

<script type="text/javascript">
    require(['instafeed'], function() {
        var feed = new Instafeed({
            get: 'tagged',
            sortBy: 'random',
            tagName: 'hybridantnu',
            clientId: '4607d54615d045968654b06a038c3d4d',
            template: '<div class="instawrapper"><a href="{{link}}"><img src="{{image}}" </br></br> Likes: {{likes}} </a></div>'
        });
        feed.run();
    });
</script>

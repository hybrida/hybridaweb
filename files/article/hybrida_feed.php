<div id="article-title">
	<h1><?= $article->title ?></h1>
</div>


<div class="instawrapper" id="instafeedpage"></div> 

<div class="instawrapper" id="instafeed"></div>

<style>
    .instawrapper {
        float: left;
        height: 220px;
        box-shadow: 0px 0px 20px #999;
        margin-left: 20px;
        margin-right: 20px;
        margin-bottom: 20px;
        padding: 5px;
}
</style>

<script type="text/javascript">
    require(['instafeedpage'], function() {
        var feed = new Instafeed({
            get: 'tagged',
            sortBy: 'most-recent',
            tagName: 'hybridantnu',
            clientId: '4607d54615d045968654b06a038c3d4d',
            template: '<a href="{{link}}"><img src="{{image}}" /></a>',
            //resolution: 'low_resolution',
            limit: 1
        });
        feed.run();
    });
</script>

<script type="text/javascript">
    require(['instafeed.min'], function() {
        var feed = new Instafeed({
            get: 'tagged',
            sortBy: 'most-recent',
            tagName: 'hybridantnu',
            clientId: '4607d54615d045968654b06a038c3d4d',
            template: '<a href="{{link}}"><img src="{{image}}" /></a>'
        });
        feed.run();
    });
</script>

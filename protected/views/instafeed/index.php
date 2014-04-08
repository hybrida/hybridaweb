<div class="instafeed">

    <img class="banner" alt="Instagram Feed Logo"
			 width="700"
			 src="/upc/files/instafeed/instafeed_logo.jpg" />

    <div id="instafeed-header"></div>

    <h2>Bruk <b>#hybridantnu</b>, og del dine opplevelser med oss!</h2>

    <div id="instafeed-body" class="g-clearfix"></div>

    <input type="button" value="Neste side" class="nextPageButton g-button">

</div>


<script type="text/template" id="instafeed-header-template">
    <div class="header">
        <h2>-- Nyeste bilde --</h2>
        <a href="{{link}}">
            <img src="{{image}}" ></br>
            <i class="icon-comment icon-large"></i>   {{comments}}
            &nbsp;
            <i class="icon-heart icon-large"></i> {{likes}} </br>
        </a>
        <div class="caption">{{caption}}</div>
    </div>
</script>

<script type="text/javascript">
    require(['instafeed'], function(insta) {
        var feed = new insta.Instafeed({
            target: 'instafeed-header',
            get: 'tagged',
            sortBy: 'most-liked',
            tagName: 'hybridantnu',
            clientId: '0e3d7923e15646fdb1e1f1e6220bd852',
            template: $('#instafeed-header-template').html(),
            resolution: 'low_resolution',
            limit: 1
        });
        feed.run();
    });
</script>

<script type="text/template" id="instafeed-body-template">
    <div class="body">
        <a href="{{link}}">
            <img src="{{image}}" </br></br>
            <i class="icon-comment"></i>  {{comments}}
            <i class="icon-heart"></i>   {{likes}}
        </a>
        <div class="caption">{{caption}}</div>
    </div>
</script>

<script type="text/javascript">
    require(['instafeed'], function(insta) {
        var feed = new insta.Instafeed({
            target: 'instafeed-body',
            get: 'tagged',
            sortBy: 'most-recent',
            tagName: 'hybridantnu',
            limit: 60,
            clientId: '0e3d7923e15646fdb1e1f1e6220bd852',
            template: $('#instafeed-body-template').html()
        });

        var nextPageButton = document.getElementsByClassName("nextPageButton")[0];

        nextPageButton.addEventListener('click', function() {
            feed.next();
        });

        feed.run();
    });
</script>


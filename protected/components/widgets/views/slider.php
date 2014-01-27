           

<div id="slides">
    <?= FrontpageBanner::getBanner() ?>
    <img src="/upc/images/frontpage_banner/banner.png">
    <img src="/upc/images/frontpage_banner/banner2.png">
</div>

<script>
  $(function(){
    $("#slides").slidesjs({
      width: 1000,
      height: 250,
      play: {
      active: false,
        // [boolean] Generate the play and stop buttons.
        // You cannot use your own buttons. Sorry.
      effect: "slide",
        // [string] Can be either "slide" or "fade".
      interval: 5000,
        // [number] Time spent on each slide in milliseconds.
      auto: true,
        // [boolean] Start playing the slideshow on load.
      swap: false,
        // [boolean] show/hide stop and play buttons
      pauseOnHover: false,
        // [boolean] pause a playing slideshow on hover
      restartDelay: 2500
        // [number] restart delay on inactive slideshow
    },
    effect: {
      slide: {
        // Slide effect settings.
        speed: 2000
          // [number] Speed in milliseconds of the slide animation.
      },
      fade: {
        speed: 3000,
          // [number] Speed in milliseconds of the fade animation.
        crossfade: true
          // [boolean] Cross-fade the transition.
      }
    }
    });
  });
  
</script>


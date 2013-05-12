--- ringen_base.php
+++ ringen_base.php
@@ -1,11 +1,14 @@
+<div class="ringenSite">
+<img id="banner" alt="IKT-ringen logo"
+			 width="751" 
+			 src="/upc/files/ringen/images/banner2.png" />
 <div id="article-title">
 	<h1><?= $article->title ?></h1>
 </div>
 <div id="article-content">
-	<p>
-		<img alt="IKT-ringen logo"
-			 width="256" 
-			 src="/upc/files/ringen/images/iktlogo_planet.png" />
-	</p>
 	<?= $article->content ?>
+</div>
+
+
+
 </div>
\ No newline at end of file

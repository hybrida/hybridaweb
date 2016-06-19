<div id="article-title">
	<h1><?= $article->title ?></h1>
</div>

<div id="article-content">
	<style>

        .hele-styret {
            max-width: 100%;
        }

		.articleStyret {
			display: block;
		}

		.styremedlemmer div {
            text-align: center;
			float: left;
			width: 300px;
            height: 470px;
			margin: 10px 20px;
		}

        .styremedlemmer div:nth-child(odd):last-of-type:before {
            content: ' ';
            display: block;
            height: 1px;
            margin-top: -1px;
            clear: both;
        }
        .styremedlemmer div:nth-child(odd):last-of-type {
            clear: both;
            float: none;
            margin: 10px auto;
        }

		.styremedlemmer div img {
			display: block;
            height: 300px;
            margin: 0 auto;
		}

        .styremedlemmer div .description {
            text-align: left;
        }

	</style>

	<div class="articleStyret" >
		<img class="hele-styret" src="/upc/files/styret/artikkel/styret.jpg" alt="Hele styret" />

		<p>
			<strong>Dette er de syv styremedlemmene som per dags dato har hovedansvaret 
				for &aring; holde liv i linjeforeningen (og dens medlemmer).</strong>
		</p>

		<div class="styremedlemmer">
			<div>
				<h2>Leder</h2>
				<img src="/upc/files/styret/artikkel/leder.jpg" alt ="Leder av Hybrida" />
				<a href="/profil/martiaks">Martin Vee Akselsen</a>, 3. kl
				<div class="description">
					V&aring;r &aelig;rede leder. Har det overordnede ansvaret i Hybrida, og er rett og slett helt sjef.
				</div>
			</div>

			<div>
				<h2>Nestleder</h2>
				<img src="/upc/files/styret/artikkel/nestleder.jpg" alt ="Nestleder" />
				<a href="/profil/sigribra">Sigrid Bratsberg</a>, 3. kl
				<div class="description">
					"Samarbeider" med lederen om det organisatoriske og administrative ansvaret i 
					styret.
				</div>
			</div>

			<div>
				<h2>Skattmester</h2>
				<img src="/upc/files/styret/artikkel/skattmester.jpg" alt ="Skattmester" />
				<a href="/profil/jonasasa">Jonas Åsnes Sagild</a>, 1. kl
				<div class="description">
                    Ansvaret for pengestr&oslash;mmen inn og,
                    selvf&oslash;lgelig mest, ut. Driver i f&oslash;lge p&aring;litelige kilder
                    ikke med underslag (men man vet jo aldri).
                </div>
			</div>

			<div>
				<h2>Festivalus</h2>
				<img src="/upc/files/styret/artikkel/festivalus.jpg" alt ="Festivalus" />
				<a href="/profil/njknudse">Nora Johanne Knudsen</a>, 2. kl
				<div class="description">
					Ansvaret for det som blir arrangert av fester, turer og en hel rekke andre
					arrangementer.
				</div>
			</div>

			<div>
				<h2>Bedriftskomit&eacute;sjef</h2>
				<img src="/upc/files/styret/artikkel/bksjef.jpg" alt ="Bedkomsjef" />
				<a href="/profil/ludviglj">Ludvig Lilleby Johansson</a>, 2. kl
				<div class="description">
					Fikser og ordner med profileringen av linja og linjeforeningen utad til
					bedrifter og n&aelig;ringslivet. S&oslash;rger for at vi f&aring;r de saftigste jobbene 
					p&aring; markedet. 
				</div>
			</div>

			<div>
				<h2>Vevsjef</h2>
				<img src="/upc/files/styret/artikkel/vevsjef.jpg" alt ="Vevsjef" />
				<a href="/profil/simennje">Simen Norderud Jensen</a>, 2. kl
				<div class="description">
					Har ansvaret for utvikling og drift av nettsidene og HybridLAN, samt informasjonsflyten i
                    linjeforeningen.
				</div>
			</div>

            <div>
                <h2>Jentekomit&eacute;sjef</h2>
                <img src="/upc/files/styret/artikkel/jentekomsjef.jpg" alt ="Jentekomsjef" />
                <a href="/profil/gurogb">Guro Golberg Br&oslash;to</a>, 2. kl
                <div class="description">
                    Sjef for jentekomiteen, eller chicas united som det kalles i spania.
                    S&oslash;rger for at damene oppf&oslash;rer seg i henhold til forskriftene.
                </div>
            </div>
			<br clear="all" />
		</div>
	</div>
</div>

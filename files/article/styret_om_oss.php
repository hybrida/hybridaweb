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
				<a href="/profil/simenlil">Simen Lillehagen</a>
				, 4. kl
				<div class="description">
					Har det overordnede ansvaret i Hybrida, og er rett og slett helt sjef. 
					Glad for å ha mange jenter i styret.
				</div>
			</div>

			<div>
				<h2>Nestleder</h2>
				<img src="/upc/files/styret/artikkel/nestleder.jpg" alt ="Nestleder" />
				<a href="/profil/stephabu">Stephanie Buadu</a>
				, 2. kl
				<div class="description">
					"Samarbeider" med lederen om det organisatoriske og administrative ansvaret i 
					styret.
				</div>
			</div>

			<div>
				<h2>Skattmester</h2>
				<img src="/upc/files/styret/artikkel/skattmester.jpg" alt ="Skattmester" />
				<a href="/profil/sigribra">Sigrid Bratsberg</a>
				, 1. kl
				<div class="description">
                    Ansvaret for pengestr&oslash;mmen inn og,
                    selvfølgelig mest, ut. Driver i følge pålitelige kilder
                    ikke med underslag (men man vet jo aldri).
                </div>
			</div>

			<div>
				<h2>Festivalus</h2>
				<img src="/upc/files/styret/artikkel/festivalus.jpg" alt ="Festivalus" />
				<a href="/profil/liveja">Astrid Nerhus Dale</a>
				, 2. kl
				<div class="description">
					Ansvaret for det som blir arrangert av fester, turer og en hel rekke andre
					arrangementer. Er også daglig leder på Hybridas eksklusive bar på Moholt.  
				</div>
			</div>

			<div>
				<h2>Bedriftskomit&eacute;sjef</h2>
				<img src="/upc/files/styret/artikkel/bksjef.jpg" alt ="Bedkomsjef" />
				<a href="/profil/andreamf">Andrea Marie Festøy</a>
				, 2. kl
				<div class="description">
					Fikser og ordner med profileringen av linja og linjeforeningen utad til
					bedrifter og n&aelig;ringslivet. Sørger for at vi får de saftigste jobbene 
					på markedet. 
				</div>
			</div>

			<div>
				<h2>Vevsjef</h2>
				<img src="/upc/files/styret/artikkel/vevsjef.jpg" alt ="Vevsjef" />
				<a href="/profil/ivarhk">Ivar Haga Kr&aring;b&oslash;l</a>
				, 2. kl
				<div class="description">
					Ansvar for utvikling og drift av nettsidene, samt informasjonsflyten i
					linjeforeningen og HybridLAN. Jau.
				</div>
			</div>

            <div>
                <h2>Jentekomit&eacute;sjef</h2>
                <img src="/upc/files/styret/artikkel/jentekomsjef.jpg" alt ="Jentekomsjef" />
                <a href="/profil/helendyp">Helene Dypbukt</a>
                , 2. kl
                <div class="description">
                    Sjef for jentekomiteen, eller chicas united som det kalles i spania.
                    sørger for at damene oppfører seg i henhold.
                </div>
            </div>
			<br clear="all" />
		</div>
	</div>
</div>
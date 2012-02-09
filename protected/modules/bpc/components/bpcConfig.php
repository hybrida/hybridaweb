<?php

//Hybrida - Ingeniærvitenskap & IKT
class bpcConfig

{
	// Deres linjeforeningsid, gitt på mail fra Timini
	public static $forening = 12;

	// Deres private handshake-id, gitt på mail fra Timini
	public static $key = '27ede510ee989207365b8e9eef46309a82b8e7de';

	// Hvordan data skal returneres fra BPC. Mulige valg: Kun 'serialized_array' foreløpig, meld fra hvis noe annet er ønskelig
	public static $defaultmethod = 'serialized_array';

	// Url til server-scriptet hos BPC. Ikke endre disse til noe annet en de som står her med mindre dere får beskjed om det.
	public static $url = 'https://bpc.timini.no/bpc_testing/remote/'; // Dette er en testserver som dere kan leke med
	// public static $url = 'https://bpc.timini.no/remote/'; // Dette er produksjonsserveren

	// Utvikling - disse parameterne vil vanligvis stå som false
	public static $debug = false;
	public static $timing = false;

}
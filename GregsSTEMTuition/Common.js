//**********************************************************************************************************************
//**********************************************************************************************************************
//** GLOBAL VARIBALES
//**********************************************************************************************************************
//**********************************************************************************************************************

var g_arrayTOC = [];
var g_bCoursesPopupMenu = false;
var g_nStageNum = 1;




//**********************************************************************************************************************
//**********************************************************************************************************************
//** LOCATION
//**********************************************************************************************************************
//**********************************************************************************************************************

function GetUserLocation()
{
	let timeZoneCityToCountry = 
	{
	  "Andorra": "Andorra",
	  "Dubai": "United Arab Emirates",
	  "Kabul": "Afghanistan",
	  "Tirane": "Albania",
	  "Yerevan": "Armenia",
	  "Casey": "Antarctica",
	  "Davis": "Antarctica",
	  "Mawson": "Antarctica",
	  "Palmer": "Antarctica",
	  "Rothera": "Antarctica",
	  "Troll": "Antarctica",
	  "Vostok": "Antarctica",
	  "Buenos_Aires": "Argentina",
	  "Cordoba": "Argentina",
	  "Salta": "Argentina",
	  "Jujuy": "Argentina",
	  "Tucuman": "Argentina",
	  "Catamarca": "Argentina",
	  "La_Rioja": "Argentina",
	  "San_Juan": "Argentina",
	  "Mendoza": "Argentina",
	  "San_Luis": "Argentina",
	  "Rio_Gallegos": "Argentina",
	  "Ushuaia": "Argentina",
	  "Pago_Pago": "Samoa (American)",
	  "Vienna": "Austria",
	  "Lord_Howe": "Australia",
	  "Macquarie": "Australia",
	  "Hobart": "Australia",
	  "Melbourne": "Australia",
	  "Sydney": "Australia",
	  "Broken_Hill": "Australia",
	  "Brisbane": "Australia",
	  "Lindeman": "Australia",
	  "Adelaide": "Australia",
	  "Darwin": "Australia",
	  "Perth": "Australia",
	  "Eucla": "Australia",
	  "Baku": "Azerbaijan",
	  "Barbados": "Barbados",
	  "Dhaka": "Bangladesh",
	  "Brussels": "Belgium",
	  "Sofia": "Bulgaria",
	  "Bermuda": "Bermuda",
	  "Brunei": "Brunei",
	  "La_Paz": "Bolivia",
	  "Noronha": "Brazil",
	  "Belem": "Brazil",
	  "Fortaleza": "Brazil",
	  "Recife": "Brazil",
	  "Araguaina": "Brazil",
	  "Maceio": "Brazil",
	  "Bahia": "Brazil",
	  "Sao_Paulo": "Brazil",
	  "Campo_Grande": "Brazil",
	  "Cuiaba": "Brazil",
	  "Santarem": "Brazil",
	  "Porto_Velho": "Brazil",
	  "Boa_Vista": "Brazil",
	  "Manaus": "Brazil",
	  "Eirunepe": "Brazil",
	  "Rio_Branco": "Brazil",
	  "Thimphu": "Bhutan",
	  "Minsk": "Belarus",
	  "Belize": "Belize",
	  "St_Johns": "Canada",
	  "Halifax": "Canada",
	  "Glace_Bay": "Canada",
	  "Moncton": "Canada",
	  "Goose_Bay": "Canada",
	  "Toronto": "Canada",
	  "Nipigon": "Canada",
	  "Thunder_Bay": "Canada",
	  "Iqaluit": "Canada",
	  "Pangnirtung": "Canada",
	  "Winnipeg": "Canada",
	  "Rainy_River": "Canada",
	  "Resolute": "Canada",
	  "Rankin_Inlet": "Canada",
	  "Regina": "Canada",
	  "Swift_Current": "Canada",
	  "Edmonton": "Canada",
	  "Cambridge_Bay": "Canada",
	  "Yellowknife": "Canada",
	  "Inuvik": "Canada",
	  "Dawson_Creek": "Canada",
	  "Fort_Nelson": "Canada",
	  "Whitehorse": "Canada",
	  "Dawson": "Canada",
	  "Vancouver": "Canada",
	  "Cocos": "Cocos (Keeling) Islands",
	  "Zurich": "Switzerland",
	  "Abidjan": "Côte d'Ivoire",
	  "Rarotonga": "Cook Islands",
	  "Santiago": "Chile",
	  "Punta_Arenas": "Chile",
	  "Easter": "Chile",
	  "Shanghai": "China",
	  "Urumqi": "China",
	  "Bogota": "Colombia",
	  "Costa_Rica": "Costa Rica",
	  "Havana": "Cuba",
	  "Cape_Verde": "Cape Verde",
	  "Christmas": "Christmas Island",
	  "Nicosia": "Cyprus",
	  "Famagusta": "Cyprus",
	  "Prague": "Czech Republic",
	  "Berlin": "Germany",
	  "Copenhagen": "Denmark",
	  "Santo_Domingo": "Dominican Republic",
	  "Algiers": "Algeria",
	  "Guayaquil": "Ecuador",
	  "Galapagos": "Ecuador",
	  "Tallinn": "Estonia",
	  "Cairo": "Egypt",
	  "El_Aaiun": "Western Sahara",
	  "Madrid": "Spain",
	  "Ceuta": "Spain",
	  "Canary": "Spain",
	  "Helsinki": "Finland",
	  "Fiji": "Fiji",
	  "Stanley": "Falkland Islands",
	  "Chuuk": "Micronesia",
	  "Pohnpei": "Micronesia",
	  "Kosrae": "Micronesia",
	  "Faroe": "Faroe Islands",
	  "Paris": "France",
	  "London": "Britain (UK)",
	  "Tbilisi": "Georgia",
	  "Cayenne": "French Guiana",
	  "Gibraltar": "Gibraltar",
	  "Nuuk": "Greenland",
	  "Danmarkshavn": "Greenland",
	  "Scoresbysund": "Greenland",
	  "Thule": "Greenland",
	  "Athens": "Greece",
	  "South_Georgia": "South Georgia & the South Sandwich Islands",
	  "Guatemala": "Guatemala",
	  "Guam": "Guam",
	  "Bissau": "Guinea-Bissau",
	  "Guyana": "Guyana",
	  "Hong_Kong": "Hong Kong",
	  "Tegucigalpa": "Honduras",
	  "Port-au-Prince": "Haiti",
	  "Budapest": "Hungary",
	  "Jakarta": "Indonesia",
	  "Pontianak": "Indonesia",
	  "Makassar": "Indonesia",
	  "Jayapura": "Indonesia",
	  "Dublin": "Ireland",
	  "Jerusalem": "Israel",
	  "Kolkata": "India",
	  "Chagos": "British Indian Ocean Territory",
	  "Baghdad": "Iraq",
	  "Tehran": "Iran",
	  "Reykjavik": "Iceland",
	  "Rome": "Italy",
	  "Jamaica": "Jamaica",
	  "Amman": "Jordan",
	  "Tokyo": "Japan",
	  "Nairobi": "Kenya",
	  "Bishkek": "Kyrgyzstan",
	  "Tarawa": "Kiribati",
	  "Kanton": "Kiribati",
	  "Kiritimati": "Kiribati",
	  "Pyongyang": "Korea (North)",
	  "Seoul": "Korea (South)",
	  "Almaty": "Kazakhstan",
	  "Qyzylorda": "Kazakhstan",
	  "Qostanay": "Kazakhstan",
	  "Aqtobe": "Kazakhstan",
	  "Aqtau": "Kazakhstan",
	  "Atyrau": "Kazakhstan",
	  "Oral": "Kazakhstan",
	  "Beirut": "Lebanon",
	  "Colombo": "Sri Lanka",
	  "Monrovia": "Liberia",
	  "Vilnius": "Lithuania",
	  "Luxembourg": "Luxembourg",
	  "Riga": "Latvia",
	  "Tripoli": "Libya",
	  "Casablanca": "Morocco",
	  "Monaco": "Monaco",
	  "Chisinau": "Moldova",
	  "Majuro": "Marshall Islands",
	  "Kwajalein": "Marshall Islands",
	  "Yangon": "Myanmar (Burma)",
	  "Ulaanbaatar": "Mongolia",
	  "Hovd": "Mongolia",
	  "Choibalsan": "Mongolia",
	  "Macau": "Macau",
	  "Martinique": "Martinique",
	  "Malta": "Malta",
	  "Mauritius": "Mauritius",
	  "Maldives": "Maldives",
	  "Mexico_City": "Mexico",
	  "Cancun": "Mexico",
	  "Merida": "Mexico",
	  "Monterrey": "Mexico",
	  "Matamoros": "Mexico",
	  "Mazatlan": "Mexico",
	  "Chihuahua": "Mexico",
	  "Ojinaga": "Mexico",
	  "Hermosillo": "Mexico",
	  "Tijuana": "Mexico",
	  "Bahia_Banderas": "Mexico",
	  "Kuala_Lumpur": "Malaysia",
	  "Kuching": "Malaysia",
	  "Maputo": "Mozambique",
	  "Windhoek": "Namibia",
	  "Noumea": "New Caledonia",
	  "Norfolk": "Norfolk Island",
	  "Lagos": "Nigeria",
	  "Managua": "Nicaragua",
	  "Amsterdam": "Netherlands",
	  "Oslo": "Norway",
	  "Kathmandu": "Nepal",
	  "Nauru": "Nauru",
	  "Niue": "Niue",
	  "Auckland": "New Zealand",
	  "Chatham": "New Zealand",
	  "Panama": "Panama",
	  "Lima": "Peru",
	  "Tahiti": "French Polynesia",
	  "Marquesas": "French Polynesia",
	  "Gambier": "French Polynesia",
	  "Port_Moresby": "Papua New Guinea",
	  "Bougainville": "Papua New Guinea",
	  "Manila": "Philippines",
	  "Karachi": "Pakistan",
	  "Warsaw": "Poland",
	  "Miquelon": "St Pierre & Miquelon",
	  "Pitcairn": "Pitcairn",
	  "Puerto_Rico": "Puerto Rico",
	  "Gaza": "Palestine",
	  "Hebron": "Palestine",
	  "Lisbon": "Portugal",
	  "Madeira": "Portugal",
	  "Azores": "Portugal",
	  "Palau": "Palau",
	  "Asuncion": "Paraguay",
	  "Qatar": "Qatar",
	  "Reunion": "Réunion",
	  "Bucharest": "Romania",
	  "Belgrade": "Serbia",
	  "Kaliningrad": "Russia",
	  "Moscow": "Russia",
	  "Simferopol": "Russia",
	  "Kirov": "Russia",
	  "Volgograd": "Russia",
	  "Astrakhan": "Russia",
	  "Saratov": "Russia",
	  "Ulyanovsk": "Russia",
	  "Samara": "Russia",
	  "Yekaterinburg": "Russia",
	  "Omsk": "Russia",
	  "Novosibirsk": "Russia",
	  "Barnaul": "Russia",
	  "Tomsk": "Russia",
	  "Novokuznetsk": "Russia",
	  "Krasnoyarsk": "Russia",
	  "Irkutsk": "Russia",
	  "Chita": "Russia",
	  "Yakutsk": "Russia",
	  "Khandyga": "Russia",
	  "Vladivostok": "Russia",
	  "Ust-Nera": "Russia",
	  "Magadan": "Russia",
	  "Sakhalin": "Russia",
	  "Srednekolymsk": "Russia",
	  "Kamchatka": "Russia",
	  "Anadyr": "Russia",
	  "Riyadh": "Saudi Arabia",
	  "Guadalcanal": "Solomon Islands",
	  "Mahe": "Seychelles",
	  "Khartoum": "Sudan",
	  "Stockholm": "Sweden",
	  "Singapore": "Singapore",
	  "Paramaribo": "Suriname",
	  "Juba": "South Sudan",
	  "Sao_Tome": "Sao Tome & Principe",
	  "El_Salvador": "El Salvador",
	  "Damascus": "Syria",
	  "Grand_Turk": "Turks & Caicos Is",
	  "Ndjamena": "Chad",
	  "Kerguelen": "French Southern & Antarctic Lands",
	  "Bangkok": "Thailand",
	  "Dushanbe": "Tajikistan",
	  "Fakaofo": "Tokelau",
	  "Dili": "East Timor",
	  "Ashgabat": "Turkmenistan",
	  "Tunis": "Tunisia",
	  "Tongatapu": "Tonga",
	  "Istanbul": "Turkey",
	  "Funafuti": "Tuvalu",
	  "Taipei": "Taiwan",
	  "Kiev": "Ukraine",
	  "Uzhgorod": "Ukraine",
	  "Zaporozhye": "Ukraine",
	  "Wake": "US minor outlying islands",
	  "New_York": "United States",
	  "Detroit": "United States",
	  "Louisville": "United States",
	  "Monticello": "United States",
	  "Indianapolis": "United States",
	  "Vincennes": "United States",
	  "Winamac": "United States",
	  "Marengo": "United States",
	  "Petersburg": "United States",
	  "Vevay": "United States",
	  "Chicago": "United States",
	  "Tell_City": "United States",
	  "Knox": "United States",
	  "Menominee": "United States",
	  "Center": "United States",
	  "New_Salem": "United States",
	  "Beulah": "United States",
	  "Denver": "United States",
	  "Boise": "United States",
	  "Phoenix": "United States",
	  "Los_Angeles": "United States",
	  "Anchorage": "United States",
	  "Juneau": "United States",
	  "Sitka": "United States",
	  "Metlakatla": "United States",
	  "Yakutat": "United States",
	  "Nome": "United States",
	  "Adak": "United States",
	  "Honolulu": "United States",
	  "Montevideo": "Uruguay",
	  "Samarkand": "Uzbekistan",
	  "Tashkent": "Uzbekistan",
	  "Caracas": "Venezuela",
	  "Ho_Chi_Minh": "Vietnam",
	  "Efate": "Vanuatu",
	  "Wallis": "Wallis & Futuna",
	  "Apia": "Samoa (western)",
	  "Johannesburg": "South Africa",
	  "Antigua": "Antigua & Barbuda",
	  "Anguilla": "Anguilla",
	  "Luanda": "Angola",
	  "McMurdo": "Antarctica",
	  "DumontDUrville": "Antarctica",
	  "Syowa": "Antarctica",
	  "Aruba": "Aruba",
	  "Mariehamn": "Åland Islands",
	  "Sarajevo": "Bosnia & Herzegovina",
	  "Ouagadougou": "Burkina Faso",
	  "Bahrain": "Bahrain",
	  "Bujumbura": "Burundi",
	  "Porto-Novo": "Benin",
	  "St_Barthelemy": "St Barthelemy",
	  "Kralendijk": "Caribbean NL",
	  "Nassau": "Bahamas",
	  "Gaborone": "Botswana",
	  "Blanc-Sablon": "Canada",
	  "Atikokan": "Canada",
	  "Creston": "Canada",
	  "Kinshasa": "Congo (Dem. Rep.)",
	  "Lubumbashi": "Congo (Dem. Rep.)",
	  "Bangui": "Central African Rep.",
	  "Brazzaville": "Congo (Rep.)",
	  "Douala": "Cameroon",
	  "Curacao": "Curaçao",
	  "Busingen": "Germany",
	  "Djibouti": "Djibouti",
	  "Dominica": "Dominica",
	  "Asmara": "Eritrea",
	  "Addis_Ababa": "Ethiopia",
	  "Libreville": "Gabon",
	  "Grenada": "Grenada",
	  "Guernsey": "Guernsey",
	  "Accra": "Ghana",
	  "Banjul": "Gambia",
	  "Conakry": "Guinea",
	  "Guadeloupe": "Guadeloupe",
	  "Malabo": "Equatorial Guinea",
	  "Zagreb": "Croatia",
	  "Isle_of_Man": "Isle of Man",
	  "Jersey": "Jersey",
	  "Phnom_Penh": "Cambodia",
	  "Comoro": "Comoros",
	  "St_Kitts": "St Kitts & Nevis",
	  "Kuwait": "Kuwait",
	  "Cayman": "Cayman Islands",
	  "Vientiane": "Laos",
	  "St_Lucia": "St Lucia",
	  "Vaduz": "Liechtenstein",
	  "Maseru": "Lesotho",
	  "Podgorica": "Montenegro",
	  "Marigot": "St Martin (French)",
	  "Antananarivo": "Madagascar",
	  "Skopje": "North Macedonia",
	  "Bamako": "Mali",
	  "Saipan": "Northern Mariana Islands",
	  "Nouakchott": "Mauritania",
	  "Montserrat": "Montserrat",
	  "Blantyre": "Malawi",
	  "Niamey": "Niger",
	  "Muscat": "Oman",
	  "Kigali": "Rwanda",
	  "St_Helena": "St Helena",
	  "Ljubljana": "Slovenia",
	  "Longyearbyen": "Svalbard & Jan Mayen",
	  "Bratislava": "Slovakia",
	  "Freetown": "Sierra Leone",
	  "San_Marino": "San Marino",
	  "Dakar": "Senegal",
	  "Mogadishu": "Somalia",
	  "Lower_Princes": "St Maarten (Dutch)",
	  "Mbabane": "Eswatini (Swaziland)",
	  "Lome": "Togo",
	  "Port_of_Spain": "Trinidad & Tobago",
	  "Dar_es_Salaam": "Tanzania",
	  "Kampala": "Uganda",
	  "Midway": "US minor outlying islands",
	  "Vatican": "Vatican City",
	  "St_Vincent": "St Vincent",
	  "Tortola": "Virgin Islands (UK)",
	  "St_Thomas": "Virgin Islands (US)",
	  "Aden": "Yemen",
	  "Mayotte": "Mayotte",
	  "Lusaka": "Zambia",
	  "Harare": "Zimbabwe"
	};
	
	let strUserRegion = "";
	let strUserCity = "";
	let strUserCountry = "";
	let strUserTimeZone = "";
	
	if (Intl) 
	{
		strUserTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
		let arrayTimeZone = strUserTimeZone.split("/");
		strUserRegion = arrayTimeZone[0];
		strUserCity = arrayTimeZone[arrayTimeZone.length - 1];
		strUserCountry = timeZoneCityToCountry[strUserCity];
	}
	return {strTZ:strUserTimeZone, strCITY:strUserCity, strREGION:strUserRegion, strCOUNTRY:strUserCountry};
}

function GetUserCountry()
{
	let structUL = GetUserLocation();
	return structUL.strCOUNTRY;
}

function GetUserCity()
{
	let structUL = GetUserLocation();
	return structUL.strCITY;
}

function GetUserRegion()
{
	let structUL = GetUserLocation();
	return structUL.strREGION;
}

function GetUserTimeZone()
{
	let structUL = GetUserLocation();
	return structUL.strTZ;
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** COMMON FUNCTIONS
//**********************************************************************************************************************
//**********************************************************************************************************************

function OnBodyLoad()
{
	SetPaymentLevel();
	if (sessionStorage["web_course"] && (sessionStorage["web_course"].length > 0))
	{
		DoLogin(sessionStorage["web_course"], "web_course");
	}
}

function GenerateTryItNow()
{
	var divTryItNowHTML = document.getElementById("TryItNowHTML"),
		strHTML = "";
	
	if (divTryItNowHTML)
	{
		strHTML = strHTML.innerHTML;
		document.write(strHTML);
	}
}

function GenerateGregsEmailAddress()
{
	var strEmailAddress = "gregplants" + "@" + "bigpond" + "." + "com";
	document.write("<a class=\"Email\" id=\"Email\" href=\"mailto: " + strEmailAddress + "\">" + strEmailAddress + "</a>");
}

function GenerateGregsMobile()
{
	var strMobile = "04" + "55" + "328" + "886";
	document.write(strMobile);
}

function SpaceGap(nNumberSpaces)
{
	for (var nI = 0; nI < nNumberSpaces; nI++)
		document.write("&nbsp;");
}

var g_nLevel = 0;
						
function BuildTOC(arrayTOC, g_nLevel)
{
	var strIndent = "", nI = 0;
	
	for (nI = 0; nI < g_nLevel; nI++)
		strIndent += "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		
	for (nI = 0; nI < arrayTOC.length; nI++)
	{
		if (Array.isArray(arrayTOC[nI]))
		{
			BuildTOC(arrayTOC[nI], g_nLevel + 1);
		}
		else
		{
			document.write("<li class=\"TOCListItem\">&nbsp;&nbsp;" + strIndent + "<a class=\"TOCLink\" href=\"#" + arrayTOC[nI] + "\">" + arrayTOC[nI] + "</a></li>");
		}
	}
}

function MakeTOC(arrayTOC)
{
	if (arrayTOC.length > 0)
	{
		document.write("<ul id=\"TOCList\" class=\"TOCList\">");
		document.write("<hr class=\"TOCLine\"><h4 class=\"TOCHeading\">&nbsp;&nbsp;ON THIS PAGE</h4><hr class=\"TOCLine\">");
		BuildTOC(arrayTOC, g_nLevel);
		document.write("<hr class=\"TOCLine\"></ul>");
	}
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** POPUP MENU FUNCTIONS
//**********************************************************************************************************************
//**********************************************************************************************************************

function DoToggleCoursesPopupMenu()
{
	var strPopupName = "Courses";

	if (document.getElementsByName(strPopupName) !== null)
	{
		if (g_bCoursesPopupMenu)
		{
			document.getElementsByName(strPopupName)[0].style.display = "none";
		}
		else
		{
			document.getElementsByName(strPopupName)[0].style.display = "block";
		}
		g_bCoursesPopupMenu = !g_bCoursesPopupMenu;
	}
	else
	{
		alert("No such object with name '" + strPopupName + "'!");
	}
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** COURSE FUNCTIONS
//**********************************************************************************************************************
//**********************************************************************************************************************

var g_arrayStageBookmarks = [];
var g_nScore = 0;

function DoHighlightCurrentStageLink(strIDLink2Highlight, strIDLink2Unhighlight)
{
	let headingStage2Highlight = document.getElementById(strIDLink2Highlight);
	let headingStage2Unhighlight = document.getElementById(strIDLink2Unhighlight);
	
	if (headingStage2Highlight)
	{
		let strIDLink2Highlight = headingStage2Highlight.innerText;
		let link2Highlight = document.getElementById(strIDLink2Highlight);
		
		if (link2Highlight)
		{
			link2Highlight.style.backgroundColor = "#DDCC99";
			link2Highlight.style.color = "red";
		}
	}
	if (headingStage2Unhighlight)
	{
		let strIDLink2Unhighlight = headingStage2Unhighlight.innerText;
		let link2Unhighlight = document.getElementById(strIDLink2Unhighlight);
		
		if (link2Unhighlight)
		{
			link2Unhighlight.style.backgroundColor = "#CCBB88";
			link2Unhighlight.style.color = "navy";
		}
	}
}

function SetPaymentLevel()
{
	let strCountry = GetUserCountry();
	
	if ((strCountry == "United States") || (strCountry == "Canada") || (strCountry == "Antarctica") || (strCountry == "Australia") || 
		(strCountry == "Switzerland") || (strCountry == "Germany") || (strCountry == "Christmas Island") || (strCountry == "Denmark") || 
		(strCountry == "Spain") || (strCountry == "Finland") || (strCountry == "Falkland Islands") || (strCountry == "France") || 
		(strCountry == "Britain (UK)") || (strCountry == "Gibraltar") || (strCountry == "Greenland") || (strCountry == "Ireland") || 
		(strCountry == "Israel") || (strCountry == "Iceland") || (strCountry == "Italy") || (strCountry == "Japan") || 
		(strCountry == "Korea (South)") || (strCountry == "Luxembourg") || (strCountry == "Norfolk Island") || 
		(strCountry == "Netherlands") || (strCountry == "Norway") || (strCountry == "New Zealand") || (strCountry == "Poland") || 
		(strCountry == "Portugal") || (strCountry == "Sweden") || (strCountry == "`") || (strCountry == "Vatican City") || 
		(strCountry == "Saudi Arabia") || (strCountry == "Taiwan") || (strCountry == "Belgium") || (strCountry == "Bulgaria") || 
		(strCountry == "Bermuda") || (strCountry == "Cyprus") || (strCountry == "Czech Republic") || (strCountry == "Estonia") || 
		(strCountry == "Micronesia") || (strCountry == "Greece") || (strCountry == "Guam") || (strCountry == "Kiribati") || 
		(strCountry == "Lithuania") || (strCountry == "Latvia") || (strCountry == "Monaco") || (strCountry == "Marshall Islands") || 
		(strCountry == "Malta") || (strCountry == "Panama") || (strCountry == "Pitcairn") || (strCountry == "Puerto Rico") || 
		(strCountry == "Palau") || (strCountry == "Paraguay") || (strCountry == "Réunion") || (strCountry == "Turkey") || 
		(strCountry == "US minor outlying islands") || (strCountry == "osnia & Herzegovina") || (strCountry == "Bahrain") || 
		(strCountry == "Benin") || (strCountry == "St Barthelemy") || (strCountry == "Bahamas") || (strCountry == "Guernsey") || 
		(strCountry == "Croatia") || (strCountry == "Guadeloupe") || (strCountry == "Isle of Man") || (strCountry == "Kuwait") || 
		(strCountry == "Cayman Islands") || (strCountry == "Liechtenstein") || (strCountry == "Montenegro") || 
		(strCountry == "St Martin (French)") || (strCountry == "Northern Mariana Islands") || (strCountry == "Oman") || 
		(strCountry == "St Helena") || (strCountry == "Slovenia") || (strCountry == "Svalbard & Jan Mayen") || 
		(strCountry == "Slovakia") || (strCountry == "San Marino") || (strCountry == "St Maarten (Dutch)") ||
		(strCountry.indexOf("Virgin Islands") > -1) || (strCountry == "Mayotte"))
	{
		document.getElementById("TenDollarCountry").style.display = "block";
	}
	else if ((strCountry == "Brazil") || (strCountry == "China") || (strCountry == "Fiji") || (strCountry == "Georgia") || 
			(strCountry == "Hong Kong") || (strCountry == "Malaysia") || (strCountry == "Peru") || (strCountry == "St Pierre & Miquelon") || 
			(strCountry == "Qatar") || (strCountry == "Solomon Islands") || (strCountry == "Seychelles") || (strCountry == "Tuvalu") || 
			(strCountry == "Dominica") || (strCountry == "Grenada") || (strCountry == "St Lucia") || (strCountry == "Montserrat"))
	{
		document.getElementById("FiveDollarCountry").style.display = "block";
	}
	else if ((strCountry == "Egypt") || (strCountry == "Cuba") || (strCountry == "Moldova") || (strCountry == "Mauritius") || 
				(strCountry == "Maldives") || (strCountry == "Mexico") || (strCountry == "Thailand") || (strCountry == "Ukraine") || 
				(strCountry == "Uruguay") || (strCountry == "Venezuela") || (strCountry == "South Africa") || 
				(strCountry == "Botswana") || (strCountry == "North Macedonia") || (strCountry == "Mauritania"))
	{
		document.getElementById("OneDollarCountry").style.display = "block";
	}
	else
	{
		document.getElementById("FiftyCentCountry").style.display = "block";
	}
}

function DoLogin(strTargetPassword, strCourseName)
{
	let inputPassword = document.getElementById("password");
	let divContent = document.getElementById("course_content");
	let divLogin = document.getElementById("login");
	let divContentHeader = document.getElementById("ContentHeader");
	
	if (inputPassword && divContent && divLogin)
	{
		if ((inputPassword.value === strTargetPassword) || ((sessionStorage[strCourseName]) && (sessionStorage[strCourseName].length > 0)))
		{
			divContent.style.display = "block";
			divLogin.style.display = "none";
			sessionStorage[strCourseName] = strTargetPassword;
			if (sessionStorage["current_stage"] && (sessionStorage["current_stage"].length > 0))
			{
				//console.log("sessionStorage['current_stage'] = " + sessionStorage["current_stage"]);
				let divStage = document.getElementById(sessionStorage["current_stage"]);
				if (!divStage)
				{
					sessionStorage["current_stage"] = "Stage1";
					divStage = document.getElementById(sessionStorage["current_stage"]);
				}
				divStage.style.display = "block";
					
			}
			else if (document.getElementById('Stage1'))
			{
				//console.log("document.getElementById('Stage1') = " + document.getElementById("Stage1"));
				document.getElementById("Stage1").style.display = "block";
			}
			divContentHeader.style.display = "block";
			
			if (!sessionStorage["current_stage"] || (sessionStorage["current_stage"].length == 0))
				sessionStorage["current_stage"] = "Stage1";
								
			DoHighlightCurrentStageLink(sessionStorage["current_stage"] + "Heading", "");
		}
	}
}

function DoShowHide(strIDDiv2Show, strIDDiv2Hide)
{
	var div2Hide = document.getElementById(strIDDiv2Hide),
		div2Show = document.getElementById(strIDDiv2Show),
		strIDLink2Highlight = "", 
		strIDLink2Unhighlight = "";

	if (div2Hide)
	{
		div2Hide.style.display = "none";
		strIDLink2Unhighlight = strIDDiv2Hide + "Heading";
	}
	else
	{
		strIDLink2Unhighlight = "Stage1Heading";
	}
	if (div2Show)
	{
		div2Show.style.display = "block";
		sessionStorage["previous_stage"] = sessionStorage["current_stage"];
		sessionStorage["current_stage"] = strIDDiv2Show;
		strIDLink2Highlight = strIDDiv2Show + "Heading";
		//alert(sessionStorage["current_stage"]);
	}
	DoHighlightCurrentStageLink(strIDLink2Highlight, strIDLink2Unhighlight);
}

function DrawFirstStageButtons(strStartPage, nStageNum)
{
	g_nStageNum++;
	document.write("<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"document.location='" + strStartPage + "'\">&lt; PREVIOUS</button>&nbsp;");
	document.write("<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"DoShowHide('Stage2', 'Stage1')\">NEXT &gt;</button>");
	
	return nStageNum + 1;
}

function DrawLastStageButtons(strNextPage, nStageNum)
{	
	nStageNum--;
	document.write("<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"DoShowHide('Stage" + nStageNum.toString() + "', 'Stage" + (nStageNum - 1).toString() + "')\">&lt; PREVIOUS</button>");
	if (strNextPage.length > 0)
		document.write("&nbsp;<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"document.location='" + strNextPage+ "'\">NEXT &gt;</button>&nbsp;");
	
	return nStageNum + 1;
}

function DrawMidStageButtons(nStageNum)
{
	let nNextStageNum = nStageNum + 1;
	let nPrevStageNum = nStageNum - 1;

	document.write("<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"DoShowHide('Stage" + nPrevStageNum.toString() + "', 'Stage" + nStageNum.toString() + "')\">&lt; PREVIOUS</button>&nbsp;");
	document.write("<button type=\"button\" class=\"PreviousNextButtons\" onclick=\"DoShowHide('Stage" + nNextStageNum.toString() + "', 'Stage" + nStageNum.toString() + "')\">NEXT &gt;</button>");
	
	return nStageNum + 1;
}

function OnClickStageLink(strIDStageDiv2Show)
{
	DoShowHide(strIDStageDiv2Show, sessionStorage["current_stage"]);
}

function GenerateStageMenu()
{
	let divContentHeader = document.getElementById("ContentHeader");
	let divCourseContent = document.getElementById("course_content");

	if (divContentHeader && divCourseContent)
	{
		console.log(g_arrayStageBookmarks);
		divContentHeader.style.display = divCourseContent.style.display;
		for (let nI = 0; nI < g_arrayStageBookmarks.length; nI++)
		{
			divContentHeader.innerHTML += g_arrayStageBookmarks[nI];
		}
	}
}

function SetStageDivIDs(strStageLinkID)
{
	const divCourseContent = document.getElementById("course_content");
	
	if (divCourseContent)
	{
		let strTagName = "";
		
		for (let nI = 0; nI < divCourseContent.children.length; nI++)
		{
			strTagName = divCourseContent.children[nI].tagName;
			if (strTagName == "DIV")
			{
				divCourseContent.children[nI].id = "Stage" + (nI + 1).toString();
				
				for (let nJ = 0; nJ < divCourseContent.children[nI].children.length; nJ++)
				{
					strTagName = divCourseContent.children[nI].children[nJ].tagName;
					if (strTagName == "H2")
					{
						divCourseContent.children[nI].children[nJ].id = "Stage" + (nI + 1).toString() + "Heading";
						g_arrayStageBookmarks.push("<a href=\"#\" class=\"StageLink\" id=\"" + 
																	divCourseContent.children[nI].children[nJ].innerText +
																	"\" onclick=\"OnClickStageLink('" +
																	divCourseContent.children[nI].id + "') \">" + 
																	divCourseContent.children[nI].children[nJ].innerText + "</a>");
						break;
					}
				}
			}
		}
		GenerateStageMenu();
	}
}

function WriteAsHTMLTags(arrayLinesHTML)
{
	for (let nI = 0; nI < arrayLinesHTML.length; nI++)
	{
		document.write(arrayLinesHTML[nI]);
	}
}

function Replace(strText, strReplaceWhat, strReplaceWith)
{
	let nI = strText.indexOf(strReplaceWhat);
	
	while (nI > -1)
	{
		strText = strText.replace(strReplaceWhat, strReplaceWith);
		nI = strText.indexOf(strReplaceWhat);
	}
	return strText;
}

function GetAsHTMLCode(arrayLinesHTML)
{
	let strHTMLCode = "", strLineHTML = "";
	
	for (let nI = 0; nI < arrayLinesHTML.length; nI++)
	{
		strLineHTML = arrayLinesHTML[nI];
		strLineHTML = Replace(strLineHTML, " ", "&nbsp;&nbsp;");
		strLineHTML = Replace(strLineHTML, "<", "&lt;");
		strLineHTML = Replace(strLineHTML, ">", "&gt;");
		strLineHTML = Replace(strLineHTML, "\n", "<br/>");
		if (strLineHTML.indexOf("</script_>") > -1)
			strLineHTML = strLineHTML.replace("</script_>", "</script>")
		strHTMLCode += strLineHTML + "<br/>";
	}
	return strHTMLCode;
}

function WriteAsHTMLCode(arrayLinesHTML)
{
	document.write(GetAsHTMLCode(arrayLinesHTML) + "<br/>");
}

//**********************************************************************************************************************
//**********************************************************************************************************************
//** TEST YOURSELF FUNCTIONS
//**********************************************************************************************************************
//**********************************************************************************************************************

let g_arrayQuestions = [];

function OnClickSubmitAnswers(g_arrayQuestions)
{
	let divAnswers = document.getElementById("Answers");
	
	if (divAnswers)
	{
		GenerateAnswers(g_arrayQuestions);
		divAnswers.style.display = "block";
	}
}

function GetTryItNowCode(nQuestionNum)
{
	let divTryItNow = document.getElementById("TryItNowHTML");
	let strTryItNowCode = "";
	
	if (divTryItNow)
	{
		strTryItNowCode = divTryItNow.innerHTML;
		strTryItNowCode = strTryItNowCode.replace("id=\"TryItNowCode", "id=\"TryItNowCode" + nQuestionNum.toString());
		strTryItNowCode = strTryItNowCode.replace("id=\"TryItNowResults", "id=\"TryItNowResults" + nQuestionNum.toString());
		strTryItNowCode = strTryItNowCode.replace("OnClickButtonRun()", "OnClickButtonRun(" + nQuestionNum.toString() + ")");
		g_arrayQuestions[nQuestionNum].strID = "TryItNowCode" + nQuestionNum.toString();
	}
	return strTryItNowCode;
}

function GenerateQuestions(g_arrayQuestions)
{
	let strButton = "";
		
	document.write("<ol>");
	for (let nI = 0; nI < g_arrayQuestions.length; nI++)
	{
		document.write("<li><b>" + GetAsHTMLCode([g_arrayQuestions[nI].strQuestion]) + "</b></li>");
		if (g_arrayQuestions[nI].strType == "code")
		{
			document.write(GetTryItNowCode(nI));
		}
		else if (g_arrayQuestions[nI].strType == "multiple")
		{
			document.write("<p>");
			let strChecked = " checked";
			for (let nJ = 0; nJ < g_arrayQuestions[nI].arrayOptions.length; nJ++)
			{
				let strText = "<input type=\"radio\" name=\"Option\" id=\"Question" + nI.toString() + "_" + nJ.toString() + 
					"\"" + strChecked + "\">" + 
					"<label for=\"Question" + nI.toString() + "_" + nJ.toString() + "\">" + GetAsHTMLCode([g_arrayQuestions[nI].arrayOptions[nJ]]) + 
					"</label><br/>";
				document.write(strText);
				strChecked = "";
			}
			g_arrayQuestions[nI].strID = "Question" + nI.toString();
		}
		document.write("<br/>");
	}
	document.write("</ol><br/><input type=\"button\" value=\"SUBMIT ANSWERS\" onclick=\"OnClickSubmitAnswers(g_arrayQuestions)\">");
}

function GetYourAnswer(nQuestionNum, structQuestion)
{
	let strAnswer = "";
	let strID = "";
	let input = null;
	
	if (structQuestion.strType == "code")
	{
		input = document.getElementById(structQuestion.strID);
		if (input)
		{
			strAnswer = input.value;
		}
		else
		{
			strAnswer = "Input with ID '" + structQuestion.strID + "' not found!";
		}
	}
	else if (structQuestion.strType == "multiple")
	{
		for (let nI = 0; nI < structQuestion.arrayOptions.length; nI++)
		{
			strID = "Question" + nQuestionNum.toString() + "_" + nI.toString();
			input = document.getElementById(strID);
			if (input && input.checked)
			{
				strAnswer = structQuestion.arrayOptions[nI];
			}
		}
	}
	return strAnswer;
}

function GetTickOrCross(structQuestion)
{
	let strHTML = "<img src=\"images/Cross.png\" alt=\"images/Cross.png\" width=\"20\" style=\"position:relative;top:5px;padding-left:20px;\">";
	let strHTMLTick = "<img src=\"images/Tick.png\" alt=\"images/Tick.png\" width=\"20\" style=\"position:relative;top:5px;padding-left:20px;\">";
	
	if (structQuestion.strType == "code")
	{
		let nLastIndex = -1, nCurrentIndex = 0, nMaxIndex = 0, bValid = true;
		
		for (let nI = 0; nI < structQuestion.arrayCorrectParts.length; nI++)
		{
			if (Array.isArray(structQuestion.arrayCorrectParts[nI]))
			{
				for (let nJ = 0; nJ < structQuestion.arrayCorrectParts[nI].length; nJ++)
				{
					nCurrentIndex = structQuestion.strAnswer.indexOf(structQuestion.arrayCorrectParts[nI][nJ]);
					if (nCurrentIndex > nLastIndex)
					{
						if (nCurrentIndex > nMaxIndex)
							nMaxIndex = nCurrentIndex;
					}
					else
					{
						bValid = false;
						break;
					}
				}
				if (!bValid)
				{
					break;
				}
				else
				{
					nLastIndex = nMaxIndex;
				}
			}
			else
			{
				nCurrentIndex = structQuestion.strAnswer.indexOf(structQuestion.arrayCorrectParts[nI], nLastIndex);
				if (nCurrentIndex > nLastIndex)
				{
					nLastIndex = nCurrentIndex;
				}
				else
				{
					bValid = false;
					break;
				}
			}
		}
		/*
			name=" id=""
			name=X" id="!"
			name=X" id="! 
			
			letters, digits, hyphens, underscores, colons and periods.
			- _ : .
		*/
		bValid  = structQuestion.strAnswer.indexOf("=\" ") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"/") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"/") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"~") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"`") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"!") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"@") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"#") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"$") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"%") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"^") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"&") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"*") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"(") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\")") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"=") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"+") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"{") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"[") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"}") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"]") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"|") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"\\") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\";") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"'") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"?") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"/") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\"<") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\",") == -1;
		bValid  &= structQuestion.strAnswer.indexOf("=\">") == -1;
		
		if (bValid)
		{
			strHTML = strHTMLTick;
			g_nScore++;
		}
	}
	else if (structQuestion.strType == "multiple")
	{
		if (structQuestion.strAnswer == structQuestion.arrayOptions[structQuestion.nCorrectOption])
		{
			strHTML = strHTMLTick;
			g_nScore++;
		}
	}
	return strHTML;
}

function GenerateAnswers(g_arrayQuestions)
{
	let divAnswers = document.getElementById("Answers");
	let strAnswers = "<p><h3><u>CORRECT ANSWERS</u></h3>";
	
	if (divAnswers)
	{
		for (let nI = 0; nI < g_arrayQuestions.length; nI++)
		{
			strAnswers += "<b>" + (nI + 1).toString() + ". </b>";
			if (g_arrayQuestions[nI].strType == "code")
			{
				strAnswers += GetAsHTMLCode([g_arrayQuestions[nI].strCorrectAnswer]) + "<br/><br/>";
			}
			else if (g_arrayQuestions[nI].strType == "multiple")
			{
				strAnswers += g_arrayQuestions[nI].arrayOptions[g_arrayQuestions[nI].nCorrectOption] + "<br/><br/>";
			}
			g_arrayQuestions[nI].strAnswer = GetYourAnswer(nI, g_arrayQuestions[nI]);
			strAnswers += "<b style=\"color:red;\">YOUR ANSWER: </b>" + GetAsHTMLCode(g_arrayQuestions[nI].strAnswer) + 
						GetTickOrCross(g_arrayQuestions[nI]) + "<br/><br/><hr><br/>";
		}
		strAnswers += "<p><b style=\"color:red;\">YOUR SCORE: </b><b>" + g_nScore.toString() + " / " + 
			g_arrayQuestions.length.toString() + "</b> or <b>" + ((g_nScore * 100)/ g_arrayQuestions.length).toString() + 
			"%</b></p>";
		divAnswers.innerHTML = strAnswers + "</p>";
		g_nScore = 0;
	}
}

function OnClickButtonRun(nQuestionNum)
{
	let textareaTryItNowCode = document.getElementById("TryItNowCode" + nQuestionNum.toString());
	let iframeTryItNowResults = document.getElementById("TryItNowResults" + nQuestionNum.toString());
	
	if (textareaTryItNowCode && iframeTryItNowResults)
	{
		g_arrayQuestions[nQuestionNum].strAnswer = textareaTryItNowCode.value;
		iframeTryItNowResults.srcdoc = textareaTryItNowCode.value;
	}
}


<?php
class Select
{
	/*
		This class contains a method that generates a select tag and methods that generate options for the select element
	*/
	public function createSelectTag($sel_name, $sel_opts, $selected_opt, $class_name="")
	{
	/*	This method accepts 4 arguments and generates an HTML select tag:
	*	1.  name of the select element
	*	2. array containing the options 
	*	3. default selected value
	*	4. class name
	*/	
		$html = '<select name="'.$sel_name.'" id="'.$sel_name.'" '; 
		if ($class_name) {
			$html .= 'class="'.$class_name.'"';
		}
		$html .= ' >'."\n";
		if ($selected_opt) {
			$html .= '<option value="'.$selected_opt.'" selected="selected">'.
					 $selected_opt.'</option>'."\n";
		}
		foreach($sel_opts as $option) {
			$html .=  '<option value="'.$option.'" >'.$option.'</option>'."\n";
		}
		$html .= '</select>';
		return $html;
	}
	
	public function selectElement($sel_val,$selections)
	{
		//  accepts a value ($sel_val) and searches that value in the accepted array ($selections)
		foreach ($selections as $key=>$value) {
			if ($sel_val == $value) {
//				$index = ++$key;
//				break;
				return ++$key;
			}
		}
		return false;
//		return $index;
	}
	
	public function fillNumericOptions($start, $end)
	{  /*    accepts a starting number and an ending number and creates an array of numbers within the
		*   range of the accepted numbers
		*/
		$k = 0;
		$sel_opts = array();
		for ($i=$start; $i <= $end; $i++) {
			$sel_opts[$k++] = $i;
 		}
		return $sel_opts;
	}
	
	public function fillMonthOptions()
	{
		$month_opts = array ("Jan","Feb","Mar","Apr","May","Jun",
						 "Jul","Aug","Sep","Oct","Nov","Dec");
		return $month_opts;
	}
  
    public function fillCountryOptions()
	{
		$country_opts = array (
		"AD" => "Andorra",
		"AE" => "United Arab Emirates",
		"AF" => "Afghanistan",
		"AG" => "Antigua and Barbuda",
		"AI" => "Anguilla",
		"AL" => "Albania",
		"AM" => "Armenia",
		"AN" => "Netherlands Antilles",
		"AO" => "Angola",
		"AQ" => "Antarctica",
		"AR" => "Argentina",
		"AS" => "American Samoa",
		"AT" => "Austria",
		"AU" => "Australia",
		"AW" => "Aruba",
		"AZ" => "Azerbaijan",
		"BA" => "Bosnia and Herzegovina",
		"BB" => "Barbados",
		"BD" => "Bangladesh",
		"BE" => "Belgium",
		"BF" => "Burkina Faso",
		"BG" => "Bulgaria",
		"BH" => "Bahrain",
		"BI" => "Burundi",
		"BJ" => "Benin",
		"BM" => "Bermuda",
		"BN" => "Brunei Darussalam",
		"BO" => "Bolivia",
		"BR" => "Brazil",
		"BS" => "Bahamas",
		"BT" => "Bhutan",
		"BV" => "Bouvet Island",
		"BW" => "Botswana",
		"BY" => "Belarus",
		"BZ" => "Belize",
		"CA" => "Canada",
		"CC" => "Cocos (Keeling) Islands",
		"CF" => "Central African Republic",
		"CG" => "Congo",
		"CH" => "Switzerland",
		"CI" => "Cote D'Ivoire (Ivory Coast)",
		"CK" => "Cook Islands",
		"CL" => "Chile",
		"CM" => "Cameroon",
		"CN" => "China",
		"CO" => "Colombia",
		"CR" => "Costa Rica",
		"CS" => "Czechoslovakia (former)",
		"CU" => "Cuba",
		"CV" => "Cape Verde",
		"CX" => "Christmas Island",
		"CY" => "Cyprus",
		"CZ" => "Czech Republic",
		"DE" => "Germany",
		"DJ" => "Djibouti",
		"DK" => "Denmark",
		"DM" => "Dominica",
		"DO" => "Dominican Republic",
		"DZ" => "Algeria",
		"EC" => "Ecuador",
		"EE" => "Estonia",
		"EG" => "Egypt",
		"EH" => "Western Sahara",
		"ER" => "Eritrea",
		"ES" => "Spain",
		"ET" => "Ethiopia",
		"FI" => "Finland",
		"FJ" => "Fiji",
		"FK" => "Falkland Islands (Malvinas)",
		"FM" => "Micronesia",
		"FO" => "Faroe Islands",
		"FR" => "France",
		"FX" => "France, Metropolitan",
		"GA" => "Gabon",
		"GB" => "Great Britain (UK)",
		"GD" => "Grenada",
		"GE" => "Georgia",
		"GF" => "French Guiana",
		"GH" => "Ghana",
		"GI" => "Gibraltar",
		"GL" => "Greenland",
		"GM" => "Gambia",
		"GN" => "Guinea",
		"GP" => "Guadeloupe",
		"GQ" => "Equatorial Guinea",
		"GR" => "Greece",
		"GS" => "S. Georgia and S. Sandwich Isls.",
		"GT" => "Guatemala",
		"GU" => "Guam",
		"GW" => "Guinea-Bissau",
		"GY" => "Guyana",
		"HK" => "Hong Kong",
		"HM" => "Heard and McDonald Islands",
		"HN" => "Honduras",
		"HR" => "Croatia (Hrvatska)",
		"HT" => "Haiti",
		"HU" => "Hungary",
		"ID" => "Indonesia",
		"IE" => "Ireland",
		"IL" => "Israel",
		"IN" => "India",
		"IO" => "British Indian Ocean Territory",
		"IQ" => "Iraq",
		"IR" => "Iran",
		"IS" => "Iceland",
		"IT" => "Italy",
		"JM" => "Jamaica",
		"JO" => "Jordan",
		"JP" => "Japan",
		"KE" => "Kenya",
		"KG" => "Kyrgyzstan",
		"KH" => "Cambodia",
		"KI" => "Kiribati",
		"KM" => "Comoros",
		"KN" => "Saint Kitts and Nevis",
		"KP" => "Korea (North)",
		"KR" => "Korea (South)",
		"KW" => "Kuwait",
		"KY" => "Cayman Islands",
		"KZ" => "Kazakhstan",
		"LA" => "Laos",
		"LB" => "Lebanon",
		"LC" => "Saint Lucia",
		"LI" => "Liechtenstein",
		"LK" => "Sri Lanka",
		"LR" => "Liberia",
		"LS" => "Lesotho",
		"LT" => "Lithuania",
		"LU" => "Luxembourg",
		"LV" => "Latvia",
		"LY" => "Libya",
		"MA" => "Morocco",
		"MC" => "Monaco",
		"MD" => "Moldova",
		"MG" => "Madagascar",
		"MH" => "Marshall Islands",
		"MK" => "Macedonia",
		"ML" => "Mali",
		"MM" => "Myanmar",
		"MN" => "Mongolia",
		"MO" => "Macau",
		"MP" => "Northern Mariana Islands",
		"MQ" => "Martinique",
		"MR" => "Mauritania",
		"MS" => "Montserrat",
		"MT" => "Malta",
		"MU" => "Mauritius",
		"MV" => "Maldives",
		"MW" => "Malawi",
		"MX" => "Mexico",
		"MY" => "Malaysia",
		"MZ" => "Mozambique",
		"NA" => "Namibia",
		"NC" => "New Caledonia",
		"NE" => "Niger",
		"NF" => "Norfolk Island",
		"NG" => "Nigeria",
		"NI" => "Nicaragua",
		"NL" => "Netherlands",
		"NO" => "Norway",
		"NP" => "Nepal",
		"NR" => "Nauru",
		"NT" => "Neutral Zone",
		"NU" => "Niue",
		"NZ" => "New Zealand (Aotearoa)",
		"OM" => "Oman",
		"PA" => "Panama",
		"PE" => "Peru",
		"PF" => "French Polynesia",
		"PG" => "Papua New Guinea",
		"PH" => "Philippines",
		"PK" => "Pakistan",
		"PL" => "Poland",
		"PM" => "St. Pierre and Miquelon",
		"PN" => "Pitcairn",
		"PR" => "Puerto Rico",
		"PT" => "Portugal",
		"PW" => "Palau",
		"PY" => "Paraguay",
		"QA" => "Qatar",
		"RE" => "Reunion",
		"RO" => "Romania",
		"RU" => "Russian Federation",
		"RW" => "Rwanda",
		"SA" => "Saudi Arabia",
		"Sb" => "Solomon Islands",
		"SC" => "Seychelles",
		"SD" => "Sudan",
		"SE" => "Sweden",
		"SG" => "Singapore",
		"SH" => "St. Helena",
		"SI" => "Slovenia",
		"SJ" => "Svalbard and Jan Mayen Islands",
		"SK" => "Slovak Republic",
		"SL" => "Sierra Leone",
		"SM" => "San Marino",
		"SN" => "Senegal",
		"SO" => "Somalia",
		"SR" => "Suriname",
		"ST" => "Sao Tome and Principe",
		"SU" => "USSR (former)",
		"SV" => "El Salvador",
		"SY" => "Syria",
		"SZ" => "Swaziland",
		"TC" => "Turks and Caicos Islands",
		"TD" => "Chad",
		"TF" => "French Southern Territories",
		"TG" => "Togo",
		"TH" => "Thailand",
		"TJ" => "Tajikistan",
		"TK" => "Tokelau",
		"TM" => "Turkmenistan",
		"TN" => "Tunisia",
		"TO" => "Tonga",
		"TP" => "East Timor",
		"TR" => "Turkey",
		"TT" => "Trinidad and Tobago",
		"TV" => "Tuvalu",
		"TW" => "Taiwan",
		"TZ" => "Tanzania",
		"UA" => "Ukraine",
		"UG" => "Uganda",
		"UK" => "United Kingdom",
		"UM" => "US Minor Outlying Islands",
		"US" => "United States",
		"UY" => "Uruguay",
		"UZ" => "Uzbekistan",
		"VA" => "Vatican City State (Holy See)",
		"VC" => "Saint Vincent and the Grenadines",
		"VE" => "Venezuela",
		"VG" => "Virgin Islands (British)",
		"VI" => "Virgin Islands (U.S.)",
		"VN" => "Viet Nam",
		"VU" => "Vanuatu",
		"WF" => "Wallis and Futuna Islands",
		"WS" => "Samoa",
		"YE" => "Yemen",
		"YT" => "Mayotte",
		"YU" => "Yugoslavia",
		"ZA" => "South Africa",
		"ZM" => "Zambia",
		"ZR" => "Zaire",
		"ZW" => "Zimbabwe");
		return $country_opts;
	}
}
?>
<?php

namespace App\Http\Controllers;


use Acme\Client;
use App\Mail\FeedbackMail;
use Illuminate\Http\Client\HttpClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Symfony\Component\BrowserKit\Exception\RuntimeException;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpKernel\HttpClientKernel;

class AppController extends Controller
{
    public $sources = [
        [
            "name"=> "Adi Dravida",
            "country"=> "India",
            "language"=> "Tamil",
            "religion"=> "Hinduism",
            "population"=> 8753000,
            "christian"=> 0.00095,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16164"
        ],
        [
            "name"=> "Afghan, Tajik",
            "country"=> "Afghanistan",
            "language"=> "Dari",
            "religion"=> "Islam",
            "population"=> 11598000,
            "christian"=> 0.0001,
            "window"=> "Yes",
            "region"=> "AF",
            "people_id"=> 14372
        ],
        [
            "name"=> "Ahar",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1734000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16184"
        ],
        [
            "name"=> "Aimaq",
            "country"=> "Afghanistan",
            "language"=> "Aimaq",
            "religion"=> "Islam",
            "population"=> 1730000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "AF",
            "people_id"=> "21454"
        ],
        [
            "name"=> "Alawite",
            "country"=> "Syria",
            "language"=> "Arabic, Levantine",
            "religion"=> "Islam",
            "population"=> 1674000,
            "christian"=> 0.00021,
            "window"=> "Yes",
            "region"=> "SY",
            "people_id"=> "18805"
        ],
        [
            "name"=> "Algerian, Arabic-speaking",
            "country"=> "Algeria",
            "language"=> "Arabic, Algerian Spoken",
            "religion"=> "Islam",
            "population"=> 33118000,
            "christian"=> 8.999999999999999e-05,
            "window"=> "Yes",
            "region"=> "AG",
            "people_id"=> 10379
        ],
        [
            "name"=> "Algerian, Arabic-speaking",
            "country"=> "Egypt",
            "language"=> "Arabic, Algerian Spoken",
            "religion"=> "Islam",
            "population"=> 2027000,
            "christian"=> 0.00018999999999999998,
            "window"=> "Yes",
            "region"=> "EG",
            "people_id"=> "10379"
        ],
        [
            "name"=> "Ansari",
            "country"=> "India",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 12713000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16221"
        ],
        [
            "name"=> "Ansari",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 4950000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "16221"
        ],
        [
            "name"=> "Arab, Bedouin",
            "country"=> "Jordan",
            "language"=> "Arabic, Eastern Egyptian Bedawi Spoken",
            "religion"=> "Islam",
            "population"=> 1535000,
            "christian"=> 0.0001,
            "window"=> "Yes",
            "region"=> "JO",
            "people_id"=> "10758"
        ],
        [
            "name"=> "Arab, Bedouin",
            "country"=> "Saudi Arabia",
            "language"=> "Arabic, Najdi Spoken",
            "religion"=> "Islam",
            "population"=> 1402000,
            "christian"=> 0.0009,
            "window"=> "Yes",
            "region"=> "SA",
            "people_id"=> "10758"
        ],
        [
            "name"=> "Arab, Cyrenaican",
            "country"=> "Libya",
            "language"=> "Arabic, Libyan Spoken",
            "religion"=> "Islam",
            "population"=> 1460000,
            "christian"=> 0.001,
            "window"=> "Yes",
            "region"=> "LY",
            "people_id"=> "11454"
        ],
        [
            "name"=> "Arab, Hadrami",
            "country"=> "Yemen",
            "language"=> "Arabic, Hadrami Spoken",
            "religion"=> "Islam",
            "population"=> 2200000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "YM",
            "people_id"=> "12029"
        ],
        [
            "name"=> "Arab, Libyan",
            "country"=> "Libya",
            "language"=> "Arabic, Libyan Spoken",
            "religion"=> "Islam",
            "population"=> 1594000,
            "christian"=> 0.001,
            "window"=> "Yes",
            "region"=> "LY",
            "people_id"=> "13169"
        ],
        [
            "name"=> "Arab, Moroccan",
            "country"=> "Egypt",
            "language"=> "Arabic, Moroccan Spoken",
            "religion"=> "Islam",
            "population"=> 1981000,
            "christian"=> 0.0004,
            "window"=> "Yes",
            "region"=> "EG",
            "people_id"=> "13819"
        ],
        [
            "name"=> "Arab, Moroccan",
            "country"=> "Morocco",
            "language"=> "Arabic, Moroccan Spoken",
            "religion"=> "Islam",
            "population"=> 24511000,
            "christian"=> 0.0009,
            "window"=> "Yes",
            "region"=> "MO",
            "people_id"=> "13819"
        ],
        [
            "name"=> "Arab, Northern Yemeni",
            "country"=> "Yemen",
            "language"=> "Arabic, Sanaani Spoken",
            "religion"=> "Islam",
            "population"=> 15004000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "YM",
            "people_id"=> "14715"
        ],
        [
            "name"=> "Arab, Omani",
            "country"=> "Oman",
            "language"=> "Arabic, Omani Spoken",
            "religion"=> "Islam",
            "population"=> 1967000,
            "christian"=> 1e-05,
            "window"=> "Yes",
            "region"=> "MU",
            "people_id"=> "10378"
        ],
        [
            "name"=> "Arab, Saudi - Hijazi",
            "country"=> "Saudi Arabia",
            "language"=> "Arabic, Hijazi Spoken",
            "religion"=> "Islam",
            "population"=> 11291000,
            "christian"=> 0.0009,
            "window"=> "Yes",
            "region"=> "SA",
            "people_id"=> "14784"
        ],
        [
            "name"=> "Arab, Saudi - Najdi",
            "country"=> "Iraq",
            "language"=> "Arabic, Najdi Spoken",
            "religion"=> "Islam",
            "population"=> 1934000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IZ",
            "people_id"=> "10759"
        ],
        [
            "name"=> "Arab, Saudi - Najdi",
            "country"=> "Saudi Arabia",
            "language"=> "Arabic, Najdi Spoken",
            "religion"=> "Islam",
            "population"=> 14668000,
            "christian"=> 0.0009,
            "window"=> "Yes",
            "region"=> "SA",
            "people_id"=> "10759"
        ],
        [
            "name"=> "Arab, Saudi - Najdi",
            "country"=> "Syria",
            "language"=> "Arabic, Najdi Spoken",
            "religion"=> "Islam",
            "population"=> 1752000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "SY",
            "people_id"=> "10759"
        ],
        [
            "name"=> "Arab, Tihami",
            "country"=> "Yemen",
            "language"=> "Arabic, Taizzi-Adeni Spoken",
            "religion"=> "Islam",
            "population"=> 5137000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "YM",
            "people_id"=> "15484"
        ],
        [
            "name"=> "Arab, Yemeni",
            "country"=> "Yemen",
            "language"=> "Arabic, Taizzi-Adeni Spoken",
            "religion"=> "Islam",
            "population"=> 7764000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "YM",
            "people_id"=> "15198"
        ],
        [
            "name"=> "Arain (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 11507000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "16228"
        ],
        [
            "name"=> "Arora (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 4869000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16239"
        ],
        [
            "name"=> "Arunthathiyar",
            "country"=> "India",
            "language"=> "Tamil",
            "religion"=> "Hinduism",
            "population"=> 1131000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16242"
        ],
        [
            "name"=> "Assamese (Muslim traditions)",
            "country"=> "India",
            "language"=> "Assamese",
            "religion"=> "Islam",
            "population"=> 3198000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "10461"
        ],
        [
            "name"=> "Awan",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 5709000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "16264"
        ],
        [
            "name"=> "Badhai (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 7815000,
            "christian"=> 5e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16332"
        ],
        [
            "name"=> "Bagdi (Hindu traditions)",
            "country"=> "India",
            "language"=> "Bengali",
            "religion"=> "Hinduism",
            "population"=> 3456000,
            "christian"=> 0.00092,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16281"
        ],
        [
            "name"=> "Bairagi (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 4203000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16297"
        ],
        [
            "name"=> "Bairwa",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1180000,
            "christian"=> 0.0003,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16298"
        ],
        [
            "name"=> "Balija (Hindu traditions)",
            "country"=> "India",
            "language"=> "Kannada",
            "religion"=> "Hinduism",
            "population"=> 1803000,
            "christian"=> 0.00012,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> 16312
        ],
        [
            "name"=> "Baloch Rind",
            "country"=> "Pakistan",
            "language"=> "Balochi, Southern",
            "religion"=> "Islam",
            "population"=> 1425000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "20260"
        ],
        [
            "name"=> "Baloch unspecified",
            "country"=> "Pakistan",
            "language"=> "Balochi, Eastern",
            "religion"=> "Islam",
            "population"=> 2494000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "11684"
        ],
        [
            "name"=> "Bania Agarwal",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 5822000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "19688"
        ],
        [
            "name"=> "Bania Komti",
            "country"=> "India",
            "language"=> "Telugu",
            "religion"=> "Hinduism",
            "population"=> 2130000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "19707"
        ],
        [
            "name"=> "Bania Mahur",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1038000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "19713"
        ],
        [
            "name"=> "Bania unspecified",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 17064000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16318"
        ],
        [
            "name"=> "Banjar",
            "country"=> "Indonesia",
            "language"=> "Banjar",
            "religion"=> "Islam",
            "population"=> 4416000,
            "christian"=> 0.0009,
            "window"=> "Yes",
            "region"=> "ID",
            "people_id"=> "10658"
        ],
        [
            "name"=> "Basor",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1101000,
            "christian"=> 4e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16340"
        ],
        [
            "name"=> "Bedar (Hindu traditions)",
            "country"=> "India",
            "language"=> "Kannada",
            "religion"=> "Hinduism",
            "population"=> 2437000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16365"
        ],
        [
            "name"=> "Bedouin, Eastern Bedawi",
            "country"=> "Egypt",
            "language"=> "Arabic, Eastern Egyptian Bedawi Spoken",
            "religion"=> "Islam",
            "population"=> 1284000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "EG",
            "people_id"=> "13046"
        ],
        [
            "name"=> "Beldar (Hindu traditions)",
            "country"=> "India",
            "language"=> "Kannada",
            "religion"=> "Hinduism",
            "population"=> 2008000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16375"
        ],
        [
            "name"=> "Bengali Muslim Sayyid",
            "country"=> "Bangladesh",
            "language"=> "Bengali",
            "religion"=> "Islam",
            "population"=> 1844000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "BG",
            "people_id"=> "18045"
        ],
        [
            "name"=> "Bengali Muslim Shaikh",
            "country"=> "Bangladesh",
            "language"=> "Bengali",
            "religion"=> "Islam",
            "population"=> 134244000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "BG",
            "people_id"=> "18084"
        ],
        [
            "name"=> "Berber, Imazighen",
            "country"=> "Algeria",
            "language"=> "Tamazight, Central Atlas",
            "religion"=> "Islam",
            "population"=> 1712000,
            "christian"=> 0.001,
            "window"=> "Yes",
            "region"=> "AG",
            "people_id"=> "12217"
        ],
        [
            "name"=> "Berber, Imazighen",
            "country"=> "Morocco",
            "language"=> "Tamazight, Central Atlas",
            "religion"=> "Islam",
            "population"=> 2867000,
            "christian"=> 0.0007000000000000001,
            "window"=> "Yes",
            "region"=> "MO",
            "people_id"=> "12217"
        ],
        [
            "name"=> "Berber, Rif",
            "country"=> "Morocco",
            "language"=> "Tarifit",
            "religion"=> "Islam",
            "population"=> 1610000,
            "christian"=> 0.0003,
            "window"=> "Yes",
            "region"=> "MO",
            "people_id"=> "10803"
        ],
        [
            "name"=> "Berber, Shawiya",
            "country"=> "Algeria",
            "language"=> "Tachawit",
            "religion"=> "Islam",
            "population"=> 2393000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "AG",
            "people_id"=> "14899"
        ],
        [
            "name"=> "Bhar",
            "country"=> "India",
            "language"=> "Bhojpuri",
            "religion"=> "Hinduism",
            "population"=> 2381000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16405"
        ],
        [
            "name"=> "Bharbhunja (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1447000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16412"
        ],
        [
            "name"=> "Bhat (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1647000,
            "christian"=> 2e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16406"
        ],
        [
            "name"=> "Bhoi (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 5941000,
            "christian"=> 3e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16429"
        ],
        [
            "name"=> "Bhuinhar",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1158000,
            "christian"=> 0.00049,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16424"
        ],
        [
            "name"=> "Bind",
            "country"=> "India",
            "language"=> "Bhojpuri",
            "religion"=> "Hinduism",
            "population"=> 1180000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16457"
        ],
        [
            "name"=> "Bohra",
            "country"=> "India",
            "language"=> "Gujarati",
            "religion"=> "Islam",
            "population"=> 1322000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16494"
        ],
        [
            "name"=> "Bosniak",
            "country"=> "Bosnia-Herzegovina",
            "language"=> "Bosnian",
            "religion"=> "Islam",
            "population"=> 1615000,
            "christian"=> 0.0003,
            "window"=> "No",
            "region"=> "BK",
            "people_id"=> "10953"
        ],
        [
            "name"=> "Boya",
            "country"=> "India",
            "language"=> "Telugu",
            "religion"=> "Hinduism",
            "population"=> 4519000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16518"
        ],
        [
            "name"=> "Brahmin Bhumihar",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 3315000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "19924"
        ],
        [
            "name"=> "Brahmin Gaur",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 3675000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "19943"
        ],
        [
            "name"=> "Brahmin Hill",
            "country"=> "Nepal",
            "language"=> "Nepali",
            "religion"=> "Hinduism",
            "population"=> 3726000,
            "christian"=> 3e-05,
            "window"=> "Yes",
            "region"=> "NP",
            "people_id"=> "20056"
        ],
        [
            "name"=> "Brahmin Kanaujia",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 5143000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "19951"
        ],
        [
            "name"=> "Brahmin Radhi",
            "country"=> "India",
            "language"=> "Bengali",
            "religion"=> "Hinduism",
            "population"=> 1913000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "19972"
        ],
        [
            "name"=> "Brahmin Sanadhya",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 3262000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "19975"
        ],
        [
            "name"=> "Brahmin Sawaria",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 5175000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "19978"
        ],
        [
            "name"=> "Brahmin Telugu",
            "country"=> "India",
            "language"=> "Telugu",
            "religion"=> "Hinduism",
            "population"=> 1247000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "19983"
        ],
        [
            "name"=> "Brahmin unspecified",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 34992000,
            "christian"=> 4e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16521"
        ],
        [
            "name"=> "Brahui Jhalawan",
            "country"=> "Pakistan",
            "language"=> "Brahui",
            "religion"=> "Islam",
            "population"=> 1236000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "20026"
        ],
        [
            "name"=> "Chakkiliyan (Hindu traditions)",
            "country"=> "India",
            "language"=> "Tamil",
            "religion"=> "Hinduism",
            "population"=> 1016000,
            "christian"=> 0.00067,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16600"
        ],
        [
            "name"=> "Chechen, Nohchi",
            "country"=> "Russia",
            "language"=> "Chechen",
            "religion"=> "Islam",
            "population"=> 1440000,
            "christian"=> 6e-05,
            "window"=> "No",
            "region"=> "RS",
            "people_id"=> "11317"
        ],
        [
            "name"=> "Daroga (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1218000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16676"
        ],
        [
            "name"=> "Darzi (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 2484000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16673"
        ],
        [
            "name"=> "Darzi (Muslim traditions)",
            "country"=> "India",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 1202000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17513"
        ],
        [
            "name"=> "Dewar",
            "country"=> "India",
            "language"=> "Odia",
            "religion"=> "Hinduism",
            "population"=> 1210000,
            "christian"=> 0.00058,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16695"
        ],
        [
            "name"=> "Dhangar Bharwad",
            "country"=> "India",
            "language"=> "Gujarati",
            "religion"=> "Hinduism",
            "population"=> 3331000,
            "christian"=> 0.00037999999999999997,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16700"
        ],
        [
            "name"=> "Dhanuk",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 5035000,
            "christian"=> 3e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16696"
        ],
        [
            "name"=> "Dhimar",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 2251000,
            "christian"=> 5e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16705"
        ],
        [
            "name"=> "Dhobi (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 12673000,
            "christian"=> 0.00018999999999999998,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16709"
        ],
        [
            "name"=> "Dhobi (Muslim traditions)",
            "country"=> "India",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 1156000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17519"
        ],
        [
            "name"=> "Dhobi (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Saraiki",
            "religion"=> "Islam",
            "population"=> 1294000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "17519"
        ],
        [
            "name"=> "Dusadh (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 6701000,
            "christian"=> 0.00027,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16742"
        ],
        [
            "name"=> "Fulani, Adamawa",
            "country"=> "Cameroon",
            "language"=> "Fulfulde, Adamawa",
            "religion"=> "Islam",
            "population"=> 2768000,
            "christian"=> 0.0005,
            "window"=> "No",
            "region"=> "CM",
            "people_id"=> "11774"
        ],
        [
            "name"=> "Fulani, Adamawa",
            "country"=> "Nigeria",
            "language"=> "Fulfulde, Adamawa",
            "religion"=> "Islam",
            "population"=> 1683000,
            "christian"=> 0.00052,
            "window"=> "Yes",
            "region"=> "NI",
            "people_id"=> "11774"
        ],
        [
            "name"=> "Fulani, Maasina",
            "country"=> "Mali",
            "language"=> "Fulfulde, Maasina",
            "religion"=> "Islam",
            "population"=> 1442000,
            "christian"=> 8.999999999999999e-05,
            "window"=> "Yes",
            "region"=> "ML",
            "people_id"=> "11773"
        ],
        [
            "name"=> "Fulani, Pulaar",
            "country"=> "Senegal",
            "language"=> "Pulaar",
            "religion"=> "Islam",
            "population"=> 1549000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "SG",
            "people_id"=> "15622"
        ],
        [
            "name"=> "Fulbe",
            "country"=> "Guinea",
            "language"=> "Pular",
            "religion"=> "Islam",
            "population"=> 4679000,
            "christian"=> 8.999999999999999e-05,
            "window"=> "Yes",
            "region"=> "GV",
            "people_id"=> "11769"
        ],
        [
            "name"=> "Gadaria (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 4825000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16768"
        ],
        [
            "name"=> "Gadaria Dhingar",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1427000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21718"
        ],
        [
            "name"=> "Gadaria Nikhad",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1646000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21719"
        ],
        [
            "name"=> "Gangakula",
            "country"=> "India",
            "language"=> "Kannada",
            "religion"=> "Hinduism",
            "population"=> 1844000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16785"
        ],
        [
            "name"=> "Gauda",
            "country"=> "India",
            "language"=> "Odia",
            "religion"=> "Hinduism",
            "population"=> 2429000,
            "christian"=> 0.00084,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16800"
        ],
        [
            "name"=> "Gosain unspecified",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1382000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16862"
        ],
        [
            "name"=> "Gujar (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 8549000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16878"
        ],
        [
            "name"=> "Gujar (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 5206000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "17549"
        ],
        [
            "name"=> "Gujjar (Muslim traditions)",
            "country"=> "India",
            "language"=> "Gujari",
            "religion"=> "Islam",
            "population"=> 1209000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16879"
        ],
        [
            "name"=> "Gujjar (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Hindko, Northern",
            "religion"=> "Islam",
            "population"=> 2533000,
            "christian"=> 1e-05,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "16879"
        ],
        [
            "name"=> "Hajam",
            "country"=> "India",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 2368000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "19655"
        ],
        [
            "name"=> "Hajam",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 2314000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "19655"
        ],
        [
            "name"=> "Halwai (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1678000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16905"
        ],
        [
            "name"=> "Hausa",
            "country"=> "C\u00f4te d'Ivoire",
            "language"=> "Hausa",
            "religion"=> "Islam",
            "population"=> 1200000,
            "christian"=> 0,
            "window"=> "No",
            "region"=> "IV",
            "people_id"=> "12070"
        ],
        [
            "name"=> "Hazara",
            "country"=> "Afghanistan",
            "language"=> "Hazaragi",
            "religion"=> "Islam",
            "population"=> 3631000,
            "christian"=> 0.00029,
            "window"=> "Yes",
            "region"=> "AF",
            "people_id"=> "12076"
        ],
        [
            "name"=> "Hui",
            "country"=> "China",
            "language"=> "Chinese, Mandarin",
            "religion"=> "Islam",
            "population"=> 13738000,
            "christian"=> 7.000000000000001e-05,
            "window"=> "Yes",
            "region"=> "CH",
            "people_id"=> "12140"
        ],
        [
            "name"=> "Ilavan",
            "country"=> "India",
            "language"=> "Malayalam",
            "religion"=> "Hinduism",
            "population"=> 6754000,
            "christian"=> 0.00016,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16965"
        ],
        [
            "name"=> "Jambi",
            "country"=> "Indonesia",
            "language"=> "Malay, Jambi",
            "religion"=> "Islam",
            "population"=> 1045000,
            "christian"=> 0.0006,
            "window"=> "Yes",
            "region"=> "ID",
            "people_id"=> "12318"
        ],
        [
            "name"=> "Jat (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 16163000,
            "christian"=> 0.00029,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "12329"
        ],
        [
            "name"=> "Jat (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Saraiki",
            "religion"=> "Islam",
            "population"=> 13498000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "17571"
        ],
        [
            "name"=> "Jat (Sikh traditions)",
            "country"=> "India",
            "language"=> "Punjabi, Eastern",
            "religion"=> "Other / Small",
            "population"=> 8794000,
            "christian"=> 0.00015,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "18777"
        ],
        [
            "name"=> "Jat Gahlot (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 1699000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "19840"
        ],
        [
            "name"=> "Jat Kharral (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Saraiki",
            "religion"=> "Islam",
            "population"=> 1222000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "19881"
        ],
        [
            "name"=> "Jat Varaich (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 1071000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "19911"
        ],
        [
            "name"=> "Jebala",
            "country"=> "Morocco",
            "language"=> "Arabic, Moroccan Spoken",
            "religion"=> "Islam",
            "population"=> 1297000,
            "christian"=> 0.00029,
            "window"=> "Yes",
            "region"=> "MO",
            "people_id"=> "12336"
        ],
        [
            "name"=> "Jogi (Hindu traditions)",
            "country"=> "India",
            "language"=> "Bengali",
            "religion"=> "Hinduism",
            "population"=> 3816000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17019"
        ],
        [
            "name"=> "Jola",
            "country"=> "Bangladesh",
            "language"=> "Bengali",
            "religion"=> "Islam",
            "population"=> 1371000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "BG",
            "people_id"=> "22099"
        ],
        [
            "name"=> "Kabardian",
            "country"=> "T\u00fcrkiye (Turkey)",
            "language"=> "Kabardian",
            "religion"=> "Islam",
            "population"=> 1203000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "TU",
            "people_id"=> "11675"
        ],
        [
            "name"=> "Kachhi (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 4962000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17035"
        ],
        [
            "name"=> "Kachhi Kachhwaha",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1426000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21763"
        ],
        [
            "name"=> "Kahar (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 9759000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17044"
        ],
        [
            "name"=> "Kaibartta unspecified",
            "country"=> "India",
            "language"=> "Bengali",
            "religion"=> "Hinduism",
            "population"=> 1658000,
            "christian"=> 0.00083,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17016"
        ],
        [
            "name"=> "Kalal (Hindu traditions)",
            "country"=> "India",
            "language"=> "Telugu",
            "religion"=> "Hinduism",
            "population"=> 2614000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17204"
        ],
        [
            "name"=> "Kalal Idiga",
            "country"=> "India",
            "language"=> "Telugu",
            "religion"=> "Hinduism",
            "population"=> 2093000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21147"
        ],
        [
            "name"=> "Kalwar (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 2697000,
            "christian"=> 2e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17061"
        ],
        [
            "name"=> "Kalwar Jaiswal",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1161000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21150"
        ],
        [
            "name"=> "Kandu",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 2813000,
            "christian"=> 3e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17080"
        ],
        [
            "name"=> "Kapu Reddi",
            "country"=> "India",
            "language"=> "Telugu",
            "religion"=> "Hinduism",
            "population"=> 4246000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21151"
        ],
        [
            "name"=> "Kapu unspecified",
            "country"=> "India",
            "language"=> "Telugu",
            "religion"=> "Hinduism",
            "population"=> 14045000,
            "christian"=> 0.00023,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "19597"
        ],
        [
            "name"=> "Kashmiri (Muslim traditions)",
            "country"=> "India",
            "language"=> "Kashmiri",
            "religion"=> "Islam",
            "population"=> 8008000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "12558"
        ],
        [
            "name"=> "Kashmiri (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Hindko, Northern",
            "religion"=> "Islam",
            "population"=> 1317000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "12558"
        ],
        [
            "name"=> "Kayastha (Hindu traditions)",
            "country"=> "Bangladesh",
            "language"=> "Bengali",
            "religion"=> "Hinduism",
            "population"=> 1503000,
            "christian"=> 0.00043999999999999996,
            "window"=> "Yes",
            "region"=> "BG",
            "people_id"=> "17124"
        ],
        [
            "name"=> "Kayastha (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 7148000,
            "christian"=> 0.0003,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17124"
        ],
        [
            "name"=> "Kayastha Sribastab",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1151000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21327"
        ],
        [
            "name"=> "Kazakh",
            "country"=> "China",
            "language"=> "Kazakh",
            "religion"=> "Islam",
            "population"=> 1862000,
            "christian"=> 0.00012,
            "window"=> "Yes",
            "region"=> "CH",
            "people_id"=> "12599"
        ],
        [
            "name"=> "Khampa Eastern",
            "country"=> "China",
            "language"=> "Tibetan, Khams",
            "religion"=> "Buddhism",
            "population"=> 1597000,
            "christian"=> 0.0005,
            "window"=> "Yes",
            "region"=> "CH",
            "people_id"=> "18522"
        ],
        [
            "name"=> "Khandait",
            "country"=> "India",
            "language"=> "Odia",
            "religion"=> "Hinduism",
            "population"=> 2067000,
            "christian"=> 0.00054,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17150"
        ],
        [
            "name"=> "Khati (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1955000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17162"
        ],
        [
            "name"=> "Khatik (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 2693000,
            "christian"=> 1e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17301"
        ],
        [
            "name"=> "Khatri (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 2802000,
            "christian"=> 8e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17161"
        ],
        [
            "name"=> "Khatri (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 1205000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "17586"
        ],
        [
            "name"=> "Khorasani Turk",
            "country"=> "Iran",
            "language"=> "Khorasani Turkish",
            "religion"=> "Islam",
            "population"=> 1017000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IR",
            "people_id"=> "12667"
        ],
        [
            "name"=> "Kirar",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1066000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17194"
        ],
        [
            "name"=> "Koiri (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 9732000,
            "christian"=> 0.0004,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17236"
        ],
        [
            "name"=> "Kol",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 2102000,
            "christian"=> 0.00062,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17239"
        ],
        [
            "name"=> "Koli (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 2682000,
            "christian"=> 0.00023,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17247"
        ],
        [
            "name"=> "Koli Mahadev",
            "country"=> "India",
            "language"=> "Marathi",
            "religion"=> "Hinduism",
            "population"=> 2001000,
            "christian"=> 0.00066,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17210"
        ],
        [
            "name"=> "Koshti",
            "country"=> "India",
            "language"=> "Marathi",
            "religion"=> "Hinduism",
            "population"=> 1329000,
            "christian"=> 0.00046,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17275"
        ],
        [
            "name"=> "Kumhar (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 18743000,
            "christian"=> 8.999999999999999e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17316"
        ],
        [
            "name"=> "Kumhar (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 3965000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "17597"
        ],
        [
            "name"=> "Kunbi (Hindu traditions)",
            "country"=> "India",
            "language"=> "Gujarati",
            "religion"=> "Hinduism",
            "population"=> 15725000,
            "christian"=> 0.0005,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17325"
        ],
        [
            "name"=> "Kunbi Kadwa",
            "country"=> "India",
            "language"=> "Gujarati",
            "religion"=> "Hinduism",
            "population"=> 1404000,
            "christian"=> 0.0001,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21181"
        ],
        [
            "name"=> "Kunbi Lewa",
            "country"=> "India",
            "language"=> "Gujarati",
            "religion"=> "Hinduism",
            "population"=> 2400000,
            "christian"=> 0.00017,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21182"
        ],
        [
            "name"=> "Kurd, Central",
            "country"=> "Iraq",
            "language"=> "Kurdish, Central",
            "religion"=> "Islam",
            "population"=> 5263000,
            "christian"=> 0.0004,
            "window"=> "Yes",
            "region"=> "IZ",
            "people_id"=> "11126"
        ],
        [
            "name"=> "Kurd, Kurmanji",
            "country"=> "T\u00fcrkiye (Turkey)",
            "language"=> "Kurdish, Northern",
            "religion"=> "Islam",
            "population"=> 9252000,
            "christian"=> 0.0001,
            "window"=> "Yes",
            "region"=> "TU",
            "people_id"=> "12877"
        ],
        [
            "name"=> "Kurd, Turkish-speaking",
            "country"=> "T\u00fcrkiye (Turkey)",
            "language"=> "Turkish",
            "religion"=> "Islam",
            "population"=> 6412000,
            "christian"=> 0.0001,
            "window"=> "Yes",
            "region"=> "TU",
            "people_id"=> "18756"
        ],
        [
            "name"=> "Kurmi (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 22664000,
            "christian"=> 7.000000000000001e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17334"
        ],
        [
            "name"=> "Kyrgyz",
            "country"=> "Kyrgyzstan",
            "language"=> "Kyrgyz",
            "religion"=> "Islam",
            "population"=> 4882000,
            "christian"=> 0.00091,
            "window"=> "Yes",
            "region"=> "KG",
            "people_id"=> "12933"
        ],
        [
            "name"=> "Laki",
            "country"=> "Iran",
            "language"=> "Laki",
            "religion"=> "Islam",
            "population"=> 1313000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IR",
            "people_id"=> "19313"
        ],
        [
            "name"=> "Lingayat",
            "country"=> "India",
            "language"=> "Kannada",
            "religion"=> "Ethnic Religions",
            "population"=> 4092000,
            "christian"=> 0.00012,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17372"
        ],
        [
            "name"=> "Lodha (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 6156000,
            "christian"=> 0.00033,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17378"
        ],
        [
            "name"=> "Lodha Jariya",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1806000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21768"
        ],
        [
            "name"=> "Lohar (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 11351000,
            "christian"=> 7.000000000000001e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17379"
        ],
        [
            "name"=> "Lohar (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 2236000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "17609"
        ],
        [
            "name"=> "Lunia (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 3801000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17391"
        ],
        [
            "name"=> "Luri, Northern",
            "country"=> "Iran",
            "language"=> "Luri, Northern",
            "religion"=> "Islam",
            "population"=> 1986000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IR",
            "people_id"=> "13158"
        ],
        [
            "name"=> "Luri, Southern",
            "country"=> "Iran",
            "language"=> "Luri, Southern",
            "religion"=> "Islam",
            "population"=> 1082000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IR",
            "people_id"=> "19312"
        ],
        [
            "name"=> "Machhi (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 2419000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "17618"
        ],
        [
            "name"=> "Maguindanao",
            "country"=> "Philippines",
            "language"=> "Maguindanaon",
            "religion"=> "Islam",
            "population"=> 1396000,
            "christian"=> 5e-05,
            "window"=> "No",
            "region"=> "RP",
            "people_id"=> "13209"
        ],
        [
            "name"=> "Mahratta Jadhav",
            "country"=> "India",
            "language"=> "Marathi",
            "religion"=> "Hinduism",
            "population"=> 3340000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21188"
        ],
        [
            "name"=> "Mahratta Kunbi",
            "country"=> "India",
            "language"=> "Gujarati",
            "religion"=> "Hinduism",
            "population"=> 9087000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17599"
        ],
        [
            "name"=> "Mahratta unspecified",
            "country"=> "India",
            "language"=> "Marathi",
            "religion"=> "Hinduism",
            "population"=> 31574000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17554"
        ],
        [
            "name"=> "Mal (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 2107000,
            "christian"=> 7.000000000000001e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17424"
        ],
        [
            "name"=> "Malay",
            "country"=> "Indonesia",
            "language"=> "Malay",
            "religion"=> "Islam",
            "population"=> 3298000,
            "christian"=> 0.0001,
            "window"=> "Yes",
            "region"=> "ID",
            "people_id"=> "13437"
        ],
        [
            "name"=> "Malay",
            "country"=> "Malaysia",
            "language"=> "Malay",
            "religion"=> "Islam",
            "population"=> 13951000,
            "christian"=> 0.001,
            "window"=> "Yes",
            "region"=> "MY",
            "people_id"=> "13437"
        ],
        [
            "name"=> "Malay, Pattani",
            "country"=> "Thailand",
            "language"=> "Malay, Pattani",
            "religion"=> "Islam",
            "population"=> 1571000,
            "christian"=> 5e-05,
            "window"=> "Yes",
            "region"=> "TH",
            "people_id"=> "14343"
        ],
        [
            "name"=> "Malay, Riau",
            "country"=> "Indonesia",
            "language"=> "Malay",
            "religion"=> "Islam",
            "population"=> 1908000,
            "christian"=> 0.0008,
            "window"=> "Yes",
            "region"=> "ID",
            "people_id"=> "14556"
        ],
        [
            "name"=> "Malay, Sumatera North",
            "country"=> "Indonesia",
            "language"=> "Malay",
            "religion"=> "Islam",
            "population"=> 2300000,
            "christian"=> 0.0005,
            "window"=> "Yes",
            "region"=> "ID",
            "people_id"=> "20292"
        ],
        [
            "name"=> "Mali (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 12552000,
            "christian"=> 0.00012,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "18786"
        ],
        [
            "name"=> "Mallah (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 3107000,
            "christian"=> 6e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17432"
        ],
        [
            "name"=> "Mandailing",
            "country"=> "Indonesia",
            "language"=> "Batak Mandailing",
            "religion"=> "Islam",
            "population"=> 1265000,
            "christian"=> 0.00099,
            "window"=> "Yes",
            "region"=> "ID",
            "people_id"=> "10721"
        ],
        [
            "name"=> "Mangala",
            "country"=> "India",
            "language"=> "Telugu",
            "religion"=> "Hinduism",
            "population"=> 2199000,
            "christian"=> 0.00047,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "19068"
        ],
        [
            "name"=> "Maninka, Eastern",
            "country"=> "Guinea",
            "language"=> "Maninkakan, Eastern",
            "religion"=> "Islam",
            "population"=> 3404000,
            "christian"=> 0.0002,
            "window"=> "Yes",
            "region"=> "GV",
            "people_id"=> "13511"
        ],
        [
            "name"=> "Mappila",
            "country"=> "India",
            "language"=> "Malayalam",
            "religion"=> "Islam",
            "population"=> 10436000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17452"
        ],
        [
            "name"=> "Maranao, Lanao",
            "country"=> "Philippines",
            "language"=> "Maranao",
            "religion"=> "Islam",
            "population"=> 1481000,
            "christian"=> 1e-05,
            "window"=> "No",
            "region"=> "RP",
            "people_id"=> "13531"
        ],
        [
            "name"=> "Megh (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 4739000,
            "christian"=> 0.00017,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17527"
        ],
        [
            "name"=> "Mewati (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Sindhi",
            "religion"=> "Islam",
            "population"=> 1001000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "17620"
        ],
        [
            "name"=> "Minangkabau, Orang Negeri",
            "country"=> "Malaysia",
            "language"=> "Malay",
            "religion"=> "Islam",
            "population"=> 1000000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "MY",
            "people_id"=> "14208"
        ],
        [
            "name"=> "Mirasi (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 2108000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "17622"
        ],
        [
            "name"=> "Mochi (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 3564000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "17625"
        ],
        [
            "name"=> "Moghal",
            "country"=> "India",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 2080000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "13761"
        ],
        [
            "name"=> "Moghal",
            "country"=> "Pakistan",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 1363000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "13761"
        ],
        [
            "name"=> "Mongolian, Peripheral",
            "country"=> "China",
            "language"=> "Mongolian, Peripheral",
            "religion"=> "Buddhism",
            "population"=> 5583000,
            "christian"=> 0.0004,
            "window"=> "Yes",
            "region"=> "CH",
            "people_id"=> "18603"
        ],
        [
            "name"=> "Moor",
            "country"=> "Mauritania",
            "language"=> "Hassaniyya",
            "religion"=> "Islam",
            "population"=> 3954000,
            "christian"=> 0.001,
            "window"=> "Yes",
            "region"=> "MR",
            "people_id"=> "13592"
        ],
        [
            "name"=> "Muhamasheen, Akhdam",
            "country"=> "Yemen",
            "language"=> "Arabic, Taizzi-Adeni Spoken",
            "religion"=> "Islam",
            "population"=> 1735000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "YM",
            "people_id"=> "10380"
        ],
        [
            "name"=> "Munnur",
            "country"=> "India",
            "language"=> "Telugu",
            "religion"=> "Hinduism",
            "population"=> 1001000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "19281"
        ],
        [
            "name"=> "Murao (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 2860000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17708"
        ],
        [
            "name"=> "Mussali",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 2722000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "17714"
        ],
        [
            "name"=> "Mutrasi",
            "country"=> "India",
            "language"=> "Telugu",
            "religion"=> "Hinduism",
            "population"=> 1218000,
            "christian"=> 0.00035000000000000005,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "19316"
        ],
        [
            "name"=> "Nadar (Hindu traditions)",
            "country"=> "India",
            "language"=> "Tamil",
            "religion"=> "Hinduism",
            "population"=> 3390000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17735"
        ],
        [
            "name"=> "Nai (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 14140000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17745"
        ],
        [
            "name"=> "Naikda",
            "country"=> "India",
            "language"=> "Kannada",
            "religion"=> "Hinduism",
            "population"=> 4299000,
            "christian"=> 0.00079,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17786"
        ],
        [
            "name"=> "Palembang",
            "country"=> "Indonesia",
            "language"=> "Musi",
            "religion"=> "Islam",
            "population"=> 3478000,
            "christian"=> 0.0003,
            "window"=> "Yes",
            "region"=> "ID",
            "people_id"=> "14274"
        ],
        [
            "name"=> "Panika",
            "country"=> "India",
            "language"=> "Chhattisgarhi",
            "religion"=> "Hinduism",
            "population"=> 1264000,
            "christian"=> 0.00043,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17824"
        ],
        [
            "name"=> "Pashtun",
            "country"=> "Pakistan",
            "language"=> "Pashto, Central",
            "religion"=> "Islam",
            "population"=> 32262000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "14256"
        ],
        [
            "name"=> "Pashtun Kakar",
            "country"=> "Pakistan",
            "language"=> "Pashto, Southern",
            "religion"=> "Islam",
            "population"=> 1425000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "22188"
        ],
        [
            "name"=> "Pashtun Khattak",
            "country"=> "Pakistan",
            "language"=> "Pashto, Northern",
            "religion"=> "Islam",
            "population"=> 1414000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "22197"
        ],
        [
            "name"=> "Pashtun Mandanri (Manezai)",
            "country"=> "Pakistan",
            "language"=> "Pashto, Northern",
            "religion"=> "Islam",
            "population"=> 1390000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "22223"
        ],
        [
            "name"=> "Pashtun Mohmand",
            "country"=> "Pakistan",
            "language"=> "Pashto, Northern",
            "religion"=> "Islam",
            "population"=> 1180000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "22234"
        ],
        [
            "name"=> "Pashtun Yusafzai",
            "country"=> "India",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 1032000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "22294"
        ],
        [
            "name"=> "Pashtun Yusafzai",
            "country"=> "Pakistan",
            "language"=> "Pashto, Northern",
            "religion"=> "Islam",
            "population"=> 3624000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "22294"
        ],
        [
            "name"=> "Pashtun, Northern",
            "country"=> "Afghanistan",
            "language"=> "Pashto, Northern",
            "religion"=> "Islam",
            "population"=> 7292000,
            "christian"=> 0.0001,
            "window"=> "Yes",
            "region"=> "AF",
            "people_id"=> "14256"
        ],
        [
            "name"=> "Pashtun, Pathan",
            "country"=> "India",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 9215000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21537"
        ],
        [
            "name"=> "Pashtun, Southeast",
            "country"=> "Afghanistan",
            "language"=> "Pashto, Southern",
            "religion"=> "Islam",
            "population"=> 2054000,
            "christian"=> 0.0001,
            "window"=> "Yes",
            "region"=> "AF",
            "people_id"=> "22356"
        ],
        [
            "name"=> "Pashtun, Southern",
            "country"=> "Afghanistan",
            "language"=> "Pashto, Southern",
            "religion"=> "Islam",
            "population"=> 4622000,
            "christian"=> 0.00018999999999999998,
            "window"=> "Yes",
            "region"=> "AF",
            "people_id"=> "14327"
        ],
        [
            "name"=> "Pasi (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 5914000,
            "christian"=> 0.0008,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17852"
        ],
        [
            "name"=> "Pasi Kaithwan",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1044000,
            "christian"=> 0.0001,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21772"
        ],
        [
            "name"=> "Pingdi",
            "country"=> "China",
            "language"=> "Chinese, Xiang",
            "religion"=> "Ethnic Religions",
            "population"=> 1340000,
            "christian"=> 0.001,
            "window"=> "Yes",
            "region"=> "CH",
            "people_id"=> "18653"
        ],
        [
            "name"=> "Pinjara",
            "country"=> "India",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 3938000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17877"
        ],
        [
            "name"=> "Pulayan unspecified",
            "country"=> "India",
            "language"=> "Malayalam",
            "religion"=> "Hinduism",
            "population"=> 1109000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17911"
        ],
        [
            "name"=> "Qashqai, Kashkai",
            "country"=> "Iran",
            "language"=> "Kashkay",
            "religion"=> "Islam",
            "population"=> 1051000,
            "christian"=> 2e-05,
            "window"=> "Yes",
            "region"=> "IR",
            "people_id"=> "14497"
        ],
        [
            "name"=> "Qassab",
            "country"=> "India",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 1284000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17919"
        ],
        [
            "name"=> "Qassab",
            "country"=> "Pakistan",
            "language"=> "Saraiki",
            "religion"=> "Islam",
            "population"=> 1174000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "17919"
        ],
        [
            "name"=> "Rabari (Hindu traditions)",
            "country"=> "India",
            "language"=> "Gujarati",
            "religion"=> "Hinduism",
            "population"=> 1270000,
            "christian"=> 5e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17921"
        ],
        [
            "name"=> "Rahanweyn",
            "country"=> "Somalia",
            "language"=> "Maay",
            "religion"=> "Islam",
            "population"=> 2301000,
            "christian"=> 0.0001,
            "window"=> "Yes",
            "region"=> "SO",
            "people_id"=> "13179"
        ],
        [
            "name"=> "Raigar",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1068000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17926"
        ],
        [
            "name"=> "Rajput (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 27712000,
            "christian"=> 0.00017999999999999998,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17928"
        ],
        [
            "name"=> "Rajput (Muslim traditions)",
            "country"=> "India",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 1966000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17667"
        ],
        [
            "name"=> "Rajput (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 5254000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "17667"
        ],
        [
            "name"=> "Rajput (Sikh traditions)",
            "country"=> "India",
            "language"=> "Punjabi, Eastern",
            "religion"=> "Other / Small",
            "population"=> 1260000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "18159"
        ],
        [
            "name"=> "Rajput Bais (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1610000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "20374"
        ],
        [
            "name"=> "Rajput Bhatti (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1064000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "20381"
        ],
        [
            "name"=> "Rajput Bhatti (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 2053000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "20234"
        ],
        [
            "name"=> "Rajput Chauhan (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 3643000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "20386"
        ],
        [
            "name"=> "Rajput Chauhan (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Sindhi",
            "religion"=> "Islam",
            "population"=> 1493000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "20235"
        ],
        [
            "name"=> "Rajput Ponwar (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1535000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "20421"
        ],
        [
            "name"=> "Rajput Rathor (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1697000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "20427"
        ],
        [
            "name"=> "Rakhine",
            "country"=> "Myanmar (Burma)",
            "language"=> "Rakhine",
            "religion"=> "Buddhism",
            "population"=> 2580000,
            "christian"=> 0.001,
            "window"=> "Yes",
            "region"=> "BM",
            "people_id"=> "13207"
        ],
        [
            "name"=> "Rayeen (Muslim traditions)",
            "country"=> "India",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 1159000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17328"
        ],
        [
            "name"=> "Romani, Domari",
            "country"=> "Iran",
            "language"=> "Domari",
            "religion"=> "Islam",
            "population"=> 1496000,
            "christian"=> 0.0006,
            "window"=> "Yes",
            "region"=> "IR",
            "people_id"=> "11597"
        ],
        [
            "name"=> "Sahariya",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1033000,
            "christian"=> 0.00012,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17997"
        ],
        [
            "name"=> "Sali",
            "country"=> "India",
            "language"=> "Kannada",
            "religion"=> "Hinduism",
            "population"=> 1227000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "18002"
        ],
        [
            "name"=> "Sasak",
            "country"=> "Indonesia",
            "language"=> "Sasak",
            "religion"=> "Islam",
            "population"=> 3397000,
            "christian"=> 0.00018999999999999998,
            "window"=> "Yes",
            "region"=> "ID",
            "people_id"=> "14776"
        ],
        [
            "name"=> "Sayyid",
            "country"=> "India",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 9296000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "18045"
        ],
        [
            "name"=> "Sayyid",
            "country"=> "Pakistan",
            "language"=> "Sindhi",
            "religion"=> "Islam",
            "population"=> 6647000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "18045"
        ],
        [
            "name"=> "Shaikh",
            "country"=> "Pakistan",
            "language"=> "Sindhi",
            "religion"=> "Islam",
            "population"=> 12015000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "18084"
        ],
        [
            "name"=> "Shaikh Qureshi",
            "country"=> "India",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 9727000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21236"
        ],
        [
            "name"=> "Shaikh Qureshi",
            "country"=> "Pakistan",
            "language"=> "Sindhi",
            "religion"=> "Islam",
            "population"=> 1078000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "21236"
        ],
        [
            "name"=> "Shaikh Siddiqi",
            "country"=> "India",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 9019000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21815"
        ],
        [
            "name"=> "Shaikh unspecified",
            "country"=> "India",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 72220000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "18084"
        ],
        [
            "name"=> "Sindhi Sama",
            "country"=> "Pakistan",
            "language"=> "Sindhi",
            "religion"=> "Islam",
            "population"=> 1621000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "18164"
        ],
        [
            "name"=> "Sonar (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 8322000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "18150"
        ],
        [
            "name"=> "Soninke",
            "country"=> "Mali",
            "language"=> "Soninke",
            "religion"=> "Islam",
            "population"=> 1996000,
            "christian"=> 0.0001,
            "window"=> "Yes",
            "region"=> "ML",
            "people_id"=> "14996"
        ],
        [
            "name"=> "Sylhet (Muslim traditions)",
            "country"=> "Bangladesh",
            "language"=> "Sylheti",
            "religion"=> "Islam",
            "population"=> 12350000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "BG",
            "people_id"=> "22311"
        ],
        [
            "name"=> "Tajik",
            "country"=> "Tajikistan",
            "language"=> "Tajik",
            "religion"=> "Islam",
            "population"=> 7492000,
            "christian"=> 0.0005,
            "window"=> "Yes",
            "region"=> "TI",
            "people_id"=> "15201"
        ],
        [
            "name"=> "Tajik",
            "country"=> "Uzbekistan",
            "language"=> "Tajik",
            "religion"=> "Islam",
            "population"=> 1757000,
            "christian"=> 0.001,
            "window"=> "Yes",
            "region"=> "UZ",
            "people_id"=> "15201"
        ],
        [
            "name"=> "Tamboli (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 2226000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "18210"
        ],
        [
            "name"=> "Tamil (Muslim traditions)",
            "country"=> "Sri Lanka",
            "language"=> "Tamil",
            "religion"=> "Islam",
            "population"=> 1174000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "CE",
            "people_id"=> "15234"
        ],
        [
            "name"=> "Tamil (Muslim traditions)",
            "country"=> "India",
            "language"=> "Tamil",
            "religion"=> "Islam",
            "population"=> 3463000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "15234"
        ],
        [
            "name"=> "Tanti (Hindu traditions)",
            "country"=> "India",
            "language"=> "Bengali",
            "religion"=> "Hinduism",
            "population"=> 5805000,
            "christian"=> 0.00012,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "18217"
        ],
        [
            "name"=> "Tarkhan (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1043000,
            "christian"=> 0.00014000000000000001,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "18259"
        ],
        [
            "name"=> "Tarkhan (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 3185000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "17695"
        ],
        [
            "name"=> "Tarkhan (Sikh traditions)",
            "country"=> "India",
            "language"=> "Punjabi, Eastern",
            "religion"=> "Other / Small",
            "population"=> 1247000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "18177"
        ],
        [
            "name"=> "Tausug, Moro Joloano",
            "country"=> "Philippines",
            "language"=> "Tausug",
            "religion"=> "Islam",
            "population"=> 1394000,
            "christian"=> 2e-05,
            "window"=> "No",
            "region"=> "RP",
            "people_id"=> "15295"
        ],
        [
            "name"=> "Teli (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 22446000,
            "christian"=> 0.0002,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "18229"
        ],
        [
            "name"=> "Teli (Muslim traditions)",
            "country"=> "India",
            "language"=> "Urdu",
            "religion"=> "Islam",
            "population"=> 2026000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "17692"
        ],
        [
            "name"=> "Teli (Muslim traditions)",
            "country"=> "Pakistan",
            "language"=> "Punjabi, Western",
            "religion"=> "Islam",
            "population"=> 3041000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "PK",
            "people_id"=> "17692"
        ],
        [
            "name"=> "Thai Islam",
            "country"=> "Thailand",
            "language"=> "Thai",
            "religion"=> "Islam",
            "population"=> 1366000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "TH",
            "people_id"=> "19767"
        ],
        [
            "name"=> "Thori (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1130000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "18247"
        ],
        [
            "name"=> "Tili",
            "country"=> "India",
            "language"=> "Bengali",
            "religion"=> "Hinduism",
            "population"=> 1287000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "18254"
        ],
        [
            "name"=> "Tuareg, Tamajaq",
            "country"=> "Niger",
            "language"=> "Tamajaq, Tawallammat",
            "religion"=> "Islam",
            "population"=> 1208000,
            "christian"=> 0.0009,
            "window"=> "Yes",
            "region"=> "NG",
            "people_id"=> "15223"
        ],
        [
            "name"=> "Turk",
            "country"=> "Germany",
            "language"=> "Turkish",
            "religion"=> "Islam",
            "population"=> 2804000,
            "christian"=> 0,
            "window"=> "No",
            "region"=> "GM",
            "people_id"=> "18274"
        ],
        [
            "name"=> "Turk",
            "country"=> "T\u00fcrkiye (Turkey)",
            "language"=> "Turkish",
            "religion"=> "Islam",
            "population"=> 61482000,
            "christian"=> 0.0001,
            "window"=> "Yes",
            "region"=> "TU",
            "people_id"=> "18274"
        ],
        [
            "name"=> "Turkmen",
            "country"=> "Afghanistan",
            "language"=> "Turkmen",
            "religion"=> "Islam",
            "population"=> 2356000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "AF",
            "people_id"=> "15654"
        ],
        [
            "name"=> "Turkmen",
            "country"=> "Turkmenistan",
            "language"=> "Turkmen",
            "religion"=> "Islam",
            "population"=> 4945000,
            "christian"=> 0.0005,
            "window"=> "Yes",
            "region"=> "TX",
            "people_id"=> "15654"
        ],
        [
            "name"=> "Turkmen, Middle-Eastern",
            "country"=> "Iraq",
            "language"=> "Azerbaijani, South",
            "religion"=> "Islam",
            "population"=> 2684000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IZ",
            "people_id"=> "21538"
        ],
        [
            "name"=> "Uyghur",
            "country"=> "China",
            "language"=> "Uyghur",
            "religion"=> "Islam",
            "population"=> 11768000,
            "christian"=> 8e-05,
            "window"=> "Yes",
            "region"=> "CH",
            "people_id"=> "15755"
        ],
        [
            "name"=> "Uzbek, Northern",
            "country"=> "Uzbekistan",
            "language"=> "Uzbek, Northern",
            "religion"=> "Islam",
            "population"=> 28516000,
            "christian"=> 0.0002,
            "window"=> "Yes",
            "region"=> "UZ",
            "people_id"=> "14039"
        ],
        [
            "name"=> "Uzbek, Southern",
            "country"=> "Afghanistan",
            "language"=> "Uzbek, Southern",
            "religion"=> "Islam",
            "population"=> 4761000,
            "christian"=> 8.999999999999999e-05,
            "window"=> "Yes",
            "region"=> "AF",
            "people_id"=> "15756"
        ],
        [
            "name"=> "Vaddar (Hindu traditions)",
            "country"=> "India",
            "language"=> "Telugu",
            "religion"=> "Hinduism",
            "population"=> 4197000,
            "christian"=> 0.00058,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "18288"
        ],
        [
            "name"=> "Valmiki (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 5842000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "22348"
        ],
        [
            "name"=> "Vanjara",
            "country"=> "India",
            "language"=> "Marathi",
            "religion"=> "Hinduism",
            "population"=> 1145000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "18329"
        ],
        [
            "name"=> "Wolof",
            "country"=> "Senegal",
            "language"=> "Wolof",
            "religion"=> "Islam",
            "population"=> 5962000,
            "christian"=> 0.0001,
            "window"=> "Yes",
            "region"=> "SG",
            "people_id"=> "15414"
        ],
        [
            "name"=> "Yadav (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 41186000,
            "christian"=> 5e-05,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "16187"
        ],
        [
            "name"=> "Yadav (Hindu traditions)",
            "country"=> "Nepal",
            "language"=> "Maithili",
            "religion"=> "Hinduism",
            "population"=> 1053000,
            "christian"=> 0.0003,
            "window"=> "Yes",
            "region"=> "NP",
            "people_id"=> "16187"
        ],
        [
            "name"=> "Yadav Dhindhor",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1839000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21294"
        ],
        [
            "name"=> "Yadav Gaoli",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 5894000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21295"
        ],
        [
            "name"=> "Yadav Ghosi",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1862000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21822"
        ],
        [
            "name"=> "Yadav Gola",
            "country"=> "India",
            "language"=> "Telugu",
            "religion"=> "Hinduism",
            "population"=> 5680000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21296"
        ],
        [
            "name"=> "Yadav Gualbans (Hindu traditions)",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 5827000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21299"
        ],
        [
            "name"=> "Yadav Rawat",
            "country"=> "India",
            "language"=> "Hindi",
            "religion"=> "Hinduism",
            "population"=> 1720000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21300"
        ],
        [
            "name"=> "Yadav Sadgope",
            "country"=> "India",
            "language"=> "Bengali",
            "religion"=> "Hinduism",
            "population"=> 3105000,
            "christian"=> 0.00083,
            "window"=> "Yes",
            "region"=> "IN",
            "people_id"=> "21301"
        ],
        [
            "name"=> "Zaza-Dimli",
            "country"=> "T\u00fcrkiye (Turkey)",
            "language"=> "Zazaki, Southern",
            "religion"=> "Islam",
            "population"=> 1316000,
            "christian"=> 0,
            "window"=> "Yes",
            "region"=> "TU",
            "people_id"=> "11560"
        ]
    ];
    public  $nameAndCountry=[];
    public String $photo;
    public String $map;
    public $info=[];
    public String $body;

    private function generatePeopleGroup($translateTo, $index){
        try{
            $source = $this->sources[$index];

            $link = "https://joshuaproject.net/people_groups/".$source["people_id"]."/".$source["region"];

            $browser = new HttpBrowser(HttpClient::create());
            $browser->request('GET', $link);

            //Name and Country
            $browser->getCrawler()
                ->filter('span.link-text')
                ->each(function ($node) {
                    $this->nameAndCountry[] = $node->text();
                });

            //Image Source
            $this->photo = $browser->getCrawler()
                ->filter('.profile_image.img-responsive')
                ->image()->getUri();

            if($this->map = $browser->getCrawler()->filter('.profile_map.img-responsive')->count() > 0){
                //Extract Map Source
                $this->map = $browser->getCrawler()
                    ->filter('.profile_map.img-responsive')
                    ->image()->getUri();
            }else{
                $this->map = "";
            }

            //Extract info
            $browser->getCrawler()
                ->filter('.data > a')
                ->each(function ($node) {
                    $this->info[] = $node->text();
                });

            //Extract Body Content
            $this->body = $browser->getCrawler()
                ->filter('.content.left')->html();

        }
        catch(HttpClientException $exception){
            return response()->json(['message'=>'Failed to retrieve data']);
        }

        if(count($this->info) < 6){
            $christian = str_replace('\n'," ",$this->info[3]);
            $evangelical = $this->info[4];
        }else{
            $christian = str_replace('\n'," ",$this->info[4]);
            $evangelical = trim($this->info[5]);
        }

        //correct body
        $body = str_replace('h7',"strong",$this->body);

        return [
            'photo'       => $this->photo,
//            'index'       => $index,
//            'name'        => $this->nameAndCountry[0],
//            'country'     => $this->nameAndCountry[1],
            'name'        => GoogleTranslate::trans($this->nameAndCountry[0], $translateTo, 'en'),
            'country'     => GoogleTranslate::trans($this->nameAndCountry[1], $translateTo, 'en'),
            'population'  => $this->info[0],
            'language'    => GoogleTranslate::trans($this->info[1], $translateTo, 'en'),
            'religion'    => $source["religion"],
            'christian'   => $christian,
            'evangelical' => $evangelical,
            'window'      => $source["window"],
            'people_id'   => $source["people_id"],
            'map'         => GoogleTranslate::trans($this->map, $translateTo, 'en'),
            'body'        => GoogleTranslate::trans($body, $translateTo, 'en'),
            'link'        => $link,
        ];

    }
    public function show($translateTo, $index)
    {
        if(intval($index) < 0 || intval($index) >= count($this->sources)){
            //index out of range
            return response()->json(['message'=>'Index out of range'],404);
        }elseif (!isset($translateTo)){
            return response()->json(['message'=>'Translate to language not set'],400);
        }

        return response()->json($this->generatePeopleGroup($translateTo, $index));

    }

    public function showById($translateTo, $people_id)
    {
        $index = 0;
        $check = false;

        while($index < count($this->sources)){
            if($this->sources[$index]["people_id"] == $people_id) {
                $check = true;
                break;
            }
            $index++;
        }

        if ($check){
            return response()->json($this->generatePeopleGroup($translateTo, $index));
        }else{
            return response()->json(['message'=>'People Id could not be matched'],404);
        }
    }

    public function index($translateTo)
    {
        $index = 0;
        $list = [];

        while($index < count($this->sources)){
//            $list[] = $this->generatePeopleGroup($translateTo, $index);

            $index++;
        }
        Log::info("Hello World");
        return response()->json($list);
    }

    public function append(Request $request)
    {
        $arr = [];
        $index = 0;
        while ($index < count($this->sources)){
            $arr[]=[
                "photo"=> $request->images[$index]["photo"],
                "name"=> $this->sources[$index]["name"],
                "country"=> $this->sources[$index]["country"],
                "language"=> $this->sources[$index]["language"],
                "religion"=> $this->sources[$index]["religion"],
                "population"=> $this->sources[$index]["population"],
                "christian"=> $this->sources[$index]["christian"],
                "window"=> $this->sources[$index]["window"],
                "region"=> $this->sources[$index]["region"],
                "people_id"=> $this->sources[$index]["people_id"],
            ];
//            dd($arr);
            $index++;
        }
        return response()->json($arr);
    }

    public function sendFeedback(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required',
            'subject'   => 'required',
            'message'   => 'required'
        ]);

        try{
            Mail::to("kunozgamlowoka@gmail.com")->send(new FeedbackMail($request->name,$request->subject,$request->message,$request->email));
            return response()->json(["message"=>"Successfully sent"]);
        }catch(\Symfony\Component\Mailer\Exception\RuntimeException $exception){
            return response()->json(["message"=>$exception],400);

        }



    }
}

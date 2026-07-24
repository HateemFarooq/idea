<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->delete();

        // Build a map of country name => id from the database
        $countries = DB::table('countries')->pluck('id', 'name');

        // Helper to get country id or null if not in DB
        $id = fn (string $name) => $countries[$name] ?? null;

        $statesByCountry = [
            'Afghanistan' => [
                'Badakhshan', 'Badgis', 'Baglan', 'Balkh', 'Bamiyan', 'Farah', 'Faryab',
                'Gawr', 'Gazni', 'Herat', 'Hilmand', 'Jawzjan', 'Kabul', 'Kapisa', 'Khawst',
                'Kunar', 'Lagman', 'Lawghar', 'Nangarhar', 'Nimruz', 'Nuristan', 'Paktika',
                'Paktiya', 'Parwan', 'Qandahar', 'Qunduz', 'Samangan', 'Sar-e Pul', 'Takhar',
                'Uruzgan', 'Wardak', 'Zabul',
            ],
            'Albania' => [
                'Berat', 'Bulqize', 'Delvine', 'Devoll', 'Dibre', 'Durres', 'Elbasan', 'Fier',
                'Gjirokaster', 'Gramsh', 'Has', 'Kavaje', 'Kolonje', 'Korce', 'Kruje', 'Kucove',
                'Kukes', 'Kurbin', 'Lezhe', 'Librazhd', 'Lushnje', 'Mallakaster', 'Malsi e Madhe',
                'Mat', 'Mirdite', 'Peqin', 'Permet', 'Pogradec', 'Puke', 'Sarande', 'Shkoder',
                'Skrapar', 'Tepelene', 'Tirane', 'Tropoje', 'Vlore',
            ],
            'Algeria' => [
                "'Ayn Daflah", "'Ayn Tamushanat", 'Adrar', 'Algiers', 'Annabah', 'Bashshar',
                'Batnah', 'Bijayah', 'Biskrah', 'Blidah', 'Buirah', 'Bumardas', 'Burj Bu Arririj',
                'Ghalizan', 'Ghardayah', 'Ilizi', 'Jijili', 'Jilfah', 'Khanshalah', 'Masilah',
                'Midyah', 'Milah', 'Muaskar', 'Mustaghanam', 'Naama', 'Oran', 'Ouargla', 'Qalmah',
                'Qustantinah', 'Sakikdah', 'Satif', "Sayda'", "Sidi ban-al-'Abbas", 'Suq Ahras',
                'Tamanghasat', 'Tibazah', 'Tibissah', 'Tilimsan', 'Tinduf', 'Tisamsilt', 'Tiyarat',
                'Tizi Wazu', 'Umm-al-Bawaghi', 'Wahran', 'Warqla',
            ],
            'Argentina' => [
                'Buenos Aires', 'Catamarca', 'Chaco', 'Chubut', 'Cordoba', 'Corrientes',
                'Distrito Federal', 'Entre Rios', 'Formosa', 'Jujuy', 'La Pampa', 'La Rioja',
                'Mendoza', 'Misiones', 'Neuquen', 'Rio Negro', 'Salta', 'San Juan', 'San Luis',
                'Santa Cruz', 'Santa Fe', 'Santiago del Estero', 'Tierra del Fuego', 'Tucuman',
            ],
            'Australia' => [
                'Australian Capital Territory', 'New South Wales', 'Northern Territory',
                'Queensland', 'South Australia', 'Tasmania', 'Victoria', 'Western Australia',
            ],
            'Austria' => [
                'Burgenland', 'Carinthia', 'Lower Austria', 'Salzburg', 'Styria',
                'Tirol', 'Upper Austria', 'Vorarlberg', 'Wien',
            ],
            'Bangladesh' => [
                'Bagar Hat', 'Bandarban', 'Barguna', 'Barisal', 'Bhola', 'Bogora',
                'Brahman Bariya', 'Chandpur', 'Chattagam', 'Chittagong Division', 'Chuadanga',
                'Dhaka', 'Dinajpur', 'Faridpur', 'Feni', 'Gaybanda', 'Gazipur', 'Gopalganj',
                'Habiganj', 'Jaipur Hat', 'Jamalpur', 'Jessor', 'Jhalakati', 'Jhanaydah',
                'Khagrachhari', 'Khulna', 'Kishorganj', 'Koks Bazar', 'Komilla', 'Kurigram',
                'Kushtiya', 'Lakshmipur', 'Lalmanir Hat', 'Madaripur', 'Magura', 'Maimansingh',
                'Manikganj', 'Maulvi Bazar', 'Meherpur', 'Munshiganj', 'Naral', 'Narayanganj',
                'Narsingdi', 'Nator', 'Naugaon', 'Nawabganj', 'Netrakona', 'Nilphamari',
                'Noakhali', 'Pabna', 'Panchagarh', 'Patuakhali', 'Pirojpur', 'Rajbari',
                'Rajshahi', 'Rangamati', 'Rangpur', 'Satkhira', 'Shariatpur', 'Sherpur',
                'Silhat', 'Sirajganj', 'Sunamganj', 'Tangayal', 'Thakurgaon',
            ],
            'Belgium' => [
                'Antwerpen', 'Brabant', 'Brabant Wallon', 'Brussel', 'East Flanders',
                'Hainaut', 'Liege', 'Limburg', 'Luxembourg', 'Namur', 'Oost-Vlaanderen',
                'Vlaams-Brabant', 'Wallonne', 'West-Vlaanderen',
            ],
            'Brazil' => [
                'Acre', 'Alagoas', 'Amapa', 'Amazonas', 'Bahia', 'Ceara', 'Distrito Federal',
                'Espirito Santo', 'Goias', 'Maranhao', 'Mato Grosso', 'Mato Grosso do Sul',
                'Minas Gerais', 'Para', 'Paraiba', 'Parana', 'Pernambuco', 'Piaui',
                'Rio Grande do Norte', 'Rio Grande do Sul', 'Rio de Janeiro', 'Rondonia',
                'Roraima', 'Santa Catarina', 'Sao Paulo', 'Sergipe', 'Tocantins',
            ],
            'Canada' => [
                'Alberta', 'British Columbia', 'Manitoba', 'New Brunswick',
                'Newfoundland and Labrador', 'Northwest Territories', 'Nova Scotia', 'Nunavut',
                'Ontario', 'Prince Edward Island', 'Quebec', 'Saskatchewan', 'Yukon',
            ],
            'China' => [
                'Anhui', 'Beijing', 'Chongqing', 'Fujian', 'Gansu', 'Guangdong', 'Guangxi',
                'Guizhou', 'Hainan', 'Hebei', 'Heilongjiang', 'Henan', 'Hubei', 'Hunan',
                'Jiangsu', 'Jiangxi', 'Jilin', 'Liaoning', 'Nei Monggol', 'Ningxia Hui',
                'Qinghai', 'Shaanxi', 'Shandong', 'Shanghai', 'Shanxi', 'Sichuan', 'Tianjin',
                'Xinjiang', 'Xizang', 'Yunnan', 'Zhejiang',
            ],
            'Denmark' => [
                'Bornholm', 'Frederiksborg', 'Fyn', 'Kobenhavn', 'Nordjylland', 'Ribe',
                'Ringkobing', 'Roskilde', 'Sjaelland', 'Sonderjylland', 'Storstrom',
                'Vejle', 'Vestsjalland', 'Viborg',
            ],
            'Egypt' => [
                'Aswan', 'Asyut', 'Bani Suwayf', 'Cairo', 'Dumyat', 'Kafr-ash-Shaykh',
                'Matruh', 'Qina', 'Sawhaj', 'Sina al-Janubiyah', 'Sina ash-Shamaliyah',
                'al-Bahr-al-Ahmar', 'al-Buhayrah', 'al-Fayyum', 'al-Gharbiyah',
                'al-Iskandariyah', 'al-Ismailiyah', 'al-Jizah', 'al-Minufiyah', 'al-Minya',
                'al-Qahira', 'al-Qalyubiyah', 'al-Uqsur', 'al-Wadi al-Jadid',
                'as-Suways', 'ash-Sharqiyah',
            ],
            'France' => [
                'Ain', 'Aisne', 'Allier', 'Alpes-Maritimes', 'Alsace', 'Ardeche', 'Ardennes',
                'Ariege', 'Aube', 'Aude', 'Aveyron', 'Bas-Rhin', 'Bouches-du-Rhone', 'Calvados',
                'Cantal', 'Charente', 'Charente-Maritime', 'Cher', 'Correze', 'Corse-du-Sud',
                'Creuse', 'Deux-Sevres', 'Dordogne', 'Doubs', 'Drome', 'Essonne', 'Eure',
                'Eure-et-Loir', 'Finistere', 'Gard', 'Gers', 'Gironde', 'Haut-Rhin',
                'Haute-Corse', 'Haute-Garonne', 'Haute-Loire', 'Haute-Marne', 'Haute-Saone',
                'Haute-Savoie', 'Haute-Vienne', 'Hautes-Alpes', 'Hautes-Pyrenees',
                'Hauts-de-Seine', 'Herault', 'Ile-de-France', 'Ille-et-Vilaine', 'Indre',
                'Indre-et-Loire', 'Isere', 'Jura', 'Landes', 'Loir-et-Cher', 'Loire',
                'Loire-Atlantique', 'Loiret', 'Lot', 'Lot-et-Garonne', 'Lozere',
                'Maine-et-Loire', 'Manche', 'Marne', 'Mayenne', 'Meurthe-et-Moselle', 'Meuse',
                'Morbihan', 'Moselle', 'Nievre', 'Nord', 'Oise', 'Orne', 'Paris',
                'Pas-de-Calais', 'Pays de la Loire', 'Puy-de-Dome', 'Pyrenees-Atlantiques',
                'Pyrenees-Orientales', 'Rhone', 'Saone-et-Loire', 'Sarthe', 'Savoie',
                'Seine-Maritime', 'Seine-Saint-Denis', 'Seine-et-Marne', 'Somme', 'Tarn',
                'Tarn-et-Garonne', 'Territoire de Belfort', 'Var', 'Vaucluse', 'Vendee',
                'Vienne', 'Vosges', 'Yonne', 'Yvelines',
            ],
            'Germany' => [
                'Baden-Wurttemberg', 'Bavaria', 'Berlin', 'Brandenburg', 'Bremen', 'Hamburg',
                'Hessen', 'Lower Saxony', 'Mecklenburg-Vorpommern', 'Niedersachsen',
                'Nordrhein-Westfalen', 'North Rhine-Westphalia', 'Rheinland-Pfalz', 'Saarland',
                'Sachsen', 'Sachsen-Anhalt', 'Saxony', 'Schleswig-Holstein', 'Thuringia',
            ],
            'India' => [
                'Andaman and Nicobar Islands', 'Andhra Pradesh', 'Arunachal Pradesh', 'Assam',
                'Bihar', 'Chandigarh', 'Chhattisgarh', 'Dadra and Nagar Haveli', 'Daman and Diu',
                'Delhi', 'Goa', 'Gujarat', 'Haryana', 'Himachal Pradesh', 'Jammu and Kashmir',
                'Jharkhand', 'Karnataka', 'Kerala', 'Lakshadweep', 'Madhya Pradesh', 'Maharashtra',
                'Manipur', 'Meghalaya', 'Mizoram', 'Nagaland', 'Odisha', 'Pondicherry', 'Punjab',
                'Rajasthan', 'Sikkim', 'Tamil Nadu', 'Telangana', 'Tripura', 'Uttar Pradesh',
                'Uttarakhand', 'West Bengal',
            ],
            'Indonesia' => [
                'Aceh', 'Bali', 'Bangka-Belitung', 'Banten', 'Bengkulu', 'Gorontalo',
                'Jakarta', 'Jambi', 'Jawa Barat', 'Jawa Tengah', 'Jawa Timur',
                'Kalimantan Barat', 'Kalimantan Selatan', 'Kalimantan Tengah', 'Kalimantan Timur',
                'Lampung', 'Maluku', 'Maluku Utara', 'Nusa Tenggara Barat', 'Nusa Tenggara Timur',
                'Papua', 'Riau', 'Riau Kepulauan', 'Sulawesi Selatan', 'Sulawesi Tengah',
                'Sulawesi Tenggara', 'Sulawesi Utara', 'Sumatera Barat', 'Sumatera Selatan',
                'Sumatera Utara', 'Yogyakarta',
            ],
            'Iran' => [
                'Ardabil', 'Azarbayjan-e Bakhtari', 'Azarbayjan-e Khavari', 'Bushehr',
                'Chahar Mahal-e Bakhtiari', 'Esfahan', 'Fars', 'Gilan', 'Golestan', 'Hamadan',
                'Hormozgan', 'Ilam', 'Kerman', 'Kermanshah', 'Khorasan', 'Khuzestan',
                'Kohgiluyeh-e Boyerahmad', 'Kordestan', 'Lorestan', 'Markazi', 'Mazandaran',
                'Qazvin', 'Qom', 'Semnan', 'Sistan-e Baluchestan', 'Tehran', 'Yazd', 'Zanjan',
            ],
            'Iraq' => [
                'Babil', 'Baghdad', 'Dahuk', 'Dhi Qar', 'Diyala', 'Erbil', 'Karbala',
                'Kurdistan', 'Maysan', 'Ninawa', 'Salah-ad-Din', 'Wasit', 'al-Anbar',
                'al-Basrah', 'al-Muthanna', 'al-Qadisiyah', 'an-Najaf', 'as-Sulaymaniyah',
            ],
            'Italy' => [
                'Abruzzo', 'Agrigento', 'Alessandria', 'Ancona', 'Arezzo', 'Ascoli Piceno',
                'Asti', 'Avellino', 'Bari', 'Basilicata', 'Belluno', 'Benevento', 'Bergamo',
                'Biella', 'Bologna', 'Bolzano', 'Brescia', 'Brindisi', 'Calabria', 'Campania',
                'Caserta', 'Catania', 'Chieti', 'Como', 'Cosenza', 'Cremona', 'Cuneo',
                'Emilia-Romagna', 'Ferrara', 'Firenze', 'Friuli-Venezia Giulia', 'Frosinone',
                'Genoa', 'Gorizia', 'Lazio', 'Lecce', 'Lecco', 'Liguria', 'Lodi', 'Lombardia',
                'Macerata', 'Mantova', 'Marche', 'Messina', 'Milan', 'Modena', 'Molise',
                'Naples', 'Novara', 'Padova', 'Parma', 'Pavia', 'Perugia', 'Pesaro-Urbino',
                'Piacenza', 'Piedmont', 'Pisa', 'Pordenone', 'Potenza', 'Puglia',
                'Reggio Emilia', 'Rimini', 'Roma', 'Salerno', 'Sardegna', 'Sassari', 'Savona',
                'Sicilia', 'Siena', 'Sondrio', 'South Tyrol', 'Taranto', 'Teramo', 'Torino',
                'Toscana', 'Trapani', 'Trentino-Alto Adige', 'Trento', 'Treviso', 'Udine',
                'Umbria', 'Varese', 'Veneto', 'Venezia', 'Vercelli', 'Verona', 'Vicenza',
                'Viterbo',
            ],
            'Japan' => [
                'Aichi', 'Akita', 'Aomori', 'Chiba', 'Ehime', 'Fukui', 'Fukuoka', 'Fukushima',
                'Gifu', 'Gumma', 'Hiroshima', 'Hokkaido', 'Hyogo', 'Ibaraki', 'Ishikawa',
                'Iwate', 'Kagawa', 'Kagoshima', 'Kanagawa', 'Kochi', 'Kumamoto', 'Kyoto',
                'Mie', 'Miyagi', 'Miyazaki', 'Nagano', 'Nagasaki', 'Nara', 'Niigata', 'Oita',
                'Okayama', 'Okinawa', 'Osaka', 'Saga', 'Saitama', 'Shiga', 'Shimane',
                'Shizuoka', 'Tochigi', 'Tokushima', 'Tokyo', 'Tottori', 'Toyama', 'Wakayama',
                'Yamagata', 'Yamaguchi', 'Yamanashi',
            ],
            'Malaysia' => [
                'Johor', 'Kedah', 'Kelantan', 'Kuala Lumpur', 'Labuan', 'Melaka',
                'Negeri Sembilan', 'Pahang', 'Penang', 'Perak', 'Perlis', 'Pulau Pinang',
                'Sabah', 'Sarawak', 'Selangor', 'Terengganu',
            ],
            'Mexico' => [
                'Aguascalientes', 'Baja California', 'Baja California Sur', 'Campeche',
                'Chiapas', 'Chihuahua', 'Coahuila', 'Colima', 'Distrito Federal', 'Durango',
                'Guanajuato', 'Guerrero', 'Hidalgo', 'Jalisco', 'Mexico', 'Michoacan', 'Morelos',
                'Nayarit', 'Nuevo Leon', 'Oaxaca', 'Puebla', 'Queretaro', 'Quintana Roo',
                'San Luis Potosi', 'Sinaloa', 'Sonora', 'Tabasco', 'Tamaulipas', 'Tlaxcala',
                'Veracruz', 'Yucatan', 'Zacatecas',
            ],
            'Netherlands' => [
                'Drenthe', 'Flevoland', 'Friesland', 'Gelderland', 'Groningen', 'Limburg',
                'Noord-Brabant', 'Noord-Holland', 'Overijssel', 'South Holland', 'Utrecht',
                'Zeeland', 'Zuid-Holland',
            ],
            'New Zealand' => [
                'Auckland', 'Bay of Plenty', 'Canterbury', 'Gisborne', "Hawke's Bay",
                'Manawatu-Wanganui', 'Marlborough', 'Nelson', 'Northland', 'Otago',
                'Southland', 'Taranaki', 'Tasman', 'Waikato', 'Wellington', 'West Coast',
            ],
            'Nigeria' => [
                'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue',
                'Borno', 'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'Gombe',
                'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara',
                'Lagos', 'Nassarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau',
                'Rivers', 'Sokoto', 'Taraba', 'Yobe', 'Zamfara',
            ],
            'Norway' => [
                'Akershus', 'Aust Agder', 'Buskerud', 'Finnmark', 'Hedmark', 'Hordaland',
                'Moere og Romsdal', 'Nord Trondelag', 'Nordland', 'Oppland', 'Oslo',
                'Rogaland', 'Soer Troendelag', 'Sogn og Fjordane', 'Telemark', 'Troms',
                'Vest Agder', 'Vestfold',
            ],
            'Pakistan' => [
                'Azad kashmir', 'Balochistan', 'Fata', 'Gilgit–baltistan',
                'Islamabad capital territory', 'Khyber Pakhtunkhwa', 'Punjab', 'Sindh',
            ],
            'Philippines' => [
                'Bicol', 'Caraga', 'Central Luzon', 'Central Mindanao', 'Central Visayas',
                'Cordillera', 'Davao', 'Eastern Visayas', 'Ilocos', 'Luzon',
                'Metropolitan Manila Area', 'Muslim Mindanao', 'Northern Mindanao',
                'Southern Mindanao', 'Southern Tagalog', 'Western Mindanao', 'Western Visayas',
            ],
            'Qatar' => [
                'Doha', 'Jarian-al-Batnah', 'Umm Salal', 'ad-Dawhah', 'al-Ghuwayriyah',
                'al-Jumayliyah', 'al-Khawr', 'al-Wakrah', 'ar-Rayyan', 'ash-Shamal',
            ],
            'Russia' => [
                'Adygeja', 'Altaj', 'Amur', 'Arhangelsk', 'Astrahan', 'Bashkortostan',
                'Belgorod', 'Brjansk', 'Burjatija', 'Chechenija', 'Cheljabinsk', 'Chita',
                'Chukotka', 'Chuvashija', 'Dagestan', 'Gorno-Altaj', 'Habarovsk', 'Hakasija',
                'Ingusetija', 'Irkutsk', 'Ivanovo', 'Jaroslavl', 'Kabardino-Balkarija',
                'Kaliningrad', 'Kalmykija', 'Kaluga', 'Kamchatka', 'Karachaj-Cherkessija',
                'Karelija', 'Kemerovo', 'Kirov', 'Komi', 'Kostroma', 'Krasnodar',
                'Krasnojarsk', 'Kurgan', 'Kursk', 'Leningrad', 'Lipeck', 'Magadan', 'Marij El',
                'Mordovija', 'Moscow', 'Moskovskaya Oblast', 'Murmansk', 'Nenets',
                'Nizhnij Novgorod', 'Novgorod', 'Novosibirsk', 'Omsk', 'Orenburg', 'Orjol',
                'Penza', 'Perm', 'Primorje', 'Pskov', 'Rjazan', 'Rostov', 'Saha', 'Sahalin',
                'Samara', 'Sankt-Peterburg', 'Saratov', 'Smolensk', 'Stavropol', 'Sverdlovsk',
                'Tambov', 'Tatarstan', 'Tjumen', 'Tomsk', 'Tula', 'Tver', 'Udmurtija',
                'Uljanovsk', 'Vladimir', 'Volgograd', 'Vologda', 'Voronezh',
            ],
            'South Korea' => [
                'Busan', 'Cheju', 'Chollabuk', 'Chollanam', 'Chungcheongbuk', 'Chungcheongnam',
                'Daegu', 'Gangwon-do', 'Gyeonggi-do', 'Gyeongsangnam-do', 'Incheon',
                'Jeju-Si', 'Jeonbuk', 'Kwangju', 'Kyeongsangbuk', 'Pusan', 'Seoul', 'Taegu',
                'Taejeon', 'Ulsan',
            ],
            'Thailand' => [
                'Amnat Charoen', 'Ang Thong', 'Bangkok', 'Bung Kan', 'Buriram', 'Chachoengsao',
                'Chai Nat', 'Chaiyaphum', 'Chanthaburi', 'Chiang Mai', 'Chiang Rai',
                'Chon Buri', 'Chumphon', 'Kalasin', 'Kamphaeng Phet', 'Kanchanaburi',
                'Khon Kaen', 'Krabi', 'Lampang', 'Lamphun', 'Loei', 'Lop Buri', 'Mae Hong Son',
                'Maha Sarakham', 'Mukdahan', 'Nakhon Nayok', 'Nakhon Pathom',
                'Nakhon Phanom', 'Nakhon Ratchasima', 'Nakhon Sawan', 'Nakhon Si Thammarat',
                'Nan', 'Narathiwat', 'Nong Bua Lam Phu', 'Nong Khai', 'Nonthaburi',
                'Pathum Thani', 'Pattani', 'Phang Nga', 'Phatthalung', 'Phayao', 'Phetchabun',
                'Phetchaburi', 'Phichit', 'Phitsanulok', 'Phra Nakhon Si Ayutthaya',
                'Phrae', 'Phuket', 'Prachin Buri', 'Prachuap Khiri Khan', 'Ranong',
                'Ratchaburi', 'Rayong', 'Roi Et', 'Sa Kaeo', 'Sakon Nakhon', 'Samut Prakan',
                'Samut Sakhon', 'Samut Songkhram', 'Saraburi', 'Satun', 'Si Sa Ket',
                'Sing Buri', 'Songkhla', 'Sukhothai', 'Suphan Buri', 'Surat Thani', 'Surin',
                'Tak', 'Trang', 'Trat', 'Ubon Ratchathani', 'Udon Thani', 'Uthai Thani',
                'Uttaradit', 'Yala', 'Yasothon',
            ],
            'Turkey' => [
                'Adana', 'Adiyaman', 'Afyonkarahisar', 'Agri', 'Aksaray', 'Amasya', 'Ankara',
                'Antalya', 'Ardahan', 'Artvin', 'Aydin', 'Balikesir', 'Bartin', 'Batman',
                'Bayburt', 'Bilecik', 'Bingol', 'Bitlis', 'Bolu', 'Burdur', 'Bursa',
                'Canakkale', 'Cankiri', 'Corum', 'Denizli', 'Diyarbakir', 'Duzce', 'Edirne',
                'Elazig', 'Erzincan', 'Erzurum', 'Eskisehir', 'Gaziantep', 'Giresun',
                'Gumushane', 'Hakkari', 'Hatay', 'Igdir', 'Isparta', 'Istanbul', 'Izmir',
                'Kahramanmaras', 'Karabuk', 'Karaman', 'Kars', 'Kastamonu', 'Kayseri',
                'Kilis', 'Kirikkale', 'Kirklareli', 'Kirsehir', 'Kocaeli', 'Konya', 'Kutahya',
                'Malatya', 'Manisa', 'Mardin', 'Mersin', 'Mugla', 'Mus', 'Nevsehir', 'Nigde',
                'Ordu', 'Osmaniye', 'Rize', 'Sakarya', 'Samsun', 'Sanliurfa', 'Siirt',
                'Sinop', 'Sirnak', 'Sivas', 'Tekirdag', 'Tokat', 'Trabzon', 'Tunceli', 'Usak',
                'Van', 'Yalova', 'Yozgat', 'Zonguldak',
            ],
            'United Arab Emirates' => [
                'Abu Dhabi', 'Ajman', 'Dubai', 'Fujairah', 'Ras al-Khaimah',
                'Sharjah', 'Umm al-Quwain',
            ],
            'United Kingdom' => [
                'England', 'Northern Ireland', 'Scotland', 'Wales',
            ],
            'United States' => [
                'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado',
                'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois',
                'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland',
                'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana',
                'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York',
                'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania',
                'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah',
                'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming',
            ],
        ];

        $rows = [];
        foreach ($statesByCountry as $countryName => $states) {
            $countryId = $id($countryName);
            if (! $countryId) {
                continue; // skip countries not in DB
            }
            foreach ($states as $stateName) {
                $rows[] = ['name' => $stateName, 'country_id' => $countryId];
            }
        }

        // Insert in chunks to avoid query size limits
        foreach (array_chunk($rows, 100) as $chunk) {
            DB::table('states')->insert($chunk);
        }
    }
}

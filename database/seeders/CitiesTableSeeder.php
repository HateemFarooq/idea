<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cities')->delete();

        $states = DB::table('states')->pluck('id', 'name');
        $id = fn (string $name) => $states[$name] ?? null;

        $data = [
            // INDIA
            'Andaman and Nicobar Islands' => ['Port Blair', 'Rangat', 'Diglipur', 'Mayabunder', 'Garacharma'],
            'Andhra Pradesh' => ['Visakhapatnam', 'Vijayawada', 'Guntur', 'Nellore', 'Kurnool', 'Rajahmundry', 'Tirupati', 'Kakinada', 'Anantapur', 'Vizianagaram'],
            'Arunachal Pradesh' => ['Itanagar', 'Naharlagun', 'Pasighat', 'Tawang', 'Ziro', 'Along', 'Tezu'],
            'Assam' => ['Guwahati', 'Silchar', 'Dibrugarh', 'Jorhat', 'Nagaon', 'Tinsukia', 'Tezpur'],
            'Bihar' => ['Patna', 'Gaya', 'Bhagalpur', 'Muzaffarpur', 'Darbhanga', 'Bihar Sharif', 'Arrah', 'Begusarai'],
            'Chandigarh' => ['Chandigarh'],
            'Chhattisgarh' => ['Raipur', 'Bhilai', 'Korba', 'Bilaspur', 'Durg', 'Jagdalpur', 'Ambikapur'],
            'Dadra and Nagar Haveli' => ['Silvassa'],
            'Daman and Diu' => ['Daman', 'Diu'],
            'Delhi' => ['New Delhi', 'Delhi', 'Shahdara', 'Rohini', 'Dwarka', 'Janakpuri'],
            'Goa' => ['Panaji', 'Margao', 'Vasco da Gama', 'Mapusa', 'Ponda'],
            'Gujarat' => ['Ahmedabad', 'Surat', 'Vadodara', 'Rajkot', 'Bhavnagar', 'Jamnagar', 'Gandhinagar', 'Junagadh'],
            'Haryana' => ['Faridabad', 'Gurgaon', 'Panipat', 'Ambala', 'Yamunanagar', 'Rohtak', 'Hisar', 'Karnal'],
            'Himachal Pradesh' => ['Shimla', 'Manali', 'Dharamsala', 'Solan', 'Mandi', 'Kullu'],
            'Jammu and Kashmir' => ['Srinagar', 'Jammu', 'Anantnag', 'Baramulla', 'Sopore', 'Kathua'],
            'Jharkhand' => ['Ranchi', 'Jamshedpur', 'Dhanbad', 'Bokaro', 'Deoghar', 'Hazaribag'],
            'Karnataka' => ['Bengaluru', 'Mysore', 'Hubli-Dharwad', 'Mangalore', 'Belgaum', 'Kalaburagi', 'Davanagere', 'Bellary'],
            'Kerala' => ['Thiruvananthapuram', 'Kochi', 'Kozhikode', 'Kollam', 'Thrissur', 'Alappuzha', 'Palakkad'],
            'Lakshadweep' => ['Kavaratti', 'Agatti', 'Minicoy'],
            'Madhya Pradesh' => ['Bhopal', 'Indore', 'Gwalior', 'Jabalpur', 'Ujjain', 'Sagar', 'Dewas', 'Satna', 'Ratlam'],
            'Maharashtra' => ['Mumbai', 'Pune', 'Nagpur', 'Thane', 'Nashik', 'Aurangabad', 'Solapur', 'Kolhapur', 'Amravati', 'Nanded'],
            'Manipur' => ['Imphal', 'Thoubal', 'Churachandpur'],
            'Meghalaya' => ['Shillong', 'Tura', 'Jowai'],
            'Mizoram' => ['Aizawl', 'Lunglei', 'Champhai'],
            'Nagaland' => ['Kohima', 'Dimapur', 'Mokokchung'],
            'Odisha' => ['Bhubaneswar', 'Cuttack', 'Rourkela', 'Berhampur', 'Sambalpur', 'Puri'],
            'Pondicherry' => ['Pondicherry', 'Karaikal', 'Mahe', 'Yanam'],
            'Punjab' => ['Ludhiana', 'Amritsar', 'Jalandhar', 'Patiala', 'Bathinda', 'Mohali', 'Hoshiarpur'],
            'Rajasthan' => ['Jaipur', 'Jodhpur', 'Kota', 'Bikaner', 'Ajmer', 'Udaipur', 'Bhilwara'],
            'Sikkim' => ['Gangtok', 'Namchi', 'Ravangla'],
            'Tamil Nadu' => ['Chennai', 'Coimbatore', 'Madurai', 'Tiruchirappalli', 'Salem', 'Tirunelveli', 'Vellore', 'Erode'],
            'Telangana' => ['Hyderabad', 'Warangal', 'Nizamabad', 'Karimnagar', 'Ramagundam', 'Khammam'],
            'Tripura' => ['Agartala', 'Udaipur', 'Dharmanagar'],
            'Uttar Pradesh' => ['Lucknow', 'Kanpur', 'Agra', 'Varanasi', 'Meerut', 'Allahabad', 'Ghaziabad', 'Noida', 'Bareilly', 'Aligarh'],
            'Uttarakhand' => ['Dehradun', 'Haridwar', 'Roorkee', 'Rishikesh', 'Haldwani'],
            'West Bengal' => ['Kolkata', 'Howrah', 'Asansol', 'Siliguri', 'Durgapur', 'Bardhaman', 'Malda'],

            // USA
            'Alabama' => ['Birmingham', 'Montgomery', 'Mobile', 'Huntsville', 'Tuscaloosa'],
            'Alaska' => ['Anchorage', 'Juneau', 'Fairbanks', 'Sitka', 'Wasilla'],
            'California' => ['Los Angeles', 'San Francisco', 'San Diego', 'San Jose', 'Sacramento', 'Oakland', 'Fresno', 'Long Beach'],
            'Florida' => ['Miami', 'Orlando', 'Tampa', 'Jacksonville', 'Tallahassee', 'Fort Lauderdale', 'St. Petersburg'],
            'New York' => ['New York City', 'Buffalo', 'Rochester', 'Yonkers', 'Syracuse', 'Albany'],
            'Texas' => ['Houston', 'Austin', 'Dallas', 'San Antonio', 'Fort Worth', 'El Paso', 'Arlington', 'Corpus Christi'],
            'Washington' => ['Seattle', 'Spokane', 'Tacoma', 'Vancouver', 'Bellevue', 'Olympia'],

            // UNITED KINGDOM
            'England' => ['London', 'Birmingham', 'Manchester', 'Liverpool', 'Leeds', 'Sheffield', 'Bristol', 'Newcastle', 'Leicester'],
            'Scotland' => ['Glasgow', 'Edinburgh', 'Aberdeen', 'Dundee', 'Inverness', 'Perth'],
            'Wales' => ['Cardiff', 'Swansea', 'Newport', 'Bangor', 'St Davids'],
            'Northern Ireland' => ['Belfast', 'Londonderry', 'Lisburn', 'Newry', 'Armagh'],

            // AUSTRALIA
            'New South Wales' => ['Sydney', 'Newcastle', 'Wollongong', 'Central Coast', 'Maitland'],
            'Victoria' => ['Melbourne', 'Geelong', 'Ballarat', 'Bendigo', 'Shepparton'],
            'Queensland' => ['Brisbane', 'Gold Coast', 'Sunshine Coast', 'Townsville', 'Cairns'],
            'Western Australia' => ['Perth', 'Rockingham', 'Mandurah', 'Bunbury', 'Geraldton'],
            'South Australia' => ['Adelaide', 'Mount Gambier', 'Whyalla', 'Gawler', 'Murray Bridge'],

            // CANADA
            'Ontario' => ['Toronto', 'Ottawa', 'Mississauga', 'Brampton', 'Hamilton', 'London', 'Markham'],
            'Quebec' => ['Montreal', 'Quebec City', 'Laval', 'Gatineau', 'Longueuil', 'Sherbrooke'],
            'British Columbia' => ['Vancouver', 'Victoria', 'Surrey', 'Burnaby', 'Richmond', 'Kelowna'],
            'Alberta' => ['Calgary', 'Edmonton', 'Red Deer', 'Lethbridge', 'St. Albert'],

            // GERMANY
            'Bavaria' => ['Munich', 'Nuremberg', 'Augsburg', 'Regensburg', 'Ingolstadt', 'Wurzburg'],
            'Berlin' => ['Berlin'],
            'Hamburg' => ['Hamburg'],
            'North Rhine-Westphalia' => ['Cologne', 'Dusseldorf', 'Dortmund', 'Essen', 'Duisburg', 'Bochum', 'Wuppertal', 'Bielefeld', 'Bonn'],

            // JAPAN
            'Tokyo' => ['Tokyo', 'Shinjuku', 'Shibuya', 'Chiyoda', 'Minato', 'Taito'],
            'Osaka' => ['Osaka', 'Sakai', 'Higashiosaka', 'Hirakata', 'Toyonaka', 'Suita'],
            'Kanagawa' => ['Yokohama', 'Kawasaki', 'Sagamihara', 'Fujisawa', 'Yokosuka'],
            'Aichi' => ['Nagoya', 'Toyohashi', 'Okazaki', 'Ichinomiya', 'Kasugai'],

            // CHINA
            'Beijing' => ['Beijing'],
            'Shanghai' => ['Shanghai'],
            'Guangdong' => ['Guangzhou', 'Shenzhen', 'Dongguan', 'Foshan', 'Zhongshan', 'Huizhou'],
            'Sichuan' => ['Chengdu', 'Mianyang', 'Nanchong', 'Luzhou', 'Yibin'],

            // FRANCE
            'Ile-de-France' => ['Paris', 'Boulogne-Billancourt', 'Saint-Denis', 'Argenteuil', 'Montreuil'],
            'Rhone' => ['Lyon', 'Villeurbanne', 'Venissieux', 'Saint-Priest', 'Caluire-et-Cuire'],
            'Bouches-du-Rhone' => ['Marseille', 'Aix-en-Provence', 'Arles', 'Martigues', 'Aubagne'],

            // PAKISTAN
            'Punjab' => ['Lahore', 'Faisalabad', 'Rawalpindi', 'Multan', 'Gujranwala', 'Sialkot', 'Bahawalpur'],
            'Sindh' => ['Karachi', 'Hyderabad', 'Sukkur', 'Larkana', 'Nawabshah', 'Mirpur Khas'],
            'Islamabad capital territory' => ['Islamabad'],
        ];

        $rows = [];
        foreach ($data as $stateName => $cities) {
            $stateId = $id($stateName);
            if (! $stateId) {
                continue;
            }
            foreach ($cities as $city) {
                $rows[] = [
                    'name' => $city,
                    'state_id' => $stateId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        foreach (array_chunk($rows, 100) as $chunk) {
            DB::table('cities')->insert($chunk);
        }
    }
}

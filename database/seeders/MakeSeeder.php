<?php

namespace Database\Seeders;

use App\Models\Make;
use App\Models\vehicleModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $carData = [
            'Audi' => ['A3', 'A4', 'A5', 'A6', 'Q3', 'Q5', 'Q7', 'SQ5'],
            'BMW' => [
                '114', '116', '320', '320i', '323', '420 Gran Coupé',
                '523', '528i', '535', 'X1', 'X2', 'X3', 'X5', 'X5 M50', 'X6'
            ],
            'Chevrolet' => [
                'Captiva', 'Cruze', 'Lumina'
            ],
            'Chrysler' => [
                '300C', 'Crossfire'
            ],
            'Citroën' => [
                'Citroën C3', 'Citroën DS4'
            ],
            'Daihatsu' => [
                'Hijet', 'Mira', 'Move'
            ],
            'EICHER' => [
                'Pro 3008', 'Pro 3009', 'Pro 5025T'
            ],
            'Ford' => [
                'B-Max', 'Escape', 'Fiesta', 'Fusion Titanium 2.0L', 'Kuga',
                'Mustang', 'Ranger', 'Ranger D/C', 'Ranger D/C XLT'
            ],
            'HINO' => [
                'HINO 185', 'HINO 300 WC'
            ],
            'Honda' => [
                'Airwave', 'Aqua hybrid', 'CR-V', 'CR-Z', 'Fit', 'Fit Hybrid',
                'Fit shuttle', 'Fit shuttle hybrid', 'Grace', 'Insight Hybrid',
                'Logo', 'Mobilio', 'Odyssey', 'Spada', 'Spike', 'Stepwgn Spada',
                'Stpwgn', 'Stream', 'Vezel'
            ],
            'Hyundai' => [
                'Santa Fe', 'Sonata'
            ],
            'Isuzu' => [
                'Como', 'D-Max', 'Elf', 'FRR', 'FSR', 'NKR', 'NPR', 'NQR'
            ],
            'Jaguar' => [
                'E-Pace', 'F-Pace', 'XE', 'XF'
            ],
            'Jeep' => [
                'Cherokee', 'Comanche', 'Compass', 'Grand Cherokee', 'Laredo', 'Wrangler'
            ],
            'Kia' => [
                'Kia Sorento'
            ],
            'Land Rover' => [
                '88', 'Defender', 'Discovery', 'Discovery 3', 'Discovery 4', 'Discovery Sport',
                'Freelander', 'Range Rover', 'Range Rover Autobiography', 'Range Rover Evoque',
                'Range Rover HSE', 'Range Rover Sport', 'Range Rover Velar', 'Range Rover Vogue'
            ],
            'Lexus' => [
                '570', 'GS 450', 'GX 460', '270', 'RX 270', 'RX 450', 'RX 450h', 'LX 570', 'NX 200',
                'NX 300', 'RX 200', 'RX 270', 'RX 300', 'RX 350'
            ],
            'Man' => [
                'Jeep Comanche', 'Man TGA 28.410'
            ],
            'Maserati' => [
                'Maserati Ghibli'
            ],
            'Mazda' => [
                'Mazda 3', 'Mazda 5', 'Mazda 6', 'Atenza', 'Axela', 'Biante', 'Bongo', 'Carol', 'CX-3', 'CX-5',
                'CX-9', 'Demio', 'Familia', 'Flair', 'Premacy', 'Roadster', 'Scrum', 'Titan', 'Verisa'
            ],
            'Mercedes-Benz' => [
                '1840', '200', '220', '250', '500', 'A 180', 'ACTROS', 'B 180', 'C 180', 'C 200', 'C 250',
                'CE 220', 'CL 180', 'CLA 180', 'CLS 350', 'E 200', 'E 220', 'E 240', 'E 250', 'E 300',
                'E 320', 'E 350', 'GL 320', 'GL 500', 'GLA 180', 'GLA 250', 'GLC 250', 'GLE 350', 'GLE 63 AMG',
                'ML 250', 'ML 280', 'ML 350', 'ML 63 AMG', 'S 320', 'S 350', 'S 400', 'S 500', 'S 550', 'SLK 200',
                'Sprinter'
            ],
            'MINI' => [
                'MINI Cooper'
            ],
            'Mitsubishi' => [
                'Canter', 'Delica', 'EK wagon', 'FH', 'Fuso', 'Galant', 'L200', 'Lancer', 'Minicab', 'Mirage',
                'New Outlander', 'Outlander GLX', 'Outlander hybrid', 'Pajero', 'Pajero Sport GLX Did',
                'Plug-in Hybrid Outlander', 'RVR', 'Shogun'
            ],
            'MOBIUS' => [
                'MOBIUS 3'
            ],
            'Nissan' => [
                'AD Expert', 'Advan', 'Almera', 'Atlas', 'Bluebird', 'Caravan', 'Cube', 'Dayz', 'Dualis', 'Elgrand',
                'e-NV200', 'Juke', 'Lafesta', 'Latio', 'Leaf', 'March', 'Moco', 'Murano', 'Note', 'Note medalist',
                'Note Nismo', 'Note Rider', 'NP200', 'NP 300', 'NV 100 clipper', 'NV200', 'NV250', 'NV300', 'NV350',
                'NV3500', 'Patrol', 'Qashqai', 'Serena', 'Serena Hybrid', 'Skyline', 'Sunny', 'Sylphy', 'Teana',
                'Tiida', 'Vanette', 'Wingroad', 'X-Trail'
            ],
            'Peugeot' => [
                '208', '3008', '308', '5008', '504', 'RCZ'
            ],
            'Porsche' => [
                '911', 'Cayenne', 'Panamera'
            ],
            'Range Rover' => [
                'Autobiography', 'HSE LR4', 'Range Rover', 'Evoque', 'Hse', 'Sport', 'Velar', 'Vogue'
            ],
            'Subaru' => [
                'B9 Tribeca', 'Exiga', 'Forester', 'G4', 'Impreza', 'Legacy', 'Levorg', 'Outback', 'Pleo',
                'Trezia', 'WRX STI', 'XT', 'XV'
            ],
            'Suzuki' => [
                'Alto GLX', 'Carry', 'Escudo', 'Every', 'Hustler', 'Jimny GL', 'Solio', 'Spacia', 'S-presso GL',
                'Stingray', 'Swift GLX', 'Swift RS', 'SX4', 'Vitara', 'Wagon', 'Wagon R', 'Wagon R+', 'Wagon R limited'
            ],
            'Toyota' => [
                '110', 'Allion', 'Alphard', 'Aqua', 'Auris', 'Avensis', 'Axio', 'Axio', 'Axio hybrid', 'Bb', 'Belta',
                'Camry', 'Carina', 'Celica', 'C-HR', 'Coaster', 'Commuter', 'Corolla', 'Corolla Cross', 'Corolla Hybrid',
                'Corolla Verso', 'Crown', 'Crown Athlete', 'Crown Majesta', 'Crown Royal saloon', 'Crown Royal saloon Hybrid',
                'DynaToyota DYNA 200', 'Fielder', 'Fielder', 'Fielder hybrid', 'Fielder hybrid', 'FJ Cruiser', 'Fortuner',
                'GrandHiace', 'GT86', 'Harrier', 'Harrier', 'Harrier hybrid', 'Hiace', 'Hilux', 'Hilux', 'Hilux Revo',
                'Hilux Surf', 'Hilux vigo', 'Ipsum', 'Isis', 'Ist', 'Land Cruiser', 'Landcruiser 76', 'Landcruiser HZJ',
                'Landcruiser Prado', 'Landcruiser prado TX', 'Landcruiser prado TX.L', 'Landcruiser prado TZ',
                'Landcruiser prado TZ.L', 'Landcruiser TX.G', 'Landcruiser V8', 'Landcruiser vx.I', 'Landcruiser Vx V8',
                'Landcruiser ZX', 'Lexus 270', 'Lexus RX 270', 'Lexus RX 270', 'Lexus RX 450', 'Lexus RX 450h', 'Lite-Ace',
                'Mark II', 'Mark X', 'Noah', 'Paseo', 'Passo', 'Passo Hana', 'Pixis', 'Porte', 'Prado', 'Prado TXL', 'Prado VX',
                'Premio', 'Prius', 'Prius Hybrid', 'Probox', 'Ractis', 'Ractis Lepice', 'RAV 4', 'Regius', 'Regiusace', 'Rumion',
                'Rush', 'SAI', 'Sienna', 'Sienta', 'Spade', 'Starlet', 'Succeed', 'Succeed', 'Town Ace', 'Urban Cruiser',
                'Vanguard', 'Vellfire', 'Vellfire', 'Vitz', 'Vitz Jewela', 'Vitz RS', 'Voxy', 'Wish', 'Yaris'
            ],
            'Volkswagen' => [
                'Beetle', 'Golf', 'Golf Plus', 'GTI', 'Jetta', 'Passat', 'Polo', 'Sharan', 'T4 Caravelle',
                'T5 California', 'Tiguan', 'Touareg', 'Touran', 'up!'
            ],
            'Volvo' => [
                'C70', 'S60', 'V40', 'V60', 'V70', 'XC60', 'XC90'
            ]
        ];

        foreach ($carData as $makeName => $models) {
            // Create the make
            $make = Make::create(['name' => $makeName]);

            // Create the models associated with the make
            foreach ($models as $modelName) {
                vehicleModel::create([
                    'make_id' => $make->id,
                    'name' => $modelName,
                ]);
            }
        }
    }

}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\PetHotel;
use App\Models\SOPGeneral;
use App\Models\Asuransi;
use App\Models\Package;
use App\Models\CancelSOP;
use App\Models\SupportedPetType;
use App\Models\SupportedPet;
use App\Models\Fasilitas;
use App\Models\MonitoringImage;
use App\Models\Monitoring;
use App\Models\CustomSOP;
use App\Models\PetHotelImage;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dt = Carbon::now();
        $dateNow = $dt->toDateTimeString();

 
        $asuransi = Asuransi::create([
            'asuransi_id' => 5,
            'asuransi_name' => 'Pertanggung jawaban pertama saat hewan anda mengalami kecelakaan.'
        ]);

        $sop_general = SOPGeneral::create([
            'sop_generals_id' => 5,
            'sop_generals_description' => 'kami mencoba untuk menghasilkan produk dan jasa yang terbaik',
            'sop_generals_asuransi' => 'Semua hewan dicover asuransi manulife'
        ]);

        $cancel_sop = CancelSOP::create([
            'cancel_sops_id' => 5,
            'cancel_sops_description' => 'Kami tidak masalah jika terjadi pembatalan saat order'
        ]);

        $supportedPetType = SupportedPetType::create([
            'supported_pet_type_name'=> 'British Short Hair'
        ]);

        $supportedPet = SupportedPet::create([
            'supported_pet_id' => 5,
            'supported_pet_name' => 'Tria', 
            'supported_pet_type_id' => $supportedPetType->supported_pet_type_id
        ]);

        $fasilitas = Fasilitas::create([
            'fasilitas_id' => 7,
            'fasilitas_name' => 'Tempat Makan Anjing', 
            'fasilitas_description' => 'Fasilitas kami dilengkapin dengan tempat makan anjing yang luas.'
        ]);
        $packages = Package::create([
            'package_id' => 1,
            'fasilitas_id' => $fasilitas->fasilitas_id,
            'supported_pet_id' => $supportedPet->supported_pet_id,
            'package_price' => 175700
        ]);

        $pet_hotel_image = PetHotelImage::create([
            'pet_hotel_image_id' => 5,
            'pet_hotel_image_url' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.npr.org%2F2021%2F10%2F27%2F1049736477%2Fgoogle-minors-remove-images-search-results&psig=AOvVaw2TXWM1pYjPclzAR3iqc-ih&ust=1665239177981000&source=images&cd=vfe&ved=0CAsQjRxqFwoTCLD6r7-pzvoCFQAAAAAdAAAAABAH'
        ]);

        $pet_hotel = PetHotel::create([
            'pet_hotel_id' => 1,
            'pet_hotel_name' => 'Amore Pet Hotel',
            'pet_hotel_longitude' => 15.235125,
            'pet_hotel_latitude' => 12.1325135,
            'pet_hotel_location' => 'Jln. Catalina 9 Blok Z, Graha Raya',
            'pet_hotel_description' => 'Kami telah beroperasi selama 9 tahun berturut-turut',
            'sop_generals_id' => $sop_general->sop_generals_id,
            'asuransi_id' => $asuransi->asuransi_id,
            'cancel_sops_id' => $cancel_sop->cancel_sops_id,
            'supported_pet_id' => $supportedPet->supported_pet_id,
            'fasilitas_id' => $fasilitas->fasilitas_id,
            'package_id' => $packages->package_id,
            'pet_hotel_image_id' => $pet_hotel_image->pet_hotel_image_id
        ]);

        $monitoring_image_id = MonitoringImage::create([
            'monitoring_image_id' => 15,
            'monitoring_image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/77/Google_Images_2015_logo.svg/800px-Google_Images_2015_logo.svg.png'
        ]);

        $monitoring = Monitoring::create([
            'monitoring_id' => 5, 
            'monitoring_name' => 'Anjing Makan',
            'monitoring_image_id' => $monitoring_image_id->monitoring_image_id
         ]);

        $customSop = CustomSOP::create([
            'custom_sop_id' => 5, 
            'custom_sop_name'=> 'Ajak main setiap 30 menit sekali'
        ]);


        $order = Order::create([
            'order_id' => 1,
            'order_name' => 'order dea amanda',
            'order_status' => 'Belum Diverifikasi',
            'order_date_checkin' => $dateNow,
            'order_date_checkout' => $dateNow,
            'user_id' => '24125321853135',
            'pet_hotel_id' => $pet_hotel->pet_hotel_id
        ]);

        $order_detail = OrderDetail::create([
            'order_detail_id' => 1,
            'pet_name' => 'Dea',
            'pet_type' => 'Kucing',
            'order_detail_price' => 10000,
            'order_id' => $order->order_id,
            'monitoring_id' => $monitoring->monitoring_id,
            'package_id' => $packages->package_id,
            'custom_sop_id' => $customSop->custom_sop_id
        ]);

     
        
    }
}

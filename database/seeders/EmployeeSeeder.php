<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employee')->insert([
            ['name'=>'SPM Administrator','user_id'=>1,'role'=>1,'created_at'=>now()],
            ['name'=>'Gabriel Cesar Hutagalung','user_id'=>2,'role'=>1,'created_at'=>now()],
            ['name'=>'Dr. Arnaldo Marulitua Sinaga, S.T, M.InfoTech','user_id'=>3,'role'=>2,'created_at'=>now()],
            ['name'=>'Dr. Johannes Harungguan Sianipar, S.T., M.T.','user_id'=>4,'role'=>4,'created_at'=>now()],
            ['name'=>'Rosni Lumbantoruan, ST, M.ISD,Ph.D','user_id'=>5,'role'=>5,'created_at'=>now()],
            ['name'=>'Rosni Lumbantoruan, ST, M.ISD,Ph.D','user_id'=>5,'role'=>59,'created_at'=>now()],
            ['name'=>'Humasak Tommy Argo Simanjuntak, ST, M.ISD','user_id'=>6,'role'=>6,'created_at'=>now()],
            ['name'=>'Humasak Tommy Argo Simanjuntak, ST, M.ISD','user_id'=>6,'role'=>59,'created_at'=>now()],
            ['name'=>'Mariana Simanjuntak, S.S, M.Sc','user_id'=>7,'role'=>19,'created_at'=>now()],
            ['name'=>'Indra Hartarto Tambunan, ST., M.S.,Ph.D','user_id'=>8,'role'=>44,'created_at'=>now()],
            ['name'=>'Indra Hartarto Tambunan, ST., M.S.,Ph.D','user_id'=>8,'role'=>58,'created_at'=>now()],
            ['name'=>'Riyanthi Angrainy Sianturi, S.Sos, M.Ds','user_id'=>9,'role'=>47,'created_at'=>now()],
            ['name'=>'Dr. Fitriani Tupa Ronauli Silalahi, S.Si, M.Si','user_id'=>10,'role'=>45,'created_at'=>now()],
            ['name'=>'Dr. Merry Meryam Martgrita, S.Si., M.Si','user_id'=>11,'role'=>46,'created_at'=>now()],
            ['name'=>'Parmonangan Rotua Togatorop, S.Kom., M.T.I','user_id'=>12,'role'=>13,'created_at'=>now()],
            ['name'=>'Parmonangan Rotua Togatorop, S.Kom., M.T.I','user_id'=>12,'role'=>59,'created_at'=>now()],
            ['name'=>'Arie Satia Dharma, S.T, M.Kom','user_id'=>13,'role'=>48,'created_at'=>now()],
            ['name'=>'Arie Satia Dharma, S.T, M.Kom','user_id'=>13,'role'=>57,'created_at'=>now()],
            ['name'=>'Samuel Indra Gunawan Situmeang, S.Ti., M.Sc.','user_id'=>14,'role'=>50,'created_at'=>now()],
            ['name'=>'Samuel Indra Gunawan Situmeang, S.Ti., M.Sc.','user_id'=>14,'role'=>59,'created_at'=>now()],
            ['name'=>'Guntur Purba Siboro, S.T, M.T','user_id'=>15,'role'=>49,'created_at'=>now()],
            ['name'=>'Guntur Purba Siboro, S.T, M.T','user_id'=>15,'role'=>58,'created_at'=>now()],
            ['name'=>'Josua Boyke William Jawak, ST., M.Ds','user_id'=>16,'role'=>51,'created_at'=>now()],
            ['name'=>'Ardiles Sinaga, S.T., M.T.','user_id'=>17,'role'=>56,'created_at'=>now()],
            ['name'=>'Eka Stephani Sinambela, SST., M.Sc','user_id'=>18,'role'=>55,'created_at'=>now()],
            ['name'=>'Goklas Henry Agus Panjaitan, S.Tr.Kom','user_id'=>19,'role'=>54,'created_at'=>now()],
            ['name'=>'Yoke Aprilia Purba S.Kom','user_id'=>20,'role'=>23,'created_at'=>now()],
            ['name'=>'Anggiat Saud Parulian, S.Tr.Kom.','user_id'=>21,'role'=>21,'created_at'=>now()],
            ['name'=>'Oka Simatupang, S.Sos','user_id'=>22,'role'=>21,'created_at'=>now()],
            ['name'=>'Monalisa Pasaribu, S.S, M.Ed (TESOL)','user_id'=>23,'role'=>31,'created_at'=>now()],
            ['name'=>'Rentauli Mariah Silalahi, S.Pd, M. Ed','user_id'=>24,'role'=>31,'created_at'=>now()],
            ['name'=>'Rusneni Vitaria','user_id'=>25,'role'=>35,'created_at'=>now()],
            ['name'=>'Natal Sijabat','user_id'=>26,'role'=>7,'created_at'=>now()],
            ['name'=>'Dr. Arlinta Christy Barus S.T., M.InfoTech','user_id'=>27,'role'=>57,'created_at'=>now()],
            ['name'=>'Iustisia Natalia Simbolon, S.Kom.,M.T','user_id'=>28,'role'=>57,'created_at'=>now()],
            ['name'=>'Ranty Deviana Siahaan, S.Kom, M.Eng.','user_id'=>29,'role'=>57,'created_at'=>now()],
            ['name'=>'Herimanto, S.Kom., M.Kom','user_id'=>30,'role'=>57,'created_at'=>now()],
            ['name'=>'Junita Amalia, S.Pd, M.Si','user_id'=>31,'role'=>9,'created_at'=>now()],
            ['name'=>'Junita Amalia, S.Pd, M.Si','user_id'=>31,'role'=>59,'created_at'=>now()],
            ['name'=>'Mario Elyezer Subekti Simaremare, S.Kom., M.Sc','user_id'=>32,'role'=>59,'created_at'=>now()],
            ['name'=>'Tennov Simanjuntak, S.T, M.Sc.','user_id'=>33,'role'=>59,'created_at'=>now()],
            ['name'=>'Albert Sagala, S.T, M.T','user_id'=>34,'role'=>58,'created_at'=>now()],
            ['name'=>'Deni P. Lumbantoruan, S.T, M.Eng., Ph.D.','user_id'=>35,'role'=>58,'created_at'=>now()],
            ['name'=>'Good Fried Panggabean, ST, MT, Ph.D','user_id'=>36,'role'=>58,'created_at'=>now()],
            ['name'=>'Philippians Manurung, S.T., M.T.','user_id'=>37,'role'=>58,'created_at'=>now()],
        ]);
    }
}

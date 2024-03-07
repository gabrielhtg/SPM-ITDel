<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class create_dashboard_introduction extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dashboard')->insert([
                'juduldashboard' => 'Ini judul Introduction',
                'keterangandashboard' => '
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illum itaque rerum nihil recusandae laboriosam, iusto alias repellendus similique magnam ratione deleniti ut laudantium natus qui soluta consequatur ipsa nemo ad?
                    Provident sed et labore alias vel obcaecati reiciendis corrupti blanditiis dolorem, non pariatur aut eum deleniti voluptate animi unde velit! Ab et id libero qui nisi sequi sapiente veniam itaque.
                    In doloribus error ducimus, placeat harum, doloremque fugit nemo quisquam ullam eos expedita. Quae deleniti illo corporis incidunt molestiae, placeat rem totam nostrum! Perspiciatis officiis omnis atque quia sunt culpa.
                    Inventore iure consequuntur earum enim modi unde quidem accusantium, aut voluptate, sit reprehenderit. Voluptates est dolorem, tempore magnam incidunt totam quibusdam molestias, a illum ipsum mollitia consequatur, temporibus porro ea.
                    Tempore, incidunt similique, quos omnis, pariatur voluptate sit aliquid ipsam labore modi quia. Nobis officia corrupti unde, veniam id, aspernatur impedit veritatis reiciendis ipsa minus neque commodi non provident numquam!
                    Explicabo voluptas commodi sequi autem ut maiores vero laboriosam ipsum amet quasi. Inventore recusandae doloremque praesentium neque quibusdam? Consectetur reiciendis fuga illum debitis culpa assumenda omnis eligendi impedit fugiat officia.
                    Eaque optio repellendus architecto. Similique quaerat voluptatum eligendi quos dolores alias ad? Alias natus quis perferendis id sequi voluptatibus voluptas ratione sed eius iste? Autem similique ratione aliquid adipisci dolor!
                    A fuga ratione molestiae quod illum. Quidem quae mollitia quos distinctio est tempore dolorem impedit quibusdam obcaecati, sequi odit magni, consequuntur sit laudantium similique perspiciatis laborum harum ut numquam accusantium.
                    At ex doloremque, nostrum illum inventore adipisci voluptatem rerum in, officia vel consequatur fuga sequi? Et repellat corporis cumque. Dolor at impedit voluptatem officia laboriosam nihil provident libero omnis dolore?
                    Eos odit reiciendis aut vitae dolore aspernatur quo fugiat omnis, ratione ullam numquam harum voluptates error a. Soluta repellat, illo nihil velit quam vero quibusdam, voluptatem sit tempora necessitatibus iure!
                    Quae, eum. Ullam sapiente debitis recusandae reprehenderit facere, similique modi adipisci saepe blanditiis possimus corporis doloribus totam dolor rerum, excepturi molestias. Dolores quo aspernatur voluptates est eos ab itaque maxime!
                    Atque repellat, ipsam totam, laudantium architecto sint sunt expedita et sit magnam cupiditate rem libero possimus! Modi amet accusantium nisi, qui nemo aut! Eum commodi amet praesentium eos minima in?
                    Eius magni labore perferendis dicta obcaecati atque modi aperiam vel eveniet alias excepturi dignissimos reprehenderit, ex voluptates veritatis quos delectus nisi? Aut, quae molestiae? Optio aliquid laborum totam nulla nisi.
                    Nulla inventore non laborum cum perferendis enim, hic praesentium dolores error molestias quos, iste ipsum obcaecati nisi vel. Nesciunt possimus totam modi cupiditate culpa quo pariatur sed dolore, id quam?
                    Officia expedita sed debitis id consequuntur fuga quibusdam dolores autem, similique ducimus facere perferendis modi atque cumque quidem a non omnis? Repudiandae veritatis placeat praesentium. Ut ipsam veniam exercitationem eos?
                    Reprehenderit quas placeat repudiandae quidem porro obcaecati minus illo nam fuga. Eos dignissimos maxime voluptatibus ad animi quaerat vel, eveniet recusandae. Necessitatibus suscipit id non praesentium nulla! Dignissimos, minima molestias.
                    Nostrum eum, fugiat unde dolorum voluptatibus ipsa. Amet quos dolores minus unde laudantium quis voluptatum inventore iste, distinctio animi iure illo laborum dignissimos, officiis ab! Ipsa excepturi id libero consequatur.
                    Quam, est quod adipisci, quo fugit nesciunt doloribus minus ipsam tempora id iste commodi quisquam, laboriosam nobis sapiente dolores optio? Harum non ea dolorem tenetur quis, iusto minima ex delectus!
                    Veniam iste ex error dolorem ea cum minus iure temporibus suscipit? Tempore dolorem aliquid doloremque facere similique modi iste delectus. Labore facilis accusantium cumque aliquam sint, molestiae aperiam qui repellendus?
                    Ducimus perferendis, asperiores porro officiis, quos aut enim earum est veritatis deserunt voluptatum ipsa molestias obcaecati, autem ad reprehenderit eos facilis quod voluptatem sit vero quasi quisquam. Ea, quis esse.
                ',
        ]);
    }
}

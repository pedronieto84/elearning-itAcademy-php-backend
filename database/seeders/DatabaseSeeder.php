<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Course;
use App\Models\Module;
use App\Models\Topic;
use App\Models\Card;
use App\Models\Lista;
use App\Models\Video;
use App\Models\Text;
use App\Models\Test;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Creates 5 courses with its corresponding Modules, Topics, Cards and Resources.
        Course::factory(5)
        ->create()

        ->each( function ($course) {
            $modules = Module::factory(5)
            ->create()

            ->each( function ($module) {
                $topics = Topic::factory(rand(3,8))
                ->create()

                ->each( function ($topic) {
                    $cards = Card::factory(rand(2,5))
                    ->create()

                    ->each( function ($card) {
                        $videos = Video::factory(rand(1,3))->create();
                        $listas = Lista::factory(rand(1,2))->create();
                        $texts = Text::factory(rand(1,3))->create();
                        $tests = Test::factory(rand(1,2))->create();


                        foreach ($videos as $video) {
                            $card->video()->save($video);
                        };

                        foreach ($listas as $lista) {
                            $card->lista()->save($lista);
                        };

                        foreach ($texts as $text) {
                            $card->text()->save($text);
                        };

                        foreach ($tests as $test) {
                            $card->test()->save($test);
                        };

                    });

                    foreach ($cards as $card) {
                        $topic->card()->save($card);
                    };

                });

                foreach ($topics as $topic) {
                    $module->topic()->save($topic);
                };

            });

            foreach ($modules as $module) {
                $course->module()->save($module);
            };

        });
    }
}

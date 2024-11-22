<?php

namespace Database\Seeders;

use App\Models\Letter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cards = [
            [
                'sender' => 'Alex, the Dreamer',
                'subject' => 'A new bike',
                'content' => 'Dear Santa, I wish for a shiny red bike to ride with my friends.',
                'read' => false,
                'image_url' => 'https://picsum.photos/seed/bike/150/150'
            ],
            [
                'sender' => 'Emily, the Artist',
                'subject' => 'Art supplies',
                'content' => 'Hi Santa, I would love some new art supplies to paint beautiful pictures.',
                'read' => true,
                'image_url' => 'https://picsum.photos/seed/art/150/150'
            ],
            [
                'sender' => 'Jack, the Adventurer',
                'subject' => 'A telescope',
                'content' => 'Santa, could you bring me a telescope? I want to see the stars up close.',
                'read' => false,
                'image_url' => 'https://picsum.photos/seed/telescope/150/150'
            ],
            [
                'sender' => 'Sophia, the Reader',
                'subject' => 'A storybook collection',
                'content' => 'Dear Santa, I hope to receive a collection of magical storybooks this Christmas.',
                'read' => false,
                'image_url' => 'https://picsum.photos/seed/books/150/150'
            ],
            [
                'sender' => 'Liam, the Animal Lover',
                'subject' => 'A pet dog',
                'content' => 'Hi Santa, can you bring me a little puppy to play with? I promise to take care of it.',
                'read' => true,
                'image_url' => 'https://picsum.photos/seed/dog/150/150'
            ],
            [
                'sender' => 'Olivia, the Baker',
                'subject' => 'Baking set',
                'content' => 'Santa, I want to bake cookies just like my mom. Please bring me a baking set!',
                'read' => false,
                'image_url' => 'https://picsum.photos/seed/baking/150/150'
            ],
            [
                'sender' => 'Noah, the Scientist',
                'subject' => 'Science kit',
                'content' => 'Dear Santa, I would love a science kit to do experiments at home.',
                'read' => true,
                'image_url' => 'https://picsum.photos/seed/science/150/150'
            ],
            [
                'sender' => 'Mia, the Performer',
                'subject' => 'Microphone',
                'content' => 'Santa, can you bring me a microphone? I want to sing like a star!',
                'read' => false,
                'image_url' => 'https://picsum.photos/seed/microphone/150/150'
            ],
            [
                'sender' => 'Lucas, the Builder',
                'subject' => 'Lego set',
                'content' => 'Hi Santa, I wish for a big Lego set to build amazing things!',
                'read' => false,
                'image_url' => 'https://picsum.photos/seed/lego/150/150'
            ],
            [
                'sender' => 'Ella, the Dancer',
                'subject' => 'Ballet shoes',
                'content' => 'Dear Santa, please bring me a pair of ballet shoes. I want to dance on stage.',
                'read' => true,
                'image_url' => 'https://picsum.photos/seed/ballet/150/150'
            ],
            [
                'sender' => 'Emily Johnson',
                'subject' => 'My Christmas Wishlist',
                'content' => 'Dear Santa, I have been very good this year. I would love to get a dollhouse and a puppy!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=2'
            ],
            [
                'sender' => 'Liam Smith',
                'subject' => 'Christmas Gifts for My Family',
                'content' => 'Hi Santa! Please bring something nice for my mom and dad. Maybe a book for dad and a necklace for mom?',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=3'
            ],
            [
                'sender' => 'Sophia Brown',
                'subject' => 'Christmas Cookies for You',
                'content' => 'Dear Santa, I made cookies for you! I hope you enjoy them. I would love to get a skateboard this year.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
        ];

        Letter::insert($cards);
    }
}

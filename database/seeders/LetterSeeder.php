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
                'read' => false,
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
                'read' => false,
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
                'read' => false,
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
                'read' => false,
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
            [
                'sender' => 'Oliver Williams',
                'subject' => 'A Bike for Christmas',
                'content' => 'Dear Santa, I’ve been dreaming about a shiny red bike! Hope you can make it happen.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Charlotte Davis',
                'subject' => 'A Magical Christmas',
                'content' => 'Dear Santa, all I want this year is to have a magical time with my family.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Elijah Miller',
                'subject' => 'New Books Please!',
                'content' => 'Hi Santa! I’d love to read new adventure books this year. Thank you!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Amelia Martinez',
                'subject' => 'A Dress for the Holidays',
                'content' => 'Dear Santa, I’d love to have a sparkling dress for Christmas dinner.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'James Garcia',
                'subject' => 'Snowboard Dream',
                'content' => 'Dear Santa, can you bring me a snowboard? I want to ride the snow!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Mia Rodriguez',
                'subject' => 'A Kitten for Christmas',
                'content' => 'Hi Santa, I’d love to have a kitten to cuddle with during the holidays.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Benjamin Wilson',
                'subject' => 'A Telescope to See the Stars',
                'content' => 'Dear Santa, I wish for a telescope so I can see the stars and planets.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Evelyn Hernandez',
                'subject' => 'A Ballet Outfit',
                'content' => 'Hi Santa! I’d love a new ballet outfit to dance this Christmas.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Lucas Moore',
                'subject' => 'RC Car Request',
                'content' => 'Dear Santa, can you please bring me a remote-controlled car?',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Harper Anderson',
                'subject' => 'A Christmas Adventure',
                'content' => 'Dear Santa, I’d love to go on a Christmas adventure with my family!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Ava Lee',
                'subject' => 'A Teddy Bear',
                'content' => 'Hi Santa, I would love a big fluffy teddy bear to hug at night.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Noah Thomas',
                'subject' => 'A Soccer Ball',
                'content' => 'Dear Santa, please bring me a soccer ball so I can practice my goals!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Isabella Taylor',
                'subject' => 'A Craft Kit',
                'content' => 'Dear Santa, I wish for a craft kit to make beautiful things this Christmas.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'William White',
                'subject' => 'A Pair of Roller Skates',
                'content' => 'Hi Santa! I’d love to have roller skates to play outside with my friends.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Mila Harris',
                'subject' => 'A Puzzle for Christmas',
                'content' => 'Dear Santa, I’d love a big puzzle to solve with my family.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Henry Martin',
                'subject' => 'A Science Kit',
                'content' => 'Hi Santa, I love science! Could you bring me a science experiment kit?',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Luna Clark',
                'subject' => 'A Unicorn Toy',
                'content' => 'Dear Santa, I dream of a unicorn toy that lights up and sparkles!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Jack Lewis',
                'subject' => 'A Dinosaur Figure',
                'content' => 'Hi Santa, can you bring me a dinosaur figure? I love learning about them!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Ella Walker',
                'subject' => 'A Musical Instrument',
                'content' => 'Dear Santa, I’d love to learn to play a ukulele. Can you bring me one?',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Alexander Scott',
                'subject' => 'A Racing Track',
                'content' => 'Hi Santa, could you bring me a racing track for my toy cars?',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Zoe King',
                'subject' => 'A Dream Doll',
                'content' => 'Dear Santa, all I want is a beautiful doll with long hair that I can style!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Matthew Young',
                'subject' => 'A Robot Friend',
                'content' => 'Hi Santa, I would love a robot that can talk and play with me!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Chloe Perez',
                'subject' => 'A Puppy for Christmas',
                'content' => 'Dear Santa, I’ve been wishing for a puppy that I can take care of!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Jackson Rodriguez',
                'subject' => 'Superhero Costume',
                'content' => 'Dear Santa, I want to be a superhero this Christmas! Please bring me a superhero costume.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Scarlett Lee',
                'subject' => 'A Fairy Garden Set',
                'content' => 'Hi Santa! I’d love to have a fairy garden kit with little fairies and sparkles!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Ethan Perez',
                'subject' => 'A New Helmet',
                'content' => 'Dear Santa, I need a new helmet so I can ride my bike safely!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Grace Carter',
                'subject' => 'A Mermaid Tail',
                'content' => 'Dear Santa, I’ve always wanted a mermaid tail to wear in the pool!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Daniel Evans',
                'subject' => 'A Toy Train Set',
                'content' => 'Hi Santa, can you bring me a big toy train set to play with? I love trains!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Sophie Hall',
                'subject' => 'A Baking Set',
                'content' => 'Dear Santa, I’d love to have a baking set so I can make cookies just like you!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Benjamin Green',
                'subject' => 'A Magic Kit',
                'content' => 'Hi Santa! Can you bring me a magic kit to perform amazing tricks?',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Amos Clark',
                'subject' => 'A Skateboard for Christmas',
                'content' => 'Dear Santa, all I want this Christmas is a cool skateboard to ride with my friends.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Maya Adams',
                'subject' => 'A Magical Dollhouse',
                'content' => 'Hi Santa, please bring me a magical dollhouse with lights and furniture!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Eliot Thomas',
                'subject' => 'A Super Fast Car',
                'content' => 'Dear Santa, I would love to have a super fast toy car that can zoom around!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Lily Harris',
                'subject' => 'A Coloring Set',
                'content' => 'Hi Santa, I love to color! Please bring me a big coloring set with markers and crayons.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Jacob Lee',
                'subject' => 'A Basketball',
                'content' => 'Dear Santa, I’ve been practicing basketball, and I’d love a new basketball this year!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Zara Jackson',
                'subject' => 'A Fancy Hat',
                'content' => 'Hi Santa! I would like a fancy hat to wear to all the Christmas parties.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Jackie Robinson',
                'subject' => 'A Trampoline',
                'content' => 'Dear Santa, can you bring me a trampoline so I can jump high into the air?',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Isabella Scott',
                'subject' => 'A Christmas Sweater',
                'content' => 'Hi Santa! Please bring me a cozy Christmas sweater with reindeer and snowflakes.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Oliver Evans',
                'subject' => 'A Helicopter Toy',
                'content' => 'Dear Santa, I’d love a toy helicopter that flies high in the sky!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Sophia White',
                'subject' => 'A New Backpack',
                'content' => 'Hi Santa, I need a new backpack to carry all my school things!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Lucas Mitchell',
                'subject' => 'A Kite for Christmas',
                'content' => 'Dear Santa, I would love a colorful kite that I can fly on windy days!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Ava Davis',
                'subject' => 'A Set of Dolls',
                'content' => 'Hi Santa, please bring me a set of dolls so I can play with my friends!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Evan Collins',
                'subject' => 'A Remote Control Car',
                'content' => 'Dear Santa, I would really like a remote control car to race around the house.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Maya Cooper',
                'subject' => 'A Fairy Wand',
                'content' => 'Hi Santa, can you bring me a fairy wand that glows and makes magic?',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Oliver Brown',
                'subject' => 'A New Watch',
                'content' => 'Dear Santa, I’ve always wanted a cool watch that I can wear to school.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Ella Turner',
                'subject' => 'A Unicorn Puzzle',
                'content' => 'Hi Santa, I would love a unicorn puzzle to put together with my family!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Noah Harris',
                'subject' => 'A Helicopter Toy',
                'content' => 'Dear Santa, I would love to have a helicopter toy that flies in the sky!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Charlotte Johnson',
                'subject' => 'A Play Kitchen Set',
                'content' => 'Hi Santa! Please bring me a play kitchen set so I can pretend to cook with my friends!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'James Martinez',
                'subject' => 'A Spy Kit',
                'content' => 'Dear Santa, I want a spy kit to feel like a secret agent this Christmas!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Lily Wilson',
                'subject' => 'A Dinosaur Set',
                'content' => 'Hi Santa, I would love a set of dinosaurs to play with and learn about!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Harper Lewis',
                'subject' => 'A Teddy Bear',
                'content' => 'Dear Santa, I would love to have a soft teddy bear to cuddle with at night.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Isaiah Clark',
                'subject' => 'A Magic Carpet',
                'content' => 'Hi Santa, I want a magic carpet that can fly me to faraway places.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Amelia Robinson',
                'subject' => 'A Camera',
                'content' => 'Dear Santa, I want a camera to take pictures of all my fun adventures!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Liam Green',
                'subject' => 'A Telescope',
                'content' => 'Hi Santa, I want a telescope to look at the stars and planets at night.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Sophie Wright',
                'subject' => 'A Playhouse',
                'content' => 'Dear Santa, can you bring me a cute playhouse that I can play in with my friends?',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Aiden Harris',
                'subject' => 'A Rocket Ship Toy',
                'content' => 'Hi Santa, I would love a rocket ship toy to pretend I’m an astronaut!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Mia King',
                'subject' => 'A Ballet Outfit',
                'content' => 'Dear Santa, can you bring me a beautiful ballet outfit so I can dance like a ballerina?',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Ethan Evans',
                'subject' => 'A Pirate Ship Toy',
                'content' => 'Hi Santa, I want a pirate ship toy so I can sail the high seas!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Zoe Miller',
                'subject' => 'A Dinosaur Book',
                'content' => 'Dear Santa, I love dinosaurs! Please bring me a dinosaur book so I can learn more about them.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'David White',
                'subject' => 'A Basketball Hoop',
                'content' => 'Hi Santa, I would love a mini basketball hoop to practice my shots at home!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Lily Martinez',
                'subject' => 'A Fairy Tale Book',
                'content' => 'Dear Santa, can you bring me a fairy tale book so I can read bedtime stories?',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Nolan Wilson',
                'subject' => 'A New Bicycle',
                'content' => 'Hi Santa, please bring me a new bicycle so I can ride around the park!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Ella Cooper',
                'subject' => 'A Pet Rabbit',
                'content' => 'Dear Santa, I’ve always wanted a cute pet rabbit to keep as a friend.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Lucas Taylor',
                'subject' => 'A Lego Set',
                'content' => 'Hi Santa! I would love a big Lego set to build different structures and things.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Charlotte Thomas',
                'subject' => 'A Water Gun',
                'content' => 'Dear Santa, can you bring me a water gun to play with on warm days?',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Benjamin Clark',
                'subject' => 'A Puzzle Map',
                'content' => 'Hi Santa, I would love a puzzle map to learn about the world and places!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Amos Adams',
                'subject' => 'A New Scooter',
                'content' => 'Dear Santa, please bring me a new scooter to ride with my friends!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Sophia Lee',
                'subject' => 'A Mermaid Costume',
                'content' => 'Hi Santa, can you bring me a mermaid costume so I can pretend to swim like one?',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Oliver King',
                'subject' => 'A Snow Globe',
                'content' => 'Dear Santa, I love snow globes! Please bring me one with a winter scene inside.',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
            [
                'sender' => 'Amelia Turner',
                'subject' => 'A Jump Rope',
                'content' => 'Hi Santa! I want a jump rope to play with outside and get some exercise!',
                'read' => false,
                'image_url' => 'https://picsum.photos/150/150?random=4'
            ],
        ];

        Letter::insert($cards);
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class bookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $categoryFiction=[
            'Action and adventure',
            'Alternate history',
            'Anthology',
            'Chick lit',
            'Childrens',
            'Classic',
            'Comic book',
            'Coming-of-age',
            'Crime',
            'Drama',
            'Fairytale',
            'Fantasy',
            'Graphic Novel',
            'Historical fiction',
            'Horror',
            'Mystery',
            'Paranormal romance',
            'Picture book',
            'Poetry',
            'Political thriller',
            'Romance',
            'Satire',
            'Science fiction',
            'Short story',
            'Suspense',
            'Thriller',
            'Western',
            'Young adult'];

        $categoryNonFiction=[
            'Art/architecture',
            'Autobiography',
            'Biography',
            'Business/economics',
            'Crafts/hobbies',
            'Cookbook',
            'Diary',
            'Dictionary',
            'Encyclopedia',
            'Guide',
            'Health/fitness',
            'History',
            'Home and garden',
            'Humor',
            'Journal',
            'Math',
            'Memoir',
            'Philosophy',
            'Prayer',
            'Religion, spirituality, and new age',
            'Textbook',
            'True crime',
            'Review',
            'Science',
            'Self help',
            'Sports and leisure',
            'Travel',
            'True crime'];

        $type=['Fiction','Nonfiction'];

        $setType = $type[random_int(0,1)];

        if($setType == 'Fiction'){
            $setCategory = $categoryFiction[random_int(0,27)];
        }
        if($setType == 'Nonfiction'){
            $setCategory = $categoryNonFiction[random_int(0,27)];
        }

        $status=['Active','NotActive'];

        return [
            'Title' => $this->faker->unique()->word,
            'Author' => $this->faker->name,
            'Type' => $setType,
            'Category' => $setCategory,
            'Copyright' => $this->faker->name,
            'No_pages' => $this->faker->numberBetween($min = 100, $max = 500),
            'Stock' => $this->faker->numberBetween($min = 1, $max = 120),
            'status' => $status[random_int(0,1)],
        ];
    }
}

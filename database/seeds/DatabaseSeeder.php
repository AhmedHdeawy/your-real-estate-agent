<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(LanguagesTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(GroupsTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(GroupMembersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(RepliesTableSeeder::class);
        $this->call(LikesTableSeeder::class);
        $this->call(MessagesTableSeeder::class);
        $this->call(FriendsTableSeeder::class);
    }
}

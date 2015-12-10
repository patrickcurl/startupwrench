<?php

use Illuminate\Database\Seeder;
use App\Topic;
class TopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	 $topics = ['Idea Generation', 'Naming', 'Domain names', 'Hosting', 'Market research', 'Forms and Surveys', 'Mockups and Wireframing', 'Design', 'Development', 'Bootcamps', 'Incubaters and Accelerators', 'Deployment', 'Social tools', 'MVP', 'Marketing', 'Early Users', 'Presentations', 'Product Demo', 'Launching', 'Analytics', 'Mobile Analytics', 'Customer Support', 'Project Management', 'Collaboration and Communication', 'Productivity', 'Bugtracking and Feedback', 'Shop', 'Payments', 'Outsourcing', 'Raising Capital', 'Investors', 'Sales', 'CRM', 'Legal', 'Finance', 'HR', 'Learning', 'Books', 'Videos', 'Articles', 'Blogs', 'Newsletters'];

    	 foreach($topics as $topic){
            $t = new Topic;
            
    	 	if ($t->validate(['name' => $topic])){
               
               $t->name = $topic;
               if($t->save())
                {
                    $this->command->info("Added topic: {$topic}"); 
                }
            } else {
                $this->command->info($t->errors());
            }
            // Topic::create(["name" => $topic]);
    	 }
    }
}

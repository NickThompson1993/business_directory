<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use League\Csv\Reader;
use App\Business;
use App\BusinessHours;
use App\Category;
use Exception;
use Storage;

class PopulateDatabaseFromCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:populate {file_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Attempt to populate the database via a given CSV file.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $fileName = $this->argument('file_name');
        $filePath = "import_data/{$fileName}";
       throw_if(!Storage::exists($filePath), 
        new \Exception("The file: {$fileName} does not exist in the storage path")
        );

       $reader = Reader::createFromPath(Storage::path($filePath));
       $reader->setHeaderOffset(0);  
       collect($reader->getRecords())->each(function($record, $index) use($reader){
        
       
            $data = [
                'title' => $record[$reader->getHeader()[0]],
                'body' => mb_convert_encoding($record[$reader->getHeader()[2]] , 'UTF-8', 'UTF-8'),
                'tripadvisor'=> $record[$reader->getHeader()[3]],  
                'quarter'=> $record[$reader->getHeader()[4]],
                'address1'=> $record[$reader->getHeader()[5]],
                'address2'=> $record[$reader->getHeader()[6]],
                'town'=> $record[$reader->getHeader()[7]],
                'postcode'=> $record[$reader->getHeader()[8]],
                'longitude'=> $record[$reader->getHeader()[9]],
                'latitude'=> $record[$reader->getHeader()[10]],
                'phone'=> $record[$reader->getHeader()[11]],
                'website'=> $record[$reader->getHeader()[12]],
                'facebook'=> $record[$reader->getHeader()[22]],
                'instagram'=> $record[$reader->getHeader()[23]],
                'twitter'=> $record[$reader->getHeader()[24]],
                'youtube'=> $record[$reader->getHeader()[25]]
            ];
            $business = Business::create($data);

            $hoursData = [
                'business_id' => $index,
                'monday_hours' => $record[$reader->getHeader()[14]],
                'tuesday_hours' => $record[$reader->getHeader()[15]],
                'wednesday_hours' => $record[$reader->getHeader()[16]],
                'thursday_hours' => $record[$reader->getHeader()[17]],
                'friday_hours' => $record[$reader->getHeader()[18]],
                'saturday_hours' => $record[$reader->getHeader()[19]],
                'sunday_hours' => $record[$reader->getHeader()[20]],
                'bank_hours' => $record[$reader->getHeader()[21]],
            ];
            BusinessHours::create($hoursData);

            $categories = $this->resolveCategories($record[$reader->getHeader()[1]]);
           
            $business->categories()->attach($categories);
            
       });
    }

    protected function resolveCategories($categories) {
        $categories = explode(',', $categories);
        return array_map(function($category){
            $categoryInstance = Category::where('name', $category)->first();
            if($categoryInstance) {
                return $categoryInstance->id;
            }
            return Category::create(['name' => $category])->id;
        }, $categories);
    
    }

  
}

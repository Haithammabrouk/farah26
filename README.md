# Farah Project

# Installation
- Its very simple, Just open your MySQL Client (i.e PhpMyAdmin) &amp; create DB:

        dslr_db     

- Tshen run the following command on your terminal:

        bash run.sh           


    or


        sh run.sh       


    or 

        . run.sh        

# Helpers
- To update the admin portal permissions run on terminal:

        php artisan permissions:update      


- Helper Trait to upload any image in different sizes:

        App\Helpers\ImageUploaderTrait  

- File System manager just add the following code to your Model if you want it to inherit the fillable methodology.

<i>no need to make colomn in your db for (image, pdfs, videos, media) pathes, this polymorphic table can hold as many as possible instances without overloading the server or response timing.</i>

**for single file**

        public function file()
        {
            return $this->morphOne(File::class, 'fileable');
        }   

**for multi files**

        public function files()
        {
            return $this->morphMany(File::class, 'fileable');
        }

- To refresh your database tables, and get a pure one, run this command:

        bash refresh.sh


![TECH](https://yt3.ggpht.com/a/AGF-l78FAkOCNYV8LZHcUvQ2Ja-7u-b46tC0C2i1GA=s288-c-k-c0xffffffff-no-rj-mo)


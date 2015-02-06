# SwagTS

Scans Swagger Models folders to create TypeScript type definitions (d.ts)

# Usage

1. Ensure that Swagger Annotations are autoloaded in any manner in your project. For example you can use composer's autoloader:

   ```
   $loader = require(__DIR__.'/../vendor/autoload.php');
   AnnotationRegistry::registerLoader([$loader,'loadClass']);
   ```
2. Create a Writer and point it at your Swagger Models directory

   ```
   $dir = new \DirectoryIterator("src/Whatever/Swagger/MyModels");
   $w = new SwagTS\Writer();
   echo $w->crawlDirectory($dir, "MyModels", "\\MyVendor\\Whatever\\Swagger\\");
   ```
   
   First namespace parameter will translate in ts module name. 
   The second one is a prefix, so your `MyVendor\Whatever\Swagger\MyModels` will translate to `module MyModels`.
3. Bingo!
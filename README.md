# SwagTS

Scans Swagger Models to create TypeScript type definitions (d.ts)

# Usage

## from swagger json

```
use SwagTS\Providers\JSONSchema;
use SwagTS\Writer;

$provider = new JSONSchema(['json_schema' => file_get_contents('https://api.timepad.ru/doc/swag/Timepad%20API.json')]);
$w = new Writer($p);
$converted = $w->makeModule("MyDesiredTSNamespace");
```
  

## From swagger-php models

```
use SwagTS\Providers\SwaggerPHP;
use SwagTS\Writer;

$provider = new SwaggerPHP(['directory' => "src/Whatever/MySwaggerStuff/", 'resource' => '/']);
$w = new Writer($provider);
$converted = $w->makeModule("MyDesiredTSNamespace");
```
  
  
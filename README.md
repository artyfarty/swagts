# SwagTS

Scans Swagger Models to create TypeScript type definitions (d.ts)

# Usage


## From swagger-php models

```

$w = new Writer(new SwaggerPHP(['directory' => "src/Whatever/MySwaggerStuff/", 'resource' => '/']));
$converted = $w->makeModule("MyDesiredTSNamespace");
```
  
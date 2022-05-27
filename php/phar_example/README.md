# pjson

php json tool, like python's mjson.

## shell

Use in linux shell:

```
cp pjson.phar /usr/local/bin/pjson
chmod +x /usr/local/bin/pjson
echo '{"json":"example"}' | pjson
```

## php

```
require 'src/pjson.php';
$pj = new pjson('{"foo":"bar"}');
$jsonViewString = $pj->outStr();

/* echo $jsonViewString;
{
    "foo":"bar"
}
*/
```

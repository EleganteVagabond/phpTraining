<?php

// notice the <<< initializing the value
$str = <<<'EOD'
Example of string
spanning multiple lines
using nowdoc syntax.
$a does not parse.
EOD;                        // closing 'EOD' must be on it's own line, and to the left most point

echo $str;
echo "\n\n";

$a = 'Variable';

$str = <<<EOD
Example of string
spanning multiple lines
using heredoc syntax.
$a is parsed
EOD;

echo $str;

$str = "\n\n
Example of string
spanning multiple lines
using double quote heredoc syntax.
$a is parsed.
";

echo $str;
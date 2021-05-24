<?php

namespace PHP2JS;

use PhpParser\Error;
use PhpParser\ParserFactory;

class PHP2JS
{
    public static function compile($code){
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        try {
            $ast = $parser->parse('<?php'.PHP_EOL.$code);
        } catch (Error $error) {
            echo "Parse error: {$error->getMessage()}\n";
            return;
        }

        $compiler= new Compiler;
        $jscode = $compiler->prettyPrint($ast);
        return $jscode;
    }

    public static function compileFile($input,$output=null){
        $code = @file_get_contents($input);
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        try {
            $ast = $parser->parse($code);
        } catch (Error $error) {
            echo "Parse error: {$error->getMessage()}\n";
            return;
        }

        $compiler= new Compiler;
        $jscode = $compiler->prettyPrint($ast);
        if($output){
            file_put_contents($output,$jscode);
            return;
        }
        return $newCode;
    }
}
<?php

namespace PHP2JS;

use PhpParser\Error;
use PhpParser\ParserFactory;

class PHP2JS
{
    public static function compile($code,$mode = 'js'){
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        $errorHandler = new \PhpParser\ErrorHandler\Collecting;

            $ast = $parser->parse('<?php'.PHP_EOL.$code, $errorHandler);
            if ($errorHandler->hasErrors()) {
                foreach ($errorHandler->getErrors() as $error) {
                    // $error is an ordinary PhpParser\Error
                }
            }  

        $compiler= new Compiler;
        $compiler->mode = $mode;
        $jscode = $compiler->prettyPrint($ast);
        return $jscode;
    }

    public static function compileFile($input,$output=null,$mode='js'){
        $code = @file_get_contents($input);
        $parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
        try {
            $ast = $parser->parse($code);
        } catch (Error $error) {
            echo "Parse error: {$error->getMessage()}\n";
            return;
        }

        $compiler= new Compiler;
        $compiler->mode = $mode;
        $jscode = $compiler->prettyPrint($ast);
        if($output){
            file_put_contents($output,$jscode);
            return;
        }
        return $newCode;
    }
}
<?php

namespace Rmunate\Php2Js;

class License
{
    /**
     * Generate Text License
     * @return comment license
     */
    public static function comment()
    {
        return $comment = <<<EOT
        /*
        * Copyright (c) [2023] [RAUL MAURICIO UNATE CASTRO]
        * https://github.com/rmunate/PHP2JS
        *
        * This library is an open-source software available under the MIT License.
        * Permission is hereby granted, free of charge, to any person obtaining a copy of this library and associated
        * documentation files (the "Software"), to use the library without restriction, including, but not limited to, the
        * following actions:
        *
        * - Use the library for commercial or non-commercial purposes.
        * - Modify the library and adapt it to your own needs.
        * - Distribute copies of the library.
        * - Sublicense the library.
        *
        * When using or distributing this library, it is required to include the following attribution in all copies or
        * substantial portions of the Software:
        *
        * "[RAUL MAURICIO UNATE CASTRO], the copyright holder of this library, must be acknowledged and mentioned in all copies or derivatives of the library."
        *
        * Furthermore, if modifications are made to the library, it is requested to include an additional note in the
        * documentation or any other means of notifying the changes made, stating:
        *
        * "This library has been modified from the original library developed by [RAUL MAURICIO UNATE CASTRO]."
        *
        * THE LIBRARY IS PROVIDED "AS IS," WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
        * LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT
        * SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
        * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE LIBRARY OR THE USE OR OTHER DEALINGS
        * IN THE LIBRARY.
        */
        EOT;
        
    }
}

?>
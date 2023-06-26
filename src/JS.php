<?php

/*
 * Copyright (c) [2023] [RAUL MAURICIO UÑATE CASTRO]
 *
 * Esta biblioteca es un software de código abierto disponible bajo la licencia MIT.
 * Se concede permiso, de forma gratuita, a cualquier persona que obtenga una copia de esta biblioteca y los archivos de
 * documentación asociados (el "Software"), para utilizar la biblioteca sin restricciones, incluyendo, entre otras, las
 * siguientes acciones:
 *
 * - Utilizar la biblioteca con fines comerciales o no comerciales.
 * - Modificar la biblioteca y adaptarla a sus propias necesidades.
 * - Distribuir copias de la biblioteca.
 * - Sublicenciar la biblioteca.
 *
 * Al utilizar o distribuir esta biblioteca, se requiere que se incluya la siguiente atribución en todas las copias o
 * partes sustanciales de la misma:
 *
 * "[RAUL MAURICIO UÑATE CASTRO], titular de los derechos de autor de esta biblioteca, debe ser
 * reconocido y mencionado en todas las copias o derivados de la biblioteca."
 *
 * Además, si se realizan modificaciones en la biblioteca, se solicita que se incluya una nota adicional en la
 * documentación o en cualquier otro medio de notificación de los cambios realizados, que indique:
 *
 * "Esta biblioteca se ha modificado a partir de la biblioteca original desarrollada por [RAUL MAURICIO UÑATE CASTRO]."
 *
 * LA BIBLIOTECA SE PROPORCIONA "TAL CUAL", SIN GARANTÍA DE NINGÚN TIPO, EXPRESA O IMPLÍCITA, INCLUYENDO PERO NO
 * LIMITADO A GARANTÍAS DE COMERCIALIZACIÓN, ADECUACIÓN PARA UN PROPÓSITO PARTICULAR Y NO INFRACCIÓN. EN NINGÚN CASO
 * LOS AUTORES O TITULARES DE LOS DERECHOS DE AUTOR SERÁN RESPONSABLES DE NINGUNA RECLAMACIÓN, DAÑO O OTRA
 * RESPONSABILIDAD, YA SEA EN UNA ACCIÓN DE CONTRATO, AGRAVIO O CUALQUIER OTRO MOTIVO, QUE SURJA DE, O EN RELACIÓN CON
 * LA BIBLIOTECA O EL USO U OTROS TRATOS EN LA BIBLIOTECA.
 */

namespace Rmunate\Php2Js;

use Rmunate\Php2Js\License;

class JS
{

    /**
     * Propierties Object
     * Id Unique from Script
     */
    private $uniqueID;
    private $reward;
    private $alias;
    private $license;
    private $compact = false;

    /**
     * Create a Static Instance
     * @return static
     */
    public static function script(string $reward): static
    {
        return new static($reward, false);
    }

    /**
     * Create a Static Instance
     * @return static
     */
    public static function compact(string $compact): static
    {
        return new static($compact, true);
    }

    /**
     * Create New Instance
     * @return void
     */
    public function __construct(string $reward, bool $compact = false)
    {
        $this->uniqueID = strtoupper(bin2hex(random_bytes(16)));
        $this->reward = $reward;
        $this->license = License::comment();
        $this->compact = $compact;
    }

    /**
     * @param string $alias
     * @return static
     */
    public function alias(string $alias = 'PHP2JS')
    {
        if (empty($alias)) {
            $this->alias = 'PHP2JS';
            return $this;
        } else {
            $long = strlen($alias);
            $alias = substr($alias, 1, $long - 2);
            if (empty($alias)) {
                $this->alias = 'PHP2JS';
                return $this;
            } else {
                $patron = '/^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$/';
                if (preg_match($patron, $alias)) {
                    $this->alias = preg_replace('/[^a-zA-Z0-9_$]+/', '', $alias);
                    return $this;
                } else {
                    throw new \Exception ('The alias "' . $alias . '" is not valid for the name of a constant in JavaScript');
                }
            }
        }
    }

    /**
     * Return Script JS
     * @return string
     */
    public function generate(): string
    {
        if ($this->compact) {
            $jsonEncode = '<?php echo json_encode(compact(' . $this->reward . '),JSON_UNESCAPED_UNICODE);?>;';
        } else if ($this->reward == 'vars') {
            $jsonEncode = '<?php echo json_encode(array_diff_key(get_defined_vars(), array_flip(["app", "__data", "errors", "__env", "__path"])),JSON_UNESCAPED_UNICODE); ?>;';
        } else {
            $jsonEncode = '<?php echo json_encode(\Rmunate\Php2Js\DataPhp2Js::' . $this->reward . '(),JSON_UNESCAPED_UNICODE); ?>;';
        }
        return '<script id="' . $this->uniqueID . '">
                    ' . $this->license . '
                    const ' . $this->alias . ' = ' . $jsonEncode . '
                    document.getElementById("' . $this->uniqueID . '").remove();
                </script>';
    }
}
